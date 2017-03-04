<?php
App::import('Model','JournalInterfase');

class FamsysInterfacesController extends AppController {

	var $name = 'FamsysInterfaces';
	var $components = array('Session');

	function index() {
		$this->FamsysInterface->recursive = 0;
        $layout = $this->data['FamsysInterface']['layout'];
		
		list($date_start, $date_end) = $this->set_date_filters('FamsysInterface');
		$conditions[] = array('FamsysInterface.posting_date >=' => ($date_start['year'] . '-' . $date_start['month'] . '-' . $date_start['day'].' 00:00:00'),
			'FamsysInterface.posting_date <=' => ($date_end['year'] . '-' . $date_end['month'] . '-' . $date_end['day'].' 23:59:00'));

		if ($layout == 'pdf' || $layout == 'xls') {
			  $con = $this->FamsysInterface->find('all', array('conditions' => $conditions, 'order'=>'FamsysInterface.id'));
        } else {
			  $this->paginate = array('order'=>'FamsysInterface.id');
			  $con = $this->paginate($conditions);
        }
		$this->set('famsysInterfaces', $con);
        $copyright_id = $this->configs['copyright_id'];	
		$this->set(compact('copyright_id', 'date_start', 'date_end'));
		
		if ($layout == 'pdf') {
			  Configure::write('debug', 1); // Otherwise we cannot use this method while developing 
			  $this->layout = 'pdf'; //this will use the pdf.ctp layout 
			  $this->render('index_pdf');
		} else if ($layout == 'xls') {
			  $this->render('index_xls', 'export_xls');
		}


	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid famsys interface', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('famsysInterface', $this->FamsysInterface->read(null, $id));
	}

	function add() {
		if(!empty($this->data))
		{
			$data_source 	= $this->configs['odbc_name'];
			$user			= $this->configs['user_interfase'];
			$password		= $this->configs['password_interfase'];
			
			if (!odbc_connect( $data_source, $user, $password))
			{
				$this->Session->setFlash(__('The famsys interface Can not Posting, Please Try Again.', true));
				$this->redirect(array('controller'=>'pages', 'action' => 'home'));					
			}

			foreach($this->data as $data)
			{
				$this->FamsysInterface->create();
					$data['FamsysInterface']['source_no'] 	= sprintf("%04d",$this->FamsysInterface->incrementId($data['FamsysInterface']['source_dt']));// kirim source_dt return id
					$data['FamsysInterface']['noref'] 	= $data['FamsysInterface']['source_id'].$data['FamsysInterface']['source_dt'].$data['FamsysInterface']['source_no'];
					list($hh,$ii,$ss) = explode(':', date('H:i:s'));
					$data['FamsysInterface']['source_tm']	= sprintf("%06d",$hh.$ii.$ss); //number bisa beda keluarr nya
				if($this->FamsysInterface->save($data))
				    $sukses = true;
			}
			if($sukses)
			{
				$JournalInterfase = new JournalInterfase;
				$JournalInterfase->updateAll(
					array('posting'=>1, 'posting_date'=>'getdate()'),
					array('posting'=>0)
				);
				$posting = $this->insert_csb();
				if($posting)
				{
					$this->Session->setFlash(__('The famsys interface Has been Posting', true), 'default', array('class' => 'ok'));
					$this->redirect(array('action' => 'index'));
				}else{
					$this->Session->setFlash(__('The famsys interface Can not Posting, Please Try Again.', true));
					$this->redirect(array('controller'=>'pages', 'action' => 'home'));					
				}
			}
		}
		
		$JournalInterfase = new JournalInterfase;
		$journal_interfases = $JournalInterfase->find('all', array(
			'conditions'=>array('posting'=>0),
			'order'=>array('JournalInterfase.source_dt'),
			'fields' => array(
                    'JournalInterfase.source_dt',
                    'JournalInterfase.kdtran',
                    'JournalInterfase.norek1',
                    'JournalInterfase.norek2',
                    'JournalInterfase.kdcab1',
                    'JournalInterfase.kdcab2',
                    'JournalInterfase.ket1',
                    'JournalInterfase.ket2',
                    'JournalInterfase.costdept1',
                    'JournalInterfase.costdept2',
                    'sum(JournalInterfase.nilai1) as nilai1',
                    'sum(JournalInterfase.nilai2) as nilai2',
            ),
            'group' => array('JournalInterfase.source_dt','JournalInterfase.norek1','JournalInterfase.norek2','JournalInterfase.kdcab1'
							,'JournalInterfase.kdcab2','JournalInterfase.kdtran','JournalInterfase.ket1',
							'JournalInterfase.ket2','JournalInterfase.costdept1','JournalInterfase.costdept2')));
							
		$this->set(compact('journal_interfases'));
	}
	
