<?php

App::import('Sanitize');
App::import('Model', 'JournalGroup');
App::import('Model', 'JournalTemplate');
App::import('Model', 'JournalTemplateDetail');
App::import('Model', 'JournalPosition');
App::import('Model', 'Account');
App::import('Model', 'DeliveryOrderStatuses');

class InvoicesController extends AppController {

      var $name = 'Invoices';
      var $helpers = array('Number', 'Ajax', 'Javascript');
      var $components = array('RequestHandler');

      function index($invoice_status_id=null, $no=null, $department_id=null, $supplier_id=null, $is_done=null) {
            $this->Invoice->recursive = 1;
            $group_id = $this->Session->read('Security.permissions');

            if ($group_id == fincon_group_id)
                  $conditions =
                          array('or' => array(
                                  array('status_invoice_id' => status_invoice_sent_to_fincon_id),
                                  array('status_invoice_id' => status_invoice_sent_to_fincon_supervisor_id),
                                  array('status_invoice_id' => status_invoice_unpaid_id),
                                  array('status_invoice_id' => status_invoice_paid_id),
                                  array('status_invoice_id' => status_invoice_posted_receival_journal_id),
                                  array('status_invoice_id' => status_invoice_posted_payment_journal_id),
                                  array('status_invoice_id' => status_invoice_processing_id),
                              )
                  );
			else if ($group_id == fincon_supervisor_group_id)
                  $conditions =
                          array('or' => array(
                                  array('status_invoice_id' => status_invoice_sent_to_fincon_supervisor_id),
                                  array('status_invoice_id' => status_invoice_unpaid_id),
                                  array('status_invoice_id' => status_invoice_paid_id),
                                  array('status_invoice_id' => status_invoice_posted_receival_journal_id),
                                  array('status_invoice_id' => status_invoice_posted_payment_journal_id),
                                  array('status_invoice_id' => status_invoice_processing_id),
                              )
                  );
			else if ($group_id == po_approval1_group_id)
                  $conditions =
                          array('or' => array(
                                  array('status_invoice_id' => status_invoice_sent_to_fincon_id),
                                  array('status_invoice_id' => status_invoice_sent_to_supervisor_id),
                              )
                  );				  
            elseif ( $group_id = gs_group_id)
                  $conditions = '';
                          /* array('or' => array(
                                  array('status_invoice_id' => status_invoice_new_id),
                                  array('status_invoice_id' => status_invoice_sent_to_supervisor_id),
                                  array('status_invoice_id' => status_invoice_reject_id),
                              )
                  );			 */	  

            //set up filters session
            if ($invoice_status_id)
                  $this->Session->write('Invoice.invoice_status_id', $invoice_status_id);
            else if (isset($this->data['Invoice']['invoice_status_id']))
                  $this->Session->write('Invoice.invoice_status_id', $this->data['Invoice']['invoice_status_id']);
            if ($invoice_status_id = $this->Session->read('Invoice.invoice_status_id'))
                  $conditions[] = array('status_invoice_id' => $invoice_status_id);

            $layout = $this->data['Invoice']['layout'];
            if ($supplier_id)
                  $this->Session->write('Invoice.supplier_id', $supplier_id);
            else if (isset($this->data['Invoice']['supplier_id']))
                  $this->Session->write('Invoice.supplier_id', $this->data['Invoice']['supplier_id']);
            if ($supplier_id = $this->Session->read('Invoice.supplier_id'))
                  $conditions[] = array('supplier_id' => $supplier_id);
				  
			$currency_id = $this->data['Invoice']['currency_id'];
			if($currency_id)
				$conditions[] = array('currency_id' => $currency_id);

			$conditions[] = array('Invoice.status_invoice_id !='=> status_invoice_archive_id); //archive

			if ($no)
                  $this->Session->write('Invoice.no', trim($no));
            else if (isset($this->data['Invoice']['no']))
                  $this->Session->write('Invoice.no', trim($this->data['Invoice']['no']));
            if ($no = $this->Session->read('Invoice.no'))
                  $conditions[] = array('Invoice.no LIKE' => '%'. $no . '%');

				list($date_start, $date_end) = $this->set_date_filters('Invoice');
            $conditions[] = array('Invoice.inv_date >=' => ($date_start['year'] . '-' . $date_start['month'] . '-' . $date_start['day']),
                'Invoice.inv_date <=' => ($date_end['year'] . '-' . $date_end['month'] . '-' . $date_end['day']));

            if ($layout == 'pdf' || $layout == 'xls') {
                  $con = $this->Invoice->find('all', array('conditions' => $conditions, 'order'=>'Invoice.id'));
            } else {
				  $this->paginate = array('order'=>'Invoice.id');
                  $con = $this->paginate($conditions);
            }
			//echo '<pre>';
			//var_dump($con);
			//echo '</pre>';die();
			$this->set('invoices', $con);
            $copyright_id = $this->configs['copyright_id'];
            $invoiceStatuses = $this->Invoice->InvoiceStatus->find('list', array('conditions' =>array('InvoiceStatus.id !=' => status_invoice_archive_id))); //archive
            $currencies = $this->Invoice->Currency->find('list');
            $suppliers = $this->Invoice->Supplier->find('list');
			$moduleName = 'Invoice > List Invoice';
			$this->set('title_for_layout',  $this->lastSegment($moduleName));
            $this->set(compact('invoice_statuses', 'date_start', 'date_end', 
				'copyright_id', 'invoiceStatuses', 'suppliers', 'currencies', 'moduleName'));


            if ($layout == 'pdf') {
                  Configure::write('debug', 0); // Otherwise we cannot use this method while developing 
                  $this->layout = 'pdf'; //this will use the pdf.ctp layout 
                  $this->render('index_pdf');
            } else if ($layout == 'xls') {
                  $this->render('index_xls', 'export_xls');
            }
      }

