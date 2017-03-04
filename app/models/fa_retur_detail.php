<?php
class FaReturDetail extends AppModel {
	var $name = 'FaReturDetail';
	var $displayField = 'fa_retur_id';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'FaRetur' => array(
			'className' => 'FaRetur',
			'foreignKey' => 'fa_retur_id',
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
		'AssetCategory' => array(
			'className' => 'AssetCategory',
			'foreignKey' => 'asset_category_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
?>