<?php
class JournalTemplatesController extends AppController {

	var $name = 'JournalTemplates';
	var $helpers = array('Ajax', 'Javascript', 'Number');
	var $components = array('RequestHandler');

    var $paginate = array(
        'limit' => 25,
        'order' => array(
            'AssetCategory.name' => 'asc'
        )
    );
	
	function index() {
		$journal_groups = $this->JournalTemplate->JournalGroup->find('list');
		$this->JournalTemplate->recursive = 0;
		
		$conditions=array();
		if(!empty($this->data))
		{
			if(isset($this->data['JournalTemplate']['journal_group_id']))
				$this->Session->write('JournalTemplate.journal_group_id',$this->data['JournalTemplate']['journal_group_id']);
			if(isset($this->data['JournalTemplate']['asset_category_type_id']))
				$this->Session->write('JournalTemplate.asset_category_type_id',$this->data['JournalTemplate']['asset_category_type_id']);
			if(isset($this->data['JournalTemplate']['asset_category_id']))
				$this->Session->write('JournalTemplate.asset_category_id',$this->data['JournalTemplate']['asset_category_id']);

		}
		$journal_group_id=$this->Session->read('JournalTemplate.journal_group_id');
		$conditions = array('journal_group_id'=>$journal_group_id);
		$this->paginate = array('order'=>'JournalTemplate.id');
		$this->set('journalTemplates', $this->paginate($conditions));
		$this->set(compact('journal_groups','journal_group_id'));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid journal template', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->write('JournalTemplate.id',$id);
		
		$journal_positions = $this->JournalTemplate->JournalTemplateDetail->JournalPosition->find('list');
		$accounts = $this->JournalTemplate->JournalTemplateDetail->Account->find('list');
		$accountCodes = $this->JournalTemplate->JournalTemplateDetail->Account->find('list', array('fields'=>array('gl')));
		$this->set('journalTemplate', $this->JournalTemplate->read(null, $id));
		$this->set(compact('journal_positions','accounts','accountCodes'));
	}

	function add() {
		if (!empty($this->data)) {
			$this->JournalTemplate->create();
			if ($this->JournalTemplate->save($this->data)) {
				$this->Session->setFlash(__('The journal template has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The journal template could not be saved. Please, try again.', true));
			}
		}
		$journalGroups = $this->JournalTemplate->JournalGroup->find('list');
		$assetCategoryTypes = $this->JournalTemplate->AssetCategory->AssetCategoryType->find('list');
		$assetCategories = $this->JournalTemplate->AssetCategory->find('list', array('conditions'=>array('AssetCategory.asset_category_type_id'=>$this->Session->read('JournalTemplate.asset_category_type_id'))));
		$this->set(compact('journalGroups', 'assetCategories','assetCategoryTypes'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid journal template', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->JournalTemplate->save($this->data)) {
				$this->Session->setFlash(__('The journal template has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The journal template could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->JournalTemplate->read(null, $id);
		}
		
		$param=array('order'=>array('AssetCategory.name'));
		$journalGroups = $this->JournalTemplate->JournalGroup->find('list');
		$assetCategories = $this->JournalTemplate->AssetCategory->find('list', $param);
			//, array('conditions'=>array('AssetCategory.asset_category_type_id'=>$this->Session->read('JournalTemplate.asset_category_type_id'))));
		$assetCategoryTypes = $this->JournalTemplate->AssetCategory->AssetCategoryType->find('list');
		$this->set(compact('journalGroups', 'assetCategories','assetCategoryTypes'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for journal template', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->JournalTemplate->delete($id)) {
			$this->Session->setFlash(__('Journal template deleted', true), 'default', array('class'=>'ok'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Journal template was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function get_journal_group($model) {
		$this->layout='ajax';
		
		$this->set('options',
			$this->JournalTemplate->find('list',
				array(
					'order'=>array('JournalTemplate.name'),
					'conditions' => array(
						'JournalTemplate.journal_group_id' => $this->data[$model]['journal_group_id']
					)
				)
			)
		);
		$this->render('/journal_templates/ajax_dropdown');
	}

}
?>