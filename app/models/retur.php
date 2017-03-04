<?php
class Retur extends AppModel {
	var $name = 'Retur';
	var $displayField = 'id';
/* 	var $actsAs = array('Logable' => array( 
        'userModel' => 'Retur',  
        'userKey' => 'id',  
        'change' => 'list', // options are 'list' or 'full' 
        'description_ids' => TRUE // options are TRUE or FALSE 
    ));
 */	var $validate = array(
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
		'ReturStatus' => array(
			'className' => 'ReturStatus',
			'foreignKey' => 'retur_status_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),		
		
	);

	var $hasMany = array(
		'ReturDetail' => array(
			'className' => 'ReturDetail',
			'foreignKey' => 'retur_id',
			'dependent' => false,
		),
		'Stock' => array(
			'className' => 'Stock',
			'foreignKey' => 'retur_id',
			'dependent' => false,
		),
		'InventoryLedger' => array(
			'className' => 'InventoryLedger',
			'foreignKey' => 'retur_id',
			'dependent' => false,
		)
	);

	
	function getNewId($department_id)
	{
		$year = date('y') ;
		$prefix = 'RET';
		$retur = $this->find('all', array(
			'conditions'=>array(
				'Retur.department_id'=>$department_id,
				'year(Retur.date)'=> date('Y') ),
			'fields'=>'Retur.no', 
			'limit'=>1, 
			'order'=>'Retur.id desc') );
		$dep = $this->Department->read(null, $department_id);
		$dep_code = $dep['Department']['code'];
		if(!empty($retur))
		{
			$next =  $retur[0]['Retur']['no'];
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

	function count_by_status($retur_id, $group_id=null, $username=null)
	{
		if ($group_id == normal_user_group_id) 
		$c = $this->find('count', array('conditions'=>array('Retur.retur_status_id'=>$retur_id, 'Retur.created_by'=>$username)));
		else
		$c = $this->find('count', array('conditions'=>array('Retur.retur_status_id'=>$retur_id)));
		return $c;
	}
}
?>