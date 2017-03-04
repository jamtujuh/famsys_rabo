<div class="assetDetails view">
      <h2><?php __('Asset History'); ?></h2>
      <dl><?php $i = 0;
$class = ' class="altrow"'; ?>
            <dt<?php if ($i % 2 == 0)
      echo $class; ?>><?php __('Code'); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
                        echo $class; ?>>
<?php echo $assetDetail['AssetDetail']['code']; ?>
                  &nbsp;
            </dd>

            <dt<?php if ($i % 2 == 0)
      echo $class; ?>><?php __('Condition'); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
      echo $class; ?>>
                  <?php echo $assetDetail['Condition']['name']; ?>
                  &nbsp;
            </dd>
            <dt<?php if ($i % 2 == 0)
                        echo $class; ?>><?php __('Asset'); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
                        echo $class; ?>>
<?php echo $assetDetail['Asset']['name']; ?>
                  &nbsp;
            </dd>
            <dt<?php if ($i % 2 == 0)
      echo $class; ?>><?php __('Location'); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
      echo $class; ?>>
<?php echo $assetDetail['Location']['name']; ?>
                  &nbsp;
            </dd>
            <dt<?php if ($i % 2 == 0)
      echo $class; ?>><?php __('Department'); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
      echo $class; ?>>
                  <?php echo $assetDetail['Department']['name']; ?>
                  &nbsp;
            </dd>

            <dt<?php if ($i % 2 == 0)
                        echo $class; ?>><?php __('Name'); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
                        echo $class; ?>>
<?php echo $assetDetail['AssetDetail']['name']; ?>
                  &nbsp;
            </dd>
            <dt<?php if ($i % 2 == 0)
      echo $class; ?>><?php __('Color'); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
      echo $class; ?>>
                  <?php echo $assetDetail['AssetDetail']['color']; ?>
                  &nbsp;
            </dd>
            <dt<?php if ($i % 2 == 0)
                        echo $class; ?>><?php __('Brand'); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
                        echo $class; ?>>
<?php echo $assetDetail['AssetDetail']['brand']; ?>
                  &nbsp;
            </dd>
            <dt<?php if ($i % 2 == 0)
      echo $class; ?>><?php __('Type'); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
                        echo $class; ?>>
<?php echo $assetDetail['AssetDetail']['type']; ?>
                  &nbsp;
            </dd>
            <dt<?php if ($i % 2 == 0)
      echo $class; ?>><?php __('Exist'); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
      echo $class; ?>>
                  <?php echo $assetDetail['AssetDetail']['ada']; ?>
                  &nbsp;
            </dd>

            <dt<?php if ($i % 2 == 0)
                        echo $class; ?>><?php __('Economic Age'); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
                        echo $class; ?>>
<?php echo $assetDetail['AssetDetail']['umurek']; ?>
                  &nbsp;
            </dd>
            <dt<?php if ($i % 2 == 0)
      echo $class; ?>><?php __('Date of Purchase'); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
                        echo $class; ?>>
<?php echo $assetDetail['AssetDetail']['date_of_purchase']?$this->Time->format(DATE_FORMAT, $assetDetail['AssetDetail']['date_of_purchase']):''; ?>
                  &nbsp;
            </dd>
            <dt<?php if ($i % 2 == 0)
      echo $class; ?>><?php __('Date Start'); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
      echo $class; ?>>
<?php echo $assetDetail['AssetDetail']['date_start']?$this->Time->format(DATE_FORMAT, $assetDetail['AssetDetail']['date_start']):''; ?>
                  &nbsp;
            </dd>
            <dt<?php if ($i % 2 == 0)
      echo $class; ?>><?php __('Date End'); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
      echo $class; ?>>
                  <?php echo $assetDetail['AssetDetail']['date_end']?$this->Time->format(DATE_FORMAT, $assetDetail['AssetDetail']['date_end']):''; ?>
                  &nbsp;
            </dd>

            <dt<?php if ($i % 2 == 0)
                        echo $class; ?>><?php __('Price'); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
                        echo $class; ?>>
<?php echo $this->Number->format($assetDetail['AssetDetail']['price']); ?>
                  &nbsp;
            </dd>

            <dt<?php if ($i % 2 == 0)
      echo $class; ?>><?php __('Monthly Depr.'); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
      echo $class; ?>>
<?php echo $this->Number->format($assetDetail['AssetDetail']['depbln']); ?>
                  &nbsp;
            </dd>

            <dt<?php if ($i % 2 == 0)
      echo $class; ?>><?php __('Serial No'); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
      echo $class; ?>>
<?php echo $assetDetail['AssetDetail']['serial_no']; ?>
                  &nbsp;
            </dd>

            <dt<?php if ($i % 2 == 0)
      echo $class; ?>><?php __('Source'); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
      echo $class; ?>>
<?php echo $assetDetail['AssetDetail']['source']; ?>
                  &nbsp;
            </dd>		
            <dt<?php if ($i % 2 == 0)
      echo $class; ?>><?php __('Warranty'); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
                        echo $class; ?>>
