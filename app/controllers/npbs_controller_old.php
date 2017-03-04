<?php

App::import('Model', 'InventoryLedger', 'Group');
App::import('CakeEmail');

class NpbsController extends AppController {

      var $name = 'Npbs';
      var $helpers = array('Html', 'Ajax', 'Javascript', 'Number', 'Time');
      var $components = array('RequestHandler','Email');
	  
      function index($npb_status_id=null, $is_done=null, $no=null, $request_type_id=null, $department_id=null, $business_type_id=null, $cost_center_id=null /* , $request_type_id=null */) {
			$moduleName = 'MR > List MR';
			$this->set('title_for_layout',  $this->lastSegment($moduleName));
            $this->Session->write('Npb.can_select_supplier', $this->Session->read('Security.permissions') 	== gs_group_id ? true : false);
            $this->Session->write('Npb.is_branch_head', $this->Session->read('Security.permissions') 		== branch_head_group_id ? true : false);
            $this->Session->write('Npb.is_approval2', $this->Session->read('Security.permissions') 			== mr_aproval2_group_id ? true : false);
            $this->Session->write('Npb.is_approval2', $this->Session->read('Security.permissions') 			== mr_aproval3_group_id ? true : false);
            $this->Session->write('Npb.is_normal_user', $this->Session->read('Security.permissions') 		== normal_user_group_id ? true : false);
            $this->Session->write('Npb.is_gs_user', $this->Session->read('Security.permissions') 			== gs_group_id ? true : false);
            $this->Session->write('Npb.is_gs_admin', $this->Session->read('Security.permissions') 			== gs_admin_group_id ? true : false);
            $this->Session->write('Npb.is_it_admin', $this->Session->read('Security.permissions') 			== it_admin_group_id ? true : false);
            $this->Session->write('Npb.is_stock_management', $this->Session->read('Security.permissions') 	== stock_management_group_id ? true : false);
            $this->Session->write('Npb.is_stock_supervisor', $this->Session->read('Security.permissions') 	== stock_supervisor_group_id ? true : false);
            $group_id = $this->Session->read('Security.permissions');
            $dept_id = $this->Session->read('Userinfo.department_id');
            $username = $this->Session->read('Userinfo.username');
            $layout = $this->data['Npb']['layout'];
            //// filter NPBs
            if ($group_id == admin_group_id)//admin
                  $conditions = array();

            else if ($group_id == branch_head_group_id)//pimcab
                  $conditions = array(
                      'AND' => array(
							array('department_id' => $dept_id),
					  'OR' => array(	  
                           array('npb_status_id' => status_npb_branch_approved_id),
                           array('npb_status_id' => status_npb_sent_to_branch_head_id),
                           array('npb_status_id' => status_npb_processing_id))
						)
						
				);
				  
			else if ($group_id == mr_aproval2_group_id)//approval 2
                  $conditions = array(
                      'AND' => array(
					  'OR' => array(	  
                           array('npb_status_id' => status_npb_branch_approved_id),
                           array('npb_status_id' => status_npb_approved2_id),
                           array('npb_status_id' => status_npb_processing_id))
					)
                  );
				  
			else if ($group_id == mr_aproval3_group_id)//approval 3
                  $conditions = array(
                      'AND' => array(
					  'OR' => array(	  
                           array('npb_status_id' => status_npb_approved2_id),
                           array('npb_status_id' => status_npb_approved3_id),
                           array('npb_status_id' => status_npb_processing_id))
					)
                  );

            else if ($group_id == gs_group_id) //gs
            /// gs procurement cuma bisa lihat yang status_processing_id dan item detailnya (procurement dan qty_filled=0)
                  $conditions = array(
                      'AND' => array(
                          'OR' => array(
                              array('npb_status_id' => status_npb_sent_to_gs_supervisor_id),
                              array('npb_status_id' => status_npb_processing_id),
                              array('npb_status_id' => status_npb_done_id),
                              array('npb_status_id' => status_npb_draft_id),
                              array('npb_status_id' => status_npb_approved_by_supervisor_id),
                              array('npb_status_id' => status_npb_sent_to_supervisor_id),
                              array('npb_status_id' => status_npb_stock_manager_processed_id),
                              array('npb_status_id' => status_npb_sent_to_stock_management_id),
                              array('npb_status_id' => status_npb_sent_to_branch_head_id),
                              array('npb_status_id' => status_npb_rac_processed_id),
                              array('npb_status_id' => status_npb_branch_approved_id)),
                      )
						);
            else if ($group_id == gs_spv_group_id) //gs_SPV
                  $conditions = array(
                      'AND' => array(
                          'OR' => array(
                              array('npb_status_id' => status_npb_sent_to_gs_supervisor_id),
                              array('npb_status_id' => status_npb_processing_id),
                              array('npb_status_id' => status_npb_done_id),
                              array('npb_status_id' => status_npb_draft_id),
                              array('npb_status_id' => status_npb_approved_by_supervisor_id),
                              array('npb_status_id' => status_npb_sent_to_supervisor_id),
                              array('npb_status_id' => status_npb_stock_manager_processed_id),
                              array('npb_status_id' => status_npb_sent_to_stock_management_id),
                              array('npb_status_id' => status_npb_sent_to_branch_head_id),
                              array('npb_status_id' => status_npb_branch_approved_id)),
                      )
                  );
            else if ($group_id == gs_admin_group_id) //gs_admin
                  $conditions = array(
                      'AND' => array(
							  array('request_type_id' => array(request_type_fa_general_id, request_type_stock_id, request_type_service_id)),
                          'OR' => array(
                              array('npb_status_id' => status_npb_sent_to_gs_supervisor_id),
                              array('npb_status_id' => status_npb_processing_id),
                              array('npb_status_id' => status_npb_done_id),
                              array('npb_status_id' => status_npb_draft_id),
                              array('npb_status_id' => status_npb_approved_by_supervisor_id),
                              array('npb_status_id' => status_npb_sent_to_supervisor_id),
                              array('npb_status_id' => status_npb_stock_manager_processed_id),
                              array('npb_status_id' => status_npb_sent_to_stock_management_id),
                              array('npb_status_id' => status_npb_sent_to_branch_head_id),
                              array('npb_status_id' => status_npb_branch_approved_id)),
                      )
                  );

            else if ($group_id == it_admin_group_id) //it_admin
                  $conditions = array(
                      'AND' => array(
							  array('request_type_id' => request_type_fa_it_id),
                          'OR' => array(
                              array('npb_status_id' => status_npb_sent_to_gs_supervisor_id),
                              array('npb_status_id' => status_npb_processing_id),
                              array('npb_status_id' => status_npb_done_id),
                              array('npb_status_id' => status_npb_draft_id),
                              array('npb_status_id' => status_npb_approved_by_supervisor_id),
                              array('npb_status_id' => status_npb_sent_to_supervisor_id),
                              array('npb_status_id' => status_npb_sent_to_branch_head_id),
                              array('npb_status_id' => status_npb_branch_approved_id)),
						)
                  );
            else if ($group_id == fa_management_group_id) { //fa_management
                  if(DRIVER=='mysql')
                        $v_is_done =  '(select if(sum(qty-qty_filled)=0,1,0) from npb_details where npb_details.npb_id=Npb.id
										and npb_details.process_type_id=' . movement_process_type_id . ')' ;
                  elseif(DRIVER=='mssql')
                        $v_is_done =  '(select case sum(qty-qty_filled) when 0 then 1 else 0 end 
								from npb_details where npb_details.npb_id=Npb.id
								and npb_details.process_type_id=' . movement_process_type_id . ')' ;

