<?php

App::import('Model', 'Asset');

class MovementsController extends AppController {

      var $name = 'Movements';
      var $helpers = array('Form', 'Html', 'Ajax', 'Javascript', 'Time');
      var $components = array('RequestHandler');

      function getSourceDepartmentSubId() {
            $this->layout = 'ajax';
            $this->set('options', $this->Movement->DepartmentSub->find('list', array(
                        'conditions' => array(
                            'DepartmentSub.department_id' => $this->data['Movement']['source_department_id']
                        ),
                        'group' => array('DepartmentSub.name')
                            )
                    )
            );

            $this->render('/movements/ajax_dropdown');
      }

      function getSourceDepartmentUnitId() {
            $this->layout = 'ajax';
            $this->set('options', $this->Movement->DepartmentUnit->find('list', array(
                        'conditions' => array(
                            'DepartmentUnit.department_sub_id' => $this->data['Movement']['source_department_sub_id']
                        ),
                        'group' => array('DepartmentUnit.name')
                            )
                    )
            );

            $this->render('/movements/ajax_dropdown');
      }

      function getDestDepartmentSubId() {
            $this->layout = 'ajax';
            $this->set('options', $this->Movement->DepartmentSub->find('list', array(
                        'conditions' => array(
                            'DepartmentSub.department_id' => $this->data['Movement']['dest_department_id']
                        ),
                        'group' => array('DepartmentSub.name')
                            )
                    )
            );

            $this->render('/movements/ajax_dropdown');
      }

      function getDestDepartmentUnitId() {
            $this->layout = 'ajax';
            $this->set('options', $this->Movement->DepartmentUnit->find('list', array(
                        'conditions' => array(
                            'DepartmentUnit.department_sub_id' => $this->data['Movement']['dest_department_sub_id']
                        ),
                        'group' => array('DepartmentUnit.name')
                            )
                    )
            );

            $this->render('/movements/ajax_dropdown');
      }

