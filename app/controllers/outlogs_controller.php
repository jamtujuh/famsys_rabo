<?php

App::import('Controller', 'JournalTransactions');

class OutlogsController extends AppController {

      var $name = 'Outlogs';
      var $helpers = array('Ajax', 'Javascript', 'Time');
      var $components = array('RecordReferer', 'RequestHandler');

      var $journal_group_distribute_hq_branch_id = null;

      function beforeFilter() {
          $this->journal_group_distribute_hq_branch_id = $this->RecordReferer->getIdByModelNameAndRefName('JournalGroup', 'journal_group_distribute_hq_branch_id');
          parent::beforeFilter();
      }

      function index($outlog_status_id=null, $outlog_department_id=null, $journal_groups_id=null) {
            $this->Outlog->recursive = 1;
            $layout = $this->data['Outlog']['layout'];
			
			if(!empty( $this->data['Outlog'] ) )
			{	
				//approve via checkbox
				if(isset($this->data['Outlog']['outlog_id'])){
					$outlog_id_updates = $this->data['Outlog']['outlog_id'];
					$arr = array();
					foreach ($outlog_id_updates as $outlog_id_update){
						if($outlog_id_update > 0){
							$arr[]['id'] 	= $outlog_id_update;						
						}					
					}
					$this->update_status_outlog($arr,status_outlog_approved_id);
				}
				
			}
            /* if ($outlog_status_id || ($outlog_status_id = $this->data['Outlog']['outlog_status_id'])) {
                  $conditions[] = array('Outlog.outlog_status_id' => $outlog_status_id);
            } */
			
			if($outlog_status_id)
				$this->Session->write('Outlog.outlog_status_id',$outlog_status_id);
			else if(isset($this->data['Outlog']['outlog_status_id']))
				$this->Session->write('Outlog.outlog_status_id',$this->data['Outlog']['outlog_status_id']);
			if($outlog_status_id=$this->Session->read('Outlog.outlog_status_id')) 
				$conditions[] = array('outlog_status_id'=>$outlog_status_id);
				
			if($outlog_department_id)
				$this->Session->write('Outlog.supplier_id',$outlog_department_id);
			else if(isset($this->data['Outlog']['outlog_status_id']))
				$this->Session->write('Outlog.outlog_status_id',$this->data['Outlog']['outlog_status_id']);
			if($outlog_status_id=$this->Session->read('Outlog.outlog_status_id')) 
				$conditions[] = array('outlog_status_id'=>$outlog_status_id);

            //DIT KOMEN DARI SINI - FILTERS
            //if($journal_groups_id || ($journal_groups_id=$this->data['Outlog']['journal_groups_id']) ) {
            if($journal_groups_id) {
                $outlogs_list_category = $this->Outlog->outlogs_list_category($journal_groups_id);
                if($journal_groups_id!=''){
					$str = 'Outlog.id';
					$array = array(-99);
					for($i=0;$i<count($outlogs_list_category);$i++){
						  array_push($array, $outlogs_list_category[$i][0]['id']);
					}
					$conditions[] = array('Outlog.id'=> $array);
                }
            }
            //DIT KOMEN SAMPE SINI - FILTERS

            /* if ($outlog_department_id || ($outlog_department_id = $this->data['Outlog']['department_id'])) {
                  $conditions[] = array('Outlog.department_id' => $outlog_department_id);
            } */
			
            if ($outlog_business_type_id = $this->data['Outlog']['business_type_id']) {
                  $conditions[] = array('Outlog.business_type_id' => $outlog_business_type_id);
            }
			
			if($this->data['CostCenter']['name'] == ''){
				$this->data['Outlog']['cost_center_id'] = null;
			}
			
            if ($outlog_cost_center_id = $this->data['Outlog']['cost_center_id']) {
                  $conditions[] = array('Outlog.cost_center_id' => $outlog_cost_center_id);
            }
			$conditions[] = array('Outlog.outlog_status_id !=' => status_outlog_archive_id);//archive
			$this->paginate = array('order'=>'Outlog.id');
            list($date_start, $date_end) = $this->set_date_filters('Outlog');
            $conditions[] = array('Outlog.date >=' => ($date_start['year'] . '-' . $date_start['month'] . '-' . $date_start['day']),
                'Outlog.date <=' => ($date_end['year'] . '-' . $date_end['month'] . '-' . $date_end['day']));
            if ($layout == 'pdf' || $layout == 'xls') {
                  $con = $this->Outlog->find('all', array('conditions' => $conditions));
            } else {
                  $con = $this->paginate($conditions);
            }
			
			//if(empty($this->data)){
			//	echo '<pre>';
			//	var_dump($cons);
			//	echo '</pre>';die();
			//}
			
            $this->set('outlogs', $con);
            $copyright_id = $this->configs['copyright_id'];
            $departments = $this->Outlog->Department->find('list');
            $businessTypes = $this->Outlog->BusinessType->find('list');
            $costCenters = $this->Outlog->CostCenter->find('list');
			//$cc 			= $this->Outlog->query('select a.id,a.name,b.t24_dao from cost_centers a left join cost_center_to_daos b on b.cost_center_id = a.id where a.remarks = "Y" order by a.name');
			//foreach($cc as $data){
			//	if($data[0]['t24_dao']){
			//		$costCenters[ $data[0]['id'] ]	= $data[0]['name'] . " - " .$data[0]['t24_dao'];
			//	}else{
			//		$costCenters[ $data[0]['id'] ]	= $data[0]['name'];
			//	}				
			//}
            $outlogStatuses = $this->Outlog->OutlogStatus->find('list', array('conditions' =>array('id !=' => status_outlog_archive_id))); //archive
			App::import('Model','JournalGroup');
            $journal_group = new JournalGroup;

            //$journal_groups = $journal_group->get_active_journal_group();

            $this->set(compact('costCenters', 'businessTypes', 'departments', 'outlog_department_id', 'date_start', 'date_end', 'outlogStatuses', 'outlog_status_id', 'copyright_id', 'journal_groups', 'journal_groups_id'));


            if ($layout == 'pdf') {
                  Configure::write('debug', 0); // Otherwise we cannot use this method while developing 
                  $this->layout = 'pdf'; //this will use the pdf.ctp layout 
                  $this->render('index_pdf');
            } else if ($layout == 'xls') {
                  $this->render('index_xls', 'export_xls');
            }
      }

