<?php
App::import('Controller','Outlog');
App::import('Controller','InventoryLedgers');
App::import('Controller','Inlogs');
App::import('Controller','InlogDetails');
App::import('Model','Inlog');
App::import('Model','InlogDetail');
App::import('Model','AssetCategory');

class DeliveryOrdersController extends AppController {

    var $name = 'DeliveryOrders';
    var $helpers = array('Ajax', 'Javascript');

	function index($po_id=null) {
		Configure::write('debug',1);
		if (!$po_id) {
			$this->Session->setFlash(__('Invalid PO Id', true));
			$this->redirect(array('controller' => 'pos', 'action' => 'index'));
		}

		$po = $this->DeliveryOrder->Po->read(null, $po_id);
		//echo '<pre>';
		//var_dump($po);
		//echo '<pre>';die();
		
		if (empty($po)) {
			  $this->Session->setFlash(__('Cannot find PO id ' . $po_id, true));
			  $this->redirect(array('controller' => 'pos', 'action' => 'index'));
		}
		$this->Session->write('Po.id', $po_id);
		
		if (DRIVER=='mysql') {
			$t_cur 		= $this->DeliveryOrder->query('select sum(delivery_orders.total_cur) from delivery_orders where delivery_orders.po_id = "'.$this->Session->read('Po.id').'"');
			$tot_cur 	= $t_cur[0][0]['sum(delivery_orders.total_cur)'];
		} elseif (DRIVER=='mssql') {
			$t_cur 		= $this->DeliveryOrder->query('select sum(delivery_orders.total_cur) from delivery_orders where delivery_orders.po_id = "'.$this->Session->read('Po.id').'"');
			$tot_cur 	= $t_cur[0][0]['computed'];
		}
		//var_dump($tot_cur);
		$this->set('tot_cur', $tot_cur);

		$this->DeliveryOrder->recursive = 0;
		$this->set('po_id', $po_id);
		$this->set('po', $po);
		$this->paginate = array('order'=>'DeliveryOrder.id');
		$this->set('deliveryOrders', $this->paginate(array('DeliveryOrder.po_id' => $po_id)));
	}

    function list_delivery_order($delivery_order_status_id=null, $convert_asset=null, $dono=null) {
		Configure::write('debug',1);
		$this->DeliveryOrder->recursive = 1;
		$layout = $this->data['DeliveryOrder']['layout'];
		$group = $this->Session->read('Security.permissions');
		
		if(!empty($this->data)){
		$this->Session->write('Po.no', trim($this->data['Po']['no']));
		if($this->data['Po']['no'] == '')
			$this->data['DeliveryOrder']['po_id'] = null;
		}
		
		$conditions = array();
		
		if($group == fa_management_group_id){
			$conditions[] = array('DeliveryOrder.request_type_id' => request_type_fa_general_id);
		}else if($group == it_management_group_id){
			$conditions[] = array('DeliveryOrder.request_type_id' => request_type_fa_it_id);
		}
		
		if($convert_asset != null)
			  $conditions[] = array('DeliveryOrder.convert_asset' => $convert_asset);
			   
		if ($po_id = $this->data['DeliveryOrder']['po_id']) {
			  $conditions[] = array('DeliveryOrder.po_id' => $po_id);
		}
		
		//set up filters delivery_order_status_id
		if ($delivery_order_status_id)
			  $this->Session->write('DeliveryOrder.delivery_order_status_id', $delivery_order_status_id);
		else if (isset($this->data['DeliveryOrder']['delivery_order_status_id']))
			  $this->Session->write('DeliveryOrder.delivery_order_status_id', $this->data['DeliveryOrder']['delivery_order_status_id']);
		
		if ($delivery_order_status_id = $this->Session->read('DeliveryOrder.delivery_order_status_id'))
			  $conditions[] = array('delivery_order_status_id' => $delivery_order_status_id);
		
		// setup filter number
		if ($dono)
			  $this->Session->write('DeliveryOrder.DoNo', trim($dono));
		else if (isset($this->data['DeliveryOrder']['DoNo']))
			  $this->Session->write('DeliveryOrder.DoNo', trim($this->data['DeliveryOrder']['DoNo']));
		if ($dono = $this->Session->read('DeliveryOrder.DoNo'))
			  $conditions[] = array('DeliveryOrder.no LIKE' => '%'. $dono . '%');

		 /* if (isset($this->data['DeliveryOrder']['DoNo']))
			if(trim($this->data['DeliveryOrder']['DoNo']) == '')
			$this->data['DeliveryOrder']['DoNo'] = null;
		$this->Session->write('DeliveryOrder.DoNo', $this->data['DeliveryOrder']['DoNo']);
		if ($no = $this->Session->read('DeliveryOrder.DoNo'))				
			$conditions[] = array('DeliveryOrder.no LIKE' => '%' . $no . '%') ; */
			
		list($date_start, $date_end) = $this->set_date_filters('DeliveryOrder');
		$conditions[] = array('DeliveryOrder.do_date >=' => ($date_start['year'] . '-' . $date_start['month'] . '-' . $date_start['day']),
			'DeliveryOrder.do_date <=' => ($date_end['year'] . '-' . $date_end['month'] . '-' . $date_end['day']));
		
		/*if ($delivery_order_status_id==2 && $convert_asset==1)
		{
			$this->DeliveryOrder->bindModel(
							array('hasOne' => array(
								'InvoicesDeliveryOrder' => array(
									'className' => 'InvoicesDeliveryOrder')
								)));				
			$conditions[] = array('InvoicesDeliveryOrder.id'=>null); // id of Dessert
		}
	
		 		$conditions[] = array('delivery_order_status_id'=>$this->Session->read('DeliveryOrder.delivery_order_status_id') );
		*/
		//echo '<pre>';
		//var_dump($conditions);
		//echo '</pre>';die();
		if ($layout == 'pdf' || $layout == 'xls')
		{
			$con = $this->DeliveryOrder->find('all', array('conditions' => $conditions));
		} else {
			$con = $this->DeliveryOrder->find('all', array('conditions' => $conditions));
			$con = $this->paginate($conditions);
		}
		
		$this->set('deliveryOrders', $con);
		$copyright_id 			= $this->configs['copyright_id'];
		$deliveryOrderStatuses 	= $this->DeliveryOrder->DeliveryOrderStatus->find('list');
		$currencies 			= $this->DeliveryOrder->Po->Currency->find('list');
		$pos 					= $this->DeliveryOrder->Po->find('list');
		$currency				= $this->DeliveryOrder->Currency->find('list', array('fields'=>'is_desimal'));
		$moduleName = 'PO > List DO';
		$this->set('title_for_layout',  $this->lastSegment($moduleName));
		$this->set(compact('deliveryOrderStatuses', 'copyright_id', 'pos', 'po_id', 
				'delivery_order_status_id', 'date_end', 'date_start',
				'currencies', 'moduleName', 'currency'));

		if ($layout == 'pdf')
		{
			Configure::write('debug', 0); // Otherwise we cannot use this method while developing
			$this->layout = 'pdf'; //this will use the pdf.ctp layout
			$this->render('list_delivery_order_pdf');
		} else if ($layout == 'xls') {
			$this->render('list_delivery_order_xls', 'export_xls');
		}
	}

