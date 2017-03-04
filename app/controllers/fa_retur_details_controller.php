<?php
class FaReturDetailsController extends AppController {

	var $name = 'FaReturDetails';

	function index() {
		$this->FaReturDetail->recursive = 0;
		$this->paginate = array('order'=>'FaReturDetail.id');
		$this->set('faReturDetails', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid fa retur detail', true), array('action' => 'index'));
		}
		$this->set('faReturDetail', $this->FaReturDetail->read(null, $id));
	}

	function add() {
		$name = array();
		if (!empty($this->data)) 
		{
			if(isset($this->data['FaReturDetail']['search_keyword']))
			{
				$name = $this->data['FaReturDetail']['search_keyword'];
			}
			else
			{
			//var_dump($this->data);
				//delete semua record berdasarkan session disposal id
				$this->FaReturDetail->deleteAll(array('fa_retur_id' => $this->Session->read('FaRetur.id')));
				//$this->FaReturDetail->query('update asset_details set ada="Y" where asset_details.id="'.$this->data['FaReturDetail']['asset_detail_id'].'" ');
				
				if(isset($this->data['FaReturDetail']['asset_detail_id']))
				{
				
					foreach ($this->data['FaReturDetail']['asset_detail_id']  as $asset_detail_id)
					{
						$assetDetail = $this->FaReturDetail->AssetDetail->read(null, $asset_detail_id);
						$data['FaReturDetail']['fa_retur_id'] 			= $this->data['FaReturDetail']['fa_retur_id'];
						$data['FaReturDetail']['asset_detail_id'] 		= $asset_detail_id;
						$data['FaReturDetail']['asset_category_id'] 	= $assetDetail['AssetDetail']['asset_category_id'];
						$data['FaReturDetail']['date_of_purchase'] 		= $assetDetail['AssetDetail']['date_of_purchase'];
						$data['FaReturDetail']['code'] 					= $assetDetail['AssetDetail']['code'];
						$data['FaReturDetail']['name'] 					= $assetDetail['AssetDetail']['name'];
						$data['FaReturDetail']['item_code'] 			= $assetDetail['AssetDetail']['item_code'];
						$data['FaReturDetail']['brand'] 				= $assetDetail['AssetDetail']['brand'];
						$data['FaReturDetail']['type'] 					= $assetDetail['AssetDetail']['type'];
						$data['FaReturDetail']['color'] 				= $assetDetail['AssetDetail']['color'];
						$data['FaReturDetail']['serial_no'] 			= $assetDetail['AssetDetail']['serial_no'];
						$data['FaReturDetail']['notes'] 				= $this->data['FaReturDetail']['notes'];
						$this->FaReturDetail->create();
						$this->FaReturDetail->save($data);
						//update asset detail
						$this->FaReturDetail->query('update asset_details set ada="T" where asset_details.id="'.$asset_detail_id.'" ');
						//$this->FaReturDetail->AssetDetail->set('ada', 'T');
						//$this->FaReturDetail->AssetDetail->save();
					}
				}
				
				$this->Session->setFlash(__('The Fa Retur detail has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('controller'=>'fa_returs','action' => 'view', $this->Session->read('FaRetur.id')));
			}
		}
		$faRetur = $this->FaReturDetail->FaRetur->read(null, $this->Session->read('FaRetur.id') );
		$fa_retur_no = $faRetur['FaRetur']['no'];
		$assetDetailSelecteds =$faRetur['FaReturDetail'];
		$department_id = $faRetur['FaRetur']['department_id'];
		$faReturs = $this->FaReturDetail->FaRetur->find('list');
		$assetDetails = $this->FaReturDetail->AssetDetail->find('list');
		$assetCategories = $this->FaReturDetail->AssetCategory->find('list');
		$asset_details = $this->FaReturDetail->AssetDetail->find('all', 
			array('conditions'=>array('AssetDetail.department_id'=>$department_id, array('AssetDetail.ada'=>'Y',
			'OR'=>array(array('AssetDetail.name LIKE'=>'%'.$name.'%'), array('AssetDetail.code LIKE' => '%'.$name.'%'))))));
		
		$this->set(compact('faReturs', 'assetDetails', 'assetCategories', 'fa_retur_no', 'faRetur', 'asset_details', 'assetDetailSelecteds'));

		$this->FaReturDetail->recursive = 0;
		$this->set('faReturDetails', $this->paginate());

	}

	function edit($id = null) {
		$msg = '';
		
		if($this->is_ajax)
		{
			$this->data=$_POST;
			$this->layout='ajax';
			$this->autoRender=false;
			$fieldName = $this->data['editorId'];
			$value = str_replace(',','',$this->data['value']);
			list($fieldName,$id)=explode('.',$fieldName);
			
			$this->data = $this->FaReturDetail->read(null, $id);
			$this->data['FaReturDetail'][$fieldName] = $value;
			$this->data['FaReturDetail']['id'] = $id;
		}
	
		/* if (!$id && empty($this->data)) {
			$this->flash(sprintf(__('Invalid fa retur detail', true)), array('action' => 'index'));
		} */
		if (!$id && empty($this->data)) {
			if($this->is_ajax)
			{
				$msg = __('Invalid fa retur detail', true);
			}
			else
			{
				$this->Session->setFlash(__('Invalid fa retur detail', true));
				$this->redirect(array('action' => 'index'));
			}
		}
		/* if (!empty($this->data)) {
			if ($this->FaReturDetail->save($this->data)) {
				$this->flash(__('The fa retur detail has been saved.', true), array('action' => 'index'));
			} else {
			}
		} */
		if (!empty($this->data)) {
			if ($this->FaReturDetail->save($this->data)) {
				if($this->is_ajax)
				{
					$msg = __('The fa retur detail has been saved', true);
				}
				else
				{
					$this->Session->setFlash(__('The fa retur detail has been saved', true), 'default', array('class'=>'ok'));
					$this->redirect(array('controller'=>'fa_returs','action' => 'view', $this->Session->read('FaRetur.id')));
				}
			} else {
				if($this->is_ajax)
				{
					$msg = __('The fa retur detail could not be saved. Please, try again.', true);
				}
				else
				{
					$this->Session->setFlash(__('The fa retur detail could not be saved. Please, try again.', true));
				}
			}
		}
		//if (empty($this->data)) {
			$this->data = $this->FaReturDetail->read(null, $id);
		//}
		if($this->is_ajax)
		{
			if($fieldName=='brand' || $fieldName=='color' || $fieldName=='type' || $fieldName=='serial_no' )
			{
				echo $this->data['FaReturDetail'][$fieldName];
			}/*  else {
				echo number_format($this->data['PoDetail'][$fieldName],0);
			}
			 */
		}
		else
		{
			$faReturs = $this->FaReturDetail->FaRetur->find('list');
			$assetDetails = $this->FaReturDetail->AssetDetail->find('list');
			$assetCategories = $this->FaReturDetail->AssetCategory->find('list');
			$this->set(compact('faReturs', 'assetDetails', 'assetCategories'));
		}
	}
	
	function ajax_edit($id )
	{
		$this->is_ajax=true;
		$this->edit($id );
	}

	function delete($id = null) {
		if (!$id) {
			$this->flash(sprintf(__('Invalid fa retur detail', true)), array('action' => 'index'));
		}
		if ($this->FaReturDetail->delete($id)) {
			$this->flash(__('Fa retur detail deleted', true), array('action' => 'index'));
		}
		$this->flash(__('Fa retur detail was not deleted', true), array('action' => 'index'));
		$this->redirect(array('action' => 'index'));
	}
}
?>