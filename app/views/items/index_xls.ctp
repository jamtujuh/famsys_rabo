<?php
//header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
//header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
//header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename=\"". __('Items', true) .' '.gmdate("d M Y") . ".xls" );
//header ("Content-Description: Generated Report" );
?>
<?php
if($this->Session->read('Item.asset_category_id') == null){
	$asset_category_id = 'All';
}else{
	$asset_category_id = $assetCategories[$this->Session->read('Item.asset_category_id')];
}
?>
<table cellspacing="0" cellpadding="1" border="0">
	<tr>
		<td colspan="4"><h2><?php echo __('Items', true) ;?></h2></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Asset Category Type', true);?></td>
		<td>: <?php echo $assetCategoryTypes[$this->Session->read('Item.asset_category_type_id')];?></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Asset Category', true);?></td>
		<td>: <?php echo $asset_category_id;?></td>
	</tr>
</table>
<table cellspacing="0" cellpadding="1" border="1">
		<tr>
			<td bgcolor="#CCCCCC"><?php echo __('no', true) ;?></td>
			<td bgcolor="#CCCCCC"><?php echo __('Asset Category Type', true) ;?></td>
			<td bgcolor="#CCCCCC"><?php echo __('Asset Category', true) ;?></td>
			<td bgcolor="#CCCCCC"><?php echo __('Code', true) ;?></td>
			<td bgcolor="#CCCCCC"><?php echo __('Request Type', true) ;?></td>
			<td bgcolor="#CCCCCC"><?php echo __('Name', true) ;?></td>
			<td bgcolor="#CCCCCC"><?php echo __('Unit', true) ;?></td>
			<td bgcolor="#CCCCCC"><?php echo __('Currency', true) ;?></td>
			<td bgcolor="#CCCCCC"><?php echo __('Avg Price', true) ;?></td>
			<td bgcolor="#CCCCCC"><?php echo __('Qty Reorder', true) ;?></td>
		</tr>		
		<?php
		$i = 0;
		foreach ($items as $item):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
		?>
		<td><?php echo $i; ?></td>
		<td align="left"><?php echo $assetCategoryTypes[$this->Session->read('Item.asset_category_type_id')]; ?></td>
		<td align="left"><?php echo $item['AssetCategory']['name']; ?></td>
		<td align="left"><?php echo $item['Item']['code']; ?></td>
		<td align="left"><?php echo $item['RequestType']['name']; ?></td>
		<td align="left"><?php echo $item['Item']['name']; ?></td>
		<td><?php echo $units[$item['Item']['unit_id']]; ?></td>
		<td><?php echo $item['Currency']['name']; ?></td>
		<td align="right"><?php echo $this->Number->precision($item['Item']['avg_price'],2); ?></td>
		<td align="right"><?php echo $this->Number->precision($item['Item']['qty_reorder'],0); ?></td>
	</tr>
	<?php endforeach; ?>
	</table>

