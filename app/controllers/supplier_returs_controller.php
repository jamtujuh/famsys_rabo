<?php
class SupplierRetursController extends AppController {

	var $name = 'SupplierReturs';
	var $helpers = array('Ajax', 'Javascript', 'Time');
	var $components = array('RequestHandler');

	function index($supplier_retur_status_id=null, $supplier_retur_department_id=null) {
		$this->SupplierRetur->recursive = 0;
		$layout=$this->data['SupplierRetur']['layout'];
		if($supplier_retur_status_id || ($supplier_retur_status_id=$this->data['SupplierRetur']['supplier_retur_status_id']) ) {
			$conditions[] = array('supplier_retur_status_id'=>$supplier_retur_status_id);
		}		
		if($supplier_retur_department_id || ($supplier_retur_department_id=$this->data['SupplierRetur']['department_id']) ) {
			$conditions[] = array('department_id'=>$supplier_retur_department_id);
		}
		
		list($date_start,$date_end) = $this->set_date_filters('SupplierRetur');
		$conditions[] = array('SupplierRetur.date >=' => ($date_start['year'] . '-' . $date_start['month'] . '-' . $date_start['day']) , 
				'SupplierRetur.date <=' => ($date_end['year'] . '-' . $date_end['month'] . '-' . $date_end['day']) );
		$conditions[] = array('supplier_retur_status_id !='=>status_supplier_retur_archive_id); //archive
		
		$this->paginate = array('order'=>'SupplierRetur.id');
		if($layout=='pdf' || $layout=='xls'){
		$con = $this->SupplierRetur->find('all', array('conditions'=>$conditions));
		}else{
		$con = $this->paginate($conditions);
		}
		$this->set('supplier_returs', $con);
		
		$departments = $this->SupplierRetur->Department->find('list');
		$copyright_id  = $this->configs['copyright_id'];
		$supplierReturStatuses = $this->SupplierRetur->SupplierReturStatus->find('list', array('conditions' =>array('id !=' => status_supplier_retur_archive_id))); //archive
		$this->set(compact('departments', 'supplier_retur_department_id', 'supplierReturStatuses', 
							'supplier_retur_status_id','date_start', 'date_end', 'copyright_id'));
		
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
		$this->SupplierRetur->recursive = 0;
		
		if($supplier_retur_department_id || ($supplier_retur_department_id=$this->data['SupplierRetur']['department_id']) ) {
			$conditions[] = array('department_id'=>$supplier_retur_department_id);
		}
		
		list($date_start,$date_end) = $this->set_date_filters('SupplierRetur');
		$conditions[] = array('date >=' => ($date_start['year'] . '-' . $date_start['month'] . '-' . $date_start['day']) , 
				'date <=' => ($date_end['year'] . '-' . $date_end['month'] . '-' . $date_end['day']) );
		
		$this->set('supplier_returs', $this->paginate($conditions));
		
		$departments = $this->SupplierRetur->Department->find('list');
		$this->set(compact('departments', 'supplier_retur_department_id', 'date_start', 'date_end'));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid supplier_retur', true));
			$this->redirect(array('action' => 'index'));
		}
		//$this->SupplierRetur->recursive = 3;
		$this->SupplierRetur->recursive = 1;
		
		$supplier_retur = $this->SupplierRetur->read(null, $id);
		$retur = $supplier_retur['SupplierRetur']['retur_id'];
		$this->Session->write('SupplierRetur.id', $id);		
		$this->Session->write('SupplierRetur.can_approve',  false);
		$this->Session->write('SupplierRetur.can_process',  false);
		$this->Session->write('SupplierRetur.can_journal',  false);
		$this->Session->write('SupplierRetur.can_request_approval', false);
		$this->Session->write('SupplierRetur.can_print_retur_notes', false);
		$this->Session->write('SupplierRetur.can_reprint_retur_notes', false);
		$this->Session->write('SupplierRetur.can_edit', false);
		
