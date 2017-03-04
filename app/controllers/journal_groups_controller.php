<?php
class JournalGroupsController extends AppController {

	var $name = 'JournalGroups';

	function index() {
		$this->JournalGroup->recursive = 0;
		//$this->paginate = array('order'=>'JournalGroups.id');
		$this->set('journalGroups', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid journal group', true));
			$this->redirect(array('action' => 'index'));
		}
		$assetCategories=$this->JournalGroup->JournalTemplate->AssetCategory->find('list');
		$this->set('journalGroup', $this->JournalGroup->read(null, $id));
		$this->set(compact('assetCategories'));
	}

	function add() {
		if (!empty($this->data)) {
			$this->JournalGroup->create();
			if ($this->JournalGroup->save($this->data)) {
				$this->Session->setFlash(__('The journal group has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The journal group could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid journal group', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->JournalGroup->save($this->data)) {
				$this->Session->setFlash(__('The journal group has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The journal group could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->JournalGroup->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for journal group', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->JournalGroup->delete($id)) {
			$this->Session->setFlash(__('Journal group deleted', true), 'default', array('class'=>'ok'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Journal group was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>