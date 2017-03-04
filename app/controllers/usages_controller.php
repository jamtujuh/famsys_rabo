<?php
class UsagesController extends AppController {

	var $name = 'Usages';
	var $helpers = array('Ajax', 'Javascript', 'Time');
	var $components = array('RequestHandler');

	function index($usage_status_id=null, $usage_department_id=null) {
		$layout=$this->data['Usage']['layout'];
		$this->Usage->recursive = 0;
		if($usage_status_id || ($usage_status_id=$this->data['Usage']['usage_status_id']) ) {
			$conditions[] = array('usage_status_id'=>$usage_status_id);
		}
		
		if($usage_department_id || ($usage_department_id=$this->data['Usage']['department_id']) ) {
			$conditions[] = array('department_id'=>$usage_department_id);
		}
		$this->paginate = array('order'=>'Usage.id');
		list($date_start,$date_end) = $this->set_date_filters('Usage');
		$conditions[] = array('date >=' => ($date_start['year'] . '-' . $date_start['month'] . '-' . $date_start['day']) , 
				'date <=' => ($date_end['year'] . '-' . $date_end['month'] . '-' . $date_end['day']) );
		if($layout=='pdf' || $layout=='xls'){
		$con = $this->Usage->find('all', array('conditions'=>$conditions));
		}else{
		$con = $this->paginate($conditions);
		}
		
		$this->set('usages', $con);
		
		$departments = $this->Usage->Department->find('list');
		$copyright_id  = $this->configs['copyright_id'];
		$usageStatuses = $this->Usage->UsageStatus->find('list');
		$this->set(compact('copyright_id', 'departments', 'usage_department_id', 'usageStatuses','usage_status_id','date_start', 'date_end'));
		
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
	
	function index_pdf() {
		$this->Usage->recursive = 0;
		
		if($usage_department_id || ($usage_department_id=$this->data['Usage']['department_id']) ) {
			$conditions[] = array('department_id'=>$usage_department_id);
		}
		
		list($date_start,$date_end) = $this->set_date_filters('Usage');
		$conditions[] = array('date >=' => ($date_start['year'] . '-' . $date_start['month'] . '-' . $date_start['day']) , 
				'date <=' => ($date_end['year'] . '-' . $date_end['month'] . '-' . $date_end['day']) );
		
		$this->set('usages', $this->paginate($conditions));
		
		$departments = $this->Usage->Department->find('list');
		$this->set(compact('departments', 'usage_department_id', 'date_start', 'date_end'));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid usage', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Usage->recursive = 3;
		$group_id=$this->Session->read('Security.permissions') ;
		
		$usage = $this->Usage->read(null, $id);
		$this->Session->write('Usage.id', $id);
		$this->Session->write('Usage.can_approve', false);		
		$this->Session->write('Usage.can_process', false);		
		$this->Session->write('Usage.can_generate_journal', false);		
		$this->Session->write('Usage.can_edit', false);		
		$this->Session->write('Usage.can_send_to_branch_head', false);		
		$this->Session->write('Usage.can_archive', false);		
		
		if ($group_id==normal_user_group_id && $usage['Usage']['department_id']==$this->Session->read('Userinfo.department_id') )
		{
			$this->Session->write('Usage.can_edit', $usage['Usage']['usage_status_id']==status_usage_draft_id?true:false);		
			$this->Session->write('Usage.can_archive', $usage['Usage']['usage_status_id']==status_usage_reject_id?true:false);		
			$this->Session->write('Usage.can_send_to_branch_head', $usage['Usage']['usage_status_id']==status_usage_draft_id?true:false);		
			$this->Session->write('Usage.can_process', $usage['Usage']['usage_status_id']==status_usage_approved_id?true:false);
			$this->Session->write('Usage.can_generate_journal', $usage['Usage']['usage_status_id']==status_usage_processed_id?true:false);		
		}
		else if($group_id==branch_head_group_id && $usage['Usage']['department_id']==$this->Session->read('Userinfo.department_id') )
		{
			$this->Session->write('Usage.can_approve', $usage['Usage']['usage_status_id']==status_usage_sent_to_branch_head_id?true:false);		
		}
		
		$this->set('usage', $usage);
		$assetCategories = $this->Usage->UsageDetail->Item->AssetCategory->find('list');
		$units = $this->Usage->UsageDetail->Item->Unit->find('list');
		$this->set(compact('assetCategories', 'units'));
	}
	
	function process($id, $reprint=false)
	{
		if (!$id) {
			$this->Session->setFlash(__('Invalid usage', true));
			$this->redirect(array('action' => 'index'));
		}
		$usage = $this->Usage->read(null, $id);
				
		//insert ke stock cabang, type usage
		foreach($usage['UsageDetail'] as $detail){
			$data['Stock']['date']		=$usage['Usage']['date'];
			$data['Stock']['item_id']	=$detail['item_id'];
			$data['Stock']['qty']		= -1 * $detail['qty'];
			$data['Stock']['in_out']	='usage';
			$data['Stock']['price']		=$detail['price'];
			$data['Stock']['amount']	=$detail['amount'];
			$data['Stock']['usage_id']	=$detail['usage_id'];
			$data['Stock']['department_id']=$usage['Usage']['department_id'];
			$this->Usage->Stock->create();
			$this->Usage->Stock->save($data);
		}
		
		$this->set('usage', $usage);
		$assetCategories = $this->Usage->UsageDetail->Item->AssetCategory->find('list');
		$units = $this->Usage->UsageDetail->Item->Unit->find('list');
//		$this->set(compact('usage','assetCategories', 'units'));		

		$this->Usage->set('is_process',1);
		$this->Usage->set('usage_status_id',status_usage_processed_id);
		if($this->Usage->save()) {
			$this->Session->setFlash(__('The usage has been processed', true), 'default', array('class'=>'ok'));
			$this->redirect(array('action' => 'view', $id));
		} else {
			$this->Session->setFlash(__('The usage could not be processed. Please, try again.', true));
			$this->redirect(array('action' => 'index'));
		}
		
	}
	
	function add($npb_id=null) {
		if (!empty($this->data)) {
			$this->Usage->create();
			
			if ($this->Usage->save($this->data)) {
			
				$this->Session->setFlash(__('The usage has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'view', $this->Usage->id));
			} else {
				$this->Session->setFlash(__('The usage could not be saved. Please, try again.', true));
			}
		}
		$newId = $this->Usage->getNewId($this->Session->read('Userinfo.department_id'));
		
		//created from NPB ?
		$departments = $this->Usage->Department->find('list');
		$this->set(compact('departments','newId'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid usage', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Usage->save($this->data)) {
				$this->Session->setFlash(__('The usage has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The usage could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Usage->read(null, $id);
		}
		$departments = $this->Usage->Department->find('list');
		$this->set(compact('departments'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for usage', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Usage->delete($id)) {
			$this->Session->setFlash(__('Usage deleted', true), 'default', array('class'=>'ok'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Usage was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function update_status($id=null, $new_status=null)
	{
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid usage', true));
			$this->redirect(array('action' => 'index'));
		}
		$usage=$this->Usage->read(null, $id);
		$this->Usage->set('usage_status_id', $new_status);
		if($new_status == status_usage_approved_id){
		$this->data['Usage']['approved_by']		= $this->Session->read('Userinfo.username');
		$this->data['Usage']['approved_date']	= date('Y-m-d H:i:s');
		}
		if ($this->Usage->save($this->data)) {
			$this->Session->setFlash(__('The usage status has been saved', true), 'default', array('class'=>'ok'));
			$this->redirect(array('action' => 'index'));
		} else {
			$this->Session->setFlash(__('The usage status could not be saved. Please, try again.', true));
		}

		$this->redirect(array('action' => 'index'));		
	}
	
	function cancel($id = null){
		$this->Usage->recursive = 3;

		//view Usage
		if (!$id) {
			$this->Session->setFlash(__('Invalid Usage', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Usage->read(null, $id);
		
		//Add Notes Reject Usage and Change Status
		if (!empty($this->data)) {
			$this->data['Usage']['id'] = $id;
			$this->data['Usage']['usage_status_id'] = status_usage_draft_id;
			if ($this->Usage->save($this->data)) {
				$this->Session->setFlash(__('The Usage has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Usage could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$usage = $this->data = $this->Usage->read(null, $id);
		}
		$assetCategories = $this->Usage->UsageDetail->Item->AssetCategory->find('list');
		$item = $this->Usage->UsageDetail->Item->find('list');
		$departments = $this->Usage->Department->find('list');
		$usageStatuses = $this->Usage->UsageStatus->find('list');
		$this->set(compact('usage', 'departments', 'usageStatuses', 'assetCategories', 'item'));
	}
	function reject($id = null){
		$this->Usage->recursive = 3;

		//view Usage
		if (!$id) {
			$this->Session->setFlash(__('Invalid Usage', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Usage->read(null, $id);
		
		//Add Notes Reject Usage and Change Status
		if (!empty($this->data)) {
			$this->data['Usage']['id'] = $id;
			$this->data['Usage']['usage_status_id'] = status_usage_reject_id;
			if ($this->Usage->save($this->data)) {
				$this->Session->setFlash(__('The Usage has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Usage could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$usage = $this->data = $this->Usage->read(null, $id);
		}
		$assetCategories = $this->Usage->UsageDetail->Item->AssetCategory->find('list');
		$item = $this->Usage->UsageDetail->Item->find('list');
		$departments = $this->Usage->Department->find('list');
		$usageStatuses = $this->Usage->UsageStatus->find('list');
		$this->set(compact('usage', 'departments', 'usageStatuses', 'assetCategories', 'item'));
	}
	
	function archive($id = null){
		//view Usage
		if (!$id) {
			$this->Session->setFlash(__('Invalid Usage', true));
			$this->redirect(array('action' => 'index'));
		}
		
		$this->data['Usage']['id'] = $id;
		$this->data['Usage']['usage_status_id'] = status_usage_archive_id;
		if ($this->Usage->save($this->data)) {
			$this->Session->setFlash(__('The Usage has been saved', true), 'default', array('class'=>'ok'));
			$this->redirect(array('action' => 'index'));
		} else {
			$this->Session->setFlash(__('The Usage could not be saved. Please, try again.', true));
		}
	}

}
?>