<?php
class ConfigsController extends AppController {

	var $name = 'Configs';

	function index($print=null) {
		$this->Config->recursive = 0;
		$this->paginate = array('order'=>'Config.key');
		if($print == 'pdf' || $print == 'xls')
			$con = $this->Config->find('all');
		else
			$con = $this->paginate();
			
		$this->set('configs', $con);
		
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

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid config', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('config', $this->Config->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Config->create();
			if ($this->Config->save($this->data)) {
				$this->Session->setFlash(__('The config has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The config could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid config', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Config->save($this->data)) {
				$this->Session->setFlash(__('The config has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The config could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Config->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for config', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Config->delete($id)) {
			$this->Session->setFlash(__('Config deleted', true), 'default', array('class'=>'ok'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Config was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>