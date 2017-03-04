<?php
class DeliveryOrderDetail extends AppModel {
	var $name = 'DeliveryOrderDetail';
	var $displayField = 'name';
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	/* var $actsAs = array('Logable' => array( 
        'userModel' => 'DeliveryOrderDetail',  
        'userKey' => 'id',  
        'change' => 'list', // options are 'list' or 'full' 
        'description_ids' => TRUE // options are TRUE or FALSE 
    )); */
	var $belongsTo = array(
		'DeliveryOrder' => array(
			'className' => 'DeliveryOrder',
			'foreignKey' => 'delivery_order_id',
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
		'PoDetail' => array(
			'className' => 'PoDetail',
			'foreignKey' => 'po_detail_id',
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
		'Npb' => array(
			'className' => 'Npb',
			'foreignKey' => 'npb_id',
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
		)
	);
	
	
	function update_po_detail_qty($update_po=false)
	{
		
		$vat_rate = $this->data['DeliveryOrder']['vat_rate']/100;
		//************************
		if(DRIVER=='mysql')
			$is_vat =  'if(is_vat, amount_after_disc_cur*'.$vat_rate.', 0)' ;
		elseif(DRIVER=='mssql')
			$is_vat =  'case is_vat when 1 then (amount_cur - discount_cur)*'.$vat_rate.' when 0 then 0 end' ;
		//**************************
		
		//update my qty, amount, etc sesuai dengan qty received
		$sqls='update delivery_order_details 
		set 
		amount_cur 		= price_cur * qty_received,
		discount_cur 	= discount_unit_cur * qty_received
		where id			=' .$this->data['DeliveryOrderDetail']['id'];
		$this->query($sqls);
		
		$sql='update delivery_order_details 
		set 
		amount_after_disc_cur 	= amount_cur - discount_cur,
		amount_after_disc		 	= amount_cur - discount_cur,
		vat_cur 						= ('.$is_vat.'),
		vat					 			= ('.$is_vat.')
		where id						=' .$this->data['DeliveryOrderDetail']['id'];
		$this->query($sql);

		$sql='update delivery_order_details 
		set 
		amount_nett_cur 			= amount_after_disc_cur + vat_cur,
		amount_nett					= amount_after_disc_cur + vat_cur,
		price								= price_cur,
		amount							= amount_cur,
		discount						= discount_cur
		where id						= '.$this->data['DeliveryOrderDetail']['id'];
		$this->query($sql);
		
		
		//update delivery order totals
		$delivery_order_id = $this->data['DeliveryOrder']['id'];
		$sql='update delivery_orders
		set 
		sub_total_cur=(select sum(amount_cur) from delivery_order_details where delivery_order_id=delivery_orders.id),
		discount_cur=(select sum(discount_cur) from delivery_order_details where delivery_order_id=delivery_orders.id),
		after_disc_cur=(select sum(amount_after_disc_cur) from delivery_order_details where delivery_order_id=delivery_orders.id),
		total_cur=(select sum(amount_nett_cur) from delivery_order_details where delivery_order_id=delivery_orders.id)
		where id='.$delivery_order_id;
		$this->query($sql);
		
		//update po detail qty
		if($update_po)
		{
			$po_detail_id 	= $this->data['DeliveryOrderDetail']['po_detail_id'];
			$this->PoDetail->recursive=0;
			$poDetail		=$this->PoDetail->read(null, $po_detail_id);
			$po_id 			= $poDetail['PoDetail']['po_id'];
			
			/* $sql='select sum(qty_received) as s from delivery_order_details where po_detail_id="'.$po_detail_id.'"';
			$res=$this->query($sql);
			$total_received = $res[0][0]['s']; */
			
			$TR = $this->find('first', array('fields'=>array('SUM(DeliveryOrderDetail.qty_received) as qty_received'),
						'conditions'=>array(
							'and' =>array('DeliveryOrderDetail.po_id'=>$po_id,
								'DeliveryOrderDetail.po_detail_id'=>$po_detail_id,
								'DeliveryOrderDetail.delivery_order_id'=>$delivery_order_id)
							)));
			$total_received = $TR[0]['qty_received'];
			
			if($total_received>$poDetail['PoDetail']['qty'])
				$total_received=$poDetail['PoDetail']['qty'];
			
			$poDetail['PoDetail']['qty_received'] = $total_received;
			$sql='update po_details set qty_received=qty_received + '.$total_received.' where id='.$po_detail_id;		
			if(!$this->query($sql))
			{
				__('Po Detail update qty_received failed');
				return;
			}
			
			$po=$this->PoDetail->Po->read(null,$po_id);
			if($po['Po']['v_is_done'] == 1)
			{
				$po['Po']['date_finish'] = date('Y-m-d H:i:s');
				$this->PoDetail->Po->save($po);
			}
		}
	}
	
}
?>