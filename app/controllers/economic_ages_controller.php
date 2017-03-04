<?php
class EconomicAgesController extends AppController {

    var $name = 'EconomicAges';
    var $helpers = array('Ajax', 'Javascript', 'Time');
    var $components = array('RequestHandler');

    function index() {
		$this->EconomicAge->recursive = 0;
		$layout = $this->data['EconomicAge']['layout'];
		if(!empty($this->data))
		{
			$this->Session->write('EconomicAge.year', 	$this->data['EconomicAge']['year']);			
		}
		$conditions[] = array();
		
		if($year=$this->Session->read('EconomicAge.year')){
			$conditions[]=array('EconomicAge.year'=>$year);			
		}
		$this->paginate = array('order'=>'EconomicAge.year ASC');
		$con = $this->paginate($conditions);
		
		$opts = $this->EconomicAge->find('list', array('order'=>'EconomicAge.year ASC'));
		$options = array();
		foreach ($opts as $opt => $year):
			$options[$year] = $year;
		endforeach;
		$this->set('economicages', $con);		
		$this->set(compact('year','options','layout'));
    }

	function add() {
	  	if (!empty($this->data)) {
				$code = $this->data['EconomicAge']['year'];
				$exist = $this->EconomicAge->find('list', array('conditions' => array('EconomicAge.year' => $code)));
				if($exist){
					$this->Session->setFlash(__('The Economic Age could not be saved. Please, try different year value.', true));
				}else{
					$this->data['EconomicAge']['max'] = $this->data['EconomicAge']['year'] * 12;
					$this->EconomicAge->create();
					if ($this->EconomicAge->save($this->data)) {
						$this->Session->setFlash(__('The Economic Age has been saved', true), 'default', array('class' => 'ok'));
						$this->redirect(array('action' => 'index'));
					} else {
						$this->Session->setFlash(__('The Economic Age could not be saved. Please, try again.', true));
					}
				}
								
            }
			
		$year = $this->EconomicAge->find('list');
		$this->set(compact('newId', 'year'));
	}
	  
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			  $this->Session->setFlash(__('Invalid Economic Age', true));
			  $this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			$code = $this->data['EconomicAge']['year'];
			$exist = $this->EconomicAge->find('list', array('conditions' => array('EconomicAge.year' => $code)));
			if($exist){
				$this->Session->setFlash(__('The Economic Age could not be saved. Please, try different year value.', true));
			}else{
				$this->data['EconomicAge']['max'] = $this->data['EconomicAge']['year'] * 12;
				if ($this->EconomicAge->save($this->data)) {
					$this->Session->setFlash(__('The Economic Age has been saved', true), 'default', array('class' => 'ok'));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The Economic Age could not be saved. Please, try again.', true));
				}
			}			
		}
		if (empty($this->data)) {
			  $this->data = $this->EconomicAge->read(null, $id);
		}
		$EconomicAge = $this->EconomicAge->read(null, $id);
		$this->set(compact('EconomicAge'));
    }

    function delete($id = null) {
		if (!$id) {
			  $this->Session->setFlash(__('Invalid id for Economic Age', true));
			  $this->redirect(array('action' => 'index'));
		}

		//reset NPB detail 	qty  and status
		$EconomicAge = $this->EconomicAge->read(null, $id);
		if ($this->EconomicAge->delete($id)) {
			  $this->Session->setFlash(__('Economic Age deleted', true), 'default', array('class' => 'ok'));
			  $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Economic Age was not deleted', true));
		$this->redirect(array('action' => 'index'));
    }

}

?>