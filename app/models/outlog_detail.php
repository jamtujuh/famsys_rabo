<?php
class OutlogDetail extends AppModel {
	var $name = 'OutlogDetail';
	var $displayField = 'id';
	var $actsAs = array('Logable' => array( 
        'userModel' => 'OutlogDetail',  
        'userKey' => 'id',  
        'change' => 'list', // options are 'list' or 'full' 
        'description_ids' => TRUE // options are TRUE or FALSE 
    ));
	var $validate = array(
		'outlog_id' => array(
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
		'Outlog' => array(
			'className' => 'Outlog',
			'foreignKey' => 'outlog_id',
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
		'item_detail'=> SQL_ITEM_DETAIL_DISPLAY_FIELD,
		'item_name'=> SQL_ITEM_NAME_DISPLAY_FIELD
	);
	
	function beforeSave()
	{
		//Calculate Amount
		if(isset($this->data['OutlogDetail']['qty']) && isset($this->data['OutlogDetail']['price']))
		{
			$this->data['OutlogDetail']['amount']=$this->data['OutlogDetail']['qty']*$this->data['OutlogDetail']['price'];
		}
		return true;
	}
}
?>