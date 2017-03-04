<?php
class FaSupplierReturStatusesController extends AppController {

	var $name = 'FaSupplierReturStatuses';

	function index() {
		$this->FaSupplierReturStatus->recursive = 0;
		$this->paginate = array('order'=>'faSupplierReturStatus.id');
		$this->set('FaSupplierReturStatuses', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid fa supplier retur status', true), array('action' => 'index'));
		}
		$this->set('FaSupplierReturStatus', $this->FaSupplierReturStatus->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->FaSupplierReturStatus->create();
			if ($this->FaSupplierReturStatus->save($this->data)) {
				$this->flash(__('FaSupplierReturStatus saved.', true), array('action' => 'index'));
			} else {
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(sprintf(__('Invalid fa supplier retur status', true)), array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->FaSupplierReturStatus->save($this->data)) {
				$this->flash(__('The fa supplier retur status has been saved.', true), array('action' => 'index'));
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->FaSupplierReturStatus->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->flash(sprintf(__('Invalid fa supplier retur status', true)), array('action' => 'index'));
		}
		if ($this->FaSupplierReturStatus->delete($id)) {
			$this->flash(__('Fa Supplier Retur status deleted', true), array('action' => 'index'));
		}
		$this->flash(__('Fa Supplier Retur status was not deleted', true), array('action' => 'index'));
		$this->redirect(array('action' => 'index'));
	}
}
?>