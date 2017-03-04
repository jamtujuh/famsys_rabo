<?php

class PoDetailsController extends AppController {

      var $name = 'PoDetails';
      var $helpers = array('Ajax', 'Javascript');
      var $is_ajax = false;

      function index() {
	        $layout = $this->data['PoDetail']['layout'];
            $this->PoDetail->recursive = 1;
            $conditions = array();
			
			if(!$this->Session->check('PoDetail.report_type'))
				//$this->Session->write('PoDetail.report_type', 'Finish');
				$this->Session->write('PoDetail.report_type', 'All');

            if (!empty($this->data)) {
                  $this->Session->write('PoDetail.asset_category_id', $this->data['PoDetail']['asset_category_id']);

                  $this->Session->write('PoDetail.asset_category_type_id', $this->data['PoDetail']['asset_category_type_id']);

                  $this->Session->write('PoDetail.department_id', $this->data['PoDetail']['department_id']);
				  
                  $this->Session->write('PoDetail.po_status_id', $this->data['PoDetail']['po_status_id']);
				  
                  $this->Session->write('PoDetail.supplier_id', $this->data['PoDetail']['supplier_id']);
				  
                  $this->Session->write('PoDetail.currency_id', $this->data['PoDetail']['currency_id']);
					if ($this->data['PoDetail']['report_type']=='Outstanding')
					{
						$this->Session->write('PoDetail.report_type', 'Outstanding');
					}
					else if ($this->data['PoDetail']['report_type']=='Finish')
					{
						$this->Session->write('PoDetail.report_type', 'Finish');
					}
					else 
					{
						$this->Session->write('PoDetail.report_type', 'All');
					}
					
			}
			if(DRIVER=='mysql') {
				$conditions[] = array('(SELECT if(sum(qty)-sum(qty_received)=0,1,0) FROM po_details WHERE `po_details`.`po_id` = `Po`.`id`) = ' . 
					($this->Session->read('PoDetail.report_type')=='Finish'? 1 : 0) );
			}                
			elseif(DRIVER=='mssql') {
				if (($this->Session->read('PoDetail.report_type')!='All'))
				{
					$conditions[] = array('(select case sum(qty-qty_received) when 0 then 1 else 0 end from po_details WHERE po_details.po_id = Po.id) = ' . 
					($this->Session->read('PoDetail.report_type')=='Finish'? 1 : 0) );
				}			
					//$conditions[] = array('(select case sum(qty-qty_received) when 0 then 1 else 0 end from po_details WHERE po_details.po_id = Po.id) = ' . 
					//($this->Session->read('PoDetail.report_type')=='All'? 1 : (($this->Session->read('PoDetail.report_type')=='Finish'? 1 : 0))) );
			}
			if(!$this->Session->check('PoDetail.report_type'))
				//$this->Session->write('PoDetail.report_type', 'Finish');
				$this->Session->write('PoDetail.report_type', 'All');
				
            if ($this->Session->read('PoDetail.asset_category_type_id'))
                  $conditions[] = array('AssetCategory.asset_category_type_id' => $this->Session->read('PoDetail.asset_category_type_id'));

            if ($this->Session->read('PoDetail.asset_category_id'))
                  $conditions[] = array('PoDetail.asset_category_id' => $this->Session->read('PoDetail.asset_category_id'));

            if ($this->Session->read('PoDetail.department_id'))
                  $conditions[] = array('PoDetail.department_id' => $this->Session->read('PoDetail.department_id'));
				  
            if ($this->Session->read('PoDetail.po_status_id'))
                  $conditions[] = array('Po.po_status_id' => $this->Session->read('PoDetail.po_status_id'));

            if ($this->Session->read('PoDetail.supplier_id'))
                  $conditions[] = array('Po.supplier_id' => $this->Session->read('PoDetail.supplier_id'));
				  
            if ($this->Session->read('PoDetail.currency_id'))
                  $conditions[] = array('PoDetail.currency_id' => $this->Session->read('PoDetail.currency_id'));
				  
				  $conditions[] = array('Po.po_status_id !=' => status_po_archive_id);
                  $conditions[] = array('Po.po_status_id !=' => status_po_reject_id);
				  //var_dump($this->Session->read('PoDetail.report_type'));

            ///date fileter		
            list($date_start, $date_end) = $this->set_date_filters('PoDetail');
            $conditions[] = array('Po.po_date >=' => ($date_start['year'] . '-' . $date_start['month'] . '-' . $date_start['day']),
                'Po.po_date <=' => ($date_end['year'] . '-' . $date_end['month'] . '-' . $date_end['day']));

  			$this->paginate = array('order'=>'PoDetail.id');
			
			if($layout=='pdf' || $layout=='xls'){
				$con = $this->PoDetail->find('all', array('conditions'=>$conditions, 'order'=>'PoDetail.id'));
			}else{
				$con = $this->paginate($conditions);
			}
			//var_dump($conditions);
			$this->set('poDetails', $con);
			$npbs = $this->PoDetail->Po->Npb->find('list');
			$suppliers = $this->PoDetail->Po->Supplier->find('list');
			$requestType = $this->PoDetail->Po->RequestType->find('list');
            $poStatuses = $this->PoDetail->Po->PoStatus->find('list', array('conditions' =>array('AND'=>array('id !=' => status_po_archive_id),
																										array('id !=' => status_po_reject_id)))); //archive);
            $currencies = $this->PoDetail->Po->Currency->find('list');
            $currency = $this->PoDetail->Po->Currency->find('list', array('fields'=>'is_desimal'));
            $businessType = $this->PoDetail->BusinessType->find('list');
            $departments = $this->PoDetail->Department->find('list');
            $copyright_id = $this->configs['copyright_id'];
            $assetCategoryTypes = $this->PoDetail->AssetCategory->AssetCategoryType->find('list');
            $assetCategories = $this->PoDetail->AssetCategory->find('list', array('conditions' => array('asset_category_type_id' => $this->Session->read('PoDetail.asset_category_type_id'))));
			$moduleName = 'PO > List PO Detail';
			$this->set('title_for_layout',  $this->lastSegment($moduleName));
			$this->set(compact('npbs','businessType', 'currencies', 'currency', 'departments', 'copyright_id', 'assetCategoryTypes', 'assetCategories', 'moduleName',
								'date_start', 'date_end', 'poStatuses', 'suppliers', 'requestType'));
			if ($layout == 'pdf') {
				Configure::write('debug', 2); // Otherwise we cannot use this method while developing 
				$this->layout = 'pdf'; //this will use the pdf.ctp layout 
				$this->render('index_pdf');
            } else if ($layout == 'xls') {
                $this->render('index_xls', 'export_xls');
            }

      }

