<?php

class Invoice extends AppModel {

      var $name = 'Invoice';
      var $displayField = 'id';
      /* 	var $actsAs = array('Logable' => array( 
        'userModel' => 'Invoice',
        'userKey' => 'id',
        'change' => 'list', // options are 'list' or 'full'
        'description_ids' => TRUE // options are TRUE or FALSE
        ));
       */
      var $validate = array(
          'no' => array(
              'no tempty' => array(
                  'rule' => array('notempty'),
              //'message' => 'Your custom message here',
              //'allowEmpty' => false,
              //'required' => false,
              //'last' => false, // Stop validation after this rule
              //'on' => 'create', // Limit validation to 'create' or 'update' operations
              ),
              'Unique' => array(
                  'rule' => array('isUnique'),
              //'message' => 'Your custom message here',
              //'allowEmpty' => false,
              //'required' => false,
              //'last' => false, // Stop validation after this rule
              //'on' => 'create', // Limit validation to 'create' or 'update' operations
              ),
          ),
          'inv_date' => array(
				'notempty' => array(
                  'rule' => array('notempty'),
              /* 'date' => array(
                  'rule' => array('date'), */
              //'message' => 'Your custom message here',
              //'allowEmpty' => false,
              //'required' => false,
              //'last' => false, // Stop validation after this rule
              //'on' => 'create', // Limit validation to 'create' or 'update' operations
              ),
          ),
          'supplier_id' => array(
              'notempty' => array(
                  'rule' => array('notempty'),
              //'message' => 'Your custom message here',
              //'allowEmpty' => false,
              //'required' => false,
              //'last' => false, // Stop validation after this rule
              //'on' => 'create', // Limit validation to 'create' or 'update' operations
              ),
          ),
          'price' => array(
              'notempty' => array(
                  'rule' => array('notempty'),
              //'message' => 'Your custom message here',
              //'allowEmpty' => false,
              //'required' => false,
              //'last' => false, // Stop validation after this rule
              //'on' => 'create', // Limit validation to 'create' or 'update' operations
              ),
          ),
          'price_cur' => array(
              'notempty' => array(
                  'rule' => array('notempty'),
              //'message' => 'Your custom message here',
              //'allowEmpty' => false,
              //'required' => false,
              //'last' => false, // Stop validation after this rule
              //'on' => 'create', // Limit validation to 'create' or 'update' operations
              ),
          ),
      );
      //The Associations below have been created with all possible keys, those that are not needed can be removed
      var $belongsTo = array(
          'Supplier' => array(
              'className' => 'Supplier',
              'foreignKey' => 'supplier_id',
              'conditions' => '',
              'fields' => '',
              'order' => ''
          ),
          'Currency' => array(
              'className' => 'Currency',
              'foreignKey' => 'currency_id',
              'conditions' => '',
              'fields' => '',
              'order' => ''
          ),
          'InvoiceStatus' => array(
              'className' => 'InvoiceStatus',
              'foreignKey' => 'status_invoice_id',
              'conditions' => '',
              'fields' => '',
              'order' => ''
          ),
          'Department' => array(
              'className' => 'Department',
              'foreignKey' => 'department_id',
              'conditions' => '',
              'fields' => '',
              'order' => ''
          ),
          'BankAccountType' => array(
              'className' => 'BankAccountType',
              'foreignKey' => 'paid_bank_account_type_id',
              'conditions' => '',
              'fields' => '',
              'order' => ''
          ),
          'RequestType' => array(
              'className' => 'RequestType',
              'foreignKey' => 'request_type_id',
          )
      );
      var $hasMany = array(
          'InvoiceDetail' => array(
              'className' => 'InvoiceDetail',
              'foreignKey' => 'invoice_id',
              'dependent' => true,
              'conditions' => '',
              'fields' => '',
              'order' => '',
              'limit' => '',
              'offset' => '',
              'exclusive' => '',
              'finderQuery' => '',
              'counterQuery' => ''
          ),
          'InvoicePayment' => array(
              'className' => 'InvoicePayment',
              'foreignKey' => 'invoice_id',
              'dependent' => true
          ),
      );
      var $hasAndBelongsToMany = array(
          'Po' => array(
              'className' => 'Po',
              'joinTable' => 'invoices_pos',
              'foreignKey' => 'invoice_id',
              'associationForeignKey' => 'po_id',
              'unique' => true,
          ),
          // 'PoPayment' => array(
          // 'className'              => 'PoPayment',
          // 'joinTable'              => 'invoices_po_payments',
          // 'foreignKey'             => 'invoice_id',
          // 'associationForeignKey'  => 'po_payment_id',
          // 'unique'                 => true,
          // ),
          'Purchase' => array(
              'className' => 'Purchase',
              'joinTable' => 'invoices_purchases',
              'foreignKey' => 'purchase_id',
              'associationForeignKey' => 'invoice_id',
              'unique' => true,
          ),
          'DeliveryOrder' => array(
              'className' => 'DeliveryOrder',
              'joinTable' => 'invoices_delivery_orders',
              'foreignKey' => 'invoice_id',
              'associationForeignKey' => 'delivery_order_id',
              'unique' => true,
          )
      );
      var $virtualFields = array(
          'vsubtotal' => 'SELECT SUM(invoice_details.amount) FROM invoice_details WHERE invoice_details.invoice_id = Invoice.id',
          'vsubtotal_cur' => 'SELECT SUM(invoice_details.amount_cur) FROM invoice_details WHERE invoice_details.invoice_id = Invoice.id',
          'vtotal_discount' => 'SELECT SUM(invoice_details.discount) FROM invoice_details WHERE invoice_details.invoice_id = Invoice.id',
          'vtotal_after_disc' => 'SELECT SUM(invoice_details.amount_after_disc) FROM invoice_details WHERE invoice_details.invoice_id = Invoice.id',
          'vtotal_vat_base' => SQL_INVOICE_VTOTAL_VAT_BASE,
          //'vtotal_vat' => 'SELECT SUM( invoice_details.vat ) FROM invoice_details WHERE invoice_details.invoice_id = Invoice.id',
          'vtotal_vat' => 'SELECT SUM( vat ) FROM invoice_details WHERE invoice_details.invoice_id = Invoice.id',
          'vtotal_wht_base' => SQL_INVOICE_VTOTAL_WHT_BASE,
          'vtotal_wht' => 'SELECT SUM( invoice_details.wht ) FROM invoice_details WHERE invoice_details.invoice_id = Invoice.id',
          'vtotal_discount_cur' => 'SELECT SUM(invoice_details.discount_cur) FROM invoice_details WHERE invoice_details.invoice_id = Invoice.id',
          'vtotal_after_disc_cur' => 'SELECT SUM(invoice_details.amount_after_disc_cur) FROM invoice_details WHERE invoice_details.invoice_id = Invoice.id',
          'vtotal_vat_base_cur' => SQL_INVOICE_VAT_BASE_CUR,
          'vtotal_vat_cur' => 'SELECT SUM( invoice_details.vat_cur ) FROM invoice_details WHERE invoice_details.invoice_id = Invoice.id',
          'vtotal_wht_base_cur' => SQL_INVOICE_WHT_BASE_CUR,
          'vtotal_wht_cur' => 'SELECT SUM( invoice_details.wht_cur ) FROM invoice_details WHERE invoice_details.invoice_id = Invoice.id',
          'status_name' => 'SELECT name from invoice_statuses s where s.id = Invoice.status_invoice_id',
          'vtotal_paid' => 'SELECT SUM( invoice_payments.amount_paid ) FROM invoice_payments WHERE invoice_payments.invoice_id = Invoice.id',
          'vtotal_amount_due' => 'SELECT SUM( invoice_payments.amount_due ) FROM invoice_payments WHERE invoice_payments.invoice_id = Invoice.id'
      );