      function index($movement_status_id=null, $movement_department_id=null, $movement_department_sub_id=null, $movement_department_unit_id=null, $dest_department_id=null, $dest_business_type_id=null, $dest_cost_center_id=null) {
            $this->Session->write('Movement.is_fa_management_user', $this->Session->read('Security.permissions') == fa_management_group_id ? true : false);
            $this->Session->write('Movement.is_fa_supervisor_user', $this->Session->read('Security.permissions') == fa_supervisor_group_id ? true : false);
            $this->Session->write('Movement.is_it_management_user', $this->Session->read('Security.permissions') == it_management_group_id ? true : false);
            $this->Session->write('Movement.is_it_supervisor_user', $this->Session->read('Security.permissions') == it_supervisor_group_id ? true : false);
            $group_id = $this->Session->read('Security.permissions');
            $this->Movement->recursive = 0;
            $layout = $this->data['Movement']['layout'];
			if(!empty($this->data)){
				if($this->data['SourceCostCenter']['name'] == '')
					$this->data['Movement']['source_cost_center_id'] = null;
				if($this->data['DestCostCenter']['name'] == '')
					$this->data['Movement']['dest_cost_center_id'] = null;
			}
            //// filter Movements 
            if ($group_id == admin_group_id || $group_id == gs_group_id)//admin||gs
                  $conditions = array();

            else if ($group_id == fa_management_group_id)//fa
                  $conditions = array(
                      'AND' => array(
                          'OR' => array(
                              array('movement_status_id' => status_movement_new_id),
                              array('movement_status_id' => status_movement_request_for_approval_id),
                              array('movement_status_id' => status_movement_approved_by_supervisor_id),
                              array('movement_status_id' => status_movement_processed_id),
                              array('movement_status_id' => status_disposal_finish_id),
                              array('movement_status_id' => status_disposal_posted_journal_id),
                              //array('movement_status_id' => status_movement_archive_id),
                              array('movement_status_id' => status_movement_reject_id)),
                          'OR' => array(
                              array('request_type_id' => request_type_fa_general_id))
                      )
                  );
            else if ($group_id == fa_supervisor_group_id)//spv_fa
                  $conditions = array(
                      'AND' => array(
                          'OR' => array(
                              array('movement_status_id' => status_movement_request_for_approval_id),
                              array('movement_status_id' => status_movement_approved_by_supervisor_id),
                              array('movement_status_id' => status_movement_processed_id),
                              array('movement_status_id' => status_disposal_finish_id),
                              array('movement_status_id' => status_disposal_posted_journal_id),
                              //array('movement_status_id' => status_movement_archive_id),
                              array('movement_status_id' => status_movement_reject_id)),
                          'OR' => array(
                              array('request_type_id' => request_type_fa_general_id))
                      )
                  );
            else if ($group_id == it_management_group_id)//it
                  $conditions = array(
                      'AND' => array(
                          'OR' => array(
                              array('movement_status_id' => status_movement_new_id),
                              array('movement_status_id' => status_movement_request_for_approval_id),
                              array('movement_status_id' => status_movement_approved_by_supervisor_id),
                              array('movement_status_id' => status_movement_processed_id),
                              array('movement_status_id' => status_disposal_finish_id),
                              array('movement_status_id' => status_disposal_posted_journal_id),
                              //array('movement_status_id' => status_movement_archive_id),
                              array('movement_status_id' => status_movement_reject_id)),
                          'OR' => array(
                              array('request_type_id' => request_type_fa_it_id))
                      )
                  );

            else if ($group_id == it_supervisor_group_id)//spv_it
                  $conditions = array(
                      'AND' => array(
                          'OR' => array(
                              array('movement_status_id' => status_movement_request_for_approval_id),
                              array('movement_status_id' => status_movement_approved_by_supervisor_id),
                              array('movement_status_id' => status_movement_processed_id),
                              array('movement_status_id' => status_disposal_finish_id),
                              array('movement_status_id' => status_disposal_posted_journal_id),
                              //array('movement_status_id' => status_movement_archive_id),
                              array('movement_status_id' => status_movement_reject_id)),
                          'OR' => array(
                              array('request_type_id' => request_type_fa_it_id))
                      )
                  );
            else if ($group_id == fincon_group_id)//fincon
                  $conditions = array(
                      'AND' => array(
                          'OR' => array(
                              array('movement_status_id' => status_movement_processed_id),
                              array('movement_status_id' => status_disposal_finish_id),
                              array('movement_status_id' => status_disposal_posted_journal_id)),
                          'OR' => array(
                              array('request_type_id' => request_type_fa_general_id),
                              array('request_type_id' => request_type_fa_it_id))
                      )
                  );
			$conditions[] = array('movement_status_id !='=>status_movement_archive_id); //archive

            //var_dump($this->data['Movement']['movement_status_id']);
            if ($movement_status_id || ($movement_status_id = $this->data['Movement']['movement_status_id'])) {
                  $conditions[] = array('movement_status_id' => $movement_status_id);
            }

            if ($movement_department_id = $this->data['Movement']['source_department_id']) {
                  $conditions[] = array('Movement.source_department_id' => $movement_department_id);
            }
            if ($movement_business_id = $this->data['Movement']['source_business_type_id']) {
                  $conditions[] = array('Movement.source_business_type_id' => $movement_business_id);
            }
            if ($movement_cost_center_id = $this->data['Movement']['source_cost_center_id']) {
                  $conditions[] = array('Movement.source_cost_center_id' => $movement_cost_center_id);
            }


            if ($dest_department_id = $this->data['Movement']['dest_department_id']) {
                  $conditions[] = array('Movement.dest_department_id' => $dest_department_id);
            }
            if ($dest_business_type_id = $this->data['Movement']['dest_business_type_id']) {
                  $conditions[] = array('Movement.dest_business_type_id' => $dest_business_type_id);
            }
            if ($dest_cost_center_id = $this->data['Movement']['dest_cost_center_id']) {
                  $conditions[] = array('Movement.dest_cost_center_id' => $dest_cost_center_id);
            }
            /* if($movement_department_sub_id || ($movement_department_sub_id=$this->data['Movement']['source_department_sub_id']) ) {
              $conditions[] = array('source_department_sub_id'=>$movement_department_sub_id);
              }
              if($movement_department_unit_id || ($movement_department_unit_id=$this->data['Movement']['source_department_unit_id']) ) {
              $conditions[] = array('source_department_unit_id'=>$movement_department_unit_id);
              } */
			$this->paginate = array('order'=>'Movement.id');
            list($date_start, $date_end) = $this->set_date_filters('Movement');
            $conditions[] = array('Movement.doc_date >=' => ($date_start['year'] . '-' . $date_start['month'] . '-' . $date_start['day']),
                'Movement.doc_date <=' => ($date_end['year'] . '-' . $date_end['month'] . '-' . $date_end['day']));
            if ($layout == 'pdf' || $layout == 'xls') {
                  $con = $this->Movement->find('all', array('conditions' => $conditions, 'order'=>'Movement.id'));
            } else {
				  $this->paginate = array('order'=>'Movement.id');
                  $con = $this->paginate($conditions);
            }
            $this->set('movements', $con);
            $copyright_id = $this->configs['copyright_id'];
            $movement_statuses = $this->Movement->MovementStatus->find('list', array('conditions' =>array('id !=' => status_movement_archive_id))); //archive);
            $departments = $this->Movement->Department->find('list');
            //$departmentSub = $this->Movement->Department->DepartmentSub->find('list', array('conditions' => array('DepartmentSub.department_id' => $departments)));
            //$departmentUnit = $this->Movement->Department->DepartmentUnit->find('list', array('conditions' => array('DepartmentUnit.department_sub_id' => $departmentSub)));
            $businessType = $this->Movement->Department->BusinessType->find('list');
            $costCenter = $this->Movement->CostCenter->find('list');
			$moduleName = 'Fixed Assets > FA Transfers > List FA Transfers';
			$this->set('title_for_layout',  $this->lastSegment($moduleName));
            $this->set(compact('copyright_id', 'departmentSub', 'departmentUnit', 
				'movement_statuses', 'departments', 'movement_status_id', 'movement_department_id', 
				'movement_department_sub_id', 'movement_department_unit_id', 'date_start', 'date_end', 
				'businessType', 'costCenter', 'movement_business_id', 'movement_cost_center_id', 'dest_department_id', 
				'dest_business_type_id', 'dest_cost_center_id', 'moduleName'));


            if ($layout == 'pdf') {
                  Configure::write('debug', 0); // Otherwise we cannot use this method while developing 
                  $this->layout = 'pdf'; //this will use the pdf.ctp layout 
                  $this->render('index_pdf');
            } else if ($layout == 'xls') {
                  $this->render('index_xls', 'export_xls');
            }
      }