      function view($id = null) {
            if (!$id) {
                  $this->Session->setFlash(__('Invalid invoice', true));
                  $this->redirect(array('action' => 'index'));
            }

            $this->data = $invoice = $this->Invoice->read(null, $id);
            $this->Session->write('Invoice.id', $id);
            $this->Session->write('Invoice.wht_rate', $invoice['Invoice']['wht_rate']);
            $this->Session->write('Invoice.vat_rate', $invoice['Invoice']['vat_rate']);
            $this->Session->write('Invoice.department_id', $invoice['Invoice']['department_id']);

            $group_id = $this->Session->read('Security.permissions');
            $status_invoice_id = $invoice['Invoice']['status_invoice_id'];
            $convert_asset = $invoice['Invoice']['convert_asset'];
            $supplier_id = $invoice['Invoice']['supplier_id'];
            $is_settled = $invoice['Invoice']['total'] == $invoice['Invoice']['vtotal_paid'];
			$is_from_po = !empty($invoice['Po']);

            $can_send_to_spv = ($group_id == gs_group_id &&
                    ($status_invoice_id == status_invoice_new_id || $status_invoice_id == status_invoice_registered_id));
					
            $can_send_to_fincon = ($group_id == po_approval1_group_id &&
                    ($status_invoice_id == status_invoice_sent_to_supervisor_id || $status_invoice_id == status_invoice_registered_id));

            $can_sent_to_supervisor = ($group_id == fincon_group_id &&
                    ($status_invoice_id == status_invoice_sent_to_fincon_id || $status_invoice_id == status_invoice_registered_id));

            $can_approve_by_supervisor = ($group_id == fincon_supervisor_group_id &&
                    ($status_invoice_id == status_invoice_sent_to_fincon_supervisor_id || $status_invoice_id == status_invoice_registered_id));

            $can_cancel = ($group_id == fincon_supervisor_group_id &&
							($status_invoice_id == status_invoice_sent_to_fincon_supervisor_id || $status_invoice_id == status_invoice_registered_id))
						||($group_id == fincon_group_id &&
							($status_invoice_id == status_invoice_sent_to_fincon_id || $status_invoice_id == status_invoice_registered_id))
						||($group_id == po_approval1_group_id &&
							($status_invoice_id == status_invoice_sent_to_supervisor_id || $status_invoice_id == status_invoice_registered_id));
            $can_reject = ($group_id == fincon_supervisor_group_id &&
							($status_invoice_id == status_invoice_sent_to_fincon_supervisor_id || $status_invoice_id == status_invoice_registered_id))
						||($group_id == fincon_group_id &&
							($status_invoice_id == status_invoice_sent_to_fincon_id || $status_invoice_id == status_invoice_registered_id))
						||($group_id == po_approval1_group_id &&
							($status_invoice_id == status_invoice_sent_to_supervisor_id || $status_invoice_id == status_invoice_registered_id));
			
			$can_archive = $group_id == gs_group_id && $status_invoice_id == status_invoice_reject_id;
            
			//status unpaid bisa edit
			$can_edit = ($group_id == fincon_group_id && ($status_invoice_id == status_invoice_sent_to_fincon_id || $status_invoice_id == status_invoice_unpaid_id)) ||
				//supervisor tidak bisa edit -- 24 Sep 2014
				//($group_id == gs_group_id && $status_invoice_id == status_invoice_new_id ) || ($group_id == fincon_supervisor_group_id);
				($group_id == gs_group_id && $status_invoice_id == status_invoice_new_id );
			
			//kalau bukan dari PO
			$can_edit_detail = ($group_id == fincon_group_id && $status_invoice_id == status_invoice_sent_to_fincon_id &&
				!$is_from_po
			) ;
			$can_edit_wht = ($group_id == fincon_group_id && $status_invoice_id == status_invoice_sent_to_fincon_id ) ;
			
            $can_delete = ($group_id == fincon_group_id && $status_invoice_id == status_invoice_sent_to_fincon_id && empty($invoice['Po']));
            $can_add_detail = ($group_id == fincon_group_id && $status_invoice_id == status_invoice_sent_to_fincon_id && empty($invoice['Po']));

            $can_register_fa = $group_id == gs_group_id && $convert_asset == 0 && $invoice['Invoice']['request_type_id'] != request_type_stock_id;
            $can_inlog_stock = $group_id == gs_group_id && $convert_asset == 0 && $invoice['Invoice']['request_type_id'] == request_type_stock_id;

            $can_payment = ($group_id == fincon_group_id && $status_invoice_id == status_invoice_unpaid_id) || 
						   ($group_id == fincon_group_id && $status_invoice_id == status_invoice_paid_id) || 
						   ($group_id == fincon_group_id && $status_invoice_id == status_invoice_posted_term_payment_journal_id) || 
						   ($group_id == fincon_group_id && $status_invoice_id == status_invoice_posted_payment_journal_id) || 
						   ($group_id == fincon_group_id && $status_invoice_id == status_invoice_posted_receival_journal_id) || 
						   ($group_id == fincon_group_id && $status_invoice_id == status_invoice_registered_id) || 
							$group_id == fincon_supervisor_group_id ;
            //&& $status_invoice_id==status_invoice_unpaid_id)  ;
            //&& $status_invoice_id==status_invoice_posted_receival_journal_id;
            // $can_posting_receival_journal     	= $group_id==fincon_group_id && $status_invoice_id==status_invoice_unpaid_id;
            // $can_posting_payment_journal     	= $group_id==fincon_group_id && $status_invoice_id==status_invoice_paid_id;
            $can_posting_receival_journal = false;
            $can_posting_payment_journal = false;
            $can_posting_purchase_journal = $group_id == fincon_group_id && $status_invoice_id == status_invoice_paid_id && $is_settled;

            $assetCategories = $this->Invoice->InvoiceDetail->AssetCategory->find('list' /* , array('conditions'=>array('asset_category_type_id !=' => 2)) */);
            $currencies = $this->Invoice->Currency->find('list');
            $departments = $this->Invoice->InvoiceDetail->Department->find('list');
            $bankAccountTypes = $this->Invoice->BankAccountType->find('list');
            $currency = $this->Invoice->Po->Currency->find('list');
            $supplierBankAccounts = $this->Invoice->Supplier->BankAccount->find('list', array('condition' => array('BankAccount.supplier_id' => $supplier_id)));
            $Npbs = $this->Invoice->Po->Npb->find('list');
            $Pos = $this->Invoice->Po->find('list');
			$sql = 'select c.qty, a.name from cost_centers a
					left join npbs b on b.cost_center_id = a.id
					left join invoice_details c on c.npb_id = b.id
					where c.invoice_id = '.$id;
			$costCenters = $this->Invoice->query($sql);
			$invoice['ItemSummary'] = null;
			if ($costCenters):
				foreach($costCenters as $costCenter){
					$CCName[] 	= $costCenter[0]['qty'] .'&nbsp;('.$costCenter[0]['name'].')'.'<br>';				
				}
				$invoice['ItemSummary'] = $CCName;
			endif;
			
			
			//echo "<pre>";
			//var_dump($costCentersCount);
			//echo "</pre>";die();
            $this->set(compact(
                           'invoice', 'can_register_fa', 'can_inlog_stock', 'can_payment', 'currency', '
						   can_posting_receival_journal', 'can_posting_payment_journal', 
						   'can_posting_purchase_journal', 'can_send_to_spv', 
						   'can_sent_to_supervisor', 'can_send_to_fincon',  'can_approve_by_supervisor', 
						   'can_cancel', 'can_reject', 'can_archive',
						   'can_edit', 'can_edit_detail','can_edit_wht',
						   'can_delete', 'can_add_detail', 'assetCategories', 'departments', 'currencies', 'bankAccountTypes', 'supplierBankAccounts', 'Npbs', 'Pos'
                    ));
      }

