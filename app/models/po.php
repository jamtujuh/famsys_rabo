<?php
class Po extends AppModel {
	var $name = 'Po';
	var $displayField = 'no';
	var $actsAs = array('Logable' => array( 
        'userModel' => 'Po',  
        'userKey' => 'id',  
        'change' => 'list', // options are 'list' or 'full' 
        'description_ids' => TRUE // options are TRUE or FALSE 
    ));
	var $validate = array(
		'no' => array(
			'is Unique' => array(
				'rule' => array('isUnique'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'po_date' => array(
			/* 'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			), */
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'supplier_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'umurek' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Umurek cannot be null',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),		
		// 'department_id' => array(
			// 'notempty' => array(
				// 'rule' => array('notempty'),
				// //'message' => 'Your custom message here',
				// //'allowEmpty' => false,
				// //'required' => false,
				// //'last' => false, // Stop validation after this rule
				// //'on' => 'create', // Limit validation to 'create' or 'update' operations
			// ),
		// ),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Supplier' => array(
			'className' => 'Supplier',
			'foreignKey' => 'supplier_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'PoStatus' => array(
			'className' => 'PoStatus',
			'foreignKey' => 'po_status_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),			
		'Currency' => array(
			'className' => 'Currency',
			'foreignKey' => 'currency_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),		
		'Department' => array(
			'className' => 'Department',
			'foreignKey' => 'department_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'RequestType' => array(
			'className' => 'RequestType',
			'foreignKey' => 'request_type_id',
		)	
	);

	var $hasMany = array(
		'PoDetail' => array(
			'className' => 'PoDetail',
			'foreignKey' => 'po_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => 'item_code ASC',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'NpbDetail' => array(
			'className' => 'NpbDetail',
			'foreignKey' => 'po_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'PoPayment' => array(
			'className' => 'PoPayment',
			'foreignKey' => 'po_id'
		),
		'DeliveryOrder' => array(
			'className' => 'DeliveryOrder',
			'foreignKey' => 'po_id'
		)
	);
	
    var $hasAndBelongsToMany = array(
        'Npb' => array(
			'className'              => 'Npb',
			'joinTable'              => 'npbs_pos',
			'foreignKey'             => 'po_id',
			'associationForeignKey'  => 'npb_id',
			'unique'                 => true,
			'conditions'             => '',
			'fields'                 => '',
			'order'                  => '',
			'limit'                  => '',
			'offset'                 => '',
			'finderQuery'            => '',
			'deleteQuery'            => '',
			'insertQuery'            => ''
		),
	    'Invoice' => array(
			'className'              => 'Invoice',
			'joinTable'              => 'invoices_pos',
			'foreignKey'             => 'po_id',
			'associationForeignKey'  => 'invoice_id',
			'unique'                 => true,
			'conditions'             => '',
			'fields'                 => '',
			'order'                  => '',
			'limit'                  => '',
			'offset'                 => '',
			'finderQuery'            => '',
			'deleteQuery'            => '',
			'insertQuery'            => ''
		)	
    );	
	var $virtualFields = array(
	  'vsubtotal' => 'SELECT SUM(po_details.amount) FROM po_details WHERE po_details.po_id = Po.id',
	  'vsubtotal_cur' => 'SELECT SUM(po_details.amount_cur) FROM po_details WHERE po_details.po_id = Po.id',

	  'vtotal_discount' => 'SELECT SUM(po_details.discount) FROM po_details WHERE po_details.po_id = Po.id',
	  'vtotal_after_disc' => 'SELECT SUM(po_details.amount_after_disc) FROM po_details WHERE po_details.po_id = Po.id',
	  'vtotal_vat_base' => SQL_VTOTAL_VAT_BASE_DISPLAY_FIELD,
	  'vtotal_vat' => 'SELECT SUM( po_details.vat ) FROM po_details WHERE po_details.po_id = Po.id',

	  'vtotal_discount_cur' => 'SELECT SUM(po_details.discount_cur) FROM po_details WHERE po_details.po_id = Po.id',
	  'vtotal_after_disc_cur' => 'SELECT SUM(po_details.amount_after_disc_cur) FROM po_details WHERE po_details.po_id = Po.id',
	  'vtotal_vat_base_cur' => SQL_VTOTAL_VAT_BASE_CUR_DISPLAY_FIELD,
	  'vtotal_vat_cur' => 'SELECT SUM( po_details.vat_cur ) FROM po_details WHERE po_details.po_id = Po.id',

	  'supplier_name' => 'SELECT name from suppliers s where s.id = Po.supplier_id',
	  'department_name' => 'SELECT name from departments d where d.id = Po.department_id',
	  'status_name' => 'SELECT name from po_statuses s where s.id = Po.po_status_id',
	  'v_is_done'		=> SQL_V_IS_DONE_PO_DISPLAY_FIELD,
      'v_month'  => 'SELECT SUM(po_details.qty) FROM po_details,pos WHERE po_details.po_id = Po.id and MONTH(po_date)=month(getdate())',
	  
	  'v_total_term_percent' => 'SELECT SUM( po_payments.term_percent ) FROM po_payments WHERE po_payments.po_id = Po.id',
	  'v_total_amount_due' => 'SELECT SUM(po_payments.amount_due) FROM po_payments WHERE po_payments.po_id = Po.id',
	  'v_total_amount_paid' => 'SELECT SUM(po_payments.amount_paid) FROM po_payments WHERE po_payments.po_id = Po.id'
);	
	
	function beforeSave()
	{
		//var_dump($this->data);
		
		if(isset($this->data['Po']['after_disc_cur']) && isset($this->data['Po']['vat_total_cur']) )
		{
			$this->data['Po']['total_cur'] = $this->data['Po']['after_disc_cur'] 
				+ $this->data['Po']['vat_total_cur'];
		}
		
		if(isset($this->data['Po']['after_disc']) && isset($this->data['Po']['vat_total']) )
		{
			$this->data['Po']['total'] 	= $this->data['Po']['after_disc'] 
				+ $this->data['Po']['vat_total'];
		}

		return true;
	}
		
	function getNewId($request_type_id)
	{
		$year = date('my');
		$prefix = 'RII/HO';
		$request_type = $this->RequestType->read(null, $request_type_id);
		$reg_code	  = $request_type['RequestType']['descr'];
		
		$po = $this->find('all', array(
		'conditions'=>array(
			'Po.request_type_id'=>$request_type_id,
			'year(Po.po_date)'=> date('Y'),
			'right(Po.no, 2)'=> date('y')),
		'fields'=>'Po.no', 
		'limit'=>1, 
		'order'=>'Po.id desc'));

		/*
		if($request_type_id==3 && date('Y')==2014 && date('m')>'02'){

			$start_limit = 371;

			$po = $this->find('all', array(
				'conditions'=>array(
					'Po.request_type_id'=>$request_type_id,
					'year(Po.po_date)'=> date('Y'),
					'right(Po.no, 2)'=> date('y'),
					'year(Po.created)'=> date('Y'),
					"SUBSTRING(Po.no,charindex('/', Po.no, charindex('/', Po.no)+1)+1,3) < " => 371
					),
				'fields'=>'Po.no', 'limit'=>1, 'order'=>'Po.no desc') );
			if(!empty($po))
			{
				$next =  $po[0]['Po']['no'];
				$a	  =  explode('/',$next);
				$no	  =  $a[2];

				if(($no+1) >= $start_limit){
					$po = $this->find('all', array(
						'conditions'=>array(
							'Po.request_type_id'=>$request_type_id,
							'year(Po.po_date)'=> date('Y'),
							'right(Po.no, 2)'=> date('y'),
							'year(Po.created)'=> date('Y')),
						'fields'=>'Po.no', 'limit'=>1, 'order'=>'Po.no desc') );
				}
			}
		}
		*/

		if(!empty($po))
		{
			$next =  $po[0]['Po']['no'];
			$a	  =  explode('/',$next);
			$no	  =  $a[2];
			$next =  $prefix.'-'.$reg_code.'/'.sprintf("%03s",$no+1)."/$year";
		}
		else
		{
			$next = "RII/HO-$reg_code/001/$year";
		}
		return $next;
	}	
	

	function calc_tax($id_detail)
	{
		$po = $this->PoDetail->read(null, $id_detail);
		$id = $po['PoDetail']['po_id'];
		
		$po = $this->PoDetail->find('all', array('conditions'=>array('PoDetail.po_id'=>$id)));
		$vat_base = 0;
		//$wht_base = 0;
		foreach ($po as $i=>$d)
		{
			$vat_base += $d['PoDetail']['is_vat']==1?$d['PoDetail']['amount']:0;
			//$wht_base += $d['PoDetail']['is_wht']==1?$d['PoDetail']['amount']:0;
		}
		
		$this->data = $this->read(null, $id);
		$this->data['Po']['vat_base'] = $vat_base;
		//$this->data['Po']['wht_base'] = $wht_base;
		$this->save($this->data);
		
	}	
	
	function count_by_status($status_id)
	{
		$c = $this->find('count', array('conditions'=>array('Po.po_status_id'=>$status_id)));
		return $c;
	}
	
	function count_down_payment_unjournaled()
	{
		$c = $this->find('count', array('conditions'=>array('Po.down_payment >'=>0, 
			'Po.is_down_payment_journal_generated'=>0,
			'Po.po_status_id'=>status_po_sent_id)));
		return $c;
	}
	
}
?>