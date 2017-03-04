<?php
class AydaDocsController extends AppController {

	var $name = 'AydaDocs';

	function index() {
		$this->AydaDoc->recursive = 0;
		$this->paginate = array('order'=>'AydaDoc.id');
		$this->set('aydaDocs', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid ayda doc', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('aydaDoc', $this->AydaDoc->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->AydaDoc->create();
			if ($this->AydaDoc->save($this->data)) {
				$this->Session->setFlash(__('The ayda doc has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ayda doc could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid ayda doc', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->AydaDoc->save($this->data)) {
				$this->Session->setFlash(__('The ayda doc has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ayda doc could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->AydaDoc->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for ayda doc', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->AydaDoc->delete($id)) {
			$this->Session->setFlash(__('Ayda doc deleted', true), 'default', array('class'=>'ok'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Ayda doc was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>