      function view($id = null) {
            if (!$id) {
                  $this->Session->setFlash(__('Invalid po detail', true));
                  $this->redirect(array('action' => 'index'));
            }
            $this->set('poDetail', $this->PoDetail->read(null, $id));
      }

      function add() {
            if (!empty($this->data)) {
                  $this->PoDetail->create();

                  if (!isset($this->data['PoDetail']['name'])) { // dari stock po
                        $this->data['PoDetail']['name'] = $this->data['Item']['name'];
                  }

                  if ($this->PoDetail->save($this->data)) {
                        $this->update_po_totals($this->data['PoDetail']['po_id']);
                        $this->Session->setFlash(__('The po detail has been saved', true), 'default', array('class' => 'ok'));
                        $this->redirect(array('controller' => 'pos', 'action' => 'view', $this->Session->read('Po.id')));
                  } else {
                        $this->Session->setFlash(__('The po detail could not be saved. Please, try again.', true));
                  }
            }
            $po = $this->PoDetail->Po->read(null, $this->Session->read('Po.id'));
            $assetCategories = $this->PoDetail->AssetCategory->find('list', array('conditions' => array('is_asset' => 1)));
            $currencies = $this->PoDetail->Currency->find('list');
            $this->set(compact('po', 'assetCategories', 'currencies', 'po'));
      }

