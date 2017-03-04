<?php
App::import('Model','Invoice');
App::import('Model','Supplier');
App::import('Model','Currency');

class InvoicePaymentsController extends AppController {

      var $name = 'InvoicePayments';
      var $helpers = array('Number', 'Ajax', 'Javascript');
      var $components = array('RequestHandler');

      function index($invoice_id=null) {
            //$this->paginate = array('order' => 'InvoicePayment.id');
            if (!$invoice_id) {
                  $this->Session->setFlash(__('Invalid invoice id', true));
                  $this->redirect(array('controller' => 'invoices', 'action' => 'view', $invoice_id));
            }
            $invoice = $this->InvoicePayment->Invoice->read(null, $invoice_id);
            $this->InvoicePayment->recursive = 0;
			$this->paginate = array('order'=>'InvoicePayment.id');
						
			$invoicePayments = $this->paginate(array('InvoicePayment.invoice_id'=>$invoice_id));	

			$sql = $this->InvoicePayment->query('select sum(invoice_payments.amount_due) as total from invoice_payments where invoice_payments.invoice_id= "'.$invoice_id.'"');
			$percen_total = $sql[0][0]['total'];
			
            $payment_settled = $invoice['Invoice']['total'] - $invoice['Invoice']['vtotal_paid'] == 0 ? true : false;
            $full_amount_due = $invoice['Invoice']['total'] <= $invoice['Invoice']['vtotal_amount_due']  ? true : false;
            
            $this->Session->write('InvoicePayment.can_payment', (!$full_amount_due) );
            
            $this->set('invoicePayments', $invoicePayments);
            $this->set('invoice', $invoice);
            $invoicePaymentStatus = $this->InvoicePayment->InvoicePaymentStatus->find('list');
            $bankAccounts = $this->InvoicePayment->BankAccount->find('list');
            $bankAccountTypes = $this->InvoicePayment->BankAccountType->find('list');
            $this->set(compact('invoicePaymentStatus','bankAccounts','bankAccountTypes', 'percen_total'));
      }

      function list_invoice_payments($invoice_payment_status_id=null) {
            $this->paginate = array('order' => 'InvoicePayment.id');
            if (!$invoice_payment_status_id) {
                  $this->Session->setFlash(__('Invalid $invoice_payment_status_id id', true));
                  $this->redirect(array('controller' => 'invoices', 'action' => 'index'));
            }
			
            $this->InvoicePayment->recursive = 1;
            $this->set('invoicePayments', $this->paginate(array('InvoicePayment.invoice_payment_status_id' => $invoice_payment_status_id)));
            $invoicePaymentStatus = $this->InvoicePayment->InvoicePaymentStatus->find('list');
            $this->set(compact('invoicePaymentStatus', 'invoicePayments'));
      }

      function view($id = null) {
            if (!$id) {
                  $this->Session->setFlash(__('Invalid invoice payment', true));
                  $this->redirect(array('action' => 'index'));
            }
           $this->set('invoicePayment', $this->InvoicePayment->read(null, $id));
      }

