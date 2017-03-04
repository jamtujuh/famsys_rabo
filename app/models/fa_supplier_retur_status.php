<?php
class FaSupplierReturStatus extends AppModel {
	var $name = 'FaSupplierReturStatus';
	var $displayField = 'name';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'FaSupplierRetur' => array(
			'className' => 'FaSupplierRetur',
			'foreignKey' => 'fa_supplier_retur_status_id',
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