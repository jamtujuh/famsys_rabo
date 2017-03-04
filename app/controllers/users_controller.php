<?php
App::import('Controller', 'ActivityLogs');
App::import('Controller', 'NpbDetails');
App::import('Controller', 'FamsysInterfaces');
App::import('Model', 'User');

class UsersController extends AppController {

	var $name = 'Users';
	var $helpers = array('Form','Html', 'Ajax', 'Javascript', 'Validation');
	var $components = array('RequestHandler', 'Attachment', 'Session');
	
	function loginx() 
	{	
		Configure::write('debug', 0); // Otherwise we cannot use this method while developing
		$this->configs = $this->Config->find('list');
		$login_message = $this->configs['login_message'];
		$cutOff = $this->configs['cut_off'];
		$cutOn = $this->configs['cut_on'];
		
		$auto_logout_on 	= $this->configs['auto_logout_on'];
		$auto_logout_off 	= $this->configs['auto_logout_off'];
		
		$trigger_on 	= $this->configs['trigger_on'];
		$trigger_off 	= $this->configs['trigger_off'];
		
		$day_trigger_1 	= $this->configs['day_trigger_1'];
		$day_trigger_2 	= $this->configs['day_trigger_2'];
		
		$timecurrent	= date('H:i:s');
		$curday 		= date('d');
		
		if($curday == $day_trigger_1 && $timecurrent >= $trigger_on && $timecurrent <= $trigger_off){
			$NpbDetail	= new NpbDetailsController;
			$NpbDetail->recap_mrs(1);
		}else if ($curday == $day_trigger_2 && $timecurrent >= $trigger_on && $timecurrent <= $trigger_off){
			$NpbDetail	= new NpbDetailsController;
			$NpbDetail->recap_mrs(2);
		}
		//If the form has been submitted then authenticate users
		if($this->data) {
			$this->Bauth->regfields = array('email','department_id', 'department_sub_id', 'department_unit_id','name',
			'department_name', 'group_name', 'department_sub_name', 'department_unit_name', 'cost_center_id',
			'cost_center_name', 'business_type_id', 'business_type_name', 'id', 'aktif', 'group_is_admin', 'last_password_change');

			$name 		= $this->data['User']['username'];
			$cons		= array('User.username'=>$name);
			
			$userlogin	= $this->User->find('all', array('conditions' => $cons));
			
			$pwd 		= $userlogin[0]['User']['password'];
			$akt		= $userlogin[0]['User']['aktif'];
			//username not exist
			if(!$userlogin[0]['User']['username']){
				$name		= $this->data['User']['username'];
				$process 	= 'LOGIN FAILED';
				$status 	= 'FAILED';
				$created	= date('Y-m-d H:i:s');
				$remark		= 'USER '. $name .' NOT EXIST';
				$ActivityDataArray = array($name,$process,$status,$created,$remark);
				
				$Activity 	= new ActivityLogsController;			
				$Activity->add($ActivityDataArray);
				$this->Bauth->login($this->data);
			}
			if($akt == 0){				
				$process 	= 'LOGIN FAILED';
				$status 	= 'FAILED';
				$created	= date('Y-m-d H:i:s');
				$remark		= 'USER DISABLED';
				$ActivityDataArray = array($name,$process,$status,$created,$remark);
				
				$Activity 	= new ActivityLogsController;			
				$Activity->add($ActivityDataArray);
				$this->Bauth->login($this->data);			
			}
			
			//password correct
			if($pwd == md5($this->data['User']['password'])){
				$process 	= 'LOGIN';
				$status 	= 'SUCCESS';
				$created	= date('Y-m-d H:i:s');
				$remark		= '';
				$ActivityDataArray = array($name,$process,$status,$created,$remark);
				
				$Activity 	= new ActivityLogsController;			
				$Activity->add($ActivityDataArray);
				
				if($curday == $day_trigger_1 && $timecurrent >= $trigger_on && $timecurrent <= $trigger_off){
					$NpbDetail	= new NpbDetailsController;
					$NpbDetail->recap_mrs(1);
				}else if ($curday == $day_trigger_2 && $timecurrent >= $trigger_on && $timecurrent <= $trigger_off){
					$NpbDetail	= new NpbDetailsController;
					$NpbDetail->recap_mrs(2);
				}
				$this->Bauth->login($this->data);
			}else{
			//password not correct
				$name 		= $this->data['User']['username'];		
				$process 	= 'LOGIN FAILED';
				$status 	= 'FAILED';
				$created	= date('Y-m-d H:i:s');
				$remark		= 'WRONG PASSWORD';
				$ActivityDataArray = array($name,$process,$status,$created,$remark);				
				$Activity 	= new ActivityLogsController;
				$Activity->add($ActivityDataArray);
				$this->Bauth->login($this->data);
			}						
		}
		else 
		{
			//If there was no data submitted, simply render the login form
			$this->set(compact('login_message', 'cutOff', 'cutOn'));
			$this->render('login');
		}
	}
	
