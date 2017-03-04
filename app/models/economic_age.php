<?php
class EconomicAge extends AppModel {
	var $name = 'EconomicAge';
	var $displayField = 'year';
	var $actsAs = array('Logable' => array( 
        'userModel' => 'EconomicAge',  
        'userKey' => 'id',  
        'change' => 'list', // options are 'list' or 'full' 
        'description_ids' => TRUE // options are TRUE or FALSE 
    ));
	var $validate = array(
		'year' => array(
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