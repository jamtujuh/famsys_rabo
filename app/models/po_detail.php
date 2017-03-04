<?php
class PoDetail extends AppModel {
	var $name = 'PoDetail';
	var $displayField = 'name';
	var $actsAs = array('Logable' => array( 
        'userModel' => 'PoDetail',  
        'userKey' => 'id',  
        'change' => 'list', // options are 'list' or 'full' 
        'description_ids' => TRUE // options are TRUE or FALSE 
    ));
	var $validate = array(
		'id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'po_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'asset_category_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
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
		'qty' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'price' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'price_cur' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'discount_cur' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'amount_nett_cur' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'currency_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'rp_rate' => array(
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
		'Po' => array(
			'className' => 'Po',
			'foreignKey' => 'po_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'AssetCategory' => array(
			'className' => 'AssetCategory',
			'foreignKey' => 'asset_category_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Currency' => array(
			'className' => 'Currency',
			'foreignKey' => 'currency_id',
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
		'CostCenter' => array(
			'className' => 'CostCenter',
			'foreignKey' => 'cost_center_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Item' => array(
			'className' => 'item',
			'foreignKey' => 'item_id',
		)			
	);


	var $virtualFields = array (
		'item_name'=> SQL_ITEM_NAME_PO_DISPLAY_FIELD,
		'currency_name'=> SQL_CURRENCY_NAME_DISPLAY_FIELD,
		'currency_description'=> SQL_CURRENCY_DESCRIPTION_DISPLAY_FIELD,
		'category_code'=> SQL_CATEGORY_CODE_DISPLAY_FIELD
	);
	
	function beforeSave()
	{
	

		//calculate amount
		// if(isset($this->data['PoDetail']['price']) && isset($this->data['PoDetail']['qty']))
			// $this->data['PoDetail']['amount']=$this->data['PoDetail']['price']*$this->data['PoDetail']['qty'];
		if(isset($this->data['PoDetail']['price_cur']) && isset($this->data['PoDetail']['qty']))
		{
			$this->data['PoDetail']['amount']=$this->data['PoDetail']['price_cur']*$this->data['PoDetail']['qty'];
			$this->data['PoDetail']['amount_cur']=$this->data['PoDetail']['price_cur']*$this->data['PoDetail']['qty'];
		}
		
		//calculate amount after discount
		// if(isset($this->data['PoDetail']['amount']) && isset($this->data['PoDetail']['discount']))
			// $this->data['PoDetail']['amount_after_disc']  =$this->data['PoDetail']['amount']-$this->data['PoDetail']['discount'];
		
		if(isset($this->data['PoDetail']['amount_cur']) && isset($this->data['PoDetail']['discount_cur']))
		{
			$this->data['PoDetail']['discount']=$this->data['PoDetail']['discount_cur'];
			$this->data['PoDetail']['amount_after_disc_cur']= $this->data['PoDetail']['amount_cur']-$this->data['PoDetail']['discount_cur'];
			$this->data['PoDetail']['amount_after_disc']  =$this->data['PoDetail']['amount_cur']-$this->data['PoDetail']['discount_cur'];
		}

		//calculate vat
		if(!empty($this->data['PoDetail']['is_vat']) )
		{
			// if(isset($this->data['PoDetail']['amount_after_disc'] )) 
				// $this->data['PoDetail']['vat'] = ($this->data['PoDetail']['amount_after_disc'] ) * 10/100;
				
			if(isset($this->data['PoDetail']['amount_after_disc_cur'] ))
			{
				$this->data['PoDetail']['vat_cur'] = ($this->data['PoDetail']['amount_after_disc_cur'] ) * 10/100;
				$this->data['PoDetail']['vat'] = ($this->data['PoDetail']['amount_after_disc_cur'] ) * 10/100;
			}
		}
		else
		{
			$this->data['PoDetail']['vat'] = 0;
			$this->data['PoDetail']['vat_cur'] = 0;
		}
		
		//calculate nett amount
		// if(isset($this->data['PoDetail']['amount_after_disc']))		
			// $this->data['PoDetail']['amount_nett'] = $this->data['PoDetail']['amount_after_disc'] + $this->data['PoDetail']['vat_cur'] ;
		if(isset($this->data['PoDetail']['amount_after_disc_cur']))		
		{
			$this->data['PoDetail']['amount_nett_cur'] = $this->data['PoDetail']['amount_after_disc_cur'] + $this->data['PoDetail']['vat_cur'] ;
			$this->data['PoDetail']['amount_nett'] = $this->data['PoDetail']['amount_after_disc_cur'] + $this->data['PoDetail']['vat_cur'] ;
		}
		
		return true;
	}
	

	
	function afterDelete()
	{
		$sql='update npb_details set po_id=NULL where id="'.$this->id .'"';
		$this->query($sql);
		return true;
	}
}
?>