	//function login di by pass passwordnya,jadi hanya memasukkan username nya saja (UAT Rendi)
	function login() 
	{	
		//phpinfo();
		//App::import('Lib','ldap');
		App::import('Lib','ldapmock'); // Use this ldapmock to bypass ldap authentication.
		Configure::write('debug', 0); // Otherwise we cannot use this method while developing
		
		//reset all of default menu loaded by the user
		$this->Session->write('Menu',null);
		//$this->Session->write('Menu.main.User.Change Password','/users/change_password');
		$this->Session->write('Menu.main.Main.Home','/#');
		$this->Session->write('Menu.main.Main.Login','/users/login');
		$this->Session->write('Menu.main.Main.Reset Password','/users/reset_password');
		
		$this->configs = $this->Config->find('list');
		
		$login_message = $this->configs['login_message'];
		$cutOff = $this->configs['cut_off'];
		$cutOn = $this->configs['cut_on'];
		
		$auto_logout_on 	= $this->configs['auto_logout_on'];
		$auto_logout_off 	= $this->configs['auto_logout_off'];
		/*
		$trigger_on 	= $this->configs['trigger_on'];
		$trigger_off 	= $this->configs['trigger_off'];
		
		$day_trigger_1 	= $this->configs['day_trigger_1'];
		$day_trigger_2 	= $this->configs['day_trigger_2'];
		
		$timecurrent	= date('H:i:s');
		$curday 		= date('d');
		
		if($curday == $day_trigger_1 && $timecurrent >= $trigger_on && $timecurrent <= $trigger_off){
			$NpbDetail	= new NpbDetailsController;
			$NpbDetail->recap_mrs(1);
		}else if ($curday == $day_trigger_2 && $timecurrent >= $trigger_on && $timecurrent <= $trigger_off){
			$NpbDetail	= new NpbDetailsController;
			$NpbDetail->recap_mrs(2);
		}
		*/
		//If the form has been submitted then authenticate users
		if($this->data){
			$name 		= trim($this->data['User']['ad_user']);
			$pass 		= $this->data['User']['password'];
			
			$res 		= $this->User->query("select count(id) as total from users where ad_user = '".$name."'");
			$total		= $res[0][0]['total'];
			
			if($total > 0){
				$logToAD	= $name;
				//$ldap 		= new ldap;
				// Use ldapmock to bypass ldap authentication.
					$userByAdName = $this->User->find('first', array('conditions' => array('User.ad_user' => $name)));
					$mockupArgs = array();
					$mockupArgs['auth_ok'] = true; // true => ldap->auth always return true, false => always return false.
					$mockupArgs['ad_user_givenname'] = $userByAdName['User']['name'];
					$mockupArgs['ad_user_sn'] = '';
					$mockupArgs['ad_user_mail'] = $userByAdName['User']['email'];
					$mockupArgs['ad_user_samaccountname'] = $name;
					$ldap = new ldapmock();
                                        $ldap->setMockupArgs($mockupArgs);

				/* ******************************** */
				/* FOR TESTING, USE THE BOTTOM CODE */
				/* ******************************** */
				//$conn = $ldap->auth($logToAD,$pass);
				$conn = $ldap->auth($logToAD);
					
				if($conn){
					$ldap_info = $ldap->getInfo($logToAD, $pass);
					
					$this->Session->write('Userinfo.name', $ldap_info['name']);
					$this->Session->write('Userinfo.email', $ldap_info['email']);
					
					$this->Session->write('ldap_info', $ldap_info);
					
					$this->Bauth->regfields = array('email', 'department_id', 'department_sub_id', 'department_unit_id','name',
					'department_name', 'group_name', 'department_sub_name', 'department_unit_name', 'cost_center_id',
					'cost_center_name', 'business_type_id', 'business_type_name', 'id', 'aktif', 'group_is_admin', 'last_password_change');
					
					$process 	= 'LOGIN';
					$status 	= 'SUCCESS';
					$created	= date('Y-m-d H:i:s');
					$remark		= '';
					$ActivityDataArray = array($name,$process,$status,$created,$remark);
					
					$Activity 	= new ActivityLogsController;			
					$Activity->add($ActivityDataArray);
					$this->Bauth->login($this->data);
				}else{
					$this->Session->setFlash(__('Authorization to Active Directory Failed, Wrong Username / Password. Please try again.', true));
					$this->set(compact('login_message', 'cutOff', 'cutOn'));
					unset($this->data['User']['username']);
					unset($this->data['User']['password']);
					unset($this->data['User']);				
					$this->redirect(array('action'=>'login'));
				}
			}else{
				$this->Session->setFlash(__('User Not Existed In Famsys. Please try again.', true));
				$this->set(compact('login_message', 'cutOff', 'cutOn'));
				unset($this->data['User']['username']);
				unset($this->data['User']['password']);
				unset($this->data['User']);				
				$this->redirect(array('action'=>'login'));
			}
			
			
			
			
			/*
			$res 		= $this->User->query("select count(id) as total from users where ad_user = '".$name."'");
			$total		= $res[0][0]['total'];
			if($total > 0){
				$cons		= array('User.ad_user'=>$name);
				$userlogin	= $this->User->find('all', array('conditions' => $cons));
				$adUser		= $userlogin[0]['User']['ad_user'];
				$logToAD 	= '';
				if(empty($adUser)){
					$logToAD = $name;
				}else{
					$logToAD = $adUser;
				}
				
				//echo '<pre>';
				//var_dump($userlogin);
				//echo '</pre>';die();
				
				//connect to ad
				$ldap = new ldap;			
				if($pass	== dev_password_id){
					$conn = $ldap->auth($logToAD);			
				}else{
					$conn = $ldap->auth($logToAD,$pass);
				}
				
				if($conn){
					echo "first bind success<br>";
					if($userlogin){					
						$ldap_info = $ldap->getInfo($adUser, $pass);
						
						//echo '<pre>';
						//var_dump($ldap_info);
						//echo '</pre>';die();					
						
						$this->Bauth->regfields = array('email', 'department_id', 'department_sub_id', 'department_unit_id','name',
						'department_name', 'group_name', 'department_sub_name', 'department_unit_name', 'cost_center_id',
						'cost_center_name', 'business_type_id', 'business_type_name', 'id', 'aktif', 'group_is_admin', 'last_password_change');
						
						$this->Session->write('Userinfo.name', $ldap_info['name']);
						$this->Session->write('Userinfo.email', $ldap_info['email']);
						
						$this->Session->write('ldap_info', $ldap_info);

						$name 		= $this->data['User']['username'];
						$cons		= array('User.username'=>$name);				
						$akt		= $userlogin[0]['User']['aktif'];
						//$pwd		= $userlogin[0]['User']['password'];
						if($akt == 0){
							$process 	= 'LOGIN FAILED';
							$status 	= 'FAILED';
							$created	= date('Y-m-d H:i:s');
							$remark		= 'USER DISABLED';
							$ActivityDataArray = array($name,$process,$status,$created,$remark);
							
							$Activity 	= new ActivityLogsController;			
							$Activity->add($ActivityDataArray);
							$this->Bauth->login($this->data);
						}else{
							$process 	= 'LOGIN';
							$status 	= 'SUCCESS';
							$created	= date('Y-m-d H:i:s');
							$remark		= '';
							$ActivityDataArray = array($name,$process,$status,$created,$remark);
							
							$Activity 	= new ActivityLogsController;			
							$Activity->add($ActivityDataArray);
							$this->Bauth->login($this->data);
						}
					}else{						
						$this->Session->setFlash(__('User Not Registered in Famsys. Please try again.', true));
						//$this->redirect(array('controller'=>'users','action' => 'reset_password', $userEmail));		
						$this->set(compact('login_message', 'cutOff', 'cutOn'));
						unset($this->data['User']['username']);
						unset($this->data['User']['password']);
						unset($this->data['User']);
						$this->redirect(array('action'=>'login'));
					}
				}else{					
					$this->Session->setFlash(__('Authorization to Active Directory Failed, Wrong Username / Password. Please try again.', true));
					$this->set(compact('login_message', 'cutOff', 'cutOn'));
					unset($this->data['User']['username']);
					unset($this->data['User']['password']);
					unset($this->data['User']);				
					$this->redirect(array('action'=>'login'));
				}
			}else{
				$this->Session->setFlash(__('User Not Existed In Famsys. Please try again.', true));
				$this->set(compact('login_message', 'cutOff', 'cutOn'));
				unset($this->data['User']['username']);
				unset($this->data['User']['password']);
				unset($this->data['User']);				
				$this->redirect(array('action'=>'login'));
			}	*/		
		}else{			
			$this->set(compact('login_message', 'cutOff', 'cutOn'));
			$this->render('login');
		}
	}
	
