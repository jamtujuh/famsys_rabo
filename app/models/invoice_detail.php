<?php
class InvoiceDetail extends AppModel {
	var $name = 'InvoiceDetail';
	var $displayField = 'name';
	var $actsAs = array('Logable' => array( 
        'userModel' => 'InvoiceDetail',  
        'userKey' => 'id',  
        'change' => 'list', // options are 'list' or 'full' 
        'description_ids' => TRUE // options are TRUE or FALSE 
    ));
	var $validate = array(
		'invoice_id' => array(
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
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Invoice' => array(
			'className' => 'Invoice',
			'foreignKey' => 'invoice_id',
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
		'Department' => array(
			'className' => 'Department',
			'foreignKey' => 'department_id',
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
		)
	);
	var $virtualFields = array (
		'currency_name'=> 'SELECT name from currencies where InvoiceDetail.currency_id = currencies.id'
	);	
	
	function beforeSave()
	{
	//debug($this->data);
		/************************************
		dipakai ketika price, discount invoice detail  diedit,
		*************************************/
		// if(isset($this->data['InvoiceDetail']['price']) && !isset($this->data['InvoiceDetail']['price_cur']))
		// {
			$this->data['InvoiceDetail']['price'] = $this->data['InvoiceDetail']['price_cur'] * $this->data['InvoiceDetail']['rp_rate'];
		//}
		// if(isset($this->data['InvoiceDetail']['discount_cur']))
		// {
			// $this->data['InvoiceDetail']['discount'] = $this->data['InvoiceDetail']['discount_cur'] * $this->data['InvoiceDetail']['rp_rate'];
		// }

		//calculate amount
		if(isset($this->data['InvoiceDetail']['price_cur']) && isset($this->data['InvoiceDetail']['qty']))
		{
			$this->data['InvoiceDetail']['amount']=$this->data['InvoiceDetail']['price_cur']*$this->data['InvoiceDetail']['qty']* $this->data['InvoiceDetail']['rp_rate'];
			$this->data['InvoiceDetail']['amount_cur']=$this->data['InvoiceDetail']['price_cur']*$this->data['InvoiceDetail']['qty'];
		}
		
		//calculate amount after discount
		if(isset($this->data['InvoiceDetail']['amount_cur']) && isset($this->data['InvoiceDetail']['discount_cur']))
		{
			$this->data['InvoiceDetail']['amount_after_disc_cur']= $this->data['InvoiceDetail']['amount_cur']-$this->data['InvoiceDetail']['discount_cur'];
		}
		if(isset($this->data['InvoiceDetail']['amount']) && isset($this->data['InvoiceDetail']['discount']))
		{
			$this->data['InvoiceDetail']['amount_after_disc']  =$this->data['InvoiceDetail']['amount']-$this->data['InvoiceDetail']['discount'];
		}

		//calculate vat 
		if(!empty($this->data['InvoiceDetail']['is_vat']) )
		{
			if(isset($this->data['InvoiceDetail']['amount_after_disc_cur'] ))
			{
				$this->data['InvoiceDetail']['vat_cur'] = 
				($this->data['InvoiceDetail']['amount_after_disc_cur'] ) 
				* $this->data['InvoiceDetail']['vat_rate']/100;
			}
			if(isset($this->data['InvoiceDetail']['amount_after_disc'] ))
			{
				$this->data['InvoiceDetail']['vat'] = 
				($this->data['InvoiceDetail']['amount_after_disc'] ) 
				* $this->data['InvoiceDetail']['vat_rate']/100;
			}
		}
		else
		{
			$this->data['InvoiceDetail']['vat_cur'] = 0;
			$this->data['InvoiceDetail']['vat'] = 0;
		}
		
		//calculate wht
		if(!empty($this->data['InvoiceDetail']['is_wht']) )
		{
			if(isset($this->data['InvoiceDetail']['amount_after_disc_cur'] ))
			{
				$this->data['InvoiceDetail']['wht_cur'] = 
				($this->data['InvoiceDetail']['amount_after_disc_cur'] ) * 
				$this->data['InvoiceDetail']['wht_rate']/100;
			}
			if(isset($this->data['InvoiceDetail']['amount_after_disc'] ))
			{
				$this->data['InvoiceDetail']['wht'] = 
				($this->data['InvoiceDetail']['amount_after_disc'] ) * 
				$this->data['InvoiceDetail']['wht_rate']/100;
			}
		}
		else
		{
			$this->data['InvoiceDetail']['wht'] = 0;
			$this->data['InvoiceDetail']['wht_cur'] = 0;
		}		
		
		//calculate nett amount
		if(isset($this->data['InvoiceDetail']['amount_after_disc_cur']))		
		{
			$this->data['InvoiceDetail']['amount_nett_cur'] = 
				$this->data['InvoiceDetail']['amount_after_disc_cur'] 
				+ $this->data['InvoiceDetail']['vat_cur'] 
				- $this->data['InvoiceDetail']['wht_cur'];
		}
		
		if(isset($this->data['InvoiceDetail']['amount_after_disc']))		
		{
			$this->data['InvoiceDetail']['amount_nett'] = 
				$this->data['InvoiceDetail']['amount_after_disc'] 
				+ $this->data['InvoiceDetail']['vat'] 
				- $this->data['InvoiceDetail']['wht'] ;
		}		
		return true;
	}	
}
?>