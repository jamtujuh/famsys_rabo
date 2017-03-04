<?php

App::import('Model','JournalGroup');

class InlogsController extends AppController {

	var $name = 'Inlogs';
	var $helpers = array('Ajax', 'Javascript', 'Time');
	var $components = array('RequestHandler');

	function index($inlog_status_id=null, $inlog_supplier_id=null, $journal_groups_id=null) {
		$this->Inlog->recursive = 0;
		$layout=$this->data['Inlog']['layout'];
		
		if($inlog_status_id || ($inlog_status_id =$this->data['Inlog']['inlog_status_id']) ) {
			$conditions[] = array('Inlog.inlog_status_id'=>$inlog_status_id);
		}
			
		if($inlog_supplier_id || ($inlog_supplier_id=$this->data['Inlog']['supplier_id']) ) {
			$conditions[] = array('Inlog.supplier_id'=>$inlog_supplier_id);
		}

		//DIT KOMEN DARI SINI - FILTERS
		if($journal_groups_id || ($journal_groups_id=$this->data['Inlog']['journal_groups_id']) ) {
			$inlogs_list_category = $this->Inlog->inlogs_list_category($journal_groups_id);
	 		if($journal_groups_id!=''){
				$str = 'Inlog.id';
				$array = array(-99);
				for($i=0;$i<count($inlogs_list_category);$i++){
					array_push($array, $inlogs_list_category[$i][0]['id']);
				}
				$conditions[] = array('Inlog.id'=> $array);

			}
		}
		//DIT KOMEN SAMPE SINI - FILTERS

		$conditions[] = array('Inlog.inlog_status_id !='=>status_inlog_archive_id);
		list($date_start,$date_end) = $this->set_date_filters('Inlog');
		$conditions[] = array('date >=' => ($date_start['year'] . '-' . $date_start['month'] . '-' . $date_start['day']) , 
				'date <=' => ($date_end['year'] . '-' . $date_end['month'] . '-' . $date_end['day']) );
		if($layout=='pdf' || $layout=='xls'){
			$con = $this->Inlog->find('all', array('conditions'=>$conditions));
		}else{
			$this->paginate = array('order'=>'Inlog.id', 'paramType' => 'querystring');
			$con = $this->paginate($conditions);
		}	
//print_r($this->Inlog);		
		//echo "<pre>";
		//var_dump($con);
		//echo "</pre>";die();
		$this->set('inlogs', $con);
		$copyright_id  = $this->configs['copyright_id'];
		$suppliers = $this->Inlog->Supplier->find('list');
		$inlogStatuses = $this->Inlog->InlogStatus->find('list', array('conditions' =>array('InlogStatus.id !=' => status_inlog_archive_id))); //archive
		$pos = $this->Inlog->Po->find('list');

		$journal_group = new JournalGroup;

		$journal_groups = $journal_group->get_active_journal_group();

		$this->set(compact('suppliers', 'pos', 'inlog_supplier_id', 'inlog_po_id', 'date_start', 'date_end',
		'inlogStatuses', 'inlog_status_id', 'copyright_id', 'journal_groups', 'journal_groups_id'));
		
		
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
		$this->Inlog->recursive = 0;
			
		if($inlog_supplier_id || ($inlog_supplier_id=$this->data['Inlog']['supplier_id']) ) {
			$conditions[] = array('supplier_id'=>$inlog_supplier_id);
		}
		
		if($inlog_po_id || ($inlog_po_id=$this->data['Inlog']['po_id']) ) {
			$conditions[] = array('po_id'=>$inlog_po_id);
		}
		
		list($date_start,$date_end) = $this->set_date_filters('Inlog');
		$conditions[] = array('date >=' => ($date_start['year'] . '-' . $date_start['month'] . '-' . $date_start['day']) , 
				'date <=' => ($date_end['year'] . '-' . $date_end['month'] . '-' . $date_end['day']) );
		
		$this->set('inlogs', $this->paginate($conditions));
		
		$suppliers = $this->Inlog->Supplier->find('list');
		$pos = $this->Inlog->Po->find('list');
		$this->set(compact('suppliers', 'pos', 'inlog_supplier_id', 'inlog_po_id', 'date_start', 'date_end'));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid inlog', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->write('Inlog.id', $id);
		$inlog=$this->Inlog->read(null, $id);
		
		$this->Session->write('Inlog.can_approve',  false);
		$this->Session->write('Inlog.can_process', false);
		$this->Session->write('Inlog.can_request_approval', false);
		// $this->Session->write('Inlog.can_print_delivery_notes', false);
		// $this->Session->write('Inlog.can_reprint_delivery_notes', false);			
		
		if($this->Session->read('Security.permissions')==stock_management_group_id){

			$this->Session->write('Inlog.can_process', $inlog['Inlog']['inlog_status_id']==status_inlog_approved_id?true:false);
			//$this->Session->write('Inlog.can_request_approval', $inlog['Inlog']['inlog_status_id']==status_inlog_sent_to_stock_management_id? true : false);
			$this->Session->write('Inlog.can_request_approval', $inlog['Inlog']['inlog_status_id']==status_inlog_draft_id? true : false);
			// $this->Session->write('Inlog.can_print_delivery_notes', $inlog['Inlog']['inlog_status_id']==status_inlog_approved_id&&$inlog['Inlog']['is_printed']==0?true:false);
			// $this->Session->write('Inlog.can_reprint_delivery_notes', $inlog['Inlog']['inlog_status_id']==status_inlog_approved_id&&$inlog['Inlog']['is_printed']==1?true:false);
		}
		else if($this->Session->read('Security.permissions')==stock_supervisor_group_id){
			$this->Session->write('Inlog.can_approve', $inlog['Inlog']['inlog_status_id']==status_inlog_sent_to_supervisor_id? true : false);
		}
		else if($this->Session->read('Security.permissions')==gs_group_id)
		{
			$this->Session->write('Inlog.can_send_to_stock_management', $inlog['Inlog']['inlog_status_id']==status_inlog_draft_id?true:false);
		}		
		$this->set('inlog', $inlog);
		$assetCategories = $this->Inlog->InlogDetail->Item->AssetCategory->find('list');
		$items = $this->Inlog->InlogDetail->Item->find('list');
		$units = $this->Inlog->InlogDetail->Item->Unit->find('list');
		$this->set(compact('assetCategories', 'items', 'units', 'inlog'));
	}

