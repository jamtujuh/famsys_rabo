<?php
class Purchase extends AppModel {
	var $name = 'Purchase';
	var $displayField = 'doc_no';
	var $actsAs = array('Logable' => array( 
        'userModel' => 'Purchase',  
        'userKey' => 'id',  
        'change' => 'list', // options are 'list' or 'full' 
        'description_ids' => TRUE // options are TRUE or FALSE 
    ));
	var $validate = array(
		'no' => array(
			'is Unique' => array(
				'rule' => array('isUnique'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'warranty_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'requester_id' => array(
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
/* 		'supplier_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
 */		'date_of_purchase' => array(
			'notempty' => array(
				'rule' => array('notempty'),
			/* 'date' => array(
				'rule' => array('date'), */
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
		'Warranty' => array(
			'className' => 'Warranty',
			'foreignKey' => 'warranty_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Requester' => array(
			'className' => 'Requester',
			'foreignKey' => 'requester_id',
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
		'Supplier' => array(
			'className' => 'Supplier',
			'foreignKey' => 'supplier_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),	
		'DeliveryOrder' => array(
			'className' => 'DeliveryOrder',
			'foreignKey' => 'delivery_order_id',
			'dependent' => true,
		),	
		'Currency' => array(
			'className' => 'Currency',
			'foreignKey' => 'currency_id',
			'dependent' => true,
		),
		'PurchaseStatus' => array(
			'className' => 'PurchaseStatus',
			'foreignKey' => 'purchase_status_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
		
	);
	
 	var $hasMany = array(
		'Asset' => array(
			'className' => 'Asset',
			'foreignKey' => 'purchase_id',
			'conditions' => '',
			'dependent' => true,
			'fields' => '',
			'order' => ''
		),	
		'AssetDetail' => array(
			'className' => 'AssetDetail',
			'foreignKey' => 'purchase_id',
			'conditions' => '',
			'dependent' => true,
			'fields' => '',
			'order' => ''
		),	
	); 
    var $hasAndBelongsToMany = array(	
	    'Invoice' => array(
			'className'              => 'Invoice',
			'joinTable'              => 'invoices_purchases',
			'foreignKey'             => 'invoice_id',
			'associationForeignKey'  => 'purchase_id',
			'unique'                 => true,
		)		
    );	
	var $virtualFields = array(
	  'total' => 'SELECT SUM(assets.amount) FROM assets WHERE assets.purchase_id = Purchase.id',
	  'total_cur' => 'SELECT SUM(assets.amount_cur) FROM assets WHERE assets.purchase_id = Purchase.id'
	);	

	// function beforeSave() {
		// $p=$this->find('first', array('conditions'=>array('Purchase.id'=>$this->data['Purchase']['id'])) );
		// var_dump($p);
		// $p['Purchase']['doc_total'] = $p['Purchase']['balance']; 
		// return true;
	// }	
	
	function getNewId()
	{
		$pur = $this->find('all', array('fields'=>'Purchase.no', 'limit'=>1, 'order'=>'Purchase.id desc') );
		if(!empty($pur))
		{
			$next =  $pur[0]['Purchase']['no'];
			if(strstr($next,'-'))
				list($prefix, $no) = explode('-',$next);
			else
				list($prefix, $no) = array("FA", $next);
				
			$next = $prefix . '-' . sprintf("%04s",$no+1);
		}
		else
		{
			$next = 'FA-0001';
		}
		return $next;
	}
	
	function count_by_status($purchase_id, $group_id)
	{
		$cons[] = array();
		if($group_id == fa_management_group_id)//fa_management
			$cons[] = array('Purchase.purchase_status_id'=>$purchase_id,
						'AND'=> array('DeliveryOrder.request_type_id' => request_type_fa_general_id));
		else if($group_id == it_management_group_id)//IT_management
			$cons[] = array('Purchase.purchase_status_id'=>$purchase_id,
						'AND'=> array('DeliveryOrder.request_type_id' => request_type_fa_it_id));
		else if($group_id == fa_supervisor_group_id)//fa_supervisor
			$cons[] = array('Purchase.purchase_status_id'=>$purchase_id,
						'AND'=> array('DeliveryOrder.request_type_id' => request_type_fa_general_id));
		else if($group_id == it_supervisor_group_id)//IT_supervisor
			$cons[] = array('Purchase.purchase_status_id'=>$purchase_id,
						'AND'=> array('DeliveryOrder.request_type_id' => request_type_fa_it_id));
		
		$c = $this->find('count', array('conditions'=>$cons));
		return $c;
	}
	function getTotals($conditions){
	$total = 0;
		foreach($conditions as $puchase){
			$total += $puchase['Purchase']['total'];
			}
	
	$a['total'] = $total;
	return $a;
	}
  function count_status_puchase_draft($group) {
	$count_do = $this->query('select count(purchases.purchase_status_id) as count from purchases where purchases.purchase_status_id = '.status_purchase_draft_id.' and purchases.group_id='.$group.'') ;
	$count = $count_do[0][0]['count'];
	return $count;
	}
	
  function count_status_puchase_sent_to_supervisor($group) {
	if($group==fa_management_group_id){
	$count_do = $this->query('select count(purchases.purchase_status_id) as count from purchases where purchases.purchase_status_id = '.status_purchase_sent_to_supervisor_id.' and purchases.group_id='.fa_management_group_id.'') ;
	$count = $count_do[0][0]['count'];
	}elseif($group==it_management_group_id){
	$count_do = $this->query('select count(purchases.purchase_status_id) as count from purchases where purchases.purchase_status_id = '.status_purchase_sent_to_supervisor_id.' and purchases.group_id='.it_management_group_id.'') ;
	$count = $count_do[0][0]['count'];
	}
	return $count;
	}
}
?>