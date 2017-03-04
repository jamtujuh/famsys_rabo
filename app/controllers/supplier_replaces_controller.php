<?php
class SupplierReplacesController extends AppController {

	var $name = 'SupplierReplaces';
	var $helpers = array('Ajax', 'Javascript', 'Time');
	var $components = array('RequestHandler');

	function index($supplier_replace_status_id=null, $supplier_replace_department_id=null) {
		$this->SupplierReplace->recursive = 0;
		$layout=$this->data['SupplierReplace']['layout'];
		$group = $this->Session->read('Security.permissions');
		if($group == stock_supervisor_group_id)
			$conditions[] = array('supplier_replace_status_id'=>status_supplier_retur_sent_to_supervisor_id);
			
		if($supplier_replace_status_id || ($supplier_replace_status_id=$this->data['SupplierReplace']['supplier_replace_status_id']) ) {
			$conditions[] = array('supplier_replace_status_id'=>$supplier_replace_status_id);
		}		
		if($supplier_replace_department_id || ($supplier_replace_department_id=$this->data['SupplierReplace']['department_id']) ) {
			$conditions[] = array('department_id'=>$supplier_replace_department_id);
		}
		$conditions[] = array('supplier_replace_status_id !='=>status_supplier_replace_archive_id); //archive
		
		list($date_start,$date_end) = $this->set_date_filters('SupplierReplace');
		$conditions[] = array('SupplierReplace.date >=' => ($date_start['year'] . '-' . $date_start['month'] . '-' . $date_start['day']) , 
				'SupplierReplace.date <=' => ($date_end['year'] . '-' . $date_end['month'] . '-' . $date_end['day']) );
		$this->paginate = array('order'=>'SupplierReplace.id');
		
		if($layout=='pdf' || $layout=='xls'){
		$con = $this->SupplierReplace->find('all', array('conditions'=>$conditions));
		}else{
		$con = $this->paginate($conditions);
		}
		$this->set('supplier_replaces', $con);
		
		$departments = $this->SupplierReplace->Department->find('list');
		$copyright_id  = $this->configs['copyright_id'];
		$supplierReplaceStatuses = $this->SupplierReplace->SupplierReplaceStatus->find('list', array('conditions' =>array('id !=' => status_supplier_replace_archive_id))); //archive
		$this->set(compact('departments', 'supplier_replace_department_id', 'supplierReplaceStatuses', 
							'supplier_replace_status_id','date_start', 'date_end', 'copyright_id'));
		
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
		$this->SupplierReplace->recursive = 0;
		
		if($supplier_replace_department_id || ($supplier_replace_department_id=$this->data['SupplierReplace']['department_id']) ) {
			$conditions[] = array('department_id'=>$supplier_replace_department_id);
		}
		
		list($date_start,$date_end) = $this->set_date_filters('SupplierReplace');
		$conditions[] = array('date >=' => ($date_start['year'] . '-' . $date_start['month'] . '-' . $date_start['day']) , 
				'date <=' => ($date_end['year'] . '-' . $date_end['month'] . '-' . $date_end['day']) );
		
		$this->set('supplier_replaces', $this->paginate($conditions));
		
		$departments = $this->SupplierReplace->Department->find('list');
		$this->set(compact('departments', 'supplier_replace_department_id', 'date_start', 'date_end'));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid supplier_replace', true));
			$this->redirect(array('action' => 'index'));
		}
		//$this->SupplierReplace->recursive = 3;
		$this->SupplierReplace->recursive = 1;
		
		$supplier_replace = $this->SupplierReplace->read(null, $id);
		$this->Session->write('SupplierReplace.id', $id);		
		$this->Session->write('SupplierReplace.can_approve',  false);
		$this->Session->write('SupplierReplace.can_process',  false);
		$this->Session->write('SupplierReplace.can_journal',  false);
		$this->Session->write('SupplierReplace.can_request_approval', false);
		$this->Session->write('SupplierReplace.can_print_retur_notes', false);
		$this->Session->write('SupplierReplace.can_reprint_retur_notes', false);
		$this->Session->write('SupplierReplace.can_edit', false);
		
