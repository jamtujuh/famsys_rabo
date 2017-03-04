<?php
class AssetCategoriesController extends AppController {

	var $name = 'AssetCategories';

	function index() {
		$this->AssetCategory->recursive = 0;
		if(!empty($this->data))
		{
			$this->Session->write('AssetCategory.asset_category_type_id', $this->data['AssetCategory']['asset_category_type_id']);
		}
		
		$conditions[]=array('AssetCategory.asset_category_type_id'=>$this->Session->read('AssetCategory.asset_category_type_id'));
		$this->paginate = array('order'=>'AssetCategory.id');
		$this->set('assetCategories', $this->paginate($conditions));
		$this->set('assetCategoryTypes', $this->AssetCategory->AssetCategoryType->find('list'));
		
		$moduleName = 'Master Data > Asset Item Category';
		$this->set('title_for_layout',  $this->lastSegment($moduleName));
		$this->set(compact('moduleName'));
	}

	function view($id = null) {
		$this->AssetCategory->recursive = 0;
		if (!$id) {
			$this->Session->setFlash(__('Invalid asset category', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('assetCategory', $this->AssetCategory->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->AssetCategory->create();
			if ($this->AssetCategory->save($this->data)) {
				$this->Session->setFlash(__('The asset category has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The asset category could not be saved. Please, try again.', true));
			}
		}
		$this->set('assetCategoryTypes', $this->AssetCategory->AssetCategoryType->find('list'));
		$accounts = $this->AssetCategory->Account->find('list');
		$accountDeprAccumulateds = $this->AssetCategory->Account->find('list');
		$accountDeprCosts = $this->AssetCategory->Account->find('list');
		$this->set(compact('accounts','accountDeprAccumulateds','accountDeprCosts'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid asset category', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->AssetCategory->save($this->data)) {
				$this->Session->setFlash(__('The asset category has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The asset category could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->AssetCategory->read(null, $id);
		}
		$this->set('assetCategoryTypes', $this->AssetCategory->AssetCategoryType->find('list'));
		$param=array('order'=>array('Account.name'));
		$accounts = $this->AssetCategory->Account->find('list' , $param);
		$accountDeprAccumulateds = $this->AssetCategory->Account->find('list' , $param);
		$accountDeprCosts = $this->AssetCategory->Account->find('list' , $param);
		$this->set(compact('accounts','accountDeprAccumulateds','accountDeprCosts'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for asset category', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->AssetCategory->delete($id)) {
			$this->Session->setFlash(__('Asset category deleted', true), 'default', array('class'=>'ok'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Asset category was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function get_asset_categories($model) {
		$this->layout='ajax';
		
		$this->set('options',
			$this->AssetCategory->find('list',
				array(
					'order'=>array('AssetCategory.name'),
					'conditions' => array(
						'AssetCategory.asset_category_type_id' => $this->data[$model]['asset_category_type_id']
					)
				)
			)
		);
		$this->render('/inlog_details/ajax_dropdown');
	}
		
}
?>