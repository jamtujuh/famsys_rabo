<?php
//header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
//header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
//header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename=\"" .__('Inventory Outlog Recap Report', true).'-'. gmdate("d M Y") . ".xls" );
//header ("Content-Description: Generated Report" );
?>
<?php
if($asset_category == NULL) {
	$ac = 'All';
}else {
	$ac = $assetCategories[$asset_category];
}
?>
<table cellspacing="0" cellpadding="1" border="0">
	<tr>
		<td colspan="4"><h2><?php echo __('Inventory Outlog Recap Report', true) ;?></h2></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Asset Category', true) ;?></td>
		<td>: <?php echo $ac ;?></td>
	</tr>	
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Date End', true) ;?></td>
		<td>: <?php echo $this->params['data']['filter']['month']['month'];?>-<?php echo $this->params['data']['filter']['year']['year'];?></td>
	</tr>
</table>
<table cellspacing="0" cellpadding="1" border="1">
	<tr>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('No',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Name',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Beginning Stock',true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Out',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('End Stock',true) ;?></div></td>
	</tr>
	<?php
	$i = 0;
	$r = 0;
	$end_stock=0;
	$total=0;
	foreach ($rows as $item_id=>$row):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<?php
		if (!empty($row['begin_stock_amount']) && !empty($row['out_amount'])) {
			$end_stock=$row['begin_stock_amount']-$row['out_amount'];
		} elseif (!empty($row['begin_stock_amount']) && empty($row['out_amount'])) {
			$end_stock=$row['begin_stock_amount']-0;
		} elseif (empty($row['begin_stock_amount']) && !empty($row['out_amount'])) {
			$end_stock=0-$row['out_amount'];
		}
	?>
	<tr<?php echo $class;?>>
	<?php list($code) = explode ('|', $item_id)?>
		<td><?php echo $i; ?></td>
		<td><?php echo $items[$item_id] ; ?></td>
		<td align="right">
			<?php
				if (!empty($row['begin_stock_amount'])) {
					echo $this->Number->precision($row['begin_stock_amount'],0);
				} else {
					echo $r;
				}
			?>
		</td>
		<td align="right">
			<?php
				if (!empty($row['out_amount'])) {
					echo $this->Number->precision($row['out_amount'],0);
				} else {
					echo $r;
				}
			?>
		</td>
		<td align="right"><?php echo $this->Number->precision($end_stock,0); ?></td>
	</tr>
	<?php $total	+=$end_stock; ?>
<?php endforeach; ?>
	<tr>
		<td style="border-top:1px solid black" colspan="3"align="right"><?php echo  __('Sub Total',true) ;?></td>
		<td style="border-top:1px solid black" align="right"><?php echo  __('Rp',true) ;?></td>
		<td style="border-top:1px solid black" align="right">
			<?php 
				echo $this->Number->precision($total,0);
			?>
		</td>
	</tr>
	</table>