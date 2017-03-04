<div class="process view">
	<h2><?php __('Stock Supplier Replace process complete') ?></h2>
	<p><?php __('You can see the Stock list now.') ?></p>
	<div class="doc_actions">
		<ul>
			<li><?php echo $this->Html->link(__('List Stock', true), array('controller'=>'stocks','action' => 'index'));?></li>
			<li><?php echo $this->Html->link(__('List Supplier Replaces', true), array('controller'=>'supplier_replaces','action' => 'index'));?></li>
		</u>
	</div>

</div>


<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><? echo $this->Html->link(__('Home', true), '/pages/home' ); ?></li>
		<li><?php echo $this->Html->link(__('List Stock', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Outlog', true), array('controller'=>'outlogs','action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Inlog', true), array('controller'=>'inlogs','action' => 'index'));?></li>
	</ul>
</div>