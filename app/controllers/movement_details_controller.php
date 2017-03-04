<?php
App::import('Model','AssetDetail');
class MovementDetailsController extends AppController {

      var $name = 'MovementDetails';
      var $helpers = array('Ajax', 'Javascript', 'Time', 'Form');
      var $components = array('RequestHandler');

      function index() {
            $this->MovementDetail->recursive = 0;
			$this->paginate = array('order'=>'MovementDetail.id');
            $this->set('movementDetails', $this->paginate());
      }

      function view($id = null) {
            if (!$id) {
                  $this->Session->setFlash(__('Invalid movement detail', true));
                  $this->redirect(array('action' => 'index'));
            }
            $this->Session->write('Movement.id', $id);
            $this->set('movementDetail', $this->MovementDetail->read(null, $id));
      }

      function add() {
            $keyword = array();
			
			//write session
            //$this->Session->write('MovementDetail.npb_detail_id', $this->data['MovementDetail']['npb_detail_id']);
			if(!empty($this->data['MovementDetail']['npb_detail_id']))
			$this->Session->write('MovementDetail.npb_detail_id', $this->data['MovementDetail']['npb_detail_id']);
			
            $npbDetail = $this->MovementDetail->NpbDetail->read(null, $this->Session->read('MovementDetail.npb_detail_id'));
            //var_dump($this->data['MovementDetail']['asset_detail_id']);
            $npb_id = $npbDetail['NpbDetail']['npb_id'];
			
            if (!empty($this->data)) {
                  if (isset($this->data['MovementDetail']['search_keyword'])) {
                        $keyword = $this->data['MovementDetail']['search_keyword'];
                  } else {
                        //delete movement_detail
						$movement_detailfilled = $this->MovementDetail->find('count', array('conditions'=>array('MovementDetail.npb_detail_id'=>$this->Session->read('MovementDetail.npb_detail_id'), 'MovementDetail.movement_id'=>$this->Session->read('Movement.id'))));
						$qtySisa = $npbDetail['NpbDetail']['qty_filled'] - $movement_detailfilled;
						$sql = 'update npb_details set qty_filled="'.$qtySisa.'" where id=' . $npbDetail['NpbDetail']['id'];
						$this->MovementDetail->query($sql);
						$this->MovementDetail->deleteAll(array('MovementDetail.movement_id' => $this->Session->read('Movement.id'), 'npb_detail_id' => $this->Session->read('MovementDetail.npb_detail_id')));
						//save movement_detail from asset_detail
                        if (isset($this->data['MovementDetail']['asset_detail_id'])) {
							
							  $movement_detailQty = $this->MovementDetail->find('count', array('conditions'=>array('npb_detail_id'=>$npbDetail['NpbDetail']['id'])));
							  $qty_npb_detail = $npbDetail['NpbDetail']['qty'] - $movement_detailQty;
                             $count = 0;
                              foreach ($this->data['MovementDetail']['asset_detail_id'] as $asset_detail_id) {
                                    if ($count >= $qty_npb_detail)
                                          break;
									$AssetDetail = new AssetDetail;
                                    $assetDetail = $AssetDetail->read(null, $asset_detail_id);
									//debug($assetDetail);
                                    $data['MovementDetail']['movement_id'] = $this->data['MovementDetail']['movement_id'];
                                    $data['MovementDetail']['notes'] = $this->data['MovementDetail']['notes'];
                                    $data['MovementDetail']['npb_detail_id'] = $this->Session->read('MovementDetail.npb_detail_id');
                                    $data['MovementDetail']['asset_detail_id'] = $asset_detail_id;
                                    $data['MovementDetail']['asset_category_id'] = $assetDetail['AssetDetail']['asset_category_id'];
                                    $data['MovementDetail']['price'] = $assetDetail['AssetDetail']['price'];
                                    $data['MovementDetail']['book_value'] = $assetDetail['AssetDetail']['book_value'];
                                    $data['MovementDetail']['accum_dep'] = $assetDetail['AssetDetail']['depthnini'];
                                    $data['MovementDetail']['code'] = $assetDetail['AssetDetail']['code'];
                                    $data['MovementDetail']['name'] = $assetDetail['AssetDetail']['name'];
                                    $data['MovementDetail']['date_of_purchase'] = $assetDetail['AssetDetail']['date_of_purchase'];
                                    $this->MovementDetail->create();
                                    $this->MovementDetail->save($data);

                                    $count++;
                              }
                              //update npb_details
                              $this->update_npbDetails($count);
                              $this->MovementDetail->NpbDetail->Npb->checkDone($npb_id);
                        }

                        $this->Session->setFlash(__('The movement detail has been saved', true), 'default', array('class' => 'ok'));
                        $this->redirect(array('controller' => 'movements', 'action' => 'view', $this->Session->read('Movement.id')));
                  }
            }
            $movement = $this->MovementDetail->Movement->read(null, $this->Session->read('Movement.id'));
			
            $npb_id = $movement['Movement']['npb_id'];
			
            $npbItemDetail = $this->MovementDetail->NpbDetail->find('list', array(
                        'fields' => array('NpbDetail.id', 'NpbDetail.item_name', 'NpbDetail.item_code'),
                        'conditions' => array('NpbDetail.npb_id' => $npb_id,
                            'NpbDetail.process_type_id' => movement_process_type_id)
                    ));
			
			//write session
            

            $assetCategoryId = $npbDetail['Item']['asset_category_id'];
            $itemName = $npbDetail['Item']['code'];
			
            $assetDetailSelecteds = $movement['MovementDetail'];

            $source_department_id = $movement['Movement']['source_department_id'];
            $source_business_type_id = $movement['Movement']['source_business_type_id'];
            $source_cost_center_id = $movement['Movement']['source_cost_center_id'];
			
            $mov_no = $movement['Movement']['no'];

            $asset_details = $this->MovementDetail->AssetDetail->find('all', array('conditions' =>
                        array('AND' =>
                            array(
                                'AssetDetail.department_id' 		=> $source_department_id,
                                'AssetDetail.business_type_id' 		=> $source_business_type_id,
                                'AssetDetail.cost_center_id' 		=> $source_cost_center_id,
                               
							    'AssetDetail.asset_category_id' 	=> $assetCategoryId,
                                'AssetDetail.ada' 					=> 'Y',
                                'AssetDetail.code LIKE' 			=> '%' . $itemName . '%',
                                'OR' => array(
                                    array('AssetDetail.name LIKE' 	=> '%' . $keyword . '%'),
                                    array('AssetDetail.code LIKE' 	=> '%' . $keyword . '%')),
                            )
                        )
                    ));

            $this->set(compact('movement', 'npbItemDetail', 'mov_no', 'asset_details', 'assetDetailSelecteds'));

            $this->MovementDetail->recursive = 0;
            $this->set('movementDetails', $this->paginate());
      }