		if($this->Session->read('Security.permissions')==stock_management_group_id){
			$this->Session->write('SupplierReplace.can_request_approval', $supplier_replace['SupplierReplace']['supplier_replace_status_id']==status_supplier_replace_draft_id? true : false);
			$this->Session->write('SupplierReplace.can_process', $supplier_replace['SupplierReplace']['supplier_replace_status_id']==status_supplier_replace_approved_id?true:false);
			$this->Session->write('SupplierReplace.can_print_retur_notes',   ($supplier_replace['SupplierReplace']['supplier_replace_status_id']==status_supplier_replace_approved_id||$supplier_replace['SupplierReplace']['supplier_replace_status_id']==status_supplier_replace_processed_id) &&$supplier_replace['SupplierReplace']['is_printed']==0?true:false);
			$this->Session->write('SupplierReplace.can_reprint_retur_notes', $supplier_replace['SupplierReplace']['is_printed']==1?true:false);
			$this->Session->write('SupplierReplace.can_edit', $supplier_replace['SupplierReplace']['supplier_replace_status_id']==status_supplier_replace_draft_id&&$supplier_replace['SupplierReplace']['created_by']==$this->Session->read('Userinfo.username')?true:false);
		}
		else if($this->Session->read('Security.permissions')==stock_supervisor_group_id){
			$this->Session->write('SupplierReplace.can_approve', $supplier_replace['SupplierReplace']['supplier_replace_status_id']==status_supplier_replace_sent_to_supervisor_id? true : false);
			$this->Session->write('SupplierReplace.can_cancel', $supplier_replace['SupplierReplace']['supplier_replace_status_id']==status_supplier_replace_sent_to_supervisor_id? true : false);
			$this->Session->write('SupplierReplace.can_reject', $supplier_replace['SupplierReplace']['supplier_replace_status_id']==status_supplier_replace_sent_to_supervisor_id? true : false);
		}
		else if($this->Session->read('Security.permissions')==fincon_group_id){
			$this->Session->write('SupplierReplace.can_journal', $supplier_replace['SupplierReplace']['supplier_replace_status_id']==status_supplier_replace_processed_id?true : false);
		}
		
