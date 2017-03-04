<?php
class UsersController extends AppController {

	var $name = 'Users';
	var $helpers = array('Form','Html', 'Ajax', 'Javascript', 'Validation');
	

	
	function login() 
	{	
		$this->configs = $this->Config->find('list');
		$login_message = $this->configs['login_message'];
		$cutOff = $this->configs['cut_off'];
		$cutOn = $this->configs['cut_on'];
		//If the form has been submitted then authenticate users
		if($this->data) {
			$this->Bauth->regfields = array('department_id', 'department_sub_id', 'department_unit_id','name',
			'department_name', 'group_name', 'department_sub_name', 'department_unit_name', 'cost_center_id',
			'cost_center_name', 'business_type_id', 'business_type_name', 'id', 'aktif', 'group_is_admin');
			$this->Bauth->login($this->data);
			//$this->Session->setFlash(__('Login Unsuccessfull. Please, try again.', true));
		}
		else 
		{
			//If there was no data submitted, simply render the login form
			$this->set(compact('login_message', 'cutOff', 'cutOn'));
			$this->render('login');
		}
	}
		
	function logout() {
		$this->Bauth->logoutPage = '/users/login';  //Sets the page where the user will be redirected when logging out
		$this->Bauth->logout();  //Actually logs out the user, destroying session information 
	}
	
	function index() 
	{

		if(!$this->Session->read('Userinfo.id'))
		{
			$this->redirect('/users/login');
			exit;
		}	

		$this->Session->write('User.can_edit', $this->Session->read('Security.permissions')==admin_group_id);
		$layout=$this->data['User']['layout'];
		if(!empty($this->data))
		{
			if($this->data['Cost']['name'] = '')
				$this->data['User']['cost_center_id'] = null;
			$this->Session->write('User.department_id', $this->data['User']['department_id']);
			$this->Session->write('User.business_type_id', $this->data['User']['business_type_id']);
			$this->Session->write('User.cost_center_id', $this->data['User']['cost_center_id']);
			$this->Session->write('User.name', $this->data['User']['search']);
			$this->Session->write('User.aktif', $this->data['User']['aktif']);
		}
	
		$this->User->recursive = 0;
		
		$cons=array();
		$name =  $this->Session->read('User.name');
        $cons[] = array('OR' => array('User.name LIKE' => '%' . $name . '%', 
										  'User.username LIKE' => '%' . $name . '%',
										  ));
		if($this->Session->read('User.aktif')==1)
			$cons[]=array('User.aktif'=>1);
		else if($this->Session->read('User.aktif')==2)
			$cons[]=array('User.aktif'=>0);
			
		if($department_id=$this->Session->read('User.department_id'))
			$cons[]=array('User.department_id'=>$department_id);
			
		if($business_type_id=$this->Session->read('User.business_type_id'))
			$cons[]=array('User.business_type_id'=>$business_type_id);
			
		if($cost_center_id=$this->Session->read('User.cost_center_id'))
			$cons[]=array('User.cost_center_id'=>$cost_center_id);
				
		$this->paginate = array('order'=>'User.id');
		if($layout=='pdf' || $layout=='xls'){
			$con = $this->User->find('all', array('conditions'=>$cons));
		}else{
			$con = $this->paginate($cons);
		}

		$this->set('users', $con);
		
		$businessType= $this->User->BusinessType->find('list');
		$costCenters= $this->User->CostCenter->find('list');
		$departments= $this->User->Department->find('list');
		$copyright_id = $this->configs['copyright_id'];
		$this->set(compact('costCenters','departments', 'businessType', 'copyright_id'));
		//$Userinfo['username'];
		if($layout=='pdf')
		{
			Configure::write('debug',1); // Otherwise we cannot use this method while developing 
			$this->layout = 'pdf'; //this will use the pdf.ctp layout 
			$this->render('index_pdf'); 		
		}
		else if($layout=='xls')
		{
			$this->render('index_xls','export_xls');		
		}
	}

	function view($id = null) {
		if(!$this->Session->read('Userinfo.id'))
		{
			$this->redirect('/users/login');
			exit;
		}		
		if (!$id) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->write('User.can_edit', $this->Session->read('Security.permissions')==admin_group_id);
		$this->set('user', $this->User->read(null, $id));
	}

