<?php
class FaSupplierRetur extends AppModel {
	var $name = 'FaSupplierRetur';
	var $displayField = 'no';
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $validate = array(
		'po_id' => array(
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
	
	);
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
		'FaSupplierReturStatus' => array(
			'className' => 'FaSupplierReturStatus',
			'foreignKey' => 'fa_supplier_retur_status_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Po' => array(
			'className' => 'Po',
			'foreignKey' => 'po_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)		
	);

	var $hasMany = array(
		'FaSupplierReturDetail' => array(
			'className' => 'FaSupplierReturDetail',
			'foreignKey' => 'fa_supplier_retur_id',
			'dependent' => false,
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
	
	function count_by_status($fa_supplier_retur_status_id, $group_id, $department_id)
	{
		$cons[] = array();
		
		if($group_id == normal_user_group_id)//normal_user_group_id
			$cons[] = array('and' =>array('FaSupplierRetur.fa_supplier_retur_status_id'=>$fa_supplier_retur_status_id, 'FaSupplierRetur.department_id'=>$department_id));
		else if($group_id == branch_head_group_id)//branch_head_group_id
			$cons[] = array('and' =>array('FaSupplierRetur.fa_supplier_retur_status_id'=>$fa_supplier_retur_status_id, 'FaSupplierRetur.department_id'=>$department_id));
		else if($group_id == gs_group_id)//gs_group_id
			$cons[] = array('FaSupplierRetur.fa_supplier_retur_status_id'=>$fa_supplier_retur_status_id);
		else if($group_id == po_approval1_group_id)//po_approval1_group_id
			$cons[] = array('FaSupplierRetur.fa_supplier_retur_status_id'=>$fa_supplier_retur_status_id);
		
		$c = $this->find('count', array('conditions'=>$cons));
		return $c;
	}
		function getNewId($department_id)
	{
		$prefix = 'SR-FA';
		$year = date('my');
		$faSupplierRetur = $this->find('all', array(
		'conditions'=>array(
			'FaSupplierRetur.department_id'=>$department_id,
			'year(doc_date)'=> date('Y')),
		'fields'=>'FaSupplierRetur.no', 'limit'=>1, 'order'=>'FaSupplierRetur.no desc') );
		$dep		  = $this->Department->read(null, $department_id);
		$dep_code	  = $dep['Department']['code'];
 	    if(!empty($faSupplierRetur))
		{
			$next =  $faSupplierRetur[0]['FaSupplierRetur']['no'];
			$a	  =  explode('/',$next);
			$no	  =  $a[2];
			$next =  "$dep_code/$prefix/".sprintf("%03s",$no+1)."/$year";
		}
		else
		{
			$next =  "$dep_code/$prefix/001/$year";
		}
		return $next;
	}


}
?>