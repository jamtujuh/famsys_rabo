<?php
class JournalTransaction extends AppModel {
	var $name = 'JournalTransaction';
/* 	var $actsAs = array('Logable' => array( 
        'userModel' => 'JournalTransaction',  
        'userKey' => 'id',  
        'change' => 'list', // options are 'list' or 'full' 
        'description_ids' => TRUE // options are TRUE or FALSE 
    ));  */
 	var $validate = array(
		'journal_template_detail_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'account_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'amount' => array(
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
		'JournalTemplate' => array(
			'className' => 'JournalTemplate',
			'foreignKey' => 'journal_template_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Account' => array(
			'className' => 'Account',
			'foreignKey' => 'account_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'JournalPosition' => array(
			'className' => 'JournalPosition',
			'foreignKey' => 'journal_position_id',
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
		'JournalGroup' => array(
			'className' => 'JournalGroup',
			'foreignKey' => false,
			'conditions' => array('JournalTemplate.journal_group_id = JournalGroup.id')
		)
	);
	function totalGeneral($z){
	$amount_cr = 0;
	$amount_db = 0;
		foreach($z as $journal){
			$amount_cr += $journal['JournalTransaction']['amount_cr'];
			$amount_db += $journal['JournalTransaction']['amount_db'];
		}
		$a['amount_cr'] = $amount_cr;
		$a['amount_db'] = $amount_db;
		return $a;
	}


	function journal_transactions_list_category($group_id = 0){
		  $groups = $this->query('select distinct journal_transactions.id from journal_transactions
							inner join
								journal_templates
							on
								journal_templates.id = journal_transactions.journal_template_id
							where
							journal_templates.journal_group_id = '.$group_id);
		  return $groups;
	}
}
?>