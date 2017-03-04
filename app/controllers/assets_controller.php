<?php
App::import('Model','Item');
App::import('Model','AssetDetail');
App::import('Model','AssetCategory');

class AssetsController extends AppController {

      var $name = 'Assets';
      var $helpers = array('Number', 'Ajax', 'Javascript');
      var $components = array('RequestHandler');
      var $is_ajax = false;

	function index() {
		$this->Asset->recursive = 0;
		$moduleName = 'Asset > List Asset';
		$this->set('title_for_layout',  $this->lastSegment($moduleName));
		$layout = 'Screen';
		
            if (!empty($this->data)) {
				if($this->data['CostCenter']['name'] == '')
				$this->data['Asset']['cost_center_id'] = null;
                $this->Session->write('AssetReport.department_id', $this->data['Asset']['department_id']);
                //$this->Session->write('AssetReport.department_sub_id',$this->data['Asset']['department_sub_id']);
                //$this->Session->write('AssetReport.department_unit_id',$this->data['Asset']['department_unit_id']);
                $this->Session->write('AssetReport.business_type_id', $this->data['Asset']['business_type_id']);
                $this->Session->write('AssetReport.cost_center_id', $this->data['Asset']['cost_center_id']);
				$this->Session->write('AssetReport.source', $this->data['Asset']['source']);
				$this->Session->write('AssetReport.efektif', $this->data['Asset']['efektif']);
                $this->Session->write('AssetReport.asset_category_id', $this->data['Asset']['asset_category_id']);
                $this->Session->write('AssetReport.is_inventory', $this->data['Asset']['is_inventory']);
                $this->Session->write('AssetReport.asset_category_type_id', $this->data['Asset']['asset_category_type_id']);
				$this->Session->write('AssetReport.name', $this->data['Asset']['search_keyword']);
				$layout = $this->data['Asset']['layout'];
            }
            if (!$this->Session->check('AssetReport.is_inventory'))
                  $this->Session->write('AssetReport.is_inventory', 3);
            if (!$this->Session->check('AssetReport.asset_category_type_id'))
                  $this->Session->write('AssetReport.asset_category_type_id', 1);
            $conditions = array();
            $min_asset_value = $this->Asset->min_asset_value = $this->configs['min_asset_value'];
            $asset_category_type_id = $this->Session->read('AssetReport.asset_category_type_id');			
			
            $group_id = $this->Session->read('Security.permissions');
            $dep_id = $this->Session->read('Userinfo.department_id');
			
            if ($group_id == normal_user_group_id || $group_id == branch_head_group_id)//normal
                  $conditions = array(
                      'Asset.department_id' => $dep_id,
                  );
            else if ($department_id = $this->Session->read('AssetReport.department_id'))
                  $conditions['Asset.department_id'] = $department_id;

            if ($business_type_id = $this->Session->read('AssetReport.business_type_id'))
                  $conditions['Asset.business_type_id'] = $business_type_id;
            if ($cost_center_id = $this->Session->read('AssetReport.cost_center_id'))
                  $conditions['Asset.cost_center_id'] = $cost_center_id;
				  
			if ($source = $this->Session->read('AssetReport.source'))
                  $conditions[] = array('Asset.source LIKE' => '%' . $source . '%') ;
				  
			if ($this->Session->read('AssetReport.efektif') == 'yes')
                  $conditions[] = array('Asset.date_start !=' => null, 'Asset.date_end !=' => null);
            else if ($this->Session->read('AssetReport.efektif') == 'no')
                  $conditions[] = array('Asset.date_start' => null, 'Asset.date_end' => null);
            else if ($this->Session->read('AssetReport.efektif') == 'all')
                  $conditions[] = array();

            if ($asset_category_id = $this->Session->read('AssetReport.asset_category_id'))
                $conditions['Asset.asset_category_id'] = $asset_category_id;
            else
                $conditions['AssetCategory.asset_category_type_id'] = $asset_category_type_id;

            if ($this->Session->read('AssetReport.is_inventory') == 1)
                  $conditions[] = array('Asset.price <' => $min_asset_value);
            else if ($this->Session->read('AssetReport.is_inventory') == 2)
                  $conditions[] = array('Asset.price >' => $min_asset_value);
            else if ($this->Session->read('AssetReport.is_inventory') == 3)
                  $conditions[] = array('Asset.price >' => 0);
				  
			$name = $this->Session->read('AssetReport.name');
            $conditions[] = array('OR' => array('Asset.name LIKE' => '%' . $name . '%', 
										        'Asset.item_code LIKE' => '%' . $name . '%',
												'Asset.code LIKE' => '%' . $name . '%'));
            //ada='Y'
            $conditions[] = array('Asset.ada' => 'Y');

			//$this->paginate = array('order'=>'Asset.id DESC');
            list($date_start, $date_end) = $this->set_date_filters('Asset');

			//filter asset yang date_of_purchase nya kurang dari date_end
            $conditions[] = array('Asset.date_of_purchase <=' => $date_end['year']. '-' . $date_end['month']. '-' . 15);
			
			//filter asset yang date_of_purchase_start dan date_of_purchase_end
			list($date_of_purchase_start, $date_of_purchase_end) = $this->set_date_filters_for_report('Asset');
            $conditions[] = array('Asset.date_of_purchase >=' => ($date_of_purchase_start['year'] . '-' . $date_of_purchase_start['month'] . '-' . $date_of_purchase_start['day']),
                'Asset.date_of_purchase <=' => ($date_of_purchase_end['year'] . '-' . $date_of_purchase_end['month'] . '-' . $date_of_purchase_end['day']));
			
			
            if ($layout == 'Screen') {
				$this->paginate = array('order'=>'Asset.id');
				$assets = $this->paginate($conditions);
				$assets = $this->Asset->_calculateDepr('Asset', $assets, $date_start, $date_end);
			}
            else if ($layout == 'pdf' || $layout == 'xls') {
				$assets = $this->Asset->find('all', array('conditions' => $conditions ,'order'=>'Asset.id'));
				$assets = $this->Asset->_calculateDepr('Asset', $assets, $date_start, $date_end);
				//$assetTotals 			= $this->Asset->findTotalsFromArray($assets);
            }
            
			$this->set('assets', $assets);
			//$assetTotals 			= $this->Asset->findTotals($conditions);
			
            $year = $date_end['year'];
            $copyright_id = $this->configs['copyright_id'];
            $departments = $this->Asset->Department->find('list');
            //$departmentSub		= $this->Asset->Department->DepartmentSub->find('list', array('conditions'=>array('department_id'=>$department_id))) ;
            //$departmentUnit		= $this->Asset->Department->DepartmentUnit->find('list', array('conditions'=>array('department_sub_id'=>$department_sub_id))) ;
            $businessType = $this->Asset->BusinessType->find('list');
            $location = $this->Asset->Location->find('list');
            $costCenter = $this->Asset->CostCenter->find('list');
            $costCenters = $this->Asset->CostCenter->find('list', array('fields' => 'name'));
			$cc 			= $this->Asset->query('select ccs.id, ccd.t24_dao, ccs.name from cost_centers ccs
													left join cost_center_to_daos ccd 
													on ccd.cost_center_id = ccs.id
													where ccs.remarks = "Y"');
			foreach($cc as $data){
				$costCenterToDao[ $data[0]['id'] ]	= $data[0]['t24_dao'] . " - " .$data[0]['name'];
			}
            $assetCategoryTypes = $this->Asset->AssetCategory->AssetCategoryType->find('list', array('conditions' => array('AssetCategoryType.id !=' => 2)));
            $assetCategories = $this->Asset->AssetCategory->find('list', array('conditions' => array('asset_category_type_id' => $asset_category_type_id)));	
            $this->set(compact('departments', 'copyright_id', 'assetCategories', 'date_end',
				'costCenters', 'source', 'efektif', 'assetCategoryTypes', 'year', 'businessType', 'costCenter', 'min_asset_value', 'location', 'departmentSub', 'departmentUnit',
            	'assetTotals', 'moduleName', 'department_id', 'business_type_id', 'date_of_purchase_start', 'date_of_purchase_end' , 'costCenterToDao'));

            if ($layout == 'pdf') {
                  Configure::write('debug', 0); // Otherwise we cannot use this method while developing 
                  $this->layout = 'pdf'; //this will use the pdf.ctp layout 
                  $this->render('index_pdf');
            } else if ($layout == 'xls') {
                  $this->render('index_xls', 'export_xls');
            }
      }

      function view($id = null) {	
            if (!$id) {
                  $this->Session->setFlash(__('Invalid asset', true));
                  $this->redirect(array('action' => 'index'));
            }
			$asset = $this->Asset->read(null, $id);
			$asset_categories	= $this->Asset->AssetCategory->find('list', array('conditions' => array('is_asset' => 1)));
			$this->Session->write('Asset.id', $id);
            $this->set('asset', $asset);
            //$assetDetails = $this->Asset->AssetDetail->find('list');
            $this->set('assetCategories', $asset_categories);
            $this->set('departmentsub', $this->Asset->Department->DepartmentSub->find('list'));
            $this->set('departmentunit', $this->Asset->Department->DepartmentUnit->find('list'));
		}
		
	function ajax_add2() {
		$group_id = $this->Session->read('Security.permissions');
		$this->Asset->recursive = 0;
		$this->autoRender = false;
		$msg = '';
		$asset = null;
		
		if (!empty($this->data)) {
			$this->Asset->create();
			$purchase_id = $this->data['Asset']['purchase_id'] = $this->Session->read('Purchase.id');
			$purchase = $this->Asset->Purchase->read(null, $purchase_id);
			
			$res = $this->Asset->query("SELECT request_type_id FROM PURCHASES WHERE id = '".$this->Session->read('Purchase.id')."'");
			$reqTypeId	= $res[0][0]['request_type_id'];
			  
			$data_details = array();
			$Item = new Item;
			$item = $Item->read(null, $this->data['Asset']['item_id']);;
			$this->data['Asset']['item_code'] = $item['Item']['code'];
			$this->data['Asset']['name'] = $item['Item']['name'];
			$qty = $this->data['Asset']['qty'];
			$price = $this->data['Asset']['price'];
			
			$date_of_purchase = $this->data['Asset']['date_of_purchase']['year'].'-'.$this->data['Asset']['date_of_purchase']['month'].'-'.$this->data['Asset']['date_of_purchase']['day'].' 00:00:00';
			
			$code = $this->Asset->getNewId($this->data['Asset']['asset_category_id'], $date_of_purchase, $this->data['Asset']['department_id'], $this->data['Asset']['item_code']);
			$umurek = $this->data['Asset']['umurek'];
			
			if($this->data['Asset']['brand']=='' || $this->data['Asset']['brand']==' '){
				$this->data['Asset']['brand']= '-';
			}
			if($this->data['Asset']['type']=='' || $this->data['Asset']['type']==' '){
				$this->data['Asset']['type']= '-';
			}
			if($this->data['Asset']['color']=='' || $this->data['Asset']['color']==' '){
				$this->data['Asset']['color']= '-';
			}
			$this->data['Asset']['code'] = $code;
			$this->data['Asset']['amount'] = $qty * $price;
			  
			$this->data['Asset']['depbln'] = $qty * $price / $umurek / 12;

			$this->data['Asset']['amount_cur'] = $qty * $this->data['Asset']['price_cur'];
			$this->data['Asset']['amount'] = $qty * $price;
			$this->data['Asset']['thnlalu'] = 0;
			$this->data['Asset']['blnlalu'] = 0;
			$this->data['Asset']['blnini'] = 1;
			$this->data['Asset']['jthnlalu'] = 0;
			$this->data['Asset']['jblnlalu'] = 0;
			$this->data['Asset']['jblnini'] = 0;
			$this->data['Asset']['hpthnini'] = 0;
			$this->data['Asset']['hpthnlalu'] = 0;
			$this->data['Asset']['hpblnlalumasuk'] = 0;
			$this->data['Asset']['hpblnlalukeluar'] = 0;
			$this->data['Asset']['depthnlalu'] = 0;
			$this->data['Asset']['ada'] = 'T';
			$maksi = $this->data['Asset']['maksi'] = $umurek * 12;
			$this->data['Asset']['date_of_purchase'] = $date_of_purchase;
			list($year, $m, $d) = explode('-', $date_of_purchase);
			$this->data['Asset']['year'] = $year;
			if ($this->Asset->save($this->data)) {
				$data_details['AssetDetail'] = $this->data['Asset'];
				$asset_id = $this->Asset->id;
				$assetDetail = new AssetDetail;
				
				$categoryId = $this->data['Asset']['asset_category_id'];
				$res = $this->Asset->query('select asset_category_type_id from asset_categories where id = "'.$categoryId.'"');
				$categoryTypeId = $res[0][0]['asset_category_type_id'];
				
				for ($i = 0; $i < $qty; $i++) {
					
					$data_details['AssetDetail']['asset_id'] = $asset_id;
					$data_details['AssetDetail']['code'] = $assetDetail->getNewId($data_details['AssetDetail']['asset_category_id'], $data_details['AssetDetail']['date_of_purchase'], $data_details['AssetDetail']['department_id'], $data_details['AssetDetail']['item_code']);

					$data_details['AssetDetail']['depbln'] = $data_details['AssetDetail']['price'] / $umurek / 12;

					$data_details['AssetDetail']['asset_category_type_id'] = $categoryTypeId;
					 
					$assetDetail->create();
					$assetDetail->save($data_details);
				}
				
					$status = 'ok';
					$msg = __('The asset has been saved', true);
					$asset = $this->Asset->read(null, $this->Asset->id);
					$count = $this->Asset->find('count', array('conditions' => array('Asset.purchase_id' => $purchase_id)));
			} else {
				$status = 'failed';
				$count = 0;
				$msg = __('The asset could not be saved. Please, try again.', true);
			}
		}
		echo json_encode(array('status' => $status, 'msg' => $msg, 'data' => $asset, 'count' => $count));
	}	

	function add() {
		$asset = null;
		$count = 0;
		$this->Asset->recursive = 0;
		if ($this->is_ajax) {
			$this->layout = 'ajax';
			$this->autoRender = false;
		}

		if (!empty($this->data)) {
			
			$res = $this->Asset->query("SELECT request_type_id FROM PURCHASES WHERE id = '".$this->Session->read('Purchase.id')."'");
			$reqTypeId	= $res[0][0]['request_type_id'];
				
			$data_details = array();
			$purchase = $this->Asset->Purchase->read(null, $this->Session->read('Purchase.id'));
			$Item = new Item;
			$item = $Item->read(null, $this->data['Asset']['item_id']);;
			$this->data['Asset']['item_code'] = $item['Item']['code'];
			$this->data['Asset']['name'] = $item['Item']['name'];
			$qty = $this->data['Asset']['qty'];
			$price = $this->data['Asset']['price'];
			$purchase_id = $this->data['Asset']['purchase_id'];
			$date_of_purchase = $this->data['Asset']['date_of_purchase']['year'].'-'.$this->data['Asset']['date_of_purchase']['month'].'-'.$this->data['Asset']['date_of_purchase']['day'].' 00:00:00';
			
			$code = $this->Asset->getNewId($this->data['Asset']['asset_category_id'], $date_of_purchase, $this->data['Asset']['department_id'], $this->data['Asset']['item_code']);
			$umurek = $this->data['Asset']['umurek'];
			
			if($reqTypeId == request_type_fa_it_id){
				$this->data['Asset']['konfigurasi'] = $this->data['Asset']['konfigurasi'];
			}else{
				$this->data['Asset']['konfigurasi'] = null;
			}
			
			if($this->data['Asset']['brand']=='' || $this->data['Asset']['brand']==' '){
				$this->data['Asset']['brand']= '-';
			}
			if($this->data['Asset']['type']=='' || $this->data['Asset']['type']==' '){
				$this->data['Asset']['type']= '-';
			}
			if($this->data['Asset']['color']=='' || $this->data['Asset']['color']==' '){
				$this->data['Asset']['color']= '-';
			}
			$this->data['Asset']['code'] = $code;
			$this->data['Asset']['amount'] = $qty * $price;
			  
			$this->data['Asset']['depbln'] = $qty * $price / $umurek / 12;

			$this->data['Asset']['amount_cur'] = $qty * $this->data['Asset']['price_cur'];
			$this->data['Asset']['amount'] = $qty * $price;
			$this->data['Asset']['thnlalu'] = 0;
			$this->data['Asset']['blnlalu'] = 0;
			$this->data['Asset']['blnini'] = 1;
			$this->data['Asset']['jthnlalu'] = 0;
			$this->data['Asset']['jblnlalu'] = 0;
			$this->data['Asset']['jblnini'] = 0;
			$this->data['Asset']['hpthnini'] = 0;
			$this->data['Asset']['hpthnlalu'] = 0;
			$this->data['Asset']['hpblnlalumasuk'] = 0;
			$this->data['Asset']['hpblnlalukeluar'] = 0;
			$this->data['Asset']['depthnlalu'] = 0;
			$this->data['Asset']['ada'] = 'T';
			$maksi = $this->data['Asset']['maksi'] = $umurek * 12;
			$this->data['Asset']['date_of_purchase'] = $date_of_purchase;
			list($year, $m, $d) = explode('-', $date_of_purchase);
			$this->data['Asset']['year'] = $year;
			//$this->data['Asset']['date_start'] = $purchase['Purchase']['date_of_purchase'];
			//$this->data['Asset']['date_end'] = date('Y-m-d', strtotime('+ ' . ($maksi - 1) . ' months', strtotime($purchase['Purchase']['date_of_purchase'])));

			$categoryId = $this->data['Asset']['asset_category_id'];
			$res = $this->Asset->query('select asset_category_type_id from asset_categories where id = "'.$categoryId.'"');
			$categoryTypeId = $res[0][0]['asset_category_type_id'];
			 
			//asset master...
			$this->Asset->create();

			if ($this->Asset->save($this->data)) {
				//asset details...
				$data_details['AssetDetail'] = $this->data['Asset'];
				$asset_id = $this->Asset->id;
				$assetDetail = new AssetDetail;
				
				for ($i = 0; $i < $qty; $i++) {
					
					$data_details['AssetDetail']['asset_id'] = $asset_id;
					$data_details['AssetDetail']['code'] = $assetDetail->getNewId($data_details['AssetDetail']['asset_category_id'], $data_details['AssetDetail']['date_of_purchase'], $data_details['AssetDetail']['department_id'], $data_details['AssetDetail']['item_code']);

					$data_details['AssetDetail']['depbln'] = $data_details['AssetDetail']['price'] / $umurek / 12;

					$data_details['AssetDetail']['category_type_id'] = $categoryTypeId;
					 
					$assetDetail->create();
					$assetDetail->save($data_details);
				}

				//redirect back
				if (!$this->is_ajax) {
					$this->Session->setFlash(__('The asset and asset details has been saved', true), 'default', array('class' => 'ok'));
					$this->redirect(array('controller' => 'purchases', 'action' => 'view', $purchase_id));
				} else {
					$asset = $this->Asset->read(null, $this->Asset->id);
					$count = $this->Asset->find('count', array('conditions' => array('Asset.purchase_id' => $purchase_id)));
					$msg = __('The asset and asset details has been saved', true);
					$status = 'ok';
					echo json_encode(array('status' => $status, 'msg' => $msg, 'data' => $asset, 'count' => $count));
				}
			} else {
				if (!$this->is_ajax) {
					$this->Session->setFlash(__('The asset could not be saved. Please, try again.', true));
				} else {
					$msg = __('The asset could not be saved. Please, try again.', true);
					$status = 'failed';
				}
			}
		}
		
		if (!$this->is_ajax) {
			$purchase_id = !empty($this->params['pass'][0]) ? $this->params['pass'][0] : $this->data['Asset']['purchase_id'];
			$purchases = $this->Asset->Purchase->findById($purchase_id);
			$assetCategories = $this->Asset->AssetCategory->find('list', array('conditions' => array('is_asset' => 1)));
			$assetCategoryTypes = $this->Asset->AssetCategory->AssetCategoryType->find('list', array('conditions' => array('AssetCategoryType.id !=' => 2)));
			$currencies = $this->Asset->Currency->find('list');
			$this->set(compact('purchases', 'assetCategories', 'currencies','assetCategoryTypes'));
		} else {
			echo json_encode(array('status' => $status, 'msg' => $msg, 'data' => $asset, 'count' => $count));
		}
	}

	function ajax_add() {
		$this->is_ajax = true;
		$this->add();
	}

      function edit($id = null) {
            if (!$id && empty($this->data)) {
                  $this->Session->setFlash(__('Invalid asset', true));
                  $this->redirect(array('action' => 'index'));
            }
            if (!empty($this->data)) {
                  $this->Asset->id = $id;

                  //update to AssetDetail where assetdetail.asset_id=asset.id
                  $this->update_assetDetails();

                  if ($this->Asset->save($this->data)) {

                        $this->Session->setFlash(__('The asset has been saved', true), 'default', array('class' => 'ok'));
                        if ($purchase_id = $this->Session->read('Purchase.id'))
                              $this->redirect(array('controller' => 'purchases', 'action' => 'view', $purchase_id));
                        else
                              $this->redirect(array('action' => 'index'));
                  } else {
                        $this->Session->setFlash(__('The asset could not be saved. Please, try again.', true));
                  }
            }

            if (empty($this->data)) {
                  $this->data = $this->Asset->read(null, $id);
            }
            $purchases = $this->Asset->Purchase->find('list');
            $assetCategories = $this->Asset->AssetCategory->find('list', array('conditions' => array('is_asset' => 1)));
            $currencies = $this->Asset->Currency->find('list');
            $locations = $this->Asset->Location->find('list');
            $departments = $this->Asset->Department->find('list');
            $businessType = $this->Asset->BusinessType->find('list');
            $costCenter = $this->Asset->CostCenter->find('list');
            $this->set(compact('purchases', 'assetCategories', 'currencies', 'locations', 'departments', 'costCenter', 'businessType'));
      }
	  
	  function update_assetDetails() {
            $asst_id = $this->Session->read('Asset.id');
            //$this->Asset->id=$id;

            $sql = 'update asset_details set 
				name				="' . $this->data['Asset']['name'] . '" ,
				business_type_id	="' . $this->data['Asset']['business_type_id'] . '" ,
				cost_center_id		="' . $this->data['Asset']['cost_center_id'] . '" ,
				brand				="' . $this->data['Asset']['brand'] . '" ,
				type				="' . $this->data['Asset']['type'] . '" ,
				color				="' . $this->data['Asset']['color'] . '" ,
				location_id			="' . $this->data['Asset']['location_id'] . '"
				where asset_id="' . $asst_id . '" ';
            $this->Asset->query($sql);
      }
	  
	  function editEconomicAge($id = null) {
            if (!$id && empty($this->data)) {
                  $this->Session->setFlash(__('Invalid asset', true));
                  $this->redirect(array('action' => 'index'));
            }
            if (!empty($this->data)) {
                  $this->Asset->id = $id;

                  //update to AssetDetail where assetdetail.asset_id=asset.id
                  $this->update_assetDetailsEA();

                  if ($this->Asset->save($this->data)) {

                        $this->Session->setFlash(__('The asset has been saved', true), 'default', array('class' => 'ok'));
                        if ($purchase_id = $this->Session->read('Purchase.id'))
                              $this->redirect(array('controller' => 'purchases', 'action' => 'view', $purchase_id));
                        else
                              $this->redirect(array('action' => 'index'));
                  } else {
                        $this->Session->setFlash(__('The asset could not be saved. Please, try again.', true));
                  }
            }

            if (empty($this->data)) {
                  $this->data = $this->Asset->read(null, $id);
            }
      }
	  
	  function update_assetDetailsEA() {
            $asst_id = $this->Session->read('Asset.id');
            //$this->Asset->id=$id;

			//var_dump($this->data['Asset']);die();
			
            $sql = 'update asset_details set 
				umurek				= "' . $this->data['Asset']['umurek'] . ' " 
				 where asset_id="' . $this->data['Asset']['id'] . '" ';
            $this->Asset->query($sql);
      }

      function delete($id = null) {
            if (!$id) {
                $this->Session->setFlash(__('Invalid id for asset', true));
                $this->redirect(array('action' => 'index'));
            }
            if ($this->Asset->delete($id, true)) {
                $purchaseId = $this->Session->read('Purchase.id');
                $this->Session->setFlash(__('Asset deleted', true), 'default', array('class' => 'ok'));
                $this->redirect(array('controller' => 'purchases', 'action' => 'view', $purchaseId));
            }
            $this->Session->setFlash(__('Asset was not deleted', true));
            $this->redirect(array('action' => 'index'));
      }

      function reports($type='depr') {
			$layout = 'Screen' ; //default
            if (!empty($this->data)) {
 				if($this->data['CostCenter']['name'] == '')
					$this->data['Asset']['cost_center_id'] = null;
				
				  $this->Session->write('AssetReport.department_id', $this->data['Asset']['department_id']);
                  $this->Session->write('AssetReport.business_type_id', $this->data['Asset']['business_type_id']);
                  $this->Session->write('AssetReport.cost_center_id', $this->data['Asset']['cost_center_id']);
				  $this->Session->write('AssetReport.source', $this->data['Asset']['source']);
				  $this->Session->write('AssetReport.efektif', $this->data['Asset']['efektif']);
                  //$this->Session->write('AssetReport.department_sub_id',$this->data['Asset']['department_sub_id']);
                  //$this->Session->write('AssetReport.department_unit_id',$this->data['Asset']['department_unit_id']);
                  $this->Session->write('AssetReport.asset_category_id', $this->data['Asset']['asset_category_id']);
                  $this->Session->write('AssetReport.is_inventory', $this->data['Asset']['is_inventory']);
                  $this->Session->write('AssetReport.asset_category_type_id', $this->data['Asset']['asset_category_type_id']);
                  $this->Session->write('AssetReport.name', $this->data['Asset']['search_keyword']);
				  $layout = $this->data['Asset']['layout'];
            }
            $this->Asset->recursive = 1;
            $min_asset_value = $this->Asset->min_asset_value = $this->configs['min_asset_value'];

            $conditions = array();
			
			/***************************************************
			asset_category_type_id
			****************************************************/
            if (!$this->Session->check('AssetReport.is_inventory'))
                  $this->Session->write('AssetReport.is_inventory', 3);
			if(!$this->Session->check('AssetReport.asset_category_type_id'))
				$this->Session->write('AssetReport.asset_category_type_id' ,1);
            $asset_category_type_id = $this->Session->read('AssetReport.asset_category_type_id');

            $group_id = $this->Session->read('Security.permissions');
            $dep_id = $this->Session->read('Userinfo.department_id');
			
            if ($group_id == normal_user_group_id || $group_id == branch_head_group_id)//normal
                  $conditions = array(
                      'Asset.department_id' => $dep_id,
                  );
            else if ($department_id = $this->Session->read('AssetReport.department_id'))
                  $conditions['Asset.department_id'] = $department_id;
				  
            if ($department_sub_id = $this->Session->read('AssetReport.department_sub_id'))
                  $conditions['Asset.department_sub_id'] = $department_sub_id;
            if ($department_unit_id = $this->Session->read('AssetReport.department_unit_id'))
                  $conditions['Asset.department_unit_id'] = $department_unit_id;

            if ($business_type_id = $this->Session->read('AssetReport.business_type_id'))
                  $conditions['Asset.business_type_id'] = $business_type_id;
            if ($cost_center_id = $this->Session->read('AssetReport.cost_center_id'))
                  $conditions['Asset.cost_center_id'] = $cost_center_id;
				  
			if ($source = $this->Session->read('AssetReport.source'))
                  $conditions[] = array('Asset.source LIKE' => '%' . $source . '%') ;
				  
			if ($this->Session->read('AssetReport.efektif') == 'yes')
                  $conditions[] = array('Asset.date_start !=' => null, 'Asset.date_end !=' => null);
            else if ($this->Session->read('AssetReport.efektif') == 'no')
                  $conditions[] = array('Asset.date_start' => null, 'Asset.date_end' => null);
            else if ($this->Session->read('AssetReport.efektif') == 'all')
                  $conditions[] = array();

            if ($asset_category_id = $this->Session->read('AssetReport.asset_category_id'))
                  $conditions['Asset.asset_category_id'] = $asset_category_id;
            else
                  $conditions['AssetCategory.asset_category_type_id'] = $asset_category_type_id;

            if ($this->Session->read('AssetReport.is_inventory') == 1)
                  $conditions[] = array('Asset.price <' => $min_asset_value);
            else if ($this->Session->read('AssetReport.is_inventory') == 2)
                  $conditions[] = array('Asset.price >' => $min_asset_value);
            else if ($this->Session->read('AssetReport.is_inventory') == 3)
                  $conditions[] = array('Asset.price >' => 0);

			$name = $this->Session->read('AssetReport.name');
            $conditions[] = array('OR' => array('Asset.name LIKE' => '%' . $name . '%', 
										        'Asset.item_code LIKE' => '%' . $name . '%',
												'Asset.code LIKE' => '%' . $name . '%'));				  
            //ada='Y'
            $conditions[] = array('Asset.ada' => 'Y');

            list($date_start, $date_end) = $this->set_date_filters('Asset');
            
			$periode = date("M Y", strtotime($date_end['year'] . '-'. $date_end['month'] . '-'. (isset($date_end['day'])? $date_end['day'] : '01') ) );
            $this->Session->write('AssetReport.periode', $periode);
			$conditions[] = array('Asset.date_of_purchase <=' => $date_end['year']. '-' . $date_end['month']. '-' . 15);
			
			//filter asset yang date_of_purchase_start dan date_of_purchase_end
			list($date_of_purchase_start, $date_of_purchase_end) = $this->set_date_filters_for_report('Asset');
            $conditions[] = array('Asset.date_of_purchase >=' => ($date_of_purchase_start['year'] . '-' . $date_of_purchase_start['month'] . '-' . $date_of_purchase_start['day']),
                'Asset.date_of_purchase <=' => ($date_of_purchase_end['year'] . '-' . $date_of_purchase_end['month'] . '-' . $date_of_purchase_end['day']));
			
            $departments = $this->Asset->Department->find('list');
            //$departmentSub = $this->Asset->Department->DepartmentSub->find('list', array('conditions' => array('department_id' => $department_id)));
            $departmentUnit = $this->Asset->Department->DepartmentUnit->find('list', array('conditions' => array('department_sub_id' => $department_sub_id)));
            $departmentUnit = $this->Asset->Department->DepartmentUnit->find('list', array('conditions' => array('department_sub_id' => $department_sub_id)));
            $businessType = $this->Asset->BusinessType->find('list');
            $costCenter = $this->Asset->CostCenter->find('list');
            $costCenters = $this->Asset->CostCenter->find('list', array('fields' => 'name'));
			//$cc 			= $this->Asset->query('select cost_centers, name from cost_centers where organization_level = "SUB GROUP"');
			//foreach($cc as $data){
			//	$costCenters[ $data[0]['cost_centers'] ]	= $data[0]['cost_centers'] . " - " .$data[0]['name'];
			//}
            $assetCategoryTypes = $this->Asset->AssetCategory->AssetCategoryType->find('list', array('conditions' => array('AssetCategoryType.id !=' => 2)));
            $assetCategories = $this->Asset->AssetCategory->find('list', array('conditions' => array('asset_category_type_id' => $asset_category_type_id)));
            $copyright_id = $this->configs['copyright_id'];
			
            if ($layout == 'Screen') {
				$this->paginate = array('order'=>'Asset.id');
                $assets = $this->paginate($conditions);
                $assets = $this->Asset->_calculateDepr('Asset', $assets, $date_start, $date_end);
            }
            else if ($layout == 'pdf' || $layout == 'xls') {
				$assets = $this->Asset->find('all', array('conditions' => $conditions, 'order'=>'Asset.id'));
				$assets = $this->Asset->_calculateDepr('Asset', $assets, $date_start, $date_end);
				//$assetTotals = $this->Asset->findTotals($conditions);
				//$assetTotals = $this->Asset->findTotalsFromArray($assets);
            }

			$moduleName = 'Report > Fixed Assets > Monthly Depreciation Report';
			$this->set('title_for_layout',  $this->lastSegment($moduleName));
            $this->set(compact('assetTotals', 'copyright_id', 'assets', 'departments', 'date_end', 
				'assetCategories', 'assetCategoryTypes', 'min_asset_value', 'departmentSub', 
					'departmentUnit', 'businessType', 'costCenter', 'source', 'efektif', 'costCenters', 'moduleName', 'date_of_purchase_start', 'date_of_purchase_end'));


            if ($layout == 'pdf') {
                  Configure::write('debug', 0); // Otherwise we cannot use this method while developing 
                  $this->layout = 'pdf'; //this will use the pdf.ctp layout 
                  $this->render('depr_pdf');
            } else if ($layout == 'xls')
                  $this->render('depr_xls', 'export_xls');
            else
                  $this->render($type);
      }

      function get_depr_year() {
		$assetCategory = new AssetCategory;
		$assetCategory->recursive = 0;

		if (!empty($this->data)) {
                if (!empty($this->data['Asset']['asset_category_id'])){
                    $this->set('asset_category', $assetCategory->findById($this->data['Asset']['asset_category_id']));
				}
                else if (!empty($this->data['InvoiceDetail']['asset_category_id']))
                    $this->set('asset_category', $this->Asset->AssetCategory->findById($this->data['InvoiceDetail']['asset_category_id']));
                else if (!empty($this->data['NpbDetail']['asset_category_id']))
                    $this->set('asset_category', $this->Asset->AssetCategory->findById($this->data['NpbDetail']['asset_category_id']));
                else if (!empty($this->data['PoDetail']['asset_category_id']))
				    $this->set('asset_category', $assetCategory->findById($this->data['PoDetail']['asset_category_id']));
            }
      }

      function get_currency() {
            if (!empty($this->data)) {
                if (!empty($this->data['Asset']['currency_id']))
                    $this->set('currency', $this->Asset->Currency->findById($this->data['Asset']['currency_id']));
                else if (!empty($this->data['InvoiceDetail']['currency_id']))
                    $this->set('currency', $this->Asset->Currency->findById($this->data['InvoiceDetail']['currency_id']));
                else if (!empty($this->data['NpbDetail']['currency_id']))
                    $this->set('currency', $this->Asset->Currency->findById($this->data['NpbDetail']['currency_id']));
                else if (!empty($this->data['PoDetail']['currency_id']))
                    $this->set('currency', $this->Asset->Currency->findById($this->data['PoDetail']['currency_id']));
            }
      }

      /****************************************************\
        hitung depresiasi,
        patokan untuk bulan ini
        \*************************************************** */

    function process_depr() {
            //new process method:
            // find all asset
            // calculate deprt
            // save to asset
            // exit;
			
			
			//update asset yg qty = 0
			
            $this->Asset->recursive=-1;
            $cond = array(
			//'Asset.price >' => $this->configs['min_asset_value'],
			'Asset.posting'=>0, 
			'Asset.date_start !=' => null, //tidak sama dengan null sekali harus di puter kan.............
			//'Asset.date_start <='=>date('Y-m-15 23:59:59'), // yang tanggal start lebih dari periode bulan ini , yaitu tgl 15 setiap bulan
			//'Asset.date_end  >='=>date('Y-m-31 23:59:59'), // masih berlaku  di bulan ini
            'Asset.ada'=>'Y');
			
            $date_start = array('year'=>date('Y') , 'month'=>date('m') , 'day'=>1 );// , mktime(0,0,0,date('m')-1, date('d'), date('Y')));
            $date_end   = array('year'=>date('Y') , 'month'=>date('m') , 'day'=>date('d') );
			$min_asset_value = $this->configs['min_asset_value'];
            
            //calculate assets
            $assetsNonDepr = $this->Asset->find('all', array('conditions'=>$cond, 'order'=>'Asset.id'));
            foreach($assetsNonDepr as $a)
            {            
				$asset = $this->Asset->_calculateDeprMontly('Asset', $a, $date_start, $date_end, $min_asset_value);
				$this->Asset->id = $asset['Asset']['id'];
				if(!$this->Asset->save($asset)){
                    debug('cannot save assets ' . $a['Asset']['id']);  
                }
            }
            
            
            /// now calculate asset details
            // $cond = array(
			//'AssetDetail.price >' => $this->configs['min_asset_value'],
			//'AssetDetail.posting'=>0, 
			//'AssetDetail.date_start !=' => null, //tidak sama dengan null
			//'AssetDetail.date_start <='=>date('Y-m-15 23:59:59'), // yang tanggal start lebih dari periode bulan ini , yaitu tgl 15 setiap bulan
			//'AssetDetail.date_end  >='=>date('Y-m-31 23:59:59'), // masih berlaku  di bulan ini
            //'AssetDetail.ada'=>'Y');	    
			//$assetDetailsNonDepr = $this->Asset->AssetDetail->find('all', array('conditions'=>$cond));
            //$assetDetails = $this->Asset->_calculateDepr('AssetDetail', $assetDetailsNonDepr, $date_start, $date_end);
			//foreach($assetDetails as $a)
			//{            
            //	if(!$this->Asset->AssetDetail->save($a))
            //  {
			//  	debug('cannot save asset_details ' . $a['AssetDetail']['id']);  
            //  }
            //} 
 
            //return;
            
	}

     /*  function find() {
            if (!empty($this->data)) {
                  $this->Session->write('Asset.department_id', $this->data['Asset']['department_id']);
                  $this->Session->write('Asset.business_type_id', $this->data['Asset']['business_type_id']);
                  $this->Session->write('Asset.cost_center_id', $this->data['Asset']['cost_center_id']);
                  //$this->Session->write('Asset.department_sub_id', $this->data['Asset']['department_sub_id']);
                  //$this->Session->write('Asset.department_unit_id', $this->data['Asset']['department_unit_id']);
                  $this->Session->write('Asset.asset_category_id', $this->data['Asset']['asset_category_id']);
                  $this->Session->write('Asset.name', $this->data['Asset']['search_keyword']);
                
            }
            $cons = array();
            $layout = $this->data['Asset']['layout'];
            if ($asset_category_id = $this->Session->read('Asset.asset_category_id'))
                  $cons[] = array('Asset.asset_category_id' => $asset_category_id);
            if ($department_id = $this->Session->read('Asset.department_id'))
                  $cons[] = array('Asset.department_id' => $department_id);
            if ($department_sub_id = $this->Session->read('Asset.department_sub_id'))
                  $cons[] = array('Asset.department_sub_id' => $department_sub_id);
            if ($department_unit_id = $this->Session->read('Asset.department_unit_id'))
                  $cons[] = array('Asset.department_unit_id' => $department_unit_id);

            if ($business_type_id = $this->Session->read('Asset.business_type_id'))
                  $cons[] = array('Asset.business_type_id' => $business_type_id);
            if ($cost_center_id = $this->Session->read('Asset.cost_center_id'))
                  $cons[] = array('Asset.cost_center_id' => $cost_center_id);
			$name = $this->Session->read('Asset.name');
            $cons[] = array('OR' => array('Asset.name LIKE' => '%' . $name . '%',
										  'Asset.code LIKE' => '%' . $name . '%',
										  'Asset.item_code LIKE' => '%' . $name . '%'
										  ));
            list($date_start, $date_end) = $this->set_date_filters('Asset');
			
			//ada='Y'
            $cons[] = array('Asset.ada' => 'Y');

            $cons[] = array('Asset.date_of_purchase <=' => $date_end['year']. '-' . $date_end['month']. '-' . 15);

            $this->Asset->recursive = 1;
///		$this->set('assets', $this->paginate($cons));
            if ($layout == 'pdf' || $layout == 'xls') {
                  $assets = $this->Asset->find('all', array('conditions' => $cons));
            } else {
                  $assets = $this->paginate($cons);
            }
            $assets = $this->Asset->_calculateDepr('Asset', $assets, $date_start, $date_end);
			
			$assetTotals 			= $this->Asset->findTotals($cons);
			
            $this->set('assets', $assets);
            $this->set('warranties', $this->Asset->Warranty->find('list'));
            $this->set('departments', $this->Asset->Department->find('list'));
            $this->set('departmentSub', $this->Asset->Department->DepartmentSub->find('list', array('conditions' => array('department_id' => $department_id))));
            $this->set('departmentUnit', $this->Asset->Department->DepartmentUnit->find('list', array('conditions' => array('department_sub_id' => $department_sub_id))));
            $this->set('assetCategories', $this->Asset->AssetCategory->find('list', array('conditions' => array('asset_category_type_id !=' => 2))));
            $copyright_id = $this->configs['copyright_id'];
            $businessType = $this->Asset->BusinessType->find('list');
            $location = $this->Asset->Location->find('list');
            $costCenter = $this->Asset->CostCenter->find('list');
            $costCenters = $this->Asset->CostCenter->find('list', array('fields' => 'name'));
			//$cc 			= $this->Asset->query('select cost_centers, name from cost_centers where organization_level = "SUB GROUP"');
			//foreach($cc as $data){
			//	$costCenters[ $data[0]['cost_centers'] ]	= $data[0]['cost_centers'] . " - " .$data[0]['name'];
			//}
			$moduleName = 'Fixed Assets > Find Asset';
			$this->set('title_for_layout',  $this->lastSegment($moduleName));
            $this->set(compact('copyright_id', 'businessType', 'costCenter', 'location', 'costCenters', 'assetTotals', 'moduleName'));

            if ($layout == 'pdf') {
                  Configure::write('debug', 0); // Otherwise we cannot use this method while developing 
                  $this->layout = 'pdf'; //this will use the pdf.ctp layout 
                  $this->render('find_pdf');
            } else if ($layout == 'xls') {
                  $this->render('find_xls', 'export_xls');
            }
      } */

      function process() {
			if($this->Session->read('Security.permissions') == fincon_group_id){
            $depreciation_warning = $this->configs['depreciation_warning'];
			$moduleName = 'Report > Fixed Assets > Process Depreciation';
			$this->set('title_for_layout',  $this->lastSegment($moduleName));
            $this->set(compact('depreciation_warning', 'moduleName'));
			}else{
				$this->redirect(array('action'=>'index'));
			}
      }
	  
      function auto_complete_reklass() {
			$this->Asset->recursive = -1;
			$date = null;
            //$this->set('assets', $this->Asset->find('all', array('conditions' => "Asset.date_start != '{$date}' and price >= 5000000 and
            //$this->set('assets', $this->Asset->find('all', array('conditions' => "
			//$this->set('assets', $this->Asset->find('all', array('conditions' => "Asset.date_start != '{$date}' and
			$this->set('assets', $this->Asset->find('all', array('conditions' => "Asset.date_start is not null and
					(Asset.name LIKE '%{$this->data['Asset']['name']}%'
					or Asset.code LIKE '%{$this->data['Asset']['name']}%')
				"))
            );
            $this->layout = "ajax";
      }

}

?>