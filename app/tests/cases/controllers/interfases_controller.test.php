<?php
/* Interfases Test cases generated on: 2012-04-04 21:58:19 : 1333551499*/
App::import('Controller', 'Interfases');

class TestInterfasesController extends InterfasesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class InterfasesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.interfase', 'app.config');

	function startTest() {
		$this->Interfases =& new TestInterfasesController();
		$this->Interfases->constructClasses();
	}

	function endTest() {
		unset($this->Interfases);
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