      function update_npbDetails($count) {
            $npbDetailId = $this->Session->read('MovementDetail.npb_detail_id');
            $mov_id = $this->Session->read('Movement.id');
            //update npb details:
            //qty_filled, qty_unfilled
            //movement_id
            //date finish jika sudah qty-qty_filled = 0
			if(DRIVER == 'mysql'){
				$this->MovementDetail->query('update npb_details set qty_filled=(if(qty>"' . $count . '", "' . $count . '", qty)), 
				qty_unfilled=qty-qty_filled, 
				date_finish=if(qty-qty_filled=0, now(), NULL) , 
				movement_id="' . $mov_id . '" 
				where npb_details.id="' . $npbDetailId . '" ');
				
            }elseif(DRIVER == 'mssql'){
				
				$this->MovementDetail->query('update npb_details set 
						qty_filled= qty_filled + (case when qty  > "'.$count.'" then "'.$count.'" else qty end), 
						movement_id="' . $mov_id . '" where npb_details.id="' . $npbDetailId . '" ');
						
				$this->MovementDetail->query('update npb_details set 
					  qty_unfilled=qty-qty_filled, 
					  date_finish= case(qty-qty_filled) when 0 then  getdate() else NULL end where npb_details.id="' . $npbDetailId . '" ');
			}
      }

      function edit($id = null) {
            if (!$id && empty($this->data)) {
                  $this->Session->setFlash(__('Invalid movement detail', true));
                  $this->redirect(array('action' => 'index'));
            }

            if (!empty($this->data)) {

                  if (isset($this->data['MovementDetail']['asset_detail_id'])) {
                        foreach ($this->data['MovementDetail']['asset_detail_id'] as $asset_detail_id) {
                              $assetDetail = $this->MovementDetail->AssetDetail->read(null, $asset_detail_id);
                              $data['MovementDetail']['movement_id'] = $this->data['MovementDetail']['movement_id'];
                              $data['MovementDetail']['notes'] = $this->data['MovementDetail']['notes'];
                              $data['MovementDetail']['asset_detail_id'] = $asset_detail_id;
                              $data['MovementDetail']['asset_category_id'] = $assetDetail['AssetDetail']['asset_category_id'];
                              $this->MovementDetail->save($data);
                        }
                  }

                  $this->Session->setFlash(__('The movement detail has been saved', true), 'default', array('class' => 'ok'));
                  $this->redirect(array('controller' => 'movements', 'action' => 'view', $this->Session->read('Movement.id')));
            }

            if (empty($this->data)) {
                  $movement = $this->MovementDetail->Movement->read(null, $this->Session->read('Movement.id'));
            }
            $assetDetailSelecteds = $movement['MovementDetail'];

            $source_department_id = $movement['Movement']['source_department_id'];
            $mov_no = $movement['Movement']['no'];

            $asset_details = $this->MovementDetail->AssetDetail->find('all', array('conditions' => array('AssetDetail.department_id' => $source_department_id)));


            $this->set(compact('movement', 'mov_no', 'asset_details', 'assetDetailSelecteds'));

            $this->MovementDetail->recursive = 0;
            $this->set('movementDetails', $this->paginate());
      }

      function delete($id = null) {
            if (!$id) {
                  $this->Session->setFlash(__('Invalid id for movement detail', true));
                  $this->redirect(array('controller' => 'movements', 'action' => 'view', $this->Session->read('Movement.id')));
            }
            if ($this->MovementDetail->delete($id)) {
                  $this->Session->setFlash(__('Movement detail deleted', true), 'default', array('class' => 'ok'));
                  $this->redirect(array('controller' => 'movements', 'action' => 'view', $this->Session->read('Movement.id')));
            }
            $this->Session->setFlash(__('Movement detail was not deleted', true));
            $this->redirect(array('controller' => 'movements', 'action' => 'view', $this->Session->read('Movement.id')));
      }

      function reports($type='fa') {
            $layout = $this->data['MovementDetail']['layout'];
            //$this->MovementDetail->recursive = 2;
            $this->MovementDetail->recursive = 1;
			$group_id = $this->Session->read('Security.permissions');
            $dep_id = $this->Session->read('Userinfo.department_id');

			if(!empty($this->data)){
				if($this->data['DestCostCenter']['name'] == '')
				  $this->data['MovementDetail']['dest_cost_center_id'] = null;
				if($this->data['SourceCostCenter']['name'] == '')
				  $this->data['MovementDetail']['source_cost_center_id'] = null;
				$this->Session->write('MovementDetail.name', $this->data['MovementDetail']['search_keyword']);
				$this->Session->write('MovementDetail.is_inventory', $this->data['MovementDetail']['is_inventory']);
				//$this->Session->write('MovementDetail.dest_department_id', $this->data['MovementDetail']['dest_department_id']);
			}
			$min_asset_value = $this->configs['min_asset_value'];
            $conditions = array();
            if (!$this->Session->check('MovementDetail.is_inventory'))
                  $this->Session->write('MovementDetail.is_inventory', 3);
				  
            if ($this->Session->read('MovementDetail.is_inventory') == 1)
                  $conditions[] = array('MovementDetail.price <' => $min_asset_value);
            else if ($this->Session->read('MovementDetail.is_inventory') == 2)
                  $conditions[] = array('MovementDetail.price >' => $min_asset_value);
            else if ($this->Session->read('MovementDetail.is_inventory') == 3)
                  $conditions[] = array('MovementDetail.price >' => 0);
			
			/*  if($group_id == normal_user_group_id || $group_id == branch_head_group_id){
				 if (!$this->Session->check('MovementDetail.dest_department_id'))
					  $this->Session->write('MovementDetail.dest_department_id', $dep_id);
			 }   */
			
			$conditions[] = array('Movement.movement_status_id' => status_movement_finish_id);
			
			if ($source_department_id = $this->data['MovementDetail']['source_department_id']) {
			$conditions[] = array('source_department_id' => $source_department_id);
            }
            if ($source_business_type_id = $this->data['MovementDetail']['source_business_type_id']) {
                  $conditions[] = array('source_business_type_id' => $source_business_type_id);
            }
            if ($source_cost_center_id = $this->data['MovementDetail']['source_cost_center_id']) {
                  $conditions[] = array('source_cost_center_id' => $source_cost_center_id);
            }
			if($group_id == normal_user_group_id || $group_id == branch_head_group_id)
				$dest_department_id = $dep_id;
			else
				$dest_department_id = $this->data['MovementDetail']['dest_department_id'];

            if (!empty($dest_department_id)) {
                  $conditions[] = array('dest_department_id' => $dest_department_id);
            }
            if ($dest_business_type_id = $this->data['MovementDetail']['dest_business_type_id']) {
                  $conditions[] = array('dest_business_type_id' => $dest_business_type_id);
            }
			
            if ($dest_cost_center_id = $this->data['MovementDetail']['dest_cost_center_id']) {
                  $conditions[] = array('dest_cost_center_id' => $dest_cost_center_id);
            }
            if ($asset_category_id = $this->data['MovementDetail']['asset_category_id'])
                  $conditions[] = array('AssetDetail.asset_category_id' => $asset_category_id);
			
			$name = $this->Session->read('MovementDetail.name');
			$conditions[] = array('OR' => array(
									'MovementDetail.name LIKE' => '%'. $name .'%',
									'MovementDetail.code LIKE' => '%'. $name .'%'
									//'MovementDetail.item_code LIKE' => '%'. $name .'%'
								)
							);
			$this->paginate = array('order'=>'MovementDetail.id');
            //date- filter
            list($date_start, $date_end) = $this->set_date_filters('MovementDetail');
            $conditions[] = array('doc_date >=' => ($date_start['year'] . '-' . $date_start['month'] . '-' . $date_start['day']),
                'doc_date <=' => ($date_end['year'] . '-' . $date_end['month'] . '-' . $date_end['day']));

            if ($layout == 'pdf' || $layout == 'xls') {
                  $con = $this->MovementDetail->find('all', array('conditions' => $conditions, 'order'=>'MovementDetail.id'));
            } else {
                  $con = $this->paginate($conditions);
            }

            $this->set('movementDetails', $con);
            $departments = $this->MovementDetail->Movement->Department->find('list');
            //$departmentSub 	= $this->MovementDetail->Movement->Department->DepartmentSub->find('list');
            //$departmentUnit 	= $this->MovementDetail->Movement->Department->DepartmentUnit->find('list');
            $businessType = $this->MovementDetail->Movement->Department->BusinessType->find('list');
            $costCenter = $this->MovementDetail->Movement->CostCenter->find('list');
            $costCenters = $this->MovementDetail->Movement->CostCenter->find('list', array('fields' => 'name'));
			//$cc 			= $this->MovementDetail->query('select a.id,a.name,b.t24_dao from cost_centers a left join cost_center_to_daos b on b.cost_center_id = a.id where a.remarks = "Y" order by a.name');
			//foreach($cc as $data){
			//	if($data[0]['t24_dao']){
			//		$costCenters[ $data[0]['id'] ]	= $data[0]['name'] . " - " .$data[0]['t24_dao'];
			//	}else{
			//		$costCenters[ $data[0]['id'] ]	= $data[0]['name'];
			//	}				
			//}
            $assetCategories = $this->MovementDetail->AssetDetail->AssetCategory->find('list', array('conditions' => array('is_asset' => 1)));
            $copyright_id = $this->configs['copyright_id'];
			$moduleName = 'Report > Fixed Assets > Transfer Report';
			$this->set('title_for_layout',  $this->lastSegment($moduleName));
            $this->set(compact('departments', 'departmentSub', 'departmentUnit', 'source_department_id', 
				'costCenters', 'department_unit_id', 'department_sub_id', 'assetCategories', 'copyright_id', 
				'date_start', 'date_end', 'businessType', 'costCenter', 'source_business_type_id', 'source_cost_center_id', 
				'dest_department_id', 'dest_business_type_id', 'dest_cost_center_id', 'asset_category_id', 'moduleName'));

            if ($layout == 'pdf') {
                  Configure::write('debug', 0); // Otherwise we cannot use this method while developing 
                  $this->layout = 'pdf'; //this will use the pdf.ctp layout 
                  $this->render('report_fa_pdf');
            } else if ($layout == 'xls') {

                  $this->render('report_fa_xls', 'export_xls');
            } else {
                  $this->render('report_' . $type);
            }
      }

}

?>
