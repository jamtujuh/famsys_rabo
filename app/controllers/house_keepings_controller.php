<?php
class HouseKeepingsController extends AppController {

    var $name = 'HouseKeepings';
    var $helpers = array('Ajax', 'Javascript', 'Time');
    var $components = array('RequestHandler');

    function index() {
		$this->HouseKeeping->recursive = 0;
		if(!empty($this->data))
		{
			if ($this->data['HouseKeeping']['date_start'] == $this->data['HouseKeeping']['date_end'].' '.'00:00:00.000'){
				$this->data['HouseKeeping']['date_start']['day'] = $this->data['HouseKeeping']['date_start']['day'] - 1;
			}
			$this->Session->write('HouseKeeping.name', 			$this->data['HouseKeeping']['name']);
			$this->Session->write('HouseKeeping.status', 		$this->data['HouseKeeping']['status']);
			$this->Session->write('HouseKeeping.created_by', 	$this->data['HouseKeeping']['user']);
			
		}
		
		$conditions[] = array();
		$name 	= $this->data['HouseKeeping']['name'];
		$status	= $this->data['HouseKeeping']['status'];
		$user	= $this->data['HouseKeeping']['user'];
		
		if ($name)
			$this->Session->write('HouseKeeping.name', $name);
		else if (isset($this->data['HouseKeeping']['name']))
			$this->Session->write('HouseKeeping.name', $this->data['HouseKeeping']['name']);
		if ($name = $this->Session->read('HouseKeeping.name'))
			$conditions[] = array('HouseKeeping.name' => $name);
		
		if ($status)
			$this->Session->write('HouseKeeping.status', $status);
		else if (isset($this->data['HouseKeeping']['status']))
			$this->Session->write('HouseKeeping.status', $this->data['HouseKeeping']['status']);
		if ($status = $this->Session->read('HouseKeeping.status'))
			$conditions[] = array('HouseKeeping.status' => $status);
		
		if ($user)
			$this->Session->write('HouseKeeping.created_by', $user);
		else if (isset($this->data['HouseKeeping']['user']))
			$this->Session->write('HouseKeeping.created_by', $this->data['HouseKeeping']['user']);
		if ($user = $this->Session->read('HouseKeeping.created_by'))
			$conditions[] = array('HouseKeeping.created_by' => $user);
		
		list($date_start, $date_end) = $this->set_date_filters('HouseKeeping');
            $conditions[] = array('HouseKeeping.date >=' => ($date_start['year'] . '-' . $date_start['month'] . '-' . $date_start['day'] . ' 00:00:00.000'),
                'HouseKeeping.date <=' => ($date_end['year'] . '-' . $date_end['month'] . '-' . $date_end['day'] . ' 23:59:59.000'));
		
		$this->paginate = array('order'=>'HouseKeeping.id DESC');
		$con = $this->paginate($conditions);
			
			//echo '<pre>';
			//var_dump($conditions);
			//echo '</pre>';die();
		
		$tableOptions = array('npbs'=>'MR','pos'=>'PO','delivery_orders'=>'DO', 'inlogs'=>'INLOG', 'outlogs'=>'OUTLOG');
		$statusOptions = array('1'=>'Success', '2'=>'Failed');
		$opts = $this->HouseKeeping->User->find('list',array('fields'=>'User.username', 'conditions'=>array('User.group_id'=>housekeeper_group_id)));
		$options = array();
		foreach ($opts as $opt => $usr):
			$options[$usr] = $usr;
		endforeach;
		$moduleName = 'House Keeping > List House Keeping';
		$this->set('HouseKeepings', $con);		
		$this->set(compact('options','tableOptions','statusOptions','moduleName','date_start','date_end'));
    }

	function add() {
		if(!empty($this->data)){
			$tn = $this->data['HouseKeeping']['table_name'];
			if($tn){
				$remark	= $this->data['HouseKeeping']['remark'];
				$ds	= $this->data['HouseKeeping']['ds'];
				$de = $this->data['HouseKeeping']['de'];
				$date_start = $ds['year'] . '-' . $ds['month'] . '-' . $ds['day'] . ' 00:00:00.000';
				$date_end 	= $de['year'] . '-' . $de['month'] . '-' . $de['day'] . ' 23:59:59.000';
				
				$this->Session->write('HKConf.date_start', 	$date_start);
				$this->Session->write('HKConf.date_end', 	$date_end);
				$this->Session->write('HKConf.remark', 		$remark);
				$this->Session->write('HKConf.table_name',	$tn);
				switch($tn){
					case 'npbs':
						$this->redirect(array('action' => 'get_view_npbs'));
						break;
					case 'pos':
						$this->redirect(array('action' => 'get_view_pos'));
						break;
					case 'delivery_orders':
						$this->redirect(array('action' => 'get_view_delivery_orders'));
						break;
					case 'inlogs':
						$this->redirect(array('action' => 'get_view_inlogs'));
						break;
					case 'outlogs':
						$this->redirect(array('action' => 'get_view_outlogs'));
						break;
				}
			}else{
				$this->Session->setFlash(__('Please specify the Table Name.', true));
			}
		}
		if($this->Session->read('HKConf.date_start') && $this->Session->read('HKConf.date_end')){
			$date_start	= $this->Session->read('HKConf.date_start');
			$date_end	= $this->Session->read('HKConf.date_end');
		}else{
			list($date_start, $date_end) = $this->set_date_filters('HouseKeeping');
		}
		
		$date = date('Y-m-d H:i:s');
		$tableOptions = array('npbs'=>'MR','pos'=>'PO','delivery_orders'=>'DO', 'inlogs'=>'INLOG', 'outlogs'=>'OUTLOG');
		
		$this->set(compact('date','tableOptions','date_start','date_end'));
	}
	
	/* ******************************** */
	/*				GET VIEW			*/
	/* ******************************** */
	
	function get_view_npbs(){
		$date_start = $this->Session->read('HKConf.date_start');
		$date_end 	= $this->Session->read('HKConf.date_end');
		$sql	= "select * from npbs 
					where npb_date between '".$date_start."' and '".$date_end."' ";
		$find 	= $this->HouseKeeping->query($sql);
		if($find){
			$n = 1;
			foreach($find as $loop){
				$data[$n]	= $loop[0];
				// npb status
				$sql = "select name from npb_statuses where id = '".$loop[0]['npb_status_id']."' ";
				$res = $this->HouseKeeping->query($sql);
				$data[$n]['npb_status_name']	= $res[0][0]['name'];
				// npb outstanding
				$sql = "select case SUM(qty-qty_unfilled) when 0 then 1 else 0 end as outstanding from npb_details where npb_id = '".$loop[0]['id']."' ";
				$res = $this->HouseKeeping->query($sql);
				$data[$n]['npb_outstanding']	= $res[0][0]['outstanding'];
				
				$n++;
			}
			$this->Session->write('HKData',	$data);
			$moduleName = 'House Keeping > Delete Data';
			$this->set(compact('date','date_start','date_end','moduleName', 'data'));
		}else{
			$this->Session->setFlash(__('No Data Could Be Retrieved. Please Set a Different Filter', true));
			$this->redirect(array('action'=>'add'));
		}
	}
	
	function get_view_pos(){
		$date_start = $this->Session->read('HKConf.date_start');
		$date_end 	= $this->Session->read('HKConf.date_end');
		$sql	= "select a.*, c.id as npb_id, c.no as npb_no, c.npb_status_id
					from pos a 
					left join npbs_pos b on b.po_id = a.id
					left join npbs c on c.id = b.npb_id
					where a.po_date between '".$date_start."' and '".$date_end."' ";
		$find 	= $this->HouseKeeping->query($sql);
		if($find){
			$n = 1;
			foreach($find as $loop){
				$data[$n]	= $loop[0];
				// po status
				$sql = "select name from po_statuses where id = '".$loop[0]['po_status_id']."' ";
				$res = $this->HouseKeeping->query($sql);
				$data[$n]['po_status_name']	= $res[0][0]['name'];
				// npb status
				if($loop[0]['npb_id']){
					$sql = "select name from npb_statuses where id = '".$loop[0]['npb_status_id']."' ";
					$res = $this->HouseKeeping->query($sql);
					$data[$n]['npb_status_name']	= $res[0][0]['name'];
					// npb outstanding
					$sql = "select case SUM(qty-qty_unfilled) when 0 then 1 else 0 end as outstanding from npb_details where npb_id = '".$loop[0]['npb_id']."' ";
					$res = $this->HouseKeeping->query($sql);
					$data[$n]['npb_outstanding']	= $res[0][0]['outstanding'];
				}else{
					$data[$n]['npb_status_name']	= null;
					$data[$n]['npb_outstanding']	= null;
				}
				
				$n++;
			}
			$this->Session->write('HKData',	$data);
			$moduleName = 'House Keeping > Delete Data';
			$this->set(compact('date','date_start','date_end','moduleName', 'data'));
		}else{
			$this->Session->setFlash(__('No Data Could Be Retrieved. Please Set a Different Filter', true));
			$this->redirect(array('action'=>'add'));
		}
	}
	
