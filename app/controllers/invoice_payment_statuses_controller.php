<?php
class InvoicePaymentStatusesController extends AppController {

	var $name = 'InvoicePaymentStatuses';

	function index() {
		$this->InvoicePaymentStatus->recursive = 0;
		$this->paginate = array('order'=>'InvoicePaymentStatus.id');
		$this->set('invoicePaymentStatuses', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid invoice payment status', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('invoicePaymentStatus', $this->InvoicePaymentStatus->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->InvoicePaymentStatus->create();
			if ($this->InvoicePaymentStatus->save($this->data)) {
				$this->Session->setFlash(__('The invoice payment status has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The invoice payment status could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid invoice payment status', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->InvoicePaymentStatus->save($this->data)) {
				$this->Session->setFlash(__('The invoice payment status has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The invoice payment status could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->InvoicePaymentStatus->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for invoice payment status', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->InvoicePaymentStatus->delete($id)) {
			$this->Session->setFlash(__('Invoice payment status deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Invoice payment status was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>