<?php
class FaRetursController extends AppController {

	var $name = 'FaReturs';
	var $helpers = array('Number','Ajax','Javascript');

	function index() {
	
		$this->FaRetur->recursive = 0;
		$layout=$this->data['FaRetur']['layout'];
        $group_id = $this->Session->read('Security.permissions');
		$username = $this->Session->read('Userinfo.username');
		$conditions[]=array();
		if ($group_id == normal_user_group_id) //normal users
			  $conditions = array('created_by' => $username);
		$group_id = $this->Session->read('Security.permissions');
        $dep_id = $this->Session->read('Userinfo.department_id');
		
		if ($group_id == normal_user_group_id || $group_id == branch_head_group_id){//normal
			  $conditions[] = array(
				  'FaRetur.department_id' => $dep_id,
			  );
		}
		elseif( $department_id=$this->data['FaRetur']['department_id'])  {
			$conditions[] = array('FaRetur.department_id'=>$department_id);
		}
		if( $business_type_id=$this->data['FaRetur']['business_type_id'])  {
			$conditions[] = array('FaRetur.business_type_id'=>$business_type_id);
		}
		if( $cost_center_id=$this->data['FaRetur']['cost_center_id'])  {
			$conditions[] = array('FaRetur.cost_center_id'=>$cost_center_id);
		}
		if( $fa_retur_status_id=$this->data['FaRetur']['fa_retur_status_id'])  {
			$conditions[] = array('FaRetur.fa_retur_status_id'=>$fa_retur_status_id);
		}		
		$conditions[] = array('fa_retur_status_id !='=>status_fa_retur_archive_id); //archive
		list($date_start,$date_end) = $this->set_date_filters('FaRetur');
		$conditions[] = array('FaRetur.doc_date >=' => ($date_start['year'] . '-' . $date_start['month'] . '-' . $date_start['day']) , 
				'FaRetur.doc_date <=' => ($date_end['year'] . '-' . $date_end['month'] . '-' . $date_end['day']) );
		if($layout=='pdf' || $layout=='xls'){
			$con = $this->FaRetur->find('all', array('conditions'=>$conditions, 'order'=>'FaRetur.id'));
		}else{
			$this->paginate = array('order'=>'FaRetur.id');
			$con = $this->paginate($conditions);
		}
		$this->set('faReturs', $con);
		$copyright_id	 = $this->configs['copyright_id'];	
		$departments	 = $this->FaRetur->Department->find('list');
		$businessTypes	 = $this->FaRetur->BusinessType->find('list');
		$costCenter 	 = $this->FaRetur->CostCenter->find('list');
		$costCenters 	 = $this->FaRetur->CostCenter->find('list', array('fields'=>'name'));
		//$cc 			= $this->FaRetur->query('select a.id,a.name,b.t24_dao from cost_centers a left join cost_center_to_daos b on b.cost_center_id = a.id where a.remarks = "Y" order by a.name');
		//foreach($cc as $data){
		//	if($data[0]['t24_dao']){
		//		$costCenters[ $data[0]['id'] ]	= $data[0]['name'] . " - " .$data[0]['t24_dao'];
		//	}else{
		//		$costCenters[ $data[0]['id'] ]	= $data[0]['name'];
		//	}				
		//}
		$faReturStatuses = $this->FaRetur->FaReturStatus->find('list', array('conditions' =>array('id !=' => status_fa_retur_archive_id))); //archive
		$moduleName = 'Fixed Assets > List FA Retur';
		$this->set('title_for_layout',  $this->lastSegment($moduleName));
		$this->set(compact('departments', 'businessTypes', 'costCenters', 'faReturStatuses', 'copyright_id', 'department_id',
					'business_type_id', 'cost_center_id', 'fa_retur_status_id', 'costCenter', 'date_start', 'date_end', 'moduleName'));
		
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
			$this->flash(__('Invalid fa retur', true), array('action' => 'index'));
			
		}
		$faRetur		    = $this->FaRetur->read(null, $id);
		$group_id			= $this->Session->read('Security.permissions');
		$username			= $this->Session->read('Userinfo.username');
		$this->Session->write('FaRetur.id', $id);
		/// can edit FaRETUR ?
		if($faRetur['FaRetur']['fa_retur_status_id'] == status_fa_retur_draft_id && $id_group == normal_user_group_id)
			$this->Session->write('FaRetur.can_edit', true);
		else
			$this->Session->write('FaRetur.can_edit', false);
	
