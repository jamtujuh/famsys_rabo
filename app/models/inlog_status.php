<?php
class InlogStatus extends AppModel {
	var $name = 'InlogStatus';
	var $displayField = 'name';
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $actsAs = array('Logable' => array( 
        'userModel' => 'InlogStatus',  
        'userKey' => 'id',  
        'change' => 'list', // options are 'list' or 'full' 
        'description_ids' => TRUE // options are TRUE or FALSE 
    ));
/* 	var $hasMany = array(
		'Inlog' => array(
			'className' => 'Inlog',
			'foreignKey' => 'inlog_status_id',
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