<?php
class PasswordHistory extends AppModel {
	var $name = 'PasswordHistory';
	var $displayField = 'name';
	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);
}
?>