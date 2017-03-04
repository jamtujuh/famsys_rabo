<?php
class PoPaymentsController extends AppController {

	var $name = 'PoPayments';

	function index() {
		$this->PoPayment->recursive = 0;
		$this->paginate = array('order'=>'PoPayment.id');
		$this->set('poPayments', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid po payment', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('poPayment', $this->PoPayment->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->PoPayment->create();
			if ($this->PoPayment->save($this->data)) {
				$this->Session->setFlash(__('The po payment has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The po payment could not be saved. Please, try again.', true));
			}
		}
		$pos = $this->PoPayment->Po->find('list');
		$this->set(compact('pos'));
	}

	function edit($id = null) {
		$msg = '';
		
		if($this->is_ajax)
		{
			$this->data=$_POST;
			$this->layout='ajax';
			$this->autoRender=false;
			$fieldName = $this->data['editorId'];
			$value = str_replace(',','',$this->data['value']);
			list($fieldName,$id)=explode('.',$fieldName);
			
			$this->data = $this->PoPayment->read(null, $id);
			$this->data['PoPayment'][$fieldName] = $value;
			$this->data['PoPayment']['id'] = $id;
			
			//update amount_due , amount_paid
			$this->data['PoPayment']['amount_due'] = $this->data['Po']['total_cur']*$this->data['PoPayment']['term_percent']/100 ;
		}
		
		if (!$id && empty($this->data)) {
			if($this->is_ajax)
			{
				$msg = __('Invalid po payment', true);
			}
			else
			{
				$this->Session->setFlash(__('Invalid po payment', true));
				$this->redirect(array('action' => 'index'));
			}
		}	

		if (!empty($this->data)) {
			if ($this->PoPayment->save($this->data)) {
				if($this->is_ajax)
				{
					$msg = __('The po payment has been saved', true);
				}
				else
				{			
					$this->Session->setFlash(__('The po payment has been saved', true), 'default', array('class'=>'ok'));
					$this->redirect(array('action' => 'index'));
				}
			} else {
				if($this->is_ajax)
				{
					$msg = __('The po payment could not be saved. Please, try again.', true);
				}
				else
				{
					$this->Session->setFlash(__('The po payment could not be saved. Please, try again.', true));
				}
			}
		}
		//if (empty($this->data)) {
			$this->data = $this->PoPayment->read(null, $id);
		//}
		if($this->is_ajax)
		{
			//echo json_encode(array('data'=>$this->data,'msg'=>$msg));
			if ($fieldName == 'date_due') {
				echo strftime("%Y-%m-%d", strtotime($this->data['PoPayment'][$fieldName]));
			} else {
				echo $this->data['PoPayment'][$fieldName];
			}
		}
		else
		{		
			$pos = $this->PoPayment->Po->find('list');
			$this->set(compact('pos'));
		}
	}
	
	function ajax_edit($id )
	{
		$this->is_ajax=true;
		$this->edit($id );
	}
	
	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for po payment', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->PoPayment->delete($id)) {
			$this->Session->setFlash(__('Po payment deleted', true), 'default', array('class'=>'ok'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Po payment was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>