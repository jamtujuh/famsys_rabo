<?php
class PeriodesController extends AppController {

    var $name = 'Periodes';
    var $helpers = array('Ajax', 'Javascript', 'Time');
    var $components = array('RequestHandler');

    function index() {
		$this->Periode->recursive = 0;
		$layout = $this->data['Periode']['layout'];
		$conditions[] = array();
		$this->paginate = array('order'=>'Periode.id ASC');
		$con = $this->paginate($conditions);
		$this->set('Periodes', $con);		
		$this->set(compact('layout'));
    }

	function add() {
	  	if (!empty($this->data)) {			
			$day_start 	= $this->data['Periode']['day_start'];
			$day_end 	= $this->data['Periode']['day_end'];
			$exist 		= $this->Periode->findByName($this->data['Periode']['name']);
			if($exist){
				$this->Session->setFlash(__('The Periode could not be saved. Please, try again.', true));
			}else{
				if($day_end > '31'){
					$this->Session->setFlash(__('The Periode could not be saved. Please, try again.', true));
					$this->redirect(array('action' => 'add'));
				}else if($day_start < $day_end){
					$this->Periode->create();
					if ($this->Periode->save($this->data)) {
						$this->Session->setFlash(__('The Periode has been saved', true), 'default', array('class' => 'ok'));
						$this->redirect(array('action' => 'index'));
					} else {
						$this->Session->setFlash(__('The Periode could not be saved. Please, try again.', true));
					}
				}
			}
		}
		for($n=1;$n<=31;$n++){
			$dates[$n] = $n;
		}
		$curday = date('d');
		$this->set(compact('dates', 'curday'));
	}
	  
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			  $this->Session->setFlash(__('Invalid Periode', true));
			  $this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			$this->data['Periode']['id'] = $id;
			$day_start 	= $this->data['Periode']['day_start'];
			$day_end 	= $this->data['Periode']['day_end'];
			$exist 		= $this->Periode->findByName($this->data['Periode']['name']);
			
			if($day_start < $day_end){
				if ($this->Periode->save($this->data)) {
					$this->Session->setFlash(__('The Periode has been saved', true), 'default', array('class' => 'ok'));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The Periode could not be saved. Please, try again.', true));
				}
			}			
		}
		if (empty($this->data)) {
			  $this->data = $this->Periode->read(null, $id);
		}
		$Periode = $this->Periode->read(null, $id);
		$day_start = $Periode['Periode']['day_start'];
		$day_end = $Periode['Periode']['day_end'];
		
		for($n=1;$n<=31;$n++){
			$dates[$n] = $n;
		}
		$this->set(compact('Periode','day_start','day_end','dates'));
    }

    function delete($id = null) {
		if (!$id) {
			  $this->Session->setFlash(__('Invalid id for Periode', true));
			  $this->redirect(array('action' => 'index'));
		}

		//reset NPB detail 	qty  and status
		$Periode = $this->Periode->read(null, $id);
		if ($this->Periode->delete($id)) {
			  $this->Session->setFlash(__('Periode deleted', true), 'default', array('class' => 'ok'));
			  $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Periode was not deleted', true));
		$this->redirect(array('action' => 'index'));
    }
}

?>