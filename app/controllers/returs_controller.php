<?php
class RetursController extends AppController {

	var $name = 'Returs';
	var $helpers = array('Ajax', 'Javascript', 'Time');
	var $components = array('RequestHandler');

	function index($retur_status_id=null, $retur_department_id=null) {
		$this->Retur->recursive = 0;
		$layout=$this->data['Retur']['layout'];
        $group_id = $this->Session->read('Security.permissions');
		$username = $this->Session->read('Userinfo.username');
		if ($group_id == normal_user_group_id) //normal users
			  $conditions = array('created_by' => $username);
			  
		if($retur_status_id || ($retur_status_id=$this->data['Retur']['retur_status_id']) ) {
			$conditions[] = array('retur_status_id'=>$retur_status_id);
		}
		if($retur_department_id || ($retur_department_id=$this->data['Retur']['department_id']) ) {
			$conditions[] = array('department_id'=>$retur_department_id);
		}		
		$conditions[] = array('retur_status_id !='=>status_retur_archive_id); //archive
		$this->paginate = array('order'=>'Retur.id');
		list($date_start,$date_end) = $this->set_date_filters('Retur');
		$conditions[] = array('date >=' => ($date_start['year'] . '-' . $date_start['month'] . '-' . $date_start['day']) , 
				'date <=' => ($date_end['year'] . '-' . $date_end['month'] . '-' . $date_end['day']) );
		if($layout=='pdf' || $layout=='xls'){
		$con = $this->Retur->find('all', array('conditions'=>$conditions));
		}else{
		$con = $this->paginate($conditions);
		}
		$this->set('returs', $con);
		
		$departments = $this->Retur->Department->find('list');
		$copyright_id  = $this->configs['copyright_id'];
		$returStatuses = $this->Retur->ReturStatus->find('list', array('conditions' =>array('id !=' => status_retur_archive_id))); //archive
		$this->set(compact('departments','retur_department_id','returStatuses', 'retur_status_id', 'date_start', 'date_end', 'copyright_id'));
		
		if($layout=='pdf')
		{
			Configure::write('debug',0); // Otherwise we cannot use this method while developing 
			$this->layout = 'pdf'; //this will use the pdf.ctp layout 
			$this->render('index_pdf'); 		
		}
		else if($layout=='xls')
		{
		$this->render('index_xls','export_xls');		

		}
	}
	
	function index_pdf() {
		$this->Retur->recursive = 0;
		
		if($retur_department_id || ($retur_department_id=$this->data['Retur']['department_id']) ) {
			$conditions[] = array('department_id'=>$retur_department_id);
		}
		
		list($date_start,$date_end) = $this->set_date_filters('Retur');
		$conditions[] = array('date >=' => ($date_start['year'] . '-' . $date_start['month'] . '-' . $date_start['day']) , 
				'date <=' => ($date_end['year'] . '-' . $date_end['month'] . '-' . $date_end['day']) );
		
		$this->set('returs', $this->paginate($conditions));
		
		$departments = $this->Retur->Department->find('list');
		$this->set(compact('departments', 'retur_department_id', 'date_start', 'date_end'));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid retur', true));
			$this->redirect(array('action' => 'index'));
		}
		//$this->Retur->recursive = 3;
		$this->Retur->recursive = 1;
		$group_id=$this->Session->read('Security.permissions') ;
 
		$retur = $this->Retur->read(null, $id);
		$this->Session->write('Retur.id', $id);
		$this->Session->write('Retur.can_process', false);		
		$this->Session->write('Retur.can_edit', false);		
		$this->Session->write('Retur.can_send_to_branch_head', false);		
		$this->Session->write('Retur.can_send_to_stock_management', false);		
		$this->Session->write('Retur.can_generate_journal', false);
		
		
		if($group_id==stock_management_group_id)
		{
			$this->Session->write('Retur.can_process', $retur['Retur']['retur_status_id']==status_retur_approved_by_branch_head_id?true:false);
		}
		else if ($group_id==normal_user_group_id && $retur['Retur']['department_id']==$this->Session->read('Userinfo.department_id') )
		{
			$this->Session->write('Retur.can_edit', 				$retur['Retur']['retur_status_id']==status_retur_draft_id?true:false);		
			$this->Session->write('Retur.can_send_to_branch_head', 	$retur['Retur']['retur_status_id']==status_retur_draft_id?true:false);		
		}
		else if($group_id==branch_head_group_id && $retur['Retur']['department_id']==$this->Session->read('Userinfo.department_id') )
		{
			$this->Session->write('Retur.can_send_to_stock_management', $retur['Retur']['retur_status_id']==status_retur_sent_to_branch_head_id?true:false);
		}
		else if($group_id==fincon_group_id)
		{
			$this->Session->write('Retur.can_generate_journal', $retur['Retur']['retur_status_id']==status_retur_processed_id?true:false);
		}
		
