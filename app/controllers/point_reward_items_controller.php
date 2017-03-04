<?php

class PointRewardItemsController extends AppController {

	var $name = 'PointRewardItems';
	//var $uses = array('PointRewardItem');
    var $components = array('RequestHandler');

    function index() {
		$this->PointRewardItem->recursive = 0;
		
		$conditions[]=array('PointRewardItem.item_id not '=>null);
		
		$this->paginate = array('order'=>'PointRewardItem.id');
		
		$con = $this->paginate($conditions);		
		
		$this->set('PointRewardItems', $con);

		$copyright_id = $this->configs['copyright_id'];
		$moduleName = 'Reports > List Point Reward Items';

		$this->set(compact('copyright_id'));		
	}
	
	function add() {
		if (!empty($this->data)) {
			$this->data['PointRewardItem']['item_prefix'] = strtoupper($this->data['PointRewardItem']['item_prefix']);
			$this->PointRewardItem->create();
			if(empty($this->data['PointRewardItem']['item_prefix']) || empty($this->data['PointRewardItem']['item_id'])){
				$this->Session->setFlash(__('The Point Reward Item could not be saved. Please, check the data.', true));
				$this->redirect(array('action' => 'add'));
			}
			
			if ($this->PointRewardItem->save($this->data)) {
				$this->Session->setFlash(__('The Point Reward Item has been saved', true), 'default', array('class' => 'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Point Reward Item could not be saved. Please, try again.', true));
					$this->log($this->data);
					//$this->showQuery($sql);
			}
		}
		$items 	= $this->PointRewardItem->Item->find('list', array('conditions' => array('Item.request_type_id' => request_type_point_reward_id, 'PointRewardItem.item_prefix'=> null)));
		$opts	= array('VOUCHER'=>'VOUCHER','HADIAH'=>'HADIAH');
		$moduleName = 'Point Reward Item > New Item ';
		$this->set('title_for_layout',  $this->lastSegment($moduleName));
		
		$this->set(compact('items', 'moduleName', 'opts'));
	} 
	
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid point reward item', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('PointRewardItem', $this->PointRewardItem->read(null, $id));
	}
	
	function edit($id = null){		
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid id', true));
			$this->redirect(array('action' => 'index'));
		}
		
		if (!empty($this->data)) {
			$this->data['PointRewardItem']['item_prefix'] = strtoupper($this->data['PointRewardItem']['item_prefix']);
			$count = $this->PointRewardItem->find('count', array('conditions' => array('PointRewardItem.item_prefix' => $this->data['PointRewardItem']['item_prefix'])));
			if($count > 0){
				$this->Session->setFlash(__('The item prefix already used. Please, try again with different item prefix.', true));
				$this->redirect(array('action' => 'edit', $id));
			}else{
				if ($this->PointRewardItem->save($this->data)) {
					$this->Session->setFlash(__('The item has been saved', true), 'default', array('class' => 'ok'));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The item could not be saved. Please, try again.', true));
				}

			}
		}
		
		if (empty($this->data)) {
			$this->data = $this->PointRewardItem->read(null, $id);
		}
		
		$pointItem = $this->PointRewardItem->read(null, $id);
		$this->Session->write('PointRewardItem.id', $id);

		$items = $this->PointRewardItem->Item->find('list', array('conditions' => array('Item.request_type_id' => request_type_point_reward_id)));
		$this->Session->write('PointRewardItem.item_id', $pointItem['PointRewardItem']['item_id']);
		$this->Session->write('PointRewardItem.mark', $pointItem['PointRewardItem']['mark']);
		
		$opts	= array('VOUCHER'=>'VOUCHER','HADIAH'=>'HADIAH');
		$this->set(compact('pointItem', 'items', 'opts'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for point reward item', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->PointRewardItem->delete($id)) {
			$this->Session->setFlash(__('Point reward item deleted', true), 'default', array('class' => 'ok'));			
		}else{
			$this->Session->setFlash(__('Point reward item was not deleted', true));
		}		
		$this->redirect(array('action' => 'index'));
	}

}
?>