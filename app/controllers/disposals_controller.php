<?php
App::import('Model','AssetDetail');
class DisposalsController extends AppController {

	var $name = 'Disposals';
	var $helpers = array('Ajax', 'Javascript', 'Time');
	var $components = array('RequestHandler');
	
	function index($type=null, $disposal_status_id=null, $disposal_department_id=null, $disposal_type_id=null) {
		$this->Session->write('Disposal.is_fa_management_user', $this->Session->read('Security.permissions') == fa_management_group_id ? true : false);
		$this->Session->write('Disposal.is_fa_supervisor_user', $this->Session->read('Security.permissions') == fa_supervisor_group_id ? true : false);
		$this->Session->write('Disposal.is_fincon_user', $this->Session->read('Security.permissions') == fincon_group_id ? true : false);	

		$this->Disposal->recursive = 0;
		$group_id 	= $this->Session->read('Security.permissions');
		$layout=$this->data['Disposal']['layout'];
			
		//condision type writeoff and sales

		if($type) 
			$this->Session->write('Disposal.disposal_type', $type);
		
		//$conditions[] = array('disposal_type_id'=>$this->Session->read('Disposal.disposal_type'));
		$type= $this->Session->read('Disposal.disposal_type');

		//// filter Disposals 
		if($group_id == admin_group_id || $group_id == gs_group_id)//admin||gs
			$conditions = array();
			
		else if($group_id == fa_management_group_id)//fa_management
			$conditions[] = array(
					'OR'=>array(
						array('disposal_status_id'=>status_disposal_new_id), 
						array('disposal_status_id'=>status_disposal_request_for_approval_id),
						array('disposal_status_id'=>status_disposal_approved_by_supervisor_id),
						array('disposal_status_id'=>status_disposal_finish_id),
						array('disposal_status_id'=>status_disposal_archive_id),
						array('disposal_status_id'=>status_disposal_reject_id)) 
				);
		
		else if($group_id == fa_supervisor_group_id)//fa_supervisor
			$conditions[] = array(
					'OR'=>array(
						array('disposal_status_id'=>status_disposal_request_for_approval_id),
						array('disposal_status_id'=>status_disposal_approved_by_supervisor_id),
						array('disposal_status_id'=>status_disposal_approved_by_fincon_id),
						array('disposal_status_id'=>status_disposal_finish_id),
						array('disposal_status_id'=>status_disposal_archive_id),
						array('disposal_status_id'=>status_disposal_reject_id)) 
				);
		else if ($group_id == fincon_group_id)//fincon
			$conditions[] = array(
					'OR'=>array(
						array('disposal_status_id'=>status_disposal_approved_by_supervisor_id),
						array('disposal_status_id'=>status_disposal_approved_by_fincon_id),
						array('disposal_status_id'=>status_disposal_reject_id),
						array('disposal_status_id'=>status_disposal_finish_id),
						array('disposal_status_id'=>status_disposal_posted_journal_id)) 
				);
			
		if($disposal_status_id || ($disposal_status_id=$this->data['Disposal']['disposal_status_id']) ) {
			$conditions[] = array('disposal_status_id'=>$disposal_status_id);
		}
			
		if($disposal_department_id || ($disposal_department_id=$this->data['Disposal']['department_id']) ) {
			$conditions[] = array('department_id'=>$disposal_department_id);
		}
		
		$conditions[] = array('disposal_type_id'=>$this->Session->read('Disposal.disposal_type'));
		
		//if($disposal_type_id || ($disposal_type_id=$this->data['Disposal']['disposal_type_id']) ) {
		//$conditions[] = array('disposal_type_id'=>$disposal_type_id);
		//}
		$conditions[] = array('disposal_status_id !='=>status_disposal_archive_id); //archive
		
		list($date_start,$date_end) = $this->set_date_filters('Disposal');
		$conditions[] = array('doc_date >=' => ($date_start['year'] . '-' . $date_start['month'] . '-' . $date_start['day']) , 
				'doc_date <=' => ($date_end['year'] . '-' . $date_end['month'] . '-' . $date_end['day']) );
		if($layout=='pdf' || $layout=='xls'){
		$con = $this->Disposal->find('all', array('conditions'=>$conditions, 'order'=>'Disposal.id'));
		}else{
		$this->paginate = array('order'=>'Disposal.id');
		$con = $this->paginate($conditions);
		}
		$this->set('disposals', $con);
		$copyright_id  = $this->configs['copyright_id'];
		$disposal_statuses = $this->Disposal->DisposalStatus->find('list', array('conditions' =>array('id !=' => status_disposal_archive_id))); //archive
		$disposalTypes = $this->Disposal->DisposalType->find('list');
		$departments = $this->Disposal->Department->find('list');
		$moduleName = 'Fixed Assets > Disposal > List Disposal ' . ucwords($disposalTypes[$type]);
		$this->set('title_for_layout',  $this->lastSegment($moduleName));
		$this->set(compact('disposal_statuses', 'departments', 
		'disposal_status_id', 'disposal_department_id', 
		'disposalTypes', 'copyright_id',
		'date_start', 'date_end', 'type', 'moduleName'));
		
		//$this->set('movements', $this->paginate());
		
		
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
		$this->Session->write('Disposal.is_fa_management_user', $this->Session->read('Security.permissions') == fa_management_group_id ? true : false);
		$this->Session->write('Disposal.is_fa_supervisor_user', $this->Session->read('Security.permissions') == fa_supervisor_group_id ? true : false);
		$this->Session->write('Disposal.is_fincon_user', $this->Session->read('Security.permissions') == fincon_group_id ? true : false);		
	
		if (!$id) {
			$this->Session->setFlash(__('Invalid disposal', true));
			$this->redirect(array('action' => 'index', $this->Session->read('Disposal.disposal_type')));
		}
	
		
		$disposal = $this->Disposal->read(null, $id);
		$this->Session->write('Disposal.id', $id);
		$type = $disposal['Disposal']['disposal_type_id'];
		$this->Session->write('Disposal.type', $type);
		$id_group=$this->Session->read('Security.permissions');
		
		/// can edit Disposal ?
		if(($disposal['Disposal']['disposal_status_id'] == status_disposal_new_id && $id_group == fa_management_group_id) ||
			$id_group == admin_group_id)
			$this->Session->write('Disposal.can_edit', true);
		else
			$this->Session->write('Disposal.can_edit', false);
			
		/// Disposal Print ?
		if(($disposal['Disposal']['disposal_status_id'] == status_disposal_new_id || $disposal['Disposal']['disposal_status_id'] == status_disposal_request_for_approval_id) && 
			$id_group == fa_management_group_id)
			$this->Session->write('Disposal.can_print', true);
		else
			$this->Session->write('Disposal.can_print', false);
		
		/// Disposal Cancel
		if(($disposal['Disposal']['disposal_status_id'] == status_disposal_request_for_approval_id && $id_group == fa_supervisor_group_id) ||
			$id_group == admin_group_id)
			$this->Session->write('Disposal.can_cancel', true);
			
		else if(($disposal['Disposal']['disposal_status_id'] == status_disposal_approved_by_supervisor_id && $id_group == fincon_group_id) ||
			$id_group == admin_group_id)
			$this->Session->write('Disposal.can_cancel', true);
		
		else
			$this->Session->write('Disposal.can_cancel', false);
		
		/// Disposal Reject
		if(($disposal['Disposal']['disposal_status_id'] == status_disposal_request_for_approval_id && $id_group == fa_supervisor_group_id) ||
			$id_group == admin_group_id)
			$this->Session->write('Disposal.can_reject', true);
			
		else if(($disposal['Disposal']['disposal_status_id'] == status_disposal_approved_by_supervisor_id && $id_group == fincon_group_id) ||
			$id_group == admin_group_id)
			$this->Session->write('Disposal.can_reject', true);
		
		else
			$this->Session->write('Disposal.can_reject', false);
		
		/// Disposal Archive
		if(($disposal['Disposal']['disposal_status_id'] == status_disposal_reject_id && $id_group == fa_management_group_id) ||
			$id_group == admin_group_id)
			$this->Session->write('Disposal.can_archive', true);
		
		else
			$this->Session->write('Disposal.can_archive', false);
			
		/// Disposal can_reject_notes
		if((!empty($disposal['Disposal']['reject_notes']) && $id_group == fa_management_group_id) ||
			$id_group == admin_group_id)
			$this->Session->write('Disposal.can_reject_notes', true);
			
		else if((!empty($disposal['Disposal']['reject_notes']) && $id_group == fa_supervisor_group_id) ||
			$id_group == admin_group_id)
			$this->Session->write('Disposal.can_reject_notes', true);
		
		else if((!empty($disposal['Disposal']['reject_notes']) && $id_group == fincon_group_id) ||
			$id_group == admin_group_id)
			$this->Session->write('Disposal.can_reject_notes', true);
		
		else
			$this->Session->write('Disposal.can_reject_notes', false);
			
		/// Disposal can_cancel_notes
		if((!empty($disposal['Disposal']['cancel_notes']) && $id_group == fa_management_group_id) ||
			$id_group == admin_group_id)
			$this->Session->write('Disposal.can_cancel_notes', true);
			
		else if((!empty($disposal['Disposal']['cancel_notes']) && $id_group == fa_supervisor_group_id) ||
			$id_group == admin_group_id)
			$this->Session->write('Disposal.can_cancel_notes', true);
		
		else if((!empty($disposal['Disposal']['cancel_notes']) && $id_group == fincon_group_id) ||
			$id_group == admin_group_id)
			$this->Session->write('Disposal.can_cancel_notes', true);
		
		else
			$this->Session->write('Disposal.can_cancel_notes', false);
		
		/// can Disposal Posting journal?
		if(($disposal['Disposal']['disposal_status_id'] == status_disposal_approved_by_supervisor_id && $id_group == fincon_group_id))
			$this->Session->write('Disposal.can_posting_disposal_journal', true);
		else
			$this->Session->write('Disposal.can_posting_disposal_journal', false);
		
		$approveLink = $this->get_approve_link($id, $disposal, $id_group);
		
		$this->set('disposal', $this->Disposal->read(null, $id));
		$types=$this->Disposal->DisposalType->find('list');
		$assetCategories = $this->Disposal->DisposalDetail->AssetDetail->AssetCategory->find('list',   array('conditions'=>array('is_asset'=>1)));
		$this->set(compact('approveLink', 'assetCategories','types' , 'type'));
	}
	
