<?php
/* Movement Fixture generated on: 2011-02-23 16:19:24 : 1298452764 */
class MovementFixture extends CakeTestFixture {
	var $name = 'Movement';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'doc_date' => array('type' => 'date', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'no' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'unique', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'source_deptartment_id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 40, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'dest_department_id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 40, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'created_by' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'notes' => array('type' => 'text', 'null' => false, 'default' => NULL, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'movement_status_id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 40, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'no' => array('column' => 'no', 'unique' => 1), 'doc_date' => array('column' => array('doc_date', 'created_by', 'movement_status_id'), 'unique' => 0)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'doc_date' => '2011-02-23',
			'no' => 'Lorem ip',
			'source_deptartment_id' => 'Lorem ipsum dolor sit amet',
			'dest_department_id' => 'Lorem ipsum dolor sit amet',
			'created_by' => 'Lorem ipsum dolor sit amet',
			'notes' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'movement_status_id' => 'Lorem ipsum dolor sit amet'
		),
	);
}
?>