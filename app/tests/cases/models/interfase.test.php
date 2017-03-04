<?php
/* Interfase Test cases generated on: 2012-04-04 21:57:58 : 1333551478*/
App::import('Model', 'Interfase');

class InterfaseTestCase extends CakeTestCase {
	var $fixtures = array('app.interfase');

	function startTest() {
		$this->Interfase =& ClassRegistry::init('Interfase');
	}

	function endTest() {
		unset($this->Interfase);
		ClassRegistry::flush();
	}

}
?>