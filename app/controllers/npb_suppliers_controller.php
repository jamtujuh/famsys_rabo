<?php
class NpbSuppliersController extends AppController {

	var $name = 'NpbSuppliers';
	var $helpers = array('Ajax', 'Javascript', 'Number');
	var $components = array('RequestHandler');

	function index() {
		$this->NpbSupplier->recursive = 0;
		$this->paginate = array('order'=>'NpbSupplier.id');
		$this->set('npbSuppliers', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid npb supplier', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('npbSupplier', $this->NpbSupplier->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->NpbSupplier->create();
			if ($this->NpbSupplier->save($this->data)) {
				$this->Session->setFlash(__('The npb supplier has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('controller'=>'npbs','action' => 'view', $this->Session->read('Npb.id')));
			} else {
				$this->Session->setFlash(__('The npb supplier could not be saved. Please, try again.', true));
			}
		}
		$npb = $this->NpbSupplier->Npb->read(null, $this->Session->read('Npb.id'));
		$suppliers = $this->NpbSupplier->Supplier->find('list');
		$this->set(compact('npb', 'suppliers'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid npb supplier', true));
			$this->redirect(array('controller'=>'npbs','action' => 'view', $this->Session->read('Npb.id')));
		}
		if (!empty($this->data)) {
			if ($this->NpbSupplier->save($this->data)) {
				$this->Session->setFlash(__('The npb supplier has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('controller'=>'npbs','action' => 'view', $this->Session->read('Npb.id')));
			} else {
				$this->Session->setFlash(__('The npb supplier could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->NpbSupplier->read(null, $id);
		}
		$npb = $this->NpbSupplier->Npb->read(null, $this->Session->read('Npb.id'));
		$suppliers = $this->NpbSupplier->Supplier->find('list');
		$this->set(compact('npb', 'suppliers'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for npb supplier', true));
			$this->redirect(array('controller'=>'npbs','action' => 'view', $this->Session->read('Npb.id')));
		}
		if ($this->NpbSupplier->delete($id)) {
			$this->Session->setFlash(__('Npb supplier deleted', true), 'default', array('class'=>'ok'));
			$this->redirect(array('controller'=>'npbs','action' => 'view', $this->Session->read('Npb.id')));
		}
		$this->Session->setFlash(__('Npb supplier was not deleted', true));
		$this->redirect(array('controller'=>'npbs','action' => 'view', $this->Session->read('Npb.id')));

	}
}
?>