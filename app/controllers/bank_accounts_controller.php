<?php
class BankAccountsController extends AppController {

	var $name = 'BankAccounts';
	var $helpers = array('Ajax', 'Javascript', 'Time');
	var $components = array('RequestHandler');
	var $is_ajax=false;

	function index() {
		$this->BankAccount->recursive = 0;
		$this->paginate = array('order'=>'BankAccount.id');
		$this->set('bankAccounts', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid bank account', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('bankAccount', $this->BankAccount->read(null, $id));
	}

	function add() {
		//$this->BankAccount->recursive = 2;
		$this->BankAccount->recursive = 1;
		if($this->is_ajax)
		{
			$this->layout='ajax';
			$this->autoRender=false;
			$msg='';
			$status='';
			$bankAccount=null;
			$count=0;
		}
		
		if (!empty($this->data)) {
			$this->BankAccount->create();
			if ($this->BankAccount->save($this->data)) {
				if($this->is_ajax)
				{
					$msg=__('The bank account has been saved', true);
					
					$bankAccount=$this->BankAccount->read(null, $this->BankAccount->id);
					$currency = $this->BankAccount->Currency->find('list');
					$bankAccountType = $this->BankAccount->BankAccountType->find('list');
					$count = $this->BankAccount->find('count', array('conditions'=>array('BankAccount.supplier_id'=>$this->Session->read('Supplier.id') )));
				}
				else
				{
					$this->Session->setFlash(__('The bank account has been saved', true), 'default', array('class'=>'ok'));
					$this->redirect(array('controller'=>'suppliers','action' => 'view', $this->Session->read('Supplier.id')));
				}
			} else {
				if($this->is_ajax)
					$this->Session->setFlash(__('The bank account could not be saved. Please, try again.', true));
				else
					$this->Session->setFlash(__('The bank account could not be saved. Please, try again.', true));
			}
		}
		
		if($this->is_ajax)
		{
			echo json_encode(array('status'=>$status, 'msg'=>$msg, 'data'=>$bankAccount, 'currency'=>$currency[$bankAccount['BankAccount']['currency_id']], 'bankAccountType'=>$bankAccountType[$bankAccount['BankAccount']['bank_account_type_id']], 'count'=>$count));
		}
		else
		{
			$suppliers = $this->BankAccount->Supplier->read(null, $this->Session->read('Supplier.id') );
			$supplier_name = $suppliers['Supplier']['name'];
			$bankAccountTypes = $this->BankAccount->BankAccountType->find('list');
			$this->set(compact('suppliers', 'bankAccountTypes', 'supplier_name'));
		}
	}
	
	function ajax_add()
	{
		$this->is_ajax=true;
		$this->add();
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid bank account', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->BankAccount->save($this->data)) {
				$this->Session->setFlash(__('The bank account has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('controller'=>'suppliers','action' => 'view', $this->Session->read('Supplier.id')));
			} else {
				$this->Session->setFlash(__('The bank account could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->BankAccount->read(null, $id);
			$supplier = $this->BankAccount->Supplier->read(null, $this->Session->read('Supplier.id') );
		}
		$supplier_name = $supplier['Supplier']['name'];
		
		$suppliers = $this->BankAccount->Supplier->find('list');
		$bankAccountTypes = $this->BankAccount->BankAccountType->find('list');
		$this->set(compact('suppliers', 'bankAccountTypes', 'supplier_name'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for bank account', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->BankAccount->delete($id)) {
			$this->Session->setFlash(__('Bank account deleted', true), 'default', array('class'=>'ok'));
			$this->redirect(array('controller'=>'suppliers','action' => 'view', $this->Session->read('Supplier.id')));
		}
		$this->Session->setFlash(__('Bank account was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>
