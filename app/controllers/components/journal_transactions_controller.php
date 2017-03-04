<?php
App::import('Model','Asset');
App::import('Model','Invoice');
App::import('Model','InvoicePayment');
App::import('Model','Movement');
App::import('Model','Department');
App::import('Model','Disposal');
App::import('Model','SupplierRetur');
App::import('Model','Retur');
App::import('Model','Inlog');
App::import('Model','Outlog');
App::import('Model','Po');
App::import('Model','DeliveryOrder');
App::import('Model','Usage');
define('ACCOUNT_CURRENCY_IDR_CODE','360');
define('HQ_DEPARTMENT_ID','19');

class JournalTransactionsController extends AppController {

	var $name = 'JournalTransactions';
    var $paginate = array(
        'limit' => 10,
        'order' => array(
            'JournalTransaction.id' => 'asc'
        )
    );
	
	
	function prepare_invoice_posting($doc_id=null)
	{
		$this->Session->write('JournalTransaction.doc_id',$doc_id);
		//$this->Session->write('JournalTransaction.journal_group_id',$journal_group_id);
		$departments 			= $this->JournalTransaction->Department->find('list');
		$departmentAccountCodes = $this->JournalTransaction->Department->find('list', array('fields'=>array('account_code')));
		
		$Invoice 		= new Invoice;
		$InvoicePayment = new InvoicePayment;
		$invoice 		= $Invoice->read(null, $doc_id);
		$invoice_id		= $doc_id;
		$department_id	= HQ_DEPARTMENT_ID ;

		$action 		= 'posting_invoice';
		$doc_id 		= 'invoice_id';

		//jumlah record details di jurnal template, utk langkap record di journal trx
		$detailSize 	= 2;
		$detail_source 	= 'invoice';

		$total_dp = 0;
		foreach($invoice['Po'] as $po)
		{
			$total_dp += $po['down_payment'];
		}
		
		$payments = count($invoice['InvoicePayment']);
		
		$accountNames 		= $this->JournalTransaction->Account->find('list', array('fields'=>array('Account.name')));
		$accountCodes 		= $this->JournalTransaction->Account->find('list', array('fields'=>array('Account.gl')));
		$journalPositions 	= $this->JournalTransaction->JournalPosition->find('list');		
		$journalLines		= array();
		$total_amount 		= 0;
		$offset_detail_dp 	= 0;
		
		//kalau ada dp
		if($total_dp)
		{
			// DP
			$start_index 		= 0;
			$amount				= $total_dp;
			$journal_group_id 	= journal_group_down_payment_id;
			$tmp				= $this->generatePaymentJournalLines($start_index, $amount, $department_id,$invoice_id, $journal_group_id,$departmentAccountCodes,$accountNames ,$accountCodes, $journalPositions);
			$journalLines 		+= $tmp;
			$offset_detail_dp 	= 2;
			$total_amount 		+= $amount;
		}
		
		// ada dp atau beberapa pembayarans...	
		if($payments > 1 || $total_dp)
		{
			foreach($invoice['InvoicePayment'] as $payment_index=>$invoicePayment)
			{
				$tmp				= array();
				$amount_paid		= $invoicePayment['amount_paid'];
				$journal_group_id 	= journal_group_down_payment_id;					
				$start_index 		= $detailSize*($payment_index) + $offset_detail_dp;
				$is_lunas 			= $invoicePayment['amount_due']==$invoicePayment['amount_paid'];
				
				$tmp=$this->generatePaymentJournalLines($start_index,$amount_paid,$department_id,$invoice_id,$journal_group_id,$departmentAccountCodes,$accountNames ,$accountCodes, $journalPositions);

				//pembayaran pertama, kurangi dulu dgn dp
				if($payment_index==0)
				{
					$tmp[$start_index]['amount_db'] 	= $amount_paid - $total_dp;
					$tmp[$start_index]['amount_cr']		= 0;
					$tmp[$start_index+1]['amount_db']	= 0;
					$tmp[$start_index+1]['amount_cr'] 	= $amount_paid - $total_dp;					
					$total_amount += $amount_paid-$total_dp;
				}
				else
				{
					$tmp[$start_index]['amount_db'] 	= $amount_paid;
					$tmp[$start_index]['amount_cr']		= 0;
					$tmp[$start_index+1]['amount_db']	= 0;
					$tmp[$start_index+1]['amount_cr'] 	= $amount_paid;	
					$total_amount += $amount_paid;
				}
				$journalLines += $tmp;
			
				// journal pelunasan
				if($is_lunas)
				{
					$start_index=count($journalLines);
					$journal_group_id = journal_group_purchase_id;
					$tmp=$this->generatePaymentJournalLines($start_index,$total_amount, $department_id,$invoice_id, $journal_group_id,$departmentAccountCodes,$accountNames ,$accountCodes, $journalPositions);
					$journalLines += $tmp;
				}
			}
		}
		else // 1 kali pembayaran
		{
			$invoicePayment		= $invoice['InvoicePayment'][0];
			$total_amount		= $invoicePayment['amount_paid'];
			$start_index		= 0;
			$journal_group_id 	= journal_group_purchase_id;
			$tmp=$this->generatePaymentJournalLines($start_index,$total_amount, $department_id,$invoice_id, $journal_group_id,$departmentAccountCodes,$accountNames ,$accountCodes, $journalPositions);
			$journalLines += $tmp;		
		}
		
		$journalTemplates = $this->JournalTransaction->JournalTemplate->find('list');
		$this->set(compact(
			'journalLines',
			'journal_group_id', 
			'journal_template_id', 
			'journalTemplates',
			'action',
			'departments')
		);	
		$this->render('prepare_posting');
	}
	
	function generatePaymentJournalLines($start_index,$amount, $department_id,$invoice_id, $journal_group_id,$departmentAccountCodes,$accountNames ,$accountCodes, $journalPositions )
	{
		$journalLines = null;
	
		//$assetCategoryId = $detail[$model]['asset_category_id'];
		$journalTemplate = $this->JournalTransaction->JournalTemplate->find('first', 
			array('conditions'=>array('journal_group_id'=>$journal_group_id))
		);
		
		if(!empty($journalTemplate))
		{
			foreach ($journalTemplate['JournalTemplateDetail'] as $j=>$jtd)
			{
				$index			=$start_index + $j;
				$amount_db		=$jtd['journal_position_id']==1?$amount :"";
				$amount_cr		=$jtd['journal_position_id']==2?$amount :"";
				$journalLines[$index]['department_id']			= $department_id;
				$journalLines[$index]['account_code']			= $departmentAccountCodes[$department_id] . '.'.ACCOUNT_CURRENCY_IDR_CODE.'.' . $accountCodes[$jtd['account_id']]; 

				$journalLines[$index]['date']					= date("Y-m-d");
				$journalLines[$index]['account_id']				= $jtd['account_id'];
				$journalLines[$index]['account_name']			= $accountNames[$jtd['account_id']];
				$journalLines[$index]['journal_position_id']	= $jtd['journal_position_id'];
				$journalLines[$index]['journal_position_name']	= $journalPositions[$jtd['journal_position_id']];
				
				$journalLines[$index]['amount_db']				= abs($amount_db);
				$journalLines[$index]['amount_cr']				= abs($amount_cr);
				$journalLines[$index]['journal_template_id']	= $jtd['journal_template_id']; 
				$journalLines[$index]['reff']					= array('detail_source'=>'invoice', 'id'=>$invoice_id);
				
			}// foreach 
			
		}//emtpy	
		
		return $journalLines;
	}
	
