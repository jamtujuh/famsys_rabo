<?php
class User extends AppModel {
	var $name = 'User';
	var $displayField = 'name';
	var $actsAs = array('Logable' => 
		array( 
			'userModel' => 'User',  
			'userKey' => 'id',  
			'change' => 'list', // options are 'list' or 'full' 
			'description_ids' => TRUE // options are TRUE or FALSE 
		)
	);
	var $validate = array(
        'username' => array(
            'alphaNumeric' => array(
                'rule' => 'alphaNumeric',
                'required' => true,
                'message' => 'Alphabets and numbers only'
                ),
            'between' => array(
                'rule' => array('between', 3, 25),
                'message' => 'Between 5 to 25 characters'
            ),
            'isUnique' => array(
                'rule' => array('isUnique'),
                'message' => 'Is Unique'
            )
        ),
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		/* 'password' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			//'rule' => array('minLength', '8'),
			//'message' => 'Mimimum 8 characters long'
		), */
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
		'group_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'ad_user' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Username for Active Directory cannot be empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	
	var $belongsTo = array(
		'Group'=>array(
			'className' => 'Group',
			'foreignKey' => 'group_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Department'=>array(
			'className' => 'Department',
			'foreignKey' => 'department_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		// 'DepartmentSub'=>array(
			// 'className' => 'DepartmentSub',
			// 'foreignKey' => 'department_sub_id',
			// 'conditions' => '',
			// 'fields' => '',
			// 'order' => ''
		// ),		
		// 'DepartmentUnit'=>array(
			// 'className' => 'DepartmentUnit',
			// 'foreignKey' => 'department_unit_id',
			// 'conditions' => '',
			// 'fields' => '',
			// 'order' => ''
		// ),		
		'CostCenter'=>array(
			'className' => 'CostCenter',
			'foreignKey' => 'cost_center_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),		
		'BusinessType'=>array(
			'className' => 'BusinessType',
			'foreignKey' => 'business_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),		
	);
	
	var $hasMany = array('Log',
		'PasswordHistory' => array(
			'className' => 'PasswordHistory',
			'foreignKey' => 'user_id',
			'dependent' => true,
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
	
	var $virtualFields = array(
		'department_name'=>'select name from departments where id=User.department_id',
		'department_sub_name'=>'select name from department_subs where id=User.department_sub_id',
		'department_unit_name'=>'select name from department_units where id=User.department_unit_id',
		'cost_center_name'=>'select name from cost_centers where id=User.cost_center_id',
		'business_type_name'=>'select name from business_types where id=User.business_type_id',
		'group_name'=>'select name from groups where id=User.group_id',
		'group_is_admin'=>'select is_admin from groups where id=User.group_id',
	);
    function hashPassword($id){
		$user = $this->read(null, $id);
		$this->id = $id;
		$this->set('password', md5($user['User']['password']));
		$this->save();
	}
	
	/* function afterSave()
	{
		$id = $this->getLastInsertID(); 
		$this->hashPassword($id);
	} */
}
?>
