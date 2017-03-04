<?php
App::import('Sanitize','Item');
class PosController extends AppController {
	var $name = 'Pos';
	var $helpers = array('Html','Ajax','Javascript','Number','Time');
	var $components = array( 'RequestHandler' );
	
	function index($po_status_id=null, $no=null, $po_department_id=null, $supplier_id=null, $is_done=null) {
		Configure::write('debug',1);
		$id_group=$this->Session->read('Security.permissions');
		$this->Po->recursive = 1;
		$layout=$this->data['Po']['layout'];
		if($id_group == po_approval1_group_id)
			$conditions = array(
				'OR'=>array(
					array('po_status_id'=>status_po_request_for_approval_id),
					array('po_status_id'=>status_po_reject_id),
					array('po_status_id'=>status_po_approved_1_id),
					array('po_status_id'=>status_po_sent_id),
					array('po_status_id'=>status_po_cancel_id),
					array('po_status_id'=>status_po_request_cancel_id),
					array('po_status_id'=>status_po_cancel_level_1_id)
				)
			);
			
		elseif($id_group == po_approval2_group_id)
			$conditions = array(
				'OR'=>array(
					array('po_status_id'=>status_po_approved_1_id),
					array('po_status_id'=>status_po_reject_id),
					array('po_status_id'=>status_po_approved_2_id),
					array('po_status_id'=>status_po_cancel_id),
					array('po_status_id'=>status_po_request_cancel_id),
					array('po_status_id'=>status_po_cancel_level_1_id),
					array('po_status_id'=>status_po_cancel_level_2_id)
				)
			);		
		elseif($id_group == po_approval3_group_id)
			$conditions = array(
				'OR'=>array(
					array('po_status_id'=>status_po_approved_2_id),
					array('po_status_id'=>status_po_reject_id),
					array('po_status_id'=>status_po_approved_3_id),
					array('po_status_id'=>status_po_cancel_id),
					array('po_status_id'=>status_po_request_cancel_id),
					array('po_status_id'=>status_po_cancel_level_1_id),
					array('po_status_id'=>status_po_cancel_level_2_id),
					array('po_status_id'=>status_po_cancel_level_3_id)
				)
			);
			
		elseif($id_group == fincon_group_id)
			$conditions = array(
				'OR'=>array(
					array('po_status_id'=>status_po_approved_3_id),
					array('po_status_id'=>status_po_sent_id),
					array('po_status_id'=>status_po_cancel_id),
					array('po_status_id'=>status_po_cancel_level_2_id),
					array('po_status_id'=>status_po_finish_id)
				)
			); 	
		elseif($id_group == admin_group_id || $id_group = gs_group_id)
			$conditions = array();
			
		//set up filters session
		if($po_status_id)
			$this->Session->write('Po.po_status_id',$po_status_id);
		else if(isset($this->data['Po']['po_status_id']))
			$this->Session->write('Po.po_status_id',$this->data['Po']['po_status_id']);
		if($po_status_id=$this->Session->read('Po.po_status_id')) 
			$conditions[] = array('po_status_id'=>$po_status_id);
		
		//is done filter
		if($is_done)
			$this->Session->write('Po.is_done',$is_done);
		else if(isset($this->data['Po']['is_done']))
			$this->Session->write('Po.is_done',$this->data['Po']['is_done']);
		if($is_done=$this->Session->read('Po.is_done'))
			$conditions[] = array('is_done'=>$is_done);
				
		if(DRIVER=='mysql') {
			if($is_done==1)
				$conditions[] = array('(SELECT if(sum(qty-qty_received)=0, 1, 0) FROM po_details WHERE po_details.po_id = Po.id) = 1' ); 
			else if($is_done==2)
				$conditions[] = array('(SELECT if(sum(qty-qty_received)=0, 1, 0) FROM po_details WHERE po_details.po_id = Po.id) = 0' ); 
		}                
        elseif(DRIVER=='mssql') {
			if($is_done==1)
				$conditions[] = array('(select case sum(qty-qty_received) when 0 then 1 else 0 end 
                                   from po_details WHERE po_details.po_id = Po.id) = 1' ); 
			else if($is_done==2)
				$conditions[] = array('(select case sum(qty-qty_received) when 0 then 1 else 0 end 
                                   from po_details WHERE po_details.po_id = Po.id) = 0' ); 
		}
		$conditions[] = array('po_status_id !='=>status_po_archive_id); //archive
		$this->paginate = array('order'=>'Po.id');
		//set up filters supplier_id
		if($supplier_id)
			$this->Session->write('Po.supplier_id',$supplier_id);
		else if(isset($this->data['Po']['supplier_id']))
			$this->Session->write('Po.supplier_id',$this->data['Po']['supplier_id']);
		if($supplier_id=$this->Session->read('Po.supplier_id')) 
			$conditions[] = array('supplier_id'=>$supplier_id);
		
		// number filter
		/* 
		if(isset($this->data['Po']['no']))
				if(trim($this->data['Po']['no']) == '')
				$this->data['Po']['no']=null;
			$this->Session->write('Po.no', $this->data['Po']['no']);
			if ($no = $this->Session->read('Po.no'))
				$conditions[] = array('Po.no LIKE' => '%'. $no . '%'); 
		*/
		
		if ($no)
            $this->Session->write('Po.no', trim($no));
		else if (isset($this->data['Po']['no']))
			$this->Session->write('Po.no', trim($this->data['Po']['no']));
		if ($no = $this->Session->read('Po.no'))
			$conditions[] = array('Po.no LIKE' => '%'. $no . '%');
		
		///date filter		
		list($date_start,$date_end) = $this->set_date_filters('Po');
		$conditions[] = array('po_date >=' => ($date_start['year'] . '-' . $date_start['month'] . '-' . $date_start['day']) , 
				'po_date <=' => ($date_end['year'] . '-' . $date_end['month'] . '-' . $date_end['day']) );
		
		if($layout=='pdf' || $layout=='xls'){
			$con = $this->Po->find('all', array('conditions'=>$conditions, 'order'=>'Po.id'));
		}else{
			$con = $this->paginate($conditions);
		}
		$this->set('pos', $con);
		$copyright_id  = $this->configs['copyright_id'];
		$invoices = $this->Po->Invoice->find('list');		
		$invoice_statuses = $this->Po->Invoice->InvoiceStatus->find('list');		
		$po_statuses = $this->Po->PoStatus->find('list', array('conditions' =>array('id !=' => status_po_archive_id))); //archive);
		$suppliers = $this->Po->Supplier->find('list');
		$moduleName = 'PO > List PO';
		$this->set('title_for_layout',  $this->lastSegment($moduleName));
		$this->set(compact('po_statuses', 
			'date_start','date_end',
			'suppliers', 'copyright_id'
			, 'invoices', 'invoice_statuses', 'moduleName'
			));
		
		if($layout=='pdf')
		{
			Configure::write('debug',1); // Otherwise we cannot use this method while developing 
			$this->layout = 'pdf'; //this will use the pdf.ctp layout 
			$this->render('index_pdf'); 		
		}
		else if($layout=='xls')
		{
			$this->render('index_xls','export_xls');
		}
	}
	
	function ajax_view($id=null)
	{
		$this->layout='ajax';
		$this->autoRender=false;
		$po=$this->Po->read(null, $id);
		echo json_encode(array('data'=>$po));
		
	}