		if($this->Session->read('Security.permissions')==stock_management_group_id){
			$this->Session->write('SupplierRetur.can_request_approval', $supplier_retur['SupplierRetur']['supplier_retur_status_id']==status_supplier_retur_draft_id? true : false);
			$this->Session->write('SupplierRetur.can_process', $supplier_retur['SupplierRetur']['supplier_retur_status_id']==status_supplier_retur_approved_id?true:false);
			$this->Session->write('SupplierRetur.can_print_retur_notes',   ($supplier_retur['SupplierRetur']['supplier_retur_status_id']==status_supplier_retur_approved_id||$supplier_retur['SupplierRetur']['supplier_retur_status_id']==status_supplier_retur_processed_id) &&$supplier_retur['SupplierRetur']['is_printed']==0?true:false);
			$this->Session->write('SupplierRetur.can_reprint_retur_notes', $supplier_retur['SupplierRetur']['is_printed']==1?true:false);
			$this->Session->write('SupplierRetur.can_edit', $supplier_retur['SupplierRetur']['supplier_retur_status_id']==status_supplier_retur_draft_id&&$supplier_retur['SupplierRetur']['created_by']==$this->Session->read('Userinfo.username')?true:false);
		}
		else if($this->Session->read('Security.permissions')==stock_supervisor_group_id){
			$this->Session->write('SupplierRetur.can_approve', $supplier_retur['SupplierRetur']['supplier_retur_status_id']==status_supplier_retur_sent_to_supervisor_id? true : false);
			$this->Session->write('SupplierRetur.can_cancel', $supplier_retur['SupplierRetur']['supplier_retur_status_id']==status_supplier_retur_sent_to_supervisor_id? true : false);
			$this->Session->write('SupplierRetur.can_reject', $supplier_retur['SupplierRetur']['supplier_retur_status_id']==status_supplier_retur_sent_to_supervisor_id? true : false);
		}
		else if($this->Session->read('Security.permissions')==fincon_group_id){
			$this->Session->write('SupplierRetur.can_journal', $supplier_retur['SupplierRetur']['supplier_retur_status_id']==status_supplier_retur_processed_id?true : false);
		}
		
