<?php
/* Interfase Fixture generated on: 2012-04-04 21:57:58 : 1333551478 */
class InterfaseFixture extends CakeTestFixture {
	var $name = 'Interfase';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'length' => 11, 'key' => 'primary'),
		'source_id' => array('type' => 'string', 'null' => false, 'length' => 3),
		'source_dt' => array('type' => 'float', 'null' => false, 'length' => 9),
		'source_no' => array('type' => 'float', 'null' => false, 'length' => 5),
		'source_tm' => array('type' => 'float', 'null' => false, 'length' => 5),
		'kdtran' => array('type' => 'string', 'null' => false, 'length' => 3),
		'noref' => array('type' => 'string', 'null' => false, 'length' => 15),
		'norek1' => array('type' => 'string', 'null' => false, 'length' => 6),
		'kdcab1' => array('type' => 'string', 'null' => false, 'length' => 3),
		'ccy1' => array('type' => 'float', 'null' => false, 'length' => 5),
		'nilai1' => array('type' => 'float', 'null' => false, 'length' => 9),
		'norek2' => array('type' => 'string', 'null' => false, 'length' => 6),
		'kdcab2' => array('type' => 'string', 'null' => false, 'length' => 3),
		'ccy2' => array('type' => 'float', 'null' => false, 'length' => 5),
		'nilai2' => array('type' => 'float', 'null' => false, 'length' => 9),
		'costc1' => array('type' => 'float', 'null' => true, 'length' => 9),
		'costc2' => array('type' => 'float', 'null' => true, 'length' => 9),
		'costdept1' => array('type' => 'string', 'null' => false, 'length' => 10),
		'costdept2' => array('type' => 'string', 'null' => false, 'length' => 10),
		'kurs' => array('type' => 'float', 'null' => false, 'length' => 9),
		'ket1' => array('type' => 'string', 'null' => true, 'length' => 35),
		'ket2' => array('type' => 'string', 'null' => false, 'length' => 35),
		'ket3' => array('type' => 'string', 'null' => true, 'length' => 35),
		'rc' => array('type' => 'float', 'null' => true, 'length' => 5),
		'st' => array('type' => 'string', 'null' => true, 'length' => 3),
		'trs_dt' => array('type' => 'datetime', 'null' => true),
		'trs_tm' => array('type' => 'integer', 'null' => true, 'length' => 4),
		'posting' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 4),
		'posting_date' => array('type' => 'datetime', 'null' => true),
		'indexes' => array('0' => array()),
		'tableParameters' => array()
	);

	var $records = array(
		array(
			'id' => 1,
			'source_id' => 'L',
			'source_dt' => 1,
			'source_no' => 1,
			'source_tm' => 1,
			'kdtran' => 'L',
			'noref' => 'Lorem ipsum d',
			'norek1' => 'Lore',
			'kdcab1' => 'L',
			'ccy1' => 1,
			'nilai1' => 1,
			'norek2' => 'Lore',
			'kdcab2' => 'L',
			'ccy2' => 1,
			'nilai2' => 1,
			'costc1' => 1,
			'costc2' => 1,
			'costdept1' => 'Lorem ip',
			'costdept2' => 'Lorem ip',
			'kurs' => 1,
			'ket1' => 'Lorem ipsum dolor sit amet',
			'ket2' => 'Lorem ipsum dolor sit amet',
			'ket3' => 'Lorem ipsum dolor sit amet',
			'rc' => 1,
			'st' => 'L',
			'trs_dt' => '2012-04-04 21:57:57',
			'trs_tm' => 1,
			'posting' => 1,
			'posting_date' => '2012-04-04 21:57:58'
		),
	);
}
?>