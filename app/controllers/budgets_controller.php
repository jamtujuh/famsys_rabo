<?php
class BudgetsController extends AppController {

	var $name = 'Budgets';

	function index() {
		$this->Budget->recursive = 0;
		$this->set('budgets', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid budget', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('budget', $this->Budget->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Budget->create();
			if ($this->Budget->save($this->data)) {
				$this->Session->setFlash(__('The budget has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The budget could not be saved. Please, try again.', true));
			}
		}
		$departments = $this->Budget->Department->find('list');
		$this->set(compact('departments'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid budget', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Budget->save($this->data)) {
				$this->Session->setFlash(__('The budget has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The budget could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Budget->read(null, $id);
		}
		$departments = $this->Budget->Department->find('list');
		$this->set(compact('departments'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for budget', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Budget->delete($id)) {
			$this->Session->setFlash(__('Budget deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Budget was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>