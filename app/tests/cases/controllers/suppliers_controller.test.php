<?php
/* Suppliers Test cases generated on: 2011-01-13 13:55:28 : 1294901728*/
App::import('Controller', 'Suppliers');

class TestSuppliersController extends SuppliersController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class SuppliersControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.supplier');

	function startTest() {
		$this->Suppliers =& new TestSuppliersController();
		$this->Suppliers->constructClasses();
	}

	function endTest() {
		unset($this->Suppliers);
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