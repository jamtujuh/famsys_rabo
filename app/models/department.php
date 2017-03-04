<?php

class Department extends AppModel {

      var $name = 'Department';
      var $displayField = 'name';
      var $actsAs = array('Logable' => array(
              'userModel' => 'Department',
              'userKey' => 'id',
              'change' => 'list', // options are 'list' or 'full' 
              'description_ids' => TRUE // options are TRUE or FALSE 
              ));
	 var $order = array('Department.name' => 'asc');     
	 var $validate = array(
          'account_code' => array(
              'notempty' => array(
                  'rule' => array('notempty'),
                  'message' => 'Please enter the account code',
              //'allowEmpty' => false,
              //'required' => false,
              //'last' => false, // Stop validation after this rule
              //'on' => 'create', // Limit validation to 'create' or 'update' operations
              ),
          ),
          'name' => array(
              'notempty' => array(
                  'rule' => array('notempty'),
                  'message' => 'Please enter the name',
              //'allowEmpty' => false,
              //'required' => false,
              //'last' => false, // Stop validation after this rule
              //'on' => 'create', // Limit validation to 'create' or 'update' operations
              ),
          ),
      );
      //The Associations below have been created with all possible keys, those that are not needed can be removed
      var $hasMany = array(
         /*  'Ayda' => array(
              'className' => 'Ayda',
              'foreignKey' => 'department_id',
              'dependent' => false,
              'conditions' => '',
              'fields' => '',
              'order' => '',
              'limit' => '',
              'offset' => '',
              'exclusive' => '',
              'finderQuery' => '',
              'counterQuery' => ''
          ), */
          'DepartmentSub' => array(
              'className' => 'DepartmentSub',
              'foreignKey' => 'department_id',
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
          'Location' => array(
              'className' => 'Location',
              'foreignKey' => 'department_id',
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
      'DepartmentUnit' => array(
              'className' => 'DepartmentUnit',
              'foreignKey' => 'department_id',
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
 /*          'User' => array(
              'className' => 'User',
              'foreignKey' => 'department_id',
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
          'Purchase' => array(
              'className' => 'Purchase',
              'foreignKey' => 'department_id',
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
          'Npb' => array(
              'className' => 'Npb',
              'foreignKey' => 'department_id',
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
          'Po' => array(
              'className' => 'Po',
              'foreignKey' => 'department_id',
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
          'JournalTransaction' => array(
              'className' => 'JournalTransaction',
              'foreignKey' => 'department_id',
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
          'Invoice' => array(
              'className' => 'Invoice',
              'foreignKey' => 'department_id',
              'dependent' => false,
              'conditions' => '',
              'fields' => '',
              'order' => '',
              'limit' => '',
              'offset' => '',
              'exclusive' => '',
              'finderQuery' => '',
              'counterQuery' => ''
          ) */
      );
      var $belongsTo = array(
          'BusinessType' => array(
              'className' => 'BusinessType',
              'foreignKey' => 'business_type_id',
              'conditions' => '',
              'fields' => '',
              'order' => ''
          )
      );
}

?>