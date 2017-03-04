<?php 
class ReklasStatusesController extends AppController {

	var $name = 'ReklasStatuses';

	function index() {
		$this->ReklasStatus->recursive = 0;
		$this->paginate = array('order'=>'ReklasStatus.id');
		$this->set('reklasStatuses', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid reklas status', true), array('action' => 'index'));
		}
		$this->set('reklasStatus', $this->ReklasStatus->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->ReklasStatus->create();
			if ($this->ReklasStatus->save($this->data)) {
				$this->flash(__('Reklas Status saved.', true), array('action' => 'index'));
			} else {
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(sprintf(__('Invalid reklas status', true)), array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->ReklasStatus->save($this->data)) {
				$this->flash(__('The reklas status has been saved.', true), array('action' => 'index'));
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ReklasStatus->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->flash(sprintf(__('Invalid reklas status', true)), array('action' => 'index'));
		}
		if ($this->ReklasStatus->delete($id)) {
			$this->flash(__('reklas status deleted', true), array('action' => 'index'));
		}
		$this->flash(__('reklas status was not deleted', true), array('action' => 'index'));
		$this->redirect(array('action' => 'index'));
	}
}
?>