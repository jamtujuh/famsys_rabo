<?php

class DeliveryOrderDetailsController extends AppController {

      var $name = 'DeliveryOrderDetails';
      var $helpers = array('Ajax', 'Javascript');
      var $is_ajax = false;

      function index() {
            $this->DeliveryOrderDetail->recursive = 0;
			$this->paginate = array('order'=>'DeliveryOrderDetail.id');
            $this->set('deliveryOrderDetails', $this->paginate());
      }

      function view($id = null) {
            if (!$id) {
                  $this->Session->setFlash(__('Invalid delivery order detail', true));
                  $this->redirect(array('action' => 'index'));
            }
            $this->set('deliveryOrderDetail', $this->DeliveryOrderDetail->read(null, $id));
      }

      function add() {
            if (!empty($this->data)) {
                  $this->DeliveryOrderDetail->create();
                  if ($this->DeliveryOrderDetail->save($this->data)) {
                        $this->Session->setFlash(__('The delivery order detail has been saved', true), 'default', array('class' => 'ok'));
                        $this->redirect(array('action' => 'index'));
                  } else {
                        $this->Session->setFlash(__('The delivery order detail could not be saved. Please, try again.', true));
                  }
            }
            $deliveryOrders = $this->DeliveryOrderDetail->DeliveryOrder->find('list');
            $pos = $this->DeliveryOrderDetail->Po->find('list');
            $assetCategories = $this->DeliveryOrderDetail->AssetCategory->find('list');
            $currencies = $this->DeliveryOrderDetail->Currency->find('list');
            $npbs = $this->DeliveryOrderDetail->Npb->find('list');
            $departments = $this->DeliveryOrderDetail->Department->find('list');
            $costcenter = $this->DeliveryOrderDetail->CostCenter->find('list');
            $businessType = $this->DeliveryOrderDetail->Department->BusinessType->find('list');
            $this->set(compact('deliveryOrders', 'pos', 'assetCategories', 'currencies', 'npbs', 'departments', 'costcenter', 'businessType'));
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

                  $this->data = $this->DeliveryOrderDetail->read(null, $id);

                  if ($fieldName == 'qty_received') {
                        if ($value > $this->data['DeliveryOrderDetail']['qty'])
                              $value = $this->data['DeliveryOrderDetail']['qty'];
                        if ($value < 0 || $value == null)
                              $value = 0;
                  }

                  $this->data['DeliveryOrderDetail'][$fieldName] = $value;
                  $this->data['DeliveryOrderDetail']['id'] = $id;
            }

            if (!$id && empty($this->data)) {
                  if ($this->is_ajax) {
                        $msg = __('Invalid delivery order detail', true);
                  } else {
                        $this->Session->setFlash(__('Invalid delivery order detail', true));
                        $this->redirect(array('action' => 'index'));
                  }
            }

            if (!empty($this->data)) {
                  if ($this->DeliveryOrderDetail->save($this->data)) {

                        //update po dilakukan pada saat approve
                        $this->data = $this->DeliveryOrderDetail->read(null, $id);
                        $this->DeliveryOrderDetail->update_po_detail_qty(false);

                        if ($this->is_ajax) {
                              $msg = __('The delivery order detail has been saved', true);
                        } else {
                              $this->Session->setFlash(__('The delivery order detail has been saved', true), 'default', array('class' => 'ok'));
                              $this->redirect(array('action' => 'index'));
                        }
                  } else {
                        if ($this->is_ajax) {
                              $msg = __('The delivery order detail could not be saved. Please, try again.', true);
                        } else {
                              $this->Session->setFlash(__('The delivery order detail could not be saved. Please, try again.', true));
                        }
                  }
            }

            if (empty($this->data)) {
                  $this->data = $this->DeliveryOrderDetail->read(null, $id);
            }