    function add($po_id = null) {
		if (!empty($this->data)) {
			$po_id = $this->data['Invoice']['po_id'];
			$this->Invoice->create();
			///kalau fincon, status langsung unpaid
			if ($this->Session->read('Security.permissions') == fincon_group_id) {
				$this->data['Invoice']['status_invoice_id'] = status_invoice_sent_to_fincon_id;
			}
			//debug($this->data);
			if ($this->Invoice->save($this->data)) {
				$id = $this->data['Invoice']['id'] = $this->Invoice->id;
				if (isset($this->data['Invoice']['select_details_from_po'])) {
					//$this->add_from_po();
					$this->add_from_do();
				}
				$this->Invoice->update_total($id);
				$this->Session->setFlash(__('The invoice has been saved', true), 'default', array('class' => 'ok'));                        
				//redirect to flag button
				$this->redirect(array('action' => 'view', $this->Invoice->id));
			} else {
				$this->Session->setFlash(__('The invoice could not be saved. Please, try again.', true));
			}
		}

		//conditions po status sent
		//   and already done , all qty = qty received
		//   and not been converted to any invoices
		// $cons			= 'Po.po_status_id="'.status_po_sent_id.'"';
		// $cons			.= ' and ((SELECT if(sum(qty)-sum(qty_received)=0,1,0)  FROM po_details WHERE po_details.po_id = Po.id)=1) ';
		// $cons			.= ' and (select count(*) from invoices_pos where po_id=Po.id )=0';
		// $pos 			= $this->Invoice->Po->find('list', array('conditions'=>$cons) );
		// $poa 			= $this->Invoice->Po->find('all', array('conditions'=>$cons) );
		$suppliers = $this->Invoice->Supplier->find('list');
		$departments = $this->Invoice->Department->find('list');
		$currencies = $this->Invoice->Currency->find('list');
		$requestTypes = $this->Invoice->RequestType->find('list');

		if ($po_id) {
			$po = $this->Invoice->Po->read(null, $po_id);
			$supplier_id = $po['Po']['supplier_id'];
			$supplier_name = $po['Supplier']['name'];
			$request_type_id = $po['Po']['request_type_id'];
			$request_type_name = $po['RequestType']['name'];
			$default_wht_rate = $po['Supplier']['default_wht_rate'];
			$currency_id = $po['Po']['currency_id'];
			$currency_name = $po['Currency']['name'];
			$rp_rate = $po['Currency']['rp_rate'];
		} else {
			$po = null;
			$supplier_id = null;
			$request_type_id = null;
			$default_wht_rate = $this->configs['default_wht_rate'] + 0;
			$currency_id = 1;
			$currency_name = null;
			$rp_rate = 1;
		}

		//kodisi : status sent
		$cons = 'Po.po_status_id="' . status_po_sent_id . '"';
		//and sudah done
		//$cons	.= ' and ((SELECT if(sum(qty)-sum(qty_received)=0,1,0) FROM po_details WHERE po_details.po_id = Po.id)=1) ';
		//and belum terkait ke invoice ini
		//$cons	.= ' and (select count(*) from invoices_pos where po_id=Po.id )=0';
		//and punya supplier ini
		if ($supplier_id)
			$cons .= ' and Po.supplier_id="' . $supplier_id . '"';
		if ($request_type_id)
			$cons .= ' and Po.request_type_id="' . $request_type_id . '"';
		if ($currency_id)
			$cons .= ' and Po.currency_id="' . $currency_id . '"';

		$pos = $this->Invoice->Po->find('list', array('conditions' => $cons));
		$poa = $this->Invoice->Po->find('all', array('conditions' => $cons));

		///find DO connected to this invoice
		$tmp = array();
		$sql = 'select invoices.no, invoices_delivery_orders.* 
				from invoices_delivery_orders left join invoices 
				on invoices_delivery_orders.invoice_id=invoices.id';

		$invoiceDeliveryOrders = $this->Invoice->query($sql);
		foreach ($invoiceDeliveryOrders as $ido) 
		{
			if(DRIVER == 'mysql')
			{
				$tmp[$ido['invoices_delivery_orders']['delivery_order_id']] = array('invoice_id' => $ido['invoices_delivery_orders']['invoice_id'], 'no' => $ido['invoices']['no']);
			}elseif(DRIVER == 'mssql'){
				$invoice_no = $this->Invoice->field('no', array('id'=> $ido[0]['invoice_id']));
				$tmp[$ido[0]['delivery_order_id']] = array('invoice_id' => $ido[0]['invoice_id'], 'no' => $invoice_no);
			}
		}
		$invoiceDeliveryOrders = $tmp;

		$default_vat_rate = $this->configs['default_vat_rate'] + 0;
		
		$moduleName = 'Invoice > New Invoice';
		$this->set('title_for_layout',  $this->lastSegment($moduleName));
		$this->set(compact('assetCategories', 'suppliers', 'requestTypes', 'departments', 
			'po', 'supplier_id', 'po_id', 'poa', 'pos', 'supplier_name', 'request_type_id', 'request_type_name', 
			'default_wht_rate', 'default_vat_rate', 'invoiceDeliveryOrders', 'currency_id', 
			'currency_name', 'rp_rate', 'currencies', 'moduleName'));
    }

      function ajax_edit($id=null) {
            if (!$id && empty($this->data)) {
                  $msg = __('Invalid invoice', true);
            }
            $this->data = $_POST;
            $this->layout = 'ajax';
            $this->autoRender = false;
            $fieldName = $this->data['editorId'];
            $value = str_replace(',', '', $this->data['value']);
            
            $this->data = $this->Invoice->read(null, $id);
			if($fieldName == 'wht_rate'){
				$value = abs($value);
			if($value > 99)
				$value = 99;
			}
			if($fieldName == 'wht_base'){
				$value = abs($value);
			if($value > $this->data['Invoice']['sub_total'])
				$value = $this->data['Invoice']['sub_total'];
			}
			if($fieldName == 'other_cost_total'){
				$value = abs($value);
 			if($value > $this->data['Invoice']['sub_total'])
				$value = $this->data['Invoice']['sub_total'];
			}
           $this->data['Invoice'][$fieldName] = $value;
            if ($this->Invoice->save($this->data)) {
				$this->Invoice->update_total($id);
                  if ($fieldName == 'other_cost_notes')
                        echo $value ? $value : '-';
                  else
                        echo number_format($value, 0);
            }
            else
                  echo '-';
      }

