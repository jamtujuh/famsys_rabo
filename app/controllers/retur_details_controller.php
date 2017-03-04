<?php
class ReturDetailsController extends AppController {

	var $name = 'ReturDetails';
	var $helpers = array('Ajax', 'Javascript', 'Time');
	var $components = array('RequestHandler');
	var $is_ajax = false;	
	function getItems() {
		$this->set('options',
			$this->ReturDetail->Item->find('list',
				array(
					'conditions' => array(
						'Item.asset_category_id' => $this->data['ReturDetail']['asset_category_id']
					),
					'group' => array('Item.name')
				)
			)
		);
		$this->render('/retur_details/ajax_dropdown');
	}
	
	function getUnits() {
		$this->set('options',
			$this->ReturDetail->Item->Unit->find('list',
				array(
					'conditions' => array(
						'Item.unit_id' => $this->data['ReturDetail']['unit_id']
					),
					'group' => array('Unit.name')
				)
			)
		);
		$this->render('/retur_details/ajax_dropdown');
	}

	function index() {
		$this->ReturDetail->recursive = 0;
		$this->paginate = array('order'=>'ReturDetail.id');
		$this->set('returDetails', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid retur detail', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('returDetail', $this->ReturDetail->read(null, $id));
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
		$returDetail=null;
		$count=0;
		$status=null;
		
		if (!empty($this->data)) {
			$item_id = $this->data['ReturDetail']['item_id'];
			$item  = $this->ReturDetail->Item->read(null, $item_id);
			$this->data['ReturDetail']['price']  = $item['Item']['avg_price'];
		
			$this->data['ReturDetail']['amount'] = $this->data['ReturDetail']['qty']*$this->data['ReturDetail']['price']  ;
			$this->data['ReturDetail']['amount_cur'] = $this->data['ReturDetail']['qty']*$this->data['ReturDetail']['price_cur']  ;
				
			$this->ReturDetail->create();
			if ($this->ReturDetail->save($this->data)) {
				if($this->is_ajax)
				{
					$msg=__('The retur detail has been saved', true);
					$status='ok';
					$this->ReturDetail->recursive=2;
					$returDetail=$this->ReturDetail->read(null, $this->ReturDetail->id );
					$count=$this->ReturDetail->find('count', array('conditions'=>array('ReturDetail.retur_id'=>$this->Session->read('Retur.id'))));					
				}
				else
				{			
					$this->Session->setFlash(__('The retur detail has been saved', true), 'default', array('class'=>'ok'));
					$this->redirect(array('controller'=>'returs','action' => 'view', $this->Session->read('Retur.id')));
				}
			} else {
				if($this->is_ajax)
				{
					$status='failed';
					$msg=__('The retur detail could not be saved. Please, try again.', true);
				}
				else
				{			
					$this->Session->setFlash(__('The retur detail could not be saved. Please, try again.', true));
				}
			}
		}
		
		if($this->is_ajax)
		{
			echo json_encode(array('status'=>$status, 'msg'=>$msg, 'data'=>$returDetail,'count'=>$count));
		}
		else
		{			
			$returs = $this->ReturDetail->Retur->read(null, $this->Session->read('Retur.id') );
			$out_no = $returs['Retur']['no'];
			$assetCategories = $this->ReturDetail->Item->AssetCategory->find('list', 
				array('conditions' => array('AssetCategory.is_asset' => 0)));
			$this->set(compact('returs', 'out_no', 'assetCategories','items' ,'units'));
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid retur detail', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->ReturDetail->save($this->data)) {
				$this->Session->setFlash(__('The retur detail has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The retur detail could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ReturDetail->read(null, $id);
		}
		$returs = $this->ReturDetail->Retur->find('list');
		$items = $this->ReturDetail->Item->find('list');
		$this->set(compact('returs', 'items'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for retur detail', true));
			$this->redirect(array('controller'=>'returs','action'=>'view', $this->Session->read('Retur.id')));
		}
		if ($this->ReturDetail->delete($id)) {
			$this->Session->setFlash(__('Retur detail deleted', true), 'default', array('class'=>'ok'));
			$this->redirect(array('controller'=>'returs','action'=>'view', $this->Session->read('Retur.id')));
		}
		$this->Session->setFlash(__('Retur detail was not deleted', true));
		$this->redirect(array('controller'=>'returs','action'=>'view', $this->Session->read('Retur.id')));
	}
}
?>