      function ajax_add() {
            $this->layout = 'ajax';
            $this->autoRender = false;
            $msg = '';
            $count = 0;
            $poDetail = null;
            if (!empty($this->data)) {

                  if (!isset($this->data['PoDetail']['name'])) { // dari stock po
                        //$this->data['PoDetail']['item_code']=$this->data['Item']['code'];
                        //$this->data['PoDetail']['name']		=$this->data['Item']['name'];
                  }
                  $item = $this->PoDetail->Item->read(null, $this->data['PoDetail']['item_id']);
                  $this->data['PoDetail']['item_code'] = $item['Item']['code'];
                  $this->data['PoDetail']['name'] = $item['Item']['name'];
                  $this->PoDetail->create();
                  if ($this->PoDetail->save($this->data)) {
                        $this->update_po_totals($this->Session->read('Po.id'));
                        $msg = __('The po detail has been saved', true);
                        $status = 'ok';
                        $poDetail = $this->PoDetail->read(null, $this->PoDetail->id);
                        $count = $this->PoDetail->find('count', array('conditions' => array('PoDetail.po_id' => $this->Session->read('Po.id'))));
                  } else {
                        $status = 'failed';
                        $msg = __('The po detail could not be saved. Please, try again.', true);
                  }
            }

            echo json_encode(array('status' => $status, 'msg' => $msg, 'data' => $poDetail, 'count' => $count));
      }

      function edit($id = null) {
            $msg = '';

            if ($this->is_ajax) {
                $this->data = $_POST;
                $this->layout = 'ajax';
                $this->autoRender = false;
                $fieldName = $this->data['editorId'];
                $value = str_replace(',', '', $this->data['value']);
                list($fieldName, $id) = explode('.', $fieldName);
				
                $this->data = $this->PoDetail->read(null, $id);
                $this->data['PoDetail'][$fieldName] = $value;
                $this->data['PoDetail']['id'] = $id;
				if($fieldName == 'price_cur'){
					$this->data['PoDetail']['price'] = $value;
				}
            }

            if (!$id && empty($this->data)) {
                  if ($this->is_ajax) {
                        $msg = __('Invalid po detail', true);
                  } else {
                        $this->Session->setFlash(__('Invalid po detail', true));
                        $this->redirect(array('action' => 'index'));
                  }
            }
			
            if (!empty($this->data)) {
				$poDetail = $this->PoDetail->read(null, $id);						
				if($fieldName == 'qty' && ($poDetail['PoDetail']['qty'] < $value)){							
					$this->PoDetail->query('update npb_details set qty = '.$value.' where id = '.$poDetail['PoDetail']['npb_detail_id']);
				}
				
				if($fieldName == 'price_cur' && ($poDetail['PoDetail']['price_cur'] < $value)){
					$res	= $this->PoDetail->query('select qty from npb_details where id = "'.$poDetail['PoDetail']['npb_detail_id'].'" ');
					$qty 	= $res[0][0]['qty'];
					$amount	= $qty * $value;
					$this->PoDetail->query('update npb_details set price = '.$value.', price_cur = '.$value.', amount = '.$amount.', amount_cur = '.$amount.' where id = '.$poDetail['PoDetail']['npb_detail_id']);
				}
				
                  if ($this->PoDetail->save($this->data)) {
                        $this->update_po_totals($this->data['PoDetail']['po_id']);
						
						
                        //update npb detail set qty fill = qty di po untuk nbp detail ID yg sesuai dengan tercatat di po detail
                        //update npb_details set qty_filled = $this->data['PoDetail']['qty'] where id = $this->data['PoDetail']['npb_detail_id']
                        if ($this->is_ajax) {
                              $msg = __('The po detail has been saved', true);
                        } else {
                              $this->Session->setFlash(__('The po detail has been saved', true), 'default', array('class' => 'ok'));
                              $this->redirect(array('controller' => 'pos', 'action' => 'view', $this->Session->read('Po.id')));
                        }
                  } else {
                        if ($this->is_ajax) {
                              $msg = __('The po detail could not be saved. Please, try again.', true);
                        } else {
                              $this->Session->setFlash(__('The po detail could not be saved. Please, try again.', true));
                        }
                  }
            }
            //if (empty($this->data)) {
            $this->data = $this->PoDetail->read(null, $id);
            //}

            if ($this->is_ajax) {
                  if ($fieldName == 'brand' || $fieldName == 'color' || $fieldName == 'type') {
                        echo $this->data['PoDetail'][$fieldName];
                  } else {
						$currency = $this->PoDetail->Currency->find('list', array('fields'=>'is_desimal'));
						$places = $this->getPlaces($currency[$this->data['PoDetail']['currency_id']]);
                        echo number_format($this->data['PoDetail'][$fieldName], $places);
                  }

                  //echo json_encode(array('data'=>$this->data,'msg'=>$msg));
                  //echo number_format($this->data['PoDetail'][$fieldName],0);
                  //update qty_filled do npb
                  /*
				  if ($fieldName == 'qty') {
                        $qty_filled = $this->data['PoDetail'][$fieldName];
                        $npb_detail_id = $this->data['PoDetail']['npb_detail_id'];
                        $sql = 'update npb_details set qty_filled="' . $qty_filled . '" where id="' . $npb_detail_id . '"';
                        $this->PoDetail->query($sql);
                  }
				  */
            } else {
                  $pos = $this->PoDetail->Po->find('list');
                  $assetCategories = $this->PoDetail->AssetCategory->find('list', array('conditions' => array('is_asset' => 1)));
                  $currencies = $this->PoDetail->Currency->find('list');
                  $this->set(compact('pos', 'assetCategories', 'currencies'));
            }
      }

