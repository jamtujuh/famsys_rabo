<?php
class NpbFulfillmentsController extends AppController {

	var $name = 'NpbFulfillments';

	function index() {
		$this->NpbFulfillment->recursive = 0;
		$this->paginate = array('order'=>'NpbFulfillment.id');
		$this->set('npbFulfillments', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid npb fulfillment', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('npbFulfillment', $this->NpbFulfillment->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->NpbFulfillment->create();
			if ($this->NpbFulfillment->save($this->data)) {
				$this->Session->setFlash(__('The npb fulfillment has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The npb fulfillment could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid npb fulfillment', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->NpbFulfillment->save($this->data)) {
				$this->Session->setFlash(__('The npb fulfillment has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The npb fulfillment could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->NpbFulfillment->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for npb fulfillment', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->NpbFulfillment->delete($id)) {
			$this->Session->setFlash(__('Npb fulfillment deleted', true), 'default', array('class'=>'ok'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Npb fulfillment was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>