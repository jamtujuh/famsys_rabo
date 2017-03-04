<?php
class Npb extends AppModel {
	var $name = 'Npb';
	var $displayField = 'no';
	var $actsAs = array('Logable' => array( 
        'userModel' => 'Npb',  
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
		'department_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'cost_center_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'request_type_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'npb_date' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			/* 'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			), */
		),		
		'req_date' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			/* 'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			), */
		),
		'created_by' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Department' => array(
			'className' => 'Department',
			'foreignKey' => 'department_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'BusinessType' => array(
			'className' => 'BusinessType',
			'foreignKey' => 'business_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'CostCenter' => array(
			'className' => 'CostCenter',
			'foreignKey' => 'cost_center_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'NpbStatus' => array(
			'className' => 'NpbStatus',
			'foreignKey' => 'npb_status_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'RequestTypes' => array(
			'className' => 'RequestTypes',
			'foreignKey' => 'request_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),		
		'Supplier' => array(
			'className' => 'Supplier',
			'foreignKey' => 'supplier_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'NpbDetail' => array(
			'className' => 'NpbDetail',
			'foreignKey' => 'npb_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'NpbSupplier' => array(
			'className' => 'NpbSupplier',
			'foreignKey' => 'npb_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Attachment' => array(
			'className' => 'Attachment',
			'foreignKey' => 'npb_id',
			'dependent' => true,
		)		
	);

    var $hasAndBelongsToMany = array(
        'Po' =>
            array(
                'className'              => 'Po',
                'joinTable'              => 'npbs_pos',
                'foreignKey'             => 'npb_id',
                'associationForeignKey'  => 'po_id',
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
	  'v_total' 			=> SQL_V_TOTAL_DISPLAY_FIELD,
	  'v_total_cur' 		=> SQL_V_TOTAL_CUR_DISPLAY_FIELD,
	  'v_supplier_name' 	=> SQL_NAME_SUPPLIER_DISPLAY_FIELD,
	  //'v_displayField'      => SQL_NPB_DISPLAY_FIELD,
	  /* new: done is checked by qty-qty_filled, if sum  zero => done, else outstanding */
	  'v_is_done'			=> SQL_NPB_V_IS_DONE_DISPLAY_FIELD
	);
      
	
	function getNewId($department_id, $request_type_id)
	{
		$year 	= date('my') ;
		$prefix = 'MR';
		$dep 			= $this->Department->read(null, $department_id);
		$request_type 	= $this->RequestTypes->read(null, $request_type_id);
		$dep_code = $dep['Department']['code'];
		$req_code = $request_type['RequestTypes']['descr'];
		$code 	= $dep_code . '/' . $prefix . '-' .$req_code .'/';
		$npb = $this->find('all', array(
			'conditions'=>array(
				'Npb.department_id'=>$department_id,
				'Npb.request_type_id'=>$request_type_id,
				'year(Npb.npb_date)'=> date('Y'),
				'Npb.no like "'.$code.'%"'),
			'fields'=>'Npb.no', 
			'limit'=>1, 
			'order'=>'Npb.id desc') );
		if(!empty($npb))
		{
			$next =  $npb[0]['Npb']['no'];
			$a = explode('/',$next);
			//antisipasi nomor format lama

			// $prefix = $a[0];
			// $dep_code = $a[1];
			// $year = $a[2];
			$no = $a[2]; 

			$next = $prefix . '-'. $dep_code. '-' . $year . '-' . sprintf("%04s",$no+1);
			$next = "$dep_code/$prefix-$req_code/".sprintf("%03s",$no+1)."/$year";
		}
		else
		{
			$next = "$dep_code/$prefix-$req_code/001/$year";
		}
		return $next;
	}
	
	function getNewIdCompile($department_id, $request_type_id, $type)
	{
		$year 	= date('my') ;
		$prefix = 'MR';
		$dep 			= $this->Department->read(null, $department_id);
		$request_type 	= $this->RequestTypes->read(null, $request_type_id);
		$dep_code = $dep['Department']['code'];
		$req_code = $request_type['RequestTypes']['descr'];
		$code 	= $dep_code . '/' . $prefix . '-' .$req_code .'-C/';
		$npb = $this->find('all', array(
			'conditions'=>array(
				'Npb.department_id'=>$department_id,
				'Npb.request_type_id'=>$request_type_id,
				'year(Npb.npb_date)'=> date('Y'),
				'Npb.no like "'.$code.'%"'),
			'fields'=>'Npb.no', 
			'limit'=>1, 
			'order'=>'Npb.id desc') );
		$day		= date('d');
		if(!empty($npb))
		{
			$next =  $npb[0]['Npb']['no'];
			$a = explode('/',$next);
			//antisipasi nomor format lama

			// $prefix = $a[0];
			// $dep_code = $a[1];
			// $year = $a[2];
			$no = $a[2]; 

			$next = $prefix . '-'. $dep_code. '-' . $year . '-' . sprintf("%04s",$no+1);
			$next = "$dep_code/$prefix-$req_code-C/0$day-$type/$year";
		}
		else
		{
			$next = "$dep_code/$prefix-$req_code-C/0$day-$type/$year";
		}
		return $next;
	}
	
	function getNewIdDummy($department_id, $request_type_id)
	{
		$year 	= date('my') ;
		$prefix = 'MR';
		$dep 			= $this->Department->read(null, $department_id);
		$request_type 	= $this->RequestTypes->read(null, $request_type_id);
		$dep_code = $dep['Department']['code'];
		$req_code = $request_type['RequestTypes']['descr'];
		$code 	= $dep_code . '/' . $prefix . '-' .$req_code .'/';
		$npb = $this->find('all', array(
			'conditions'=>array(
				'Npb.department_id'=>$department_id,
				'Npb.request_type_id'=>$request_type_id,
				'year(Npb.npb_date)'=> date('Y'),
				'Npb.no like "'.$code.'%"'),
			'fields'=>'Npb.no', 
			'limit'=>1, 
			'order'=>'Npb.id desc') );
		if(!empty($npb))
		{
			$next =  $npb[0]['Npb']['no'];
			$a = explode('/',$next);
			//antisipasi nomor format lama

			// $prefix = $a[0];
			// $dep_code = $a[1];
			// $year = $a[2];
			$no = $a[2]; 

			$next = $prefix . '-'. $dep_code. '-' . $year . '-' . sprintf("%04s",$no+1);
			$next = "$dep_code/$prefix-DUMMY/".sprintf("%03s",$no+1)."/$year";
		}
		else
		{
			$next = "$dep_code/$prefix-DUMMY/001/$year";
		}
		return $next;
	}
	
	function count_by_status($npb_status_id, $group_id, $department_id, $username=null)
	{	
		
		$cons = array();
		//check database driver 
		//************************
		if(DRIVER=='mysql')
			$v_is_done =  '(select if(sum(qty-qty_filled)=0,1,0) from npb_details where npb_details.npb_id=Npb.id)' ;
		elseif(DRIVER=='mssql')
			$v_is_done =  '(select case sum(qty-qty_filled) when 0 then 1 else 0 end from npb_details where npb_details.npb_id=Npb.id)' ;
		//************************
		if($group_id == branch_head_group_id || $group_id == mr_aproval2_group_id|| $group_id == mr_aproval3_group_id)//branch_head
			$cons[] = array('and' =>array('Npb.npb_status_id'=>$npb_status_id, 'Npb.department_id'=>$department_id, 'Npb.request_type_id != '.request_type_point_reward_id));
		else if($group_id == gs_admin_group_id)//gs_admin
			$cons[] = array('and' =>array('Npb.npb_status_id'=>$npb_status_id, 
				'or'=>array(array('Npb.request_type_id'=>request_type_fa_general_id),
						array('Npb.request_type_id'=>request_type_stock_id),
						array('Npb.request_type_id'=>request_type_service_id),
						array('Npb.request_type_id'=>request_type_point_reward_id))
			));
		else if($group_id == it_admin_group_id)//it_admin
			$cons[] = array('and' =>array('Npb.npb_status_id'=>$npb_status_id, 
				'Npb.request_type_id'=>request_type_fa_it_id));
		else if($group_id	== gs_group_id)//gs
			$cons[] = array('and' =>array('Npb.npb_status_id'=>$npb_status_id, 
				$v_is_done => 0));
		else if($group_id == gs_spv_group_id)//gs_spv
			$cons[] = array('and' =>array('Npb.npb_status_id'=>$npb_status_id, 
				'or'=>array(array('Npb.request_type_id'=>request_type_fa_it_id),
						array('Npb.request_type_id'=>request_type_fa_general_id),
						array('Npb.request_type_id'=>request_type_stock_id),
						array('Npb.request_type_id'=>request_type_service_id))
			));
		else if($group_id	== normal_user_group_id)//normal
			$cons[] = array('and' =>array('Npb.npb_status_id'=>$npb_status_id, 'Npb.department_id'=>$department_id, 'Npb.created_by'=>$username));
		else if($group_id	== fa_management_group_id)//fa_management
			$cons[] = array('Npb.npb_status_id'=>$npb_status_id);
		else if($group_id	== stock_management_group_id)//stock_management
			$cons[] = array('and' =>array('Npb.npb_status_id'=>$npb_status_id, 
			'Npb.request_type_id'=>request_type_stock_id, /*'Npb.department_id'=>$department_id,*/ 
			$v_is_done => 0, 'Npb.created_by'=>$username));
		else if($group_id	== stock_supervisor_group_id)//stock_supervisor
			$cons[] = array('and' =>array('Npb.npb_status_id'=>$npb_status_id, 
			'Npb.request_type_id'=>request_type_stock_id, /*'Npb.department_id'=>$department_id,*/ 
			$v_is_done => 0));
		else if($group_id	== it_management_group_id)//it_management
			$cons[] = array('Npb.npb_status_id'=>$npb_status_id);
		else if($group_id	== rac_group_id || $group_id == rac_approval_group_id)//rac 
			$cons[] = array('and' =>array('Npb.npb_status_id'=>$npb_status_id, 
											'Npb.request_type_id'=>request_type_point_reward_id));
			
		//	$cons[] = array('and' =>array('Npb.npb_status_id'=>$npb_status_id, 'Npb.department_id'=>$department_id, '(SELECT if(sum(qty-qty_filled)=0,1,0)  FROM npb_details WHERE npb_details.npb_id = Npb.id) = 0'));
			
		//echo '<pre>';
		//var_dump($cons);
		//echo '</pre>';die();
			
		$c = $this->find('count', array('conditions'=>$cons));
		return $c;
	}
	
	function count_mr_point_reward_compiled( )
	{
		$cons[] = array('Npb.request_type_id'=>request_type_point_reward_id, 
						'Npb.npb_status_id'=>status_npb_processing_id,
						'Npb.no like "%MR-RAC-C%" ');
		$c = $this->find('count', array('conditions'=>$cons));
		
		return $c;
	}

	function count_item_no_process_type($request_type_id)
	{
		$count = $this->NpbDetail->find('count', array(
			'conditions'=>array(
					'Npb.npb_status_id'=>array(status_npb_processing_id),
					'NpbDetail.qty > NpbDetail.qty_filled',
					//'NpbDetail.qty != NpbDetail.qty_filled',
					'NpbDetail.process_type_id'=>null,
					'Npb.request_type_id'=>$request_type_id
					)
		));

		return $count;
	}
	
	function count_item_for_procurement( )
	{
		$count = $this->NpbDetail->find('count', array(
			'conditions'=>array(
					'Npb.npb_status_id'=>status_npb_processing_id,
					'NpbDetail.process_type_id'=>procurement_process_type_id,
					'NpbDetail.qty > NpbDetail.qty_filled')
					//'NpbDetail.qty != NpbDetail.qty_filled')
					//'convert(varchar, NpbDetail.qty) !=' => 'convert(varchar, NpbDetail.qty_filled)')
		));
		
		return $count;
	}
	
	function count_item_for_movement($request_type_id)
	{
		$count = $this->NpbDetail->find('count', array(
			'conditions'=>array(
					'Npb.npb_status_id'=>status_npb_processing_id,
					'Npb.request_type_id'=>$request_type_id,
					'NpbDetail.process_type_id'=>movement_process_type_id,
					'NpbDetail.qty > NpbDetail.qty_filled')
					//'NpbDetail.qty != NpbDetail.qty_filled')
					//'convert(varchar, NpbDetail.qty) !=' => 'convert(varchar, NpbDetail.qty_filled)')
		));
		
		return $count;
	}
		
	function checkDone($id)
	{
		$npb = $this->read(null, $id);
		$is_done = $npb['Npb']['v_is_done'];
		
		foreach($npb['NpbDetail'] as $detail){
			if($detail['qty_filled'] > $detail['qty']){
				$this->query('update npb_details set qty_filled = "'.$detail['qty'].'" where id = "'.$detail['id'].'" ');
			}
		}
		
		if($is_done == 1)
		{
			$this->id = $id;
			$this->set('npb_status_id', status_npb_done_id);
			$this->set('date_finish', date('Y-m-d H:i:s'));
			$this->save();
		}
	}
	
	function count_voucher_by_status($npb_status_id, $group_id, $department_id, $username=null)
	{	
		
		$cons = array();
		//check database driver 
		//************************
		if(DRIVER=='mysql')
			$v_is_done =  '(select if(sum(qty-qty_filled)=0,1,0) from npb_details where npb_details.npb_id=Npb.id)' ;
		elseif(DRIVER=='mssql')
			$v_is_done =  '(select case sum(qty-qty_filled) when 0 then 1 else 0 end from npb_details where npb_details.npb_id=Npb.id)' ;
		//************************
		if($group_id == 2 || $group_id == 104 || $group_id == 105)//branch_head
			$cons[] = array('and' =>array('Npb.npb_status_id'=>$npb_status_id, 'Npb.department_id'=>$department_id));
		else if($group_id == 14 || $group_id == 100)//branch_head
			$cons[] = array('and' =>array('Npb.npb_status_id'=>$npb_status_id));
		
		$cons[] = array('and' =>array('Npb.request_type_id'=>5,));
			
		$c = $this->find('count', array('conditions'=>$cons));
		//echo '<pre>';
		//var_dump($c);
		//echo '</pre>';die();
		return $c;
	}
	
	function count_voucher_approved($npb_status_id, $group_id, $department_id, $username=null)
	{	
		
		$cons = array();
		//check database driver 
		//************************
		if(DRIVER=='mysql')
			$v_is_done =  '(select if(sum(qty-qty_filled)=0,1,0) from npb_details where npb_details.npb_id=Npb.id)' ;
		elseif(DRIVER=='mssql')
			$v_is_done =  '(select case sum(qty-qty_filled) when 0 then 1 else 0 end from npb_details where npb_details.npb_id=Npb.id)' ;
		//************************
		if($group_id == 2 || $group_id == 104 || $group_id == 105)//branch_head
			$cons[] = array('and' =>array('Npb.npb_status_id'=>$npb_status_id, 'Npb.department_id'=>$department_id));
		else if($group_id == 14 || $group_id == 100)//branch_head
			$cons[] = array('and' =>array('Npb.npb_status_id'=>$npb_status_id));
		
		$cons[] = array('and' =>array('Npb.request_type_id'=>5,));
		$cons[] = array('and' =>array('Npb.approved_date !='=>null,));
			
		$c = $this->find('count', array('conditions'=>$cons));
		//echo '<pre>';
		//var_dump($c);
		//echo '</pre>';die();
		return $c;
	}
	
}
?>
