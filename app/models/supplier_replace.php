<?php
class SupplierReplace extends AppModel {
	var $name = 'SupplierReplace';
	var $displayField = 'id';
	var $actsAs = array('Logable' => array( 
        'userModel' => 'SupplierReplace',  
        'userKey' => 'id',  
        'change' => 'list', // options are 'list' or 'full' 
        'description_ids' => TRUE // options are TRUE or FALSE 
    ));
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
		'supplier_retur_id' => array(
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
		'Supplier' => array(
			'className' => 'Supplier',
			'foreignKey' => 'supplier_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),		
		'SupplierRetur' => array(
			'className' => 'SupplierRetur',
			'foreignKey' => 'supplier_retur_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),		
		'SupplierReplaceStatus' => array(
			'className' => 'SupplierReplaceStatus',
			'foreignKey' => 'supplier_replace_status_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),			
	);

	var $hasMany = array(
		'SupplierReplaceDetail' => array(
			'className' => 'SupplierReplaceDetail',
			'foreignKey' => 'supplier_replace_id',
			'dependent' => false,
		),
		'Stock' => array(
			'className' => 'Stock',
			'foreignKey' => 'supplier_replace_id',
			'dependent' => false,
		)		
	);

	
	function getNewId($department_id)
	{
		$year = date('y') ;
		$prefix = 'RPL';
		$supplier_retur = $this->find('all', array(
			'conditions'=>array(
				'SupplierReplace.department_id'=>$department_id,
				'year(SupplierReplace.date)'=> date('Y') ),
			'fields'=>'SupplierReplace.no', 
			'limit'=>1, 
			'order'=>'SupplierReplace.id desc') );
		$dep = $this->Department->read(null, $department_id);
		$dep_code = $dep['Department']['code'];
		if(!empty($supplier_retur))
		{
			$next =  $supplier_retur[0]['SupplierReplace']['no'];
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

	function count_by_status($supplier_replace_status_id)
	{
		$c = $this->find('count', array('conditions'=>array('SupplierReplace.supplier_replace_status_id'=>$supplier_replace_status_id)));
		return $c;
	}
}
?>