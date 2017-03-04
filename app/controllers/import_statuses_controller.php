<?php
class ImportStatusesController extends AppController {

	var $name = 'ImportStatuses';

	function index() {
		$this->ImportStatus->recursive = 0;
		$this->paginate = array('order'=>'ImportStatus.id');
		$this->set('importStatuses', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid import status', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('importStatus', $this->ImportStatus->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->ImportStatus->create();
			if ($this->ImportStatus->save($this->data)) {
				$this->Session->setFlash(__('The import status has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The import status could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid import status', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->ImportStatus->save($this->data)) {
				$this->Session->setFlash(__('The import status has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The import status could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ImportStatus->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for import status', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ImportStatus->delete($id)) {
			$this->Session->setFlash(__('Import status deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Import status was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>