      function beforeSave() {

            // if(isset($this->data['Invoice']['id']) && isset($this->data['Invoice']['wht_rate']))
            // {
            // $this->query('update invoice_details set 
            // wht_rate ="'.$this->data['Invoice']['wht_rate'].'" ,
            // wht      = if(is_wht=1, amount_after_disc* wht_rate/100, 0),
            // wht_cur  = if(is_wht=1, amount_after_disc_cur* wht_rate / 100, 0)
            // where invoice_id="'.$this->data['Invoice']['id'].'"' );
            // $invoice = $this->read(null, $this->data['Invoice']['id']);
            // $this->data['Invoice']['wht_base'] = $invoice['Invoice']['vtotal_wht_base'];
            // $this->data['Invoice']['wht_total'] = $invoice['Invoice']['vtotal_wht'];
            // $this->data['Invoice']['vat_base'] = $invoice['Invoice']['vtotal_vat_base'];
            // $this->data['Invoice']['vat_total'] = $invoice['Invoice']['vtotal_vat'];
            // $this->data['Invoice']['wht_base_cur'] = $invoice['Invoice']['vtotal_wht_base_cur'];
            // $this->data['Invoice']['wht_total_cur'] = $invoice['Invoice']['vtotal_wht_cur'];
            // $this->data['Invoice']['vat_base_cur'] = $invoice['Invoice']['vtotal_vat_base_cur'];
            // $this->data['Invoice']['vat_total_cur'] = $invoice['Invoice']['vtotal_vat_cur'];
            //$this->log('model data-'. var_export($this->data ,true) );
            // }
            //hitung grand total

            if (isset($this->data['Invoice']['after_disc_cur'])
                    && isset($this->data['Invoice']['vat_total_cur'])
                    && isset($this->data['Invoice']['other_cost_total'])
                    && isset($this->data['Invoice']['wht_total_cur']))
                  $this->data['Invoice']['total_cur'] = $this->data['Invoice']['after_disc_cur'] + $this->data['Invoice']['vat_total_cur'] - $this->data['Invoice']['wht_total_cur'] - $this->data['Invoice']['other_cost_total'];

            if (isset($this->data['Invoice']['after_disc'])
                    && isset($this->data['Invoice']['vat_total'])
                    && isset($this->data['Invoice']['other_cost_total'])
                    && isset($this->data['Invoice']['wht_total']))
                  $this->data['Invoice']['total'] = $this->data['Invoice']['after_disc'] + $this->data['Invoice']['vat_total'] - $this->data['Invoice']['wht_total'] - $this->data['Invoice']['other_cost_total'];

            //$this->log('tota-'. $this->data['Invoice']['total']);
            return true;
      }