      function add($invoice_id=null) {

            if (!empty($this->data)) {
                  $this->InvoicePayment->create();
                  $invoice_id = $this->data['InvoicePayment']['invoice_id'];
                  $this->data['InvoicePayment']['term_percent'] = str_replace(',', '', $this->data['InvoicePayment']['amount_due']) / str_replace(',', '', $this->data['InvoicePayment']['amount_invoice']) * 100;
                  $this->data['InvoicePayment']['invoice_payment_status_id'] = status_invoice_new_id;
                  $this->data['InvoicePayment']['processing'] = 0;
				  if ($this->InvoicePayment->save($this->data)) {

                        //update status invoice jika sudah lunas
                        //$this->InvoicePayment->Invoice->processSettlement($invoice_id);

                        $this->Session->setFlash(__('The invoice payment has been saved', true), 'default', array('class' => 'ok'));
                        $this->redirect(array('controller' => 'invoice_payments', 'action' => 'index', $invoice_id));
                  } else {
                        $this->Session->setFlash(__('The invoice payment could not be saved. Please, try again.', true));
                  }
            }

            $invoice = $this->InvoicePayment->Invoice->read(null, $invoice_id);
            $date_due = $invoice['Invoice']['date_due'];
            $date_due = $date_due ? $date_due : date('Y-m-d', strtotime($invoice['Invoice']['date_due'] . ' +30 days'));
            $amount_due = $invoice['Invoice']['total'] - $invoice['Invoice']['vtotal_paid'];
            $amount_paid = $amount_due; /// to be paid now, default is amount due
            $amount_invoice = $invoice['Invoice']['total'];
            $term_no = $this->InvoicePayment->find('count', array('conditions' => array('InvoicePayment.invoice_id' => $invoice_id))) + 1;
            $term_percent = round(($amount_paid / $amount_invoice) * 100);
            $supplier_id = $invoice['Invoice']['supplier_id'];
            $invoice_no = $invoice['Invoice']['no'];
            $supplier_name = $invoice['Supplier']['name'];

            $supplierBankAccounts = $this->InvoicePayment->Invoice->Supplier->BankAccount->find('list', array('conditions' => array('BankAccount.supplier_id' => $invoice['Invoice']['supplier_id'])));
            $bankAccountTypes = $this->InvoicePayment->BankAccountType->find('list');
            $supplier_bank_account_type_id = $invoice['Supplier']['bank_account_type_id'];

            $this->set(compact('invoice_id', 'term_no', 'term_percent', 'date_due', 'amount_paid', 'amount_due', 'amount_invoice', 'supplierBankAccounts', 'bankAccountTypes', 'supplier_bank_account_type_id', 'supplier_id', 'supplier_name', 'invoice_no'
                    ));
      }