                  $conditions = array(
                      'AND' => array(
							array(
								'Npb.request_type_id =' =>  request_type_fa_general_id,
								$v_is_done => 0,
							),
							'OR' => array(
								'Npb.npb_status_id' => status_npb_processing_id,
								  array('npb_status_id' => status_npb_sent_to_gs_supervisor_id),
								  array('npb_status_id' => status_npb_processing_id),
								  array('npb_status_id' => status_npb_done_id),
								  array('npb_status_id' => status_npb_draft_id),
								  array('npb_status_id' => status_npb_approved_by_supervisor_id),
								  array('npb_status_id' => status_npb_sent_to_supervisor_id),
								  array('npb_status_id' => status_npb_sent_to_branch_head_id),
								  array('npb_status_id' => status_npb_branch_approved_id)),
						)
                  );
                  //debug($conditions);
            } else if ($group_id == it_management_group_id){ //it_management
                  if(DRIVER=='mysql')
                        $v_is_done =  '(select if(sum(qty-qty_filled)=0,1,0) from npb_details where npb_details.npb_id=Npb.id
										and npb_details.process_type_id=' . movement_process_type_id . ')' ;
                  elseif(DRIVER=='mssql')
                        $v_is_done =  '(select case sum(qty-qty_filled) when 0 then 1 else 0 end 
								from npb_details where npb_details.npb_id=Npb.id
								and npb_details.process_type_id=' . movement_process_type_id . ')' ;

                  $conditions = array(
						'AND' => array(
							array(
								'Npb.request_type_id =' =>  request_type_fa_it_id,
								$v_is_done => 0,
							),
							'OR' => array(
								'Npb.npb_status_id' => status_npb_processing_id,
								array('npb_status_id' => status_npb_sent_to_gs_supervisor_id),
								  array('npb_status_id' => status_npb_processing_id),
								  array('npb_status_id' => status_npb_done_id),
								  array('npb_status_id' => status_npb_sent_to_it_management_id),
								  array('npb_status_id' => status_npb_draft_id),
								  array('npb_status_id' => status_npb_approved_by_supervisor_id),
								  array('npb_status_id' => status_npb_sent_to_supervisor_id),
								  array('npb_status_id' => status_npb_sent_to_branch_head_id),
								  array('npb_status_id' => status_npb_branch_approved_id)),
						)
                        
                    );
				  }
            else if ($group_id == stock_management_group_id) //stock_management
                  $conditions = array(
                      'AND' => array(
                          'OR' => array(
							  array('npb_status_id' => status_npb_sent_to_gs_supervisor_id),
                              array('npb_status_id' => status_npb_processing_id),
                              array('npb_status_id' => status_npb_done_id),
                              array('npb_status_id' => status_npb_draft_id),
                              array('npb_status_id' => status_npb_approved_by_supervisor_id),
                              array('npb_status_id' => status_npb_sent_to_supervisor_id),
                              array('npb_status_id' => status_npb_stock_manager_processed_id),
                              array('npb_status_id' => status_npb_sent_to_stock_management_id),
                              array('npb_status_id' => status_npb_sent_to_branch_head_id),
                              array('npb_status_id' => status_npb_branch_approved_id)),
                          'OR' => array(
                              array('request_type_id' => request_type_point_reward_id),
                              array('request_type_id' => request_type_stock_id),
                              array('request_type_id' => request_type_service_id)),
  						  //'npb_status_id !=' =>  status_npb_archive_id,
						  'created_by' => $username,
                    )
                  );
            else if ($group_id == stock_supervisor_group_id) //stock_supervisor_group_id
                  $conditions = array(
                      'AND' => array(
                          'OR' => array(
                              array('npb_status_id' => status_npb_sent_to_gs_supervisor_id),
                              array('npb_status_id' => status_npb_processing_id),
                              array('npb_status_id' => status_npb_done_id),
                              array('npb_status_id' => status_npb_draft_id),
                              array('npb_status_id' => status_npb_approved_by_supervisor_id),
                              array('npb_status_id' => status_npb_sent_to_supervisor_id),
                              array('npb_status_id' => status_npb_stock_manager_processed_id),
                              array('npb_status_id' => status_npb_sent_to_stock_management_id),
                              array('npb_status_id' => status_npb_sent_to_branch_head_id),
                              array('npb_status_id' => status_npb_branch_approved_id)),
                          'OR' => array(
                              array('request_type_id' => request_type_stock_id),
                              array('request_type_id' => request_type_point_reward_id),
                              array('request_type_id' => request_type_service_id)),
 						  //'npb_status_id !=' =>  status_npb_archive_id
                     )
                  );
            else if ($group_id == rac_group_id) //RAC
                  $conditions = array(
                      'AND' => array(
							array('request_type_id' => request_type_point_reward_id),
                          'OR' => array(                              
                              array('npb_status_id' => status_npb_draft_id),                              
                              array('npb_status_id' => status_npb_sent_to_rac_id)),
                     )
                  );
			else if ($group_id == rac_approval_group_id) //RAC
                  $conditions = array(
                      'AND' => array(
							array('request_type_id' => request_type_point_reward_id),
                          'OR' => array(                                                       
                              array('npb_status_id' => status_npb_sent_to_rac_id),                              
                              array('npb_status_id' => status_npb_rac_processed_id),                              
                              array('npb_status_id' => status_npb_processing_id)),
                     )
                  );
            else //normal users
                  $conditions = array(
                      'AND' => array(
                          'department_id' => $dept_id,
                          'created_by' => $username,
                     )
                  );
				  
				//echo '<pre>';
				//var_dump($conditions);
				//echo '</pre>';die();
		
			if(!empty( $this->data ) )
			{
				//approve via checkbox
				if(isset($this->data['Npb']['npb_id'])){	
					$npb_id_updates = $this->data['Npb']['npb_id'];
					$arr = array();
					foreach ($npb_id_updates as $npb_id_update){						
						if($npb_id_update > 0){
							$arr[]['id'] 	= $npb_id_update;
							
							/*$this->data['Npb']['id'] = $npb_id_update;
							$this->data['Npb']['npb_status_id'] = status_npb_processing_id;
							$this->data['Npb']['approved_by'] = $this->Session->read('Userinfo.username');
							$this->data['Npb']['approved_date'] = date("Y-m-d");
							if($this->Npb->save($this->data)){
								$this->Session->setFlash(__('The Npb(s) has been approved', true), 'default', array('class'=>'ok'));
								$this->redirect(array('action' => 'index', status_npb_branch_approved_id));
							}else{
								$this->Session->setFlash(__('The Npb(s) could not be approved. Please, try again.', true));
								$this->redirect(array('action' => 'index', status_npb_branch_approved_id));
							}*/
						}
					}	
					$this->update_status_npbs($arr,status_npb_processing_id);	
				}
			}
				  
			// setup filter req type
			if ($request_type_id)
                  $this->Session->write('Npb.request_type_id', $request_type_id);
            else if (isset($this->data['Npb']['request_type_id']))
                  $this->Session->write('Npb.request_type_id', $this->data['Npb']['request_type_id']);
            if ($request_type_id = $this->Session->read('Npb.request_type_id'))
                  $conditions[] = array('request_type_id' => $request_type_id);

            //set up filters session
            if ($npb_status_id)
                  $this->Session->write('Npb.npb_status_id', $npb_status_id);
            else if (isset($this->data['Npb']['npb_status_id']))
                  $this->Session->write('Npb.npb_status_id', $this->data['Npb']['npb_status_id']);
            if ($npb_status_id = $this->Session->read('Npb.npb_status_id'))
                  $conditions[] = array('npb_status_id' => $npb_status_id);
				  $conditions[] = array('npb_status_id !=' =>  status_npb_archive_id);

            //is done filter
            if ($is_done)
                  $this->Session->write('Npb.is_done', $is_done);
            else if (isset($this->data['Npb']['is_done']))
                  $this->Session->write('Npb.is_done', $this->data['Npb']['is_done']);
            $is_done = $this->Session->read('Npb.is_done');
			
			if(DRIVER=='mysql') {
				if ($is_done == 1)
					  $conditions[] = array('(SELECT if(sum(qty-qty_filled)=0, 1, 0) FROM npb_details WHERE npb_details.npb_id = Npb.id) = 1');
				else if ($is_done == 2)
					  $conditions[] = array('(SELECT if(sum(qty-qty_filled)=0, 1, 0) FROM npb_details WHERE npb_details.npb_id = Npb.id) = 0');
			}
			elseif(DRIVER=='mssql') {
				if ($is_done == 1)
					  $conditions[] = array('(select case sum(qty-qty_filled) when 0 then 1 else 0 end from npb_details where npb_details.npb_id=Npb.id) = 1');
				else if ($is_done == 2)
					  $conditions[] = array('(select case sum(qty-qty_filled) when 0 then 1 else 0 end from npb_details where npb_details.npb_id=Npb.id) = 0');
			}
            //department_id filter
            if (isset($this->data['Npb']['department_id']))
                  $this->Session->write('Npb.department_id', $this->data['Npb']['department_id']);
            if ($department_id = $this->Session->read('Npb.department_id'))
                  $conditions[] = array('Npb.department_id' => $department_id);
            if (isset($this->data['Npb']['department_sub_id']))
                  $this->Session->write('Npb.department_sub_id', $this->data['Npb']['department_sub_id']);
            if ($department_sub_id = $this->Session->read('Npb.department_sub_id'))
                  $conditions[] = array('Npb.department_sub_id' => $department_sub_id);
            if (isset($this->data['Npb']['department_unit_id']))
                  $this->Session->write('Npb.department_unit_id', $this->data['Npb']['department_unit_id']);
            if ($department_unit_id = $this->Session->read('Npb.department_unit_id'))
                  $conditions[] = array('Npb.department_unit_id' => $department_unit_id);

            //business_type_id filter
            if (isset($this->data['Npb']['business_type_id']))
                  $this->Session->write('Npb.business_type_id', $this->data['Npb']['business_type_id']);
            if ($business_type_id = $this->Session->read('Npb.business_type_id'))
                  $conditions[] = array('Npb.business_type_id' => $business_type_id);

            // number filter
			/* if(isset($this->data['Npb']['no']))
				if(trim($this->data['Npb']['no']) == '')
				$this->data['Npb']['no']=null;
			$this->Session->write('Npb.no', $this->data['Npb']['no']);
			if ($no = $this->Session->read('Npb.no'))
				$conditions[] = array('Npb.no LIKE' => '%'. $no . '%'); */
			if ($no)
                  $this->Session->write('Npb.no', trim($no));
            else if (isset($this->data['Npb']['no']))
                  $this->Session->write('Npb.no', trim($this->data['Npb']['no']));
            if ($no = trim($this->Session->read('Npb.no')))
                  $conditions[] = array('Npb.no LIKE' => '%'. $no . '%');
			
			//cost_center_id filter
            if (isset($this->data['Npb']['cost_center_id']))
 				if($this->data['CostCenter']['name'] == '')
					$this->data['Npb']['cost_center_id'] = null;
                  $this->Session->write('Npb.cost_center_id', $this->data['Npb']['cost_center_id']);
            if ($cost_center_id = $this->Session->read('Npb.cost_center_id'))
                  $conditions[] = array('Npb.cost_center_id' => $cost_center_id);

            //date- filter
            list($date_start, $date_end) = $this->set_date_filters('Npb');
            $conditions[] = array('Npb.npb_date >=' => ($date_start['year'] . '-' . $date_start['month'] . '-' . $date_start['day']),
                'Npb.npb_date <=' => ($date_end['year'] . '-' . $date_end['month'] . '-' . $date_end['day']));
            $this->paginate = array('order'=>'Npb.id');
            $this->Npb->recursive = 0;
            if ($layout == 'pdf' || $layout == 'xls') {
                  $con = $this->Npb->find('all', array('conditions' => $conditions, 'order'=>'Npb.id'));
            } else {
                  $con = $this->paginate($conditions);
            }
			
			$can_print_status	= $this->Npb->query('select a.source_npb_id, a.do_id, b.delivery_order_status_id from npbs_point_rewards a 
										left join delivery_orders b on b.id = a.do_id');
			
			
			
			$n = 0;
			foreach($can_print_status as $data){
				if($data[0]['delivery_order_status_id'] != status_delivery_order_done_id){
					unset($can_print_status[$n]);
				}
				$n++;
			}
			$can_print_status = array_values($can_print_status);
			
			//echo '<pre>';
			//var_dump($can_print_status);
			//echo '</pre>';die();

            $this->set('npbs', $con);
            $copyright_id = $this->configs['copyright_id'];
            $npbStatuses = $this->Npb->NpbStatus->find('list', array('conditions' =>array('id !=' => status_npb_archive_id, 'id !=' => status_npb_dummy_id))); //archive);
            $departments = $this->Npb->Department->find('list');
            $departmentSub = $this->Npb->Department->DepartmentSub->find('list', array('conditions' => array('department_id' => $department_id)));
            $departmentUnit = $this->Npb->Department->DepartmentUnit->find('list', array('conditions' => array('department_id' => $department_id)));
            $businessType = $this->Npb->BusinessType->find('list');
            $costCenter = $this->Npb->CostCenter->find('list');
            $costCenters = $this->Npb->CostCenter->find('list', array('fields' => 'name'));
			//$cc 			= $this->Npb->query('select a.id,a.name,b.t24_dao from cost_centers a left join cost_center_to_daos b on b.cost_center_id = a.id where a.remarks = "Y" order by a.name');
			//foreach($cc as $data){
			//	if($data[0]['t24_dao']){
			//		$costCenters[ $data[0]['id'] ]	= $data[0]['name'] . " - " .$data[0]['t24_dao'];
			//	}else{
			//		$costCenters[ $data[0]['id'] ]	= $data[0]['name'];
			//	}				
			//}
            $requestTypes = $this->Npb->RequestTypes->find('list');
            $this->set(compact('npbStatuses', 'departments', 'date_start', 'date_end', 'requestTypes', 'costCenter', 'costCenters', 'departmentSub', 'departmentUnit', 'copyright_id', 'businessType'
                    , 'moduleName', 'can_print_status'));
			
            if ($layout == 'pdf') {
                  Configure::write('debug', 1); // Otherwise we cannot use this method while developing
                  $this->layout = 'pdf'; //this will use the pdf.ctp layout
                  $this->render('index_pdf');
            } else if ($layout == 'xls') {
                  $this->render('index_xls', 'export_xls');
            }
      }
	  
	  function update_status_npbs($ids=null, $new_status=null) {
		if (!$ids) {
			  $this->Session->setFlash(__('Invalid npb id', true));
			  $this->redirect(array('action' => 'view', $id));
		}
		//echo '<pre>';
		//var_dump($ids);
		//echo '</pre>';die();
		foreach($ids as $data){
			$id = $data['id'];
			if ($new_status == status_npb_processing_id) {
				$this->data['Npb']['approved_date'] 	= date('Y-m-d H:i:s');
				$this->data['Npb']['approved_by'] 		= $this->Session->read('Userinfo.username');
				$this->data['Npb']['npb_status_id'] 	= $new_status;
				$this->data['Npb']['id'] 				= $id;
			}
			$this->Npb->save($this->data);			
			/*
			if ($new_status == status_npb_processing_id) {
				$this->save_to_ledger($id);
			}
			*/
		}
		$this->Session->setFlash(__('The Npb(s) has been approved', true), 'default', array('class'=>'ok'));
		$this->redirect(array('action' => 'index', status_npb_branch_approved_id));
	}

      function ajax_view($id=null) {
            $this->layout = 'ajax';
            $this->autoRender = false;
            $npb = $this->Npb->read(null, $id);
            echo json_encode(array('data' => $npb));
      }

      function view($id = null,$no_procces=null, $approved_history=null) {
            if (!$id) {
                  $this->Session->setFlash(__('Invalid npb', true));
                  $this->redirect(array('action' => 'index'));
            }
			$this->Npb->recursive = 1;
            $npb = $this->Npb->read(null, $id);
			
			foreach ($npb['NpbDetail'] as $npbDetail) {	  
				  $sql = "update npb_details set qty_unfilled=qty, qty_filled=0 where id='".$npbDetail['id']."';";
				  $this->Npb->query($sql);
			}			

			
            $group_id = $this->Session->read('Security.permissions');
            $username = $this->Session->read('Userinfo.username');
            $npb_status_id = $npb['Npb']['npb_status_id'];
            $request_type_id = $npb['Npb']['request_type_id'];
            $npb_is_done = $npb['Npb']['v_is_done'] ? true : false;
            $npb_is_printed = $npb['Npb']['is_printed'] ? 1 : 0;
		
            $this->Session->write('Npb.can_select_supplier', $group_id == gs_group_id ? true : false);
            $this->Session->write('Npb.is_branch_head', $group_id == branch_head_group_id ? true : false);
            $this->Session->write('Npb.is_approval2_head', $group_id == mr_aproval2_group_id ? true : false);
            $this->Session->write('Npb.is_approval3_head', $group_id == mr_aproval3_group_id ? true : false);
            $this->Session->write('Npb.is_normal_user', $group_id == normal_user_group_id ? true : false);
            $this->Session->write('Npb.is_gs_user', $group_id == gs_group_id ? true : false);
            $this->Session->write('Npb.is_gs_admin', $group_id == gs_admin_group_id ? true : false);
            $this->Session->write('Npb.is_it_admin', $group_id == it_admin_group_id ? true : false);
            $this->Session->write('Npb.is_it_management', $group_id == it_management_group_id ? true : false);
            $this->Session->write('Npb.is_stock_management', $group_id == stock_management_group_id ? true : false);
            $this->Session->write('Npb.is_stock_supervisor', $group_id == stock_supervisor_group_id ? true : false);

            //set up session npb.request_type_id
            $this->Session->write('Npb.request_type_id', $request_type_id);
            
            //set up session npb.department_id
            $this->Session->write('Npb.department_id', $npb['Npb']['department_id']);
/*             //set up session npb.department_sub_id
            //$this->Session->write('Npb.department_sub_id', $npb['Npb']['department_sub_id']);
            //set up session npb.department_unit_id
            //$this->Session->write('Npb.department_unit_id', $npb['Npb']['department_unit_id']);
 */            //set up session npb.business_type_id
            $this->Session->write('Npb.business_type_id', $npb['Npb']['business_type_id']);
            //set up session npb.cost_center_id
            $this->Session->write('Npb.cost_center_id', $npb['Npb']['cost_center_id']);
			
            $this->Session->write('Npb.is_purchase_request', false);
            $this->Session->write('Npb.can_edit', false);
            $this->Session->write('Npb.can_send_to_branch_head', false);
            $this->Session->write('Npb.can_edit_price', false);
            $this->Session->write('Npb.can_attachment', false);
            $this->Session->write('Npb.can_create_po', false);
            $this->Session->write('Npb.can_create_movement', false);
            $this->Session->write('Npb.can_approval_it_manager', false);
            $this->Session->write('Npb.can_print_npb', false);
            $this->Session->write('Npb.can_cancel', false);
            $this->Session->write('Npb.can_reject', false);
            $this->Session->write('Npb.can_set_process_type', false);
            $this->Session->write('Npb.can_send_for_processing', false);
            $this->Session->write('Npb.can_approve_branch', false);
            $this->Session->write('Npb.can_check_stock', false);
            $this->Session->write('Npb.can_archive', false);
            $this->Session->write('Npb.can_sent_to_gs_spv', false);

            if ($group_id == normal_user_group_id || $group_id == rac_group_id) {
				
                  //new npb at cabang
                  $this->Session->write('Npb.can_edit', $npb['Npb']['created_by'] == $username
                          && $npb_status_id == status_npb_draft_id);

                  //can send to branch head
                  $this->Session->write('Npb.can_send_to_branch_head', $npb['Npb']['created_by'] == $username
                          && $npb_status_id == status_npb_draft_id);

                  //can_attachment
                  $this->Session->write('Npb.can_attachment', $npb['Npb']['created_by'] == $username &&
                          $npb_status_id == status_npb_draft_id);

                  //archive
                  $this->Session->write('Npb.can_archive', $npb['Npb']['created_by'] == $username &&
                          $npb_status_id == status_npb_reject_id);
						  
				$this->Session->write('Npb.can_set_process_type', true);
            } elseif ($group_id == branch_head_group_id) {
                  if ($npb_status_id == status_npb_sent_to_branch_head_id) {
                        /// NPB Reject status_npb_sent_to_branch_head_id login branch_head_group_id
                        $this->Session->write('Npb.can_reject', true);

                        /// NPB Cancel status_npb_sent_to_branch_head_id login branch_head_group_id
                        $this->Session->write('Npb.can_cancel', true);

                        /// can approve branch head
                        $this->Session->write('Npb.can_approve_branch', true);
                  }
            } elseif ($group_id == it_admin_group_id) {
                  if ($request_type_id == request_type_fa_it_id) {
                        //can set process type
                        //$this->Session->write('Npb.can_set_process_type', true);

                        if ($npb_status_id == status_npb_branch_approved_id) {
                              //Request for it items
                              $this->Session->write('Npb.can_edit_price', true);
							  
							  $this->Session->write('Npb.can_edit', true);         
							  
							  $this->Session->write('Npb.can_set_process_type', true);
							  //can add attahcment
                              $this->Session->write('Npb.can_attachment', true);

                              /// NPB Reject status_npb_branch_approved_id login it_admin_group_id
                              $this->Session->write('Npb.can_reject', true);

                              /// NPB Cancel status_npb_branch_approved_id login it_admin_group_id
                              $this->Session->write('Npb.can_cancel', true);

                              //can flag it approval
                              if ($npb_is_printed) {
                                    $this->Session->write('Npb.can_approval_it_manager', true);
                              }
                              //can print NPB
                              $this->Session->write('Npb.can_print_npb', true);
                        }
                  }
            } elseif ($group_id == gs_admin_group_id) {
                //gs admin to gs spv
				//if ($request_type_id != request_type_stock_id)
                    //$this->Session->write('Npb.can_set_process_type', true);

					//$this->Session->write('Npb.can_sent_to_gs_spv', !$npb_is_done);
					if ($npb_status_id == status_npb_branch_approved_id && $request_type_id != request_type_fa_it_id) {
						$this->Session->write('Npb.can_sent_to_gs_spv', true);//yg saya ubah
                        $this->Session->write('Npb.can_cancel', true);
						if($request_type_id == request_type_stock_id || $request_type_id == request_type_service_id || $request_type_id == request_type_point_reward_id){
							$this->Session->write('Npb.can_set_process_type', false);
						}else{
							$this->Session->write('Npb.can_set_process_type', true);
						}
					}
				///modul stock
				//gs admin to stock spv
				if ($request_type_id == request_type_stock_id)
					if ($npb_status_id == status_npb_branch_approved_id) {
						$this->Session->write('Npb.can_send_to_supervisor', false);
                        $this->Session->write('Npb.can_cancel', true);
					}
            } elseif ($group_id == gs_spv_group_id) {
				  if ($request_type_id != request_type_stock_id)
                        $this->Session->write('Npb.can_set_process_type', false);
					//$this->Session->write('Npb.can_send_for_processing', !$npb_is_done);
                  if ($npb_status_id == status_npb_sent_to_gs_supervisor_id) {
				        $this->Session->write('Npb.can_send_for_processing', true);//yg saya ubah
                        $this->Session->write('Npb.can_cancel', true);
                        $this->Session->write('Npb.can_reject', true);

                  }
            } elseif ($group_id == it_management_group_id) {
                  //it_management, movement
				  foreach($npb['NpbDetail'] as $npbDetail){
					  if($npbDetail['process_type_id'] == movement_process_type_id && $request_type_id == request_type_fa_it_id){
								  $this->Session->write('Npb.can_create_movement', $npb_is_done == 0 &&
								  $npb_status_id == status_npb_processing_id);
								  $this->Session->write('Npb.can_reject', $npb_is_done == 0);
					  }else{
							false;
					  }
                  }
            } elseif ($group_id == fa_management_group_id) {
                  //fa_management, movement
				  foreach($npb['NpbDetail'] as $npbDetail){
					  if($npbDetail['process_type_id'] == movement_process_type_id && $request_type_id == request_type_fa_general_id){
							  $this->Session->write('Npb.can_create_movement', $npb_is_done == 0 && $npbDetail['qty'] != $npbDetail['qty_filled'] &&
							  $npb_status_id == status_npb_processing_id);
							  $this->Session->write('Npb.can_reject', $npb_is_done == 0 && $npbDetail['qty'] != $npbDetail['qty_filled']);
					  }else{
							false;
					  }
                 }
				 
            } elseif ($group_id == stock_management_group_id) {
                  //new_mr, group stock_management, is_purchase_request=npb.stock phurchase request=>1
                  $this->Session->write('Npb.is_purchase_request', ($npb['Npb']['is_purchase_request'] == 1 && $npb_status_id == status_npb_draft_id)
                  );

                  //stock management can create new npb
                  $this->Session->write('Npb.can_edit', $npb['Npb']['created_by'] == $username
                          && $npb_status_id == status_npb_draft_id
                          && ($request_type_id == request_type_stock_id || $request_type_id == request_type_point_reward_id)
                  );

                  // can attachment
                  $this->Session->write('Npb.can_attachment', $request_type_id == request_type_stock_id &&
                          $npb_status_id == status_npb_draft_id
                  );

                  //can send to supervisor
                  $this->Session->write('Npb.can_send_to_supervisor', $npb['Npb']['created_by'] == $username
                          && $npb_status_id == status_npb_draft_id);

                  //can check stock for outlog
                  if ($npb_status_id == status_npb_processing_id && $npb['Npb']['is_purchase_request'] == 0){
                        $this->Session->write('Npb.can_check_stock', true);
                        $this->Session->write('Npb.can_reject', true);
				  }
                  //can archive
                  $this->Session->write('Npb.can_archive', $npb['Npb']['created_by'] == $username &&
                          $npb_status_id == status_npb_reject_id);
						  
				$this->Session->write('Npb.can_set_process_type', true);
            }
            elseif ($group_id == stock_supervisor_group_id) {
                  if (($request_type_id == request_type_stock_id || $request_type_id == request_type_point_reward_id) && $npb_status_id == status_npb_sent_to_supervisor_id) {
                        /// NPB Reject status_npb_sent_to_branch_head_id login branch_head_group_id
                        $this->Session->write('Npb.can_reject', true);

                        /// NPB Cancel status_npb_sent_to_branch_head_id login branch_head_group_id
                        $this->Session->write('Npb.can_cancel', true);

                        /// can send for further processing
                        $this->Session->write('Npb.can_send_for_processing', !$npb_is_done);
                  }
            } elseif ($group_id == gs_group_id) {
				//detail gak kebaca di sini
				$npb = $this->Npb->read(null, $id);
				foreach($npb['NpbDetail'] as $npbdetail){								
					if ($npbdetail['po_id'] == 0 && $npb_status_id == status_npb_processing_id && $npb_is_done == 0 && $npbdetail['process_type_id'] == procurement_process_type_id){
						 $this->Session->write('Npb.can_create_po', true);
					}
				}
				
				  //no more processing
				  $this->Session->write('Npb.can_send_for_processing', false);
            }

			//echo '<pre>';
			//var_dump($this->Session->read('Npb'));
			//echo '</pre>';die();
			
			$id_group = $this->Session->read('Security.permissions');
			$npb = $this->Npb->read(null, $id);
            $this->Session->write('Npb.id', $id);
            $pos = $this->Npb->Po->find('list');
            $departments = $this->Npb->Department->find('list');
            $departmentsub = $this->Npb->Department->DepartmentSub->find('list');
            $departmentunit = $this->Npb->Department->DepartmentUnit->find('list');
			$suppliers = $this->Npb->Supplier->find('list');
            $currencies = $this->Npb->NpbDetail->Currency->find('list');
            $currency = $this->Npb->NpbDetail->Currency->find('list', array('fields'=>'is_desimal'));
            $units = $this->Npb->NpbDetail->Unit->find('list');
            $movements = $this->Npb->NpbDetail->Movement->find('list');
            $processTypes = $this->Npb->NpbDetail->ProcessType->find('list');
			$costCenterId= $this->Npb->CostCenter->find('list', array('fields' => 'name','conditions' => array('CostCenter.id'=>$npb['Npb']['cost_center_id'])));
			$approveLink = $this->get_approve_link($id, $npb, $id_group);
			$npb['Npb']['cost_center_name'] = $costCenterId[$npb['Npb']['cost_center_id']];
				//echo "<pre>";
				//var_dump($this->Session->read());
				//var_dump($npb);
				//echo "</pre>";die();
            $this->set(compact('currency', 'npb', 'pos', 'departments', 'suppliers', 'currencies', 'units', 'departmentsub', 'departmentunit', 'movements', 'group_id', 'processTypes','costCenter','costCenters', 'approveLink'));
      }
	  
	  function approveToPo($id=null){
			$this->data['Npb']['id'] = $id;
			$this->data['Npb']['npb_status_id'] = status_npb_processing_id;
			$this->data['Npb']['approved_date'] = date('Y-m-d H:i:s');
            $this->data['Npb']['approved_by'] = $this->Session->read('Userinfo.username');
			$npbs = $this->Npb->read(null, $id);
				$this->data['Npb']['approved_history'] = $npbs['Npb']['approved_history'].'<br />Approved : '.$this->Session->read('Userinfo.username').'/'.$this->Session->read('Userinfo.group_name').'/'.date('Y-m-d H:i:s').',';
			if ($this->Npb->save($this->data)) {
                  $this->Session->setFlash(__('The npb has been saved to the PO process', true), 'default', array('class' => 'ok'));
                  $this->redirect(array('action' => 'index'));
            } else {
                  $this->Session->setFlash(__('The npb could not be saved. Please, try again.', true));
            }
	  }	  

      function add($request_type_id=null) {
			if (!empty($this->data)) {
				$group_id = $this->Session->read('Security.permissions');
                $request_type_id = $this->data['Npb']['request_type_id'];
				if($request_type_id == request_type_point_reward_id && $group_id == stock_management_group_id){
					$this->data['Npb']['is_purchase_request'] = 1;
				}else 
				if($request_type_id == request_type_point_reward_id && $group_id == normal_user_group_id){
					$this->data['Npb']['is_purchase_request'] = 0;
				}
                $this->Npb->create();
                if ($this->Npb->save($this->data)) {
                      $this->Session->setFlash(__('The npb has been saved', true), 'default', array('class' => 'ok'));
                      $this->redirect(array('action' => 'view', $this->Npb->id));
                } else {
                      $this->Session->setFlash(__('The npb could not be saved. Please, try again.', true));
					//$this->log($this->data);
					//$this->showQuery($sql);
                }
            }
            $newId 			= $this->Npb->getNewId($this->Session->read('Userinfo.department_id'), $request_type_id);
            $departments 	= $this->Npb->Department->find('list');
            $departmentsub 	= $this->Npb->Department->DepartmentSub->find('list');
            $departmentunit = $this->Npb->Department->DepartmentUnit->find('list');
			$costCenter 	= $this->Npb->CostCenter->find('list');
            //$costCenters 	= $this->Npb->CostCenter->find('list', array('fields' => 'name'));
            $cc 			= $this->Npb->query('select a.id,a.name,b.t24_dao from cost_centers a left join cost_center_to_daos b on b.cost_center_id = a.id where a.remarks = "Y" order by a.name');
			foreach($cc as $data){
				if($data[0]['t24_dao']){
					$costCenters[ $data[0]['id'] ]	= $data[0]['name'] . " - " .$data[0]['t24_dao'];
				}else{
					$costCenters[ $data[0]['id'] ]	= $data[0]['name'];
				}				
			}
			
			//echo '<pre>';
			//var_dump($costCenters);
			//echo '</pre>';die();
            $npbStatuses 	= $this->Npb->NpbStatus->find('list');
            $requestTypes 	= $this->Npb->RequestTypes->find('list');
			$moduleName 	= 'MR > New MR '.  $requestTypes[$request_type_id];
			$this->set('title_for_layout',  $this->lastSegment($moduleName));
			
            $this->set(compact('departments', 'newId', 'npbStatuses', 'requestTypes', 'departmentsub', 'departmentunit', 'request_type_id', 'moduleName','costCenter','costCenters'));
      }

      function edit($id = null) {
            if (!$id && empty($this->data)) {
                  $this->Session->setFlash(__('Invalid npb', true));
                  $this->redirect(array('action' => 'index'));
            }
            if (!empty($this->data)) {
                  if ($this->Npb->save($this->data)) {
                        $this->Session->setFlash(__('The npb has been saved', true), 'default', array('class' => 'ok'));
                        $this->redirect(array('action' => 'view', $id));
                  } else {
                        $this->Session->setFlash(__('The npb could not be saved. Please, try again.', true));
                  }
            }
            if (empty($this->data)) {
                  $this->data = $this->Npb->read(null, $id);
            }
            $departments = $this->Npb->Department->find('list');
            $departmentsub = $this->Npb->Department->DepartmentSub->find('list');
            $departmentunit = $this->Npb->Department->DepartmentUnit->find('list');
			$costCenter = $this->Npb->CostCenter->find('list');
            //$costCenters = $this->Npb->CostCenter->find('list', array('fields' => 'name'));
			$cc 			= $this->Npb->query('select a.id,a.name,b.t24_dao from cost_centers a left join cost_center_to_daos b on b.cost_center_id = a.id where a.remarks = "Y" order by a.name');
			foreach($cc as $data){
				if($data[0]['t24_dao']){
					$costCenters[ $data[0]['id'] ]	= $data[0]['name'] . " - " .$data[0]['t24_dao'];
				}else{
					$costCenters[ $data[0]['id'] ]	= $data[0]['name'];
				}				
			}
            $npbStatuses = $this->Npb->NpbStatus->find('list');
            $requestTypes = $this->Npb->RequestTypes->find('list');
            $this->set(compact('departments', 'npbStatuses', 'requestTypes', 'departmentsub', 'departmentunit','costCenter','costCenters'));
      }

      function select_supplier($id=null, $supplier_id=null) {
            $npb_id = $this->Session->read('Npb.id');

            $data['Npb']['id'] = $npb_id;
            $data['Npb']['supplier_id'] = $supplier_id;

            $this->Npb->read(null, $npb_id);

            if ($this->Npb->save($data)) {
                  $this->Npb->query('update npb_suppliers set selected=0 where npb_id="' . $npb_id . '"');
                  $this->Npb->query('update npb_suppliers set selected=1 where id="' . $id . '"');
                  $this->Session->setFlash(__('Npb Supplier Selected', true), 'default', array('class' => 'ok'));
                  $this->redirect(array('action' => 'view', $npb_id));
            }
            $this->Session->setFlash(__('Npb Supplier was not selected', true));
            $this->redirect(array('action' => 'view', $npb_id));
      }

      function delete($id = null) {
            if (!$id) {
                  $this->Session->setFlash(__('Invalid id for npb', true));
                  $this->redirect(array('action' => 'index'));
            }
            if ($this->Npb->delete($id)) {
                  $this->Session->setFlash(__('Npb deleted', true), 'default', array('class' => 'ok'));
                  $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Npb was not deleted', true));
            $this->redirect(array('action' => 'index'));
      }

      function notifyDepartmentHead($id = null) {
            if (!$id) {
                  $this->Session->setFlash(__('Invalid id for npb', true));
                  $this->redirect(array('action' => 'index'));
            }
			//kalau sekarang sudah lebih dari jam param max mr, cannot approval
            $mr_max_time = $this->configs['mr_max_time']; //12
            $now = date('H:i:s');
            /* if (strtotime($now) > strtotime($mr_max_time)) {
                  $this->Session->setFlash(__('The MR cannot be send now, current time ' . $now .
                                  ' exceeds maximum allowed to send time of ' . ($mr_max_time ) .
                                  '. Please try again tomorrow.', true));
                  $this->redirect(array('action' => 'index'));
            } */
			
			$count_npb_id = $this->Npb->query('select sum(npbDetails.qty) as c from npb_details as npbDetails where npbDetails.npb_id="'.$id.'"');
            $count = $count_npb_id[0][0]['c'];
			
			if ($count >= 1) {
				/* NEW CODE BY RENDI */
				
				/* IF DIFFERENT MR CATEGORY DETAILS ADDED, CREATE AS NEW MR */
				$reqType = $this->Npb->NpbDetail->findByNpbId($id, array('Npb.request_type_id'));
				$reqTypeId = $reqType['Npb']['request_type_id'];
				
				if($reqTypeId == request_type_point_reward_id){
					$itemDetails = $this->Npb->NpbDetail->find('all', array(
														'conditions'=>array('NpbDetail.npb_id'=>$id),
														'order'=>'Item.code'));													
					$assCats	= $this->Npb->NpbDetail->find('all', array(
														'fields'=>'DISTINCT Item.code',
														'conditions'=>array('NpbDetail.npb_id'=>$id),
														'order'=>'Item.code'));
					
					foreach($assCats as $cates){
						$cats[] = substr($cates['Item']['code'],0,1);
					}
					$cats = array_values(array_unique($cats));
					$newId1 = $id + 1;
					$newId2 = $id + 2;
					$newId3 = $id + 3;
					$newId4 = $id + 4;
					$newId5 = $id + 5;
					$no1 = null;
					$no2 = null;
					$no3 = null;
					$no4 = null;
					$no5 = null;
					
					//echo '<pre>';
					//var_dump($itemDetails);
					//echo '</pre>';die();
					
					$newNpbId = $id;
					$newMRData = $this->Npb->findById($id);
					$count = 1;
					
					foreach($itemDetails as $itemDetail):
						if(isset($cats[1]) && substr($itemDetail['Item']['code'],0,1) == $cats[1] && substr($itemDetail['Item']['code'],0,1) != $cats[0]){
							if($no1){
								$newMRData['Npb']['no'] = $no1;
							}else{
								$newMRData['Npb']['no'] = $this->Npb->getNewId($this->Session->read('Userinfo.department_id'), $reqTypeId);							
							}						
							$no1 = $newMRData['Npb']['no'];
							$newMRData['Npb']['id'] = $newId1;
							$newMRData['Npb']['npb_status_id'] = status_npb_sent_to_branch_head_id;
							
							$this->Npb->save($newMRData['Npb']);
							if($reqTypeId == 2){
								$this->Npb->query('update npb_details set npb_id = "'.$newId1.'", process_type_id = 2 where npb_id="'.$id.'" and item_id = "'.$itemDetail['Item']['id'].'"');						
							}else{
								$this->Npb->query('update npb_details set npb_id = "'.$newId1.'", process_type_id = 1 where npb_id="'.$id.'" and item_id = "'.$itemDetail['Item']['id'].'"');						
							}
						}else if(isset($cats[2]) && substr($itemDetail['Item']['code'],0,1) == $cats[2] && substr($itemDetail['Item']['code'],0,1) != $cats[0]){
							if($no2){
								$newMRData['Npb']['no'] = $no2;
							}else{
								$newMRData['Npb']['no'] = $this->Npb->getNewId($this->Session->read('Userinfo.department_id'), $reqTypeId);							
							}						
							$no2 = $newMRData['Npb']['no'];						
							$newMRData['Npb']['id'] = $newId2;
							$newMRData['Npb']['npb_status_id'] = status_npb_sent_to_branch_head_id;
							
							$this->Npb->save($newMRData['Npb']);
							if($reqTypeId == 2){
								$this->Npb->query('update npb_details set npb_id = "'.$newId2.'", process_type_id = 2 where npb_id="'.$id.'" and item_id = "'.$itemDetail['Item']['id'].'"');						
							}else{
								$this->Npb->query('update npb_details set npb_id = "'.$newId2.'", process_type_id = 1 where npb_id="'.$id.'" and item_id = "'.$itemDetail['Item']['id'].'"');						
							}
						}else if(isset($cats[3]) && substr($itemDetail['Item']['code'],0,1) == $cats[3] && substr($itemDetail['Item']['code'],0,1) != $cats[0]){
							if($no3){
								$newMRData['Npb']['no'] = $no3;
							}else{
								$newMRData['Npb']['no'] = $this->Npb->getNewId($this->Session->read('Userinfo.department_id'), $reqTypeId);							
							}						
							$no3 = $newMRData['Npb']['no'];			
							$newMRData['Npb']['id'] = $newId3;
							$newMRData['Npb']['npb_status_id'] = status_npb_sent_to_branch_head_id;
							
							$this->Npb->save($newMRData['Npb']);
							if($reqTypeId == 2){
								$this->Npb->query('update npb_details set npb_id = "'.$newId3.'", process_type_id = 2 where npb_id="'.$id.'" and item_id = "'.$itemDetail['Item']['id'].'"');						
							}else{
								$this->Npb->query('update npb_details set npb_id = "'.$newId3.'", process_type_id = 1 where npb_id="'.$id.'" and item_id = "'.$itemDetail['Item']['id'].'"');						
							}
						}else if(isset($cats[4]) && substr($itemDetail['Item']['code'],0,1) == $cats[4] && substr($itemDetail['Item']['code'],0,1) != $cats[0]){
							if($no4){
								$newMRData['Npb']['no'] = $no4;
							}else{
								$newMRData['Npb']['no'] = $this->Npb->getNewId($this->Session->read('Userinfo.department_id'), $reqTypeId);							
							}						
							$no4 = $newMRData['Npb']['no'];				
							$newMRData['Npb']['id'] = $newId4;
							$newMRData['Npb']['npb_status_id'] = status_npb_sent_to_branch_head_id;
							
							$this->Npb->save($newMRData['Npb']);
							if($reqTypeId == 2){
								$this->Npb->query('update npb_details set npb_id = "'.$newId4.'", process_type_id = 2 where npb_id="'.$id.'" and item_id = "'.$itemDetail['Item']['id'].'"');						
							}else{
								$this->Npb->query('update npb_details set npb_id = "'.$newId4.'", process_type_id = 1 where npb_id="'.$id.'" and item_id = "'.$itemDetail['Item']['id'].'"');						
							}
						}else if(isset($cats[5]) && substr($itemDetail['Item']['code'],0,1) == $cats[5] && substr($itemDetail['Item']['code'],0,1) != $cats[0]){
							if($no4){
								$newMRData['Npb']['no'] = $no4;
							}else{
								$newMRData['Npb']['no'] = $this->Npb->getNewId($this->Session->read('Userinfo.department_id'), $reqTypeId);							
							}						
							$no4 = $newMRData['Npb']['no'];					
							$newMRData['Npb']['id'] = $newId5;
							$newMRData['Npb']['npb_status_id'] = status_npb_sent_to_branch_head_id;
							
							$this->Npb->save($newMRData['Npb']);
							if($reqTypeId == 2){
								$this->Npb->query('update npb_details set npb_id = "'.$newId5.'", process_type_id = 2 where npb_id="'.$id.'" and item_id = "'.$itemDetail['Item']['id'].'"');						
							}else{
								$this->Npb->query('update npb_details set npb_id = "'.$newId5.'", process_type_id = 1 where npb_id="'.$id.'" and item_id = "'.$itemDetail['Item']['id'].'"');						
							}
						}
					endforeach;	
				}
				
				/* END OF NEW CODE BY RENDI */
				
				$this->data['Npb']['id'] = $id;
				$this->data['Npb']['npb_status_id'] = status_npb_sent_to_branch_head_id;
				$res = $this->Npb->findById($id);
				
				$emailParam = array();
				$emailParam['id'] 				= $res['Npb']['id'];
				$emailParam['no'] 				= $res['Npb']['no'];
				$emailParam['npb_date'] 		= $res['Npb']['npb_date'];
				$emailParam['branch'] 			= $res['Department']['name'];
				$emailParam['created_date'] 	= $res['Npb']['created_date'];
				$emailParam['request_type']		= $res['RequestTypes']['name'];
				$emailParam['requester'] 		= $res['Npb']['created_by'];
				$emailParam['department_id'] 	= $res['Npb']['department_id'];
				$emailParam['business_type_id'] = $res['Npb']['business_type_id'];
				$emailParam['request_type_id'] 	= $res['Npb']['request_type_id'];
				$emailParam['npb_status'] 		= $res['NpbStatus']['name'];
				
				//$this->sendEmail(1,$emailParam);
				
				if ($this->Npb->save($this->data)) {
					  $this->Session->setFlash(__('The npb has been saved', true), 'default', array('class' => 'ok'));
					  $this->redirect(array('action' => 'index'));
				} else {
					  $this->Session->setFlash(__('The npb could not be saved. Please, try again.', true));
				}
			} else {
				$this->Session->setFlash(__('The MR could not be sent. Please, check your MR item details.', true));
				$this->redirect(array('action' => 'view', $id));
			}
      }

      function approvalDepartmentHead($id = null) {
			
            if (!$id) {
                  $this->Session->setFlash(__('Invalid id for npb', true));
                  $this->redirect(array('action' => 'index'));
            }

            //kalau sekarang sudah lebih dari jam param max mr, cannot approval
            $mr_max_time = $this->configs['mr_max_time']; //12
            $now = date('H:i:s');
            if (strtotime($now) > strtotime($mr_max_time)) {
                  $this->Session->setFlash(__('The MR cannot be approved now, current time ' . $now .
                                  ' exceeds maximum allowed approval time of ' . ($mr_max_time ) .
                                  '. Please try again tomorrow.', true));
                  $this->redirect(array('action' => 'index'));
            } 
			$res = $this->Npb->query('select request_type_id from npbs where id = '.$id);
			$npbType = $res[0][0]['request_type_id'];
			$this->data['Npb']['npb_status_id'] = null;
            $this->data['Npb']['id'] = $id;	
			if($npbType == request_type_stock_id){
				$this->data['Npb']['npb_status_id'] = status_npb_processing_id;
			}else if($npbType == request_type_fa_general_id){
				$this->data['Npb']['npb_status_id'] = status_npb_processing_id;
				// SET TO PROCUREMENT
				$this->Npb->query('update npb_details set process_type_id = 2 where npb_id = '.$id);
			}else{
				$this->data['Npb']['npb_status_id'] = status_npb_branch_approved_id;
			}            
            $this->data['Npb']['approved_date'] = date('Y-m-d H:i:s');
            $this->data['Npb']['approved_by'] = $this->Session->read('Userinfo.username');
			$npbs = $this->Npb->read(null, $id);
				$this->data['Npb']['approved_history'] = $npbs['Npb']['approved_history'].'<br />Approved : '.$this->Session->read('Userinfo.username').'/'.$this->Session->read('Userinfo.group_name').'/'.date('Y-m-d H:i:s').',';
				$this->data['Npb']['approver_one'] = $this->Session->read('Userinfo.username');
				$this->data['Npb']['approver_one_date'] = date('Y-m-d H:i:s');
				
				$res = $this->Npb->findById($id);;
				
				$emailParam = array();
				$emailParam['id'] 				= $res['Npb']['id'];
				$emailParam['no'] 				= $res['Npb']['no'];
				$emailParam['npb_date'] 		= $res['Npb']['npb_date'];
				$emailParam['branch'] 			= $res['Department']['name'];
				$emailParam['created_date'] 	= $res['Npb']['created_date'];
				$emailParam['request_type']		= $res['RequestTypes']['name'];
				$emailParam['requester'] 		= $res['Npb']['created_by'];
				$emailParam['department_id'] 	= $res['Npb']['department_id'];
				$emailParam['business_type_id'] = $res['Npb']['business_type_id'];
				$emailParam['request_type_id'] 	= $res['Npb']['request_type_id'];
				$emailParam['npb_status'] 		= $res['NpbStatus']['name'];

				//$this->sendEmail(0,$emailParam);
				
            if ($this->Npb->save($this->data)) {
                  $this->Session->setFlash(__('The npb has been saved', true), 'default', array('class' => 'ok'));
                  $this->redirect(array('action' => 'index'));
            } else {
                  $this->Session->setFlash(__('The npb could not be saved. Please, try again.', true));
            }
      }
		
		function sendEmail($emailType = null, $emailParam = null){
			//$this->Email->delivery('debug');
			if(BASE_URL != "/famsys"){
				$content = $byStatus = null;
				$res = $this->Npb->findById($emailParam['id']);
				$npbStatus 	= $res['NpbStatus']['name'];
				$npbStatusID= $res['NpbStatus']['id'];
				$status 	= $res['NpbStatus']['name'];
				$id_group = $this->Session->read('Security.permissions');
				if($emailType != 1){				
					$approver = $res['Npb']['approved_by'];
					$canceller = $res['Npb']['cancel_by'];
					$rejecter = $res['Npb']['reject_by'];
					if($npbStatus == 'Approved'){
						$byStatus = $approver;
					}else if($npbStatus == 'Reject'){
						$byStatus = $rejecter;
					}else{
						$byStatus = $canceller;
					}
				}
				if($emailType == 1){
					$content = 'Dear MR Approver,<br>';
				}else{
					$content = 'Dear '.$emailParam['requester'].'<br>';
				}			
				$content .= '<br><br>';
				if($emailType == 1){
					$content .= 'Memo Request For:<br>';
				}else{
					$content .= 'Your Memo Request For:<br>';
				}			
				$content .= 'MR No: '.$emailParam['no'].'<br>';
				$content .= 'MR Date: '.$emailParam['npb_date'].'<br>';
				$content .= 'Branch: '.$emailParam['branch'].'<br>';
				$content .= 'Request Date: '.$emailParam['created_date'].'<br>';
				$content .= 'Request Type: '.$emailParam['request_type'].'<br>';
				$content .= '<br>';
				if($emailType == 1){
					$content .= 'has been SUBMITTED for APPROVAL by '.$emailParam['requester'].'<br>';
				}else{
					$content .= 'has been '.strtoUpper($npbStatus).' by '.$byStatus.'/'.$this->Session->read('Userinfo.group_name').'<br>';
				}			
				$content .= '<br>';
				$content .= 'Sincerely,<br>';
				$content .= '<br>';
				$content .= '<br>';				
				$content .= 'FAMSYS';
				
				$userList = null;
				if($emailType == 1){
					if($id_group == normal_user_group_id){
						$userList = $this->Npb->query('select email from users where group_id = "'.branch_head_group_id.'" and department_id = "'.$res['Npb']['department_id'].'"');
					}else if($id_group == branch_head_group_id){
						$userList = $this->Npb->query('select email from users where group_id = "'.mr_aproval2_group_id.'" and department_id = "'.$res['Npb']['department_id'].'"');
					}else if($id_group == mr_aproval2_group_id){
						$userList = $this->Npb->query('select email from users where group_id = "'.mr_aproval3_group_id.'"');
					}				
				}else{
					$userList = $this->Npb->query('select email from users where username = "'.$emailParam['requester'].'"');
				}			
				
				$created_date	= date('Y-m-d H:i:s');
				$conf	= $this->Npb->query('select * from email_configs');
				
				foreach($userList as $user){
					
					$this->Email->smtpOptions = array(
							'port'			=> $conf[0][0]['port'],
							'timeout'		=> $conf[0][0]['timeout'],
							'host'			=> $conf[0][0]['host'],
							'username'		=> $conf[0][0]['username'],
							'password'		=> $conf[0][0]['password']);
					$this->Email->to		= $user[0]['email'];
					$this->Email->subject	= 'MR '.$emailParam['no'].' status';
					$this->Email->from		= $conf[0][0]['email_from'];
					$this->Email->sendAs	= 'html';
					$this->Email->template	= 'email_template';
					$this->set('content',$content);
					//$this->Email->delivery = 'debug';
					//echo '<pre>';
					//var_dump($content);
					//echo '</pre>';die();
					$this->Email->delivery = 'smtp'; // use this to send the actual email
					if($this->Email->send()){
						$this->Npb->query("INSERT INTO email_logs values('".$emailParam['no']."', '".$user[0]['email']."', 'SUCCESS', 	'".$this->Session->read('Userinfo.username')."', '".$created_date."')");
						return true;
					}else{
						$this->Npb->query("INSERT INTO email_logs values('".$emailParam['no']."', '".$user[0]['email']."', 'FAILED', 	'".$this->Session->read('Userinfo.username')."', '".$created_date."')");
						//echo $this->Email->smtpError;
					}
				}			

			}//end select base url
		}	
		

      function mrArchive($id = null) {
            if (!$id) {
                  $this->Session->setFlash(__('Invalid id for npb', true));
                  $this->redirect(array('action' => 'index'));
            }

            $this->data['Npb']['id'] = $id;
            $this->data['Npb']['npb_status_id'] = status_npb_archive_id;
            if ($this->Npb->save($this->data)) {
                  $this->Session->setFlash(__('The npb has been archived', true), 'default', array('class' => 'ok'));
                  //$this->redirect(array('action' => 'view', $id));
                  $this->redirect(array('action' => 'index'));
            } else {
                  $this->Session->setFlash(__('The npb could not be saved. Please, try again.', true));
            }
      }

      function sentToStockManagement($id = null) {
            if (!$id) {
                  $this->Session->setFlash(__('Invalid id for npb', true));
                  $this->redirect(array('action' => 'index'));
            }

            $this->data['Npb']['id'] = $id;
            $this->data['Npb']['npb_status_id'] = status_npb_sent_to_stock_management_id;
            $this->data['Npb']['approved_date'] = date('Y-m-d H:i:s');
            $this->data['Npb']['approved_by'] = $this->Session->read('Userinfo.username');
			$npbs = $this->Npb->read(null, $id);
				$this->data['Npb']['approved_history'] = $npbs['Npb']['approved_history'].'<br />Approved : '.$this->Session->read('Userinfo.username').'/'.$this->Session->read('Userinfo.group_name').'/'.date('Y-m-d H:i:s').',';
				$this->data['Npb']['approver_two'] = $this->Session->read('Userinfo.username');
				$this->data['Npb']['approver_two_date'] = date('Y-m-d H:i:s');
				
			if ($this->Npb->save($this->data)) {
                  $this->Session->setFlash(__('The npb has been saved', true), 'default', array('class' => 'ok'));
                  //$this->redirect(array('action' => 'view', $id));
                  $this->redirect(array('action' => 'index'));
            } else {
                  $this->Session->setFlash(__('The npb could not be saved. Please, try again.', true));
            }
      }

      function createPo($id = null) {
            if (!$id) {
                  $this->Session->setFlash(__('Invalid id for npb', true));
                  $this->redirect(array('action' => 'index'));
            }

            /* create one PO from this NPB */

            /* update status */
            $this->data['Npb']['id'] = $id;
            $this->data['Npb']['npb_status_id'] = 'finished';
            if ($this->Npb->save($this->data)) {
                  $this->Session->setFlash(__('The npb has been finished', true), 'default', array('class' => 'ok'));
                  $this->redirect(array('action' => 'index'));
            } else {
                  $this->Session->setFlash(__('The npb could not be saved. Please, try again.', true));
            }
      }

      function sentToGS($id = null) {
            if (!$id) {
                  $this->Session->setFlash(__('Invalid id for npb', true));
                  $this->redirect(array('action' => 'index'));
            }

            $this->data['Npb']['id'] = $id;

            //$this->data['Npb']['npb_status_id'] = status_npb_sent_to_gs_id;
            $this->data['Npb']['npb_status_id'] = status_npb_processing_id;

            if ($this->Npb->save($this->data)) {
                  $this->Session->setFlash(__('The npb has been saved', true), 'default', array('class' => 'ok'));
                  $this->redirect(array('action' => 'index', $id));
            } else {
                  $this->Session->setFlash(__('The npb could not be saved. Please, try again.', true));
            }
      }

      function mrSentToGsSpv($id = null) {
            if (!$id) {
                  $this->Session->setFlash(__('Invalid id for npb', true));
                  $this->redirect(array('action' => 'index'));
            }
			$npb = $this->Npb->read(null, $id);			
			foreach($npb['NpbDetail'] as $npbDetail){
				if($npbDetail['process_type_id'] == NULL){
					  $this->Session->setFlash(__('The npb could not be saved. Please, Check Procces Type.', true));
					  $this->redirect(array('action' => 'view', $id));
				}
			}
				$this->data['Npb']['id'] = $id;
				//$this->data['Npb']['npb_status_id'] = status_npb_sent_to_gs_id;
				$this->data['Npb']['npb_status_id'] = status_npb_sent_to_gs_supervisor_id;
				$this->data['Npb']['approved_date'] = date('Y-m-d H:i:s');
				$this->data['Npb']['approved_by'] = $this->Session->read('Userinfo.username');
				$npbs = $this->Npb->read(null, $id);
					$this->data['Npb']['approved_history'] = $npbs['Npb']['approved_history'].'<br />Approved : '.$this->Session->read('Userinfo.username').'/'.$this->Session->read('Userinfo.group_name').'/'.date('Y-m-d H:i:s').',';
					$this->data['Npb']['approver_two'] = $this->Session->read('Userinfo.username');
					$this->data['Npb']['approver_two_date'] = date('Y-m-d H:i:s');
				if ($this->Npb->save($this->data)) {
					  $this->Session->setFlash(__('The npb has been saved', true), 'default', array('class' => 'ok'));
					  $this->redirect(array('action' => 'index', status_npb_branch_approved_id, 2));
				} else {
					  $this->Session->setFlash(__('The npb could not be saved. Please, try again.', true));
					  $this->redirect(array('action' => 'view', $id));
				}
      }

      function sentToStockSupervisor($id = null) {
            if (!$id) {
                  $this->Session->setFlash(__('Invalid id for npb', true));
                  $this->redirect(array('action' => 'index'));
            }
			
            $mr_max_time = $this->configs['mr_max_time']; //12
            $now = date('H:i:s');
            /* if (strtotime($now) > strtotime($mr_max_time)) {
                  $this->Session->setFlash(__('The MR cannot be send now, current time ' . $now .
                                  ' exceeds maximum allowed to send time of ' . ($mr_max_time ) .
                                  '. Please try again tomorrow.', true));
                  $this->redirect(array('action' => 'index'));
            } */
			
			$count_npb_id = $this->Npb->query('select sum(npbDetails.qty) as c from npb_details as npbDetails where npbDetails.npb_id="'.$id.'"');
            $count = $count_npb_id[0][0]['c'];
			
            $this->data['Npb']['id'] = $id;
            $this->data['Npb']['npb_status_id'] = status_npb_sent_to_supervisor_id;
			
			if ($count >= 1) {

				if ($this->Npb->save($this->data)) {
					  $this->Session->setFlash(__('The npb has been saved', true), 'default', array('class' => 'ok'));
					  $this->redirect(array('action' => 'index'));
				} else {
					  $this->Session->setFlash(__('The npb could not be saved. Please, try again.', true));
				}
 			} else {
				$this->Session->setFlash(__('The MR could not be sent. Please, check your MR item details.', true));
				$this->redirect(array('action' => 'view', $id));
			}
     }

      function approvalItManager($id = null) {
            if (!$id) {
                  $this->Session->setFlash(__('Invalid id for npb', true));
                  $this->redirect(array('action' => 'index'));
            }

            $this->data['Npb']['id'] = $id;
			$npb = $this->Npb->read(null, $id);			
			foreach($npb['NpbDetail'] as $npbDetail){
			//var_dump($npbDetail['price_cur']);
				if($npbDetail['process_type_id'] == NULL || $npbDetail['price_cur'] < 1){
				  $this->Session->setFlash(__('The MR could not be saved. Please, Check Procces Type and Price cur can not be 0.', true));
				  $this->redirect(array('action' => 'view', $id));
				}
			}
			
            //$this->data['Npb']['npb_status_id'] = status_npb_it_manager_approved_id;
            $this->data['Npb']['npb_status_id'] = status_npb_processing_id;
            $this->data['Npb']['approved_date'] = date('Y-m-d H:i:s');
            $this->data['Npb']['approved_by'] = $this->Session->read('Userinfo.username');
			$npbs = $this->Npb->read(null, $id);
				$this->data['Npb']['approved_history'] = $npbs['Npb']['approved_history'].'<br />Approved : '.$this->Session->read('Userinfo.username').'/'.$this->Session->read('Userinfo.group_name').'/'.date('Y-m-d H:i:s').',';
				$this->data['Npb']['approver_two'] = $this->Session->read('Userinfo.username');
				$this->data['Npb']['approver_two_date'] = date('Y-m-d H:i:s');
				if ($this->Npb->save($this->data)) {
					  $this->Session->setFlash(__('The npb has been saved', true), 'default', array('class' => 'ok'));
					  $this->redirect(array('action' => 'index'));
				} else {
					  $this->Session->setFlash(__('The npb could not be saved. Please, try again.', true));
				}
			
		
      }

      function sentToFA($id = null) {
            if (!$id) {
                  $this->Session->setFlash(__('Invalid id for npb', true));
                  $this->redirect(array('action' => 'index'));
            }
            $this->data['Npb']['id'] = $id;
            $this->data['Npb']['npb_status_id'] = status_npb_sent_to_fa_management_id;
            $this->data['Npb']['approved_date'] = date('Y-m-d H:i:s');
            $this->data['Npb']['approved_by'] = $this->Session->read('Userinfo.username');
			$npbs = $this->Npb->read(null, $id);
				$this->data['Npb']['approved_history'] = $npbs['Npb']['approved_history'].'<br />Approved : '.$this->Session->read('Userinfo.username').'/'.$this->Session->read('Userinfo.group_name').'/'.date('Y-m-d H:i:s').',';
				$this->data['Npb']['approver_two'] = $this->Session->read('Userinfo.username');
				$this->data['Npb']['approver_two_date'] = date('Y-m-d H:i:s');
            if ($this->Npb->save($this->data)) {
                  $this->Session->setFlash(__('The npb has been saved', true), 'default', array('class' => 'ok'));
                  $this->redirect(array('action' => 'index', $id));
            } else {
                  $this->Session->setFlash(__('The npb could not be saved. Please, try again.', true));
            }
      }

      function sentToItManager($id = null) {
            if (!$id) {
                  $this->Session->setFlash(__('Invalid id for npb', true));
                  $this->redirect(array('action' => 'index'));
            }
            $this->data['Npb']['id'] = $id;
            //$this->data['Npb']['npb_status_id'] = status_npb_sent_to_it_management_id;
            $this->data['Npb']['npb_status_id'] = status_npb_processing_id;
            $this->data['Npb']['approved_date'] = date('Y-m-d H:i:s');
            $this->data['Npb']['approved_by'] = $this->Session->read('Userinfo.username');
			$npbs = $this->Npb->read(null, $id);
				$this->data['Npb']['approved_history'] = $npbs['Npb']['approved_history'].'<br />Approved : '.$this->Session->read('Userinfo.username').'/'.$this->Session->read('Userinfo.group_name').'/'.date('Y-m-d H:i:s').',';
				$this->data['Npb']['approver_two'] = $this->Session->read('Userinfo.username');
				$this->data['Npb']['approver_two_date'] = date('Y-m-d H:i:s');
            if ($this->Npb->save($this->data)) {
                  $this->Session->setFlash(__('The npb has been saved', true), 'default', array('class' => 'ok'));
                  $this->redirect(array('action' => 'index', $id));
            } else {
                  $this->Session->setFlash(__('The npb could not be saved. Please, try again.', true));
            }
      }

      function createMovement($id = null) {
            if (!$id) {
                  $this->Session->setFlash(__('Invalid id for npb', true));
                  $this->redirect(array('action' => 'index'));
            }
            $this->redirect(array('controller' => 'movements', 'action' => 'add', $id));

            /* update status */
            /* $this->data['Npb']['id'] = $id;
              $this->data['Npb']['npb_status_id'] = status_npb_movement_id;
              if ($this->Npb->save($this->data)) {
              $this->Session->setFlash(__('The npb has been saved', true), 'default', array('class'=>'ok'));
              $this->redirect(array('controller'=>'movements','action' => 'add', $id));
              } else {
              $this->Session->setFlash(__('The npb could not be saved. Please, try again.', true));
              } */
      }

      function updateStatus($id = null, $status_npb_id) {
            if (!$id) {
                  $this->Session->setFlash(__('Invalid id for npb', true));
                  $this->redirect(array('action' => 'index'));
            }
			$npb = $this->Npb->read(null, $id);
            if($status_npb_id==status_npb_processing_id && $npb['Npb']['request_type_id'] == request_type_stock_id)
			{
				$mr_max_time = $this->configs['mr_max_time']; //12
				$now = date('H:i:s');
				/* if (strtotime($now) > strtotime($mr_max_time)) {
					  $this->Session->setFlash(__('The MR cannot be send now, current time ' . $now .
									  ' exceeds maximum allowed to send time of ' . ($mr_max_time ) .
									  '. Please try again tomorrow.', true));
					  $this->redirect(array('action' => 'index'));
				} */
            }
			
           /* update status */
            $this->data['Npb']['id'] = $id;
            $this->data['Npb']['npb_status_id'] = $status_npb_id;

            ///kalau sudah processing, udpate MR date
            if ($status_npb_id == status_npb_processing_id) {
                  $this->data['Npb']['npb_date'] = date('Y-m-d');
                  $this->data['Npb']['approved_date'] = date('Y-m-d H:i:s');
                  $this->data['Npb']['approved_by'] = $this->Session->read('Userinfo.username');
				  $npbs = $this->Npb->read(null, $id);
					$this->data['Npb']['approved_history'] = $npbs['Npb']['approved_history'].'<br />Approved : '.$this->Session->read('Userinfo.username').'/'.$this->Session->read('Userinfo.group_name').'/'.date('Y-m-d H:i:s').',';
					$this->data['Npb']['approver_three'] = $this->Session->read('Userinfo.username');
					$this->data['Npb']['approver_three_date'] = date('Y-m-d H:i:s');
            }

            if ($this->Npb->save($this->data)) {
                  $this->Session->setFlash(__('The npb has been saved', true), 'default', array('class' => 'ok'));
                  $this->redirect(array('action' => 'index', 120, 2));
                  //$this->redirect(array('controller'=>'npbs','action' => 'view', $id));
            } else {
                  $this->Session->setFlash(__('The npb could not be saved. Please, try again.', true));
            }
      }

		function view_pdf($id = null) {
            //cek id mr
            if (!$id) {
                  $this->Session->setFlash(__('Invalid MR', true));
                  $this->redirect(array('action' => 'index'));
            }

            //Add is_printed=1
            if (!empty($id)) {
				$npb = $this->Npb->read(null, $id);	
				$i = 1;
				$p = 0;
				foreach($npb['NpbDetail'] as $npbDetail){
					if($npbDetail['process_type_id'] == NULL || $npbDetail['price_cur'] == 0){
						  $p += $i;
					}
				}
				
				if($p==0)
				{
                  $data['Npb']['id'] = $id;
                  $data['Npb']['is_printed'] = 1;
                  $this->Npb->save($data);
				}
				else  
				  $this->Session->setFlash(__('The MR could not be saved. Please, Check Procces Type and Price cannot be 0', true));
            }

            Configure::write('debug', 1); // Otherwise we cannot use this method while developing
            $npb = $this->Npb->read(null, $id);
            $this->Session->write('Npb.id', $id);
            $this->set('npb', $npb);
            $npbDetails = $this->Npb->NpbDetail->find('all', array('conditions' => array('NpbDetail.npb_id' => $id)));
            $departments = $this->Npb->Department->find('list');
            $requestTypes = $this->Npb->RequestTypes->find('list');
            $units = $this->Npb->NpbDetail->Unit->find('list');
            $currencies = $this->Npb->NpbDetail->Currency->find('list');
            $currency = $this->Npb->NpbDetail->Currency->find('list', array('fields'=>'is_desimal'));
            $processTypes = $this->Npb->NpbDetail->ProcessType->find('list');
            $this->set(compact('npbDetails', 'departments', 'requestTypes', 'units', 'currencies', 'processTypes', 'currency'));
            $this->layout = 'pdf'; //this will use the pdf.ctp layout
            $this->render();
		}
		
		function print_to_pdf($id = null) {
            //cek id mr
            if (!$id) {
                  $this->Session->setFlash(__('Invalid MR', true));
                  $this->redirect(array('action' => 'index'));
            }

            //Add is_printed=1
            if (!empty($id)) {
				$npb = $this->Npb->read(null, $id);	
				$i = 1;
				$p = 0;
				foreach($npb['NpbDetail'] as $npbDetail){
					if($npbDetail['process_type_id'] == NULL || $npbDetail['price_cur'] == 0){
						$p += $i;
					}
				}
				
				if($p==0)
				{
                  $data['Npb']['id'] = $id;
                  $data['Npb']['is_printed'] = 1;
                  $this->Npb->save($data);
				}
				else  
				  $this->Session->setFlash(__('The MR could not be saved. Please, Check Process Type and Price cannot be 0', true));
            }

            Configure::write('debug', 1); // Otherwise we cannot use this method while developing
            $npb = $this->Npb->read(null, $id);
            $this->Session->write('Npb.id', $id);
            $this->set('npb', $npb);
			$to_prints['Npb']['id']					= $id;
			$to_prints['Npb']['no']					= $npb['Npb']['no'];
			$to_prints['Npb']['department_id']		= $npb['Npb']['department_id'];
			$to_prints['Npb']['business_type_id']	= $npb['Npb']['business_type_id'];
			$to_prints['Npb']['cost_center_id']		= $npb['Npb']['cost_center_id'];
			$to_prints['Npb']['request_type_id']	= $npb['Npb']['request_type_id'];
			$to_prints['Npb']['notes']				= $npb['Npb']['notes'];
			$to_prints['Npb']['npb_date']			= $npb['Npb']['npb_date'];
			$to_prints['Npb']['req_date']			= $npb['Npb']['req_date'];
			$to_prints['Npb']['created_by']			= $npb['Npb']['created_by'];
			$to_prints['Npb']['approved_by']		= $npb['Npb']['approved_by'];
			$to_prints['Npb']['approved_by']		= $npb['Npb']['approved_by'];
			
			foreach($npb['NpbDetail'] as $detail){
				if($detail['process_type_id'] == procurement_process_type_id){
					$to_prints['NpbDetail'][] = $detail;					
				}
			}
			//echo '<pre>';
			//var_dump($to_prints);
			//echo '</pre>';die();
            $departments = $this->Npb->Department->find('list');
            $units = $this->Npb->NpbDetail->Unit->find('list');
            $currencies = $this->Npb->NpbDetail->Currency->find('list');
            $currency = $this->Npb->NpbDetail->Currency->find('list', array('fields'=>'is_desimal'));
			$businessTypes = $this->Npb->BusinessType->find('list');
			$costCenters = $this->Npb->CostCenter->find('list',array('fields'=>'name'));
			//$cc 			= $this->Npb->query('select a.id,a.name,b.t24_dao from cost_centers a left join cost_center_to_daos b on b.cost_center_id = a.id where a.remarks = "Y" order by a.name');
			//foreach($cc as $data){
			//	if($data[0]['t24_dao']){
			//		$costCenters[ $data[0]['id'] ]	= $data[0]['name'] . " - " .$data[0]['t24_dao'];
			//	}else{
			//		$costCenters[ $data[0]['id'] ]	= $data[0]['name'];
			//	}				
			//}
            $processTypes = $this->Npb->NpbDetail->ProcessType->find('list');
			$requestTypes = $this->Npb->RequestTypes->find('list');
            $this->set(compact('to_prints', 'departments', 'requestTypes', 'units', 'currencies', 'processTypes', 'currency','businessTypes','costCenters','requestTypes'));
            $this->layout = 'pdf'; //this will use the pdf.ctp layout
            $this->render();
		}

      function reject($id = null) {
            //view Npb
            if (!$id) {
                  $this->Session->setFlash(__('Invalid npb', true));
                  $this->redirect(array('action' => 'index'));
            }
            $this->Npb->read(null, $id);

            //Add Notes Reject Npb and Change Status
            if (!empty($this->data)) {
                  $this->data['Npb']['id'] = $id;
                  $this->data['Npb']['npb_status_id'] = status_npb_reject_id;
                  if ($this->Npb->save($this->data)) {
						$res = $this->Npb->findById($id);;
				
						$emailParam = array();
						$emailParam['id'] 				= $res['Npb']['id'];
						$emailParam['no'] 				= $res['Npb']['no'];
						$emailParam['npb_date'] 		= $res['Npb']['npb_date'];
						$emailParam['branch'] 			= $res['Department']['name'];
						$emailParam['created_date'] 	= $res['Npb']['created_date'];
						$emailParam['request_type']		= $res['RequestTypes']['name'];
						$emailParam['requester'] 		= $res['Npb']['created_by'];
						$emailParam['department_id'] 	= $res['Npb']['department_id'];
						$emailParam['business_type_id'] = $res['Npb']['business_type_id'];
						$emailParam['request_type_id'] 	= $res['Npb']['request_type_id'];

						//$this->sendEmail(0,$emailParam);
				  
                        $this->Session->setFlash(__('The npb has been saved', true), 'default', array('class' => 'ok'));
                        $this->redirect(array('action' => 'index'));
                  } else {
                        $this->Session->setFlash(__('The npb could not be saved. Please, try again.', true));
                  }
            }
            if (empty($this->data)) {
                  $npb = $this->data = $this->Npb->read(null, $id);
            }
            $departments = $this->Npb->Department->find('list');
            $npbStatuses = $this->Npb->NpbStatus->find('list');
            $this->set(compact('npb', 'pos', 'departments', 'npbStatuses'));
      }

      function cancel($id = null) {
            //view Npb
            if (!$id) {
                  $this->Session->setFlash(__('Invalid npb', true));
                  $this->redirect(array('action' => 'index'));
            }
            $this->Session->write('Npb.id', $id);
			$npb = $this->Npb->read(null, $id);
			 //reset npb and details
            //Add Notes Cancel Npb and Change Status
            if (!empty($this->data)) {
                  $this->data['Npb']['id'] = $id;
                  $this->data['Npb']['npb_status_id'] = status_npb_draft_id;
				  $this->data['Npb']['approved_history'] = $npb['Npb']['approval_history'].'<br />Cancel : '.$this->Session->read('Userinfo.username').'/'.date('Y-m-d H:i:s').',';
                  if ($this->Npb->save($this->data)) {
						$res = $this->Npb->findById($id);;
				
						$emailParam = array();
						$emailParam['id'] 				= $res['Npb']['id'];
						$emailParam['no'] 				= $res['Npb']['no'];
						$emailParam['npb_date'] 		= $res['Npb']['npb_date'];
						$emailParam['branch'] 			= $res['Department']['name'];
						$emailParam['created_date'] 	= $res['Npb']['created_date'];
						$emailParam['request_type']		= $res['RequestTypes']['name'];
						$emailParam['requester'] 		= $res['Npb']['created_by'];
						$emailParam['department_id'] 	= $res['Npb']['department_id'];
						$emailParam['business_type_id'] = $res['Npb']['business_type_id'];
						$emailParam['request_type_id'] 	= $res['Npb']['request_type_id'];

						//$this->sendEmail(0,$emailParam);
				  
						if($npb['Npb']['request_type_id'] == request_type_fa_it_id || $npb['Npb']['request_type_id'] == request_type_fa_general_id){
						$sql = 'update npb_details set process_type_id=NULL where npb_id=' . $id;
						$this->Npb->query($sql);
						}
                       $this->Session->setFlash(__('The npb has been saved', true), 'default', array('class' => 'ok'));
                        $this->redirect(array('action' => 'index'));
                  } else {
                        $this->Session->setFlash(__('The npb could not be saved. Please, try again.', true));
                  }
            }
            if (empty($this->data)) {
                  $npb = $this->data = $this->Npb->read(null, $id);
            }
            $departments = $this->Npb->Department->find('list');
            $npbStatuses = $this->Npb->NpbStatus->find('list');
            $this->set(compact('npb', 'pos', 'departments', 'npbStatuses'));
      }

      //NPB Report
      function npb_report($type='finish') {
			$layout = 'Screen';
            $this->Npb->recursive = 1;
            $group_id = $this->Session->read('Security.permissions');
            $dept_id = $this->Session->read('Userinfo.department_id');
            $username = $this->Session->read('Userinfo.username');
            $dept_sub_id = $this->Session->read('Userinfo.department_sub_id');
            $dept_unit_id = $this->Session->read('Userinfo.department_unit_id');
            $business_type_id = $this->Session->read('Userinfo.business_type_id');
            $cost_center_id = $this->Session->read('Userinfo.cost_center_id');
            if(!empty($this->data)){
			$layout = $this->data['Npb']['layout'];
			if($this->data['CostCenter']['name'] == '')
				$this->data['Npb']['cost_center_id'] = null;
			}

            if ($group_id == gs_group_id) //gs
                  $conditions = array(
                          // 'OR'=>array(
                          // 'npb_status_id'=>status_npb_branch_approved_id,
                          // 'and' => array(
                          // 'created_by'=>$this->Session->read('Userinfo.username'),
                          // 'npb_status_id'=>status_npb_draft_id
                          // )
                          // )
                  );
			else if ($group_id == fa_management_group_id) //gs
                  $conditions = array('request_type_id' => request_type_fa_general_id);
			else if ($group_id == stock_management_group_id) //stock
                  $conditions = array('request_type_id' => request_type_stock_id);
			else if ($group_id == it_management_group_id) //IT
                  $conditions = array('request_type_id' => request_type_fa_it_id);
			else if ($group_id == gs_admin_group_id) //gs
                 $conditions =  array('request_type_id' => request_type_fa_general_id);
				 
			else if ($group_id == it_admin_group_id) //it
                 $conditions =  array('request_type_id' => request_type_fa_it_id);
				 
			else if ($group_id == branch_head_group_id) //pimcab
                 $conditions =  array('department_id' => $dept_id);

            else //normal users
                  $conditions = array('department_id' => $dept_id, 'created_by' => $username);

           // $conditions[] = array('npb_status_id !=' => status_npb_draft_id);

            if ($department_id = $this->data['Npb']['department_id']) {
                  $conditions[] = array('department_id' => $department_id);
            }
            /* if ($department_sub_id=$this->data['Npb']['department_sub_id'])  {
              $conditions[] = array('department_sub_id'=>$department_sub_id);
              }
              if ($department_unit_id=$this->data['Npb']['department_unit_id'])  {
              $conditions[] = array('department_unit_id'=>$department_unit_id);
              } */
            if ($business_type_id = $this->data['Npb']['business_type_id']) {
                  $conditions[] = array('Npb.business_type_id' => $business_type_id);
            }
            if ($cost_center_id = $this->data['Npb']['cost_center_id']) {
                  $conditions[] = array('Npb.cost_center_id' => $cost_center_id);
            }


            list($date_start, $date_end) = $this->set_date_filters('Npb');
            $conditions[] = array('Npb.npb_date >=' => ($date_start['year'] . '-' . $date_start['month'] . '-' . $date_start['day']),
                'Npb.npb_date <=' => ($date_end['year'] . '-' . $date_end['month'] . '-' . $date_end['day']));

            if ($type == 'finish') {
                  $this->Session->write('Npb.report_type', 'finish');
            } else {
                  $this->Session->write('Npb.report_type', 'outstanding');
            }

			if(DRIVER=='mysql') {
				$conditions[] = array('(SELECT if(sum(qty-qty_filled)=0, 1, 0) FROM npb_details WHERE npb_details.npb_id = Npb.id) = ' .
					($this->Session->read('Npb.report_type') == 'finish' ? 1 : 0));
			}                
			elseif(DRIVER=='mssql') {
				$conditions[] = array('(select case sum(qty-qty_filled) when 0 then 1 else 0 end from npb_details where npb_details.npb_id=Npb.id) = ' . 
					($this->Session->read('Npb.report_type') == 'finish' ? 1 : 0));
			}
			
			if ($this->Session->read('Npb.report_type') == 'outstanding') {
				$conditions[] = array('npb_status_id' => status_npb_processing_id);
			}
            $this->paginate = array('order'=>'Npb.id');
            if ($layout == 'pdf' || $layout == 'xls') {
                  $con = $this->Npb->find('all', array('conditions' => $conditions, 'order'=>'Npb.id'));
            } else {
                  $con = $this->paginate($conditions);
            }
            $this->set('npbs', $con);

            $npb_statuses = $this->Npb->NpbStatus->find('list');
            $suppliers = $this->Npb->Supplier->find('list');
            $departments = $this->Npb->Department->find('list');
            //$departmentSub = $this->Npb->Department->DepartmentSub->find('list', array('conditions'=>array('department_id'=>$department_id)));
            //$departmentUnit = $this->Npb->Department->DepartmentUnit->find('list', array('conditions'=>array('department_sub_id'=>$department_sub_id)));
            $businessType = $this->Npb->BusinessType->find('list');
            $costCenter = $this->Npb->CostCenter->find('list');
            $costCenters = $this->Npb->CostCenter->find('list', array('fields' => 'name'));
			//$cc 			= $this->Npb->query('select a.id,a.name,b.t24_dao from cost_centers a left join cost_center_to_daos b on b.cost_center_id = a.id where a.remarks = "Y" order by a.name');
			//foreach($cc as $data){
			//	if($data[0]['t24_dao']){
			//		$costCenters[ $data[0]['id'] ]	= $data[0]['name'] . " - " .$data[0]['t24_dao'];
			//	}else{
			//		$costCenters[ $data[0]['id'] ]	= $data[0]['name'];
			//	}				
			//}
            $npb_details = $this->Npb->NpbDetail->Item->find('all');
            $copyright_id = $this->configs['copyright_id'];
            // $items = $this->Npb->Item->find('all');
			$moduleName = 'MR > '. ucwords($type) . ' Report';
			$this->set('title_for_layout',  $this->lastSegment($moduleName));
            $this->set(compact('npb_statuses', 'departments', 'npb_npb_status_id', 'department_sub_id', 
				'department_unit_id', 'date_start', 'date_end', 'copyright_id', 'departmentSub', 'departmentUnit', 
				'businessType', 'costCenter', 'npb_department_id', 'npb_details', 'items', 'suppliers', 'department_id', 
				'type', 'costCenters', 'cost_center_id', 'business_type_id', 'moduleName'));

            if ($layout == 'pdf') {
                  Configure::write('debug', 0); // Otherwise we cannot use this method while developing
                  $this->layout = 'pdf'; //this will use the pdf.ctp layout
                  $this->render('npb_report_pdf');
            } else if ($layout == 'xls') {
                  $this->render('npb_report_xls', 'export_xls');
            }
      }

      function check_stock($id) {
            if (!$id) {
                  $this->Session->setFlash(__('Invalid npb', true));
                  $this->redirect(array('action' => 'index'));
            }
            $InventoryLedger = new InventoryLedger;
            $npb = $this->Npb->read(null, $id);
            $itemBalances = $InventoryLedger->getItemBalances();
            foreach ($npb['NpbDetail'] as $npbDetail) {
                  $npb_detail_id = $npbDetail['id'];
                  $qty = $npbDetail['qty'];
                  $balance = isset($itemBalances[$npbDetail['item_id']]) ? $itemBalances[$npbDetail['item_id']] : 0;
                  $qty_unfilled = $npbDetail['qty'] - $npbDetail['qty_filled'];
				  $qty_filled=$npbDetail['qty_filled'];
				  $isi=0;
				  if($qty_filled>$qty) $isi=$qty;
				  elseif($qty_filled<$qty) $isi=$qty_filled;
				  elseif(($qty>$balance) && ($qty_filled>$balance)) $isi=$balance;
				  elseif(($qty>$balance) && ($qty_filled<$balance)) $isi=$qty_filled;
				  
                  $sql = "update npb_details set qty_unfilled='".$qty_unfilled."' where id='".$npb_detail_id."'";
                  $this->Npb->query($sql);
            }
			
			$res	= $this->Npb->query('select item_id from point_reward_items');
			foreach($res as $data){
				$arrayVoucher[]	= $data[0]['item_id'];
			}
			//$arrayVoucher 	= array(402,403,404,405);
			$res	= $this->Npb->query('select id from items where request_type_id = "5" and id not in (select item_id from point_reward_items)');
			foreach($res as $data){
				$arrayLock[]	= $data[0]['id'];
			}
			//$arrayLock 		= array(390,391,392,393,394,395,396,397,398,399,400,401,425,7048,7049,7050,7051,7052,7053,387);
			
			$npb = $this->Npb->read(null, $id);
			
			//remove non stock items
			$n = 0;
			foreach($npb['NpbDetail'] as $detail){
				if($detail['process_type_id'] == 2){
					unset($npb['NpbDetail'][$n]);
				}
				$n++;
			}
			$npb['NpbDetail'] = array_values($npb['NpbDetail']);	
			
			//echo '<pre>';
			//var_dump($npb);
			//echo '</pre>';die();
            $this->set(compact('npb', 'itemBalances'));
      }

      function ajax_edit_notes($id) {
            $this->is_ajax = true;
            $this->edit_notes($id);
      }

      function edit_notes($id = null) {
            $msg = '';

            if ($this->is_ajax) {
                  $this->data = $_POST;
                  $this->layout = 'ajax';
                  $this->autoRender = false;
                  $fieldName = $this->data['editorId'];
                  $value = str_replace(',', '', $this->data['value']);
                  list($fieldName, $id) = explode('.', $fieldName);

                  $this->data = $this->Npb->read(null, $id);
                  $this->data['Npb'][$fieldName] = $value;
                  $this->data['Npb']['id'] = $id;
            }

            if (!$id && empty($this->data)) {
                  if ($this->is_ajax) {
                        $msg = __('Invalid MR detail', true);
                  } else {
                        $this->Session->setFlash(__('Invalid npb', true));
                        $this->redirect(array('action' => 'index'));
                  }
            }
            if (!empty($this->data)) {
                  if ($this->Npb->save($this->data)) {
                        if ($this->is_ajax) {
                              $msg = __('The MR has been saved', true);
                        } else {
                              $this->Session->setFlash(__('The MR has been saved', true), 'default', array('class' => 'ok'));
                              $this->redirect(array('action' => 'view'));
                        }
                  } else {
                        if ($this->is_ajax) {
                              $msg = __('The MR could not be saved. Please, try again.', true);
                        } else {
                              $this->Session->setFlash(__('The MR could not be saved. Please, try again.', true));
                        }
                  }
            }
            //if (empty($this->data)) {
            $this->data = $this->Npb->read(null, $id);
            //}
            if ($this->is_ajax) {
                  echo $this->data['Npb'][$fieldName];
            } else {
                  $departments = $this->Npb->Department->find('list');
                  $npbStatuses = $this->Npb->NpbStatus->find('list');
                  $requestTypes = $this->Npb->RequestTypes->find('list');
                  $this->set(compact('departments', 'npbStatuses', 'requestTypes'));
            }
      }
	  
	function split_npb($id, $level){
		$count_npb_id = $this->Npb->query('select count(id) as c from npb_details as npbDetails where npbDetails.npb_id="'.$id.'"');
		$count = $count_npb_id[0][0]['c'];
		$reqType = $this->Npb->NpbDetail->findByNpbId($id, array('Npb.request_type_id'));
		$reqTypeId = $reqType['Npb']['request_type_id'];
			
		if ($count >= 1 && $reqTypeId == 5) {
		
			$itemDetails = $this->Npb->NpbDetail->find('all', array(
												'conditions'=>array('NpbDetail.npb_id'=>$id),
												'order'=>'Item.code'));													
			$assCats	= $this->Npb->NpbDetail->find('all', array(
												'fields'=>'DISTINCT Item.id',
												'conditions'=>array('NpbDetail.npb_id'=>$id),
												'order'=>'Item.id'));
			
			$allow = 0;
			
			$arrayVoucher 	= array(402,403,404,405);
			$arrayLock 		= array(390,391,392,393,394,395,396,397,398,399,400,401,425,7048,7049,7050,7051,7052,7053,387);
			
			foreach($assCats as $cates){
				$cats[] = $cates['Item']['id'];
				if(in_array($cates['Item']['id'],$arrayLock)){
					$allow = 1;
				}
			}
			
			$res = $this->Npb->query('select top(1) id from npbs order by id desc');
			$newId = $res[0][0]['id'];
			
			$cats = array_values(array_unique($cats));
			$no1 = null;
			
			$newId = $newId + 1;
			
			$newMRData = $this->Npb->findById($id);
			$count = 1;
			
			if($allow == 1){
				foreach($cats as $item_id){
					if(in_array($item_id,$arrayLock)){
						if($no1){
							$newMRData['Npb']['no'] = $no1;
						}else{
							$newMRData['Npb']['no'] = $this->Npb->getNewId($this->Session->read('Userinfo.department_id'), $reqTypeId);							
						}						
						$no1 = $newMRData['Npb']['no'];
						$newMRData['Npb']['id'] = $newId;
						$newMRData['Npb']['npb_status_id'] = $level;
						$this->Npb->save($newMRData['Npb']);
						$this->Npb->query('update npb_details set npb_id = "'.$newId.'", process_type_id = 1 where npb_id="'.$id.'" and item_id = "'.$item_id.'"');													
					}
				}
			}			
		}
	}
	  
	function can_approve($level,$id) {
		
		$npbStatuses = $this->Npb->NpbStatus->find('list');
		$id_group = $this->Session->read('Security.permissions');
		
		$npbs = $this->Npb->read(null, $id);
		$count_npb_id = $this->Npb->query('select sum(npbDetails.qty) as c from npb_details as npbDetails where npbDetails.npb_id="'.$id.'"');
		$count = $count_npb_id[0][0]['c'];
		
		if($level == status_npb_sent_to_branch_head_id && $count >= 1){
			foreach($npbs as $npb){
				if ($level == status_npb_branch_approved_id || $level == status_npb_approved2_id || $level == status_npb_approved3_id || $level == status_npb_done_id){
					$this->data['Npb']['approved_date'] = date('Y-m-d H:i:s');
					$this->data['Npb']['approved_by']   = $this->Session->read('Userinfo.username');
				}
				if ($id_group == branch_head_group_id){
					$this->data['Npb']['approver_one']   = $this->Session->read('Userinfo.username');
					$this->data['Npb']['approved_one_date'] = date('Y-m-d H:i:s');
				}else if($id_group == mr_aproval2_group_id){
					$this->data['Npb']['approver_two']   = $this->Session->read('Userinfo.username');
					$this->data['Npb']['approved_two_date'] = date('Y-m-d H:i:s');
				}else if ($id_group == mr_aproval3_group_id){
					$this->data['Npb']['approver_three']   = $this->Session->read('Userinfo.username');
					$this->data['Npb']['approved_three_date'] = date('Y-m-d H:i:s');
				}
				
				$reqTypeId = $npbs['Npb']['request_type_id'];
				
				$this->data['Npb']['npb_status_id'] = $level;
				if($this->Npb->save($this->data)){		
					
					if($level == status_npb_sent_to_branch_head_id){
						$res = $this->Npb->findById($id);
					
						$emailParam = array();
						$emailParam['id'] 				= $res['Npb']['id'];
						$emailParam['no'] 				= $res['Npb']['no'];
						$emailParam['npb_date'] 		= $res['Npb']['npb_date'];
						$emailParam['branch'] 			= $res['Department']['name'];
						$emailParam['created_date'] 	= $res['Npb']['created_date'];
						$emailParam['request_type']		= $res['RequestTypes']['name'];
						$emailParam['requester'] 		= $res['Npb']['created_by'];
						$emailParam['department_id'] 	= $res['Npb']['department_id'];
						$emailParam['business_type_id'] = $res['Npb']['business_type_id'];
						$emailParam['request_type_id'] 	= $res['Npb']['request_type_id'];
						$emailParam['npb_status'] 		= $res['NpbStatus']['name'];
						//echo '<pre>';
						//var_dump($emailParam);
						//echo '</pre>';die();
						//$this->sendEmail(1,$emailParam);
					}
					$this->Session->setFlash(__('The MR has been updated to ' . $npbStatuses[$level], true), 'default', array('class'=>'ok'));
					if($level == status_npb_sent_to_branch_head_id){
						$this->Npb->query("update npb_details set price_cur = '0' where price_cur is null and npb_id = '".$id."' ");
						$this->redirect(array('action' => 'view', $id));
					}else{
						$this->redirect(array('action' => 'index'));
					}				
				} else {
					$this->Session->setFlash(__('The MR could not be Send. Please, check Payment term Must be 100%, Item detail, Date Due must have a date(YYYY-MM-DD) Must be filled And Total Amount can not be 0, and please check down payment', true));
					$this->redirect(array('action' => 'view', $id));
				}
			}		
		}else{
			$this->Session->setFlash(__('The MR could not be sent. Please, check your MR item details.', true));
			$this->redirect(array('action' => 'view', $id));
		}
	}
	
	function approve_npb($level,$id) {
		
		$id_group = $this->Session->read('Security.permissions');
		$this->data['Npb']['id']=$id;
		$npbs = $this->Npb->read(null, $id);
		$reqTypeId = $npbs['Npb']['request_type_id'];
		if($reqTypeId == request_type_point_reward_id){
			$level = status_npb_sent_to_rac_id; //if point reward, send to rac
		}else if($reqTypeId == request_type_fa_it_id){
			$level = status_npb_branch_approved_id;
		}
		$this->data['Npb']['npb_status_id']=$level;			
		$this->data['Npb']['approved_history'] = $npbs['Npb']['approved_history'].'<br />Approved : '.$this->Session->read('Userinfo.username').'/'.$this->Session->read('Userinfo.group_name').'/'.date('Y-m-d H:i:s').',';
		$npbStatuses = $this->Npb->NpbStatus->find('list');
		
		if ($id_group == branch_head_group_id || $id_group == rac_approval_group_id){
			$this->data['Npb']['approved_date'] = date('Y-m-d H:i:s');
			$this->data['Npb']['approved_by']   = $this->Session->read('Userinfo.username');
			$this->data['Npb']['approver_one']   = $this->Session->read('Userinfo.username');
			$this->data['Npb']['approver_one_date'] = date('Y-m-d H:i:s');
		}else if($id_group == mr_aproval2_group_id){
			$this->data['Npb']['approver_two']   = $this->Session->read('Userinfo.username');
			$this->data['Npb']['approver_two_date'] = date('Y-m-d');
		}else if ($id_group == mr_aproval3_group_id){
			$this->data['Npb']['approver_three']   = $this->Session->read('Userinfo.username');
			$this->data['Npb']['approver_three_date'] = date('Y-m-d');
		}
		if ($this->Npb->save($this->data)) {
			
			//if($level == 125){
				//$this->split_npb($id, $level);
			//}
			
			$res = $this->Npb->findById($id);
				
			$emailParam = array();
			$emailParam['id'] 				= $res['Npb']['id'];
			$emailParam['no'] 				= $res['Npb']['no'];
			$emailParam['npb_date'] 		= $res['Npb']['npb_date'];
			$emailParam['branch'] 			= $res['Department']['name'];
			$emailParam['created_date'] 	= $res['Npb']['created_date'];
			$emailParam['request_type']		= $res['RequestTypes']['name'];
			$emailParam['requester'] 		= $res['Npb']['created_by'];
			$emailParam['department_id'] 	= $res['Npb']['department_id'];
			$emailParam['business_type_id'] = $res['Npb']['business_type_id'];
			$emailParam['request_type_id'] 	= $res['Npb']['request_type_id'];
			$emailParam['npb_status'] 		= $res['NpbStatus']['name'];
			
			//$this->sendEmail(0,$emailParam);
		
			$this->Session->setFlash(__('The MR has been updated to ' . $npbStatuses[$level], true), 'default', array('class'=>'ok'));
			//$this->redirect(array('action' => 'view', $id));
			if($reqTypeId == 5){
				$this->redirect(array('controller'=>'npb_details', 'action' => 'voucher_index',3));
			}else{
				$this->redirect(array('action' => 'index'));
			}			
		} else {
			$this->Session->setFlash(__('The MR could not be saved. Please, try again.', true));
		}
		$this->edit($id);
	}
	
	function get_approve_link($id, $npb, $id_group)
	{
		//if can approve MR directly / under auth amount
		$group			= $this->Npb->query('select * from groups where id="'.$id_group.'"');
		if($npb['NpbDetail']){
			$rp_rate		= $npb['NpbDetail'][0]['rp_rate'];
		}else{
			$rp_rate		= '1';
		}
		$reqTypeId = $npb['Npb']['request_type_id'];		
		
		$res			= $this->Npb->query('select SUM(amount_cur) as total from npb_details where npb_id = "'.$id.'"');
		$total			= $res[0][0]['total'];
		$res			= $this->Npb->query('select created_by from npbs where id = "'.$id.'" ');
		$created_by		= $res[0][0]['created_by'];
		//2 = lv1, 104 = lv2, 105 = lv3
		if(DRIVER == 'mysql'){
			$auth_amount 	= $group[0]['groups']['auth_amount'];
		} elseif(DRIVER == 'mssql'){
			$auth_amount 	= $group[0][0]['auth_amount'];
		}
		$username		= $this->Session->read('Userinfo.username');
		
			if($reqTypeId == request_type_point_reward_id){
				if($id_group  == rac_group_id && $npb['Npb']['npb_status_id']==status_npb_draft_id)
				{
					$approveLink = array('label'=>__('Request Approval',true),				
					'options'=>array('action' => 'can_approve/'.status_npb_sent_to_branch_head_id , $id));
				}else if($id_group  == rac_approval_group_id 
					&& $npb['Npb']['npb_status_id']==status_npb_sent_to_branch_head_id 
					&& $username != $created_by)
				{	
					$approveLink = array('label'=>__('Finish MR',true),
					'options'=>array('action' => 'approve_npb/'.status_npb_sent_to_rac_id , $id));
				}
				else
				{
					$approveLink = array('label'=>__('Back',true), 'options'=>array('action'=>'index'));
				}
			}else{
				if($auth_amount > $total*$rp_rate && $total*$rp_rate >= 0 
					&& $npb['Npb']['npb_status_id']==status_npb_sent_to_branch_head_id 
					&& $id_group  == branch_head_group_id
					&& $username != $created_by)
				{
					$approveLink = array('label'=>__('Finish MR',true),
					'options'=>array('action' => 'approve_npb/'.status_npb_processing_id , $id)); 		
				}
				else if($auth_amount > $total*$rp_rate && $total*$rp_rate > 0 
					&& $npb['Npb']['npb_status_id']==status_npb_branch_approved_id 
					&& $id_group  == mr_aproval2_group_id
					&& $username != $created_by)
				{
					$approveLink = array('label'=>__('Finish MR',true),
					'options'=>array('action' => 'approve_npb/'.status_npb_processing_id , $id)); 		
				}
				else if($auth_amount > $total*$rp_rate && $total*$rp_rate > 0 
					&& $npb['Npb']['npb_status_id']==status_npb_approved2_id 
					&& $id_group  == mr_aproval3_group_id
					&& $username != $created_by)
				{
					$approveLink = array('label'=>__('Finish MR',true),
					'options'=>array('action' => 'approve_npb/'.status_npb_processing_id , $id)); 		
				}
				else
				{
					if($id_group  == normal_user_group_id && $npb['Npb']['npb_status_id']==status_npb_draft_id)
					{
						$approveLink = array('label'=>__('Request Approval',true), 					
						'options'=>array('action' => 'can_approve/'.status_npb_sent_to_branch_head_id , $id));					
					}
					else if($id_group  == branch_head_group_id 
						&& $npb['Npb']['npb_status_id']==status_npb_sent_to_branch_head_id 
						&& $username != $created_by)
					{
						$approveLink = array('label'=>__('Approve MR Level 1',true),
						'options'=>array('action' => 'approve_npb/'.status_npb_branch_approved_id , $id)); 
					}
					else if($id_group  == mr_aproval2_group_id 
						&& $npb['Npb']['npb_status_id']==status_npb_branch_approved_id 
						&& $username != $created_by)
					{
						$approveLink = array('label'=>__('Approve MR Level 2',true),
						'options'=>array('action' => 'approve_npb/'.status_npb_approved2_id , $id)); 
					}
					else if($id_group  == mr_aproval3_group_id 
						&& $npb['Npb']['npb_status_id']==status_npb_approved2_id 
						&& $username != $created_by)
					{
						$approveLink = array('label'=>__('Approve MR',true),
						'options'=>array('action' => 'approve_npb/'.status_npb_processing_id , $id)); 
					}else
					{
						$approveLink = array('label'=>__('Back',true), 'options'=>array('action'=>'index'));
					}
				}
			}	
		return $approveLink;
	}

}

?>
