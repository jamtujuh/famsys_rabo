<?php
class NpbDetailsController extends AppController {

      var $name = 'NpbDetails';
      var $helpers = array('Ajax', 'Javascript', 'Number');
      var $components = array('RequestHandler', 'Attachment', 'Session');
      var $uses = array('NpbDetail');
      var $is_ajax = false;

      function index($npb_status_id=null, $process_type_id=null, $processType=null, $no=null) {
            $this->NpbDetail->recursive = 0;
			$group_id = $this->Session->read('Security.permissions');
			if($process_type_id == movement_process_type_id && $group_id == it_management_group_id)
			{
				$conditions[] = array('Npb.request_type_id'=>request_type_fa_it_id);
			}
			elseif($process_type_id == movement_process_type_id && $group_id == fa_management_group_id)
			{
				$conditions[] = array('Npb.request_type_id'=>request_type_fa_general_id);
			}
			elseif($process_type_id == movement_process_type_id && $group_id == stock_management_group_id)
			{
				$conditions = array(
                      'AND' => array(
                          'OR' => array(
                              array('Npb.request_type_id' => request_type_stock_id),
                              array('Npb.request_type_id' => request_type_point_reward_id)),
                     )
                  );
			}elseif($process_type_id == procurement_process_type_id && $group_id == gs_group_id){
				$conditions[] = array('Npb.no NOT LIKE' => '%/MR-RAC/%');
			}
				//$nD []= array('NpbDetail.qty-NpbDetail.qty_filled');
			$no = trim($this->data['Npb_detail']['no']);
			if(!isset($npb_status_id)){
				$npb_status_id = status_npb_processing_id;
			}
			if(!isset($process_type_id)){
				$process_type_id = procurement_process_type_id;
			}
			if ($no)
                  $this->Session->write('Npb.no', $no);
            else 
                  $this->Session->write('Npb.no', null);
			
            if ($no = $this->Session->read('Npb.no')){
                  $conditions[] = array('Npb.no LIKE' => '%'. $no . '%',
									'NpbDetail.qty-NpbDetail.qty_filled != 0',
								);
			}else{
				$conditions[] = array('NpbDetail.process_type_id'=>$process_type_id,
									'NpbDetail.qty-NpbDetail.qty_filled != 0',
									'Npb.npb_status_id'=>$npb_status_id,
										
								);
			}
					
			$this->paginate = array('order'=>'NpbDetail.id');
			$departments = $this->NpbDetail->Npb->Department->find('list');
			$this->set('npbDetails', $this->paginate($conditions));
			$this->set(compact('processType', 'departments'));
      }
	  
      function item_pending() {
            $this->NpbDetail->recursive = 0;
			$layout = $this->data['NpbDetail']['layout'];
			$group_id = $this->Session->read('Security.permissions');
			if(!empty($this->data)){
				if($this->data['CostCenter']['name'] == '')
					$this->data['NpbDetail']['cost_center_id'] = null;
			}
			$conditions[] = array('Npb.request_type_id'=>request_type_stock_id);
			$npb_status_id = status_npb_processing_id;
			$process_type_id = movement_process_type_id;
			
			$conditions[] = array('NpbDetail.process_type_id'=>$process_type_id,
									'NpbDetail.qty-NpbDetail.qty_filled != 0',
									'Npb.npb_status_id'=>$npb_status_id,									
							);
			if($department_id = $this->data['NpbDetail']['department_id']){
				$conditions[] = array('Npb.department_id'=>$department_id);
			}
			if($business_type_id = $this->data['NpbDetail']['business_type_id']){
				$conditions[] = array('Npb.business_type_id'=>$business_type_id);
			}
			if($cost_center_id = $this->data['NpbDetail']['cost_center_id']){
				$conditions[] = array('Npb.cost_center_id'=>$cost_center_id);
			}
			$this->paginate = array('order'=>'NpbDetail.id');
			$departments = $this->NpbDetail->Npb->Department->find('list');
			$businessTypes = $this->NpbDetail->Npb->BusinessType->find('list');
			$costCenters = $this->NpbDetail->Npb->CostCenter->find('list',array('fields'=>'name'));
			//$cc 			= $this->NpbDetail->query('select a.id,a.name,b.t24_dao from cost_centers a left join cost_center_to_daos b on b.cost_center_id = a.id where a.remarks = "Y" order by a.name');
			//foreach($cc as $data){
			//	if($data[0]['t24_dao']){
			//		$costCenters[ $data[0]['id'] ]	= $data[0]['name'] . " - " .$data[0]['t24_dao'];
			//	}else{
			//		$costCenters[ $data[0]['id'] ]	= $data[0]['name'];
			//	}				
			//}
			$copyright_id = $this->configs['copyright_id'];
            if ($layout == 'pdf' || $layout == 'xls') {
                  $con = $this->NpbDetail->find('all', array('conditions' => $conditions));
            } else {
                  $con = $this->paginate($conditions);
            }
			$this->set('npbDetails', $con);
			$this->set(compact('processType', 'departments', 'businessTypes', 'costCenters', 'copyright_id'));
			if ($layout == 'pdf') {
                  Configure::write('debug', 0); // Otherwise we cannot use this method while developing 
                  $this->layout = 'pdf'; //this will use the pdf.ctp layout 
                  $this->render('item_pending_pdf');
            } else if ($layout == 'xls') {
                  $this->render('item_pending_xls', 'export_xls');
            }

      }