      function view($id = null) {
		Configure::write('debug', 1);
            if (!$id) {
                  $this->Session->setFlash(__('Invalid delivery order', true));
                  $this->redirect(array('action' => 'index', $this->Session->read('Po.id')));
            }
            $this->Session->write('DeliveryOrder.can_edit', false);
            $this->Session->write('DeliveryOrder.can_approve', false);
            $this->Session->write('DeliveryOrder.can_register_fa', false);
            $this->Session->write('DeliveryOrder.can_register_stock', false);

            $deliveryOrder = $this->DeliveryOrder->read(null, $id);
			
			$po_id	= $deliveryOrder['DeliveryOrder']['po_id'];
			$res	= $this->DeliveryOrder->query("select id, qty_received from po_details where po_id = '".$po_id."' ");
			$n = 0;
			foreach($res as $r){
				$deliveryOrder['PoDetail'][$n]['po_detail_id']	= $r[0]['id'];
				$deliveryOrder['PoDetail'][$n]['qty_received']	= $r[0]['qty_received'];
				$n++;
			}
			
            $group_id = $this->Session->read('Security.permissions');
            if ($group_id == gs_group_id) {
                $this->Session->write('DeliveryOrder.can_edit', $deliveryOrder['DeliveryOrder']['delivery_order_status_id'] == status_delivery_order_new_id);
            } else if ($group_id == po_approval1_group_id) {
                  $this->Session->write('DeliveryOrder.can_approve', $deliveryOrder['DeliveryOrder']['delivery_order_status_id'] == status_delivery_order_sent_to_supervisor_id);
            }

            if ($deliveryOrder['DeliveryOrder']['convert_asset'] == 0
                    && $deliveryOrder['DeliveryOrder']['delivery_order_status_id'] == status_delivery_order_done_id) {
                  if ($group_id == stock_management_group_id && $deliveryOrder['DeliveryOrder']['request_type_id'] == request_type_stock_id) {
                        $this->Session->write('DeliveryOrder.can_register_stock', true);
                  } elseif ($group_id == fa_management_group_id && ($deliveryOrder['DeliveryOrder']['request_type_id'] == request_type_fa_general_id)) {
                        $this->Session->write('DeliveryOrder.can_register_fa', true);
                  } elseif ($group_id == it_management_group_id && ($deliveryOrder['DeliveryOrder']['request_type_id'] == request_type_fa_it_id)) {
                        $this->Session->write('DeliveryOrder.can_register_fa', true);
                  }
            }
			
			$n = 0;
			foreach($deliveryOrder['DeliveryOrderDetail'] as $doDetail){
				$res = $this->DeliveryOrder->query('select item_id from po_details where id = '.$doDetail['po_detail_id']);
				$item_id = $res[0][0]['item_id'];
				$res = $this->DeliveryOrder->query('select unit_id from items where id = '.$item_id);
				$unit_id = $res[0][0]['unit_id'];
				$res = $this->DeliveryOrder->query('select name from units where id = '.$unit_id);
				$unit_name = $res[0][0]['name'];
				$deliveryOrder['DeliveryOrderDetail'][$n]['unit_name'] = $unit_name;
				if($deliveryOrder['DeliveryOrder']['request_type_id'] == request_type_point_reward_id){
					$res = $this->DeliveryOrder->query('select no, notes from npbs where id = '.$doDetail['npb_id']);
					if($res){
						$deliveryOrder['DeliveryOrderDetail'][$n]['npb_no'] = $res[0][0]['no'];
						$deliveryOrder['DeliveryOrderDetail'][$n]['npb_notes'] = $res[0][0]['notes'];
					}
					
				}				
				$res = $this->DeliveryOrder->query('select name from asset_categories where id = '.$doDetail['asset_category_id']);
				$deliveryOrder['DeliveryOrderDetail'][$n]['asset_category_name'] = (!empty($res)) ? $res[0][0]['name'] : '-';
				$n++;
			}
			
            $this->set('deliveryOrder', $deliveryOrder);
            //$this->set('assetCategories', $this->DeliveryOrder->DeliveryOrderDetail->AssetCategory->find('list'));
            $this->set('poDetail', $this->DeliveryOrder->Po->PoDetail->find('list', array('fields' => 'qty')));
      }
	  
	function print_pdf_detailed($id = null) {
		if (!$id) {
			  $this->Session->setFlash(__('Invalid DO', true));
			  $this->redirect(array('action' => 'index'));
		}
		
		Configure::write('debug', 0); // Otherwise we cannot use this method while developing
		
		$deliveryOrder = $this->DeliveryOrder->read(null, $id);
		
		if(isset($deliveryOrder['DeliveryOrderDetail'][0]['npb_id'])){
			$npbId = $deliveryOrder['DeliveryOrderDetail'][0]['npb_id'];
		}else{
			$npbId = '0';
		}
		if(isset($deliveryOrder['DeliveryOrderDetail'][0]['business_type_id'])){
			$bttId = $deliveryOrder['DeliveryOrderDetail'][0]['business_type_id'];
		}else{
			$bttId = '0';
		}
		if(isset($deliveryOrder['DeliveryOrderDetail'][0]['cost_center_id'])){
			$ccId = $deliveryOrder['DeliveryOrderDetail'][0]['cost_center_id'];
		}else{
			$ccId = '0';
		}
		if(isset($deliveryOrder['Department']['id'])){
			$dpId = $deliveryOrder['Department']['id'];
		}else if(isset($deliveryOrder['DeliveryOrderDetail'][0]['department_id'])){
			$dpId = $deliveryOrder['DeliveryOrderDetail'][0]['department_id'];
		}else{
			$dpId = 0;
		}
		
		$dataInputToOutlog['date'] = date('Y-m-d');
		$dataInputToOutlog['department_id'] = $dpId;
		$dataInputToOutlog['created_at'] = date('Y-m-d H:i:s');
		$dataInputToOutlog['created_by'] = $this->Session->read('Userinfo.username');
		$dataInputToOutlog['npb_id'] = $npbId;
		$dataInputToOutlog['is_process'] = '0';
		$dataInputToOutlog['is_printed'] = '0';
		$dataInputToOutlog['outlog_status_id'] = status_outlog_sent_to_supervisor_id;
		$dataInputToOutlog['business_type_id'] = $bttId;
		$dataInputToOutlog['cost_center_id'] = $ccId;
		$dataInputToOutlog['retur_id'] = '0';
		$dataInputToOutlog['po_id'] = $deliveryOrder['Po']['id'];
		
		$paramsArray = array('outlogData'=>$dataInputToOutlog, 'return'=>true);
		
		//echo '<pre>';
		//var_dump($dataInputToOutlog);
		//echo '</pre>';die();
		
		//$go = $this->requestAction('outlogs/addFromDO',array('outlogData'=>array($paramsArray)));
		
		unset($deliveryOrder);
		$deliveryOrder = $this->DeliveryOrder->Po->Npb->read(null, $npbId);
		$res	= $this->DeliveryOrder->query('select no, do_date, supplier_id, delivery_order_status_id from delivery_orders where id = '.$id);
		$do_no	= $res[0][0]['no'];
		$do_date= $res[0][0]['do_date'];
		$supplier_id 	= $res[0][0]['supplier_id'];
		$status 	= $res[0][0]['delivery_order_status_id'];
		
		$res	= $this->DeliveryOrder->query('select item_id, qty_received, npb_id from delivery_order_details where delivery_order_id = '.$id);
		$item_id 	= $res[0][0]['item_id'];
		$qty_received 	= $res[0][0]['qty_received'];
		$npbIdFromDO 	= $res[0][0]['npb_id'];
		$res	= $this->DeliveryOrder->query('select name from suppliers where id = '.$supplier_id);
		$supplier_name	= $res[0][0]['name'];
		$res	= $this->DeliveryOrder->query('select name from delivery_order_statuses where id = '.$status);
		$status_name	= $res[0][0]['name'];
		
		$deliveryOrder['DeliveryOrder']['no']				= $do_no;
		$deliveryOrder['DeliveryOrder']['do_date']			= $do_date;
		$deliveryOrder['DeliveryOrder']['supplier_name']	= $supplier_name;
		$deliveryOrder['DeliveryOrder']['status_name']		= $status_name;
		$deliveryOrder['DeliveryOrder']['item_id']			= $item_id;
		$deliveryOrder['DeliveryOrder']['qty_received']		= $qty_received;
		$deliveryOrder['DeliveryOrder']['npb_id']			= $npbIdFromDO;
		
		$n = 0;
		foreach($deliveryOrder['NpbDetail'] as $doDetail){
			$res = $this->DeliveryOrder->query('select unit_id from items where id = '.$doDetail['unit_id']);
			$unit_id 	= $res[0][0]['unit_id'];
			$res = $this->DeliveryOrder->query('select name from units where id = '.$unit_id);
			$unit_name 	= $res[0][0]['name'];
			$deliveryOrder['NpbDetail'][$n]['unit_name'] = $unit_name;
			
			$res = $this->DeliveryOrder->query('select qty_received from delivery_order_details where delivery_order_id = '.$id.' and item_id = '.$doDetail['item_id']);
			if($res){
				$qty_received 	= $res[0][0]['qty_received'];
				$deliveryOrder['NpbDetail'][$n]['qty_received'] = $qty_received;
			}else{
				$deliveryOrder['NpbDetail'][$n]['qty_received'] = 0;
			}			
			$n++;
		}
		
		$this->Session->write('DeliveryOrder.id', $id);
		$this->set('deliveryOrder', $deliveryOrder);
		$this->set('poDetail', $this->DeliveryOrder->Po->PoDetail->find('list', array('fields' => 'qty')));
		$copyright_id = $this->configs['copyright_id'];
		$this->set(compact('copyright_id'));
		$this->layout = 'pdf';
		$this->render();
    }

