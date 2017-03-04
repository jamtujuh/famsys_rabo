<?php


class AssetsController extends AppController {

	var $name = 'Assets';
	var $helpers = array('Number','Ajax','Javascript');
	var $components = array( 'RequestHandler' );
	
	function index() {
		$year=$this->Session->read('AssetReport.year');
		if(empty($year))
			$this->Session->write('AssetReport.year',date('Y'));
			
		$this->Asset->recursive = 0;
		$this->set('assets', $this->paginate());
		$this->set('warranties', $this->Asset->Warranty->find('list') );
		$this->set('departments', $this->Asset->Department->find('list') );
		$this->set('assetCategories', $this->Asset->AssetCategory->find('list', array('conditions'=>array('is_asset'=>1))) );
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid asset', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->write('Asset.id',$id);
		$this->set('asset', $this->Asset->read(null, $id));
		//$assetDetails = $this->Asset->AssetDetail->find('list');
		$this->set('assetCategories', $this->Asset->AssetCategory->find('list', array('conditions'=>array('is_asset'=>1))) );

	}

	function add() {
		if (!empty($this->data)) {
		
			$data_details	= array();			
			$purchase = $this->Asset->Purchase->read(null, $this->Session->read('Purchase.id'));
			
			$qty 			= $this->data['Asset']['qty'];
			$price 			= $this->data['Asset']['price'];
			$purchase_id 	= $this->data['Asset']['purchase_id'];
			$code	 		= $this->Asset->getNewId($this->data['Asset']['asset_category_id'] , $this->data['Asset']['year']);
			$umurek 		= $this->data['Asset']['umurek'];
			

			$this->data['Asset']['code'] 			= $code;
			$this->data['Asset']['amount'] 			= $qty*$price;
			if($this->data['Asset']['asset_category_id']==amort_category_id)
				$this->data['Asset']['depbln'] 		= 0;
			else
				$this->data['Asset']['depbln']		= $qty*$price / $umurek /12;
			$this->data['Asset']['amount_cur'] 		= $qty*$this->data['Asset']['price_cur'] ;
			$this->data['Asset']['amount'] 			= $qty*$price;
			$this->data['Asset']['thnlalu']			= 0;
			$this->data['Asset']['blnlalu']			= 0;
			$this->data['Asset']['blnini']			= 1;
			$this->data['Asset']['jthnlalu']		= 0;
			$this->data['Asset']['jblnlalu']		= 0;
			$this->data['Asset']['jblnini']			= 0;
			$this->data['Asset']['hpthnini']		= 0;
			$this->data['Asset']['hpthnlalu']		= 0;
			$this->data['Asset']['hpblnlalumasuk']	= 0;
			$this->data['Asset']['hpblnlalukeluar']	= 0;
			$this->data['Asset']['depthnlalu']		= 0;
			$this->data['Asset']['ada']				= 'Y';
			$maksi = $this->data['Asset']['maksi']	= $umurek * 12;	
			$this->data['Asset']['date_of_purchase'] = $purchase['Purchase']['date_of_purchase'];
			$this->data['Asset']['date_start']    =  $purchase['Purchase']['date_of_purchase'];
			$this->data['Asset']['date_end']      = date('Y-m-d',strtotime('+ '.($maksi-1).' months', strtotime( $purchase['Purchase']['date_of_purchase'])));
						
			//asset master...
			$this->Asset->create();
			
			if ($this->Asset->save($this->data)) {
			
				//asset details...
				$data_details['AssetDetail'] = $this->data['Asset'];
				$asset_id = $this->Asset->id;
				
				for ($i=0; $i<$qty; $i++)
				{
					$data_details['AssetDetail']['asset_id'] 	= $asset_id ;
					$data_details['AssetDetail']['code'] 		= $code . '-'. sprintf("%03d",$this->Asset->AssetDetail->getNewId($code));
					if($data_details['AssetDetail']['asset_category_id']==amort_category_id)
						$data_details['AssetDetail']['depbln'] 	= 0;
					else
						$data_details['AssetDetail']['depbln'] 	= $data_details['AssetDetail']['price']/$umurek/12;
					
					$this->Asset->AssetDetail->create();
					if ($this->Asset->AssetDetail->save($data_details)) {
						
					}
				}
				
				//redirect back
				$this->Session->setFlash(__('The asset and asset details has been saved', true));
				$this->redirect(array('controller'=>'purchases','action' => 'view', $purchase_id));
			} else {
				$this->Session->setFlash(__('The asset could not be saved. Please, try again.', true));
			}
		}
		
		$purchase_id = !empty($this->params['pass'][0])?$this->params['pass'][0]:$this->data['Asset']['purchase_id'];
		$purchases = $this->Asset->Purchase->findById($purchase_id);
		$assetCategories = $this->Asset->AssetCategory->find('list',  array('conditions'=>array('is_asset'=>1)));
		$currencies = $this->Asset->Currency->find('list');
		$this->set(compact('purchases', 'assetCategories', 'currencies'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid asset', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Asset->save($this->data)) {
				$this->Session->setFlash(__('The asset has been saved', true));
				if($purchase_id=$this->Session->read('Purchase.id'))
					$this->redirect(array('controller'=>'purchases','action' => 'view', $purchase_id));
				else
					$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The asset could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Asset->read(null, $id);
		}
		$purchases = $this->Asset->Purchase->find('list');
		$assetCategories = $this->Asset->AssetCategory->find('list',  array('conditions'=>array('is_asset'=>1)));
		$currencies = $this->Asset->Currency->find('list');
		$locations = $this->Asset->Location->find('list');
		$departments = $this->Asset->Department->find('list');
		$this->set(compact('purchases','assetCategories', 'currencies','locations','departments'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for asset', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Asset->delete($id, true)) {
			$purchaseId = $this->Session->read('Purchase.id');
			$this->Session->setFlash(__('Asset deleted', true));
			$this->redirect(array('controller'=>'purchases','action'=>'view', $purchaseId));
		}
		$this->Session->setFlash(__('Asset was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	
	function reports($type='depr')
	{
		if (!empty($this->data)) {
			$this->Session->write('AssetReport.department_id',$this->data['Asset']['department_id']);
			$this->Session->write('AssetReport.asset_category_id',$this->data['Asset']['asset_category_id']);
			$this->Session->write('AssetReport.is_under_value',$this->data['Asset']['is_under_value']);
		}

		$this->Asset->recursive = 0;
		$this->Asset->min_asset_value=$this->configs['min_asset_value'];
		
		$conditions=array();
		$periode = date("M Y");
		$this->Session->write('AssetReport.periode',$periode);
		
		if($department_id = $this->Session->read('AssetReport.department_id')) 
			$conditions['Asset.department_id']		= $department_id;			
			
		if($asset_category_id = $this->Session->read('AssetReport.asset_category_id')) 
			$conditions['Asset.asset_category_id']	= $asset_category_id;
			
		if($this->Session->read('AssetReport.is_under_value') == 1) 
			$conditions[]=array('Asset.price <' => $this->configs['min_asset_value']);
		else if($this->Session->read('AssetReport.is_under_value') == 2) 
			$conditions[]=array('Asset.price >' => $this->configs['min_asset_value']);
		else if($this->Session->read('AssetReport.is_under_value') == 3) 
			$conditions[]=array('Asset.price >' => 0);

		list($date_start,$date_end) = $this->set_date_filters('Asset');

		$departments		= $this->Asset->Department->find('list') ;
		$assetCategories 	= $this->Asset->AssetCategory->find('list',  array('conditions'=>array('is_asset'=>1)));		

		if($type=='depr')
		{
			$assets		= $this->Asset->_calculateDepr('Asset', $this->paginate($conditions), $date_start, $date_end ) ;
		}
		
		$this->set(compact('assets','departments','assetCategories'));
		$this->render($type);
	}

	
	function get_depr_year()
	{
		if (!empty($this->data)) {
			if(!empty($this->data['Asset']['asset_category_id'])) 
				$this->set('asset_category',$this->Asset->AssetCategory->findById($this->data['Asset']['asset_category_id']));
			else if(!empty($this->data['InvoiceDetail']['asset_category_id'])) 
				$this->set('asset_category',$this->Asset->AssetCategory->findById($this->data['InvoiceDetail']['asset_category_id']));
			else if(!empty($this->data['NpbDetail']['asset_category_id'])) 
				$this->set('asset_category',$this->Asset->AssetCategory->findById($this->data['NpbDetail']['asset_category_id']));
			else if(!empty($this->data['PoDetail']['asset_category_id'])) 
				$this->set('asset_category',$this->Asset->AssetCategory->findById($this->data['PoDetail']['asset_category_id']));
		}
	}
	
	function get_currency()
	{
		if (!empty($this->data)) {
			if(!empty($this->data['Asset']['currency_id']))
				$this->set('currency',$this->Asset->Currency->findById($this->data['Asset']['currency_id']));
			else if(!empty($this->data['InvoiceDetail']['currency_id']))
				$this->set('currency',$this->Asset->Currency->findById($this->data['InvoiceDetail']['currency_id']));
			else if(!empty($this->data['NpbDetail']['currency_id']))
				$this->set('currency',$this->Asset->Currency->findById($this->data['NpbDetail']['currency_id']));
			else if(!empty($this->data['PoDetail']['currency_id']))
				$this->set('currency',$this->Asset->Currency->findById($this->data['PoDetail']['currency_id']));
		}
	}	
	
	/****************************************************\
	hitung depresiasi,
	patokan untuk bulan ini
	\****************************************************/
	function process_depr()
	{
		$BULANS = array(1=>"Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
		
		$per=date('Y-m');
		list($periode, $tglawal, $date_end) = array("$per-01","$per-01","$per-31");
		list($yp,$mp,$dp) = explode("-", $periode);
		$bln = strtolower(date("M"));
		$this->log("$bln, $periode, $tglawal, $date_end\n");
		
		$details = $this->Asset->AssetDetail->find('all');
		foreach ($details as $detail)
		{
			$asset_id			= $detail['AssetDetail']['asset_id'];
			$asset_detail_id	= $detail['AssetDetail']['id'];
			$date_start			= $detail['AssetDetail']['date_start'];
			$umurek				= $detail['AssetDetail']['umurek'];
			$ada				= $detail['AssetDetail']['ada'];
			$maksi				= $umurek * 12;
			$total_thnlalu 		= $this->Asset->cariJlhBlnSdThnLalu($date_start, $periode);
			$total_blnlalu 		= $this->Asset->cariJlhBlnSdBlnLalu($date_start, $periode);			

			list($yb,$mb,$db)	= explode("-", $date_start);

			/******************************************************
			update fields on asset and assets  based on calculation
			******************************************************/
			
			//dalam thn yang sama
			if( $yb == $yp ) 
			{
				$thnlalu	= 0;
				$blnlalu	= $mp-$mb;
				$blnini		= 1;
			}
			//sudah lebih dari umur ekonomis
			else if($total_thnlalu > $maksi)
			{
				$thnlalu	= $maksi;
				$blnlalu	= 0;
				$blnini		= 0;
			}
			//masih dalam tahun ekonomis
			else if($total_thnlalu <= $maksi && $maksi < ($total_thnlalu+$total_blnlalu) ) 
			{
				$thnlalu	= $total_thnlalu;
				$blnlalu	= $maksi - $total_thnlalu;
				$blnini		= 0;
			}
			//
			else if($maksi >= ($total_thnlalu+$total_blnlalu) ) 
			{
				$thnlalu	= $total_thnlalu;
				$blnlalu	= $total_blnlalu ;
				$blnini		= $maksi - ($total_thnlalu+$total_blnlalu) == 0  ? 0 : 1;
			}
			
			$this->log("maxi=$maksi, total_thnlalu=$total_thnlalu, thnlalu=$thnlalu, blnlalu=$blnlalu, blnini=$blnini");

			$sql = "update %s set thnlalu=$thnlalu, blnlalu=$blnlalu, blnini=$blnini where id='%s' ";
			$s = sprintf($sql,"assets", $asset_detail_id);
			$this->Asset->query($s);
			$this->log($s);
			
			$s = sprintf($sql,"assets", $asset_id);
			$this->Asset->query($s);			
			$this->log($s);
			
			/****************************************************
			proses 1: update kolom jan...des
			*****************************************************/
			$i		= 0;
			reset($BULANS);
			$sql	= "update %s set ";
			foreach($BULANS as $key=>$val)
			{
				$val = strtolower(substr($val,0,3));
				if($ada=='Y' && (
					($thnlalu==0 && $key>=$mb && $key < $mb+$blnlalu+$blnini  ) //dalam thn yang sama
					|| ($thnlalu>0 && $key<=$blnlalu+$blnini)) //beda tahun
				  ) 
				{
					$sql	.= "`$val`= depbln ,";				
				}
				else
				{
					$sql	.= "`$val`='0',";					
				}
			}
			$sql = trim($sql,",");
			$sql .= " where id='%s'";

			$s = sprintf($sql,"assets", $asset_detail_id);
			$this->Asset->query($s);
			$this->log($s);
			
			$s = sprintf($sql,"assets", $asset_id);
			$this->Asset->query($s);			
			$this->log($s);
			
			/****************************************************
			proses 2: update kolom hp dan dep (nilai aktiva)
			*****************************************************/			
			$sql = "update %s set 
			hpthnlalu         = if(year(date_start) < year('$tglawal'), %s, 0) ,
			hpblnlalumasuk    = if(year(date_start) < year('$tglawal'), 0, %s) ,
			hpblnlalukeluar   = if(ada='Y', 0, %s),
			hpthnini          = hpthnlalu + hpblnlalumasuk - hpblnlalukeluar,
			depthnlalu        = depbln * thnlalu, 
			depblninimasuk    = if(ada='Y' and blnini=1, depbln, 0),
			depblnlalumasuk   = depbln * (blnlalu + blnini),
			depblnlalukeluar  = if(ada='T', depbln * (thnlalu+blnlalu+blnini), 0 ),
			depthnini         = depthnlalu + depblnlalumasuk - depblnlalukeluar,
			book_value        = hpthnini - depthnini
			where id='%s'";
			$s = sprintf($sql,"assets", "price","price","price",$asset_detail_id);
			$this->Asset->query($s);
			$this->log($s);
			
			$s = sprintf($sql,"assets", "amount","amount","amount",$asset_id);
			$this->Asset->query($s);			
			$this->log($s);
			$this->log('******************************************************************');
			
		}
	}

	
	
}
?>
