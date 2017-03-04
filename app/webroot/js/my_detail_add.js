function setValue(element,attr) { 
    var e = document.getElementById(element); 
    if (e==null){return;} 
    if (attr == -1) {e.value = '';}  
    else if (attr != null && attr != ' ' && attr != '') {e.value = attr;} 
}
function setItemValues(text, li) { 
    setValue('NpbDetailItemId',li.getAttribute('item_id')); 
}
function setAssetValues(text, li) { 
    setValue('AssetItemId',li.getAttribute('item_id')); 
}
function setReklassAssetValues(text, li) { 
    setValue('ReklassAssetId',li.getAttribute('asset_id')); 
}
function setPoItemValues(text, li) { 
    setValue('PoDetailItemId',li.getAttribute('item_id')); 
}
function setInventoryLedgerItemValues(text, li) { 
    setValue('InventoryLedgerItemId',li.getAttribute('item_id')); 
}
function setSupplierValues(text, li) { 
    setValue('PoSupplierId',li.getAttribute('supplier_id')); 
}
function setSupplierReturValues(text, li) { 
    setValue('SupplierReturSupplierId',li.getAttribute('supplier_id')); 
}
function setSupplierReplaceValues(text, li) { 
    setValue('SupplierReplaceSupplierId',li.getAttribute('supplier_id')); 
}
function setCurrencyValues(text, li) { 
    setValue('NpbDetailCurrencyId',li.getAttribute('currency_id')); 
}
function setUsageItemValues(text, li) { 
    setValue('UsageDetailItemId',li.getAttribute('item_id')); 
}
function setPoDetailItemValues(text, li) { 
    setValue('PoDetailItemId',li.getAttribute('item_id')); 
}
function setReturItemValues(text, li) { 
    setValue('ReturDetailItemId',li.getAttribute('item_id')); 
}
function setOutlogReturValues(text, li) { 
    setValue('OutlogReturId',li.getAttribute('retur_id')); 
}
function setSupplierReturReturValues(text, li) { 
    setValue('SupplierReturReturId',li.getAttribute('retur_id')); 
}
function setSupplierReplaceSupplierReturValues(text, li) { 
    setValue('SupplierReplaceSupplierReturId',li.getAttribute('supplier_retur_id')); 
}
function setReklassItemValues(text, li) { 
    setValue('ReklassItemId',li.getAttribute('item_id')); 
}
function setSupplierReturItemValues(text, li) { 
    setValue('SupplierReturDetailItemId',li.getAttribute('item_id')); 
}
function setSourceCostCenterValues(text, li) { 
    setValue('MovementDetailSourceCostCenterId',li.getAttribute('cost_center_id')); 
}
function setDestCostCenterValues(text, li) { 
    setValue('MovementDetailDestCostCenterId',li.getAttribute('cost_center_id')); 
}
function setSourceCostCenterMovementValues(text, li) { 
    setValue('MovementSourceCostCenterId',li.getAttribute('cost_center_id')); 
}
function setDestCostCenterMovementValues(text, li) { 
    setValue('MovementDestCostCenterId',li.getAttribute('cost_center_id')); 
}
function setNpbCostCenterValues(text, li) { 
    setValue('NpbCostCenterId',li.getAttribute('cost_center_id')); 
}
function setNpbDetailCostCenterValues(text, li) { 
    setValue('NpbDetailCostCenterId',li.getAttribute('cost_center_id')); 
}
function setFaReturCostCenterValues(text, li) { 
    setValue('FaReturCostCenterId',li.getAttribute('cost_center_id')); 
}
function setFaSupplierReturCostCenterValues(text, li) { 
    setValue('FaSupplierReturCostCenterId',li.getAttribute('cost_center_id')); 
}
function setAssetCostCenterPurchaseValues(text, li) { 
    setValue('AssetCostCenterId',li.getAttribute('cost_center_id')); 
}
function setAssetCostCenterValues(text, li) { 
    setValue('AssetCostCenterId',li.getAttribute('cost_center_id')); 
}
function setDisposalDetailCostCenterValues(text, li) { 
    setValue('DisposalDetailCostCenterId',li.getAttribute('cost_center_id')); 
}
function setSupplierReplaceCostCenterValues(text, li) { 
    setValue('SupplierReplaceCostCenterId',li.getAttribute('cost_center_id')); 
}
function setOutlogCostCenterValues(text, li) { 
    setValue('OutlogCostCenterId',li.getAttribute('cost_center_id')); 
}
function setInventoryLedgerCostCenterValues(text, li) { 
    setValue('InventoryLedgerCostCenterId',li.getAttribute('cost_center_id')); 
}
function setAssetDetailCostCenterValues(text, li) { 
    setValue('AssetDetailCostCenterId',li.getAttribute('cost_center_id')); 
}
function setUserCostCenterValues(text, li) { 
    setValue('UserCostCenterId',li.getAttribute('cost_center_id')); 
}
function setDisposalCostCenterValues(text, li) { 
    setValue('DisposalCostCenterId',li.getAttribute('cost_center_id')); 
}
function setFaSupplierReturPoValues(text, li) { 
    setValue('FaSupplierReturPoId',li.getAttribute('po_id')); 
}
function setDeliveryOrderPoValues(text, li) { 
    setValue('DeliveryOrderPoId',li.getAttribute('po_id')); 
}

