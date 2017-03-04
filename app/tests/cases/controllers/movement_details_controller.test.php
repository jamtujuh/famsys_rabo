<?php
/* MovementDetails Test cases generated on: 2011-02-23 16:23:13 : 1298452993*/
App::import('Controller', 'MovementDetails');

class TestMovementDetailsController extends MovementDetailsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class MovementDetailsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.movement_detail', 'app.movement', 'app.asset', 'app.purchase', 'app.warranty', 'app.requester', 'app.department', 'app.ayda', 'app.ayda_status', 'app.ayda_type', 'app.ayda_insurance', 'app.ayda_doc', 'app.location', 'app.asset_detail', 'app.asset_category', 'app.account', 'app.account_global', 'app.condition', 'app.user', 'app.group', 'app.menu', 'app.groups_menu', 'app.npb', 'app.npb_status', 'app.supplier', 'app.npb_detail', 'app.po', 'app.po_status', 'app.po_detail', 'app.currency', 'app.currency_detail', 'app.npbs_po', 'app.invoice', 'app.invoice_status', 'app.invoice_detail', 'app.invoices_po', 'app.invoices_purchase', 'app.item', 'app.npb_supplier', 'app.config');

	function startTest() {
		$this->MovementDetails =& new TestMovementDetailsController();
		$this->MovementDetails->constructClasses();
	}

	function endTest() {
		unset($this->MovementDetails);
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