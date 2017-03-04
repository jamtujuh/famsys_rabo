<?php
/* Warranties Test cases generated on: 2011-01-18 05:41:06 : 1295304066*/
App::import('Controller', 'Warranties');

class TestWarrantiesController extends WarrantiesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class WarrantiesControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.warranty', 'app.purchase', 'app.requester', 'app.department', 'app.supplier', 'app.asset', 'app.asset_category', 'app.currency', 'app.currency_detail', 'app.asset_detail', 'app.condition', 'app.location');

	function startTest() {
		$this->Warranties =& new TestWarrantiesController();
		$this->Warranties->constructClasses();
	}

	function endTest() {
		unset($this->Warranties);
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