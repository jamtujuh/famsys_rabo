<?php
class LocationsController extends AppController {

	var $name = 'Locations';
	var $is_ajax=false;

	function index() {
		$this->Location->recursive = 0;
		$this->paginate = array('order'=>'Location.id');
		$this->set('locations', $this->paginate());
		$moduleName = 'Master Data > Location';
		$this->set('title_for_layout',  $this->lastSegment($moduleName));
		$this->set(compact('moduleName'));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid location', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('location', $this->Location->read(null, $id));
	}

	function add() {
		if($this->is_ajax)
		{
			$this->layout='ajax';
			$this->autoRender=false;
			$msg='';
			$status='';
			$location=null;
			$count=0;
		}	
		
		if (!empty($this->data)) {
			$this->Location->create();
			if ($this->Location->save($this->data)) {
				if($this->is_ajax)
				{	
					$this->Session->setFlash(__('The location has been saved', true), 'default', array('class'=>'ok'));
					$location=$this->Location->read(null, $this->Location->id);
					$count = $this->Location->find('count', array('conditions'=>array('Location.department_id'=>$this->Session->read('Department.id') )));
				}
				else
				{
					$this->Session->setFlash(__('The location has been saved', true), 'default', array('class'=>'ok'));
					$this->redirect(array('action' => 'index'));
				}
			} else {
				if($this->is_ajax)
					$this->Session->setFlash(__('The location could not be saved. Please, try again.', true));
				else
					$this->Session->setFlash(__('The location could not be saved. Please, try again.', true));
			}
		}
		
		if($this->is_ajax)
		{
			echo json_encode(array('status'=>$status, 'msg'=>$msg, 'data'=>$location, 'count'=>$count));
		}
		else
		{		
			$departments = $this->Location->Department->find('list');
			$parentLocations = $this->Location->ParentLocation->find('list');
			$this->set(compact('departments', 'parentLocations'));
		}
	}
	
	function ajax_add()
	{
		$this->is_ajax=true;
		$this->add();
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid location', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Location->save($this->data)) {
				$this->Session->setFlash(__('The location has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('controller'=>'departments','action' => 'view',$this->Session->read('Department.id')));
			} else {
				$this->Session->setFlash(__('The location could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Location->read(null, $id);
		}
		$departments = $this->Location->Department->find('list');
		$parentLocations = $this->Location->ParentLocation->find('list');
		$this->set(compact('departments', 'parentLocations'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for location', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Location->delete($id)) {
			$this->Session->setFlash(__('Location deleted', true), 'default', array('class'=>'ok'));
			$this->redirect(array('controller'=>'departments','action' => 'view',$this->Session->read('Department.id')));
		}
		$this->Session->setFlash(__('Location was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>