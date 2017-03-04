<?php
class Asset extends AppModel {
	var $name = 'Asset';
	var $displayField = 'name';
	var $min_asset_value = null;
	var $code;
	var $maksi;
	/* var $actsAs = array('Logable' => array( 
        'userModel' => 'Asset',  
        'userKey' => 'id',  
        'change' => 'list', // options are 'list' or 'full' 
        'description_ids' => TRUE // options are TRUE or FALSE 
    )); */
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
		'business_type_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'cost_center_id' => array(
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

		'doc_total' => array(
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
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Purchase' => array(
			'className' => 'Purchase',
			'foreignKey' => 'purchase_id',
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
		'Location' => array(
			'className' => 'Location',
			'foreignKey' => 'location_id',
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
		'BusinessType' => array(
			'className' => 'BusinessType',
			'foreignKey' => 'business_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);

	var $hasMany = array(
		'AssetDetail' => array(
			'className' => 'AssetDetail',
			'foreignKey' => 'asset_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Reklass' => array(
			'className' => 'Reklass',
			'foreignKey' => 'asset_id',
			'dependent' => true,
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
	
	var $virtualFields = array (
		'currency_name'=> 'SELECT name from currencies where Asset.currency_id = currencies.id'
	);
	
	function getNewId($asset_category_id, $date, $department_id, $item_code)
	{
            $this->log('format date sql server: ' . $date);
		if(DRIVER=='mysql')
		{
			//2011-08-04 
			list($y,$m,$d)=explode('-', $date);
			$yy = substr($y, 2, 2); //2 digit
		}
		else if(DRIVER=='mssql')
		{
			//08/03/2011 00:00:00
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
		$count 	= $this->AssetDetail->find('count', array('conditions'=>$cond) );
		$department 		= $this->Department->read(null, $department_id);
		$department_code	= $department['Department']['code'];
		
		//$assetCategory 		= $this->AssetCategory->read(null, $asset_category_id);
		//$asset_category_code= $assetCategory['AssetCategory']['code'];
		
		$next = "$department_code/$item_code/".sprintf('%04d',$count+1)."/$m$yy";
		return $next;
	}
	
	
	function _calculateDepr( $model, $assets , $date_start, $date_end)
	{
		$tmp=array();
		$b=array();
		$bulans = array(1=>"Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
		if(!isset($date_start['year'])) return ;
		if(!isset($date_end['year'])) return ;		
		
		///periode
		$start_this_year	= array('year'=>$date_end['year']-1, 'month'=>'12', 'day'=>'16');
		$last_month			= array('year'=>$date_end['year'], 'month'=>$date_end['month']-1, 'day'=>'16');
		$last_year			= array('year'=>$date_end['year']-1, 'month'=>'12', 'day'=>'16');
		$date_start 		= array('year'=>$date_end['year'], 'month'=>$date_end['month']+1 , 'day'=>'16') ;
		$date_end 			= array('year'=>$date_end['year'], 'month'=>$date_end['month'] , 'day'=>'16' );

		$tahun_ini			= $date_end['year'];
		$bln_ini			= $date_end['month'];
		$tahun_lalu			= $tahun_ini-1;
		
		/**************************************\
		looping untuk setiap asset
		\**************************************/
		
		foreach ($assets as $asset)
		{
			$id 			= $asset[$model]['id'];
			$code 			= $asset[$model]['code'];
			$maksi	 		= $asset[$model]['maksi'];
			$this->code		= $code;
			$this->maksi	= $maksi;
			
			if($model=='Asset')
			{
				$unit	 	= $asset[$model]['qty'];
				$amount	 	= $asset[$model]['amount'];
			}
			else
			{
				$unit		= 1;
				$amount	 	= $asset[$model]['price'];
			}
			
			$price	 		= $asset[$model]['price'];
			$depbln 		= $asset[$model]['depbln'];
			
			/*******************************************************\
			price lebih dari min asset value
			dan sudah efektif
			\*******************************************************/
			if($price > $this->min_asset_value  && 
				isset($asset[$model]['date_start']['year']) && isset($asset[$model]['date_end']['year']) && $asset[$model]['umurek'] > 0)
			{
				//berapa nilai adjust utk depresiasi bulan terakhir jika abis pada tahun ini
				$last_month_adjust = 0;
				
				$f_date_start	= $this->toArrayDate($asset[$model]['date_start']);
				$f_date_end		= $this->toArrayDate($asset[$model]['date_end']);
				$f_date_out		= $this->toArrayDate($asset[$model]['date_out']);
				
				if(strstr($f_date_start['day'] , ' '))
					list($f_date_start['day'], $time) = explode(' ', $f_date_start['day']);
					
 				if(strstr($f_date_end['day'] , ' '))
					list($f_date_end['day'], $time) = explode(' ', $f_date_end['day']);
 				
				//jumlah bulan sd bulan lalu, start from januari / 15 this year or date_start
				$blnlalu		= $this->cariDeprBlnLalu($start_this_year, $last_month, $f_date_start, $f_date_end, $date_start, $date_end);	
				$sisabln		= $this->cariDeprBlnSisa($start_this_year, $f_date_end);			
				
				//jumlah bulan ini, 1 atau 0
				$blnini			= $this->cariDeprBlnIni($f_date_start, $f_date_end, $date_start, $date_end)+0;
				
				//jumlah bulan sd tahun lalu until jan this year from date_start
				$thnlalu		= $this->cariDeprThnLalu( $last_year, $f_date_start, $f_date_end, $date_start, $date_end, $maksi) + 0;

				//umur total
				$umur			= $asset[$model]['umur']			= $thnlalu+$blnlalu+$blnini;
				
				
				$asset[$model]['thnlalu'] 						= $thnlalu;
				$asset[$model]['blnlalu'] 						= $blnlalu;
				$asset[$model]['blnini'] 						= $blnini;
				
				$hpthnlalu=$asset[$model]['hpthnlalu']				= $thnlalu? $amount : 0;
				$blnlalumasuk										= $this->cariHPBlnLaluMasuk($f_date_start, $start_this_year, $date_end);
				$hpblnlalumasuk=$asset[$model]['hpblnlalumasuk'] 	= $blnlalumasuk ? $amount : 0;
				$blnlalukeluar										= $this->cariHPBlnLaluKeluar($f_date_out, $date_start, $date_end);
				$hpblnlalukeluar=$asset[$model]['hpblnlalukeluar']	= $blnlalukeluar? $amount : 0;
				$hpthnini=$asset[$model]['hpthnini'] 				= $hpthnlalu+$hpblnlalumasuk-$hpblnlalukeluar;
				
				$depthnlalu=$asset[$model]['depthnlalu']			= $thnlalu * $depbln;
				$depblnlalumasuk=$asset[$model]['depblnlalumasuk']	= $blnlalu * $depbln;
				$depblninimasuk=$asset[$model]['depblninimasuk']	= $blnini * $depbln;
				$depblnlalukeluar=$asset[$model]['depblnlalukeluar']	= 0;
				$depthnini=$asset[$model]['depthnini'] 				= $depthnlalu+$depblnlalumasuk+$depblninimasuk-$depblnlalukeluar;		
				
				//last year
				$book_value_thnlalu = $asset[$model]['book_value_thnlalu'] 		= abs(floor($hpthnlalu-$depthnlalu));
				//book value thn ini
				$book_value = $asset[$model]['book_value'] 			= abs(floor($hpthnini-$depthnini));

				//book value abis di tahun ini ??
				if($book_value <=1 && $blnini)
				{
					if($model=='Asset')
					{
						$asset[$model]['book_value'] 			= $unit; 
						$last_month_adjust						= $unit;
					}
					else if($model=='AssetDetail')
					{
						$asset[$model]['book_value'] 			= 1; 
						$last_month_adjust						= 1;
					}
					//kuranigi accu dep dengan adjustment bulan terakhir
					$asset[$model]['depthnini'] 			-= $last_month_adjust;
				}
				//book value sudah habis sejak tahun lalu, 
				//maka book value thn lalu= $unit
				else if($book_value <=1 && $book_value_thnlalu <= 1)
				{
					$asset[$model]['book_value_thnlalu'] 	= $unit;
					$asset[$model]['depthnlalu'] 			-= $unit;
					$asset[$model]['depthnini'] 			-= $unit;
					$asset[$model]['book_value'] 			= $unit; 
				}
				
				//isi flag b[1] ... b[12] apakah 0 atau 1
				for($i=1; $i<=12; $i++) 
				{
					$b[$i]=0;
				}
				
				
				/**************************************************\
				jika tanggal mulai asset dibawah tahun lalu
				\**************************************************/

				if($this->smoothdate($f_date_start['year'],$f_date_start['month'],$f_date_start['day']) 
					< $this->smoothdate($last_year['year'],$last_year['month'], $last_year['day']) )
				{
					/**********************************
					jika 
					/**********************************/
					if($blnlalu+$blnini)
					{
						for($i=1; $i<=$blnlalu+1; $i++) 
						{
							$b[$i]=1;
						}
					}
					else
					{
						for($i=1; $i<=$sisabln; $i++) 
						{
							$b[$i]=1;
						}
					}
				}			
				/**************************************************\
				jika tanggal mulai asset diatas tahun lalu
				\**************************************************/
				else
				{
				
					list($f_y, $f_m, $f_d)		= array($f_date_start['year'],$f_date_start['month'],$f_date_start['day']);
					list($k_y, $k_m, $k_d)	= array($date_end['year'], $date_end['month'], $date_end['day']);
					for($i=($k_m)-$blnlalu; $i<=$k_m; $i++) 
					{
						// debug($i);
						// debug($depbln);
						$b[$i]=1;
					}
				}
				
				//khusus bulan ini
				$b[$bln_ini+0]=$blnini;
				
				
				//kemudian , isikan nilai depbln utk setiap bulannya
				for($i=1; $i<=12; $i++) 
				{
					$nilai = $b[$i] * $depbln  ;
					$asset[$model][strtolower($bulans[$i])]= $nilai;
					
					//// jika $i bulan terakhir: kurangi dengan adjustment depresiasi terakhir
					///if($b[$i]>0 && $b[$i+1]==0)
					if($thnlalu + $i == $maksi )
					{
						$asset[$model][strtolower($bulans[$i])]= $nilai - $last_month_adjust;
					}
				}
			}
			/*******************************************************\
			price kurang dari min asset value
			dan belum  efektif
			\*******************************************************/
			else
			{

				$asset[$model]['umur']						= 0;
				$asset[$model]['thnlalu'] 						= 0;
				$asset[$model]['blnlalu'] 						= 0;
				$asset[$model]['blnini'] 						= 0;
				$asset[$model]['depbln'] 						= 0;
				
				$hpthnlalu=$asset[$model]['hpthnlalu']				= 0;
				$blnlalumasuk								= 0;
				$hpblnlalumasuk=$asset[$model]['hpblnlalumasuk'] 	= 0;
				$blnlalukeluar								= 0;
				$hpblnlalukeluar=$asset[$model]['hpblnlalukeluar']	= 0;
				$hpthnini=$asset[$model]['hpthnini'] 				= 0;

				$depthnlalu=$asset[$model]['depthnlalu']			= 0;
				$depblnlalumasuk=$asset[$model]['depblnlalumasuk']	= 0;
				$depblninimasuk=$asset[$model]['depblninimasuk']	= 0;
				$depblnlalukeluar=$asset[$model]['depblnlalukeluar']	= 0;
				$asset[$model]['depthnini'] 						= 0;		
				$asset[$model]['book_value'] 					= $amount;
				$asset[$model]['book_value_thnlalu'] 				= 0;
				for($i=1; $i<=12; $i++)
				{
					$asset[$model][strtolower($bulans[$i])]= 0;
				}			
			}
			
			$tmp[] = $asset;
		}
		return $tmp;
	}
	function _calculateDeprMontly( $model, $asset , $date_start, $date_end, $min_asset_value )
	{
		$tmp=array();
		$b=array();
		$bulans = array(1=>"Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
		if(!isset($date_start['year'])) return ;
		if(!isset($date_end['year'])) return ;		
		
		///periode
		$start_this_year	= array('year'=>$date_end['year']-1, 'month'=>'12', 'day'=>'16');
		$last_month			= array('year'=>$date_end['year'], 'month'=>$date_end['month']-1, 'day'=>'16');
		$last_year			= array('year'=>$date_end['year']-1, 'month'=>'12', 'day'=>'16');
		$date_start 		= array('year'=>$date_end['year'], 'month'=>$date_end['month']+1 , 'day'=>'16') ;
		$date_end 			= array('year'=>$date_end['year'], 'month'=>$date_end['month'] , 'day'=>'16' );

		$tahun_ini			= $date_end['year'];
		$bln_ini			= $date_end['month'];
		$tahun_lalu			= $tahun_ini-1;
		
		
		/**************************************\
		looping untuk setiap asset
		\**************************************/
		
			$id 			= $asset[$model]['id'];
			$code 			= $asset[$model]['code'];
			$maksi	 		= $asset[$model]['maksi'];
			$this->code		= $code;
			$this->maksi	= $maksi;
			
			if($model=='Asset')
			{
				$unit	 	= $asset[$model]['qty'];
				$amount	 	= $asset[$model]['amount'];
			}
			else
			{
				$unit		= 1;
				$amount	 	= $asset[$model]['price'];
			}
			
			$price	 		= $asset[$model]['price'];
			$depbln 		= $asset[$model]['depbln'];
			
			/*******************************************************\
			price lebih dari min asset value
			dan sudah efektif
			\*******************************************************/
			if($price > $min_asset_value   && 
				isset($asset[$model]['date_start']['year']) && isset($asset[$model]['date_end']['year']) && $asset[$model]['umurek'] > 0)
			{
				//berapa nilai adjust utk depresiasi bulan terakhir jika abis pada tahun ini
				$last_month_adjust = 0;
				
				$f_date_start	= $this->toArrayDate($asset[$model]['date_start']);
				$f_date_end	= $this->toArrayDate($asset[$model]['date_end']);
				$f_date_out	= $this->toArrayDate($asset[$model]['date_out']);
				
				if(strstr($f_date_start['day'] , ' '))
					list($f_date_start['day'], $time) = explode(' ', $f_date_start['day']);
					
 				if(strstr($f_date_end['day'] , ' '))
					list($f_date_end['day'], $time) = explode(' ', $f_date_end['day']);
 				
				//jumlah bulan sd bulan lalu, start from januari / 15 this year or date_start
				$blnlalu		= $this->cariDeprBlnLalu($start_this_year, $last_month, $f_date_start, $f_date_end, $date_start, $date_end);	
				$sisabln		= $this->cariDeprBlnSisa($start_this_year, $f_date_end);			

				//jumlah bulan ini, 1 atau 0
				$blnini			= $this->cariDeprBlnIni($f_date_start, $f_date_end, $date_start, $date_end)+0;
				
				//jumlah bulan sd tahun lalu until jan this year from date_start
				$thnlalu		= $this->cariDeprThnLalu( $last_year, $f_date_start, $f_date_end, $date_start, $date_end, $maksi) + 0;
				//umur total
				$umur			= $asset[$model]['umur']			= $thnlalu+$blnlalu+$blnini;
				
				
				$asset[$model]['thnlalu'] 						= $thnlalu;
				$asset[$model]['blnlalu'] 						= $blnlalu;
				$asset[$model]['blnini'] 						= $blnini;
				
				$hpthnlalu=$asset[$model]['hpthnlalu']				= $thnlalu? $amount : 0;
				$blnlalumasuk										= $this->cariHPBlnLaluMasuk($f_date_start, $start_this_year, $date_end);
				$hpblnlalumasuk=$asset[$model]['hpblnlalumasuk'] 	= $blnlalumasuk ? $amount : 0;
				$blnlalukeluar										= $this->cariHPBlnLaluKeluar($f_date_out, $date_start, $date_end);
				$hpblnlalukeluar=$asset[$model]['hpblnlalukeluar']	= $blnlalukeluar? $amount : 0;
				$hpthnini=$asset[$model]['hpthnini'] 				= $hpthnlalu+$hpblnlalumasuk-$hpblnlalukeluar;

				$depthnlalu=$asset[$model]['depthnlalu']			= $thnlalu * $depbln;
				$depblnlalumasuk=$asset[$model]['depblnlalumasuk']	= $blnlalu * $depbln;
				$depblninimasuk=$asset[$model]['depblninimasuk']	= $blnini * $depbln;
				$depblnlalukeluar=$asset[$model]['depblnlalukeluar']	= 0;
				$depthnini=$asset[$model]['depthnini'] 				= $depthnlalu+$depblnlalumasuk+$depblninimasuk-$depblnlalukeluar;		
				
				//last year
				$book_value_thnlalu = $asset[$model]['book_value_thnlalu'] 		= abs(floor($hpthnlalu-$depthnlalu));
				//book value thn ini
				$book_value = $asset[$model]['book_value'] 			= abs(floor($hpthnini-$depthnini));

				//book value abis di tahun ini ??
				if($book_value <=1 && $blnini)
				{
					if($model=='Asset')
					{
						$asset[$model]['book_value'] 			= $unit; 
						$last_month_adjust						= $unit;
					}
					else if($model=='AssetDetail')
					{
						$asset[$model]['book_value'] 			= 1; 
						$last_month_adjust						= 1;
					}
					//kuranigi accu dep dengan adjustment bulan terakhir
					$asset[$model]['depthnini'] 			-= $last_month_adjust;
				}
				//book value sudah habis sejak tahun lalu, 
				//maka book value thn lalu= $unit
				else if($book_value <=1 && $book_value_thnlalu <= 1)
				{
					$asset[$model]['book_value_thnlalu'] 	= $unit;
					$asset[$model]['depthnlalu'] 			-= $unit;
					$asset[$model]['depthnini'] 			-= $unit;
					$asset[$model]['book_value'] 			= $unit; 
				}
				
				//isi flag b[1] ... b[12] apakah 0 atau 1
				for($i=1; $i<=12; $i++) 
				{
					$b[$i]=0;
				}
				
				
				/**************************************************\
				jika tanggal mulai asset dibawah tahun lalu
				\**************************************************/

				if($this->smoothdate($f_date_start['year'],$f_date_start['month'],$f_date_start['day']) 
					< $this->smoothdate($last_year['year'],$last_year['month'], $last_year['day']) )
				{
					/**********************************
					jika 
					/**********************************/
					if($blnlalu+$blnini)
					{
						for($i=1; $i<=$blnlalu+1; $i++) 
						{
							$b[$i]=1;
						}
					}
					else
					{
						for($i=1; $i<=$sisabln; $i++) 
						{
							$b[$i]=1;
						}
					}
				}			
				/**************************************************\
				jika tanggal mulai asset diatas tahun lalu
				\**************************************************/
				else
				{
				
					list($f_y, $f_m, $f_d)		= array($f_date_start['year'],$f_date_start['month'],$f_date_start['day']);
					list($k_y, $k_m, $k_d)	= array($date_end['year'], $date_end['month'], $date_end['day']);
					for($i=($k_m)-$blnlalu; $i<=$k_m; $i++) 
					{
						// debug($i);
						// debug($depbln);
						$b[$i]=1;
					}
				}
				
				//khusus bulan ini
				$b[$bln_ini+0]=$blnini;
				
				
				//kemudian , isikan nilai depbln utk setiap bulannya
				for($i=1; $i<=12; $i++) 
				{
					$nilai = $b[$i] * $depbln  ;
					$asset[$model][strtolower($bulans[$i])]= $nilai;
					
					//// jika $i bulan terakhir: kurangi dengan adjustment depresiasi terakhir
					///if($b[$i]>0 && $b[$i+1]==0)
					if($thnlalu + $i == $maksi )
					{
						$asset[$model][strtolower($bulans[$i])]= $nilai - $last_month_adjust;
					}
				}
			}
			/*******************************************************\
			price kurang dari min asset value
			dan belum  efektif
			\*******************************************************/
			else 
			{

				$asset[$model]['umur']								= 0;
				$asset[$model]['thnlalu'] 							= 0;
				$asset[$model]['blnlalu'] 							= 0;
				$asset[$model]['blnini'] 							= 0;
				$asset[$model]['depbln'] 							= 0;
				
				$hpthnlalu=$asset[$model]['hpthnlalu']				= 0;
				$blnlalumasuk										= 0;
				$hpblnlalumasuk=$asset[$model]['hpblnlalumasuk'] 	= 0;
				$blnlalukeluar										= 0;
				$hpblnlalukeluar=$asset[$model]['hpblnlalukeluar']	= 0;
				$hpthnini=$asset[$model]['hpthnini'] 				= 0;

				$depthnlalu=$asset[$model]['depthnlalu']			= 0;
				$depblnlalumasuk=$asset[$model]['depblnlalumasuk']	= 0;
				$depblninimasuk=$asset[$model]['depblninimasuk']	= 0;
				$depblnlalukeluar=$asset[$model]['depblnlalukeluar']= 0;
				$asset[$model]['depthnini'] 						= 0;		
				$asset[$model]['book_value'] 						= $amount;
				$asset[$model]['book_value_thnlalu'] 				= 0;
				for($i=1; $i<=12; $i++)
				{
					$asset[$model][strtolower($bulans[$i])]= 0;
				}			
		}
		
		return $asset;
	}

	function toArrayDate($string)
	{
		$a_date=false;

		//2000-02-01
		if(strstr($string, '-'))
		{
			list($y,$m,$d) 	= explode('-',$string);
			$a_date	= array('year'=>$y,'month'=>$m,'day'=>$d);	
		}
		//20000201
		else 
		{
			$a_date=array(substr($string,0,4), substr($string,4,2),substr($string,6,2)); 
		}
		return $a_date;
	}

	
	//apakah ada pembelian bulan ini ?
	function cariHPBlnLaluMasuk($f_date_start, $date_start, $date_end)
	{	
		$out = 0;
		if($date_start < $f_date_start && $f_date_start < $date_end)
			$out = 1;		
		return $out;
	}

	//apakah date_out asset berada di periode ybs?
	function cariHPBlnLaluKeluar($f_date_out, $date_start, $date_end )
	{
		$out = false;
		if( $date_start  <=  $f_date_out 
			&&  $f_date_out  <=  $date_end )
			$out = 1;
			
		return $out;		
		
	}

	function monthDiff($f_date_start, $date_end)
	{
		$out = $this->date_difference($f_date_start, $date_end);
		if(!$out) return 0;
		if($out['days'] > 0) $out['months']++;
		if($out['years']) $out['months'] += $out['years']*12 ;
		return $out['months'];
	}

	function smoothdate ($year, $month, $day)
	{
		return sprintf ('%04d', $year) . sprintf ('%02d', $month) . sprintf ('%02d', $day);
	}


	function date_difference ($first, $second)
	{
		if(strstr($first['day'],' ') == true){
			list($a,$b) = explode(' ', $first['day']);
			$first['day'] = $a;
		}
		if(strstr($second['day'],' ') == true){
			list($a,$b) = explode(' ', $second['day']);
			$second['day'] = $a;
		}
		if(!isset($first['year'])) return 0;
		if(!isset($second['year'])) return 0;
		$month_lengths = array (31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);

		$retval = FALSE;

 		if ( checkdate($first['month'], $first['day'], $first['year']) &&
			checkdate($second['month'], $second['day'], $second['year'])
			)
 		{
			$start = $this->smoothdate ($first['year'], $first['month'], $first['day']);
			$target = $this->smoothdate ($second['year'], $second['month'], $second['day']);
								
			if ($start <= $target)
			{
				$add_year = 0;
				while ($this->smoothdate ($first['year']+ 1, $first['month'], $first['day']) <= $target)
				{
					$add_year++;
					$first['year']++;
				}

				$add_month = 0;
				while ($this->smoothdate ($first['year'], $first['month'] + 1, $first['day']) <= $target)
				{
					$add_month++;
					$first['month']++;
					if ($first['month'] > 12)
					{
						$first['year']++;
						$first['month'] = 1;
					}
				}

				$add_day = 0;
				while ($this->smoothdate ($first['year'], $first['month'], $first['day'] + 1) <= $target)
				{
					if (($first['year'] % 100 == 0) && ($first['year'] % 400 == 0))
					{
						$month_lengths[1] = 29;
					}
					else
					{
						if ($first['year'] % 4 == 0)
						{
							$month_lengths[1] = 29;
						}
					}
					
					$add_day++;
					$first['day']++;
					if ($first['day'] > $month_lengths[$first['month'] - 1])
					{
						$first['month']++;
						$first['day'] = 1;
						
						if ($first['month'] > 12)
						{
							$first['month'] = 1;
						}
					}
					
				}
				$retval = array ('years' => $add_year, 'months' => $add_month, 'days' => $add_day);
			}
		}
		return $retval;
	}
	
	/*
	apakah ada depresiasi blm bulan periode terpilih,
	jika ada = 1 : 
		start_date 
	jika tidak = 0
	batas tanggal cut off: 15 setiap bulan
	jadi kalau dibawah tgl 15 => 1
	diatas tanggal 15 => 0
	*/

	function cariDeprBlnIni( $f_date_start, $f_date_end, $date_start, $date_end)
	{
		$out = false;
		if(!isset($f_date_start['year'])) return 0;
		if(!isset($f_date_end['year'])) return 0;
		if(!isset($date_start['year'])) return 0;
		if(!isset($date_end['year'])) return 0;
		
		///parameter filter date_start dan date_end
		$date_start 	= $this->smoothDate($date_start['year'], $date_start['month'], $date_start['day']);
		$date_end 	= $this->smoothDate($date_end['year'], $date_end['month'], $date_end['day']);
		
		/// asset field date_start dan date_end
		$f_date_start 	= $this->smoothDate($f_date_start['year'], $f_date_start['month'], $f_date_start['day']);
		$f_date_end 	= $this->smoothDate($f_date_end['year'], $f_date_end['month'], $f_date_end['day']);
		
		//var_dump($f_date_end 2016-02-15 );
		//date_start : 2016-01-15
		//date_end   : 2016-02-15
		if( $date_end  <  $f_date_start )
		{
			$out = 0;
		}
		else if( $date_start  <=  $f_date_start && $f_date_start < $date_end )
		{
			$out = 1;
		}
		else if($f_date_start < $date_start && $date_end <= $f_date_end)
		{
			$out = 1;
		}
		else if($f_date_start < $date_start && $f_date_end <= $date_end && $f_date_end >= $date_start)
		{
			$out = 1;
		}
		else if($f_date_start < $date_start && $f_date_end < $date_start)
		{
			$out = 0;
		}
		return $out;
	}
	
	// cari jumlah bulan sd bulan lalu
	// jika date_start > $start_this_year, mulai hitung dari date_start
	// else mulai hitung dari $start_this_year 
	// sampai dengan last_month
	function cariDeprBlnLalu( $start_this_year, $last_month, $f_date_start, $f_date_end, $date_start, $date_end)
	{
		$out = false;
		if(!isset($f_date_start['year'])) return $out;
		if(!isset($f_date_end['year'])) return $out;
		
		$s_this_year 	= $this->smoothDate($start_this_year['year'],	$start_this_year['month'], 	$start_this_year['day']);
		$s_last_month 	= $this->smoothDate($last_month['year'],		$last_month['month'], 	$last_month['day']);
		$s_f_date_start	= $this->smoothDate($f_date_start['year'],		$f_date_start['month'], 	$f_date_start['day']);
		$s_f_date_end 	= $this->smoothDate($f_date_end['year'],		$f_date_end['month'], 	$f_date_end['day']);
		$s_date_start 	= $this->smoothDate($date_start['year'],		$date_start['month'], 		$date_start['day']);
		$s_date_end 	= $this->smoothDate($date_end['year'],		$date_end['month'], 		$date_end['day']);
		
		if($s_f_date_end < $s_date_end  && $s_f_date_end < $s_date_start)
		{
			$out=0;
		}
		else if($s_f_date_start > $s_this_year)
		{
			$out=$this->monthDiff($f_date_start, $last_month);
		}
		else
		{
			$out=$this->monthDiff($start_this_year, $last_month);
		}
			
		return $out;
	}
	
	function cariDeprBlnSisa($start_this_year, $date_end)
	{
		$out=$this->monthDiff($start_this_year, $date_end);
		return $out;
	}
	
	// cari jumlah bulan sd tahun lalu
	// jika date_start > $start_this_year, mulai hitung dari date_start
	// else mulai hitung dari $start_this_year 
	// sampai dengan last_month
	function cariDeprThnLalu( $last_year, $f_date_start, $f_date_end, $date_start, $date_end, $maksi)
	{
		$out = false;
		if(!isset($f_date_start['year'])) return $out;
		if(!isset($f_date_end['year'])) return $out;
		if(!isset($date_start['year'])) return $out;
		if(!isset($date_end['year'])) return $out;		
		$s_last_year = $this->smoothDate($last_year['year'],$last_year['month'], $last_year['day']);
		$s_f_date_start = $this->smoothDate($f_date_start['year'],$f_date_start['month'], $f_date_start['day']);
		$s_f_date_end = $this->smoothDate($f_date_end['year'],$f_date_end['month'], $f_date_end['day']);
		$s_date_start = $this->smoothDate($date_start['year'],$date_start['month'], $date_start['day']);
		$s_date_end = $this->smoothDate($date_end['year'],$date_end['month'], $date_end['day']);
				
		if($s_f_date_end < $s_date_end  && $s_f_date_end < $s_date_start)
		{
			$out=$maksi;
		}
		else if($s_f_date_start < $s_last_year)
		{
			$out=$this->monthDiff($f_date_start, $last_year);
		}
		else
		{
			$out=0;
		}	
		return $out;
	}

	
	function cariJlhBlnSdThnLalu($f_date_start, $date_end) 
	{
		//cari jlh bulan sd tahun lalu antara $f_date_start dgn $date_end
		
		if($f_date_start && $date_end)
		{
			$start = $this->toArrayDate( $f_date_start);		
			$end  = $this->toArrayDate($date_end);
			
			$out = $this->date_difference($start, $end);
			return $out['months'];
		}
		else
			return 0;
	}

/*	function cariJlhBlnSdBlnLalu($date_start, $periode) 
	{
		if($date_start && $periode)
		{
			$a=$this->toArrayDate( $date_start);
			list($ya, $ma, $da)=array($a['year'],$a['month'],$a['day']);
			$a =  $this->toArrayDate( $periode);
			list($yp, $mp, $dp)=array($a['year'],$a['month'],$a['day']);

			$sql = sprintf("select period_diff(%04d%02d , %04d%02d) as b ", $yp, $mp, $yp, 1);
			$a = $this->query($sql);			
			$this->log( "cariJlhBlnSdBlnLalu: $sql");
			$this->log( "hasil: ". var_export($a,true) );
			$h=$a[0][0]['b'];
			return $h;
		}
		else
			return 0;
	}
*/
	
	function findTotals($conditions)
	{
		$param = array(
			'conditions'=>$conditions,
			'fields'=>array(
				'sum(Asset.qty) as qty',
				'sum(Asset.price) as price',
				'sum(Asset.amount) as amount',
				'sum(Asset.hpthnlalu) as hpthnlalu',
				'sum(Asset.depthnlalu) as depthnlalu',
				'sum(Asset.book_value) as book_value',
				'sum(Asset.depthnini) as depthnini',
				'sum(Asset.hpthnlalu-depthnlalu) as ttl',
				'sum(Asset.jan) as jan',
				'sum(Asset.feb) as feb',
				'sum(Asset.mar) as mar',
				'sum(Asset.apr) as apr',
				'sum(Asset.may) as may',
				'sum(Asset.jun) as jun',
				'sum(Asset.jul) as jul',
				'sum(Asset.aug) as aug',
				'sum(Asset.sep) as sep',
				'sum(Asset.oct) as oct',
				'sum(Asset.nov) as nov',
				'sum(Asset.dec) as dec',
				'sum(Asset.hpthnini) as hpthnini',
				),
			'joins'=>array(
				array(
					'table'=>'asset_categories',
					'alias'=>'AssetCategory',
					'conditions'=>array('Asset.asset_category_id=AssetCategory.id')
				)
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
			$qty	 		+= $asset['Asset']['qty'];
			$price		    += $asset['Asset']['price'];
			$amount	 		+= $asset['Asset']['amount'];
			$book_value		+= $asset['Asset']['book_value'];
			$book_value_thnlalu		+= $asset['Asset']['book_value_thnlalu'];
			$hpthnlalu	 	+= $asset['Asset']['hpthnlalu'];
			$depthnlalu	 	+= $asset['Asset']['depthnlalu'];
			$hpthnini	 	+= $asset['Asset']['hpthnini'];
			$depthnini	 	+= $asset['Asset']['depthnini'];
			$jan		 	+= $asset['Asset']['jan'];
			$feb		 	+= $asset['Asset']['feb'];
			$mar		 	+= $asset['Asset']['mar'];
			$apr		 	+= $asset['Asset']['apr'];
			$may		 	+= $asset['Asset']['may'];
			$jun		 	+= $asset['Asset']['jun'];
			$jul		 	+= $asset['Asset']['jul'];
			$aug		 	+= $asset['Asset']['aug'];
			$sep		 	+= $asset['Asset']['sep'];
			$oct		 	+= $asset['Asset']['oct'];
			$nov		 	+= $asset['Asset']['nov'];
			$dec		 	+= $asset['Asset']['dec'];
		} 
		$a['qty'] 			= $qty ;
		$a['price'] 		= $price ;
		$a['amount'] 		= $amount ;
		$a['book_value'] 	= $book_value ;
		$a['book_value_thnlalu'] 	= $book_value_thnlalu ;
		$a['hpthnlalu'] 	= $hpthnlalu ;
		$a['depthnlalu'] 	= $depthnlalu ;
		$a['ttl'] 			= $hpthnlalu - $depthnlalu ;
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
	function process_depr($min_asset_value){
	
		$sql = 'update assets set ada="T" where qty=0';
		$this->query($sql);
		
		$this->recursive=-1;
		   $date_ends =  date("Y-m-15",strtotime("+1 month"));
           $cond = array(
				'Asset.price >' => $min_asset_value,
				'Asset.umurek >' => 0,
				'Asset.posting'=>0, 
				'Asset.date_start !=' => null, //tidak sama dengan null
				'Asset.date_start <='=>date('Y-m-15 23:59:59'), // yang tanggal start lebih dari periode bulan ini , yaitu tgl 15 setiap bulan
				'Asset.date_end  >='=>$date_ends, // masih berlaku  di bulan ini
                'Asset.ada'=>'Y');
            $date_start = array('year'=>date('Y') , 'month'=>date('m') , 'day'=>1 );// , mktime(0,0,0,date('m')-1, date('d'), date('Y')));
            $date_end   = array('year'=>date('Y') , 'month'=>date('m') , 'day'=>date('d') );
            
            
            //calculate assets
            $assetsNonDepr = $this->find('all', array('conditions'=>$cond));
            $assets = $this->_calculateDepr('Asset', $assetsNonDepr, $date_start, $date_end);
			
            foreach($assets as $a)
            {            
                  if(!$this->save($a))
                  {
                      debug('cannot save assets ' . $a['Asset']['id']);  
                  }
            }
            
            
            /// now calculate asset details
			$date_ends =  date("Y-m-15",strtotime("+1 month"));
            $cond = array(
				'AssetDetail.price >' => $min_asset_value,
				'AssetDetail.umurek >' => 0,
				'AssetDetail.posting'=>0, 
				'AssetDetail.date_start !=' => null, //tidak sama dengan null
				'AssetDetail.date_start <='=>date('Y-m-15 23:59:59'), // yang tanggal start lebih dari periode bulan ini , yaitu tgl 15 setiap bulan
				'AssetDetail.date_end  >='=>$date_ends, // masih berlaku  di bulan ini
                'AssetDetail.ada'=>'Y');	    
            $assetDetailsNonDepr = $this->AssetDetail->find('all', array('conditions'=>$cond));
            $assetDetails = $this->_calculateDepr('AssetDetail', $assetDetailsNonDepr, $date_start, $date_end);
            foreach($assetDetails as $a)
            {            
                  if(!$this->AssetDetail->save($a))
                  {
                      debug('cannot save asset_details ' . $a['AssetDetail']['id']);  
                  }
            }
	}
}
?>