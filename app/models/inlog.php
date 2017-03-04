<?php
class Inlog extends AppModel {
	var $name = 'Inlog';
	var $displayField = 'id';
/* 	var $actsAs = array('Logable' => array( 
        'userModel' => 'Inlog',  
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
		'Supplier' => array(
			'className' => 'Supplier',
			'foreignKey' => 'supplier_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Invoice' => array(
			'className' => 'Invoice',
			'foreignKey' => 'invoice_id',
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
		),
		'DeliveryOrder' => array(
			'className' => 'DeliveryOrder',
			'foreignKey' => 'delivery_order_id',
			'dependent' => true,
		),
		'InlogStatus' => array(
			'className' => 'InlogStatus',
			'foreignKey' => 'inlog_status_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),		
	);

	var $hasMany = array(
		'InlogDetail' => array(
			'className' => 'InlogDetail',
			'foreignKey' => 'inlog_id',
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
	var $virtualFields = array(
	'ledger' => 'SELECT SUM(inlog_details.can_ledger) FROM inlog_details WHERE inlog_details.inlog_id = Inlog.id',
	);
	
	function getNewId()
	{
		$inlog = $this->find('all', array('fields'=>'no', 'limit'=>1, 'order'=>'Inlog.no desc') );
		if(!empty($inlog))
		{
			$next =  $inlog[0]['Inlog']['no'];
			list($prefix, $no) = explode('-',$next);
			$next = $prefix . '-' . sprintf("%04s",$no+1);
		}
		else
		{
			$next = 'IN-0001';
		}
		return $next;
	}

	function count_by_status($inlog_id)
	{
		$c = $this->find('count', array('conditions'=>array('Inlog.inlog_status_id'=>$inlog_id)));
		return $c;
	}
	
	function inlogs_list_category($group_id = 0){

		  $groups = $this->query('select distinct inlogs.id from inlogs
							inner join
								inlog_details
							on
								inlogs.id = inlog_details.inlog_id
							inner join
								assets
							on
								assets.id = inlog_details.item_id
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