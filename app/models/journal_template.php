<?php
class JournalTemplate extends AppModel {
	var $name = 'JournalTemplate';
	var $displayField = 'name';
	var $actsAs = array('Logable' => array( 
        'userModel' => 'JournalTemplate',  
        'userKey' => 'id',  
        'change' => 'list', // options are 'list' or 'full' 
        'description_ids' => TRUE // options are TRUE or FALSE 
    ));
	var $validate = array(
		'journal_group_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'name' => array(
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

	var $belongsTo = array(
		'JournalGroup' => array(
			'className' => 'JournalGroup',
			'foreignKey' => 'journal_group_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'AssetCategory' => array(
			'className' => 'AssetCategory',
			'foreignKey' => 'asset_category_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'JournalTemplateDetail' => array(
			'className' => 'JournalTemplateDetail',
			'foreignKey' => 'journal_template_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => 'JournalTemplateDetail.id, JournalTemplateDetail.journal_position_id',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		
		'JournalTransaction' => array(
			'className' => 'JournalTransaction',
			'foreignKey' => 'journal_template_id',
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