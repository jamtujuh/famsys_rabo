<?php
class NpbStatusesController extends AppController {

	var $name = 'NpbStatuses';

	var $helpers = array('Ajax', 'Javascript', 'Number');
	var $components = array('RequestHandler');


	function index() {
		$this->NpbStatus->recursive = 0;
		$this->paginate = array('order'=>'NpbStatus.id');
		$this->set('npbStatuses', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid npb status', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('npbStatus', $this->NpbStatus->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->NpbStatus->create();
			if ($this->NpbStatus->save($this->data)) {
				$this->Session->setFlash(__('The npb status has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The npb status could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid npb status', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->NpbStatus->save($this->data)) {
				$this->Session->setFlash(__('The npb status has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The npb status could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->NpbStatus->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for npb status', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->NpbStatus->delete($id)) {
			$this->Session->setFlash(__('Npb status deleted', true), 'default', array('class'=>'ok'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Npb status was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>