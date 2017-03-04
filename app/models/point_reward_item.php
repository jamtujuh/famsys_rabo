<?php
class PointRewardItem extends AppModel {
	var $name = 'PointRewardItem';
	var $displayField = 'item_prefix';
	/*var $actsAs = array('Logable' => array( 
        'userModel' => 'PointRewardItem',  
        'userKey' => 'id',  
        'change' => 'list', // options are 'list' or 'full' 
        'description_ids' => TRUE // options are TRUE or FALSE 
    ));*/
	var $validate = array(
		'item_prefix' => array(
			'is Unique' => array(
				'rule' => array('isUnique'),
				'message' => 'Item Prefix must be unique',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'mark' => array(
			'notempty' => array(
                  'rule' => array('notempty'),
                  'message' => 'Mark cannot empty',
              //'allowEmpty' => false,
              //'required' => false,
              //'last' => false, // Stop validation after this rule
              //'on' => 'create', // Limit validation to 'create' or 'update' operations
              ),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(	
		'Item' => array(
			'className' => 'Item',
			'foreignKey' => 'item_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
?>