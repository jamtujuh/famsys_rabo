<?php
class FaSupplierReturDetailsController extends AppController {

	var $name = 'FaSupplierReturDetails';

	function index() {
		$this->FaSupplierReturDetail->recursive = 0;
		$this->paginate = array('order'=>'FaSupplierReturDetail.id');
		$this->set('faSupplierReturDetails', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid fa supplier retur detail', true), array('action' => 'index'));
		}
		$this->set('faSupplierReturDetail', $this->FaSupplierReturDetail->read(null, $id));
	}

	function add() {
		$name = array();
		if (!empty($this->data)) 
		{
			if(isset($this->data['FaSupplierReturDetail']['search_keyword']))
			{
				$name = $this->data['FaSupplierReturDetail']['search_keyword'];
			}
			else
			{
				//delete semua record berdasarkan session disposal id
				$this->FaSupplierReturDetail->deleteAll(array('fa_supplier_retur_id' => $this->Session->read('FaSupplierRetur.id')));
				
				if(isset($this->data['FaSupplierReturDetail']['asset_detail_id']))
				{
				
					foreach ($this->data['FaSupplierReturDetail']['asset_detail_id']  as $asset_detail_id)
					{
						$assetDetail = $this->FaSupplierReturDetail->AssetDetail->read(null, $asset_detail_id);
						$data['FaSupplierReturDetail']['fa_supplier_retur_id'] 			= $this->data['FaSupplierReturDetail']['fa_supplier_retur_id'];
						$data['FaSupplierReturDetail']['asset_detail_id'] 		= $asset_detail_id;
						$data['FaSupplierReturDetail']['asset_category_id'] 	= $assetDetail['AssetDetail']['asset_category_id'];
						$data['FaSupplierReturDetail']['date_of_purchase'] 		= $assetDetail['AssetDetail']['date_of_purchase'];
						$data['FaSupplierReturDetail']['code'] 					= $assetDetail['AssetDetail']['code'];
						$data['FaSupplierReturDetail']['name'] 					= $assetDetail['AssetDetail']['name'];
						$data['FaSupplierReturDetail']['item_code'] 			= $assetDetail['AssetDetail']['item_code']?$assetDetail['AssetDetail']['item_code']:'';
						$data['FaSupplierReturDetail']['brand'] 				= $assetDetail['AssetDetail']['brand'];
						$data['FaSupplierReturDetail']['type'] 					= $assetDetail['AssetDetail']['type'];
						$data['FaSupplierReturDetail']['color'] 				= $assetDetail['AssetDetail']['color'];
						$data['FaSupplierReturDetail']['serial_no'] 			= $assetDetail['AssetDetail']['serial_no'];
						$data['FaSupplierReturDetail']['notes'] 				= $this->data['FaSupplierReturDetail']['notes'];
						$this->FaSupplierReturDetail->create();
						$this->FaSupplierReturDetail->save($data);
						//var_dump($data);
						

					}
				}
				
				$this->Session->setFlash(__('The Fa Retur detail has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('controller'=>'fa_supplier_returs','action' => 'view', $this->Session->read('FaSupplierRetur.id')));
			}
		}
		$faSupplierRetur = $this->FaSupplierReturDetail->FaSupplierRetur->read(null, $this->Session->read('FaSupplierRetur.id') );
		$fa_supplier_retur_no = $faSupplierRetur['FaSupplierRetur']['no'];
		$assetDetailSelecteds =$faSupplierRetur['FaSupplierReturDetail'];
		$department_id = $faSupplierRetur['FaSupplierRetur']['department_id'];
		$faSupplierReturs = $this->FaSupplierReturDetail->FaSupplierRetur->find('list');
		$assetDetails = $this->FaSupplierReturDetail->AssetDetail->find('list');
		$assetCategories = $this->FaSupplierReturDetail->AssetCategory->find('list');
		$asset_details = $this->FaSupplierReturDetail->AssetDetail->find('all', 
			array('conditions'=>array('AssetDetail.department_id'=>$department_id, array('AssetDetail.ada'=>'Y',
			'OR'=>array(array('AssetDetail.name LIKE'=>'%'.$name.'%'), array('AssetDetail.code LIKE' => '%'.$name.'%'))))));
		
		$this->set(compact('faSupplierReturs', 'assetDetails', 'assetCategories', 
			'fa_supplier_retur_no', 'faSupplierRetur', 'asset_details', 'assetDetailSelecteds'));

		$this->FaSupplierReturDetail->recursive = 0;
		$this->set('faSupplierReturDetails', $this->paginate());

	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(sprintf(__('Invalid fa supplier retur detail', true)), array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->FaSupplierReturDetail->save($this->data)) {
				$this->flash(__('The fa supplier retur detail has been saved.', true), array('action' => 'index'));
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->FaSupplierReturDetail->read(null, $id);
		}
		$faSupplierReturs = $this->FaSupplierReturDetail->FaSupplierRetur->find('list');
		$assetDetails = $this->FaSupplierReturDetail->AssetDetail->find('list');
		$assetCategories = $this->FaSupplierReturDetail->AssetCategory->find('list');
		$this->set(compact('faSupplierReturs', 'assetDetails', 'assetCategories'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->flash(sprintf(__('Invalid fa supplier retur detail', true)), array('action' => 'index'));
		}
		if ($this->FaSupplierReturDetail->delete($id)) {
			$this->flash(__('Fa retur detail deleted', true), array('action' => 'index'));
		}
		$this->flash(__('Fa retur detail was not deleted', true), array('action' => 'index'));
		$this->redirect(array('action' => 'index'));
	}
}
?>