<?php
class Usage extends AppModel {
	var $name = 'Usage';
	var $displayField = 'id';
/* 	var $actsAs = array('Logable' => array( 
        'userModel' => 'Usage',  
        'userKey' => 'id',  
        'change' => 'list', // options are 'list' or 'full' 
        'description_ids' => TRUE // options are TRUE or FALSE 
    )); */
	var $validate = array(
		'no' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'date' => array(
			'notempty' => array(
				'rule' => array('notempty'),
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
		'UsageStatus' => array(
			'className' => 'UsageStatus',
			'foreignKey' => 'usage_status_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),			
	);

	var $hasMany = array(
		'UsageDetail' => array(
			'className' => 'UsageDetail',
			'foreignKey' => 'usage_id',
			'dependent' => false,
		),
		'Stock' => array(
			'className' => 'Stock',
			'foreignKey' => 'usage_id',
			'dependent' => false,
		)		
	);

	function getNewId($department_id)
	{
		$year = date('y') ;
		$prefix = 'USG';
		$usage = $this->find('all', array(
			'conditions'=>array(
				'Usage.department_id'=>$department_id,
				'year(Usage.date)'=> date('Y') ),
			'fields'=>'Usage.no', 
			'limit'=>1, 
			'order'=>'Usage.id desc') );
		$dep = $this->Department->read(null, $department_id);
		$dep_code = $dep['Department']['code'];
		if(!empty($usage))
		{
			$next =  $usage[0]['Usage']['no'];
			$a = explode('-',$next);
			$prefix = $a[0];
			$dep_code = $a[1];
			$year = $a[2];
			$no = $a[3]; 
			$next = $prefix . '-'. $dep_code. '-' . $year . '-' . sprintf("%04s",$no+1);
		}
		else
		{
			$next = $prefix . '-' . $dep_code . '-' . $year . '-0001';
		}
		return $next;
	}
	
	function count_by_status($usage_id)
	{
		$c = $this->find('count', array('conditions'=>array('Usage.usage_status_id'=>$usage_id)));
		return $c;
	}
}
?>