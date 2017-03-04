<?php
class JournalTemplateDetail extends AppModel {
	var $name = 'JournalTemplateDetail';
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $actsAs = array('Logable' => array( 
        'userModel' => 'JournalTemplateDetail',  
        'userKey' => 'id',  
        'change' => 'list', // options are 'list' or 'full' 
        'description_ids' => TRUE // options are TRUE or FALSE 
    ));
	var $belongsTo = array(
		'JournalTemplate' => array(
			'className' => 'JournalTemplate',
			'foreignKey' => 'journal_template_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Account' => array(
			'className' => 'Account',
			'foreignKey' => 'account_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'JournalPosition' => array(
			'className' => 'JournalPosition',
			'foreignKey' => 'journal_position_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	// var $hasMany = array(
		// 'JournalTransaction' => array(
			// 'className' => 'JournalTransaction',
			// 'foreignKey' => 'journal_template_detail_id',
			// 'dependent' => false,
			// 'conditions' => '',
			// 'fields' => '',
			// 'order' => '',
			// 'limit' => '',
			// 'offset' => '',
			// 'exclusive' => '',
			// 'finderQuery' => '',
			// 'counterQuery' => ''
		// )
	// );

}
?>