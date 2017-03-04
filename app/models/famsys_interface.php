<?php
class FamsysInterface extends AppModel {
	var $name = 'FamsysInterface';
	var $validate = array(
		'noref' => array(
			'is Unique' => array(
				'rule' => array('isUnique'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	function incrementId($source_dt=null)
	{
		$count = $this->find('count', array('conditions'=>array('source_dt'=>$source_dt)));
		return $count+1;
	}
}
?>