<?php
class RequestTypesController extends AppController {

	var $name = 'RequestTypes';

	function index() {
		$this->RequestType->recursive = 0;
		$this->paginate = array('order'=>'RequestType.id');
		$this->set('requestTypes', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid request type', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('requestType', $this->RequestType->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->RequestType->create();
			if ($this->RequestType->save($this->data)) {
				$this->Session->setFlash(__('The request type has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The request type could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid request type', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->RequestType->save($this->data)) {
				$this->Session->setFlash(__('The request type has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The request type could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->RequestType->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for request type', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->RequestType->delete($id)) {
			$this->Session->setFlash(__('Request type deleted', true), 'default', array('class'=>'ok'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Request type was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>