	function prepare_posting($detail_source=null, $journal_group_id=null, $doc_id=null)
	{

		$this->Session->write('JournalTransaction.doc_id',$doc_id);
		$this->Session->write('JournalTransaction.journal_group_id',$journal_group_id);
		$departments = $this->JournalTransaction->Department->find('list');
		$departmentAccountCodes = $this->JournalTransaction->Department->find('list', array('fields'=>array('account_code')));
		
		$Asset = new Asset;
		$Invoice = new Invoice;
		$InvoicePayment = new InvoicePayment;
		$Movement = new Movement;
		$Department = new Department;
		$Disposal = new Disposal;
		$Inlog = new Inlog;
		$Outlog = new Outlog;
		$Retur = new Retur;
		$SupplierRetur = new SupplierRetur;
		$Usage = new Usage;
		$Po = new Po;
		$DeliveryOrder = new DeliveryOrder;
		
		/// check the type of details 
		if(empty($detail_source))
		{
			$this->Session->flash(__('Please specify the details to create the journal from',true));
			$this->redirect(array('controller'=>'journal_transactions','action' => 'index'));		
		}
		
		/// check the journal group
		if(empty($journal_group_id))
		{
			$this->Session->flash(__('Please specify the journal group to create the journal from',true));
			$this->redirect(array('controller'=>'journal_transactions','action' => 'index'));		
		}		
		
		/// check the type of details
		if($detail_source=='invoice') //one time invoice payment
		{
			if(empty($doc_id))
			{
				$this->Session->flash(__('Please specify the invoice id for this type of detail source',true));
				$this->redirect(array('controller'=>'journal_transactions','action' => 'index'));		
			}		
			$action = 'posting_invoice';
			$details = $Invoice->InvoiceDetail->find('all', array('conditions'=>array('invoice_id'=>$doc_id )) );
			$model='InvoiceDetail';
			$amount_field = 'amount_nett';
			$doc_id = 'invoice_id';
			//jumlah record details di jurnal template, utk langkap record di journal trx
			$detailSize = 2;
		}
		else if($detail_source=='invoice_payment') // partial invoice payment
		{
			if(empty($doc_id))
			{
				$this->Session->flash(__('Please specify the invoice payment id for this type of detail source',true));
				$this->redirect(array('controller'=>'journal_transactions','action' => 'index'));		
			}		
			$action = 'posting_invoice_payment';
			$invoicePayment = $InvoicePayment->read(null, $doc_id);
			$invoiceId = $invoicePayment['Invoice']['id'];
			$details = $InvoicePayment->Invoice->InvoiceDetail->find('all', array('conditions'=>array('invoice_id'=>$invoiceId )) );
			$model='InvoiceDetail';
			$amount_field = 'amount_nett';
			$doc_id = 'invoice_id';
			//jumlah record details di jurnal template, utk langkap record di journal trx
			$detailSize = 2;
			
			$percentage = $invoicePayment['InvoicePayment']['amount_paid'] / $invoicePayment['Invoice']['total'];
		}
		
		else if($detail_source=='po') 
		{
			if(empty($doc_id))
			{
				$this->Session->flash(__('Please specify the PO id for this type of detail source',true));
				$this->redirect(array('controller'=>'journal_transactions','action' => 'index'));		
			}		
			
			$action = 'posting_po';

			$details = $Po->PoDetail->find('all', array('conditions'=>array('po_id'=>$doc_id )) );
			
			//dihitung dari down payment / total 
			$percentage = $details[0]['Po']['down_payment'] / $details[0]['Po']['total_cur'];

			$model='PoDetail';
			$amount_field = 'amount_nett_cur';
			$doc_id = 'po_id';
			//jumlah record details di jurnal template, utk langkap record di journal trx
			$detailSize = 2;
			
		}
		else if($detail_source=='delivery_order') 
		{
			if(empty($doc_id))
			{
				$this->Session->flash(__('Please specify the Delivery Oorder id for this type of detail source',true));
				$this->redirect(array('controller'=>'journal_transactions','action' => 'index'));		
			}		
			
			$action = 'posting_delivery_order';

			$details = $DeliveryOrder->DeliveryOrderDetail->find('all', array('conditions'=>array('delivery_order_id'=>$doc_id )) );			
			
			$down_payment = $details[0]['Po']['down_payment'];
			$is_first_delivery_order    = $details[0]['DeliveryOrder']['is_first'];
			$line_count   = count($details);
			
			$model='DeliveryOrderDetail';
			$amount_field = 'amount_nett_cur';
			$doc_id = 'delivery_order_id';
			$detailSize = 2;
			
		}		
		
		else if($detail_source=='asset')
		{
			$action = 'posting_asset';
			$details = $Asset->find('all', array('conditions'=>array('posting'=>0, 'price >'=>$this->configs['min_asset_value'])));
			$model='Asset';
			$amount_field = 'depbln';
			$doc_id = 'id';
			$detailSize = 2;
		}
		else if($detail_source=='movement')
		{
			$action = 'posting_movement';
			$movement = $Movement->read(null, $doc_id);
			$details = $Movement->MovementDetail->find('all', array('conditions'=>array('MovementDetail.movement_id'=>$doc_id )));
			$model='MovementDetail';
			
			//get source and dest department
			$source_dept_id = $movement['Movement']['source_department_id'];
			$source_dept = $Department->read(null, $source_dept_id);
			$dest_dept_id = $movement['Movement']['dest_department_id'];
			$dest_dept = $Department->read(null, $dest_dept_id);	
			$doc_id = 'id';
			$detailSize = 3;
		}
		else if($detail_source=='disposal')
		{
			if(empty($doc_id))
			{
				$this->Session->flash(__('Please specify the Disposal id for this type of detail source',true));
				$this->redirect(array('controller'=>'journal_transactions','action' => 'index'));		
			}	
			$disposal = $Disposal->read(null, $doc_id);
			$department_id = $disposal['Disposal']['department_id'];
			$disposal_type_id = $disposal['Disposal']['disposal_type_id'];
			
			$action = 'posting_disposal';
			$details = $Disposal->DisposalDetail->find('all', array('conditions'=>array('disposal_id'=>$doc_id )) );
			$model='DisposalDetail';
			$doc_id = 'disposal_id';
			$detailSize = 4;
		}
		else if($detail_source=='outlog')
		{
			if(empty($doc_id))
			{
				$this->Session->flash(__('Please specify the outlog id for this type of detail source',true));
				$this->redirect(array('controller'=>'journal_transactions','action' => 'index'));		
			}		
			$action = 'posting_outlog';
			$details = $Outlog->OutlogDetail->find('all', array('conditions'=>array('OutlogDetail.outlog_id'=>$doc_id )) );
			$model='OutlogDetail';
			$department_id = $details[0]['Outlog']['department_id'];
			
			//isi dulu asset_category_id  
			foreach($details as $i=>$d){
				$details[$i][$model]['asset_category_id']=$d['Item']['asset_category_id'];
				$details[$i][$model]['department_id']=$department_id; /// nanti ganti dibawah menjadi kantor pusat, jika account = persediaan
			}			
			$amount_field = 'amount';
			$doc_id = 'outlog_id';
			
			//jumlah record details di jurnal template, utk langkap record di journal trx
			$detailSize = 2;			
		}
		else if($detail_source=='inlog')
		{
		}
		else if($detail_source=='usage')
		{
			if(empty($doc_id))
			{
				$this->Session->flash(__('Please specify the usage id for this type of detail source',true));
				$this->redirect(array('controller'=>'journal_transactions','action' => 'index'));		
			}		
			$action = 'posting_usage';
			$details = $Usage->UsageDetail->find('all', array('conditions'=>array('usage_id'=>$doc_id )) );
			$model='UsageDetail';
			$department_id = $details[0]['Usage']['department_id'];
			
			//isi dulu asset_category_id dan department_id
			foreach($details as $i=>$d){
				$details[$i][$model]['asset_category_id']=$d['Item']['asset_category_id'];
				$details[$i][$model]['department_id']=$department_id;
			}			
			$amount_field = 'amount';
			$doc_id = 'usage_id';
			
			//jumlah record details di jurnal template, utk langkap record di journal trx
			$detailSize = 2;				
		}
		else if($detail_source=='retur')
		{
			if(empty($doc_id))
			{
				$this->Session->flash(__('Please specify the retur id for this type of detail source',true));
				$this->redirect(array('controller'=>'journal_transactions','action' => 'index'));		
			}		
			$action = 'posting_retur';
			$details = $Retur->ReturDetail->find('all', array('conditions'=>array('retur_id'=>$doc_id )) );
			$model='ReturDetail';
			$department_id = $details[0]['Retur']['department_id'];
			
			//isi dulu asset_category_id dan department_id
			foreach($details as $i=>$d){
				$details[$i][$model]['asset_category_id']=$d['Item']['asset_category_id'];
				$details[$i][$model]['department_id']=$department_id;
			}			
			$amount_field = 'amount';
			$doc_id = 'retur_id';
			
			//jumlah record details di jurnal template, utk langkap record di journal trx
			$detailSize = 2;			
		}
		else if($detail_source=='supplier_retur')
		{
			if(empty($doc_id))
			{
				$this->Session->flash(__('Please specify the supplier retur id for this type of detail source',true));
				$this->redirect(array('controller'=>'journal_transactions','action' => 'index'));		
			}		
			$action = 'posting_supplier_retur';
			$details = $SupplierRetur->SupplierReturDetail->find('all', array('conditions'=>array('supplier_retur_id'=>$doc_id )) );
			$model='SupplierReturDetail';
			
			//isi dulu asset_category_id dan department_id
			foreach($details as $i=>$d){
				$details[$i][$model]['asset_category_id']=$d['Item']['asset_category_id'];
				$details[$i][$model]['department_id'] = HQ_DEPARTMENT_ID;
			}
			
			$amount_field = 'amount';
			$doc_id = 'supplier_retur_id';
			
			//jumlah record details di jurnal template, utk langkap record di journal trx
			$detailSize = 2;		
		}
		
		$accountNames = $this->JournalTransaction->Account->find('list', array('fields'=>array('Account.name')));
		$accountCodes = $this->JournalTransaction->Account->find('list', array('fields'=>array('Account.gl')));
		$journalPositions = $this->JournalTransaction->JournalPosition->find('list');		
		$journalLines=null;
		
		//untuk setiap items, cari journal template * detail nya
		foreach($details as $i=>$detail)
		{
			$amount_cr = $amount_db = 0;
			$assetCategoryId = $detail[$model]['asset_category_id'];
			$journalTemplate = $this->JournalTransaction->JournalTemplate->find('first', 
				array('conditions'=>array(
					'journal_group_id'=>$journal_group_id,
					'asset_category_id'=>$assetCategoryId))
			);

			// filter template_details specific for profit or loss sales disposal
			if($detail_source=='disposal')
			{
				$tmp=array();
				$loss_profit = $detail[$model]['loss_profit_amount'];
				foreach ($journalTemplate['JournalTemplateDetail'] as $jtd)
				{
					if($jtd['for_profit_sales']==0 && $loss_profit<0)
					{
						$tmp['JournalTemplateDetail'][] = $jtd;
					}
					else if($jtd['for_profit_sales']==1 && $loss_profit>=0)
					{
						$tmp['JournalTemplateDetail'][] = $jtd;
					}					
				}
				unset($journalTemplate['JournalTemplateDetail']);
				$journalTemplate['JournalTemplateDetail']  = $tmp['JournalTemplateDetail'];
			}
		
			// echo $detail[$model]['id'] . ' loss_profit:'.$loss_profit .'<br>';
			// var_dump($journalTemplate['JournalTemplateDetail']);

			if(!empty($journalTemplate))
			{
				foreach ($journalTemplate['JournalTemplateDetail'] as $j=>$jtd)
				{
					$index=$detailSize*$i + $j;

					if($detail_source=='invoice')
					{
						// $account_id		=$jtd['account_id'];
						// $account 		=$this->JournalTransaction->Account->read(null, $account_id);
						// $account_type_id=$account['Account']['account_type_id'];

						$amount_db		=$jtd['journal_position_id']==1?$detail[$model][$amount_field]:"";
						$amount_cr		=$jtd['journal_position_id']==2?$detail[$model][$amount_field]:"";
						$journalLines[$index]['department_id']	= $detail[$model]['department_id'];
						$journalLines[$index]['account_code']	= $departmentAccountCodes[$detail[$model]['department_id']] . '.'.ACCOUNT_CURRENCY_IDR_CODE.'.' . $accountCodes[$jtd['account_id']]; 
					}
					else if($detail_source=='invoice_payment')
					{
						$amount_db		=$jtd['journal_position_id']==1?$detail[$model][$amount_field]*$percentage:"";
						$amount_cr		=$jtd['journal_position_id']==2?$detail[$model][$amount_field]*$percentage:"";
						$journalLines[$index]['department_id']	= $detail[$model]['department_id'];
						$journalLines[$index]['account_code']	= $departmentAccountCodes[$detail[$model]['department_id']] . '.'.ACCOUNT_CURRENCY_IDR_CODE.'.' . $accountCodes[$jtd['account_id']]; 
					}	
					else if($detail_source=='po')
					{
						$amount_db		=$jtd['journal_position_id']==1?$detail[$model][$amount_field]*$percentage:"";
						$amount_cr		=$jtd['journal_position_id']==2?$detail[$model][$amount_field]*$percentage:"";
						$journalLines[$index]['department_id']	= $detail[$model]['department_id'];
						$journalLines[$index]['account_code']	= $departmentAccountCodes[$detail[$model]['department_id']] . '.'.ACCOUNT_CURRENCY_IDR_CODE.'.' . $accountCodes[$jtd['account_id']]; 
					}						
					else if($detail_source=='delivery_order')
					{
						$amount_db		=$jtd['journal_position_id']==1?$detail[$model][$amount_field]:"";
						$amount_cr		=$jtd['journal_position_id']==2?$detail[$model][$amount_field]:"";

						$account_id		=$jtd['account_id'];
						$account 		=$this->JournalTransaction->Account->read(null, $account_id);
						$account_type_id=$account['Account']['account_type_id'];
						//jika ada $down_payment dan delivery_order pertama, 
						// maka tambahkan di credit account uang muka,
						// jumlah credit dikurangi dgn $down_payment
						if($down_payment>0 && $is_first_delivery_order==1)
						{

							if($account_type_id == account_type_supplier_payable_id)
								$amount_cr -= $down_payment/$line_count;
							else if($account_type_id == account_type_down_payment_id)
								$amount_cr = $down_payment;

						}else{
							if($account_type_id == account_type_down_payment_id){
								$amount_db=0;
								$amount_cr=0;
							}
						}

						
						$journalLines[$index]['department_id']	= $detail[$model]['department_id'];
						$journalLines[$index]['account_code']	= $departmentAccountCodes[$detail[$model]['department_id']] . '.'.ACCOUNT_CURRENCY_IDR_CODE.'.' . $accountCodes[$jtd['account_id']]; 
					}	
					else if($detail_source=='asset')
					{
						$amount_db		=$jtd['journal_position_id']==1?$detail[$model][$amount_field]:"";
						$amount_cr		=$jtd['journal_position_id']==2?$detail[$model][$amount_field]:"";
						$journalLines[$index]['department_id']	= $detail[$model]['department_id'];
						$journalLines[$index]['account_code']	= $detail['Department']['account_code'] .  '.'.ACCOUNT_CURRENCY_IDR_CODE.'.'  . $accountCodes[$jtd['account_id']]; 
					}
					else if($detail_source=='movement')
					{
					
						//cari kolom jumlah dari movement_details berdasasran account_type_id:
						//accumulasi     : accum_dep
						//harga perolehan: price
						//cabang         : book_value
						
						$account_id		=$jtd['account_id'];
						$account 		=$this->JournalTransaction->Account->read(null, $account_id);
						$account_type_id=$account['Account']['account_type_id'];
						$journalLines[$index]['account_name'] = '';
						switch ($account_type_id){
							case account_type_accum_dep_id:
								$amount_field = 'accum_dep';
								if($jtd['for_destination_branch'] == 0)
								{
									$journalLines[$index]['account_code']	= $departmentAccountCodes[$source_dept_id] .  '.'.ACCOUNT_CURRENCY_IDR_CODE.'.'  . $accountCodes[$jtd['account_id']]; 
									$journalLines[$index]['department_id']	= $source_dept_id ;
								}
								else
								{
									$journalLines[$index]['account_code']	= $departmentAccountCodes[$dest_dept_id] .  '.'.ACCOUNT_CURRENCY_IDR_CODE.'.'  . $accountCodes[$jtd['account_id']]; 
									$journalLines[$index]['department_id']	= $dest_dept_id ;
								}
								break;
							case account_type_dest_dept_id:
								$amount_field = 'book_value';
								$journalLines[$index]['account_code']	= $departmentAccountCodes[$source_dept_id] .  '.'.ACCOUNT_CURRENCY_IDR_CODE.'.'  . $departmentAccountCodes[$dest_dept_id] ; 
								$journalLines[$index]['department_id']	= $source_dept_id ;
								$journalLines[$index]['account_name']   .= ' '. $dest_dept['Department']['name'];
								break;
							case account_type_source_dept_id:
								$amount_field = 'book_value';
								$journalLines[$index]['account_code']	= $departmentAccountCodes[$dest_dept_id] .  '.'.ACCOUNT_CURRENCY_IDR_CODE.'.'  . $departmentAccountCodes[$source_dept_id] ; 
								$journalLines[$index]['account_name']   .= ' ' .$source_dept['Department']['name'];
								if($jtd['for_destination_branch'] == 0)
								{
									$journalLines[$index]['department_id']	= $source_dept_id ;
								}
								else
								{
									$journalLines[$index]['department_id']	= $dest_dept_id ;
								}
								break;

							case account_type_acquisition_price_id:
								$amount_field = 'price';
								if($jtd['for_destination_branch'] == 0)
								{
									$journalLines[$index]['account_code']	= $departmentAccountCodes[$source_dept_id] .  '.'.ACCOUNT_CURRENCY_IDR_CODE.'.'  . $accountCodes[$jtd['account_id']]; 
									$journalLines[$index]['department_id']	= $source_dept_id ;
								}
								else
								{
									$journalLines[$index]['account_code']	= $departmentAccountCodes[$dest_dept_id] .  '.'.ACCOUNT_CURRENCY_IDR_CODE.'.'  . $accountCodes[$jtd['account_id']]; 
									$journalLines[$index]['department_id']	= $dest_dept_id ;
								}
								break;
						}
						$amount_db	=$jtd['journal_position_id']==1?$detail[$model][$amount_field]:"";
						$amount_cr	=$jtd['journal_position_id']==2?$detail[$model][$amount_field]:"";
						
					}
					else if($detail_source=='disposal')
					{
						$account_id		=$jtd['account_id'];
						$account 		=$this->JournalTransaction->Account->read(null, $account_id);
						$account_type_id=$account['Account']['account_type_id'];
						if($disposal_type_id == type_disposal_write_off_id)
						{
							switch ($account_type_id){
								case account_type_accum_dep_id:
									$amount_field = 'accum_dep';
									break;	
								case account_type_non_operational_cost_id:
									$amount_field = 'book_value';
									break;
								case account_type_acquisition_price_id:
									$amount_field = 'price';
									break;
							}
						}
						else if($disposal_type_id == type_disposal_sales_id)
						{		
							switch ($account_type_id){
								case account_type_accum_dep_id:
									$amount_field = 'accum_dep';
									break;
								case account_type_rab_id:
									$amount_field = 'sales_amount';
									break;
								case account_type_fa_sales_profit_id:
									$amount_field = 'loss_profit_amount';
									break;									
								case account_type_fa_sales_lost_id:
									$amount_field = 'loss_profit_amount';
									break;	
								case account_type_acquisition_price_id:
									$amount_field = 'price';
									break;									
							}		
					
						}

						$amount_db		=$jtd['journal_position_id']==1?$detail[$model][$amount_field]:"";
						$amount_cr		=$jtd['journal_position_id']==2?$detail[$model][$amount_field]:"";
						$journalLines[$index]['department_id']	= $department_id;
						$journalLines[$index]['account_code']	= $departmentAccountCodes[$department_id] . '.'.ACCOUNT_CURRENCY_IDR_CODE.'.' . $accountCodes[$jtd['account_id']]; 
					}
					else if($detail_source=='outlog')
					{
						$account_id		=$jtd['account_id'];
						$account 		=$this->JournalTransaction->Account->read(null, $account_id);
						$account_type_id=$account['Account']['account_type_id'];
						
						//if type account == account_type_inventory_id, maka department id= HQ
						if($account_type_id == account_type_inventory_id)
						{
							$department_id = HQ_DEPARTMENT_ID;
						}
						else 
						{
							$department_id = $detail[$model]['department_id'];
						}	
						
						$amount_db		=$jtd['journal_position_id']==1?$detail[$model][$amount_field]:"";
						$amount_cr		=$jtd['journal_position_id']==2?$detail[$model][$amount_field]:"";
						$journalLines[$index]['department_id']	= $department_id;
						$journalLines[$index]['account_code']	= $departmentAccountCodes[$department_id] . '.'.ACCOUNT_CURRENCY_IDR_CODE.'.' . $accountCodes[$jtd['account_id']]; 
					}
					else if($detail_source=='inlog')
					{
					}
					else if($detail_source=='usage')
					{
						$amount_db		=$jtd['journal_position_id']==1?$detail[$model][$amount_field]:"";
						$amount_cr		=$jtd['journal_position_id']==2?$detail[$model][$amount_field]:"";
						$journalLines[$index]['department_id']	= $detail[$model]['department_id'];
						$journalLines[$index]['account_code']	= $departmentAccountCodes[$detail[$model]['department_id']] . '.'.ACCOUNT_CURRENCY_IDR_CODE.'.' . $accountCodes[$jtd['account_id']]; 
					}					
					else if($detail_source=='retur')
					{
						$account_id		=$jtd['account_id'];
						$account 		=$this->JournalTransaction->Account->read(null, $account_id);
						$account_type_id=$account['Account']['account_type_id'];
						
						//if type account == account_type_inventory_id, maka department id= HQ
						if($account_type_id == account_type_inventory_id)
						{
							$department_id = HQ_DEPARTMENT_ID;
						}
						else 
						{
							$department_id = $detail[$model]['department_id'];
						}	
						$amount_db		=$jtd['journal_position_id']==1?$detail[$model][$amount_field]:"";
						$amount_cr		=$jtd['journal_position_id']==2?$detail[$model][$amount_field]:"";
						$journalLines[$index]['department_id']	= $department_id;
						$journalLines[$index]['account_code']	= $departmentAccountCodes[$department_id] . '.'.ACCOUNT_CURRENCY_IDR_CODE.'.' . $accountCodes[$jtd['account_id']]; 
					}
					else if($detail_source=='supplier_retur')
					{
						$amount_db		=$jtd['journal_position_id']==1?$detail[$model][$amount_field]:"";
						$amount_cr		=$jtd['journal_position_id']==2?$detail[$model][$amount_field]:"";
						$journalLines[$index]['department_id']	= $detail[$model]['department_id'];
						$journalLines[$index]['account_code']	= $departmentAccountCodes[$detail[$model]['department_id']] . '.'.ACCOUNT_CURRENCY_IDR_CODE.'.' . $accountCodes[$jtd['account_id']]; 
					}
					
					
					$journalLines[$index]['date']			= date("Y-m-d");
					$journalLines[$index]['account_id']		= $jtd['account_id'];
					$journalLines[$index]['account_name']	= $accountNames[$jtd['account_id']];
					$journalLines[$index]['journal_position_id']	= $jtd['journal_position_id'];
					$journalLines[$index]['journal_position_name']	= $journalPositions[$jtd['journal_position_id']];
					
					$journalLines[$index]['amount_db']		= abs($amount_db);
					$journalLines[$index]['amount_cr']		= abs($amount_cr);
					$journalLines[$index]['journal_template_id']	= $jtd['journal_template_id']; 
					$journalLines[$index]['reff']	= array('detail_source'=>$detail_source, 'id'=>$detail[$model][$doc_id]);


					/// drop this if amounts are 0
					//if($journalLines[$index]['amount_db']==0 && $journalLines[$index]['amount_cr']==0)
					//	unset($journalLines[$index]);
				
				}//foreach jtd
			}//empty jtd
		}//foreach details
		
		
		$journalTemplates = $this->JournalTransaction->JournalTemplate->find('list');
		$this->set(compact(
			'journalLines',
			'journal_group_id', 
			'journal_template_id', 
			'journalTemplates',
			'action',
			'departments')
		);
	}
	
	
	function posting_invoice( )
	{
		$journal_group_id = $this->Session->read('JournalTransaction.journal_group_id');
		$invoice_id = $this->Session->read('JournalTransaction.doc_id');
		$Invoice = new Invoice;

		foreach($this->data  as $d)
		{
			$d['JournalTransaction']['doc_id']=$invoice_id;
			$d['JournalTransaction']['source']='invoice';
			$this->JournalTransaction->create();
			$this->JournalTransaction->save($d);
		}
		
		// //update invoice status:
		/// penerimaan barang
		// if( $journal_group_id==journal_group_receival_id)
			// $status_invoice_id = status_invoice_posted_receival_journal_id;
		/// pembayaran full
		//else 
		//if ( $journal_group_id==journal_group_payment_id)
		$status_invoice_id = status_invoice_posted_payment_journal_id;
			
		$inv=$Invoice->read(null, $invoice_id);
		$Invoice->set(array('status_invoice_id'=>$status_invoice_id));
		if($Invoice->save())
		{
			$this->Session->setFlash(__('Invoice posted successfully', true), 'default', array('class'=>'ok'));
			$this->redirect(array('controller'=>'invoices','action' => 'index'));		
		}
		else
		{
			$this->Session->setFlash(__('Invoice posted failed', true));
			$this->redirect(array('controller'=>'invoices','action' => 'view' , $invoice_id));	
		}

		
	}
	function posting_invoice_payment( )
	{
		$journal_group_id = $this->Session->read('JournalTransaction.journal_group_id');
		$invoice_payment_id = $this->Session->read('JournalTransaction.doc_id');
		$InvoicePayment = new InvoicePayment;

		foreach($this->data  as $d)
		{
			$d['JournalTransaction']['doc_id']=$invoice_payment_id;
			$d['JournalTransaction']['source']='invoice_payment';
			$this->JournalTransaction->create();
			$this->JournalTransaction->save($d);
		}
		
		// //update invoice_payment status:
		// pembayaran termin
			
		$inv=$InvoicePayment->read(null, $invoice_payment_id);
		$invoice_id = $inv['InvoicePayment']['invoice_id'];
		$InvoicePayment->set(array('is_posted'=>1));
		$InvoicePayment->set(array('posted_date'=>date('Y-m-d H:i:s')));
		if($InvoicePayment->save())
		{
			if($inv['InvoicePayment']['amount_due']-$inv['InvoicePayment']['amount_paid'] > 0) 
			{
				//masih ada sisa lagi
				$sql = 'update invoices set status_invoice_id="'.status_invoice_posted_term_payment_journal_id . '" where id="'.$invoice_id.'"';
				$this->JournalTransaction->query($sql);
			}
			else
			{
				//lunas tak ada sisa
				$sql = 'update invoices set status_invoice_id="'.status_invoice_posted_payment_journal_id . '" where id="'.$invoice_id.'"';
				$this->JournalTransaction->query($sql);
			}
			
			$this->Session->setFlash(__('InvoicePayment posted successfully', true), 'default', array('class'=>'ok'));
			$this->redirect(array('controller'=>'invoice_payments','action' => 'index', $invoice_id));		
		}
		else
		{
			$this->Session->setFlash(__('InvoicePayment posted failed', true));
			$this->redirect(array('controller'=>'invoice_payments','action' => 'view' , $invoice_payment_id));	
		}
		
	}	
	
