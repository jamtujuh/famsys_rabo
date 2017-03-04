<?php
class PurchaseStatusesController extends AppController {

	var $name = 'PurchaseStatuses';

	function index() {
		$this->PurchaseStatus->recursive = 0;
		$this->paginate = array('order'=>'PurchaseStatus.id');
		$this->set('purchaseStatuses', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid purchase status', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('purchaseStatus', $this->PurchaseStatus->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->PurchaseStatus->create();
			if ($this->PurchaseStatus->save($this->data)) {
				$this->Session->setFlash(__('The purchase status has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The purchase status could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid purchase status', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->PurchaseStatus->save($this->data)) {
				$this->Session->setFlash(__('The purchase status has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The purchase status could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->PurchaseStatus->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for purchase status', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->PurchaseStatus->delete($id)) {
			$this->Session->setFlash(__('Purchase status deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Purchase status was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>