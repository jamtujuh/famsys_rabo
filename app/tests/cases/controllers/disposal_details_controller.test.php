<?php
/* DisposalDetails Test cases generated on: 2011-02-23 17:07:55 : 1298455675*/
App::import('Controller', 'DisposalDetails');

class TestDisposalDetailsController extends DisposalDetailsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class DisposalDetailsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.disposal_detail', 'app.disposal', 'app.department', 'app.ayda', 'app.ayda_status', 'app.ayda_type', 'app.ayda_insurance', 'app.ayda_doc', 'app.location', 'app.asset', 'app.purchase', 'app.warranty', 'app.requester', 'app.supplier', 'app.npb', 'app.npb_status', 'app.npb_detail', 'app.po', 'app.po_status', 'app.po_detail', 'app.asset_category', 'app.account', 'app.account_global', 'app.asset_detail', 'app.condition', 'app.currency', 'app.currency_detail', 'app.npbs_po', 'app.invoice', 'app.invoice_status', 'app.invoice_detail', 'app.invoices_po', 'app.invoices_purchase', 'app.item', 'app.npb_supplier', 'app.user', 'app.group', 'app.menu', 'app.groups_menu', 'app.config');

	function startTest() {
		$this->DisposalDetails =& new TestDisposalDetailsController();
		$this->DisposalDetails->constructClasses();
	}

	function endTest() {
		unset($this->DisposalDetails);
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