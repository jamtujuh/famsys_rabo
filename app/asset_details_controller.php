<?php

App::import('Model', 'Po');
App::import('Model', 'Invoice');
App::import('Model', 'Movement');
App::import('Model', 'MovementDetail');
App::import('Model', 'ImportAssetDetail');
App::import('Model', 'Disposal');
App::import('Model', 'FaSupplierRetur');
App::import('Model', 'FaRetur');

class AssetDetailsController extends AppController {

      var $name = 'AssetDetails';
      var $helpers = array('Number', 'Ajax', 'Javascript');
      var $components = array('RequestHandler');

      function index() {
            $this->AssetDetail->recursive = 1;
            if (!empty($this->data)) {
                  $this->Session->write('AssetReport.department_id', $this->data['AssetDetail']['department_id']);
                  //$this->Session->write('AssetReport.department_sub_id',$this->data['Asset']['department_sub_id']);
                  //$this->Session->write('AssetReport.department_unit_id',$this->data['Asset']['department_unit_id']);
                  $this->Session->write('AssetReport.business_type_id', $this->data['AssetDetail']['business_type_id']);
                  $this->Session->write('AssetReport.cost_center_id', $this->data['AssetDetail']['cost_center_id']);
                  $this->Session->write('AssetReport.is_inventory', $this->data['AssetDetail']['is_inventory']);
                  $this->Session->write('AssetReport.asset_category_id', $this->data['AssetDetail']['asset_category_id']);
                  $this->Session->write('AssetReport.asset_category_type_id', $this->data['AssetDetail']['asset_category_type_id']);
            }
            if (!$this->Session->check('AssetReport.is_inventory'))
                  $this->Session->write('AssetReport.is_inventory', 2);
            if (!$this->Session->check('AssetReport.asset_category_type_id'))
                  $this->Session->write('AssetReport.asset_category_type_id', 1);
            $min_asset_value = $this->AssetDetail->min_asset_value = $this->configs['min_asset_value'];
            $layout = $this->data['AssetDetail']['layout'];
            $conditions = array();

            $asset_category_type_id = $this->Session->read('AssetReport.asset_category_type_id');
            $group_id = $this->Session->read('Security.permissions');
            $dep_id = $this->Session->read('Userinfo.department_id');

            if ($group_id == normal_user_group_id || $group_id == branch_head_group_id)//normal
                  $conditions = array(
                      'Asset.department_id' => $dep_id,
                  );
            else if ($department_id = $this->Session->read('AssetReport.department_id'))
                  $conditions['AssetDetail.department_id'] = $department_id;

            /* if($department_sub_id = $this->Session->read('AssetReport.department_sub_id')) 
              $conditions['AssetDetail.department_sub_id']		= $department_sub_id;
              if($department_unit_id = $this->Session->read('AssetReport.department_unit_id'))
              $conditions['AssetDetail.department_unit_id']		= $department_unit_id; */

            if ($business_type_id = $this->Session->read('AssetReport.business_type_id'))
                  $conditions['AssetDetail.business_type_id'] = $business_type_id;
            if ($cost_center_id = $this->Session->read('AssetReport.cost_center_id'))
                  $conditions['AssetDetail.cost_center_id'] = $cost_center_id;

            if ($asset_category_id = $this->Session->read('AssetReport.asset_category_id'))
                  $conditions['AssetDetail.asset_category_id'] = $asset_category_id;
            else
                  $conditions['AssetCategory.asset_category_type_id'] = $asset_category_type_id;

            //ada='Y'
            $conditions[] = array('AssetDetail.ada' => 'Y');

            list($date_start, $date_end) = $this->set_date_filters('AssetDetail');

            if ($this->Session->read('AssetReport.is_inventory') == 1)
                  $conditions[] = array('AssetDetail.price <' => $min_asset_value);
            else if ($this->Session->read('AssetReport.is_inventory') == 2)
                  $conditions[] = array('AssetDetail.price >' => $min_asset_value);
            else if ($this->Session->read('AssetReport.is_inventory') == 3)
                  $conditions[] = array('AssetDetail.price >' => 0);
            if ($layout == 'pdf' || $layout == 'xls') {
                  $con = $this->AssetDetail->find('all', array('conditions' => $conditions));
            } else {
                  $con = $this->paginate($conditions);
            }
            $this->set('assetDetails', $con);
            
			$assetDetailTotals 			= $this->AssetDetail->findTotals($conditions);
            

            $year = $date_end['year'];
            $copyright_id = $this->configs['copyright_id'];
            $departments = $this->AssetDetail->Department->find('list');
            //$departmentSub		= $this->AssetDetail->Department->DepartmentSub->find('list', array('conditions'=>array('department_id'=>$department_id))) ;
            //$departmentUnit		= $this->AssetDetail->Department->DepartmentUnit->find('list', array('conditions'=>array('department_sub_id'=>$department_sub_id))) ;
            $businessType = $this->AssetDetail->BusinessType->find('list');
            $costCenter = $this->AssetDetail->CostCenter->find('list');
            $costCenters = $this->AssetDetail->CostCenter->find('list', array('fields' => 'name'));
            $purchase = $this->AssetDetail->Purchase->find('list');
            $location = $this->AssetDetail->Location->find('list');
            $assetCategoryTypes = $this->AssetDetail->AssetCategory->AssetCategoryType->find('list', array('conditions' => array('AssetCategoryType.id !=' => 2)));
            $assetCategories = $this->AssetDetail->AssetCategory->find('list', array('conditions' => array('asset_category_type_id' => $asset_category_type_id)));
            $this->set(compact('departments', 'copyright_id', 'assetCategories', 'purchase', 'assetCategoryTypes', 'costCenters', 'year', 'businessType', 'costCenter', 'min_asset_value', 'location', 'departmentSub', 'departmentUnit',
	            'assetDetailTotals'));

            if ($layout == 'pdf') {
                  Configure::write('debug', 0); // Otherwise we cannot use this method while developing 
                  $this->layout = 'pdf'; //this will use the pdf.ctp layout 
                  $this->render('index_pdf');
            } else if ($layout == 'xls') {
                  $this->render('index_xls', 'export_xls');
            }
      }

