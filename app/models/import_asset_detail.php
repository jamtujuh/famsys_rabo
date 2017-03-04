<?php
class ImportAssetDetail extends AppModel {
	var $name = 'ImportAssetDetail';
	var $displayField = 'name';
	var $validate = array(
		'code' => array(
			'isUnique' => array(
				'rule' => array('isUnique'),
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
		'FaImport' => array(
			'className' => 'FaImport',
			'foreignKey' => 'fa_import_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Condition' => array(
			'className' => 'Condition',
			'foreignKey' => 'condition_id',
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
		),
		'Location' => array(
			'className' => 'Location',
			'foreignKey' => 'location_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Department' => array(
			'className' => 'Department',
			'foreignKey' => 'department_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'DepartmentSub' => array(
			'className' => 'DepartmentSub',
			'foreignKey' => 'department_sub_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'DepartmentUnit' => array(
			'className' => 'DepartmentUnit',
			'foreignKey' => 'department_unit_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'BusinessType' => array(
			'className' => 'BusinessType',
			'foreignKey' => 'business_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'CostCenter' => array(
			'className' => 'CostCenter',
			'foreignKey' => 'cost_center_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Warranty' => array(
			'className' => 'Warranty',
			'foreignKey' => 'warranty_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
?>