      function ajax_edit($id) {
            $this->is_ajax = true;
            $this->edit($id);
      }

      function delete($id = null) {
            if (!$id) {
                  $this->Session->setFlash(__('Invalid id for po detail', true));
                  $this->redirect(array('action' => 'index'));
            }

            $poDetail = $this->PoDetail->read(null, $id);
            $po_id = $poDetail['PoDetail']['po_id'];
            $npb_detail_id = $poDetail['PoDetail']['npb_detail_id'];
			
			$npbDetail = $this->PoDetail->Po->NpbDetail->read(null, $npb_detail_id);
			$npb_id = $npbDetail['NpbDetail']['npb_id'];

			$this->PoDetail->Po->NpbDetail->id = $npb_detail_id;
			$this->PoDetail->Po->NpbDetail->set('qty_filled', 0);
			$this->PoDetail->Po->NpbDetail->set('qty_unfilled', $npbDetail['NpbDetail']['qty']);
			$this->PoDetail->Po->NpbDetail->set('date_finish', '0000-00-00');
			$this->PoDetail->Po->NpbDetail->set('po_id', null);
			$this->PoDetail->Po->NpbDetail->save();
			
			$this->PoDetail->Po->Npb->id=$npb_id;
			$this->PoDetail->Po->Npb->set('npb_status_id', status_npb_processing_id);
			$this->PoDetail->Po->Npb->save();

 		
            if ($this->PoDetail->delete($id)) {
                  $this->update_po_totals($po_id, true, $id);
                  $this->Session->setFlash(__('Po detail deleted', true), 'default', array('class' => 'ok'));
                  $this->redirect(array('controller' => 'pos', 'action' => 'view', $this->Session->read('Po.id')));
            }
            $this->Session->setFlash(__('Po detail was not deleted', true));
            $this->redirect(array('action' => 'index'));
      }

      function set_vat($id = null, $is_vat) {
            $poDetail = $this->PoDetail->read(null, $id);
            $this->data['PoDetail']['is_vat'] = $is_vat;
            $this->data['PoDetail']['amount_after_disc'] = $poDetail['PoDetail']['amount_after_disc'];
            $po_id = $poDetail['PoDetail']['po_id'];

            if ($this->PoDetail->save($this->data)) {
                  $this->update_po_totals($po_id);
                  $this->Session->setFlash(__('The po has been saved', true), 'default', array('class' => 'ok'));
                  $this->redirect(array('controller' => 'pos', 'action' => 'view', $this->Session->read('Po.id')));
            } else {
                  $this->Session->setFlash(__('The po could not be saved. Please, try again.', true));
                  $this->redirect(array('controller' => 'pos', 'action' => 'view', $this->Session->read('Po.id')));
            }
      }