	function add_ft() {		
		$use = 'old';
		//$use = 'new';
		
		$sukses = false;
		
		if($use	== 'old'){
			// ---------- OLD LOGIC ---------- //
			$JournalInterfase = new JournalInterfase;
			$journal_interfases = $JournalInterfase->find('all', array(
				'conditions'=>array('posting'=>0),
				'order'=>array('JournalInterfase.source_dt'),
				'fields' => array(
						'JournalInterfase.source_dt',
						'JournalInterfase.noref',
						'JournalInterfase.kdtran',
						'JournalInterfase.norek1',
						'JournalInterfase.norek2',
						'JournalInterfase.kdcab1',
						'JournalInterfase.kdcab2',
						'JournalInterfase.ket1',
						'JournalInterfase.ket2',
						'JournalInterfase.costdept1',
						'JournalInterfase.costdept2',
						'sum(JournalInterfase.nilai1) as nilai1',
						'sum(JournalInterfase.nilai2) as nilai2',
				),
				'group' => array('JournalInterfase.source_dt','JournalInterfase.norek1','JournalInterfase.norek2','JournalInterfase.kdcab1'
								,'JournalInterfase.kdcab2','JournalInterfase.kdtran','JournalInterfase.ket1',
								'JournalInterfase.ket2','JournalInterfase.costdept1','JournalInterfase.costdept2','JournalInterfase.noref')));
								
			if($journal_interfases){
				//$data_source 	= $this->configs['odbc_name'];
				//$user			= $this->configs['user_interfase'];
				//$password		= $this->configs['password_interfase'];
				
				//if (!odbc_connect( $data_source, $user, $password))
				//{
				//	$this->Session->setFlash(__('The famsys interface Can not Posting, Connection Problem with ODBC.', true));
				//	$this->redirect(array('controller'=>'pages', 'action' => 'home'));					
				//}
				$n = 0;
				foreach($journal_interfases as $data)
				{
					$this->FamsysInterface->create();
						list($hh,$ii,$ss) = explode(':', date('H:i:s'));
						
						$param['FamsysInterface']['source_id']		= 'FIX';
						$param['FamsysInterface']['source_dt']		= $data['JournalInterfase']['source_dt'];
						$param['FamsysInterface']['source_no']		= sprintf("%04d",$this->FamsysInterface->incrementId($data['JournalInterfase']['source_dt']));// kirim source_dt return id
						$param['FamsysInterface']['source_tm']		= sprintf("%06d",$hh.$ii.$ss); //number bisa beda keluar nya
						$param['FamsysInterface']['kdtran']			= $data['JournalInterfase']['kdtran'];
						$param['FamsysInterface']['noref']			= 'FIX'.$data['JournalInterfase']['source_dt'].$param['FamsysInterface']['source_no'];
						$param['FamsysInterface']['norek1']			= $data['JournalInterfase']['norek1'];
						$param['FamsysInterface']['kdcab1']			= $data['JournalInterfase']['kdcab1'];
						$param['FamsysInterface']['ccy1']			= '360';
						$param['FamsysInterface']['nilai1']			= $data[0]['nilai1'];
						$param['FamsysInterface']['norek2']			= $data['JournalInterfase']['norek2'];					
						$param['FamsysInterface']['kdcab2']			= $data['JournalInterfase']['kdcab2'];
						$param['FamsysInterface']['ccy2']			= '360';
						$param['FamsysInterface']['nilai2']			= $data[0]['nilai2'];
						$param['FamsysInterface']['costdept1']		= $data['JournalInterfase']['costdept1'];
						$param['FamsysInterface']['costdept2']		= $data['JournalInterfase']['costdept2'];
						$param['FamsysInterface']['kurs']			= '1.000000';
						$param['FamsysInterface']['ket1']			= $data['JournalInterfase']['ket2'];
						$param['FamsysInterface']['ket2']			= $data['JournalInterfase']['ket1'];
						$param['FamsysInterface']['posting']		= '1';
						$param['FamsysInterface']['posting_date']	= date('Y-m-d H:i:s');					
						
						//echo '<pre>';
						//var_dump($param);
						//echo '</pre>';die();
					if($this->FamsysInterface->save($param)){
						$sukses = true;
					}
					
				}
				if($sukses)
				{
					$JournalInterfase = new JournalInterfase;
					$JournalInterfase->updateAll(
						array('posting'=>1, 'posting_date'=>'getdate()'),
						array('posting'=>0)
					);
					
					$this->generateCsv();
					
					$this->Session->setFlash(__('The famsys interface Has been Posting', true), 'default', array('class' => 'ok'));
					$this->redirect(array('action' => 'index'));
					
					//$posting = $this->insert_csb();
					//if($posting)
					//{
						
					//}else{
					//	$this->Session->setFlash(__('The famsys interface Can not Posting, Please Try Again.', true));
					//	$this->redirect(array('controller'=>'pages', 'action' => 'home'));					
					//}
				}else{
					$this->Session->setFlash(__('The famsys interface Can not Posting, Please Try Again.', true));
					$this->redirect(array('controller'=>'pages', 'action' => 'home'));					
				}
			}else{
				$this->Session->setFlash(__('The famsys interface data can not be retrieved, Please Try Again.', true));
				$this->redirect(array('controller'=>'pages', 'action' => 'home'));	
			}

		}else{	// if use = new
			// ---------- NEW OVERRIDE QUERY ---------- //
			$sql	= "	select 
					a.source_dt date,
					a.norek1 acc_db,
					a.norek2 acc_cr,
					sum(a.nilai1) amount_db,
					sum(a.nilai2) amount_cr,
					a.ccy1 ccy_db, 
					a.ccy2 ccy_cr,
					a.kdtran kdtran, 
					a.source_no source_no,
					a.kdcab1 kdcab1,
					a.kdcab2 kdcab2,
					a.costdept1 costdept1,
					a.costdept2 costdept2,
					a.ket1 ket1,
					a.ket2 ket2
				from journal_interfases a
				where a.posting = '0'
				group by a.kdcab1, a.kdcab2, a.norek1, a.norek2, a.ccy1, a.ccy2, a.source_dt,
				a.kdtran, a.source_no, a.costdept1, a.costdept2, a.ket1, a.ket2
				order by a.source_dt ";
						
			
			$result	= $this->FamsysInterface->query($sql);
			
			if($result){
				$n	= 0;
				foreach($result as $data){
					$this->FamsysInterface->create();
					list($hh,$ii,$ss) = explode(':', date('H:i:s'));
					
					$param['FamsysInterface']['source_id']		= 'FIX';
					$param['FamsysInterface']['source_dt']		= $data[0]['date'];
					$param['FamsysInterface']['source_no']		= sprintf("%04d", $this->FamsysInterface->incrementId($data[0]['date']));
					$param['FamsysInterface']['source_tm']		= sprintf("%06d",$hh.$ii.$ss);
					$param['FamsysInterface']['kdtran']			= $data[0]['kdtran'];
					$param['FamsysInterface']['noref']			= 'FIX'.$data[0]['date'].$param['FamsysInterface']['source_no'];
					$param['FamsysInterface']['norek1']			= $data[0]['acc_db'];
					$param['FamsysInterface']['kdcab1']			= $data[0]['kdcab1'];
					$param['FamsysInterface']['ccy1']			= '360';
					$param['FamsysInterface']['nilai1']			= $data[0]['amount_db'];
					$param['FamsysInterface']['norek2']			= $data[0]['acc_cr'];
					$param['FamsysInterface']['kdcab2']			= $data[0]['kdcab2'];
					$param['FamsysInterface']['ccy2']			= '360';
					$param['FamsysInterface']['nilai2']			= $data[0]['amount_cr'];
					$param['FamsysInterface']['costdept1']		= $data[0]['costdept1'];
					$param['FamsysInterface']['costdept2']		= $data[0]['costdept2'];
					$param['FamsysInterface']['kurs']			= '1.000000';
					$param['FamsysInterface']['ket1']			= $data[0]['ket1'];
					$param['FamsysInterface']['ket2']			= $data[0]['ket2'];
					$param['FamsysInterface']['posting']		= '0';
					$param['FamsysInterface']['posting_date']	= null;
					
					//echo '<pre>';
					//var_dump($param);
					//echo '</pre>';die();
					if($this->FamsysInterface->save($param)){
						$sukses = true;
					}
				}
				
				if($sukses)
				{
					$JournalInterfase = new JournalInterfase;
					$JournalInterfase->updateAll(
						array('posting'=>1, 'posting_date'=>'getdate()'),
						array('posting'=>0)
					);
					
					$this->generateCsv();
					
					$this->Session->setFlash(__('The famsys interface Has been Posting', true), 'default', array('class' => 'ok'));
					$this->redirect(array('action' => 'index'));				
					
				}else{
					$this->Session->setFlash(__('The famsys interface Can not Posting, Please Try Again.', true));
					$this->redirect(array('controller'=>'pages', 'action' => 'home'));					
				}
			}else{
				$this->Session->setFlash(__('The famsys interface data can not be retrieved, Please Try Again.', true));
				$this->redirect(array('controller'=>'pages', 'action' => 'home'));	
			}		

		}	
		
	}
	