      function label() {
            $name = array();
            $year = $this->Session->read('AssetReport.year');
            $layout = $this->data['AssetDetail']['layout'];
            if (empty($year))
                  $this->Session->write('AssetReport.year', date('Y'));
            $cons = array();
            if (!empty($this->data)) {
                  $this->Session->write('AssetDetail.department_id', $this->data['AssetDetail']['department_id']);
                  $this->Session->write('AssetDetail.business_type_id', $this->data['AssetDetail']['business_type_id']);
                  $this->Session->write('AssetDetail.cost_center_id', $this->data['AssetDetail']['cost_center_id']);
                  //$this->Session->write('AssetDetail.department_sub_id', $this->data['AssetDetail']['department_sub_id']);
                  //$this->Session->write('AssetDetail.department_unit_id', $this->data['AssetDetail']['department_unit_id']);
                  $this->Session->write('AssetDetail.asset_category_id', $this->data['AssetDetail']['asset_category_id']);
                  $name = $this->data['AssetDetail']['search_keyword'];
            }

            $name = $this->data['AssetDetail']['search_keyword'];

            $cons = array();
            if ($asset_category_id = $this->Session->read('AssetDetail.asset_category_id'))
                  $cons[] = array('AssetDetail.asset_category_id' => $asset_category_id);
            if ($department_id = $this->Session->read('AssetDetail.department_id'))
                  $cons[] = array('AssetDetail.department_id' => $department_id);
            if ($department_sub_id = $this->Session->read('AssetDetail.department_sub_id'))
                  $cons[] = array('AssetDetail.department_sub_id' => $department_sub_id);
            if ($department_unit_id = $this->Session->read('AssetDetail.department_unit_id'))
                  $cons[] = array('AssetDetail.department_unit_id' => $department_unit_id);

            if ($business_type_id = $this->Session->read('AssetDetail.business_type_id'))
                  $cons[] = array('AssetDetail.business_type_id' => $business_type_id);
            if ($cost_center_id = $this->Session->read('AssetDetail.cost_center_id'))
                  $cons[] = array('AssetDetail.cost_center_id' => $cost_center_id);

            $cons[] = array('OR' => array('AssetDetail.name LIKE' => '%' . $name . '%', array('AssetDetail.code LIKE' => '%' . $name . '%')));
            $this->AssetDetail->recursive = 0;
            if ($layout == 'pdf' || $layout == 'xls') {
                  $con = $this->AssetDetail->find('all', array('conditions' => $cons));
            } else if ($layout == 'view_barcode') {
                  $cons[] = array('AssetDetail.id in(' . implode(',', $this->data['AssetDetail']['id']) . ')');
                  $con = $this->AssetDetail->find('all', array('conditions' => $cons));
            } else {
                  $con = $this->paginate($cons);
            }
            $this->set('assetDetails', $con);
            $this->set('departments', $this->AssetDetail->Department->find('list'));
            $this->set('departmentSub', $this->AssetDetail->Department->DepartmentSub->find('list', array('conditions' => array('department_id' => $department_id))));
            $this->set('departmentUnit', $this->AssetDetail->Department->DepartmentUnit->find('list', array('conditions' => array('department_sub_id' => $department_sub_id))));
            $this->set('businessType', $this->AssetDetail->BusinessType->find('list'));
            $this->set('costCenter', $this->AssetDetail->CostCenter->find('list'));
            $this->set('costCenters', $this->AssetDetail->CostCenter->find('list', array('fields' => 'name')));
            $this->set('assetCategories', $this->AssetDetail->AssetCategory->find('list', array('conditions' => array('is_asset' => 1))));
            $copyright_id = $this->configs['copyright_id'];
            $this->set(compact('copyright_id'));
            if ($layout == 'pdf') {
                  Configure::write('debug', 0); // Otherwise we cannot use this method while developing 
                  $this->layout = 'pdf'; //this will use the pdf.ctp layout 
                  $this->render('label_pdf');
            } else if ($layout == 'xls') {
                  $this->render('label_xls', 'export_xls');
            } else if ($layout == 'view_barcode') {
                  Configure::write('debug', 0); // Otherwise we cannot use this method while developing 
                  $this->layout = 'pdf'; //this will use the pdf.ctp layout 
                  $this->render('view_barcode-2-col');
            }
      }

