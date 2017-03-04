<?php
class SupplierReplaceDetailsController extends AppController {

	var $name = 'SupplierReplaceDetails';
	var $helpers = array('Ajax', 'Javascript', 'Time');
	var $components = array('RequestHandler');
	var $is_ajax = false;	
	function getItems() {
		$this->set('options',
			$this->SupplierReplaceDetail->Item->find('list',
				array(
					'conditions' => array(
						'Item.asset_category_id' => $this->data['SupplierReplaceDetail']['asset_category_id']
					),
					'group' => array('Item.name')
				)
			)
		);
		$this->render('/supplier_replace_details/ajax_dropdown');
	}
	
	function getUnits() {
		$this->set('options',
			$this->SupplierReplaceDetail->Item->Unit->find('list',
				array(
					'conditions' => array(
						'Item.unit_id' => $this->data['SupplierReplaceDetail']['unit_id']
					),
					'group' => array('Unit.name')
				)
			)
		);
		$this->render('/supplier_replace_details/ajax_dropdown');
	}

	function index() {
		$this->SupplierReplaceDetail->recursive = 0;
		$this->set('supplierReplaceDetails', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid supplier replace detail', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('supplierReplaceDetail', $this->SupplierReplaceDetail->read(null, $id));
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
		$supplierReplaceDetail=null;
		$count=0;
		$status=null;
		
		if (!empty($this->data)) {
			$item_id = $this->data['SupplierReplaceDetail']['item_id'];
			$item  = $this->SupplierReplaceDetail->Item->read(null, $item_id);
			$this->data['SupplierReplaceDetail']['price']  = $item['Item']['avg_price'];
			$this->data['SupplierReplaceDetail']['amount'] = $this->data['SupplierReplaceDetail']['qty']*$this->data['SupplierReplaceDetail']['price']  ;
			$this->data['SupplierReplaceDetail']['amount_cur'] = $this->data['SupplierReplaceDetail']['qty']*$this->data['SupplierReplaceDetail']['price_cur']  ;
				
			$this->SupplierReplaceDetail->create();
			if ($this->SupplierReplaceDetail->save($this->data)) {
				if($this->is_ajax)
				{
					$msg=__('The supplier replace detail has been saved', true);
					$status='ok';
					//$this->SupplierReplaceDetail->recursive=2;
					$this->SupplierReplaceDetail->recursive=1;
					$supplierReplaceDetail=$this->SupplierReplaceDetail->read(null, $this->SupplierReplaceDetail->id );
					$count=$this->SupplierReplaceDetail->find('count', array('conditions'=>array('SupplierReplaceDetail.supplier_replace_id'=>$this->Session->read('SupplierReplace.id'))));					
				}
				else
				{			
					$this->Session->setFlash(__('The supplier replace detail has been saved', true), 'default', array('class'=>'ok'));
					$this->redirect(array('controller'=>'supplier_replaces','action' => 'view', $this->Session->read('SupplierReplace.id')));
				}
			} else {
				if($this->is_ajax)
				{
					$status='failed';
					$msg=__('The supplier replace detail could not be saved. Please, try again.', true);
				}
				else
				{			
					$this->Session->setFlash(__('The supplier replace detail could not be saved. Please, try again.', true));
				}
			}
		}
		
		if($this->is_ajax)
		{
			echo json_encode(array('status'=>$status, 'msg'=>$msg, 'data'=>$supplierReplaceDetail,'count'=>$count));
		}
		else
		{			
			$supplier_replaces = $this->SupplierReplaceDetail->SupplierReplace->read(null, $this->Session->read('SupplierReplace.id') );
			$out_no = $supplier_replaces['SupplierReplace']['no'];
			$assetCategories = $this->SupplierReplaceDetail->Item->AssetCategory->find('list', 
				array('conditions' => array('AssetCategory.is_asset' => 0)));
			$this->set(compact('supplier_replaces', 'out_no', 'assetCategories','items' ,'units'));
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid supplier replace detail', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->SupplierReplaceDetail->save($this->data)) {
				$this->Session->setFlash(__('The supplier replace detail has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The supplier replace detail could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->SupplierReplaceDetail->read(null, $id);
		}
		$supplier_replaces = $this->SupplierReplaceDetail->SupplierReplace->find('list');
		$items = $this->SupplierReplaceDetail->Item->find('list');
		$this->set(compact('supplier_replaces', 'items'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for supplier replace detail', true));
			$this->redirect(array('controller'=>'supplier_replaces','action'=>'view', $this->Session->read('SupplierReplace.id')));
		}
		if ($this->SupplierReplaceDetail->delete($id)) {
			$this->Session->setFlash(__('SupplierReplace detail deleted', true), 'default', array('class'=>'ok'));
			$this->redirect(array('controller'=>'supplier_replaces','action'=>'view', $this->Session->read('SupplierReplace.id')));
		}
		$this->Session->setFlash(__('SupplierReplace detail was not deleted', true));
		$this->redirect(array('controller'=>'supplier_replaces','action'=>'view', $this->Session->read('SupplierReplace.id')));
	}
}
?>