      function set_wht($id = null, $is_wht) {
            $poDetail = $this->PoDetail->read(null, $id);
            $this->data['PoDetail']['is_wht'] = $is_wht;
            $this->data['PoDetail']['amount_after_disc'] = $poDetail['PoDetail']['amount_after_disc'];
            $po_id = $poDetail['PoDetail']['po_id'];

            if ($this->PoDetail->save($this->data)) {
                  $this->update_po_totals($po_id);
                  $this->Session->setFlash(__('The po has been saved', true), 'default', array('class' => 'ok'));
                  $this->redirect(array('controller' => 'pos', 'action' => 'view', $this->Session->read('Po.id')));
            } else {
                  $this->Session->setFlash(__('The po could not be saved. Please, try again.', true));
                  $this->redirect(array('controller' => 'pos', 'action' => 'view', $this->Session->read('Po.id')));
            }
      }

      function edit_received($id = null) {
            if (!$id && empty($this->data)) {
                  $this->Session->setFlash(__('Invalid po detail', true));
                  $this->redirect(array('action' => 'index'));
            }
            if (!empty($this->data)) {

                  if ($this->data['PoDetail']['qty_received'] > $this->data['PoDetail']['qty']) {
                        $this->data['PoDetail']['qty_received'] = $this->data['PoDetail']['qty'];
                  }

                  if ($this->PoDetail->save($this->data)) {
                        $this->Session->setFlash(__('The po detail has been saved', true), 'default', array('class' => 'ok'));
                        $this->redirect(array('controller' => 'pos', 'action' => 'view_received', $this->Session->read('Po.id')));
                  } else {
                        $this->Session->setFlash(__('The po detail could not be saved. Please, try again.', true));
                  }
            }
            if (empty($this->data)) {
                  $this->data = $this->PoDetail->read(null, $id);
            }
            $pos = $this->PoDetail->Po->find('list');
            $assetCategories = $this->PoDetail->AssetCategory->find('list', array('conditions' => array('is_asset' => 1)));
            $currencies = $this->PoDetail->Currency->find('list');
            $departments = $this->PoDetail->Department->find('list');
            $this->set(compact('pos', 'assetCategories', 'currencies', 'departments'));
      }

      function update_po_totals($po_id, $delete=false, $id=null) {
            unset($this->data);
            $po = $this->PoDetail->Po->read(null, $po_id);
            unset($this->data['PoDetail']);
            $this->data['Po']['id'] = $po['Po']['id'];

            //in currency
            $this->data['Po']['sub_total_cur'] = $po['Po']['vsubtotal_cur'] + 0;
            $this->data['Po']['discount_cur'] = $po['Po']['vtotal_discount_cur'] + 0;
            $this->data['Po']['after_disc_cur'] = $po['Po']['vtotal_after_disc_cur'] + 0;
            $this->data['Po']['vat_base_cur'] = $po['Po']['vtotal_vat_base_cur'] + 0;
            $this->data['Po']['vat_total_cur'] = $po['Po']['vtotal_vat_cur'] + 0;

            //in home currency
            $this->data['Po']['sub_total'] = $po['Po']['vsubtotal'] + 0;
            $this->data['Po']['discount'] = $po['Po']['vtotal_discount'] + 0;
            $this->data['Po']['after_disc'] = $po['Po']['vtotal_after_disc'] + 0;
            $this->data['Po']['vat_base'] = $po['Po']['vtotal_vat_base'] + 0;
            $this->data['Po']['vat_total'] = $po['Po']['vtotal_vat'] + 0;

            //save date_finish, when PO is done
            if ($po['Po']['v_is_done'] == 1)
                  $this->data['Po']['date_finish'] = date('Y-m-d');

            $this->PoDetail->Po->save($this->data);
//		$this->log(var_export($this->data,true));

            if ($delete)
                  $this->PoDetail->delete($id);
      }