      function check() {
            $name = array();
            $year = $this->Session->read('AssetReport.year');
            $layout = $this->data['AssetDetail']['layout'];
            if (empty($year))
                  $this->Session->write('AssetReport.year', date('Y'));
            $cons = array();
            if (!empty($this->data)) {
                  //if(!empty($this->data['AssetDetail']['id'])) {
                  //$data['AssetDetail']['id']	= $this->data['AssetDetail']['id'];
                  //$data['AssetDetail']['check_physical']	= 1;
                  //$this->AssetDetail->save($data);
                  //} else {
                  $this->Session->write('AssetDetail.department_id', $this->data['AssetDetail']['department_id']);
                  $this->Session->write('AssetDetail.business_type_id', $this->data['AssetDetail']['business_type_id']);
                  $this->Session->write('AssetDetail.cost_center_id', $this->data['AssetDetail']['cost_center_id']);
                  //$this->Session->write('AssetDetail.department_sub_id', $this->data['AssetDetail']['department_sub_id']);
                  //$this->Session->write('AssetDetail.department_unit_id', $this->data['AssetDetail']['department_unit_id']);
                  $this->Session->write('AssetDetail.asset_category_id', $this->data['AssetDetail']['asset_category_id']);
                  $name = $this->data['AssetDetail']['search_keyword'];
                  //}
            }
            $name = $this->data['AssetDetail']['search_keyword'];
            $cons = array();
            if ($asset_category_id = $this->Session->read('AssetDetail.asset_category_id'))
                  $cons[] = array('AssetDetail.asset_category_id' => $asset_category_id);
            if ($department_id = $this->Session->read('AssetDetail.department_id'))
                  $cons[] = array('AssetDetail.department_id' => $department_id);
            if ($department_sub_id = $this->Session->read('AssetDetail.department_sub_id'))
                  $cons[] = array('AssetDetail.department_sub_id' => $department_sub_id);
            if ($department_unit_id = $this->Session->read('AssetDetail.department_unit_id'))
                  $cons[] = array('AssetDetail.department_unit_id' => $department_unit_id);

            if ($business_type_id = $this->Session->read('AssetDetail.business_type_id'))
                  $cons[] = array('AssetDetail.business_type_id' => $business_type_id);
            if ($cost_center_id = $this->Session->read('AssetDetail.cost_center_id'))
                  $cons[] = array('AssetDetail.cost_center_id' => $cost_center_id);

            $cons[] = array('OR' => array('AssetDetail.name LIKE' => '%' . $name . '%', array('AssetDetail.code LIKE' => '%' . $name . '%')));
            $this->AssetDetail->recursive = 0;
            if ($layout == 'pdf' || $layout == 'xls') {
                  $con = $this->AssetDetail->find('all', array('conditions' => $cons));
            } else {
                  $con = $this->paginate($cons);
            }
            $this->set('assetDetails', $con);
            $copyright_id = $this->configs['copyright_id'];
            $this->set(compact('copyright_id'));
            $this->set('departments', $this->AssetDetail->Department->find('list'));
            $this->set('departmentSub', $this->AssetDetail->Department->DepartmentSub->find('list', array('conditions' => array('department_id' => $department_id))));
            $this->set('departmentUnit', $this->AssetDetail->Department->DepartmentUnit->find('list', array('conditions' => array('department_sub_id' => $department_sub_id))));
            $this->set('businessType', $this->AssetDetail->BusinessType->find('list'));
            $this->set('costCenter', $this->AssetDetail->CostCenter->find('list'));
            $this->set('costCenters', $this->AssetDetail->CostCenter->find('list', array('fields' => 'name')));
            $this->set('assetCategories', $this->AssetDetail->AssetCategory->find('list', array('conditions' => array('is_asset' => 1))));

            if ($layout == 'pdf') {
                  Configure::write('debug', 0); // Otherwise we cannot use this method while developing 
                  $this->layout = 'pdf'; //this will use the pdf.ctp layout 
                  $this->render('check_pdf');
            } else if ($layout == 'xls') {
                  $this->render('check_xls', 'export_xls');
            }
      }

      function check_update() {
            //save asset_detail to check
            if (!empty($this->data)) {
                  foreach ($this->data['AssetDetail']['check_physical'] as $check_physical) {
                        $this->AssetDetail->query('update asset_details set check_physical=1 where asset_details.id="' . $check_physical . '" ');
                  }
            }
            $this->Session->setFlash(__('The asset detail has been checked', true), 'default', array('class' => 'ok'));
            $this->redirect(array('controller' => 'asset_details', 'action' => 'check'));
      }

      function view($id = null) {
            // if (!$id) {
            // $this->Session->setFlash(__('Invalid asset detail', true));
            // $this->redirect(array('action' => 'index'));
            // }
            // $this->set('assetDetail', $this->AssetDetail->read(null, $id));

            $this->redirect(array('controller' => 'asset_details', 'action' => 'history', $id));
      }

