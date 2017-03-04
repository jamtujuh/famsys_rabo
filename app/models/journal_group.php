<?php

class JournalGroup extends AppModel {

    var $name = 'JournalGroup';
    var $displayField = 'name';
    var $actsAs = array('Logable' => array(
            'userModel' => 'JournalGroup',
            'userKey' => 'id',
            'change' => 'list', // options are 'list' or 'full' 
            'description_ids' => TRUE // options are TRUE or FALSE 
    ));
    var $validate = array(
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
    );
    //The Associations below have been created with all possible keys, those that are not needed can be removed

    var $hasMany = array(
        'JournalTemplate' => array(
            'className' => 'JournalTemplate',
            'foreignKey' => 'journal_group_id',
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

    function get_active_journal_group() {
        $groups = $this->query('select distinct journal_groups.* FROM journal_groups order by journal_groups.name');
        /* select distinct journal_groups.* FROM [famsys3].[dbo].[journal_transactions] inner join
          journal_templates
          on
          journal_templates.id = [journal_transactions].journal_template_id
          inner join
          journal_groups
          on
          journal_groups.id = journal_templates.journal_group_id order by journal_groups.name */
        $array = array();
        for ($i = 0; $i < count($groups); $i++) {
            $array [$groups[$i][0]['id']] = $groups[$i][0]['name'];
        }

        return $array;
    }

    function findByReferenceName($referenceName) {
        $params = array('conditions' => array('reference_name' => $referenceName));
        return $this->find('first', $params);
    }

}

?>