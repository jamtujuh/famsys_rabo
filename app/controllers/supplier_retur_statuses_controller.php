<?php
class SupplierReturStatusesController extends AppController {

	var $name = 'SupplierReturStatuses';

	function index() {
		$this->SupplierReturStatus->recursive = 0;
		$this->paginate = array('order'=>'SupplierReturStatus.id');
		$this->set('supplierReturStatuses', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid supplier retur status', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('supplierReturStatus', $this->SupplierReturStatus->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->SupplierReturStatus->create();
			if ($this->SupplierReturStatus->save($this->data)) {
				$this->Session->setFlash(__('The supplier retur status has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The supplier retur status could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid supplier retur status', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->SupplierReturStatus->save($this->data)) {
				$this->Session->setFlash(__('The supplier retur status has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The supplier retur status could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->SupplierReturStatus->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for supplier retur status', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->SupplierReturStatus->delete($id)) {
			$this->Session->setFlash(__('Supplier retur status deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Supplier retur status was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>