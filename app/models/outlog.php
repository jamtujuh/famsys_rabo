<?php
class Outlog extends AppModel {
	var $name = 'Outlog';
	var $displayField = 'id';
/* 	var $actsAs = array('Logable' => array( 
        'userModel' => 'Outlog',  
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
		'Retur' => array(
			'className' => 'Retur',
			'foreignKey' => 'retur_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Npb' => array(
			'className' => 'Npb',
			'foreignKey' => 'npb_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'OutlogStatus' => array(
			'className' => 'OutlogStatus',
			'foreignKey' => 'outlog_status_id'
		),
		'User' => array(
			'className' => 'User',
			'foreignKey' => false,
			'conditions' => array('Npb.created_by = User.username')
		)
	);

	var $hasMany = array(
		'OutlogDetail' => array(
			'className' => 'OutlogDetail',
			'foreignKey' => 'outlog_id',
			'dependent' => false,
		),

		'Stock' => array(
			'className' => 'Stock',
			'foreignKey' => 'outlog_id',
			'dependent' => false,
		)		
	);

	
	function getNewId()
	{
		$outlog = $this->find('all', array('fields'=>'Outlog.no', 'limit'=>1, 'order'=>'Outlog.id desc') );
		if(!empty($outlog))
		{
			$next =  $outlog[0]['Outlog']['no'];
			list($prefix, $no) = explode('-',$next);
			$next = $prefix . '-' . sprintf("%04s",$no+1);
		}
		else
		{
			$next = 'OUT-0001';
		}
		return $next;
	}
	
	function count_by_status($outlog_id)
	{
		$c = $this->find('count', array('conditions'=>array('Outlog.outlog_status_id'=>$outlog_id)));
		return $c;
	}

	function outlogs_list_category($group_id = 0){

		  $groups = $this->query('select distinct outlogs.id from outlogs
							inner join
								outlog_details
							on
								outlogs.id = outlog_details.outlog_id
							inner join
								assets
							on
								assets.id = outlog_details.item_id
							inner join
								journal_templates
							on
								journal_templates.asset_category_id = assets.asset_category_id
							where
								journal_templates.journal_group_id = '.$group_id);
		  return $groups;
	}
}
?>