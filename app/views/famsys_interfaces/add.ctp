<div class="related">
	<h3><?php __('Famsys Interface');?></h3>
	<?php if (!empty($journal_interfases)) : ?>
	
	<?php echo $this->Form->create('FamsysInterface', array('action'=>'add')) ?> 
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th nowrap><?php __('No'); ?></th>
		<th nowrap><?php __('Source Id'); ?></th>
		<th nowrap><?php __('Source Date'); ?></th>
		<th nowrap><?php __('Kode Tran'); ?></th>
		<th nowrap><?php __('Norek 1'); ?></th>
		<th nowrap><?php __('Kode Cabang 1'); ?></th>
		<th nowrap><?php __('Ccy 1'); ?></th>
		<th nowrap><?php __('Nilai 1'); ?></th>
		<th nowrap><?php __('Norek 2'); ?></th>
		<th nowrap><?php __('Kode Cabang 2'); ?></th>
		<th nowrap><?php __('Ccy 2'); ?></th>
		<th nowrap><?php __('Nilai 2'); ?></th>
		<th nowrap><?php __('Costdept 1'); ?></th>
		<th nowrap><?php __('Costdept 2'); ?></th>
		<th nowrap><?php __('Kurs'); ?></th>
		<th nowrap><?php __('Keterangan 1'); ?></th>
		<th nowrap><?php __('Keterangan 2'); ?></th>
	</tr>
	<?php foreach ($journal_interfases as $i=>$journal_interfase) : 	
	?>
	<tr>
		<td class="left">
			<?php echo ($i+1) ?>
		</td>
		<td class="left">
			<?php echo $this->Form->input('source_id',array('type'=>'hidden','name'=>'data['.$i.'][FamsysInterface][source_id]','value'=>'FIX'))?>
			<?php echo 'FIX';?>
		</td>
		<td class="left">
			<?php echo $this->Form->input('source_dt',array('type'=>'hidden','name'=>'data['.$i.'][FamsysInterface][source_dt]','value'=>$journal_interfase['JournalInterfase']['source_dt']))?>
			<?php echo $journal_interfase['JournalInterfase']['source_dt'];?>
		</td>
		<td class="center">
			<?php echo $this->Form->input('kdtran',array('type'=>'hidden','name'=>'data['.$i.'][FamsysInterface][kdtran]','value'=>$journal_interfase['JournalInterfase']['kdtran']))?>
			<?php echo $journal_interfase['JournalInterfase']['kdtran'];?>
		</td>
		<td class="left">
			<?php echo $this->Form->input('norek1',array('type'=>'hidden','name'=>'data['.$i.'][FamsysInterface][norek1]','value'=>$journal_interfase['JournalInterfase']['norek1']))?>
			<?php echo $journal_interfase['JournalInterfase']['norek1'];?>
		</td>
		<td class="center">
			<?php echo $this->Form->input('kdcab1',array('type'=>'hidden','name'=>'data['.$i.'][FamsysInterface][kdcab1]','value'=>$journal_interfase['JournalInterfase']['kdcab1']))?>
			<?php echo $journal_interfase['JournalInterfase']['kdcab1'];?>
		</td>
		<td class="center">
			<?php echo $this->Form->input('ccy1',array('type'=>'hidden','name'=>'data['.$i.'][FamsysInterface][ccy1]','value'=>360))?>
			<?php echo 360;?>
		</td>
		<td class="number">
			<?php echo $this->Form->input('nilai1',array('type'=>'hidden','name'=>'data['.$i.'][FamsysInterface][nilai1]','value'=>$journal_interfase['0']['nilai1']))?>
			<?php echo $journal_interfase['0']['nilai1'];?>
		</td>
		<td class="left">
			<?php echo $this->Form->input('norek2',array('type'=>'hidden','name'=>'data['.$i.'][FamsysInterface][norek2]','value'=>$journal_interfase['JournalInterfase']['norek2']))?>
			<?php echo $journal_interfase['JournalInterfase']['norek2'];?>
		</td>
		<td class="center">
			<?php echo $this->Form->input('kdcab2',array('type'=>'hidden','name'=>'data['.$i.'][FamsysInterface][kdcab2]','value'=>$journal_interfase['JournalInterfase']['kdcab2']))?>
			<?php echo $journal_interfase['JournalInterfase']['kdcab2'];?>
		</td>
		<td class="center">
			<?php echo $this->Form->input('ccy2',array('type'=>'hidden','name'=>'data['.$i.'][FamsysInterface][ccy2]','value'=>360))?>
			<?php echo 360;?>
		</td>
		<td class="number">
			<?php echo $this->Form->input('nilai2',array('type'=>'hidden','name'=>'data['.$i.'][FamsysInterface][nilai2]','value'=>$journal_interfase['0']['nilai2']))?>
			<?php echo $journal_interfase['0']['nilai2'];?>
		</td>
		<td class="left">
			<?php echo $this->Form->input('costdept1',array('type'=>'hidden','name'=>'data['.$i.'][FamsysInterface][costdept1]','value'=>$journal_interfase['JournalInterfase']['costdept1']))?>
			<?php echo $journal_interfase['JournalInterfase']['costdept1'];?>
		</td>
		<td class="left">
			<?php echo $this->Form->input('costdept2',array('type'=>'hidden','name'=>'data['.$i.'][FamsysInterface][costdept2]','value'=>$journal_interfase['JournalInterfase']['costdept1']))?>
			<?php echo $journal_interfase['JournalInterfase']['costdept2'];?>
		</td>
		<td class="number">
			<?php echo $this->Form->input('kurs',array('type'=>'hidden','name'=>'data['.$i.'][FamsysInterface][kurs]','value'=>1))?>
			<?php echo 1;?>
		</td>
		<td class="left">
			<?php echo $this->Form->input('ket2',array('type'=>'hidden','name'=>'data['.$i.'][FamsysInterface][ket2]','value'=>$journal_interfase['JournalInterfase']['ket1']))?>
			<?php echo $journal_interfase['JournalInterfase']['ket1'];?>
		</td>
			<?php echo $this->Form->input('ket1',array('type'=>'hidden','name'=>'data['.$i.'][FamsysInterface][ket1]','value'=>$journal_interfase['JournalInterfase']['ket2']))?>
			<?php echo $journal_interfase['JournalInterfase']['ket2'];?>
		<td class="left">
		</td>
		</tr>
	<?php endforeach; ?>
	
	</table>
	
	<?php echo $this->Form->end('Confirm Journal Interface') ?>
	<?php else: ?>
	<p><h2><?php __('Error: There is no journal that can be posted to the Interface') ?></h2></p>
	<div class="doc_actions">
	<ul>
		<li>
			<? echo $this->Html->link(__('Back To Home', true), 
			array('controller'=>'pages',
			'action'=>'home')); ?>
		</li>
	</ul>
	</div>
	<?php endif; ?>
	
</div>