	function view($id = null) {
		Configure::write('debug',1);
		if (!$id) {
			$this->Session->setFlash(__('Invalid po', true));
			$this->redirect(array('action' => 'index'));
		}
		$po = $this->Po->read(null, $id);
		$this->Session->write('Po.id', $id);

		$id_group=$this->Session->read('Security.permissions');
		
		// can Print PO?
		if( $id_group==gs_group_id && ($po['Po']['po_status_id']==status_po_request_for_approval_id 
				|| $po['Po']['po_status_id']==status_po_approved_1_id
				|| $po['Po']['po_status_id']==status_po_approved_2_id
				|| $po['Po']['po_status_id']==status_po_approved_3_id
				|| $po['Po']['po_status_id']==status_po_finish_id
				|| $po['Po']['po_status_id']==status_po_sent_id
				|| $po['Po']['po_status_id']==status_po_cancel_id
			))
			$this->Session->write('Po.can_print', true);
		else
			$this->Session->write('Po.can_print', false);

		// can edit PO ?
		if((($po['Po']['po_status_id'] == status_po_draft_id || $po['Po']['po_status_id'] == status_po_cancel_id ) && $id_group == gs_group_id) ||
			$id_group == admin_group_id)
			$this->Session->write('Po.can_edit', true);
		else 
			$this->Session->write('Po.can_edit', false);

		// can input invoice, status sent 
		if($id_group==gs_group_id && $po['Po']['po_status_id']==status_po_sent_id )
		{
			//utk tipe FA, harus sudah ada barang yang diconvert jadi FA
			if($po['Po']['request_type_id']==request_type_fa_it_id || $po['Po']['request_type_id']==request_type_fa_general_id)
			{
				$do_converted=0;
				foreach($po['DeliveryOrder'] as $do)
				{
					$do_converted += $do['convert_asset'];
				}
				if($do_converted>0)
					$this->Session->write('Po.can_invoice', true);
				else
					$this->Session->write('Po.can_invoice', false);
				
			}
			else //tipe stock dan service
			{
				$this->Session->write('Po.can_invoice', true);
			}
		}
		else
			$this->Session->write('Po.can_invoice', false);			

		/// PO Reject status_po_request_for_approval_id login po_approval1_group_id
		if($po['Po']['po_status_id']==status_po_request_for_approval_id && $id_group==po_approval1_group_id)
			$this->Session->write('Po.can_reject', true);
		/// PO Reject status_po_approved_2_id login gs_group_id
		elseif($po['Po']['po_status_id']==status_po_approved_1_id && $id_group==po_approval2_group_id)
			$this->Session->write('Po.can_reject', true);
		/// PO Reject status_po_approved_3_id login gs_group_id
		// elseif($po['Po']['po_status_id'] == status_po_approved_3_id && $id_group==gs_group_id)
			// $this->Session->write('Po.can_reject', true);
		else
			$this->Session->write('Po.can_reject', false);	
			
		//Po Cancel
		if($po['Po']['po_status_id']==status_po_request_for_approval_id && $id_group==po_approval1_group_id)
			$this->Session->write('Po.can_cancel', true);
		elseif($po['Po']['po_status_id']==status_po_approved_1_id && $id_group==po_approval2_group_id)
			$this->Session->write('Po.can_cancel', true);
		else
		$this->Session->write('Po.can_cancel', false);
		
		/// Po can_reject_notes
		if((!empty($po['Po']['reject_notes']) && $id_group == gs_group_id) ||
			$id_group == admin_group_id)
			$this->Session->write('Po.can_reject_notes', true);
		else if((!empty($po['Po']['reject_notes']) && $id_group == po_approval1_group_id) ||
			$id_group == admin_group_id)
			$this->Session->write('Po.can_reject_notes', true);
		else
			$this->Session->write('Po.can_reject_notes', false);
			
		/// Po can_cancel_notes
		if((!empty($po['Po']['cancel_notes']) && $id_group == gs_group_id) ||
			$id_group == admin_group_id)
			$this->Session->write('Po.can_cancel_notes', true);
		else if((!empty($po['Po']['cancel_notes']) && $id_group == po_approval1_group_id) ||
			$id_group == admin_group_id)
			$this->Session->write('Po.can_cancel_notes', true);
		else
			$this->Session->write('Po.can_cancel_notes', false);
			
		// can add more details 
		if( $id_group==gs_group_id && ($po['Po']['po_status_id'] == status_po_sent_id) )
			$this->Session->write('Po.can_receive', true);
		else
			$this->Session->write('Po.can_receive', false);	
		// can view down payment

		// can can_archive 
		if( $id_group==gs_group_id && 
			($po['Po']['po_status_id'] == status_po_reject_id) )
			$this->Session->write('Po.can_archive', true);
		else
			$this->Session->write('Po.can_archive', false);	
			
			
		// can generate journal down payment
		// if( $id_group==fincon_group_id && 
			// ($po['Po']['po_status_id']==status_po_finish_id || $po['Po']['po_status_id']==status_po_sent_id )
			// && $po['Po']['down_payment'] > 0 
			// && $po['Po']['is_down_payment_journal_generated'] == 0) 
			// $this->Session->write('Po.can_down_payment_journal', true);
		// else
			// $this->Session->write('Po.can_down_payment_journal', false);	
		$this->Session->write('Po.can_down_payment_journal', false);
			
		// can view down payment			
		$approveLink = $this->get_approve_link($id, $po, $id_group);
		$cancelLink = $this->get_cancel_link($id, $po, $id_group);
		$assetCategories = $this->Po->PoDetail->AssetCategory->find('list', array('conditions'=>array('asset_category_type_id !='=>2)));
		$stockAssetCategories = $this->Po->PoDetail->AssetCategory->find('list', array('conditions'=>array('asset_category_type_id'=>2)));
		//set view vars
		//$npbs = $this->Po->Npb->find('list');		
		$departments = $this->Po->Department->find('list');		
		$suppliers = $this->Po->Supplier->find('list');		
		$invoices = $this->Po->Invoice->find('list');		
		$invoice_statuses = $this->Po->Invoice->InvoiceStatus->find('list');		
		$currencies = $this->Po->Currency->find('list');		
		$npbStatuses = $this->Po->Npb->NpbStatus->find('list');
		
		$n = 0;
		foreach($po['PoDetail'] as $it){
			$itemId[] = $it['item_id'];
			if($it['qty'] < $it['qty_received']){				
				$this->Po->query('update po_details set qty_received = "'.$it['qty'].'" where id = "'.$it['id'].'" ');				
			}
		};
		$Item = $this->Po->PoDetail->Item->find('all', array('fields'=>array('Item.id','Item.price','Item.avg_price'),'conditions'=>array('Item.id'=>$itemId)));
		
		foreach($Item as $ite){
			$po['Item'][] = $ite['Item'];
		};
		
		$n = 0;
		foreach($po['PoDetail'] as $poDetail){
			$res	= $this->Po->query("select count(*) as total from npbs where id = '".$poDetail['npb_id']."' ");
			$total 	= $res[0][0]['total'];
			if($total > 0){
				$res	= $this->Po->query('select no from npbs where id = '.$poDetail['npb_id']);
				$po['PoDetail'][$n]['npb_no']	= $res[0][0]['no'];
			}else{
				$po['PoDetail'][$n]['npb_no']	= null;
				$po['PoDetail'][$n]['npb_id']	= null;
			}
			
			$n++;
		}
		
		//echo "<pre>";
		//var_dump($po);
		//echo "</pre>";die();
		
		//$places = $po['Po']['currency_id']==1?-1:2;
		$places = $this->getPlaces($po['Currency']['is_desimal']);
		//echo "<pre>";
		
		$this->set(compact('po',
			/*'npbs',*/
			'invoices',
			'invoice_statuses',
			'departments', 
			'suppliers',
			'currencies',
			'approveLink',
			'npbStatuses',
			'stockAssetCategories',
			'places',
			'assetCategories',
			'cancelLink'));
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
	
	function get_approve_link($id, $po, $id_group)
	{

		//if can approve PO directly / under auth amount
		$group			= $this->Po->query('select * from groups where id="'.$id_group.'"');
		$rp_rate		= $po['Currency']['rp_rate'];
		if(DRIVER == 'mysql'){
			$auth_amount 	= $group[0]['groups']['auth_amount'];
		} elseif(DRIVER == 'mssql'){
			$auth_amount 	= $group[0][0]['auth_amount'];
		}
		
		if($auth_amount > $po['Po']['total_cur']*$rp_rate && $po['Po']['total_cur']*$rp_rate >= 0 
			&& $po['Po']['po_status_id']==status_po_request_for_approval_id && $id_group  == po_approval1_group_id)
		{
			$approveLink = array('label'=>__('Finish PO',true),
			'options'=>array('action' => 'approve_po/'.status_po_finish_id , $id)); 		
		}
		else if($auth_amount > $po['Po']['total_cur']*$rp_rate && $po['Po']['total_cur']*$rp_rate > 0 
			&& $po['Po']['po_status_id']==status_po_approved_1_id && $id_group  == po_approval2_group_id)
		{
			$approveLink = array('label'=>__('Finish PO',true),
			'options'=>array('action' => 'approve_po/'.status_po_finish_id , $id)); 		
		}
		else if($auth_amount > $po['Po']['total_cur']*$rp_rate && $po['Po']['total_cur']*$rp_rate > 0 
			&& $po['Po']['po_status_id']==status_po_approved_2_id && $id_group  == po_approval3_group_id)
		{
			$approveLink = array('label'=>__('Finish PO',true),
			'options'=>array('action' => 'approve_po/'.status_po_finish_id , $id)); 		
		}
		else
		{
			if($id_group  == gs_group_id && $po['Po']['po_status_id']==status_po_draft_id)
			{
				$approveLink = array('label'=>__('Request Approval',true), 
				'options'=>array('action' => 'can_approve/' . status_po_request_for_approval_id , 
				$id));
			}
			else if($id_group  == po_approval1_group_id && $po['Po']['po_status_id']==status_po_request_for_approval_id)
			{
				$approveLink = array('label'=>__('Approve PO Level 1',true),
				'options'=>array('action' => 'approve_po/'. status_po_approved_1_id , $id)); 
			}
			else if($id_group  == po_approval2_group_id && $po['Po']['po_status_id']==status_po_approved_1_id)
			{
				$approveLink = array('label'=>__('Approve PO Level 2',true),
				'options'=>array('action' => 'approve_po/'. status_po_approved_2_id , $id)); 
			}
			else if($id_group  == po_approval3_group_id && $po['Po']['po_status_id']==status_po_approved_2_id)
			{
				$approveLink = array('label'=>__('Finish PO',true),
				'options'=>array('action' => 'approve_po/'. status_po_finish_id , $id)); 
			}
			else if($id_group == fincon_group_id && $po['Po']['po_status_id']==status_po_approved_2_id)
			{
				$approveLink = array('label'=>__('Finish PO',true),
				'options'=>array('action' => 'approve_po/'. status_po_finish_id , $id)); 
			}	
			//Sent PO gs_group_id
			else if($id_group == gs_group_id && $po['Po']['po_status_id']==status_po_finish_id)
			{
				$approveLink = array('label'=>__('Sent PO',true),
				'options'=>array('action' => 'approve_po/'. status_po_sent_id , $id)); 
			}		
			//Sent PO gs_group_id
			else 
			{
				$approveLink = array('label'=>__('Back',true),
				'options'=>array('action' => 'index/')); 
			}
		}
		return $approveLink;
	}
	
	function get_cancel_link($id, $po, $id_group)
	{
		//if can approve PO directly / under auth amount
		$rp_rate		= $po['Currency']['rp_rate'];
		//for po cancel, the amount was set as flat
		$auth_amount 	= '250000000'; 
		if($po['Po']['currency_id'] == '1'){
			$total_cur_converted	= $po['Po']['total_cur'];
		}else{
			$total_cur_converted	= $po['Po']['total_cur'] * $rp_rate;
		}
		
		if($id_group == gs_group_id){
			if($po['Po']['po_status_id']==status_po_draft_id 
			|| $po['Po']['po_status_id']==status_po_finish_id){
				$cancelLink = array('label'=>__('Request Cancel',true), 
				'options'=>array('action' => 'cancel/'.status_po_request_cancel_id.'/', $id));
			}else{
				$cancelLink = array('label'=>__('Back',true), 'options'=>array('action'=>'index'));
			}
		}else if($id_group == po_approval1_group_id){
			if(($po['Po']['po_status_id']==status_po_request_cancel_id
			|| $po['Po']['po_status_id']==status_po_request_for_approval_id)
				&& $total_cur_converted > 0){
				if($auth_amount > $total_cur_converted){
					$cancelLink = array('label'=>__('Cancel PO',true),
					'options'=>array('action' => 'cancel/'.status_po_cancel_id.'/', $id)); 		
				}else{
					$cancelLink = array('label'=>__('Cancel PO Level 1',true),
					'options'=>array('action' => 'cancel/'.status_po_cancel_level_1_id.'/' , $id)); 
				}
			}else{
				$cancelLink = array('label'=>__('Back',true), 'options'=>array('action'=>'index'));
			}
		}else if($id_group == po_approval2_group_id){
			if($po['Po']['po_status_id']==status_po_cancel_level_1_id
				&& $total_cur_converted > 0){
				if($auth_amount < $total_cur_converted ){
					$cancelLink = array('label'=>__('Cancel PO',true),
					'options'=>array('action' => 'cancel/'.status_po_cancel_id.'/', $id)); 		
				}else{
					$cancelLink = array('label'=>__('Back',true), 'options'=>array('action'=>'index'));
				}
			}else{
				$cancelLink = array('label'=>__('Back',true), 'options'=>array('action'=>'index'));
			}
		//}else if($id_group == fincon_group_id){
		//	if($po['Po']['po_status_id']==status_po_cancel_level_1_id
		//		&& $total_cur_converted > 0){
		//		if($auth_amount < $total_cur_converted ){
		//			$cancelLink = array('label'=>__('Cancel PO',true),
		//			'options'=>array('action' => 'cancel/'.status_po_cancel_id.'/', $id)); 		
		//		}else{
		//			$cancelLink = array('label'=>__('Back',true), 'options'=>array('action'=>'index'));
		//		}
		//	}
		}else{
			$cancelLink = array('label'=>__('Back',true), 'options'=>array('action'=>'index'));
		}
		//echo '<pre>';
		//var_dump($cancelLink);
		//echo '</pre>';die();
		return $cancelLink;
	}
	
	function no_to_words($no)
	{   
		$words = array('0'=> '' ,'1'=> 'one' ,'2'=> 'two' ,'3' => 'three','4' => 'four','5' => 'five','6' => 'six','7' => 'seven','8' => 'eight','9' => 'nine','10' => 'ten','11' => 'eleven','12' => 'twelve','13' => 'thirteen','14' => 'fouteen','15' => 'fifteen','16' => 'sixteen','17' => 'seventeen','18' => 'eighteen','19' => 'nineteen','20' => 'twenty','30' => 'thirty','40' => 'fourty','50' => 'fifty','60' => 'sixty','70' => 'seventy','80' => 'eighty','90' => 'ninty','100' => 'hundred &','1000' => 'thousand','100000' => 'lakh','10000000' => 'crore');
		//global $words;
		if($no == 0)
			return ' ';
		else {           
			$novalue='';$highno=$no;$remainno=0;$value=100;$value1=1000;        
				while($no>=100)    {
					if(($value <= $no) &&($no  < $value1))    {
					$novalue=$words["$value"];
					$highno = (int)($no/$value);
					$remainno = $no % $value;
					break;
					}
					$value	= $value1;
					$value1 = $value * 100;
				}        
			if(array_key_exists("$highno",$words))
				return $words["$highno"]." ".$novalue." ".$this->no_to_words($remainno);
			else { 
				$unit=$highno%10;
				$ten =(int)($highno/10)*10;             
				return $words["$ten"]." ".$words["$unit"]." ".$novalue." ".$this->no_to_words($remainno);
			}
		}
	//echo no_to_words(11000);
	}
	
	function eja($n, $str=null) {
		$this->dasar 	= array(1=>'satu','dua','tiga','empat','lima','enam','tujuh','delapan','sembilan');
		$this->angka 	= array(1000000000,1000000,1000,100,10,1);
		$this->satuan 	= array('milyar','juta','ribu','ratus','puluh','');
		
		$i=0;
		while($n!=0){
			$count = (int)($n/$this->angka[$i]);
				if($count>=10) $str .= $this->eja($count). " ".$this->satuan[$i]." ";
				else if($count > 0 && $count < 10)
				$str .= $this->dasar[$count] . " ".$this->satuan[$i]." ";
				$n -= $this->angka[$i] * $count;
				$i++;
		}
		$str = preg_replace("/satu puluh (\w+)/i","\\1 belas",$str);
		$str = preg_replace("/satu (ribu|ratus|puluh|belas)/i","se\\1",$str);
		return $str;
	}
	
	function num2words($num, $c=1) {
		$ZERO = 'zero';
		$MINUS = 'minus';
		$lowName = array(
			 /* zero is shown as "" since it is never used in combined forms */
			 /* 0 .. 19 */
			 "", "one", "two", "three", "four", "five",
			 "six", "seven", "eight", "nine", "ten",
			 "eleven", "twelve", "thirteen", "fourteen", "fifteen",
			 "sixteen", "seventeen", "eighteen", "nineteen");
		
		$tys = array(
			 /* 0, 10, 20, 30 ... 90 */
			 "", "", "twenty", "thirty", "fourty", "fifty",
			 "sixty", "seventy", "eighty", "ninety");
		
		$groupName = array(
			 /* We only need up to a quintillion, since a long is about 9 * 10 ^ 18 */
			 /* American: unit, hundred, thousand, million, billion, trillion, quadrillion, quintillion */
			 "", "hundred", "thousand", "million", "billion",
			 "trillion", "quadrillion", "quintillion");
		
		$divisor = array(
			 /* How many of this group is needed to form one of the succeeding group. */
			 /* American: unit, hundred, thousand, million, billion, trillion, quadrillion, quintillion */
			 100, 10, 1000, 1000, 1000, 1000, 1000, 1000) ;
		
		$num = str_replace(",","",$num);
		$num = number_format($num,2,'.','');
		$cents = substr($num,strlen($num)-2,strlen($num)-1);
		$num = (int)$num;
		
		$s = "";
		
		if ( $num == 0 ) $s = $ZERO;
		$negative = ($num < 0 );
		if ( $negative ) $num = -$num;
		// Work least significant digit to most, right to left.
		// until high order part is all 0s.
		for ( $i=0; $num>0; $i++ ) {
		   $remdr = (int)($num % $divisor[$i]);
		   $num = $num / $divisor[$i];
		   // check for 1100 .. 1999, 2100..2999, ... 5200..5999
		   // but not 1000..1099,  2000..2099, ...
		   // Special case written as fifty-nine hundred.
		   // e.g. thousands digit is 1..5 and hundreds digit is 1..9
		   // Only when no further higher order.
		   if ( $i == 1 /* doing hundreds */ && 1 <= $num && $num <= 5 ){
			   if ( $remdr > 0 ){
				   $remdr = ($num * 10);
				   $num = 0;
			   } // end if
		   } // end if
		   if ( $remdr == 0 ){
			   continue;
		   }
		   $t = "";
		   if ( $remdr < 20 ){
			   $t = $lowName[$remdr];
		   }
		   else if ( $remdr < 100 ){
			   $units = (int)$remdr % 10;
			   $tens = (int)$remdr / 10;
			   $t = $tys [$tens];
			   if ( $units != 0 ){
				   $t .= "-" . $lowName[$units];
			   }
		   }else {
			   $t = $this->num2words($remdr, 0);
		   }
		   $s = $t." ".$groupName[$i]." ".$s;
		   $num = (int)$num;
		} // end for
		$s = trim($s);
		if ( $negative ){
		   $s = $MINUS . " " . $s;
		}
		
		//if ($c !=0 ) 
			//$s .= " and $cents/100";
		$z=$this->no_to_words($cents);
		if ($c !=-1 and $cents!=0)
			$s .= " and $z cents";
		
		return $s;
	} // end num2words	
		
	function view_pdf($id = null) {
		//cek id pos
		if (!$id) {
			$this->Session->setFlash(__('Invalid po', true));
			$this->redirect(array('action' => 'index'));
		}
        Configure::write('debug',0); // Otherwise we cannot use this method while developing 
		$this->Session->write('Po.id', $id);
		$po=$this->Po->read(null, $id);
		
		//Add reprint=printed+1
		if (!empty($id)) {
			$data['Po']['id'] = $id;
			$data['Po']['printed'] = $po['Po']['printed'] + 1;
			$this->Po->save($data);
		}
		//to view related npb
		$no_npb="";
		foreach($po['Npb'] as $i=>$npb)
		{
			$no_npb .= $npb['no'] . " ";
		}
		$this->set('po', $po);
		$this->set('no_npb', $no_npb);
		//***************group po_id and name
		$param =	array(
				'conditions'=>array('PoDetail.po_id' => $id),
				'fields' => array(		
					'PoDetail.po_id', 
					'PoDetail.asset_category_id', 
					'PoDetail.item_code',
					'PoDetail.name', 
					'PoDetail.brand', 
					'PoDetail.type', 
					'PoDetail.color', 
					'sum(PoDetail.qty) as qty',
					'PoDetail.currency_id', 
					'Po.currency_id', 
					'PoDetail.price_cur',
					'sum(PoDetail.amount_cur) as amount_cur',
					'sum(PoDetail.discount_cur) as discount_cur',
					'sum(PoDetail.amount_after_disc_cur) as amount_after_disc_cur',
					'sum(PoDetail.vat_cur) as vat_cur',
					'sum(PoDetail.amount_nett_cur) as amount_nett_cur'
					), 	
				'group'=>array(
					'PoDetail.item_code',
					'PoDetail.name',
					'PoDetail.po_id',
					'PoDetail.asset_category_id', 
					'PoDetail.brand', 
					'PoDetail.type', 
					'PoDetail.color', 
					'Po.currency_id',
					'PoDetail.currency_id', 
					'PoDetail.price_cur'
					),
				'order'=>array('PoDetail.item_code'=>'ASC'),
			);
		$poDetails 			= $this->Po->PoDetail->find('all',$param);
		$this->set(compact('poDetails'));
		
		$assetCategories 	= $this->Po->PoDetail->AssetCategory->find('list', array('conditions'=>array('is_asset'=>1)));
		$currencies 		= $this->Po->Currency->find('list');
		$requestTypes 		= $this->Po->RequestType->find('list');
		//PaymentTerm
		$poPaymentTerms 		= $this->Po->PoPayment->find('all', array('conditions'=>array('PoPayment.po_id' => $id)));
		foreach($po['PoPayment'] as $poPaymentTerm)
		{
			$termPercent	= $poPaymentTerm['term_percent'];
			$amountDue		= $poPaymentTerm['amount_due'];
		}
		$this->set(compact('termPercent','amountDue'));
		//*************
		$this->set(compact('assetCategories', 'currencies', 'requestTypes'));
		//function terbilang
		//$bilang=0;
		$grandTotal=0;
		foreach($po['PoDetail'] as $poDetailBil)
		{
			$grandTotal += $poDetailBil['amount_nett_cur'];
		}
		//$place=cek rupiah atau dolar
		//$places = $po['Po']['currency_id']==1?-1:2;
		$places = $this->getPlaces($po['Currency']['is_desimal']);
		//var_dump($po['Currency']['language_id']);
		if ($po['Po']['currency_id']==1) {
			$terbilang=$this->eja(round($grandTotal,0));
		} else {
			$terbilang=$this->num2words($grandTotal,$places);
		}
		
		$PTRabobank = $this->configs['po_rabobank'];
		$this->set(compact('terbilang', 'poDetailBil', 'places', 'PTRabobank'));

		//export to pdf
        $this->layout = 'pdf'; //this will use the pdf.ctp layout 
        $this->render(); 
	}
	
	function po_type() {
		if (!empty($this->data)) {
			$this->Session->write('Po.request_type_id', $this->data['Po']['request_type_id']);
			$this->Session->write('Po.currency_id', $this->data['Po']['currency_id']);
			$this->Session->setFlash(__('The request type and currency type has been saved', true), 'default', array('class'=>'ok'));
			$this->redirect(array('action' => 'add'));
		}
		
		$currencies = $this->Po->Currency->find('list');		
		$requestTypes = $this->Po->RequestType->find('list');	
		$moduleName = 'PO > PO Type';
		$this->set('title_for_layout',  $this->lastSegment($moduleName));
		$this->set(compact('currencies', 'requestTypes', 'moduleName'));
	}
	
	function add() {
		//debug($this->data);
		if (!empty($this->data)){
			$this->Po->create();
			$this->data['Po']['po_status_id']=status_po_draft_id;
			$this->data['Po']['down_payment']= abs($this->data['Po']['down_payment']);
			//$this->data['Po']['po_date'] 			= date("Y-m-d H:i:s");
			//$this->data['Po']['delivery_date'] 	= date("Y-m-d H:i:s");
			//echo '<pre>';
			//var_dump($this->data['Po']['npb_detail_id']);
			//echo '</pre>';die();
			if(isset($this->data['Po']['npb_detail_id'])){
				if($this->Po->save($this->data)) {
					$this->data['Po']['id'] = $this->Po->id;
					$this->add_payment_terms('add');
					$poId	= $this->data['Po']['id'];
					
					if(!empty($this->data['Po']['npb_detail_id']))
						$this->add_selected_detail_from_npb();
						
					$npb_id_details = $this->data['Po']['npb_detail_id'];
					
					if($this->data['Po']['request_type_id'] == request_type_stock_id){
						foreach($npb_id_details as $npb_id_detail){
							if($npb_id_detail){
								$res = $this->Po->query('select * from npbs_point_rewards where compiled_npb_detail_id = '.$npb_id_detail);
								foreach($res as $data){
									$compiled_npb_id 		= $data[0]['compiled_npb_id'];
									$source_npb_id 			= $data[0]['source_npb_id'];
									$source_npb_detail_id 	= $data[0]['source_npb_detail_id'];
									$this->Po->query('update npbs_point_rewards set po_id = '.$poId.' where compiled_npb_detail_id = '.$npb_id_detail);
									$this->Po->query('update pos_temps set po_id = '.$poId.' where npb_detail_id = '.$source_npb_detail_id.' and npb_id = '.$source_npb_id);							
									$this->Po->query('update npb_details set po_id = '.$poId.' where id = '.$source_npb_detail_id.' and npb_id = '.$source_npb_id);							

								}
							}					
						}					
					}
						
					$this->Session->setFlash(__('The PO has been saved', true), 'default', array('class'=>'ok'));
					//if($this->data['Po']['request_type_id'] == request_type_stock_id)
						$this->redirect(array('action' => 'view', $this->Po->id));
					//else
					//	$this->redirect(array('action' => 'edit', $this->Po->id));
				} else {
					$this->Session->setFlash(__('The PO could not be saved. Please, try again.', true));
				}
			}else{
				$this->Session->setFlash(__('The PO could not be saved. Please, check MR Detail.', true));
			}
		}
		//$npbs = $this->Po->Npb->find('list');		
		//$npba = $this->Po->Npb->find('all');
		//and NpbDetail.currency_id = '.$this->Session->read('Po.currency_id').'
		if(DRIVER=='mysql')
			$v_is_done =  '(select if(sum(qty-qty_filled)=0,1,0) from npb_details where npb_details.npb_id=Npb.id)' ;
		elseif(DRIVER=='mssql')
			$v_is_done =  '(select case sum(qty-qty_filled) when 0 then 1 else 0 end from npb_details where npb_details.npb_id=Npb.id)' ;

		$cons			= '(Npb.request_type_id="'.$this->Session->read('Po.request_type_id').'"
							and Npb.npb_status_id="'.status_npb_sent_to_gs_id.'" and Npb.is_purchase_request=1) or';
		$cons			.= '(Npb.npb_status_id in("'.status_npb_sent_to_gs_id.'","'.status_npb_processing_id.'")) 
							and ('.$v_is_done.'=0) 
							and NpbDetail.process_type_id = ' . procurement_process_type_id  . '
							and (Npb.request_type_id="'.$this->Session->read('Po.request_type_id').'") ';
		$npbDetails 	= $this->Po->NpbDetail->find('all', 
			array('conditions'=>$cons, 
			'order'=>'NpbDetail.npb_id')
		);	
		
		$reqTypeId = $this->Session->read('Po.request_type_id');
		if($reqTypeId == request_type_point_reward_id){
			
		}
		//echo '<pre>';
		//var_dump($npbDetails);
		//echo '</pre>';die();
		
		$newId = $this->Po->getNewId($this->Session->read('Po.request_type_id'));
		$suppliers = $this->Po->Supplier->find('list');
		$poStatuses = $this->Po->PoStatus->find('list');
		$departments = $this->Po->Department->find('list');
		$departmentsub = $this->Po->Department->DepartmentSub->find('list');
		$departmentunit = $this->Po->Department->DepartmentUnit->find('list');
		$businessType = $this->Po->Department->BusinessType->find('list');
		$costcenter = $this->Po->PoDetail->CostCenter->find('list');
		$currencies = $this->Po->Currency->find('list');		
		$requestTypes = $this->Po->RequestType->find('list');		
		$processTypes = $this->Po->NpbDetail->ProcessType->find('list');	
		
		$po_notes = $this->configs['po_notes'];
		$po_shipping_address = $this->configs['po_shipping_address'];
		$po_billing_address = $this->configs['po_billing_address'];
		$po_address = $this->configs['po_address'];
		$moduleName = 'PO > New PO';
		$this->set('title_for_layout',  $this->lastSegment($moduleName));
		$this->set(compact('suppliers', 'departments','newId', 
			'poStatuses',
			'currencies', 'businessType',
			'requestTypes', 'costcenter',
			'npbs','npba', 'npbDetails',
			'po_notes', 'po_billing_address', 
			'po_shipping_address', 'po_address',
			'processTypes',
			'departmentsub', 'departmentunit','moduleName'));
	}
	
