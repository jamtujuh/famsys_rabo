<?php
class JournalPositionsController extends AppController {

	var $name = 'JournalPositions';

	function index() {
		$this->JournalPosition->recursive = 0;
		$this->paginate = array('order'=>'JournalPosition.id');
		$this->set('journalPositions', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid journal position', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('journalPosition', $this->JournalPosition->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->JournalPosition->create();
			if ($this->JournalPosition->save($this->data)) {
				$this->Session->setFlash(__('The journal position has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The journal position could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid journal position', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->JournalPosition->save($this->data)) {
				$this->Session->setFlash(__('The journal position has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The journal position could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->JournalPosition->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for journal position', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->JournalPosition->delete($id)) {
			$this->Session->setFlash(__('Journal position deleted', true), 'default', array('class'=>'ok'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Journal position was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>