      function index_pdf() {
            $this->Outlog->recursive = 0;

            if ($outlog_department_id || ($outlog_department_id = $this->data['Outlog']['department_id'])) {
                  $conditions[] = array('department_id' => $outlog_department_id);
            }

            list($date_start, $date_end) = $this->set_date_filters('Outlog');
            $conditions[] = array('date >=' => ($date_start['year'] . '-' . $date_start['month'] . '-' . $date_start['day']),
                'date <=' => ($date_end['year'] . '-' . $date_end['month'] . '-' . $date_end['day']));

            $this->set('outlogs', $this->paginate($conditions));
            $departments = $this->Outlog->Department->find('list');
            $this->set(compact('departments', 'outlog_department_id', 'date_start', 'date_end'));
      }

      function view($id = null) {
            if (!$id) {
                  $this->Session->setFlash(__('Invalid outlog', true));
                  $this->redirect(array('action' => 'index'));
            }
			
            $outlog = $this->Outlog->read(null, $id);
            $this->Session->write('Outlog.id', $id);

            $this->Session->write('Outlog.can_edit', false);
            $this->Session->write('Outlog.can_process', false);
            $this->Session->write('Outlog.can_approve', false);
            $this->Session->write('Outlog.can_journal', false);
            $this->Session->write('Outlog.can_request_approval', false);
            $this->Session->write('Outlog.can_print_delivery_notes', false);
            $this->Session->write('Outlog.can_reprint_delivery_notes', false);
            $this->Session->write('Outlog.can_archive', false);

            if ($this->Session->read('Security.permissions') == stock_management_group_id) {
                  $this->Session->write('Outlog.can_edit', $outlog['Outlog']['outlog_status_id'] == status_outlog_draft_id ? true : false);
                  $this->Session->write('Outlog.can_archive', $outlog['Outlog']['outlog_status_id'] == status_outlog_reject_id ? true : false);
                  $this->Session->write('Outlog.can_request_approval', $outlog['Outlog']['outlog_status_id'] == status_outlog_draft_id ? true : false);
                  $this->Session->write('Outlog.can_process', $outlog['Outlog']['outlog_status_id'] == status_outlog_approved_id && $outlog['Outlog']['is_printed'] == 1 ? true : false);
                  $this->Session->write('Outlog.can_print_delivery_notes', ($outlog['Outlog']['outlog_status_id'] == status_outlog_approved_id || $outlog['Outlog']['outlog_status_id'] == status_outlog_finish_id) && $outlog['Outlog']['is_printed'] == 0 ? true : false);
                  $this->Session->write('Outlog.can_reprint_delivery_notes', $outlog['Outlog']['is_printed'] == 1 ? true : false);
            } else if ($this->Session->read('Security.permissions') == stock_supervisor_group_id) {
                  $this->Session->write('Outlog.can_approve', $outlog['Outlog']['outlog_status_id'] == status_outlog_sent_to_supervisor_id ? true : false);
            } else if ($this->Session->read('Security.permissions') == fincon_group_id) {
                  $this->Session->write('Outlog.can_journal', $outlog['Outlog']['outlog_status_id'] == status_outlog_processed_id ? true : false);
            }

            $this->set('outlog', $outlog);
            $assetCategories = $this->Outlog->OutlogDetail->Item->AssetCategory->find('list');
            $units = $this->Outlog->OutlogDetail->Item->Unit->find('list');
            $this->set(compact('assetCategories', 'units'));
      }