      function view($id = null) {
            $this->Session->write('Movement.is_fa_management_user', $this->Session->read('Security.permissions') == fa_management_group_id ? true : false);
            $this->Session->write('Movement.is_fa_supervisor_user', $this->Session->read('Security.permissions') == fa_supervisor_group_id ? true : false);
            $this->Session->write('Movement.is_it_management_user', $this->Session->read('Security.permissions') == it_management_group_id ? true : false);
            $this->Session->write('Movement.is_it_supervisor_user', $this->Session->read('Security.permissions') == it_supervisor_group_id ? true : false);
            if (!$id) {
                  $this->Session->setFlash(__('Invalid movement', true));
                  $this->redirect(array('action' => 'index'));
            }

            $movement = $this->Movement->read(null, $id);
            $this->Session->write('Movement.id', $id);

            $id_group = $this->Session->read('Security.permissions');

            /// can edit Movement ?
            if (($movement['Movement']['movement_status_id'] == status_movement_new_id && ($id_group == fa_management_group_id || $id_group == it_management_group_id
                    || $id_group == admin_group_id)))
                  $this->Session->write('Movement.can_edit', true);
            else
                  $this->Session->write('Movement.can_edit', false);

            /// Movement Print ?
            if (//($movement['Movement']['movement_status_id'] == status_movement_new_id || $movement['Movement']['movement_status_id'] == status_movement_request_for_approval_id) && 
                    ($id_group == it_management_group_id || $id_group == fa_management_group_id))
                  $this->Session->write('Movement.can_print', true);
            else
                  $this->Session->write('Movement.can_print', false);

            /// Movement Reject ?
            if (($movement['Movement']['movement_status_id'] == status_movement_request_for_approval_id && ($id_group == fa_supervisor_group_id || $id_group == it_supervisor_group_id)))
                  $this->Session->write('Movement.can_reject', true);
            else
                  $this->Session->write('Movement.can_reject', false);

            /// Movement Cancel ?
            if (($movement['Movement']['movement_status_id'] == status_movement_request_for_approval_id && ($id_group == fa_supervisor_group_id || $id_group == it_supervisor_group_id)))
                  $this->Session->write('Movement.can_cancel', true);
            else
                  $this->Session->write('Movement.can_cancel', false);

            /// Movement Archive ?
            if (($movement['Movement']['movement_status_id'] == status_movement_reject_id && ($id_group == fa_management_group_id || $id_group == it_management_group_id)))
                  $this->Session->write('Movement.can_archive', true);
            else
                  $this->Session->write('Movement.can_archive', false);

            /// Movement can_reject_notes
            if ((!empty($movement['Movement']['reject_notes']) && ($id_group == fa_management_group_id || $id_group == it_management_group_id
                    || $id_group == admin_group_id)))
                  $this->Session->write('Movement.can_reject_notes', true);

            else if ((!empty($movement['Movement']['reject_notes']) && ($id_group == fa_supervisor_group_id || $id_group == it_supervisor_group_id
                    || $id_group == admin_group_id)))
                  $this->Session->write('Movement.can_reject_notes', true);

            else
                  $this->Session->write('Movement.can_reject_notes', false);

            /// Movement can_cancel_notes
            if ((!empty($movement['Movement']['cancel_notes']) && ($id_group == fa_management_group_id || $id_group == it_management_group_id
                    || $id_group == admin_group_id)))
                  $this->Session->write('Movement.can_cancel_notes', true);

            else if ((!empty($movement['Movement']['cancel_notes']) && ($id_group == fa_supervisor_group_id || $id_group == it_supervisor_group_id
                    || $id_group == admin_group_id)))
                  $this->Session->write('Movement.can_cancel_notes', true);

            else
                  $this->Session->write('Movement.can_cancel_notes', false);

            /// can posting Movement journal?
            //if(($movement['Movement']['movement_status_id'] == status_movement_finish_id && $id_group == fincon_group_id))
            if (($movement['Movement']['movement_status_id'] == status_movement_processed_id && $id_group == fincon_group_id))
                  $this->Session->write('Movement.can_posting_movement_journal', true);
            else
                  $this->Session->write('Movement.can_posting_movement_journal', false);


            $approveLink = $this->get_approve_link($id, $movement, $id_group);
            $departments = $this->Movement->Department->find('list');
            $npbs = $this->Movement->NpbDetail->Npb->find('list');
            $businessTypes = $this->Movement->BusinessType->find('list');
            $costCenters = $this->Movement->CostCenter->find('list');
            $costCenter = $this->Movement->CostCenter->find('list', array('fields'=>'name'));
			//$cc 			= $this->Movement->query('select a.id,a.name,b.t24_dao from cost_centers a left join cost_center_to_daos b on b.cost_center_id = a.id where a.remarks = "Y" order by a.name');
			//foreach($cc as $data){
			//	if($data[0]['t24_dao']){
			//		$costCenter[ $data[0]['id'] ]	= $data[0]['name'] . " - " .$data[0]['t24_dao'];
			//	}else{
			//		$costCenter[ $data[0]['id'] ]	= $data[0]['name'];
			//	}				
			//}
            $assetDetails = $this->Movement->MovementDetail->find('all');
            $assetCategories = $this->Movement->MovementDetail->AssetDetail->AssetCategory->find('list', array('conditions' => array('is_asset' => 1)));

            $this->set(compact('movement', 'approveLink', 'departments', 'assetCategories', 'npbs', 'businessTypes', 'costCenters', 'costCenter'));
      }