      function update_total($id) {
            
            /************************************
              dipakai ketika invoice diedit,
              ppn pph di invoice detail diedit
            ************************************ */
			
			$this->id=$id;

            $invoice = $this->read(null, $id);
            if (!isset($this->data['Invoice']['wht_rate']))
                  $this->data['Invoice']['wht_rate'] = $invoice['Invoice']['wht_rate'];
            $rp_rate = $invoice['Invoice']['rp_rate'];
		
            /**********************************
             * 1. update invoice_details
             *********************************/
			
            if(DRIVER=='mysql') {
                  $wht =  'if(is_wht=1, amount_after_disc* wht_rate/100, 0)' ;
                  $vat =  'if(is_vat=1, amount_after_disc* vat_rate/100, 0)' ;
            }elseif(DRIVER=='mssql') {
                  $wht =  '(case is_wht when 1 then amount_after_disc* wht_rate/100 else 0 end)' ;			
                  $vat =  '(case is_vat when 1 then amount_after_disc* vat_rate/100 else 0 end)' ;			
            }
			
            $sql='update 
			invoice_details set 
			rp_rate =  ' . $rp_rate . ',
			price = (price_cur * ' . $rp_rate . ')
            where invoice_id="' . $id . '"';
            $this->query($sql);
			
            $sql='update 
			invoice_details set 
			amount = ROUND(qty*price, 0) 
            where invoice_id="' . $id . '"';
            $this->query($sql);
            
			if(!$this->data['Invoice']['wht_rate']){
				$this->data['Invoice']['wht_rate'] = '0';
			}
			
            $sql='update 
			invoice_details set 
			amount_after_disc = ROUND(amount - discount, 0), 
			wht_rate ="' . $this->data['Invoice']['wht_rate'] . '" ,
			vat_rate ="' . $this->data['Invoice']['vat_rate'] . '" 
			where invoice_id="' . $id . '"';
            $this->query($sql);
            
            $sql='update 
			invoice_details set 
			wht      = '.$wht.',
			vat      = '.$vat.'
			where invoice_id="' . $id . '"';
            $this->query($sql);
			
            $sql='update 
			invoice_details set 
			amount_nett = (amount_after_disc + vat + wht)
			where invoice_id="' . $id . '"';
            $this->query($sql);

            /**********************************
             * 2. update invoices
             *********************************/
            $invoice = $this->read(null, $id);
            $this->data['Invoice']['sub_total'] = round($invoice['Invoice']['vsubtotal']) + 0;
            $this->data['Invoice']['discount'] = round($invoice['Invoice']['vtotal_discount']) + 0;
            $this->data['Invoice']['after_disc'] = round($invoice['Invoice']['vtotal_after_disc']) + 0;
            $this->data['Invoice']['vat_base'] = round($invoice['Invoice']['vtotal_vat_base']) + 0;
            $this->data['Invoice']['vat_total'] = round($invoice['Invoice']['vtotal_vat']) + 0;
            //$this->data['Invoice']['wht_base'] = round($invoice['Invoice']['vtotal_wht_base']) + 0;
            $this->data['Invoice']['wht_total'] = ($this->data['Invoice']['wht_base']/100) * $this->data['Invoice']['wht_rate'];
            $this->data['Invoice']['wht_rate'] = round($invoice['Invoice']['wht_rate']) + 0;
            $this->data['Invoice']['vat_rate'] = round($invoice['Invoice']['vat_rate']) + 0;
            $this->save($this->data);
            
            /**********************************
             * 3. update invoice_payments
             *********************************/
			 
			$invoice_total = $this->field('total');
            if(!empty($invoice['InvoicePayment']))
            {
				  $no_inv = $invoice['Invoice']['no'];
				  $i = 1;
                  foreach($invoice['InvoicePayment'] as $ip)
                  {
						$i++;
                        $this->InvoicePayment->id=$ip['id'];
                        $this->InvoicePayment->set('no', $no_inv);
                        $this->InvoicePayment->set('amount_due', $invoice_total * $ip['term_percent']/100);
                        $this->InvoicePayment->set('amount_invoice', $invoice_total);
                        $this->InvoicePayment->save();
						$no_inv = 'PAY-'.$i;
                  }
            }
      }