      function add() {
            if (!empty($this->data)) {
                  $this->AssetDetail->create();
                  if ($this->AssetDetail->save($this->data)) {
                        $this->Session->setFlash(__('The asset detail has been saved', true), 'default', array('class' => 'ok'));
                        $this->redirect(array('action' => 'index'));
                        if ($asset_id = $this->Session->read('Asset.id'))
                              $this->redirect(array('controller' => 'assets', 'action' => 'view', $asset_id));
                        else
                              $this->redirect(array('action' => 'index'));
                  } else {
                        $this->Session->setFlash(__('The asset detail could not be saved. Please, try again.', true));
                  }
            }
            $assets = $this->AssetDetail->Asset->find('list');
            $conditions = $this->AssetDetail->Condition->find('list');
            $locations = $this->AssetDetail->Location->find('list');
            $departments = $this->AssetDetail->Department->find('list');
            $this->set(compact('assets', 'conditions', 'locations', 'departments'));
      }

      function edit_sn($id) {
            if (!$id && empty($this->data)) {
                  $this->Session->setFlash(__('Invalid asset detail', true));
                  $this->redirect(array('action' => 'index'));
            }
            if (!empty($this->data)) {
                  if ($this->AssetDetail->save($this->data)) {
                        $this->Session->setFlash(__('The asset detail has been saved', true), 'default', array('class' => 'ok'));
                        if ($asset_id = $this->Session->read('Asset.id'))
                              $this->redirect(array('controller' => 'assets', 'action' => 'view', $asset_id));
                        else
                              $this->redirect(array('action' => 'index'));
                  } else {
                        $this->Session->setFlash(__('The asset detail could not be saved. Please, try again.', true));
                  }
            }
            if (empty($this->data)) {
                  $this->data = $this->AssetDetail->read(null, $id);
            }
            if ($department_id = $this->data['AssetDetail']['department_id']) {
                  
            }
            $assets = $this->AssetDetail->Asset->find('list');
            $conditions = $this->AssetDetail->Condition->find('list');
            $businessType = $this->AssetDetail->Asset->Department->BusinessType->find('list');
            $costCenter = $this->AssetDetail->Asset->CostCenter->find('list');
            $locations = $this->AssetDetail->Location->find('list');
            $departments = $this->AssetDetail->Department->find('list');
            $departmentsub = $this->AssetDetail->Department->DepartmentSub->find('list');
            $departmentunit = $this->AssetDetail->Department->DepartmentUnit->find('list');
            $this->set(compact('costCenter', 'assets', 'conditions', 'locations', 'departments', 'departmentsub', 'departmentunit', 'businessType', 'department_id'));
      }

      function edit($id = null) {
            if (!$id && empty($this->data)) {
                  $this->Session->setFlash(__('Invalid asset detail', true));
                  $this->redirect(array('action' => 'index'));
            }
            if (!empty($this->data)) {
                  if ($this->AssetDetail->save($this->data)) {
                        $this->Session->setFlash(__('The asset detail has been saved', true), 'default', array('class' => 'ok'));
                        if ($asset_id = $this->Session->read('Asset.id'))
                              $this->redirect(array('controller' => 'assets', 'action' => 'view', $asset_id));
                        else
                              $this->redirect(array('action' => 'index'));
                  } else {
                        $this->Session->setFlash(__('The asset detail could not be saved. Please, try again.', true));
                  }
            }
            if (empty($this->data)) {
                  $this->data = $this->AssetDetail->read(null, $id);
            }
            $assets = $this->AssetDetail->Asset->find('list');
            $conditions = $this->AssetDetail->Condition->find('list');
            $locations = $this->AssetDetail->Location->find('list');
            $departments = $this->AssetDetail->Department->find('list');
            $this->set(compact('assets', 'conditions', 'locations', 'departments'));
      }

