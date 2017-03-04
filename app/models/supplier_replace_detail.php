<?php
class SupplierReplaceDetail extends AppModel {
	var $name = 'SupplierReplaceDetail';
	var $displayField = 'id';
	var $actsAs = array('Logable' => array( 
        'userModel' => 'SupplierReplaceDetail',  
        'userKey' => 'id',  
        'change' => 'list', // options are 'list' or 'full' 
        'description_ids' => TRUE // options are TRUE or FALSE 
    ));
	var $validate = array(
		'supplier_replace_id' => array(
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
			'notEmpty' => array(
				'rule' => array('notEmpty'),
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
		'SupplierReplace' => array(
			'className' => 'SupplierReplace',
			'foreignKey' => 'supplier_replace_id',
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
		'item_detail'=> SQL_ITEM_DETAIL_SUPPLIER_REPLACE_DISPLAY_FIELD,
		'item_name'=> SQL_ITEM_NAME_SUPPLIER_REPLACE_DISPLAY_FIELD
	);
	
	function beforeSave()
	{
		//Calculate Amount
		if(isset($this->data['SupplierReplaceDetail']['qty']) && isset($this->data['SupplierReplaceDetail']['price']))
		{
			$this->data['SupplierReplaceDetail']['amount']=$this->data['SupplierReplaceDetail']['qty']*$this->data['SupplierReplaceDetail']['price'];
		}
		return true;
	}
}
?>