function setSupplierReplaceItemValues(text, li) { 
    setValue('SupplierReplaceDetailItemId',li.getAttribute('item_id')); 
}
function appendNpbDetail(response){
	var json = response.responseText.evalJSON();
	var status = json.status;
	if(status=='failed')
	{
		alert(json.msg);
		return;
	}
	var npbDetail 	= json.data.NpbDetail;
	var unit 		= json.data.Unit;
	var currency 	= json.data.Currency;
	var po 			= json.data.Po;
	var processType = json.data.ProcessType;
	var count 		= json.count;
	var lastCount 	= json.lastCount;
	var newTr 		= '<tr><td>'+ count + '</td>';
	newTr += '<td>' + npbDetail.item_code + '</td>';
	newTr += '<td>' + npbDetail.item_name + '</td>';
	newTr += '<td>' + npbDetail.qty + '</td>';
	newTr += '<td>' + unit.name + '</td>';	
	newTr += '<td>' + currency.name + '</td>';
	newTr += '<td>' + add_commas(npbDetail.price_cur) + '</td>';
	newTr += '<td>' + add_commas(npbDetail.amount_cur) + '</td>';
	newTr += '<td>' + npbDetail.brand + '</td>';
	newTr += '<td>' + npbDetail.type + '</td>';
	newTr += '<td>' + npbDetail.color + '</td>';
	newTr += '<td class="actions">'+ (processType.name?processType.name:"") +' <a onclick="return confirm(\'Are you sure to delete #'+npbDetail.id+' ?\')" href="'+base_url+'/npb_details/delete/'+npbDetail.id+'">Delete</a></td>';
	newTr += '</tr>';
	$('newRecord').insert({before:newTr});
	$('ItemName').value='';
	$('NpbDetailQty').value='';
	$('NpbDetailCurrencyId').value='';
//	$('NpbDetailPrice').value='';
	$('NpbDetailBrand').value='';
	$('NpbDetailType').value='';
	$('NpbDetailColor').value='';
	$('NpbDetailItemId').value='';
}
function appendDeliveryOrderDetail(response){
	var json = response.responseText.evalJSON();
	var status = json.status;
	if(status=='failed')
	{
		alert(json.msg);
		return;
	}
	var npbDetail = json.data.NpbDetail;
	var npb = json.data.Npb;
	var lastCount = json.lastCount;
	var newTr = '<tr><td>'+ count + '</td>';
	newTr += '<td>1</td>';
	newTr += '<td>2</td>';
	newTr += '<td>3</td>';
	newTr += '<td>4</td>';
	newTr += '<td>5</td>';	
	newTr += '<td>6</td>';
	newTr += '<td class="actions"><a onclick="return confirm(\'Are you sure to delete #'+deliveryOrder.no+' ?\')" href="'+base_url+'/delivery_orders/delete/'+deliveryOrder.id+'">Delete</a></td>';
	newTr += '</tr>';
	$('newRecord').insert({before:newTr});
	$('NpbNo').value='';
	$('NpbDetailItemCode').value='';
	$('NpbDetailItemName').value='';
	$('NpbDetailQty').value='';
	$('DeliveryOrderNo').value='';
	$('DeliveryOrderQtyReceived').value='';
}
function appendPoDetail(response){
	var json = response.responseText.evalJSON();
	var status = json.status;
	if(status=='failed')
	{
		alert(json.msg);
		return;
	}
	var poDetail = json.data.PoDetail;
	var assetCategory = json.data.AssetCategory;
	var department = json.data.Department;
	var po = json.data.Po;
	var item = json.data.Item;
	var count = json.count;
	var newTr = '<tr><td>'+count+'</td>';
	newTr += '<td>' + department.name + '</td>';
	newTr += '<td>' + assetCategory.name + '</td>';
	newTr += '<td>' + poDetail.item_code + '</td>';
	newTr += '<td>' + poDetail.name + '</td>';
	newTr += '<td>' + poDetail.brand + '</td>';
	newTr += '<td>' + poDetail.type + '</td>';
	newTr += '<td>' + poDetail.color + '</td>';
	newTr += '<td class="center">' + poDetail.qty + '</td>';
	newTr += '<td class="center">' + poDetail.qty_received + '</td>';
	newTr += '<td class="number">' + add_commas(poDetail.price_cur) + '</td>';
	newTr += '<td class="number"><div id="amount_cur.'+poDetail.id+'">' + add_commas(poDetail.amount_cur) + '</div></td>';
	newTr += '<td class="number">' + add_commas(poDetail.discount_cur) + '</td>';
	newTr += '<td class="number"><div id="amount_after_disc_cur.'+poDetail.id+'">' + add_commas(poDetail.amount_after_disc_cur) + '</div></td>';
	newTr += '<td><img src="'+base_url+'/img/' + poDetail.is_vat + '.gif"></td>';
	newTr += '<td>' + poDetail.npb_id + '</td>';
	newTr += '<td class="actions"><a href="'+base_url+'/po_details/delete/'+poDetail.id+'">Delete</a></td>';
	newTr += '</tr>';
	$('newRecord').insert({before:newTr});
	if(item.name) {
		$('ItemName').value='';
	} else  {
		$('PoDetailName').value='';
	}
	$('PoDetailQty').value='1';
}
function appendAsset(response){
	var json = response.responseText.evalJSON();
	var status = json.status;
	if(status=='failed')
	{
		alert(json.msg);
		return;
	}
	var asset 			= json.data.Asset;
	var assetCategory 	= json.data.AssetCategory;
	var department 		= json.data.Department;
	var businessType 	= json.data.BusinessType;
	var costCenter 		= json.data.CostCenter;
	var currency 		= json.data.Currency;
	var count 			= json.count;
	
	var newTr = '<tr><td>'+ count + '</td>';
	newTr += '<td>' + department.name + '</td>';
	newTr += '<td>' + businessType.name + '</td>';
	newTr += '<td>' + costCenter.name + '</td>';
	newTr += '<td>' + assetCategory.name + '</td>';
	newTr += '<td class="left">' + asset.code + '</td>';
	newTr += '<td class="left">' + asset.item_code + '</td>';
	newTr += '<td>' + asset.name + '</td>';
	//newTr += '<td>' + asset.konfigurasi + '</td>';
	newTr += '<td>' + asset.brand + '</td>';
	newTr += '<td>' + asset.type + '</td>';
	newTr += '<td>' + asset.color + '</td>';
	newTr += '<td>' + asset.qty + '</td>';
	newTr += '<td class="left">' + currency.name + '</td>';
	newTr += '<td class="number">' + add_commas(asset.price) + '&nbsp;</td>';
	newTr += '<td class="number">' + add_commas(asset.amount) + '&nbsp;</td>';
	newTr += '<td class="center">' + asset.maksi + '&nbsp;</td>';
	newTr += '<td class="number">' + add_commas(asset.depbln) + '&nbsp;</td>';
	newTr += '<td class="left">' + asset.date_of_purchase + '&nbsp;</td>';
	newTr += '<td class="actions"><a href="'+base_url+'/assets/view/'+asset.id+'">View</a>&nbsp<a href="'+base_url+'/assets/delete/'+asset.id+'">Delete</a></td>';
	newTr += '</tr>';
	$('newRecord').insert({before:newTr});
	$('AssetCostCenterId').value='';
	$('CostCenterName').value='';
	$('AssetUmurek').value='5';
	$('AssetItemId').value='';
	$('ItemName').value='';
	//$('AssetKonfigurasi').value='';
	$('AssetBrand').value='';
	$('AssetType').value='';
	$('AssetColor').value='';	
	$('AssetQty').value='1';
	$('AssetCurrencyId').value='1';
	$('AssetPriceCur').value='';
	$('AssetAmountCur').value='';
}
function appendBankAccount(response){
	var json = response.responseText.evalJSON();
	var bankAccount = json.data.BankAccount;
	var bankAccountType = json.bankAccountType;
	var currency = json.currency;
	var count = json.count;
	var newTr = '<tr><td>' + count + '</td>';
	newTr += '<td>' + bankAccount.bank_name + '</td>';
	newTr += '<td>' + bankAccount.bank_account_no + '</td>';
	newTr += '<td>' + bankAccount.bank_account_name + '</td>';
	newTr += '<td>' + bankAccountType + '</td>';
	newTr += '<td>' + currency + '</td>';
	newTr += '<td class="actions"><a href="'+base_url+'/bank_accounts/delete/'+bankAccount.id+'">Delete</a></td>';
	newTr += '</tr>';
	$('newRecord').insert({before:newTr});
}
function appendDepartmentSub(response){
	var json = response.responseText.evalJSON();
	var deptsub = json.data.DepartmentSub;
	var count = json.count;
	var newTr = '<tr><td>' + count + '</td>';
	newTr += '<td>' + deptsub.code + '</td>';
	newTr += '<td>' + deptsub.name + '</td>';
	newTr += '<td class="actions"><a onclick="return confirm(\'Are you sure to delete #'+deptsub.id+' ?\')" href="'+base_url+'/department_subs/delete/'+deptsub.id+'">Delete</a></td>';
	newTr += '</tr>';
	$('newRecord').insert({before:newTr});
	$('DepartmentSubCode').value='';
	$('DepartmentSubName').value='';
}
function appendLocation(response){
	var json = response.responseText.evalJSON();
	var location = json.data.Location;
	var count = json.count;
	var newTr = '<tr><td>' + count + '</td>';
	newTr += '<td>' + location.code + '</td>';
	newTr += '<td>' + location.name + '</td>';
	newTr += '<td class="actions"><a onclick="return confirm(\'Are you sure to delete #'+location.id+' ?\')" href="'+base_url+'/locations/delete/'+location.id+'">Delete</a></td>';
	newTr += '</tr>';
	$('newLocationRecord').insert({before:newTr});
	$('LocationCode').value='';
	$('LocationName').value='';
}

