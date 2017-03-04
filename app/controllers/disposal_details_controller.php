<?php
class DisposalDetailsController extends AppController {

	var $name = 'DisposalDetails';
	var $helpers = array('Ajax', 'Javascript', 'Time');
	var $components = array('RequestHandler');

	function index() {
		$this->DisposalDetail->recursive = 0;
		$this->paginate = array('order'=>'DisposalDetail.id');
		$this->set('disposalDetails', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid disposal detail', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('disposalDetail', $this->DisposalDetail->read(null, $id));
	}

	function add() {
		$name = array();
                list($date_start, $date_end) = $this->set_date_filters('AssetDetail');

		if (!empty($this->data)) 
		{
			if(isset($this->data['DisposalDetail']['search_keyword']))
			{
				$name = $this->data['DisposalDetail']['search_keyword'];
			}
			else
			{
				//delete semua record berdasarkan session disposal id
				$this->DisposalDetail->deleteAll(array('disposal_id' => $this->Session->read('Disposal.id')));
				
				if(isset($this->data['DisposalDetail']['asset_detail_id']))
				{
				
					foreach ($this->data['DisposalDetail']['asset_detail_id']  as $j=>$asset_detail_id)
					{
						$assetDetailOrig = $this->DisposalDetail->AssetDetail->read(null, $asset_detail_id);
                                                $assetDetailWithDeprAmount = $this->DisposalDetail->AssetDetail->Asset->_calculateDepr('AssetDetail', array($assetDetailOrig), $date_start, $date_end);
                                                $assetDetail = $assetDetailWithDeprAmount[0];

						$data['DisposalDetail']['disposal_id'] 			= $this->data['DisposalDetail']['disposal_id'];
						$data['DisposalDetail']['sales_amount'] 		= $this->data['DisposalDetail']['sales_amount'][$j];
						$data['DisposalDetail']['loss_profit_amount'] 	= $this->data['DisposalDetail']['sales_amount'][$j] - $assetDetail['AssetDetail']['book_value'];
						$data['DisposalDetail']['price'] 				= $assetDetail['AssetDetail']['price'];
						$data['DisposalDetail']['book_value'] 			= $assetDetail['AssetDetail']['book_value'];
						$data['DisposalDetail']['accum_dep'] 			= $assetDetail['AssetDetail']['depthnini'];
						$data['DisposalDetail']['date_of_purchase'] 	= $assetDetail['AssetDetail']['date_of_purchase'];
						$data['DisposalDetail']['notes'] 				= $this->data['DisposalDetail']['notes'];
						$data['DisposalDetail']['asset_detail_id'] 		= $asset_detail_id;
						$data['DisposalDetail']['asset_category_id'] 	= $assetDetail['AssetDetail']['asset_category_id'];
						$data['DisposalDetail']['item_code'] 			= $assetDetail['AssetDetail']['item_code'];
						$data['DisposalDetail']['code'] 				= $assetDetail['AssetDetail']['code'];
						$data['DisposalDetail']['name'] 				= $assetDetail['AssetDetail']['name'];
						$data['DisposalDetail']['brand'] 				= $assetDetail['AssetDetail']['brand'];
						$data['DisposalDetail']['type'] 				= $assetDetail['AssetDetail']['type'];
						$data['DisposalDetail']['serial_no'] 			= $assetDetail['AssetDetail']['serial_no'];
						$this->DisposalDetail->create();
						$this->DisposalDetail->save($data);
					}
				}
				
				$this->Session->setFlash(__('The disposal detail has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('controller'=>'disposals','action' => 'view', $this->Session->read('Disposal.id')));
			}
		}
		
		$disposal = $this->DisposalDetail->Disposal->read(null, $this->Session->read('Disposal.id') );
		$assetDetailSelecteds =$disposal['DisposalDetail'];
		$department_id = $disposal['Disposal']['department_id'];
		$business_type_id = $disposal['Disposal']['business_type_id'];
		$cost_center_id = $disposal['Disposal']['cost_center_id'];
		$dis_no = $disposal['Disposal']['no'];
		
		$conditions = "AssetDetail.department_id = '".$department_id."'
				and AssetDetail.business_type_id = '".$business_type_id."' 
				and AssetDetail.cost_center_id = '".$cost_center_id."'
				and AssetDetail.ada = 'Y' ";
				
		if($name){
			$conditions .= "and (AssetDetail.name LIKE '%{$name}%'
				or AssetDetail.code LIKE '%{$name}%') ";
		}
		
		$asset_details_data = $this->DisposalDetail->AssetDetail->find('all', 
			array('conditions' => $conditions));		

                $asset_details = $this->DisposalDetail->AssetDetail->Asset->_calculateDepr('AssetDetail', $asset_details_data, $date_start, $date_end);

		$this->set(compact('disposal', 'dis_no','asset_details','assetDetailSelecteds'));
		
		$this->DisposalDetail->recursive = 0;
		$this->set('disposalDetails', $this->paginate());
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid disposal detail', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->DisposalDetail->save($this->data)) {
				$this->Session->setFlash(__('The disposal detail has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The disposal detail could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->DisposalDetail->read(null, $id);
		}
		$disposals = $this->DisposalDetail->Disposal->find('list');
		$assetDetails = $this->DisposalDetail->AssetDetail->find('list');
		$this->set(compact('disposals', 'assetDetails'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for disposal detail', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->DisposalDetail->delete($id)) {
			$this->Session->setFlash(__('Disposal detail deleted', true), 'default', array('class'=>'ok'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Disposal detail was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function sales_report()
	{
		$this->detail_report('sales');
		$moduleName = 'Report > Fixed Assets > FA Sales Report';
		$this->set('title_for_layout',  $this->lastSegment($moduleName));
		$this->set(compact('moduleName'));
	}
	
	function write_off_report()
	{
		$this->detail_report('write_off');
		$moduleName = 'Report > Fixed Assets > FA Write Off Report';
		$this->set('title_for_layout',  $this->lastSegment($moduleName));
		$this->set(compact('moduleName'));
	}
	
	function detail_report($type)
	{
		$id_group=$this->Session->read('Security.permissions');
		$dep_id = $this->Session->read('Userinfo.department_id');
		$layout=$this->data['DisposalDetail']['layout'];
		$this->DisposalDetail->recursive = 2;
		$conditions=array();
		//debug($this->data);
		if(!empty($this->data))
		{
			if($this->data['CostCenter']['name'] == '')
			$this->data['DisposalDetail']['cost_center_id'] = null;
			$this->Session->write('DisposalDetail.asset_category_id', $this->data['DisposalDetail']['asset_category_id']);
			$this->Session->write('DisposalDetail.asset_category_type_id', $this->data['DisposalDetail']['asset_category_type_id']);
			$this->Session->write('DisposalDetail.is_inventory', $this->data['DisposalDetail']['is_inventory']);
			$this->Session->write('Disposal.department_id', $this->data['DisposalDetail']['department_id']);
			$this->Session->write('Disposal.business_type_id', $this->data['DisposalDetail']['business_type_id']);
			$this->Session->write('Disposal.cost_center_id', $this->data['DisposalDetail']['cost_center_id']);
		}
		$min_asset_value = $this->configs['min_asset_value'];
		if (!$this->Session->check('DisposalDetail.is_inventory'))
		$this->Session->write('DisposalDetail.is_inventory', 3);

		if ($this->Session->read('DisposalDetail.is_inventory') == 1)
			  $conditions[] = array('DisposalDetail.price <' => $min_asset_value);
		else if ($this->Session->read('DisposalDetail.is_inventory') == 2)
			  $conditions[] = array('DisposalDetail.price >' => $min_asset_value);
		else if ($this->Session->read('DisposalDetail.is_inventory') == 3)
			  $conditions[] = array('DisposalDetail.price >' => 0);

		if($this->Session->read('DisposalDetail.asset_category_id'))
			$conditions[]=array('DisposalDetail.asset_category_id'=>$this->Session->read('DisposalDetail.asset_category_id'));
		
		$conditions[]=array('Disposal.disposal_status_id'=>status_disposal_finish_id);
		
		if($id_group==normal_user_group_id || $id_group==branch_head_group_id) {
			$conditions[]=array('Disposal.department_id'=>$dep_id);
		} else if($this->Session->read('Disposal.department_id')) {
			$conditions[]=array('Disposal.department_id'=>$this->Session->read('Disposal.department_id'));
		}
		if($this->Session->read('Disposal.business_type_id')) {
			$conditions[]=array('Disposal.business_type_id'=>$this->Session->read('Disposal.business_type_id'));
		}
		if($this->Session->read('Disposal.cost_center_id')) {
			$conditions[]=array('Disposal.cost_center_id'=>$this->Session->read('Disposal.cost_center_id'));
		}
		
		///date fileter		
		list($date_start,$date_end) = $this->set_date_filters('DisposalDetail');
		$conditions[] = array('Disposal.doc_date >=' => ($date_start['year'] . '-' . $date_start['month'] . '-' . $date_start['day']) , 
				'Disposal.doc_date <=' => ($date_end['year'] . '-' . $date_end['month'] . '-' . $date_end['day']) );
				
		$conditions[] = array('disposal_type_id'=> ($type=='write_off'?type_disposal_write_off_id:type_disposal_sales_id) );
		
		if($layout=='pdf' || $layout=='xls'){
		$con = $this->DisposalDetail->find('all', array('conditions'=>$conditions));
			}else{
		$con = $this->paginate($conditions);
		}
		$this->set('disposalDetails', $con);
		
		$departments 			= $this->DisposalDetail->AssetDetail->Department->find('list');
		$businessType 			= $this->DisposalDetail->AssetDetail->BusinessType->find('list');
		$costCenters 			= $this->DisposalDetail->AssetDetail->CostCenter->find('list');
		$cost_Centers 			= $this->DisposalDetail->AssetDetail->CostCenter->find('list', array('fields'=>'name'));
		//$cc 			= $this->DisposalDetail->query('select a.id,a.name,b.t24_dao from cost_centers a left join cost_center_to_daos b on b.cost_center_id = a.id where a.remarks = "Y" order by a.name');
		//foreach($cc as $data){
		//	if($data[0]['t24_dao']){
		//		$costCenters[ $data[0]['id'] ]	= $data[0]['name'] . " - " .$data[0]['t24_dao'];
		//	}else{
		//		$costCenters[ $data[0]['id'] ]	= $data[0]['name'];
		//	}				
		//}
		$copyright_id 			= $this->configs['copyright_id'];
		$assetCategoryTypes 	= $this->DisposalDetail->AssetDetail->AssetCategory->AssetCategoryType->find('list',array('conditions'=>array('AssetCategoryType.id !=' => 2)));
		$assetCategories 		= $this->DisposalDetail->AssetDetail->AssetCategory->find('list', array('conditions'=>array('asset_category_type_id'=>$this->Session->read('DisposalDetail.asset_category_type_id'))));
		$assetCategory	 		= $this->DisposalDetail->AssetDetail->AssetCategory->find('list');
		
		$this->set(compact(
			'disposalDetails', 'costCenters', 'cost_Centers',
			'po_statuses', 'businessType',
			'departments', 'copyright_id',
			'date_start','date_end',
			'assetCategoryTypes','assetCategories',
			'assetCategory'
			));		
		if($layout=='pdf')
		{
			Configure::write('debug',0); // Otherwise we cannot use this method while developing 
			$this->layout = 'pdf'; //this will use the pdf.ctp layout 
			$this->render(''.$type.'_report_pdf'); 		
		}
		else if($layout=='xls')
		{
		$this->render(''.$type.'_report_xls','export_xls');		

		}
	}
}
?>