<?php
//header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
//header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
//header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename=\"". __('Stock Items Status', true) . gmdate("d M Y") . ".xls" );
//header ("Content-Description: Generated Report" );
?>
<?php


if($asset_category_id == null) {
		$asset_category_id = 'All';
}else {
		$asset_category_id = $assetCategories[$asset_category_id];
}
if($this->Session->read('Item.stock_status')==1)
	$stock_status = 'OK';
elseif($this->Session->read('Item.stock_status')==2)
	$stock_status = 'REORDER';
elseif($this->Session->read('Item.stock_status')==NULL)
	$stock_status = 'All';
?>
<table cellspacing="0" cellpadding="1" border="0">
	<tr>
		<td colspan="4"><h2><?php echo __('Stock Items Status', true) ;?></h2></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Asset Category', true);?></td>
		<td>: <?php echo $asset_category_id;?></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Stock Status', true);?></td>
		<td>: <?php echo $stock_status;?></td>
	</tr>
</table>
<table cellspacing="0" cellpadding="1" border="1">
		<tr>
			<td bgcolor="#CCCCCC"><?php echo __('no', true) ;?></td>
			<td bgcolor="#CCCCCC"><?php echo __('asset_category_id', true) ;?></td>
			<td bgcolor="#CCCCCC"><?php echo __('code', true) ;?></td>
			<td bgcolor="#CCCCCC"><?php echo __('name', true) ;?></td>
			<td bgcolor="#CCCCCC"><?php echo __('unit', true) ;?></td>
			<td bgcolor="#CCCCCC"><?php echo __('stock balance', true) ;?></td>
			<td bgcolor="#CCCCCC"><?php echo __('Avg Price(Rp)', true) ;?></td>
			<td bgcolor="#CCCCCC"><?php echo __('Amount(Rp)', true) ;?></td>
			<td bgcolor="#CCCCCC"><?php echo __('Stock Status', true) ;?></td>
		</tr>		
		<?php
		$i = 0;
		foreach ($items as $item):
		$i++;
		$class = null;
                        //filter by stock status
                        if (isset($item['Item']['balance']) && $item['Item']['balance'] > $item['Item']['qty_reorder']) {
                              $status = 'OK';
                        } else {
                              $status = 'REORDER';
                        }
                        //colour for $class
                        if ($status == 'OK') {
                              $class = ' style="color:green;font-weight:bold"';
                        } else if ($status == 'REORDER') {
                              $class = ' style="color:red;font-weight:bold"';
                        }
	?>
	<tr<?php echo $class;?>>
	  <td><?php echo $i; ?></td>
	  <td align="left"><?php echo $item['AssetCategory']['name']; ?></td>
	  <td align="left"><?php echo $item['Item']['code']; ?></td>
	  <td align="left"><?php echo $item['Item']['name']; ?></td>
	  <td align="left"><?php echo $item['Unit']['name']; ?></td>
	  <td align="right"><?php echo isset($item['Item']['balance']) ? $this->Number->precision($item['Item']['balance'],0) : 0; ?></td>
	  <td align="right"><?php echo $this->Number->precision($item['Item']['avg_price'],2); ?></td>
	  <td align="right"><?php echo isset($item['Item']['balance']) ? $this->Number->precision($item['Item']['avg_price'] * $item['Item']['balance'],2) : 0; ?></td>
	  <td align="center"><?php echo $status; ?></td>
	</tr>
	<?php endforeach; ?>
	</table>