function appendDepartmentUnit(response){
	var json = response.responseText.evalJSON();
	var deptunit = json.data.DepartmentUnit;
	var count = json.count;
	var newTr = '<tr><td>' + count + '</td>';
	newTr += '<td>' + deptunit.code + '</td>';
	newTr += '<td>' + deptunit.name + '</td>';
	newTr += '<td class="actions"><a onclick="return confirm(\'Are you sure to delete #'+deptunit.id+' ?\')" href="'+base_url+'/department_units/delete/'+deptunit.id+'">Delete</a></td>';
	newTr += '</tr>';
	$('newRecord').insert({before:newTr});
	$('DepartmentUnitCode').value='';
	$('DepartmentUnitName').value='';
}
function setPoValuesAfterInplace(response){
	var json = response.responseText.evalJSON();
	var poDetail = json.data.PoDetail;
	
}
function appendInvoiceDetail(response){
	var json = response.responseText.evalJSON();
	var invoiceDetail = json.data.InvoiceDetail;
	var assetCategory = json.data.AssetCategory;
	var department = json.data.Department;
	var invoice = json.data.Invoice;
	var count = json.count;
	var newTr = '<tr><td>'+count+'</td>';
	newTr += '<td>' + department.name + '</td>';
	newTr += '<td>' + assetCategory.name + '</td>';
	newTr += '<td>' + invoiceDetail.name + '</td>';
	newTr += '<td>' + invoiceDetail.brand + '</td>';
	newTr += '<td>' + invoiceDetail.type + '</td>';
	newTr += '<td>' + invoiceDetail.color + '</td>';
	newTr += '<td class="center">' + invoiceDetail.qty + '</td>';
	newTr += '<td class="number">' + add_commas(invoiceDetail.price_cur) + '</td>';
	newTr += '<td class="number">' + add_commas(invoiceDetail.price) + '</td>';
	newTr += '<td class="number">' + add_commas(invoiceDetail.amount) + '</td>';
	newTr += '<td class="number">' + add_commas(invoiceDetail.discount) + '</td>';
	newTr += '<td class="number">' + add_commas(invoiceDetail.amount_after_disc) + '</td>';
	newTr += '<td><img src="'+base_url+'/img/' + invoiceDetail.is_vat + '.gif"></td>';
	newTr += '<td><img src="'+base_url+'/img/' + invoiceDetail.is_wht + '.gif"></td>';
	newTr += '<td class="actions"><a href="'+base_url+'/invoice_details/delete/'+invoiceDetail.id+'">Delete</a></td>';
	newTr += '<td>' + invoiceDetail.npb_id + '</td>';
	newTr += '<td>' + invoiceDetail.po_id + '</td>';
	newTr += '</tr>';
	$('newRecord').insert({before:newTr});
}
function recalcPo(response){
	var json = response.responseText.evalJSON();
	var po = json.data.Po;
	var poDetails = json.data.PoDetail;
	var poPayments = json.data.PoPayment;
	$('PoTotalDiv').update(add_commas(po.total_cur));
	$('sub_total').update(add_commas(po.sub_total_cur));
	$('discount').update(add_commas(po.discount_cur));
	$('after_disc').update(add_commas(po.after_disc_cur));
	$('vat_base').update(add_commas(po.vat_base_cur));
	$('vat_total').update(add_commas(po.vat_total_cur));
	$('total').update(add_commas(po.total_cur));
	poDetails.each(function(poDetail){
		$('amount_cur.'+ poDetail.id).update(add_commas(poDetail.amount_cur));
		$('amount_after_disc_cur.'+ poDetail.id).update(add_commas(poDetail.amount_after_disc_cur));
	});
	$('total_term_percent').update(add_commas(po.v_total_term_percent) + '%');
	$('total_amount_due').update(add_commas(po.v_total_amount_due));
	$('total_amount_paid').update(add_commas(po.v_total_amount_paid));
	poPayments.each(function(poPayment){
		$('amount_due.'+ poPayment.id).update(add_commas(poPayment.amount_due));
		$('amount_paid.'+ poPayment.id).update(add_commas(poPayment.amount_paid));
	});
}
function recalcDeliveryOrder(response){
	var json = response.responseText.evalJSON();
	var deliveryOrderDetails = json.data.DeliveryOrderDetail;
	deliveryOrderDetails.each(function(deliveryOrderDetail){
		$('qty_balance.'+ deliveryOrderDetail.id).update(parseInt(deliveryOrderDetail.qty)-parseInt(deliveryOrderDetail.qty_received));
	});
}
function recalcOutlog(response){
	var json = response.responseText.evalJSON();
	var data = json.data.NpbDetail;
	data.each(function(d){
		$('qty_filled.' + d.id).update(parseInt(d.qty_filled));
	});
}
function recalcInvoice(response){
	var json = response.responseText.evalJSON();
	var invoice = json.data.Invoice;
	var invoiceDetails = json.data.InvoiceDetail;
	$('InvoiceTotalDiv').update(add_commas(invoice.total));
	$('sub_total').update(add_commas(invoice.sub_total));
	$('discount').update(add_commas(invoice.discount));
	$('after_disc').update(add_commas(invoice.after_disc));
	$('vat_base').update(add_commas(invoice.vat_base));
	$('vat_total').update(add_commas(invoice.vat_total));
	$('wht_base').update(add_commas(invoice.wht_base));
	$('wht_total').update(add_commas(invoice.wht_total));
	$('total').update(add_commas(invoice.total));
	invoiceDetails.each(function(invoiceDetail){
		$('price.'+ invoiceDetail.id).update(add_commas(invoiceDetail.price));
		$('amount.'+ invoiceDetail.id).update(add_commas(invoiceDetail.amount));
		$('discount.'+ invoiceDetail.id).update(add_commas(invoiceDetail.discount));
		$('amount_after_disc.'+ invoiceDetail.id).update(add_commas(invoiceDetail.amount_after_disc));
	});
}
function recalcNpb(response){
	var json = response.responseText.evalJSON();
	var npb = json.data.Npb;
	var npbDetails = json.data.NpbDetail;
	npbDetails.each(function(npbDetail){
		places = npbDetail.currency_id==1?-1:2;
		$('amount_cur.'+ npbDetail.id).update(add_commas(npbDetail.amount_cur, places));
	});
}
function appendNpbAttachment(response){
	var json = response.responseText.evalJSON();
	var status = json.status;
	if(status=='failed')
	{
		alert(json.msg);
		return;
	}
	var attachment = json.data.Attachment;
	var count = json.count;
	var newTr = '<tr><td>'+count + '</td>';
	newTr += '<td>' + attachment.name + '</td>';
	newTr += '<td>' + attachment.attachment_file_name + '</td>';
	newTr += '<td class="actions"><a href="'+base_url+'/attachments/delete/'+attachment.id+'">Delete</a>';
	newTr += '<a target="blank" href="'+base_url+'/attachments/view/'+attachment.id+'">View</a></td>';
	newTr += '</tr>';
	$('newAttachmentRecord').insert({before:newTr});
	$('AttachmentName').value='';
	$('AttachmentAttachmentFileName').value='';
}
function appendUsageDetail(response){
	var json = response.responseText.evalJSON();
	var status = json.status;
	if(status=='failed')
	{
		alert(json.msg);
		return;
	}
	var usageDetail = json.data.UsageDetail;
	var assetCategory = json.data.Item.AssetCategory;
	var unit = json.data.Item.Unit;
	var item = json.data.Item;
	var count = json.count;
	var newTr = '<tr><td>'+count + '</td>';
	newTr += '<td>' + assetCategory.name + '</td>';
	newTr += '<td>' + item.code + ' - ' + item.name + '</td>';
	newTr += '<td>' + usageDetail.qty + '</td>';
	newTr += '<td>' + usageDetail.descr + '</td>';
	newTr += '<td>' + unit.name + '</td>';
	newTr += '<td class="number">' + add_commas(usageDetail.price) + '</td>';
	newTr += '<td class="number">' + add_commas(usageDetail.amount) + '</td>';
	newTr += '<td class="actions"><a onclick="return confirm(\'Are you sure to delete #'+usageDetail.id+' ?\')" href="'+base_url+'/usage_details/delete/'+usageDetail.id+'">Delete</a></td>';
	newTr += '</tr>';
	$('newRecord').insert({before:newTr});
	$('ItemName').value='';
	$('UsageDetailQty').value='';
	$('UsageDetailDescr').value='';
	$('UsageDetailItemId').value='';	
}

