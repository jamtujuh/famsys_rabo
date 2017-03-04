<?php
class Location extends AppModel {
	var $name = 'Location';
	var $displayField = 'name';
	var $actsAs = array('Logable' => array( 
        'userModel' => 'Location',  
        'userKey' => 'id',  
        'change' => 'list', // options are 'list' or 'full' 
        'description_ids' => TRUE // options are TRUE or FALSE 
    ));
	var $validate = array(
		'name' => array(
			'multiple' => array(
				'rule' => array('multiple'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'department_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'parent_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
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
		'Department' => array(
			'className' => 'Department',
			'foreignKey' => 'department_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ParentLocation' => array(
			'className' => 'Location',
			'foreignKey' => 'parent_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'ChildLocation' => array(
			'className' => 'Location',
			'foreignKey' => 'parent_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
	);
	
	
	function findOrAdd($department_id, $name, $code)
	{
		$location = $this->find('first', array(
			'conditions'=>
				array(
					'Location.department_id'=>$department_id, 
					'Location.name' => $name)));
		if(empty($location))
		{
			$data['department_id']= $department_id;
			$data['name'] = $name;
			$data['code'] = $code;
			$this->create();
			$this->save(array('Location'=>$data));
			$location = $this->read(null, $this->id);
		}
		return $location['Location']['id'];
	}

}
?>