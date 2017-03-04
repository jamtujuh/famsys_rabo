<?php
class UsageDetailsController extends AppController {

	var $name = 'UsageDetails';
	var $is_ajax = false;

	function index() {
		$this->UsageDetail->recursive = 0;
		$this->set('usageDetails', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid usage detail', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('usageDetail', $this->UsageDetail->read(null, $id));
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
		$usageDetail=null;
		$count=0;
		$status=null;
		
		if (!empty($this->data)) {
			$item_id = $this->data['UsageDetail']['item_id'];
			$item  = $this->UsageDetail->Item->read(null, $item_id);		
			$this->data['UsageDetail']['price']  = $item['Item']['avg_price'];

			$this->UsageDetail->create();
			$this->data['UsageDetail']['amount'] = $this->data['UsageDetail']['qty']*$this->data['UsageDetail']['price']  ;
			$this->data['UsageDetail']['amount_cur'] = $this->data['UsageDetail']['qty']*$this->data['UsageDetail']['price_cur']  ;
			
			if ($this->UsageDetail->save($this->data)) {
				if($this->is_ajax)
				{
					$msg=__('The usage detail has been saved', true);
					$status='ok';
					$this->UsageDetail->recursive=2;
					$usageDetail=$this->UsageDetail->read(null, $this->UsageDetail->id );
					$count=$this->UsageDetail->find('count', array('conditions'=>array('UsageDetail.usage_id'=>$this->Session->read('Usage.id'))));					
				}
				else
				{
					$this->Session->setFlash(__('The usage detail has been saved', true), 'default', array('class'=>'ok'));
					$this->redirect(array('action' => 'index'));
				}
			} else {
				if($this->is_ajax)
				{
					$status='failed';
					$msg=__('The usage detail could not be saved. Please, try again.', true);
				}
				else
				{
					$this->Session->setFlash(__('The usage detail could not be saved. Please, try again.', true));
				}
			}
		}
		
		if($this->is_ajax)
		{
			echo json_encode(array('status'=>$status, 'msg'=>$msg, 'data'=>$usageDetail,'count'=>$count));
		}
		else
		{		
			$usages = $this->UsageDetail->Usage->find('list');
			$items = $this->UsageDetail->Item->find('list');
			$this->set(compact('usages', 'items'));
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid usage detail', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->UsageDetail->save($this->data)) {
				$this->Session->setFlash(__('The usage detail has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The usage detail could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->UsageDetail->read(null, $id);
		}
		$usages = $this->UsageDetail->Usage->find('list');
		$items = $this->UsageDetail->Item->find('list');
		$this->set(compact('usages', 'items'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for usage detail', true));
			$this->redirect(array('controller'=>'usages','action'=>'view', $this->Session->read('Usage.id')));
		}
		if ($this->UsageDetail->delete($id)) {
			$this->Session->setFlash(__('Usage detail deleted', true), 'default', array('class'=>'ok'));
			$this->redirect(array('controller'=>'usages','action'=>'view', $this->Session->read('Usage.id')));
		}
		$this->Session->setFlash(__('Usage detail was not deleted', true));
		$this->redirect(array('controller'=>'usages','action'=>'view', $this->Session->read('Usage.id')));
	}
}
?>