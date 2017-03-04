<?php
class DepartmentUnitsController extends AppController {

	var $name = 'DepartmentUnits';
	var $helpers = array('Ajax', 'Javascript');
	var $is_ajax=false;
	var $components = array('RequestHandler');

	function index() {
		$this->DepartmentUnit->recursive = 0;
		$this->paginate = array('order'=>'DepartmentUnit.id');
		$this->set('departmentUnits', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid department unit', true), array('action' => 'index'));
		}
		$this->set('departmentUnit', $this->DepartmentUnit->read(null, $id));
	}
	function add() {
			if($this->is_ajax)
			{
				$this->layout='ajax';
				$this->autoRender=false;
				$msg='';
				$status='';
				$departmentUnit=null;
				$count=0;
			}	
		
	if (!empty($this->data)) {
			$this->DepartmentUnit->create();
			if ($this->DepartmentUnit->save($this->data)) {
				if($this->is_ajax)
				{	
					$this->Session->setFlash(__('The Unit has been saved', true), 'default', array('class'=>'ok'));
					$departmentUnit=$this->DepartmentUnit->read(null, $this->DepartmentUnit->id);
					$count = $this->DepartmentUnit->find('count', array('conditions'=>array('DepartmentUnit.department_Sub_id'=>$this->Session->read('Department_Sub_id.id') )));
				}
				else
				{
					$this->Session->setFlash(__('The Unit has been saved', true), 'default', array('class'=>'ok'), 'default', array('class'=>'ok'));
					$this->redirect(array('action' => 'index'));
				}
			} else {
				if($this->is_ajax)
					$this->Session->setFlash(__('The Unit could not be saved. Please, try again.', true));
				else
					$this->Session->setFlash(__('The Unit could not be saved. Please, try again.', true));
			}
		}
		
		if($this->is_ajax)
		{
			echo json_encode(array('status'=>$status, 'msg'=>$msg, 'data'=>$departmentUnit, 'count'=>$count));
		}
		else
		{		
		$department = $this->DepartmentUnit->DepartmentSub->Department->find('list');
		$departmentSub = $this->DepartmentUnit->DepartmentSub->find('list');
		$this->set(compact('department', 'departmentSub'));
		}
	}
	
	function ajax_add()
	{
		$this->is_ajax=true;
		$this->add();
	}
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(sprintf(__('Invalid department unit', true)), array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->DepartmentUnit->save($this->data)) {
				$this->flash(__('The department unit has been saved.', true), array('action' => 'index'), 'default', array('class'=>'ok'));
			} else {
				$this->Session->setFlash(__('The movement status could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->DepartmentUnit->read(null, $id);
		}
		$department = $this->DepartmentUnit->DepartmentSub->Department->find('list');
		$departmentSub = $this->DepartmentUnit->DepartmentSub->find('list');
		$this->set(compact('department', 'departmentSub'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->flash(sprintf(__('Invalid department unit', true)), array('action' => 'index'));
		}
		if ($this->DepartmentUnit->delete($id)) {
			$this->flash(__('Department unit deleted', true), 'default', array('class'=>'ok'));
			$this->redirect(array('controller'=>'department_subs','action' => 'view',$this->Session->read('DepartmentSub.id')));
		}
		$this->flash(__('Department unit was not deleted', true), array('action' => 'index'));
		$this->redirect(array('action' => 'index'));
	}
	

}
?>