<?php
class Ayda extends AppModel {
	var $name = 'Ayda';
	var $displayField = 'debitor_nama';
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $actsAs = array('Logable' => array( 
        'userModel' => 'Ayda',  
        'userKey' => 'id',  
        'change' => 'list', // options are 'list' or 'full' 
        'description_ids' => TRUE // options are TRUE or FALSE 
    ));
	var $belongsTo = array(
		'AydaStatus' => array(
			'className' => 'AydaStatus',
			'foreignKey' => 'ayda_status_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		/* 'Department' => array(
			'className' => 'Department',
			'foreignKey' => 'department_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		), */
		'AydaType' => array(
			'className' => 'AydaType',
			'foreignKey' => 'ayda_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'AydaInsurance' => array(
			'className' => 'AydaInsurance',
			'foreignKey' => 'ayda_insurance_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'AydaDoc' => array(
			'className' => 'AydaDoc',
			'foreignKey' => 'ayda_doc_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
?>