      function view($id = null) {
            if (!$id) {
                  $this->Session->setFlash(__('Invalid npb detail', true));
                  $this->redirect(array('action' => 'index'));
            }
            $this->set('npbDetail', $this->NpbDetail->read(null, $id));
      }

      function add() {
            if (!empty($this->data)) {
                  $this->NpbDetail->create();
                  $this->data['NpbDetail']['amount'] = $this->data['NpbDetail']['qty'] * $this->data['NpbDetail']['price'];
                  $this->data['NpbDetail']['amount_cur'] = $this->data['NpbDetail']['qty'] * $this->data['NpbDetail']['price_cur'];
				  $this->data['NpbDetail']['qty_unfilled']	= $this->data['NpbDetail']['qty'];
                  if ($this->NpbDetail->save($this->data)) {
                        $this->Session->setFlash(__('The npb detail has been saved', true), 'default', array('class' => 'ok'));
                        $this->redirect(array('controller' => 'npbs', 'action' => 'view', $this->Session->read('Npb.id')));
                  } else {
                        $this->Session->setFlash(__('The npb detail could not be saved. Please, try again.', true));
                  }
            }
            //$npb = $this->NpbDetail->Npb->read(null, $this->Session->read('Npb.id'));
            //$items = $this->NpbDetail->Item->find('list');
            //$currencies = $this->NpbDetail->Currency->find('list');
            //$this->set(compact('npb','items', 'currencies'));

            $npb = $this->NpbDetail->Npb->read(null, $this->Session->read('Npb.id'));
            $request_type_id = $npb['Npb']['request_type_id'];
            $requestTypes = $this->NpbDetail->Item->find('list', array('conditions' => array('Item.request_type_id' => $request_type_id)));
            $currencies = $this->NpbDetail->Currency->find('list');
            $this->set(compact('npb', 'requestTypes', 'currencies'));
      }

