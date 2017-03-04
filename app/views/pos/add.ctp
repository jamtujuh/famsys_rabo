<?php 
//echo $javascript->link('prototype',false);
//echo $javascript->link('scriptaculous',false); 
echo $javascript->link('my_script',false);
echo $javascript->link('my_detail_add',false);
?>
<div id="moduleName"><?php echo $moduleName?></div>
<div class="pos form">
<?php echo $this->Form->create('Po');?>
	<fieldset>
 		<legend><?php __('Add Po'); ?></legend>
		<?php echo $this->Form->input('no', array('type'=>'text', 'value'=>$newId, 'style'=>'width:40%', 'readonly'=>true)); ?>
		<?php echo $this->Form->input('po_date', array('value'=>date("Y-m-d"), 'type'=>'text', 'readonly'=>true));?>
		<?php echo $this->Form->input('delivery_date',array('type'=>'date')); ?>
		<?php echo $this->Form->input('request_type_id', array('type'=>'hidden', 'value'=>$this->Session->read('Po.request_type_id'))); ?>
		<?php echo $this->Form->input('supplier_id', array('empty'=>'select supplier', 'type'=>'hidden')); ?>
		<?php echo $this->Form->input('Supplier.name', array('label'=>'Supplier', 'style'=>'width:75%')); ?>
		<div id="supplier_choices" class="auto_complete"></div> 
		<script type="text/javascript"> 
			//<![CDATA[
			new Ajax.Autocompleter('SupplierName', 'supplier_choices', '<?php echo BASE_URL ?>/suppliers/auto_complete', {afterUpdateElement : setSupplierValues});
			//]]>
		</script>
		<?php echo $this->Form->input('department_id', array('type'=>'hidden')); ?>
		<?php echo $this->Form->input('cost_center_id', array('type'=>'hidden')); ?>
		<?php echo $this->Form->input('business_type_id', array('type'=>'hidden')); ?>
		<?php //echo $this->Form->input('department_sub_id', array('type'=>'hidden')); ?>
		<?php //echo $this->Form->input('department_unit_id', array('type'=>'hidden')); ?>
		<?php echo $this->Form->input('description', array('style'=>'width:98%', 'value'=>$po_notes )); ?>
		<?php echo $this->Form->input('shipping_address', array('style'=>'width:98%', 'value'=>$po_shipping_address, 'maxlength'=>'255')); ?>
		<?php echo $this->Form->input('billing_address', array('style'=>'width:98%', 'value'=>$po_billing_address, 'maxlength'=>'255')); ?>
		<?php echo $this->Form->input('sub_total', array('value'=>0,'type'=>'hidden')); ?>
		<?php echo $this->Form->input('discount', array('value'=>0,'type'=>'hidden')); ?>
		<?php echo $this->Form->input('vat_rate', array('value'=>10, 'type'=>'hidden')); ?>
		<?php echo $this->Form->input('vat_base', array('value'=>0, 'type'=>'hidden')); ?>
		<?php echo $this->Form->input('wht_base', array('value'=>0, 'type'=>'hidden')); ?>
		<?php echo $this->Form->input('wht_rate', array('value'=>0, 'type'=>'hidden')); ?>
		<?php echo $this->Form->input('vat_total', array('value'=>0, 'type'=>'hidden')); ?>
		<?php echo $this->Form->input('wht_total', array('value'=>0, 'type'=>'hidden')); ?>
		<?php echo $this->Form->input('total', array('value'=>0, 'type'=>'hidden')); ?>
		<?php echo $this->Form->input('down_payment', array('value'=>0, 'type'=>'hidden')); ?>
		<?php echo $this->Form->input('payment_term', array('value'=>1)); ?>
		<?php echo $this->Form->input('daily_penalty', array('value'=>'0.001')); ?>
		<?php echo $this->Form->input('currency_id', array('type'=>'hidden', 'value'=>$this->Session->read('Po.currency_id'))); ?>
		<?php echo $this->Form->input('signer_1', array('style'=>'width:50%', 'maxlength'=>'100')); ?>
		<?php echo $this->Form->input('signer_2', array('style'=>'width:50%', 'maxlength'=>'100')); ?>
		<?php echo $this->Form->input('po_address', array('type'=>'hidden', 'style'=>'width:98%', 'value'=>$po_address, 'maxlength'=>'255')); ?>
		<?php echo $this->Form->input('created', array('value'=>date("Y-m-d"), 'type'=>'hidden') );?>
	</fieldset>
	<h2 style="margin-top:20px"><?php __('Select Outstanding MR')?></h2>
	<table>
		<tr>
			<th><?php __("Select") ?></th>
			<th><?php __("No NPB") ?></th>
			<th><?php __("Date") ?></th>
			<th><?php __("Department") ?></th>
			<th><?php __("Item Code") ?></th>
			<th><?php __("Item Name") ?></th>
			<th><?php __("Qty") ?></th>
			<th><?php __("Qty Filled") ?></th>
			<th><?php __("Req. Type") ?></th>
			<th><?php __("Process") ?></th>
			<th><?php __("Ref PO") ?></th>
		</tr>
	<?php foreach($npbDetails as $d): ?>
			<?php 
				if($this->Session->read('Security.permissions') == gs_group_id && $d['NpbDetail']['po_id'] != null)
				continue;
			?>
		<tr>
			<td>
			<?php if(  $d['NpbDetail']['qty_filled']!=$d['NpbDetail']['qty'] && $d['NpbDetail']['process_type_id']==procurement_process_type_id ) : ?>
			<?php echo $this->Form->input('select_detail', 
				array(
					'hiddenField'=>false,
					'label'=>'',
					'checked'=>false,
					'type'=>'checkbox', 
					'value'=>$d['NpbDetail']['id'],
					'name'=>'data[Po][npb_detail_id][]')) 
			?>
			<?php endif?>
			</td>
			<td class="left"><?php echo $d['Npb']['no']?></td>
			<td class="left"><?php echo $this->Time->format(DATE_FORMAT, $d['Npb']['npb_date'])?></td>
			<td class="left"><?php echo $departments[$d['Npb']['department_id']]?></td>
			<td class="left"><?php echo $d['NpbDetail']['item_code']?></td>
			<td class="left"><?php echo $d['NpbDetail']['item_name']?></td>
			<td class="center"><?php echo $d['NpbDetail']['qty']?></td>
			<td class="center"><?php echo $d['NpbDetail']['qty_filled']?></td>
			<td class="center"><?php echo $requestTypes[ $d['Npb']['request_type_id'] ]?></td>
			<td class="center"><?php echo isset($d['NpbDetail']['process_type_id'])?$processTypes[ $d['NpbDetail']['process_type_id'] ] :''?></td>
			<td class="left"><?php echo $d['Po']['no']?></td>
		</tr>
	<? endforeach;?>

	</table>

<?php echo $this->Form->end(__('Submit', true));?>
</div>

<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Pos', true), array('action' => 'index'));?></li>
	</ul>
</div>