      function delivery_notes($id, $reprint=false) {
            if (!$id) {
                  $this->Session->setFlash(__('Invalid outlog', true));
                  $this->redirect(array('action' => 'index'));
            }
            $outlog = $this->Outlog->read(null, $id);

			$conditions[]	= array('User.username'=>$outlog['Outlog']['created_by']);
			$this->loadModel('User');
			$con = $this->User->find('all', array('conditions'=>$conditions));			
			
			$name	= $con[0]['User']['name'];
			
			$outlog['User']['created_by_name'] = $name;
			
            //insert ke stock cabang
            if (!$reprint) {
                foreach ($outlog['OutlogDetail'] as $detail) {						
					$data['Stock']['date'] = $outlog['Outlog']['date'];
					$data['Stock']['item_id'] = $detail['item_id'];
					$data['Stock']['qty'] = $detail['qty'];
					$data['Stock']['in_out'] = 'outlog';
					$data['Stock']['price'] = $detail['price'];
					$data['Stock']['amount'] = $detail['amount'];
					$data['Stock']['outlog_id'] = $detail['outlog_id'];
					$data['Stock']['department_id'] = $outlog['Outlog']['department_id'];
					$this->Outlog->Stock->create();
					$this->Outlog->Stock->save($data);
                }
            }
			
            $this->set('outlog', $outlog);
            $copyright_id = $this->configs['copyright_id'];
            $assetCategories = $this->Outlog->OutlogDetail->Item->AssetCategory->find('list');
            $units = $this->Outlog->OutlogDetail->Item->Unit->find('list');
            $this->set(compact('outlog', 'assetCategories', 'units', 'copyright_id'));

            $this->Outlog->set('is_printed', 1);
			if (!$reprint){
				$this->Outlog->set('outlog_status_id', status_outlog_processed_id);

                                //Post journal.
                                $journalTransactionsController = new JournalTransactionsController;
                                $journalTransactionsController->constructClasses();

                                $journalGroupId = $this->journal_group_distribute_hq_branch_id;
                                $journalTransactionsData = $journalTransactionsController->do_prepare_posting_outlog($journalGroupId, $id);

                                $journalTransactionsController->do_posting_outlog($id, $journalTransactionsData);
                                $this->Outlog->set('outlog_status_id', status_outlog_finish_id);
			}
            $this->Outlog->save();

            Configure::write('debug', 0);
            $this->layout = 'pdf'; //this will use the pdf.ctp layout 
            $this->render('delivery_notes_pdf');

            //$this->redirect(array('action' => 'view', $id));
      }