		function ajax_add() {
			$group_id = $this->Session->read('Security.permissions');
            $this->NpbDetail->recursive = 0;
            $this->autoRender = false;
            $msg = '';
            $npbDetail = null;

            if (!empty($this->data)) {
                $this->NpbDetail->create();
                $npb_id = $this->data['NpbDetail']['npb_id'] = $this->Session->read('Npb.id');
                $npb = $this->NpbDetail->Npb->read(null, $npb_id);
				  
                if ($npb['Npb']['request_type_id'] == request_type_stock_id) {
					//if purchase request => procurement else movement (outlog)
					$process_type_id = $npb['Npb']['is_purchase_request'] ? procurement_process_type_id : movement_process_type_id;
                } else if($npb['Npb']['request_type_id'] == request_type_service_id || $npb['Npb']['request_type_id'] == request_type_fa_general_id || $npb['Npb']['request_type_id'] == request_type_point_reward_id || $npb['Npb']['request_type_id'] == request_type_fa_it_id){
                 	$process_type_id = procurement_process_type_id;						
				} else {
					$process_type_id = null;
                }
				
				if($npb['Npb']['request_type_id'] == request_type_point_reward_id){
					$res	= $this->NpbDetail->query('select id from items where request_type_id = '.request_type_point_reward_id.' and id not in (select item_id from point_reward_items)');
					foreach($res as $data){
						$arrayLock[]	= $data[0]['id'];
					}

					if(in_array($this->data['NpbDetail']['item_id'], $arrayLock)){
						$process_type_id = movement_process_type_id;	
					}else{
						$process_type_id = procurement_process_type_id;			
					}					
				}
				
				if($npb['Npb']['request_type_id'] == request_type_point_reward_id || $npb['Npb']['request_type_id'] == request_type_fa_it_id ){
					$this->data['NpbDetail']['currency_id'] = 1;
				}
			 
                $item = $this->NpbDetail->Item->findById($this->data['NpbDetail']['item_id']);
				//echo '<pre>';
				//var_dump($item);
				//echo '<pre>';die();
				if ($npb['Npb']['request_type_id'] == request_type_stock_id || $npb['Npb']['request_type_id'] == request_type_point_reward_id) {
					if($this->data['NpbDetail']['currency_id'] == '1'){
						$this->data['NpbDetail']['rp_rate'] = '1.00';
					}
					if(empty($this->data['NpbDetail']['price'])){
						$this->data['NpbDetail']['price'] 		= $item['Item']['avg_price'];
						$this->data['NpbDetail']['price_cur'] 	= $item['Item']['avg_price'];
					} else{
						$this->data['NpbDetail']['price_cur'] = /*$item['Item']['price'];*/ $this->data['NpbDetail']['price'];
					}
				}
				
				if ($npb['Npb']['request_type_id'] == request_type_fa_it_id && $group_id == normal_user_group_id) {					
					$this->data['NpbDetail']['price'] 		= "0";
					$this->data['NpbDetail']['price_cur'] 	= "0";
					$this->data['NpbDetail']['currency_id'] = "1";
				}
                if($this->data['NpbDetail']['currency_id'] != "1"){
					$res	= $this->NpbDetail->query("select rp_rate from currencies where id = '".$this->data['NpbDetail']['currency_id']."' ");
					$this->data['NpbDetail']['rp_rate']		= $res[0][0]['rp_rate'];
				}else{
					$this->data['NpbDetail']['rp_rate']		= "1";
				}
                $this->data['NpbDetail']['currency_id'] 	= $this->data['NpbDetail']['currency_id'];
				$this->data['NpbDetail']['price_cur'] 		= $this->data['NpbDetail']['price'];
                $this->data['NpbDetail']['amount'] 			= $this->data['NpbDetail']['qty'] * $this->data['NpbDetail']['price'];
                $this->data['NpbDetail']['amount_cur'] 		= $this->data['NpbDetail']['qty'] * $this->data['NpbDetail']['price_cur'];
                $this->data['NpbDetail']['unit_id'] 		= $item['Item']['unit_id'];
                $this->data['NpbDetail']['process_type_id'] = $process_type_id;
                if($this->data['NpbDetail']['currency_id'] 	== ''){
					$this->data['NpbDetail']['currency_id'] 	= '1';
				}
				if($this->data['NpbDetail']['price'] == ''){
					$this->data['NpbDetail']['price'] = '0';
				}
				if($this->data['NpbDetail']['amount'] == ''){
					$this->data['NpbDetail']['amount'] = '0';
				}
				if($this->data['NpbDetail']['brand'] == ''){
					$this->data['NpbDetail']['brand'] = '-';
				}
                if($this->data['NpbDetail']['type'] == ''){
					$this->data['NpbDetail']['type'] = '-';
				}
                if($this->data['NpbDetail']['color'] == ''){
					$this->data['NpbDetail']['color'] = '-';
				}
				$this->data['NpbDetail']['qty_filled'] = 0;
				if($this->data['NpbDetail']['price_cur'] == null){
					$this->data['NpbDetail']['price_cur'] = '0';
				}
				$this->data['NpbDetail']['qty_unfilled'] = $this->data['NpbDetail']['qty'];
                if ($this->NpbDetail->save($this->data)) {
					$status = 'ok';
					$msg = __('The npb detail has been saved', true);
					$npbDetail = $this->NpbDetail->read(null, $this->NpbDetail->id);
					$count = $this->NpbDetail->find('count', array('conditions' => array('Npb.id' => $npb_id)));
                } else {
					$status = 'failed';
					$count = 0;
					$msg = __('The npb detail could not be saved. Please, try again.', true);
                }
            }
            echo json_encode(array('status' => $status, 'msg' => $msg, 'data' => $npbDetail, 'count' => $count));
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

			$this->data = $this->NpbDetail->read(null, $id);
			if($fieldName=='qty_unfilled')
			{
				App::import('Model','InventoryLedger');
				$InventoryLedger = new InventoryLedger;
				$itemBalances = $InventoryLedger->getItemBalances();
				$balance = $itemBalances[$this->data['NpbDetail']['item_id']]?$itemBalances[$this->data['NpbDetail']['item_id']]:0;
				
				if($value > $this->data['NpbDetail']['qty'] || $value < 0)
					$value = $this->data['NpbDetail']['qty'];
				
				if($balance < 0){
					$value = 0;
				}else if($balance > 0 && $balance < $value){
					$value = $balance;
				}
				
				$qty_requested 	= $this->data['NpbDetail']['qty'];
				$qty_filled 	= $this->data['NpbDetail']['qty_filled'];
				$qty_unfilled 	= $this->data['NpbDetail']['qty_unfilled'];
				
				$qty_filled		= $value; //change value
				if($qty_filled > $qty_requested){
					$qty_filled = $qty_requested;
				}
				
				$qty_unfilled 	= $qty_requested - $qty_filled;
				if($qty_unfilled < 0){
					$qty_unfilled = 0;
				}
				
				$this->data['NpbDetail']['qty_filled'] = $qty_filled;
				$this->data['NpbDetail']['qty_unfilled'] = $qty_unfilled;
				
				$npbDetail = array('NpbDetailId'=>$id,'QtyValue'=>$value);
				$this->Session->write('OutlogDetail.Reference.'.$id, $npbDetail);
				/*$arrNpbDetail = array();
				$arrNpbDetail[] = array('NpbDetailId'=>$id,'QtyValue'=>$value);
				if($this->Session->read('OutlogDetail.Reference')){
					$arrNpbDetailSaved = $this->Session->read('OutlogDetail.Reference');
					$n = -1;
					foreach($arrNpbDetailSaved as $a){
						$n++;
					}
					$n = $n+1;
					$this->Session->write('OutlogDetail.Reference.'.$n,$arrNpbDetail);
				}else{
					$this->Session->write('OutlogDetail.Reference.0',$arrNpbDetail);
				}*/
			}
			if($fieldName=='brand')
			{
				if($value == '' || $value == ' ' || $value == '  '|| $value == '   ')
					$value = '-';
			}
			if($fieldName=='type')
			{
				if($value == '' || $value == ' ' || $value == '  '|| $value == '   ')
					$value = '-';
			}
			if($fieldName=='color')
			{
				if($value == '' || $value == ' ' || $value == '  '|| $value == '   ')
					$value = '-';
			}
			if($fieldName == 'price_cur'){
				if($value >= 0){
					$this->data['PoDetail']['price_cur'] = $value;
				}else{
					$this->data['PoDetail']['price_cur'] = 0;
				}
				
			}
			
			if($fieldName != 'qty_unfilled'){
				$this->data['NpbDetail'][$fieldName] = $value;
			}
			$this->data['NpbDetail']['id'] = $id;

		}

