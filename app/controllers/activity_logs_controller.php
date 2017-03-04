<?php
class ActivityLogsController extends AppController {

	var $name 	= 'ActivityLogs';
	var $uses	= array('ActivityLog');
	var $helpers = array('Form','Html');
	
	function index() {
		$this->Session->write('User.can_edit', $this->Session->read('Security.permissions')==monitoring_group_id);
		$layout=$this->data['ActivityLog']['layout'];
		if(!empty($this->data))
		{
			if ($this->data['ActivityLog']['date_start'] == $this->data['ActivityLog']['date_end']){
				$this->data['ActivityLog']['date_start']['day'] = $this->data['ActivityLog']['date_start']['day'] - 1;
			}
			$this->Session->write('ActivityLog.username', 	$this->data['ActivityLog']['username']);
			$this->Session->write('ActivityLog.process', 	$this->data['ActivityLog']['process']);
			$this->Session->write('ActivityLog.date_start', $this->data['ActivityLog']['date_start']);
			$this->Session->write('ActivityLog.date_end', 	$this->data['ActivityLog']['date_end']);
		}
		
		$this->ActivityLog->recursive = 0;
		$conditions[] = array();
		
		if($username=$this->Session->read('ActivityLog.username')){
			$conditions[]=array('ActivityLog.username'=>$username);			
		}
		
		if($process=$this->Session->read('ActivityLog.process')){
			$conditions[]=array('ActivityLog.process'=>$process);
		}
		
		$date_start = $this->Session->read('ActivityLog.date_start');
		if($date_start == null){
			$date_start = date('Y-m-d', strtotime('-1 day'));
		}
		$date_end 	= $this->Session->read('ActivityLog.date_end');
		
		if ($date_start['day'] == $date_end['day']){
			$date_start['day'] = $date_start['day'] - 1;
		}
		$conditions[] = array('ActivityLog.created >=' => ($date_start['year'] . '-' . $date_start['month'] . '-' . $date_start['day'] . ' 00:00:00') , 
			'ActivityLog.created <=' => ($date_end['year'] . '-' . $date_end['month'] . '-' . $date_end['day'] . ' 23:59:00'));
				
		$conditions[]=array('ActivityLog.username not '=>null);
		
		$this->paginate = array('order'=>'ActivityLog.created DESC');
		
		if($layout == 'pdf' || $layout == 'xls'){
			$con = $this->ActivityLog->find('all', array('conditions'=>$conditions, 'order'=>'created DESC'));			
			
		}else{
			$con = $this->paginate($conditions);
		}
		
		$this->set('activitylogs', $con);		
		$this->set(compact('username', 'process', 'date_start', 'date_end'));
		
		$copyright_id = $this->configs['copyright_id'];
		$this->set(compact('copyright_id'));
		if ($layout == 'pdf') {
			  Configure::write('debug', 0); // Otherwise we cannot use this method while developing 
			  $this->layout = 'pdf'; //this will use the pdf.ctp layout 
			  $this->render('index_pdf');
		} else if ($layout == 'xls') {
			  $this->render('index_xls', 'export_xls');
		}		
	}
	
	function view($id = null) {
		if(!$this->Session->read('Userinfo.id'))
		{
			$this->redirect('/users/login');
			exit;
		}
		if (!$id) {
			$this->Session->setFlash(__('Invalid id', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('activitylog', $this->ActivityLog->read(null, $id));
	}
	
	function edit($user = null) {
		if (!$user) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		$conditions[]	= array('ActivityLog.username'=>$user);
		$conditions[]	= array('ActivityLog.process'=>'LOGIN');
		$conditions[]	= array('ActivityLog.status'=>'FAILED');
		$this->loadModel('ActivityLog');
		$con = $this->ActivityLog->find('all', array('conditions'=>$conditions, 'order'=>'created DESC'));			
		
		$act_id		= $con[0]['ActivityLog']['id'];
		$username	= $con[0]['ActivityLog']['username'];
		$remark		= $con[0]['ActivityLog']['remark'];
		$process	= $con[0]['ActivityLog']['process'];
		$status		= $con[0]['ActivityLog']['status'];
		
		$dt_ric['id'] = $act_id;
		$dt_ric['process'] 	= 'DISABLE USER';
		$dt_ric['status'] 	= 'SUCCESS';
		$dt_ric['remark'] 	= 'WRONG PASSWORD 3X. USER '. $username .' HAS BEEN DISABLED BY SYSTEM';
		
		$this->ActivityLog->save($dt_ric);
	}
	
	function delete($id = null) {
		if(!$this->Session->read('Userinfo.id'))
		{
			$this->redirect('/users/login');
			exit;
		}		
		if (!$id) {
			$this->Session->setFlash(__('Invalid id', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ActivityLog->delete($id)) {
			$this->Session->setFlash(__('IT Log deleted', true), 'default', array('class'=>'ok'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('IT Log was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function add(array $dataArray = null) {
		$this->data['ActivityLog']['username'] 	= $dataArray[0];			
		$this->data['ActivityLog']['process'] 	= $dataArray[1];		
		$this->data['ActivityLog']['status'] 	= $dataArray[2];		
		$this->data['ActivityLog']['created'] 	= $dataArray[3];
		$this->data['ActivityLog']['remark'] 	= $dataArray[4];		
		
		$this->loadModel('ActivityLog');
		$this->ActivityLog->save($this->data);
	}
}
?>
