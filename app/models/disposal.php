<?php
class Disposal extends AppModel {
	var $name = 'Disposal';
	//var $primaryKey = 'id';
	var $displayField = 'Id';
	/* var $actsAs = array('Logable' => array( 
        'userModel' => 'Disposal',  
        'userKey' => 'id',  
        'change' => 'list', // options are 'list' or 'full' 
        'description_ids' => TRUE // options are TRUE or FALSE 
    )); */
	var $validate = array(
		'doc_date' => array(
			'notempty' => array(
				'rule' => array('notempty'),
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
		'business_type_id' => array(
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
		'disposal_status' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'disposal_type' => array(
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
		'DisposalStatus' => array(
			'className' => 'DisposalStatus',
			'foreignKey' => 'disposal_status_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'DisposalType' => array(
			'className' => 'DisposalType',
			'foreignKey' => 'disposal_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);

	var $hasMany = array(
		'DisposalDetail' => array(
			'className' => 'DisposalDetail',
			'foreignKey' => 'disposal_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
	
	var $virtualFields = array(
		'status_name' => 'SELECT name from disposal_statuses s where s.id = Disposal.disposal_status_id',
		'type_name' => 'SELECT name from disposal_types s where s.id = Disposal.disposal_type_id',
		'dao_code' => 'SELECT t24_dao from cost_center_to_daos d where d.cost_center_id = Disposal.cost_center_id'
	);
	
	function getNewId()
	{
		$disposal = $this->find('all', array('fields'=>'no', 'limit'=>1, 'order'=>'no desc') );
		if(!empty($disposal))
		{
			$next =  $disposal[0]['Disposal']['no'];
			list($prefix, $no) = explode('-',$next);
			$next = $prefix . '-' . sprintf("%04s",$no+1);
		}
		else
		{
			$next = 'DIS-0001';
		}
		return $next;
	}
	function count_by_status($disposal_id, $disposal_type_id)
	{
		$c = $this->find('count', array('conditions'=>array(
			'Disposal.disposal_status_id'=>$disposal_id, 
			'Disposal.disposal_type_id'=>$disposal_type_id, 
			)));
		return $c;
	}
}
?>