<?php
class PoStatusesController extends AppController {

	var $name = 'PoStatuses';

	function index() {
		$this->PoStatus->recursive = 0;
		$this->paginate = array('order'=>'PoStatus.id');
		$this->set('poStatuses', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid po status', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('poStatus', $this->PoStatus->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->PoStatus->create();
			if ($this->PoStatus->save($this->data)) {
				$this->Session->setFlash(__('The po status has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The po status could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid po status', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->PoStatus->save($this->data)) {
				$this->Session->setFlash(__('The po status has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The po status could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->PoStatus->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for po status', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->PoStatus->delete($id)) {
			$this->Session->setFlash(__('Po status deleted', true), 'default', array('class'=>'ok'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Po status was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>