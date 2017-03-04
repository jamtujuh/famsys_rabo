<?php
class Periode extends AppModel {
	var $name = 'Periode';
	var $displayField = 'name';
	var $actsAs = array('Logable' => array( 
        'userModel' => 'Periode',  
        'userKey' => 'id',  
        'change' => 'list', // options are 'list' or 'full' 
        'description_ids' => TRUE // options are TRUE or FALSE 
    ));
	var $validate = array(
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

/* 	var $hasMany = array(
		'Invoice' => array(
			'className' => 'Invoice',
			'foreignKey' => 'paid_bank_account_type_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Supplier' => array(
			'className' => 'Supplier',
			'foreignKey' => 'bank_account_type_id'
		)
	); */

}
?>