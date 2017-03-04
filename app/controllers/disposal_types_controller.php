<?php
class DisposalTypesController extends AppController {

	var $name = 'DisposalTypes';

	function index() {
		$this->DisposalType->recursive = 0;
		$this->paginate = array('order'=>'DisposalType.id');
		$this->set('disposalTypes', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid disposal type', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('disposalType', $this->DisposalType->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->DisposalType->create();
			if ($this->DisposalType->save($this->data)) {
				$this->Session->setFlash(__('The disposal type has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The disposal type could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid disposal type', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->DisposalType->save($this->data)) {
				$this->Session->setFlash(__('The disposal type has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The disposal type could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->DisposalType->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for disposal type', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->DisposalType->delete($id)) {
			$this->Session->setFlash(__('Disposal type deleted', true), 'default', array('class'=>'ok'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Disposal type was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>