      function edit($id = null) {
           // $invoice_id = $this->Session->read('Invoice.id');
			$this->set('asset_error',null);
            if (!$id && empty($this->data)) {
                $this->Session->setFlash(__('Invalid invoice payment', true));
                $this->redirect(array('controller' => 'invoice_payments', 'action' => 'index', $invoice_id));
            }
			$amount = $this->data['InvoicePayment']['amount_due'];
			$amount = str_replace(',','',$amount);
			$amount = str_replace('.00','',$amount);
			$this->InvoicePayment->recursive=-1;
            $invoicePayment = $this->InvoicePayment->read(null, $id);
            $invoice_id = $invoicePayment['InvoicePayment']['invoice_id'];
            $this->Session->write('Invoice.invoice_id', $invoice_id);
            $invoice = $this->InvoicePayment->Invoice->read(null, $invoice_id);
			$reqTypeId = $invoice['Invoice']['request_type_id'];
			
            //if($amount <= $invoice['Invoice']['total']){
				if (!empty($this->data)) {
					//echo '<pre>';
					//var_dump($this->data);
					//echo '</pre>';die();
					
					$masaManfaat 	= $this->data['InvoicePayment']['masa_manfaat'];
					$convertAsset 	= $this->data['InvoicePayment']['convert_asset'];
					$golongan 		= $this->data['InvoicePayment']['golongan'];
					$invoiceID		= $this->data['InvoicePayment']['invoice_id'];
					
					
					
					if($convertAsset == 0){
						//if($masaManfaat == null || $masaManfaat == ""){
							$masaManfaat = null;
						//}
					}
					
					//echo '<pre>';
					//var_dump($masaManfaat);
					//echo '</pre>';die();
					
					if($convertAsset == ""){
						$this->Session->setFlash(__('The invoice payment could not be saved. Please, check asset.', true));
						$this->set('asset_error','Asset must not empty');
					}else if($convertAsset == 1 && $masaManfaat == ""){
						$this->Session->setFlash(__('The invoice payment could not be saved. Please, check masa manfaat.', true));
					}else{
						$this->data['InvoicePayment']['term_percent'] = str_replace(',', '', $this->data['InvoicePayment']['amount_due']) / str_replace(',', '', $this->data['InvoicePayment']['amount_invoice']) * 100;
							
						if($convertAsset == 1){
							$res = $this->InvoicePayment->query('select id from economic_ages where year = "'.$masaManfaat.'"');
							$economic_ages_id = $res[0][0]['id'];
							$this->data['InvoicePayment']['economic_ages_id'] = $economic_ages_id; 
						}else{
							$this->data['InvoicePayment']['economic_ages_id'] = null; 
						}
						
						if ($this->InvoicePayment->save($this->data)) {
							$this->InvoicePayment->query('update invoices set convert_asset = '.$convertAsset.' where id = '.$invoiceID);
							if($convertAsset == 1){
								$masaMax = $masaManfaat * 12;
								$this->InvoicePayment->query('update assets set umurek = '.$masaManfaat.', maksi = '.$masaMax.' where invoice_id = '.$invoiceID);
							}
							
							
							$this->Session->setFlash(__('The invoice payment has been saved', true), 'default', array('class' => 'ok'));
							$this->redirect(array('controller' => 'invoice_payments', 'action' => 'view_payment', $id));
						} else {
							$this->Session->setFlash(__('The invoice payment could not be saved. Please, try again.', true));
						}
					}
					
					//if($reqTypeId == 3 || $reqTypeId == 4 || $reqTypeId == 5){ //comment 21 nov '14 [convert to asset not working?]
						//if ($convertAsset == "" || ($masaManfaat == null && $convertAsset == 1)){
						//	$this->Session->setFlash(__('The invoice payment could not be saved. Please, check the data.', true));
						//}else if($convertAsset == ""){
						
						//}else{
							
						//}
					//} //comment 21 nov '14 [convert to asset not working?]
				}
			//}else{
			
			//$this->Session->setFlash(__('The invoice payment could not be saved. Please, check Amount Due.', true));
			//$this->redirect(array('action' => 'edit', $id));
			
			//}
			
            if (empty($this->data)) {
                $this->data = $this->InvoicePayment->read(null, $id);
            }
            $supplier_id = $invoice['Invoice']['supplier_id'];
            $invoice_no = $invoice['Invoice']['no'];
            $supplier_name = $invoice['Supplier']['name'];

            $supplierBankAccounts = $this->InvoicePayment->Invoice->Supplier->BankAccount->find('list', array('conditions' => array('BankAccount.supplier_id' => $invoice['Invoice']['supplier_id'])));
            $bankAccountTypes = $this->InvoicePayment->BankAccountType->find('list');
			$convertAsset = array('0'=>'Biaya','1'=>'Asset');
			$eAs = $this->InvoicePayment->EconomicAge->find('list', array('order'=>array('year'=>'ASC')));
			$economicAges = array();
			foreach ($eAs as $eA => $year):
				$economicAges[$year] = $year;
			endforeach;
			
			$invoice = $this->InvoicePayment->Invoice->read(null, $invoicePayment['InvoicePayment']['invoice_id']);
			$ea_id	= $invoicePayment['InvoicePayment']['economic_ages_id'];
			$ea_data	= $this->InvoicePayment->EconomicAge->read(null, $ea_id);
			//echo '<pre>';
			//var_dump($ea_data);
			//echo '</pre>';die();
			
            $supplier_bank_account_type_id = $invoice['Supplier']['bank_account_type_id'];
			
            $this->set(compact('invoicePayment', 'invoice', 'invoice_id', 'term_no', 'term_percent', 'date_due', 'amount_paid', 'amount_due', 'amount_invoice', 'supplierBankAccounts', 'bankAccountTypes', 'supplier_bank_account_type_id', 'supplier_id', 'supplier_name', 'invoice_no','convertAsset','economicAges','ea_data'
                    ));
      }
      
