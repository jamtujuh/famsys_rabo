<?php
class AydaStatusesController extends AppController {

	var $name = 'AydaStatuses';

	function index() {
		$this->AydaStatus->recursive = 0;
		$this->paginate = array('order'=>'AydaStatus.id');
		$this->set('aydaStatuses', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid ayda status', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('aydaStatus', $this->AydaStatus->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->AydaStatus->create();
			if ($this->AydaStatus->save($this->data)) {
				$this->Session->setFlash(__('The ayda status has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ayda status could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid ayda status', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->AydaStatus->save($this->data)) {
				$this->Session->setFlash(__('The ayda status has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ayda status could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->AydaStatus->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for ayda status', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->AydaStatus->delete($id)) {
			$this->Session->setFlash(__('Ayda status deleted', true), 'default', array('class'=>'ok'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Ayda status was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>