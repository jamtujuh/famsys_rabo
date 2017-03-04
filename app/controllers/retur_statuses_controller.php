<?php
class ReturStatusesController extends AppController {

	var $name = 'ReturStatuses';

	function index() {
		$this->ReturStatus->recursive = 0;
		$this->paginate = array('order'=>'ReturStatus.id');
		$this->set('returStatuses', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid retur status', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('returStatus', $this->ReturStatus->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->ReturStatus->create();
			if ($this->ReturStatus->save($this->data)) {
				$this->Session->setFlash(__('The retur status has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The retur status could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid retur status', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->ReturStatus->save($this->data)) {
				$this->Session->setFlash(__('The retur status has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The retur status could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ReturStatus->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for retur status', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ReturStatus->delete($id)) {
			$this->Session->setFlash(__('Retur status deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Retur status was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>