      function input_payment($id = null) {
           // $invoice_id = $this->Session->read('Invoice.id');

            if (!$id && empty($this->data)) {
                  $this->Session->setFlash(__('Invalid invoice payment', true));
                  $this->redirect(array('controller' => 'invoice_payments', 'action' => 'index', $invoice_id));
            }
            $this->InvoicePayment->recursive=-1;
            $invoicePayment = $this->InvoicePayment->read(null, $id);
            $invoice_id = $invoicePayment['InvoicePayment']['invoice_id'];
            $this->Session->write('Invoice.invoice_id', $invoice_id);
            
            if (!empty($this->data)) {

//                  $this->data['InvoicePayment']['term_percent'] = str_replace(',', '', $this->data['InvoicePayment']['amount_paid']) / str_replace(',', '', $this->data['InvoicePayment']['amount_invoice']) * 100;
                  
                  if ($this->InvoicePayment->save($this->data)) {

//                        //update po_payment date
//                        $this->InvoicePayment->Invoice->Po->PoPayment->id = $this->data['InvoicePayment']['po_payment_id'];
//                        $this->InvoicePayment->Invoice->Po->PoPayment->set('amount_paid', str_replace(',', '', $this->data['InvoicePayment']['amount_paid']));
//                        $this->InvoicePayment->Invoice->Po->PoPayment->set('date_paid', $this->data['InvoicePayment']['date_paid']);
//                        $this->InvoicePayment->Invoice->Po->PoPayment->save();

                        $this->Session->setFlash(__('The invoice payment has been saved', true), 'default', array('class' => 'ok'));
                        $this->redirect(array('controller' => 'invoice_payments', 'action' => 'view_payment', $this->data['InvoicePayment']['id']));
                  } else {
                        $this->Session->setFlash(__('The invoice payment could not be saved. Please, try again.', true));
                  }
            }
            if (empty($this->data)) {
                  $this->data = $this->InvoicePayment->read(null, $id);
            }
            //var_dump($this->data );
            $invoice = $this->InvoicePayment->Invoice->read(null, $invoice_id);
            $supplier_id = $invoice['Invoice']['supplier_id'];
            $invoice_no = $invoice['Invoice']['no'];
            $supplier_name = $invoice['Supplier']['name'];

            $supplierBankAccounts = $this->InvoicePayment->Invoice->Supplier->BankAccount->find('list', array('conditions' => array('BankAccount.supplier_id' => $invoice['Invoice']['supplier_id'])));
            $bankAccountTypes = $this->InvoicePayment->BankAccountType->find('list');
            $supplier_bank_account_type_id = $invoice['Supplier']['bank_account_type_id'];

            $this->set(compact('invoice_id', 'term_no', 'term_percent', 'date_due', 'amount_paid', 'amount_due', 'amount_invoice', 'supplierBankAccounts', 'bankAccountTypes', 'supplier_bank_account_type_id', 'supplier_id', 'supplier_name', 'invoice_no'
                    ));
      }
      function view_payment($id = null) {

            if (!$id && empty($this->data)) {
                  $this->Session->setFlash(__('Invalid invoice payment', true));
                  $this->redirect(array('controller' => 'invoice_payments', 'action' => 'index', $id));
            }

            $invoicePayment = $this->InvoicePayment->read(null, $id);
            $invoice_id = $invoicePayment['InvoicePayment']['invoice_id'];
            $this->Session->write('Invoice.invoice_id', $invoice_id);
            $invoice = $this->InvoicePayment->Invoice->read(null, $invoice_id);

            $supplier_id = $invoice['Invoice']['supplier_id'];
            $invoice_no = $invoice['Invoice']['no'];
            $supplier_name = $invoice['Supplier']['name'];


            $can_send_to_spv = $this->Session->read('Security.permissions') == fincon_group_id
                    && ($invoicePayment['InvoicePayment']['invoice_payment_status_id'] == status_invoice_payment_draft_id ||
                    $invoicePayment['InvoicePayment']['invoice_payment_status_id'] == 0 )        ;
            $can_approve = $this->Session->read('Security.permissions') == fincon_supervisor_group_id
                    && $invoicePayment['InvoicePayment']['invoice_payment_status_id'] == status_invoice_payment_sent_to_spv_id;
            $can_journal = $this->Session->read('Security.permissions') == fincon_group_id
                    && $invoicePayment['InvoicePayment']['invoice_payment_status_id'] == status_invoice_payment_journal_id;

            $invoicePaymentStatus = $this->InvoicePayment->InvoicePaymentStatus->find('list');
            $supplierBankAccounts = $this->InvoicePayment->Invoice->Supplier->BankAccountType->find('list');
            $bankAccountTypes = $this->InvoicePayment->Invoice->Supplier->BankAccount->find('list', array('conditions' => array('BankAccount.supplier_id' => $invoice['Invoice']['supplier_id'])));
            $supplier_bank_account_type_id = $invoice['Supplier']['bank_account_type_id'];

            $this->set(compact('can_journal', 'can_approve', 'invoicePaymentStatus', 'can_send_to_spv', 'invoicePayment', 'invoice_id', 'term_no', 'term_percent', 'date_due', 'amount_paid', 'amount_due', 'amount_invoice', 'supplierBankAccounts', 'bankAccountTypes', 'supplier_bank_account_type_id', 'supplier_id', 'supplier_name', 'invoice_no'
                    ));
      }