	function logout() {
		Configure::write('debug', 0); // Otherwise we cannot use this method while developing
		$this->configs 		= $this->Config->find('list');
		$auto_logout_on 	= $this->configs['auto_logout_on'];
		$auto_logout_off 	= $this->configs['auto_logout_off'];
		/*
		$trigger_on 	= $this->configs['trigger_on'];
		$trigger_off 	= $this->configs['trigger_off'];
		
		$day_trigger_1 	= $this->configs['day_trigger_1'];
		$day_trigger_2 	= $this->configs['day_trigger_2'];
		*/
		$journal_cut_off 	= $this->configs['journal_cut_off'];
		
		$timecurrent	= date('H:i:s');
		$curday 		= date('d');
		
		/*
		if($curday == $day_trigger_1 && $timecurrent >= $trigger_on && $timecurrent <= $trigger_off){
			$NpbDetail	= new NpbDetailsController;
			$NpbDetail->recap_mrs(1);
		}else if ($curday == $day_trigger_2 && $timecurrent >= $trigger_on && $timecurrent <= $trigger_off){
			$NpbDetail	= new NpbDetailsController;
			$NpbDetail->recap_mrs(2);
		}
		*/
		
		if($timecurrent >= $journal_cut_off && $timecurrent <= '23:59:59'){		
			$FamsysInterfaces = new FamsysInterfacesController;
			$FamsysInterfaces->auto_post();
		}
		
		if ($timecurrent > $auto_logout_on && $timecurrent < $auto_logout_off){
			$name 		= $this->Session->read('Userinfo.username');
			$process 	= 'LOGOUT';
			$status 	= 'SUCCESS';
			$created	= date('Y-m-d H:i:s');
			$remark		= '';
			if ($name == NULL){
				$name = 'AUTO LOGOUT';
				$remark = 'AUTO LOGOUT BY SYSTEM';
			}
			$ActivityDataArray = array($name,$process,$status,$created,$remark);
			$Activity 	= new ActivityLogsController;			
			$Activity->add($ActivityDataArray);
		}
		$this->Bauth->logoutPage = '/users/login';  //Sets the page where the user will be redirected when logging out
		$this->Bauth->logout();
	}
	
