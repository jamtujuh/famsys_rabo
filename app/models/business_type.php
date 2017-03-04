<?php
class BusinessType extends AppModel {
	var $name = 'BusinessType';
	var $displayField = 'name';
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $actsAs = array('Logable' => array( 
        'userModel' => 'BusinessType',  
        'userKey' => 'id',  
        'change' => 'list', // options are 'list' or 'full' 
        'description_ids' => TRUE // options are TRUE or FALSE 
    ));
/* 	var $hasMany = array(
		'Department' => array(
			'className' => 'Department',
			'foreignKey' => 'business_type_id',
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