      function sentToFinconSpv($id = null) {
            if (!$id) {
                  $this->Session->setFlash(__('Invalid id for invoice Payment', true));
                  $this->redirect(array('action' => 'index'));
            }
            $d['InvoicePayment']['invoice_payment_status_id'] = status_invoice_payment_sent_to_spv_id;
            $d['InvoicePayment']['id'] = $id;
            $invoicePayment = $this->InvoicePayment->read(null, $id);
			
			$sql = $this->InvoicePayment->query('select sum(invoice_payments.term_percent) as total from invoice_payments where invoice_payments.invoice_id= "'.$invoicePayment['InvoicePayment']['invoice_id'].'"');
			$percen_total = $sql[0][0]['total'];
			$invoice_id = $invoicePayment['InvoicePayment']['invoice_id'];
			
			$sgql = $this->InvoicePayment->query('select total from invoices where invoices.id="'.$invoice_id.'"');
			$total = $sgql[0][0]['total'];
			
			$sgqql = $this->InvoicePayment->query('select sum(invoice_payments.amount_due) as amount_due from invoice_payments where invoice_payments.invoice_id="'.$invoice_id.'"');
			$amount_due = $sgqql[0][0]['amount_due'];
			
			if($invoicePayment['InvoicePayment']['amount_due'] > 0 && $percen_total <= 100 && $total >= $amount_due && 
				$invoicePayment['InvoicePayment']['bank_account_id'] !=0 && $invoicePayment['InvoicePayment']['bank_account_type_id'] !=0){
				$d['InvoicePayment']['processing'] = 0;// test
				if ($this->InvoicePayment->save($d)) {
					  $this->InvoicePayment->Invoice->processing($invoicePayment['InvoicePayment']['invoice_id']);
					  $this->Session->setFlash(__('Invoice Payment Sent to Fincon Supervisor', true), 'default', array('class' => 'ok'));
					  $this->redirect(array('action' => 'index', $this->Session->read('Invoice.invoice_id')));
				}
            }
            $this->Session->setFlash(__('Invoice Payment was not sent, Please Check Amount Due and Term Percen must be 100%. make sure if the bank account is filled', true));
            $this->redirect(array('action' => 'view_payment', $id));
      }

      function delete($id = null) {
            if (!$id) {
                  $this->Session->setFlash(__('Invalid id for invoice payment', true));
                  $this->redirect(array('action' => 'index'));
            }
			$payment = $this->InvoicePayment->read(null, $id);
            if ($this->InvoicePayment->delete($id)) {

                  //recheck invoice_status_id
//                  $this->InvoicePayment->Invoice->processSettlement($invoice_id);

                  $this->Session->setFlash(__('Invoice payment deleted', true), 'default', array('class' => 'ok'));
                  $this->redirect(array('controller' => 'invoice_payments', 'action' => 'index', $payment['InvoicePayment']['invoice_id']));
            }
            $this->Session->setFlash(__('Invoice payment was not deleted', true));
            $this->redirect(array('controller' => 'invoice_payments', 'action' => 'index', $payment['InvoicePayment']['invoice_id']));
      }

