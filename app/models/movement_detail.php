<?php
class MovementDetail extends AppModel {
	var $name = 'MovementDetail';
	var $displayField = 'id';
	var $actsAs = array('Logable' => array( 
        'userModel' => 'MovementDetail',  
        'userKey' => 'id',  
        'change' => 'list', // options are 'list' or 'full' 
        'description_ids' => TRUE // options are TRUE or FALSE 
    ));
	var $validate = array(
		'movement_id' => array(
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
		'Movement' => array(
			'className' => 'Movement',
			'foreignKey' => 'movement_id',
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
		),
		'NpbDetail' => array(
			'className' => 'NpbDetail',
			'foreignKey' => 'npb_detail_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	var $virtualFields = array (
		'asset_name'=> SQL_MOVEMENT_DETAIL_ASSET_NAME
	);
}
?>