	function generateCsv(){
		$out 	= '';
		$header = '';
		$n = 0;
		
		$xclData = $this->Session->read('ExcelGenerate');
		
		$total = count($xclData);
		
		foreach($xclData as $j){
			$n++;
			//if($j['version']){
			//	$j['version'] 		= $j['version'].',';
			//}
			if($j['version']){
				$j['version'] 		= $j['version'].$j['branch'].',';
			}
			if($j['branch']){
				$j['branch'] 		= 'CO.CODE::='.$j['branch'];
			}
			if($j['txn_code']){
				$j['txn_code'] 		= 'TRANSACTION.TYPE::='.$j['txn_code'];
			}
			if($j['dr_acc']){
				$j['dr_acc'] 		= 'DEBIT.ACCT.NO::='.$j['dr_acc'];
			}
			if($j['dr_ccy']){
				$j['dr_ccy'] 		= 'DEBIT.CURRENCY::='.$j['dr_ccy'];
			}
			if($j['dr_amount']){
				$j['dr_amount'] 	= 'DEBIT.AMOUNT::='.$j['dr_amount'];
			}

			if(strlen($j['dr_ref']) > 16){
				$j['dr_ref'] = substr($j['dr_ref'], 0, 16);
			}
			if($j['dr_ref']){
				$j['dr_ref'] 		= 'DEBIT.THEIR.REF::='.$j['dr_ref'];
			}
			if($j['cr_acc']){
				$j['cr_acc'] 		= 'CREDIT.ACCT.NO::='.$j['cr_acc'];
			}
			if($j['cr_ccy']){
				$j['cr_ccy'] 		= 'CREDIT.CURRENCY::='.$j['cr_ccy'];
			}
			if($j['cr_amount']){
				$j['cr_amount'] 	= 'CREDIT.AMOUNT::='.$j['cr_amount'];
			}
			if(strlen($j['cr_ref']) > 16){
				$j['cr_ref'] = substr($j['cr_ref'], 0, 16);
			}
			if($j['cr_ref']){
				$j['cr_ref'] 		= 'CREDIT.THEIR.REF::='.$j['cr_ref'];
			}
			if($j['dao']){
				$j['dao'] 			= 'PROFIT.CENTRE.DEPT::='.$j['dao'];
			}
			if($j['order_cust']){
				$j['order_cust'] 	= 'ORDERING.CUST::='.$j['order_cust'];
			}
		
			$out .= $j['version'] . ","; 		//version			
			//$out .= $j['branch'] . ","; 		//branch code
			$out .= $j['txn_code'] . ","; 		//txn type
			$out .= $j['dr_acc'] . ","; 		//dr account
			$out .= $j['dr_ccy'] . ","; 		//dr ccy
			$out .= $j['dr_amount'] . ",";		//dr amount
			$out .= 'DEBIT.VALUE.DATE::='.date('Y') . date('m') . date('d') . ","; //dr value date
			$out .= $j['dr_ref'] . ","; 		//dr reference
			$out .= $j['cr_acc'] . ","; 		//cr account
			$out .= $j['cr_ccy'] . ","; 		//cr ccy
			//$out .= $j['cr_amount'] . ",";		//cr amount
			$out .= 'CREDIT.VALUE.DATE::='.date('Y') . date('m') . date('d') . ","; //cr value date
			$out .= $j['cr_ref'] . ","; 		//cr reference
			$out .= $j['dao'] . ","; 			//dao
			$out .= $j['order_cust'] . ","; 	//ordering customer
			$out .= $j['rate'] . "\n"; 			//exchange rate
		}
		
		$this->set(compact(
			'header',
			'out'
		));
		
		$this->set('detail', $out);
		
		$this->Session->write('ExcelGenerate',null);
		
		$this->layout	= null;
		$this->autolayout=null;
		
		$this->configs = $this->Config->find('list');
		$t24_path = $this->configs['t24_path'];
		$t24_name = $this->configs['t24_name'];
		$t24_backup_path = $this->configs['t24_backup_path'];
		
		if($out){
			file_put_contents($t24_path.$t24_name.'-'.date('Y-m-d-H-i-s').'.csv',$out);
			file_put_contents($t24_backup_path.$t24_name.'-'.date('Y-m-d-H-i-s').'.csv',$out);	
		
			$ids = $this->Session->read('paramId');
			$posting_date = date('Y-m-d H:i:s').'.000';
			foreach($ids as $id){
				$noref	= trim($id['noref']);
				$sql	= "update journal_transactions set posting = '1', posting_date = '".$posting_date."', noref = '".$id['noref']."' where id = '".$id['id']."' ";
				$this->FamsysInterface->query($sql);
			}
		}
			
	}
	
