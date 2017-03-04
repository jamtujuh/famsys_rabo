function updateField(f,val,response) {
	var data = response.responseText.evalJSON();
	$(f).value = eval('data.'+val);
}
function getRate(response, model)
{
	var data = response.responseText.evalJSON();
	$(model+'RpRate').value = data.rp_rate;
	calcRp(model);
}
function calcRp(model)
{
	var rp = $(model+'PriceCur').value * $(model+'RpRate').value;
	$(model+'Price').value=rp;
}
function nettCur(model)
{
	var cur = $(model+'PriceCur').value - $(model+'DiscountCur').value;
	$(model+'AmountNettCur').value=cur;
}
function setTotals(r,model) {
	var data = r.responseText.evalJSON();
	$(model+'UpdateDiv').innerText 	= data.status;
	//$(model+'SubTotal').value		= add_commas(data.model.sub_total);
	//$(model+'Discount').value		= add_commas(data.model.discount);
	//$(model+'VatTotal').value		= add_commas(data.model.vat_total);
	if(model == 'Invoice')
	{
		$(model+'WhtTotal').value		= add_commas(data.model.wht_total);
	}
	$(model+'Total').innerText			= add_commas(data.model.total);
	$(model+'TotalDiv').innerText 	= add_commas(data.model.total);
	return true;
}

function add_commas(nStr, places)
{
	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1].substr(0,2) : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
	if(places== -1)
	return x1 ;//+ x2;
	else
	return  x1 + x2;
}

function calcAmount(model)
{
	var jml = $(model+'Qty').value * $(model+'Price').value;
	var jmlcur = $(model+'Qty').value * $(model+'PriceCur').value;
	$(model+'Amount').value=jml;
	$(model+'AmountCur').value=jmlcur;
}
