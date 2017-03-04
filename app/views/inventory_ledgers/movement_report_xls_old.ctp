<?php
//header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
//header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
//header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename=\"" .__('Inventory Movement Report', true).'-'. gmdate("d M Y") . ".xls" );
//header ("Content-Description: Generated Report" );
?>
<table cellspacing="0" cellpadding="1" border="0">
	<tr>
		<td colspan="4"><h2><?php echo __('Inventory Movement Report', true) ;?></h2></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Asset Category', true) ;?></td>
		<td>: 
			<?php 
				if($asset_category) echo $assetCategories[$asset_category];
				else echo 'Empty';
			?>
		</td>
	</tr>	
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Item', true) ;?></td>
		<td>: 
			<?php 
				if($asset_category) echo $items[$this->Session->read('MovementReport.item_id')];
				else echo 'Empty';
			?>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Date Start', true) ;?></td>
		<td>: <?php echo $date_start['month'];?>-<?php echo $date_start['day'];?>-<?php echo $date_start['year'];?></td>
	</tr>
	<tr>
		<td WIDTH="75" colspan="2"><?php echo __('Date End', true) ;?></td>
		<td>: <?php echo $date_end['month'];?>-<?php echo $date_end['day'];?>-<?php echo $date_end['year'];?></td>
	</tr>
</table>
<?php if($asset_category){?>
<table cellspacing="0" cellpadding="1" border="1">
	<tr>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('No',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Date',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('In',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Out',true) ;?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Saldo',true) ;?></div></td>
	</tr>
	<tr>
		<td align="right" colspan="4"><?php echo __('Begining Balance',true) ;?></td>
		<td><div align="right"><?php echo $this->Number->format($beginning_balance);?></div></td>
	</tr>
	<?php
	$i = 0;
	$r = 0;
	$balance=$beginning_balance;
	foreach ($rows as $date=>$row):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<?php
		if(!empty($row['in']) && empty($row['out'])) {
			$balance=$balance+$row['in'];
		} elseif(empty($row['in']) && !empty($row['out'])) {
			$balance=$balance-$row['out'];
		} elseif(!empty($row['in']) && !empty($row['out'])) {
			$balance=$balance+$row['in']-$row['out'];
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?></td>
		<td><?php echo $this->Time->format(DATE_FORMAT, $date); ?></td>
		<td align="right">
			<?php
				if (!empty($row['in'])) {
					echo $this->Number->precision($row['in'],0);
				} else {
					echo $r;
				}
			?>
		</td>
		<td align="right">
			<?php
				if (!empty($row['out'])) {
					echo $this->Number->precision($row['out'],0);
				} else {
					echo $r;
				}
			?>
		</td>
		<td align="right"><?php echo $this->Number->precision($balance,0); ?></td>
	</tr>
<?php endforeach; ?>
	<tr>
		<td style="border-top:1px solid black" colspan="4" align="right"><?php echo __('Ending Balance', true) ;?></td>
		<td style="border-top:1px solid black"  align="right">
			<?php 
				echo $this->Number->precision($balance,0);
			?>
		</td>
	</tr>
	</table>
<?php }?>