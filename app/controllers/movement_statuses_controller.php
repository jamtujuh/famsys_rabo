<?php
class MovementStatusesController extends AppController {

	var $name = 'MovementStatuses';

	function index() {
		$this->MovementStatus->recursive = 0;
		$this->paginate = array('order'=>'MovementStatus.id');
		$this->set('movementStatuses', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid movement status', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('movementStatus', $this->MovementStatus->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->MovementStatus->create();
			if ($this->MovementStatus->save($this->data)) {
				$this->Session->setFlash(__('The movement status has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The movement status could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid movement status', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->MovementStatus->save($this->data)) {
				$this->Session->setFlash(__('The movement status has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The movement status could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->MovementStatus->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for movement status', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->MovementStatus->delete($id)) {
			$this->Session->setFlash(__('Movement status deleted', true), 'default', array('class'=>'ok'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Movement status was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>