    function print_pdf($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid DO', true));
			$this->redirect(array('action' => 'index'));
		}

		Configure::write('debug', 0); // Otherwise we cannot use this method while developing
		$deliveryOrder = $this->DeliveryOrder->read(null, $id);
		
		//echo '<pre>';
		//var_dump($deliveryOrder);
		//echo '</pre>';die();
		
		if(isset($deliveryOrder['DeliveryOrderDetail'][0]['npb_id'])){
			$npbId = $deliveryOrder['DeliveryOrderDetail'][0]['npb_id'];
		}else{
			$npbId = '0';
		}
		if(isset($deliveryOrder['DeliveryOrderDetail'][0]['business_type_id'])){
			$bttId = $deliveryOrder['DeliveryOrderDetail'][0]['business_type_id'];
		}else{
			$bttId = '0';
		}
		if(isset($deliveryOrder['DeliveryOrderDetail'][0]['cost_center_id'])){
			$ccId = $deliveryOrder['DeliveryOrderDetail'][0]['cost_center_id'];
		}else{
			$ccId = '0';
		}
		if(isset($deliveryOrder['Department']['id'])){
			$dpId = $deliveryOrder['Department']['id'];
		}else if(isset($deliveryOrder['DeliveryOrderDetail'][0]['department_id'])){
			$dpId = $deliveryOrder['DeliveryOrderDetail'][0]['department_id'];
		}else{
			$dpId = 0;
		}
		
		$dataInputToOutlog['date'] 					= date('Y-m-d');
		$dataInputToOutlog['department_id'] 		= $dpId;
		$dataInputToOutlog['created_at'] 			= date('Y-m-d H:i:s');
		$dataInputToOutlog['created_by'] 			= $this->Session->read('Userinfo.username');
		$dataInputToOutlog['npb_id'] 				= $npbId;
		$dataInputToOutlog['is_process'] 			= '0';
		$dataInputToOutlog['is_printed'] 			= '0';
		$dataInputToOutlog['outlog_status_id'] 		= status_outlog_sent_to_supervisor_id;
		$dataInputToOutlog['business_type_id'] 		= $bttId;
		$dataInputToOutlog['cost_center_id'] 		= $ccId;
		$dataInputToOutlog['retur_id'] 				= '0';
		$dataInputToOutlog['po_id'] 				= $deliveryOrder['Po']['id'];
		
		$paramsArray = array('outlogData'=>$dataInputToOutlog, 'return'=>true);
		
		//$sql = 'select top(1)no from outlogs order by id desc';			
		//$res = $this->DeliveryOrder->query($sql);
		//$no  = trim(substr($res[0][0]['no'],4,6));
		//$lastNo = intval($no);
		
		//$newNo = $lastNo + 1;
		
		//$sql = 'select top(1)no from outlogs order by id desc';			
		//$res = $this->DeliveryOrder->query($sql);
	
		//$go = $this->requestAction('outlogs/addFromDO',array('outlogData'=>array($paramsArray))); //kenapa ada outlog disini ?????????????????
		//function ini membuat proses outlog berjalan padahal ini adalah controller untuk proses INLOG.
		//RENDIIIII!!!
		
		$n = 0;
		foreach($deliveryOrder['DeliveryOrderDetail'] as $doDetail){
			$res = $this->DeliveryOrder->query('select item_id from po_details where id = '.$doDetail['po_detail_id']);
			$item_id = $res[0][0]['item_id'];
			$res = $this->DeliveryOrder->query('select unit_id from items where id = '.$item_id);
			$unit_id = $res[0][0]['unit_id'];
			$res = $this->DeliveryOrder->query('select name from units where id = '.$unit_id);
			$unit_name = $res[0][0]['name'];
			$deliveryOrder['DeliveryOrderDetail'][$n]['unit_name'] = $unit_name;
			$res = $this->DeliveryOrder->query('select no, notes from npbs where id = '.$doDetail['npb_id']);
			$deliveryOrder['DeliveryOrderDetail'][$n]['npb_no'] = $res[0][0]['no'];
			$deliveryOrder['DeliveryOrderDetail'][$n]['npb_notes'] = $res[0][0]['notes'];
			$res = $this->DeliveryOrder->query('select name from asset_categories where id = '.$doDetail['asset_category_id']);
			$deliveryOrder['DeliveryOrderDetail'][$n]['asset_category_name'] = $res[0][0]['name'];
			$n++;
		}			
		
		//echo "<pre>";
		//var_dump($deliveryOrder);
		//echo "</pre>";die();
		