	function add_payment_terms($type)
	{
		
		if($type=='edit')
		{
				$this->Po->query('delete from po_payments where po_id="'.$this->data['Po']['id'].'"');
		}
			
		for($i=1; $i<=$this->data['Po']['payment_term']; $i++)
		{
			$term_percent = $this->data['Po']['payment_term'];
			$data['PoPayment']=array(
				'po_id'=>$this->Po->id,
				'term_no'=>$i,
				'term_percent'=>0,
				'date_due'=>'0000-00-00 00:00:00',
				'date_paid'=>'0000-00-00 00:00:00',
				'amount_due'=>0,
				'amount_paid'=>0,
				'description'=>'PO term '.$i
			);
			$this->Po->PoPayment->create();
			$this->Po->PoPayment->save($data);
		}	
	}
	
	function ajax_edit($id) {
		$this->is_ajax = true;
		$this->edit_by_ajax($id);
	}
	
	function edit_by_ajax($id = null) {
		$msg = '';
		$poResult = $this->Po->query('select a.* from pos a 
											left join po_details b on b.po_id = a.id
											where b.id = '.$id);
		$this->data['Po'] = $poResult[0][0];
		$id = $this->data['Po']['id'];
		
		
		$this->data = $_POST;
		$this->layout = 'ajax';
		$this->autoRender = false;
		$fieldName = $this->data['editorId'];
		$value = str_replace(',', '', $this->data['value']);
		list($fieldName, $poDetailId) = explode('.', $fieldName);
		
		$this->data = $this->Po->read(null, $id);
		$this->data['Po'][$fieldName] = $value;
		$this->data['Po']['id'] = $poResult[0][0]['id'];
		
		if (!$id && empty($this->data)) {			
			$msg = __('Invalid po', true);			
		}
		
		$po = $this->Po->read(null, $id);
		if (!empty($this->data)) {			
			if ($this->Po->save($this->data)) {
				$msg = __('The po has been saved', true);				
			} else {
				$msg = __('The po could not be saved. Please, try again.', true);				
			}
		}
		
		if (empty($this->data)) {
			$this->data = $this->Po->read(null, $id);
		}
		
		if ($fieldName == 'wht_rate' || $fieldName == 'wht_base') {
			$currency = $this->Po->Currency->find('list', array('fields'=>'is_desimal'));
			$places = $this->getPlaces($currency[$this->data['Po']['currency_id']]);
			echo number_format($this->data['Po'][$fieldName], $places);
		}				
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid po', true));
			$this->redirect(array('action' => 'index'));
		}
		$po = $this->Po->read(null, $id);
		if (!empty($this->data)) {
				$this->data['Po']['down_payment']= abs($this->data['Po']['down_payment']);
			if ($this->Po->save($this->data)) {
				if($this->data['Po']['payment_term'] != $po['Po']['payment_term']){
				$this->add_payment_terms('edit');
				$this->Session->setFlash(__('The po has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'view', $id));
				}else{
				$this->Session->setFlash(__('The po has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'view', $id));
				}
			} else {
				$this->Session->setFlash(__('The po could not be saved. Please, try again.', true));
			}
		}
		
		if (empty($this->data)) {
			$this->data = $this->Po->read(null, $id);
		}

		/*
		$cons 			= array('conditions'=>array('request_type_id !='=>request_type_stock_id));
		$npbs 			= $this->Po->Npb->find('list', $cons);			
		$npba 			= $this->Po->Npb->find('all', $cons);		
		*/
		
		//cari npb_details yang status NPB nya branch_approved
		//dan belum done kecuali yang po_id nya sama dgn PO yg sekarang
		//$cons			= 'Npb.npb_status_id="'.status_npb_branch_approved_id.'" and ((select if(sum(if(isnull(po_id) ,-1,0))=0,1,0) from npb_details where npb_details.npb_id=Npb.id)=0 or (po_id="'.$id.'") )';
		$suppliers 		= $this->Po->Supplier->find('list', array('order'=>'Supplier.name'));
		$departments 	= $this->Po->Department->find('list');
		$poStatuses 	= $this->Po->PoStatus->find('list');
		$requestTypes 	= $this->Po->RequestType->find('list');
		$currencies = $this->Po->Currency->find('list');		
		$this->set(compact('suppliers', 
			'departments',
			'poStatuses' , 
			'requestTypes' , 
			/*'npbs' , 'npba', 'npbDetails',*/
			'currencies'));
	}

	function update_ajax($id = null) {
		$this->autoRender = false;
		
		if (!$id && empty($this->data)) {
			echo json_encode(array('error'=>__('Invalid po', true)));
		}
		
		if (!empty($this->data)) {
			$this->data['Po']['id']  = $id;
			$this->data = Sanitize::paranoid($this->data, array('.'));
			if ($this->Po->save($this->data)) {
				$po=$this->Po->read(null, $id);
				echo json_encode(array('status'=>'The po was be saved', 'model'=>$po['Po']));
			} else {
				echo json_encode(array('status'=>__('The po could not be saved. Please, try again.',true)));
			}
		}
	}
	
	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for po', true));
			$this->redirect(array('action'=>'index'));
		}
		
		//reset npb and details
		$sql='update npb_details set qty_filled=0, qty_unfilled=qty where po_id='. $id ;
		$this->Po->query($sql);			
		
		$po=$this->Po->read(null, $id);
		foreach($po['NpbDetail'] as $npbDetail)
		{
			$sql='update npb_details set po_id=NULL where id="'.$npbDetail['id'].'"';
			$this->Po->query($sql);		
			
		$npb_id = $npbDetail['npb_id'];
		$this->Po->NpbDetail->Npb->id=$npb_id;
		$this->Po->NpbDetail->Npb->set('npb_status_id', status_npb_processing_id);
		$this->Po->NpbDetail->Npb->save();

		}
		
		if ($this->Po->delete($id)) {
			$this->Session->setFlash(__('Po deleted', true), 'default', array('class'=>'ok'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Po was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function close($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid po', true));
			$this->redirect(array('action' => 'index'));
		}
		$po = $this->Po->read(null, $id);
		if (!empty($this->data)) {
				$this->data['Po']['down_payment']= abs($this->data['Po']['down_payment']);
				
				//check approval note 1
				if ($this->data['Po']['approval_note_1'] == null){
					$this->Session->setFlash(__('Needs Approval 1 Note', true));
					$this->redirect(array('action' => 'close', $id));
				}
			if ($this->Po->save($this->data)) {
				if($this->data['Po']['payment_term'] != $po['Po']['payment_term']){
					$this->add_payment_terms('edit');
					$this->Session->setFlash(__('The po has been saved', true), 'default', array('class'=>'ok'));
					$this->redirect(array('action' => 'view', $id));
				}else{
					$this->Session->setFlash(__('The po has been saved', true), 'default', array('class'=>'ok'));
					$this->redirect(array('action' => 'view', $id));
				}
			} else {
				$this->Session->setFlash(__('The po could not be saved. Please, try again.', true));
			}
		}
		
		if (empty($this->data)) {
			$this->data = $this->Po->read(null, $id);
		}

		/*
		$cons 			= array('conditions'=>array('request_type_id !='=>request_type_stock_id));
		$npbs 			= $this->Po->Npb->find('list', $cons);			
		$npba 			= $this->Po->Npb->find('all', $cons);		
		*/
		
		//cari npb_details yang status NPB nya branch_approved
		//dan belum done kecuali yang po_id nya sama dgn PO yg sekarang
		//$cons			= 'Npb.npb_status_id="'.status_npb_branch_approved_id.'" and ((select if(sum(if(isnull(po_id) ,-1,0))=0,1,0) from npb_details where npb_details.npb_id=Npb.id)=0 or (po_id="'.$id.'") )';
		$suppliers 		= $this->Po->Supplier->find('list', array('order'=>'Supplier.name'));
		$departments 	= $this->Po->Department->find('list');
		$poStatuses 	= $this->Po->PoStatus->find('list');
		$requestTypes 	= $this->Po->RequestType->find('list');
		$currencies = $this->Po->Currency->find('list');		
		$this->set(compact('suppliers', 
			'departments',
			'poStatuses' , 
			'requestTypes' , 
			/*'npbs' , 'npba', 'npbDetails',*/
			'currencies'));
	}
	
	function archive($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for po', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Po->id = $id;
		$this->Po->set('po_status_id', status_po_archive_id);
		$this->Po->save(); 
		if ($this->Po->save($id)) {
			$this->Session->setFlash(__('Po archived', true), 'default', array('class'=>'ok'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Po was not archived', true));
		$this->redirect(array('action' => 'index'));
	}	
	
	function add_selected_detail_from_npb()
	{
		$this->Po->PoDetail->deleteAll(array('npb_id != 0 and po_id = "'.$this->data['Po']['id'].'"'), true, true);
		$this->Po->query('delete from npbs_pos where po_id="'.$this->data['Po']['id'].'"');
		$this->Po->query('update npb_details set po_id=NULL where po_id="'.$this->data['Po']['id'].'"');
		
		if(empty($this->data['Po']['npb_detail_id']))
			return;

		$npb_id_details = $this->data['Po']['npb_detail_id'];
		$this->log(var_export($npb_id_details , true));
		
		$wht_rate 	= 0;
		$vat_rate 	= 0;
		$vat_base 	= 0;
		$wht_base 	= 0;
		$sub_total 	= 0;
		$discount 	= 0;
		$after_disc = 0;
		$wht_total 	= 0;
		$vat_total 	= 0;
		$total 		= 0;
		
		foreach ($npb_id_details as $npb_id_detail)
		{
			if($npb_id_detail>0)
			{				
				$npbDetail				= $this->Po->NpbDetail->findById($npb_id_detail);
				if($npbDetail['NpbDetail']['currency_id'] == 1 && is_null($npbDetail['NpbDetail']['rp_rate'])){
					$this->Po->query("update npb_details set rp_rate = '1.00' where id = '".$npbDetail['NpbDetail']['id']."' ");
					unset($npbDetail);
					$npbDetail				= $this->Po->NpbDetail->findById($npb_id_detail);
				}
				
				$this->log('npb detail : ' . var_export($npbDetail,true));
				$department_id			= $npbDetail['Npb']['department_id'];
				$department_sub_id		= $npbDetail['Npb']['department_sub_id'];
				$department_unit_id		= $npbDetail['Npb']['department_unit_id'];
				$cost_center_id			= $npbDetail['Npb']['cost_center_id'];
				$business_type_id		= $npbDetail['Npb']['business_type_id'];
				$d 						= $npbDetail['NpbDetail'];
				
				unset($d['id']);

				$wht_rate 	= 0;
				$vat_rate 	= 10;
				$vat_base 	+= $d['amount_cur'];
				$wht_base 	= 0;
				$sub_total	+= $d['amount_cur'];
				$discount 	= 0;
				$after_disc	+= $d['amount_cur'];
				$wht_total 	= 0;
				$vat_total 	+= ($vat_rate * $d['amount_cur'] / 100);
				$total		+= $d['amount_cur'];
				
				//unset($d['id']);
				$d['po_id']									= $this->data['Po']['id'];
				$item										= $this->Po->NpbDetail->Item->findById($d['item_id']);
				$d['asset_category_id']						= $item['Item']['asset_category_id'];
				$d['item_code']								= $item['Item']['code'];
				$d['name']									= $item['Item']['name'];
				$d['amount_nett']							= $d['amount_net'];
				$d['amount_nett_cur']						= $d['amount_net_cur'];
				$d['price']									= $d['price'];
				$d['amount']								= $d['qty'] * $d['price'];
				$d['amount_cur']							= $d['qty'] * $d['price'];
				unset($d['amount_net']);
				unset($d['amount_net_cur']);
				//save color/brand/type
				if ($npbDetail['NpbDetail']['color'] ==' ') {
					$d['color']								= '-';
				} else {
					$d['color']								= $npbDetail['NpbDetail']['color'];
				}
				if ($npbDetail['NpbDetail']['brand'] ==' ') {
					$d['brand']								= '-';
				} else {
					$d['brand']								= $npbDetail['NpbDetail']['brand'];
				}
				if ($npbDetail['NpbDetail']['type'] ==' ') {
					$d['type']								= '-';
				} else {
					$d['type']								= $npbDetail['NpbDetail']['type'];
				}
				$d['department_id']							= $department_id;
				$d['currency_id']							= $this->data['Po']['currency_id'];
				$d['umurek']								= $item['AssetCategory']['depr_year_com'];
				$d['npb_detail_id']							= $npb_id_detail;
				$d['department_sub_id']						= $department_sub_id;
				$d['department_unit_id']					= $department_unit_id;
				$d['business_type_id']						= $business_type_id;
				$d['cost_center_id']						= $cost_center_id;
				$d['qty_filled']							= $d['qty'];
				
				if($d['currency_id'] == '1'){
					$d['rp_rate'] = '1.00';
				}
				
				//update to npb_details
				$npbDetail['NpbDetail']['qty_filled']		= $d['qty'];
				$npbDetail['NpbDetail']['po_id']			= $this->data['Po']['id'];
				//set npb_detail->date_finish
				if ($d['qty']==$d['qty_filled']) {
					$npbDetail['NpbDetail']['date_finish']  = date('Y-m-d');
				}
				
				$npbs[]		 			= $d['npb_id'];
				
				$poDetail['PoDetail'] 	= $d;
				//var_dump($poDetail);die();
				$this->Po->PoDetail->create();
				if(!$this->Po->PoDetail->save($poDetail))
				{
					$this->log(print_r($this->Po->ValidationErrors, true));
					var_dump($poDetail);
					die('fatal error ' . __FILE__ . ':' . __LINE__);
				}
				
				//save po_id dan qty_filled di npb detail
				if(!$this->Po->NpbDetail->save($npbDetail))
				{
					//var_dump($npbDetail);
					die('fatal error ' . __FILE__ . ':' . __LINE__);
				}
			}
		}
		
		if(!empty($npbs)) 
			$this->data['Npb']['Npb'] 	= array_unique($npbs);
		
		//update npb status
		foreach($npbs as $npb_id)
		{
			$this->Po->Npb->checkDone($npb_id);
		}
		
		$this->data['Po']['wht_rate'] 			= $wht_rate;
		$this->data['Po']['vat_rate']	 		= $vat_rate;
		$this->data['Po']['vat_base_cur'] 		= $sub_total;
		$this->data['Po']['wht_base_cur'] 		= $wht_base;
		$this->data['Po']['sub_total_cur'] 		= $sub_total;
		$this->data['Po']['discount_cur'] 		= $discount;
		$this->data['Po']['after_disc_cur'] 	= $after_disc;
		$this->data['Po']['wht_total_cur'] 		= $wht_total;
		$this->data['Po']['vat_total_cur'] 		= $vat_total;
		$this->data['Po']['total_cur'] 			= $total + $vat_total - $discount;
		$this->Po->save($this->data);	

	}
	
	function add_all_detail_from_npb( )
	{
		$this->Po->PoDetail->deleteAll(array('npb_id != 0 and po_id = "'.$this->data['Po']['id'].'"'), true, true);
		$this->Po->query('delete from npbs_pos where po_id="'.$this->data['Po']['id'].'"');

		if(empty($this->data['Npb']['Npb']))
			return;			
		$npb_ids = $this->data['Npb']['Npb'];
		
		$wht_rate = 0;
		$vat_rate = 0;
		$vat_base = 0;
		$wht_base = 0;
		$sub_total = 0;
		$discount = 0;
		$wht_total = 0;
		$vat_total = 0;
		$total = 0;	
		
		foreach ($npb_ids as $npb_id)
		{
			if($npb_id)
			{				
				$npb		= $this->Po->Npb->findById($npb_id);
				$wht_rate 	= 0;
				$vat_rate 	= 10;
				$vat_base 	+= 0;
				$wht_base 	+= 0;
				$sub_total	+= $npb['Npb']['total'];
				$discount 	+= 0;
				$wht_total 	+= 0;
				$vat_total 	+= 0;
				$total 		+= 0;
				
				foreach ($npb['NpbDetail'] as $d)
				{
					unset($d['id']);
					$d['po_id']				= $this->data['Po']['id'];
					$item					= $this->Po->Npb->NpbDetail->Item->findById($d['item_id']);
					$d['asset_category_id']	= $item['Item']['asset_category_id'];
					$d['name']				= $item['Item']['name'];
					$d['umurek']			= $item['AssetCategory']['depr_year_com'];
					$d['color']				= '';
					$d['brand']				= '';
					$d['type']				= '';
					
					$poDetail['PoDetail'] 	= $d;
					$this->Po->PoDetail->create();
					$this->Po->PoDetail->save($poDetail);
				}
			}
		}
		$this->data['Po']['wht_rate'] = $wht_rate;
		$this->data['Po']['vat_rate'] = $vat_rate;
		$this->data['Po']['vat_base'] = $vat_base;
		$this->data['Po']['wht_base'] = $wht_base;
		$this->data['Po']['sub_total'] = $sub_total;
		$this->data['Po']['discount'] = $discount;
		$this->data['Po']['wht_total'] = $wht_total;
		$this->data['Po']['vat_total'] = $vat_total;
		$this->data['Po']['total'] = $total;
		$this->Po->save($this->data);		
	}

	function approve_po($level,$id) {
		//echo "<pre>";
		//var_dump($this->Session->read());
		//echo "</pre>";
		
		$this->data['Po']['id']=$id;
		$this->data['Po']['po_status_id']=$level;
		$this->data['Po']['approval_info']=date("Y-m-d H:i:s"). ':Approved by:'.$this->Session->read('Userinfo.username');
		$poStatuses = $this->Po->PoStatus->find('list');
		
		//update status approved
		if ($level == status_po_approved_1_id || $level == status_po_approved_2_id || $level == status_po_approved_3_id || $level == status_po_finish_id){
			$this->data['Po']['approved_date'] = date('Y-m-d H:i:s');
			$this->data['Po']['approved_by']   = $this->Session->read('Userinfo.username');
		}
		
		if($level == status_po_finish_id){
			$po = $this->Po->read(null, $id);
			//update source MR Voucher
			$count = 1;
			$res = $this->Po->query('select * from npbs_point_rewards where po_id = '.$id);
			if($res){
				foreach($res as $data){						
					$compiled_npb_id		= $data[0]['compiled_npb_id'];
					$compiled_npb_detail_id	= $data[0]['compiled_npb_detail_id'];
					$source_npb_id			= $data[0]['source_npb_id'];
					$source_npb_detail_id	= $data[0]['source_npb_detail_id'];
					////update npbs_pos
					//$this->Po->query('delete from npbs_pos where npb_id = '.$compiled_npb_id.' and po_id = '.$id);
					////update npb_details of source
					//$this->Po->query('update npb_details set po_id = '.$id.' where id = '.$source_npb_detail_id);
					////update npb_details of compiled
					$this->Po->query('update npb_details set po_id = 0 where id = '.$compiled_npb_detail_id);
					////update compiled mrs to dummy
					////$s 	= $this->Po->query("select top(1) id from npbs where no like '%MR-DUMMY%' order by id desc");
					////$dummy_npb_id = $s[0][0]['id'];
					////$this->Po->query('update npb_details set npb_id = '.$dummy_npb_id.' where id = '.$compiled_npb_detail_id);
					////$this->Po->query('update npbs set npb_status_id = 127 where id = '.$compiled_npb_id);
					////update source mrs to actual
					//$this->Po->query('update npb_details set npb_id = '.$source_npb_id.' where id = '.$source_npb_detail_id);
					//$this->Po->query('update npbs set npb_status_id = 50 where id = '.$source_npb_detail_id);
					//update po details
					$s 	= $this->Po->query('select * from npb_details where id = '.$source_npb_detail_id);
					$i 	= $this->Po->query('select * from items where id = '.$s[0][0]['item_id']);
					$item_id					= $s[0][0]['item_id'];
					$color						= $s[0][0]['color'];
					$brand						= $s[0][0]['brand'];
					$type						= $s[0][0]['type'];
					$qty						= $s[0][0]['qty'];
					$price						= $s[0][0]['price'];
					$price_cur					= $s[0][0]['price_cur'];
					$amount						= $s[0][0]['amount'];
					$amount_cur					= $s[0][0]['amount_cur'];
					$discount					= $s[0][0]['discount'];
					$discount_cur				= $s[0][0]['discount_cur'];
					$amount_after_disc			= $amount - $discount;
					$amount_after_disc_cur		= $amount_cur - $discount_cur;
					$vat 						= ($amount*10)/100;
					$vat_cur 					= ($amount_cur*10)/100;
					$amount_nett				= $amount_after_disc + $vat;
					$amount_nett_cur			= $amount_after_disc_cur + $vat_cur;					
					if($count == 1){
						/*$this->Po->query('update po_details set 
										qty 					= "'.$qty.'", 
										price 					= "'.$price.'", 
										price_cur 				= "'.$price_cur.'", 
										amount 					= "'.$amount.'", 
										amount_cur 				= "'.$amount_cur.'", 
										discount 				= "'.$discount.'", 
										discount_cur 			= "'.$discount_cur.'", 
										amount_after_disc 		= "'.$amount_after_disc.'", 
										amount_after_disc_cur 	= "'.$amount_after_disc_cur.'", 
										vat 					= "'.$vat.'", 
										vat_cur 				= "'.$vat_cur.'", 
										amount_nett 			= "'.$amount_nett.'", 
										amount_nett_cur 		= "'.$amount_nett_cur.'", 
										npb_id 					= "'.$source_npb_id.'", 
										npb_detail_id 			= "'.$source_npb_detail_id.'", 
										color 					= "'.$color.'", 
										brand 					= "'.$brand.'", 
										type 					= "'.$type.'" 
										where po_id = "'.$id.'" ');
						$this->Po->query('delete from npbs_pos where po_id = '.$id);
						$this->Po->query('insert into npbs_pos values ('.$source_npb_id.','.$id.')');*/
						$this->Po->query('update pos_temps set po_id = '.$id.' where npb_id = '.$source_npb_id.' and npb_detail_id = '.$source_npb_detail_id);
					}else{
						/*$this->data['PoDetail']['po_id'] 					= $id;
						$this->data['PoDetail']['asset_category_id'] 		= $i[0][0]['asset_category_id'];
						$this->data['PoDetail']['item_code'] 				= $i[0][0]['code'];
						$this->data['PoDetail']['name'] 					= $i[0][0]['name'];
						$this->data['PoDetail']['color'] 					= $color;
						$this->data['PoDetail']['brand'] 					= $brand;
						$this->data['PoDetail']['type'] 					= $type;
						$this->data['PoDetail']['qty'] 						= $qty;
						$this->data['PoDetail']['qty_received'] 			= 0;
						$this->data['PoDetail']['price'] 					= $price;
						$this->data['PoDetail']['price_cur'] 				= $price_cur;
						$this->data['PoDetail']['amount'] 					= $amount;
						$this->data['PoDetail']['amount_cur'] 				= $amount_cur;
						$this->data['PoDetail']['discount'] 				= $discount;
						$this->data['PoDetail']['discount_cur'] 			= $discount_cur;
						$this->data['PoDetail']['amount_after_disc'] 		= $amount_after_disc;
						$this->data['PoDetail']['amount_after_disc_cur'] 	= $amount_after_disc_cur;
						$this->data['PoDetail']['vat'] 						= $vat;
						$this->data['PoDetail']['vat_cur'] 					= $vat_cur;
						$this->data['PoDetail']['amount_nett'] 				= $amount_nett;
						$this->data['PoDetail']['amount_nett_cur'] 			= $amount_nett_cur;
						$this->data['PoDetail']['currency_id'] 				= $i[0][0]['currency_id'];
						$this->data['PoDetail']['rp_rate'] 					= 1;						
						$this->data['PoDetail']['npb_id'] 					= $source_npb_id;						
						$this->data['PoDetail']['umurek'] 					= 0;						
						$this->data['PoDetail']['is_vat'] 					= 1;						
						$this->data['PoDetail']['is_wht'] 					= 0;			
						$this->data['PoDetail']['department_id'] 			= $this->Session->read('Userinfo.department_id');	
						$this->data['PoDetail']['department_sub_id'] 		= $this->Session->read('Userinfo.department_sub_id');	
						$this->data['PoDetail']['department_unit_id'] 		= $this->Session->read('Userinfo.department_unit_id');	
						$this->data['PoDetail']['business_type_id'] 		= $this->Session->read('Userinfo.business_type_id');	
						$this->data['PoDetail']['cost_center_id'] 			= $this->Session->read('Userinfo.cost_center_id');							
						$this->data['PoDetail']['item_id'] 					= $s[0][0]['item_id'];						
						$this->data['PoDetail']['npb_detail_id'] 			= $source_npb_detail_id;						
						$this->Po->PoDetail->create();
						$this->Po->PoDetail->save($this->data['PoDetail']);
						$this->Po->query('insert into npbs_pos values ('.$source_npb_id.','.$id.')');*/
						$this->Po->query('update pos_temps set po_id = '.$id.' where npb_id = '.$source_npb_id.' and npb_detail_id = '.$source_npb_detail_id);
					}
					$count++;
				}			
			}				
		}					
		
		if ($this->Po->save($this->data)) {
			$this->Session->setFlash(__('The PO has been updated to ' . $poStatuses[$level], true), 'default', array('class'=>'ok'));
			//$this->redirect(array('action' => 'view', $id));
			$this->redirect(array('action' => 'index'));
		} else {
			$this->Session->setFlash(__('The PO could not be saved. Please, try again.', true));
		}
		$this->edit($id);
	}
	
	function cancel_po($level,$id) {
		//echo "<pre>";
		//var_dump($this->Session->read());
		//echo "</pre>";
		
		$this->data['Po']['id']=$id;
		$this->data['Po']['po_status_id']=$level;
		$this->data['Po']['approval_info']=date("Y-m-d H:i:s"). ':Cancel by:'.$this->Session->read('Userinfo.username');
		$poStatuses = $this->Po->PoStatus->find('list');
		
		//update status cancelled
		if ($level == status_po_cancel_id || $level == status_po_cancel_level_1_id || $level == status_po_cancel_level_2_id || $level == status_po_cancel_level_3_id){
			$this->data['Po']['cancel_date'] = date('Y-m-d H:i:s');
			$this->data['Po']['cancel_by']   = $this->Session->read('Userinfo.username');
		}
		if ($this->Po->save($this->data)) {
			$this->Session->setFlash(__('The PO has been updated to ' . $poStatuses[$level], true), 'default', array('class'=>'ok'));
			$this->redirect(array('action' => 'index'));
		} else {
			$this->Session->setFlash(__('The PO could not be saved. Please, try again.', true));
		}
		$this->edit($id);
	}
	
	function can_approve($level,$id) {
		
		$poStatuses = $this->Po->PoStatus->find('list');
		if (DRIVER=='mysql') {
			$sql 			= $this->Po->query('SELECT SUM( po_payments.term_percent ) FROM po_payments WHERE po_payments.po_id = "'.$id.'"');
			$term_percent 	= $sql[0][0]['SUM( po_payments.term_percent )'];
			
			$slqs			= $this->Po->query('SELECT SUM(po_payments.amount_due) FROM po_payments WHERE po_payments.po_id = "'.$id.'"');
			$amount_due		= $slqs[0][0]['SUM(po_payments.amount_due)'];
		}
		elseif (DRIVER=='mssql') {
			$sql 			= $this->Po->query('SELECT SUM( po_payments.term_percent ) FROM po_payments WHERE po_payments.po_id = "'.$id.'"');
			$term_percent 	= $sql[0][0]['computed'];
			
			$slqs			= $this->Po->query('SELECT SUM(po_payments.amount_due) FROM po_payments WHERE po_payments.po_id = "'.$id.'"');
			$amount_due		= $slqs[0][0]['computed'];
		}
			$sqla			= $this->Po->query('SELECT po_payments.date_due FROM po_payments WHERE po_payments.po_id = "'.$id.'"');
			$date_due 	    = $sqla[0][0]['date_due'];
			
		//var_dump($date_due);
		$pos = $this->Po->read(null, $id);
		//echo '<pre>';
		//var_dump($pos);
		//echo '</pre>';die();
		foreach($pos as $pd){
		//update status approved
			foreach($pos['PoDetail'] as $detil){
				if($detil['price_cur']==0){
				$this->Session->setFlash(__('The PO could not be Send. Please, check Payment term Must be 100%, Item detail, Date Due must have a date(YYYY-MM-DD) Must be filled And Total Amount can not be 0, and please check down payment', true));
				$this->redirect(array('action' => 'view', $id));
				}
			}
			if($term_percent  == 100.00 && $pd['total_cur'] >= 1 && $amount_due == $pd['total_cur'] && $date_due != NULL && $pd['total_cur'] > $pd['down_payment'] && $pd['down_payment'] >= 0){
				$this->data['Po']['po_status_id']=$level;
				if($level == status_po_request_for_approval_id){
					foreach($pos['NpbDetail'] as $npbDetail){
						$this->Po->query('update npbs_point_rewards set po_id ='.$npbDetail['po_id'].' where compiled_npb_id = '.$npbDetail['npb_id'].' and compiled_npb_detail_id ='.$npbDetail['id']);
					}
				}				
				if($this->Po->save($this->data)){
					$this->Session->setFlash(__('The PO has been updated to ' . $poStatuses[$level], true), 'default', array('class'=>'ok'));
					$this->redirect(array('action' => 'index'));
				}
			} else {
				$this->Session->setFlash(__('The PO could not be Send. Please, check Payment term Must be 100%, Item detail, Date Due must have a date(YYYY-MM-DD) Must be filled And Total Amount can not be 0, and please check down payment', true));
				$this->redirect(array('action' => 'view', $id));

			}
		}
		
	}
	
	function can_cancel($level,$id) {
		
		$poStatuses = $this->Po->PoStatus->find('list');
		$pos = $this->Po->read(null, $id);
		foreach($pos as $pd){
			$this->data['Po']['po_status_id']=$level;
			if($this->Po->save($this->data)){
				$this->Session->setFlash(__('The PO has been updated to ' . $poStatuses[$level], true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			}else {
				$this->Session->setFlash(__('Cancel PO Process failed. Please try again.', true));
				$this->redirect(array('action' => 'view', $id));
			}
		}		
	}
	
	function view_received($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid po', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->write('Po.id', $id);
		$id_group=$this->Session->read('Security.permissions');
		$po=$this->Po->read(null, $id);
		/// can input invoice?
		if( $id_group==gs_group_id && 
			$po['Po']['po_status_id']==status_po_sent_id /*&& $po['Po']['v_is_done']==1*/)
			$this->Session->write('Po.can_invoice', true);
		else
			$this->Session->write('Po.can_invoice', false);

			
		$this->Session->write('Po.id', $id);
		$this->set('po', $po);
		$departments = $this->Po->Department->find('list');
		$assetCategories = $this->Po->PoDetail->AssetCategory->find('list');
		$this->set(compact('departments', 'assetCategories'));
	}
	
	
	
	function reject($id = null) {
		//View Pos
		if (!$id) {
			$this->Session->setFlash(__('Invalid po', true));
			$this->redirect(array('action' => 'index'));
		}
		$po = $this->Po->read(null, $id);
                  
		//Add Notes Reject Pos and Change Status
		if (!empty($this->data)) {
                  
            // set NPB status reject
			$npbs = $po['Npb'];
			if(!empty($npbs))
			{
				  foreach($npbs as $npb) {
						$this->Po->Npb->id=$npb['id'];
						$this->Po->Npb->set('npb_status_id', status_npb_reject_id);
						$this->Po->Npb->set('reject_notes', __('Auto Reject from PO', true)   . ' ' . $po['Po']['no'] );
						$this->Po->Npb->set('reject_by', $this->Session->read('Userinfo.username'));
						$this->Po->Npb->set('reject_date', date('Y-m-d H:i:s'));
						
						$this->Po->Npb->save();
				  }
			}				
		
			$this->data['Po']['id'] = $id;
			$this->data['Po']['po_status_id'] = status_po_reject_id;
			if ($this->Po->save($this->data)) {
				$this->Session->setFlash(__('The po has been saved', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The po could not be saved. Please, try again.', true));
			}
		}

		if (empty($this->data)) {
			$po = $this->data = $this->Po->read(null, $id);
		}
		
		$npbDetails 	= $this->Po->NpbDetail->find('all');	
		$suppliers 		= $this->Po->Supplier->find('list');
		$departments 	= $this->Po->Department->find('list');
		$poStatuses 	= $this->Po->PoStatus->find('list');
		$assetCategories 	= $this->Po->PoDetail->AssetCategory->find('list');
		$npbStatuses = $this->Po->Npb->NpbStatus->find('list');
		$npbs = $this->Po->Npb->find('list');
		$this->set(compact('po', 'suppliers', 'departments','poStatuses', 'npbDetails', 'npbs', 'assetCategories', 'npbStatuses'));
	}
	
	function cancel($level = null, $id = null) {
		$id_group=$this->Session->read('Security.permissions');
		if($id_group == po_approval1_group_id || $id_group == po_approval2_group_id){
			unset($this->data['Po']['cancel_by']);
		}
		//Add Notes Reject Pos and Change Status
		if (!empty($this->data)) {
			$poStatuses = $this->Po->PoStatus->find('list');
			if ($this->Po->save($this->data)) {				
				$this->Session->setFlash(__('The PO has been updated to ' . $poStatuses[$this->data['Po']['po_status_id']], true), 'default', array('class'=>'ok'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The po could not be saved. Please, try again.', true));
			}
		}
		
		$po					= $this->Po->read(null, $id);
		$suppliers 			= $this->Po->Supplier->find('list');
		$departments 		= $this->Po->Department->find('list');
		$poStatuses 		= $this->Po->PoStatus->find('list');
		$assetCategories 	= $this->Po->PoDetail->AssetCategory->find('list');
		$npbStatuses 		= $this->Po->Npb->NpbStatus->find('list');	
		$npbs 				= $this->Po->Npb->find('list');
		//echo '<pre>';
		//var_dump($po);
		//echo '</pre>';die();
		
		$this->set(compact('po', 'suppliers', 'departments','poStatuses' , 'assetCategories','level', 'npbStatuses','id'));
		
	}
	
	function po_report($type='finish') {

		$id_group=$this->Session->read('Security.permissions');
	
		$this->Po->recursive = 1;
		$layout=$this->data['Po']['layout'];
		//var_dump($this->configs);
		
		$conditions[] = array('po_status_id !='=>status_po_archive_id);
		$conditions[] = array('po_status_id !='=>status_po_reject_id);
		
		if ($supplier_id=$this->data['Po']['supplier_id'])  {
			$conditions[] = array('supplier_id'=>$supplier_id);
		}
		///date filter		
		list($date_start,$date_end) = $this->set_date_filters('Po');
		$conditions[] = array('po_date >=' => ($date_start['year'] . '-' . $date_start['month'] . '-' . $date_start['day']) , 
				'po_date <=' => ($date_end['year'] . '-' . $date_end['month'] . '-' . $date_end['day']) );
				
		if ($type=='finish')
		{
			$this->Session->write('Po.report_type', 'finish');
		}
		else 
		{
			$this->Session->write('Po.report_type', 'outstanding');
		}
		$this->paginate = array('order'=>'Po.id');
		if(DRIVER=='mysql') {
			$conditions[] = array('(SELECT if(sum(qty)-sum(qty_received)=0,1,0) FROM po_details WHERE `po_details`.`po_id` = `Po`.`id`) = ' . 
				($this->Session->read('Po.report_type')=='finish'? 1 : 0) );
		}                
        elseif(DRIVER=='mssql') {
			$conditions[] = array('(select case sum(qty-qty_received) when 0 then 1 else 0 end from po_details WHERE po_details.po_id = Po.id) = ' . 
				($this->Session->read('Po.report_type')=='finish'? 1 : 0) );
		}
		
		if($layout=='pdf' || $layout=='xls'){
			$con = $this->Po->find('all', array('conditions'=>$conditions, 'order'=>'Po.id'));
		}else{
			$con = $this->paginate($conditions);
		}
		$this->set('pos', $con);
		$copyright_id  = $this->configs['copyright_id'];
		$po_statuses = $this->Po->PoStatus->find('list');
		$departments = $this->Po->Department->find('list');
		$suppliers = $this->Po->Supplier->find('list');
		$moduleName = 'PO > '.  ucwords($type) . ' Report';
		$this->set('title_for_layout',  $this->lastSegment($moduleName));
		$this->set(compact('po_statuses', 'departments','po_status_id', 
			'date_start','date_end', 'copyright_id',
			'suppliers','supplier_id',
			'po_department_id','type','moduleName'));			
		
		if($layout=='pdf')
		{
			Configure::write('debug',0); // Otherwise we cannot use this method while developing 
			$this->layout = 'pdf'; //this will use the pdf.ctp layout 
			$this->render('po_report_pdf'); 		
		}
		else if($layout=='xls')
		{
			$this->render('po_report_xls','export_xls');
		}
	}
	
	// fungsi report order
	function report_order($type='finish') {
		$id_group=$this->Session->read('Security.permissions');
	
		$this->Po->recursive = 1;
		//var_dump($this->configs);
		
		if($id_group == po_approval1_group_id)
			$conditions = array(
				'OR'=>array(
					array('po_status_id'=>status_po_request_for_approval_id),
					array('po_status_id'=>status_po_approved_1_id))
			);
			
		elseif($id_group == po_approval2_group_id)
			$conditions = array(
				'OR'=>array(
					array('po_status_id'=>status_po_approved_1_id),
					array('po_status_id'=>status_po_approved_2_id))
				);
			
		// elseif($id_group == po_approval3_group_id)
		// $conditions = array('po_status_id'=>status_po_approved_2_id);
			
		elseif($id_group == fincon_group_id)
			$conditions = array(
				'OR'=>array(
					array('po_status_id'=>status_po_approved_3_id),
					array('po_status_id'=>status_po_finish_id))
				); 	
		
		elseif($id_group == admin_group_id || $id_group = gs_group_id) {
			$conditions = array();
			
		}
		
			if ($supplier_id=$this->data['Po']['supplier_id'])  {
			$conditions[] = array('supplier_id'=>$supplier_id);
		}
		
		///date filter		
		list($date_start,$date_end) = $this->set_date_filters('Po');
		$conditions[] = array('po_date >=' => ($date_start['year'] . '-' . $date_start['month'] . '-' . $date_start['day']) , 
			'po_date <=' => ($date_end['year'] . '-' . $date_end['month'] . '-' . $date_end['day']) );
			
			if ($type=='finish')
		{
			$this->Session->write('Po.report_type', 'finish');
		}
		else 
		{
			$this->Session->write('Po.report_type', 'outstanding');
		}
		
		if(DRIVER=='mysql') {
			$conditions[] = array('(SELECT if(sum(qty)-sum(qty_received)=0,1,0) FROM po_details WHERE `po_details`.`po_id` = `Po`.`id`) = ' . 
				($this->Session->read('Po.report_type')=='finish'? 1 : 0) );
		}                
        elseif(DRIVER=='mssql') {
			$conditions[] = array('(select case sum(qty-qty_received) when 0 then 1 else 0 end from po_details WHERE po_details.po_id = Po.id) = ' . 
				($this->Session->read('Po.report_type')=='finish'? 1 : 0) );
		}

		// $conditions[] = array('(SELECT if(sum(qty)-(qty_received)=0,1,0) FROM po_details where `po_details`.`po.id`)=0');

		$this->set('pos', $this->paginate($conditions));
		
		$po_statuses = $this->Po->PoStatus->find('list');
		$poDetails = $this->Po->PoDetail->find('all');
		$Currencies = $this->Po->Currency->find('all');
		
		//echo '<pre>';
		//var_dump($Currencies);
		$departments = $this->Po->Department->find('list');
		$suppliers = $this->Po->Supplier->find('list');
		$this->set(compact('po_statuses', 'departments','po_status_id', 
			'date_start','date_end',
			'suppliers','supplier_id',
			'po_department_id','type','poDetails'));

	}
	
	function ajax_recalc($id)
	{
		$this->Po->recursive=0;
		$this->layout='ajax';
		$this->autoRender=false;
		$po=$this->Po->read(null, $id);
		echo json_encode(array('data'=>$po));
	}
	
	function auto_complete ()
	{
		$this->layout='ajax';
		$this->set('pos',
		$this->Po->find('all',
			array('conditions'=>"
				Po.no LIKE '{$this->data['Po']['no']}%'
			"))
		);
	}
      
      function total_per_supplier_report()
      {
            $this->Po->recursive = 1;
			$layout=$this->data['Po']['layout'];
			
            if($this->data)
            {
                  $this->Session->write('Po.supplier_id',$this->data['Po']['supplier_id']);
                  $this->Session->write('Po.currency_id',$this->data['Po']['currency_id']);
            }
            
            if ($supplier_id=$this->Session->read('Po.supplier_id'))  {
                  $conditions[] = array('supplier_id'=>$supplier_id);
            }
            if ($currency_id=$this->Session->read('Po.currency_id'))  {
                  $conditions[] = array('currency_id'=>$currency_id);
            }
		
            ///date filter		
            list($date_start,$date_end) = $this->set_date_filters('Po');
            $conditions[] = array('po_date >=' => ($date_start['year'] . '-' . $date_start['month'] . '-' . $date_start['day']) , 
                        'po_date <=' => ($date_end['year'] . '-' . $date_end['month'] . '-' . $date_end['day']) );
				
            if(DRIVER=='mysql') {
				$conditions[] = array('(SELECT if(sum(qty)-sum(qty_received)=0,1,0) FROM po_details WHERE `po_details`.`po_id` = `Po`.`id`) = 1');  

			}                
			elseif(DRIVER=='mssql') {
				$conditions[] = array('(select case sum(qty-qty_received) when 0 then 1 else 0 end from po_details WHERE po_details.po_id = Po.id) = 1' );
			}
			            
			$conditions[] = array('Po.po_status_id'=>status_po_sent_id);
			 $this->Po->recursive=-1;
			 $pos = $this->Po->find('all',array('conditions'=>$conditions,
                'fields'=>'Po.currency_id, sum(Po.total) as total, Po.supplier_id',
				'joins'=>array(
						array(
							'table'=>'currencies',
							'alias'=>'Currency',
							'conditions'=>array('Po.currency_id=Currency.id')),
						array(
							'table'=>'suppliers',
							'alias'=>'Supplier',
							'conditions'=>array('Po.supplier_id=Supplier.id'))
						),
                'group'=>array('Po.supplier_id','Po.currency_id') ));
            $this->set('pos', $pos);
				
			$copyright_id  = $this->configs['copyright_id'];
            $currencies = $this->Po->Currency->find('list');
            $currency = $this->Po->Currency->find('list', array('fields'=>'is_desimal'));
            $suppliers = $this->Po->Supplier->find('list');
			$moduleName = 'Report > PO > Total PO Per Supplier Report';
			$this->set('title_for_layout',  $this->lastSegment($moduleName));
            $this->set(compact( 
                  'date_start','date_end','currencies', 'currency',
                  'suppliers','supplier_id', 'copyright_id', 'moduleName'));      
				  
		if($layout=='pdf')
		{
			Configure::write('debug',0); // Otherwise we cannot use this method while developing 
			$this->layout = 'pdf'; //this will use the pdf.ctp layout 
			$this->render('total_per_supplier_report_pdf'); 		
		}
		else if($layout=='xls')
		{
			$this->render('total_per_supplier_report_xls','export_xls');
		}
    }

}
?>
