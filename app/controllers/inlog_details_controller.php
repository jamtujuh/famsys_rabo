<?php
class InlogDetailsController extends AppController {

	var $name = 'InlogDetails';
	var $helpers = array('Ajax', 'Javascript', 'Time');
	var $components = array('RequestHandler');
	
	function getItems() {
		$this->set('options',
			$this->InlogDetail->Item->find('list',
				array(
					'conditions' => array(
						'Item.asset_category_id' => $this->data['InlogDetail']['asset_category_id']
					),
					'group' => array('Item.name')
				)
			)
		);
		$this->render('/inlog_details/ajax_dropdown');
	}
	
	function getUnits() {
		$this->set('options',
			$this->InlogDetail->Item->Unit->find('list',
				array(
					'conditions' => array(
						'Item.unit_id' => $this->data['InlogDetail']['unit_id']
					),
					'group' => array('Unit.name')
				)
			)
		);
		$this->render('/inlog_details/ajax_dropdown');
	}

	function index() {
		$this->InlogDetail->recursive = 0;
		$this->paginate = array('order'=>'InlogDetail.id');
		$this->set('inlogDetails', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid inlog detail', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('inlogDetail', $this->InlogDetail->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->InlogDetail->create();
			if ($this->InlogDetail->save($this->data)) {
				$this->Session->setFlash(__('The inlog detail has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('controller'=>'inlogs','action' => 'view', $this->Session->read('Inlog.id')));
			} else {
				$this->Session->setFlash(__('The inlog detail could not be saved. Please, try again.', true));
			}
		}
		$inlogs = $this->InlogDetail->Inlog->read(null, $this->Session->read('Inlog.id') );
		$in_no = $inlogs['Inlog']['no'];
		$assetCategories = $this->InlogDetail->Item->AssetCategory->find('list',
			array('conditions' => array('AssetCategory.is_asset' => 0)));
		//$items = $this->InlogDetail->Item->find('list');
		//$units = $this->InlogDetail->Item->Unit->find('list');
		//var_dump($assetCategories);
		$this->set(compact('inlogs', 'in_no', 'assetCategories', 'items', 'units'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid inlog detail', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->InlogDetail->save($this->data)) {
				$this->Session->setFlash(__('The inlog detail has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The inlog detail could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->InlogDetail->read(null, $id);
		}
		$inlogs = $this->InlogDetail->Inlog->find('list');
		$items = $this->InlogDetail->Item->find('list');
		$this->set(compact('inlogs', 'items'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for inlog detail', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->InlogDetail->delete($id)) {
			$this->Session->setFlash(__('Inlog detail deleted', true), 'default', array('class'=>'ok'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Inlog detail was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>