		if (!$id && empty($this->data)) {
			if ($this->is_ajax) {
				$msg = __('Invalid npb detail', true);
			} else {
				$this->Session->setFlash(__('Invalid npb detail', true));
				$this->redirect(array('action' => 'index'));
			}
		}
		if (!empty($this->data)) {
			$this->data['NpbDetail']['amount'] = $this->data['NpbDetail']['qty'] * $this->data['NpbDetail']['price'];
			$this->data['NpbDetail']['amount_cur'] = $this->data['NpbDetail']['qty'] * $this->data['NpbDetail']['price_cur'];
			if ($this->NpbDetail->save($this->data)) {
				if ($this->is_ajax) {
					$msg = __('The npb detail has been saved', true);
				} else {
					$this->Session->setFlash(__('The npb detail has been saved', true), 'default', array('class' => 'ok'));
					$this->redirect(array('controller' => 'npbs', 'action' => 'view', $this->Session->read('Npb.id')));
				}
			} else {
				if ($this->is_ajax) {
					$msg = __('The npb detail could not be saved. Please, try again.', true);
				} else {
					$this->Session->setFlash(__('The npb detail could not be saved. Please, try again.', true));
				}
			}
		}
		
		if (empty($this->data)) {
			$this->data = $this->NpbDetail->read(null, $id);
		}
		
		//$places = $this->data['NpbDetail']['currency_id']==1?-1:2;
		$currency = $this->NpbDetail->Currency->find('list', array('fields'=>'is_desimal'));
		$places = $this->getPlaces($currency[$this->data['NpbDetail']['currency_id']]);