		$this->Session->write('DeliveryOrder.id', $id);
		$this->set('deliveryOrder', $deliveryOrder);
		//$this->set('assetCategories', $this->DeliveryOrder->DeliveryOrderDetail->AssetCategory->find('list'));
		$this->set('poDetail', $this->DeliveryOrder->Po->PoDetail->find('list', array('fields' => 'qty')));
		$copyright_id = $this->configs['copyright_id'];
		$this->set(compact('copyright_id'));
		$this->layout = 'pdf'; //this will use the pdf.ctp layout
		$this->render();
		//$this->redirect(array('controller'=>'Outlogs','action'=>'addFromDO',$dataInputToOutlog));
    }

    function ajax_view($id=null) {
        $this->layout = 'ajax';
		$this->autoRender = false;
		$deliveryOrder = $this->DeliveryOrder->read(null, $id);
		echo json_encode(array('data' => $deliveryOrder));
    }

	function add($po_id=null) {
		if (!empty($this->data)) {
			$po_id = $this->data['DeliveryOrder']['po_id'];

			//update status existing DO to done
			//$sql='update delivery_orders set delivery_order_status_id="'.status_delivery_order_done_id.'" where po_id="'.$po_id.'"';
			//$this->DeliveryOrder->query($sql);

			$po = $this->DeliveryOrder->Po->read(null, $po_id);
			$this->DeliveryOrder->create();
			
			if ($this->DeliveryOrder->save($this->data)) {
				$delivery_order_id = $this->DeliveryOrder->id;
				//save details from PoDetail
				foreach ($po['PoDetail'] as $poDetail) {
					$Total_Receive = $this->DeliveryOrder->DeliveryOrderDetail->find('first', array('fields' => array('SUM(DeliveryOrderDetail.qty_received) as qty_received'),
								'conditions' => array('DeliveryOrderDetail.po_id' => $po_id, 'DeliveryOrderDetail.po_detail_id' => $poDetail['id'])));
					//debug ($Total_Receive);

					$doDetail['DeliveryOrderDetail'] = $poDetail;
					unset($doDetail['DeliveryOrderDetail']['id']);
					$doDetail['DeliveryOrderDetail']['po_detail_id'] 	= $poDetail['id'];
					$doDetail['DeliveryOrderDetail']['qty'] 			= $poDetail['qty'];// - $Total_Receive[0]['qty_received'];
					$doDetail['DeliveryOrderDetail']['qty_received'] 	= 0;

					//discount here is per unit
					$doDetail['DeliveryOrderDetail']['discount_unit_cur'] = $poDetail['discount_cur'] / $poDetail['qty'];

					$doDetail['DeliveryOrderDetail']['amount'] = 0;
					$doDetail['DeliveryOrderDetail']['amount_cur'] = 0;
					$doDetail['DeliveryOrderDetail']['discount'] = 0;
					$doDetail['DeliveryOrderDetail']['discount_cur'] = 0;
					$doDetail['DeliveryOrderDetail']['amount_after_disc'] = 0;
					$doDetail['DeliveryOrderDetail']['amount_after_disc_cur'] = 0;
					$doDetail['DeliveryOrderDetail']['vat'] = 0;
					$doDetail['DeliveryOrderDetail']['vat_cur'] = 0;
					$doDetail['DeliveryOrderDetail']['amount_nett'] = 0;
					$doDetail['DeliveryOrderDetail']['amount_nett_cur'] = 0;

					//$doDetail['DeliveryOrderDetail']['name'] = $poDetail['name'];
					$doDetail['DeliveryOrderDetail']['delivery_order_id'] = $delivery_order_id;
					$this->DeliveryOrder->DeliveryOrderDetail->create();
					$this->DeliveryOrder->DeliveryOrderDetail->save($doDetail);
					$reqTypeId	= $this->data['DeliveryOrder']['request_type_id'];
					if($reqTypeId == request_type_point_reward_id){
						$delivery_order_detail_id 	= $this->DeliveryOrder->DeliveryOrderDetail->id;
						$delivery_order_no			= $this->data['DeliveryOrder']['no'];
						$res	= $this->DeliveryOrder->query('select source_npb_detail_id from npbs_point_rewards where po_id = '.$poDetail['po_id']);
						foreach($res as $data){
							$find	= $this->DeliveryOrder->query('select qty from npb_details where id = '.$data[0]['source_npb_detail_id']);
							$qty			= $find[0][0]['qty'];
							$qty_filled		= $find[0][0]['qty'];
							$qty_unfilled	= $qty - $qty_filled;
							$this->DeliveryOrder->query("update npb_details set qty_filled = '".$qty_filled."', qty_unfilled = '".$qty_unfilled."' where id = '".$data[0]['source_npb_detail_id']."' ");
							$this->DeliveryOrder->query("update npbs_point_rewards set do_id = '".$delivery_order_id."', do_detail_id = '".$delivery_order_detail_id."', do_no = '".$delivery_order_no."', do_qty_received = '".$qty_filled."' where source_npb_detail_id = '".$data[0]['source_npb_detail_id']."' ");
						}

					};							  
				}
				$this->Session->setFlash(__('The delivery order has been saved', true), 'default', array('class' => 'ok'));
				$this->redirect(array('action' => 'view', $delivery_order_id));
			} else {
				$this->Session->setFlash(__('The delivery order could not be saved. Please, try again.', true));
			  }
		}

		//apakah ini do yang pertama?
		$do_count = $this->DeliveryOrder->find('count', array('conditions' => array('po_id' => $po_id)));
		$is_first = $do_count == 0 ? 1 : 0;

		$po = $this->DeliveryOrder->Po->read(null, $po_id);
		
		$po_no = $po['Po']['no'];
		$supplier_id = $po['Po']['supplier_id'];
		$request_type_id = $po['Po']['request_type_id'];
		$department_id = $po['Po']['department_id'];
		$currency_id = $po['Po']['currency_id'];
		$supplier_name = $po['Supplier']['name'];
		$department_name = $po['Department']['name'];
		$deliveryOrderStatuses = $this->DeliveryOrder->DeliveryOrderStatus->find('list');
		$this->set(compact('currency_id', 'po_no', 'po_id', 'request_type_id', 'supplier_id', 'supplier_name', 'department_id', 'department_name', 'is_first', 'deliveryOrderStatuses'));
	}
		
		function addForPO($po_id=null) {
			$this->Session->write('DeliveryOrder.can_add', true);
			
			$po = $this->DeliveryOrder->Po->read(null, $po_id);
			$res = $this->DeliveryOrder->query('select * from npbs_point_rewards where po_id = '.$po_id);
			
			//echo '<pre>';
			//var_dump($res);
			//echo '</pre>';die();
			
			$items = array();
			$cons = array();
			$deliveryOrders = $this->DeliveryOrder->find('list');
			
			foreach($res as $data){
			
				$cons[] = array("NpbDetail.item_id = '{$data[0]['item_id']}' 
									and NpbDetail.po_id = '{$data[0]['po_id']}'									
									");
				$item[] 	= $this->DeliveryOrder->Po->NpbDetail->find('all', array('conditions'=>$cons));
			}
			
			foreach($item[0] as $data){
				$items[]	= $data;
			}
			
			//echo '<pre>';
			//var_dump($res);	
			//echo '</pre>';die();
			
			$found	= $this->DeliveryOrder->query('select count(*) as total from delivery_orders where po_id = '.$po_id);
			$is_first = $found[0][0]['total'];
			$po_no = $po['Po']['no'];
            $supplier_id = $po['Po']['supplier_id'];
            $request_type_id = $po['Po']['request_type_id'];
            $department_id = $po['Po']['department_id'];
            $currency_id = $po['Po']['currency_id'];
            $supplier_name = $po['Supplier']['name'];
            $department_name = $po['Department']['name'];
			$this->set(compact('currency_id', 'po_no', 'po_id', 'request_type_id', 'supplier_id', 'supplier_name', 'department_id', 'department_name', 'items', 'doData', 'res','is_first'));
		}
		
		function ajax_add() {
            $this->DeliveryOrder->recursive = 0;
            $this->autoRender = false;
            $msg = '';
			//echo '<pre>';
			//var_dump($this->data);
			//echo '</pre>';die();
            if (!empty($this->data)) {
				$po_id 	= $this->data['DeliveryOrder']['po_id'];
				$npb_id = $this->data['DeliveryOrder']['npb_id'];
				$npb_detail_id = $this->data['DeliveryOrder']['npb_detail_id'];
				$item_id = $this->data['DeliveryOrder']['item_id'];
				
				$qty = $this->data['DeliveryOrder']['qty'];
				$qty_receive 	= $this->data['DeliveryOrder']['qty_receive'];
				
				if($this->data['DeliveryOrder']['do_no'] && $qty_receive){
					if($qty_receive > $qty){
						$this->Session->setFlash(__('The delivery order could not be saved. Please, check the qty received.', true));
						$this->redirect(array('action' => 'addForPO', $po_id));
					}else{
						//create main delivery order
						$delivery_order_id = $this->addDOForPR($po_id, $npb_id, $npb_detail_id);
						if($delivery_order_id){
							//create delivery order detail					
							$npb			= $this->DeliveryOrder->Po->Npb->read(null, $npb_id);
							$po				= $this->DeliveryOrder->Po->read(null, $po_id);
							$res			= $this->DeliveryOrder->query('select * from npbs_point_rewards where po_id = '.$po_id.' and source_npb_id = '.$npb_id.' and source_npb_detail_id = '.$npb_detail_id);
							
							foreach($po['PoDetail'] as $detail){
								$poDetailId 	= $detail['id'];
							}
							 
							//price from items					
							$res = $this->DeliveryOrder->query("select * from items where code = '".$this->data['DeliveryOrder']['item_code']."' ");
							//echo '<pre>';
							//var_dump($item);
							//echo '</pre>';die();
							$doDetailData['DeliveryOrderDetail']['delivery_order_id'] 		= $delivery_order_id;
							$doDetailData['DeliveryOrderDetail']['po_id'] 					= $po_id;
							$doDetailData['DeliveryOrderDetail']['po_detail_id'] 			= $poDetailId;
							$doDetailData['DeliveryOrderDetail']['asset_category_id'] 		= $res[0][0]['asset_category_id'];
							$doDetailData['DeliveryOrderDetail']['item_code'] 				= $this->data['DeliveryOrder']['item_code'];
							$doDetailData['DeliveryOrderDetail']['name'] 					= $res[0][0]['name'];
							$doDetailData['DeliveryOrderDetail']['color'] 					= '-';
							$doDetailData['DeliveryOrderDetail']['brand'] 					= '-';
							$doDetailData['DeliveryOrderDetail']['type'] 					= '-';
							$doDetailData['DeliveryOrderDetail']['qty'] 					= $this->data['DeliveryOrder']['qty'];
							$doDetailData['DeliveryOrderDetail']['qty_received'] 			= $qty_receive;
							if($res[0][0]['price'] == 0){
								$price = $res[0][0]['avg_price'];
							}
							$doDetailData['DeliveryOrderDetail']['price'] 					= $price;
							$doDetailData['DeliveryOrderDetail']['price_cur'] 				= $res[0][0]['avg_price'];
							$doDetailData['DeliveryOrderDetail']['amount'] 					= $price * $qty_receive;
							$doDetailData['DeliveryOrderDetail']['amount_cur'] 				= $res[0][0]['avg_price'] * $qty_receive;
							$doDetailData['DeliveryOrderDetail']['discount'] 				= 0;
							$doDetailData['DeliveryOrderDetail']['discount_cur'] 			= 0;
							$doDetailData['DeliveryOrderDetail']['amount_after_disc'] 		= $price * $qty_receive;
							$doDetailData['DeliveryOrderDetail']['amount_after_disc_cur']	= $res[0][0]['avg_price'] * $qty_receive;
							$doDetailData['DeliveryOrderDetail']['vat'] 					= 0;
							$doDetailData['DeliveryOrderDetail']['vat_cur'] 				= 0;
							$doDetailData['DeliveryOrderDetail']['amount_nett'] 			= $price * $qty_receive;
							$doDetailData['DeliveryOrderDetail']['amount_nett_cur'] 		= $res[0][0]['avg_price'] * $qty_receive;
							$doDetailData['DeliveryOrderDetail']['currency_id'] 			= 1;
							$doDetailData['DeliveryOrderDetail']['rp_rate'] 				= 1.00;
							$doDetailData['DeliveryOrderDetail']['npb_id'] 					= $npb_id;
							$doDetailData['DeliveryOrderDetail']['umurek'] 					= 0;
							$doDetailData['DeliveryOrderDetail']['is_vat'] 					= 0;
							$doDetailData['DeliveryOrderDetail']['is_wht'] 					= 0;
							$doDetailData['DeliveryOrderDetail']['department_id'] 			= $npb['Npb']['department_id'];
							$doDetailData['DeliveryOrderDetail']['department_sub_id'] 		= '0';
							$doDetailData['DeliveryOrderDetail']['department_unit_id'] 		= '0';
							$doDetailData['DeliveryOrderDetail']['business_type_id'] 		= $npb['Npb']['business_type_id'];
							$doDetailData['DeliveryOrderDetail']['cost_center_id'] 			= $npb['Npb']['cost_center_id'];
							$doDetailData['DeliveryOrderDetail']['item_id'] 				= $res[0][0]['id'];
							$doDetailData['DeliveryOrderDetail']['discount_unit_cur'] 		= '0';
							$doDetailData['DeliveryOrderDetail']['qty_outstanding'] 		= null;
							
							if ($this->DeliveryOrder->DeliveryOrderDetail->save($doDetailData)) {
								$delivery_order_detail_id = $this->DeliveryOrder->DeliveryOrderDetail->id;
								//echo $npb_id;
								//echo '-';
								//echo $npb_detail_id;
								$this->DeliveryOrder->query('update npbs_point_rewards set do_id = '.$delivery_order_id.', do_detail_id = '.$delivery_order_detail_id.', po_id = '.$po_id.', do_no = "'.$this->data['DeliveryOrder']['do_no'].'", do_qty_received = '.$qty_receive.' where source_npb_id = '.$npb_id.' and source_npb_detail_id = '.$npb_detail_id.' and item_id = '.$item_id);
								$this->DeliveryOrder->query('update npbs_point_rewards set do_id = '.$delivery_order_id.', do_detail_id = '.$delivery_order_detail_id.', do_no = "'.$this->data['DeliveryOrder']['do_no'].'" where source_npb_id = '.$npb_id);
								$qty_unfilled = $qty - $qty_receive;
								$this->DeliveryOrder->query('update npb_details set qty_filled = '.$qty_receive.', qty_unfilled =  '.$qty_receive.' where id = '.$npb_detail_id);
								$status = 'ok';
								$this->Session->setFlash(__('The delivery order has been saved', true), 'default', array('class' => 'ok'));
								$this->redirect(array('action' => 'addForPO', $po_id));
							} else {
								$status = 'failed';
								$count = 0;
								$this->Session->setFlash(__('The delivery order could not be saved. Please, check the qty received.', true));
								$this->redirect(array('action' => 'addForPO', $po_id));
							}//end if successful save
						}//end if check delivery order id is set
					}//end if check qty			

				}else{
					$this->Session->setFlash(__('The delivery order could not be saved. Please, check the detail.', true));
					$this->redirect(array('action' => 'addForPO', $po_id));
				}
            }//end if $this->data check
            //echo json_encode(array('status' => $status, 'msg' => $msg, 'data' => $deliveryOrderDetail, 'count' => $count));
		}
		
		function ajax_update() {
            $this->DeliveryOrder->recursive = 0;
            $this->autoRender = false;
            $msg = '';
			//echo '<pre>';
			//var_dump($this->data);
			//echo '</pre>';die();
            if (!empty($this->data)) {
				$delivery_order_id 	= $this->data['DeliveryOrder']['do_id'];
				$po_id 	= $this->data['DeliveryOrder']['po_id'];
				$npb_id = $this->data['DeliveryOrder']['npb_id'];
				$npb_detail_id = $this->data['DeliveryOrder']['npb_detail_id'];
				$item_id = $this->data['DeliveryOrder']['item_id'];
				
				$qty = $this->data['DeliveryOrder']['qty'];
				$qty_receive 	= $this->data['DeliveryOrder']['qty_receive'];
				
				if($this->data['DeliveryOrder']['do_no'] && $qty_receive){
					if($qty_receive > $qty){
						$this->Session->setFlash(__('The delivery order could not be saved. Please, check the qty received.', true));
						$this->redirect(array('action' => 'addForPO', $po_id));
					}else{
						$sql = "update delivery_order_details set qty_received = '".$qty_receive."' where delivery_order_id = '".$delivery_order_id."' and item_id = '".$item_id."' ";
						if ($this->DeliveryOrder->query($sql)) {
							//update relations
							$this->DeliveryOrder->query('update npbs_point_rewards set do_qty_received = '.$qty_receive.' where source_npb_id = '.$npb_id.' and source_npb_detail_id = '.$npb_detail_id);
							//update source npbs
							$qty_unfilled = $qty - $qty_receive;
							$this->DeliveryOrder->query('update npb_details set qty_filled = '.$qty_receive.', qty_unfilled = '.$qty_unfilled.' where npb_id = '.$npb_id.' and id = '.$npb_detail_id);
							//update compiled npbs
							$res 	= $this->DeliveryOrder->query('select compiled_npb_detail_id from npbs_point_rewards where source_npb_id = '.$npb_id.' and source_npb_detail_id = '.$npb_detail_id);
							$compiled_npb_detail_id = $res[0][0]['compiled_npb_detail_id'];
							$res	= $this->DeliveryOrder->query('select qty_received from po_details where po_id = '.$po_id);
							$qty_received = $res[0][0]['qty_received'];
							$qty_received = $qty_received + $qty_receive;
							$this->DeliveryOrder->query('update po_details set qty_received = '.$qty_received.' where po_id = '.$po_id);
							$status = 'ok';
							$this->Session->setFlash(__('The delivery order has been saved', true), 'default', array('class' => 'ok'));
							$this->redirect(array('action' => 'addForPO', $po_id));
						} else {
							$status = 'failed';
							$count = 0;
							$this->Session->setFlash(__('The delivery order could not be saved. Please, check the qty received.', true));
							$this->redirect(array('action' => 'addForPO', $po_id));
						}//end if successful save
					}//end if check qty						

				}else{
					$this->Session->setFlash(__('The delivery order could not be saved. Please, check the detail.', true));
					$this->redirect(array('action' => 'addForPO', $po_id));
				}
            }//end if $this->data check
            //echo json_encode(array('status' => $status, 'msg' => $msg, 'data' => $deliveryOrderDetail, 'count' => $count));
		}
		
		function addDOForPR($po_id=null, $npb_id=null, $npb_detail_id=null){
			if($po_id && $npb_id && $npb_detail_id){
				$po = $this->DeliveryOrder->Po->read(null, $po_id);
                $res	= $this->DeliveryOrder->query('select * from npb_details where id = '.$npb_detail_id);
				$amount = $res[0][0]['amount'];
				$discount	= $res[0][0]['discount'];
				
				$this->DeliveryOrder->create();
				$doData['DeliveryOrder']['po_id']						= $po_id;
				$doData['DeliveryOrder']['no']							= $this->data['DeliveryOrder']['do_no'];
				$doData['DeliveryOrder']['do_date']						= date('Y-m-d');
				$doData['DeliveryOrder']['delivery_date']				= null;
				$doData['DeliveryOrder']['supplier_id']					= $po['Po']['supplier_id'];
				$doData['DeliveryOrder']['department_id']				= null;
				$doData['DeliveryOrder']['delivery_order_status_id']	= status_delivery_order_sent_to_supervisor_id;
				$doData['DeliveryOrder']['currency_id']					= 1;
				$doData['DeliveryOrder']['description']					= null;
				$doData['DeliveryOrder']['convert_invoice']				= 0;
				$doData['DeliveryOrder']['created']						= date('Y-m-d H:i:s');
				$doData['DeliveryOrder']['approval_info']				= null;
				$doData['DeliveryOrder']['wht_rate']					= $po['Po']['wht_rate'];
				$doData['DeliveryOrder']['vat_rate']					= $po['Po']['vat_rate'];
				$doData['DeliveryOrder']['vat_base']					= $res[0][0]['amount'];
				$doData['DeliveryOrder']['vat_base_cur']				= $res[0][0]['amount_cur'];
				$doData['DeliveryOrder']['wht_base']					= $po['Po']['wht_base'];
				$doData['DeliveryOrder']['wht_base_cur']				= $po['Po']['wht_base_cur'];
				$doData['DeliveryOrder']['sub_total']					= $res[0][0]['amount'];
				$doData['DeliveryOrder']['sub_total_cur']				= $res[0][0]['amount_cur'];
				$doData['DeliveryOrder']['discount']					= $res[0][0]['discount'];
				$doData['DeliveryOrder']['discount_cur']				= $res[0][0]['discount_cur'];
				$doData['DeliveryOrder']['after_disc']					= $amount - $discount;
				$doData['DeliveryOrder']['after_disc_cur']				= $amount - $discount;
				$doData['DeliveryOrder']['wht_total']					= $po['Po']['wht_total'];
				$doData['DeliveryOrder']['wht_total_cur']				= $po['Po']['wht_total_cur'];
				$doData['DeliveryOrder']['vat_total']					= $po['Po']['vat_total'];
				$doData['DeliveryOrder']['vat_total_cur']				= $po['Po']['vat_total_cur'];
				$doData['DeliveryOrder']['total']						= $res[0][0]['amount'];
				$doData['DeliveryOrder']['total_cur']					= $res[0][0]['amount_cur'];
				$doData['DeliveryOrder']['billing_address']				= null;
				$doData['DeliveryOrder']['shipping_address']			= null;
				$doData['DeliveryOrder']['rp_rate']						= 1.00;
				$doData['DeliveryOrder']['request_type_id']				= request_type_point_reward_id;
				$doData['DeliveryOrder']['convert_asset']				= 1;
				$doData['DeliveryOrder']['is_journal_generated']		= 0;
				$doData['DeliveryOrder']['journal_generated_date']		= null;
				$doData['DeliveryOrder']['is_first']					= 1;
				$doData['DeliveryOrder']['approved_by']					= null;
				$doData['DeliveryOrder']['approved_date']				= null;
				$doData['DeliveryOrder']['cancel_by']					= null;
				$doData['DeliveryOrder']['cancel_date']					= null;
				$doData['DeliveryOrder']['cancel_note']					= null;
				
				if ($this->DeliveryOrder->save($doData)) {
					$delivery_order_id = $result = $this->DeliveryOrder->id;				
				} else {
					$result = null;
				}
				return $result;
			}				
		}

      function update_status($id = null, $new_status_id=null) {
            if (!$id) {
                  $this->Session->setFlash(__('Invalid id for delivery order', true));
                  $this->redirect(array('action' => 'index', $this->Session->read('Po.id')));
            }

            $this->DeliveryOrder->id = $id;
            $do = $this->DeliveryOrder->read(null, $id);
            $po_id = $do['DeliveryOrder']['po_id'];
			
			//sum(qty_received) where $id=do
			if (DRIVER=='mysql') {
				$sql 			= $this->DeliveryOrder->query('select sum(qty_received) from delivery_order_details where delivery_order_id = "'.$id.'"');
				$qty_received 	= $sql[0][0]['sum(qty_received)'];
			} elseif (DRIVER=='mssql') {
				$sql 			= $this->DeliveryOrder->query('select sum(qty_received) from delivery_order_details where delivery_order_id = "'.$id.'"');
				$qty_received 	= $sql[0][0]['computed'];
			}
			
			if ($qty_received >= 1) {
			
				$this->DeliveryOrder->set('delivery_order_status_id', $new_status_id);

				if ($this->DeliveryOrder->save()) {
					  $this->Session->setFlash(__('The delivery order has been saved', true), 'default', array('class' => 'ok'));
					  $this->redirect(array('action' => 'index', $po_id));
				} else {
					  $this->Session->setFlash(__('The delivery order could not be saved. Please, try again.', true));
					  $this->redirect(array('action' => 'index', $po_id));
				}
			} else {
				$this->Session->setFlash(__('The delivery order could not be saved. Please, cek your quantity received.', true));
				$this->redirect(array('action' => 'view', $id));
			}
      }

		function approved($id = null, $level = null) {
            if (!$id) {
                  $this->Session->setFlash(__('Invalid id for delivery order', true));
                  $this->redirect(array('action' => 'index', $this->Session->read('Po.id')));
            }
            $do = $this->DeliveryOrder->read(null, $id);
            $po_id = $do['DeliveryOrder']['po_id'];
			
			foreach($do['DeliveryOrderDetail'] as $detail){
				$qty			= $detail['qty'];
				$qty_received	= $detail['qty_received'];
				
				$qty_outstanding	= $qty - $qty_received;
				$do_detail_id		= $detail['id'];
				
				if($qty < $qty_received){
					$this->DeliveryOrder->query("update delivery_order_details set qty_received = '".$qty."' where id = '".$do_detail_id."' ");								
				}
				
				$this->DeliveryOrder->query("update delivery_order_details set qty_outstanding = '".$qty_outstanding."' where id = '".$do_detail_id."' ");
			}
			
			$this->data['DeliveryOrder']['delivery_order_status_id'] = status_delivery_order_done_id;
			
			if($do['DeliveryOrder']['request_type_id'] == request_type_service_id || $do['DeliveryOrder']['request_type_id'] == request_type_stock_id || $do['DeliveryOrder']['request_type_id'] == request_type_point_reward_id){
				$this->data['DeliveryOrder']['convert_asset'] = 1;
			}else{
				$this->data['DeliveryOrder']['convert_asset'] = 0;
			}
			$this->data['DeliveryOrder']['id'] = $id;

            $this->data['DeliveryOrder']['approved_date'] = date('Y-m-d H:i:s');
            $this->data['DeliveryOrder']['approved_by'] = $this->Session->read('Userinfo.username');
			
			$reqType = $do['DeliveryOrder']['request_type_id'];
			
			if ($this->DeliveryOrder->save($this->data)) {
				if($reqType == request_type_stock_id){
				
					App::import('Controller','InventoryLedgers');
					App::import('Model','InventoryLedger');
					App::import('Model','Inlog');
					App::import('Model','InlogDetail');
					
					$inLed 				= new InventoryLedgersController;			
					$InventoryLedger 	= new InventoryLedger;	
					$inlog 				= new Inlog;			
					$inlogDetail 		= new InlogDetail;		
					
					foreach($do['DeliveryOrderDetail'] as $dd){
						$this->data = $this->DeliveryOrder->DeliveryOrderDetail->read(null, $dd['id']);
						$this->DeliveryOrder->DeliveryOrderDetail->update_po_detail_qty(true);
						if(!empty($this->data['DeliveryOrder']['department_id'])){
							$dep_id = $this->data['DeliveryOrder']['department_id'];
						}else{
							$dep_id = $dd['department_id'];
							$this->data['DeliveryOrder']['department_id'] = $dd['department_id'];
						}
					}				
					/* NEW CODE BY RENDI - AUTOMATIC INLOG AFTER DO APPROVED */
					$res = $inlog->find('all', array('fields'=>'no', 'limit'=>1, 'order'=>'Inlog.no desc') );;
					$next =  $res[0]['Inlog']['no'];
					list($prefix, $no) = explode('-',$next);
					$next = 'IN-' . sprintf("%04s",$no+1);
					
					$paramInlogs = array();
					$paramInlogs['no'] 					= $next;
					$paramInlogs['date'] 				= date('Y-m-d');
					$paramInlogs['supplier_id'] 		= $this->data['DeliveryOrder']['supplier_id'];
					$paramInlogs['po_id'] 				= $this->data['DeliveryOrder']['po_id'];
					$paramInlogs['created_at'] 			= date('Y-m-d');
					$paramInlogs['created_by'] 			= $this->Session->read('Userinfo.username');
					$paramInlogs['invoice_id'] 			= 0;
					$paramInlogs['delivery_order_id'] 	= $id;
					$paramInlogs['inlog_status_id'] 	= status_inlog_finish_id;
					$paramInlogs['approved_by'] 		= $this->Session->read('Userinfo.username');
					$paramInlogs['approved_date'] 		= date('Y-m-d');
					$paramInlogs['cancel_notes'] 		= null;
					$paramInlogs['cancel_by'] 			= null;
					$paramInlogs['cancel_date'] 		= null;
					$paramInlogs['department_id'] 		= $dep_id;
					$paramInlogs['business_type_id'] 	= $dd['business_type_id'];
					$paramInlogs['cost_center_id'] 		= $dd['cost_center_id'];
					
					$inlog->create();
					$inlog->save($paramInlogs);
					$res = $this->DeliveryOrder->query('select top(1) id from inlogs order by id desc');
					$inlogId = $res[0][0]['id'];
					
					//echo '<pre>';
					//var_dump($dep_id);
					//echo '</pre>';die();
					foreach ($do['DeliveryOrderDetail'] as $dd) {
						$paramInlogDetails = array();
						$paramInlogDetails['inlog_id'] 	= $inlogId;
						$paramInlogDetails['item_id'] 	= $dd['item_id'];
						$paramInlogDetails['qty'] 		= $dd['qty_received'];
						$paramInlogDetails['price'] 	= $dd['price'];
						$paramInlogDetails['amount'] 	= $dd['amount'];
						$paramInlogDetails['posting'] 	= 1;
						$paramInlogDetails['npb_id'] 	= $dd['npb_id'];
						$paramInlogDetails['can_ledger']= 0;
						
						$inlogDetail->create();
						$inlogDetail->save($paramInlogDetails);
						$res = $this->DeliveryOrder->query('select id from inlog_details where inlog_id = '.$inlogId.' and item_id = '.$dd['item_id']);
						$inlogDetailId = $res[0][0]['id'];
						
						//$inLed->getNewAverage($paramInlogDetails['item_id'], $paramInlogDetails['qty'], $paramInlogDetails['price']);						
						//$InventoryLedger->getNewAverage($paramInlogDetails['item_id'], $paramInlogDetails['qty'], $paramInlogDetails['price']);						
												
						$paramLedger = array();
						$paramLedger['date'] = date('Y-m-d');
						$paramLedger['item_id'] = $dd['item_id'];
						$paramLedger['qty'] = $dd['qty_received'];
						$paramLedger['in_out'] = 'inlog';
						$paramLedger['price'] = $dd['price'];
						$paramLedger['amount'] = $dd['price'] * $dd['qty_received'];
						$paramLedger['doc_id'] = 0;
						$paramLedger['po_id'] = $dd['po_id'];
						$paramLedger['inlog_id'] = $inlogId;
						$paramLedger['outlog_id'] = 0;
						$paramLedger['retur_id'] = 0;
						$paramLedger['supplier_retur_id'] = 0;
						$paramLedger['supplier_retur_detail_id'] = 0;
						$paramLedger['retur_detail_id'] = 0;
						$paramLedger['inlog_detail_id'] = $inlogDetailId;
						$paramLedger['outlog_detail_id'] = 0;
						$paramLedger['supplier_replace_id'] = 0;
						$paramLedger['supplier_replace_detail_id'] = 0;
						$paramLedger['department_id'] = $dep_id;
						$paramLedger['business_type_id'] = $dd['business_type_id'];
						$paramLedger['cost_center_id'] = $dd['cost_center_id'];
						$paramLedger['date_of_transaction'] = date('Y-m-d');
						$paramLedger['npb_id'] = $dd['npb_id'];
						
						$amount = $dd['price'] * $dd['qty_received'];
						
						$InventoryLedger->create();
						$InventoryLedger->save($paramLedger);						
						
						//$inLed->generateCsv($journal);
						
						/* END OF NEW CODE BY RENDI - AUTOMATIC INLOG AFTER DO APPROVED */
							
					}
					$journal = $InventoryLedger->insert_to_journal('inlog', $inlogId, journal_group_inlog_id);
				//}else if($reqType == 5){
					
				}
                $this->Session->setFlash(__('The delivery order has been approved', true), 'default', array('class' => 'ok'));
                $this->redirect(array('action' => 'index', $po_id));
            } else {
                $this->Session->setFlash(__('The delivery order could not be approved. Please, try again.', true));
                $this->redirect(array('action' => 'index', $po_id));
            }
		}	

      function edit($id = null) {
            if (!$id && empty($this->data)) {
                  $this->Session->setFlash(__('Invalid delivery order', true));
                  $this->redirect(array('action' => 'index', $this->Session->read('Po.id')));
            }
            if (!empty($this->data)) {
                  if ($this->DeliveryOrder->save($this->data)) {
                        $this->Session->setFlash(__('The delivery order has been saved', true), 'default', array('class' => 'ok'));
                        $this->redirect(array('action' => 'index', $this->Session->read('Po.id')));
                  } else {
                        $this->Session->setFlash(__('The delivery order could not be saved. Please, try again.', true));
                  }
            }
            if (empty($this->data)) {
                  $this->data = $this->DeliveryOrder->read(null, $id);
            }
            $pos = $this->DeliveryOrder->Po->find('list');
            $suppliers = $this->DeliveryOrder->Supplier->find('list');
            $departments = $this->DeliveryOrder->Department->find('list');
            $requestTypes = $this->DeliveryOrder->RequestType->find('list');
            $deliveryOrderStatuses = $this->DeliveryOrder->DeliveryOrderStatus->find('list');
            $currencies = $this->DeliveryOrder->Currency->find('list');
            $this->set(compact('pos', 'suppliers', 'departments', 'deliveryOrderStatuses', 'currencies', 'requestTypes'));
      }

    function delete($id = null) {
		if (!$id) {
			  $this->Session->setFlash(__('Invalid id for delivery order', true));
			  $this->redirect(array('action' => 'index', $this->Session->read('Po.id')));
		}
		$do 		= $this->DeliveryOrder->read(null, $id);
		$po_id 		= $do['DeliveryOrder']['po_id'];
		$po 		= $this->DeliveryOrder->Po->read(null, $po_id);
		
		if ($this->DeliveryOrder->delete($id)) {
/* 			foreach($po['PoDetail'] as $poDetail){
				$qty = $poDetail['qty'];
				$detail = $this->DeliveryOrder->query('select * from delivery_order_details where delivery_order_details.po_detail_id = "'.$poDetail['id'].'" and delivery_order_details.po_id ="'.$poDetail['po_id'].'"');
				$qty_received = 0;	
					foreach($detail[0] as $dos){
						$data['DeliveryOrderDetail']['id']	= $dos['id'];
						$data['DeliveryOrderDetail']['qty'] = $qty;
						$data['DeliveryOrderDetail']['qty_outstanding'] = $data['DeliveryOrderDetail']['qty'] - $dos['qty_received'];
						$this->DeliveryOrder->DeliveryOrderDetail->save($data);
						$qty = $data['DeliveryOrderDetail']['qty_outstanding'];
					}
			}	
 */				
			$this->Session->setFlash(__('Delivery order deleted', true), 'default', array('class' => 'ok'));
			$this->redirect(array('action'=>'index', $po_id));
		}
		$this->Session->setFlash(__('Delivery order was not deleted', true));
		$this->redirect(array('action'=>'index', $this->Session->read('Po.id')));
    }
	  
	function cancel($id=null){
		//view DeliveryOrder
		if (!$id) {
			$this->Session->setFlash(__('Invalid Delivery Order', true));
			$this->redirect(array('action' => 'index'));
		}
		$deliveryOrder = $this->DeliveryOrder->read(null, $id);
		$po_id = $deliveryOrder['DeliveryOrder']['po_id'];
		
		//Add Notes cancel DeliveryOrder and Change Status
		if (!empty($this->data)) {
			$this->data['DeliveryOrder']['id'] = $id;
			$this->data['DeliveryOrder']['delivery_order_status_id'] = status_delivery_order_new_id;
			if ($this->DeliveryOrder->save($this->data)) {
				$this->Session->setFlash(__('The Delivery Order has been saved', true), 'default', array('class'=>'ok'));
                 $this->redirect(array('action'=>'index', $po_id));
			} else {
				$this->Session->setFlash(__('The Delivery Order could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$deliveryOrder = $this->data = $this->DeliveryOrder->read(null, $id);
		}
		$assetCategories = $this->DeliveryOrder->DeliveryOrderDetail->AssetCategory->find('list');
        $poDetail = $this->DeliveryOrder->Po->PoDetail->find('list', array('fields' => 'qty'));
		$this->set(compact('deliveryOrder', 'assetCategories', 'poDetail'));
	}

}

?>