	function add($invoice_id=null) {
		$delivery_order_id=null;
		
		if (!empty($this->data)) {
			$this->Inlog->create();
			if ($this->Inlog->save($this->data)) {
				$inlog_id = $this->Inlog->id;
				
				//add inlog from invoice
				if($invoice_id=$this->data['Inlog']['invoice_id'])
				{
					$invoice=$this->Inlog->Invoice->read(null, $invoice_id);	
					foreach ($invoice['InvoiceDetail'] as $invoiceDetail)
					{
						$d['InlogDetail']=$invoiceDetail;
						$d['InlogDetail']['inlog_id']=$inlog_id;
						unset($d['InlogDetail']['id']);
						$this->Inlog->InlogDetail->create();
						if(!$this->Inlog->InlogDetail->save($d))
							$this->log('failed create inlog detail:'.json_encode($d));
						else
							$this->log('created inlog detail:'.json_encode($d));
					}
				}		
				
				//add from DO
				if($delivery_order_id=$this->data['Inlog']['delivery_order_id'])
				{
					$deliveryOrder=$this->Inlog->DeliveryOrder->read(null, $delivery_order_id);	
					$vat_rate = $deliveryOrder['DeliveryOrder']['vat_rate'];
					foreach ($deliveryOrder['DeliveryOrderDetail'] as $deliveryOrderDetail)
					{
						if($deliveryOrderDetail['qty_received']==0)
							continue;
							
						$d['InlogDetail']=$deliveryOrderDetail;
						$d['InlogDetail']['inlog_id']=$inlog_id;
						$d['InlogDetail']['qty']=$deliveryOrderDetail['qty_received'];
						$d['InlogDetail']['price']=$deliveryOrderDetail['is_vat'] ?$deliveryOrderDetail['price_cur'] * (100 + $vat_rate)/100 :$deliveryOrderDetail['price_cur'];
						$d['InlogDetail']['amount']=$deliveryOrderDetail['price'] * $d['InlogDetail']['qty'];
						$d['InlogDetail']['npb_id']=$deliveryOrderDetail['npb_id'];
						
						if($deliveryOrder['DeliveryOrder']['currency_id'] == 1){
							$d['InlogDetail']['can_ledger'] = 0;
						}else{
							$d['InlogDetail']['can_ledger'] = 1;
						}
						
						unset($d['InlogDetail']['id']);
						$this->Inlog->InlogDetail->create();
						if(!$this->Inlog->InlogDetail->save($d))
							$this->log('failed create inlog detail:'.json_encode($d));
						else
							$this->log('created inlog detail:'.json_encode($d));
					}
					$this->Inlog->DeliveryOrder->set('convert_asset', 1);
					$this->Inlog->DeliveryOrder->save();
				}			
				
				$this->Session->setFlash(__('The inlog has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'view', $this->Inlog->id));
			} else {
				$this->Session->setFlash(__('The inlog could not be saved. Please, try again.', true));
			}
		}
		
		if($invoice_id)
		{
			$invoice=$this->Inlog->Invoice->read(null, $invoice_id);
			//$po_id=$invoice[''];
			$invoice_id=$invoice['Invoice']['id'];
			$invoice_no=$invoice['Invoice']['no'];
			$supplier_id=$invoice['Invoice']['supplier_id'];
			$supplier_name=$invoice['Supplier']['name'];
		}
		if($delivery_order_id || isset($this->passedArgs['delivery_order_id']) )
		{
			if(isset($this->passedArgs['delivery_order_id'])) $delivery_order_id=$this->passedArgs['delivery_order_id'];
			$deliveryOrder 	= $this->Inlog->DeliveryOrder->read(null, $delivery_order_id);
			$supplier_id 	= $deliveryOrder['DeliveryOrder']['supplier_id'];
			$supplier_name 	= $deliveryOrder['Supplier']['name'];
			$po_no  		= $deliveryOrder['Po']['no'];
			$po_id  		= $deliveryOrder['Po']['id'];
			$delivery_order_no=$deliveryOrder['DeliveryOrder']['no'];
			
		}		
		else
		{
			$po_id=null;
			$invoice_id=null;
			$supplier_id=null;
		}
		
		$newId = $this->Inlog->getNewId();
		$suppliers = $this->Inlog->Supplier->find('list');
		$this->set(compact('newId', 'suppliers', 
			'po_id', 'po_no','invoice_id','invoice_no','supplier_id',
			'delivery_order_id','delivery_order_no',
			'invoice_no','supplier_name'
			));
	}
	
	function getNewID2(){
		return $this->Inlog->getNewId();
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid inlog', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Inlog->save($this->data)) {
				$this->Session->setFlash(__('The inlog has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The inlog could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Inlog->read(null, $id);
		}
		$suppliers = $this->Inlog->Supplier->find('list');
		$pos = $this->Inlog->Po->find('list');
		$this->set(compact('suppliers', 'pos'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for inlog', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Inlog->delete($id)) {
			$this->Session->setFlash(__('Inlog deleted', true), 'default', array('class'=>'ok'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Inlog was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function update_status($id=null, $new_status=null)
	{
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid inlog', true));
			$this->redirect(array('action' => 'index'));
		}
		$inlog=$this->Inlog->read(null, $id);
		$this->Inlog->set('inlog_status_id', $new_status);
		
		if($new_status == status_inlog_approved_id){
		$this->data['Inlog']['approved_by'] 	= $this->Session->read('Userinfo.username');
		$this->data['Inlog']['approved_date'] 	= date('Y-m-d H:i:s');
		}
		if ($this->Inlog->save($this->data)) {
			$this->Session->setFlash(__('The inlog status has been saved', true), 'default', array('class'=>'ok'));
			$this->redirect(array('action' => 'index', 3));
		} else {
			$this->Session->setFlash(__('The inlog status could not be saved. Please, try again.', true));
		}

		$this->redirect(array('action' => 'index', 3));		
	}
	
	function cancel($id = null){
		//view Inlog
		if (!$id) {
			$this->Session->setFlash(__('Invalid Inlog', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Inlog->read(null, $id);
		
		//Add Notes Reject Inlog and Change Status
		if (!empty($this->data)) {
			$this->data['Inlog']['id'] = $id;
			$this->data['Inlog']['inlog_status_id'] = status_outlog_draft_id;
			if ($this->Inlog->save($this->data)) {
				$this->Session->setFlash(__('The Inlog has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Inlog could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$inlog = $this->data = $this->Inlog->read(null, $id);
		}
		$departments = $this->Inlog->Po->Department->find('list');
		$assetCategories = $this->Inlog->InlogDetail->Item->AssetCategory->find('list');
		$units = $this->Inlog->InlogDetail->Item->Unit->find('list');
		$items = $this->Inlog->InlogDetail->Item->find('list');
		$outlogStatus = $this->Inlog->InlogStatus->find('list');
		$this->set(compact('inlog', 'departments', 'outlogStatus', 'assetCategories', 'units', 'items'));
	}

}
?>
