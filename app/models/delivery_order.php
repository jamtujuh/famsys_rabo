<?php

class DeliveryOrder extends AppModel {

      var $name = 'DeliveryOrder';
      var $displayField = 'no';
      //The Associations below have been created with all possible keys, those that are not needed can be removed
     /*  var $actsAs = array('Logable' => array(
              'userModel' => 'DeliveryOrder',
              'userKey' => 'id',
              'change' => 'list', // options are 'list' or 'full' 
              'description_ids' => TRUE // options are TRUE or FALSE 
              )); */
      var $validate = array(
          'no' => array(
              'notempty' => array(
                  'rule' => array('notempty'),
                  'message' => 'Delivery Order Number cannot empty',
              //'allowEmpty' => false,
              //'required' => false,
              //'last' => false, // Stop validation after this rule
              //'on' => 'create', // Limit validation to 'create' or 'update' operations
              ),
			  'isUnique' => array(
                  'rule' => array('isUnique'),
                  'message' => 'Delivery Order Number already exists',
              //'allowEmpty' => false,
              //'required' => false,
              //'last' => false, // Stop validation after this rule
              //'on' => 'create', // Limit validation to 'create' or 'update' operations
              ),
          ),
          'delivery_order_status_id' => array(
              'notempty' => array(
                  'rule' => array('notempty'),
                  'message' => 'Delivery Order Status cannot empty',
              //'allowEmpty' => false,
              //'required' => false,
              //'last' => false, // Stop validation after this rule
              //'on' => 'create', // Limit validation to 'create' or 'update' operations
              ),
          ),
      );
      var $belongsTo = array(
          'Po' => array(
              'className' => 'Po',
              'foreignKey' => 'po_id',
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
          'Department' => array(
              'className' => 'Department',
              'foreignKey' => 'department_id',
              'conditions' => '',
              'fields' => '',
              'order' => ''
          ),
          'DeliveryOrderStatus' => array(
              'className' => 'DeliveryOrderStatus',
              'foreignKey' => 'delivery_order_status_id',
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
          'RequestType' => array(
              'className' => 'RequestType',
              'foreignKey' => 'request_type_id',
          )
      );
      var $hasMany = array(
          'DeliveryOrderDetail' => array(
              'className' => 'DeliveryOrderDetail',
              'foreignKey' => 'delivery_order_id',
              'dependent' => true,
          ),
          'Purchase' => array(
              'className' => 'Purchase',
              'foreignKey' => 'delivery_order_id',
              'dependent' => true,
          ),
      );
	  
	  var $hasAndBelongsToMany = array(
        'Invoice' => array(
			'className'              => 'Invoice',
			'joinTable'              => 'invoices_delivery_orders',
			'foreignKey'             => 'delivery_order_id',
			'associationForeignKey'  => 'invoice_id',
			'unique'                 => true,
			'conditions'             => '',
			'fields'                 => '',
			'order'                  => '',
			'limit'                  => '',
			'offset'                 => '',
			'finderQuery'            => '',
			'deleteQuery'            => '',
			'insertQuery'            => ''
		)
	  );
	  
      var $virtualFields = array(
          'po_no' => 'SELECT no from pos where DeliveryOrder.po_id = pos.id'
      );

      function count_by_status($status_id, $group_id) {
            $cons = array();
            if ($group_id == gs_group_id)//gs_group_id
                  $cons[] = array('DeliveryOrder.delivery_order_status_id' => $status_id);

            elseif ($group_id == po_approval1_group_id)//po_approval1_group_id
                  $cons[] = array('DeliveryOrder.delivery_order_status_id' => $status_id);

            elseif ($group_id == fa_management_group_id)//fa_management_group_id
                  $cons[] = array('and' => array('DeliveryOrder.delivery_order_status_id' => $status_id,
                          'DeliveryOrder.request_type_id' => request_type_fa_general_id,
                          'DeliveryOrder.convert_asset' => 0
                          ));
            elseif ($group_id == it_management_group_id)//it_management_group_id
                  $cons[] = array('and' => array('DeliveryOrder.delivery_order_status_id' => $status_id,
                          'DeliveryOrder.request_type_id' => request_type_fa_it_id,
                          'DeliveryOrder.convert_asset' => 0
                          ));

            elseif ($group_id == stock_management_group_id)//stock_management_group_id
                  $cons[] = array('and' => array('DeliveryOrder.delivery_order_status_id' => $status_id, 
					'DeliveryOrder.request_type_id' => request_type_stock_id, 
					'DeliveryOrder.convert_asset' => 0));

            $c = $this->find('count', array('conditions' => $cons));
            return $c;
      }

      function count_status_need_invoice() {
            $count_do = $this->query('select count(dos.no) as needInvoice
								from delivery_orders as dos
								left join invoices_delivery_orders as iod
								on iod.delivery_order_id = dos.id
								where dos.delivery_order_status_id=2
								and iod.id is null and dos.convert_asset=1');
			$count = $count_do[0][0]['needInvoice'];
			return $count;
      }
}
?>
