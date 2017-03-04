<?php
class ImportAssetDetailsController extends AppController {

	var $name = 'ImportAssetDetails';

    var $paginate = array(
        'limit' => 25,
        'order' => array(
            'ImportAssetDetail.id' => 'asc'
        )
    );


	function index($fa_import_id=null) 
	{
		$fa_import = $this->ImportAssetDetail->FaImport->read(null, $fa_import_id);
		$con[] = array('fa_import_id'=>$fa_import_id);
		$this->set('fa_import', $fa_import);
		$this->ImportAssetDetail->recursive = 0;
		$this->paginate = array('order'=>'ImportAssetDetail.id');
		$this->set('importAssetDetails', $this->paginate($con));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid import asset detail', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('importAssetDetail', $this->ImportAssetDetail->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->ImportAssetDetail->create();
			if ($this->ImportAssetDetail->save($this->data)) {
				$this->Session->setFlash(__('The import asset detail has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The import asset detail could not be saved. Please, try again.', true));
			}
		}
		$faImports = $this->ImportAssetDetail->FaImport->find('list');
		$conditions = $this->ImportAssetDetail->Condition->find('list');
		$assetCategories = $this->ImportAssetDetail->AssetCategory->find('list');
		$locations = $this->ImportAssetDetail->Location->find('list');
		$departments = $this->ImportAssetDetail->Department->find('list');
		$departmentSubs = $this->ImportAssetDetail->DepartmentSub->find('list');
		$departmentUnits = $this->ImportAssetDetail->DepartmentUnit->find('list');
		$businessTypes = $this->ImportAssetDetail->BusinessType->find('list');
		$costCenters = $this->ImportAssetDetail->CostCenter->find('list');
		$warranties = $this->ImportAssetDetail->Warranty->find('list');
		$this->set(compact('faImports', 'conditions', 'assetCategories', 'locations', 'departments', 'departmentSubs', 'departmentUnits', 'businessTypes', 'costCenters', 'warranties'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid import asset detail', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->ImportAssetDetail->save($this->data)) {
				$this->Session->setFlash(__('The import asset detail has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The import asset detail could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ImportAssetDetail->read(null, $id);
		}
		$faImports = $this->ImportAssetDetail->FaImport->find('list');
		$conditions = $this->ImportAssetDetail->Condition->find('list');
		$assetCategories = $this->ImportAssetDetail->AssetCategory->find('list');
		$locations = $this->ImportAssetDetail->Location->find('list');
		$departments = $this->ImportAssetDetail->Department->find('list');
		$departmentSubs = $this->ImportAssetDetail->DepartmentSub->find('list');
		$departmentUnits = $this->ImportAssetDetail->DepartmentUnit->find('list');
		$businessTypes = $this->ImportAssetDetail->BusinessType->find('list');
		$costCenters = $this->ImportAssetDetail->CostCenter->find('list');
		$warranties = $this->ImportAssetDetail->Warranty->find('list');
		$this->set(compact('faImports', 'conditions', 'assetCategories', 'locations', 'departments', 'departmentSubs', 'departmentUnits', 'businessTypes', 'costCenters', 'warranties'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for import asset detail', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ImportAssetDetail->delete($id)) {
			$this->Session->setFlash(__('Import asset detail deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Import asset detail was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>