	function view_pdf($id = null) 
    { 
       //cek id disposal
		if (!$id) {
			$this->Session->setFlash(__('Invalid Disposal', true));
			$this->redirect(array('action' => 'index'));
		}
		
		/* //Add is_printed=1
		if (!empty($id)) {
			$data['Disposal']['id'] = $id;
			$data['Disposal']['is_printed'] = 1;
			$this->Disposal->save($data);
		} */
		
        Configure::write('debug',0); // Otherwise we cannot use this method while developing 
		$disposal=$this->Disposal->read(null, $id);
		$this->Session->write('Disposal.id', $id);
		$this->set('disposal', $disposal);
		$copyright_id = $this->configs['copyright_id'];
		$departments = $this->Disposal->Department->find('list');
		$businessTypes = $this->Disposal->BusinessType->find('list');
		$costCenters = $this->Disposal->CostCenter->find('list');
		//$cc 			= $this->Disposal->query('select a.id,a.name,b.t24_dao from cost_centers a left join cost_center_to_daos b on b.cost_center_id = a.id where a.remarks = "Y" order by a.name');
		//foreach($cc as $data){
		//	if($data[0]['t24_dao']){
		//		$costCenters[ $data[0]['id'] ]	= $data[0]['name'] . " - " .$data[0]['t24_dao'];
		//	}else{
		//		$costCenters[ $data[0]['id'] ]	= $data[0]['name'];
		//	}				
		//}
		//$assetDetails = $this->Disposal->DisposalDetail->find('all');
		$assetCategories = $this->Disposal->DisposalDetail->AssetDetail->AssetCategory->find('list',  array('conditions'=>array('is_asset'=>1)));
		$this->set(compact('assetCategories','departments','businessTypes','costCenters','npbs', 'copyright_id'));
        $this->layout = 'pdf'; //this will use the pdf.ctp layout 
        $this->render(); 
    } 	
	
