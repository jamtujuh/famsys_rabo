<div class="suppliers form">
<?php echo $this->Form->create('Supplier');?>
	<fieldset>
 		<legend><?php __('Add Supplier'); ?></legend>
	<table width="100">
	<tr>
	<td>
	<?php
		echo $this->Form->input('no', array('maxlength'=>'4', 'label'=>'Code', 'style'=>'width:75%'));
		echo $this->Form->input('name', array('style'=>'width:75%'));
		echo $this->Form->input('address', array('style'=>'width:75%'));
		echo $this->Form->input('city', array('style'=>'width:75%'));
		echo $this->Form->input('province', array('style'=>'width:75%'));
		echo $this->Form->input('telephone', array('style'=>'width:75%'));
		echo $this->Form->input('fax', array('style'=>'width:75%'));
	?>
	</td>
	<td>
	<?php
		echo $this->Form->input('contact_person', array('style'=>'width:75%'));
		echo $this->Form->input('hp', array('style'=>'width:75%'));
		echo $this->Form->input('email', array('style'=>'width:75%'));
		echo $this->Form->input('website', array('style'=>'width:75%'));
		echo $this->Form->input('business_type', array('style'=>'width:75%'));
		echo $this->Form->input('default_wht_rate', array('style'=>'width:75%'));		
	?>
	</td>
	</tr>
	</table>
	</fieldset>

<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Suppliers', true), array('action' => 'index'));?></li>
	</ul>
</div>