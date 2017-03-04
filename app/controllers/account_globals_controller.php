<?php
class AccountGlobalsController extends AppController {

	var $name = 'AccountGlobals';

	function index() {
		$this->AccountGlobal->recursive = 0;
		$this->paginate = array('order'=>'AccountGlobal.id');
		$this->set('accountGlobals', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid account global', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('accountGlobal', $this->AccountGlobal->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->AccountGlobal->create(); 
			if ($this->AccountGlobal->save($this->data)) { 
				$this->Session->setFlash(__('The account global has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The account global could not be saved. Please, try again.', true));
			}
		}
		$parentAccountGlobals = $this->AccountGlobal->ParentAccountGlobal->find('list');
		$this->set(compact('parentAccountGlobals'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid account global', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->AccountGlobal->save($this->data)) {
				$this->Session->setFlash(__('The account global has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The account global could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->AccountGlobal->read(null, $id);
		}
		$parentAccountGlobals = $this->AccountGlobal->ParentAccountGlobal->find('list');
		$this->set(compact('parentAccountGlobals'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for account global', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->AccountGlobal->delete($id)) {
			$this->Session->setFlash(__('Account global deleted', true), 'default', array('class'=>'ok'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Account global was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>