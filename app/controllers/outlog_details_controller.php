<?php
class OutlogDetailsController extends AppController {

	var $name = 'OutlogDetails';
	var $helpers = array('Ajax', 'Javascript', 'Time');
	var $components = array('RequestHandler');
	
	function getItems() {
		$this->set('options',
			$this->OutlogDetail->Item->find('list',
				array(
					'conditions' => array(
						'Item.asset_category_id' => $this->data['OutlogDetail']['asset_category_id']
					),
					'group' => array('Item.name')
				)
			)
		);
		$this->render('/outlog_details/ajax_dropdown');
	}
	
	function getUnits() {
		$this->set('options',
			$this->OutlogDetail->Item->Unit->find('list',
				array(
					'conditions' => array(
						'Item.unit_id' => $this->data['OutlogDetail']['unit_id']
					),
					'group' => array('Unit.name')
				)
			)
		);
		$this->render('/outlog_details/ajax_dropdown');
	}

	function index() {
		$this->OutlogDetail->recursive = 0;
		$this->set('outlogDetails', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid outlog detail', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('outlogDetail', $this->OutlogDetail->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->OutlogDetail->create();
			if ($this->OutlogDetail->save($this->data)) {
				$this->Session->setFlash(__('The outlog detail has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('controller'=>'outlogs','action' => 'view', $this->Session->read('Outlog.id')));
			} else {
				$this->Session->setFlash(__('The outlog detail could not be saved. Please, try again.', true));
			}
		}
		$outlogs = $this->OutlogDetail->Outlog->read(null, $this->Session->read('Outlog.id') );
		$out_no = $outlogs['Outlog']['no'];
		$assetCategories = $this->OutlogDetail->Item->AssetCategory->find('list', 
			array('conditions' => array('AssetCategory.is_asset' => 0)));
		//$items = $this->OutlogDetail->Item->find('list');
		//$units = $this->OutlogDetail->Item->Unit->find('list');
		//var_dump($assetCategories);
		$this->set(compact('outlogs', 'out_no', 'assetCategories','items' ,'units'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid outlog detail', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->OutlogDetail->save($this->data)) {
				$this->Session->setFlash(__('The outlog detail has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The outlog detail could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->OutlogDetail->read(null, $id);
		}
		$outlogs = $this->OutlogDetail->Outlog->find('list');
		$items = $this->OutlogDetail->Item->find('list');
		$this->set(compact('outlogs', 'items'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for outlog detail', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->OutlogDetail->delete($id)) {
			$this->Session->setFlash(__('Outlog detail deleted', true), 'default', array('class'=>'ok'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Outlog detail was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>