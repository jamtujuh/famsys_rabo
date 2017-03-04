<?php
App::import('Model','AssetDetail');
App::import('Model','AssetCategory');
class PurchasesController extends AppController {

	var $name = 'Purchases';
	var $helpers = array('Form', 'Html', 'Javascript', 'Number','Ajax');
	var $components = array('RequestHandler');

	function index($purchase_status_id=null, $group_register=null) {
		$this->Purchase->recursive = 0;
		$this->Session->write('Purchase.purchase_status_id', $purchase_status_id);
		$layout = 'Screen';
		$supplier_id = null;
		$group = $this->Session->read('Security.permissions');
		$purchases = $this->Purchase->find('all');
		if($group_register==null){
			if($group == fa_management_group_id)
			{
				$conditions[] = array('Purchase.request_type_id' => request_type_fa_general_id);
			}
			else if($group == it_management_group_id)
			{
				$conditions[] = array('Purchase.request_type_id' => request_type_fa_it_id);
			}
			else if($group == it_supervisor_group_id)
			{
				$conditions[] = array('Purchase.request_type_id' => request_type_fa_it_id);
			}
			else if($group == fa_supervisor_group_id)
			{
				$conditions[] = array('Purchase.request_type_id' => request_type_fa_general_id);
			}
		}else if(!empty($group_register)){
			if($group == fa_management_group_id)
			{
					$conditions[] = array('Purchase.group_id'=>fa_management_group_id);
			}
			else if($group == it_management_group_id)
			{
					$conditions[] = array('Purchase.group_id'=>it_management_group_id);
			}
			else if($group == it_supervisor_group_id)
			{
					$conditions[] = array('Purchase.group_id'=>it_management_group_id);
			}
			else if($group == fa_supervisor_group_id)
			{
					$conditions[] = array('Purchase.group_id'=>fa_management_group_id);
			}
		}
		
		if(!empty( $this->data ) )
		{
			$supplier_id=$this->data['Purchase']['supplier_id'] ;
			$purchase_status_id=$this->data['Purchase']['purchase_status_id'] ;
			$layout=$this->data['Purchase']['layout'];
			
			//approve via checkbox
			if(isset($this->data['Purchase']['purchase_id'])){		
				$this->data['Purchase']['purchase_status_id']=status_purchase_approved_id;	
				$purchase_id_updates = $this->data['Purchase']['purchase_id'];
				//echo '<pre>';
				
				$arr = array();
				foreach ($purchase_id_updates as $purchase_id_update){
					//var_dump($purchase_id_update);
					if($purchase_id_update > 0){
						$arr[]['id'] 	= $purchase_id_update;
					}					
				}
				$this->update_status_purchase($arr,status_purchase_approved_id);				
				//echo '</pre>';die();
			}
		}

		if($supplier_id){
			$conditions[] = array('Purchase.supplier_id'=>$supplier_id);
			$this->Session->write('Purchase.supplier_id' , $supplier_id);
		}
		
		if( $purchase_status_id )
		{
			$conditions[] = array('Purchase.purchase_status_id'=>$purchase_status_id);
			$this->Session->write('Purchase.purchase_status_id' , $purchase_status_id);
		}


		$group_id = $this->Session->read('Security.permissions');
		if($group_id == fa_supervisor_group_id)
		{
			$conditions[] = array('OR' => array(
				array('Purchase.purchase_status_id' => status_purchase_sent_to_supervisor_id),
				array('Purchase.purchase_status_id' => status_purchase_finish_id)
			));
		}
		else if($group_id == it_supervisor_group_id)
		{
			$conditions[] = array('OR' => array(
				array('Purchase.purchase_status_id' => status_purchase_sent_to_supervisor_id),
				array('Purchase.purchase_status_id' => status_purchase_finish_id)
			));
		}
		else if($group_id == fa_management_group_id)
		{
			$conditions[] = array('OR' => array(
					array('Purchase.purchase_status_id' => status_purchase_sent_to_supervisor_id),
					array('Purchase.purchase_status_id' => status_purchase_finish_id),
					array('Purchase.purchase_status_id' => status_purchase_reject_id),
					array('Purchase.purchase_status_id' => status_purchase_draft_id)
			));
		}
		else if($group_id == it_management_group_id)
		{
			$conditions[] = array('OR' => array(
					array('Purchase.purchase_status_id' => status_purchase_sent_to_supervisor_id),
					array('Purchase.purchase_status_id' => status_purchase_finish_id),
					array('Purchase.purchase_status_id' => status_purchase_reject_id),
					array('Purchase.purchase_status_id' => status_purchase_draft_id)
			));
		}
		$conditions[] = array('Purchase.purchase_status_id !='=> status_purchase_archive_id); //archive
		
		//var_dump($group_id);
		///date filter		
		list($date_start,$date_end) = $this->set_date_filters('Purchase');
		$conditions[] = array('Purchase.date_of_purchase >=' => ($date_start['year'] . '-' . $date_start['month'] . '-' . $date_start['day']) , 
				'Purchase.date_of_purchase <=' => ($date_end['year'] . '-' . $date_end['month'] . '-' . $date_end['day']) );
		$this->paginate = array('order'=>'Purchase.id');
		$copyright_id  = $this->configs['copyright_id'];
		$this->paginate['Purchase']=array('order'=>'Purchase.id desc');
		$con = $this->Purchase->find('all', array('conditions'=>$conditions, 'order'=>'Purchase.id DESC'));
		//$purchaseTotal = $this->Purchase->getTotals($con);
		if($layout=='Screen'){
			$con = $this->paginate($conditions);
		}
		
		$this->set('purchases', $con);
		$moduleName = 'Fixed Assets > Register > List FA Register';
		$this->set('title_for_layout',  $this->lastSegment($moduleName));
		$suppliers = $this->Purchase->Supplier->find('list', array('order'=>'Supplier.name'));
		$purchaseStatuses = $this->Purchase->PurchaseStatus->find('list', array('conditions' =>array('PurchaseStatus.id !=' => status_purchase_archive_id))); //archive
		$this->set(compact(
			/*'departments',*/
			'date_start','date_end','copyright_id',
			'suppliers','supplier_id','status', 'moduleName',
			'purchaseStatuses', 'purchaseTotal'
			/*'department_id'*/
			));		
		
		if($layout=='pdf')
		{
			Configure::write('debug',0); // Otherwise we cannot use this method while developing 
			$this->layout = 'pdf'; //this will use the pdf.ctp layout 
			$this->render('index_pdf'); 		
		}
		else if($layout=='xls')
		{
			$this->render('index_xls','export_xls');		
		}
	}	

