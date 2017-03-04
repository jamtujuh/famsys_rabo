<?php
class FaRetur extends AppModel {
	var $name = 'FaRetur';
	var $displayField = 'no';
	//The Associations below have been created with all possible keys, those that are not needed can be removed
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
		'FaReturStatus' => array(
			'className' => 'FaReturStatus',
			'foreignKey' => 'fa_retur_status_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'FaReturDetail' => array(
			'className' => 'FaReturDetail',
			'foreignKey' => 'fa_retur_id',
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
	
	function count_by_status($fa_retur_id, $group_id, $department_id, $username=null)
	{
		$cons[] = array();
		
		if($group_id == normal_user_group_id)//normal_user_group_id
			$cons[] = array('and' =>array('FaRetur.fa_retur_status_id'=>$fa_retur_id, 'FaRetur.department_id'=>$department_id, 'FaRetur.created_by'=>$username));
		else if($group_id == branch_head_group_id)//branch_head_group_id
			$cons[] = array('and' =>array('FaRetur.fa_retur_status_id'=>$fa_retur_id, 'FaRetur.department_id'=>$department_id));
		else if($group_id == gs_group_id)//gs_group_id
			$cons[] = array('FaRetur.fa_retur_status_id'=>$fa_retur_id);
		else if($group_id == po_approval1_group_id)//po_approval1_group_id
			$cons[] = array('FaRetur.fa_retur_status_id'=>$fa_retur_id);
		
		$c = $this->find('count', array('conditions'=>$cons));
		return $c;
	}
	
	
	function getNewId($department_id)
	{
		$prefix = 'RET-FA';
		$year = date('my');
		$faRetur = $this->find('all', array(
		'conditions'=>array(
			'department_id'=>$department_id,
			'year(doc_date)'=> date('Y')),
		'fields'=>'no', 'limit'=>1, 'order'=>'no desc') );
		$dep		  = $this->Department->read(null, $department_id);
		$dep_code	  = $dep['Department']['code'];
		if(!empty($faRetur))
		{
			$next =  $faRetur[0]['FaRetur']['no'];
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