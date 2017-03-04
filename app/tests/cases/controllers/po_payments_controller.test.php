<?php
/* PoPayments Test cases generated on: 2011-04-21 10:37:25 : 1303353445*/
App::import('Controller', 'PoPayments');

class TestPoPaymentsController extends PoPaymentsController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class PoPaymentsControllerTestCase extends CakeTestCase {
	var $fixtures = array('app.po_payment', 'app.po', 'app.supplier', 'app.bank_account_type', 'app.invoice', 'app.currency', 'app.asset', 'app.purchase', 'app.warranty', 'app.requester', 'app.department', 'app.ayda', 'app.ayda_status', 'app.ayda_type', 'app.ayda_insurance', 'app.ayda_doc', 'app.location', 'app.asset_detail', 'app.asset_category', 'app.account', 'app.account_type', 'app.account_global', 'app.asset_category_type', 'app.condition', 'app.movement_detail', 'app.movement', 'app.movement_status', 'app.user', 'app.group', 'app.menu', 'app.groups_menu', 'app.npb', 'app.npb_status', 'app.request_types', 'app.npb_detail', 'app.item', 'app.unit', 'app.npb_fulfillment', 'app.npb_supplier', 'app.npbs_po', 'app.journal_transaction', 'app.journal_template', 'app.journal_group', 'app.journal_template_detail', 'app.journal_position', 'app.currency_detail', 'app.bank_account', 'app.invoice_status', 'app.invoice_detail', 'app.invoices_po', 'app.invoices_purchase', 'app.po_status', 'app.po_detail', 'app.config');

	function startTest() {
		$this->PoPayments =& new TestPoPaymentsController();
		$this->PoPayments->constructClasses();
	}

	function endTest() {
		unset($this->PoPayments);
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