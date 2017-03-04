<?php
class DepartmentUnit extends AppModel {
	var $name = 'DepartmentUnit';
	var $displayField = 'name';
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $actsAs = array('Logable' => array( 
        'userModel' => 'DepartmentUnit',  
        'userKey' => 'id',  
        'change' => 'list', // options are 'list' or 'full' 
        'description_ids' => TRUE // options are TRUE or FALSE 
    ));
	var $belongsTo = array(
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
		)
	);
}
?>