	function get_view_delivery_orders(){
		$date_start = $this->Session->read('HKConf.date_start');
		$date_end 	= $this->Session->read('HKConf.date_end');
		$sql	= "select a.*, b.id as po_id, b.no as po_no, b.po_status_id, d.id as npb_id, d.no as npb_no, d.npb_status_id
					from delivery_orders a 
					left join pos b on b.id = a.po_id
					left join npbs_pos c on c.po_id = b.id
					left join npbs d on d.id = c.npb_id
					where a.do_date between '".$date_start."' and '".$date_end."' ";
		$find 	= $this->HouseKeeping->query($sql);
		if($find){	
			$n = 1;
			foreach($find as $loop){
				$data[$n]	= $loop[0];
				// do status
				$sql = "select name from delivery_order_statuses where id = '".$loop[0]['delivery_order_status_id']."' ";
				$res = $this->HouseKeeping->query($sql);
				$data[$n]['do_status_name']	= $res[0][0]['name'];
				// po status
				if($loop[0]['po_id']){
					$sql = "select name from po_statuses where id = '".$loop[0]['po_status_id']."' ";
					$res = $this->HouseKeeping->query($sql);
					$data[$n]['po_status_name']	= $res[0][0]['name'];
				}else{
					$data[$n]['po_status_name']	= null;
				}	
				// npb status
				if($loop[0]['npb_id']){
					$sql = "select name from npb_statuses where id = '".$loop[0]['npb_status_id']."' ";
					$res = $this->HouseKeeping->query($sql);
					$data[$n]['npb_status_name']	= $res[0][0]['name'];
					// npb outstanding
					$sql = "select case SUM(qty-qty_unfilled) when 0 then 1 else 0 end as outstanding from npb_details where npb_id = '".$loop[0]['npb_id']."' ";
					$res = $this->HouseKeeping->query($sql);
					$data[$n]['npb_outstanding']	= $res[0][0]['outstanding'];
				}else{
					$data[$n]['npb_status_name']	= null;
					$data[$n]['npb_outstanding']	= null;
				}
				
				$n++;
			}
			$this->Session->write('HKData',	$data);
			$moduleName = 'House Keeping > Delete Data';
			$this->set(compact('date','date_start','date_end','moduleName', 'data'));
		}else{
			$this->Session->setFlash(__('No Data Could Be Retrieved. Please Set a Different Filter', true));
			$this->redirect(array('action'=>'add'));
		}
	}
	
	function get_view_inlogs(){
		$date_start = $this->Session->read('HKConf.date_start');
		$date_end 	= $this->Session->read('HKConf.date_end');
		$sql	= "select a.*, b.id as po_id, b.no as po_no, b.po_status_id, c.id as do_id, c.no as do_no, c.delivery_order_status_id, e.id as npb_id, e.no as npb_no, e.npb_status_id, f.id as invoice_id, f.no as invoice_no, f.status_invoice_id as invoice_status_id
					from inlogs a 
					left join pos b on b.id = a.po_id
					left join delivery_orders c on c.id = a.delivery_order_id
					left join npbs_pos d on d.po_id = b.id
					left join npbs e on e.id = d.npb_id
					left join invoices f on f.id = a.invoice_id
					where a.date between '".$date_start."' and '".$date_end."' ";
		$find 	= $this->HouseKeeping->query($sql);
		if($find){
			$n = 1;
			foreach($find as $loop){
				$data[$n]	= $loop[0];
				// inlog status
				$sql = "select name from inlog_statuses where id = '".$loop[0]['inlog_status_id']."' ";
				$res = $this->HouseKeeping->query($sql);
				$data[$n]['inlog_status_name']	= $res[0][0]['name'];
				// invoice status
				if($loop[0]['invoice_id']){
					$sql = "select name from invoice_statuses where id = '".$loop[0]['invoice_status_id']."' ";
					$res = $this->HouseKeeping->query($sql);
					$data[$n]['invoice_status_name']	= $res[0][0]['name'];
				}else{
					$data[$n]['invoice_status_name']	= null;
				}
				// do status
				if($loop[0]['do_id']){
					$sql = "select name from delivery_order_statuses where id = '".$loop[0]['delivery_order_status_id']."' ";
					$res = $this->HouseKeeping->query($sql);
					$data[$n]['do_status_name']	= $res[0][0]['name'];
				}else{
					$data[$n]['do_status_name'] = null;
				}				
				// po status
				if($loop[0]['po_id']){
					$sql = "select name from po_statuses where id = '".$loop[0]['po_status_id']."' ";
					$res = $this->HouseKeeping->query($sql);
					$data[$n]['po_status_name']	= $res[0][0]['name'];
				}else{
					$data[$n]['po_status_name']	= null;
				}
				// npb status
				if($loop[0]['npb_id']){
					$sql = "select name from npb_statuses where id = '".$loop[0]['npb_status_id']."' ";
					$res = $this->HouseKeeping->query($sql);
					$data[$n]['npb_status_name']	= $res[0][0]['name'];
					// npb outstanding
					$sql = "select case SUM(qty-qty_unfilled) when 0 then 1 else 0 end as outstanding from npb_details where npb_id = '".$loop[0]['npb_id']."' ";
					$res = $this->HouseKeeping->query($sql);
					$data[$n]['npb_outstanding']	= $res[0][0]['outstanding'];
				}else{
					$data[$n]['npb_status_name']	= null;
					$data[$n]['npb_outstanding']	= null;
				}
				
				$n++;
			}
			$this->Session->write('HKData',	$data);
			$moduleName = 'House Keeping > Delete Data';
			$this->set(compact('date','date_start','date_end','moduleName', 'data'));
		}else{
			$this->Session->setFlash(__('No Data Could Be Retrieved. Please Set a Different Filter', true));
			$this->redirect(array('action'=>'add'));
		}
	}
	
	function get_view_outlogs(){
		$date_start = $this->Session->read('HKConf.date_start');
		$date_end 	= $this->Session->read('HKConf.date_end');
		$sql	= "select a.*, b.id as npb_id, b.no as npb_no, b.npb_status_id, d.id as po_id, d.no as po_no, d.po_status_id
					from outlogs a 
					left join npbs b on b.id = a.npb_id
					left join npbs_pos c on c.npb_id = b.id
					left join pos d on d.id = c.po_id
					where date between '".$date_start."' and '".$date_end."' ";
		$find 	= $this->HouseKeeping->query($sql);
		if($find){
			$n = 1;
			foreach($find as $loop){
				$data[$n]	= $loop[0];
				// outlog status
				$sql = "select name from outlog_statuses where id = '".$loop[0]['outlog_status_id']."' ";
				$res = $this->HouseKeeping->query($sql);
				$data[$n]['outlog_status_name']	= $res[0][0]['name'];
				// po status
				if($loop[0]['po_id']){
					$sql = "select name from po_statuses where id = '".$loop[0]['po_status_id']."' ";
					$res = $this->HouseKeeping->query($sql);
					$data[$n]['po_status_name']	= $res[0][0]['name'];
				}else{
					$data[$n]['po_status_name']	= null;
				}
				// npb status
				if($loop[0]['npb_id']){
					$sql = "select name from npb_statuses where id = '".$loop[0]['npb_status_id']."' ";
					$res = $this->HouseKeeping->query($sql);
					$data[$n]['npb_status_name']	= $res[0][0]['name'];
					// npb outstanding
					$sql = "select case SUM(qty-qty_unfilled) when 0 then 1 else 0 end as outstanding from npb_details where npb_id = '".$loop[0]['npb_id']."' ";
					$res = $this->HouseKeeping->query($sql);
					$data[$n]['npb_outstanding']	= $res[0][0]['outstanding'];				
				}else{
					$data[$n]['npb_status_name']	= null;
					$data[$n]['npb_outstanding']	= null;
				}
				
				$n++;
			}
			$this->Session->write('HKData',	$data);
			$moduleName = 'House Keeping > Delete Data';
			$this->set(compact('date','date_start','date_end','moduleName', 'data'));
		}else{
			$this->Session->setFlash(__('No Data Could Be Retrieved. Please Set a Different Filter', true));
			$this->redirect(array('action'=>'add'));
		}
	}
	
