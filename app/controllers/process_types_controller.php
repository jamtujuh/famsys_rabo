<?php
class ProcessTypesController extends AppController {

	var $name = 'ProcessTypes';

	function index() {
		$this->ProcessType->recursive = 0;
		$this->paginate = array('order'=>'ProcessType.id');
		$this->set('processTypes', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid process type', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('processType', $this->ProcessType->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->ProcessType->create();
			if ($this->ProcessType->save($this->data)) {
				$this->Session->setFlash(__('The process type has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The process type could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid process type', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->ProcessType->save($this->data)) {
				$this->Session->setFlash(__('The process type has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The process type could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ProcessType->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for process type', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ProcessType->delete($id)) {
			$this->Session->setFlash(__('Process type deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Process type was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>