<?php echo $assetDetail['AssetDetail']['warranty_name']; ?>
                  &nbsp;
            </dd>		
            <dt<?php if ($i % 2 == 0)
      echo $class; ?>><?php __('Warranty Year'); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
      echo $class; ?>>
            <?php echo $assetDetail['AssetDetail']['warranty_year']; ?> Year
                  &nbsp;
            </dd>		
            <dt<?php if ($i % 2 == 0)
                  echo $class; ?>><?php __('Notes'); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
                  echo $class; ?>>
                  <pre>
<?php echo $assetDetail['AssetDetail']['notes']; ?> 
			&nbsp;
                  </pre>
            </dd>		

      </dl>
</div>

<div class="actions">
      <h3><?php __('Actions'); ?></h3>
      <ul>
            <li><?php echo $this->Html->link(__('List Assets', true), array('controller' => 'assets', 'action' => 'index')); ?> </li>
      </ul>
</div>
<?php if(!empty($assetDetail['Purchase']['no'])):?>
<div class="view">
      <h3><?php __('Related Asset Register') ?></h3>
      <dl>
            <dt<?php if ($i % 2 == 0)
      echo $class; ?>><?php __('FA Register No'); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
      echo $class; ?>>
                  <?php echo $assetDetail['Purchase']['no']; ?>
                  &nbsp;
            </dd>
            <dt<?php if ($i % 2 == 0)
                        echo $class; ?>><?php __('FA Register Date'); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
                        echo $class; ?>>
<?php echo $assetDetail['Purchase']['date_of_purchase']?$this->Time->format(DATE_FORMAT, $assetDetail['Purchase']['date_of_purchase']):''; ?>
                  &nbsp;
            </dd>                  
      </dl>
</div>
<?php endif;?>
<div class="view">
            <?php if (!empty($npb_lists)) : ?>
            <h3><?php __('Related Memo Requests') ?></h3>
            <dl>
      <?php $j = 1 ?>
      <?php foreach ($npb_lists as $no): ?>
                        <dt<?php if ($i % 2 == 0)
                  echo $class; ?>><?php echo $j++; ?>. <?php __('MR No'); ?></dt>
                        <dd<?php if ($i++ % 2 == 0)
                  echo $class; ?>>
            <?php echo $no; ?>
                              &nbsp;
                        </dd>	
                        <?php endforeach; ?>
<?php endif; ?>
      </dl>
</div>

<div class="view">
<?php if (!empty($po['Po']['no'])) : ?>
            <h3><?php __('Related Purchase Orders') ?></h3>
      <?php //debug($po['Po'])  ?>
            <dl>
                  <dt<?php if ($i % 2 == 0)
            echo $class; ?>><?php __('PO No'); ?></dt>
                  <dd<?php if ($i++ % 2 == 0)
            echo $class; ?>>
      <?php echo $this->Html->link($po['Po']['no'], array('controller' => 'pos', 'action' => 'view', $po['Po']['id'])); ?>
                        &nbsp;
                  </dd>
                  <dt<?php if ($i % 2 == 0)
            echo $class; ?>><?php __('PO Date'); ?></dt>
                  <dd<?php if ($i++ % 2 == 0)
            echo $class; ?>>
      <?php echo $po['Po']['po_date']?$this->Time->format(DATE_FORMAT, $po['Po']['po_date']):''; ?>
                        &nbsp;
                  </dd>
                  <dt<?php if ($i % 2 == 0)
            echo $class; ?>><?php __('Supplier'); ?></dt>
                  <dd<?php if ($i++ % 2 == 0)
            echo $class; ?>>
      <?php echo $po['Supplier']['supplier_info']; ?>
                        &nbsp;
                        <?php endif; ?>
            </dd>
      </dl>	
</div>

<div class="view">
                        <?php if (!empty($deliveryOrder)) : ?>
            <h3><?php __('Related Delivery Orders') ?></h3>
            <dl>
                  <dt<?php if ($i % 2 == 0)
                              echo $class; ?>><?php __('DO No'); ?></dt>
                  <dd<?php if ($i++ % 2 == 0)
                              echo $class; ?>>
                  <?php echo $this->Html->link($deliveryOrder['DeliveryOrder']['no'], array('controller' => 'delivery_orders', 'action' => 'view', $deliveryOrder['DeliveryOrder']['id'])); ?>
                        &nbsp;
                  </dd>	
<?php endif; ?>
      </dl>	
</div>

