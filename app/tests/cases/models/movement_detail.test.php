<?php
/* MovementDetail Test cases generated on: 2011-02-23 16:22:14 : 1298452934*/
App::import('Model', 'MovementDetail');

class MovementDetailTestCase extends CakeTestCase {
	var $fixtures = array('app.movement_detail', 'app.movement', 'app.asset', 'app.purchase', 'app.warranty', 'app.requester', 'app.department', 'app.ayda', 'app.ayda_status', 'app.ayda_type', 'app.ayda_insurance', 'app.ayda_doc', 'app.location', 'app.asset_detail', 'app.asset_category', 'app.account', 'app.account_global', 'app.condition', 'app.user', 'app.group', 'app.menu', 'app.groups_menu', 'app.npb', 'app.npb_status', 'app.supplier', 'app.npb_detail', 'app.po', 'app.po_status', 'app.po_detail', 'app.currency', 'app.currency_detail', 'app.npbs_po', 'app.invoice', 'app.invoice_status', 'app.invoice_detail', 'app.invoices_po', 'app.invoices_purchase', 'app.item', 'app.npb_supplier');

	function startTest() {
		$this->MovementDetail =& ClassRegistry::init('MovementDetail');
	}

	function endTest() {
		unset($this->MovementDetail);
		ClassRegistry::flush();
	}

}
?>