	/* ******************************** */
	/*				PROCESS				*/
	/* ******************************** */
	
	function process_npbs(){
		$ids 	= $this->data['HouseKeeping']['no'];
		
		$dataHK	= $this->Session->read('HKData');
		$totalData	= count($dataHK);
		for($count = 1; $count <= $totalData; $count++){
			if(in_array($count, $ids)){
				$id		= $dataHK[ $count ][ 'id' ];
				if($id){
					$delete	= $this->delete_npb_by_id($id);
					// delete npb detail
					$this->delete_npb_details('npb',$id);
					// delete npb pos
					$this->delete_npbs_pos('npb',$id);
					// delete inlog detail
					$this->delete_inlog_details('npb',$id);
					// delete outlog
					$this->delete_outlogs_by_id_prefix('npb',$id);
					// delete ledger
					$this->delete_inventory_ledgers('npb',$id);
				}
			}
		}
		
		$params['name'] 		= $this->Session->read('HKConf.table_name');
		$params['date'] 		= date('Y-m-d H:i:s.000');
		$params['date_start'] 	= $this->Session->read('HKConf.date_start');
		$params['date_end'] 	= $this->Session->read('HKConf.date_end');
		$params['remark'] 		= $this->Session->read('HKConf.remark');
		$params['created_by'] 	= $this->Session->read('Userinfo.username');
		$params['status'] 		= $delete;
		$this->HouseKeeping->create();
		if ($this->HouseKeeping->save($params)) {
			$this->Session->write('HKConf', null);
			$hk_id	= $this->HouseKeeping->id;
			
			$this->Session->setFlash(__('House Keeping has been processed.', true), 'default', array('class' => 'ok'));
			$this->redirect(array('action'=>'view',$hk_id));
		}else{
			$this->Session->setFlash(__('House Keeping could not be processed. Please, try again.', true));
			$this->redirect(array('action'=>'add'));
		}
	}
	
	function process_pos(){
		$ids 	= $this->data['HouseKeeping']['no'];
		$dataHK	= $this->Session->read('HKData');
		$totalData	= count($dataHK);
		
		for($count = 1; $count <= $totalData; $count++){
			if(in_array($count, $ids)){
				$id		= $dataHK[ $count ][ 'id' ];
				if($id){
					// delete po
					$delete	= $this->delete_po_by_id($id);
					// delete po detail
					$this->delete_po_details('po',$id);
					// delete po payments
					$this->delete_po_payments('po',$id);
					// delete npb detail
					$this->delete_npb_details('po',$id);
					// delete npb pos
					$this->delete_npbs_pos('po',$id);
					// delete inlogs
					$this->delete_inlogs_by_id_prefix('po',$id);
					// delete invoices
					//$this->delete_invoices_by_id('po',$id);
					// delete invoice detail
					//$this->delete_invoice_details('po',$id);
					// delete invoice payments
					//$this->delete_invoice_payments('po',$id);
					// delete invoice po
					//$this->delete_invoice_pos('po',$id);
					// delete ledger
					$this->delete_inventory_ledgers('po',$id); 
				}
			}
		}
		
		$params['name'] 		= $this->Session->read('HKConf.table_name');
		$params['date'] 		= date('Y-m-d H:i:s.000');
		$params['date_start'] 	= $this->Session->read('HKConf.date_start');
		$params['date_end'] 	= $this->Session->read('HKConf.date_end');
		$params['remark'] 		= $this->Session->read('HKConf.remark');
		$params['created_by'] 	= $this->Session->read('Userinfo.username');
		$params['status'] 		= $delete;
		$this->HouseKeeping->create();
		if ($this->HouseKeeping->save($params)) {
			$this->Session->write('HKConf', null);
			$hk_id	= $this->HouseKeeping->id;
			
			$this->Session->setFlash(__('House Keeping has been processed.', true), 'default', array('class' => 'ok'));
			$this->redirect(array('action'=>'view',$hk_id));
		}else{
			$this->Session->setFlash(__('House Keeping could not be processed. Please, try again.', true));
			$this->redirect(array('action'=>'add'));
		}
	}
	
	function process_delivery_orders(){
		$ids 	= $this->data['HouseKeeping']['no'];
		$dataHK	= $this->Session->read('HKData');
		$totalData	= count($dataHK);
		
		for($count = 1; $count <= $totalData; $count++){
			if(in_array($count, $ids)){
				$id		= $dataHK[ $count ][ 'id' ];
				if($id){
					// delete do
					$delete	= $this->delete_delivery_order_by_id($id);
					// delete delivery order detail
					$this->delete_delivery_order_details('delivery_order',$id);
					// delete inlogs
					$this->delete_inlogs_by_id_prefix('delivery_order',$id);
				}
			}
		}
		
		$params['name'] 		= $this->Session->read('HKConf.table_name');
		$params['date'] 		= date('Y-m-d H:i:s.000');
		$params['date_start'] 	= $this->Session->read('HKConf.date_start');
		$params['date_end'] 	= $this->Session->read('HKConf.date_end');
		$params['remark'] 		= $this->Session->read('HKConf.remark');
		$params['created_by'] 	= $this->Session->read('Userinfo.username');
		$params['status'] 		= $delete;
		$this->HouseKeeping->create();
		if ($this->HouseKeeping->save($params)) {
			$this->Session->write('HKConf', null);
			$hk_id	= $this->HouseKeeping->id;
			
			$this->Session->setFlash(__('House Keeping has been processed.', true), 'default', array('class' => 'ok'));
			$this->redirect(array('action'=>'view',$hk_id));
		}else{
			$this->Session->setFlash(__('House Keeping could not be processed. Please, try again.', true));
			$this->redirect(array('action'=>'add'));
		}	
	}
	
	function process_inlogs(){
		$ids 	= $this->data['HouseKeeping']['no'];
		$dataHK	= $this->Session->read('HKData');
		$totalData	= count($dataHK);
		
		for($count = 1; $count <= $totalData; $count++){
			if(in_array($count, $ids)){
				$id		= $dataHK[ $count ][ 'id' ];
				if($id){
					// delete inlog
					$delete	= $this->delete_inlog_by_id($id);
					// delete inlog detail
					$this->delete_inlog_details('inlog',$id);
					// delete ledger
					$this->delete_inventory_ledgers('inlog',$id);
				}
			}
		}
		
		$params['name'] 		= $this->Session->read('HKConf.table_name');
		$params['date'] 		= date('Y-m-d H:i:s.000');
		$params['date_start'] 	= $this->Session->read('HKConf.date_start');
		$params['date_end'] 	= $this->Session->read('HKConf.date_end');
		$params['remark'] 		= $this->Session->read('HKConf.remark');
		$params['created_by'] 	= $this->Session->read('Userinfo.username');
		$params['status'] 		= $delete;
		$this->HouseKeeping->create();
		if ($this->HouseKeeping->save($params)) {
			$this->Session->write('HKConf', null);
			$hk_id	= $this->HouseKeeping->id;
			
			$this->Session->setFlash(__('House Keeping has been processed.', true), 'default', array('class' => 'ok'));
			$this->redirect(array('action'=>'view',$hk_id));
		}else{
			$this->Session->setFlash(__('House Keeping could not be processed. Please, try again.', true));
			$this->redirect(array('action'=>'add'));
		}
	}
	
	function process_outlogs(){
		$ids 	= $this->data['HouseKeeping']['no'];
		$dataHK	= $this->Session->read('HKData');
		$totalData	= count($dataHK);
		
		for($count = 1; $count <= $totalData; $count++){
			if(in_array($count, $ids)){
				$id		= $dataHK[ $count ][ 'id' ];
				if($id){
					// delete outlog
					$delete	= $this->delete_outlog_by_id($id);
					// delete outlog detail
					$this->delete_outlog_details('outlog',$id);
					// delete ledger
					$this->delete_inventory_ledgers('outlog',$id);
				}
			}
		}
		
		$params['name'] 		= $this->Session->read('HKConf.table_name');
		$params['date'] 		= date('Y-m-d H:i:s.000');
		$params['date_start'] 	= $this->Session->read('HKConf.date_start');
		$params['date_end'] 	= $this->Session->read('HKConf.date_end');
		$params['remark'] 		= $this->Session->read('HKConf.remark');
		$params['created_by'] 	= $this->Session->read('Userinfo.username');
		$params['status'] 		= $delete;
		$this->HouseKeeping->create();
		if ($this->HouseKeeping->save($params)) {
			$this->Session->write('HKConf', null);
			$hk_id	= $this->HouseKeeping->id;
			
			$this->Session->setFlash(__('House Keeping has been processed.', true), 'default', array('class' => 'ok'));
			$this->redirect(array('action'=>'view',$hk_id));
		}else{
			$this->Session->setFlash(__('House Keeping could not be processed. Please, try again.', true));
			$this->redirect(array('action'=>'add'));
		}
	}
	