		if ($this->is_ajax) {
			if ($fieldName == 'price_cur')
				echo number_format($this->data['NpbDetail'][$fieldName], $places);
			else
				echo $this->data['NpbDetail'][$fieldName];
		} else {
			$npb = $this->NpbDetail->Npb->read(null, $this->Session->read('Npb.id'));
			$npbs = $this->NpbDetail->Npb->find('list');
			$request_type_id = $npb['Npb']['request_type_id'];
			$requestTypes = $this->NpbDetail->Item->find('list', array('conditions' => array('Item.request_type_id' => $request_type_id)));
			$currencies = $this->NpbDetail->Currency->find('list');
			$this->set(compact('npb', 'npbs', 'requestTypes', 'currencies', 'places'));
		}
	}

      function ajax_edit($id) {
            $this->is_ajax = true;
            $this->edit($id);
      }

      function ajax_edit_currency($id) {
            $this->autoRender = false;
            $this->data['NpbDetail']['id'] = $id;
            $this->data['NpbDetail']['currency_id'] = $this->data['NpbDetail']['currency_id'];

            if ($this->NpbDetail->save($this->data)) {
                  $msg = __('The npb detail has been saved', true);
                  echo $msg;
            }
      }

      function delete($id = null) {
            if (!$id) {
                  $this->Session->setFlash(__('Invalid id for npb detail', true));
                  $this->redirect(array('action' => 'index'));
            }
            if ($this->NpbDetail->delete($id)) {
                  $this->Session->setFlash(__('Npb detail deleted', true), 'default', array('class' => 'ok'));
                  $this->redirect(array('controller' => 'npbs', 'action' => 'view', $this->Session->read('Npb.id')));
            }
            $this->Session->setFlash(__('Npb detail was not deleted', true));
            $this->redirect(array('action' => 'index'));
      }

		function set_procurement($id = null) {
            $this->autoRender = false;
            $this->NpbDetail->read(null, $id);
            $this->NpbDetail->set('process_type_id', procurement_process_type_id);
            if ($this->NpbDetail->save())
                echo 'success';
            else
                echo 'failed';
		}

		function set_movement($id = null) {
            $this->autoRender = false;
            $this->NpbDetail->read(null, $id);
            $this->NpbDetail->set('process_type_id', movement_process_type_id);
            if ($this->NpbDetail->save())
                echo 'success';
            else
                echo 'failed';
		}

      function set_cancel($id = null) {
            $this->autoRender = false;
            $this->NpbDetail->read(null, $id);
            $this->NpbDetail->set('process_type_id', null);
            if ($this->NpbDetail->save())
                  echo 'success';
            else
                  echo 'failed';
      }

		function attachment() {
            
		}
	  
		function voucher_index($npb_status_id=null, $process_type_id=null, $processType=null, $no=null) {
            $group_id = $this->Session->read('Security.permissions');
			//$layout = $this->data['Npb_detail']['layout'];
			
			$dep_id = $this->data['Npb_detail']['department_id'];
			if($dep_id == ""){
				$this->Session->write('Npb_detail.department_id', null);
			}
			if ($dep_id){
                  $this->Session->write('Npb_detail.department_id', $dep_id);
			}
            else if (isset($this->data['Npb_detail.department_id'])){
                  $this->Session->write('Npb_detail.department_id', $dep_id);
			}
			
			if($npb_status_id && empty($status)){
				$status = $npb_status_id;
			}
			if($this->Session->read('Npb_detail.status')){
				$status = $this->Session->read('Npb_detail.status');
			}
			if($status == ""){
				$this->Session->write('Npb_detail.status', null);
			}
			if ($status){
                  $this->Session->write('Npb_detail.status', $status);
			}
            else if (isset($this->data['Npb_detail.status'])){
                  $this->Session->write('Npb_detail.status', $status);
			}
			
			// CUSTOM SCRIPT //
			
			$reqType	= request_type_point_reward_id;			
			
			$sql = 'select b.name as department_name, a.id as npb_id, a.no as npb_no, c.name as status_name
					from npbs a 
					left join departments b on a.department_id = b.id
					left join npb_statuses c on a.npb_status_id = c.id
					left join npb_details d on d.npb_id = a.id ';			
			$sql .=	"where a.request_type_id = '".$reqType."' ";			
			
			$sql .= "and a.npb_status_id = '".$status."' ";
			if($group_id == gs_group_id){
				$sql .= "and a.no like '%/MR-RAC-C/%' ";
			}else if($group_id == rac_group_id){
				$sql .= "and a.no like '%/MR-RAC/%' ";
			}			
			
			if ($dep_id = $this->Session->read('Npb_detail.department_id')){
				  $sql .= "and b.id = '".$dep_id."' ";
			};
			
			list($date_start, $date_end) = $this->set_date_filters('Npb_detail');
            if($date_start && $date_end){
				$sql .=	"and a.npb_date between '".$date_start['year']."-".$date_start['month']."-".$date_start['day']."' and 
				 '".$date_end['year']."-".$date_end['month']."-".$date_end['day']."' ";
			}
			
			//if($item_name){
			//	$sql .=	"and (e.code LIKE '%{$item_name}%'
			//			or e.name LIKE '%{$item_name}%') ";
			//}
			
			$sql .=	'group by b.name, a.id, a.no, c.name, a.created_by, a.created_date
					order by a.id ';
					
			//echo '<pre>';
			//var_dump($this->Session->read('Npb_detail'));
			//echo '</pre>';die();
					
			$npbData = null;		
			
			$res = $this->NpbDetail->query($sql);
			foreach($res as $r){
				$search	= $this->NpbDetail->query("select sum(a.qty) as total from npb_details a left join items b on b.id = a.item_id where b.id in (select item_id from point_reward_items) and a.npb_id = ".$r[0]['npb_id']);
				$r[0]['totalVoucher']	= $search[0][0]['total'];
				$search	= $this->NpbDetail->query("select sum(a.qty) as total from npb_details a left join items b on b.id = a.item_id where b.request_type_id = '".request_type_point_reward_id."'
													and b.id not in (select item_id from point_reward_items) and a.npb_id = ".$r[0]['npb_id']);
				$r[0]['totalLock']	= $search[0][0]['total'];				
				
				
				$npbData[]['main'] = $r[0];
			}
			
			// CUSTOM SCRIPT END //
			
			
			$this->NpbDetail->recursive = 0;
			
			$departments = $this->NpbDetail->Npb->Department->find('list');
			if($group_id == rac_group_id){
				$npbStatuses = $this->NpbDetail->Npb->NpbStatus->find('list', array('conditions'=>array('id != '.status_npb_processing_id)));
			}else{
				$npbStatuses = $this->NpbDetail->Npb->NpbStatus->find('list');
			}		
			
			$n  = 0;
			$m	= 0;
			if($npbData){
				foreach($npbData as $s){
					$search	= $this->NpbDetail->query("select b.id as item_id, b.name, a.qty from npb_details a 
														left join items b on b.id = a.item_id
														where a.npb_id = '".$s['main']['npb_id']."' 
														order by a.npb_id");
					if($search){
						foreach($search as $z){
							$items[$n]['item_id']	= $z[0]['item_id'];
							$items[$n]['item_name']	= $z[0]['name'];
							$items[$n]['item_qty']	= $z[0]['qty'];
							$items[$n]['npb_id']	= $s['main']['npb_id'];
							$n++;							
						}					
					}
				}
				
				$m = 0;
				foreach($npbData as $dt){
					$n = 0;
					foreach($items as $item){
						if($item['npb_id'] == $dt['main']['npb_id']){
							$npbData[$m]['detail'][$n]	= $item;
							$n++;
						}
					}
					$m++;
				}
				
			}
			
			//echo '<pre>';
			//var_dump($npbData);
			//echo '</pre>';die();
			
			$this->set(compact('processType', 'departments','date_start','date_end','npbStatuses','totals','npbData','itemDetail'));
			
			//if ($layout == 'pdf') {					
            //      Configure::write('debug', 0); // Otherwise we cannot use this method while developing 
            //      $this->layout = 'pdf'; //this will use the pdf.ctp layout 
            //      $this->render('voucher_pdf');
            //} else if ($layout == 'xls') {
            //      $this->render('voucher_xls', 'export_xls');
            //}
		}
		
		public function recap_mrs($periode_id = null){
			Configure::write('debug', 1);
			$this->NpbDetail->recursive = 0;
			$this->loadModel('NpbDetail');
			$options = array('1'=>'Periode 1','2'=>'Periode 2');
			$this->set('periode',$options);
			if(!empty($this->data)){
				$periode_id	= $this->data['NpbDetail']['per'];
			}
			
			if($periode_id){
				$res = $this->NpbDetail->query('select day_start, day_end from periodes where id = '.$periode_id);
				
				$day_start 	= $res[0][0]['day_start'];
				$day_end 	= $res[0][0]['day_end'];
				$month 		= date('m');
				$year		= date('Y');
				$arrDay		= array('27','28','29','30','31');
				
				if(in_array($day_end, $arrDay)){
					$month = date('m', strtotime("-1 month"));
				}
				
				if(($month  == '04' || $month  == '06' || $month  == '09' || $month  == '11') && in_array($day_end, $arrDay)){
					$day_end = '30';
				}
				
				if($month == '02' && in_array($day_end, $arrDay)){
					if(($year % 4) == 0){
						$day_end = '29';
					}else{
						$day_end = '28';
					}
				}
				
				//echo $year . '-' . $month . '-' . $day_start;
				//echo '<br>';
				//echo $year . '-' . $month . '-' . $day_end;
				
				$res = $this->NpbDetail->query("select item_id from point_reward_items where mark = 'VOUCHER'");
				foreach($res as $data){
					$arrayVoucher[]	= $data[0]['item_id'];
				}
				
				$vouchers	= array();		
				$res	= $this->NpbDetail->query("select item_id, item_prefix from point_reward_items where mark = 'VOUCHER'");
				$n		= 1;
				foreach($res as $item){
					$vouchers[$n]['item_id']		= $item[0]['item_id'];
					$vouchers[$n]['item_prefix']	= $item[0]['item_prefix'];
					$n++;
				}
				
				//$res = $this->NpbDetail->query("select id from items where request_type_id = '5' and id not in (select item_id from point_reward_items where mark = 'VOUCHER') ");
				//foreach($res as $data){
				//	$arrayLock[] 	= $data[0]['id'];
				//}
				
				$conditions[] = array('Npb.request_type_id'		=> request_type_point_reward_id);
				$conditions[] = array('Npb.npb_status_id'		=> status_npb_sent_to_rac_id);
				$conditions[] = array('Npb.approved_date >=' 	=> ($year . '-' . $month . '-' . $day_start),
									  'Npb.approved_date <=' 	=> ($year . '-' . $month . '-' . $day_end));
				
				$npbs 		= $this->NpbDetail->Npb->find('all', array('conditions'=>$conditions));
				
				$finalStatus = 0;
				$items = array();
				
				//echo '<pre>';
				//var_dump($conditions);
				//var_dump($npbs);
				//echo '</pre>';die();				
				
				if($npbs){
					$n = 0;
					foreach($npbs as $data){						
						foreach($data['NpbDetail'] as $npbDetail){							
							$items[$n]['item_id'] 	= $npbDetail['item_id'];
							$items[$n]['qty'] 		= $npbDetail['qty'];
							$n++;
						}
						// sets to compiled
						$this->NpbDetail->query('update npbs set npb_status_id = "'.status_npb_rac_processed_id.'" where id = '.$data['Npb']['id']);						
					}
					
					// sets non voucher items to processing status
					foreach($npbs as $data){		
						foreach($data['NpbDetail'] as $npbDetail){							
							if(!in_array($npbDetail['item_id'], $arrayVoucher)){
								$this->NpbDetail->query('update npbs set npb_status_id = "'.status_npb_processing_id.'" where id = '.$npbDetail['npb_id']);
							}
						}
					}
					
					$itemTotals = array();
					foreach($items as $item){
						$index = $this->item_exists($item['item_id'], $itemTotals);
						if($index < 0){
							$itemTotals[] 	= $item;
						}else{
							$itemTotals[$index]['qty']	+= $item['qty'];
						}					
					}
					
					$reqTypeId = request_type_point_reward_id;
					
					$newMRDetailData['NpbDetail']['po_id']			= 0;
					$newMRDetailData['NpbDetail']['movement_id']	= 0;
					$newMRDetailData['NpbDetail']['color']			= '-';
					$newMRDetailData['NpbDetail']['brand']			= '-';
					$newMRDetailData['NpbDetail']['type']			= '-';
					$newMRDetailData['NpbDetail']['fulfillment_id']	= 0;
					$newMRDetailData['NpbDetail']['desc']			= null;
					$newMRDetailData['NpbDetail']['discount']		= 0;
					$newMRDetailData['NpbDetail']['discount_cur']	= 0;
					$newMRDetailData['NpbDetail']['amount_net']		= 0;
					$newMRDetailData['NpbDetail']['amount_net_cur']	= 0;
					$newMRDetailData['NpbDetail']['date_finish']	= null;
					$newMRDetailData['NpbDetail']['qty_filled']		= 0;
					$newMRDetailData['NpbDetail']['outlog_id']		= 0;
					$newMRDetailData['NpbDetail']['process_type_id']= procurement_process_type_id;
					
					$totalV = 0;
					foreach($itemTotals as $itemTotal){
						if(in_array($itemTotal['item_id'],$arrayVoucher)){ // in voucher	
							$totalV++;
						}
					}
					
					$res	= $this->NpbDetail->query("select (count(*) + 1) as total from point_reward_items");
					$totalVoucherItems	= $res[0][0]['total'];					
					
					//echo '<pre>';
					
					if($totalV > 0){
						$newMRData['Npb']['npb_date']	= date('Y-m-d');
						for($count=1 ;$count < $totalVoucherItems; $count++){
							$newMRData['Npb']['department_id']				= 11;	//RAC = TEBET
							$newMRData['Npb']['department_sub_id']			= 0;
							$newMRData['Npb']['department_unit_id']			= 0;
							$newMRData['Npb']['business_type_id']			= 2;
							$newMRData['Npb']['cost_center_id']				= 43;
							$newMRData['Npb']['created_by']					= 'RAC';
							$newMRData['Npb']['no']							= $this->NpbDetail->Npb->getNewIdCompile(11, $reqTypeId, $vouchers[$count]['item_prefix']);
							$newMRData['Npb']['supplier_id']				= 0;
							$newMRData['Npb']['req_date']					= date('Y-m-d');
							$newMRData['Npb']['request_type_id']			= request_type_point_reward_id;
							$newMRData['Npb']['notes']						= '';
							$newMRData['Npb']['created_date']				= date('Y-m-d H:i:s');
							$newMRData['Npb']['is_purchase_request']		= 0;
							$newMRData['Npb']['is_printed']					= 0;
							$newMRData['Npb']['npb_status_id'] 				= status_npb_processing_id;				
							$this->NpbDetail->Npb->create();					
							if($this->NpbDetail->Npb->save($newMRData['Npb'])){	
								$newId = $this->NpbDetail->Npb->id;
								$savedData[$count]['npb_id']				= $newId;
								$savedData[$count]['item_id']				= $vouchers[$count]['item_id'];
								$savedData[$count]['item_prefix']			= $vouchers[$count]['item_prefix'];
							}else{
								$finalStatus = 0;
							};
						}
					}
					
					//echo '<pre>';
					//var_dump($saved['item_id']);					
					//echo '</pre>';die();
					
					foreach($itemTotals as $itemTotal){
					
						if(in_array($itemTotal['item_id'],$arrayVoucher)){ // in voucher	
							
							$res	= $this->NpbDetail->Item->findById($itemTotal['item_id']);
							if($res['Item']['price'] > 0){
								$newMRDetailData['NpbDetail']['price']		= $res['Item']['price'];
								$newMRDetailData['NpbDetail']['price_cur']	= $res['Item']['price'];
							}else{
								$newMRDetailData['NpbDetail']['price']		= $res['Item']['avg_price'];
								$newMRDetailData['NpbDetail']['price_cur']	= $res['Item']['avg_price'];
							}
							$amount = $itemTotal['qty'] * $newMRDetailData['NpbDetail']['price'];
							
							$newMRDetailData['NpbDetail']['currency_id']	= $res['Currency']['id'];
							$newMRDetailData['NpbDetail']['rp_rate']		= $res['Currency']['rp_rate'];
							$newMRDetailData['NpbDetail']['unit_id']		= $res['Unit']['id'];
							$newMRDetailData['NpbDetail']['qty']			= $itemTotal['qty'];
							$newMRDetailData['NpbDetail']['qty_unfilled']	= $itemTotal['qty'];
							$newMRDetailData['NpbDetail']['qty_filled']		= 0;
							$newMRDetailData['NpbDetail']['amount']			= $amount;
							$newMRDetailData['NpbDetail']['amount_cur']		= $amount;
							foreach($savedData as $saved){
								if($itemTotal['item_id'] == $saved['item_id']){
									$newMRDetailData['NpbDetail']['npb_id']	= $saved['npb_id'];
								}
							}		
							$newMRDetailData['NpbDetail']['item_id']		= $itemTotal['item_id'];
							$newMRDetailData['NpbDetail']['process_type_id']= procurement_process_type_id;

							$this->NpbDetail->create();
							$this->NpbDetail->save($newMRDetailData['NpbDetail']);
							$c = 1;
							foreach($savedData as $saved){
								if($itemTotal['item_id'] == $saved['item_id']){
									$newNpbDetailId = $this->NpbDetail->id;
									$savedData[$c]['npb_detail_id']	= $newNpbDetailId;
								}
								$c++;
							}	
						}						
					}
					
					foreach($npbs as $data){						
						foreach($data['NpbDetail'] as $npbDetail){
							if(in_array($npbDetail['item_id'],$arrayVoucher)){
								foreach($savedData as $saved){
									if($npbDetail['item_id'] == $saved['item_id']){
										$this->NpbDetail->query('insert into npbs_point_rewards values ("'.$saved['npb_id'].'", "'.$saved['npb_detail_id'].'", "'.$data['Npb']['id'].'", "'.$npbDetail['id'].'", NULL, NULL, NULL, NULL, NULL, "'.$npbDetail['item_id'].'")');										
									}
								}						
							}
						}						
					}
				}					
			}
		}
		
		function item_exists($itemId, $array){
			$result = -1;
			for($i=0;$i<sizeof($array);$i++){
				if($array[$i]['item_id'] == $itemId){
					$result = $i;
					break;
				}				
			}
			return $result;
		}
		
		function array_unique_multidimensional($input){
			$serialized = array_map('serialize', $input);
			$unique		= array_unique($serialized);
			return array_intersect_key($input, $unique);
		}
		
		function voucher_sent($npb_status_id=null, $process_type_id=null, $processType=null, $no=null) {
            $group_id = $this->Session->read('Security.permissions');
			$layout = $this->data['Npb_detail']['layout'];
			$item_name = trim($this->data['Npb_detail']['item_name']);
			
			if(!empty( $this->data ) )
			{
				//approve via checkbox
				if(isset($this->data['Npb_detail']['npb_id'])){		
					$npb_id_updates = $this->data['Npb_detail']['npb_id'];
					foreach ($npb_id_updates as $npb_id_update){
						if($npb_id_update > 0){
							if($this->data['Npb_detail']['process_type_id'] == movement_process_type_id){
								$npb_status_id = status_npb_movement_id;
							}else{
								$npb_status_id = status_npb_processing_id;
							}
							if($this->NpbDetail->query('update npbs set npb_status_id = '.$npb_status_id.' where id = '.$npb_id_update)){
								$this->Session->setFlash(__('The MR Voucher(s) has been approved', true), 'default', array('class'=>'ok'));
								$this->redirect(array('action' => 'index', status_npb_branch_approved_id));
							}else{
								$this->Session->setFlash(__('The MR Voucher(s) could not be approved. Please, try again.', true));
								$this->redirect(array('action' => 'index', status_npb_branch_approved_id));
							}
						}					
					}	
				}
			}
			
			if($item_name == ""){
				$this->Session->write('Npb_detail.item_name', null);
			}
			
			if(!isset($process_type_id)){
				$process_type_id = '2';
			}
			if ($item_name){
                  $this->Session->write('Npb_detail.item_name', trim($item_name));
			}
            else if (isset($this->data['Npb_detail.item_name'])){
                  $this->Session->write('Npb_detail.item_name', trim($this->data['Npb_detail.item_name']));
			}
			
			$conditions[] = array(	'Item.request_type_id'=>request_type_point_reward_id,
									'NpbDetail.qty-NpbDetail.qty_filled != 0',
									'Npb.npb_status_id in (3,2,121)',);
				
									
			list($date_start, $date_end) = $this->set_date_filters('Npb_detail');
            $conditions[] = array('Npb.npb_date >=' => ($date_start['year'] . '-' . $date_start['month'] . '-' . $date_start['day']),
                'Npb.npb_date <=' => ($date_end['year'] . '-' . $date_end['month'] . '-' . $date_end['day']));
			
            if ($item_name = trim($this->Session->read('Npb_detail.item_name'))){
                  $conditions[] = array("Item.request_type_id = request_type_point_reward_id 
										and (Item.code LIKE '%{$item_name}%'
										or Item.name LIKE '%{$item_name}%') ");
			};
			
			
			$this->paginate = array('order'=>'NpbDetail.id');
			$this->NpbDetail->recursive = 0;
			
			$departments = $this->NpbDetail->Npb->Department->find('list');
			$npbStatuses = $this->NpbDetail->Npb->NpbStatus->find('list');
			if ($layout == 'pdf' || $layout == 'xls') {
                  $con = $this->NpbDetail->find('all', array('conditions' => $conditions, 'order'=>'NpbDetail.id'));
            } else {
                  $con = $this->paginate($conditions);
            }
			
			$this->set('npbDetails', $con);
			$this->set(compact('processType', 'departments','date_start','date_end','npbStatuses'));
		}

}

?>