<div class="view">
<?php if (!empty($invoice['Invoice']['no'])) : ?>
            <h3><?php __('Related Invoices') ?></h3>
      <?php //debug($invoice['Invoice'])  ?>
            <dl>
                  <dt<?php if ($i % 2 == 0)
            echo $class; ?>><?php __('Invoice No'); ?></dt>
                  <dd<?php if ($i++ % 2 == 0)
                  echo $class; ?>>
                              <?php echo $this->Html->link($invoice['Invoice']['no'], array('controller' => 'invoices', 'action' => 'view', $invoice['Invoice']['id'])); ?>
                        &nbsp;
                  </dd>
                  <dt<?php if ($i % 2 == 0)
                              echo $class; ?>><?php __('Invoice Date'); ?></dt>
                  <dd<?php if ($i++ % 2 == 0)
                              echo $class; ?>>
      <?php echo $invoice['Invoice']['inv_date']?$this->Time->format(DATE_FORMAT, $invoice['Invoice']['inv_date']):''; ?>
                        &nbsp;
                  </dd>
                  <dt<?php if ($i % 2 == 0)
            echo $class; ?>><?php __('Supplier'); ?></dt>
                  <dd<?php if ($i++ % 2 == 0)
            echo $class; ?>>
      <?php echo $invoice['Supplier']['supplier_info']; ?>
                        &nbsp;
      <?php endif; ?>
            </dd>
      </dl>		
</div>

<div  style="clear:both">
<?php if (!empty($movements)) : ?>
            <h3><?php __('Related Movements') ?></h3>
            <table>
                  <tr>
                        <th><?php __('Move Date') ?></th>
                        <th><?php __('Move No') ?></th>
                        <th><?php __('Origin Branch') ?></th>
                        <th><?php __('Destination Branch') ?></th>
                  </tr>
                              <?php foreach ($movements as $movement): ?>
                        <tr>
                              <td>
                                    <?php echo $this->Time->format(DATE_FORMAT, $movement['Movement']['doc_date']) ?>
                              </td>
                              <td>
                                    <?php echo $this->Html->link($movement['Movement']['no'], array('controller' => 'movements', 'action' => 'view', $movement['Movement']['id'])) ?>
                              </td>
                              <td>
                        <?php echo $movement['Department']['name'] ?>
                              </td>
                              <td>
            <?php echo $departments[$movement['Movement']['dest_department_id']] ?>
                              </td>
                        </tr>
      <?php endforeach; ?>
<?php endif; ?>
      </table>
</div>	

<div  style="clear:both">
<?php if (!empty($disposals)) : ?>
            <h3><?php __('Related Disposals') ?></h3>
            <table>
                  <tr>
                        <th><?php __('Disposal Date') ?></th>
                        <th><?php __('Disposal No') ?></th>
                        <th><?php __('Type') ?></th>
                  </tr>
                              <?php foreach ($disposals as $disposal): ?>
                        <tr>
                              <td>
                                    <?php echo $this->Time->format(DATE_FORMAT, $disposal['Disposal']['date']) ?>
                              </td>
                              <td>
                                    <?php echo $this->Html->link($disposal['Disposal']['no'], array('controller' => 'disposals', 'action' => 'view', $disposal['Disposal']['id'])) ?>
                              </td>
                              <td>
                        <?php echo $disposal['DisposalType']['name'] ?>
                              </td>
                        </tr>
      <?php endforeach; ?>
<?php endif; ?>
      </table>
</div>	



<div  style="clear:both">
<?php if (!empty($fa_imports)) : ?>
            <h3><?php __('Related Imports') ?></h3>
            <table>
                  <tr>
                        <th><?php __('Import Date') ?></th>
                        <th><?php __('Import No') ?></th>
                        <th><?php __('Department') ?></th>
                        <th><?php __('Upload File Name') ?></th>
                  </tr>
      <?php foreach ($fa_imports as $fa_import): ?>
                        <tr>
                              <td>
            <?php echo $this->Time->format(DATE_FORMAT,$fa_import['date']) ?>
                              </td>
                              <td>
            <?php echo $this->Html->link($fa_import['no'], array('controller' => 'fa_imports', 'action' => 'view', $fa_import['id'])) ?>
                              </td>
                              <td>
            <?php echo $departments[$fa_import['department_id']] ?>
                              </td>
                              <td>
            <?php echo $fa_import['upload_file_name'] ?>
                              </td>
                        </tr>
      <?php endforeach; ?>
<?php endif; ?>
      </table>
</div>	



<div  style="clear:both">
<?php if (!empty($faSupplierReturs)) : ?>
            <h3><?php __('Related FaSupplierReturs') ?></h3>
            <table>
                  <tr>
                        <th><?php __('Date') ?></th>
                        <th><?php __('No') ?></th>
                        <th><?php __('Notes') ?></th>
                  </tr>
      <?php foreach ($faSupplierReturs as $faSupplierRetur): ?>
                        <tr>
                              <td>
            <?php echo $faSupplierRetur['FaSupplierRetur']['doc_date'] ?>
                              </td>
                              <td>
            <?php echo $this->Html->link($faSupplierRetur['FaSupplierRetur']['no'], array('controller' => 'faSupplierReturs', 'action' => 'view', $faSupplierRetur['FaSupplierRetur']['id'])) ?>
                              </td>
                              <td>
            <?php echo $faSupplierRetur['FaSupplierRetur']['notes'] ?>
                              </td>
                        </tr>
      <?php endforeach; ?>
<?php endif; ?>
      </table>
</div>	