	function auto_post(){
		//echo "here 2";die();
		$this->LoadModel('FamsysInterface');
		$curdate			= date('Y-m-d');
		//$curdate			= '2015-01-21';
		$sql				= "	select a.id, a.journal_position_id, a.department_id, d.txn_code, a.date, sum(a.amount_db) as amount_db, sum(a.amount_cr) as amount_cr, b.gl as pl_categ, b.t24_gl, b.seq_t24, c.name as ref, b.acc_prefix, a.account_code, e.t24_account_code, a.notes, a.source, a.noref
								from journal_transactions a, accounts b, journal_templates c, journal_groups d, departments e
								where a.account_id			= b.id
								and a.journal_template_id	= c.id
								and c.journal_group_id		= d.id
								and a.department_id			= e.id
								and a.posting				= '0'
								and a.date					= '".$curdate."'
								group by a.id, a.department_id, a.date, b.name, b.gl, b.t24_gl, b.seq_t24, b.acc_prefix, c.name, a.journal_position_id, d.txn_code, a.account_code, e.t24_account_code, a.notes, a.source, a.noref
								order by a.date, ref, a.id, a.journal_position_id, a.department_id, e.t24_account_code ";
		$journalRes			= $this->FamsysInterface->query($sql);		
		
		if($journalRes){
			foreach($journalRes as $dt){
				$journalTransactions[] = $dt[0];
			}
		
			$account_db 	= '';
			$account_cr 	= '';
			$amount_db 		= 0;
			$amount_cr 		= 0;
			$dept_db 		= '';
			$sukses 		= false;
			
			$n = 0;
			$count = 1;			
			$t = 0;
			$arrayTmp = array();
			//$cost_center_data = '';
			//$new_mapping_cost_centers = new CostCenterToDao;
			
			//$t24dao = $new_mapping_cost_centers->find('first', 
			//	array('conditions'=>array(
			//		'cost_center_id'=>$this->Session->read('Userinfo.cost_center_id'),
			//	))
			//);
			//$cost_center_data = $t24dao['CostCenterToDao']['t24_dao'];
			foreach($journalTransactions as $jt)
			{
				$id = $jt['id'];
				$noref = '';
				
				if($jt['journal_position_id']==1) 									//Db
				{	
					if(strlen($jt['account_code']) > 7 && strlen($jt['account_code']) < 16){
						list($cab1,$cy1,$brg1) = explode('.',$jt['account_code']);
						$amount_db 	= $jt['amount_db'];
						$res 		= $this->FamsysInterface->query("select account_code from departments where id = '".$jt['department_id']."'");
						$dept_db 	= $res[0][0]['account_code'];
						$id_db 		= $jt['id'];				
					}else if(strlen($jt['account_code']) == 7){
						$id_db 		= $jt['id'];
						$amount_db 	= $jt['amount_db'];		
						$cy1		= substr($jt['account_code'],0,3);
						$res 		= $this->FamsysInterface->query("select account_code from departments where id = '".$jt['department_id']."'");
						$dept_db	= $res[0][0]['account_code'];
						$brg1		= substr($jt['account_code'],2,7);					
						if($cy1 == "IDR"){
							$cy1	= '360';
						}else if($cy1 == "USD"){
							$cy1	= '840';
						}else if($cy1 == "AUD"){
							$cy1	= '036';
						}else if($cy1 == "EUR"){
							$cy1	= '333';
						}else if($cy1 == "HKD"){
							$cy1	= '344';
						}else if($cy1 == "NZD"){
							$cy1	= '554';
						}else if($cy1 == "Yen"){
							$cy1	= '392';
						}
					}else{
						$id_db 		= $jt['id'];
						$amount_db 	= $jt['amount_db'];								
						$cy1		= substr($jt['account_code'],0,3);
						$res 		= $this->FamsysInterface->query("select account_code from departments where id = '".$jt['department_id']."'");
						$dept_db	= $res[0][0]['account_code'];
						$brg1		= substr($jt['account_code'],3,6);
						if($cy1 == "IDR"){
							$cy1	= '360';
						}else if($cy1 == "USD"){
							$cy1	= '840';
						}else if($cy1 == "AUD"){
							$cy1	= '036';
						}else if($cy1 == "EUR"){
							$cy1	= '333';
						}else if($cy1 == "HKD"){
							$cy1	= '344';
						}else if($cy1 == "NZD"){
							$cy1	= '554';
						}else if($cy1 == "Yen"){
							$cy1	= '392';
						}
					}
				}
				else if($jt['journal_position_id']==2) 								//Cr
				{	
					if(strlen($jt['account_code']) != 16){
						list($cab2,$cy2,$brg2) = explode('.',$jt['account_code']);
						$amount_cr 	= $jt['amount_cr'];
						$res 		= $this->FamsysInterface->query("select account_code from departments where id = '".$jt['department_id']."'");
						$dept_cr 	= $res[0][0]['account_code'];
									
					}else if(strlen($jt['account_code']) == 7){
						$amount_cr 	= $jt['amount_cr'];	
						$cy2		= 'IDR';
						$res 		= $this->FamsysInterface->query("select account_code from departments where id = '".$jt['department_id']."'");
						$dept_cr	= $res[0][0]['account_code'];
						$brg2		= substr($jt['account_code'],2,7);					
						if($cy1 == "IDR"){
							$cy1	= '360';
						}else if($cy1 == "USD"){
							$cy1	= '840';
						}else if($cy1 == "AUD"){
							$cy1	= '036';
						}else if($cy1 == "EUR"){
							$cy1	= '333';
						}else if($cy1 == "HKD"){
							$cy1	= '344';
						}else if($cy1 == "NZD"){
							$cy1	= '554';
						}else if($cy1 == "Yen"){
							$cy1	= '392';
						}					
					}else{
						$amount_cr 	= $jt['amount_cr'];			
						$cy2		= substr($jt['account_code'],0,3);
						$res 		= $this->FamsysInterface->query("select account_code from departments where id = '".$jt['department_id']."'");
						$dept_cr	= $res[0][0]['account_code'];
						$brg2		= substr($jt['account_code'],3,6);
						if($cy2 == "IDR"){
							$cy2	= '360';
						}else if($cy2 == "USD"){
							$cy1	= '840';
						}else if($cy2 == "AUD"){
							$cy1	= '036';
						}else if($cy2 == "EUR"){
							$cy1	= '333';
						}else if($cy2 == "HKD"){
							$cy1	= '344';
						}else if($cy2 == "NZD"){
							$cy1	= '554';
						}else if($cy2 == "Yen"){
							$cy1	= '392';
						}
					}
					
					$date 		= date_create($jt['date']);
					$dt			= date_format($date, 'Ymd');
					
					$source_id			= 'FIX';
					$source_dt  		= $dt; 											//blum bisa
					list($hh,$ii,$ss) 	= explode(':', date('H:i:s'));
					$source_tm			= $hh.$ii.$ss; 									//number bisa beda keluar nya
					$source_no			= sprintf("%04d", rand(0,9999)); 				//unik dari mulai 0001 ga boleh sama
					$kdcab1				= $dept_db; 									//alpha
					$kdcab2				= $dept_cr; 									//alpha
					$kdtran				= 510; 											//numberic wajib, no transaksi
					$noref				= $source_id.$dt.$source_no; 					//alpaha numberic unik bisa di campir fix dan lain2
					//$norek1			= $cab1.$cy1.substr($brg1, 0, 4); 				//number ga bisa co validasi nya harus di explode
					$norek1				= $brg1; 										//number ga bisa co validasi nya harus di explode
					//$norek2			= $cab2.$cy2.substr($brg2, 0, 4); 				//number
					$norek2				= $brg2; 										//number
					$ccy1				= $cy1; 										//number mata uang menurut BI diambil dari account_code
					$ccy2				= $cy2;
					$nilai1				= $amount_db;  									//harus koma tidak bisa titik
					$nilai2				= $amount_cr;
					$kurs				= 1; 											// satu karena rupiah
					$costdept1			= $dept_db; 									//busines type-cost center
					$costdept2			= $dept_cr;
					$ket1				= $jt['notes'];
					$ket2    			= $jt['source'];	
					$ket3				= '';	
					$costc1				= '';	
					$costc2				= '';	

					/* run insert */ 
					$data['JournalInterfase']['source_id'] 		= $source_id;
					$data['JournalInterfase']['source_dt'] 		= $source_dt;
					$data['JournalInterfase']['source_no'] 		= $source_no;
					$data['JournalInterfase']['source_tm'] 		= $source_tm;
					$data['JournalInterfase']['kdtran']			= $kdtran;
					$data['JournalInterfase']['noref'] 			= $noref;
					$data['JournalInterfase']['kdcab1'] 		= $kdcab1;
					$data['JournalInterfase']['kdcab2'] 		= $kdcab2;
					$data['JournalInterfase']['ccy1'] 			= $ccy1;
					$data['JournalInterfase']['ccy2'] 			= $ccy2;
					$data['JournalInterfase']['norek1'] 		= $norek1;
					$data['JournalInterfase']['norek2'] 		= $norek2;
					$data['JournalInterfase']['ket1'] 			= $ket2;
					$data['JournalInterfase']['ket2'] 			= $ket1?$ket1:'';
					$data['JournalInterfase']['ket3'] 			= $ket3;
					$data['JournalInterfase']['kurs'] 			= $kurs;
					$data['JournalInterfase']['costdept1'] 		= $costdept1;
					$data['JournalInterfase']['costdept2']		= $costdept2;
					$data['JournalInterfase']['nilai1'] 		= $nilai1;
					$data['JournalInterfase']['nilai2'] 		= $nilai2;
					
					//echo '<pre>';
					//var_dump($data);
					//echo '</pre>';die();
					
					$JournalInterfase = new JournalInterfase;
					$JournalInterfase->create();
					if($JournalInterfase->save($data['JournalInterfase'])){
						//echo "success<br>";
					}else{
						//echo "failed<br>";
					}
				}
				
				if($count % 2 == 0){
					$n = $n - 1;
				}
				$arrayTmp[$n]['version'] 		= 'FUNDS.TRANSFER,/I/PROCESS//0,USER/PASSWORD/';			//version	
				//$arrayTmp[$n]['pass'] 		= '';														//pass
								
				if($jt['txn_code']){
					$arrayTmp[$n]['txn_code'] 	= $jt['txn_code'];											//txn type
				}else{
					$arrayTmp[$n]['txn_code'] 	= "AC";														//txn type
				}
				
				$arrayTmp[$n]['dao'] 			= '1000';
								
				$arrayTmp[$n]['order_cust'] 	= 'Rabobank';
				$arrayTmp[$n]['rate'] 			= '';
				
				if($jt['journal_position_id']==1){
					//debit
					//dr account
					if($jt['t24_account_code']){
						$arrayTmp[$n]['branch'] 	= $jt['t24_account_code']; 									//branch
					}else{
						$arrayTmp[$n]['branch'] 	= "ID0010001"; 												//branch
					}
					
					if($jt['txn_code'] == 'ACF1' && $jt['t24_gl'] == '62160'){
						$jt['acc_prefix']	= "PL";
						$jt['t24_gl']		= '11506';
					}
					
					if($jt['acc_prefix'] == "IDR"){
						$arrayTmp[$n]['dr_acc'] = $jt['acc_prefix'].$jt['t24_gl'].$jt['seq_t24'].substr($jt['t24_account_code'],5,4);
					}else if($jt['acc_prefix'] == "PL"){
						$arrayTmp[$n]['dr_acc'] 	= "PL" . $jt['t24_gl'];	
					}else{
						$arrayTmp[$n]['dr_acc'] 	= $jt['t24_gl'];
					}
					//dr ccy
					$arrayTmp[$n]['dr_ccy'] = 'IDR';
					//dr amount
					if($jt['amount_db']){
						$arrayTmp[$n]['dr_amount'] 	= $jt['amount_db'];
					}else{
						$arrayTmp[$n]['dr_amount'] 	= '0';
					}
					
					//dr value date
					if(substr($jt['date'],0,10)){
						$arrayTmp[$n]['dr_date'] 	= substr($jt['date'],0,10);
					}else{
						$arrayTmp[$n]['dr_date'] 	= date('Ymd');
					}					
					//dr reference
					if($jt['ref']){
						$arrayTmp[$n]['dr_ref'] 	= $jt['ref'];
					}else{
						$arrayTmp[$n]['dr_ref'] 	= 'Template';
					}					
				}else if($jt['journal_position_id']==2){
					if($count % 2 == 0){
						//credit
						//cr account
						if($jt['acc_prefix'] == "IDR"){
							$arrayTmp[$n]['cr_acc'] = $jt['acc_prefix'].$jt['t24_gl'].$jt['seq_t24'].substr($jt['t24_account_code'],5,4);
						}else if($jt['acc_prefix'] == "PL"){
							$arrayTmp[$n]['cr_acc'] = "PL" . $jt['t24_gl'];	
						}else{
							$arrayTmp[$n]['cr_acc'] = $jt['t24_gl'];
						}				
						//cr ccy
						$arrayTmp[$n]['cr_ccy'] = 'IDR';
						//cr amount
						$arrayTmp[$n]['cr_amount'] = $jt['amount_cr'];
						//cr value date
						if(substr($jt['date'],0,10)){
							$arrayTmp[$n]['cr_date'] = substr($jt['date'],0,10);
						}else{
							$arrayTmp[$n]['cr_date'] = date('Ymd');
						}
						
						//cr reference
						if($jt['ref']){
							$arrayTmp[$n]['cr_ref'] = $jt['ref'];
						}else{	
							$arrayTmp[$n]['cr_ref'] = 'Template';
						}
			
					}
				}
				
				$paramIds[$t]['id']		= $jt['id'];
				$paramIds[$t]['noref']	= $jt['noref'];
				$count++;
				$n++;
				$t++;
			}
			
			//echo '<pre>';
			//var_dump($arrayTmp);
			//echo '</pre>';die();
			
			$data_ft = $arrayTmp;
			//$this->Session->write('ExcelGenerate',$data_ft);
			//$this->Session->write('paramId',$paramIds);
			//echo "here 3";die();
			$this->add_ft_auto($data_ft, $paramIds);
		}
	}
	
