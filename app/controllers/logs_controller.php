<?php
class LogsController extends AppController {

	var $name = 'Logs';
	var $helpers = array('Ajax', 'Javascript', 'Time');
	var $components = array('RequestHandler');

	function index($model=null, $user_id=null, $action=null, $conditions=null) {
		$this->Log->recursive = 0;
		
		$conditions[] = array();
		
		if($model || ($model=$this->data['Log']['model']) ) {
			$conditions[] = array('Log.model'=>$model);
		}
		
		if($user_id || ($user_id=$this->data['Log']['user_id']) ) {
			$conditions[] = array('Log.user_id'=>$user_id);
		}
		
		if($action || ($action=$this->data['Log']['action']) ) {
			$conditions[] = array('Log.action'=>$action);
		}
		
		list($date_start,$date_end) = $this->set_date_filters('Log');
		$conditions[] = array('Log.created >=' => ($date_start['year'] . '-' . $date_start['month'] . '-' . $date_start['day'] . ' 00:00:00') , 
				'Log.created <=' => ($date_end['year'] . '-' . $date_end['month'] . '-' . $date_end['day'] . ' 23:59:00'));
		$this->paginate = array('order'=>'Log.id');
		$this->set('logs', $this->paginate( $conditions ));
		$uses = $this->Log->User->find('list');
		
		$this->set(compact('model', 'user_id', 'action', 'uses', 'date_start', 'date_end'));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid log', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('log', $this->Log->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Log->create();
			if ($this->Log->save($this->data)) {
				$this->Session->setFlash(__('The log has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The log could not be saved. Please, try again.', true));
			}
		}
		$users = $this->Log->User->find('list');
		$this->set(compact('users'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid log', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Log->save($this->data)) {
				$this->Session->setFlash(__('The log has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The log could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Log->read(null, $id);
		}
		$users = $this->Log->User->find('list');
		$this->set(compact('users'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for log', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Log->delete($id)) {
			$this->Session->setFlash(__('Log deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Log was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>