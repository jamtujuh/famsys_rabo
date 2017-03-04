<?php
/* FamsysInterfaces Test cases generated on: 2012-04-05 07:26:13 : 1333585573*/
App::import('Controller', 'FamsysInterfaces');

class TestFamsysInterfacesController extends FamsysInterfacesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class FamsysInterfacesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.famsys_interface', 'app.config');

	function startTest() {
		$this->FamsysInterfaces =& new TestFamsysInterfacesController();
		$this->FamsysInterfaces->constructClasses();
	}

	function endTest() {
		unset($this->FamsysInterfaces);
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