	function add() {
		if(!$this->Session->read('Userinfo.id'))
		{
			$this->redirect('/users/login');
			exit;
		}	
		if (!empty($this->data)) {
			$is_symbol = $this->configs['is_symbol'];
			$is_numeric = $this->configs['is_numeric'];
			$is_upper_case = $this->configs['is_upper_case'];

			if(strlen($this->data['User']['password']) >= 6 && $this->data['User']['password'] == $this->data['User']['password2'] && $this->check_password($this->data['User']['password']))
			{
				$this->Session->setFlash(__('Enter the correct user password. Please, try again.', true));

				$this->User->create();
				$this->data['User']['password'] = md5($this->data['User']['password']) ;			
				$this->data['User']['last_password_change'] = date('Y-m-d H:i:s') ;			
				if ($this->User->save($this->data)) {
					
					$this->User->PasswordHistory->create();
						$data['PasswordHistory']['date'] = date('Y-m-d H:i:s');
						$data['PasswordHistory']['user_id'] = $this->User->id;
						$data['PasswordHistory']['password'] = md5($this->data['User']['password']);
					$this->User->PasswordHistory->save($data);
					
					$this->Session->setFlash(__('The user has been saved', true), 'default', array('class'=>'ok'));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
				}
			}else {
				$this->Session->setFlash(__('The user can not be saved. Please, password and minimal password must be 6 digit. Put '.$is_symbol.' symbol, '.$is_numeric.' numeric and '.$is_upper_case.' upper case ', true));
			
			}
		}
		$groups = $this->User->Group->find('list');
		$departments = $this->User->Department->find('list');
		$costCenter = $this->User->CostCenter->find('list');
		$businessType = $this->User->BusinessType->find('list');
		$this->set(compact('groups','departments', 'costCenter', 'businessType'));	
	}

	function edit($id = null) {
		if(!$this->Session->read('Userinfo.id'))
		{
			$this->redirect('/users/login');
			exit;
		}		
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
		$groups = $this->User->Group->find('list');
		$departments = $this->User->Department->find('list');
		$costCenter = $this->User->CostCenter->find('list');
		$businessType = $this->User->BusinessType->find('list');
		$this->set(compact('groups','departments','departmentsub','departmentunit', 'costCenter', 'businessType'));			
	}
	
	function set_password($id = null) {
		if(!$this->Session->read('Userinfo.id'))
		{
			$this->redirect('/users/login');
			exit;
		}		
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		$user = $this->User->read(null, $id);
		$is_symbol = $this->configs['is_symbol'];
		$is_numeric = $this->configs['is_numeric'];
		$is_upper_case = $this->configs['is_upper_case'];
		$limit_password = $this->configs['limit_password'];
		$this->set(compact('user'));
		if (!empty($this->data)) {
			if($this->data['User']['password'] == $this->data['User']['password2'] && strlen($this->data['User']['password']) >= '6'
			&& $user['User']['password']!=md5($this->data['User']['password']) && $this->check_password($this->data['User']['password']))
			{
			$this->data['User']['password'] = md5($this->data['User']['password']) ;
			$date = $this->data['User']['last_password_change'] = date('Y-m-d H:i:s') ;
						
			$passwords = $this->User->PasswordHistory->find('all', array('conditions'=>array(
				'PasswordHistory.user_id' => $id), 'order'=>array('PasswordHistory.id'=>'DESC'),
				'limit'=>$limit_password));
				
			$i = 1;
			$password = 0;
			foreach($passwords as $pass){
				if($pass['PasswordHistory']['password']==md5($this->data['User']['password']))
					$password += $i;
			}
			if($password==0){
				$this->User->PasswordHistory->create();
				$data['PasswordHistory']['date'] = date('Y-m-d H:i:s');
				$data['PasswordHistory']['user_id'] = $id;
				$data['PasswordHistory']['password'] = md5($this->data['User']['password']);
				$this->User->PasswordHistory->save($data);
					if ($this->User->save($this->data)) {
						$this->Session->setFlash(__('The user password has been changed', true), 'default', array('class'=>'ok'));
						$this->redirect(array('controller'=>'pages', 'action' => 'home'));
						}
					}else{
						$this->Session->setFlash(__('The user password could not be changed. Please, Make sure password not been used', true));
					}
			}else{
				$this->Session->setFlash(__('The user password could not be changed. Please, try again. Put '.$is_symbol.' symbol, '.$is_numeric.' numeric and '.$is_upper_case.' upper case Or Password Has been Used', true));
			}
		}
		
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
	}
	
