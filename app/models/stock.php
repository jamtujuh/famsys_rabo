<?php
class Stock extends AppModel {
	var $name = 'Stock';
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $actsAs = array('Logable' => array( 
        'userModel' => 'Stock',  
        'userKey' => 'id',  
        'change' => 'list', // options are 'list' or 'full' 
        'description_ids' => TRUE // options are TRUE or FALSE 
    ));
	var $belongsTo = array(
		'Item' => array(
			'className' => 'Item',
			'foreignKey' => 'item_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Outlog' => array(
			'className' => 'Outlog',
			'foreignKey' => 'outlog_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Usage' => array(
			'className' => 'Usage',
			'foreignKey' => 'usage_id',
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
		'Department' => array(
			'className' => 'Department',
			'foreignKey' => 'department_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
?>