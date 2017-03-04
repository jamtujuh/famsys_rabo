<?php
class OutlogStatusesController extends AppController {

	var $name = 'OutlogStatuses';

	function index() {
		$this->OutlogStatus->recursive = 0;
        $this->paginate = array('order'=>'OutlogStatus.id');
		$this->set('outlogStatuses', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid outlog status', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('outlogStatus', $this->OutlogStatus->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->OutlogStatus->create();
			if ($this->OutlogStatus->save($this->data)) {
				$this->Session->setFlash(__('The outlog status has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The outlog status could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid outlog status', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->OutlogStatus->save($this->data)) {
				$this->Session->setFlash(__('The outlog status has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The outlog status could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->OutlogStatus->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for outlog status', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->OutlogStatus->delete($id)) {
			$this->Session->setFlash(__('Outlog status deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Outlog status was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>