	function posting_po( ) //down payment 
	{
		$journal_group_id = $this->Session->read('JournalTransaction.journal_group_id');
		$po_id = $this->Session->read('JournalTransaction.doc_id');
		$Po = new Po;

		foreach($this->data as $d)
		{
			$d['JournalTransaction']['doc_id']=$po_id;
			$d['JournalTransaction']['source']='po';
			$this->JournalTransaction->create();
			$this->JournalTransaction->save($d);
		}
		
		// //update po status:			
		$po=$Po->read(null, $po_id);
		$Po->set(array('is_down_payment_journal_generated'=>1));
		$Po->set(array('down_payment_journal_generated_date'=>date('Y-m-d H:i:s')));
		if($Po->save())
		{
			$this->Session->setFlash(__('PO down payment journal posted successfully', true), 'default', array('class'=>'ok'));
			$this->redirect(array('controller'=>'pos','action' => 'view',$po_id));		
		}
		else
		{
			$this->Session->setFlash(__('PO down payment journal posted failed', true));
			$this->redirect(array('controller'=>'pos','action' => 'view' , $po_id));	
		}
	}		
	
	function posting_delivery_order( ) //down payment 
	{
		$journal_group_id = $this->Session->read('JournalTransaction.journal_group_id');
		$delivery_order_id = $this->Session->read('JournalTransaction.doc_id');
		$DeliveryOrder = new DeliveryOrder;

		foreach($this->data as $d)
		{
			$d['JournalTransaction']['doc_id']=$delivery_order_id;
			$d['JournalTransaction']['source']='delivery_order';
			$this->JournalTransaction->create();
			$this->JournalTransaction->save($d);
		}
		
		// //update delivery_order status:			
		$delivery_order=$DeliveryOrder->read(null, $delivery_order_id);
		$po_id = $delivery_order['DeliveryOrder']['po_id'];
		$DeliveryOrder->set(array('is_journal_generated'=>1));
		$DeliveryOrder->set(array('journal_generated_date'=>date('Y-m-d H:i:s')));
		if($DeliveryOrder->save())
		{
			$this->Session->setFlash(__('Delivery Order receive journal posted successfully', true), 'default', array('class'=>'ok'));
			$this->redirect(array('controller'=>'delivery_orders','action' => 'index',$po_id));		
		}
		else
		{
			$this->Session->setFlash(__('Delivery Order receive journal posting failed', true));
			$this->redirect(array('controller'=>'delivery_orders','action' => 'index' , $po_id));	
		}
	}		
	
