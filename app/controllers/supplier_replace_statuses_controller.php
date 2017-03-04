<?php
class SupplierReplaceStatusesController extends AppController {

	var $name = 'SupplierReplaceStatuses';

	function index() {
		$this->SupplierReplaceStatus->recursive = 0;
		$this->set('supplierReplaceStatuses', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid supplier replace status', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('supplierReplaceStatus', $this->SupplierReplaceStatus->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->SupplierReplaceStatus->create();
			if ($this->SupplierReplaceStatus->save($this->data)) {
				$this->Session->setFlash(__('The supplier replace status has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The supplier replace status could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid supplier replace status', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->SupplierReplaceStatus->save($this->data)) {
				$this->Session->setFlash(__('The supplier replace status has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The supplier replace status could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->SupplierReplaceStatus->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for supplier replace status', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->SupplierReplaceStatus->delete($id)) {
			$this->Session->setFlash(__('Supplier retur status deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Supplier retur status was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>