    function add($npb_id=null) {
		
	  	if (!empty($this->data)) {
			$NpbDetailReference 	= $this->Session->read('OutlogDetail.Reference');
			$this->Session->write('OutlogDetail.Reference',null);
			
			$this->Outlog->create();
			if ($this->Outlog->save($this->data)) {
				$outlog_id = $this->Outlog->id;
				$res = $this->Outlog->query('select count(*) as c from outlog_details where outlog_id = '.$outlog_id);
				$detailCount = $res[0][0]['c'];
				
				$itemId = $qtyFill = $price = $amount = $outlogDetailId = 0;
				if (isset($this->data['Outlog']['npb_id']) && $detailCount >= 0) {
					$npb_id = $this->data['Outlog']['npb_id'];
					
					$InventoryLedger = new InventoryLedger;
					$itemBalances = $InventoryLedger->getItemBalances();
					$npb = $this->Outlog->Npb->read(null, $npb_id);
					//remove non stock items
					$n = 0;
					foreach($npb['NpbDetail'] as $detail){
						if($detail['process_type_id'] == 2){
							unset($npb['NpbDetail'][$n]);							
						}
						$n++;
					}
					$npb['NpbDetail'] = array_values($npb['NpbDetail']);
					
					foreach ($npb['NpbDetail'] as $npbDetail) {
						//print 'ref '.$NpbDetailReference;
						if(empty($NpbDetailReference))continue;
						foreach($NpbDetailReference as $reference){
							//qty_unfilled = qty yang diisi oleh user utk dipenuhi
							if ($npbDetail['id'] == $reference['NpbDetailId'] && 
								$reference['QtyValue'] > 0 && 
								isset($itemBalances[$npbDetail['item_id']]) &&
								$itemBalances[$npbDetail['item_id']] >= $reference['QtyValue']) {

								$npb_detail_id = $npbDetail['id'];
								$this->Outlog->OutlogDetail->Item->recursive = 0;
								$item = $this->Outlog->OutlogDetail->Item->read(null, $npbDetail['item_id']);
								
								$this->data['Outlog']['qty_fill'] 		= $npbDetail['qty_filled'];
								$this->data['Outlog']['qty_unfilled'] 	= $npbDetail['qty'] - $npbDetail['qty_filled'];
								
								$data['OutlogDetail']['outlog_id'] 	= $outlog_id;
								$data['OutlogDetail']['item_id'] 	= $npbDetail['item_id'];									
								$data['OutlogDetail']['qty'] 		= $reference['QtyValue'];									
								$data['OutlogDetail']['price'] 		= $item['Item']['avg_price'];
								$data['OutlogDetail']['amount'] 	= $item['Item']['avg_price'] * $npbDetail['qty_filled'];
								$data['OutlogDetail']['posting'] 	= 1;
								$data['OutlogDetail']['npb_id'] 	= $npb_id;	
								$data['OutlogDetail']['retur_id'] 	= 0;				
								
								$qtyFill 	= $npbDetail['qty_filled'];
								$qty 		= $data['OutlogDetail']['qty'];
								
								$this->Outlog->OutlogDetail->create();
								$this->Outlog->OutlogDetail->save($data);
								$outlogDetailId = $this->Outlog->OutlogDetail->id;
								
								$price = $data['OutlogDetail']['price'];
								$amount = $data['OutlogDetail']['amount'];
								$outlogId = $this->Outlog->id;
								$itemId = $npbDetail['item_id'];
								$npbId = $this->data['Outlog']['npb_id'];
								
								//set qty_filled, set outlog_id
								$sql = 'update npb_details set outlog_id=' . $outlog_id . ' where id=' . $npb_detail_id;
								$this->Outlog->query($sql);
							}
						}
						
					}
					$this->Outlog->Npb->checkDone($npb_id);
				}
				$this->Session->setFlash(__('The outlog has been saved', true), 'default', array('class' => 'ok'));
				$this->redirect(array('action' => 'view', $this->Outlog->id));
			} else {
				$this->Session->setFlash(__('The outlog could not be saved. Please, try again.', true));
			}
		}
		
		$newId = $this->Outlog->getNewId();
		//$this->checking($npb_id); 
		//created from NPB ?
		if ($npb_id) 
		{
			$npb = $this->Outlog->Npb->read(null, $npb_id);
			//remove non stock items
			$n = 0;
			foreach($npb['NpbDetail'] as $detail){
				if($detail['process_type_id'] == procurement_process_type_id){
					unset($npb['NpbDetail'][$n]);
				}
					$n++;
			}
			$npb['NpbDetail'] = array_values($npb['NpbDetail']);	
			
			$conditions[]	= array('Item.id'=>$npb['NpbDetail']['0']['item_id']);
			$this->loadModel('Item');
			$con = $this->Item->find('all', array('conditions'=>$conditions));			
			
			$ass_cat_id		= $con[0]['Item']['asset_category_id'];		
			$balance 		= $con[0]['Item']['balance'];
			
			$conditions2[]	= array('Asset.id'=>$ass_cat_id);
			$this->loadModel('Asset');
			$con2 = $this->Asset->find('all', array('conditions'=>$conditions2));	
			
			$stock_qty = $con2[0]['Asset']['qty'];
			$stock_status = $con2[0]['Asset']['ada'];
			
			$npb['Item']['id'] = $npb['NpbDetail']['0']['item_id'];
			$npb['Item']['balance'] = $balance;
			$npb['Item']['stock_status'] = $stock_status;
			$npb['Item']['asset_category'] = $ass_cat_id;
			
			//echo "<pre>";
			//var_dump($npb);
			//echo "</pre>";die();							  
		}
		else
		{
			$npb=null;
		}
		$departments = $this->Outlog->Department->find('list');
		$this->set(compact('newId', 'departments', 'npb'));
    }
	  