      // function calc_tax($id_detail)
      // {
      // $inv = $this->InvoiceDetail->read(null, $id_detail);
      // $id = $inv['InvoiceDetail']['invoice_id'];
      // $inv = $this->InvoiceDetail->find('all', 
      // array('conditions'=>array('InvoiceDetail.invoice_id'=>$id)));
      // $vat_base = 0;
      // $wht_base = 0;
      // $vat = 0;
      // $wht = 0;
      // foreach ($inv as $i=>$d)
      // {
      // $vat_base += $d['InvoiceDetail']['is_vat']==1?$d['InvoiceDetail']['amount_after_disc']:0;
      // $wht_base += $d['InvoiceDetail']['is_wht']==1?$d['InvoiceDetail']['amount_after_disc']:0;
      // $vat += $d['InvoiceDetail']['is_vat']==1?$d['InvoiceDetail']['amount_after_disc']*$d['Invoice']['vat_rate']:0;
      // $wht += $d['InvoiceDetail']['is_wht']==1?$d['InvoiceDetail']['amount_after_disc']*$d['Invoice']['wht_rate']:0;
      // }
      // $this->data = $this->read(null, $id);
      // $this->data['Invoice']['id'] = $id;
      // $this->data['Invoice']['vat_base'] = $vat_base;
      // $this->data['Invoice']['wht_base'] = $wht_base;
      // $this->data['Invoice']['vat'] = $vat;
      // $this->data['Invoice']['wht'] = $wht;
      // $this->save($this->data);
      // }
      
      function updatePayment($invoie_id)
      {
            
      }

      function count_by_status($status_id) {
            $c = $this->find('count', array('conditions' => array('Invoice.status_invoice_id' => $status_id)));
            return $c;
      }