		$this->Session->write('FaRetur.can_print', false);
		$this->Session->write('FaRetur.can_cancel', false);
		$this->Session->write('FaRetur.can_reject', false);
		$this->Session->write('FaRetur.can_archive', false);
		$this->Session->write('FaRetur.can_finish', false);
		
	//note reject dan cancel
		if($group_id==branch_head_group_id && $faRetur['FaRetur']['fa_retur_status_id'] == status_fa_retur_sent_to_branch_head_id)
		{
				$this->Session->write('FaRetur.can_reject', true) ;
				
				$this->Session->write('FaRetur.can_cancel', true);
		}	
		elseif($group_id==gs_group_id && $faRetur['FaRetur']['fa_retur_status_id'] == status_fa_retur_branch_approved_id)
		{
				$this->Session->write('FaRetur.can_reject', true) ;
				
				$this->Session->write('FaRetur.can_cancel',true);
		}
		elseif($group_id==po_approval1_group_id && $faRetur['FaRetur']['fa_retur_status_id'] == status_fa_retur_sent_to_gs_id)
		{
				$this->Session->write('FaRetur.can_reject', true) ;
				
				$this->Session->write('FaRetur.can_cancel',true);
		}
		elseif($group_id==normal_user_group_id && $faRetur['FaRetur']['fa_retur_status_id'] == status_fa_retur_reject_id)
		{
				$this->Session->write('FaRetur.can_archive', true) ;
		}
		elseif($group_id==gs_group_id &&  ($faRetur['FaRetur']['fa_retur_status_id'] == status_fa_retur_approval_by_gs_spv_id || $faRetur['FaRetur']['fa_retur_status_id'] ==status_fa_retur_processing_id))
		{
				$this->Session->write('FaRetur.can_print', true) ;
		}
		elseif($group_id==gs_group_id &&  $faRetur['FaRetur']['fa_retur_status_id'] ==status_fa_retur_processing_id)
		{
				$this->Session->write('FaRetur.can_finish', true) ;
		}
		
		
		/// can edit FaRETURdETAIL ?
		if($faRetur['FaRetur']['fa_retur_status_id'] == status_fa_retur_processing_id && $id_group == gs_group_id)
			$this->Session->write('FaRetur.can_edit_detail', true);
		else
			$this->Session->write('FaRetur.can_edit_detail', false);
		if($faRetur['FaRetur']['fa_retur_status_id'] == status_fa_retur_processing_id && $id_group == gs_group_id)
			$this->Session->write('FaRetur.can_edit_detail', true);
		else
			$this->Session->write('FaRetur.can_edit_detail', false);

		$faRetur = $this->FaRetur->read(null, $id);
		$this->Session->write('FaRetur.id', $id);
		
