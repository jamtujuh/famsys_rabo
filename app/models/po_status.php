<?php
class PoStatus extends AppModel {
	var $name = 'PoStatus';
	var $displayField = 'name';
	var $actsAs = array('Logable' => array( 
        'userModel' => 'PoStatus',  
        'userKey' => 'id',  
        'change' => 'list', // options are 'list' or 'full' 
        'description_ids' => TRUE // options are TRUE or FALSE 
    ));
	var $validate = array(
		'id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
			),
		),
	);		
	//The Associations below have been created with all possible keys, those that are not needed can be removed

/* 	var $hasMany = array(
		'Po' => array(
			'className' => 'Po',
			'foreignKey' => 'po_status_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	); */

}
?>