      function delete($id = null) {
            if (!$id) {
                  $this->Session->setFlash(__('Invalid id for asset detail', true));
                  $this->redirect(array('action' => 'index'));
            }
            if ($this->AssetDetail->delete($id)) {
                  $this->Session->setFlash(__('Asset detail deleted', true), 'default', array('class' => 'ok'));
                  if ($asset_id = $this->Session->read('Asset.id'))
                        $this->redirect(array('controller' => 'assets', 'action' => 'view', $asset_id));
                  else
                        $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Asset detail was not deleted', true));
            $this->redirect(array('action' => 'index'));
      }

      function reports($type='detail_fa') {
            if (!empty($this->data)) {
                  $this->Session->write('AssetReport.department_id', $this->data['AssetDetail']['department_id']);
                  $this->Session->write('AssetReport.business_type_id', $this->data['AssetDetail']['business_type_id']);
                  $this->Session->write('AssetReport.cost_center_id', $this->data['AssetDetail']['cost_center_id']);
                  //$this->Session->write('AssetReport.department_sub_id',$this->data['AssetDetail']['department_sub_id']);
                  //$this->Session->write('AssetReport.department_unit_id',$this->data['AssetDetail']['department_unit_id']);
                  $this->Session->write('AssetReport.asset_category_id', $this->data['AssetDetail']['asset_category_id']);
                  $this->Session->write('AssetReport.is_inventory', $this->data['AssetDetail']['is_inventory']);
                  $this->Session->write('AssetReport.asset_category_type_id', $this->data['AssetDetail']['asset_category_type_id']);
            }
            if (!$this->Session->check('AssetReport.is_inventory'))
                  $this->Session->write('AssetReport.is_inventory', 2);

            $layout = $this->data['AssetDetail']['layout'];

            $this->AssetDetail->recursive = 0;

            $conditions = array();
            $min_asset_value = $this->AssetDetail->Asset->min_asset_value = $this->configs['min_asset_value'];

            if ($this->Session->read('AssetReport.is_inventory') == 1)
                  $conditions[] = array('AssetDetail.price <' => $min_asset_value);
            else if ($this->Session->read('AssetReport.is_inventory') == 2)
                  $conditions[] = array('AssetDetail.price >' => $min_asset_value);
            else if ($this->Session->read('AssetReport.is_inventory') == 3)
                  $conditions[] = array('AssetDetail.price >' => 0);

            $asset_category_type_id = $this->Session->read('AssetReport.asset_category_type_id');

            if ($department_id = $this->Session->read('AssetReport.department_id'))
                  $conditions['AssetDetail.department_id'] = $department_id;
            if ($department_sub_id = $this->Session->read('AssetReport.department_sub_id'))
                  $conditions['AssetDetail.department_sub_id'] = $department_sub_id;
            if ($department_unit_id = $this->Session->read('AssetReport.department_unit_id'))
                  $conditions['AssetDetail.department_unit_id'] = $department_unit_id;

            if ($cost_center_id = $this->Session->read('AssetReport.cost_center_id'))
                  $conditions['AssetDetail.cost_center_id'] = $cost_center_id;
            if ($business_type_id = $this->Session->read('AssetReport.business_type_id'))
                  $conditions['AssetDetail.business_type_id'] = $business_type_id;

            if ($asset_category_id = $this->Session->read('AssetReport.asset_category_id'))
                  $conditions['AssetDetail.asset_category_id'] = $asset_category_id;
			else
                  $conditions['AssetCategory.asset_category_type_id'] = $asset_category_type_id;
            //ada='Y'
            $conditions[] = array('AssetDetail.ada' => 'Y');

            list($date_start, $date_end) = $this->set_date_filters('AssetDetail');
            $periode = date("M Y", strtotime($date_end['year'] . '-' . $date_end['month'] . '-' . (isset($date_end['day']) ? $date_end['day'] : '01')));
            $this->Session->write('AssetReport.periode', $periode);

            $departments = $this->AssetDetail->Department->find('list');
            $departmentSub = $this->AssetDetail->Department->DepartmentSub->find('list', array('conditions' => array('department_id' => $department_id)));
            $departmentUnit = $this->AssetDetail->Department->DepartmentUnit->find('list', array('conditions' => array('department_sub_id' => $department_sub_id)));
            $businessType = $this->AssetDetail->BusinessType->find('list');
            $costCenter = $this->AssetDetail->CostCenter->find('list');
            $costCenters = $this->AssetDetail->CostCenter->find('list', array('fields' => 'name'));
            $assetCategoryTypes = $this->AssetDetail->AssetCategory->AssetCategoryType->find('list', array('conditions' => array('AssetCategoryType.id !=' => 2)));
            $assetCategories = $this->AssetDetail->AssetCategory->find('list', array('conditions' => array('asset_category_type_id' => 1)));

            if ($type == 'rekap') {
			
                  $param = array(
                      'conditions' => $conditions,
                      'order' => 'AssetDetail.asset_category_id',
                      'fields' => array(
                          'AssetDetail.asset_category_id',
                          'sum(AssetDetail.price) as price',
                          'sum(AssetDetail.depthnini) as depr'
                      ),
                      'group' => array('AssetDetail.asset_category_id'),
					  'joins'=>array(
							array(
								'table'=>'asset_categories',
								'alias'=>'AssetCategory',
								'conditions'=>array('AssetDetail.asset_category_id=AssetCategory.id'))
							),
                  );
				   $this->AssetDetail->recursive = -1;
                  $assets = $this->AssetDetail->find('all', $param);
				  //debug($assets);
            } elseif ($type == 'monthly_rekap') {
                  $param = array(
                      'conditions' => $conditions,
                       'order' => 'AssetDetail.asset_category_id',
                       'fields' => array(
                          'AssetDetail.asset_category_id',
                          'sum(AssetDetail.price) as price',
                          'sum(AssetDetail.depthnlalu) as depthnlalu',
                          'sum(AssetDetail.hpthnlalu - AssetDetail.depthnlalu) as bookthnlalu',
                          'sum(AssetDetail.depthnini) as depthnini',
                          'sum(AssetDetail.jan) as jan',
                          'sum(AssetDetail.feb) as feb',
                          'sum(AssetDetail.mar) as mar',
                          'sum(AssetDetail.apr) as apr',
                          'sum(AssetDetail.may) as may',
                          'sum(AssetDetail.jun) as jun',
                          'sum(AssetDetail.jul) as jul',
                          'sum(AssetDetail.aug) as aug',
                          'sum(AssetDetail.sep) as sep',
                          'sum(AssetDetail.oct) as oct',
                          'sum(AssetDetail.nov) as nov',
                          'sum(AssetDetail.dec) as dec'
                      ),
                      'group' => array('AssetDetail.asset_category_id'),
					  'joins'=>array(
							array(
								'table'=>'asset_categories',
								'alias'=>'AssetCategory',
								'conditions'=>array('AssetDetail.asset_category_id=AssetCategory.id'))
							),
                  );
				    $this->AssetDetail->recursive = -1;
                  $assets = $this->AssetDetail->find('all', $param);
            } else if ($type == 'movement') {
                  $this->_generateMovementReport($assetCategories);
                  $assets = null;
            } else if ($type == 'purchase') {
				$conditions[] = array('AssetDetail.date_of_purchase >=' => ($date_start['year'] . '-' . $date_start['month'] . '-' . $date_start['day']) , 
						'AssetDetail.date_of_purchase <=' => ($date_end['year'] . '-' . $date_end['month'] . '-' . $date_end['day']) );
			
                  if ($layout == 'pdf' || $layout == 'xls') {
                        $assets = $this->AssetDetail->find('all', array('conditions' => $conditions));
                  } else {
                        $assets = $this->paginate($conditions);
                  }
                  $assets = $this->AssetDetail->Asset->_calculateDepr('AssetDetail', $assets, $date_start, $date_end);
                  $assetDetailTotal = $this->AssetDetail->findTotals($conditions);
           } else { //default : detail_fa
                  if ($layout == 'pdf' || $layout == 'xls') {
                        $assets = $this->AssetDetail->find('all', array('conditions' => $conditions));
                  } else {
                        $assets = $this->paginate($conditions);
                  }
                  $assets = $this->AssetDetail->Asset->_calculateDepr('AssetDetail', $assets, $date_start, $date_end);
			$assetDetailTotal = $this->AssetDetail->findTotals($conditions);
		}
            $copyright_id = $this->configs['copyright_id'];
            $this->set(compact('assetDetailTotal', 'date_end', 'copyright_id', 'assets', 'departments', 'departmentSub', 'departmentUnit', 'assetCategories', 'min_asset_value', 'assetCategoryTypes', 'costCenter', 'businessType', 'costCenters'));

            if ($layout == 'pdf') {
                  Configure::write('debug', 0); // Otherwise we cannot use this method while developing 
                  $this->layout = 'pdf'; //this will use the pdf.ctp layout 
                  $this->render('' . $type . '_pdf');
            } else if ($layout == 'xls') {
                  $this->render('' . $type . '_xls', 'export_xls');
            }
            else
                  $this->render($type);
      }

      function _generateMovementReport($assetCategories) {
            ///************************************ init array costs,$deprs,$books ***************
            $costs = array();
            $deprs = array();

            foreach ($assetCategories as $id => $name) {
                  $costs[$id]['begin_balance'] = '0';
                  $costs[$id]['add_purchase'] = '0';
                  $costs[$id]['add_mutasi'] = '0';
                  $costs[$id]['add_reclass'] = '0';
                  $costs[$id]['add_reclass_gol'] = '0';
                  $costs[$id]['add_revaluasi'] = '0';
                  $costs[$id]['add_total'] = '0';
                  $costs[$id]['deduct_mutasi'] = '0';
                  $costs[$id]['deduct_reclass'] = '0';
                  $costs[$id]['deduct_reclass_gol'] = '0';
                  $costs[$id]['deduct_scrapt'] = '0';
                  $costs[$id]['deduct_sales'] = '0';
                  $costs[$id]['deduct_revaluasi'] = '0';
                  $costs[$id]['deduct_total'] = '0';
                  $costs[$id]['ending_balance'] = '0';

                  $deprs[$id]['begin_balance'] = '0';
                  $deprs[$id]['add_purchase'] = '0';
                  $deprs[$id]['add_mutasi'] = '0';
                  $deprs[$id]['add_reclass'] = '0';
                  $deprs[$id]['add_reclass_gol'] = '0';
                  $deprs[$id]['add_revaluasi'] = '0';
                  $deprs[$id]['add_total'] = '0';
                  $deprs[$id]['deduct_mutasi'] = '0';
                  $deprs[$id]['deduct_reclass'] = '0';
                  $deprs[$id]['deduct_reclass_gol'] = '0';
                  $deprs[$id]['deduct_scrapt'] = '0';
                  $deprs[$id]['deduct_sales'] = '0';
                  $deprs[$id]['deduct_revaluasi'] = '0';
                  $deprs[$id]['deduct_total'] = '0';
                  $deprs[$id]['ending_balance'] = '0';
            }

            ///************************************ purchase costs ***************
            $param = array(
                'fields' => array(
                    'AssetDetail.asset_category_id',
                    'sum(AssetDetail.hpthnlalu) as begin_balance',
                    'sum(AssetDetail.hpblnlalumasuk) as add_purchase',
                ),
                'group' => array('AssetDetail.asset_category_id'),
                'conditions' => array('source' => 'purchase')
            );
            $purchases = $this->AssetDetail->find('all', $param);

            $param = array(
                'fields' => array(
                    'AssetDetail.asset_category_id',
                    'sum(AssetDetail.hpblnlalumasuk) as add_mutasi',
                    'sum(AssetDetail.hpblnlalukeluar) as deduct_mutasi',
                ),
                'group' => array('AssetDetail.asset_category_id'),
                'conditions' => array('source' => 'mutasi')
            );
            $mutasis = $this->AssetDetail->find('all', $param);
            foreach ($purchases as $purchase) {
                  $asset_category_id = $purchase['AssetDetail']['asset_category_id'];
                  $costs[$asset_category_id]['begin_balance'] = $purchase['0']['begin_balance'];
                  $costs[$asset_category_id]['add_purchase'] = $purchase['0']['add_purchase'];
                  $costs[$asset_category_id]['add_reclass'] = 0;
                  $costs[$asset_category_id]['add_reclass_gol'] = 0;
                  $costs[$asset_category_id]['add_revaluasi'] = 0;

                  $costs[$asset_category_id]['deduct_reclass'] = 0;
                  $costs[$asset_category_id]['deduct_reclass_gol'] = 0;
                  $costs[$asset_category_id]['deduct_revaluasi'] = 0;
                  $costs[$asset_category_id]['deduct_scrapt'] = 0;
                  $costs[$asset_category_id]['deduct_sales'] = 0;
            }

//            foreach ($mutasis as $mutasi) {
//                  $asset_category_id = $mutasi['AssetDetail']['asset_category_id'];
//                  $costs[$asset_category_id]['add_mutasi'] = $mutasi['0']['add_mutasi'];
//                  $costs[$asset_category_id]['deduct_mutasi'] = $mutasi['0']['deduct_mutasi'];
//            }

            foreach ($costs as $asset_category_id => $cost) {
                  $costs[$asset_category_id]['add_total'] =
                          isset($cost['begin_balance']) ? $cost['begin_balance'] : 0 +
                          isset($cost['add_purchase']) ? $cost['add_purchase'] : 0 +
                                  isset($costs[$asset_category_id]['add_reclass']) ? $costs[$asset_category_id]['add_reclass'] : 0 +
                                          isset($costs[$asset_category_id]['add_reclass_gol']) ? $costs[$asset_category_id]['add_reclass_gol'] : 0 +
                                                  isset($costs[$asset_category_id]['add_revaluasi']) ? $costs[$asset_category_id]['add_revaluasi'] : 0 +
                                                          (isset($cost['add_mutasi']) ? $cost['add_mutasi'] : 0);

                  $costs[$asset_category_id]['deduct_total'] =
                          isset($costs[$asset_category_id]['deduct_sales']) ? $costs[$asset_category_id]['deduct_sales'] : 0 +
                          isset($costs[$asset_category_id]['deduct_scrapt']) ? $costs[$asset_category_id]['deduct_scrapt'] : 0 +
                                  isset($costs[$asset_category_id]['deduct_revaluasi']) ? $costs[$asset_category_id]['deduct_revaluasi'] : 0 +
                                          isset($costs[$asset_category_id]['add_reclass']) ? $costs[$asset_category_id]['add_reclass'] : 0 +
                                                  isset($costs[$asset_category_id]['add_reclass_gol']) ? $costs[$asset_category_id]['add_reclass_gol'] : 0 +
                                                          (isset($cost['deduct_mutasi']) ? $cost['deduct_mutasi'] : 0);

                  $costs[$asset_category_id]['ending_balance'] =
                          $costs[$asset_category_id]['add_total'] -
                          $costs[$asset_category_id]['deduct_total'];
            }
            //var_dump($purchases);
            //
            ///************************************ accomulated depr ***************
            $param = array(
                'fields' => array(
                    'AssetDetail.asset_category_id',
                    'sum(AssetDetail.depthnlalu) as begin_balance',
                    'sum(AssetDetail.depblnlalumasuk) as add_purchase',
                    'sum(AssetDetail.depblnlalukeluar) as deduct_purchase',
                ),
                'group' => array('AssetDetail.asset_category_id'),
                'conditions' => array('source' => 'purchase')
            );
            $purchases = $this->AssetDetail->find('all', $param);
            $param = array(
                'fields' => array(
                    'AssetDetail.asset_category_id',
                    'sum(AssetDetail.depblnlalumasuk) as add_mutasi',
                    'sum(AssetDetail.depblnlalukeluar) as deduct_mutasi',
                ),
                'group' => array('AssetDetail.asset_category_id'),
                'conditions' => array('source' => 'mutasi')
            );
            $mutasis = $this->AssetDetail->find('all', $param);

            foreach ($purchases as $purchase) {
                  $asset_category_id = $purchase['AssetDetail']['asset_category_id'];
                  $deprs[$asset_category_id]['begin_balance'] = $purchase['0']['begin_balance'];
                  $deprs[$asset_category_id]['add_purchase'] = $purchase['0']['add_purchase'];
                  $deprs[$asset_category_id]['add_reclass'] = 0;
                  $deprs[$asset_category_id]['add_reclass_gol'] = 0;
                  $deprs[$asset_category_id]['add_revaluasi'] = 0;

                  $deprs[$asset_category_id]['deduct_reclass'] = 0;
                  $deprs[$asset_category_id]['deduct_reclass_gol'] = 0;
                  $deprs[$asset_category_id]['deduct_revaluasi'] = 0;
                  $deprs[$asset_category_id]['deduct_scrapt'] = 0;
                  $deprs[$asset_category_id]['deduct_sales'] = 0;
            }
//            foreach ($mutasis as $mutasi) {
//                  $asset_category_id = $mutasi['AssetDetail']['asset_category_id'];
//                  $deprs[$asset_category_id]['add_mutasi'] = $mutasi['0']['add_mutasi'];
//                  $deprs[$asset_category_id]['deduct_mutasi'] = $mutasi['0']['deduct_mutasi'];
//            }
            foreach ($deprs as $asset_category_id => $depr) {
                  $deprs[$asset_category_id]['add_total'] =
                          isset($depr['begin_balance']) ? $depr['begin_balance'] : 0 +
                          isset($depr['add_purchase']) ? $depr['add_purchase'] : 0 +
                                  isset($deprs[$asset_category_id]['add_reclass']) ? $deprs[$asset_category_id]['add_reclass'] : 0 +
                                          isset($deprs[$asset_category_id]['add_reclass_gol']) ? $deprs[$asset_category_id]['add_reclass_gol'] : 0 +
                                                  isset($deprs[$asset_category_id]['add_revaluasi']) ? $deprs[$asset_category_id]['add_revaluasi'] : 0 +
                                                          (isset($depr['add_mutasi']) ? $depr['add_mutasi'] : 0);

                  $deprs[$asset_category_id]['deduct_total'] =
                          isset($deprs[$asset_category_id]['deduct_sales']) ? $deprs[$asset_category_id]['deduct_sales'] : 0 +
                          isset($deprs[$asset_category_id]['deduct_scrapt']) ? $deprs[$asset_category_id]['deduct_scrapt'] : 0 +
                                  isset($deprs[$asset_category_id]['deduct_revaluasi']) ? $deprs[$asset_category_id]['deduct_revaluasi'] : 0 +
                                          isset($deprs[$asset_category_id]['add_reclass']) ? $deprs[$asset_category_id]['add_reclass'] : 0 +
                                                  isset($deprs[$asset_category_id]['add_reclass_gol']) ? $deprs[$asset_category_id]['add_reclass_gol'] : 0 +
                                                          (isset($depr['deduct_mutasi']) ? $depr['deduct_mutasi'] : 0);

                  $deprs[$asset_category_id]['ending_balance'] =
                          $deprs[$asset_category_id]['add_total'] -
                          $deprs[$asset_category_id]['deduct_total'];
            }
            //var_dump($deprs);
            ///*****************************8 book values ***************/
            $books = array();
            foreach ($costs as $asset_category_id => $cost) {
                  $books[$asset_category_id]['cost'] = $cost['ending_balance'];
                  $books[$asset_category_id]['depr'] = $deprs[$asset_category_id]['ending_balance'];
                  $books[$asset_category_id]['book'] = $books[$asset_category_id]['cost'] - $books[$asset_category_id]['depr'];
            }
            //var_dump($books);
            $this->set('costs', $costs);
            $this->set('deprs', $deprs);
            $this->set('books', $books);
      }

      function history($id = null) {
            if (!$id) {
                  $this->Session->setFlash(__('Invalid asset detail', true));
                  $this->redirect(array('action' => 'index'));
            }
            $assetDetail = $this->AssetDetail->read(null, $id);

            $Po = new Po;
            $Invoice = new Invoice;
            $Movement = new Movement;
            $ImportAssetDetail = new ImportAssetDetail;
            $Disposal = new Disposal;
            $FaSupplierRetur = new FaSupplierRetur;
            $FaRetur = new FaRetur;
            $DeliveryOrder = new DeliveryOrder;

            $po = $Po->read(null, $assetDetail['AssetDetail']['po_id']);
            $invoice = $Invoice->read(null, $assetDetail['AssetDetail']['invoice_id']);
            $deliveryOrder = $DeliveryOrder->read(null, $assetDetail['AssetDetail']['delivery_order_id']);

            //the related npbs
            $npb_lists = array();
            if (!empty($po['Npb'])) {
                  foreach ($po['Npb'] as $npb) {
                        if ($npb['department_id'] == $assetDetail['AssetDetail']['department_id'])
                              $npb_lists[$npb['id']] = $npb['no'];
                  }
                  $npb_lists = array_unique($npb_lists);
            }


            //the related DeliveryOrder
//             $dos_lists = array();
//             if (!empty($po['DeliveryOrder'])) {
//                   foreach ($po['DeliveryOrder'] as $dos) {
//                         $dos_lists[$dos['id']] = $dos['no'];
//                   }
//             }
            //the related Movement
            if (!empty($assetDetail['MovementDetail'])) {
                  foreach ($assetDetail['MovementDetail'] as $md) {
                        $movements[] = $Movement->read(null, $md['movement_id']);
                  }
            }
            //debug($movements);
            //the related FaImport, kalau dari import, source = import:<importAssetDetailId>
            $source = $assetDetail['AssetDetail']['source'];
            if (strstr($source, 'import')) {
                  list($source, $importAssetDetailId) = explode(':', $source);
                  if ($importAssetDetailId) {
                        $iad = $ImportAssetDetail->read(null, $importAssetDetailId);
                        //debug($iad);
                        $fa_imports[] = $iad['FaImport'];
                  }
            }

            //the FaSupplierRetur
            if (!empty($assetDetail['FaSupplierReturDetail'])) {
                  foreach ($assetDetail['FaSupplierReturDetail'] as $fsrd) {
                        $faSupplierReturs[] = $FaSupplierRetur->read(null, $fsrd['fa_supplier_retur_id']);
                  }
            }

            $departments = $this->AssetDetail->Department->find('list');

            $this->set(compact(
                            'assetDetail', 'departments', 'po', 'movements', 'faSupplierReturs', 'fa_imports', 'disposals', 'invoice', 'npb_lists', 'deliveryOrder'));
      }

}

?>
