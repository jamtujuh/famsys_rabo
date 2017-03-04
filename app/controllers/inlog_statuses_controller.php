<?php
class InlogStatusesController extends AppController {

	var $name = 'InlogStatuses';

	function index() {
		$this->InlogStatus->recursive = 0;
		$this->paginate = array('order'=>'InlogStatus.id');
		$this->set('inlogStatuses', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid inlog status', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('inlogStatus', $this->InlogStatus->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->InlogStatus->create();
			if ($this->InlogStatus->save($this->data)) {
				$this->Session->setFlash(__('The inlog status has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The inlog status could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid inlog status', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->InlogStatus->save($this->data)) {
				$this->Session->setFlash(__('The inlog status has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The inlog status could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->InlogStatus->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for inlog status', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->InlogStatus->delete($id)) {
			$this->Session->setFlash(__('Inlog status deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Inlog status was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>