	function add_ft_auto($ExcelGenerate, $ids) {
		$posting_date = date('Y-m-d H:i:s');
		$use = 'old';
		//$use = 'new';
		foreach($ids as $id){
			$sql	= "update journal_transactions set posting = '1', posting_date = '".$posting_date."', noref = '".$id['noref']."' where id = '".$id['id']."' ";
			$this->FamsysInterface->query($sql);
		}
		$sukses = false;
		
		if($use == 'old'){
		
			$JournalInterfase = new JournalInterfase;
			$journal_interfases = $JournalInterfase->find('all', array(
				'conditions'=>array('posting'=>0),
				'order'=>array('JournalInterfase.source_dt'),
				'fields' => array(
						'JournalInterfase.source_dt',
						'JournalInterfase.noref',
						'JournalInterfase.kdtran',
						'JournalInterfase.norek1',
						'JournalInterfase.norek2',
						'JournalInterfase.kdcab1',
						'JournalInterfase.kdcab2',
						'JournalInterfase.ket1',
						'JournalInterfase.ket2',
						'JournalInterfase.costdept1',
						'JournalInterfase.costdept2',
						'sum(JournalInterfase.nilai1) as nilai1',
						'sum(JournalInterfase.nilai2) as nilai2',
				),
				'group' => array('JournalInterfase.source_dt','JournalInterfase.norek1','JournalInterfase.norek2','JournalInterfase.kdcab1'
								,'JournalInterfase.kdcab2','JournalInterfase.kdtran','JournalInterfase.ket1',
								'JournalInterfase.ket2','JournalInterfase.costdept1','JournalInterfase.costdept2','JournalInterfase.noref')));
								
			
			
			if($journal_interfases){
				//$this->loadModel('Config');
				//$this->configs = $this->Config->find('list');
				//echo '<pre>';
				//var_dump($this->configs);
				//echo '</pre>';die();
				//$data_source 	= $this->configs['odbc_name'];
				//$user			= $this->configs['user_interfase'];
				//$password		= $this->configs['password_interfase'];
				
				//if (!odbc_connect( $data_source, $user, $password))
				//{
				//	$this->Session->setFlash(__('The famsys interface Can not Posting, Connection Problem with ODBC.', true));
				//	$this->redirect(array('controller'=>'pages', 'action' => 'home'));					
				//}
				$n = 0;
				foreach($journal_interfases as $data)
				{
					$this->FamsysInterface->create();
					list($hh,$ii,$ss) = explode(':', date('H:i:s'));
					
					$param['FamsysInterface']['source_id']		= 'FIX';
					$param['FamsysInterface']['source_dt']		= $data['JournalInterfase']['source_dt'];
					$param['FamsysInterface']['source_no']		= sprintf("%04d",$this->FamsysInterface->incrementId($data['JournalInterfase']['source_dt']));// kirim source_dt return id
					$param['FamsysInterface']['source_tm']		= sprintf("%06d",$hh.$ii.$ss); //number bisa beda keluar nya
					$param['FamsysInterface']['kdtran']			= $data['JournalInterfase']['kdtran'];
					$param['FamsysInterface']['noref']			= 'FIX'.$data['JournalInterfase']['source_dt'].$param['FamsysInterface']['source_no'];
					$param['FamsysInterface']['norek1']			= $data['JournalInterfase']['norek1'];
					$param['FamsysInterface']['kdcab1']			= $data['JournalInterfase']['kdcab1'];
					$param['FamsysInterface']['ccy1']			= '360';
					$param['FamsysInterface']['nilai1']			= $data[0]['nilai1'];
					$param['FamsysInterface']['norek2']			= $data['JournalInterfase']['norek2'];					
					$param['FamsysInterface']['kdcab2']			= $data['JournalInterfase']['kdcab2'];
					$param['FamsysInterface']['ccy2']			= '360';
					$param['FamsysInterface']['nilai2']			= $data[0]['nilai2'];
					$param['FamsysInterface']['costdept1']		= $data['JournalInterfase']['costdept1'];
					$param['FamsysInterface']['costdept2']		= $data['JournalInterfase']['costdept2'];
					$param['FamsysInterface']['kurs']			= '1.000000';
					$param['FamsysInterface']['ket1']			= $data['JournalInterfase']['ket2'];
					$param['FamsysInterface']['ket2']			= $data['JournalInterfase']['ket1'];
					$param['FamsysInterface']['posting']		= '1';
					$param['FamsysInterface']['posting_date']	= date('Y-m-d H:i:s');					
					
					//echo '<pre>';
					//var_dump($param);
					//echo '</pre>';die();
					if($this->FamsysInterface->save($param)){						
						$sukses = true;						
					}					
				}
				
				if($sukses)
				{
					$JournalInterfase = new JournalInterfase;
					$JournalInterfase->updateAll(
						array('posting'=>1, 'posting_date'=>'getdate()'),
						array('posting'=>0)
					);
						
					$this->generateCsvAuto($ExcelGenerate);			
				}
			}
		
		}else{	// if use = new
			// ---------- NEW OVERRIDE QUERY ---------- //
			$sql	= "	select 
					a.source_dt date,
					a.norek1 acc_db,
					a.norek2 acc_cr,
					sum(a.nilai1) amount_db,
					sum(a.nilai2) amount_cr,
					a.ccy1 ccy_db, 
					a.ccy2 ccy_cr,
					a.kdtran kdtran, 
					a.source_no source_no,
					a.kdcab1 kdcab1,
					a.kdcab2 kdcab2,
					a.costdept1 costdept1,
					a.costdept2 costdept2,
					a.ket1 ket1,
					a.ket2 ket2
				from journal_interfases a
				where a.posting = '0'
				group by a.kdcab1, a.kdcab2, a.norek1, a.norek2, a.ccy1, a.ccy2, a.source_dt,
				a.kdtran, a.source_no, a.costdept1, a.costdept2, a.ket1, a.ket2
				order by a.source_dt ";
						
			$JournalInterfase = new JournalInterfase;
			$result	= $JournalInterfase->query($sql);
			
			if($result){
				$n	= 0;
				foreach($result as $data){
					$this->FamsysInterface->create();
					list($hh,$ii,$ss) = explode(':', date('H:i:s'));
					
					$param['FamsysInterface']['source_id']		= 'FIX';
					$param['FamsysInterface']['source_dt']		= $data[0]['date'];
					$param['FamsysInterface']['source_no']		= sprintf("%04d", $this->FamsysInterface->incrementId($data[0]['date']));
					$param['FamsysInterface']['source_tm']		= sprintf("%06d",$hh.$ii.$ss);
					$param['FamsysInterface']['kdtran']			= $data[0]['kdtran'];
					$param['FamsysInterface']['noref']			= 'FIX'.$data[0]['date'].$param['FamsysInterface']['source_no'];
					$param['FamsysInterface']['norek1']			= $data[0]['acc_db'];
					$param['FamsysInterface']['kdcab1']			= $data[0]['kdcab1'];
					$param['FamsysInterface']['ccy1']			= '360';
					$param['FamsysInterface']['nilai1']			= $data[0]['amount_db'];
					$param['FamsysInterface']['norek2']			= $data[0]['acc_cr'];
					$param['FamsysInterface']['kdcab2']			= $data[0]['kdcab2'];
					$param['FamsysInterface']['ccy2']			= '360';
					$param['FamsysInterface']['nilai2']			= $data[0]['amount_cr'];
					$param['FamsysInterface']['costdept1']		= $data[0]['costdept1'];
					$param['FamsysInterface']['costdept2']		= $data[0]['costdept2'];
					$param['FamsysInterface']['kurs']			= '1.000000';
					$param['FamsysInterface']['ket1']			= $data[0]['ket1'];
					$param['FamsysInterface']['ket2']			= $data[0]['ket2'];
					$param['FamsysInterface']['posting']		= '1';
					$param['FamsysInterface']['posting_date']	= date('Y-m-d H:i:s');
					
					//echo '<pre>';
					//var_dump($param);
					//echo '</pre>';die();
					if($this->FamsysInterface->save($param)){
						$sukses = true;
					}
				}
				
				if($sukses)
				{
					$JournalInterfase = new JournalInterfase;
					$JournalInterfase->updateAll(
						array('posting'=>1, 'posting_date'=>'getdate()'),
						array('posting'=>0)
					);
					
					$this->generateCsvAuto($ExcelGenerate);			
					
				}
			}	

		}		
	}
	