      function approve($id = null) {
            if (!$id) {
                  $this->Session->setFlash(__('Invalid id for invoice Payment', true));
                  $this->redirect(array('action' => 'index'));
            }

            $this->data = $this->InvoicePayment->read(null, $id);
            $invoice_id = $this->data['InvoicePayment']['invoice_id'];
			
			$invoices = $this->InvoicePayment->Invoice->read(null, $invoice_id);
			if($invoices['Invoice']['request_type_id']==request_type_stock_id)
			{
				$this->data['InvoicePayment']['invoice_payment_status_id'] = status_invoice_payment_finish_id;
			}else{
				$this->data['InvoicePayment']['invoice_payment_status_id'] = status_invoice_payment_journal_id;
			}
			
            if (!empty($this->data)) {
                  if ($this->InvoicePayment->save($this->data)) {
					if($invoices['Invoice']['request_type_id']==request_type_stock_id)
					{
						$invoice_pays = $this->InvoicePayment->read(null, $id);
						$this->InvoicePayment->id = $id ;
						$this->InvoicePayment->set('invoice_payment_status_id', status_invoice_payment_finish_id);
						$this->InvoicePayment->set('amount_paid', $invoice_pays['InvoicePayment']['amount_due']);
						$this->InvoicePayment->set('date_paid', date('Y-m-d H:i:s'));

						if($this->InvoicePayment->save())
						{
							$invoice = new Invoice;
							$invoice_pay = $this->InvoicePayment->read(null, $this->InvoicePayment->id);
							$invoice_id = $invoice_pay['InvoicePayment']['invoice_id'];
							$invoice->Po->PoPayment->id = $invoice_pay['InvoicePayment']['po_payment_id'];
							$invoice->Po->PoPayment->set('amount_paid', str_replace(',', '', $invoice_pay['InvoicePayment']['amount_paid']));
							$invoice->Po->PoPayment->set('date_paid', $invoice_pay['InvoicePayment']['date_paid']);
							$invoice->Po->PoPayment->save();

							//update status invoice paid jika sudah lunas else unpaid
							$invoice->processSettlement($invoice_id);

							$this->Session->setFlash(__('Invoice Payment successfully', true), 'default', array('class'=>'ok'));
							$this->redirect(array('action' => 'list_invoice_payments', status_invoice_payment_sent_to_spv_id));		
						}
						else
						{	
							$this->Session->setFlash(__('Invoice Payment journal posted failed', true));
							$this->redirect(array('controller'=>'invoice_payments','action' => 'view_payment' , $invoice_id));	
						}
					}
					else
					{
						$this->Session->setFlash(__('Invoice Payment successfully', true), 'default', array('class'=>'ok'));
						$this->redirect(array('action' => 'list_invoice_payments', status_invoice_payment_sent_to_spv_id));		
					}
				}
            }
            if (empty($this->data)) {
                  $this->data = $this->InvoicePayment->read(null, $id);
            }
      }

      function cancel($id = null) {
            if (!$id) {
                  $this->Session->setFlash(__('Invalid id for invoice Payment', true));
                  $this->redirect(array('action' => 'index'));
            }

            $this->data = $this->InvoicePayment->read(null, $id);
            $this->data['InvoicePayment']['invoice_payment_status_id'] = status_invoice_payment_draft_id;

            if ($this->InvoicePayment->save($this->data)) {
                  $this->Session->setFlash(__('Invoice Payment has saved', true), 'default', array('class' => 'ok'));
                  //$this->redirect(array('action'=>'view', $id));
                  $this->redirect(array('controller' => 'invoice_payments', 'action' => 'list_invoice_payments', status_invoice_payment_sent_to_spv_id));
            }

            $this->Session->setFlash(__('Invoice Payment was not sent', true));
            $this->redirect(array('controller' => 'invoice_payments', 'action' => 'list_invoice_payments', status_invoice_payment_sent_to_spv_id));
      }
	  
	  function transfer_intern()
	  {
		$layout = 'Screen';
			if (!empty($this->data)) {
				$layout = $this->data['InvoicePayment']['layout'];
			}
			$this->InvoicePayment->recursive = 1;
			list($date_start,$date_end) = $this->set_date_filters('InvoicePayment');
			$conditions[] = array('InvoicePayment.invoice_payment_status_id'=>3);
			$conditions[] = array('InvoicePayment.date_paid between ? and ?' => array($date_start['year'] . '-' . $date_start['month'] . '-' . $date_start['day']. ' 00:00:00', $date_end['year'] . '-' . $date_end['month'] . '-' . $date_end['day']. ' 23:59:59'));

			if($layout=='pdf' || $layout=='xls'){
				$con = $this->InvoicePayment->find('all', array('conditions'=>$conditions));
			}else{
				$this->paginate = array('order'=>'InvoicePayment.id');
				$con = $this->paginate($conditions);
			}
		    $this->set('invoicePayments', $con);
			$Currency = new Currency;
			$Supplier = new Supplier;
			$currency = $Currency->find('list');
			$supplier = $Supplier->find('list');
            $this->set(compact('invoicePaymentStatus', 'supplier', 'date_start', 'date_end', 'currency'));
			
			if ($layout == 'pdf') {
                  Configure::write('debug', 0); // Otherwise we cannot use this method while developing 
                  $this->layout = 'pdf'; //this will use the pdf.ctp layout 
                  $this->render('transfer_intern_pdf');
            } else if ($layout == 'xls') {
                  $this->render('transfer_intern_xls', 'export_xls');
            }

	  }

}

?>