      function edit($id = null) {
            if (!$id && empty($this->data)) {
                  $this->Session->setFlash(__('Invalid invoice', true));
                  $this->redirect(array('action' => 'index'));
            }
			$group_id = $this->Session->read('Security.permissions');
			
			if (!empty($this->data)) {

                  //if ($this->data['Invoice']['select_details_from_po'] == "1") {
                        //$this->add_from_po( );
                  //      $this->add_from_do();
                  //}

                  if ($this->Invoice->save($this->data)) {
                        $this->Invoice->update_total($id); //update invoice total, invoice detail, and invoice payments
                        $this->Session->setFlash(__('The invoice has been saved', true), 'default', array('class' => 'ok'));
                        $this->redirect(array('action' => 'view', $id));
                  } else {
                        $this->Session->setFlash(__('The invoice could not be saved. Please, try again.', true));
                  }
            }
            if (empty($this->data)) {
				$this->data = $this->Invoice->read(null, $id);
				$is_from_po = !empty($this->data['Po']);  
				if($is_from_po)
				{
					$supplier_name = $this->data['Supplier']['name'];
					$currency_name = $this->data['Currency']['name'];
				}
				$can_edit_wht = ($group_id == fincon_group_id && $this->data['Invoice']['status_invoice_id'] == status_invoice_sent_to_fincon_id ) ;
				
				$can_edit_no=false;
				/* if($group_id==fincon_group_id)
				{
					if(!$is_from_po)
						$can_edit_no = true;
				} 
				else*/ if($group_id==gs_group_id)
				{
					if($this->data['Invoice']['status_invoice_id'] == status_invoice_new_id )
						$can_edit_no = true;
				}
            }

            $suppliers = $this->Invoice->Supplier->find('list', array('order' => 'Supplier.name'));
            $departments = $this->Invoice->Department->find('list');
            $currencies = $this->Invoice->Currency->find('list');

            $this->set(compact('assetCategories', 'suppliers', 'departments', 'pos', 'poa', 'currencies',
			'supplier_name','currency_name', 'can_edit_wht', 'can_edit_no',
			'is_from_po'));
      }

