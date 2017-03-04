<?php
class HouseKeeping extends AppModel {
	var $name = 'HouseKeeping';
	var $displayField = 'name';
	var $actsAs = array('Logable' => array( 
        'userModel' => 'HouseKeeping',  
        'userKey' => 'id',  
        'change' => 'list', // options are 'list' or 'full' 
        'description_ids' => TRUE // options are TRUE or FALSE 
    ));
	var $validate = array(
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
		'User' => array(
			'className' => 'User',
			'foreignKey' => false,
			'conditions' => array('HouseKeeping.created_by = User.username')
		)
	); 

}
?>