	function posting_supplier_retur( )
	{
		$journal_group_id = $this->Session->read('JournalTransaction.journal_group_id');
		$supplier_retur_id = $this->Session->read('JournalTransaction.doc_id');
		$SupplierRetur = new SupplierRetur;

		foreach($this->data as $d)
		{
			$d['JournalTransaction']['doc_id']=$supplier_retur_id;
			$d['JournalTransaction']['source']='supplier_retur';
			$this->JournalTransaction->create();
			$this->JournalTransaction->save($d);
		}
		
		// //update supplier_retur status:			
		$supplier_retur=$SupplierRetur->read(null, $supplier_retur_id);
		$SupplierRetur->set(array('supplier_retur_status_id'=>status_supplier_retur_finish_id));
		if($SupplierRetur->save())
		{
			$this->Session->setFlash(__('Supplier Retur journal posted successfully', true), 'default', array('class'=>'ok'));
			$this->redirect(array('controller'=>'supplier_returs','action' => 'view', $supplier_retur_id ));		
		}
		else
		{
			$this->Session->setFlash(__('Supplier Retur journal posted failed', true));
			$this->redirect(array('controller'=>'supplier_returs','action' => 'view' , $supplier_retur_id));	
		}
	}	
	
	function posting_usage( )
	{
		$journal_group_id = $this->Session->read('JournalTransaction.journal_group_id');
		$usage_id = $this->Session->read('JournalTransaction.doc_id');
		$Usage = new Usage;

		foreach($this->data as $d)
		{
			$d['JournalTransaction']['doc_id']=$usage_id;
			$d['JournalTransaction']['source']='usage';
			$this->JournalTransaction->create();
			$this->JournalTransaction->save($d);
		}
		
		// //update usage status:			
		$usage=$Usage->read(null, $usage_id);
		$Usage->set(array('usage_status_id'=>status_usage_finish_id));
		if($Usage->save())
		{
			$this->Session->setFlash(__('Usage journal posted successfully', true), 'default', array('class'=>'ok'));
			$this->redirect(array('controller'=>'usages','action' => 'view', $usage_id));		
		}
		else
		{
			$this->Session->setFlash(__('Usage journal posted failed', true));
			$this->redirect(array('controller'=>'usages','action' => 'view' , $usage_id));	
		}
	}	
	function posting_retur( )
	{
		$journal_group_id = $this->Session->read('JournalTransaction.journal_group_id');
		$retur_id = $this->Session->read('JournalTransaction.doc_id');
		$Retur = new Retur;

		foreach($this->data as $d)
		{
			$d['JournalTransaction']['doc_id']=$retur_id;
			$d['JournalTransaction']['source']='retur';
			$this->JournalTransaction->create();
			$this->JournalTransaction->save($d);
		}
		
		// //update retur status:			
		$retur=$Retur->read(null, $retur_id);
		$Retur->set(array('retur_status_id'=>status_retur_finish_id));
		if($Retur->save())
		{
			$this->Session->setFlash(__('Retur journal posted successfully', true), 'default', array('class'=>'ok'));
			$this->redirect(array('controller'=>'returs','action' => 'view', $retur_id));		
		}
		else
		{
			$this->Session->setFlash(__('Retur journal posted failed', true));
			$this->redirect(array('controller'=>'returs','action' => 'view' , $retur_id));	
		}
	}		
	function posting_outlog( )
	{
		$journal_group_id = $this->Session->read('JournalTransaction.journal_group_id');
		$outlog_id = $this->Session->read('JournalTransaction.doc_id');
		$Outlog = new Outlog;

		foreach($this->data as $d)
		{
			$d['JournalTransaction']['doc_id']=$outlog_id;
			$d['JournalTransaction']['source']='outlog';
			$this->JournalTransaction->create();
			$this->JournalTransaction->save($d);
		}
		
		// //update outlog status:			
		$outlog=$Outlog->read(null, $outlog_id);
		$Outlog->set(array('outlog_status_id'=>status_outlog_finish_id));
		if($Outlog->save())
		{
			$this->Session->setFlash(__('Outlog journal posted successfully', true), 'default', array('class'=>'ok'));
			$this->redirect(array('controller'=>'outlogs','action' => 'view', $outlog_id));		
		}
		else
		{
			$this->Session->setFlash(__('Outlog journal posted failed', true));
			$this->redirect(array('controller'=>'outlogs','action' => 'view' , $outlog_id));	
		}
	}		
	function posting_asset()
	{
		$journal_group_id = $this->Session->read('JournalTransaction.journal_group_id');
		$Asset = new Asset;

		foreach($this->data  as $d)
		{
			$asset_id = $d['JournalTransaction']['doc_id'];
			$this->JournalTransaction->create();
			$this->JournalTransaction->save($d);
			
			
			//update asset posting status
			$Asset->read(null, $asset_id);
			$Asset->set(array('posting'=>1));
			$Asset->save();
		}
			
		$this->Session->setFlash(__('Asset Amortization posted successfully', true), 'default', array('class'=>'ok'));
		$this->redirect(array('controller'=>'assets','action' => 'index'));		
	}
	