		$this->set('faRetur', $this->FaRetur->read(null, $id));
		$approveLink = $this->get_approve_link($id, $faRetur, $id_group);
		$assetCategory = $this->FaRetur->FaReturDetail->AssetCategory->find('list');
		$this->set(compact('approveLink', 'assetCategory'));
	}
	
	function reject($id = null){
		//view Fa Retur
		if (!$id) {
			$this->Session->setFlash(__('Invalid Fa Retur', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->FaRetur->read(null, $id);
		
		//Add Notes Reject FaRetur and Change Status
		if (!empty($this->data)) {
			$this->data['FaRetur']['id'] = $id;
			$this->data['FaRetur']['fa_retur_status_id'] = status_fa_retur_reject_id;
			if ($this->FaRetur->save($this->data)) {
				$this->Session->setFlash(__('The Fa Retur has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Fa Retur could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$faRetur = $this->data = $this->FaRetur->read(null, $id);
		}
		$assetCategory = $this->FaRetur->FaReturDetail->AssetCategory->find('list');
		$departments = $this->FaRetur->Department->find('list');
		$faReturStatus = $this->FaRetur->FaReturStatus->find('list');
		$this->set(compact('faRetur', 'departments', 'faReturStatus', 'assetCategory'));
	}
	
	function cancel($id = null){
		//view Fa Retur
		if (!$id) {
			$this->Session->setFlash(__('Invalid Fa Retur', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->FaRetur->read(null, $id);
		
		//Add Notes Reject FaRetur and Change Status
		if (!empty($this->data)) {
			$this->data['FaRetur']['id'] = $id;
			$this->data['FaRetur']['fa_retur_status_id'] = status_fa_retur_draft_id;
			if ($this->FaRetur->save($this->data)) {
				$this->Session->setFlash(__('The Fa Retur has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Fa Retur could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$faRetur = $this->data = $this->FaRetur->read(null, $id);
		}
		$assetCategory = $this->FaRetur->FaReturDetail->AssetCategory->find('list');
		$departments = $this->FaRetur->Department->find('list');
		$faReturStatus = $this->FaRetur->FaReturStatus->find('list');
		$this->set(compact('faRetur', 'departments', 'faReturStatus', 'assetCategory'));
	}
	function can_print($id = null){
		//view Fa Retur
		if (!$id) {
			$this->Session->setFlash(__('Invalid Fa Retur', true));
			$this->redirect(array('action' => 'index'));
		}
        Configure::write('debug',0); // Otherwise we cannot use this method while developing 
		$faRetur=$this->FaRetur->read(null, $id);
		$this->Session->write('FaRetur.id', $id);
		$this->set('FaRetur', $faRetur);
		
		$copyright_id = $this->configs['copyright_id'];
		$assetCategory = $this->FaRetur->FaReturDetail->AssetCategory->find('list');
		$departments = $this->FaRetur->Department->find('list');
		$faReturStatus = $this->FaRetur->FaReturStatus->find('list');
		$this->set(compact('faRetur', 'departments', 'faReturStatus', 'assetCategory', 'copyright_id'));
        $this->layout = 'pdf'; //this will use the pdf.ctp layout 
        $this->render(); 

	}
	
	function archive($id = null){
		//view Fa Retur
		if (!$id) {
			$this->Session->setFlash(__('Invalid Fa Retur', true));
			$this->redirect(array('action' => 'index'));
		}
		
		$this->data['FaRetur']['id'] = $id;
		$this->data['FaRetur']['fa_retur_status_id'] = status_fa_retur_archive_id;
		if ($this->FaRetur->save($this->data)) {
			$this->Session->setFlash(__('The Fa Retur has been saved', true), 'default', array('class'=>'ok'));
			$this->redirect(array('action' => 'index'));
		} else {
			$this->Session->setFlash(__('The Fa Retur could not be saved. Please, try again.', true));
		}
	}

	function add() {
		if (!empty($this->data)) {
			$this->FaRetur->create();
			if ($this->FaRetur->save($this->data)) {
				$this->Session->setFlash(__('Fa Retur saved.', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'view', $this->FaRetur->id));
			} else {
			}
		}
		$newId = $this->FaRetur->getNewId($this->Session->read('Userinfo.department_id'));
		$departments = $this->FaRetur->Department->find('list');
		$businessTypes = $this->FaRetur->BusinessType->find('list');
		$costCenters = $this->FaRetur->CostCenter->find('list');
		//$cc 			= $this->FaRetur->query('select a.id,a.name,b.t24_dao from cost_centers a left join cost_center_to_daos b on b.cost_center_id = a.id where a.remarks = "Y" order by a.name');
		//foreach($cc as $data){
		//	if($data[0]['t24_dao']){
		//		$costCenters[ $data[0]['id'] ]	= $data[0]['name'] . " - " .$data[0]['t24_dao'];
		//	}else{
		//		$costCenters[ $data[0]['id'] ]	= $data[0]['name'];
		//	}				
		//}
		$faReturStatuses = $this->FaRetur->FaReturStatus->find('list');
		$this->set(compact('departments', 'businessTypes', 'costCenters', 'faReturStatuses', 'newId'));
	}
	function get_approve_link($id, $faRetur, $id_group){
		$this->Session->write('FaRetur.is_normal_user', $this->Session->read('Security.permissions') == normal_user_group_id ? true : false);
		$this->Session->write('FaRetur.is_branch_head_user', $this->Session->read('Security.permissions') == branch_head_group_id ? true : false);
		$this->Session->write('FaRetur.is_gs_user', $this->Session->read('Security.permissions') == gs_group_id ? true : false);			
		$this->Session->write('FaRetur.is_approval1_user', $this->Session->read('Security.permissions') == po_approval1_group_id ? true : false);			

	
		$group	= $this->FaRetur->query('select * from groups where id="'.$id_group.'"');
		
		if($id_group  == normal_user_group_id && $faRetur['FaRetur']['fa_retur_status_id']==status_fa_retur_draft_id)
			{
				$approveLink = array('label'=>__('Send to Branch Head',true), 
				'options'=>array('action' => 'approve_fa_retur/' . status_fa_retur_sent_to_branch_head_id , $id));
			}
		else if($id_group  == branch_head_group_id && $faRetur['FaRetur']['fa_retur_status_id']==status_fa_retur_sent_to_branch_head_id)
			{
				$approveLink = array('label'=>__('Approve by Branch Head',true),
				'options'=>array('action' => 'approve_fa_retur/'. status_fa_retur_branch_approved_id , $id)); 
			}
		else if($id_group  == gs_group_id && $faRetur['FaRetur']['fa_retur_status_id']==status_fa_retur_branch_approved_id)
			{
				$approveLink = array('label'=>__('Send To Supervisor',true),
				'options'=>array('action' => 'approve_fa_retur/'. status_fa_retur_sent_to_gs_id , $id)); 
			}
		else if($id_group  == po_approval1_group_id && $faRetur['FaRetur']['fa_retur_status_id']==status_fa_retur_sent_to_gs_id)
			{
				$approveLink = array('label'=>__('Approve by Supervisor',true),
				'options'=>array('action' => 'approve_fa_retur/'. status_fa_retur_approval_by_gs_spv_id , $id)); 
			}
		else if($id_group  == gs_group_id && $faRetur['FaRetur']['fa_retur_status_id']==status_fa_retur_approval_by_gs_spv_id)
			{
				$approveLink = array('label'=>__('Procces',true),
				'options'=>array('action' => 'approve_fa_retur/'. status_fa_retur_processing_id , $id)); 
			}
		else if($id_group  == gs_group_id && $faRetur['FaRetur']['fa_retur_status_id']== status_fa_retur_processing_id)
			{
				$approveLink = array('label'=>__('Finish',true),
				'options'=>array('action' => 'finish/'. $id)); 
			}
		else
			{
				$approveLink = array('label'=>__('Back',true), 'options'=>array('action'=>'index'));
			}

		return $approveLink;
	}
	
	function approve_fa_retur($level,$id) {
	
		
		$this->data['FaRetur']['id']=$id;
		$faRetur = $this->FaRetur->read(null, $id);
		foreach($faRetur['FaReturDetail'] as $frd){
			if($frd['id'] != null){	
					$this->data['FaRetur']['fa_retur_status_id']=$level;
					if($level == status_fa_retur_branch_approved_id || 
					$level == status_fa_retur_sent_to_gs_id || $level == status_fa_retur_approval_by_gs_spv_id )
					{
						$this->data['FaRetur']['approved_date'] = date('Y-m-d H:i:s');
						$this->data['FaRetur']['approved_by']   = $this->Session->read('Userinfo.username');
					}
					
					if ($this->FaRetur->save($this->data)) {
						$this->Session->setFlash(__('The Fa Retur has been saved', true), 'default', array('class'=>'ok'));
						$this->redirect(array('action' => 'index'));
					}
			}
					
		}
			$this->Session->setFlash(__('The Fa Retur can not be send please check detail', true));
			$this->redirect(array('action' => 'view', $id));	
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(sprintf(__('Invalid fa retur', true)), array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->FaRetur->save($this->data)) {
				$this->flash(__('The fa retur has been saved.', true), array('action' => 'index'));
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->FaRetur->read(null, $id);
		}
		$departments = $this->FaRetur->Department->find('list');
		$businessTypes = $this->FaRetur->BusinessType->find('list');
		$costCenters = $this->FaRetur->CostCenter->find('list');
		//$cc 			= $this->FaRetur->query('select a.id,a.name,b.t24_dao from cost_centers a left join cost_center_to_daos b on b.cost_center_id = a.id where a.remarks = "Y" order by a.name');
		//foreach($cc as $data){
		//	if($data[0]['t24_dao']){
		//		$costCenters[ $data[0]['id'] ]	= $data[0]['name'] . " - " .$data[0]['t24_dao'];
		//	}else{
		//		$costCenters[ $data[0]['id'] ]	= $data[0]['name'];
		//	}				
		//}
		$faReturStatuses = $this->FaRetur->FaReturStatus->find('list');
		$this->set(compact('departments', 'businessTypes', 'costCenters', 'faReturStatuses'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->flash(sprintf(__('Invalid fa retur', true)), array('action' => 'index'));
		}
		if ($this->FaRetur->delete($id)) {
			$this->flash(__('Fa retur deleted', true), array('action' => 'index'));
		}
		$this->flash(__('Fa retur was not deleted', true), array('action' => 'index'));
		$this->redirect(array('action' => 'index'));
	}
	
	function finish($id)
	{		
		if (!$id) {
			$this->flash(sprintf(__('Invalid fa retur', true)), array('action' => 'index'));
		}

		$faRetur = $this->FaRetur->read(null, $id);
		
		foreach($faRetur['FaReturDetail'] as $fsd)
		{
			$asset_detail_id = $fsd['asset_detail_id'];
			$assetDetail = $this->FaRetur->FaReturDetail->AssetDetail->read(null, $asset_detail_id);
			
			//update assetDetail to ada=Y
			$this->FaRetur->FaReturDetail->AssetDetail->id=$asset_detail_id;
			$this->FaRetur->FaReturDetail->AssetDetail->set('ada', 'Y');
			$this->FaRetur->FaReturDetail->AssetDetail->set('brand', $fsd['brand']);
			$this->FaRetur->FaReturDetail->AssetDetail->set('type',  $fsd['type']);
			$this->FaRetur->FaReturDetail->AssetDetail->set('color',  $fsd['color']);
			$this->FaRetur->FaReturDetail->AssetDetail->set('serial no',  $fsd['serial_no']);
			$this->FaRetur->FaReturDetail->AssetDetail->save();
				
		}
		$this->data['FaRetur']['id'] = $id;
		$this->data['FaRetur']['fa_retur_status_id'] = status_fa_retur_finish_id;
		if ($this->FaRetur->save($this->data)) {
			$this->Session->setFlash(__('The Fa Retur has been saved', true), 'default', array('class'=>'ok'));
			$this->redirect(array('action' => 'index'));
		} else {
			$this->Session->setFlash(__('The Fa Retur could not be saved. Please, try again.', true));
		}

	}

}
?>