<?php
class AydaInsurance extends AppModel {
	var $name = 'AydaInsurance';
	var $displayField = 'nama';
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $actsAs = array('Logable' => array( 
        'userModel' => 'AydaInsurance',  
        'userKey' => 'id',  
        'change' => 'list', // options are 'list' or 'full' 
        'description_ids' => TRUE // options are TRUE or FALSE 
    ));
	var $hasMany = array(
		'Ayda' => array(
			'className' => 'Ayda',
			'foreignKey' => 'ayda_insurance_id',
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
	);

}
?>