<?php
//header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
//header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
//header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename=\"" .__('Memo Requests', true).'-'. gmdate("d M Y") . ".xls" );
//header ("Content-Description: Generated Report" );
?>
<?php
$is_done ='';
$request_type_id ='';
$npb_status_id ='';
$department_id ='';
$business_type_id ='';
$cost_center_id ='';

if ($this->Session->read('Npb.is_done',$this->data['Npb']['is_done']) == 0) {
	$is_done = $is_done  . 'All';
} else if ($this->Session->read('Npb.is_done',$this->data['Npb']['is_done']) == 1) {
	$is_done = $is_done  . 'Yes';
} else if ($this->Session->read('Npb.is_done',$this->data['Npb']['is_done']) == 2) {
	$is_done = $is_done  . 'No';
}

if ($this->Session->read('Npb.request_type_id',$this->data['Npb']['request_type_id']) == null) {
	$request_type_id = $request_type_id  . 'All';
}else  {
		$request_type_id = $request_type_id  . $requestTypes[$this->Session->read('Npb.request_type_id',$this->data['Npb']['request_type_id'])];
}

if ($this->Session->read('Npb.npb_status_id',$this->data['Npb']['npb_status_id']) == null) {
	$npb_status_id = $npb_status_id  . 'All';
}else  {
		$npb_status_id = $npb_status_id  . $npbStatuses[$this->Session->read('Npb.npb_status_id',$this->data['Npb']['npb_status_id'])];
}

if ($this->Session->read('Npb.department_id',$this->data['Npb']['department_id']) == null) {
	$department_id = $department_id  . 'All';
}else  {
		$department_id = $department_id  . $departments[$this->Session->read('Npb.department_id',$this->data['Npb']['department_id'])];
}
if ($this->Session->read('Npb.business_type_id',$this->data['Npb']['business_type_id']) == null) {
	$business_type_id = $business_type_id . 'All';
}else  {
		$business_type_id = $business_type_id . $businessType[$this->Session->read('Npb.business_type_id',$this->data['Npb']['business_type_id'])];
}
if ($this->Session->read('Npb.cost_center_id',$this->data['Npb']['cost_center_id']) == null) {
	$cost_center_id = $cost_center_id . 'All';
}else  {
		$cost_center_id = $cost_center_id . $costCenter[$this->Session->read('Npb.cost_center_id',$this->data['Npb']['cost_center_id'])];
}
if ($this->Session->read('Npb.cost_center_id',$this->data['Npb']['cost_center_id']) == null) {
	$cost_center_ids =  '';
}else  {
		$cost_center_ids =  $costCenters[$this->Session->read('Npb.cost_center_id',$this->data['Npb']['cost_center_id'])];
}
$no = $this->Session->read('Npb.no');
?>
<table cellspacing="0" cellpadding="1" border="0">
	<tr>
		<td colspan="4"><h2><?php echo __('Memo Requests', true) ;?></h2></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo __('Request Type', true) ;?></td>
		<td colspan="2">: <?php echo $request_type_id ;?></td>
	
		<td colspan="2"><?php echo __('Is Done', true) ;?></td>
		<td colspan="2">: <?php echo $is_done ;?></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo __('Mr Status', true) ;?></td>
		<td colspan="2">: <?php echo $npb_status_id ;?></td>
	
		<td colspan="2"><?php echo __('Branch', true) ;?></td>
		<td colspan="2">: <?php echo $department_id ;?></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo __('Business Type', true) ;?></td>
		<td colspan="2">: <?php echo $business_type_id ;?></td>
	
		<td colspan="2"><?php echo __('Cost Center', true) ;?></td>
		<td colspan="2">: <?php echo $cost_center_id ;?>&nbsp;<?php echo $cost_center_ids ;?></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo __('Date Start', true) ;?></td>
		<td colspan="2">: <?php echo $date_start['month'] ;?>-<?php echo $date_start['day'] ;?>-<?php echo $date_start['year'] ;?></td>
	
		<td colspan="2"><?php echo __('Date End', true);?></td>
		<td colspan="2">: <?php echo $date_end['month'] ;?>-<?php echo $date_end['day'] ;?>-<?php echo $date_end['year'] ;?></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo __('No', true) ;?></td>
		<td colspan="2">: <?php echo $no ;?></td>
	
		<td colspan="2"></td>
		<td colspan="2"></td>
	</tr>
</table>
<table cellspacing="0" cellpadding="1" border="1">
	<tr>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('No', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('No Mr', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Mr Date', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Branch', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Req Date', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Mr Status', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Request Type', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Is Done', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Approved By', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Approved Date', true);?></div></td>
		<td bgcolor="#CCCCCC"><div align="center"><?php echo __('Created By', true);?></div></td>
	</tr>
	<?php
	$i = 0;
	foreach ($npbs as $npb):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
		
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $i; ?></td>
		<td class="left"><?php echo $npb['Npb']['no']; ?></td>
		<td class="left"><?php echo $this->Time->format(DATE_FORMAT, $npb['Npb']['npb_date']); ?></td>
		<td>
			<?php echo $npb['Department']['name']; ?>
		</td>
		<td class="left"><?php echo $this->Time->format(DATE_FORMAT, $npb['Npb']['req_date']); ?></td>
		<td><?php echo $npb['NpbStatus']['name']; ?></td>
		<td><?php echo $npb['RequestTypes']['name']; ?></td>
		<!--td class="number"><?php echo round($npb['Npb']['v_total']); ?></td-->
		<?php if($npb['Npb']['v_is_done'] == 1){ 
		$image = 'Yes';
		}else{
		$image = 'No';
		}
		?>
		<td><?php echo $image; ?></td>

		<td><?php echo ucwords($npb['Npb']['approved_by']); ?></td>
		<td><?php echo $npb['Npb']['approved_date']; ?></td>
		<td><?php echo $npb['Npb']['created_by']; ?></td>
	</tr>
<?php endforeach; ?>
	</table>