<?php
class SupplierReturDetail extends AppModel {
	var $name = 'SupplierReturDetail';
	var $displayField = 'id';
	var $actsAs = array('Logable' => array( 
        'userModel' => 'SupplierReturDetail',  
        'userKey' => 'id',  
        'change' => 'list', // options are 'list' or 'full' 
        'description_ids' => TRUE // options are TRUE or FALSE 
    ));
	var $validate = array(
		'supplier_retur_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
		'item_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
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
		'descr' => array(
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
		'SupplierRetur' => array(
			'className' => 'SupplierRetur',
			'foreignKey' => 'supplier_retur_id',
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
		'item_detail'=> SQL_ITEM_DETAIL_SUPPLIER_RETUR_DETAIL_DISPLAY_FIELD,
		'item_name'=> SQL_ITEM_NAME_SUPPLIER_RETUR_DETAIL_DISPLAY_FIELD
	);
	
	function beforeSave()
	{
		//Calculate Amount
		if(isset($this->data['SupplierReturDetail']['qty']) && isset($this->data['SupplierReturDetail']['price']))
		{
			$this->data['SupplierReturDetail']['amount']=$this->data['SupplierReturDetail']['qty']*$this->data['SupplierReturDetail']['price'];
		}
		return true;
	}
}
?>