<?php
class UsageStatusesController extends AppController {

	var $name = 'UsageStatuses';

	function index() {
		$this->UsageStatus->recursive = 0;
		$this->paginate = array('order'=>'UsageStatus.id');
		$this->set('usageStatuses', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid usage status', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('usageStatus', $this->UsageStatus->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->UsageStatus->create();
			if ($this->UsageStatus->save($this->data)) {
				$this->Session->setFlash(__('The usage status has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The usage status could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid usage status', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->UsageStatus->save($this->data)) {
				$this->Session->setFlash(__('The usage status has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The usage status could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->UsageStatus->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for usage status', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->UsageStatus->delete($id)) {
			$this->Session->setFlash(__('Usage status deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Usage status was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>