      function view_pdf($id = null) {
            //cek id movement
            if (!$id) {
                  $this->Session->setFlash(__('Invalid Movement', true));
                  $this->redirect(array('action' => 'index'));
            }

            /* //Add is_printed=1
              if (!empty($id)) {
              $data['Movement']['id'] = $id;
              $data['Movement']['is_printed'] = 1;
              $this->Movement->save($data);
              } */

            Configure::write('debug', 0); // Otherwise we cannot use this method while developing 
            $movement = $this->Movement->read(null, $id);
            $this->Session->write('Movement.id', $id);
            $this->set('movement', $movement);
            $departments = $this->Movement->Department->find('list');
            $npbs = $this->Movement->NpbDetail->Npb->find('list');
            $businessTypes = $this->Movement->BusinessType->find('list');
            $costCenters = $this->Movement->CostCenter->find('list');
			//$cc 			= $this->Npb->query('select a.id,a.name,b.t24_dao from cost_centers a left join cost_center_to_daos b on b.cost_center_id = a.id where a.remarks = "Y" order by a.name');
			//foreach($cc as $data){
			//	if($data[0]['t24_dao']){
			//		$costCenters[ $data[0]['id'] ]	= $data[0]['name'] . " - " .$data[0]['t24_dao'];
			//	}else{
			//		$costCenters[ $data[0]['id'] ]	= $data[0]['name'];
			//	}				
			//}
            $assetDetails = $this->Movement->MovementDetail->find('all');
            $copyright_id = $this->configs['copyright_id'];
            $assetCategories = $this->Movement->MovementDetail->AssetDetail->AssetCategory->find('list', array('conditions' => array('is_asset' => 1)));
            $this->set(compact('assetCategories', 'departments', 'businessTypes', 'costCenters', 'npbs', 'copyright_id'));
            $this->layout = 'pdf'; //this will use the pdf.ctp layout 
            $this->render();
      }

      function get_approve_link($id, $movement, $id_group) {
            $this->Session->write('Movement.is_fa_management_user', $this->Session->read('Security.permissions') == fa_management_group_id ? true : false);
            $this->Session->write('Movement.is_fa_supervisor_user', $this->Session->read('Security.permissions') == fa_supervisor_group_id ? true : false);
            $this->Session->write('Movement.is_it_management_user', $this->Session->read('Security.permissions') == it_management_group_id ? true : false);
            $this->Session->write('Movement.is_it_supervisor_user', $this->Session->read('Security.permissions') == it_supervisor_group_id ? true : false);
            $group = $this->Movement->query('select * from groups where id="' . $id_group . '"');

            if (($id_group == fa_management_group_id || $id_group == it_management_group_id) && $movement['Movement']['movement_status_id'] == status_movement_new_id) {
                  $approveLink = array('label' => __('Request For Approval', true),
                      'options' => array('action' => 'approve_movement/' . status_movement_request_for_approval_id, $id));
            } else if (($id_group == fa_supervisor_group_id || $id_group == it_supervisor_group_id) && $movement['Movement']['movement_status_id'] == status_movement_request_for_approval_id) {
                  $approveLink = array('label' => __('Approved by Supervisor', true),
                      'options' => array('action' => 'approve_movement/' . status_movement_approved_by_supervisor_id, $id));
            } else if (($id_group == fa_management_group_id || $id_group == it_management_group_id) &&
                    $movement['Movement']['movement_status_id'] == status_movement_approved_by_supervisor_id) {
                  $approveLink = array('label' => __('Process Movement', true),
                      'options' => array('action' => 'approve_movement/' . status_movement_processed_id, $id));
            }
            // else if($id_group  == fincon_group_id && 
            // $movement['Movement']['movement_status_id']==status_movement_processed_id)
            // {
            // $approveLink = array('label'=>__('Finish Movement',true),
            // 'options'=>array('action' => 'approve_movement/'. status_movement_finish_id , $id)); 
            // }			
            else {
                  $approveLink = array('label' => __('Back', true), 'options' => array('action' => 'index'));
            }

            return $approveLink;
      }

      function approve_movement($level, $id) {
			$movement = $this->Movement->read(null, $id);
			if (!empty($movement['MovementDetail']))
			{
				$min_asset_value = $this->configs['min_asset_value'];
				$price = $this->Movement->MovementDetail->find('count', array('conditions'=>array('MovementDetail.price >'=>$min_asset_value, 'MovementDetail.movement_id'=>$id)));
				if($price == 0 && $level==status_movement_processed_id){
					$this->data['Movement']['id'] = $id;
					$this->data['Movement']['movement_status_id'] = status_movement_finish_id;
				}else{
					$this->data['Movement']['id'] = $id;
					$this->data['Movement']['movement_status_id'] = $level;
				}
				if ($level == status_movement_approved_by_supervisor_id) {
					  $this->data['Movement']['approved_by'] = $this->Session->read('Userinfo.username');
					  $this->data['Movement']['approved_date'] = date('Y-m-d H:i:s');
				}

				if ($this->Movement->save($this->data)) {
					  if ($level == status_movement_processed_id) {
							if (!$this->process_movement($id)) {
								  $this->Session->setFlash(__('The movement could not be processed. Please, try again.', true));
								  $this->redirect(array('action' => 'view', $id));
							}
					  }

					  $this->Session->setFlash(__('The movement has been saved', true), 'default', array('class' => 'ok'));
					  //$this->redirect(array('action' => 'view', $id));
					  $this->redirect(array('action' => 'index'));
				} else {
					  $this->Session->setFlash(__('The movement could not be saved. Please, try again.', true));
				}
				$this->edit($id);
			}
			else
			{
				$this->Session->setFlash(__('The FA transfer detail could not be empty. Please, try again.', true));
				$this->redirect(array('action' => 'view', $id));
			}
      }