	function get_approve_link($id, $disposal, $id_group){
		$this->Session->write('Disposal.is_fa_management_user', $this->Session->read('Security.permissions') == fa_management_group_id ? true : false);
		$this->Session->write('Disposal.is_fa_supervisor_user', $this->Session->read('Security.permissions') == fa_supervisor_group_id ? true : false);
		$this->Session->write('Disposal.is_fincon_user', $this->Session->read('Security.permissions') == fincon_group_id ? true : false);			

	
		$group	= $this->Disposal->query('select * from groups where id="'.$id_group.'"');
		
		if($id_group  == fa_management_group_id && $disposal['Disposal']['disposal_status_id']==status_disposal_new_id)
			{
				$approveLink = array('label'=>__('Request For Approval',true), 
				'options'=>array('action' => 'approve_disposal/' . status_disposal_request_for_approval_id , $id));
			}
		else if($id_group  == fa_supervisor_group_id && $disposal['Disposal']['disposal_status_id']==status_disposal_request_for_approval_id)
			{
				$approveLink = array('label'=>__('Approve by Supervisor',true),
				'options'=>array('action' => 'approve_spv/'. status_disposal_approved_by_supervisor_id , $id)); 
			}
		/* 
		else if($id_group  == fincon_group_id && $disposal['Disposal']['disposal_status_id']==status_disposal_approved_by_supervisor_id)
			{
				$approveLink = array('label'=>__('Disposal Finish',true),
				'options'=>array('action' => 'approve_disposal/'. status_disposal_finish_id , $id)); 
			}
		else if($id_group  == fincon_group_id && $disposal['Disposal']['disposal_status_id']==status_disposal_finish_id)
			{
				$journal_group_id = $disposal['Disposal']['disposal_type_id']==type_disposal_write_off_id ? journal_group_write_off_id : journal_group_sales_id;
				$approveLink = array('label'=>__('Disposal Journal Posting',true),
				'options'=>array('controller'=>'journal_transactions','action' => 'prepare_posting/disposal' , $journal_group_id, $id)); 
			} 
		*/		
		else
			{
				$approveLink = array('label'=>__('Back',true), 'options'=>array('action'=>'index'));
			}

		return $approveLink;
	}
	