	function generateCsvAuto($xclData){		
		$out 	= '';
		$header = '';
		
		$total = count($xclData);
		$n = 0;
		foreach($xclData as $j){
			$n++;
			//if($j['version']){
			//	$j['version'] 		= $j['version'].',';
			//}
			if($j['version']){
				$j['version'] 		= $j['version'].$j['branch'].',';
			}
			if($j['branch']){
				$j['branch'] 		= 'CO.CODE::='.$j['branch'];
			}
			if($j['txn_code']){
				$j['txn_code'] 		= 'TRANSACTION.TYPE::='.$j['txn_code'];
			}
			if($j['dr_acc']){
				$j['dr_acc'] 		= 'DEBIT.ACCT.NO::='.$j['dr_acc'];
			}
			if($j['dr_ccy']){
				$j['dr_ccy'] 		= 'DEBIT.CURRENCY::='.$j['dr_ccy'];
			}
			if($j['dr_amount']){
				$j['dr_amount'] 	= 'DEBIT.AMOUNT::='.$j['dr_amount'];
			}
			if(strlen($j['dr_ref']) > 16){
				$j['dr_ref'] = substr($j['dr_ref'], 0, 16);
			}
			if($j['dr_ref']){
				$j['dr_ref'] 		= 'DEBIT.THEIR.REF::='.$j['dr_ref'];
			}
			if($j['cr_acc']){
				$j['cr_acc'] 		= 'CREDIT.ACCT.NO::='.$j['cr_acc'];
			}
			if($j['cr_ccy']){
				$j['cr_ccy'] 		= 'CREDIT.CURRENCY::='.$j['cr_ccy'];
			}
			if($j['cr_amount']){
				$j['cr_amount'] 	= 'CREDIT.AMOUNT::='.$j['cr_amount'];
			}
			if(strlen($j['cr_ref']) > 16){
				$j['cr_ref'] = substr($j['cr_ref'], 0, 16);
			}
			if($j['cr_ref']){
				$j['cr_ref'] 		= 'CREDIT.THEIR.REF::='.$j['cr_ref'];
			}
			if($j['dao']){
				$j['dao'] 			= 'PROFIT.CENTRE.DEPT::='.$j['dao'];
			}
			if($j['order_cust']){
				$j['order_cust'] 	= 'ORDERING.CUST::='.$j['order_cust'];
			}
		
			$out .= $j['version'] . ","; 		//version			
			//$out .= $j['branch'] . ","; 		//branch code
			$out .= $j['txn_code'] . ","; 		//txn type
			$out .= $j['dr_acc'] . ","; 		//dr account
			$out .= $j['dr_ccy'] . ","; 		//dr ccy
			$out .= $j['dr_amount'] . ",";		//dr amount
			$out .= 'DEBIT.VALUE.DATE::='.date('Y') . date('m') . date('d') . ","; //dr value date
			$out .= $j['dr_ref'] . ","; 		//dr reference
			$out .= $j['cr_acc'] . ","; 		//cr account
			$out .= $j['cr_ccy'] . ","; 		//cr ccy
			//$out .= $j['cr_amount'] . ",";		//cr amount
			$out .= 'CREDIT.VALUE.DATE::='.date('Y') . date('m') . date('d') . ","; //cr value date
			$out .= $j['cr_ref'] . ","; 		//cr reference
			$out .= $j['dao'] . ","; 			//dao
			$out .= $j['order_cust'] . ","; 	//ordering customer			
			
			//if($n == $total){
			//	$out .= $j['rate']; 			//exchange rate
			//}else{
				$out .= $j['rate'] . "\n"; 			//exchange rate
			//}
		}
		
		//$header = '';		
		
		//$this->set(compact(
		//	'header',
		//	'out'
		//));
		
		$this->set('detail', $out);
		$this->set('header', $header);
		
		//$this->Session->write('ExcelGenerate',null);
		
		//echo '<pre>';
		//var_dump($out);
		//echo '</pre>';die();
		$this->layout	= null;
		$this->autolayout=null;
		
		$this->loadModel('Config');
		$this->configs 		= $this->Config->find('list');
		$t24_path 			= $this->configs['t24_path'];
		$t24_name 			= $this->configs['t24_name'];
		$t24_backup_path 	= $this->configs['t24_backup_path'];
		
		file_put_contents($t24_path.$t24_name.'-'.date('Y-m-d-H-i-s').'.csv',$out);		
		file_put_contents($t24_backup_path.$t24_name.'-'.date('Y-m-d-H-i-s').'.csv',$out);
		
		//$this->render('post_t24_xls', 'export_xls');
	}
	
