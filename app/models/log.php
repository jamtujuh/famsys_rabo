<?php
class Log extends AppModel {
	var $name = 'Log';
	var $displayField = 'title';
	var $order = 'created DESC';
	//var $order = 'id DESC'; // assume created with cake core is used and works
	var $fixture = 'log';
	var $useTable = 'logs';
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	
	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
?>