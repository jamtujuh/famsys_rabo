<?php
class NpbTypesController extends AppController {

	var $name = 'NpbTypes';

	function index() {
		$this->NpbType->recursive = 0;
		$this->paginate = array('order'=>'NpbType.id');
		$this->set('npbTypes', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid npb type', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('npbType', $this->NpbType->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->NpbType->create();
			if ($this->NpbType->save($this->data)) {
				$this->Session->setFlash(__('The npb type has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The npb type could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid npb type', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->NpbType->save($this->data)) {
				$this->Session->setFlash(__('The npb type has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The npb type could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->NpbType->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for npb type', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->NpbType->delete($id)) {
			$this->Session->setFlash(__('Npb type deleted', true), 'default', array('class'=>'ok'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Npb type was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>