	function update_status_purchase($ids=null, $new_status=null) {
		if (!$ids) {
			  $this->Session->setFlash(__('Invalid purchase id', true));
			  $this->redirect(array('action' => 'view', $id));
		}
		//echo '<pre>';
		//var_dump($ids);
		//echo '</pre>';die();
		foreach($ids as $data){
			$id = $data['id'];
			if ($new_status == status_purchase_approved_id) {
				$this->data['Purchase']['approved_date'] = date('Y-m-d H:i:s');
				$this->data['Purchase']['approved_by'] = $this->Session->read('Userinfo.username');
				$this->data['Purchase']['purchase_status_id'] = $new_status;
				$this->data['Purchase']['id'] = $id;
			}
			$this->Purchase->save($this->data);
			/*if ($this->Purchase->save($this->data)) {
				if ($new_status == status_purchase_approved_id) {
					$this->save_to_ledger($id);
				}
			}*/
		}
		$this->Session->setFlash(__('The Purchase(s) has been approved', true), 'default', array('class'=>'ok'));
		$this->redirect(array('action' => 'index', 2));
	}
	
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid FA Register', true));
			$this->redirect(array('action' => 'index'));
		}
		$group_id = $this->Session->read('Security.permissions');
		$this->Session->write('Purchase.id',$id);
		$assets = $this->Purchase->Asset->findByPurchaseId($id);
		
		$purchase=$this->Purchase->read(null, $id);

		$this->Session->write('Purchase.can_edit', false);
		$this->Session->write('Purchase.can_send_to_supervisor', false);
		$this->Session->write('Purchase.can_approve', false);
		$this->Session->write('Purchase.can_cancel', false);
		$this->Session->write('Purchase.can_reject', false);
		$this->Session->write('Purchase.can_archive', false);

		if ($group_id == fa_management_group_id && $purchase['DeliveryOrder']['request_type_id'] == request_type_fa_general_id) {
			$this->Session->write('Purchase.can_edit', $purchase['Purchase']['purchase_status_id'] == status_purchase_draft_id ? true : false);
			$this->Session->write('Purchase.can_send_to_supervisor', $purchase['Purchase']['purchase_status_id'] == status_purchase_draft_id ? true : false);
			$this->Session->write('Purchase.can_archive', $purchase['Purchase']['purchase_status_id'] == status_purchase_reject_id ? true : false);
		} 
		else if ($group_id == it_management_group_id && $purchase['DeliveryOrder']['request_type_id'] == request_type_fa_it_id) {
			$this->Session->write('Purchase.can_edit', $purchase['Purchase']['purchase_status_id'] == status_purchase_draft_id ? true : false);
			$this->Session->write('Purchase.can_send_to_supervisor', $purchase['Purchase']['purchase_status_id'] == status_purchase_draft_id ? true : false);
			$this->Session->write('Purchase.can_archive', $purchase['Purchase']['purchase_status_id'] == status_purchase_reject_id ? true : false);
			$this->Session->write('Purchase.request_type_id', request_type_fa_it_id);
		} 
		else if ($group_id == fa_supervisor_group_id && $purchase['DeliveryOrder']['request_type_id'] == request_type_fa_general_id) {
			$this->Session->write('Purchase.can_approve', $purchase['Purchase']['purchase_status_id'] == status_purchase_sent_to_supervisor_id ? true : false);
			$this->Session->write('Purchase.can_cancel', $purchase['Purchase']['purchase_status_id'] == status_purchase_sent_to_supervisor_id ? true : false);
			$this->Session->write('Purchase.can_reject', $purchase['Purchase']['purchase_status_id'] == status_purchase_sent_to_supervisor_id ? true : false);
		} 
		else if ($group_id == it_supervisor_group_id && $purchase['DeliveryOrder']['request_type_id'] == request_type_fa_it_id) {
			$this->Session->write('Purchase.can_approve', $purchase['Purchase']['purchase_status_id'] == status_purchase_sent_to_supervisor_id ? true : false);
			$this->Session->write('Purchase.can_cancel', $purchase['Purchase']['purchase_status_id'] == status_purchase_sent_to_supervisor_id ? true : false);
			$this->Session->write('Purchase.can_reject', $purchase['Purchase']['purchase_status_id'] == status_purchase_sent_to_supervisor_id ? true : false);
		} 
		
		$departments = $this->Purchase->Department->find('list');
		$businessTypes = $this->Purchase->Asset->BusinessType->find('list');
		$costCenters = $this->Purchase->Asset->CostCenter->find('list');
		$costCenter = $this->Purchase->Asset->CostCenter->find('list', array('fields'=>'name'));
		//$cc 			= $this->Purchase->query('select a.id,a.name,b.t24_dao from cost_centers a left join cost_center_to_daos b on b.cost_center_id = a.id where a.remarks = "Y" order by a.name');
		//foreach($cc as $data){
		//	if($data[0]['t24_dao']){
		//		$costCenter[ $data[0]['id'] ]	= $data[0]['name'] . " - " .$data[0]['t24_dao'];
		//	}else{
		//		$costCenter[ $data[0]['id'] ]	= $data[0]['name'];
		//	}				
		//}
		$departmentsub = $this->Purchase->Department->DepartmentSub->find('list');
		$departmentunit = $this->Purchase->Department->DepartmentUnit->find('list');
		if($purchase['Purchase']['delivery_order_id']==null){
			if($purchase['Purchase']['group_id'] == it_management_group_id){
				$assetCategories = $this->Purchase->Asset->AssetCategory->find('list', array('conditions'=>array('OR'=>array(array('AssetCategory.id'=>4), array('AssetCategory.id'=>10)), 'AssetCategory.asset_category_type_id !='=>2)));
			}elseif($purchase['Purchase']['group_id'] == fa_management_group_id ){
				$assetCategories = $this->Purchase->Asset->AssetCategory->find('list', array('conditions'=>array('AND'=>array(array('AssetCategory.id !='=>4), array('AssetCategory.id !='=>10)), 'AssetCategory.asset_category_type_id !='=>2)));
			}
		}else{
				$assetCategories = $this->Purchase->Asset->AssetCategory->find('list', array('conditions'=>array('AssetCategory.asset_category_type_id !='=>2)));
		}
		$locations = $this->Purchase->Asset->Location->find('list');
		//if($purchase['Purchase']['delivery_order_id']==null){
			//$currencies = $this->Purchase->Asset->Currency->find('list', array('conditions'=>array('Currency.id'=>1)));
		//}else{
			$currencies = $this->Purchase->Asset->Currency->find('list');
		//}
		$deliveryOrderDetail = $this->Purchase->DeliveryOrder->DeliveryOrderDetail->find('all');
		$status = $this->Purchase->PurchaseStatus->find('list');

		//echo '<pre>';
		//var_dump($this->Session->read('Purchase'));
		//echo '</pre>';die();
		
		$can_add_detail=$purchase['Purchase']['delivery_order_id']==null?true:false;
		//$can_add_detail=true;
		
		$this->Session->write('DeliveryOrder.id', $purchase['Purchase']['delivery_order_id']);
		
		$this->set('assets',$assets['Asset']);
		$this->set(compact('costCenter', 'costCenters', 'businessTypes', 'status', 'departmentunit', 'departmentsub', 'purchase', 'assetCategories','departments', 'locations','currencies','can_add_detail', 'deliveryOrderDetail'));
	}
	
	function print_pdf($id = null) {
	
		if (!$id) {
			$this->Session->setFlash(__('Invalid FA Register', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->write('Purchase.id',$id);
		$assets = $this->Purchase->Asset->findByPurchaseId($id);
		//var_dump($assets);
		Configure::write('debug',1);
		$purchase=$this->Purchase->read(null, $id);
		$this->Session->write('Purchase.id', $id);
		$this->set('purchase', $purchase);

		$departments = $this->Purchase->Department->find('list');
		$assetCategories = $this->Purchase->Asset->AssetCategory->find('list', array('conditions'=>array('AssetCategory.asset_category_type_id !='=>2)));
		$locations = $this->Purchase->Asset->Location->find('list');
		$currencies = $this->Purchase->Asset->Currency->find('list');
		$copyright_id = $this->configs['copyright_id'];
		$deliveryOrderDetail = $this->Purchase->DeliveryOrder->DeliveryOrderDetail->find('all');
		
		$this->set('assets',$assets['Asset']);
		$this->set(compact('copyright_id', 'assetCategories','departments', 'locations','currencies', 'deliveryOrderDetail'));
        $this->layout = 'pdf'; //this will use the pdf.ctp layout 
		$this->render(); 
	}

	function add() {
		$supplier_id		=null;
		$supplier_name		=null;
		$warranty_name		=null;
		$delivery_order_id	=null;
		$invoice_id			=null;
		$po_no				=null;
		$po_id				=null;

		if (!empty($this->data)) {			
			$startY = intval($this->data['Purchase']['warranty_year_start']['year']);
			$startM = intval($this->data['Purchase']['warranty_year_start']['month']);
			$startD = intval($this->data['Purchase']['warranty_year_start']['day']);
			
			$endY = intval($this->data['Purchase']['warranty_year_end']['year']);
			$endM = intval($this->data['Purchase']['warranty_year_end']['month']);
			$endD = intval($this->data['Purchase']['warranty_year_end']['day']);
			
			if($endY > $startY || ($endY = $startY && $endM > $startM)){
				if($endD < $startD){
					$endD = $endD + 30;
					$endM = $endM - 1;
				}
				if($endM < $startM){
					$endM = $endM + 12;
					$endY = $endY - 1;
				}
				
				$rangeD = $endD - $startD;
				$rangeM = $endM - $startM;
				$rangeY = $endY - $startY;
				
				if($rangeD > 30){
					$rangeD = $rangeD - 30;
					$rangeM = $rangeM + 1;
				}
				if($rangeM > 12){
					$rangeY = $rangeY + ($rangeM / 12);
				}
				$this->data['Purchase']['warranty_year'] = $rangeY;
				$this->data['Purchase']['warranty_month'] = $rangeM;
				
				$this->Purchase->create();
				if ($this->Purchase->save($this->data)) {
					if($delivery_order_id=$this->data['Purchase']['delivery_order_id'])
						$this->register_asset_from_do($delivery_order_id);
					else if($invoice_id=$this->data['Purchase']['invoice_id'])
						$this->register_asset_from_invoice($invoice_id);
					
					$this->Session->setFlash(__('The FA Register has been saved', true), 'default', array('class'=>'ok'));
					$this->redirect(array('action' => 'view', $this->Purchase->id ));
				} else {
					$this->Session->setFlash(__('The FA Register could not be saved. Please, try again.', true));
				}
			}else{
				$this->Session->setFlash(__('The FA Register could not be saved. Please, check the warranty dates.', true));
			}
		}
		
		if($delivery_order_id || isset($this->passedArgs['delivery_order_id']) )
		{
			if(isset($this->passedArgs['delivery_order_id'])) $delivery_order_id=$this->passedArgs['delivery_order_id'];
			$deliveryOrder 	= $this->Purchase->DeliveryOrder->read(null, $delivery_order_id);
			$supplier_id 	= $deliveryOrder['DeliveryOrder']['supplier_id'];
			$supplier_name 	= $deliveryOrder['Supplier']['supplier_info'];
			$po_no  		= $deliveryOrder['Po']['no'];
			$po_id  		= $deliveryOrder['Po']['id'];
			$currency_id	= $deliveryOrder['Po']['currency_id'];
			$currency		= $this->Purchase->Currency->read(null, $currency_id);
			$currency_name 	= $currency['Currency']['name'];
			$rp_rate 		= $currency['Currency']['rp_rate'];	
			$warranty_name	= $deliveryOrder['Supplier']['name'];
			
			
		}
		else if($invoice_id || isset($this->passedArgs['invoice_id']))
		{
			if(isset($this->passedArgs['invoice_id'])) $invoice_id=$this->passedArgs['invoice_id'];
		}
		else {
			$currency_id	= 1;
			$currency_name 	= null;
			$rp_rate 		= 1;				
		}

		$warranties = $this->Purchase->Warranty->find('list');
		$warranty_id = 2;//no waranty
		$requesters = $this->Purchase->Requester->find('list');
		$departments = $this->Purchase->Department->find('list');
		$suppliers = $this->Purchase->Supplier->find('list');
		$currencies = $this->Purchase->Currency->find('list', array('id'=>1));
		$statuses = $this->Purchase->PurchaseStatus->find('list');
		$warranty_year_start = date("Y-m-d");
		$warranty_year_end = date("Y-m-d", strtotime('+5 year'));
		
		$moduleName = 'Fixed Assets > Register > New FA Register';
		$this->set('title_for_layout',  $this->lastSegment($moduleName));
		$newId= $this->Purchase->getNewId();
				
		$this->set(compact(
			'statuses',
			'warranties', 
			'warranty_id',
			'warranty_name',
			'warranty_year_start',
			'warranty_year_end',
			'requesters', 
			'departments', 
			'currencies', 
			'currency_id', 
			'currency_name', 
			'rp_rate', 
			'suppliers',
			'supplier_id',
			'supplier_name',
			'delivery_order_id',
			'invoice_id',
			'po_no',
			'po_id',
			'newId',
			'moduleName'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid FA Register', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Purchase->save($this->data)) {
				$this->Session->setFlash(__('The FA Register has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The FA Register could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Purchase->read(null, $id);
		}
		$warranties 	= $this->Purchase->Warranty->find('list');
		$requesters 	= $this->Purchase->Requester->find('list');
		$departments 	= $this->Purchase->Department->find('list');
		$suppliers 		= $this->Purchase->Supplier->find('list');
		$statuses 		= $this->Purchase->PurchaseStatus->find('list');
		//echo "<pre>";
		//var_dump($this->data);
		//echo "</pre>";die();
		
		$warranty_year_start = date("Y-m-d");
		$warranty_year_end = $this->data['Warranty']['warranty_year']."-".$this->data['Warranty']['warranty_month']."-".date("d");
		
		$supplier_info = $this->data['Supplier']['supplier_info'];
		$warranty_info = $this->data['Warranty']['warranty_info'];

		$this->set(compact('statuses', 'warranties', 'requesters', 'departments', 'suppliers', 'currencies', 'supplier_info', 'warranty_info', 'warranty_year_start','warranty_year_end'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid FA Register', true));
			$this->redirect(array('action'=>'index'));
		}
		$purchase = $this->Purchase->read(null, $id);
		
		$this->Purchase->DeliveryOrder->id = $purchase['Purchase']['delivery_order_id'];
		$this->Purchase->DeliveryOrder->set('convert_asset', 0);
		$this->Purchase->DeliveryOrder->save();
		
		$sql = 'delete from assets where assets.purchase_id = "'.$id.'"';
		$this->Purchase->query($sql);
		
		$sql = 'delete from asset_details where asset_details.purchase_id = "'.$id.'"';
		$this->Purchase->query($sql);
		
		if ($this->Purchase->delete($id)) {
			$this->Session->setFlash(__('FA Register deleted', true), 'default', array('class'=>'ok'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('FA Register was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

	function reports($type='fa') {
		$this->Purchase->recursive =3;
		$layout=$this->data['Purchase']['layout'];
		$conditions=array();
		if(!empty($this->data))
			$this->Session->write('AssetReport.department_id',$this->data['Purchase']['department_id']);
		if($department_id = $this->Session->read('AssetReport.department_id'))
			$conditions['Asset.department_id'] = $department_id;

		$departments = $this->Purchase->Department->find('list');
		$AssetCategory = new AssetCategory;
		$assetCategories = $AssetCategory->find('list');
		if($layout=='pdf' || $layout=='xls'){
		$purchases = $this->Purchase->find('all', array('conditions'=>$conditions));
		}else{
		$purchases = $this->paginate($conditions);
		}
		$this->set('purchases', $purchases);
		$this->set(compact(
			'departments',
			'assetCategories',
			'department_id'));	

		
		if($layout=='pdf')
		{
			Configure::write('debug',0); // Otherwise we cannot use this method while developing 
			$this->layout = 'pdf'; //this will use the pdf.ctp layout 
			$this->render('report_fa_pdf'); 		
		}
		else if($layout=='xls')
		{
		$this->render('report_fa_xls','export_xls');		

		}else
		$this->render('report_'.$type);
	}

	function register_asset_from_do($id=null) 
	{
		if (!$id) {
			$this->Session->setFlash(__('Invalid DeliveryOrder', true));
			$this->redirect(array('action' => 'index'));
		}
		
		$deliveryOrder 	= $this->Purchase->DeliveryOrder->read(null, $id);
		$purchase_id 	= $this->Purchase->id;
		
		$currency_id 	= $this->data['Purchase']['currency_id'];
		$rp_rate	 	= $this->data['Purchase']['rp_rate'];
		$warranty_name	 	= $this->data['Purchase']['warranty_name'];
		$warranty_year	 	= $this->data['Purchase']['warranty_year'];
		$date_of_purchase = $this->data['Purchase']['date_of_purchase'];
		//$date_of_purchase = $date_of_purchase['year'] . '-' . $date_of_purchase['month'] . '-' . $date_of_purchase['day'] ;

		//save assets
		$detail['Asset'] = $deliveryOrder['DeliveryOrderDetail'];
		foreach ($detail['Asset'] as $a)
		{
			
			$data['Asset'] 					= $a;
			$data['Asset']['purchase_id']	= $purchase_id;
			$data['Asset']['currency_id']	= $currency_id;
			$data['Asset']['warranty_name']	= $warranty_name;
			$data['Asset']['warranty_year']	= $warranty_year;
			$data['Asset']['delivery_order_detail_id']	= $a['id'];
			$data['Asset']['delivery_order_id']			= $a['delivery_order_id'];
			unset($data['Asset']['id']);
			//$qty   							= $data['Asset']['qty'];
			$qty							= $a['qty_received'];
			if ($qty==0) continue;
			$data['Asset']['qty']			= $qty;
			$data['Asset']['price'] 		= round($a['amount_nett'] / $qty * $rp_rate);
			$data['Asset']['price_cur'] 	= $a['amount_nett_cur'] / $qty;
			$data['Asset']['amount'] 		= round($a['amount_nett'] * $rp_rate);
			$data['Asset']['amount_cur'] 	= $a['amount_nett_cur'] ;
			//$data['Asset']['ada'] 			= 'Y';
			$data['Asset']['ada'] 			= 'T';
			$data['Asset']['blnini'] 		= '1';// apa ini?????
			$maksi 							= $data['Asset']['umurek'] * 12;
			if($maksi==0){
				$data['Asset']['maksi']		= 0;
				$data['Asset']['depbln'] 	= 0;
			}
			else{
				$data['Asset']['maksi'] 	= $maksi;
				$data['Asset']['depbln'] 	= $data['Asset']['amount'] / $maksi ;
			}
			$data['Asset']['date_of_purchase'] = $this->data['Purchase']['date_of_purchase'];
			
			$year = substr($deliveryOrder['DeliveryOrder']['do_date'],0,4);
			$data['Asset']['code'] 	= $this->Purchase->Asset->getNewId($a['asset_category_id'], $date_of_purchase, $a['department_id'], $a['item_code'] );
			$data['Asset']['year'] 			= $year;			
			$this->log('register_asset_from_do:data='.var_export($data,true));
			$this->Purchase->Asset->create();
			if ($this->Purchase->Asset->save($data)) {
				$asset_id = $this->Purchase->Asset->id;
				$this->Session->setFlash(__('The asset has been saved', true), 'default', array('class'=>'ok'));
				
				//asset details...
				$data_details['AssetDetail'] = $data['Asset'];
				unset($data_details['AssetDetail']['id']);
				for ($i=0; $i<$qty; $i++)
				{
					$assetDetail = new AssetDetail;
					$data_details['AssetDetail']['asset_id'] 	= $asset_id ;
					//$data_details['AssetDetail']['code'] 		= $code . '-'. sprintf("%03d",$this->Purchase->Asset->AssetDetail->getNewId($code));
					$data_details['AssetDetail']['code'] 		= $assetDetail->getNewId($data_details['AssetDetail']['asset_category_id'], $date_of_purchase, $data_details['AssetDetail']['department_id'] , $data_details['AssetDetail']['item_code']);
					if($maksi==0)
						$data_details['AssetDetail']['depbln'] 		= 0;
					else
						$data_details['AssetDetail']['depbln'] 		= $data_details['AssetDetail']['price']/$maksi;
					$data_details['AssetDetail']['price'] 		= $a['amount_nett'] / $qty * $rp_rate;
					$data_details['AssetDetail']['price_cur'] 	= $a['amount_nett_cur'] / $qty ;					

					$this->Purchase->Asset->AssetDetail->create();
					if ($this->Purchase->Asset->AssetDetail->save($data_details)) {
						
					}
				}				
			} else {
				$this->Session->setFlash(__('The asset could not be saved. Please, try again.', true));
			}
		}
		
		$deliveryOrder['DeliveryOrder']['status_delivery_order_id']=status_delivery_order_registered_id;
		$deliveryOrder['DeliveryOrder']['convert_asset']=1;
		$this->Purchase->DeliveryOrder->save($deliveryOrder);
		$this->redirect(array('controller'=>'purchases','action' => 'view', $purchase_id ));

	}	
	
	function register_asset_from_invoice($id=null) 
	{
		if (!$id) {
			$this->Session->setFlash(__('Invalid invoice', true));
			$this->redirect(array('action' => 'index'));
		}
		
		$purchase=array();
		$inv = $this->Invoice->read(null, $id);
		$purchase['Purchase'] = $inv['Invoice'];
		unset($purchase['Purchase']['id']);
		
		$po_nos = $this->to_string($inv['Po'], 'no');
		
		//save purchase
		$purchase['Purchase']['no']				=$this->Invoice->Purchase->getNewId();
		$purchase['Purchase']['warranty_id']	='1';
		$purchase['Purchase']['requester_id']	='1';
		$purchase['Purchase']['department_id']	='1';
		$purchase['Purchase']['date_of_purchase']=$inv['Invoice']['inv_date'];
		$purchase['Purchase']['invoice_no']		= $inv['Invoice']['no'];
		$purchase['Purchase']['po_no']			= $po_nos;
		$date_of_purchase	 = $purchase['Purchase']['date_of_purchase'];
		
		$this->Invoice->Purchase->create();
		if ($this->Invoice->Purchase->save($purchase)) {
			$purchase['Purchase']['id'] = $this->Invoice->Purchase->id;
			$this->Session->setFlash(__('The FA Register has been saved', true), 'default', array('class'=>'ok'));
		} else {
			$this->Session->setFlash(__('The FA Register could not be saved. Please, try again.', true));
			$this->redirect(array('action' => 'view', $id));
		}
		
		$purchase_id = $this->Invoice->Purchase->id;

		//save asset 
		$detail['Asset'] = $inv['InvoiceDetail'];
		//var_dump($inv);
		foreach ($detail['Asset'] as $a)
		{
			
			$data['Asset'] 					= $a;
			$data['Asset']['purchase_id']	= $purchase_id;
			$data['Asset']['invoice_id']	= $inv['Invoice']['id'];
			unset($data['Asset']['id']);
			$qty   							= $data['Asset']['qty'];
			$data['Asset']['price'] 		= $a['amount_nett'] / $qty;
			$data['Asset']['price_cur'] 	= $a['amount_nett_cur'] / $qty;
			$data['Asset']['amount'] 		= $a['amount_nett'] ;
			$data['Asset']['amount_cur'] 	= $a['amount_nett_cur'] ;
			$data['Asset']['ada'] 			= 'Y';
			$data['Asset']['blnini'] 		= '1';
			$maksi 							= $data['Asset']['umurek'] * 12;
			$data['Asset']['maksi']			= $maksi;
			$data['Asset']['depbln'] 	= $data['Asset']['amount'] / $maksi ;
			$data['Asset']['date_of_purchase'] = $purchase['Purchase']['date_of_purchase'];
			
			if($inv['Invoice']['status_invoice_id'] == status_invoice_posted_payment_journal_id)
			{
				$data['Asset']['date_start']    = $inv['Invoice']['paid_date'];
				$data['Asset']['date_end']      = date('Y-m-d',strtotime('+ '.($maksi-1).' months', strtotime($inv['Invoice']['paid_date'])));
			}
			
			$year = substr($inv['Invoice']['inv_date'],0,4);
			$code = $data['Asset']['code'] 	= $this->Invoice->Purchase->Asset->getNewId($a['asset_category_id'], $date_of_purchase, $a['department_id'] , $a['item_code']);
			$data['Asset']['year'] 			= $year;
			$data['Asset']['no_npb'] 		= $data['Asset']['npb_id'];
			$data['Asset']['no_po'] 		= $data['Asset']['po_id'];
			
			$this->log('register_asset:data='.var_export($data,true));
			$this->Invoice->Purchase->Asset->create();
			if ($this->Invoice->Purchase->Asset->save($data)) {
				$asset_id = $this->Invoice->Purchase->Asset->id;
				$this->Session->setFlash(__('The FA Register has been saved', true), 'default', array('class'=>'ok'));
				
				//asset details...
				$data_details['AssetDetail'] = $data['Asset'];
				unset($data_details['AssetDetail']['id']);
				for ($i=0; $i<$qty; $i++)
				{
					$data_details['AssetDetail']['asset_id'] 	= $asset_id ;
					//$data_details['AssetDetail']['code'] 		= $code . '-'. sprintf("%03d",$this->Invoice->Purchase->Asset->AssetDetail->getNewId($code));
					$data_details['AssetDetail']['code'] 		= $this->Invoice->Purchase->Asset->AssetDetail->getNewId($data_details['AssetDetail']['asset_category_id'], $date_of_purchase, $data_details['AssetDetail']['department_id'], $data_details['AssetDetail']['item_code'] );
					$data_details['AssetDetail']['depbln'] 		= $data_details['AssetDetail']['price']/$maksi;
					$data_details['AssetDetail']['price'] 		= $a['amount_nett'] / $qty;
					$data_details['AssetDetail']['price_cur'] 	= $a['amount_nett_cur'] / $qty ;					

					$this->Invoice->Purchase->Asset->AssetDetail->create();
					if ($this->Invoice->Purchase->Asset->AssetDetail->save($data_details)) {
						
					}
				}				
			} else {
				$this->Session->setFlash(__('The FA Register could not be saved. Please, try again.', true));
			}
		}
		
		$inv['Invoice']['status_invoice_id']=status_invoice_registered_id;
		$inv['Invoice']['convert_asset']=1;
		$this->Invoice->save($inv);
		
		$this->redirect(array('controller'=>'purchases','action' => 'view', $purchase['Purchase']['id'] ));
	}
	
	function update_status($id = null, $status_purchase_id) {
		if (!$id) {
			  $this->Session->setFlash(__('Invalid FA Register', true));
			  $this->redirect(array('action' => 'index'));
		}
		$purchase = $this->Purchase->read(null, $id);
		foreach($purchase['Asset'] as $asset){
			if(!empty($asset)){
			/* update status */
			$this->data['Purchase']['id'] = $id;
			$this->data['Purchase']['purchase_status_id'] = $status_purchase_id;
			/*kalau sudah approved, finishkan register fa && update asset dan detail 'Y'*/
			if ($status_purchase_id == status_purchase_approved_id) {
				if (!($id)) {
					$this->Session->setFlash(__('Failed to process the FA Register. Please, try again.', true));
					$this->redirect(array('action' => 'index'));
				}else {
					$this->data['Purchase']['id'] = $id;
					$this->data['Purchase']['purchase_status_id'] = status_purchase_finish_id;
					
					//update asset ada='Y'
					$sql='UPDATE assets SET ada="Y" WHERE assets.purchase_id='. $id ;
					$this->Purchase->query($sql);
					
					//update asset_detail ada='Y'
					$sql='UPDATE asset_details SET ada="Y" WHERE asset_details.purchase_id='. $id ;
					$this->Purchase->query($sql);
					
					if($purchase['Purchase']['delivery_order_id']==null){
						//update asset date start dan date end'\
						$sql = 'select * from assets where assets.purchase_id='. $id ;
						$asset_id = $this->Purchase->query($sql);
						foreach($asset_id as $assetss){
							foreach($assetss as $asset_ID){
							$this->Purchase->Asset->id = $asset_ID['id'];
							$this->Purchase->Asset->set('date_start', $asset_ID['date_of_purchase']);
							$this->Purchase->Asset->set('date_end', date('Y-m-d', strtotime('+ ' . ($asset_ID['maksi'] + 0) . ' months', strtotime($asset_ID['date_of_purchase']))));
							$this->Purchase->Asset->save();
							}
						}
						
						$sql = 'select * from asset_details where asset_details.purchase_id='. $id ;
						$asset_detail_id = $this->Purchase->query($sql);
						
						foreach($asset_detail_id as $detailxx){
							foreach($detailxx as $detail){
							$this->Purchase->AssetDetail->id = $detail['id'];
							$this->Purchase->AssetDetail->set('date_start', $detail['date_of_purchase']);
							$this->Purchase->AssetDetail->set('date_end', date('Y-m-d', strtotime('+ ' . ($detail['maksi'] + 0) . ' months', strtotime($detail['date_of_purchase']))));
							$this->Purchase->AssetDetail->save();
												
							}
						}
					}
				}					
			}
		if ($this->Purchase->save($this->data)) {
			  $this->Session->setFlash(__('The FA Register has been saved', true), 'default', array('class' => 'ok'));
			  $this->redirect(array('action' => 'index'));
		} else {
			  $this->Session->setFlash(__('The FA Register could not be saved. Please, try again.', true));
		}
			}
		}

		$this->Session->setFlash(__('The FA Register could not be saved. Please, try again.', true));
		$this->redirect(array('action' => 'view', $id));
	}
	
	function cancel($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid FA Register', true));
			$this->redirect(array('action' => 'index'));
		}
		$group_id = $this->Session->read('Security.permissions');
		$this->Session->write('Purchase.id',$id);
		$assets = $this->Purchase->Asset->findByPurchaseId($id);
		
		//$purchase=$this->Purchase->read(null, $id);
		
		//Add Notes Cancel Purchase and Change Status
		if (!empty($this->data)) {
			  $this->data['Purchase']['id'] = $id;
			  $this->data['Purchase']['purchase_status_id'] = status_purchase_draft_id;
			  if ($this->Purchase->save($this->data)) {
					$this->Session->setFlash(__('The FA Register has been saved', true), 'default', array('class' => 'ok'));
					$this->redirect(array('action' => 'index'));
			  } else {
					$this->Session->setFlash(__('The FA Register could not be saved. Please, try again.', true));
			  }
		}
		if (empty($this->data)) {
			  $purchase = $this->data = $this->Purchase->read(null, $id);
		}
		
		$departments = $this->Purchase->Department->find('list');
		$departmentsub = $this->Purchase->Department->DepartmentSub->find('list');
		$departmentunit = $this->Purchase->Department->DepartmentUnit->find('list');
		$assetCategories = $this->Purchase->Asset->AssetCategory->find('list', array('conditions'=>array('AssetCategory.asset_category_type_id !='=>2)));
		$locations = $this->Purchase->Asset->Location->find('list');
		$currencies = $this->Purchase->Asset->Currency->find('list');
		$deliveryOrderDetail = $this->Purchase->DeliveryOrder->DeliveryOrderDetail->find('all');
		$status = $this->Purchase->PurchaseStatus->find('list');
		
		$can_add_detail=$purchase['Purchase']['delivery_order_id']==null?true:false;
		
		$this->set('assets',$assets['Asset']);
		$this->set(compact('status', 'departmentunit', 'departmentsub', 'purchase', 'assetCategories','departments', 'locations','currencies','can_add_detail', 'deliveryOrderDetail'));
	}
	
	function reject($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid FA Register', true));
			$this->redirect(array('action' => 'index'));
		}
		$group_id = $this->Session->read('Security.permissions');
		$this->Session->write('Purchase.id',$id);
		$assets = $this->Purchase->Asset->findByPurchaseId($id);
		
		//$purchase=$this->Purchase->read(null, $id);
		
		//Add Notes Reject Purchase and Change Status
		if (!empty($this->data)) {
			  $this->data['Purchase']['id'] = $id;
			  $this->data['Purchase']['purchase_status_id'] = status_purchase_reject_id;
			  if ($this->Purchase->save($this->data)) {
					$this->Session->setFlash(__('The FA Register has been saved', true), 'default', array('class' => 'ok'));
					$this->redirect(array('action' => 'index'));
			  } else {
					$this->Session->setFlash(__('The FA Register could not be saved. Please, try again.', true));
			  }
		}
		if (empty($this->data)) {
			  $purchase = $this->data = $this->Purchase->read(null, $id);
		}
		
		$departments = $this->Purchase->Department->find('list');
		$departmentsub = $this->Purchase->Department->DepartmentSub->find('list');
		$departmentunit = $this->Purchase->Department->DepartmentUnit->find('list');
		$assetCategories = $this->Purchase->Asset->AssetCategory->find('list', array('conditions'=>array('AssetCategory.asset_category_type_id !='=>2)));
		$locations = $this->Purchase->Asset->Location->find('list');
		$currencies = $this->Purchase->Asset->Currency->find('list');
		$deliveryOrderDetail = $this->Purchase->DeliveryOrder->DeliveryOrderDetail->find('all');
		$status = $this->Purchase->PurchaseStatus->find('list');
		
		$can_add_detail=$purchase['Purchase']['delivery_order_id']==null?true:false;
		
		$this->set('assets',$assets['Asset']);
		$this->set(compact('status', 'departmentunit', 'departmentsub', 'purchase', 'assetCategories','departments', 'locations','currencies','can_add_detail', 'deliveryOrderDetail'));
	}
	
	function archive($id = null, $status_purchase_id) {
		if (!$id) {
			  $this->Session->setFlash(__('Invalid FA Register', true));
			  $this->redirect(array('action' => 'index'));
		}
		
		/* update status */
		$this->data['Purchase']['id'] = $id;
		$this->data['Purchase']['purchase_status_id'] = $status_purchase_id;
		
		/*kalau sudah approved, finishkan register fa && update asset dan detail 'Y'*/
		if ($status_purchase_id == status_purchase_archive_id) {
			if (!($id)) {
				$this->Session->setFlash(__('Failed to process the FA Register. Please, try again.', true));
				$this->redirect(array('action' => 'index'));
			}
			else
				$this->data['Purchase']['id'] = $id;
				$this->data['Purchase']['purchase_status_id'] = status_purchase_archive_id;
				
				//delete assets
				$sql = 'delete from assets where purchase_id=' . $id;
				$this->Purchase->query($sql);
				
				//delete asset_details
				$sql = 'delete from asset_details where purchase_id="' . $id . '"';
				$this->Purchase->query($sql);
				
				//update delivery_orders convert_asset='0'
				//$delivery_order_id = $purchase['Purchase']['delivery_order_id'];
				$sql='UPDATE delivery_orders SET convert_asset="0" WHERE delivery_orders.id='. $this->Session->read('DeliveryOrder.id') ;
				$this->Purchase->query($sql);
		}

		if ($this->Purchase->save($this->data)) {
			  $this->Session->setFlash(__('The FA Register has been saved', true), 'default', array('class' => 'ok'));
			  $this->redirect(array('action' => 'index'));
		} else {
			  $this->Session->setFlash(__('The FA Register could not be saved. Please, try again.', true));
		}

		$this->Session->setFlash(__('The FA Register has been saved', true), 'default', array('class' => 'ok'));
		$this->redirect(array('action' => 'index'));
	}
	
}
?>