	function posting_movement()
	{
		$journal_group_id = $this->Session->read('JournalTransaction.journal_group_id');
		$Movement = new Movement;
		$movement_id = $this->Session->read('JournalTransaction.doc_id');
		
		foreach($this->data  as $d)
		{
			$asset_id = $d['JournalTransaction']['doc_id'];
			$this->JournalTransaction->create();
			$this->JournalTransaction->save($d);

		}

		$Movement->read(null, $movement_id);
		$Movement->set(array('movement_status_id'=>status_movement_finish_id));
		if($Movement->save())
		{
			$this->Session->setFlash(__('Movement posted successfully', true), 'default', array('class'=>'ok'));
			$this->redirect(array('controller'=>'movements','action' => 'index'));		
		}
		else
		{
			$this->Session->setFlash(__('Movement posted failed', true));
			$this->redirect(array('controller'=>'movements','action' => 'view' , $movement_id));	
		}

		//update department_id in assets and asset_details		

	}	
	
	function posting_disposal()
	{
		$journal_group_id = $this->Session->read('JournalTransaction.journal_group_id');
		$Disposal = new Disposal;

		foreach($this->data  as $d)
		{
			$disposal_id = $d['JournalTransaction']['doc_id'];
			$this->JournalTransaction->create();
			$this->JournalTransaction->save($d);

		}
		
		//update asset posting status
		$Disposal->read(null, $disposal_id);
		$Disposal->set(array('disposal_status_id'=>status_disposal_posted_journal_id));
		if($Disposal->save())
		{
			$this->Session->setFlash(__('Disposal posted successfully', true), 'default', array('class'=>'ok'));
			$this->redirect(array('controller'=>'disposals','action' => 'index'));		
		}
		else
		{
			$this->Session->setFlash(__('Disposal posted failed', true));
			$this->redirect(array('controller'=>'disposals','action' => 'view' , $disposal_id));	
		}
	
	}
		