            if ($this->is_ajax) {
                  echo $this->data['DeliveryOrderDetail'][$fieldName];
            } else {
                  $deliveryOrders = $this->DeliveryOrderDetail->DeliveryOrder->find('list');
                  $pos = $this->DeliveryOrderDetail->Po->find('list');
                  $assetCategories = $this->DeliveryOrderDetail->AssetCategory->find('list');
                  $currencies = $this->DeliveryOrderDetail->Currency->find('list');
                  $npbs = $this->DeliveryOrderDetail->Npb->find('list');
                  $departments = $this->DeliveryOrderDetail->Department->find('list');
                  $this->set(compact('deliveryOrders', 'pos', 'assetCategories', 'currencies', 'npbs', 'departments'));
            }
      }

      function ajax_edit($id) {
            $this->is_ajax = true;
            $this->edit($id);
      }

      function delete($id = null) {
            if (!$id) {
                  $this->Session->setFlash(__('Invalid id for delivery order detail', true));
                  $this->redirect(array('action' => 'index'));
            }
            if ($this->DeliveryOrderDetail->delete($id)) {
                  $this->Session->setFlash(__('Delivery order detail deleted', true), 'default', array('class' => 'ok'));
                  $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Delivery order detail was not deleted', true));
            $this->redirect(array('action' => 'index'));
      }

      function receive_report() {
            $id_group = $this->Session->read('Security.permissions');
            $layout = $this->data['DeliveryOrderDetail']['layout'];
            $this->DeliveryOrderDetail->recursive = 1;
            $conditions = array();

            if (!empty($this->data)) {
                  $this->Session->write('DeliveryOrderDetail.asset_category_id', $this->data['DeliveryOrderDetail']['asset_category_id']);

                  $this->Session->write('DeliveryOrderDetail.asset_category_type_id', $this->data['DeliveryOrderDetail']['asset_category_type_id']);
            }

            if ($this->Session->read('DeliveryOrderDetail.asset_category_id'))
                  $conditions[] = array('DeliveryOrderDetail.asset_category_id' => $this->Session->read('DeliveryOrderDetail.asset_category_id'));
			$this->paginate = array('order'=>'DeliveryOrderDetail.id');
            ///date filter		
            list($date_start, $date_end) = $this->set_date_filters('DeliveryOrderDetail');
            $conditions[] = array('DeliveryOrder.do_date >=' => ($date_start['year'] . '-' . $date_start['month'] . '-' . $date_start['day']),
                'DeliveryOrder.do_date <=' => ($date_end['year'] . '-' . $date_end['month'] . '-' . $date_end['day']));

            if ($layout == 'pdf' || $layout == 'xls') {
                  $con = $this->DeliveryOrderDetail->find('all', array('conditions' => $conditions));
            } else {
                  $con = $this->paginate($conditions);
            }
            $this->set('deliveryOrderDetails', $con);

            $currencies = $this->DeliveryOrderDetail->Currency->find('list');
            $currency = $this->DeliveryOrderDetail->Currency->find('list', array('fields'=>'is_desimal'));
            $copyright_id = $this->configs['copyright_id'];
            $departments = $this->DeliveryOrderDetail->Department->find('list');
            $assetCategoryTypes = $this->DeliveryOrderDetail->AssetCategory->AssetCategoryType->find('list');
            $assetCategories = $this->DeliveryOrderDetail->AssetCategory->find('list', array('conditions' => array('asset_category_type_id' => $this->Session->read('DeliveryOrderDetail.asset_category_type_id'))));
			$moduleName = 'Report > PO > Item Receive Report';
			$this->set('title_for_layout',  $this->lastSegment($moduleName));
            $this->set(compact(
                            'deliveryOrderDetails', 'copyright_id', 'delivery_order_statuses', 'currency',
							'departments', 'delivery_order_status_id', 'date_start', 'date_end', 'suppliers', 
							'supplier_id', 'assetCategoryTypes', 'assetCategories','currencies', 'moduleName'
                    ));
            if ($layout == 'pdf') {
                  Configure::write('debug', 0); // Otherwise we cannot use this method while developing 
                  $this->layout = 'pdf'; //this will use the pdf.ctp layout 
                  $this->render('receive_report_pdf');
            } else if ($layout == 'xls') {
                  $this->render('receive_report_xls', 'export_xls');
            }
      }

}

?>