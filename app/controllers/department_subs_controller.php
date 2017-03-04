<?php
class DepartmentSubsController extends AppController {

	var $name = 'DepartmentSubs';
	var $helpers = array('Ajax', 'Javascript');
	var $is_ajax=false;
	var $components = array('RequestHandler');
	function index() {
		$this->DepartmentSub->recursive = 0;
		$this->paginate = array('order'=>'DepartmentSub.id');
		$this->set('departmentSubs', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid department sub', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->write('DepartmentSub.id', $id);
		$this->set('departmentSub', $this->DepartmentSub->read(null, $id));
	}

	function add() {
		if($this->is_ajax)
		{
			$this->layout='ajax';
			$this->autoRender=false;
			$msg='';
			$status='';
			$departmentSub=null;
			$count=0;
		}	
		
		if (!empty($this->data)) {
			$this->DepartmentSub->create();
			if ($this->DepartmentSub->save($this->data)) {
				if($this->is_ajax)
				{	
					$this->Session->setFlash(__('The Department has been saved', true), 'default', array('class'=>'ok'));
					$departmentSub=$this->DepartmentSub->read(null, $this->DepartmentSub->id);
					$count = $this->DepartmentSub->find('count', array('conditions'=>array('DepartmentSub.department_id'=>$this->Session->read('Department.id') )));
				}
				else
				{
					$this->Session->setFlash(__('The Department has been saved', true), 'default', array('class'=>'ok'));
					$this->redirect(array('action' => 'index'));
				}
			} else {
				if($this->is_ajax)
					$this->Session->setFlash(__('The Department could not be saved. Please, try again.', true));
				else
					$this->Session->setFlash(__('The Department could not be saved. Please, try again.', true));
			}
		}
		
		if($this->is_ajax)
		{
			echo json_encode(array('status'=>$status, 'msg'=>$msg, 'data'=>$departmentSub, 'count'=>$count));
		}
		else
		{		
			$departments = $this->DepartmentSub->Department->find('list');
			$this->set(compact('departments'));
		}
	}
	
	function ajax_add()
	{
		$this->is_ajax=true;
		$this->add();
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid department sub', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->DepartmentSub->save($this->data)) {
				$this->Session->setFlash(__('The department sub has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The department sub could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->DepartmentSub->read(null, $id);
		}
		$departments = $this->DepartmentSub->Department->find('list');
		$this->set(compact('departments'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for department sub', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->DepartmentSub->delete($id)) {
			$this->Session->setFlash(__('Department sub deleted', true), 'default', array('class'=>'ok'));
			$this->redirect(array('controller'=>'departments','action' => 'view',$this->Session->read('Department.id')));
		}
		$this->Session->setFlash(__('Department sub was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function getDepartmentUnitId($sender) {
		$this->layout='ajax';
		$this->set('options',
			$this->DepartmentSub->DepartmentUnit->find('list',
				array(
					'conditions' => array(
						'DepartmentUnit.department_sub_id' => $this->data[$sender]['department_sub_id']
					),
					'group' => array('DepartmentUnit.name')
				)
			)
		);
		
		$this->render('/department_subs/ajax_dropdown');
	}
	

}
?>