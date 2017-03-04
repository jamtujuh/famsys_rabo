<?php
class CurrencyDetailsController extends AppController {

	var $name = 'CurrencyDetails';
	var $helpers = array('Number');

	function index() {
		$this->CurrencyDetail->recursive = 0;
		$this->paginate = array('order'=>'CurrencyDetail.id');
		$this->set('currencyDetails', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid currency detail', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('currencyDetail', $this->CurrencyDetail->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->CurrencyDetail->create();
			if ($this->CurrencyDetail->save($this->data)) {
				$this->Session->setFlash(__('The currency detail has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('controller'=>'currencies','action' => 'view', $this->Session->read('Currency.id')));
			} else {
				$this->Session->setFlash(__('The currency detail could not be saved. Please, try again.', true));
			}
		}
		$currencies = $this->CurrencyDetail->Currency->find('list');
		$this->set(compact('currencies'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid currency detail', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->CurrencyDetail->save($this->data)) {
				$this->Session->setFlash(__('The currency detail has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('controller'=>'currencies','action' => 'view', $this->Session->read('Currency.id')));
			} else {
				$this->Session->setFlash(__('The currency detail could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->CurrencyDetail->read(null, $id);
		}
		$currencies = $this->CurrencyDetail->Currency->find('list');
		$this->set(compact('currencies'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for currency detail', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->CurrencyDetail->delete($id)) {
			$this->Session->setFlash(__('Currency detail deleted', true), 'default', array('class'=>'ok'));
			$this->redirect(array('controller'=>'currencies','action' => 'view', $this->Session->read('Currency.id')));
		}
		$this->Session->setFlash(__('Currency detail was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>