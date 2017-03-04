<?php
class InventoryLedgersController extends AppController {

	var $name = 'InventoryLedgers';
	var $helpers = array('Ajax', 'Javascript', 'Time', 'Paginator');
	var $components = array('RequestHandler');
	var $paginate = array('limit' => 25, 'page' => 1, 'order'=>array('InventoryLedger.date'=>'ASC'));

	function index($inv_item_id=null, $conditions=null) {
		$this->paginate['InventoryLedger']=array('order'=>'InventoryLedger.date asc, InventoryLedger.id asc');		
		$this->InventoryLedger->recursive = 0;
		$layout=$this->data['InventoryLedger']['layout'];
		if(!empty($this->data))
		{
			if($this->data['Item']['name'] == '')
				$this->data['InventoryLedger']['item_id'] = null;
			$this->Session->write('InventoryLedger.item_id',$this->data['InventoryLedger']['item_id']);
		}

		
		$inv_item_id=$this->Session->read('InventoryLedger.item_id');
		$conditions[] = array('InventoryLedger.item_id'=>$inv_item_id);
		
		list($date_start,$date_end) = $this->set_date_filters('InventoryLedger');
		$conditions[] = array('InventoryLedger.date >=' => ($date_start['year'] . '-' . $date_start['month'] . '-' . $date_start['day']) , 
				'InventoryLedger.date <=' => ($date_end['year'] . '-' . $date_end['month'] . '-' . $date_end['day']) );
		
		$sql = 'SELECT sum(case in_out when "inlog" then qty when "retur" then qty when "supplierReplace" then qty else -1*qty end) as sum FROM inventory_ledgers where inventory_ledgers.date < "'.$date_start['year'].'-'.$date_start['month'].'-'.$date_start['day'].'" AND inventory_ledgers.item_id ="'.$inv_item_id.'"';
		$begining		 	= $this->InventoryLedger->query($sql);
		$beginning_balance  = $begining[0][0]['sum'];
		
		$sqls = 'SELECT sum(case in_out when "inlog" then qty when "retur" then qty when "supplierReplace" then qty else -1*qty end) as sum FROM inventory_ledgers where inventory_ledgers.date >= "'.$date_start['year'].'-'.$date_start['month'].'-'.$date_start['day'].'" AND inventory_ledgers.date <= "'.$date_end['year'].'-'.$date_end['month'].'-'.$date_end['day'].'" AND inventory_ledgers.item_id ="'.$inv_item_id.'"';
		$ending			 	= $this->InventoryLedger->query($sqls);
		$ending_balance     = $ending[0][0]['sum'] + $beginning_balance ;
		
		//****************************************************************
		if($layout=='pdf' || $layout=='xls'){
			$con = $this->InventoryLedger->find('all', array('conditions'=>$conditions));
		}else{
			$con = $this->paginate($conditions);
		}
		$this->set('inventoryLedgers', $con);
		$copyright_id  = $this->configs['copyright_id'];
		$items = $this->InventoryLedger->Item->find('list', array('conditions'=>array('asset_category_id in (select id from asset_categories where asset_category_type_id=2)')));
		$units 	= $this->InventoryLedger->Item->Unit->find('list');
		$this->set(compact('copyright_id', 'items', 'units', 'inv_item_id', 'date_start', 'date_end', 'beginning_balance', 'ending_balance'));
		
		
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
		if (!$id) {
			$this->Session->setFlash(__('Invalid inventory ledger', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('inventoryLedger', $this->InventoryLedger->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->InventoryLedger->create();
			if ($this->InventoryLedger->save($this->data)) {
				$this->Session->setFlash(__('The inventory ledger has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The inventory ledger could not be saved. Please, try again.', true));
			}
		}
		$items = $this->InventoryLedger->Item->find('list');
		$pos = $this->InventoryLedger->Po->find('list');
		$this->set(compact('items', 'pos'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid inventory ledger', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->InventoryLedger->save($this->data)) {
				$this->Session->setFlash(__('The inventory ledger has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The inventory ledger could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->InventoryLedger->read(null, $id);
		}
		$items = $this->InventoryLedger->Item->find('list');
		$pos = $this->InventoryLedger->Po->find('list');
		$this->set(compact('items', 'pos'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for inventory ledger', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->InventoryLedger->delete($id)) {
			$this->Session->setFlash(__('Inventory ledger deleted', true), 'default', array('class'=>'ok'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Inventory ledger was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function process_inv($doc=null, $id=null) 
	{
		$limit 	= '17:00:00';
		$timecurrent= date('H:i:s');
		//if($doc == 'inlog' && $this->configs['journal_cut_off'] > date('H:i:s'))
		if($doc == 'inlog' && $limit > $timecurrent;)
		{
			$inlogDetails = $this->InventoryLedger->InlogDetail->find('all',
					array('conditions' => array( 
					'Inlog.inlog_status_id'=>status_inlog_approved_id, 
					'Inlog.id'=>$id)));
			//print_r($inlogDetails);
			echo "masuk";die();
			//exit();
			$data['InventoryLedger'] = array();
			if( !empty( $inlogDetails ) ) {
				
				foreach ($inlogDetails as $inlogDetail)
				{
					$data['InventoryLedger']['date']			= $inlogDetail['Inlog']['date'];
					$data['InventoryLedger']['item_id']			= $inlogDetail['InlogDetail']['item_id'];
					$data['InventoryLedger']['qty']				= $inlogDetail['InlogDetail']['qty'];
					$data['InventoryLedger']['in_out']			= 'inlog';
					$data['InventoryLedger']['price']			= $inlogDetail['InlogDetail']['price'];
					$data['InventoryLedger']['amount']			= $inlogDetail['InlogDetail']['amount'];
					$data['InventoryLedger']['inlog_id']		= $inlogDetail['Inlog']['id'];
					$data['InventoryLedger']['npb_id']			= $inlogDetail['InlogDetail']['npb_id'];
					$data['InventoryLedger']['department_id']			= $inlogDetail['Inlog']['department_id'];
					$data['InventoryLedger']['business_type_id']		= $inlogDetail['Inlog']['business_type_id'];
					$data['InventoryLedger']['cost_center_id']			= $inlogDetail['Inlog']['cost_center_id'];
					$data['InventoryLedger']['inlog_detail_id']			= $inlogDetail['InlogDetail']['id'];
					$data['InventoryLedger']['po_id']					= $inlogDetail['Inlog']['po_id'];
					$data['InventoryLedger']['date_of_transaction']		= date('Y-m-d');
					
					$this->getNewAverage($inlogDetail['InlogDetail']['item_id'], $inlogDetail['InlogDetail']['qty'], $inlogDetail['InlogDetail']['price']);

					$this->InventoryLedger->create();
					$this->InventoryLedger->save($data);
					
					//set posting to 1 where 
					$inlogDetail['InlogDetail']['posting']		= 1;
					$this->InventoryLedger->InlogDetail->save($inlogDetail);
					
					$inlog_id = $inlogDetail['Inlog']['id'];
					
				}
				$inlog = $this->InventoryLedger->Inlog->read(null, $id);
				
				if($inlog['Inlog']['inlog_status_id']==status_inlog_approved_id){
					$journal = $this->InventoryLedger->insert_to_journal_csv($doc, $id, journal_group_inlog_id);
					$this->generateCsv($journal);
				}else{
					$this->redirect(array('action' => 'process_inv'));
				}
				$this->InventoryLedger->Inlog->read(null, $id);
				$this->InventoryLedger->Inlog->set('inlog_status_id',status_inlog_finish_id);
				$this->InventoryLedger->Inlog->save();
			}
		}
		elseif($doc == 'outlog' && $this->configs['journal_cut_off'] > date('H:i:s'))
		{
			/****************************
			//source from outlog
			****************************/
			$outlogDetails = $this->InventoryLedger->OutlogDetail->find('all',
					array('conditions' => array('Outlog.outlog_status_id'=>status_outlog_approved_id, 'Outlog.id'=>$id)));
			$data['InventoryLedger'] = array();
			
			if( !empty( $outlogDetails ) ) {
				$valid = $this->checkValid($outlogDetails);
				if($valid)
				{ 
					foreach ($outlogDetails as $outlogDetail)
					{
						$item = $this->InventoryLedger->Item->read(null, $outlogDetail['OutlogDetail']['item_id']);
						$data['InventoryLedger']['date']			= $outlogDetail['Outlog']['date'];
						$data['InventoryLedger']['item_id']			= $outlogDetail['OutlogDetail']['item_id'];
						$data['InventoryLedger']['qty']				= $outlogDetail['OutlogDetail']['qty'];
						$data['InventoryLedger']['in_out']			= 'outlog';
						$data['InventoryLedger']['price']			= $item['Item']['avg_price'];
						$data['InventoryLedger']['amount']			= $outlogDetail['OutlogDetail']['amount'];
						$data['InventoryLedger']['outlog_id']		= $outlogDetail['Outlog']['id'];
						$data['InventoryLedger']['department_id']		= $outlogDetail['Outlog']['department_id'];
						$data['InventoryLedger']['business_type_id']	= $outlogDetail['Outlog']['business_type_id'];
						$data['InventoryLedger']['cost_center_id']		= $outlogDetail['Outlog']['cost_center_id'];
						$data['InventoryLedger']['npb_id']				= $outlogDetail['OutlogDetail']['npb_id'];
						$data['InventoryLedger']['retur_id']			= $outlogDetail['OutlogDetail']['retur_id'];
						$data['InventoryLedger']['outlog_detail_id']	= $outlogDetail['OutlogDetail']['id'];
						$data['InventoryLedger']['date_of_transaction']	= date('Y-m-d');
						$data['InventoryLedger']['po_id']			= 0;
						
						$this->InventoryLedger->create();
						$this->InventoryLedger->save($data);
						
						//set posting to 1 
						$outlogDetail['OutlogDetail']['price']		= $item['Item']['avg_price'];
						$outlogDetail['OutlogDetail']['posting']	= 1;
						$this->InventoryLedger->OutlogDetail->save($outlogDetail);
						$outlog_id = $outlogDetail['Outlog']['id'];
					}
					$outlog = $this->InventoryLedger->Outlog->read(null, $id);
					$retur_id = $outlog['Outlog']['retur_id'];
					if($outlog['Outlog']['outlog_status_id']==status_outlog_approved_id){
						echo 'masuk';
						$journal = $this->InventoryLedger->insert_to_journal_csv($doc, $id);
						$this->generateCsv($journal);
						if($retur_id != 0){
						$this->InventoryLedger->Retur->id = $retur_id;
						$this->InventoryLedger->Retur->set('retur_status_id',status_retur_finish_id);
						$this->InventoryLedger->Retur->save();	
						}
					}else{
						$this->redirect(array('action' => 'process_inv'));
					}
					$this->InventoryLedger->Outlog->id = $id;
					$this->InventoryLedger->Outlog->set('outlog_status_id', status_outlog_finish_id);
					$this->InventoryLedger->Outlog->save();
				}
				else
				{
					$this->Session->setFlash(__('Outlog can not be processed because Some Qty Item Not Fulfill', true));
					$this->redirect(array('controller' => 'outlogs', 'action' => 'view', $id));
				}
			}
		}
		elseif($doc == 'supplierRetur' && $this->configs['journal_cut_off'] > date('H:i:s'))
		{
			/****************************
			//source from supplier retur
			****************************/
			$supplierReturDetails = $this->InventoryLedger->SupplierReturDetail->find('all',
					array('conditions' => array('SupplierRetur.id' => $id, 'SupplierRetur.supplier_retur_status_id'=>status_supplier_retur_approved_id)));
			$data['InventoryLedger'] = array();
			$supplierRetur = $this->InventoryLedger->SupplierRetur->read(null, $id);
			if( !empty( $supplierReturDetails ) ) {
				
				foreach ($supplierReturDetails as $supplierReturDetail)
				{
					$item = $this->InventoryLedger->Item->read(null, $supplierReturDetail['SupplierReturDetail']['item_id']);
					$data['InventoryLedger']['date']			= $supplierReturDetail['SupplierRetur']['date'];
					$data['InventoryLedger']['item_id']			= $supplierReturDetail['SupplierReturDetail']['item_id'];
					$data['InventoryLedger']['qty']				= $supplierReturDetail['SupplierReturDetail']['qty'];
					$data['InventoryLedger']['in_out']			= 'supplierRetur';
					$data['InventoryLedger']['price']			= $item['Item']['avg_price'];
					$data['InventoryLedger']['amount']			= $supplierReturDetail['SupplierReturDetail']['amount'];
					$data['InventoryLedger']['supplier_retur_id']			= $supplierReturDetail['SupplierRetur']['id'];
					$data['InventoryLedger']['department_id']				= $supplierReturDetail['SupplierRetur']['department_id'];
					$data['InventoryLedger']['business_type_id']			= $supplierReturDetail['SupplierRetur']['business_type_id'];
					$data['InventoryLedger']['cost_center_id']				= $supplierReturDetail['SupplierRetur']['cost_center_id'];
					$data['InventoryLedger']['supplier_retur_detail_id']	= $supplierReturDetail['SupplierReturDetail']['id'];
					if($supplierRetur['SupplierRetur']['retur_id'] != null){
					$data['InventoryLedger']['retur_id']					= $supplierReturDetail['SupplierRetur']['retur_id'];
					}
					$data['InventoryLedger']['date_of_transaction']			= date('Y-m-d');
					$data['InventoryLedger']['po_id']			= 0;
					
					$this->InventoryLedger->create();
					$this->InventoryLedger->save($data);
					
					$supplierReturDetail['SupplierReturDetail']['price']				= $item['Item']['avg_price'];					
					$supplierReturDetail['SupplierReturDetail']['posting']				= 1;					
					$this->InventoryLedger->SupplierReturDetail->save($supplierReturDetail);
					$supplier_retur_id = $supplierReturDetail['SupplierRetur']['id'];
				
					$supplierRetur = $this->InventoryLedger->SupplierRetur->read(null, $id);
					if($supplierRetur['SupplierRetur']['supplier_retur_status_id']==status_supplier_retur_approved_id){
						$journal = $this->InventoryLedger->insert_to_journal_csv($doc, $id, journal_group_supplier_retur_id);
						$this->generateCsv($journal);
						if($supplierRetur['SupplierRetur']['retur_id'] != null){
						$this->InventoryLedger->Retur->id = $supplierRetur['SupplierRetur']['retur_id'];
						$this->InventoryLedger->Retur->set('can_retur',1);
						$this->InventoryLedger->Retur->save();	
						}
					}else{
						$this->redirect(array('action' => 'process_inv'));
					} 
				}
				/* $this->InventoryLedger->SupplierRetur->id = $id;
				$this->InventoryLedger->SupplierRetur->set('supplier_retur_status_id', status_supplier_retur_processed_id);
				$this->InventoryLedger->SupplierRetur->save();		 */ 
				$sql = 'update supplier_returs set supplier_retur_status_id='.status_supplier_retur_processed_id.' where supplier_returs.id = '.$id.'';
				$this->InventoryLedger->query($sql);
			}
		}
		elseif($doc == 'supplierReplace' && $this->configs['journal_cut_off'] > date('H:i:s'))
		{
			/****************************
			//source from supplier replace
			****************************/
			$supplierReplaceDetails = $this->InventoryLedger->SupplierReplaceDetail->find('all',
					array('conditions' => array('SupplierReplace.id' => $id, 'SupplierReplace.supplier_replace_status_id'=>status_supplier_replace_approved_id)));
			 $data['InventoryLedger'] = array();
			
			if( !empty( $supplierReplaceDetails ) ) {
				
				foreach ($supplierReplaceDetails as $supplierReplaceDetail)
				{
					$item = $this->InventoryLedger->Item->read(null, $supplierReplaceDetail['SupplierReplaceDetail']['item_id']);
					$data['InventoryLedger']['date']			= $supplierReplaceDetail['SupplierReplace']['date'];
					$data['InventoryLedger']['item_id']			= $supplierReplaceDetail['SupplierReplaceDetail']['item_id'];
					$data['InventoryLedger']['qty']				= $supplierReplaceDetail['SupplierReplaceDetail']['qty'];
					$data['InventoryLedger']['in_out']			= 'supplierReplace';
					$data['InventoryLedger']['price']			=  $item['Item']['avg_price'];
					$data['InventoryLedger']['amount']			= $supplierReplaceDetail['SupplierReplaceDetail']['amount'];
					$data['InventoryLedger']['supplier_replace_id']			= $supplierReplaceDetail['SupplierReplace']['id'];
					$data['InventoryLedger']['department_id']				= $supplierReplaceDetail['SupplierReplace']['department_id'];
					$data['InventoryLedger']['business_type_id']			= $supplierReplaceDetail['SupplierReplace']['business_type_id'];
					$data['InventoryLedger']['cost_center_id']				= $supplierReplaceDetail['SupplierReplace']['cost_center_id'];
					$data['InventoryLedger']['supplier_replace_detail_id']	= $supplierReplaceDetail['SupplierReplaceDetail']['id'];
					$data['InventoryLedger']['supplier_retur_id']			= $supplierReplaceDetail['SupplierReplace']['supplier_retur_id'];
					$data['InventoryLedger']['date_of_transaction']	= date('Y-m-d');
					
					$this->InventoryLedger->create();
					$this->InventoryLedger->save($data);
					
					
					//set posting to 1 
					$supplierReplaceDetail['SupplierReplaceDetail']['price']				=  $item['Item']['avg_price'];;					
					$supplierReplaceDetail['SupplierReplaceDetail']['posting']				= 1;					
					$this->InventoryLedger->SupplierReplaceDetail->save($supplierReplaceDetail);
				} 
				$supplierReplace = $this->InventoryLedger->SupplierReplace->read(null, $id);
				$supplier_retur_id = $supplierReplace['SupplierReplace']['supplier_retur_id'];
					if($supplierReplace['SupplierReplace']['supplier_replace_status_id']==status_supplier_replace_approved_id){
						$journal = $this->InventoryLedger->insert_to_journal_csv($doc, $id, journal_group_supplier_replace_id);
						$this->generateCsv($journal);
						$this->InventoryLedger->SupplierRetur->id = $supplier_retur_id;
						$this->InventoryLedger->SupplierRetur->set('supplier_retur_status_id',status_supplier_retur_finish_id);
						$this->InventoryLedger->SupplierRetur->save();	 	
					}else{
						$this->redirect(array('action' => 'process_inv'));
					} 
				$this->InventoryLedger->SupplierReplace->id = $id;
				$this->InventoryLedger->SupplierReplace->set('supplier_replace_status_id',status_supplier_replace_finish_id);
				$this->InventoryLedger->SupplierReplace->save();	 	
			}
		}
		elseif($doc == 'retur' && $this->configs['journal_cut_off'] > date('H:i:s'))
		{
			/****************************
			//source from supplier retur
			****************************/
			$returDetails = $this->InventoryLedger->ReturDetail->find('all',
					array('conditions' => array('Retur.id' => $id , 'Retur.retur_status_id'=>status_retur_approved_by_branch_head_id)));
			$data['InventoryLedger'] = array();
			
			if( !empty( $returDetails ) ) {
				
				foreach ($returDetails as $returDetail)
				{
					$item = $this->InventoryLedger->Item->read(null, $returDetail['ReturDetail']['item_id']);
					$data['InventoryLedger']['date']			= $returDetail['Retur']['date'];
					$data['InventoryLedger']['item_id']			= $returDetail['ReturDetail']['item_id'];
					$data['InventoryLedger']['qty']				= $returDetail['ReturDetail']['qty'];
					$data['InventoryLedger']['in_out']			= 'retur';
					$data['InventoryLedger']['price']			= $item['Item']['avg_price'];
					$data['InventoryLedger']['amount']			= $returDetail['ReturDetail']['amount'];
					$data['InventoryLedger']['retur_id']		= $returDetail['Retur']['id'];
					$data['InventoryLedger']['department_id']	= $returDetail['Retur']['department_id'];
					$data['InventoryLedger']['business_type_id']= $returDetail['Retur']['business_type_id'];
					$data['InventoryLedger']['cost_center_id']	= $returDetail['Retur']['cost_center_id'];
					$data['InventoryLedger']['retur_detail_id']	= $returDetail['ReturDetail']['id'];
					$data['InventoryLedger']['date_of_transaction']	= date('Y-m-d');
					$data['InventoryLedger']['po_id']			= 0;
					
					$this->InventoryLedger->create();
					$this->InventoryLedger->save($data);
					
					//set posting to 1 
					$returDetail['ReturDetail']['price']		= $item['Item']['avg_price'];				
					$returDetail['ReturDetail']['posting']		= 1;					
					$this->InventoryLedger->ReturDetail->save($returDetail);
					$retur_id = $returDetail['Retur']['id'];
					// //insert ke stock cabang, type retur
					/* $data['Stock']['date']		=$returDetail['Retur']['date'];
					$data['Stock']['item_id']	=$returDetail['ReturDetail']['item_id'];
					$data['Stock']['qty']		= -1 * $returDetail['ReturDetail']['qty'];
					$data['Stock']['in_out']	='retur';
					$data['Stock']['price']		=$returDetail['ReturDetail']['price'];
					$data['Stock']['amount']	=$returDetail['ReturDetail']['amount'];
					$data['Stock']['retur_id']	=$returDetail['Retur']['id'];
					$data['Stock']['department_id']=$returDetail['Retur']['department_id'];
					
					$this->InventoryLedger->Retur->Stock->create();
					$this->InventoryLedger->Retur->Stock->save($data); */
				}
				$retur = $this->InventoryLedger->Retur->read(null, $id);
				if($retur['Retur']['retur_status_id']==status_retur_approved_by_branch_head_id){
					$journal = $this->InventoryLedger->insert_to_journal_csv($doc, $id, journal_group_retur_id);
					$this->generateCsv($journal);
				}else{
					$this->redirect(array('action' => 'process_inv'));
				}

				$this->InventoryLedger->Retur->id = $id;
				$this->InventoryLedger->Retur->set('retur_status_id',status_retur_processed_id);
				$this->InventoryLedger->Retur->save();				
			}
		}
		else
		{
				if($doc == 'outlog')
				{
					$this->Session->setFlash(__('Outlog can not be processed because it exceeded the time of '.$this->configs['journal_cut_off'], true));
					$this->redirect(array('controller' => 'outlogs', 'action' => 'view', $id));
				}
				if($doc == 'inlog')
				{
					$this->Session->setFlash(__('Inlog can not be processed because it exceeded the time of '.$this->configs['journal_cut_off'], true));
					$this->redirect(array('controller' => 'inlogs', 'action' => 'view', $id));
				}
				elseif($doc == 'retur')
				{
					$this->Session->setFlash(__('Retur can not be processed because it exceeded the time of '.$this->configs['journal_cut_off'], true));
					$this->redirect(array('controller' => 'returs', 'action' => 'view', $id));
				}
				elseif($doc == 'supplierReplace')
				{
					$this->Session->setFlash(__('Supplier Replace can not be processed because it exceeded the time of '.$this->configs['journal_cut_off'], true));
					$this->redirect(array('controller' => 'supplier_replaces', 'action' => 'view', $id));
				}
				elseif($doc == 'supplierRetur')
				{
					$this->Session->setFlash(__('Supplier Retur Replace can not be processed because it exceeded the time of '.$this->configs['journal_cut_off'], true));
					$this->redirect(array('controller' => 'supplier_returs', 'action' => 'view', $id));
				}
		}
		
	}
	
	function generateCsv($journal = null){
	
		$header = '';
		$header .= "ACCOUNT NUMBER,";
		$header .= "SIGN,";
		$header .= "AMOUNT-LCY,";
		$header .= "TRANSACTION CODE,";
		$header .= "NARRATIVE,";
		$header .= "PL CATEGORY,";
		$header .= "CUSTOMER ID,";
		$header .= "ACCOUNT OFFICER,";
		$header .= "PRODUCT CATEGORY,";
		$header .= "VALUE DATE,";
		$header .= "CURRENCY,";
		$header .= "AMOUNT FCY,";
		$header .= "EXCHANGE RATE,";
		$header .= "POSITION TYPE,";
		$header .= "REVERSAL MARKER,";
		$header .= "ACCOUNTING DATE,";
		$header .= "BRANCH CODE\n";
		
		$data = "";
		
		$tc = new TransactionCode;
		$transactionCodes = $tc->find('list', array('fields' => array('code')));
		
		foreach($journal as $d){
			$data .= $d['account_code'] . ",";
			$data .= $d['journal_position_id'] . ",";
			$data .= $d['amount_lcy'] . ",";
			$data .= $transactionCodes[$d['transaction_code']] . ",";
			$data .= $d['account_name'] . ",";
			$data .= $d['pl_category'] . ",";
			$data .= $d['customer_id'] . ",";
			$data .= $d['account_officer'] . ",";
			$data .= $d['product_category'] . ",";
			$data .= $d['value_date'] . ",";
			$data .= $d['currency'] . ",";
			$data .= $d['amount_fcy'] . ",";
			$data .= $d['exchange_rate'] . ",";
			$data .= $d['position_type'] . ",";
			$data .= $d['reversal_marker'] . ",";
			$data .= $d['accounting_date'] . ",";
			$data .= $d['branch_code'] . "\n";
		}
		
		$this->set(compact(
			'header',
			'data'
		));
		
		
		$this->set('detail', $data);
		$this->set('header', $header);
	
		$this->render('journal_xls', 'export_xls');
	}
	
	function checkValid($outlogDetails)
	{
		if($outlogDetails)
		{
			foreach($outlogDetails as $outlogDetail)
			{
				$item = $this->InventoryLedger->Item->read(null, $outlogDetail['OutlogDetail']['item_id']);
				if($item['Item']['balance'] < $outlogDetail['OutlogDetail']['qty'])
				{
					return false;
				}
			}
			return true;
		}
		else
		{
			return false;
		}
	}
	function getNewAverage($item_id, $qty, $price)
	{
		$item = $this->InventoryLedger->Item->read(null, $item_id);
		$average_last = $item['Item']['avg_price'] * $item['Item']['balance'];
		$average_new = $qty * $price;
		$average = ($average_last + $average_new) / ($qty + $item['Item']['balance']);
		$this->InventoryLedger->Item->set('avg_price', $average);
		$this->InventoryLedger->Item->save();
	}
	
	function getItems() {
	$this->layout='ajax';
		$this->set('options',
			$this->InventoryLedger->Item->find('list',
				array(
					'conditions' => array(
						'Item.asset_category_id' => $this->data['InventoryLedger']['asset_category_id']
					),
					'order' => array('Item.name')
				)
			)
		);
		$this->render('/inventory_ledgers/ajax_dropdown');
	}
	
	function movement_report($asset_category=null) {
		$rows = array();
		$layout=$this->data['InventoryLedger']['layout'];
		if (!empty($this->data)) {
			$this->Session->write('MovementReport.item_id',$this->data['InventoryLedger']['item_id']);
			$this->Session->write('MovementReport.asset_category_id',$this->data['InventoryLedger']['asset_category_id']);
		}
		//***
		$this->InventoryLedger->recursive = 0;
		//***
		$conditions=array();
		//***
		$assetCategories 	= $this->InventoryLedger->Item->AssetCategory->find('list',
			array('conditions' => array('AssetCategory.is_asset' => 0)));
		//filter category asset
		$asset_category=$this->Session->read('MovementReport.asset_category_id') ;
			$conditions[] = array('asset_category_id'=>$asset_category);
		
		//filter item
		$items 	= $this->InventoryLedger->Item->find('list',
			array('conditions' => array('Item.asset_category_id' => $asset_category)));
		$inv_item_id = $this->Session->read('MovementReport.item_id');
			$conditions['InventoryLedger.item_id']		= $inv_item_id;
		//filter date
		list($date_start,$date_end) = $this->set_date_filters('InventoryLedger');
		$conditions[] = array('InventoryLedger.date >=' => ($date_start['year'] . '-' . $date_start['month'] . '-' . $date_start['day']) , 
				'InventoryLedger.date <=' => ($date_end['year'] . '-' . $date_end['month'] . '-' . $date_end['day']) );
		//***
		$param =	array(
				'conditions'=>$conditions,
				'fields' => array(
					'InventoryLedger.date',
					'InventoryLedger.item_id',
					'sum(InventoryLedger.qty) as qty'
					), 	
				'group'=>array(
					'InventoryLedger.date',
					'InventoryLedger.item_id'
					),		
			);
		$inventoryLedgers 			= $this->InventoryLedger->find('all',$param);
		//saldo awal
		if(DRIVER == 'mysql'){
		$sql = 'SELECT sum(if(in_out="inlog",qty,-1*qty)) as s FROM inventory_ledgers where date < "'.$date_start['year'].'-'.$date_start['month'].'-'.$date_start['day'].'" AND item_id="'.$inv_item_id.'"';
		$begin = $this->InventoryLedger->query($sql);
		$beginning_balance = $begin[0][0]['s'];
		}if(DRIVER == 'mssql'){
		$sql = 'SELECT sum(case in_out when "inlog" then qty else -1*qty end) as s FROM inventory_ledgers where date < "'.$date_start['year'].'-'.$date_start['month'].'-'.$date_start['day'].'" AND item_id="'.$inv_item_id.'"';
		$begin = $this->InventoryLedger->query($sql);
		$beginning_balance = $begin[0][0]['s'];
		}
		//***
		$inlogDetails = $this->InventoryLedger->find('all',
			array('conditions' => array('AND'=>array('InventoryLedger.in_out' => 'inlog',$conditions)),
				'fields' => array(
					'InventoryLedger.date',
					'InventoryLedger.item_id',
					'sum(InventoryLedger.qty) as qty'
					), 	
				'group'=>array(
					'InventoryLedger.date',
					'InventoryLedger.item_id'
					)));
		foreach ($inlogDetails as $inlogDetail)
		{
			$date=$inlogDetail['InventoryLedger']['date'];
			$qty=$inlogDetail[0]['qty'];
			$rows[$date]['in']=$qty;
		}
		//***
		//***
		$outlogDetails = $this->InventoryLedger->find('all',
			array('conditions' => array('AND'=>array('InventoryLedger.in_out' => 'outlog',$conditions)),
				'fields' => array(
					'InventoryLedger.date',
					'InventoryLedger.item_id',
					'sum(InventoryLedger.qty) as qty'
					), 	
				'group'=>array(
					'InventoryLedger.date',
					'InventoryLedger.item_id'
					)));
		foreach ($outlogDetails as $outlogDetail)
		{
			$date=$outlogDetail['InventoryLedger']['date'];
			$qty=$outlogDetail[0]['qty'];
			$rows[$date]['out']=$qty;
		}
		if ($rows) {
			ksort($rows);
		}
		//var_dump($rows);
		//***
		$supplierReturDetails = $this->InventoryLedger->find('all',
			array('conditions' => array('AND'=>array('InventoryLedger.in_out' => 'supplierRetur',$conditions)),
				'fields' => array(
					'InventoryLedger.date',
					'InventoryLedger.item_id',
					'sum(InventoryLedger.qty) as qty'
					), 	
				'group'=>array(
					'InventoryLedger.date',
					'InventoryLedger.item_id'
					)));
		foreach ($supplierReturDetails as $supplierReturDetail)
		{
			$date=$supplierReturDetail['InventoryLedger']['date'];
			$qty=$supplierReturDetail[0]['qty'];
			$rows[$date]['out']=$qty;
		}
		if ($rows) {
			ksort($rows);
		}

		$copyright_id  = $this->configs['copyright_id'];
		/******************************************************/		
		$this->set(compact('assetCategories', 'asset_category', 'items', 'date_start', 'date_end',
			'inventoryLedgers', 'inlogDetails', 'outlogDetails','supplierReturDetails', 'copyright_id',
			'inlogDetail', 'outlogDetail', 'beginning_balance', 'rows', 'date', 'qty', 'in', 'out'));
			
		
		if($layout=='pdf')
		{
			Configure::write('debug',0); // Otherwise we cannot use this method while developing 
			$this->layout = 'pdf'; //this will use the pdf.ctp layout 
			$this->render('movement_report_pdf'); 		
		}
		else if($layout=='xls')
		{
		$this->render('movement_report_xls','export_xls');		

		}

	}
	
	
	function stock_report($asset_category=null) {
		$this->InventoryLedger->recursive = 0;
		$layout=$this->data['InventoryLedger']['layout'];
		//***
		$conditions=array();
		//***
		$assetCategories 	= $this->InventoryLedger->Item->AssetCategory->find('list',
			array('conditions' => array('AssetCategory.is_asset' => 0)));
		//***
		$param =	array(
				'conditions'=>$conditions,
				'fields' => array(
					'InventoryLedger.item_id', 
					'sum(InventoryLedger.qty) as qty', 
					'sum(InventoryLedger.price) as price', 
					'sum(InventoryLedger.amount) as amount', 
					), 	
				'group'=>array('InventoryLedger.item_id'),		
			);
		$inventoryLedgers 			= $this->InventoryLedger->find('all',$param);
		//echo '<pre>';
		//var_dump($inventoryLedgers);
		//filter category asset
		
		if($asset_category || ($asset_category=$this->data['InventoryLedger']['asset_category_id']) ) {
			$conditions[] = array('asset_category_id'=>$asset_category);
		}
		//***filter periode
		$month = date ("m"); 
		$year = date ("Y"); 
		 
		if (!empty ($this->params['data']['filter']['month']['month']) && !empty ($this->params['data']['filter']['year']['year'])) 
        {  
			$month = $this->params['data']['filter']['month']['month']; 
            $year = $this->params['data']['filter']['year']['year']; 
        
		} 
		else 
        {  
			if (!empty ($this->params ['named']['filter.month']) && !empty ($this->params ['named']['filter.year'])) 
            { 
				$month = $this->params ['named']['filter.month']; 
				$year = $this->params ['named']['filter.year']; 
            } 
        } 
		$this->params['pass']['filter.month'] = $month; 
		$this->params['pass']['filter.year'] = $year; 
		$conditions[] = array("InventoryLedger.date LIKE '%$year-$month%'");
		$this->set(compact('data'));  
		///***
		if($layout=='pdf' || $layout=='xls'){
			$inventoryLedgers			= $this->InventoryLedger->find('all', array('conditions'=>$conditions));
		}else{
			$this->paginate = array('order'=>'InventoryLedger.id');
			$inventoryLedgers			= $this->paginate($conditions);
		}
		//***
		$assetCategories2 	= $this->InventoryLedger->Item->AssetCategory->find('list', array ('fields' => array('AssetCategory.code')));
		$items 	= $this->InventoryLedger->Item->find('list');
		$units 	= $this->InventoryLedger->Item->Unit->find('list');
		//***
		$copyright_id  = $this->configs['copyright_id'];
		$this->set(compact('copyright_id', 'assetCategories' , 'assetCategories2', 'inventoryLedgers', 'asset_category', 'items', 'units'));	
			
		
		if($layout=='pdf')
		{
			Configure::write('debug',0); // Otherwise we cannot use this method while developing 
			$this->layout = 'pdf'; //this will use the pdf.ctp layout 
			$this->render('stock_report_pdf'); 		
		}
		else if($layout=='xls')
		{
		$this->render('stock_report_xls','export_xls');		

		}

	}
	
	function in_recap_report($asset_category=null) {
		$this->InventoryLedger->recursive = 0;
		$layout=$this->data['InventoryLedger']['layout'];
		//***
		$conditions=array('InventoryLedger.in_out' => 'inlog');
		//***
		$assetCategories 	= $this->InventoryLedger->Item->AssetCategory->find('list',
			array('conditions' => array('AssetCategory.is_asset' => 0)));
		//***
		$param =	array(
				'conditions'=>$conditions,
				'fields' => array(		
					'InventoryLedger.po_id', 
					), 	
				'order'=>array('InventoryLedger.po_id'),		
			);
		$inventoryLedgers 			= $this->InventoryLedger->find('all',$param);
		//filter category asset
		if($asset_category || ($asset_category=$this->data['InventoryLedger']['asset_category_id']) ) {
			$conditions[] = array('asset_category_id'=>$asset_category);
		}
		//filter periode
		$month = date ("m"); 
		$year = date ("Y"); 
		if (!empty ($this->params['data']['filter']['month']['month']) && !empty ($this->params['data']['filter']['year']['year'])) 
        {  
			$month = $this->params['data']['filter']['month']['month']; 
            $year = $this->params['data']['filter']['year']['year']; 
        } 
		else 
        {  
			if (!empty ($this->params ['named']['filter.month']) && !empty ($this->params ['named']['filter.year'])) 
            { 
				$month = $this->params ['named']['filter.month']; 
				$year = $this->params ['named']['filter.year']; 
            } 
        } 
		$this->params['pass']['filter.month'] = $month; 
		$this->params['pass']['filter.year'] = $year; 
		$conditions[] = array("InventoryLedger.date LIKE '%$year-$month%'");
		$this->set(compact('data'));
		//***
		if($layout=='pdf' || $layout=='xls'){
		$inventoryLedgers			= $this->InventoryLedger->find('all', array('conditions'=>$conditions));
		}else{
		$inventoryLedgers			= $this->paginate($conditions);
		}
		//***
		$copyright_id  = $this->configs['copyright_id'];
		$pos 	= $this->InventoryLedger->Po->find('list', array ('fields' => array('Po.no')));
		$assetCategories2 	= $this->InventoryLedger->Item->AssetCategory->find('list', array ('fields' => array('AssetCategory.code')));
		$items 	= $this->InventoryLedger->Item->find('list');
		$units 	= $this->InventoryLedger->Item->Unit->find('list');
		//***
		$this->set(compact('copyright_id', 'assetCategories', 'assetCategories2', 'inventoryLedgers', 'asset_category', 'pos', 'items', 'units'));
		
		
		if($layout=='pdf')
		{
			Configure::write('debug',0); // Otherwise we cannot use this method while developing 
			$this->layout = 'pdf'; //this will use the pdf.ctp layout 
			$this->render('in_recap_report_pdf'); 		
		}
		else if($layout=='xls')
		{
		$this->render('in_recap_report_xls','export_xls');		

		}

	}
	
	function out_recap_report($asset_category=null) {
		$this->InventoryLedger->recursive = 0;
		$layout=$this->data['InventoryLedger']['layout'];
		//***
		$conditions=array();
		//***
		$assetCategories 	= $this->InventoryLedger->Item->AssetCategory->find('list',
			array('conditions' => array('AssetCategory.is_asset' => 0)));
		//***
		$param =	array(
				'conditions'=>$conditions,
				'fields' => array(		
					'InventoryLedger.item_id', 
					), 	
				'group'=>array('InventoryLedger.item_id'),		
			);
		$inventoryLedgers 			= $this->InventoryLedger->find('all',$param);
		//filter category asset
		if($asset_category || ($asset_category=$this->data['InventoryLedger']['asset_category_id']) ) {
			$conditions[] = array('asset_category_id'=>$asset_category);
		}
		//filter periode
		$date = date ("d");
		$month = date ("m"); 
		$year = date ("Y"); 
		if (!empty ($this->params['data']['filter']['month']['month']) && !empty ($this->params['data']['filter']['year']['year'])) 
        {  
			$month = $this->params['data']['filter']['month']['month']; 
            $year = $this->params['data']['filter']['year']['year']; 
        } 
		else 
        {  
			if (!empty ($this->params ['named']['filter.month']) && !empty ($this->params ['named']['filter.year'])) 
            { 
				$month = $this->params ['named']['filter.month']; 
				$year = $this->params ['named']['filter.year']; 
            } 
        } 
		$this->params['pass']['filter.month'] = $month; 
		$this->params['pass']['filter.year'] = $year; 
		$conditions[] = array("InventoryLedger.date LIKE '%$year-$month%'");
		$this->set(compact('data'));
		//***
		$param1 =	array(
				'conditions'=>array(
					'OR'=>array('InventoryLedger.in_out'=>'inlog'),
						array('InventoryLedger.date '=>''.$year.'-'.$month.'-'.'01'.''),
						array($conditions)),
				'fields' => array(		
					'InventoryLedger.item_id', 
					'sum(InventoryLedger.qty) as qty', 
					'sum(InventoryLedger.amount) as amount'
					), 	
				'group'=>array('InventoryLedger.item_id'),		
			);
		$inlogDetails = $this->InventoryLedger->find('all',$param1);
		foreach ($inlogDetails as $inlogDetail)
		{
			$item_id = $inlogDetail['InventoryLedger']['item_id'];
			$qty = $inlogDetail[0]['qty'];
			$amount = $inlogDetail[0]['amount'];
			$rows[$item_id]['begin_stock_qty'] = $qty;
			$rows[$item_id]['begin_stock_amount'] = $amount;
		}
		//***
		$start	= ''.$year.'-'.$month.'-'.'01'.'';
		$end	= ''.$year.'-'.$month.'-'.'31'.'';
		$param2 =	array(
				'conditions'=>array(
					'OR'=>array('InventoryLedger.in_out'=>'outlog'),
						array('InventoryLedger.date BETWEEN ? AND ?'=>array(
							$start, $end)),
							array($conditions)),
				'fields' => array(		
					'InventoryLedger.item_id', 
					'sum(InventoryLedger.qty) as qty', 
					'sum(InventoryLedger.amount) as amount'
					), 	
				'group'=>array('InventoryLedger.item_id'),		
			);
		$outlogDetails = $this->InventoryLedger->find('all',$param2);
		foreach ($outlogDetails as $outlogDetail)
		{
			$item_id = $outlogDetail['InventoryLedger']['item_id'];
			$qty = $outlogDetail[0]['qty'];
			$amount = $outlogDetail[0]['amount'];
			$rows[$item_id]['out_qty'] = $qty;
			$rows[$item_id]['out_amount'] = $amount;
		}
		//***
		/*foreach $rows as $date => $row
		{
			$rows[$date]['end_qty'] = $rows[$date]['begin_stock_qty'] - $rows[$date]['out_qty'];
			$rows[$date]['end_amount'] = $rows[$date]['begin_stock_amount'] - $rows[$date]['out_amount']
		}*/
		//***
		if($layout=='pdf' || $layout=='xls'){
		$inventoryLedgers			= $this->InventoryLedger->find('all', array('conditions'=>$conditions));
		}else{
		$inventoryLedgers			= $this->paginate($conditions);
		}
		//***
		$copyright_id  = $this->configs['copyright_id'];
		$assetCategories2 	= $this->InventoryLedger->Item->AssetCategory->find('list', array ('fields' => array('AssetCategory.code')));
		$items 	= $this->InventoryLedger->Item->find('list');
		//***
		$this->set(compact('rows',
			'assetCategories', 'inventoryLedgers', 'copyright_id',
			'asset_category', 'assetCategories2', 'items'));
			
		
		if($layout=='pdf')
		{
			Configure::write('debug',0); // Otherwise we cannot use this method while developing 
			$this->layout = 'pdf'; //this will use the pdf.ctp layout 
			$this->render('out_recap_report_pdf'); 		
		}
		else if($layout=='xls')
		{
		$this->render('out_recap_report_xls','export_xls');		

		}

	}
	
	function report_out_recap(){
		$this->InventoryLedger->recursive = 0;
		$this->paginate = array('order'=>'InventoryLedger.id');
		$layout=$this->data['InventoryLedger']['layout'];
		if(!empty($this->data)){
			if($this->data['CostCenter']['name'] == '')
				$this->data['InventoryLedger']['cost_center_id'] = null;
			if($this->data['Item']['name'] == '')
				$this->data['InventoryLedger']['item_id'] = null;
		}
		if($this->data['InventoryLedger']['doc_no'] == 1){
		$conditions[] = array('InventoryLedger.npb_id !='=>0);
		}elseif($this->data['InventoryLedger']['doc_no'] == 2){
		$conditions[] = array('InventoryLedger.retur_id !='=>0);
		}elseif($this->data['InventoryLedger']['doc_no'] == null){
		
		}
		if($item = $this->data['InventoryLedger']['item_id']){
		$conditions[] = array('InventoryLedger.item_id'=>$item);
		}
		
		if($business_type_id = $this->data['InventoryLedger']['business_type_id']){
		$conditions[] = array('InventoryLedger.business_type_id'=>$business_type_id);
		}
		if($cost_center_id = $this->data['InventoryLedger']['cost_center_id']){
		$conditions[] = array('InventoryLedger.cost_center_id'=>$cost_center_id);
		}
		if ($this->Session->read('Security.permissions') == normal_user_group_id || $this->Session->read('Security.permissions') == branch_head_group_id){
			$department_id = $this->data['InventoryLedger']['department_id'] = $this->Session->read('Userinfo.department_id');
			$conditions[] = array('InventoryLedger.department_id'=>$department_id);
		}elseif($department_id = $this->data['InventoryLedger']['department_id']){
			$conditions[] = array('InventoryLedger.department_id'=>$department_id);
		}
		list($date_start,$date_end) = $this->set_date_filters('InventoryLedger');
		$conditions[] = array('InventoryLedger.date >=' => ($date_start['year'] . '-' . $date_start['month'] . '-' . $date_start['day']) , 
				'InventoryLedger.date <=' => ($date_end['year'] . '-' . $date_end['month'] . '-' . $date_end['day']) );
		
		$conditions[] = array('InventoryLedger.in_out'=>'outlog');
		
		if($layout=='pdf' || $layout=='xls'){
			$con = $this->InventoryLedger->find('all', array('conditions'=>$conditions));
		}else{
			$con = $this->paginate($conditions);
		}
		$this->set('inventoryLedgers', $con);
		
		$copyright_id  = $this->configs['copyright_id'];				
		$units = $this->InventoryLedger->Item->Unit->find('list');
		$items = $this->InventoryLedger->Item->find('list');
		$departments = $this->InventoryLedger->Department->find('list');
		$businessTypes = $this->InventoryLedger->BusinessType->find('list');
		$this->set(compact('departments', 'businessTypes', 'units', 'items', 'date_start', 'date_end', 'copyright_id'));
		if($layout=='pdf')
		{
			Configure::write('debug',0); // Otherwise we cannot use this method while developing 
			$this->layout = 'pdf'; //this will use the pdf.ctp layout 
			$this->render('report_out_recap_pdf'); 		
		}
		else if($layout=='xls')
		{
		$this->render('report_out_recap_xls','export_xls');		

		}
	}	
	
	function report_stock_recap(){
		$this->InventoryLedger->recursive = 0;
		$this->paginate = array('order'=>'InventoryLedger.id');
		$layout=$this->data['InventoryLedger']['layout'];
		if(!empty($this->data)){
			if($this->data['CostCenter']['name'] == '')
				$this->data['InventoryLedger']['cost_center_id'] = null;
			if($this->data['Item']['name'] == '')
				$this->data['InventoryLedger']['item_id'] = null;
		}
		if($item = $this->data['InventoryLedger']['item_id']){
		$conditions[] = array('InventoryLedger.item_id'=>$item);
		}
		if($department_id = $this->data['InventoryLedger']['department_id']){
		$conditions[] = array('InventoryLedger.department_id'=>$department_id);
		}
		if($business_type_id = $this->data['InventoryLedger']['business_type_id']){
		$conditions[] = array('InventoryLedger.business_type_id'=>$business_type_id);
		}
		if($cost_center_id = $this->data['InventoryLedger']['cost_center_id']){
		$conditions[] = array('InventoryLedger.cost_center_id'=>$cost_center_id);
		}
		list($date_start,$date_end) = $this->set_date_filters('InventoryLedger');
		$conditions[] = array('InventoryLedger.date >=' => ($date_start['year'] . '-' . $date_start['month'] . '-' . $date_start['day']) , 
				'InventoryLedger.date <=' => ($date_end['year'] . '-' . $date_end['month'] . '-' . $date_end['day']) );
								
		if($layout=='pdf' || $layout=='xls'){
			$con = $this->InventoryLedger->find('all', array('conditions'=>$conditions,'order'=>'InventoryLedger.id'));
		}else{
			$con = $this->paginate($conditions);
		}
		$this->set('inventoryLedgers', $con);
		
		$copyright_id  = $this->configs['copyright_id'];						
		$units = $this->InventoryLedger->Item->Unit->find('list');
		$items = $this->InventoryLedger->Item->find('list');
		$departments = $this->InventoryLedger->Department->find('list');
		$businessTypes = $this->InventoryLedger->BusinessType->find('list');
		$this->set(compact('departments', 'businessTypes', 'units', 'items', 'date_start', 'date_end', 'copyright_id'));
		if($layout=='pdf')
		{
			Configure::write('debug',0); // Otherwise we cannot use this method while developing 
			$this->layout = 'pdf'; //this will use the pdf.ctp layout 
			$this->render('report_stock_recap_pdf'); 		
		}
		else if($layout=='xls')
		{
		$this->render('report_stock_recap_xls','export_xls');		

		}
	}	
	
	function report_in_recap(){
		$this->InventoryLedger->recursive = 0;
		$this->paginate = array('order'=>'InventoryLedger.id');
		$layout=$this->data['InventoryLedger']['layout'];
		if(!empty($this->data)){
			if($this->data['CostCenter']['name'] == '')
				$this->data['InventoryLedger']['cost_center_id'] = null;
			if($this->data['Item']['name'] == '')
				$this->data['InventoryLedger']['item_id'] = null;
		}
		if($item = $this->data['InventoryLedger']['item_id']){
		$conditions[] = array('InventoryLedger.item_id'=>$item);
		}
		if($department_id = $this->data['InventoryLedger']['department_id']){
		$conditions[] = array('InventoryLedger.department_id'=>$department_id);
		}
		if($business_type_id = $this->data['InventoryLedger']['business_type_id']){
		$conditions[] = array('InventoryLedger.business_type_id'=>$business_type_id);
		}
		if($cost_center_id = $this->data['InventoryLedger']['cost_center_id']){
		$conditions[] = array('InventoryLedger.cost_center_id'=>$cost_center_id);
		}
		list($date_start,$date_end) = $this->set_date_filters('InventoryLedger');
		$conditions[] = array('InventoryLedger.date >=' => ($date_start['year'] . '-' . $date_start['month'] . '-' . $date_start['day']) , 
				'InventoryLedger.date <=' => ($date_end['year'] . '-' . $date_end['month'] . '-' . $date_end['day']) );
		
		$conditions[] = array('InventoryLedger.in_out'=>'inlog');
		
		if($layout=='pdf' || $layout=='xls'){
			$con = $this->InventoryLedger->find('all', array('conditions'=>$conditions));
		}else{
			$con = $this->paginate($conditions);
		}
		$this->set('inventoryLedgers', $con);
		
		$copyright_id  = $this->configs['copyright_id'];		
		$units = $this->InventoryLedger->Item->Unit->find('list');
		$items = $this->InventoryLedger->Item->find('list');
		$departments = $this->InventoryLedger->Department->find('list');
		$businessTypes = $this->InventoryLedger->BusinessType->find('list');
		$costCenters = $this->InventoryLedger->CostCenter->find('list');
		$this->set(compact('departments', 'businessTypes', 'units', 'items', 'date_start', 'date_end', 'copyright_id', 'costCenters'));
		
		if($layout=='pdf')
		{
			Configure::write('debug',0); // Otherwise we cannot use this method while developing 
			$this->layout = 'pdf'; //this will use the pdf.ctp layout 
			$this->render('report_in_recap_pdf'); 		
		}
		else if($layout=='xls')
		{
		$this->render('report_in_recap_xls','export_xls');		

		}
	
	}
	
	function report_retur_recap(){
		$this->InventoryLedger->recursive = 0;
		$this->paginate = array('order'=>'InventoryLedger.id');
		$layout=$this->data['InventoryLedger']['layout'];
		if(!empty($this->data)){
			if($this->data['CostCenter']['name'] == '')
				$this->data['InventoryLedger']['cost_center_id'] = null;
			if($this->data['Item']['name'] == '')
				$this->data['InventoryLedger']['item_id'] = null;
		}
		if($item = $this->data['InventoryLedger']['item_id']){
		$conditions[] = array('InventoryLedger.item_id'=>$item);
		}
		if($department_id = $this->data['InventoryLedger']['department_id']){
		$conditions[] = array('InventoryLedger.department_id'=>$department_id);
		}
		if($business_type_id = $this->data['InventoryLedger']['business_type_id']){
		$conditions[] = array('InventoryLedger.business_type_id'=>$business_type_id);
		}
		if($cost_center_id = $this->data['InventoryLedger']['cost_center_id']){
		$conditions[] = array('InventoryLedger.cost_center_id'=>$cost_center_id);
		}
		list($date_start,$date_end) = $this->set_date_filters('InventoryLedger');
		$conditions[] = array('InventoryLedger.date >=' => ($date_start['year'] . '-' . $date_start['month'] . '-' . $date_start['day']) , 
				'InventoryLedger.date <=' => ($date_end['year'] . '-' . $date_end['month'] . '-' . $date_end['day']) );
		
		$conditions[] = array('InventoryLedger.in_out'=>'retur');
		
		if($layout=='pdf' || $layout=='xls'){
			$con = $this->InventoryLedger->find('all', array('conditions'=>$conditions));
		}else{
			$con = $this->paginate($conditions);
		}
		$this->set('inventoryLedgers', $con);
		
		$copyright_id  = $this->configs['copyright_id'];				
		$units = $this->InventoryLedger->Item->Unit->find('list');
		$items = $this->InventoryLedger->Item->find('list');
		$departments = $this->InventoryLedger->Department->find('list');
		$businessTypes = $this->InventoryLedger->BusinessType->find('list');
		$this->set(compact('departments', 'businessTypes', 'units', 'items', 'date_start', 'date_end', 'copyright_id'));
		if($layout=='pdf')
		{
			Configure::write('debug',0); // Otherwise we cannot use this method while developing 
			$this->layout = 'pdf'; //this will use the pdf.ctp layout 
			$this->render('report_retur_recap_pdf'); 		
		}
		else if($layout=='xls')
		{
		$this->render('report_retur_recap_xls','export_xls');		

		}
	}	
	
	function report_supplierretur_recap(){
		$this->InventoryLedger->recursive = 0;
		$this->paginate = array('order'=>'InventoryLedger.id');
		$layout=$this->data['InventoryLedger']['layout'];
		if(!empty($this->data)){
			
			if($this->data['Item']['name'] == '')
				$this->data['InventoryLedger']['item_id'] = null;
		}
		if($item = $this->data['InventoryLedger']['item_id']){
		$conditions[] = array('InventoryLedger.item_id'=>$item);
		}
		
		list($date_start,$date_end) = $this->set_date_filters('InventoryLedger');
		$conditions[] = array('InventoryLedger.date >=' => ($date_start['year'] . '-' . $date_start['month'] . '-' . $date_start['day']) , 
				'InventoryLedger.date <=' => ($date_end['year'] . '-' . $date_end['month'] . '-' . $date_end['day']) );
		
		$conditions[] = array('InventoryLedger.in_out'=>'supplierRetur');
		
		if($layout=='pdf' || $layout=='xls'){
			$con = $this->InventoryLedger->find('all', array('conditions'=>$conditions));
		}else{
			$con = $this->paginate($conditions);
		}
		$this->set('inventoryLedgers', $con);
		
		$copyright_id  = $this->configs['copyright_id'];						
		$units = $this->InventoryLedger->Item->Unit->find('list');
		$items = $this->InventoryLedger->Item->find('list');
		$departments = $this->InventoryLedger->Department->find('list');
		$businessTypes = $this->InventoryLedger->BusinessType->find('list');
		$this->set(compact('departments', 'businessTypes', 'units', 'items', 'date_start', 'date_end', 'copyright_id'));
		if($layout=='pdf')
		{
			Configure::write('debug',0); // Otherwise we cannot use this method while developing 
			$this->layout = 'pdf'; //this will use the pdf.ctp layout 
			$this->render('report_supplierretur_recap_pdf'); 		
		}
		else if($layout=='xls')
		{
		$this->render('report_supplierretur_recap_xls','export_xls');		

		}
	}	
	
	function report_supplierreplace_recap(){
		$this->InventoryLedger->recursive = 0;
		$this->paginate = array('order'=>'InventoryLedger.id');
		$layout=$this->data['InventoryLedger']['layout'];
		if(!empty($this->data)){
			
			if($this->data['Item']['name'] == '')
				$this->data['InventoryLedger']['item_id'] = null;
		}
		if($item = $this->data['InventoryLedger']['item_id']){
		$conditions[] = array('InventoryLedger.item_id'=>$item);
		}
		
		list($date_start,$date_end) = $this->set_date_filters('InventoryLedger');
		$conditions[] = array('InventoryLedger.date >=' => ($date_start['year'] . '-' . $date_start['month'] . '-' . $date_start['day']) , 
				'InventoryLedger.date <=' => ($date_end['year'] . '-' . $date_end['month'] . '-' . $date_end['day']) );
		
		$conditions[] = array('InventoryLedger.in_out'=>'supplierReplace');
		
		if($layout=='pdf' || $layout=='xls'){
			$con = $this->InventoryLedger->find('all', array('conditions'=>$conditions));
		}else{
			$con = $this->paginate($conditions);
		}
		$this->set('inventoryLedgers', $con);
		
		$copyright_id  = $this->configs['copyright_id'];						
		$units = $this->InventoryLedger->Item->Unit->find('list');
		$items = $this->InventoryLedger->Item->find('list');
		$departments = $this->InventoryLedger->Department->find('list');
		$businessTypes = $this->InventoryLedger->BusinessType->find('list');
		$this->set(compact('departments', 'businessTypes', 'units', 'items', 'date_start', 'date_end', 'copyright_id'));
		if($layout=='pdf')
		{
			Configure::write('debug',0); // Otherwise we cannot use this method while developing 
			$this->layout = 'pdf'; //this will use the pdf.ctp layout 
			$this->render('report_supplierreplace_recap_pdf'); 		
		}
		else if($layout=='xls')
		{
		$this->render('report_supplierreplace_recap_xls','export_xls');		

		}
	}	
	
	function report_supplierretur_recap(){
		$this->InventoryLedger->recursive = 0;
		$this->paginate = array('order'=>'InventoryLedger.id');
		$layout=$this->data['InventoryLedger']['layout'];
		if(!empty($this->data)){
			
			if($this->data['Item']['name'] == '')
				$this->data['InventoryLedger']['item_id'] = null;
		}
		if($item = $this->data['InventoryLedger']['item_id']){
		$conditions[] = array('InventoryLedger.item_id'=>$item);
		}
		
		list($date_start,$date_end) = $this->set_date_filters('InventoryLedger');
		$conditions[] = array('InventoryLedger.date >=' => ($date_start['year'] . '-' . $date_start['month'] . '-' . $date_start['day']) , 
				'InventoryLedger.date <=' => ($date_end['year'] . '-' . $date_end['month'] . '-' . $date_end['day']) );
		
		$conditions[] = array('InventoryLedger.in_out'=>'supplierRetur');
		
		if($layout=='pdf' || $layout=='xls'){
			$con = $this->InventoryLedger->find('all', array('conditions'=>$conditions));
		}else{
			$con = $this->paginate($conditions);
		}
		$this->set('inventoryLedgers', $con);
		
		$copyright_id  = $this->configs['copyright_id'];						
		$units = $this->InventoryLedger->Item->Unit->find('list');
		$items = $this->InventoryLedger->Item->find('list');
		$departments = $this->InventoryLedger->Department->find('list');
		$businessTypes = $this->InventoryLedger->BusinessType->find('list');
		$this->set(compact('departments', 'businessTypes', 'units', 'items', 'date_start', 'date_end', 'copyright_id'));
		if($layout=='pdf')
		{
			Configure::write('debug',0); // Otherwise we cannot use this method while developing 
			$this->layout = 'pdf'; //this will use the pdf.ctp layout 
			$this->render('report_supplierretur_recap_pdf'); 		
		}
		else if($layout=='xls')
		{
		$this->render('report_supplierretur_recap_xls','export_xls');		

		}
	}
}
?>
