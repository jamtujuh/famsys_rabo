<?php
class InvoiceDetailsController extends AppController {

	var $name = 'InvoiceDetails';
	var $helpers = array('Number','Ajax','Javascript');
	var $cominvoicenents = array( 'RequestHandler' );
	var $is_ajax=false;

	function index() {
		$this->InvoiceDetail->recursive = 0;
		$this->paginate = array('order'=>'InvoiceDetail.id');
		$this->set('invoiceDetails', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid invoice detail', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('invoiceDetail', $this->InvoiceDetail->read(null, $id));
	}

	function add() {
		$invoiceDetail=null;

		if($this->is_ajax)
		{
			$this->layout='ajax';
			$this->autoRender = false;
			$msg='';
			$count=0;
		}
		
		if (!empty($this->data)) {
			$this->InvoiceDetail->create();
			$this->data['InvoiceDetail']['amount'] = $this->data['InvoiceDetail']['price']*$this->data['InvoiceDetail']['qty']  ;
			$this->data['InvoiceDetail']['amount_cur'] = $this->data['InvoiceDetail']['price_cur']*$this->data['InvoiceDetail']['qty']  ;
			if ($this->InvoiceDetail->save($this->data)) {
				if($this->is_ajax)
				{
					$status = 'ok';
					$msg=__('The invoice detail has been saved', true);
					$invoiceDetail = $this->InvoiceDetail->read(null, $this->InvoiceDetail->id);
					$invoice_id=$invoiceDetail['InvoiceDetail']['invoice_id'];
					$this->InvoiceDetail->Invoice->update_total($invoice_id);
					$count = $this->InvoiceDetail->find('count', array('conditions'=>array('Invoice.id'=>$this->Session->read('Invoice.id'))));
				}
				else
				{
					$this->Session->setFlash(__('The invoice detail has been saved', true), 'default', array('class'=>'ok'));
					$this->redirect(array('controller'=>'invoices','action' => 'view', $this->Session->read('Invoice.id')));
				}
			} else {
				if($this->is_ajax)
				{
					$status = 'failed';
					$msg=__('The invoice detail could not be saved. Please, try again.', true);
				}
				else
					$this->Session->setFlash(__('The invoice detail could not be saved. Please, try again.', true));
			}
		}
		
		if($this->is_ajax)
		{
			echo json_encode(array('status'=>$status, 'msg'=>$msg, 'count'=>$count, 'data'=>$invoiceDetail));
		}
		else
		{
			$invoices = $this->InvoiceDetail->Invoice->find('list');
			$assetCategories = $this->InvoiceDetail->AssetCategory->find('list',  array('conditions'=>array('is_asset'=>1)));
			$currencies = $this->InvoiceDetail->Currency->find('list');
			$departments = $this->InvoiceDetail->Department->find('list');
			$this->set(compact('invoices', 'assetCategories', 'currencies','departments'));
		}
	}
	
	function ajax_add()
	{
		$this->is_ajax=true;
		$this->add();
	}

	function edit($id = null) {
		$msg = '';
		
		if($this->is_ajax)
		{
			$this->data=$_POST;
			$this->layout='ajax';
			$this->autoRender=false;
			$fieldName = $this->data['editorId'];
			$value = str_replace(',','',$this->data['value']);
			list($fieldName,$id)=explode('.',$fieldName);			
			$this->data = $this->InvoiceDetail->read(null, $id);
			$this->data['InvoiceDetail'][$fieldName] = $value;
			$this->data['InvoiceDetail']['id'] = $id;
		}
		
		if (!$id && empty($this->data)) {
			if($this->is_ajax)
			{
				$msg = __('Invalid invoice detail', true);
			}
			else
			{
				$this->Session->setFlash(__('Invalid invoice detail', true));
				$this->redirect(array('action' => 'index'));
			}
		}
		
		if (!empty($this->data)) {
			if ($this->InvoiceDetail->save($this->data)) {
				//$this->update_invoice_totals($this->data['InvoiceDetail']['invoice_id']);
				$this->InvoiceDetail->Invoice->update_total($this->data['InvoiceDetail']['invoice_id']);
				if($this->is_ajax)
				{
					$msg = __('The invoice detail has been saved', true);
				}
				else
				{				
					$this->Session->setFlash(__('The invoice detail has been saved', true), 'default', array('class'=>'ok'));
					$this->redirect(array('controller'=>'invoices','action' => 'view', $this->Session->read('Invoice.id')));
				}
			} else {
				if($this->is_ajax)
				{
					$msg = __('The po detail could not be saved. Please, try again.', true);
				}
				else
				{
					$this->Session->setFlash(__('The invoice detail could not be saved. Please, try again.', true));
				}
			}
		}
		//if (empty($this->data)) {
			$this->data = $this->InvoiceDetail->read(null, $id);
		//}

		if($this->is_ajax)
		{
			echo number_format($this->data['InvoiceDetail'][$fieldName],0);
		}
		else
		{		
			$invoices = $this->InvoiceDetail->Invoice->find('list');
			$assetCategories = $this->InvoiceDetail->AssetCategory->find('list',  array('conditions'=>array('is_asset'=>1)));
			$currencies = $this->InvoiceDetail->Currency->find('list');		
			$departments = $this->InvoiceDetail->Department->find('list');
			$this->set(compact('invoices', 'assetCategories', 'currencies','departments'));
		}
	}
	
	function ajax_edit($id)
	{
		$this->is_ajax=true;
		$this->edit($id );
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for invoice detail', true));
			$this->redirect(array('action'=>'index'));
		}
		$invoiceDetail = $this->InvoiceDetail->read(null,$id);
		$invoice_id = $invoiceDetail['InvoiceDetail']['invoice_id'];			
		
		if ($this->InvoiceDetail->delete($id)) {
			//$this->update_invoice_totals($invoice_id, true, $id);
			$this->InvoiceDetail->Invoice->update_total($invoice_id);
		
			$this->Session->setFlash(__('Invoice detail deleted', true), 'default', array('class'=>'ok'));
			$this->redirect(array('controller'=>'invoices','action' => 'view', $this->Session->read('Invoice.id')));
		}
		$this->Session->setFlash(__('Invoice detail was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function set_vat($id = null, $is_vat) {
		$invoiceDetail = $this->InvoiceDetail->read(null,$id);
		$this->data['InvoiceDetail']['id'] = $id;
		$this->data['InvoiceDetail']['is_vat'] = $is_vat;
		$this->data['InvoiceDetail']['amount_after_disc'] = $invoiceDetail['InvoiceDetail']['amount_after_disc'];
		$this->data['InvoiceDetail']['amount_after_disc_cur'] = $invoiceDetail['InvoiceDetail']['amount_after_disc_cur'];
		$invoice_id = $invoiceDetail['InvoiceDetail']['invoice_id'];
		
		if ($d=$this->InvoiceDetail->save($this->data)) {
			
			//$this->InvoiceDetail->Invoice->calc_tax($id);
			//$this->update_invoice_totals($invoice_id);
			$this->InvoiceDetail->Invoice->update_total($invoice_id);
			
			$this->Session->setFlash(__('The invoice has been saved', true), 'default', array('class'=>'ok'));
			$this->redirect(array('controller'=>'invoices','action' => 'view', $this->Session->read('Invoice.id')));
		} else {
			$this->Session->setFlash(__('The invoice could not be saved. Please, try again.', true));
			$this->redirect(array('controller'=>'invoices','action' => 'view', $this->Session->read('Invoice.id')));
		}
	}
	
	function set_wht($id = null, $is_wht) {
		$invoiceDetail = $this->InvoiceDetail->read(null,$id);
	
		$this->data['InvoiceDetail']['id'] = $id;
		$this->data['InvoiceDetail']['is_wht'] = $is_wht;
		$this->data['InvoiceDetail']['amount_after_disc'] = $invoiceDetail['InvoiceDetail']['amount_after_disc'];
		$this->data['InvoiceDetail']['amount_after_disc_cur'] = $invoiceDetail['InvoiceDetail']['amount_after_disc_cur'];
		$invoice_id = $invoiceDetail['InvoiceDetail']['invoice_id'];
		
		if ($this->InvoiceDetail->save($this->data)) {
			//$this->update_invoice_totals($invoice_id);
			$this->InvoiceDetail->Invoice->update_total($invoice_id);

			$this->Session->setFlash(__('The invoice has been saved', true), 'default', array('class'=>'ok'));
			$this->redirect(array('controller'=>'invoices','action' => 'view', $this->Session->read('Invoice.id')));
		} else {
			$this->Session->setFlash(__('The invoice could not be saved. Please, try again.', true));
			$this->redirect(array('controller'=>'invoices','action' => 'view', $this->Session->read('Invoice.id')));
		}
	}	
	
	// function update_invoice_totals($invoice_id, $delete=false, $id=null)
	// {
		// $invoice = $this->InvoiceDetail->Invoice->read(null, $invoice_id );
		
		// $data['Invoice']['id'] 				= $invoice['Invoice']['id'];

		// //in currency
		// unset($data['InvoiceDetail']);
		// $data['Invoice']['sub_total_cur'] 	= $invoice['Invoice']['vsubtotal_cur'] + 0;
		// $data['Invoice']['discount_cur'] 	= $invoice['Invoice']['vtotal_discount_cur'] +0;
		// $data['Invoice']['after_disc_cur'] 	= $invoice['Invoice']['vtotal_after_disc_cur']+0;
		// $data['Invoice']['vat_base_cur'] 	= $invoice['Invoice']['vtotal_vat_base_cur']+0;
		// $data['Invoice']['vat_total_cur'] 	= $invoice['Invoice']['vtotal_vat_cur']+0;
		// $data['Invoice']['wht_base_cur'] 	= $invoice['Invoice']['vtotal_wht_base_cur']+0;
		// $data['Invoice']['wht_total_cur'] 	= $invoice['Invoice']['vtotal_wht_cur']+0;

		// //in home currency
		// $data['Invoice']['sub_total'] 	= $invoice['Invoice']['vsubtotal'] + 0;
		// $data['Invoice']['discount'] 	= $invoice['Invoice']['vtotal_discount'] +0;
		// $data['Invoice']['after_disc'] 	= $invoice['Invoice']['vtotal_after_disc']+0;
		// $data['Invoice']['vat_base'] 	= $invoice['Invoice']['vtotal_vat_base']+0;
		// $data['Invoice']['vat_total'] 	= $invoice['Invoice']['vtotal_vat']+0;		
		// $data['Invoice']['wht_base'] 	= $invoice['Invoice']['vtotal_wht_base']+0;
		// $data['Invoice']['wht_total'] 	= $invoice['Invoice']['vtotal_wht']+0;		
				
		// $data['Invoice']['wht_rate'] 	= $invoice['Invoice']['wht_rate']+0;
		// $data['Invoice']['vat_rate'] 	= $invoice['Invoice']['vat_rate']+0; 
		// $this->InvoiceDetail->Invoice->saveAll( $data );

		// if($delete)
			// $this->InvoiceDetail->delete($id);
	// }	
}
?>