		$this->set('supplier_replace', $supplier_replace);
		$assetCategories = $this->SupplierReplace->SupplierReplaceDetail->Item->AssetCategory->find('list');
		$units = $this->SupplierReplace->SupplierReplaceDetail->Item->Unit->find('list');
		$this->set(compact('assetCategories', 'units'));
	}
	
	// function process($id)
	// {
		// if (!$id) {
			// $this->Session->setFlash(__('Invalid supplier_replace', true));
			// $this->redirect(array('action' => 'index'));
		// }
		// $supplier_replace = $this->SupplierReplace->read(null, $id);
				
		// //insert ke stock cabang, type supplier_replace
		// foreach($supplier_replace['SupplierReplaceDetail'] as $detail){
			// $data['Stock']['date']		=$supplier_replace['SupplierReplace']['date'];
			// $data['Stock']['item_id']	=$detail['item_id'];
			// $data['Stock']['qty']		= -1 * $detail['qty'];
			// $data['Stock']['in_out']	='supplier_replace';
			// $data['Stock']['price']		=$detail['price'];
			// $data['Stock']['amount']	=$detail['amount'];
			// $data['Stock']['supplier_replace_id']	=$detail['supplier_replace_id'];
			// $data['Stock']['department_id']=$supplier_replace['SupplierReplace']['department_id'];
			// $this->SupplierReplace->Stock->create();
			// $this->SupplierReplace->Stock->save($data);
		// }
		
		// $this->set('supplier_replace', $supplier_replace);
		// $assetCategories = $this->SupplierReplace->SupplierReplaceDetail->Item->AssetCategory->find('list');
		// $units = $this->SupplierReplace->SupplierReplaceDetail->Item->Unit->find('list');
		// $this->set(compact('supplier_replace','assetCategories', 'units'));		
		// $this->SupplierReplace->set('is_process',1);
		// $this->SupplierReplace->save();
		
	// }
	
	function add($npb_id=null) {
		if (!empty($this->data)) {
			$this->SupplierReplace->create();
			$retur = $this->SupplierReplace->SupplierRetur->read(null, $this->data['SupplierReplace']['supplier_retur_id']);
			
			if ($this->SupplierReplace->save($this->data)) {
				if(!empty($retur)){
				foreach($retur['SupplierReturDetail'] as $detil){
					  $data['SupplierReplaceDetail']['supplier_replace_id'] = $this->SupplierReplace->id;
					  $data['SupplierReplaceDetail']['qty'] = $detil['qty'];
					  $data['SupplierReplaceDetail']['item_id'] = $detil['item_id'];
					  $data['SupplierReplaceDetail']['posting'] = 0;
					  $data['SupplierReplaceDetail']['price'] = $detil['price'];
					  $data['SupplierReplaceDetail']['amount'] = $detil['amount'];
					  $data['SupplierReplaceDetail']['descr']  = $detil['descr'];
					  $this->SupplierReplace->SupplierReplaceDetail->create();
					  $this->SupplierReplace->SupplierReplaceDetail->save($data);
				}
				}
				$this->Session->setFlash(__('The supplier_replace has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'view', $this->SupplierReplace->id));
			} else {
				$this->Session->setFlash(__('The supplier_replace could not be saved. Please, try again.', true));
			}
		}
		$department_id=$this->Session->read('Userinfo.department_id');
		$business_type_id=$this->Session->read('Userinfo.business_type_id');
		$cost_center_id=$this->Session->read('Userinfo.cost_center_id');
		$newId = $this->SupplierReplace->getNewId($department_id);
		
		$departments = $this->SupplierReplace->Department->find('list');
		$businessTypes = $this->SupplierReplace->BusinessType->find('list');
		//$costCenters = $this->SupplierReplace->CostCenter->find('list');
		$cc 			= $this->SupplierReplace->query('select a.id,a.name,b.t24_dao from cost_centers a left join cost_center_to_daos b on b.cost_center_id = a.id where a.remarks = "Y" order by a.name');
		foreach($cc as $data){
			if($data[0]['t24_dao']){
				$costCenters[ $data[0]['id'] ]	= $data[0]['name'] . " - " .$data[0]['t24_dao'];
			}else{
				$costCenters[ $data[0]['id'] ]	= $data[0]['name'];
			}				
		}
		$suppliers = $this->SupplierReplace->Supplier->find('list');
		$this->set(compact('business_type_id', 'cost_center_id', 'newId', 'departments','department_id', 'suppliers', 'businessTypes', 'costCenters'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid supplier_replace', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->SupplierReplace->save($this->data)) {
				$this->Session->setFlash(__('The supplier_replace has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The supplier_replace could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->SupplierReplace->read(null, $id);
		}
		$departments = $this->SupplierReplace->Department->find('list');
		$this->set(compact('departments'));
	}
	
	function supplier_replace_notes($id, $reprint=false)
	{
		if (!$id) {
			$this->Session->setFlash(__('Invalid supplierReplace', true));
			$this->redirect(array('action' => 'index'));
		}
		$supplierReplace = $this->SupplierReplace->read(null, $id);

		$this->set('supplierReplace', $supplierReplace);
		$assetCategories = $this->SupplierReplace->SupplierReplaceDetail->Item->AssetCategory->find('list');
		$units = $this->SupplierReplace->SupplierReplaceDetail->Item->Unit->find('list');
		$this->set(compact('supplierReplace','assetCategories', 'units'));
				
		Configure::write('debug',1); 
		$this->layout = 'pdf'; //this will use the pdf.ctp layout 
		$this->render('supplier_replace_notes_pdf'); 		

	}
	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for supplier_replace', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->SupplierReplace->delete($id)) {
			$this->Session->setFlash(__('SupplierReplace deleted', true), 'default', array('class'=>'ok'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('SupplierReplace was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function update_status($id=null, $new_status=null)
	{
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid supplierReplace', true));
			$this->redirect(array('action' => 'index'));
		}
		$supplierReplace=$this->SupplierReplace->read(null, $id);
		$this->SupplierReplace->set('supplier_replace_status_id', $new_status);
		if ($new_status == status_supplier_replace_approved_id) {
			$this->data['SupplierReplace']['approved_date'] = date('Y-m-d H:i:s');
			$this->data['SupplierReplace']['approved_by'] = $this->Session->read('Userinfo.username');
		}
		if ($new_status == status_supplier_replace_reject_id) {
			$this->data['SupplierReplace']['reject_date'] = date('Y-m-d H:i:s');
			$this->data['SupplierReplace']['reject_by'] = $this->Session->read('Userinfo.username');
		}
		if ($new_status == status_supplier_replace_draft_id) {
			$this->data['SupplierReplace']['cancel_date'] = date('Y-m-d H:i:s');
			$this->data['SupplierReplace']['cancel_by'] = $this->Session->read('Userinfo.username');
		}

		if($this->configs['journal_cut_off'] > date('H:i:s'))
		{

			if ($this->SupplierReplace->save($this->data)) {
				$this->Session->setFlash(__('The supplierReplace status has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The supplierReplace status could not be saved. Please, try again.', true));
			}

			$this->redirect(array('action' => 'view', $id));
		}
		else
		{
			$this->Session->setFlash(__('Supplier Replace can not be processed because it exceeded the time of '.$this->configs['journal_cut_off'], true));
			$this->redirect(array('controller' => 'supplier_replaces', 'action' => 'view', $id));
		}
	}	
}
?>