function appendReturDetail(response){
	var json = response.responseText.evalJSON();
	var status = json.status;
	if(status=='failed')
	{
		alert(json.msg);
		return;
	}
	var returDetail = json.data.ReturDetail;
	var assetCategory = json.data.Item.AssetCategory;
	var unit = json.data.Item.Unit;
	var item = json.data.Item;
	var count = json.count;
	var newTr = '<tr><td>'+count + '</td>';
	newTr += '<td>' + assetCategory.name + '</td>';
	newTr += '<td>' + item.code + ' - ' + item.name + '</td>';
	newTr += '<td>' + returDetail.qty + '</td>';
	newTr += '<td>' + returDetail.descr + '</td>';
	newTr += '<td>' + unit.name + '</td>';
	newTr += '<td class="number">' + add_commas(returDetail.price) + '</td>';
	newTr += '<td class="number">' + add_commas(returDetail.amount) + '</td>';
	newTr += '<td class="actions"><a onclick="return confirm(\'Are you sure to delete #'+returDetail.id+' ?\')" href="'+base_url+'/retur_details/delete/'+returDetail.id+'">Delete</a></td>';
	newTr += '</tr>';
	$('newRecord').insert({before:newTr});
	$('ItemName').value='';
	$('ReturDetailQty').value='';
	$('ReturDetailDescr').value='';
	$('ReturDetailItemId').value='';
}

