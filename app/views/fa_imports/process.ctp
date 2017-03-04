<div class="process view">
	<h2><?php __('Import process complete') ?></h2>
	<p><?php __('You can see the FA list now.') ?></p>
	<div class="doc_actions">
		<ul>
			<li><?php echo $this->Html->link(__('List FA', true), array('controller'=>'stocks','action' => 'index'));?></li>
			<li><?php echo $this->Html->link(__('List Imports', true), array('controller'=>'usages','action' => 'index'));?></li>
		</u>
	</div>

</div>


<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><? echo $this->Html->link(__('Home', true), '/pages/home' ); ?></li>
		<li><?php echo $this->Html->link(__('List FA', true), array('action' => 'index'));?></li>
	</ul>
</div>