		$this->set('retur', $retur);
		$assetCategories = $this->Retur->ReturDetail->Item->AssetCategory->find('list');
		$units = $this->Retur->ReturDetail->Item->Unit->find('list');
		$this->set(compact('assetCategories', 'units'));
	}
	
	
	function add($npb_id=null) {
		if (!empty($this->data)) {
			$this->Retur->create();
			
			if ($this->Retur->save($this->data)) {
				$this->Session->setFlash(__('The retur has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'view', $this->Retur->id));
			} else {
				$this->Session->setFlash(__('The retur could not be saved. Please, try again.', true));
			}
		}
		$department_id=$this->Session->read('Userinfo.department_id');
		$business_type_id=$this->Session->read('Userinfo.business_type_id');
		$cost_center_id=$this->Session->read('Userinfo.cost_center_id');
		$newId = $this->Retur->getNewId($department_id);
		
		$departments = $this->Retur->Department->find('list');
		$businessTypes = $this->Retur->BusinessType->find('list');
		//$costCenters = $this->Retur->CostCenter->find('list', array('fields'=>'name'));
		$cc 			= $this->Retur->query('select a.id,a.name,b.t24_dao from cost_centers a left join cost_center_to_daos b on b.cost_center_id = a.id where a.remarks = "Y" order by a.name');
		foreach($cc as $data){
			if($data[0]['t24_dao']){
				$costCenters[ $data[0]['id'] ]	= $data[0]['name'] . " - " .$data[0]['t24_dao'];
			}else{
				$costCenters[ $data[0]['id'] ]	= $data[0]['name'];
			}				
		}
		$this->set(compact('newId', 'departments','department_id', 'business_type_id', 'cost_center_id', 'businessTypes', 'costCenters'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid retur', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Retur->save($this->data)) {
				$this->Session->setFlash(__('The retur has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The retur could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Retur->read(null, $id);
		}
		$departments = $this->Retur->Department->find('list');
		$this->set(compact('departments'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for retur', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Retur->delete($id)) {
			$this->Session->setFlash(__('Retur deleted', true), 'default', array('class'=>'ok'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Retur was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

	function update_status($id=null, $new_status=null)
	{
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid retur', true));
			$this->redirect(array('action' => 'index'));
		}
		$retur=$this->Retur->read(null, $id);
		$this->Retur->set('retur_status_id', $new_status);
		if ($new_status == status_retur_approved_by_branch_head_id) {
			$this->data['Retur']['approved_date'] = date('Y-m-d H:i:s');
			$this->data['Retur']['approved_by'] = $this->Session->read('Userinfo.username');
		}
		if ($new_status == status_retur_reject_id) {
			$this->data['Retur']['reject_date'] = date('Y-m-d H:i:s');
			$this->data['Retur']['reject_by'] = $this->Session->read('Userinfo.username');
		}
		if ($new_status == status_retur_draft_id) {
			$this->data['Retur']['cancel_date'] = date('Y-m-d H:i:s');
			$this->data['Retur']['cancel_by'] = $this->Session->read('Userinfo.username');
		}

		if($this->configs['journal_cut_off'] > date('H:i:s'))
		{
			if(!empty($retur['ReturDetail'])){
				if ($this->Retur->save($this->data)) {
					$this->Session->setFlash(__('The retur status has been saved', true), 'default', array('class'=>'ok'));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The retur status could not be saved. Please, try again.', true));
				}
			} else {
				$this->Session->setFlash(__('The retur status could not be saved. Please, fill Retur Detail.', true));
				$this->redirect(array('action' => 'view', $id));
			}
		}
		else
		{
			$this->Session->setFlash(__('Retur can not be processed because it exceeded the time of '.$this->configs['journal_cut_off'], true));
			$this->redirect(array('controller' => 'returs', 'action' => 'view', $id));
		}

		
	}
	function auto_complete ()
	{
		$this->set('returs',
			$this->Retur->find('all',
				array('conditions'=>" Retur.retur_status_id = 7
					AND Retur.no LIKE '{$this->data['Retur']['no']}%'
					
				"))
			);
		$this->layout = "ajax";
	}
	function auto_complete_supplier ()
	{
		$this->set('returs',
			$this->Retur->find('all',
				array('conditions'=>" Retur.can_retur = 0 AND Retur.retur_status_id = 7
					AND Retur.no LIKE '{$this->data['Retur']['name']}%'
					
				"))
			);
		$this->layout = "ajax";
	}

}
?>