      function process_movement($id) {
            $AssetModel = new Asset;
           // $this->Movement->recursive = 2;
            $this->Movement->recursive = 1;
            $movement = $this->Movement->read(null, $id);
            $doc_date = $movement['Movement']['doc_date'];
            $dest_department_id = $movement['Movement']['dest_department_id'];
            $dest_department_sub_id = $movement['Movement']['dest_department_sub_id'];
            $dest_department_unit_id = $movement['Movement']['dest_department_unit_id'];
            $dest_business_type_id = $movement['Movement']['dest_business_type_id'];
            $dest_cost_center_id = $movement['Movement']['dest_cost_center_id'];
            $old_asset_id = 0;
            $new_asset_id = 0;

            /* *************************************************
              untuk setiap asset_detail yang ada di movement detail:
              - update department_id ke $dest_department_id
              - update kode asset , ganti dept_id
              - kurangi asset induk qty nya
              - insert asset induk baru di dest_department_id
             * ************************************************* */

            foreach ($movement['MovementDetail'] as $md) {
                  $assetDetail = array();
                  $asset = array();

                  //get asset detail
                  $asset_detail_id = $md['asset_detail_id'];
                  $assetDetail = $this->Movement->MovementDetail->AssetDetail->read(null, $asset_detail_id);
                  if (empty($assetDetail)) {
                        debug('cannot find assetDetail with id ' . $asset_detail_id);
                        die;
                  }

                  //1. delete source asset detail
                  $this->Movement->query('delete from asset_details where id='. $asset_detail_id);
                  
                  //2. create new asset for destination branch, qty=jumlah asset detail yg ditransfer
                  $asset['Asset'] = $assetDetail['Asset'];
                  $this->log("old_asset_id=$old_asset_id , [Asset][id]={$asset['Asset']['id']}, new_asset_id=$new_asset_id");
                  if ($old_asset_id != $asset['Asset']['id']) 
				  {
                        $this->log('creating asset');
                        $old_asset_id = $asset['Asset']['id'];
                        //create new asset induk
                        $asset['Asset']['department_id'] = $dest_department_id;
                        $asset['Asset']['department_sub_id'] = $dest_department_sub_id;
                        $asset['Asset']['department_unit_id'] = $dest_department_unit_id;
                        $asset['Asset']['business_type_id'] = $dest_business_type_id;
                        $asset['Asset']['cost_center_id'] = $dest_cost_center_id;
                        $asset['Asset']['date_start'] = $doc_date;
                        $asset['Asset']['source'] = 'mutasi';
                        $asset['Asset']['qty'] = 1;
                        $code = $asset['Asset']['code'] = $this->Movement->MovementDetail->AssetDetail->Asset->getNewId($asset['Asset']['asset_category_id'], $asset['Asset']['date_of_purchase'], $asset['Asset']['department_id'], $asset['Asset']['item_code']);
                        unset($asset['Asset']['id']);
                        $this->log('asset=' . var_export($asset, true));
                        $AssetModel->create();
                        if (!$AssetModel->save($asset))
                              return false;
                        $new_asset_id = $AssetModel->id;
                        $this->log('created asset: id=' . $new_asset_id);

						/******************
						updating assets qty
						******************/
                        $sql = 'update assets set qty=qty-1 where id="' . $old_asset_id . '"';
                        $this->log('updating old asset qty: ' . $sql);
                        $this->Movement->query($sql);

                        $sql = 'update assets set amount=qty*price,amount_cur=qty*price_cur where id="' . $old_asset_id . '"';
                        $this->log('updating old asset amount: ' . $sql);
                        $this->Movement->query($sql);

                        $this->log('updated old asset');
                  }
                  else 
				  {
						/*****************
						updating old asset 
						*****************/
                        $sql = 'update assets set qty=qty-1 where id="' . $old_asset_id . '"';
                        $this->log('updating old asset qty: ' . $sql);
                        $this->Movement->query($sql);

                        $sql = 'update assets set amount=qty*price,amount_cur=qty*price_cur where id="' . $old_asset_id . '"';
                        $this->log('updating old asset amount: ' . $sql);
                        $this->Movement->query($sql);
                        $this->log('updated old asset');
						
						/*****************
						updating new asset 
						*****************/			
                        $sql = 'update assets set qty=qty+1 where id="' . $new_asset_id . '"';
                        $this->log('updating new asset qty: ' . $sql);
                        $this->Movement->query($sql);
                        $sql = 'update assets set amount=qty*price,amount_cur=qty*price_cur where id="' . $new_asset_id . '"';
                        $this->log('updating new asset amount: ' . $sql);
                        $this->Movement->query($sql);

                        $this->log('updated new asset');
                  }

				/******
				delete old asset if qty = 0
				*******/
				$sql = 'delete from assets where qty=0 and id="' . $old_asset_id . '"';
				$this->log('deleting old asset if qty=0: ' . $sql);
				$this->Movement->query($sql);
				$this->log('deleted old asset : '  . $this->Movement->getAffectedRows() );
				
				//3. create new asset_detail to destination department
                  $this->log('creating asset_detail');
                  //unset($assetDetail['AssetDetail']['id']);
                  unset($assetDetail['Asset']);
                  $this->Movement->MovementDetail->AssetDetail->create();
                  $assetDetail['AssetDetail']['department_id'] = $dest_department_id;
                  $assetDetail['AssetDetail']['department_sub_id'] = $dest_department_sub_id;
                  $assetDetail['AssetDetail']['department_unit_id'] = $dest_department_unit_id;
                  $assetDetail['AssetDetail']['business_type_id'] = $dest_business_type_id;
                  $assetDetail['AssetDetail']['cost_center_id'] = $dest_cost_center_id;
                  $assetDetail['AssetDetail']['date_start'] = $doc_date;
                  $assetDetail['AssetDetail']['source'] = 'mutasi';
                  $assetDetail['AssetDetail']['asset_id'] = $new_asset_id;
                  $new_code = $assetDetail['AssetDetail']['code'] = $this->Movement->MovementDetail->AssetDetail->getNewId($assetDetail['AssetDetail']['asset_category_id'], $assetDetail['AssetDetail']['date_of_purchase'], $assetDetail['AssetDetail']['department_id'], $assetDetail['AssetDetail']['item_code']);

                  if (!$this->Movement->MovementDetail->AssetDetail->save($assetDetail))
                        return false;
						
						
				//4. update new_asset_code movement details
				$sql = 'update movement_details set new_code = "'.$new_code.'" where id = ' . $md['id'] ;
				$this->log('updating movement details: ' . $sql);
				$this->Movement->query($sql);
				
                  $asset_detail_id = $this->Movement->MovementDetail->AssetDetail->id;
                  $this->log('created asset_detail: id=' . $asset_detail_id . ' asset_id=' . $new_asset_id);
            }
            ///set qty asset induk baru ++		
            return true;
      }

