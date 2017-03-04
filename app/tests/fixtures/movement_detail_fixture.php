<?php
/* MovementDetail Fixture generated on: 2011-02-23 16:22:11 : 1298452931 */
class MovementDetailFixture extends CakeTestFixture {
	var $name = 'MovementDetail';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'movement_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'asset_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'notes' => array('type' => 'text', 'null' => false, 'default' => NULL, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'movement_id' => array('column' => array('movement_id', 'asset_id'), 'unique' => 0)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'movement_id' => 1,
			'asset_id' => 1,
			'notes' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.'
		),
	);
}
?>