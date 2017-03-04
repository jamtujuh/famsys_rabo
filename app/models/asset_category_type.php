<?php
class AssetCategoryType extends AppModel {
	var $name = 'AssetCategoryType';
	var $displayField = 'name';
	var $actsAs = array('Logable' => array( 
        'userModel' => 'AssetCategoryType',  
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
	var $hasMany = array(
		'AssetCategory' => array(
			'className' => 'AssetCategory',
			'foreignKey' => 'asset_category_type_id',
		)
	);		
}
?>