		$this->set('supplier_retur', $supplier_retur);
		$assetCategories = $this->SupplierRetur->SupplierReturDetail->Item->AssetCategory->find('list');
		$units = $this->SupplierRetur->SupplierReturDetail->Item->Unit->find('list');
		$this->set(compact('assetCategories', 'units', 'retur'));
	}
	
	
	function add($npb_id=null) {
		if (!empty($this->data)) {
			$retur = $this->SupplierRetur->Retur->read(null, $this->data['SupplierRetur']['retur_id']);
			$this->SupplierRetur->create();			
			if ($this->SupplierRetur->save($this->data)) {
				if(!empty($retur)){
				foreach($retur['ReturDetail'] as $detil){
					  $data['SupplierReturDetail']['supplier_retur_id'] = $this->SupplierRetur->id;
					  $data['SupplierReturDetail']['retur_id'] = $retur['Retur']['id'];
					  $data['SupplierReturDetail']['qty'] = $detil['qty'];
					  $data['SupplierReturDetail']['item_id'] = $detil['item_id'];
					  $data['SupplierReturDetail']['posting'] = 0;
					  $data['SupplierReturDetail']['price'] = $detil['price'];
					  $data['SupplierReturDetail']['amount'] = $detil['amount'];
					  $data['SupplierReturDetail']['descr']  = $detil['descr'];
					  $this->SupplierRetur->SupplierReturDetail->create();
					  $this->SupplierRetur->SupplierReturDetail->save($data);
				}
				}
				$this->Session->setFlash(__('The Supplier Retur has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'view', $this->SupplierRetur->id));
			} else {
				$this->Session->setFlash(__('The supplier_retur could not be saved. Please, try again.', true));
			}
		}
		$department_id=$this->Session->read('Userinfo.department_id');
		$business_type_id=$this->Session->read('Userinfo.business_type_id');
		$cost_center_id=$this->Session->read('Userinfo.cost_center_id');
		$newId = $this->SupplierRetur->getNewId($department_id);
		
		$departments = $this->SupplierRetur->Department->find('list');
		$businessTypes = $this->SupplierRetur->BusinessType->find('list');
		$costCenters = $this->SupplierRetur->CostCenter->find('list');
		//$cc 			= $this->SupplierRetur->query('select a.id,a.name,b.t24_dao from cost_centers a left join cost_center_to_daos b on b.cost_center_id = a.id where a.remarks = "Y" order by a.name');
		//foreach($cc as $data){
		//	if($data[0]['t24_dao']){
		//		$costCenters[ $data[0]['id'] ]	= $data[0]['name'] . " - " .$data[0]['t24_dao'];
		//	}else{
		//		$costCenters[ $data[0]['id'] ]	= $data[0]['name'];
		//	}				
		//}
		$suppliers = $this->SupplierRetur->Supplier->find('list');
		$this->set(compact('newId', 'departments','department_id', 'suppliers', 'businessTypes', 'business_type_id', 'cost_center_id', 'costCenters'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid supplier_retur', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->SupplierRetur->save($this->data)) {
				$this->Session->setFlash(__('The Supplier Retur has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The supplier_retur could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->SupplierRetur->read(null, $id);
		}
		$departments = $this->SupplierRetur->Department->find('list');
		$this->set(compact('departments'));
	}
	
	function supplier_retur_notes($id, $reprint=false)
	{
		if (!$id) {
			$this->Session->setFlash(__('Invalid supplier Retur', true));
			$this->redirect(array('action' => 'index'));
		}
		$supplierRetur = $this->SupplierRetur->read(null, $id);

		$this->set('supplierRetur', $supplierRetur);
		$assetCategories = $this->SupplierRetur->SupplierReturDetail->Item->AssetCategory->find('list');
		$units = $this->SupplierRetur->SupplierReturDetail->Item->Unit->find('list');
		$this->set(compact('supplierRetur','assetCategories', 'units'));
		
		$this->SupplierRetur->set('is_printed',1);
		$this->SupplierRetur->save();
		
		Configure::write('debug',1); 
		$this->layout = 'pdf'; //this will use the pdf.ctp layout 
		$this->render('supplier_retur_notes_pdf'); 		

	}
	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for supplier_retur', true));
			$this->redirect(array('action'=>'index'));
		}
		$supplierRetur = $this->SupplierRetur->read(null, $id);
		if ($this->SupplierRetur->delete($id)) {
			if($supplierRetur['SupplierRetur']['retur_id'] != null || $supplierRetur['SupplierRetur']['retur_id'] != 0){
				$this->SupplierRetur->Retur->id = $supplierRetur['SupplierRetur']['retur_id'];
				$this->SupplierRetur->Retur->set('can_retur',0);
				$this->SupplierRetur->Retur->save();	
			}
			$this->Session->setFlash(__('SupplierRetur deleted', true), 'default', array('class'=>'ok'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('SupplierRetur was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function update_status($id=null, $new_status=null)
	{
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid supplierRetur', true));
			$this->redirect(array('action' => 'index'));
		}
		
		$supplierRetur=$this->SupplierRetur->read(null, $id);
		$this->data['SupplierRetur']['supplier_retur_status_id'] = $new_status;
		if ($new_status == status_retur_approved_by_branch_head_id) {
			$this->data['SupplierRetur']['approved_date'] = date('Y-m-d H:i:s');
			$this->data['SupplierRetur']['approved_by'] = $this->Session->read('Userinfo.username');
		}
		if ($new_status == status_retur_reject_id) {
			$this->data['SupplierRetur']['reject_date'] = date('Y-m-d H:i:s');
			$this->data['SupplierRetur']['reject_by'] = $this->Session->read('Userinfo.username');
		}
		if ($new_status == status_retur_draft_id) {
			$this->data['SupplierRetur']['cancel_date'] = date('Y-m-d H:i:s');
			$this->data['SupplierRetur']['cancel_by'] = $this->Session->read('Userinfo.username');
		}

		if($this->configs['journal_cut_off'] > date('H:i:s'))
		{

			if(!empty($supplierRetur['SupplierReturDetail'])){
				if($this->SupplierRetur->save($this->data)){
					$this->Session->setFlash(__('The supplierRetur status has been saved', true), 'default', array('class'=>'ok'));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The supplierRetur status could not be saved. Please, try again.', true));
				}
			} else {
				$this->Session->setFlash(__('The supplierRetur status could not be saved. Please, fill Supplier retur Detail.', true));
				$this->redirect(array('action' => 'view', $id));
			}
		}
		else
		{
			$this->Session->setFlash(__('supplierretur Replace can not be processed because it exceeded the time of '.$this->configs['journal_cut_off'], true));
			$this->redirect(array('controller' => 'supplier_returs', 'action' => 'view', $id));
		}


	}	
	function auto_complete ()
	{
		$this->set('supplierReturs',
			$this->SupplierRetur->find('all',
				array('conditions'=>" SupplierRetur.supplier_retur_status_id = 7
					AND SupplierRetur.no LIKE '{$this->data['SupplierRetur']['no']}%'
					
				"))
			);
		$this->layout = "ajax";
	}

}
?>