      function delete($id = null) {
            if (!$id) {
                  $this->Session->setFlash(__('Invalid id for invoice', true));
                  $this->redirect(array('action' => 'index'));
            }
            if ($this->Invoice->delete($id)) {
                  $this->Session->setFlash(__('Invoice deleted', true), 'default', array('class' => 'ok'));
                  $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Invoice was not deleted', true));
            $this->redirect(array('action' => 'index'));
      }

      function sentToSpv($id = null) {
            if (!$id) {
                  $this->Session->setFlash(__('Invalid id for invoice', true));
                  $this->redirect(array('action' => 'index'));
            }
			
            $d['Invoice']['status_invoice_id'] = status_invoice_sent_to_supervisor_id;
            $d['Invoice']['id'] = $id;
			$invoice = $this->Invoice->read(null, $id);
			foreach($invoice['InvoiceDetail'] as $invoiceDetail){
			if($invoice['Invoice']['total'] >= 1 && $invoiceDetail['qty'] != 0){
            if ($this->Invoice->save($d)) {
                  $this->Session->setFlash(__('Invoice Sent to Supervisor', true), 'default', array('class' => 'ok'));
                  //$this->redirect(array('action'=>'view', $id));
                  $this->redirect(array('action' => 'index'));
				}
				}
			}
            $this->Session->setFlash(__('Invoice was not sent please check Total Amount', true));
            $this->redirect(array('action' => 'view', $id));
      }
      function sentToFincon($id = null) {
            if (!$id) {
                  $this->Session->setFlash(__('Invalid id for invoice', true));
                  $this->redirect(array('action' => 'index'));
            }
            //$invoice = $this->Invoice->read(null, $id);
            //$this->Invoice->set('status_invoice_id',$status_invoice_id);
            $d['Invoice']['status_invoice_id'] = status_invoice_sent_to_fincon_id;
            $d['Invoice']['id'] = $id;
            if ($this->Invoice->save($d)) {
                  $this->Session->setFlash(__('Invoice Sent to Fincon', true), 'default', array('class' => 'ok'));
                  //$this->redirect(array('action'=>'view', $id));
                  $this->redirect(array('action' => 'index'));
            }

            $this->Session->setFlash(__('Invoice was not sent', true));
            $this->redirect(array('action' => 'index'));
      }

      function sentToFinconSpv($id = null) {
            if (!$id) {
                  $this->Session->setFlash(__('Invalid id for invoice', true));
                  $this->redirect(array('action' => 'index'));
            }
            $d['Invoice']['status_invoice_id'] = status_invoice_sent_to_fincon_supervisor_id;
            $d['Invoice']['id'] = $id;
 			$invoice = $this->Invoice->read(null, $id);
			
			foreach($invoice['InvoiceDetail'] as $invoiceDetail){
			if($invoice['Invoice']['total'] >= 1 && $invoiceDetail['qty'] != 0){
				if ($this->Invoice->save($d)) {
                  $this->Session->setFlash(__('Invoice Sent to Fincon Supervisor', true), 'default', array('class' => 'ok'));
                  //$this->redirect(array('action'=>'view', $id));
                  $this->redirect(array('action' => 'index'));
            }
			}
		}
            $this->Session->setFlash(__('Invoice was not sent please check Total Amount', true));
            $this->redirect(array('action' => 'view', $id));
      }

      function update_status($id = null, $status_invoice_id) {
            if (!$id) {
                  $this->Session->setFlash(__('Invalid id for invoice', true));
                  $this->redirect(array('action' => 'index'));
            }
            //$invoice = $this->Invoice->read(null, $id);
            //$this->Invoice->set('status_invoice_id',$status_invoice_id);
            $d['Invoice']['status_invoice_id'] = $status_invoice_id;
            $d['Invoice']['id'] = $id;

            if ($status_invoice_id == status_invoice_unpaid_id) {

                  $d['Invoice']['approved_by'] = $this->Session->read('Userinfo.username');
                  $d['Invoice']['approved_date'] = date('Y-m-d H:i:s');
            }

            if ($this->Invoice->save($d)) {
                  $this->Session->setFlash(__('Invoice Unpaid', true), 'default', array('class' => 'ok'));
                  //$this->redirect(array('action'=>'view', $id));
                  $this->redirect(array('action' => 'index'));
            }

            $this->Session->setFlash(__('Invoice was not sent', true));
            $this->redirect(array('action' => 'index'));
      }

      function to_string($obj, $field) {
            $s = '';
            foreach ($obj as $i => $o) {
                  $s.= $o[$field] . " ";
            }
            return $s;
      }

      /*
        payments are now done at invoice_payments controller
        to handle multiple payments for one invoice.

        when payment are all settled, update the assets date_start / date_end / price /amount
       */

      function payment($id=null) {
            if (!$id && empty($this->data)) {
                  $this->Session->setFlash(__('Invalid invoice', true));
                  $this->redirect(array('action' => 'index'));
            }

            if (!empty($this->data)) {
                  if ($this->Invoice->save($this->data)) {

                        ////update asset date_start and date_end
                        $invoice = $this->Invoice->read(null, $id);
                        foreach ($invoice['DeliveryOrder'] as $deliveryOrder) {
                              $delivery_order_id = $deliveryOrder['id'];
							  if(DRIVER == 'mysql'){
								  $sql = 'update %s set date_start=now(), date_end=date_add(now(), interval maksi-1 month), invoice_id=' . $id . ' where delivery_order_id=' . $delivery_order_id;
                              }elseif(DRIVER == 'mssql'){
								  $sql = 'update %s set date_start=getdate(), date_end=DATEADD(month, maksi-1,getdate()), invoice_id=' . $id . ' where delivery_order_id=' . $delivery_order_id;
                              }
							  $this->log('update asset: ' . sprintf($sql, 'assets'));
                              if (!$this->Invoice->query(sprintf($sql, 'assets'))) {
                                    $this->Session->setFlash(__('failed to update assets', true));
                                    $this->redirect(array('action' => 'index'));
                              }

                              $this->log('update asset detail: ' . sprintf($sql, 'asset_details'));
                              if (!$this->Invoice->query(sprintf($sql, 'asset_details'))) {
                                    $this->Session->setFlash(__('failed to update asset_details', true));
                                    $this->redirect(array('action' => 'index'));
                              }
                        }

                        $this->Session->setFlash(__('The invoice payment has been saved', true), 'default', array('class' => 'ok'));
                        $this->redirect(array('action' => 'index'));
                  } else {
                        $this->Session->setFlash(__('The invoice payment could not be saved. Please, try again.', true));
                  }
            }

            if (empty($this->data)) {
                  $this->data = $invoice = $this->Invoice->read(null, $id);
            }
            $suppliers = $this->Invoice->Supplier->find('list');
            $supplierBankAccounts = $this->Invoice->Supplier->BankAccount->find('list', array('conditions' => array('BankAccount.supplier_id' => $invoice['Invoice']['supplier_id'])));
            $departments = $this->Invoice->Department->find('list');
            $bankAccountTypes = $this->Invoice->BankAccountType->find('list');
            $this->set(compact('invoice', 'assetCategories', 'suppliers', 'departments', 'bankAccountTypes', 'supplierBankAccounts'));
      }

      function update_ajax($id = null) {
            $this->autoRender = false;

            if (!$id && empty($this->data)) {
                  echo json_encode(array('error' => __('Invalid invoice', true)));
            }

            if (!empty($this->data)) {
                  $this->data = Sanitize::paranoid($this->data, array('.'));
                  if ($this->Invoice->save($this->data)) {
                        $invoice = $this->Invoice->read(null, $id);
                        echo json_encode(array('status' => 'The invoice was be saved', 'model' => $invoice['Invoice']));
                  } else {
                        echo json_encode(array('status' => __('The invoice could not be saved. Please, try again.', true)));
                  }
            }
      }

      function add_from_po() {
            $rp_rate = $this->data['Invoice']['rp_rate'];

            $this->Invoice->InvoiceDetail->deleteAll(
                    array('po_id != 0 and invoice_id = "' . $this->data['Invoice']['id'] . '"'), true, true);

            $this->Invoice->query('delete from invoices_pos where invoice_id="' .
                    $this->data['Invoice']['id'] . '"');

            if (empty($this->data['Po']['Po']))
                  return;

            $po_ids = $this->data['Po']['Po'];

            $wht_rate = 0;
            $vat_rate = $this->configs['default_vat_rate'];
            $vat_base = 0;
            $wht_base = 0;
            $sub_total = 0;
            $discount = 0;
            $after_disc = 0;
            $wht_total = 0;
            $vat_total = 0;
            $total = 0;

            foreach ($po_ids as $po_id) {
                  $po = $this->Invoice->Po->findById($po_id);
                  $wht_rate = $po['Supplier']['default_wht_rate'];

                  $vat_base += $po['Po']['vat_base_cur'] * $rp_rate;
                  $wht_base += $po['Po']['wht_base_cur'] * $rp_rate;
                  $sub_total += $po['Po']['sub_total_cur'] * $rp_rate;
                  $discount += $po['Po']['discount_cur'] * $rp_rate;
                  $after_disc += $po['Po']['after_disc_cur'] * $rp_rate;
                  $wht_total += $po['Po']['wht_total_cur'] * $rp_rate;
                  $vat_total += $po['Po']['vat_total_cur'] * $rp_rate;
                  $total += $po['Po']['total_cur'] * $rp_rate;

                  if (!empty($po['PoDetail'])) {
                        foreach ($po['PoDetail'] as $d) {
                              unset($d['id']);
                              $d['invoice_id'] = $this->data['Invoice']['id'];
                              $invoiceDetail['InvoiceDetail'] = $d;
                              $invoiceDetail['InvoiceDetail']['price'] = $invoiceDetail['InvoiceDetail']['price_cur'] * $rp_rate;
                              $invoiceDetail['InvoiceDetail']['wht_rate'] = $wht_rate;
                              $invoiceDetail['InvoiceDetail']['vat_rate'] = $vat_rate;
                              $invoiceDetail['InvoiceDetail']['rp_rate'] = $rp_rate;
                              $this->Invoice->InvoiceDetail->create();
                              $this->Invoice->InvoiceDetail->save($invoiceDetail);
                              $this->log("insert inv detail " . json_encode($d));
                        }
                  }
            }

            ///global POs data to Invoice
            $this->data['Invoice']['wht_rate'] = $wht_rate;
            $this->data['Invoice']['vat_rate'] = $vat_rate;
            $this->data['Invoice']['vat_base'] = $vat_base;
            $this->data['Invoice']['wht_base'] = $wht_base;

            $this->data['Invoice']['sub_total'] = $sub_total;
            $this->data['Invoice']['discount'] = $discount;
            $this->data['Invoice']['after_disc'] = $after_disc;

            $this->data['Invoice']['wht_total'] = $wht_total;
            $this->data['Invoice']['vat_total'] = $vat_total;
            $this->data['Invoice']['total'] = $total;
            $this->log("inv data:" . var_export($this->data, true));
            $this->Invoice->save($this->data);
      }

    function add_from_do() {
		
		$rp_rate = $this->data['Invoice']['rp_rate'];
		$this->Invoice->query('delete from invoices_delivery_orders where invoice_id="' .
				$this->data['Invoice']['id'] . '"');

		if (empty($this->data['DeliveryOrder']['DeliveryOrder']))
			  return;

		$do_ids = $this->data['DeliveryOrder']['DeliveryOrder'];

		$wht_rate = 0;
		$vat_rate = $this->configs['default_vat_rate'];

		$vat_base = 0;
		$wht_base = 0;
		$sub_total = 0;
		$discount = 0;
		$after_disc = 0;
		$wht_total = 0;
		$vat_total = 0;
		$total = 0;

		$vat_base_cur = 0;
		$wht_base_cur = 0;
		$sub_total_cur = 0;
		$discount_cur = 0;
		$after_disc_cur = 0;
		$wht_total_cur = 0;
		$vat_total_cur = 0;
		$total_cur = 0;

		/******************************************
		  first save invoice detail from every do details
		 ****************************************** */
		foreach ($do_ids as $do_id) {
			$do = $this->Invoice->DeliveryOrder->findById($do_id);
			$wht_rate = $do['Supplier']['default_wht_rate'];
			$this->data['Po']['Po'][$do['Po']['id']] = $do['Po']['id'];

			if (!empty($do['DeliveryOrderDetail'])) {
				foreach ($do['DeliveryOrderDetail'] as $d) {
					$invoiceDetail = array();
					$qty = $d['qty'];

					// invoice total in rupiah
					$vat_base += ( $d['is_vat'] ? $d['amount_cur'] * $rp_rate : 0);
					$sub_total += $d['amount_cur'] * $rp_rate;
					$discount += $d['discount_cur'] * $rp_rate;
					$after_disc += $d['amount_after_disc_cur'] * $rp_rate;
					$vat_total += $d['vat_cur'] * $rp_rate;
					$total += ($d['amount_cur'] * $rp_rate) + ($d['vat_cur'] * $rp_rate) - ($d['discount_cur'] * $rp_rate);

					// invoice total in PO currency
					$vat_base_cur += ( $d['is_vat'] ? $d['amount_cur'] : 0);
					$sub_total_cur += $d['amount_cur'];
					$discount_cur += $d['discount_cur'];
					$after_disc_cur += $d['amount_after_disc_cur'];
					$vat_total_cur += $d['vat_cur'];
					$total_cur += $d['amount_nett_cur'];

					unset($d['id']);

					$d['invoice_id'] = $this->data['Invoice']['id'];
					$d['qty'] = $d['qty_received'];

					//details in rupiah
					$d['price'] = $d['price_cur'] * $rp_rate;
					$d['amount'] = $d['amount_cur'] * $rp_rate;
					$d['discount'] = $d['discount_cur'] * $rp_rate;
					$d['amount_after_disc'] = $d['amount_after_disc_cur'] * $rp_rate;
					$d['vat'] = $d['vat_cur'] * $rp_rate;
					$d['amount_nett'] = $d['amount_nett_cur'] * $rp_rate;

					$d['wht_rate'] = $wht_rate;
					$d['vat_rate'] = $vat_rate;
					$d['rp_rate'] = $rp_rate;
					$invoiceDetail['InvoiceDetail'] = $d;
					//debug($invoiceDetail);
					if($d['qty'])
					{
						$this->Invoice->InvoiceDetail->create();
						if (!$this->Invoice->InvoiceDetail->save($invoiceDetail))
							$this->log("error insert invoice detail " . json_encode($invoiceDetail));
						else
							$this->log("success insert inv detail " . json_encode($invoiceDetail));
					}
				}
			}
		}

		///global POs data to Invoice
		$this->data['Invoice']['wht_rate'] = $wht_rate;
		$this->data['Invoice']['vat_rate'] = $vat_rate;
		$this->data['Invoice']['vat_base'] = $vat_base;
		$this->data['Invoice']['wht_base'] = $wht_base;
		$this->data['Invoice']['sub_total'] = $sub_total;
		$this->data['Invoice']['discount'] = $discount;
		$this->data['Invoice']['after_disc'] = $after_disc;
		$this->data['Invoice']['wht_total'] = $wht_total;
		$this->data['Invoice']['vat_total'] = $vat_total;
		$this->data['Invoice']['total'] = $total;

		$this->data['Invoice']['vat_base_cur'] = $vat_base_cur;
		$this->data['Invoice']['wht_base_cur'] = $wht_base_cur;
		$this->data['Invoice']['sub_total_cur'] = $sub_total_cur;
		$this->data['Invoice']['discount_cur'] = $discount_cur;
		$this->data['Invoice']['after_disc_cur'] = $after_disc_cur;
		$this->data['Invoice']['wht_total_cur'] = $wht_total_cur;
		$this->data['Invoice']['vat_total_cur'] = $vat_total_cur;
		$this->data['Invoice']['total_cur'] = $total_cur;

		if (!$this->Invoice->save($this->data))
			$this->log("error saving invoice :" . json_encode($this->data));
		else {
			$this->log("success saving invoice:" . json_encode($this->data));
			/* 	**********************************************************
					then, save invoice payments from po payments
				********************************************************** 	*/
			$id = $this->Invoice->id;
			$invoice = $this->Invoice->read(null, $id);
			foreach ($invoice['Po'] as $po) {
				$po_id = $po['id'];
				$po = $this->Invoice->Po->read(null, $po_id);

				foreach ($po['PoPayment'] as $no => $pp) {
					$d['InvoicePayment']['no'] = 'PAY-' . ($no + 1);
					$d['InvoicePayment']['term_no'] = $pp['term_no'];
					$d['InvoicePayment']['term_percent'] = $pp['term_percent'];
					$d['InvoicePayment']['date_due'] = $pp['date_due'];
					$d['InvoicePayment']['amount_due'] = $pp['amount_due'] * $rp_rate;
					$d['InvoicePayment']['amount_invoice'] = $total;
					$d['InvoicePayment']['amount_paid'] = 0;
					//$d['InvoicePayment']['date_paid'] = date("Y-m-d H:i:s");
					$d['InvoicePayment']['description'] = $pp['description'];
					$d['InvoicePayment']['po_id'] = $po_id;
					$d['InvoicePayment']['invoice_id'] = $id;
					$d['InvoicePayment']['po_payment_id'] = $pp['id'];

					$this->Invoice->InvoicePayment->create();
					if (!$this->Invoice->InvoicePayment->save($d))
						die('cannot save InvoicePayment');
				}
			}
		}
    }

      function report($type=null) {
            $this->Invoice->recursive = 0;
            $layout = $this->data['Invoice']['layout'];
            $group_id = $this->Session->read('Security.permissions');

            if ($type == 'outstanding') {
                  $conditions[] = array('status_invoice_id !=' => status_invoice_posted_payment_journal_id);
            } else if ($type == 'finish') {
                  $conditions[] = array('status_invoice_id' => status_invoice_posted_payment_journal_id);
            }


            //if(($department_id=$this->data['Invoice']['department_id'])) {
            //	$conditions[] = array('department_id'=>$department_id);
            //}

            if (($supplier_id = $this->data['Invoice']['supplier_id'])) {
                  $conditions[] = array('supplier_id' => $supplier_id);
            }

            list($date_start, $date_end) = $this->set_date_filters('Invoice');
            $conditions[] = array('inv_date >=' => ($date_start['year'] . '-' . $date_start['month'] . '-' . $date_start['day']),
                'inv_date <=' => ($date_end['year'] . '-' . $date_end['month'] . '-' . $date_end['day']));
			$this->paginate = array('order'=>'Invoice.id');
            if ($layout == 'pdf' || $layout == 'xls') {
                  $con = $this->Invoice->find('all', array('conditions' => $conditions, 'order'=>'Invoice.id'));
            } else {
                  $con = $this->paginate($conditions);
            }
			//echo '<pre>';
			//var_dump($con);
			//echo '</pre>';die();
            $this->set('invoices', $con);
            $copyright_id = $this->configs['copyright_id'];
            $departments = $this->Invoice->Department->find('list');
            $currencies = $this->Invoice->Currency->find('list');
            $suppliers = $this->Invoice->Supplier->find('list');
            $bankAccountTypes = $this->Invoice->BankAccountType->find('list');
            $supplierBankAccounts = $this->Invoice->Supplier->BankAccount->find('list', array('condition' => array('BankAccount.supplier_id' => $supplier_id)));
			$moduleName = 'Invoice > '. ucwords($type). ' Report';
			$this->set('title_for_layout',  $this->lastSegment($moduleName));
            $this->set(compact(
                            'date_start', 'date_end', 'suppliers', 'supplier_id', 
							'departments', 'department_id', 'type', 'copyright_id', 'bankAccountTypes', 
							'supplierBankAccounts', 'currencies', 'moduleName'));


            if ($layout == 'pdf') {
                  Configure::write('debug', 1); // Otherwise we cannot use this method while developing 
                  $this->layout = 'pdf'; //this will use the pdf.ctp layout 
                  $this->render('report_pdf');
            } else if ($layout == 'xls') {
                  $this->render('report_xls', 'export_xls');
            }
      }
	  
		function flow_report($invoice_status_id=null, $no_inv=null, $no_po=null, $no_do=null) {
            $this->Invoice->recursive = 1;
            $group_id = $this->Session->read('Security.permissions');

            if ($group_id == fincon_group_id)
                  $conditions =
                          array('or' => array(
                                  array('status_invoice_id' => status_invoice_sent_to_fincon_id),
                                  array('status_invoice_id' => status_invoice_sent_to_fincon_supervisor_id),
                                  array('status_invoice_id' => status_invoice_unpaid_id),
                                  array('status_invoice_id' => status_invoice_paid_id),
                                  array('status_invoice_id' => status_invoice_posted_receival_journal_id),
                                  array('status_invoice_id' => status_invoice_posted_payment_journal_id),
                                  array('status_invoice_id' => status_invoice_processing_id),
                              )
                  );
			else if ($group_id == fincon_supervisor_group_id)
                  $conditions =
                          array('or' => array(
                                  array('status_invoice_id' => status_invoice_sent_to_fincon_supervisor_id),
                                  array('status_invoice_id' => status_invoice_unpaid_id),
                                  array('status_invoice_id' => status_invoice_paid_id),
                                  array('status_invoice_id' => status_invoice_posted_receival_journal_id),
                                  array('status_invoice_id' => status_invoice_posted_payment_journal_id),
                                  array('status_invoice_id' => status_invoice_processing_id),
                              )
                  );
			else if ($group_id == po_approval1_group_id)
                  $conditions =
                          array('or' => array(
                                  array('status_invoice_id' => status_invoice_sent_to_fincon_id),
                                  array('status_invoice_id' => status_invoice_sent_to_supervisor_id),
                              )
                  );				  
            elseif ( $group_id = gs_group_id)
                  $conditions = '';
                          /* array('or' => array(
                                  array('status_invoice_id' => status_invoice_new_id),
                                  array('status_invoice_id' => status_invoice_sent_to_supervisor_id),
                                  array('status_invoice_id' => status_invoice_reject_id),
                              )
                  );			 */	  

            //set up filters session
            if ($invoice_status_id)
                  $this->Session->write('Invoice.invoice_status_id', $invoice_status_id);
            else if (isset($this->data['Invoice']['invoice_status_id']))
                  $this->Session->write('Invoice.invoice_status_id', $this->data['Invoice']['invoice_status_id']);
            if ($invoice_status_id = $this->Session->read('Invoice.invoice_status_id'))
                  $conditions[] = array('status_invoice_id' => $invoice_status_id);

            $layout = $this->data['Invoice']['layout'];
            $conditions[] = array('Invoice.status_invoice_id !='=> status_invoice_archive_id); //archive
			
			$no_inv = $this->data['Invoice']['no_inv'];
			$no_po = $this->data['Invoice']['no_po'];
			$no_mr = $this->data['Invoice']['no_do'];
			
			if ($no_inv)
                  $this->Session->write('Invoice.no', trim($no_inv));
            else if (isset($this->data['Invoice']['no']))
                  $this->Session->write('Invoice.no', trim($this->data['Invoice']['no']));
            if ($no = $this->Session->read('Invoice.no'))
                  $conditions[] = array('Invoice.no LIKE' => '%'. $no_inv . '%');
				  
			if ($no_po)
                  $this->Session->write('Po.no', trim($no_po));
            else if (isset($this->data['Po']['no']))
                  $this->Session->write('Po.no', trim($this->data['Po']['no']));
            if ($no = $this->Session->read('Po.no'))
                  $conditions[] = array('Po.no LIKE' => '%'. $no_po . '%');
				  
			if ($no_do)
                  $this->Session->write('DeliveryOrder.no', trim($no_do));
            else if (isset($this->data['DeliveryOrder']['no']))
                  $this->Session->write('DeliveryOrder.no', trim($this->data['DeliveryOrder']['no']));
            if ($no = $this->Session->read('DeliveryOrder.no'))
                  $conditions[] = array('DeliveryOrder.no LIKE' => '%'. $no_do . '%');
				  

				list($date_start, $date_end) = $this->set_date_filters('Invoice');
            $conditions[] = array('Invoice.inv_date >=' => ($date_start['year'] . '-' . $date_start['month'] . '-' . $date_start['day']),
                'Invoice.inv_date <=' => ($date_end['year'] . '-' . $date_end['month'] . '-' . $date_end['day']));

            if ($layout == 'pdf' || $layout == 'xls') {
                  $cons = $this->Invoice->find('all', array('conditions' => $conditions, 'order'=>'Invoice.id'));
            } else {
				  $this->paginate = array('order'=>'Invoice.id');
                  $cons = $this->paginate($conditions);
            }
			
			
            $this->set('invoices', $cons);
            
			$copyright_id = $this->configs['copyright_id'];
            $invoiceStatuses = $this->Invoice->InvoiceStatus->find('list', array('conditions' =>array('InvoiceStatus.id !=' => status_invoice_archive_id))); //archive
            $currencies = $this->Invoice->Currency->find('list');
            $suppliers = $this->Invoice->Supplier->find('list');
			$find = $this->Invoice->query('select a.id as npb_id, a.no, a.approved_by, c.id as po_id from npbs a left join npbs_pos b on b.npb_id = a.id left join pos c on c.id = b.po_id where c.id != null');
			
			foreach($find as $loops){
				$npbs[] = $loops[0];
			}
			//echo '<pre>';
			//var_dump($cons);
			//echo '</pre>';die();
			$moduleName = 'Invoice > Flow Invoice Report';
			$this->set('title_for_layout',  $this->lastSegment($moduleName));
            $this->set(compact('invoice_statuses', 'date_start', 'date_end', 
				'copyright_id', 'invoiceStatuses', 'suppliers', 'currencies', 'moduleName', 'npbs', 'doStatus'));


            if ($layout == 'pdf') {
                  Configure::write('debug', 0); // Otherwise we cannot use this method while developing 
                  $this->layout = 'pdf'; //this will use the pdf.ctp layout 
                  $this->render('index_flow_pdf');
            } else if ($layout == 'xls') {
                  $this->render('index_flow_xls', 'export_xls');
            }
		}

      function ajax_recalc($id) {
            $this->layout = 'ajax';
            $this->autoRender = false;
            $invoice = $this->Invoice->read(null, $id);
            echo json_encode(array('data' => $invoice));
      }
	  
	 	function cancel($id = null) {
		if (!$id) {
				$this->Session->setFlash(__('Invalid Invoices', true));
				$this->redirect(array('action' => 'index'));
			}
			$this->Invoice->read(null, $id);
            $group_id = $this->Session->read('Security.permissions');
		
		//Add Notes Reject invoice and Change Status
		if (!empty($this->data)) {
			$this->data['Invoice']['id'] = $id;
			if($group_id==fincon_supervisor_group_id)
				$this->data['Invoice']['status_invoice_id'] = status_invoice_sent_to_fincon_id;
			elseif($group_id==po_approval1_group_id)
				$this->data['Invoice']['status_invoice_id'] = status_invoice_new_id;
			elseif($group_id==fincon_group_id)
				$this->data['Invoice']['status_invoice_id'] = status_invoice_new_id;
				
			if ($this->Invoice->save($this->data)) {
				$this->Session->setFlash(__('The Invoice has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Invoice could not be saved. Please, try again.', true));
			}
		}
		
		if (empty($this->data)) {
				$invoice = $this->data = $this->Invoice->read(null, $id);
			}

			$departments 	= $this->Invoice->Department->find('list');
			$invoiceStatuses 	= $this->Invoice->InvoiceStatus->find('list');
			$assetCategories 	= $this->Invoice->InvoiceDetail->AssetCategory->find('list');
			$this->set(compact('invoice', 'departments','invoiceStatuses' , 'assetCategories'));
		}
		
	 	function reject($id = null) {
		if (!$id) {
				$this->Session->setFlash(__('Invalid Invoices', true));
				$this->redirect(array('action' => 'index'));
			}
			$this->Invoice->read(null, $id);
		
		//Add Notes Reject invoice and Change Status
		if (!empty($this->data)) {
			$this->data['Invoice']['id'] = $id;
			$this->data['Invoice']['status_invoice_id'] = status_invoice_reject_id;
			if ($this->Invoice->save($this->data)) {
				$this->Session->setFlash(__('The Invoice has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Invoice could not be saved. Please, try again.', true));
			}
		}
	
		if (empty($this->data)) {
				$invoice = $this->data = $this->Invoice->read(null, $id);
			}

			$departments 	= $this->Invoice->Department->find('list');
			$invoiceStatuses 	= $this->Invoice->InvoiceStatus->find('list');
			$assetCategories 	= $this->Invoice->InvoiceDetail->AssetCategory->find('list');
			$this->set(compact('invoice', 'departments','invoiceStatuses' , 'assetCategories'));
		}

      function archive($id = null) {
            if (!$id) {
                  $this->Session->setFlash(__('Invalid id for invoice', true));
                  $this->redirect(array('action' => 'index'));
            }

            $this->data['Invoice']['id'] = $id;
            $this->data['Invoice']['status_invoice_id'] = status_invoice_archive_id;
            if ($this->Invoice->save($this->data)) {
                  $this->Session->setFlash(__('The Invoice has been archived', true), 'default', array('class' => 'ok'));
                  //$this->redirect(array('action' => 'view', $id));
                  $this->redirect(array('action' => 'index'));
            } else {
                  $this->Session->setFlash(__('The Invoice could not be saved. Please, try again.', true));
            }
      }
	  
		function payable_aging_report($no=null, $supplier_id=null){
			$this->Invoice->recursive = 1;
            $group_id = $this->Session->read('Security.permissions');

            $layout = $this->data['Invoice']['layout'];
            if ($supplier_id)
                  $this->Session->write('Invoice.supplier_id', $supplier_id);
            else if (isset($this->data['Invoice']['supplier_id']))
                  $this->Session->write('Invoice.supplier_id', $this->data['Invoice']['supplier_id']);
            if ($supplier_id = $this->Session->read('Invoice.supplier_id'))
                  $conditions[] = array('supplier_id' => $supplier_id);
				  
			$currency_id = $this->data['Invoice']['currency_id'];
			if($currency_id)
				$conditions[] = array('currency_id' => $currency_id);

			if ($no)
                  $this->Session->write('Invoice.no', trim($no));
            else if (isset($this->data['Invoice']['no']))
                  $this->Session->write('Invoice.no', trim($this->data['Invoice']['no']));
            if ($no = $this->Session->read('Invoice.no'))
                  $conditions[] = array('Invoice.no LIKE' => '%'. $no . '%');

				list($date_start, $date_end) = $this->set_date_filters('Invoice');
            $conditions[] = array('Invoice.inv_date >=' => ($date_start['year'] . '-' . $date_start['month'] . '-' . $date_start['day']),
                'Invoice.inv_date <=' => ($date_end['year'] . '-' . $date_end['month'] . '-' . $date_end['day']));

            if ($layout == 'pdf' || $layout == 'xls') {
                  $con = $this->Invoice->find('all', array('conditions' => $conditions, 'order'=>'Invoice.id'));
            } else {
				  $this->paginate = array('order'=>'Supplier.name');
                  $con = $this->paginate($conditions);
            }
			
			$inlogs = $this->Invoice->query('select b.id as inv_id, a.id as inl_id, a.no as inl_no from inlogs a left join invoices b on a.invoice_id = b.id');
			
			//echo "<pre>";
			//var_dump($inlogs);
			//echo "</pre>";die();
            $this->set('invoices', $con);
			
            $copyright_id = $this->configs['copyright_id'];
            $invoiceStatuses = $this->Invoice->InvoiceStatus->find('list', array('conditions' =>array('InvoiceStatus.id !=' => status_invoice_archive_id))); //archive
            $currencies = $this->Invoice->Currency->find('list');
            $suppliers = $this->Invoice->Supplier->find('list');
			$moduleName = 'Supplier > List Payable Aging Report';
			$this->set('title_for_layout',  $this->lastSegment($moduleName));
            $this->set(compact('invoice_statuses', 'date_start', 'date_end', 
				'copyright_id', 'invoiceStatuses', 'suppliers', 'currencies', 'moduleName', 'inlogs'));


            if ($layout == 'pdf') {
                  Configure::write('debug', 0); // Otherwise we cannot use this method while developing 
                  $this->layout = 'pdf'; //this will use the pdf.ctp layout 
                  $this->render('index_pdf');
            } else if ($layout == 'xls') {
                  $this->render('index_xls', 'export_xls');
            }
		}
}

?>