      function order_report() {
            $id_group = $this->Session->read('Security.permissions');
            $layout = $this->data['PoDetail']['layout'];
            $this->PoDetail->recursive = 1;
            $conditions = array();

            if (!empty($this->data)) {
                  $this->Session->write('PoDetail.asset_category_id', $this->data['PoDetail']['asset_category_id']);

                  $this->Session->write('PoDetail.asset_category_type_id', $this->data['PoDetail']['asset_category_type_id']);

                  $this->Session->write('PoDetail.department_id', $this->data['PoDetail']['department_id']);
            }

            if ($this->Session->read('PoDetail.asset_category_id'))
                  $conditions[] = array('PoDetail.asset_category_id' => $this->Session->read('PoDetail.asset_category_id'));

            if ($this->Session->read('PoDetail.department_id'))
                  $conditions[] = array('PoDetail.department_id' => $this->Session->read('PoDetail.department_id'));
				  
			$this->paginate = array('order'=>'PoDetail.id');

            ///date fileter		
            list($date_start, $date_end) = $this->set_date_filters('PoDetail');
            $conditions[] = array('Po.po_date >=' => ($date_start['year'] . '-' . $date_start['month'] . '-' . $date_start['day']),
                'Po.po_date <=' => ($date_end['year'] . '-' . $date_end['month'] . '-' . $date_end['day']));

            if ($layout == 'pdf' || $layout == 'xls') {
                  $con = $this->PoDetail->find('all', array('conditions' => $conditions, 'order'=>'PoDetail.id'));
            } else {
                  $con = $this->paginate($conditions);
            }
            $this->set('poDetails', $con);

            $currencies = $this->PoDetail->Po->Currency->find('list');
            $currency = $this->PoDetail->Po->Currency->find('list', array('fields'=>'is_desimal'));
            $departments = $this->PoDetail->Department->find('list');
            $copyright_id = $this->configs['copyright_id'];
            $assetCategoryTypes = $this->PoDetail->AssetCategory->AssetCategoryType->find('list');
            $assetCategories = $this->PoDetail->AssetCategory->find('list', array('conditions' => array('asset_category_type_id' => $this->Session->read('PoDetail.asset_category_type_id'))));
			$moduleName = 'Report > PO > Item Order Report';
			$this->set('title_for_layout',  $this->lastSegment($moduleName));
            $this->set(compact(
                            'poDetails', 'po_statuses', 'departments', 'copyright_id', 'currencies', 
							'date_start', 'date_end', 'suppliers', 'supplier_id', 
							'assetCategoryTypes', 'assetCategories', 'moduleName', 'currency'
                    ));
            if ($layout == 'pdf') {
                  Configure::write('debug', 0); // Otherwise we cannot use this method while developing 
                  $this->layout = 'pdf'; //this will use the pdf.ctp layout 
                  $this->render('order_report_pdf');
            } else if ($layout == 'xls') {
                  $this->render('order_report_xls', 'export_xls');
            }
      }
      function report_service() {
        $this->PoDetail->recursive = 0;
        $layout = $this->data['PoDetail']['layout'];
		if(!empty($this->data)){
			if($this->data['Item']['name'] == ''){
				$this->data['PoDetail']['item_id'] = null;
			}
		}
		if($department_id = $this->data['PoDetail']['department_id']){
			$conditions[] = array('PoDetail.department_id'=>$department_id);
		}
		if($asset_category_id = $this->data['PoDetail']['asset_category_id']){
			$conditions[] = array('PoDetail.asset_category_id'=>$asset_category_id);
		}
		if($item_id = $this->data['PoDetail']['item_id']){
			$conditions[] = array('PoDetail.item_id'=>$item_id);
		}
		$conditions[] = array('Po.request_type_id'=>request_type_service_id);
		$con = $this->paginate($conditions);
  		$this->paginate = array('order'=>'PoDetail.id');
		if ($layout == 'pdf' || $layout == 'xls') {
			  $con = $this->PoDetail->find('all', array('conditions' => $conditions, 'order'=>'PoDetail.id'));
		} else {
			  $con = $this->paginate($conditions);
		}
		$this->set('poDetails', $con);
        $departments = $this->PoDetail->Department->find('list');
        $items = $this->PoDetail->Item->find('list');
        $assetCategories = $this->PoDetail->AssetCategory->find('list', array('conditions'=>array('AssetCategory.asset_category_type_id'=>3)));
        $npbs = $this->PoDetail->Po->Npb->find('list');
		$this->set(compact('departments', 'assetCategories', 'npbs', 'items'));
		 if ($layout == 'pdf') {
			  Configure::write('debug', 0); // Otherwise we cannot use this method while developing 
			  $this->layout = 'pdf'; //this will use the pdf.ctp layout 
			  $this->render('report_service_pdf');
		} else if ($layout == 'xls') {
			  $this->render('report_service_xls', 'export_xls');
		}
     }

}

?>