	function insert_into_csb() {
		$JournalInterfase = new JournalInterfase;
		$journal_interfases = $JournalInterfase->find('all', array(
			'conditions'=>array('posting'=>0),
			'order'=>array('JournalInterfase.source_dt'),
			'fields' => array(
                    'JournalInterfase.source_dt',
                    'JournalInterfase.kdtran',
                    'JournalInterfase.norek1',
                    'JournalInterfase.norek2',
                    'JournalInterfase.kdcab1',
                    'JournalInterfase.kdcab2',
                    'JournalInterfase.ket1',
                    'JournalInterfase.ket2',
                    'JournalInterfase.costdept1',
                    'JournalInterfase.costdept2',
                    'sum(JournalInterfase.nilai1) as nilai1',
                    'sum(JournalInterfase.nilai2) as nilai2',
            ),
            'group' => array('JournalInterfase.source_dt','JournalInterfase.norek1','JournalInterfase.norek2','JournalInterfase.kdcab1'
							,'JournalInterfase.kdcab2','JournalInterfase.kdtran','JournalInterfase.ket1',
							'JournalInterfase.ket2','JournalInterfase.costdept1','JournalInterfase.costdept2')));
							
		if(!empty($journal_interfases))
		{
			$data_source 	= $this->configs['odbc_name'];
			$user			= $this->configs['user_interfase'];
			$password		= $this->configs['password_interfase'];
			if (odbc_connect( $data_source, $user, $password))
			{
	
				foreach($journal_interfases as $data)
				{
					$this->FamsysInterface->create();
						$famsys['FamsysInterface']['source_id']   = 'FIX';
						$famsys['FamsysInterface']['source_dt']   = $data['JournalInterfase']['source_dt'];
						$famsys['FamsysInterface']['kdtran']  	  = $data['JournalInterfase']['kdtran'];
						$famsys['FamsysInterface']['norek1']      = $data['JournalInterfase']['norek1'];
						$famsys['FamsysInterface']['kdcab1']      = $data['JournalInterfase']['kdcab1'];
						$famsys['FamsysInterface']['ccy1']        = 360;
						$famsys['FamsysInterface']['nilai1']      = $data[0]['nilai1'];
						$famsys['FamsysInterface']['norek2']      = $data['JournalInterfase']['norek2'];
						$famsys['FamsysInterface']['kdcab2']      = $data['JournalInterfase']['kdcab2'];
						$famsys['FamsysInterface']['ccy2']        = 360;
						$famsys['FamsysInterface']['nilai2']      = $data[0]['nilai2'];
						$famsys['FamsysInterface']['costdept1']   = $data['JournalInterfase']['costdept1'];
						$famsys['FamsysInterface']['costdept2']   = $data['JournalInterfase']['costdept2'];
						$famsys['FamsysInterface']['kurs']   	  = 1;
						$famsys['FamsysInterface']['ket1']   	  = $data['JournalInterfase']['ket2'];
						$famsys['FamsysInterface']['ket2']   	  = $data['JournalInterfase']['ket1'];
						$famsys['FamsysInterface']['source_no']   = sprintf("%04d",$this->FamsysInterface->incrementId($data['JournalInterfase']['source_dt']));// kirim source_dt return id
						$famsys['FamsysInterface']['noref'] 	  = $famsys['FamsysInterface']['source_id'].$famsys['FamsysInterface']['source_dt'].$famsys['FamsysInterface']['source_no'];
						list($hh,$ii,$ss) = explode(':', date('H:i:s'));
						$famsys['FamsysInterface']['source_tm']	= sprintf("%06d",$hh.$ii.$ss); //number bisa beda keluarr nya
					if($this->FamsysInterface->save($famsys['FamsysInterface'])){
						$sukses = true;
					}
					if(!$this->FamsysInterface->save($famsys)){
						debug($this->validationErrors); die();
					}
				}
				
				if($sukses)
				{
					$JournalInterfase = new JournalInterfase;
					$JournalInterfase->updateAll(
						array('posting'=>1, 'posting_date'=>'getdate()'),
						array('posting'=>0)
					);
					$this->insert_csb();
				}
			}
			else
			{
				$this->Session->setFlash(__('The famsys interface Can not Posting, Please Try Again.', true));
				$this->redirect(array('controller'=>'pages', 'action' => 'home'));					
			}
		}
		
	}