      function processSettlement($id) {
            $invoice = $this->read(null, $id);
            $lunas = $invoice['Invoice']['total'] == $invoice['Invoice']['vtotal_paid'];
			//debug($id);
			
            if ($lunas) 
			{
				/*************************************************************
				update date_start dan date_end asset dan asset detail
				**************************************************************/
				if(DRIVER == 'mysql')
				{
					foreach ($invoice['DeliveryOrder'] as $deliveryOrder) 
					{
						$delivery_order_id = $deliveryOrder['id'];
						$sql = 'update %s set date_start=now(), date_end=date_add(now(), interval maksi month), invoice_id=' . $id . ' where delivery_order_id=' . $delivery_order_id;
						$this->log('update asset: ' . sprintf($sql, 'assets'));
						if (!$this->query(sprintf($sql, 'assets'))) 
						{
							  $this->Session->setFlash(__('failed to update assets', true));
							  $this->redirect(array('action' => 'index'));
						}

						$this->log('update asset detail: ' . sprintf($sql, 'asset_details'));
						if (!$this->query(sprintf($sql, 'asset_details'))) 
						{
							  $this->Session->setFlash(__('failed to update asset_details', true));
							  $this->redirect(array('action' => 'index'));
						}
					}
					$sql_paid_date = 'update invoices set paid_date=NOW(), status_invoice_id=' . status_invoice_paid_id . ' where id=' . $id;
				}
				elseif(DRIVER == 'mssql')
				{
					foreach ($invoice['DeliveryOrder'] as $deliveryOrder) 
					{
						$delivery_order_id = $deliveryOrder['id'];
						$sql = 'update %s set date_start=getdate(), date_end=DATEADD(month,maksi,getdate()), invoice_id=' . $id . ' where delivery_order_id=' . $delivery_order_id;
						if (!$this->query(sprintf($sql, 'assets'))) 
						{
							  $this->Session->setFlash(__('failed to update assets', true));
							  $this->redirect(array('action' => 'index'));
						}

						$this->log('update asset detail: ' . sprintf($sql, 'asset_details'));
						if (!$this->query(sprintf($sql, 'asset_details'))) 
						{
							  $this->Session->setFlash(__('failed to update asset_details', true));
							  $this->redirect(array('action' => 'index'));
						}
					}
					$sql_paid_date = 'update invoices set paid_date=getdate(), status_invoice_id=' . status_invoice_paid_id . ' where id=' . $id;
				}
				
				$this->query($sql_paid_date);
				
				
				/*************************************************************
				update price and amount asset sesuai dengan kurs invoice
				**************************************************************/
				$rp_rate = $invoice['Invoice']['rp_rate'];
				$sql_price_amount = 'update assets set price=price_cur * '.$rp_rate.', amount=amount_cur*'.$rp_rate.' where invoice_id=' . $id;
				if (!$this->query(sprintf($sql_price_amount))) 
				{
					  $this->Session->setFlash(__('failed to update price and amount assets', true));
					  $this->redirect(array('action' => 'index'));
				}				
				$sql_price = 'update asset_details set price=price_cur * '.$rp_rate.' where invoice_id=' . $id;
				if (!$this->query(sprintf($sql_price))) 
				{
					  $this->Session->setFlash(__('failed to update price asset_details', true));
					  $this->redirect(array('action' => 'index'));
				}
				
            } else {
                  $sql = 'update invoices set paid_date=NULL, status_invoice_id=' . status_invoice_unpaid_id . ' where id=' . $id;
                  $this->query($sql);
                  $sql = 'update assets set date_start=NULL, date_end=NULL where invoice_id =' . $id;
                  $this->query($sql);
                  $sql = 'update asset_details set date_start=NULL, date_end=NULL where invoice_id =' . $id;
                  $this->query($sql);
            }
      }
	  
	  function processing($id){
		$invoice = $this->query('select sum(processing) as processing from invoice_payments where invoice_id ="'.$id.'"');
		if($invoice[0][0]['processing'] == 0){
			$this->id = $id;
			$this->set('status_invoice_id', status_invoice_processing_id);
			$this->save();
		}
	  }

}

?>