		function addFromDO() {			
			$outlog = $this->params['outlogData'];			
			if (!empty($outlog)) {
				$this->data['Outlog']['no'] 		 		= $this->Outlog->getNewId();
				$this->data['Outlog']['outlog_status_id'] 	= status_outlog_finish_id;
				$this->data['Outlog']['approved_by'] 		= $outlog[0]['approved_date'] = $outlog[0]['reject_notes'] = $outlog[0]['reject_by'] = NULL;
				$this->data['Outlog']['reject_date'] 		= $outlog[0]['cancel_notes'] = $outlog[0]['cancel_by'] = $outlog[0]['cancel_date'] = NULL;
				$this->data['Outlog']['created_at']  		= date('Y-m-d H:i:s');
				$this->data['Outlog']['created_by']  		= $this->Session->read('Userinfo.username');
				$this->data['Outlog']['date']  		 		= date('Y-m-d');
				$this->data['Outlog']['is_printed']  		= '1';
				$this->data['Outlog']['npb_id']  	 		= $outlog[0]['outlogData']['npb_id'];
				$this->data['Outlog']['department_id']  	= $outlog[0]['outlogData']['department_id'];
				$this->data['Outlog']['business_type_id']  	= $outlog[0]['outlogData']['business_type_id'];
				$this->data['Outlog']['cost_center_id']  	= $outlog[0]['outlogData']['cost_center_id'];
				$this->Outlog->create();
				if ($this->Outlog->save($this->data)) {
					//echo '1';
					$outlog_id = $this->Outlog->id;
					$res = $this->Outlog->query('select count(*) as c from outlog_details where outlog_id = '.$outlog_id);
					$detailCount = $res[0][0]['c'];
					
					$itemId = $qtyFill = $price = $amount = $outlogDetailId = 0;
					if (isset($this->data['Outlog']['npb_id']) && $detailCount < 1) {  
						//echo '2';die();
						$npb_id = $this->data['Outlog']['npb_id'];
						
						$amt	= 0;
						
						App::import('Model','InventoryLedger');
						$InventoryLedger = new InventoryLedger;
						$itemBalances = $InventoryLedger->getItemBalances();
						
						$npb = $this->Outlog->Npb->read(null, $npb_id);
						foreach ($npb['NpbDetail'] as $npbDetail) {
							
							//qty_unfilled = qty yang diisi oleh user utk dipenuhi
							if ($npbDetail['qty_unfilled'] > 0 && isset($itemBalances[$npbDetail['item_id']])
									&& $itemBalances[$npbDetail['item_id']] >= $npbDetail['qty_unfilled']) {
								//echo '3';
								$npb_detail_id = $npbDetail['id'];
								$this->Outlog->OutlogDetail->Item->recursive = 0;
								$item = $this->Outlog->OutlogDetail->Item->read(null, $npbDetail['item_id']);
								
								$this->data['Outlog']['qty_fill'] = $npbDetail['qty_filled'];
								$this->data['Outlog']['qty_unfilled'] = $npbDetail['qty'] - $npbDetail['qty_filled'];
								
								$price	= $npbDetail['price'];
								$amount	= $price * $npbDetail['qty_unfilled'];
								
								$par['OutlogDetail']['outlog_id'] 	= $outlog_id;
								$par['OutlogDetail']['item_id'] 	= $npbDetail['item_id'];
								$par['OutlogDetail']['qty'] 		= $npbDetail['qty_unfilled'];
								$par['OutlogDetail']['price'] 		= intval($item['Item']['avg_price']);
								$par['OutlogDetail']['amount'] 		= $amount;
								$par['OutlogDetail']['posting'] 	= 1;
								$par['OutlogDetail']['npb_id'] 		= $npb_id;
								$par['OutlogDetail']['retur_id'] 	= 0;
								
								$qtyFill = $npbDetail['qty_filled'];
								
								//echo '<pre>';
								//var_dump($par);
								//echo '</pre>';die();
								
								$this->Outlog->OutlogDetail->create();
								$this->Outlog->OutlogDetail->save($par);
								$outlogDetailId = $this->Outlog->OutlogDetail->id;
								//echo '4';
								$sql = 'select qty_filled, qty_unfilled from npb_details where id=' . $npb_detail_id;
								$res = $this->Outlog->query($sql);
								$qty_filled = $res[0][0]['qty_filled'] + $qtyFill;
								$qty_unfilled = $res[0][0]['qty_unfilled'] - $qtyFill;
								
								//set qty_filled, set outlog_id
								$sql = 'update npb_details set outlog_id="' . $outlog_id . '", qty_filled="' . $qty_filled . '", qty_unfilled="' . $qty_unfilled . '" where id=' . $npb_detail_id;
								$this->Outlog->query($sql);
								
								//echo "<pre>";
								//var_dump($res);
								//echo "</pre>";die();
								
								$ledgerAmount = $par['OutlogDetail']['qty'] * $par['OutlogDetail']['price'];
								$po_id = $outlog[0]['outlogData']['po_id'];
								
								$paramLedger = array();
								$paramLedger['date'] 						= date('Y-m-d');
								$paramLedger['item_id'] 					= $par['OutlogDetail']['item_id'];
								$paramLedger['qty'] 						= $par['OutlogDetail']['qty'];
								$paramLedger['in_out'] 						= 'outlog';
								$paramLedger['price'] 						= $par['OutlogDetail']['price'];
								$paramLedger['amount'] 						= $par['OutlogDetail']['amount'];
								$paramLedger['doc_id'] 						= 0;
								$paramLedger['po_id'] 						= $po_id;
								$paramLedger['inlog_id'] 					= 0;
								$paramLedger['outlog_id'] 					= $outlog_id;
								$paramLedger['retur_id'] 					= 0;
								$paramLedger['supplier_retur_id'] 			= 0;
								$paramLedger['supplier_retur_detail_id'] 	= 0;
								$paramLedger['retur_detail_id'] 			= 0;
								$paramLedger['inlog_detail_id'] 			= 0;
								$paramLedger['outlog_detail_id'] 			= $outlogDetailId;
								$paramLedger['supplier_replace_id'] 		= 0;
								$paramLedger['supplier_replace_detail_id'] 	= 0;
								$paramLedger['department_id'] 				= $this->data['Outlog']['department_id'];
								$paramLedger['business_type_id'] 			= $this->data['Outlog']['business_type_id'];
								$paramLedger['cost_center_id'] 				= $this->data['Outlog']['cost_center_id'];
								$paramLedger['date_of_transaction'] 		= date('Y-m-d');
								$paramLedger['npb_id'] 						= $this->data['Outlog']['npb_id'];	
								$InventoryLedger->create();
								$InventoryLedger->save($paramLedger);
								//echo '5';
								
								App::import('Controller','InventoryLedgers');
								$inLed 	 = new InventoryLedgersController;		
								$journal = $inLed->insert_to_journal_csv('outlog', $outlog_id, $this->journal_group_distribute_hq_branch_id);
								
								//$inLed->generateCsv($journal);
								
								//****change status == status_npb_stock_manager_processed_id(done)
								// $status = status_npb_done_id;
								// $sql_status = 'update npbs set npb_status_id='.$status.' where id='.$npb_id;
								// $this->Outlog->query($sql_status);
							}
						}
						
						$journal = $InventoryLedger->insert_to_journal('outlog', $outlog_id, $this->journal_group_distribute_hq_branch_id);
						$this->Outlog->Npb->checkDone($npb_id);
						//echo '6';die();
					}
					return true;
				} else {
					return false;
				}
			}
			
		}
	  
