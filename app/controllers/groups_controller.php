<?php
class GroupsController extends AppController {

	var $name = 'Groups';
	var $helpers = array('Form','Html');

	function index($print=null) {
		$this->Group->recursive = 1;
		$this->paginate = array('order'=>'Group.id');
		
		if($print == 'pdf' || $print == 'xls')
			$con = $this->Group->find('all');
		else
			$con = $this->paginate();
			
		$this->set('groups', $con);
		
		$copyright_id = $this->configs['copyright_id'];
		$this->set(compact('copyright_id'));
		if ($print == 'pdf') {
			  Configure::write('debug', 0); // Otherwise we cannot use this method while developing 
			  $this->layout = 'pdf'; //this will use the pdf.ctp layout 
			  $this->render('index_pdf');
		} else if ($print == 'xls') {
			  $this->render('index_xls', 'export_xls');
		}
	}
	function export_xls($id=null) {
		$this->Group->recursive = 1;
		$groups = $this->Group->read(null, $id);
		$copyright_id = $this->configs['copyright_id'];
		$menu = $this->Group->Menu->find('list');
		$this->set(compact('copyright_id','groups', 'menu'));
		$this->render('export_xls', 'export_xls');
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid group', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Group->recursive = 0;
		$this->set('group', $this->Group->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Group->create();
			if ($this->Group->save($this->data)) {
				$this->Session->setFlash(__('The group has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The group could not be saved. Please, try again.', true));
			}
		}
		$menus = $this->Group->Menu->find('list');
		$this->set(compact('menus'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid group', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Group->save($this->data)) {
				$this->Session->setFlash(__('The group has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The group could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Group->read(null, $id);
		}
		//$menus = $this->Group->Menu->find('list');
		$menus = $this->Group->Menu->find('threaded');
		$menus = $this->threaded_to_list($menus,'Menu','id','title');			
		$this->set(compact('menus'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for group', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Group->delete($id)) {
			$this->Session->setFlash(__('Group deleted', true), 'default', array('class'=>'ok'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Group was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>