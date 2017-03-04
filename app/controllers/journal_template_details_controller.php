<?php
class JournalTemplateDetailsController extends AppController {

	var $name = 'JournalTemplateDetails';
	var $contraAccounts = array(
		''=>'None',
		'accum_dep'=>'Akumulasi Depresiasi',
		'fa'=>'FA Acquisition Cost',
		'rab_kas'=>'RAB Kas',
		'profit'=>'Keuntungan Penjualan FA',
		'loss'=>'Kerugian Penjualan FA',
		'book_value'=>'Book Value',
	);

	function index() {
		$this->JournalTemplateDetail->recursive = 0;
		$this->paginate = array('order'=>'JournalTemplateDetail.id');
		$this->set('journalTemplateDetails', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid journal template detail', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('journalTemplateDetail', $this->JournalTemplateDetail->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->JournalTemplateDetail->create();
			if ($this->JournalTemplateDetail->save($this->data)) {
				$this->Session->setFlash(__('The journal template detail has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('controller'=>'journal_templates','action' => 'view', $this->Session->read('JournalTemplate.id')));
			} else {
				$this->Session->setFlash(__('The journal template detail could not be saved. Please, try again.', true));
			}
		}
		$journalTemplates = $this->JournalTemplateDetail->JournalTemplate->find('list');
		$accounts = $this->JournalTemplateDetail->Account->find('list', array('order'=>'Account.name'));
		$contraAccounts = $this->contraAccounts;
		$journalPositions = $this->JournalTemplateDetail->JournalPosition->find('list');
		$this->set(compact('journalTemplates', 'accounts', 'journalPositions','contraAccounts'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid journal template detail', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->JournalTemplateDetail->save($this->data)) {
				$this->Session->setFlash(__('The journal template detail has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('controller'=>'journal_templates','action' => 'view', $this->Session->read('JournalTemplate.id')));
			} else {
				$this->Session->setFlash(__('The journal template detail could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->JournalTemplateDetail->read(null, $id);
		}
		$journalTemplates = $this->JournalTemplateDetail->JournalTemplate->find('list');
		$accounts = $this->JournalTemplateDetail->Account->find('list', array('order'=>'Account.name'));
		$contraAccounts = $this->contraAccounts;
		$journalPositions = $this->JournalTemplateDetail->JournalPosition->find('list');
		$this->set(compact('journalTemplates', 'accounts', 'journalPositions','contraAccounts'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for journal template detail', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->JournalTemplateDetail->delete($id)) {
			$this->Session->setFlash(__('Journal template detail deleted', true), 'default', array('class'=>'ok'));
			$this->redirect(array('controller'=>'journal_templates','action' => 'view', $this->Session->read('JournalTemplate.id')));
		}
		$this->Session->setFlash(__('Journal template detail was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>