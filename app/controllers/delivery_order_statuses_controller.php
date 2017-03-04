<?php
class DeliveryOrderStatusesController extends AppController {

	var $name = 'DeliveryOrderStatuses';

	function index() {
		$this->DeliveryOrderStatus->recursive = 0;
		$this->paginate = array('order'=>'DeliveryOrderStatus.id');
		$this->set('deliveryOrderStatuses', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid delivery order status', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('deliveryOrderStatus', $this->DeliveryOrderStatus->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->DeliveryOrderStatus->create();
			if ($this->DeliveryOrderStatus->save($this->data)) {
				$this->Session->setFlash(__('The delivery order status has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The delivery order status could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid delivery order status', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->DeliveryOrderStatus->save($this->data)) {
				$this->Session->setFlash(__('The delivery order status has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The delivery order status could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->DeliveryOrderStatus->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for delivery order status', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->DeliveryOrderStatus->delete($id)) {
			$this->Session->setFlash(__('Delivery order status deleted', true), 'default', array('class'=>'ok'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Delivery order status was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>