	function delete($id = null) {
		if(!$this->Session->read('Userinfo.id'))
		{
			$this->redirect('/users/login');
			exit;
		}		
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->User->delete($id)) {
			$this->Session->setFlash(__('User deleted', true), 'default', array('class'=>'ok'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function change_password() {
		if(!$this->Session->read('Userinfo.id'))
		{
			$this->redirect('/users/login');
			exit;
		}		
		$user = $this->User->read(null , $this->Session->read('Userinfo.id'));
		$is_symbol = $this->configs['is_symbol'];
		$is_numeric = $this->configs['is_numeric'];
		$is_upper_case = $this->configs['is_upper_case'];
		$limit_password = $this->configs['limit_password'];
		if (!empty($this->data)) {
			if($user['User']['password']==md5($this->data['User']['old_password'])/*  && $user['User']['password']!=md5($this->data['User']['password']) */
				 && $this->data['User']['password'] == $this->data['User']['password2'] && strlen($this->data['User']['password']) >= 6){
				if($this->check_password($this->data['User']['password']))
				{
				$this->data['User']['password'] = md5($this->data['User']['password']);
				$this->data['User']['last_password_change'] = date('Y-m-d H:i:s') ;
								
			$passwords = $this->User->PasswordHistory->find('all', array('conditions'=>array(
				'PasswordHistory.user_id' => $this->Session->read('Userinfo.id')), 'order'=>array('PasswordHistory.id'=>'DESC'),
				'limit'=>$limit_password));
				
				$i = 1;
				$password = 0;
				foreach($passwords as $pass){
					if($pass['PasswordHistory']['password']==md5($this->data['User']['password']))
						$password += $i;
				}
				if($password==0){
					$this->User->PasswordHistory->create();
					$data['PasswordHistory']['date'] = date('Y-m-d H:i:s');
					$data['PasswordHistory']['user_id'] = $this->Session->read('Userinfo.id');
					$data['PasswordHistory']['password'] = md5($this->data['User']['password']);
					$this->User->PasswordHistory->save($data);
						if ($this->User->save($this->data)) {
							$this->Session->setFlash(__('The user password has been changed', true), 'default', array('class'=>'ok'));
							$this->redirect(array('controller'=>'pages', 'action' => 'home'));
						}else{
							$this->Session->setFlash(__('The user password could not be changed. Please, try again.', true));
						} 
					}else{
						$this->Session->setFlash(__('Password has been used', true));
					}
				}else{
					$this->Session->setFlash(__('The user password could not be changed. Please, try again. Put '.$is_symbol.' symbol, '.$is_numeric.' numeric and '.$is_upper_case.' upper case', true));
				}
			}else{
					$this->Session->setFlash(__('The user password could not be changed. Please, old password not correct or try to check new password', true));
			}	
		}
		$moduleName = 'User > Profile';
		$this->set('title_for_layout',  $this->lastSegment($moduleName));
		$this->set(compact('moduleName'));
	}
	
	function check_password($data)
	{
		if(!empty($data))
		{
			$check_simbol		= $this->check_simbol($data);
			$check_upper_case	= $this->check_upper_case($data);
			$check_numeric		= $this->check_numeric($data);
			//$check_space		= $this->check_space($data);
		}
		else
		{
			return false;
		}	
		if($check_simbol && $check_upper_case && $check_numeric/*  && $check_space */)
			return true;
		else
			return false;
	}
	function check_upper_case($data)
	{
		$is_symbol = $this->configs['is_symbol'];
		if(!empty($data))
		{
			if(preg_match_all('/[A-Z]/', $data, $count))
			{
				$check = count($count[0]);
			}
		}
		if(!empty($check) && $check == $is_symbol)	
			return true;
		else
			return false;
	}
	
	function check_simbol($data)
	{
		$is_upper_case = $this->configs['is_upper_case'];
		if(!empty($data))
		{
			if(preg_match_all('%[^a-zA-Z0-9]%', $data, $count))
			{
				$check = count($count[0]);
			}
		}
		if(!empty($check) && $check == $is_upper_case)	
			return true;
		else
			return false;
	}
	
	function check_numeric($data)
	{
		$is_numeric = $this->configs['is_numeric'];
		if(!empty($data))
		{
			if(preg_match_all('/[0-9]/', $data, $count))
			{
				$check = count($count[0]);
			}
		}
		if(!empty($check) && $check == $is_numeric)	
			return true;
		else
			return false;
	}
	
	function check_space($data)
	{
		if(!empty($data))
		{
			if(preg_match_all('/\s+/', $data, $count))
			{
				$check = count($count[0]);
			}else
			    $check = 0;
			
		}
		if(!empty($check) && $check==0)	
			return true;
		else
			return false;
	}
}
?>