	function index() {
		$this->JournalTransaction->recursive = 0;
		$departments = $this->JournalTransaction->Department->find('list');
		$journalTemplates = $this->JournalTransaction->JournalTemplate->find('list');
		$postings = array(1=>'Yes', 0=>'No');
		$con=array();
		$layout=$this->data['JournalTransaction']['layout'];
		if(isset($this->data['JournalTransaction']['department_id']))
			$this->Session->write('JournalTransaction.department_id',$this->data['JournalTransaction']['department_id']);
			
		if(isset($this->data['JournalTransaction']['journal_template_id']))
			$this->Session->write('JournalTransaction.journal_template_id',$this->data['JournalTransaction']['journal_template_id']);
			
		if(isset($this->data['JournalTransaction']['posting_id']))
			$this->Session->write('JournalTransaction.posting_id',$this->data['JournalTransaction']['posting_id']);

		list($date_start,$date_end) = $this->set_date_filters('JournalTransaction');
		$con[] = array('`date` >=' => ($date_start['year'] . '-' . $date_start['month'] . '-' . $date_start['day']) , 
				'`date` <=' => ($date_end['year'] . '-' . $date_end['month'] . '-' . $date_end['day']) );
		
		

		if($department_id=$this->Session->read('JournalTransaction.department_id'))
			$con[] = array('department_id'=>$department_id);
		if($journal_template_id=$this->Session->read('JournalTransaction.journal_template_id'))
			$con[] = array('journal_template_id'=>$journal_template_id);
		if($posting_id=$this->Session->read('JournalTransaction.posting_id'))
			$con[] = array('posting'=>$posting_id);
		$copyright_id  = $this->configs['copyright_id'];
		$this->set(compact(
			'departments',
			'department_id',
			'journalTemplates', 
			'journal_template_id',
			'postings',
			'posting_id',
			'date_start',
			'date_end',
			'copyright_id'
			));
		if($layout=='pdf' || $layout=='xls'){
		$z = $this->JournalTransaction->find('all', array('conditions'=>$con));
		}else{
		$z = $this->paginate($con);
		}
		$this->set('journalTransactions', $z);
		
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
		else if($layout=='txt')
		{
		$this->render('index_txt','export_xls');

		}
		else if($layout=='txt_length')
		{
		$this->render('index_txt_length','export_xls');

		}


	}
	
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid journal transaction', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('journalTransaction', $this->JournalTransaction->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->JournalTransaction->create();
			if ($this->JournalTransaction->save($this->data)) {
				$this->Session->setFlash(__('The journal transaction has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The journal transaction could not be saved. Please, try again.', true));
			}
		}
		$journalTemplateDetails = $this->JournalTransaction->JournalTemplateDetail->find('list');
		$accounts = $this->JournalTransaction->Account->find('list');
		$journalPositions = $this->JournalTransaction->JournalPosition->find('list');
		$departments = $this->JournalTransaction->Department->find('list');
		$invoices = $this->JournalTransaction->Invoice->find('list');
		$this->set(compact('journalTemplateDetails', 'accounts', 'journalPositions', 'departments', 'invoices'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid journal transaction', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->JournalTransaction->save($this->data)) {
				$this->Session->setFlash(__('The journal transaction has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The journal transaction could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->JournalTransaction->read(null, $id);
		}
		$journalTemplateDetails = $this->JournalTransaction->JournalTemplateDetail->find('list');
		$accounts = $this->JournalTransaction->Account->find('list');
		$journalPositions = $this->JournalTransaction->JournalPosition->find('list');
		$departments = $this->JournalTransaction->Department->find('list');
		$invoices = $this->JournalTransaction->Invoice->find('list');
		$this->set(compact('journalTemplateDetails', 'accounts', 'journalPositions', 'departments', 'invoices'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for journal transaction', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->JournalTransaction->delete($id)) {
			$this->Session->setFlash(__('Journal transaction deleted', true), 'default', array('class'=>'ok'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Journal transaction was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	
	function copy_to_trans()
	{
		$this->JournalTransaction->recursive = 0;
		$params					= array('conditions'=>array('posting'=>0));
		$journalTransactions 	= $this->JournalTransaction->find('all',$params);
		$departments 			= $this->JournalTransaction->Department->find('list');
		$departmentAccountCodes = $this->JournalTransaction->Department->find('list', array('fields'=>array('account_code')));		
		$accountNames 			= $this->JournalTransaction->Account->find('list', array('fields'=>array('Account.name')));
		$accountCodes 			= $this->JournalTransaction->Account->find('list', array('fields'=>array('Account.gl')));
		$journalPositions 		= $this->JournalTransaction->JournalPosition->find('list');		
		
		//connect to SQL server
		$serverName = "(local)\SQLEXPRESS";
		$connectionOptions = array("Database"=>"transdb");

		/* Connect using Windows Authentication. */
		$conn = sqlsrv_connect($serverName, $connectionOptions);
		if( $conn === false ) die ( debug(sqlsrv_errors() ));
	
		$account_db 	= '';
		$account_cr 	= '';		
		$amount_db 		= 0;		
		$amount_cr 		= 0;		

		foreach($journalTransactions as $jt)
		{

			$id = $jt['JournalTransaction']['id'];
			
			if($jt['JournalTransaction']['journal_position_id']==1) //Db
			{ 
				$account_db = $jt['JournalTransaction']['account_code'];
				$amount_db 	= $jt['JournalTransaction']['amount_db'];
				$dept_db 	= $departmentAccountCodes[ $jt['JournalTransaction']['department_id'] ];
			}
			else if($jt['JournalTransaction']['journal_position_id']==2) //Cr
			{
				$account_cr = $jt['JournalTransaction']['account_code'];
				$amount_cr 	= $jt['JournalTransaction']['amount_cr'];
				$dept_cr 	= $departmentAccountCodes[ $jt['JournalTransaction']['department_id'] ];
				
				$source_id	= 'FIX';
				$source_date= $jt['JournalTransaction']['date'];
				$source_tm	= $jt['JournalTransaction']['time'];
				$source_no	= $jt['JournalTransaction']['date'];
				$kdcab		= $departmentAccountCodes[ $jt['JournalTransaction']['department_id'] ];
				$kdtrs		= '';
				$noref		= $id;
				$norek1		= $account_db;
				$norek2		= $account_cr;
				$ccy1		= '';
				$ccy2		= '';
				$nilai1		= $amount_db;
				$nilai2		= $amount_cr;
				$kurs		= 0;
				$costdept1	= $dept_db;
				$costdept2	= $dept_cr;
				$ket1		= $jt['JournalTransaction']['notes'];
				$ket2    	= $jt['JournalTransaction']['source'];	
				$ket3		= '';
				$st			= '';
				$rc			= '';	
				
				$tsql = "INSERT INTO trans (
					source_id	,
					source_date	,
					source_tm	,
					source_no	,
					kdcab		,
					kdtrs		,
					noref		,
					norek1		,
					norek2		,
					ccy1		,
					ccy2		,
					nilai1		,
					nilai2		,
					kurs		,	
					costdept1	,	
					costdept2	,	
					ket1		,	
					ket2    	,	
					ket3		,	
					st			,
					rc				
				) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)"; 

				$params = array(
					&$source_id	,
					&$source_date,
					&$source_tm	,
					&$source_no	,
					&$kdcab		,
					&$kdtrs		,
					&$noref		,
					&$norek1	,	
					&$norek2	,	
					&$ccy1		,
					&$ccy2		,
					&$nilai1	,	
					&$nilai2	,	
					&$kurs		,	
					&$costdept1	,	
					&$costdept2	,	
					&$ket1		,	
					&$ket2    	,	
					&$ket3		,	
					&$st		,	
					&$rc	
				);

				$insertReview = sqlsrv_prepare($conn, $tsql, $params);
				if( $insertReview === false ) die( debug(sqlsrv_errors()) ); 
				if( sqlsrv_execute($insertReview) === false ) die(debug(sqlsrv_errors()));
			
			}
			
			//update current JournalTransaction record
			$this->JournalTransaction->id = $id;
			$this->JournalTransaction->saveField( 'posting', 1);			
			$this->JournalTransaction->saveField( 'posting_date', date('Y-m-d H:i:s'));
		}
	}
}
?>