<?php
class CostCentersController extends AppController {

	var $name = 'CostCenters';

	function index() {
		$this->CostCenter->recursive = 0;
		$this->paginate = array('order'=>'CostCenter.id');
		$this->set('costCenters', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid cost center', true), array('action' => 'index'));
		}
		$this->set('costCenter', $this->CostCenter->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->CostCenter->create();
			if ($this->CostCenter->save($this->data)) {
				$this->Session->setFlash(__('The department has been saved', true), 'default', array('class' => 'ok'));
                $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The department could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(sprintf(__('Invalid cost center', true)), array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->CostCenter->save($this->data)) {
				$this->Session->setFlash(__('The department has been saved', true), 'default', array('class' => 'ok'));
                $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The department could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->CostCenter->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->flash(sprintf(__('Invalid cost center', true)), array('action' => 'index'));
		}
		if ($this->CostCenter->delete($id)) {
			$this->Session->setFlash(__('The department has been deleted', true), 'default', array('class' => 'ok'));
                $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The department could not be deleted. Please, try again.', true));
			}
	}
	
	function auto_complete ()
	{
		$this->CostCenter->recursive = 0;
		/*
		$this->set('costCenters',
			$this->CostCenter->find('all',
				array('conditions'=>"
					CostCenter.cost_centers LIKE '{$this->data['CostCenter']['name']}%'
					or CostCenter.name LIKE '{$this->data['CostCenter']['name']}%'
					
				"))
			);
		*/
		$costCenters = $this->CostCenter->query("select a.id, a.name, b.t24_dao, a.remarks from cost_centers a
												left join cost_center_to_daos b on b.cost_center_id = a.id
												where a.name like '{$this->data['CostCenter']['name']}%'
												or b.t24_dao like '%{$this->data['CostCenter']['name']}%'
												and a.remarks = 'Y'
												");
		$this->set('costCenters', $costCenters);
		$this->layout = "ajax";
	}
	
	function auto_complete_source ()
	{
		$this->CostCenter->recursive = 0;
		$this->set('costCenters',
			$this->CostCenter->find('all',
				array('conditions'=>"
					CostCenter.cost_centers LIKE '{$this->data['SourceCostCenter']['name']}%'
					or CostCenter.name LIKE '{$this->data['SourceCostCenter']['name']}%'
					
				"))
			);
		$this->layout = "ajax";
	}
	
	function auto_complete_destination ()
	{
		$this->CostCenter->recursive = 0;
		$this->set('costCenters',
			$this->CostCenter->find('all',
				array('conditions'=>"
					CostCenter.cost_centers LIKE '{$this->data['DestCostCenter']['name']}%'
					or CostCenter.name LIKE '{$this->data['DestCostCenter']['name']}%'
					
				"))
			);
		$this->layout = "ajax";
	}
}
?>