<?php
class FaImport extends AppModel {
	var $name = 'FaImport';
	var $displayField = 'id';
/* 	var $actsAs = array('Logable' => array( 
        'userModel' => 'FaImport',  
        'userKey' => 'id',  
        'change' => 'list', // options are 'list' or 'full' 
        'description_ids' => TRUE // options are TRUE or FALSE 
    ));
 */	var $validate = array(
		'no' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'date' => array(
			/* 'date' => array(
				'rule' => array('date'), */
			'notempty' => array(
				'rule' => array('notempty'),
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
		'created_by' => array(
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

	var $belongsTo = array(
		'Department' => array(
			'className' => 'Department',
			'foreignKey' => 'department_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),	
		'ImportStatus' => array(
			'className' => 'ImportStatus',
			'foreignKey' => 'import_status_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),			
	);

	var $hasMany = array(
		/* 'ImportAsset' => array(
			'className' => 'ImportAsset',
			'foreignKey' => 'fa_import_id',
			'dependent' => false,
		), */
		'ImportAssetDetail' => array(
			'className' => 'ImportAssetDetail',
			'foreignKey' => 'fa_import_id',
			'dependent' => true,
		)			
	);

	function getNewId( )
	{
		$year = date('y') ;
		$prefix = 'IMP';
		$faImport = $this->find('all', array(
			'conditions'=>array(
				//'department_id'=>$department_id,
				'year(FaImport.date)'=> date('Y') ),
			'fields'=>'FaImport.no', 
			'limit'=>1, 
			'order'=>'FaImport.id desc') );
		//$dep = $this->Department->read(null, $department_id);
		//$dep_code = $dep['Department']['code'];
		if(!empty($faImport))
		{
			$next =  $faImport[0]['FaImport']['no'];
			$a = explode('-',$next);
			$prefix 	= $a[0];
			//$dep_code 	= $a[1];
			$year 		= $a[1];
			$no 		= $a[2]; 
			//$next = $prefix . '-'. $dep_code. '-' . $year . '-' . sprintf("%04s",$no+1);
			$next = $prefix .  '-' . $year . '-' . sprintf("%04s",$no+1);
		}
		else
		{
			$next = $prefix .  '-' . $year . '-0001';
		}
		return $next;
	}
	
	function count_by_status($fa_import_id)
	{
		$c = $this->find('count', array('conditions'=>array('FaImport.import_status_id'=>$fa_import_id)));
		return $c;
	}
}
?>