	function insert_csb() {
		
		$data_source 	= $this->configs['odbc_name'];
		$user			= $this->configs['user_interfase'];
		$password		= $this->configs['password_interfase'];
		
		if ( !( $database = odbc_connect($data_source, $user, $password)))
		die( "Could not connect to database" );
		$FamsysInterface = $this->FamsysInterface->find('all', array('conditions'=>array('posting'=>0)));
		foreach($FamsysInterface as $interfase)
		{
				$source_id 	= $interfase['FamsysInterface']['source_id'];
				$source_dt 	= $interfase['FamsysInterface']['source_dt'];
				$source_no 	= sprintf("%04d",$interfase['FamsysInterface']['source_no']);
				$source_tm	= $interfase['FamsysInterface']['source_tm'];
				$kdtran 	= $interfase['FamsysInterface']['kdtran'];
				$noref	 	= $interfase['FamsysInterface']['noref'];
				$kdcab1	 	= $interfase['FamsysInterface']['kdcab1'];
				$kdcab2	 	= $interfase['FamsysInterface']['kdcab2'];
				$norek1	 	= $interfase['FamsysInterface']['norek1'];
				$norek2	 	= $interfase['FamsysInterface']['norek2'];
				$ket1	 	= $interfase['FamsysInterface']['ket1'];
				$ket2	 	= $interfase['FamsysInterface']['ket2'];
				$ket3	 	= $interfase['FamsysInterface']['ket3'];
				$kurs	 	= $interfase['FamsysInterface']['kurs'];
				$ccy1	 	= $interfase['FamsysInterface']['ccy1'];
				$ccy2	 	= $interfase['FamsysInterface']['ccy2'];
				$costdept1	= $interfase['FamsysInterface']['costdept1'];
				$costdept2	= $interfase['FamsysInterface']['costdept2'];
				$nilai1		= $interfase['FamsysInterface']['nilai1'];
				$nilai2		= $interfase['FamsysInterface']['nilai2'];
			
			$stmt = odbc_prepare($database, "INSERT INTO trans(source_id,source_dt,source_no,source_tm,kdtran,noref,norek1,norek2,kdcab1,kdcab2,
			ket1,ket2,ket3,nilai1,nilai2,ccy1,ccy2,costdept1,costdept2,kurs) 
			VALUES('$source_id','$source_dt','$source_no','$source_tm','$kdtran','$noref','$norek1','$norek2','$kdcab1','$kdcab2','$ket2','$ket1','$ket3',
			$nilai1,$nilai2,'$ccy1','$ccy2','$costdept1','$costdept2',$kurs);" ); 				
			/* check for errors */
			if (!odbc_execute($stmt))
			{
				/* error */
				echo " Error please re-check $noref <br/>";
				$sukses = false;
			}else{
				$sukses = true;
			}			
			if($sukses)
			{
				 $this->FamsysInterface->read(null, $interfase['FamsysInterface']['id']);
				 $this->FamsysInterface->set('posting', 1);
				 $this->FamsysInterface->set('posting_date', date('Y-m-d H:i:s'));
				 $this->FamsysInterface->save();
			}

		}
		return $sukses;
	}
	
	function read_csb() {
		
		$data_source 	= $this->configs['odbc_name'];
		$user			= $this->configs['user_interfase'];
		$password		= $this->configs['password_interfase'];
		
		if ( !( $database = odbc_connect( $data_source, $user, $password)))
		die( "Could not connect to database" );
			
			$stmt = "Select * from trans"; 
			$queryexe = odbc_exec($database, $stmt);
			while ($row = odbc_fetch_array($queryexe)) 
			{
				$interfase = $this->FamsysInterface->find('first', array('conditions'=>array('noref'=>$row['noref'])));
				$this->FamsysInterface->read(null, $interfase['FamsysInterface']['id']);
				$this->FamsysInterface->set('rc', $row['rc']);
				$this->FamsysInterface->set('st', $row['st']);
				$this->FamsysInterface->save();
			}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid famsys interface', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->FamsysInterface->save($this->data)) {
				$this->Session->setFlash(__('The famsys interface has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The famsys interface could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->FamsysInterface->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for famsys interface', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->FamsysInterface->delete($id)) {
			$this->Session->setFlash(__('Famsys interface deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Famsys interface was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function prepare_journal() {
		$this->configs 		= $this->Config->find('list');
		$journal_cut_off 	= $this->configs['journal_cut_off'];
		$this->set('journal_cut_off', $journal_cut_off);
	}
}
?>