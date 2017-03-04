<?php
/* RequestType Test cases generated on: 2011-03-09 10:45:38 : 1299642338*/
App::import('Model', 'RequestType');

class RequestTypeTestCase extends CakeTestCase {
	var $fixtures = array('app.request_type', 'app.npb', 'app.department', 'app.ayda', 'app.ayda_status', 'app.ayda_type', 'app.ayda_insurance', 'app.ayda_doc', 'app.location', 'app.asset', 'app.purchase', 'app.warranty', 'app.requester', 'app.supplier', 'app.asset_category', 'app.account', 'app.account_global', 'app.asset_detail', 'app.condition', 'app.currency', 'app.po', 'app.po_status', 'app.po_detail', 'app.npb_detail', 'app.item', 'app.npb_fulfillment', 'app.npbs_po', 'app.invoice', 'app.invoice_status', 'app.invoice_detail', 'app.invoices_po', 'app.invoices_purchase', 'app.currency_detail', 'app.user', 'app.group', 'app.menu', 'app.groups_menu', 'app.journal_transaction', 'app.journal_template', 'app.journal_group', 'app.journal_template_detail', 'app.journal_position', 'app.npb_status', 'app.request_types', 'app.npb_supplier');

	function startTest() {
		$this->RequestType =& ClassRegistry::init('RequestType');
	}

	function endTest() {
		unset($this->RequestType);
		ClassRegistry::flush();
	}

}
?>