	  function add_retur(){
        if(!empty($this->data)){
		
			$retur = $this->Outlog->Retur->read(null, $this->data['Outlog']['retur_id']);
			$this->data['Outlog']['department_id'] = $retur['Retur']['department_id'];
			$this->data['Outlog']['business_type_id'] = $retur['Retur']['business_type_id'];
			$this->data['Outlog']['cost_center_id'] = $retur['Retur']['cost_center_id'];
			
			$this->Outlog->create();
			if ($this->Outlog->save($this->data)) {
				foreach($retur['ReturDetail'] as $detil){
					  $data['OutlogDetail']['outlog_id'] = $this->Outlog->id;
					  $data['OutlogDetail']['retur_id'] = $retur['Retur']['id'];
					  $data['OutlogDetail']['qty'] = $detil['qty'];
					  $data['OutlogDetail']['item_id'] = $detil['item_id'];
					  $data['OutlogDetail']['posting'] = 0;
					  $data['OutlogDetail']['price'] = $detil['price'];
					  $data['OutlogDetail']['amount'] = $detil['amount'];
					  $this->Outlog->OutlogDetail->create();
					  $this->Outlog->OutlogDetail->save($data);
				}
				$this->Session->setFlash(__('The outlog has been saved', true), 'default', array('class' => 'ok'));
				$this->redirect(array('action' => 'view', $this->Outlog->id));
			} else {
				$this->Session->setFlash(__('The outlog could not be saved. Please, try again.', true));
			}

		}
		$newId = $this->Outlog->getNewId();
        $this->set(compact('newId'));
	  
	  }
	  
		function checking($npb_id){
	  
			$npb = $this->Outlog->Npb->read(null, $npb_id);
			//remove non stock items
			$n = 0;
			foreach($npb['NpbDetail'] as $detail){
				if($detail['process_type_id'] == procurement_process_type_id){
					unset($npb['NpbDetail'][$n]);
				}
				$n++;
			}
			$npb['NpbDetail'] = array_values($npb['NpbDetail']);	
			App::import('Model','InventoryLedger');
			$InventoryLedger = new InventoryLedger;
			$itemBalances = $InventoryLedger->getItemBalances();
			
			foreach($npb['NpbDetail'] as $npbDetail){
			$balance = $itemBalances[$npbDetail['item_id']]?$itemBalances[$npbDetail['item_id']]:0;
				if($balance < $npbDetail['qty_unfilled']){
					$this->Session->setFlash(__('The outlog could not be saved. Please, check stock available.', true));
					$this->redirect(array('controller'=>'npbs', 'action'=>'check_stock', $npb_id));
				}
			}

		}
	  
      function edit($id = null) {
            if (!$id && empty($this->data)) {
                  $this->Session->setFlash(__('Invalid outlog', true));
                  $this->redirect(array('action' => 'index'));
            }			
			
            if (!empty($this->data)) {					
					$data['Outlog']['id'] = $this->data['Outlog']['id'];
					$data['Outlog']['date'] = $this->data['Outlog']['date'];
					$data['Outlog']['notes'] = $this->data['Outlog']['notes'];
                if ($this->Outlog->save($data)) {
                    $this->Session->setFlash(__('The outlog has been saved', true), 'default', array('class' => 'ok'));
                    $this->redirect(array('action' => 'view', $id));
                } else {
                    $this->Session->setFlash(__('The outlog could not be saved. Please, try again.', true));
                }
            }
            if (empty($this->data)) {
                  $this->data = $this->Outlog->read(null, $id);
            }
			$outlog = $this->Outlog->read(null, $id);
            $departments = $this->Outlog->Department->find('list');
            $business_type_id = $this->Outlog->BusinessType->find('list');
            $cost_center_id = $this->Outlog->CostCenter->find('list');
            $this->set(compact('departments', 'outlog', 'business_type_id', 'cost_center_id'));
      }

