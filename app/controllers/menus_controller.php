<?php
class MenusController extends AppController {

	var $name = 'Menus';
	var $paginate = array( 
		'Menu'    => array( 
			'order'    => array( 
				'Menu.parent_id'    => 'asc',
				/* 'Menu.urutan'    => 'asc' */) 
		) 
	); 
	var $actAs = array('Tree');
	
	function index() {
		Configure::write('debug', 0);
		$this->Menu->recursive = 0;
		$parentMenus = $this->Menu->find('threaded');
		$parentMenus = $this->threaded_to_list($parentMenus,'Menu','id','title');	
		
		$cons=array();
		if(!empty($this->data))
		{
			if($this->data['Menu']['parent_id'])
				$this->Session->write('Menu.parent_id',$this->data['Menu']['parent_id']);
			else
				$this->Session->write('Menu.parent_id',null);
		}
		if($this->Session->check('Menu.parent_id'))
			$cons[] = array('Menu.parent_id'=>$this->Session->read('Menu.parent_id'));
		//$this->paginate = array('order'=>array('Menu.id','Menu.urutan'));
		$this->set('menus', $this->paginate($cons));
		$this->set('parentMenus', $parentMenus);
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid menu', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('menu', $this->Menu->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Menu->create();
			if ($this->Menu->save($this->data)) {
				$this->Session->setFlash(__('The menu has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The menu could not be saved. Please, try again.', true));
			}
		}

		$parentMenus = $this->Menu->find('threaded');
		$parentMenus = $this->threaded_to_list($parentMenus,'Menu','id','title');	
		
//		$groups = $this->Menu->Group->find('list');
		$this->set(compact('parentMenus', 'groups'));
	}


	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid menu', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Menu->save($this->data)) {
				$this->Session->setFlash(__('The menu has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The menu could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Menu->read(null, $id);
		}
		$parentMenus = $this->Menu->find('threaded');
		$parentMenus = $this->threaded_to_list($parentMenus,'Menu','id','title');	
		//$groups = $this->Menu->Group->find('list');
		$this->set(compact('parentMenus' ));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for menu', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Menu->delete($id)) {
			$this->Session->setFlash(__('Menu deleted', true), 'default', array('class'=>'ok'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Menu was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>