	function approve_disposal($level,$id) {
		$disposal = $this->Disposal->read(null, $id);
		if (!empty($disposal['DisposalDetail']))
		{
			$this->data['Disposal']['id']=$id;
			$this->data['Disposal']['disposal_status_id']=$level;
			//$this->data['disposal']['approval_info']=date("Y-m-d H:i:s"). ':Approved by:'.$this->Session->read('Userinfo.username');
			if($level == status_disposal_approved_by_supervisor_id){
			$this->data['Disposal']['approved_by'] 		= $this->Session->read('Userinfo.username');
			$this->data['Disposal']['approved_date']    = date('Y-m-d H:i:s');
			}
			if ($this->Disposal->save($this->data)) {
				$this->Session->setFlash(__('The disposal has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index', $this->Session->read('Disposal.disposal_type')));
			} else {
				$this->Session->setFlash(__('The disposal could not be saved. Please, try again.', true));
			}
			$this->edit($id);
		}
		else
		{
			$this->Session->setFlash(__('The disposal detail could not be save. Please, try again. and make sure the detail is filled', true));
			$this->redirect(array('action' => 'view', $id));
		}
	}

	function approve_spv($level,$id) {
		$disposal = $this->Disposal->read(null, $id);
		if (!empty($disposal['DisposalDetail']))
		{
			$min_asset_value = $this->configs['min_asset_value'];
			$price = $this->Disposal->DisposalDetail->find('count', array('conditions'=>array('DisposalDetail.price >'=>$min_asset_value, 'DisposalDetail.disposal_id'=>$id)));
			if($price == 0){
				$this->data['Disposal']['id']=$id;
				$this->data['Disposal']['disposal_status_id']=status_disposal_finish_id;
				$this->deleteAsset($id);
			}else{
				$this->data['Disposal']['id']=$id;
				$this->data['Disposal']['disposal_status_id']=$level;
			}
			if($level == status_disposal_approved_by_supervisor_id){
			$this->data['Disposal']['approved_by'] 		= $this->Session->read('Userinfo.username');
			$this->data['Disposal']['approved_date']    = date('Y-m-d H:i:s');
			}
			if ($this->Disposal->save($this->data)) {
				$this->Session->setFlash(__('The disposal has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index', $this->Session->read('Disposal.disposal_type')));
			} else {
				$this->Session->setFlash(__('The disposal could not be saved. Please, try again.', true));
			}
			$this->edit($id);
		}
		else
		{
			$this->Session->setFlash(__('The disposal detail could not be save. Please, try again. and make sure the detail is filled', true));
			$this->redirect(array('action' => 'view', $id));
		}
	}
	function deleteAsset($id)
	{
		$disDetails = $this->Disposal->read(null, $id);
		foreach($disDetails['DisposalDetail']  as $disDetail)
		{
			$assetDetail = array();
            $asset = array();
			
			$asset_detail_id = $disDetail['asset_detail_id'];
			$asset_detail = new AssetDetail;
			$assetDetail = $asset_detail->read(null, $asset_detail_id);
			if (empty($assetDetail)) {
				debug('cannot find assetDetail with id ' . $asset_detail_id);
				die;
			}
			/*********************
			delete asset detail
			*********************/
            $this->Disposal->query('delete from asset_details where id='. $asset_detail_id);
			
			/****************************
			OR updating asset_details ada=T
			*****************************/
			//$ADA = 'T';
			//$sql='update asset_details set ada="'.$ADA.'" where id='. $disDetail['asset_detail_id'] ;
			//$this->JournalTransaction->query($sql);	
			
			$asset['Asset'] = $assetDetail['Asset'];
			$asset_id = $asset['Asset']['id'];
			/******************
			updating assets qty
			******************/
			$sql = 'update assets set qty=qty-1 where id="' . $asset_id . '"';
			$this->log('updating old asset qty: ' . $sql);
			$this->Disposal->query($sql);
			/******************
			delete assets qty == 0
			******************/
			$sql = 'delete from assets where qty=0 and id="' . $asset_id . '"';
			$this->log('deleting old asset if qty=0: ' . $sql);
			$this->Disposal->query($sql);				
		}
	}
	function add($type=type_disposal_write_off_id) {
		
		//condision type writeoff and sales
		if ($type==type_disposal_write_off_id)
		{
			$this->Session->write('Disposal.disposal_type', type_disposal_write_off_id);
		}
		else 
		{
			$this->Session->write('Disposal.disposal_type', type_disposal_sales_id);
		}
		
		if (!empty($this->data)) {
			if($this->data['CostCenter']['name'] == '')
				$this->data['Disposal']['cost_center_id'] = null;
				$this->Disposal->create();
			if ($this->Disposal->save($this->data)) {
				$this->Session->setFlash(__('The disposal has been send', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'view', $this->Disposal->id));
			} else {
				$this->Session->setFlash(__('The disposal could not be saved. Please, try again.', true));
			}
		}
		$newId = $this->Disposal->getNewId();
		$departments = $this->Disposal->Department->find('list');
		$businessTypes = $this->Disposal->BusinessType->find('list');
		$costCenters = $this->Disposal->CostCenter->find('list');
		//$cc 			= $this->Disposal->query('select a.id,a.name,b.t24_dao from cost_centers a left join cost_center_to_daos b on b.cost_center_id = a.id where a.remarks = "Y" order by a.name');
		//foreach($cc as $data){
		//	if($data[0]['t24_dao']){
		//		$costCenters[ $data[0]['id'] ]	= $data[0]['name'] . " - " .$data[0]['t24_dao'];
		//	}else{
		//		$costCenters[ $data[0]['id'] ]	= $data[0]['name'];
		//	}				
		//}
		$statuses = $this->Disposal->DisposalStatus->find('list');
		$types = $this->Disposal->DisposalType->find('list');
		$moduleName = 'Fixed Assets > Disposal > New Disposal ' . ucwords($types[$type]);
		$this->set('title_for_layout',  $this->lastSegment($moduleName));
		$this->set(compact('newId', 'departments', 'statuses', 'types', 'type', 'businessTypes', 'costCenters', 'moduleName'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid disposal', true));
			$this->redirect(array('action' => 'index'));
		}

		
		$disposal = $this->Disposal->read(null, $id);
		$this->Session->write('Disposal.id', $id);
		$type = $disposal['Disposal']['disposal_type_id'];
		
		if (!empty($this->data)) {
			if ($this->Disposal->save($this->data)) {
				$this->Session->setFlash(__('The disposal has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'view', $id));
			} else {
				$this->Session->setFlash(__('The disposal could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Disposal->read(null, $id);
		}
		
		//$newId = $this->Disposal->getNewId();
		$departments = $this->Disposal->Department->find('list');
		$businessTypes = $this->Disposal->BusinessType->find('list');
		$costCenters = $this->Disposal->CostCenter->find('list');
		//$cc 			= $this->Disposal->query('select a.id,a.name,b.t24_dao from cost_centers a left join cost_center_to_daos b on b.cost_center_id = a.id where a.remarks = "Y" order by a.name');
		//foreach($cc as $data){
		//	if($data[0]['t24_dao']){
		//		$costCenters[ $data[0]['id'] ]	= $data[0]['name'] . " - " .$data[0]['t24_dao'];
		//	}else{
		//		$costCenters[ $data[0]['id'] ]	= $data[0]['name'];
		//	}				
		//}
		$statuses = $this->Disposal->DisposalStatus->find('list');
		$types = $this->Disposal->DisposalType->find('list');
		$this->set(compact('newId', 'departments', 'statuses', 'types', 'type','businessTypes','costCenters'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for disposal', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Disposal->delete($id)) {
			$this->Session->setFlash(__('Disposal deleted', true), 'default', array('class'=>'ok'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Disposal was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	
	function reject($id = null){
		//view Disposal
		if (!$id) {
			$this->Session->setFlash(__('Invalid disposal', true));
			$this->redirect(array('action' => 'index'));
		}
		
		$this->Disposal->read(null, $id);
		
		//Add Notes Reject Disposal and Change Status
		if (!empty($this->data)) {
			$this->data['Disposal']['id'] = $id;
			$this->data['Disposal']['disposal_status_id'] = status_disposal_reject_id;
			if ($this->Disposal->save($this->data)) {
				$this->Session->setFlash(__('The disposal has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The disposal could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$disposal = $this->data = $this->Disposal->read(null, $id);
		}
		$departments = $this->Disposal->Department->find('list');
		$this->set(compact('disposal', 'departments'));
		
	}
	
	function cancel($id = null){
		//view Disposal
		if (!$id) {
			$this->Session->setFlash(__('Invalid disposal', true));
			$this->redirect(array('action' => 'index'));
		}
		
		$this->Disposal->read(null, $id);
		
		//Add Notes Cancel Disposal and Change Status
		if (!empty($this->data)) {
			$this->data['Disposal']['id'] = $id;
			$this->data['Disposal']['disposal_status_id'] = status_disposal_new_id;
			if ($this->Disposal->save($this->data)) {
				$this->Session->setFlash(__('The disposal has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The disposal could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$disposal = $this->data = $this->Disposal->read(null, $id);
		}
		$departments = $this->Disposal->Department->find('list');
		$this->set(compact('disposal', 'departments'));
		
	}
	
	function archive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid disposal', true));
			$this->redirect(array('action' => 'index'));
		}
		
		//reset npb and details
		//$sql='update npb_details set qty_filled=0, qty_unfilled=qty where movement_id='. $id ;
		//$this->Movement->query($sql);			
		
		//$movement=$this->Movement->read(null, $id);
		//foreach($movement['NpbDetail'] as $npbDetail)
		//{
			//$sql='update npb_details set movement_id=NULL where id="'.$npbDetail['id'].'"';
			//$this->Movement->query($sql);			
		//}
		
			$this->data['Disposal']['id'] = $id;
			$this->data['Disposal']['disposal_status_id'] = status_disposal_archive_id;
			if ($this->Disposal->save($this->data)) {
				$this->Session->setFlash(__('The disposal has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The disposal could not be saved. Please, try again.', true));
			}
	}
	
}
?>
