<?php
class DisposalStatusesController extends AppController {

	var $name = 'DisposalStatuses';

	function index() {
		$this->DisposalStatus->recursive = 0;
		$this->paginate = array('order'=>'DisposalStatus.id');
		$this->set('disposalStatuses', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid disposal status', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('disposalStatus', $this->DisposalStatus->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->DisposalStatus->create();
			if ($this->DisposalStatus->save($this->data)) {
				$this->Session->setFlash(__('The disposal status has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The disposal status could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid disposal status', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->DisposalStatus->save($this->data)) {
				$this->Session->setFlash(__('The disposal status has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The disposal status could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->DisposalStatus->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for disposal status', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->DisposalStatus->delete($id)) {
			$this->Session->setFlash(__('Disposal status deleted', true), 'default', array('class'=>'ok'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Disposal status was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>