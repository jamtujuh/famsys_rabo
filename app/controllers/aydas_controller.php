<?php
class AydasController extends AppController {

	var $name = 'Aydas';

	function index() {
		$this->Ayda->recursive = 0;
		$this->paginate = array('order'=>'Ayda.id');
		$this->set('aydas', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid ayda', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('ayda', $this->Ayda->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Ayda->create();
			if ($this->Ayda->save($this->data)) {
				$this->Session->setFlash(__('The ayda has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ayda could not be saved. Please, try again.', true));
			}
		}
		$aydaStatuses = $this->Ayda->AydaStatus->find('list');
		$departments = $this->Ayda->Department->find('list');
		$aydaTypes = $this->Ayda->AydaType->find('list');
		$aydaInsurances = $this->Ayda->AydaInsurance->find('list');
		$aydaDocs = $this->Ayda->AydaDoc->find('list');
		$this->set(compact('aydaStatuses', 'departments', 'aydaTypes', 'aydaInsurances', 'aydaDocs'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid ayda', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Ayda->save($this->data)) {
				$this->Session->setFlash(__('The ayda has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The ayda could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Ayda->read(null, $id);
		}
		$aydaStatuses = $this->Ayda->AydaStatus->find('list');
		$departments = $this->Ayda->Department->find('list');
		$aydaTypes = $this->Ayda->AydaType->find('list');
		$aydaInsurances = $this->Ayda->AydaInsurance->find('list');
		$aydaDocs = $this->Ayda->AydaDoc->find('list');
		$this->set(compact('aydaStatuses', 'departments', 'aydaTypes', 'aydaInsurances', 'aydaDocs'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for ayda', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Ayda->delete($id)) {
			$this->Session->setFlash(__('Ayda deleted', true), 'default', array('class'=>'ok'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Ayda was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>