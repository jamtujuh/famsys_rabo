<?php 
class Reklass extends AppModel {
	var $name = 'Reklass';
	var $displayField = 'doc_no';
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $validate = array(
		'doc_no' => array(
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
	var $belongsTo = array(
		'ReklasStatus' => array(
			'className' => 'ReklasStatus',
			'foreignKey' => 'reklas_status_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
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
		'Item' => array(
			'className' => 'Item',
			'foreignKey' => 'item_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);
	
	
 	function getNewId()
	{
		$prefix = 'REK';
		$year = date('my');
		$reklass = $this->find('all', array(
		'fields'=>'doc_no', 'limit'=>1, 'order'=>'doc_no desc') );
		if(!empty($reklass))
		{
			$next =  $reklass[0]['Reklass']['doc_no'];
			$a	  =  explode('/',$next);
			$no	  =  $a[1];
			$next =  "$prefix/".sprintf("%03s",$no+1)."/$year";
		}
		else
		{
			$next =  "$prefix/001/$year";
		}
		return $next;
	}
	function count_by_status($status)
	{
		$c = $this->find('count', array('conditions'=>array('Reklass.reklas_status_id'=>$status)));
		return $c;
	}
	function change_code($id){
		$reklass = $this->read(null, $id);
		
		$asset = $this->Asset->read(null, $reklass['Reklass']['asset_id']);
		$item = $this->Item->read(null, $reklass['Reklass']['item_id']);
		
		$code = $this->Asset->getNewId($reklass['Reklass']['asset_category_id'], $reklass['Reklass']['date'], $asset['Asset']['department_id'], $reklass['Reklass']['item_code']);
		
		$this->Asset->id = $reklass['Reklass']['asset_id'];
		$this->Asset->set('item_code', $reklass['Reklass']['item_code']);
		$this->Asset->set('name', $item['Item']['name']);
		$this->Asset->set('asset_category_id', $reklass['Reklass']['asset_category_id']);
		$this->Asset->set('code', $code);
		$this->Asset->save();
		
		foreach($asset['AssetDetail'] as $detil){
			$code = $this->Asset->getNewId($reklass['Reklass']['asset_category_id'], $reklass['Reklass']['date'], $asset['Asset']['department_id'], $reklass['Reklass']['item_code']);

			$this->Asset->AssetDetail->id = $detil['id'];
			$this->Asset->AssetDetail->set('item_code', $reklass['Reklass']['item_code']);
			$this->Asset->AssetDetail->set('name', $item['Item']['name']);
			$this->Asset->AssetDetail->set('asset_category_id', $reklass['Reklass']['asset_category_id']);
			$this->Asset->AssetDetail->set('code', $code);
			$this->Asset->AssetDetail->save();
		}
	}

}
?>