	function index() 
	{
		Configure::write('debug', 0); // Otherwise we cannot use this method while developing
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
				
		$last_password_change = $this->Session->read('User.last_password_change');
		
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

			//if(strlen($this->data['User']['password']) >= 6 && $this->data['User']['password'] == $this->data['User']['password2'] && $this->check_password($this->data['User']['password']))
			if($this->data['User']['password'] == $this->data['User']['password2'])
			{
				$this->Session->setFlash(__('Enter the correct user password. Please, try again.', true));

				$this->User->create();
				$this->data['User']['cost_center_id'] = null;
				$this->data['User']['password'] = md5($this->data['User']['password']) ;			
				$this->data['User']['last_password_change'] = date('Y-m-d H:i:s') ;			
				if ($this->User->save($this->data)) {
					$name 		= $this->Session->read('Userinfo.username');
					$process 	= 'ADD USER';
					$status 	= 'SUCCESS';
					$created	= date('Y-m-d H:i:s');
					$remark		= $this->Session->read('Userinfo.username') . ' ADDED ' .$this->data['User']['username'];
					$ActivityDataArray = array($name,$process,$status,$created,$remark);
					$Activity 	= new ActivityLogsController;			
					$Activity->add($ActivityDataArray);
					
					$this->User->PasswordHistory->create();
						$data['PasswordHistory']['date'] = date('Y-m-d H:i:s');
						$data['PasswordHistory']['user_id'] = $this->User->id;
						$data['PasswordHistory']['password'] = md5($this->data['User']['password']);
					$this->User->PasswordHistory->save($data);
					
					$this->Session->setFlash(__('The user has been saved', true), 'default', array('class'=>'ok'));
					$this->redirect(array('action' => 'index'));
				} else {
					$name 		= $this->Session->read('Userinfo.username');
					$process 	= 'ADD USER';
					$status 	= 'FAILED';
					$created	= date('Y-m-d H:i:s');
					$remark		= $this->Session->read('Userinfo.username') . ' ADD ' .$this->data['User']['username']. ' FAILED';
					$ActivityDataArray = array($name,$process,$status,$created,$remark);
					$Activity 	= new ActivityLogsController;			
					$Activity->add($ActivityDataArray);
					
					$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
				}
			}else {
				$this->Session->setFlash(__('The user can not be saved. Please, password and minimal password must be 6 digit. Put '.$is_symbol.' symbol, '.$is_numeric.' numeric and '.$is_upper_case.' upper case ', true));
			
			}
		}
		$groups 		= $this->User->Group->find('list');
		$departments 	= $this->User->Department->find('list');
		$costCenter 	= $this->User->CostCenter->find('list');
		$businessType 	= $this->User->BusinessType->find('list');
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
			$this->data['User']['cost_center_id'] = null;
			if ($this->User->save($this->data)) {
				$name 		= $this->Session->read('Userinfo.username');
				$process 	= 'EDIT USER';
				$status 	= 'SUCCESS';
				$created	= date('Y-m-d H:i:s');
				$remark		= $this->Session->read('Userinfo.username') . ' EDITED ' .$this->data['User']['username'];
				$ActivityDataArray = array($name,$process,$status,$created,$remark);
				$Activity 	= new ActivityLogsController;			
				$Activity->add($ActivityDataArray);
				
				$this->Session->setFlash(__('The user has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$name 		= $this->Session->read('Userinfo.username');
				$process 	= 'EDIT USER';
				$status 	= 'FAILED';
				$created	= date('Y-m-d H:i:s');
				$remark		= $this->Session->read('Userinfo.username') . ' EDIT ' .$this->data['User']['username']. ' FAILED';
				$ActivityDataArray = array($name,$process,$status,$created,$remark);
				$Activity 	= new ActivityLogsController;			
				$Activity->add($ActivityDataArray);
				
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
			if($this->data['User']['password'] == $this->data['User']['password2']// && strlen($this->data['User']['password']) >= '6'
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
						$name 		= $this->Session->read('Userinfo.username');
						$process 	= 'RESET PASSWORD';
						$status 	= 'SUCCESS';
						$created	= date('Y-m-d H:i:s');
						$remark		= $this->Session->read('Userinfo.username') . ' RESET PASSWORD FOR ' .$this->data['User']['username'];
						$ActivityDataArray = array($name,$process,$status,$created,$remark);
						$Activity 	= new ActivityLogsController;			
						$Activity->add($ActivityDataArray);
						
						$this->Session->setFlash(__('The user password has been changed', true), 'default', array('class'=>'ok'));
						$this->redirect(array('controller'=>'pages', 'action' => 'home'));
						}
					}else{
						$name 		= $this->Session->read('Userinfo.username');
						$process 	= 'RESET PASSWORD';
						$status 	= 'FAILED';
						$created	= date('Y-m-d H:i:s');
						$remark		= $this->Session->read('Userinfo.username') . ' RESET PASSWORD FOR ' .$this->data['User']['username']. ' FAILED';
						$ActivityDataArray = array($name,$process,$status,$created,$remark);
						$Activity 	= new ActivityLogsController;			
						$Activity->add($ActivityDataArray);
						
						$this->Session->setFlash(__('The user password could not be changed. Please, Make sure password not been used', true));
					}
			}else{
				$name 		= $this->Session->read('Userinfo.username');
				$process 	= 'RESET PASSWORD';
				$status 	= 'FAILED';
				$created	= date('Y-m-d H:i:s');
				$remark		= $this->Session->read('Userinfo.username') . ' RESET PASSWORD FOR ' .$this->data['User']['username']. ' FAILED';
				$ActivityDataArray = array($name,$process,$status,$created,$remark);
				$Activity 	= new ActivityLogsController;			
				$Activity->add($ActivityDataArray);
					
				$this->Session->setFlash(__('The user password could not be changed. Please, try again. Put '.$is_symbol.' symbol, '.$is_numeric.' numeric and '.$is_upper_case.' upper case Or Password Has been Used', true));
			}
		}
		
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
	}
	
	function change_active($id = null) {
		if(!$this->Session->read('Userinfo.id'))
		{
			$this->redirect('/users/login');
			exit;
		}	
		$user = $this->User->read(null, $id);
		if (!empty($user)) {
			if($user['User']['aktif']==0){
				$dt_ric['id'] = $id;
				$dt_ric['aktif'] = '1';
				$progress = 'ENABLING';
			}else{
				$dt_ric['id'] = $id;
				$dt_ric['aktif'] = '0';
				$progress = 'DISABLING';
			}	
			
			if ($this->User->save($dt_ric)){				
				$name 		= $this->Session->read('Userinfo.username');
				if ($progress == 'ENABLING'){
					$process 	= 'ENABLE USER';
				}else{
					$process 	= 'DISABLE USER';
				}				
				$status 	= 'SUCCESS';
				$created	= date('Y-m-d H:i:s');
				
				$remark		= $this->Session->read('Userinfo.username') . ' ' . $progress . ' ' .$user['User']['username'];
				$ActivityDataArray = array($name,$process,$status,$created,$remark);
				$Activity 	= new ActivityLogsController;			
				$Activity->add($ActivityDataArray);
				
				$this->Session->setFlash(__('The user active status has been changed', true), 'default', array('class'=>'ok'));
				$this->redirect(array('controller'=>'users', 'action' => 'index'));			
			}else{
				$name 		= $this->Session->read('Userinfo.username');
				$process 	= 'ACTIVE STATUS';
				$status 	= 'SUCCESS';
				$created	= date('Y-m-d H:i:s');
				
				$remark		= $this->Session->read('Userinfo.username') . ' ' . $progress . ' ' .$user['User']['username'] . ' FAILED';
				$ActivityDataArray = array($name,$process,$status,$created,$remark);
				$Activity 	= new ActivityLogsController;			
				$Activity->add($ActivityDataArray);
				
				$this->Session->setFlash(__('The user active status has been changed', true), 'default', array('class'=>'ok'));
				$this->redirect(array('controller'=>'users', 'action' => 'index'));			
			}
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
		$user = $this->User->read(null, $id);
		$username = $user['User']['username'];
		
		if ($this->User->delete($id)) {
			$name 		= $this->Session->read('Userinfo.username');
			$process 	= 'DELETE USER';
			$status 	= 'SUCCESS';
			$created	= date('Y-m-d H:i:s');
			$remark		= $this->Session->read('Userinfo.username') . ' DELETED ' .$username;
			$ActivityDataArray = array($name,$process,$status,$created,$remark);
			$Activity 	= new ActivityLogsController;			
			$Activity->add($ActivityDataArray);
					
			$this->Session->setFlash(__('User deleted', true), 'default', array('class'=>'ok'));
			$this->redirect(array('action'=>'index'));
		}
			$name 		= $this->Session->read('Userinfo.username');
			$process 	= 'DELETE USER';
			$status 	= 'FAILED';
			$created	= date('Y-m-d H:i:s');
			$remark		= $this->Session->read('Userinfo.username') . ' DELETED ' .$this->data['User']['username'];
			$ActivityDataArray = array($name,$process,$status,$created,$remark);
			$Activity 	= new ActivityLogsController;			
			$Activity->add($ActivityDataArray);
		$this->Session->setFlash(__('User was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	//reset password
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
				 && $this->data['User']['password'] == $this->data['User']['password2']
				 //&& strlen($this->data['User']['password']) >= 6
				 )
				{
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
					$data['PasswordHistory']['aktif'] = '1';					
					$this->User->PasswordHistory->save($data);

					$dt_ric['aktif'] = '1';
					$this->User->save($dt_ric);
					
						if ($this->User->save($this->data)) {
							$name 		= $this->Session->read('Userinfo.username');
							$process 	= 'CHANGE PASSWORD';
							$status 	= 'SUCCESS';
							$created	= date('Y-m-d H:i:s');
							$remark		= $this->Session->read('Userinfo.username') . ' CHANGE PASSWORD';
							$ActivityDataArray = array($name,$process,$status,$created,$remark);
							$Activity 	= new ActivityLogsController;			
							$Activity->add($ActivityDataArray);
					
							$this->Session->write('ric.custom.password_is_expired', null);

							$this->Session->setFlash(__('The user password has been changed', true), 'default', array('class'=>'ok'));
							//$this->Session->destroy();
							$this->redirect(array('controller'=>'pages', 'action' => 'home'));
						}else{
							$name 		= $this->Session->read('Userinfo.username');
							$process 	= 'CHANGE PASSWORD';
							$status 	= 'FAILED';
							$created	= date('Y-m-d H:i:s');
							$remark		= $this->Session->read('Userinfo.username') . ' CHANGE PASSWORD FAILED';
							$ActivityDataArray = array($name,$process,$status,$created,$remark);
							$Activity 	= new ActivityLogsController;			
							$Activity->add($ActivityDataArray);
					
							$this->Session->setFlash(__('The user password could not be changed. Please, try again.', true));
						} 
					}else{
						$name 		= $this->Session->read('Userinfo.username');
						$process 	= 'CHANGE PASSWORD';
						$status 	= 'FAILED';
						$created	= date('Y-m-d H:i:s');
						$remark		= $this->Session->read('Userinfo.username') . ' CHANGE PASSWORD FAILED, PASSWORD USED';
						$ActivityDataArray = array($name,$process,$status,$created,$remark);
						$Activity 	= new ActivityLogsController;			
						$Activity->add($ActivityDataArray);
						$this->Session->setFlash(__('Password has been used', true));
					}
				}else{
					$name 		= $this->Session->read('Userinfo.username');
					$process 	= 'CHANGE PASSWORD';
					$status 	= 'FAILED';
					$created	= date('Y-m-d H:i:s');
					$remark		= $this->Session->read('Userinfo.username') . ' CHANGE PASSWORD FAILED';
					$ActivityDataArray = array($name,$process,$status,$created,$remark);
					$Activity 	= new ActivityLogsController;			
					$Activity->add($ActivityDataArray);
					
					$this->Session->setFlash(__('The user password could not be changed. Please, try again. Put '.$is_symbol.' symbol, '.$is_numeric.' numeric and '.$is_upper_case.' upper case', true));
				}
			}else{
				$name 		= $this->Session->read('Userinfo.username');
				$process 	= 'CHANGE PASSWORD';
				$status 	= 'FAILED';
				$created	= date('Y-m-d H:i:s');
				$remark		= $this->Session->read('Userinfo.username') . ' CHANGE PASSWORD FAILED';
				$ActivityDataArray = array($name,$process,$status,$created,$remark);
				$Activity 	= new ActivityLogsController;			
				$Activity->add($ActivityDataArray);
					
				$this->Session->setFlash(__('The user password could not be changed. Please, old password not correct or try to check new password', true));
			}	
		}
		$moduleName = 'User > Profile';
		$this->set('title_for_layout',  $this->lastSegment($moduleName));
		$this->set(compact('moduleName'));
	}
	
	function reset_password($email = null) {
		
		$this->Session->write('Menu',null);
		//$this->Session->write('Menu.main.User.Change Password','/users/change_password');
		$this->Session->write('Menu.main.Main.Home','/#');
		$this->Session->write('Menu.main.Main.Login','/users/login');
		
		$is_symbol 		= $this->configs['is_symbol'];
		$is_numeric 	= $this->configs['is_numeric'];
		$is_upper_case 	= $this->configs['is_upper_case'];
		$limit_password = $this->configs['limit_password'];

		if (!empty($this->data)) {
			if($this->data['User']['password'] == $this->data['User']['password2']){
				$ldap 	= new ldap;
				$conn	= $ldap->auth($this->data['User']['ad_user'],$this->data['User']['Password']);
				if($conn){
					$this->data['User']['password'] = md5($this->data['User']['password']);
					$this->data['User']['last_password_change'] = date('Y-m-d H:i:s') ;
					
					$res 	= $this->User->query('select id from users where email = "'.$email.'" ');
					foreach($res as $r=>$d){
						$passwords = $this->User->PasswordHistory->find('all', array('conditions'=>array(
						'PasswordHistory.user_id' => $d[0]['id']), 'order'=>array('PasswordHistory.id'=>'DESC'),
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
							$data['PasswordHistory']['user_id'] = $d[0]['id'];
							$data['PasswordHistory']['password'] = md5($this->data['User']['password']);
							$data['PasswordHistory']['aktif'] = '1';					
							$this->User->PasswordHistory->save($data);

							$dt_ric['aktif'] = '1';
							$this->User->save($dt_ric);
						
							if ($this->User->save($this->data)) {
								$name 		= $this->Session->read('Userinfo.username');
								$process 	= 'CHANGE PASSWORD';
								$status 	= 'SUCCESS';
								$created	= date('Y-m-d H:i:s');
								$remark		= $this->Session->read('Userinfo.username') . ' CHANGE PASSWORD';
								$ActivityDataArray = array($name,$process,$status,$created,$remark);
								$Activity 	= new ActivityLogsController;			
								$Activity->add($ActivityDataArray);
						
								$this->Session->write('ric.custom.password_is_expired', null);

								$this->Session->setFlash(__('The user password has been changed', true), 'default', array('class'=>'ok'));
								//$this->Session->destroy();
								$this->redirect(array('controller'=>'pages', 'action' => 'home'));
							}else{
								$name 		= $this->Session->read('Userinfo.username');
								$process 	= 'CHANGE PASSWORD';
								$status 	= 'FAILED';
								$created	= date('Y-m-d H:i:s');
								$remark		= $this->Session->read('Userinfo.username') . ' CHANGE PASSWORD FAILED';
								$ActivityDataArray = array($name,$process,$status,$created,$remark);
								$Activity 	= new ActivityLogsController;			
								$Activity->add($ActivityDataArray);
						
								$this->Session->setFlash(__('The user password could not be changed. Please, try again.', true));
							} 
						}else{
							$name 		= $this->Session->read('Userinfo.username');
							$process 	= 'CHANGE PASSWORD';
							$status 	= 'FAILED';
							$created	= date('Y-m-d H:i:s');
							$remark		= $this->Session->read('Userinfo.username') . ' CHANGE PASSWORD FAILED, PASSWORD USED';
							$ActivityDataArray = array($name,$process,$status,$created,$remark);
							$Activity 	= new ActivityLogsController;			
							$Activity->add($ActivityDataArray);
							$this->Session->setFlash(__('Password has been used', true));
						}
					}
				}else{
					$this->Session->setFlash(__('Your Famsys\'s Password and Window\'s Password are not match', true));
				}
			}else{
				$name 		= $this->Session->read('Userinfo.username');
				$process 	= 'CHANGE PASSWORD';
				$status 	= 'FAILED';
				$created	= date('Y-m-d H:i:s');
				$remark		= $this->Session->read('Userinfo.username') . ' CHANGE PASSWORD FAILED';
				$ActivityDataArray = array($name,$process,$status,$created,$remark);
				$Activity 	= new ActivityLogsController;			
				$Activity->add($ActivityDataArray);
					
				$this->Session->setFlash(__('The user password could not be changed. Check your confirm password', true));
			}	
		}
		$moduleName = 'User > Profile';
		$this->set('title_for_layout',  $this->lastSegment($moduleName));
		$this->set(compact('moduleName', 'email'));
	}
	
	function check_password($data)
	{
		/*if(!empty($data))
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
		if($check_simbol && $check_upper_case && $check_numeric/*  && $check_space )*/
		/*	return true;
		else
			return false;*/
		return true;
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
	
	function choose_group(){
		//echo '<pre>';
		//var_dump($this->Session->read());
		//echo '</pre>';die();
		if(!$this->Session->read('Userinfo.id'))
		{
			$this->redirect('/users/login');
			exit;
		}
		if(!empty($this->data)){
			if($this->Session->read('ldap_info.email')){
				$email			= $this->Session->read('ldap_info.email');
				$name			= $this->Session->read('ldap_info.name');
				$this->Session->write('Userinfo.email', $email);
				$this->Session->write('Userinfo.name', $name);
			}else{
				$email			= $this->Session->read('Userinfo.email');
			}			
			$group_id		= $this->data['User']['group_id'];
			$department_id	= $this->data['User']['department_id'];			
			// set the group name
			$res			= $this->User->query("select name from groups where id = '".$group_id."' ");
			$group_name		= $res[0][0]['name'];
			
			// set the user identity
			$res			= $this->User->query("select * from users where email = '".$email."' and group_id = '".$group_id."' ");
			if($res[0][0]['aktif'] != 1){
				unset($this->data);
				$this->Session->setFlash(__("Your role for the group '".$group_name."' has been deactivated. Please, choose another role", true));
				$this->redirect('/users/choose_group/');
			}else{
				$username			= $res[0][0]['username'];
				$cost_center_id		= $res[0][0]['cost_center_id'];
				$business_type_id 	= $res[0][0]['business_type_id'];
				$this->Session->write('Userinfo.username',			$res[0][0]['username']);
				$this->Session->write('Userinfo.cost_center_id',	$res[0][0]['cost_center_id']);
				$this->Session->write('Userinfo.business_type_id',	$res[0][0]['business_type_id']);
				$this->Session->write('Userinfo.aktif',				$res[0][0]['aktif']);			
				$this->Session->write('Userinfo.group_name',		$group_name);
				//set the cost center name
				$res			= $this->User->query("select name from cost_centers where id = '".$cost_center_id."' ");
				$this->Session->write('Userinfo.cost_center_name',	$res[0][0]['name']);
				//set the business type name
				$res			= $this->User->query("select name from business_types where id = '".$business_type_id."' ");
				$this->Session->write('Userinfo.business_type_name',$res[0][0]['name']);
				// set the department name
				$res			= $this->User->query("select id, name from departments where id = '".$department_id."' ");
				$this->Session->write('Userinfo.department_id',		$res[0][0]['id']);
				$this->Session->write('Userinfo.department_name',	$res[0][0]['name']);				
				
				$this->Session->write('Userinfo.group_id',$group_id);
				$this->Session->write('Security.permissions',$group_id);
				$this->Session->write('Userinfo.department_id',$department_id);
				$this->redirect('/');
			}
		}
		//reset all of default menu loaded by the user
		$this->Session->write('Menu',null);
		//$this->Session->write('Menu.main.User.Change Password','/users/change_password');
		$this->Session->write('Menu.main.Main.Use Default','/');
				
		$email			= $this->Session->read('ldap_info.email');
		if(!$email){
			$email			= $this->Session->read('Userinfo.email');
		}
		
		$res			= $this->User->query("select group_id from users where email = '".$email."' ");
		$group_id		= array();
		foreach($res as $result){
			$group_id[]		= $result[0]['group_id'];
		}
		
		//echo '<pre>';
		//var_dump($this->Session->read());
		//echo '</pre>';die();
		
		$res			= $this->User->query("select department_id from users where email = '".$email."' ");
		$department_id		= array();
		foreach($res as $result){
			$department_id[]		= $result[0]['department_id'];
		}
		
		$groups 		= $this->User->Group->find('list', array('conditions'=>array('id'=>$group_id)));
		$departments 	= $this->User->Department->find('list', array('conditions'=>array('id'=>$department_id)));
		
		$this->set(compact('groups','departments'));		
	}
	
	
}
?>