function appendSupplierReturDetail(response){
	var json = response.responseText.evalJSON();
	var status = json.status;
	if(status=='failed')
	{
		alert(json.msg);
		supplier_return;
	}
	var supplier_returDetail = json.data.SupplierReturDetail;
	var assetCategory = json.data.Item.AssetCategory;
	var unit = json.data.Item.Unit;
	var item = json.data.Item;
	var count = json.count;
	var newTr = '<tr><td>'+count + '</td>';
	newTr += '<td>' + assetCategory.name + '</td>';
	newTr += '<td>' + item.code + ' - ' + item.name + '</td>';
	newTr += '<td>' + supplier_returDetail.qty + '</td>';
	newTr += '<td>' + supplier_returDetail.descr + '</td>';
	newTr += '<td>' + unit.name + '</td>';
	newTr += '<td class="number">' + add_commas(supplier_returDetail.price) + '</td>';
	newTr += '<td class="number">' + add_commas(supplier_returDetail.amount) + '</td>';
	newTr += '<td class="actions"><a href="'+base_url+'/supplier_retur_details/delete/'+supplier_returDetail.id+'">Delete</a></td>';
	newTr += '</tr>';
	$('newRecord').insert({before:newTr});
	$('ItemName').value='';
	$('SupplierReturDetailQty').value='';
	$('SupplierReturDetailDescr').value='';
}