      function add($npb_id=null) {
            if (!empty($this->data)) {
                  $this->Movement->create();
                  //$this->data['Movement']['doc_date']=date("Y-m-d H:i:s");
                  if ($this->Movement->save($this->data)) {
                        $this->data['Movement']['id'] = $this->Movement->id;

                        $this->Session->setFlash(__('The movement has been saved', true), 'default', array('class' => 'ok'));
                        $this->redirect(array('action' => 'view', $this->Movement->id));
                  } else {
                        $this->Session->setFlash(__('The movement could not be saved. Please, try again.', true));
                  }
            }

            $newId = $this->Movement->getNewId();
            $departments = $this->Movement->Department->find('list');
            $departmentSubs = $this->Movement->DepartmentSub->find('list');
            $departmentUnits = $this->Movement->DepartmentUnit->find('list');
            $businessTypes = $this->Movement->BusinessType->find('list');
			$costCenters = $this->Movement->CostCenter->find('list');
			//$cc 			= $this->Movement->query('select a.id,a.name,b.t24_dao from cost_centers a left join cost_center_to_daos b on b.cost_center_id = a.id where a.remarks = "Y" order by a.name');
			//foreach($cc as $data){
			//	if($data[0]['t24_dao']){
			//		$costCenters[ $data[0]['id'] ]	= $data[0]['name'] . " - " .$data[0]['t24_dao'];
			//	}else{
			//		$costCenters[ $data[0]['id'] ]	= $data[0]['name'];
			//	}				
			//}
            $statuses = $this->Movement->MovementStatus->find('list');
            $requestTypes = $this->Movement->RequestTypes->find('list');
            //$npbs = $this->Movement->NpbDetail->Npb->find('list');
			$moduleName = 'Fixed Assets > FA Transfers > New FA Transfers';
			$this->set('title_for_layout',  $this->lastSegment($moduleName));
            $this->set(compact('departments', 'newId', 'statuses', 'requestTypes', 'departmentSubs', 
				'departmentUnits', 'businessTypes', 'costCenters'/* ,'npbs' */, 'moduleName'));
      }

      function edit($id = null) {
            if (!$id && empty($this->data)) {
                  $this->Session->setFlash(__('Invalid movement', true));
                  $this->redirect(array('action' => 'index'));
            }
            if (!empty($this->data)) {
                  if ($this->Movement->save($this->data)) {
                        $this->Session->setFlash(__('The movement has been saved', true), 'default', array('class' => 'ok'));
                        $this->redirect(array('action' => 'index'));
                  } else {
                        $this->Session->setFlash(__('The movement could not be saved. Please, try again.', true));
                  }
            }
            if (empty($this->data)) {
                  $this->data = $this->Movement->read(null, $id);
            }

            //$newId = $this->Movement->getNewId();
            $departments = $this->Movement->Department->find('list');
            $departmentSubs = $this->Movement->DepartmentSub->find('list');
            $departmentUnits = $this->Movement->DepartmentUnit->find('list');
            $businessTypes = $this->Movement->BusinessType->find('list');
            $costCenters = $this->Movement->CostCenter->find('list');
			//$cc 			= $this->Movement->query('select a.id,a.name,b.t24_dao from cost_centers a left join cost_center_to_daos b on b.cost_center_id = a.id where a.remarks = "Y" order by a.name');
			//foreach($cc as $data){
			//	if($data[0]['t24_dao']){
			//		$costCenters[ $data[0]['id'] ]	= $data[0]['name'] . " - " .$data[0]['t24_dao'];
			//	}else{
			//		$costCenters[ $data[0]['id'] ]	= $data[0]['name'];
			//	}				
			//}
            $statuses = $this->Movement->MovementStatus->find('list');
            $requestTypes = $this->Movement->RequestTypes->find('list');
            $npbs = $this->Movement->NpbDetail->Npb->find('list');
            $this->set(compact('departments', 'newId', 'statuses', 'requestTypes', 'departmentSubs', 'departmentUnits', 'businessTypes', 'costCenters', 'npbs'));
      }

      function delete($id = null) {
            if (!$id) {
                  $this->Session->setFlash(__('Invalid id for movement', true));
                  $this->redirect(array('action' => 'index'));
            }
			
			if(!empty($id))
			{
				$movement = $this->Movement->read(null, $id);
				if(!empty($movement['NpbDetail'])){
					foreach ($movement['NpbDetail'] as $npbDetail) {
						  $movement_detailfilled = $this->Movement->MovementDetail->find('count', array('conditions'=>array('MovementDetail.npb_detail_id'=>$npbDetail['id'], 'MovementDetail.movement_id'=>$id)));
						  $sisa = $npbDetail['qty_filled'] - $movement_detailfilled ;
						  $sql = 'update npb_details set movement_id=NULL, qty_filled="'.$sisa.'" where id="' . $npbDetail['id'] . '"';
						  $this->Movement->query($sql);
					
					$sql = 'update npbs set npb_status_id=' . status_npb_processing_id . ' where id="' . $npbDetail['npb_id'] . '"';
					$this->Movement->query($sql);
					}
				}
			

				if ($this->Movement->delete($id)) {
				  //reset npb_details
					//$sql = 'update npb_details set qty_filled=0, qty_unfilled=qty, date_finish=NULL where movement_id=' . $id;
					//$this->Movement->query($sql);

					$this->Session->setFlash(__('Movement deleted', true), 'default', array('class' => 'ok'));
					  $this->redirect(array('action' => 'index'));
				}
			}
			
            $this->Session->setFlash(__('Movement was not deleted', true));
            $this->redirect(array('action' => 'index'));
      }

