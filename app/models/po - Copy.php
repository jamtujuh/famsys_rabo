<?php
class Po extends AppModel {
	var $name = 'Po';
	var $displayField = 'id';
	var $actsAs = array('Logable' => array( 
        'userModel' => 'Po',  
        'userKey' => 'id',  
        'change' => 'list', // options are 'list' or 'full' 
        'description_ids' => TRUE // options are TRUE or FALSE 
    ));
	var $validate = array(
		'id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'po_date' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
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
		'Department' => array(
			'className' => 'Department',
			'foreignKey' => 'department_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'PoDetail' => array(
			'className' => 'PoDetail',
			'foreignKey' => 'po_id',
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
	
    var $hasAndBelongsToMany = array(
        'Npb' => array(
			'className'              => 'Npb',
			'joinTable'              => 'npbs_pos',
			'foreignKey'             => 'npb_id',
			'associationForeignKey'  => 'po_id',
			'unique'                 => true,
			'conditions'             => '',
			'fields'                 => '',
			'order'                  => '',
			'limit'                  => '',
			'offset'                 => '',
			'finderQuery'            => '',
			'deleteQuery'            => '',
			'insertQuery'            => ''
		),
	    'Invoice' => array(
			'className'              => 'Invoice',
			'joinTable'              => 'invoices_pos',
			'foreignKey'             => 'invoice_id',
			'associationForeignKey'  => 'po_id',
			'unique'                 => true,
			'conditions'             => '',
			'fields'                 => '',
			'order'                  => '',
			'limit'                  => '',
			'offset'                 => '',
			'finderQuery'            => '',
			'deleteQuery'            => '',
			'insertQuery'            => ''
		)	
    );	
	var $virtualFields = array(
	  'total' => 'SELECT SUM(po_details.amount) FROM po_details WHERE po_details.po_id = Po.id',
	  'total_cur' => 'SELECT SUM(po_details.amount_cur) FROM po_details WHERE po_details.po_id = Po.id'
	);	
	
	function getNewId()
	{
		$id = $this->find('all', array('fields'=>'id', 'limit'=>1, 'order'=>'id desc') );
		if(!empty($id))
		{
			$next =  $id[0]['Po']['id'];
			list($prefix, $no) = explode('-',$next);
			$next = $prefix . '-' . sprintf("%04s",$no+1);
		}
		else
		{
			$next = 'PO-0001';
		}
		return $next;
	}	
}
?>