<?php
class BankAccountTypesController extends AppController {

	var $name = 'BankAccountTypes';

	function index() {
		$this->BankAccountType->recursive = 0;
		$this->paginate = array('order'=>'BankAccountType.id');
		$this->set('bankAccountTypes', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid bank account type', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('bankAccountType', $this->BankAccountType->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->BankAccountType->create();
			if ($this->BankAccountType->save($this->data)) {
				$this->Session->setFlash(__('The bank account type has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The bank account type could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid bank account type', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->BankAccountType->save($this->data)) {
				$this->Session->setFlash(__('The bank account type has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The bank account type could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->BankAccountType->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for bank account type', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->BankAccountType->delete($id)) {
			$this->Session->setFlash(__('Bank account type deleted', true), 'default', array('class'=>'ok'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Bank account type was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>