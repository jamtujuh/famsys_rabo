<?php
/* JournalInterfases Test cases generated on: 2012-03-15 18:43:11 : 1331811791*/
App::import('Controller', 'JournalInterfases');

class TestJournalInterfasesController extends JournalInterfasesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class JournalInterfasesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.journal_interfase', 'app.config');

	function startTest() {
		$this->JournalInterfases =& new TestJournalInterfasesController();
		$this->JournalInterfases->constructClasses();
	}

	function endTest() {
		unset($this->JournalInterfases);
		ClassRegistry::flush();
	}

	function testIndex() {

	}

	function testView() {

	}

	function testAdd() {

	}

	function testEdit() {

	}

	function testDelete() {

	}

}
?>