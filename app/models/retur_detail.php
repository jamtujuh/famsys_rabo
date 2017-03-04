<?php
class ReturDetail extends AppModel {
	var $name = 'ReturDetail';
	var $displayField = 'id';
	var $actsAs = array('Logable' => array( 
        'userModel' => 'ReturDetail',  
        'userKey' => 'id',  
        'change' => 'list', // options are 'list' or 'full' 
        'description_ids' => TRUE // options are TRUE or FALSE 
    ));
	var $validate = array(
		'retur_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
		'item_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
		'descr' => array(
			'notempty' => array(
				'rule' => array('notempty'),
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
		'Retur' => array(
			'className' => 'Retur',
			'foreignKey' => 'retur_id',
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
	);
	
	var $virtualFields = array (
		'item_detail'=> SQL_ITEM_DETAIL_RETUR_DETAIL_DISPLAY_FIELD,
		'item_name'=> SQL_ITEM_NAME_RETUR_DETAIL_DISPLAY_FIELD
	);
	
	function beforeSave()
	{
		//Calculate Amount
		if(isset($this->data['ReturDetail']['qty']) && isset($this->data['ReturDetail']['price']))
		{
			$this->data['ReturDetail']['amount']=$this->data['ReturDetail']['qty']*$this->data['ReturDetail']['price'];
		}
		return true;
	}
}
?>
