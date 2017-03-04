<?php
/* FamsysInterface Test cases generated on: 2012-04-05 07:25:54 : 1333585554*/
App::import('Model', 'FamsysInterface');

class FamsysInterfaceTestCase extends CakeTestCase {
	var $fixtures = array('app.famsys_interface');

	function startTest() {
		$this->FamsysInterface =& ClassRegistry::init('FamsysInterface');
	}

	function endTest() {
		unset($this->FamsysInterface);
		ClassRegistry::flush();
	}

}
?>