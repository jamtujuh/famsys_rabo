<?php
class SupplierReturDetailsController extends AppController {

	var $name = 'SupplierReturDetails';
	var $helpers = array('Ajax', 'Javascript', 'Time');
	var $components = array('RequestHandler');
	var $is_ajax = false;	
	function getItems() {
		$this->set('options',
			$this->SupplierReturDetail->Item->find('list',
				array(
					'conditions' => array(
						'Item.asset_category_id' => $this->data['SupplierReturDetail']['asset_category_id']
					),
					'group' => array('Item.name')
				)
			)
		);
		$this->render('/supplier_retur_details/ajax_dropdown');
	}
	
	function getUnits() {
		$this->set('options',
			$this->SupplierReturDetail->Item->Unit->find('list',
				array(
					'conditions' => array(
						'Item.unit_id' => $this->data['SupplierReturDetail']['unit_id']
					),
					'group' => array('Unit.name')
				)
			)
		);
		$this->render('/supplier_retur_details/ajax_dropdown');
	}

	function index() {
		$this->SupplierReturDetail->recursive = 0;
		$this->paginate = array('order'=>'SupplierReturDetail.id');
		$this->set('supplier_returDetails', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid supplier_retur detail', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('supplier_returDetail', $this->SupplierReturDetail->read(null, $id));
	}
	function ajax_add()
	{
		$this->is_ajax=true;
		$this->add();
	}
	
	function add() {
		if($this->is_ajax)
			$this->autoRender = false;

		$msg='';
		$supplier_returDetail=null;
		$count=0;
		$status=null;
		
		if (!empty($this->data)) {
			$item_id = $this->data['SupplierReturDetail']['item_id'];
			$item  = $this->SupplierReturDetail->Item->read(null, $item_id);
			$this->data['SupplierReturDetail']['price']  = $item['Item']['avg_price'];
			$this->data['SupplierReturDetail']['amount'] = $this->data['SupplierReturDetail']['qty']*$this->data['SupplierReturDetail']['price']  ;
			$this->data['SupplierReturDetail']['amount_cur'] = $this->data['SupplierReturDetail']['qty']*$this->data['SupplierReturDetail']['price_cur']  ;
				
			$this->SupplierReturDetail->create();
			if ($this->SupplierReturDetail->save($this->data)) {
				if($this->is_ajax)
				{
					$msg=__('The supplier_retur detail has been saved', true);
					$status='ok';
					//$this->SupplierReturDetail->recursive=2;
					$this->SupplierReturDetail->recursive=1;
					$supplier_returDetail=$this->SupplierReturDetail->read(null, $this->SupplierReturDetail->id );
					$count=$this->SupplierReturDetail->find('count', array('conditions'=>array('SupplierReturDetail.supplier_retur_id'=>$this->Session->read('SupplierRetur.id'))));					
				}
				else
				{			
					$this->Session->setFlash(__('The supplier_retur detail has been saved', true), 'default', array('class'=>'ok'));
					$this->redirect(array('controller'=>'supplier_returs','action' => 'view', $this->Session->read('SupplierRetur.id')));
				}
			} else {
				if($this->is_ajax)
				{
					$status='failed';
					$msg=__('The supplier_retur detail could not be saved. Please, try again.', true);
				}
				else
				{			
					$this->Session->setFlash(__('The supplier_retur detail could not be saved. Please, try again.', true));
				}
			}
		}
		
		if($this->is_ajax)
		{
			echo json_encode(array('status'=>$status, 'msg'=>$msg, 'data'=>$supplier_returDetail,'count'=>$count));
		}
		else
		{			
			$supplier_returs = $this->SupplierReturDetail->SupplierRetur->read(null, $this->Session->read('SupplierRetur.id') );
			$out_no = $supplier_returs['SupplierRetur']['no'];
			$assetCategories = $this->SupplierReturDetail->Item->AssetCategory->find('list', 
				array('conditions' => array('AssetCategory.is_asset' => 0)));
			$this->set(compact('supplier_returs', 'out_no', 'assetCategories','items' ,'units'));
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid supplier_retur detail', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->SupplierReturDetail->save($this->data)) {
				$this->Session->setFlash(__('The supplier_retur detail has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The supplier_retur detail could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->SupplierReturDetail->read(null, $id);
		}
		$supplier_returs = $this->SupplierReturDetail->SupplierRetur->find('list');
		$items = $this->SupplierReturDetail->Item->find('list');
		$this->set(compact('supplier_returs', 'items'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for supplier_retur detail', true));
			$this->redirect(array('controller'=>'supplier_returs','action'=>'view', $this->Session->read('SupplierRetur.id')));
		}
		if ($this->SupplierReturDetail->delete($id)) {
			$this->Session->setFlash(__('SupplierRetur detail deleted', true), 'default', array('class'=>'ok'));
			$this->redirect(array('controller'=>'supplier_returs','action'=>'view', $this->Session->read('SupplierRetur.id')));
		}
		$this->Session->setFlash(__('SupplierRetur detail was not deleted', true));
		$this->redirect(array('controller'=>'supplier_returs','action'=>'view', $this->Session->read('SupplierRetur.id')));
	}
}
?>