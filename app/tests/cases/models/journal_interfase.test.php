<?php
/* JournalInterfase Test cases generated on: 2012-03-15 18:42:42 : 1331811762*/
App::import('Model', 'JournalInterfase');

class JournalInterfaseTestCase extends CakeTestCase {
	var $fixtures = array('app.journal_interfase');

	function startTest() {
		$this->JournalInterfase =& ClassRegistry::init('JournalInterfase');
	}

	function endTest() {
		unset($this->JournalInterfase);
		ClassRegistry::flush();
	}

}
?>