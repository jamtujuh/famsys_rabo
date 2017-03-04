<?php
class PointReward extends AppModel {
	var $name = 'PointReward';
	var $displayField = 'no';
	var $actsAs = array('Logable' => array( 
        'userModel' => 'PointReward',  
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
		'created_date' => array(
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
		),		
		'CostCenter' => array(
			'className' => 'CostCenter',
			'foreignKey' => 'cost_center_id',
		),	
		'RequestType' => array(
			'className' => 'RequestType',
			'foreignKey' => 'request_type_id',
		),	
		'Npb' => array(
			'className' => 'Npb',
			'foreignKey' => 'npb_id',
		),		
		'User' => array(
			'className' => 'User',
			'foreignKey' => false,
			'conditions' => array('PointReward.created_by = User.username')
		)
	);

	var $hasMany = array(
		
	);
	
    var $hasAndBelongsToMany = array(
        
    );	
	
	function beforeSave()
	{
		
	}
}
?>