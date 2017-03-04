<?php
class DisposalDetail extends AppModel {
	var $name = 'DisposalDetail';
	var $displayField = 'id';
	/* var $actsAs = array('Logable' => array( 
        'userModel' => 'DisposalDetail',  
        'userKey' => 'id',  
        'change' => 'list', // options are 'list' or 'full' 
        'description_ids' => TRUE // options are TRUE or FALSE 
    )); */
	var $validate = array(
		'disposal_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'asset_detail_id' => array(
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
		'Disposal' => array(
			'className' => 'Disposal',
			'foreignKey' => 'disposal_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'AssetDetail' => array(
			'className' => 'AssetDetail',
			'foreignKey' => 'asset_detail_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	var $virtualFields = array (
		'asset_name'=> SQL_DISPOSAL_ASSET_NAME
	);
}
?>