      function delete($id = null) {
            if (!$id) {
                  $this->Session->setFlash(__('Invalid id for outlog', true));
                  $this->redirect(array('action' => 'index'));
            }

            //reset NPB detail 	qty  and status
            $outlog = $this->Outlog->read(null, $id);
            $npb_id = $outlog['Outlog']['npb_id'];

            //kalau ada detail outlogs, reset MR
            if(!empty($outlog['OutlogDetail']))
            {
                  foreach($outlog['OutlogDetail'] as $od)
                  {
                        $qty = $od['qty'];
                        //$sql = 'update npb_details set qty_filled=qty_filled-'.$qty.', qty_unfilled=qty_unfilled-'.$qty.', outlog_id=NULL where npb_id="' . $npb_id . '" and item_id=' . $od['item_id'];
						//seharusnya kembali ke qty MR awal
						$sql = 'update npb_details set qty_filled=0, qty_unfilled=qty, outlog_id=NULL where npb_id="' . $npb_id . '" and item_id=' . $od['item_id'];
                        $this->Outlog->query($sql);
                  }
                  $sql = 'update npbs set npb_status_id = ' . status_npb_processing_id . ' where id="' . $npb_id . '"';
                  $this->Outlog->query($sql);
            }
            
            if ($this->Outlog->delete($id)) {
                  $this->Session->setFlash(__('Outlog deleted', true), 'default', array('class' => 'ok'));
                  $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Outlog was not deleted', true));
            $this->redirect(array('action' => 'index'));
      }
	  
		function update_status_outlog($ids=null, $new_status=null) {
            if (!$ids) {
                  $this->Session->setFlash(__('Invalid outlog', true));
                  $this->redirect(array('action' => 'view', $id));
            }
			foreach($ids as $data){
				$id = $data['id'];
				if ($new_status == status_outlog_approved_id) {
					$this->data['Outlog']['approved_date'] 		= date('Y-m-d H:i:s');
					$this->data['Outlog']['approved_by'] 		= $this->Session->read('Userinfo.username');
					$this->data['Outlog']['outlog_status_id'] 	= $new_status;
					$this->data['Outlog']['id'] 				= $id;
				}	
				if ($this->Outlog->save($this->data)) {
					if ($new_status == status_outlog_approved_id) {
						$this->save_to_ledger($id);
					}
				}
			}
			$this->redirect(array('action' => 'index'));
		}

		function update_status($id=null, $new_status=null) {
            if (!$id && empty($this->data)) {
                  $this->Session->setFlash(__('Invalid outlog', true));
                  $this->redirect(array('action' => 'view', $id));
            }
            $outlog = $this->Outlog->read(null, $id);
            $this->Outlog->set('outlog_status_id', $new_status);
            if ($new_status == status_outlog_approved_id) {
                  $this->data['Outlog']['approved_date'] 	= date('Y-m-d H:i:s');
                  $this->data['Outlog']['approved_by'] 		= $this->Session->read('Userinfo.username');
				  $this->data['Outlog']['outlog_status_id'] = $new_status;
				  $this->data['Outlog']['id'] 				= $id;
            }
			//if($this->configs['journal_cut_off'] > date('H:i:s'))
			if(true)
			{				
				if ($this->Outlog->save($this->data)) {
					if ($new_status == status_outlog_approved_id) {
						$this->save_to_ledger($id);
					}
						$this->Session->setFlash(__('The outlog status has been saved', true), 'default', array('class' => 'ok'));
						if($new_status == status_outlog_approved_id)
						{
							$this->redirect(array('action' => 'index', status_outlog_sent_to_supervisor_id));
						}
						else
						{
							$this->redirect(array('action' => 'index', status_outlog_sent_to_supervisor_id));
						}
				} else {
					  $this->Session->setFlash(__('The outlog status could not be saved. Please, try again.', true));
				}
			}
			else
			{
				//$this->Session->setFlash(__('Outlog can not be processed because it exceeded the time of '.$this->configs['journal_cut_off'], true));
				$this->redirect(array('controller' => 'outlogs', 'action' => 'view', $id));
			}

            $this->redirect(array('action' => 'view', $id));
		}
	  
		function save_to_ledger($outlog_id = null){
			$outlogs = $this->Outlog->findById($outlog_id);
			$npb_id = $outlogs['Npb']['id'];
			$ccid	= $outlogs['CostCenter']['id'];
			$deid	= $outlogs['Department']['id'];
			$btid	= $outlogs['Outlog']['business_type_id'];
			
			if(!empty($outlogs)){
				App::import('Model','InventoryLedger');
				$InventoryLedger = new InventoryLedger;
				$itemBalances = $InventoryLedger->getItemBalances();
				foreach($outlogs['OutlogDetail'] as $outlogDetail){					
				//var_dump($outlogDetail);					
					//$this->loadModel('InventoryLedger');
					$paramLedger = array();
					$paramLedger['date'] 						= date('Y-m-d');
					$paramLedger['item_id'] 					= $outlogDetail['item_id'];
					$paramLedger['qty'] 						= $outlogDetail['qty'];
					$paramLedger['in_out'] 						= 'outlog';
					$paramLedger['price'] 						= $outlogDetail['price'];
					$paramLedger['amount'] 						= $outlogDetail['amount'];
					$paramLedger['doc_id'] 						= 0;
					$paramLedger['po_id'] 						= 0;
					$paramLedger['inlog_id'] 					= 0;
					$paramLedger['outlog_id'] 					= $outlog_id;
					$paramLedger['retur_id'] 					= 0;
					$paramLedger['supplier_retur_id'] 			= 0;
					$paramLedger['supplier_retur_detail_id'] 	= 0;
					$paramLedger['retur_detail_id'] 			= 0;
					$paramLedger['inlog_detail_id'] 			= 0;
					$paramLedger['outlog_detail_id'] 			= $outlogDetail['id'];
					$paramLedger['supplier_replace_id'] 		= 0;
					$paramLedger['supplier_replace_detail_id'] 	= 0;
					$paramLedger['department_id'] 				= $deid;
					$paramLedger['business_type_id'] 			= $btid;
					$paramLedger['cost_center_id'] 				= $ccid;
					$paramLedger['date_of_transaction'] 		= date('Y-m-d');
					$paramLedger['npb_id'] 						= $outlogDetail['npb_id'];
					
					$InventoryLedger->create();
					$InventoryLedger->save($paramLedger);
					//$this->InventoryLedger->save($paramLedger);
					
					$npb = $this->Outlog->Npb->read(null, $outlogDetail['npb_id']);
					foreach ($npb['NpbDetail'] as $npbDetail) {
						$npb_detail_id = $npbDetail['id'];
						
						$sql = 'select qty,qty_filled, qty_unfilled, item_id from npb_details where id=' . $npb_detail_id;
						$res = $this->Outlog->query($sql);
						//change double qty
						$qty_filled = $res[0][0]['qty_filled']; //+ $outlogDetail['qty'];
						$qty_unfilled = $res[0][0]['qty_unfilled']; //- $outlogDetail['qty'];
						$qty_npb = $res[0][0]['qty'];
						$itemIDNpb = $res[0][0]['item_id'];
						
						if($outlogDetail['item_id'] == $itemIDNpb){
							$sql = 'update npb_details set qty_filled= qty_filled+' . $qty_filled . ', qty_unfilled=qty-qty_filled-' . $qty_unfilled . ' where id=' . $npb_detail_id .' and item_id = ' .$itemIDNpb;
							$this->Outlog->query($sql);
						}
					}//set new qty
				}//end of outlog detail 				
			}//end of outlog check
		}

      function cancel($id = null) {
            //view Outlog
            if (!$id) {
                  $this->Session->setFlash(__('Invalid Outlog', true));
                  $this->redirect(array('action' => 'index'));
            }
            $this->Outlog->read(null, $id);

            //Add Notes Reject Outlog and Change Status
            if (!empty($this->data)) {
                  $this->data['Outlog']['id'] = $id;
                  $this->data['Outlog']['outlog_status_id'] = status_outlog_draft_id;
                  if ($this->Outlog->save($this->data)) {
                        $this->Session->setFlash(__('The Outlog has been saved', true), 'default', array('class' => 'ok'));
                        $this->redirect(array('action' => 'index'));
                  } else {
                        $this->Session->setFlash(__('The Outlog could not be saved. Please, try again.', true));
                  }
            }
            if (empty($this->data)) {
                  $outlog = $this->data = $this->Outlog->read(null, $id);
            }
            $departments = $this->Outlog->Department->find('list');
            $assetCategories = $this->Outlog->OutlogDetail->Item->AssetCategory->find('list');
            $units = $this->Outlog->OutlogDetail->Item->Unit->find('list');
            $outlogStatus = $this->Outlog->OutlogStatus->find('list');
            $this->set(compact('outlog', 'departments', 'outlogStatus', 'assetCategories', 'units'));
      }

      function reject($id = null) {
            //view Outlog
            if (!$id) {
                  $this->Session->setFlash(__('Invalid Outlog', true));
                  $this->redirect(array('action' => 'index'));
            }
            $this->Outlog->read(null, $id);

            //Add Notes Reject Outlog and Change Status
            if (!empty($this->data)) {
                  $this->data['Outlog']['id'] = $id;
                  $this->data['Outlog']['outlog_status_id'] = status_outlog_reject_id;
                  if ($this->Outlog->save($this->data)) {
                        $this->Session->setFlash(__('The Outlog has been saved', true), 'default', array('class' => 'ok'));
                        $this->redirect(array('action' => 'index'));
                  } else {
                        $this->Session->setFlash(__('The Outlog could not be saved. Please, try again.', true));
                  }
            }
            if (empty($this->data)) {
                  $outlog = $this->data = $this->Outlog->read(null, $id);
            }
            $departments = $this->Outlog->Department->find('list');
            $assetCategories = $this->Outlog->OutlogDetail->Item->AssetCategory->find('list');
            $outlogStatus = $this->Outlog->OutlogStatus->find('list');
            $units = $this->Outlog->OutlogDetail->Item->Unit->find('list');
            $this->set(compact('outlog', 'departments', 'outlogStatus', 'assetCategories', 'units'));
      }

      function archive($id = null) {
            //view Outlog
            if (!$id) {
                  $this->Session->setFlash(__('Invalid Outlog', true));
                  $this->redirect(array('action' => 'index'));
            }

            $this->data['Outlog']['id'] = $id;
            $this->data['Outlog']['outlog_status_id'] = status_outlog_archive_id;
            if ($this->Outlog->save($this->data)) {
                  $this->Session->setFlash(__('The Outlog has been saved', true), 'default', array('class' => 'ok'));
                  $this->redirect(array('action' => 'index'));
            } else {
                  $this->Session->setFlash(__('The Outlog could not be saved. Please, try again.', true));
            }
      }

}

?>