      function reject($id = null) {
            //view Movement
            if (!$id) {
                  $this->Session->setFlash(__('Invalid movement', true));
                  $this->redirect(array('action' => 'index'));
            }

            $mov = $this->Movement->read(null, $id);

            //Add Notes Reject Movement and Change Status
            if (!empty($this->data)) {
                  $this->data['Movement']['id'] = $id;
                  $this->data['Movement']['movement_status_id'] = status_movement_reject_id;
                  if ($this->Movement->save($this->data)) {
                        
                        /// reject MRs
                        $npbDetails = $mov['NpbDetail'];
                        if(!empty($npbDetails)) {
                              foreach($npbDetails as $nd){
                                    $this->Movement->NpbDetail->Npb->id=$nd['npb_id'];
                                    $this->Movement->NpbDetail->Npb->set('npb_status_id', status_npb_reject_id );
                                    $this->Movement->NpbDetail->Npb->set('reject_notes', __('Auto Reject from Movement',true) . ' ' . $mov['Movement']['no'] );
                                    $this->Movement->NpbDetail->Npb->set('reject_by', $this->Session->read('Userinfo.username'));
                                    $this->Movement->NpbDetail->Npb->set('reject_date', date('Y-m-d H:i:s'));
                                    $this->Movement->NpbDetail->Npb->save();
                              }
                        }
                        
                        $this->Session->setFlash(__('The movement has been saved', true), 'default', array('class' => 'ok'));
                        $this->redirect(array('action' => 'index'));
                  } else {
                        $this->Session->setFlash(__('The movement could not be saved. Please, try again.', true));
                  }
            }
            if (empty($this->data)) {
                  $movement = $this->data = $this->Movement->read(null, $id);
            }

            $departments = $this->Movement->Department->find('list');
            $businessTypes = $this->Movement->BusinessType->find('list');
            $costCenters = $this->Movement->CostCenter->find('list');
            $costCenter = $this->Movement->CostCenter->find('list', array('fields' => 'name'));
			//$cc 			= $this->Movement->query('select a.id,a.name,b.t24_dao from cost_centers a left join cost_center_to_daos b on b.cost_center_id = a.id where a.remarks = "Y" order by a.name');
			//foreach($cc as $data){
			//	if($data[0]['t24_dao']){
			//		$costCenter[ $data[0]['id'] ]	= $data[0]['name'] . " - " .$data[0]['t24_dao'];
			//	}else{
			//		$costCenter[ $data[0]['id'] ]	= $data[0]['name'];
			//	}				
			//}
            $assetCategories = $this->Movement->MovementDetail->AssetDetail->AssetCategory->find('list', array('conditions' => array('is_asset' => 1)));
            $statuses = $this->Movement->MovementStatus->find('list');
            $this->set(compact('movement', 'departments', 'statuses', 'assetCategories', 'businessTypes', 'costCenters', 'costCenter'));
      }

      function cancel($id = null) {
            //view Movement
            if (!$id) {
                  $this->Session->setFlash(__('Invalid movement', true));
                  $this->redirect(array('action' => 'index'));
            }

            $this->Movement->read(null, $id);

            //Add Notes Cancel Movement and Change Status
            if (!empty($this->data)) {
                  $this->data['Movement']['id'] = $id;
                  $this->data['Movement']['movement_status_id'] = status_movement_new_id;
                  if ($this->Movement->save($this->data)) {
                        $this->Session->setFlash(__('The movement has been saved', true), 'default', array('class' => 'ok'));
                        $this->redirect(array('action' => 'index'));
                  } else {
                        $this->Session->setFlash(__('The movement could not be saved. Please, try again.', true));
                  }
            }
            if (empty($this->data)) {
                  $movement = $this->data = $this->Movement->read(null, $id);
            }

            $departments = $this->Movement->Department->find('list');
            $businessTypes = $this->Movement->BusinessType->find('list');
            $costCenters = $this->Movement->CostCenter->find('list');
            $costCenter = $this->Movement->CostCenter->find('list', array('fields' => 'name'));
			//$cc 			= $this->Movement->query('select a.id,a.name,b.t24_dao from cost_centers a left join cost_center_to_daos b on b.cost_center_id = a.id where a.remarks = "Y" order by a.name');
			//foreach($cc as $data){
			//	if($data[0]['t24_dao']){
			//		$costCenter[ $data[0]['id'] ]	= $data[0]['name'] . " - " .$data[0]['t24_dao'];
			//	}else{
			//		$costCenter[ $data[0]['id'] ]	= $data[0]['name'];
			//	}				
			//}
            $statuses = $this->Movement->MovementStatus->find('list');
            $assetCategories = $this->Movement->MovementDetail->AssetDetail->AssetCategory->find('list', array('conditions' => array('is_asset' => 1)));
            $this->set(compact('movement', 'departments', 'statuses', 'assetCategories', 'businessTypes', 'costCenters', 'costCenter'));
      }

