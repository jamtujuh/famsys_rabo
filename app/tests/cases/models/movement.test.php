<?php
/* Movement Test cases generated on: 2011-02-23 16:19:27 : 1298452767*/
App::import('Model', 'Movement');

class MovementTestCase extends CakeTestCase {
	var $fixtures = array('app.movement', 'app.movement_detail', 'app.asset', 'app.purchase', 'app.warranty', 'app.requester', 'app.department', 'app.ayda', 'app.ayda_status', 'app.ayda_type', 'app.ayda_insurance', 'app.ayda_doc', 'app.location', 'app.asset_detail', 'app.asset_category', 'app.account', 'app.account_global', 'app.condition', 'app.user', 'app.group', 'app.menu', 'app.groups_menu', 'app.npb', 'app.npb_status', 'app.supplier', 'app.npb_detail', 'app.po', 'app.po_status', 'app.po_detail', 'app.currency', 'app.currency_detail', 'app.npbs_po', 'app.invoice', 'app.invoice_status', 'app.invoice_detail', 'app.invoices_po', 'app.invoices_purchase', 'app.item', 'app.npb_supplier');

	function startTest() {
		$this->Movement =& ClassRegistry::init('Movement');
	}

	function endTest() {
		unset($this->Movement);
		ClassRegistry::flush();
	}

}
?>