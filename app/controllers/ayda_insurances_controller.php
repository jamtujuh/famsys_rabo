<?php
class AydaInsurancesController extends AppController {

	var $name = 'AydaInsurances';

	function index() {
		$this->AydaInsurance->recursive = 0;
		$this->paginate = array('order'=>'AydaInsurance.id');
		$this->set('aydaInsurances', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid ayda insurance', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('aydaInsurance', $this->AydaInsurance->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->AydaInsurance->create();
			if ($this->AydaInsurance->save($this->data)) {
				$this->Session->setFlash(__('The ayda insurance has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ayda insurance could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid ayda insurance', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->AydaInsurance->save($this->data)) {
				$this->Session->setFlash(__('The ayda insurance has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ayda insurance could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->AydaInsurance->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for ayda insurance', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->AydaInsurance->delete($id)) {
			$this->Session->setFlash(__('Ayda insurance deleted', true), 'default', array('class'=>'ok'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Ayda insurance was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>