      function archive($id = null) {
            if (!$id) {
                  $this->Session->setFlash(__('Invalid movement', true));
                  $this->redirect(array('action' => 'index'));
            }

            //reset npb and details
            $sql = 'update npb_details set qty_filled=0, qty_unfilled=qty where movement_id=' . $id;
            $this->Movement->query($sql);

            $movement = $this->Movement->read(null, $id);
            foreach ($movement['NpbDetail'] as $npbDetail) {
                  $sql = 'update npb_details set movement_id=NULL where id="' . $npbDetail['id'] . '"';
                  $this->Movement->query($sql);
            }

            $sql = 'update npbs set npb_status_id=' . status_npb_processing_id . ' where id="' . $npbDetail['npb_id'] . '"';
            $this->Movement->query($sql);

            $this->data['Movement']['id'] = $id;
            $this->data['Movement']['movement_status_id'] = status_movement_archive_id;
            //$this->data['Movement']['npb_id']			 	= NULL;
            if ($this->Movement->save($this->data)) {
                  $this->Session->setFlash(__('The movement has been saved', true), 'default', array('class' => 'ok'));
                  $this->redirect(array('action' => 'index'));
            } else {
                  $this->Session->setFlash(__('The movement could not be saved. Please, try again.', true));
            }
      }

      function reports($type='fa') {
		if($this->data['Movement']['source_cost_center_id'] = '')
			$this->data['Movement']['source_cost_center_id'] = null;
		if($this->data['Movement']['dest_cost_center_id'] = '')
			$this->data['Movement']['dest_cost_center_id'] = null;
            $layout = $this->data['Movement']['layout'];
            $this->Movement->recursive = 2;

            $conditions = array();
            if ($source_department_id = $this->data['Movement']['source_department_id']) {
                  $conditions[] = array('source_department_id' => $source_department_id);
            }
            if ($source_business_type_id = $this->data['Movement']['source_business_type_id']) {
                  $conditions[] = array('source_business_type_id' => $source_business_type_id);
            }
            if ($source_cost_center_id = $this->data['Movement']['source_cost_center_id']) {
                  $conditions[] = array('source_cost_center_id' => $source_cost_center_id);
            }

            if ($dest_department_id = $this->data['Movement']['dest_department_id']) {
                  $conditions[] = array('Movement.dest_department_id' => $dest_department_id);
            }
            if ($dest_business_type_id = $this->data['Movement']['dest_business_type_id']) {
                  $conditions[] = array('Movement.dest_business_type_id' => $dest_business_type_id);
            }
            if ($dest_cost_center_id = $this->data['Movement']['dest_cost_center_id']) {
                  $conditions[] = array('Movement.dest_cost_center_id' => $dest_cost_center_id);
            }
            //*********************
            // $assetDetails = $this->Movement->MovementDetail->AssetDetail->find('all');
            // foreach ($assetDetails as $assetDetail) {
            // if($asset_category_id = $this->data['Movement']['asset_category_id'])  {
            // $conditions[] = array($assetDetail['AssetDetail']['asset_category_id'] =>$asset_category_id);
            // } 
            // }/* echo '<pre>';
            //**********************
            if ($asset_category_id = $this->data['Movement']['asset_category_id'])
                  $conditions[] = array('AssetDetail.asset_category_id' => $asset_category_id);


            /* if($department_sub_id=$this->data['Movement']['source_department_sub_id'])  {
              $conditions[] = array('source_department_sub_id'=>$department_sub_id);
              }
              if($department_unit_id=$this->data['Movement']['source_department_unit_id'])  {
              $conditions[] = array('source_department_unit_id'=>$department_unit_id);
              } */
			$this->paginate = array('order'=>'Movement.id');
            //date- filter
            list($date_start, $date_end) = $this->set_date_filters('Movement');
            $conditions[] = array('doc_date >=' => ($date_start['year'] . '-' . $date_start['month'] . '-' . $date_start['day']),
                'doc_date <=' => ($date_end['year'] . '-' . $date_end['month'] . '-' . $date_end['day']));

            if ($layout == 'pdf' || $layout == 'xls') {
                  $con = $this->Movement->find('all', array('conditions' => $conditions));
            } else {
                  $con = $this->paginate($conditions);
            }

            $this->set('movements', $con);
            $departments = $this->Movement->Department->find('list');
            $departmentSub = $this->Movement->Department->DepartmentSub->find('list');
            $departmentUnit = $this->Movement->Department->DepartmentUnit->find('list');
            $businessType = $this->Movement->Department->BusinessType->find('list');
            $costCenter = $this->Movement->CostCenter->find('list');
            $costCenters = $this->Movement->CostCenter->find('list', array('fields' => 'name'));
			//$cc 			= $this->Movement->query('select a.id,a.name,b.t24_dao from cost_centers a left join cost_center_to_daos b on b.cost_center_id = a.id where a.remarks = "Y" order by a.name');
			//foreach($cc as $data){
			//	if($data[0]['t24_dao']){
			//		$costCenters[ $data[0]['id'] ]	= $data[0]['name'] . " - " .$data[0]['t24_dao'];
			//	}else{
			//		$costCenters[ $data[0]['id'] ]	= $data[0]['name'];
			//	}				
			//}
            $assetCategories = $this->Movement->MovementDetail->AssetDetail->AssetCategory->find('list', array('conditions' => array('is_asset' => 1)));
            $copyright_id = $this->configs['copyright_id'];
            $this->set(compact('departments', 'departmentSub', 'departmentUnit', 'source_department_id', 'costCenters', 'department_unit_id', 'department_sub_id', 'assetCategories', 'copyright_id', 'date_start', 'date_end', 'businessType', 'costCenter', 'source_business_type_id', 'source_cost_center_id', 'dest_department_id', 'dest_business_type_id', 'dest_cost_center_id', 'asset_category_id'));




            if ($layout == 'pdf') {
                  Configure::write('debug', 0); // Otherwise we cannot use this method while developing 
                  $this->layout = 'pdf'; //this will use the pdf.ctp layout 
                  $this->render('report_fa_pdf');
            } else if ($layout == 'xls') {
                  $this->render('report_fa_xls', 'export_xls');
            }
            else
                  $this->render('report_' . $type);
      }

}

?>
