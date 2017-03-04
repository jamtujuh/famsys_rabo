<?php
class InvoicePayment extends AppModel {
	var $name = 'InvoicePayment';
	var $actsAs = array('Logable' => array( 
        'userModel' => 'InvoicePayment',  
        'userKey' => 'id',  
        'change' => 'list', // options are 'list' or 'full' 
        'description_ids' => TRUE // options are TRUE or FALSE 
    ));
	var $validate = array(
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
		//'masa_manfaat' => array(
			//'notempty' => array(
				//'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			//),
		//),
		//'convert_asset' => array(
			//'notempty' => array(
				//'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			//),
		//),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	/*var $validate = array(
		'no' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Payment Number cannot be empty',
			),
		),
		'term_no' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Term Number cannot be empty',
			),
		),
		'term_percent' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Term Percentage cannot be empty',
			),
		),		
		'date_due' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Date Due cannot be empty',
			),
		),		
		'date_paid' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Date Paid cannot be empty',
			),
		),		
		'amount_due' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Amount Due cannot be empty',
			),
		),		
		/*'amount_paid' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Amount Paid cannot be empty',
			),
		),		
		'amount_invoice' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Amount Invoice cannot be empty',
			),
		),			
	);
       * 
       */
	var $belongsTo = array(
		'Invoice' => array(
			'className' => 'Invoice',
			'foreignKey' => 'invoice_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Po' => array(
			'className' => 'Po',
			'foreignKey' => 'po_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'BankAccountType' => array(
			'className' => 'BankAccountType',
			'foreignKey' => 'bank_account_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),		
		'BankAccount' => array(
			'className' => 'BankAccount',
			'foreignKey' => 'bank_account_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),				
		'InvoicePaymentStatus' => array(
			'className' => 'InvoicePaymentStatus',
			'foreignKey' => 'invoice_payment_status_id',
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
		'EconomicAge' => array(
			'className' => 'EconomicAge',
			'foreignKey' => 'economic_ages_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	function beforeSave(){
	
            if(isset ($this->data['InvoicePayment']['amount_due'] ))
      		$this->data['InvoicePayment']['amount_due'] = str_replace(',','',$this->data['InvoicePayment']['amount_due']);
      	
            if(isset($this->data['InvoicePayment']['amount_paid'] ))
                  $this->data['InvoicePayment']['amount_paid'] = str_replace(',','',$this->data['InvoicePayment']['amount_paid']);
	
            if(isset($this->data['InvoicePayment']['amount_invoice'] ))
                  $this->data['InvoicePayment']['amount_invoice'] = str_replace(',','',$this->data['InvoicePayment']['amount_invoice']);

            return true;
	}
      
	function count_by_status($invoice_payment_id)
	{
		//$cons[] = array();

		$cons[] = array('InvoicePayment.invoice_payment_status_id'=>$invoice_payment_id);

		$c = $this->find('count', array('conditions'=>$cons));
		return $c;
	}
      
      
}
?>