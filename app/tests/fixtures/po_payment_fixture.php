<?php
/* PoPayment Fixture generated on: 2011-04-21 10:37:01 : 1303353421 */
class PoPaymentFixture extends CakeTestFixture {
	var $name = 'PoPayment';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'po_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'term' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'payment_date' => array('type' => 'date', 'null' => false, 'default' => NULL),
		'amount' => array('type' => 'float', 'null' => false, 'default' => NULL, 'length' => '20,2'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'po_id' => array('column' => array('po_id', 'term'), 'unique' => 0)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'po_id' => 1,
			'term' => 1,
			'payment_date' => '2011-04-21',
			'amount' => 1
		),
	);
}
?>