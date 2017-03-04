<?php
class Movement extends AppModel {
	var $name = 'Movement';
	var $displayField = 'no';
	// var $actsAs = array('Logable' => array( 
        // 'userModel' => 'Movement',  
        // 'userKey' => 'id',  
        // 'change' => 'list', // options are 'list' or 'full' 
        // 'description_ids' => TRUE // options are TRUE or FALSE 
    // ));
	var $validate = array(
		'doc_date' => array(
			'notempty' => array(
				'rule' => array('notempty'),
			/* 'date' => array(
				'rule' => array('date'), */
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
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
		'source_department_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'source_business_type_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'source_cost_center_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'dest_department_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		/*'source_department_sub_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'source_department_unit_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),*/
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
		'movement_status_id' => array(
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
			'foreignKey' => 'source_department_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'DepartmentSub' => array(
			'className' => 'DepartmentSub',
			'foreignKey' => 'source_department_sub_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'DepartmentUnit' => array(
			'className' => 'DepartmentUnit',
			'foreignKey' => 'source_department_unit_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'BusinessType' => array(
			'className' => 'BusinessType',
			'foreignKey' => 'source_business_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'CostCenter' => array(
			'className' => 'CostCenter',
			'foreignKey' => 'source_cost_center_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'MovementStatus' => array(
			'className' => 'MovementStatus',
			'foreignKey' => 'movement_status_id',
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
	);
	
	var $hasMany = array(
		'MovementDetail' => array(
			'className' => 'MovementDetail',
			'foreignKey' => 'movement_id',
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
		'NpbDetail' => array(
			'className' => 'NpbDetail',
			'foreignKey' => 'movement_id',
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
	);
	
	var $virtualFields = array(
		'status_name' => 'SELECT name from movement_statuses s where s.id = Movement.movement_status_id'
	);
	
	function getNewId()
	{
		$movement = $this->find('all', array('fields'=>'Movement.no', 'limit'=>1, 'order'=>'Movement.no desc') );
		if(!empty($movement))
		{
			$next =  $movement[0]['Movement']['no'];
			list($prefix, $no) = explode('-',$next);
			$next = $prefix . '-' . sprintf("%04s",$no+1);
		}
		else
		{
			$next = 'MOV-0001';
		}
		return $next;
	}
	
	function count_by_status($movement_id, $group_id)
	{
		$cons[] = array();
		
		if($group_id == fa_management_group_id)//fa_management
			$cons[] = array('and' =>array('Movement.movement_status_id'=>$movement_id, 'Movement.request_type_id'=>request_type_fa_general_id));
		else if($group_id == fa_supervisor_group_id)//fa_supervisor
			$cons[] = array('and' =>array('Movement.movement_status_id'=>$movement_id, 'Movement.request_type_id'=>request_type_fa_general_id));
		else if($group_id == it_management_group_id)//it_management
			$cons[] = array('and' =>array('Movement.movement_status_id'=>$movement_id, 'Movement.request_type_id'=>request_type_fa_it_id));
		else if($group_id == it_supervisor_group_id)//it_supervisor
			$cons[] = array('and' =>array('Movement.movement_status_id'=>$movement_id, 'Movement.request_type_id'=>request_type_fa_it_id));
		else if($group_id == fincon_group_id)//fincon
			$cons[] = array('Movement.movement_status_id'=>$movement_id);
		
		$c = $this->find('count', array('conditions'=>$cons));
		return $c;
	}

}
?>