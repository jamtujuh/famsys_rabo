<?php
class CostCenterToDao extends AppModel {
	var $name = 'CostCenterToDao';
	//var $displayField = 'name';
	
	var $belongsTo = array(
		'CostCenter' => array(
			'className' => 'CostCenter',
			'foreignKey' => 'cost_center_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
}
?>