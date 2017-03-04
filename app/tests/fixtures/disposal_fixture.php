<?php
/* Disposal Fixture generated on: 2011-02-23 17:04:36 : 1298455476 */
class DisposalFixture extends CakeTestFixture {
	var $name = 'Disposal';

	var $fields = array(
		'Id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'doc_date' => array('type' => 'date', 'null' => false, 'default' => NULL),
		'no' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'unique', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'department_id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 20, 'key' => 'index', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'created_by' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'notes' => array('type' => 'text', 'null' => false, 'default' => NULL, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'disposal_status_id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'disposal_type_id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'indexes' => array('PRIMARY' => array('column' => 'Id', 'unique' => 1), 'no' => array('column' => 'no', 'unique' => 1), 'department_id' => array('column' => 'department_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'Id' => 1,
			'doc_date' => '2011-02-23',
			'no' => 'Lorem ip',
			'department_id' => 'Lorem ipsum dolor ',
			'created_by' => 'Lorem ipsum dolor sit amet',
			'notes' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'disposal_status_id' => 'Lorem ipsum dolor sit amet',
			'disposal_type_id' => 'Lorem ipsum dolor sit amet'
		),
	);
}
?>