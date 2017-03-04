<?php
echo $javascript->link('my_script', false);
?>
<div id="moduleName"><?php echo 'Stock > Stock Status'?></div>
<div id="close_filter_button"><?php echo $this->Html->link(__('Show/Hide Filters',true), '#', array('onclick'=>'$("filter").toggle()')) ?></div>
<div id="filter">
	<div class="fieldfilter">
            <?php echo $this->Form->create('Item') ?>		
      <fieldset>
 			<fieldset class="subfilter">
            <legend><?php __('Filter Item'); ?></legend>
            <?php echo $this->Form->input('asset_category_id', array('options' => $assetCategories, 'empty' => 'all', 'value' => $this->Session->read('Item.asset_category_id'))) ?>
            <?php echo $this->Form->input('stock_status', array('options' => array(1 => 'OK', 2 => 'REORDER'), 'empty' => 'all', 'value'=>$this->Session->read('Item.stock_status'))); ?>
      </fieldset>
            <?php echo $this->Form->radio('layout', array('Screen'=>'Screen', 'pdf' => 'PDF', 'xls' => 'XLS'), array('default' => 'Screen')) ?>
            <?php echo $this->Form->submit('Refresh') ?>
            <?php echo $this->Form->end() ?>
      </fieldset>
</div>

</div>

<div class="related">
      <?php if (!empty($items)) : ?>
            <h2><?php __('Stock Items Status'); ?></h2>
            <table cellpadding="0" cellspacing="0">
                  <tr>
                        <th><?php echo $this->Paginator->sort('no'); ?></th>
                        <th><?php echo $this->Paginator->sort('asset_category_id'); ?></th>
                        <th><?php echo $this->Paginator->sort('code'); ?></th>
                        <th><?php echo $this->Paginator->sort('name'); ?></th>
                        <th><?php echo $this->Paginator->sort('unit'); ?></th>
                        <th><?php echo $this->Paginator->sort('stock balance'); ?></th>
                        <th><?php echo $this->Paginator->sort('avg_price(Rp)'); ?></th>
                        <th><?php echo $this->Paginator->sort('amount(Rp)'); ?></th>
                        <th><?php echo $this->Paginator->sort('stock status'); ?></th>
                  </tr>
                  <?php
                  $i = 0;
                  foreach ($items as $item):
                        $class = null;
                        if ($i++ % 2 == 0) {
                              $class = ' class="altrow"';
                        }
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
                        <tr<?php echo $class; ?>>
                              <td><?php echo $i; ?></td>
                              <td class="left"><?php echo $item['AssetCategory']['name']; ?></td>
                              <td class="left"><?php echo $item['Item']['code']; ?></td>
                              <td class="left"><?php echo $item['Item']['name']; ?></td>
                              <td class="left"><?php echo $item['Unit']['name']; ?></td>
                              <td class="number"><?php echo isset($item['Item']['balance']) ? $this->Number->format($item['Item']['balance']) : 0; ?></td>
                              <td class="number"><?php echo $this->Number->format($item['Item']['avg_price'], 2); ?></td>
                              <td class="number"><?php echo isset($item['Item']['balance']) ? $this->Number->format($item['Item']['avg_price'] * $item['Item']['balance'], 2) : 0; ?></td>
                              <td class="center"><?php echo $status; ?></td>
                        </tr>
      <?php endforeach; ?>
            </table>
            <p>
                  <?php
                  echo $this->Paginator->counter(array(
                      'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
                  ));
                  ?>	</p>

            <div class="paging">
                  <?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class' => 'disabled')); ?>
      	 | 	<?php echo $this->Paginator->numbers(); ?>
                  |
                  <?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled')); ?>
            </div>
            <?php endif; //not empty?>
</div>
