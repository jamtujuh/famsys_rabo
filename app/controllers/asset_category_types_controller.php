<?php
class AssetCategoryTypesController extends AppController {

	var $name = 'AssetCategoryTypes';
	var $helpers = array('Ajax', 'Javascript', 'Time');
	var $components = array('RequestHandler');

	function index() {
		$this->AssetCategoryType->recursive = 0;
		$this->paginate = array('order'=>'AssetCategoryType.id');
		$this->set('assetCategoryTypes', $this->paginate());
		
		$moduleName = 'Master Data > Category Type';
		$this->set('title_for_layout',  $this->lastSegment($moduleName));
		$this->set(compact('moduleName'));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid asset category type', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('assetCategoryType', $this->AssetCategoryType->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->AssetCategoryType->create();
			if ($this->AssetCategoryType->save($this->data)) {
				$this->Session->setFlash(__('The asset category type has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The asset category type could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid asset category type', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->AssetCategoryType->save($this->data)) {
				$this->Session->setFlash(__('The asset category type has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The asset category type could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->AssetCategoryType->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for asset category type', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->AssetCategoryType->delete($id)) {
			$this->Session->setFlash(__('Asset category type deleted', true), 'default', array('class'=>'ok'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Asset category type was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>