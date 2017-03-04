<?php
class JournalInterfasesController extends AppController {

	var $name = 'JournalInterfases';

	function index() {
		$this->JournalInterfase->recursive = 0;
		$this->set('journalInterfases', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid journal interfase', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('journalInterfase', $this->JournalInterfase->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->JournalInterfase->create();
			if ($this->JournalInterfase->save($this->data)) {
				$this->Session->setFlash(__('The journal interfase has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The journal interfase could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid journal interfase', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->JournalInterfase->save($this->data)) {
				$this->Session->setFlash(__('The journal interfase has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The journal interfase could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->JournalInterfase->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for journal interfase', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->JournalInterfase->delete($id)) {
			$this->Session->setFlash(__('Journal interfase deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Journal interfase was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function insert_adt()
	{
		$data_source 	= $this->configs['odbc_name'];
		$user			= $this->configs['user_interfase'];
		$password		= $this->configs['password_interfase'];
		
		if ( !( $database = odbc_connect( $data_source, $user, $password)))
		die( "Could not connect to database" );
		
		$journalInterfase = $this->JournalInterfase->find('all', array(
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
		$i = 0;
		
		foreach($journalInterfase as $interfase)
		{
			$i++;
			$source_id 	= 'FIX';
			$source_dt 	= $interfase['JournalInterfase']['source_dt'];
			$source_no 	= sprintf("%04d",$i);
			list($hh,$ii,$ss) = explode(':', date('H:i:s'));
			$source_tm	= sprintf("%06d",$hh.$ii.$ss); //number bisa beda keluarr nya
			$kdtran 	= 510;
			$noref	 	= $source_id.$source_dt.$source_no;
			$kdcab1	 	= $interfase['JournalInterfase']['kdcab1'];
			$kdcab2	 	= $interfase['JournalInterfase']['kdcab2'];
			$norek1	 	= $interfase['JournalInterfase']['norek1'];
			$norek2	 	= $interfase['JournalInterfase']['norek2'];
			$ket1	 	= $interfase['JournalInterfase']['ket1'];
			$ket2	 	= $interfase['JournalInterfase']['ket2'];
			$ket3	 	= '';
			$kurs	 	= 1;
			$ccy1	 	= 360;
			$ccy2	 	= 360;
			$costdept1	= $interfase['JournalInterfase']['costdept1'];
			$costdept2	= $interfase['JournalInterfase']['costdept2'];
			$nilai1		= $interfase[0]['nilai1'];
			$nilai2		= $interfase[0]['nilai2'];
			
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
			
		}
			if($sukses)
			{
				$this->JournalInterfase->updateAll(
					array('posting'=>1, 'posting_date'=>'getdate()'),
					array('posting'=>0)
				);
			}

	}
}
?>