function appendSupplierReplaceDetail(response){
	var json = response.responseText.evalJSON();
	var status = json.status;
	if(status=='failed')
	{
		alert(json.msg);
		supplier_replacen;
	}
	var supplier_replaceDetail = json.data.SupplierReplaceDetail;
	var assetCategory = json.data.Item.AssetCategory;
	var unit = json.data.Item.Unit;
	var item = json.data.Item;
	var count = json.count;
	var newTr = '<tr><td>'+count + '</td>';
	newTr += '<td>' + assetCategory.name + '</td>';
	newTr += '<td>' + item.code + ' - ' + item.name + '</td>';
	newTr += '<td>' + supplier_replaceDetail.qty + '</td>';
	newTr += '<td>' + supplier_replaceDetail.descr + '</td>';
	newTr += '<td>' + unit.name + '</td>';
	newTr += '<td class="number">' + add_commas(supplier_replaceDetail.price) + '</td>';
	newTr += '<td class="number">' + add_commas(supplier_replaceDetail.amount) + '</td>';
	newTr += '<td class="actions"><a href="'+base_url+'/supplier_replace_details/delete/'+supplier_replaceDetail.id+'">Delete</a></td>';
	newTr += '</tr>';
	$('newRecord').insert({before:newTr});
	$('ItemName').value='';
	$('SupplierReplaceDetailQty').value='';
	$('SupplierReplaceDetailDescr').value='';
}
