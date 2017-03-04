<?php
class AydaTypesController extends AppController {

	var $name = 'AydaTypes';

	function index() {
		$this->AydaType->recursive = 0;
		$this->paginate = array('order'=>'AydaType.id');
		$this->set('aydaTypes', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid ayda type', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('aydaType', $this->AydaType->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->AydaType->create();
			if ($this->AydaType->save($this->data)) {
				$this->Session->setFlash(__('The ayda type has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ayda type could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid ayda type', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->AydaType->save($this->data)) {
				$this->Session->setFlash(__('The ayda type has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ayda type could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->AydaType->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for ayda type', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->AydaType->delete($id)) {
			$this->Session->setFlash(__('Ayda type deleted', true), 'default', array('class'=>'ok'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Ayda type was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>