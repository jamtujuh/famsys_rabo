<?php

class TransactionCode extends AppModel {

    var $name = 'TransactionCode';
    var $actsAs = array('Logable' => array(
            'userModel' => 'TransactionCode',
            'userKey' => 'id',
            'change' => 'list',
            'description_ids' => TRUE
    ));

}
