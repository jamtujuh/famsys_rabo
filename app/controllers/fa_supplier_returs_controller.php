<?php
class FaSupplierRetursController extends AppController {

	var $name = 'FaSupplierReturs';
	var $helpers = array('Number','Ajax','Javascript');

	function index($cost_center_id=null) {
		$layout = 'Screen';
		if(!empty($this->data)){
		if($this->data['CostCenter']['name'] == '')
		  $this->data['FaSupplierRetur']['cost_center_id'] = null;
		$layout=$this->data['FaSupplierRetur']['layout'];
		}
		$this->FaSupplierRetur->recursive = 0;
		$conditions[]=array();
		
		if( $department_id=$this->data['FaSupplierRetur']['department_id'])  {
			$conditions[] = array('FaSupplierRetur.department_id'=>$department_id);
		}
		if( $business_type_id=$this->data['FaSupplierRetur']['business_type_id'])  {
			$conditions[] = array('FaSupplierRetur.business_type_id'=>$business_type_id);
		}
		if( $cost_center_id=$this->data['FaSupplierRetur']['cost_center_id'])  {
			$conditions[] = array('FaSupplierRetur.cost_center_id'=>$cost_center_id);
		}
		if( $fa_supplier_retur_status_id=$this->data['FaSupplierRetur']['fa_supplier_retur_status_id'])  {
			$conditions[] = array('FaSupplierRetur.fa_supplier_retur_status_id'=>$fa_supplier_retur_status_id);
		}		
		$conditions[] = array('fa_supplier_retur_status_id !='=>status_fa_supplier_retur_archive_id); //archive
		
		list($date_start,$date_end) = $this->set_date_filters('FaSupplierRetur');
		$conditions[] = array('FaSupplierRetur.doc_date >=' => ($date_start['year'] . '-' . $date_start['month'] . '-' . $date_start['day']) , 
				'FaSupplierRetur.doc_date <=' => ($date_end['year'] . '-' . $date_end['month'] . '-' . $date_end['day']) );
			$this->paginate = array('order'=>'FaSupplierRetur.id');
		if($layout=='pdf' || $layout=='xls'){
			$con = $this->FaSupplierRetur->find('all', array('conditions'=>$conditions, 'order'=>'FaSupplierRetur.id'));
		}else{
			$con = $this->paginate($conditions);
		}

		$this->set('faSupplierReturs', $con);
		$copyright_id = $this->configs['copyright_id'];
		$departments = $this->FaSupplierRetur->Department->find('list');
		$businessTypes = $this->FaSupplierRetur->BusinessType->find('list');
		$costCenter	 = $this->FaSupplierRetur->CostCenter->find('list');
		$costCenters = $this->FaSupplierRetur->CostCenter->find('list', array('fields'=>'name'));
		//$cc 			= $this->FaSupplierRetur->query('select a.id,a.name,b.t24_dao from cost_centers a left join cost_center_to_daos b on b.cost_center_id = a.id where a.remarks = "Y" order by a.name');
		//foreach($cc as $data){
		//	if($data[0]['t24_dao']){
		//		$costCenters[ $data[0]['id'] ]	= $data[0]['name'] . " - " .$data[0]['t24_dao'];
		//	}else{
		//		$costCenters[ $data[0]['id'] ]	= $data[0]['name'];
		//	}				
		//}
		$faSupplierReturStatuses = $this->FaSupplierRetur->FaSupplierReturStatus->find('list', array('conditions' =>array('id !=' => status_fa_supplier_retur_archive_id))); //archive
		$moduleName = 'Fixed Assets > List FA Supplier Retur';
		$this->set('title_for_layout',  $this->lastSegment($moduleName));
		$this->set(compact('departments', 'businessTypes', 'costCenters', 'faSupplierReturStatuses', 'copyright_id', 
							'department_id', 'business_type_id', 'cost_center_id', 'fa_supplier_retur_status_id', 
							'costCenter', 'date_start', 'date_end', 'moduleName'));
		
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

	function view($id = null) {
		$id_group=$this->Session->read('Security.permissions');
		
		if (!$id) {
			$this->flash(__('Invalid Fa Supplier Retur', true), array('action' => 'index'));
		}
		
		$faSupplierRetur = $this->FaSupplierRetur->read(null, $id);
		$this->Session->write('FaSupplierRetur.id', $id);
		$this->Session->write('FaSupplierRetur.can_edit', false);
		$this->Session->write('FaSupplierRetur.can_replacement', false);
		$this->Session->write('FaSupplierRetur.can_pdf', false);
		
		$fa_supplier_retur_status_id = $faSupplierRetur['FaSupplierRetur']['fa_supplier_retur_status_id'];
		
		if($id_group == gs_group_id)
		{
			$this->Session->write('FaSupplierRetur.can_edit', $fa_supplier_retur_status_id==status_fa_supplier_retur_draft_id);
			$this->Session->write('FaSupplierRetur.can_replacement', $fa_supplier_retur_status_id==status_fa_supplier_retur_processing_id);
			$this->Session->write('FaSupplierRetur.can_pdf', true);
		}
		else if($id_group == po_approval1_group_id)
		{
		}
		
		$this->set('faSupplierRetur', $this->FaSupplierRetur->read(null, $id));
		$approveLink = $this->get_approve_link($id, $faSupplierRetur, $id_group);
		$assetCategory = $this->FaSupplierRetur->FaSupplierReturDetail->AssetCategory->find('list');
		$this->set(compact('approveLink', 'assetCategory'));
	}
	
	function view_pdf($id = null) 
    { 
       //cek id
		if (!$id) {
			$this->Session->setFlash(__('Invalid FaSupplierRetur', true));
			$this->redirect(array('action' => 'index'));
		}
		
		//Add is_printed=1
		// if (!empty($id)) {
			// $data['FaSupplierRetur']['id'] = $id;
			// $data['FaSupplierRetur']['is_printed'] = 1;
			// $this->FaSupplierRetur->save($data);
		// }
		
        Configure::write('debug',0); // Otherwise we cannot use this method while developing 
		$faSupplierRetur=$this->FaSupplierRetur->read(null, $id);
		$this->Session->write('FaSupplierRetur.id', $id);
		$this->set('faSupplierRetur', $faSupplierRetur);
		$copyright_id = $this->configs['copyright_id'];
		$departments = $this->FaSupplierRetur->Department->find('list');
		$assetCategories = $this->FaSupplierRetur->FaSupplierReturDetail->AssetDetail->AssetCategory->find('list');
		$this->set(compact('faSupplierRetur', 'departments', 'assetCategories', 'copyright_id'));
        $this->layout = 'pdf'; //this will use the pdf.ctp layout 
        $this->render(); 
    } 	
	
	function add() {
		if (!empty($this->data)) {
				if($this->data['Po']['no'] == ''){
				$this->data['FaSupplierRetur']['po_id'] = null;
				$this->Session->setFlash(__('FaSupplierRetur can not save. please check PO', true));
			}
			$this->FaSupplierRetur->create();
			if ($this->FaSupplierRetur->save($this->data)) {
				$this->Session->setFlash(__('Fa Supplier Retur saved.', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'view', $this->FaSupplierRetur->id));
			} else {
			}
		}
		$newId = $this->FaSupplierRetur->getNewId($this->Session->read('Userinfo.department_id'));
		$departments = $this->FaSupplierRetur->Department->find('list');
		$businessTypes = $this->FaSupplierRetur->BusinessType->find('list');
		$costCenters = $this->FaSupplierRetur->CostCenter->find('list');
		$pos = $this->FaSupplierRetur->Po->find('list');
		$faSupplierReturStatuses = $this->FaSupplierRetur->FaSupplierReturStatus->find('list');
		$moduleName = 'Fixed Assets > New FA Supplier Retur';
		$this->set('title_for_layout',  $this->lastSegment($moduleName));
		$this->set(compact('departments', 'businessTypes', 'costCenters', 'pos', 'faSupplierReturStatuses', 'newId', 'moduleName'));
	}
	
	
	function get_approve_link($id, $faSupplierRetur, $id_group){
		$this->Session->write('FaSupplierRetur.is_gs_user', $this->Session->read('Security.permissions') == gs_group_id ? true : false);			
		$this->Session->write('FaSupplierRetur.is_approval1_user', $this->Session->read('Security.permissions') == po_approval1_group_id ? true : false);			

		$group	= $this->FaSupplierRetur->query('select * from groups where id="'.$id_group.'"');
		
		if($id_group  == gs_group_id && $faSupplierRetur['FaSupplierRetur']['fa_supplier_retur_status_id']==status_fa_supplier_retur_draft_id)
		{
			$approveLink = array('label'=>__('Send To Supervisor',true),
			'options'=>array('action' => 'approve_fa_supplier_retur/'. status_fa_supplier_retur_sent_to_supervisor_id , $id)); 
		}
		else if($id_group  == po_approval1_group_id && $faSupplierRetur['FaSupplierRetur']['fa_supplier_retur_status_id']==status_fa_supplier_retur_sent_to_supervisor_id)
		{
			$approveLink = array('label'=>__('Approve and Process',true),
			'options'=>array('action' => 'process/'. status_fa_supplier_retur_processing_id , $id)); 
		}
		else
			$approveLink = array();


		return $approveLink;
	}
	
	function approve_fa_supplier_retur($level,$id) {
	
		
		$this->data['FaSupplierRetur']['id']=$id;
		$this->data['FaSupplierRetur']['fa_supplier_retur_status_id']=$level;
		$faReturSupplier = $this->FaSupplierRetur->read(null, $id);
		foreach($faReturSupplier['FaSupplierReturDetail'] as $frsd){
			if($frsd['id'] != NULL){
				if($level == status_fa_supplier_retur_processing_id){
				$this->data['FaSupplierRetur']['approved_by'] 	= $this->Session->read('Userinfo.username');
				$this->data['FaSupplierRetur']['approved_date'] = date('Y-m-d H:i:s');
				}
				if ($this->FaSupplierRetur->save($this->data)) {
				
					$this->Session->setFlash(__('The Fa Supplier Retur has been saved', true), 'default', array('class'=>'ok'));
					$this->redirect(array('action' => 'index'));
				} 
			}
		}
		
			$this->Session->setFlash(__('The Fa Supplier Retur can not be processed please check detail', true));
			$this->redirect(array('action' => 'view', $id));					

	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(sprintf(__('Invalid Fa Supplier Retur', true)), array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if($this->data['Po']['no'] == ''){
				$this->data['FaSupplierRetur']['po_id'] = null;
				$this->Session->setFlash(__('FaSupplierRetur can not save. please check PO', true));
			}
			if ($this->FaSupplierRetur->save($this->data)) {
				$this->Session->setFlash(__('The Fa Supplier Retur has been saved.', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'view', $id));
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->FaSupplierRetur->read(null, $id);
		}
		$departments = $this->FaSupplierRetur->Department->find('list');
		$businessTypes = $this->FaSupplierRetur->BusinessType->find('list');
		$costCenters = $this->FaSupplierRetur->CostCenter->find('list');
		$faSupplierReturStatuses = $this->FaSupplierRetur->FaSupplierReturStatus->find('list');
		$this->set(compact('departments', 'businessTypes', 'costCenters', 'faSupplierReturStatuses'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->flash(sprintf(__('Invalid Fa Supplier Retur', true)), array('action' => 'index'));
		}
		if ($this->FaSupplierRetur->delete($id)) {
			$this->flash(__('Fa retur deleted', true), array('action' => 'index'));
		}
		$this->flash(__('Fa retur was not deleted', true), array('action' => 'index'));
		$this->redirect(array('action' => 'index'));
	}
	
	
	function process($level, $id)
	{
		$this->data['FaSupplierRetur']['fa_supplier_retur_status_id']=$level;
		
		$faSupplierRetur = $this->FaSupplierRetur->read(null, $id);
		
		foreach($faSupplierRetur['FaSupplierReturDetail'] as $fsrd)
		{
			$asset_detail_id = $fsrd['asset_detail_id'];
			$assetDetail = $this->FaSupplierRetur->FaSupplierReturDetail->AssetDetail->read(null, $asset_detail_id);
			
			//update assetDetail to ada=T
			$this->FaSupplierRetur->FaSupplierReturDetail->AssetDetail->id=$asset_detail_id;
			$this->FaSupplierRetur->FaSupplierReturDetail->AssetDetail->set('ada', 'T');
			$this->FaSupplierRetur->FaSupplierReturDetail->AssetDetail->set('notes', $assetDetail['AssetDetail']['notes'] . 
				"\nReturned to Supplier: " . $faSupplierRetur['FaSupplierRetur']['no'] . 
				" at " . date('Y-m-d H:i:s')
				);
			$this->FaSupplierRetur->FaSupplierReturDetail->AssetDetail->save();
			if ($this->FaSupplierRetur->save($this->data)) {
				$this->Session->setFlash(__('The Fa Supplier Retur has been saved.', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			}
		}
	}
	
	function replacement($id)
	{

		$faSupplierRetur = $this->FaSupplierRetur->read(null, $id);
		$faSupplierRetur['FaSupplierRetur']['fa_supplier_retur_status_id'] = status_fa_supplier_retur_finish_id;
		
		if ($this->FaSupplierRetur->save($faSupplierRetur)) 
		{	
			foreach($faSupplierRetur['FaSupplierReturDetail'] as $fsrd)
			{
				$asset_detail_id = $fsrd['asset_detail_id'];
				$assetDetail = $this->FaSupplierRetur->FaSupplierReturDetail->AssetDetail->read(null, $asset_detail_id);
				
				//update assetDetail to ada=T
				$this->FaSupplierRetur->FaSupplierReturDetail->AssetDetail->id=$asset_detail_id;
				$this->FaSupplierRetur->FaSupplierReturDetail->AssetDetail->set('ada', 'Y');
				$this->FaSupplierRetur->FaSupplierReturDetail->AssetDetail->set('notes', 
					$assetDetail['AssetDetail']['notes'] . 
					"\nReplacement from Supplier: " . $faSupplierRetur['FaSupplierRetur']['no'] . 
					" at " . date('Y-m-d H:i:s'));
				$this->FaSupplierRetur->FaSupplierReturDetail->AssetDetail->save();
					
			}
			$this->flash(__('Fa Supplier Retur replacement was processed', true), array('action' => 'index'));
			$this->redirect(array('action' => 'index'));		
		}
		else
		{
			$this->flash(__('Fa Supplier Retur replacement was not processed', true));
			$this->redirect(array('action' => 'index'));		
		}
	}	
}
?>