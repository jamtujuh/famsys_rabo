<?php
class InlogDetail extends AppModel {
	var $name = 'InlogDetail';
	var $displayField = 'id';
	var $actsAs = array('Logable' => array( 
        'userModel' => 'InlogDetail',  
        'userKey' => 'id',  
        'change' => 'list', // options are 'list' or 'full' 
        'description_ids' => TRUE // options are TRUE or FALSE 
    ));
	var $validate = array(
		'inlog_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'item_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
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
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Inlog' => array(
			'className' => 'Inlog',
			'foreignKey' => 'inlog_id',
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
		'InventoryLedger' => array(
			'className' => 'InventoryLedger',
			'foreignKey' => 'id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	var $virtualFields = array (
		'item_detail'=> SQL_ITEM_DETAIL
	);
	
	function beforeSave()
	{
		//Calculate Amount
		if(isset($this->data['InlogDetail']['qty']) && isset($this->data['InlogDetail']['price']))
		{
			$this->data['InlogDetail']['amount']=$this->data['InlogDetail']['qty']*$this->data['InlogDetail']['price'];
		}
		return true;
	}
}
?>