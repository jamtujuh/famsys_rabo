<?php
class WarrantiesController extends AppController {

	var $name = 'Warranties';
	var $helpers = array('Ajax', 'Javascript');
	var $components = array('RequestHandler');

	function index() {
		$this->Warranty->recursive = 0;
		$this->paginate = array('order'=>'Warranty.id');
		$this->set('warranties', $this->paginate());
		$moduleName = 'Master Data > Warranty';
		$this->set('title_for_layout',  $this->lastSegment($moduleName));
		$this->set(compact('moduleName'));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid warranty', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('warranty', $this->Warranty->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Warranty->create();
			if ($this->Warranty->save($this->data)) {
				$this->Session->setFlash(__('The warranty has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The warranty could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid warranty', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Warranty->save($this->data)) {
				$this->Session->setFlash(__('The warranty has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The warranty could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Warranty->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for warranty', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Warranty->delete($id)) {
			$this->Session->setFlash(__('Warranty deleted', true), 'default', array('class'=>'ok'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Warranty was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	// function get_warranty_json()
	// {
		// if (!empty($this->data)) {
			// $this->set('warranty',$this->Warranty->findById($this->data['Purchase']['warranty_id']));
		// }
	// }	
	function get_warranty_info()
	{
		$this->autoRender = false;
		if (!empty($this->data)) {
			$w=$this->Warranty->findById($this->data['Purchase']['warranty_id']);
			echo $w['Warranty']['warranty_info'];
		}
	}
	
	function history() {

	}
	
}
?>