	function save_log($params){
		$this->HouseKeeping->create();
		if ($this->HouseKeeping->save($params)) {
			return true;
		}else{
			return false;
		}
	}
	  
	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Id', true));
			$this->redirect(array('action' => 'index'));
		}

		$this->HouseKeeping->recursive = 1;
		$HouseKeeping = $this->HouseKeeping->read(null, $id);
		$this->Session->write('HouseKeeping.id', $id);
		$this->set(compact('HouseKeeping'));
    }
	
	/* ******************************** */
	/*			MAIN TABLE DELETE		*/
	/* ******************************** */
	
	function delete_npb_by_id($id){
		$tmp_fields = 'npb_id, no, npb_date, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, supplier_id, req_date, npb_status_id, request_type_id, notes, created_by, created_date, reject_notes, reject_by, reject_date, cancel_notes, cancel_by, cancel_date, is_purchase_request, date_finish, is_printed, approved_by, approved_date, approved_history, approver_one, approver_two, approver_three, approver_one_date, approver_two_date, approver_three_date';
		$npb_fields = 'id, no, npb_date, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, supplier_id, req_date, npb_status_id, request_type_id, notes, created_by, created_date, reject_notes, reject_by, reject_date, cancel_notes, cancel_by, cancel_date, is_purchase_request, date_finish, is_printed, approved_by, approved_date, approved_history, approver_one, approver_two, approver_three, approver_one_date, approver_two_date, approver_three_date';
		$copy_data = $this->HouseKeeping->query('insert into tmp_npbs ('.$tmp_fields.') select '.$npb_fields.' from npbs where id = "'.$id.'" ');		
			// delete npb after copied						
			$execute = $this->HouseKeeping->query('delete from npbs where id = "'.$id.'" ');
			if($execute){return 1;}else{return 2;}
	}
	
	function delete_po_by_id($id){
		$tmp_fields = 'po_id, no, po_date, delivery_date, supplier_id, department_id, po_status_id, currency_id, description, convert_invoice, created, approval_info, wht_rate, vat_rate, vat_base, vat_base_cur, wht_base, wht_base_cur, sub_total, sub_total_cur, discount, discount_cur, after_disc, after_disc_cur, wht_total, wht_total_cur, vat_total, vat_total_cur, total, total_cur, billing_address, shipping_address, reject_notes, reject_by, reject_date, cancel_notes, cancel_by, cancel_date, payment_term, rp_rate, date_finish, printed, request_type_id, signer_1, signer_2, po_address, down_payment, is_down_payment_journal_generated, down_payment_journal_generated_date, approved_by, approved_date, daily_penalty, approval_note_1, approval_note_2';
		$pos_fields = 'id, no, po_date, delivery_date, supplier_id, department_id, po_status_id, currency_id, description, convert_invoice, created, approval_info, wht_rate, vat_rate, vat_base, vat_base_cur, wht_base, wht_base_cur, sub_total, sub_total_cur, discount, discount_cur, after_disc, after_disc_cur, wht_total, wht_total_cur, vat_total, vat_total_cur, total, total_cur, billing_address, shipping_address, reject_notes, reject_by, reject_date, cancel_notes, cancel_by, cancel_date, payment_term, rp_rate, date_finish, printed, request_type_id, signer_1, signer_2, po_address, down_payment, is_down_payment_journal_generated, down_payment_journal_generated_date, approved_by, approved_date, daily_penalty, approval_note_1, approval_note_2';
		$copyData = $this->HouseKeeping->query('insert into tmp_pos ('.$tmp_fields.') select '.$pos_fields.' from pos where id = "'.$id.'" ');
			// delete po after copied						
			$execute = $this->HouseKeeping->query('delete from pos where id = "'.$id.'" ');
			if($execute){return 1;}else{return 2;}
	}
	
	function delete_delivery_order_by_id($id){
		$tmp_fields = 'delivery_order_id, po_id, no, do_date, delivery_date, supplier_id, department_id, delivery_order_status_id, currency_id, description, convert_invoice, created, approval_info, wht_rate, vat_rate, vat_base, vat_base_cur, wht_base, wht_base_cur, sub_total, sub_total_cur, discount, discount_cur, after_disc, after_disc_cur, wht_total, wht_total_cur, vat_total, vat_total_cur, total, total_cur, billing_address, shipping_address, rp_rate, request_type_id, convert_asset, is_journal_generated, journal_generated_date, is_first, approved_by, approved_date, cancel_by, cancel_date, cancel_note';
		$do_fields = 'id, po_id, no, do_date, delivery_date, supplier_id, department_id, delivery_order_status_id, currency_id, description, convert_invoice, created, approval_info, wht_rate, vat_rate, vat_base, vat_base_cur, wht_base, wht_base_cur, sub_total, sub_total_cur, discount, discount_cur, after_disc, after_disc_cur, wht_total, wht_total_cur, vat_total, vat_total_cur, total, total_cur, billing_address, shipping_address, rp_rate, request_type_id, convert_asset, is_journal_generated, journal_generated_date, is_first, approved_by, approved_date, cancel_by, cancel_date, cancel_note';
		$copyData = $this->HouseKeeping->query('insert into tmp_delivery_orders ('.$tmp_fields.') select '.$do_fields.' from delivery_orders where id = "'.$id.'" ');
			// delete delivery order after copied						
			$execute = $this->HouseKeeping->query('delete from delivery_orders where id = "'.$id.'" ');
			if($execute){return 1;}else{return 2;}
	}
	
	function delete_inlog_by_id($id){
		$tmp_fields = 'inlog_id, no, date, supplier_id, po_id, created_at, created_by, invoice_id, delivery_order_id, inlog_status_id, approved_by, approved_date, cancel_notes, cancel_by, cancel_date, department_id, business_type_id, cost_center_id';
		$inlog_fields = 'id, no, date, supplier_id, po_id, created_at, created_by, invoice_id, delivery_order_id, inlog_status_id, approved_by, approved_date, cancel_notes, cancel_by, cancel_date, department_id, business_type_id, cost_center_id';
		$copyData = $this->HouseKeeping->query('insert into tmp_inlogs ('.$tmp_fields.') select '.$inlog_fields.' from inlogs where id = "'.$id.'" ');
			// delete inlog after copied						
			$execute = $this->HouseKeeping->query('delete from inlogs where id = "'.$id.'" ');
			if($execute){return 1;}else{return 2;}
	}
	
	function delete_outlog_by_id($id){
		$tmp_fields = 'outlog_id, no, date, department_id, created_at, created_by, npb_id, is_process, is_printed, outlog_status_id, approved_by, approved_date, reject_notes, reject_by, reject_date, cancel_notes, cancel_by, cancel_date, business_type_id, cost_center_id, retur_id';
		$outlog_fields = 'id, no, date, department_id, created_at, created_by, npb_id, is_process, is_printed, outlog_status_id, approved_by, approved_date, reject_notes, reject_by, reject_date, cancel_notes, cancel_by, cancel_date, business_type_id, cost_center_id, retur_id';
		$copyData = $this->HouseKeeping->query('insert into tmp_outlogs ('.$tmp_fields.') select '.$outlog_fields.' from outlogs where id = "'.$id.'" ');
			// delete outlog after copied						
			$execute = $this->HouseKeeping->query('delete from outlogs where id = "'.$id.'" ');
			if($execute){return 1;}else{return 2;}
	}
	
	/* ******************************** */
	/*			DETAILED DELETE			*/
	/* ******************************** */
	
	function delete_npb_details($prefix = null, $id = null){
		$tmp_detail_fields = 'npb_detail_id, npb_id, po_id, movement_id, item_id, color, brand, type, fulfillment_id, qty, price, price_cur, amount, amount_cur, currency_id, rp_rate, descr, discount, discount_cur, amount_net, amount_net_cur, date_finish, qty_filled, qty_unfilled, unit_id, outlog_id, process_type_id';
		$detail_fields = 'id, npb_id, po_id, movement_id, item_id, color, brand, type, fulfillment_id, qty, price, price_cur, amount, amount_cur, currency_id, rp_rate, descr, discount, discount_cur, amount_net, amount_net_cur, date_finish, qty_filled, qty_unfilled, unit_id, outlog_id, process_type_id';
		$copyData= $this->HouseKeeping->query('insert into tmp_npb_details ('.$tmp_detail_fields.') select '.$detail_fields.' from npb_details where '.$prefix.'_id = "'.$id.'" ');
		$execute = $this->HouseKeeping->query('delete from npb_details where '.$prefix.'_id = "'.$id.'" ');
		if ($prefix == 'npb'){
			$res = $this->HouseKeeping->query('select id from npb_details where npb_id = "'.$id.'" ');
			foreach($res as $d){
				$this->delete_po_details('npb_detail',$d[0]['id']); // delete po detail
			}
		}
			
	}
	
	function delete_po_details($prefix = null, $id = null){
		$tmp_detail_fields = 'po_detail_id, po_id, asset_category_id, item_code, name, color, brand, type, qty, qty_received, price, price_cur, amount, amount_cur, discount, discount_cur, amount_after_disc, amount_after_disc_cur, vat, vat_cur, amount_nett, amount_nett_cur, currency_id, rp_rate, npb_id, umurek, is_vat, is_wht, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, item_id, npb_detail_id';
		$detail_fields = 'id, po_id, asset_category_id, item_code, name, color, brand, type, qty, qty_received, price, price_cur, amount, amount_cur, discount, discount_cur, amount_after_disc, amount_after_disc_cur, vat, vat_cur, amount_nett, amount_nett_cur, currency_id, rp_rate, npb_id, umurek, is_vat, is_wht, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, item_id, npb_detail_id';
		$copyData = $this->HouseKeeping->query('insert into tmp_po_details ('.$tmp_detail_fields.') select '.$detail_fields.' from po_details where '.$prefix.'_id = "'.$id.'" ');
		$execute = $this->HouseKeeping->query('delete from po_details where '.$prefix.'_id = "'.$id.'" ');
	}
	
	function delete_po_payments($prefix = null, $id = null){
		$tmp_detail_fields = 'po_payment_id, po_id, term_no, term_percent, date_due, date_paid, amount_due, amount_paid, description, amount_po';
		$detail_fields = 'id, po_id, term_no, term_percent, date_due, date_paid, amount_due, amount_paid, description, amount_po';
		$copyData = $this->HouseKeeping->query('insert into tmp_po_payments ('.$tmp_detail_fields.') select '.$detail_fields.' from po_payments where '.$prefix.'_id = "'.$id.'" ');
		$execute = $this->HouseKeeping->query('delete from po_payments where '.$prefix.'_id = "'.$id.'" ');
	}
	
	function delete_delivery_order_details($prefix = null, $id = null){
		$tmp_detail_fields = 'delivery_order_detail_id, delivery_order_id, po_id, po_detail_id, asset_category_id, item_code, name, color, brand, type, qty, qty_received, price, price_cur, amount, amount_cur, discount, discount_cur, amount_after_disc, amount_after_disc_cur, vat, vat_cur, amount_nett, amount_nett_cur, currency_id, rp_rate, npb_id, umurek, is_vat, is_wht, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, item_id, discount_unit_cur, qty_outstanding';
		$detail_fields = 'id, delivery_order_id, po_id, po_detail_id, asset_category_id, item_code, name, color, brand, type, qty, qty_received, price, price_cur, amount, amount_cur, discount, discount_cur, amount_after_disc, amount_after_disc_cur, vat, vat_cur, amount_nett, amount_nett_cur, currency_id, rp_rate, npb_id, umurek, is_vat, is_wht, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, item_id, discount_unit_cur, qty_outstanding';
		$copyData = $this->HouseKeeping->query('insert into tmp_delivery_order_details ('.$tmp_detail_fields.') select '.$detail_fields.' from delivery_order_details where '.$prefix.'_id = "'.$id.'" ');
		$execute = $this->HouseKeeping->query('delete from delivery_order_details where '.$prefix.'_id = "'.$id.'" ');
	}
	
	function delete_inlog_details($prefix = null, $id = null){
		$tmp_detail_fields = 'inlog_detail_id, inlog_id, item_id, qty, price, amount, posting, npb_id, can_ledger';
		$detail_fields = 'id, inlog_id, item_id, qty, price, amount, posting, npb_id, can_ledger';
		$copyData = $this->HouseKeeping->query('insert into tmp_inlog_details ('.$tmp_detail_fields.') select '.$detail_fields.' from inlog_details where '.$prefix.'_id = "'.$id.'" ');
		$execute = $this->HouseKeeping->query('delete from inlog_details where '.$prefix.'_id = "'.$id.'" ');
	}
	
	function delete_outlog_details($prefix = null, $id = null){
		$tmp_detail_fields = 'outlog_detail_id, outlog_id, item_id, qty, price, amount, posting, npb_id, retur_id';
		$detail_fields = 'id, outlog_id, item_id, qty, price, amount, posting, npb_id, retur_id';
		$copyData = $this->HouseKeeping->query('insert into tmp_outlog_details ('.$tmp_detail_fields.') select '.$detail_fields.' from outlog_details where '.$prefix.'_id = "'.$id.'" ');
		$execute = $this->HouseKeeping->query('delete from outlog_details where '.$prefix.'_id = "'.$id.'" ');
	}
	
	function delete_invoice_details($prefix = null, $id = null){
		$tmp_detail_fields = 'invoice_detail_id, invoice_id, asset_category_id, name, color, brand, type, qty, price, price_cur, amount, amount_cur, discount, discount_cur, amount_after_disc, amount_after_disc_cur, vat, vat_cur, wht, wht_cur, amount_nett, amount_nett_cur, currency_id, rp_rate, vat_rate, wht_rate, npb_id, po_id, umurek, is_vat, is_wht, department_id, item_id';
		$detail_fields = 'id, invoice_id, asset_category_id, name, color, brand, type, qty, price, price_cur, amount, amount_cur, discount, discount_cur, amount_after_disc, amount_after_disc_cur, vat, vat_cur, wht, wht_cur, amount_nett, amount_nett_cur, currency_id, rp_rate, vat_rate, wht_rate, npb_id, po_id, umurek, is_vat, is_wht, department_id, item_id';
		$copyData = $this->HouseKeeping->query('insert into tmp_invoice_details ('.$tmp_detail_fields.') select '.$detail_fields.' from invoice_details where '.$prefix.'_id = "'.$id.'" ');
		$execute = $this->HouseKeeping->query('delete from invoice_details where '.$prefix.'_id = "'.$id.'" ');
	}
	
	function delete_inventory_ledgers($prefix = null, $id = null){
		$tmp_detail_fields = 'inventory_ledger_id, date, item_id, qty, in_out, price, amount, doc_id, po_id, inlog_id, outlog_id, retur_id, supplier_retur_id, supplier_retur_detail_id, retur_detail_id, inlog_detail_id, outlog_detail_id, supplier_replace_id, supplier_replace_detail_id, department_id, business_type_id, cost_center_id, date_of_transaction, npb_id';
		$detail_fields = 'id, date, item_id, qty, in_out, price, amount, doc_id, po_id, inlog_id, outlog_id, retur_id, supplier_retur_id, supplier_retur_detail_id, retur_detail_id, inlog_detail_id, outlog_detail_id, supplier_replace_id, supplier_replace_detail_id, department_id, business_type_id, cost_center_id, date_of_transaction, npb_id';
		$copyData = $this->HouseKeeping->query('insert into tmp_inventory_ledgers ('.$tmp_detail_fields.') select '.$detail_fields.' from inventory_ledgers where '.$prefix.'_id = '.$id);
		$this->HouseKeeping->query('delete from inventory_ledgers where '.$prefix.'_id = '.$id);
	}
	
	function delete_invoice_payments($prefix = null, $id = null){
		$tmp_detail_fields = 'invoice_payment_id, invoice_id, no, term_no, term_percent, date_due, date_paid, amount_due, amount_paid, description, amount_invoice, amount_po, po_id, po_payment_id, bank_account_id, bank_account_type_id, is_posted, posted_date, invoice_payment_status_id, processing, economic_ages_id';
		$detail_fields = 'id, invoice_id, no, term_no, term_percent, date_due, date_paid, amount_due, amount_paid, description, amount_invoice, amount_po, po_id, po_payment_id, bank_account_id, bank_account_type_id, is_posted, posted_date, invoice_payment_status_id, processing, economic_ages_id';
		$copyData = $this->HouseKeeping->query('insert into tmp_invoice_payments ('.$tmp_detail_fields.') select '.$detail_fields.' from invoice_payments where '.$prefix.'_id = "'.$id.'" and invoice_payment_status_id = "3" ');
		$execute = $this->HouseKeeping->query('delete from invoice_payments where '.$prefix.'_id = "'.$id.'" and invoice_payment_status_id = "3" ');
	}
	
	function delete_invoice_delivery_orders($inv_id = null, $id = null){
		$tmp_detail_fields = 'invoice_delivery_orders_id, invoice_id, delivery_order_id';
		$detail_fields = 'id, invoice_id, delivery_order_id';
		$copyData = $this->HouseKeeping->query('insert into tmp_invoice_delivery_orders ('.$tmp_detail_fields.') select '.$detail_fields.' from invoices_delivery_orders where delivery_order_id = "'.$id.'" and invoice_id = "'.$inv_id.'" ');
		$execute = $this->HouseKeeping->query('delete from invoices_delivery_orders where delivery_order_id = "'.$id.'" and invoice_id = "'.$inv_id.'" ');
	}
	
	function delete_invoice_pos($inv_id = null, $id = null){
		$tmp_detail_fields = 'invoices_pos_id, invoice_id, po_id';
		$detail_fields = 'id, invoice_id, po_id';
		$copyData = $this->HouseKeeping->query('insert into tmp_invoices_pos ('.$tmp_detail_fields.') select '.$detail_fields.' from invoices_pos where po_id = "'.$id.'" and invoice_id = "'.$inv_id.'" ');
		$execute = $this->HouseKeeping->query('delete from invoices_pos where po_id = "'.$id.'" and invoice_id = "'.$inv_id.'" ');
	}
	
	function delete_npbs_pos($prefix = null, $id = null){
		$tmp_detail_fields = 'npb_pos_id, npb_id, po_id';
		$detail_fields = 'id, npb_id, po_id';
		$copyData = $this->HouseKeeping->query('insert into tmp_npbs_pos ('.$tmp_detail_fields.') select '.$detail_fields.' from npbs_pos where '.$prefix.'_id = "'.$id.'" ');
		$execute = $this->HouseKeeping->query('delete from npbs_pos where '.$prefix.'_id = "'.$id.'" ');
	}
	
	function delete_inlogs_by_id_prefix($prefix = null, $id = null){
		$tmp_detail_fields = 'inlog_id, no, date, supplier_id, po_id, created_at, created_by, invoice_id, delivery_order_id, inlog_status_id, approved_by, approved_date, cancel_notes, cancel_by, cancel_date, department_id, business_type_id, cost_center_id';
		$detail_fields = 'id, no, date, supplier_id, po_id, created_at, created_by, invoice_id, delivery_order_id, inlog_status_id, approved_by, approved_date, cancel_notes, cancel_by, cancel_date, department_id, business_type_id, cost_center_id';
		$copyData = $this->HouseKeeping->query('insert into tmp_inlogs ('.$tmp_detail_fields.') select '.$detail_fields.' from inlogs where '.$prefix.'_id = "'.$id.'" ');
		$res = $this->HouseKeeping->query('select id from inlogs where '.$prefix.'_id = "'.$id.'" ');
		$execute = $this->HouseKeeping->query('delete from inlogs where '.$prefix.'_id = "'.$id.'" ');
		foreach($res as $data){
			$this->delete_inlog_details('inlog',$data[0]['id']);
		}
	}
	
	function delete_outlogs_by_id_prefix($prefix = null, $id = null){
		$tmp_detail_fields = 'outlog_id, no, date, department_id, created_at, created_by, npb_id, is_process, is_printed, outlog_status_id, approved_by, approved_date, reject_notes, reject_by, reject_date, cancel_notes, cancel_by, cancel_date, business_type_id, cost_center_id, retur_id';
		$detail_fields = 'id, no, date, department_id, created_at, created_by, npb_id, is_process, is_printed, outlog_status_id, approved_by, approved_date, reject_notes, reject_by, reject_date, cancel_notes, cancel_by, cancel_date, business_type_id, cost_center_id, retur_id';
		$copyData = $this->HouseKeeping->query('insert into tmp_outlogs ('.$tmp_detail_fields.') select '.$detail_fields.' from outlogs where '.$prefix.'_id = "'.$id.'" ');
		$res = $this->HouseKeeping->query('select id from outlogs where '.$prefix.'_id = "'.$id.'" ');
		$execute = $this->HouseKeeping->query('delete from outlogs where '.$prefix.'_id = "'.$id.'" ');
		foreach($res as $data){
			$this->delete_outlog_details('outlog',$data[0]['id']);
		}
	}
	
	function delete_invoices_by_id($prefix = null, $id = null){
		$tmp_detail_fields = 'invoice_id, no, inv_date, supplier_id, department_id, currency_id, description, po_no, paid_date, paid_bank_name, paid_bank_account_no, paid_bank_account_name, paid_bank_account_type_id, convert_asset, wht_rate, vat_rate, sub_total, vat_base, wht_base, discount, after_disc, wht_total, vat_total, total, billing_address, shipping_address, status_invoice_id, rp_rate, bank_account_id, request_type_id, date_due, approved_by, approved_date, other_cost_total, other_cost_notes, reject_notes, reject_by, reject_date, cancel_notes, cancel_by, cancel_date, po_id';
		$detail_fields = 'id, no, inv_date, supplier_id, department_id, currency_id, description, po_no, paid_date, paid_bank_name, paid_bank_account_no, paid_bank_account_name, paid_bank_account_type_id, convert_asset, wht_rate, vat_rate, sub_total, vat_base, wht_base, discount, after_disc, wht_total, vat_total, total, billing_address, shipping_address, status_invoice_id, rp_rate, bank_account_id, request_type_id, date_due, approved_by, approved_date, other_cost_total, other_cost_notes, reject_notes, reject_by, reject_date, cancel_notes, cancel_by, cancel_date, po_id';
		$copyData = $this->HouseKeeping->query('insert into tmp_invoices ('.$tmp_detail_fields.') select '.$detail_fields.' from invoices where '.$prefix.'_id = "'.$id.'" and invoice_status_id = "6" ');
		$res = $this->HouseKeeping->query('select id from invoices where '.$prefix.'_id = "'.$id.'" and invoice_status_id = "6" ');
		$execute = $this->HouseKeeping->query('delete from invoices where '.$prefix.'_id = "'.$id.'" and invoice_status_id = "6" ');
		foreach($res as $data){
			$this->delete_invoice_details('invoice',$data[0]['id']);
			if($prefix == 'delivery_order'){
				$this->delete_invoice_delivery_orders($data[0]['id'],$id);
			}else if($prefix == 'po'){
				$this->delete_invoice_pos($data[0]['id'],$id);
			}
		}
	}
	
	function insert_log($status = null){
		$params['name'] 		= $this->Session->read('HKConf.table_name');
		$params['date'] 		= date('Y-m-d H:i:s.000');
		$params['date_start'] 	= $this->Session->read('HKConf.date_start');
		$params['date_end'] 	= $this->Session->read('HKConf.date_end');
		$params['remark'] 		= $this->Session->read('HKConf.remark');
		$params['created_by'] 	= $this->Session->read('Userinfo.username');
		$params['status'] 		= $status;
		if($this->save_log($params)){
			if($status == '1'){
				$this->Session->setFlash(__('House Keeping has been processed', true), 'default', array('class'=>'ok'));
				$this->redirect(array('action'=>'index'));
			}else{
				$this->Session->setFlash(__('Data not exists.', true));
				$this->redirect(array('action'=>'add'));
			}
		}else{
			$this->Session->setFlash(__('House Keeping could not be processed. Please, try again.', true));
			$this->redirect(array('action'=>'add'));
		};
	}
	
	function get_data_view(){
		if (!empty($this->data)) {
			$tn = $this->data['HouseKeeping']['table_name'];
			if($tn){
				$ds	= $this->data['HouseKeeping']['ds'];
				$de = $this->data['HouseKeeping']['de'];
				$date_start = $ds['year'] . '-' . $ds['month'] . '-' . $ds['day'] . ' 00:00:00.000';
				$date_end 	= $de['year'] . '-' . $de['month'] . '-' . $de['day'] . ' 23:59:59.000';
				$status = '0';
				
				if($tn && $date_start && $date_end){
					
					if($tn != 'inlogs' && $tn != 'outlogs'){
						if($tn == 'npbs'){
							$where = "where j.npb_date between '".$date_start."' and '".$date_end."' ";
						}else if($tn == 'pos'){
							$where = "where c.po_date between '".$date_start."' and '".$date_end."' ";
						}else if($tn == 'delivery_orders'){
							$where = "where e.do_date between '".$date_start."' and '".$date_end."' ";
						}else if($tn == 'all'){
							$where = " ";
						}
						
						$sql = "select 
								a.id as inv_id, a.no as inv_no, a.paid_date as inv_paid_date, h.name as inv_status_name, 
								c.id as po_id, c.no as po_no, f.name as po_status_name, 
								e.id as do_id, e.no as do_no, g.name as do_status_name, 
								j.id as npb_id, j.no as npb_no, k.name as npb_status_name 
								from invoices a 
								left join invoices_pos b on b.invoice_id = a.id 
								left join pos c on c.id = b.po_id 
								left join invoices_delivery_orders d on d.invoice_id = a.id 
								left join delivery_orders e on e.id = d.delivery_order_id 
								left join po_statuses f on f.id = c.po_status_id 
								left join delivery_order_statuses g on g.id = e.delivery_order_status_id 
								left join invoice_statuses h on h.id = a.status_invoice_id 
								left join npbs_pos i on i.po_id = c.id 
								left join npbs j on j.id = i.npb_id 
								left join npb_statuses k on k.id = j.npb_status_id 
								".$where." ";
						$find	= $this->HouseKeeping->query($sql);
						$n = 1;
						foreach($find as $loop){
							$data[$n]	= $loop[0];
							$sql = "select case SUM(qty-qty_unfilled) when 0 then 1 else 0 end as outstanding from npb_details where npb_id = '".$loop[0]['npb_id']."' ";
							$res = $this->HouseKeeping->query($sql);
							$data[$n]['npb_outstanding']	= $res[0][0]['outstanding'];
							$n++;
						}
					}else{						
						
					}
					
					$this->Session->write('HKData', $data);
					
					$this->Session->write('Data.TableName', $tn);
					$this->Session->write('Data.DateStart', $date_start);
					$this->Session->write('Data.DateEnd', 	$date_end);
					$this->Session->write('Data.Remark', 	$this->data['HouseKeeping']['remark']);
					
					//echo '<pre>';
					//var_dump($this->Session->read());
					//echo '</pre>';die();
					$moduleName = 'House Keeping > Delete Data';
					$this->set(compact('date','tn','date_start','date_end','moduleName', 'data'));
				}else{
					$this->Session->setFlash(__('An Error Occured. Please Try Again.', true));
					$this->redirect(array('action' => 'add'));
				}
			}else{
				$this->Session->setFlash(__('Please specify the Table Name.', true));
			}
		}
	}

	/*function process(){
		if (!empty($this->data)) {
			$ids 	= $this->data['HouseKeeping']['no'];
			$dataHK	= $this->Session->read('HKData');
			$totalData	= count($dataHK);
			
			for($count = 1; $count <= $totalData; $count++){
				echo '<pre>';
				if(in_array($count, $ids)){
					var_dump($dataHK[ $count ]);
					$invoice_id	= $dataHK[ $count ][ 'inv_id' ];
					$do_id		= $dataHK[ $count ][ 'do_id' ];
					$po_id		= $dataHK[ $count ][ 'po_id' ];
					$npb_id		= $dataHK[ $count ][ 'npb_id' ];
					if($npb_id){
						$this->delete_npb_by_id($npb_id);
					}
					//if($invoice_id){
					//	$this->delete_invoice_by_id($invoice_id);
					//}
					//if($do_id){
					//	$this->delete_do_by_id($do_id);
					//}
					//if($po_id){
					//	$this->delete_po_by_id($po_id);
					//}
					
				}
				
			}
			echo '</pre>';die();
			
			$this->redirect(array('action' => 'index'));
		}
	}*/
	
	
	/*function delete_npbs($date_start = null, $date_end = null){
		$status = '0';
		$tmp_fields = 'npb_id, no, npb_date, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, supplier_id, req_date, npb_status_id, request_type_id, notes, created_by, created_date, reject_notes, reject_by, reject_date, cancel_notes, cancel_by, cancel_date, is_purchase_request, date_finish, is_printed, approved_by, approved_date, approved_history, approver_one, approver_two, approver_three, approver_one_date, approver_two_date, approver_three_date';
		$npb_fields = 'id, no, npb_date, department_id, department_sub_id, department_unit_id, business_type_id, cost_center_id, supplier_id, req_date, npb_status_id, request_type_id, notes, created_by, created_date, reject_notes, reject_by, reject_date, cancel_notes, cancel_by, cancel_date, is_purchase_request, date_finish, is_printed, approved_by, approved_date, approved_history, approver_one, approver_two, approver_three, approver_one_date, approver_two_date, approver_three_date';
		$fn = 'npb_date';
		$copy_data = $this->HouseKeeping->query('insert into tmp_npbs ('.$tmp_fields.') select '.$npb_fields.' from npbs where npb_date between "'.$date_start.'" and "'.$date_end.'" ');
		$res = $this->HouseKeeping->query('select id from npbs where npb_date between "'.$date_start.'" and "'.$date_end.'" ');
		foreach($res as $npb){						
			// delete npb after copied						
			$execute = $this->HouseKeeping->query('delete from npbs where id = "'.$npb[0]['id'].'" ');
			// delete npb detail
			$this->delete_npb_details('npb',$npb[0]['id']);
			// delete npb pos
			$this->delete_npbs_pos('npb',$npb[0]['id']);
			// delete inlog detail
			$this->delete_inlog_details('npb',$npb[0]['id']);
			// delete outlog
			$this->delete_outlogs_by_id('npb',$npb[0]['id']);
			// delete invoice detail
			//$this->delete_invoice_details('npb',$npb[0]['id']);
			// delete ledger
			$this->delete_inventory_ledgers('npb',$npb[0]['id']);
			if($execute){
				$status = '1';
				$remark = '';
			}else{
				$remark = '<br>Data not exists';
			}
		}
		$this->insert_log('npbs', $date_start, $date_end, $status, $remark);		
	}
	
	function delete_pos($date_start = null, $date_end = null){
		$status = '0';
		// delete main po
		$tmp_fields = 'po_id, no, po_date, delivery_date, supplier_id, department_id, po_status_id, currency_id, description, convert_invoice, created, approval_info, wht_rate, vat_rate, vat_base, vat_base_cur, wht_base, wht_base_cur, sub_total, sub_total_cur, discount, discount_cur, after_disc, after_disc_cur, wht_total, wht_total_cur, vat_total, vat_total_cur, total, total_cur, billing_address, shipping_address, reject_notes, reject_by, reject_date, cancel_notes, cancel_by, cancel_date, payment_term, rp_rate, date_finish, printed, request_type_id, signer_1, signer_2, po_address, down_payment, is_down_payment_journal_generated, down_payment_journal_generated_date, approved_by, approved_date, daily_penalty, approval_note_1, approval_note_2';
		$pos_fields = 'id, no, po_date, delivery_date, supplier_id, department_id, po_status_id, currency_id, description, convert_invoice, created, approval_info, wht_rate, vat_rate, vat_base, vat_base_cur, wht_base, wht_base_cur, sub_total, sub_total_cur, discount, discount_cur, after_disc, after_disc_cur, wht_total, wht_total_cur, vat_total, vat_total_cur, total, total_cur, billing_address, shipping_address, reject_notes, reject_by, reject_date, cancel_notes, cancel_by, cancel_date, payment_term, rp_rate, date_finish, printed, request_type_id, signer_1, signer_2, po_address, down_payment, is_down_payment_journal_generated, down_payment_journal_generated_date, approved_by, approved_date, daily_penalty, approval_note_1, approval_note_2';
		$fn = 'po_date';
		$copyData = $this->HouseKeeping->query('insert into tmp_pos ('.$tmp_fields.') select '.$pos_fields.' from pos where pos.'.$fn.' between "'.$date_start.'" and "'.$date_end.'" ');
		$res = $this->HouseKeeping->query('select id from pos where '.$fn.' between "'.$date_start.'" and "'.$date_end.'" ');
		foreach($res as $po){
			// delete po after copied						
			$execute = $this->HouseKeeping->query('delete from pos where id = "'.$po[0]['id'].'" ');
			// delete po detail
			$this->delete_po_details('po',$po[0]['id']);
			// delete po payments
			$this->delete_po_payments('po',$po[0]['id']);
			// delete npb detail
			$this->delete_npb_details('po',$po[0]['id']);
			// delete npb pos
			$this->delete_npbs_pos('po',$po[0]['id']);
			// delete inlogs
			$this->delete_inlogs_by_id('po',$po[0]['id']);
			// delete invoices
			$this->delete_invoices_by_id('po',$po[0]['id']);
			// delete invoice detail
			//$this->delete_invoice_details('po',$po[0]['id']);
			// delete invoice payments
			$this->delete_invoice_payments('po',$po[0]['id']);
			// delete invoice po
			//$this->delete_invoice_pos('po',$po[0]['id']);
			// delete ledger
			$this->delete_inventory_ledgers('po',$po[0]['id']);
			if($execute){
				$status = '1';
				$remark = '';
			}else{
				$remark = '<br>Data not exists';
			}
		}
		$this->insert_log('pos', $date_start, $date_end, $status, $remark);		
	}
	
	function delete_delivery_orders($date_start = null, $date_end = null){
		$status = '0';
		//delete main do
		$tmp_fields = 'delivery_order_id, po_id, no, do_date, delivery_date, supplier_id, department_id, delivery_order_status_id, currency_id, description, convert_invoice, created, approval_info, wht_rate, vat_rate, vat_base, vat_base_cur, wht_base, wht_base_cur, sub_total, sub_total_cur, discount, discount_cur, after_disc, after_disc_cur, wht_total, wht_total_cur, vat_total, vat_total_cur, total, total_cur, billing_address, shipping_address, rp_rate, request_type_id, convert_asset, is_journal_generated, journal_generated_date, is_first, approved_by, approved_date, cancel_by, cancel_date, cancel_note';
		$do_fields = 'id, po_id, no, do_date, delivery_date, supplier_id, department_id, delivery_order_status_id, currency_id, description, convert_invoice, created, approval_info, wht_rate, vat_rate, vat_base, vat_base_cur, wht_base, wht_base_cur, sub_total, sub_total_cur, discount, discount_cur, after_disc, after_disc_cur, wht_total, wht_total_cur, vat_total, vat_total_cur, total, total_cur, billing_address, shipping_address, rp_rate, request_type_id, convert_asset, is_journal_generated, journal_generated_date, is_first, approved_by, approved_date, cancel_by, cancel_date, cancel_note';
		$fn = 'do_date';
		
		$copyData = $this->HouseKeeping->query('insert into tmp_delivery_orders ('.$tmp_fields.') select '.$do_fields.' from delivery_orders where delivery_orders.'.$fn.' between "'.$date_start.'" and "'.$date_end.'" ');
		$res = $this->HouseKeeping->query('select id from delivery_orders where '.$fn.' between "'.$date_start.'" and "'.$date_end.'" ');
		foreach($res as $del){
			// delete delivery order after copied						
			$execute = $this->HouseKeeping->query('delete from delivery_orders where id = "'.$del[0]['id'].'" ');
			// delete delivery order detail
			$this->delete_delivery_order_details('delivery_order',$del[0]['id']);
			// delete inlogs
			$this->delete_inlogs_by_id('delivery_order',$del[0]['id']);
			// delete invoices
			$this->delete_invoices_by_id('delivery_order',$del[0]['id']);
			// delete invoice delivery order
			//$this->delete_invoice_delivery_orders('delivery_order',$del[0]['id']);
			if($execute){
				$status = '1';
				$remark = '';
			}else{
				$remark = '<br>Data not exists';
			}
		}
		$this->insert_log('delivery_orders', $date_start, $date_end, $status, $remark);		
	}
	
	function delete_inlogs($date_start = null, $date_end = null){
		$status = '0';
		// delete main inlog
		$tmp_fields = 'inlog_id, no, date, supplier_id, po_id, created_at, created_by, invoice_id, delivery_order_id, inlog_status_id, approved_by, approved_date, cancel_notes, cancel_by, cancel_date, department_id, business_type_id, cost_center_id';
		$inlog_fields = 'id, no, date, supplier_id, po_id, created_at, created_by, invoice_id, delivery_order_id, inlog_status_id, approved_by, approved_date, cancel_notes, cancel_by, cancel_date, department_id, business_type_id, cost_center_id';
		$fn = 'date';
		$copyData = $this->HouseKeeping->query('insert into tmp_inlogs ('.$tmp_fields.') select '.$inlog_fields.' from inlogs where inlogs.'.$fn.' between "'.$date_start.'" and "'.$date_end.'" ');
		$res = $this->HouseKeeping->query('select id from inlogs where '.$fn.' between "'.$date_start.'" and "'.$date_end.'" ');
		foreach($res as $inlog){
			// delete inlog after copied						
			$execute = $this->HouseKeeping->query('delete from inlogs where id = "'.$inlog[0]['id'].'" ');
			// delete inlog detail
			$this->delete_inlog_details('inlog',$inlog[0]['id']);
			// delete ledger
			$this->delete_inventory_ledgers('inlog',$inlog[0]['id']);
			if($execute){
				$status = '1';
				$remark = '';
			}else{
				$remark = '<br>Data not exists';
			}
		}
		$this->insert_log('inlogs', $date_start, $date_end, $status, $remark);		
	}
	
	function delete_outlogs($date_start = null, $date_end = null){
		$status = '0';
		// delete main outlog
		$tmp_fields = 'outlog_id, no, date, department_id, created_at, created_by, npb_id, is_process, is_printed, outlog_status_id, approved_by, approved_date, reject_notes, reject_by, reject_date, cancel_notes, cancel_by, cancel_date, business_type_id, cost_center_id, retur_id';
		$outlog_fields = 'id, no, date, department_id, created_at, created_by, npb_id, is_process, is_printed, outlog_status_id, approved_by, approved_date, reject_notes, reject_by, reject_date, cancel_notes, cancel_by, cancel_date, business_type_id, cost_center_id, retur_id';
		$fn = 'date';
		$copyData = $this->HouseKeeping->query('insert into tmp_outlogs ('.$tmp_fields.') select '.$outlog_fields.' from outlogs where outlogs.'.$fn.' between "'.$date_start.'" and "'.$date_end.'" ');
		$res = $this->HouseKeeping->query('select id from outlogs where '.$fn.' between "'.$date_start.'" and "'.$date_end.'" ');
		foreach($res as $outlog){
			// delete outlog after copied						
			$execute = $this->HouseKeeping->query('delete from outlogs where id = "'.$outlog[0]['id'].'" ');
			// delete outlog detail
			$this->delete_outlog_details('outlog',$outlog[0]['id']);
			// delete ledger
			$this->delete_inventory_ledgers('outlog',$outlog[0]['id']);
			if($execute){
				$status = '1';
				$remark = '';
			}else{
				$remark = '<br>Data not exists';
			}
		}		
		$this->insert_log('outlogs', $date_start, $date_end, $status);
	}
	
	function delete_invoices($date_start = null, $date_end = null){
		$status = '0';
		// delete main invoices
		$tmp_fields = 'invoice_id, no, inv_date, supplier_id, department_id, currency_id, description, po_no, paid_date, paid_bank_name, paid_bank_account_no, paid_bank_account_name, paid_bank_account_type_id, convert_asset, created, wht_rate, vat_rate, sub_total, vat_base, wht_base, discount, after_disc, wht_total, vat_total, total, billing_address, shipping_address, status_invoice_id, rp_rate, bank_account_id, request_type_id, date_due, approved_by, approved_date, other_cost_total, other_cost_notes, reject_notes, reject_by, reject_date, cancel_notes, cancel_by, cancel_date';
		$invoice_fields = 'id, no, inv_date, supplier_id, department_id, currency_id, description, po_no, paid_date, paid_bank_name, paid_bank_account_no, paid_bank_account_name, paid_bank_account_type_id, convert_asset, created, wht_rate, vat_rate, sub_total, vat_base, wht_base, discount, after_disc, wht_total, vat_total, total, billing_address, shipping_address, status_invoice_id, rp_rate, bank_account_id, request_type_id, date_due, approved_by, approved_date, other_cost_total, other_cost_notes, reject_notes, reject_by, reject_date, cancel_notes, cancel_by, cancel_date';
		$fn = 'inv_date';
		$copyData = $this->HouseKeeping->query('insert into tmp_invoices ('.$tmp_fields.') select '.$invoice_fields.' from invoices where invoices.'.$fn.' between "'.$date_start.'" and "'.$date_end.'" ');
		$res = $this->HouseKeeping->query('select id from invoices where '.$fn.' between "'.$date_start.'" and "'.$date_end.'" ');
		foreach($res as $invoice){
			// delete invoice after copied						
			$execute = $this->HouseKeeping->query('delete from invoices where id = "'.$invoice[0]['id'].'" ');
			// delete invoice detail
			$this->delete_invoice_details('invoice',$invoice[0]['id']);
			// delete invoice payments
			$this->delete_invoice_payments('invoice',$invoice[0]['id']);
			// delete invoice delivery order
			$this->delete_invoice_delivery_orders('invoice',$invoice[0]['id']);
			// delete invoice po
			$this->delete_invoice_pos('invoice',$invoice[0]['id']);
			// delete inlogs
			$this->delete_inlogs_by_id('invoice',$invoice[0]['id']);
			if($execute){
				$status = '1';
				$remark = '';
			}else{
				$remark = '<br>Data not exists';
			}
		}
		$this->insert_log('invoices', $date_start, $date_end, $status, $remark);		
	}*/
	
}

?>