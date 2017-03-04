<?php
class FaReturStatusesController extends AppController {

	var $name = 'FaReturStatuses';

	function index() {
		$this->FaReturStatus->recursive = 0;
		$this->paginate = array('order'=>'FaReturStatus.id');
		$this->set('faReturStatuses', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid fa retur status', true), array('action' => 'index'));
		}
		$this->set('faReturStatus', $this->FaReturStatus->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->FaReturStatus->create();
			if ($this->FaReturStatus->save($this->data)) {
				$this->flash(__('Fareturstatus saved.', true), array('action' => 'index'));
			} else {
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(sprintf(__('Invalid fa retur status', true)), array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->FaReturStatus->save($this->data)) {
				$this->flash(__('The fa retur status has been saved.', true), array('action' => 'index'));
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->FaReturStatus->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->flash(sprintf(__('Invalid fa retur status', true)), array('action' => 'index'));
		}
		if ($this->FaReturStatus->delete($id)) {
			$this->flash(__('Fa retur status deleted', true), array('action' => 'index'));
		}
		$this->flash(__('Fa retur status was not deleted', true), array('action' => 'index'));
		$this->redirect(array('action' => 'index'));
	}
}
?>