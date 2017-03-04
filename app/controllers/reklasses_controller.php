<?php 
class ReklassesController extends AppController {

	var $name = 'Reklasses';
    var $helpers = array('Html', 'Ajax', 'Javascript', 'Number', 'Time');
	
	function index($reklas_status_id = null) {
	
		$this->Reklass->recursive = 0;
		$this->paginate = array('order'=>'Reklass.id');
		$layout = $this->data['Reklass']['layout'];
		$conditions = array();
		if ($reklas_status_id || ($reklas_status_id = $this->data['Reklass']['reklas_status_id'])) {
			  $conditions[] = array('Reklass.reklas_status_id' => $reklas_status_id);
		}
		list($date_start, $date_end) = $this->set_date_filters('Reklass');
		$conditions[] = array('date >=' => ($date_start['year'] . '-' . $date_start['month'] . '-' . $date_start['day']),
			'date <=' => ($date_end['year'] . '-' . $date_end['month'] . '-' . $date_end['day']));
		if ($layout == 'pdf' || $layout == 'xls') {
			  $con = $this->Reklass->find('all', array('conditions' => $conditions));
		} else {
			  $con = $this->paginate($conditions);
		}
		$this->set('reklasses', $con);
        $copyright_id = $this->configs['copyright_id'];
		$reklasStatus = $this->Reklass->ReklasStatus->find('list');
		$this->set(compact('date_start', 'date_end', 'reklasStatus', 'copyright_id'));
		if ($layout == 'pdf') {
			  Configure::write('debug', 1); // Otherwise we cannot use this method while developing 
			  $this->layout = 'pdf'; //this will use the pdf.ctp layout 
			  $this->render('index_pdf');
		} else if ($layout == 'xls') {
			  $this->render('index_xls', 'export_xls');
		}
	}

	function view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid reklas', true), array('action' => 'index'));
		}
		$this->set('reklas', $this->Reklass->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$asset = $this->Reklass->Asset->read(null, $this->data['Reklass']['asset_id']);
			$this->data['Reklass']['amount'] = $asset['Asset']['amount'];
			$this->data['Reklass']['depthnini'] = $asset['Asset']['book_value'];
			$item = $this->Reklass->Item->read(null, $this->data['Reklass']['item_id']);
			$this->data['Reklass']['item_code'] = $item['Item']['code'];
			$this->Reklass->create();
			$this->data['Reklass']['reklas_status_id'] = status_reklass_draft_id;
			if ($this->Reklass->save($this->data)) {
				$this->Session->setFlash(__('Reklass saved.', true), 'default', array('class' => 'ok'));
				$this->redirect(array('action' => 'view', $this->Reklass->id));
			} else {
				$this->Session->setFlash(__('Reklass Cant be saved.', true));
				$this->redirect(array('action' => 'index'));

			}
		}
		$newID = $this->Reklass->getNewId();
		//$assetCategory = $this->Reklass->AssetCategory->find('list', array('conditions'=>array('asset_category_type_id !='=>2)));
		$assetCategory = $this->Reklass->AssetCategory->find('list');
		$this->set(compact('newID', 'assetCategory'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(sprintf(__('Invalid reklas', true)), array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Reklass->save($this->data)) {
				$this->Session->setFlash(__('Reklass saved.', true), 'default', array('class' => 'ok'));
				$this->redirect(array('action' => 'view', $id));
			} else {
				$this->Session->setFlash(__('Reklass Cant be saved.', true));
				$this->redirect(array('action' => 'view', $id));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Reklass->read(null, $id);
		}
		$assets = $this->Reklass->Asset->find('list');
		$assetCategory = $this->Reklass->AssetCategory->find('list');
		$this->set(compact('assets', 'assetCategory'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->flash(sprintf(__('Invalid reklas', true)), array('action' => 'index'));
		}
		if ($this->Reklass->delete($id)) {
			$this->flash(__('reklas deleted', true), array('action' => 'index'));
		}
		$this->flash(__('reklas was not deleted', true), array('action' => 'index'));
		$this->redirect(array('action' => 'index'));
	}
	
	function UpdateStatus($id, $status){
		if (!$id) {
			$this->flash(sprintf(__('Invalid reklas', true)), array('action' => 'index'));
		}
		
		$this->Reklass->id = $id;
		$this->Reklass->set('reklas_status_id', $status);
			if ($this->Reklass->save()) {
				$this->Session->setFlash(__('Reklass saved.', true), 'default', array('class' => 'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Reklass Cannot be saved.', true));
				$this->redirect(array('action' => 'index'));

			}

	}
}
?>