<?php
class NpbDetail extends AppModel {
	var $name = 'NpbDetail';
	var $displayField = 'id';
	/*var $actsAs = array('Logable' => array( 
        'userModel' => 'NpbDetail',  
        'userKey' => 'id',  
        'change' => 'list', // options are 'list' or 'full' 
        'description_ids' => TRUE // options are TRUE or FALSE 
    ));*/
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
		'npb_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'item_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'qty' => array(
			'numeric' => array(
				'rule' => array('numeric'),
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
		/*'currency_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),*/
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Npb' => array(
			'className' => 'Npb',
			'foreignKey' => 'npb_id',
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
		'Movement' => array(
			'className' => 'Movement',
			'foreignKey' => 'movement_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Item' => array(
			'className' => 'Item',
			'foreignKey' => 'item_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),		
		'NpbFulfillment' => array(
			'className' => 'NpbFulfillment',
			'foreignKey' => 'fulfillment_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),		
		'Currency' => array(
			'className' => 'Currency',
			'foreignKey' => 'currency_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Unit' => array(
			'className' => 'Unit',
			'foreignKey' => 'unit_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ProcessType' => array(
			'className' => 'ProcessType',
			'foreignKey' => 'process_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),		
	);
	var $virtualFields = array (
		'currency_name'=> 'SELECT name from currencies where NpbDetail.currency_id = currencies.id',
		'item_name'=>'SELECT name from items where NpbDetail.item_id = items.id',	
		'item_code'=>'SELECT code from items where NpbDetail.item_id = items.id',		
	);	
	
	
}
?>