<?php
class ProcessType extends AppModel {
	var $name = 'ProcessType';
	var $displayField = 'name';
	var $actsAs = array('Logable' => array( 
        'userModel' => 'ProcessType',  
        'userKey' => 'id',  
        'change' => 'list', // options are 'list' or 'full' 
        'description_ids' => TRUE // options are TRUE or FALSE 
    ));
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	/* var $hasMany = array(
		'NpbDetail' => array(
			'className' => 'NpbDetail',
			'foreignKey' => 'process_type_id',
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