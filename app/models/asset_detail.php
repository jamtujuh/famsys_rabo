<?php
class AssetDetail extends AppModel {
	var $name = 'AssetDetail';
	var $displayField = 'name';
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	// var $actsAs = array('Logable' => array( 
        // 'userModel' => 'AssetDetail',  
        // 'userKey' => 'id',  
        // 'change' => 'list', // options are 'list' or 'full' 
        // 'description_ids' => TRUE // options are TRUE or FALSE 
    // ));
	var $order = 'AssetDetail.id';
	var $validate = array(
		'code' => array(
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
		'department_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
			),
		),
		'umurek' => array(
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

		'price' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
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
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
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
	var $belongsTo = array(
		'Asset' => array(
			'className' => 'Asset',
			'foreignKey' => 'asset_id',
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
		'Condition' => array(
			'className' => 'Condition',
			'foreignKey' => 'condition_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Location' => array(
			'className' => 'Location',
			'foreignKey' => 'location_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Purchase' => array(
			'className' => 'Purchase',
			'foreignKey' => 'purchase_id',
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
		'BusinessType' => array(
			'className' => 'BusinessType',
			'foreignKey' => 'business_type_id',
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
		'AssetCategoryType' => array(
			'className' => 'AssetCategoryType',
			'foreignKey' => 'asset_category_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	var $hasMany = array(
		'MovementDetail' => array(
			'className' => 'MovementDetail',
			'foreignKey' => 'asset_detail_id',
		),
		'FaSupplierReturDetail' => array(
			'className' => 'FaSupplierReturDetail',
			'foreignKey' => 'asset_detail_id',
		)		
	);	
	
	function getNewId($asset_category_id, $date, $department_id, $item_code)
	{
		if(DRIVER=='mysql')
		{
			//2011-08-04 
			list($y,$m,$d)=explode('-', $date);
			$yy = substr($y, 2, 2); //2 digit
		}
		else if(DRIVER=='mssql')
		{
                 /*
			list($m,$d,$y)  = explode('/', $date);
			list($y, $hour) = explode(' ' , $y);
			$yy = substr($y, 2, 2); // 2 digit
                  */
                  
			//2011-08-04 00:00:00
            list($y,$m,$d)=explode('-', $date);
			if (strstr($d,' '))
				list($d, $hour) = explode(' ' , $d);
			$yy = substr($y, 2, 2); // 2 digit yy
		}
		
		$cond 	= array(
			'AssetDetail.asset_category_id'=>$asset_category_id, 
			'AssetDetail.item_code'=>$item_code, 
			'year(AssetDetail.date_of_purchase)'=>$y, 
			'AssetDetail.department_id'=>$department_id);
		$count 	= $this->find('count', array('conditions'=>$cond) );
		$department 		= $this->Department->read(null, $department_id);
		$department_code	= $department['Department']['code'];
		//$assetCategory 		= $this->AssetCategory->read(null, $asset_category_id);
		//$asset_category_code= $assetCategory['AssetCategory']['code'];
		
		//$location_code 		= 'XXX';		
		$next = "$department_code/$item_code/".sprintf('%04d',$count+1)."/$m$yy";
		return $next;
	}
	
	function findTotals($conditions)
	{
		$param = array(
			'conditions'=>$conditions,
			'order'=>'sum(AssetDetail.price)',
			'fields'=>array(
				'sum(AssetDetail.price) as price',
				'sum(AssetDetail.hpthnlalu) as hpthnlalu',
				'sum(AssetDetail.depthnlalu) as depthnlalu',
				'sum(AssetDetail.book_value) as book_value',
				'sum(AssetDetail.depthnini) as depthnini',
				'sum(AssetDetail.jan) as jan',
				'sum(AssetDetail.feb) as feb',
				'sum(AssetDetail.mar) as mar',
				'sum(AssetDetail.apr) as apr',
				'sum(AssetDetail.may) as may',
				'sum(AssetDetail.jun) as jun',
				'sum(AssetDetail.jul) as jul',
				'sum(AssetDetail.aug) as aug',
				'sum(AssetDetail.sep) as sep',
				'sum(AssetDetail.oct) as oct',
				'sum(AssetDetail.nov) as nov',
				'sum(AssetDetail.dec) as dec',
				'sum(AssetDetail.hpthnini) as hpthnini',
				'sum(AssetDetail.hpthnlalu-AssetDetail.depthnlalu) as total',
				),
			'joins'=>array(
				array(
					'table'=>'asset_categories',
					'alias'=>'AssetCategory',
					'conditions'=>array('AssetDetail.asset_category_id=AssetCategory.id')
				),
			)
		);
		$this->recursive=-1;
		$a = $this->find('first', $param);
		return $a[0];
	}	

	function findTotalsFromArray($con) {
		$qty = 0;
		$price = 0;
		$amount = 0;
		$book_value = 0;
		$book_value_thnlalu = 0;
		$hpthnlalu = 0;
		$depthnlalu = 0;
		$hpthnini = 0;
		$depthnini = 0;
		$jan = 0;
		$feb = 0;
		$mar = 0;
		$apr = 0;
		$may = 0;
		$jun = 0;
		$jul = 0;
		$aug = 0;
		$sep = 0;
		$oct = 0;
		$nov = 0;
		$dec = 0;
		
		foreach ($con as $asset) {
			$price		    += $asset['AssetDetail']['price'];
			$book_value		+= $asset['AssetDetail']['book_value'];
			$hpthnlalu	 	+= $asset['AssetDetail']['hpthnlalu'];
			$book_value_thnlalu	 	+= $asset['AssetDetail']['book_value_thnlalu'];
			$depthnlalu	 	+= $asset['AssetDetail']['depthnlalu'];
			$hpthnini	 	+= $asset['AssetDetail']['hpthnini'];
			$depthnini	 	+= $asset['AssetDetail']['depthnini'];
			$jan		 	+= $asset['AssetDetail']['jan'];
			$feb		 	+= $asset['AssetDetail']['feb'];
			$mar		 	+= $asset['AssetDetail']['mar'];
			$apr		 	+= $asset['AssetDetail']['apr'];
			$may		 	+= $asset['AssetDetail']['may'];
			$jun		 	+= $asset['AssetDetail']['jun'];
			$jul		 	+= $asset['AssetDetail']['jul'];
			$aug		 	+= $asset['AssetDetail']['aug'];
			$sep		 	+= $asset['AssetDetail']['sep'];
			$oct		 	+= $asset['AssetDetail']['oct'];
			$nov		 	+= $asset['AssetDetail']['nov'];
			$dec		 	+= $asset['AssetDetail']['dec'];
		} 
		$a['price'] 		= $price ;
		$a['book_value'] 	= $book_value ;
		$a['book_value_thnlalu'] 	= $book_value_thnlalu ;
		$a['hpthnlalu'] 	= $hpthnlalu ;
		$a['depthnlalu'] 	= $depthnlalu ;
		$a['total']			= $hpthnlalu - $depthnlalu ;
		$a['depthnini']		= $depthnini ;
		$a['hpthnini']		= $hpthnini ;
		$a['jan']			= $jan ;
		$a['feb']			= $feb ;
		$a['mar']			= $mar ;
		$a['apr']			= $apr ;
		$a['may']			= $may ;
		$a['jun']			= $jun ;
		$a['jul']			= $jul ;
		$a['aug']			= $aug ;
		$a['sep']			= $sep ;
		$a['oct']			= $oct ;
		$a['nov']			= $nov ;
		$a['dec']			= $dec ;
		
		return $a;
	}
}
?>