<?php
echo $javascript->link('my_script', false);
echo $javascript->link('my_detail_add', false);
$request_type_id = $npb['Npb']['request_type_id'];
$npb_status_id = $npb['Npb']['npb_status_id'];
$npb_created_by = $npb['Npb']['created_by'];
$can_edit_price = $this->Session->read('Npb.can_edit_price');
$can_attachment = $this->Session->read('Npb.can_attachment');
$group_id = $this->Session->read('Security.permissions');
$recalcFunction = $ajax->remoteFunction(
                array(
                    'url' => array('controller' => 'npbs', 'action' => 'ajax_view', $npb['Npb']['id']),
                    'indicator' => 'LoadingDiv',
                    'complete' => 'recalcNpb(request)'
                )
);
?>
<div class="npbs view">
      <h2><?php __('Npb'); ?></h2>
      <dl><?php $i = 0;
$class = ' class="altrow"'; ?>

            <dt<?php if ($i % 2 == 0)
                  echo $class; ?>><?php __('No'); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
                        echo $class; ?>>
                        <?php echo $npb['Npb']['no']; ?>
                  &nbsp;
            </dd>
            <dt<?php if ($i % 2 == 0)
                              echo $class; ?>><?php __('Department'); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
                        echo $class; ?>>
                        <?php echo $npb['Department']['name']; ?>
                  &nbsp;
            </dd>

            <?php if (!empty($npb['Npb']['department_sub_id'])) : ?>
                  <dt<?php if ($i % 2 == 0)
                  echo $class; ?>><?php __('Department Sub'); ?></dt>
                  <dd<?php if ($i++ % 2 == 0)
                        echo $class; ?>>
                              <?php echo $departmentsub[$npb['Npb']['department_sub_id']]; ?>
                        &nbsp;
                  </dd>
            <?php endif; ?>

            <?php if (!empty($npb['Npb']['department_sub_id'])) : ?>
                  <dt<?php if ($i % 2 == 0)
                  echo $class; ?>><?php __('Department Unit'); ?></dt>
                  <dd<?php if ($i++ % 2 == 0)
                        echo $class; ?>>
                              <?php echo $departmentunit[$npb['Npb']['department_unit_id']]; ?>
                        &nbsp;
                  </dd>
            <?php endif; ?>
			
			<?php if (!empty($npb['Npb']['cost_center_id'])) : ?>
                  <dt<?php if ($i % 2 == 0)
                  echo $class; ?>><?php __('Cost Center'); ?></dt>
                  <dd<?php if ($i++ % 2 == 0)
                        echo $class; ?>>
                              <?php echo $npb['Npb']['cost_center_name']; ?>
                        &nbsp;
                  </dd>
            <?php endif; ?>

            <dt<?php if ($i % 2 == 0)
                  echo $class; ?>><?php __('MR Date'); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
                        echo $class; ?>>
                        <?php echo $this->Time->format(DATE_FORMAT, $npb['Npb']['npb_date']); ?>
                  &nbsp;
            </dd>		
            <dt<?php if ($i % 2 == 0)
                              echo $class; ?>><?php __('Req Date'); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
                        echo $class; ?>>
                        <?php echo $this->Time->format(DATE_FORMAT, $npb['Npb']['req_date']); ?>
                  &nbsp;
            </dd>		
            <dt<?php if ($i % 2 == 0)
                              echo $class; ?>><?php __('Status'); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
                        echo $class; ?>>
                        <?php echo $npb['NpbStatus']['name']; ?>
                  &nbsp;
            </dd>
            <dt<?php if ($i % 2 == 0)
                              echo $class; ?>><?php __('Request Type'); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
                        echo $class; ?>>
                        <?php echo $npb['RequestTypes']['name']; ?>
                  &nbsp;
            </dd>
			<?php if($npb['Npb']['v_is_done'] == 1) {?>
            <dt<?php if ($i % 2 == 0)
                  echo $class; ?>><?php __('Is Done ?'); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
                        echo $class; ?>>
                        <?php echo $this->Html->image($npb['Npb']['v_is_done'] . ".gif"); ?>
                  &nbsp;
            </dd>
			<?php } ?>
            <dt<?php if ($i % 2 == 0)
                              echo $class; ?>><?php __('Created By'); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
                        echo $class; ?>>
                        <?php echo $npb['Npb']['created_by']; ?>
                  &nbsp;
            </dd>		
            <dt<?php if ($i % 2 == 0)
                              echo $class; ?>><?php __('Created Date'); ?></dt>
            <dd<?php if ($i++ % 2 == 0)
                        echo $class; ?>>
                        <?php echo $npb['Npb']['created_date']; ?>
                  &nbsp;
            </dd>	

            <?php if (!empty($npb['Npb']['reject_by'])) : ?>
                  <dt<?php if ($i % 2 == 0)
                  echo $class; ?>><?php __('Reject By'); ?></dt>
                  <dd<?php if ($i++ % 2 == 0)
                        echo $class; ?>>
                              <?php echo $npb['Npb']['reject_by']; ?>
                        &nbsp;
                  </dd>
                  <dt<?php if ($i % 2 == 0)
                              echo $class; ?>><?php __('Reject Notes'); ?></dt>
                  <dd<?php if ($i++ % 2 == 0)
                        echo $class; ?>>
                              <pre><?php echo $npb['Npb']['reject_notes']; ?></pre>
                        &nbsp;
                  </dd>
                  <dt<?php if ($i % 2 == 0)
                              echo $class; ?>><?php __('Reject Date'); ?></dt>
                  <dd<?php if ($i++ % 2 == 0)
                        echo $class; ?>>
                              <?php echo $npb['Npb']['reject_date']; ?>
                        &nbsp;
                  </dd>
            <?php endif; ?>

            <?php if (!empty($npb['Npb']['cancel_by'])) : ?>
                  <dt<?php if ($i % 2 == 0)
                  echo $class; ?>><?php __('Cancel By'); ?></dt>
                  <dd<?php if ($i++ % 2 == 0)
                        echo $class; ?>>
                              <?php echo $npb['Npb']['cancel_by']; ?>
                        &nbsp;
                  </dd>
                  <dt<?php if ($i % 2 == 0)
                              echo $class; ?>><?php __('Cancel Notes'); ?></dt>
                  <dd<?php if ($i++ % 2 == 0)
                        echo $class; ?>>
                              <pre><?php echo $npb['Npb']['cancel_notes']; ?></pre>
                        &nbsp;
                  </dd>
                  <dt<?php if ($i % 2 == 0)
                              echo $class; ?>><?php __('Cancel Date'); ?></dt>
                  <dd<?php if ($i++ % 2 == 0)
                        echo $class; ?>>
                              <?php echo $npb['Npb']['cancel_date']; ?>
                        &nbsp;
                  </dd>
            <?php endif; ?>


            <?php if (!empty($npb['Npb']['approved_by'])) : ?>
                  <dt<?php if ($i % 2 == 0)
                  echo $class; ?>><?php __('Approved By'); ?></dt>
                  <dd<?php if ($i++ % 2 == 0)
                        echo $class; ?>>
                              <?php echo $npb['Npb']['approved_by']; ?>
                        &nbsp;
                  </dd>
                  <dt<?php if ($i % 2 == 0)
                              echo $class; ?>><?php __('Approved Date'); ?></dt>
                  <dd<?php if ($i++ % 2 == 0)
                        echo $class; ?>>
                              <?php echo $npb['Npb']['approved_date']; ?>
                        &nbsp;
                  </dd>
                  <dt<?php if ($i % 2 == 0)
                              echo $class; ?>><?php __('Approved History'); ?></dt>
                  <dd<?php if ($i++ % 2 == 0)
                        echo $class; ?>>
                              <?php echo $npb['Npb']['approved_history']; ?>
                        &nbsp;
                  </dd>
            <?php endif; ?>

      </dl>

      <div class="doc_actions">
            <ul>
				<?php if($npb['Npb']['npb_status_id'] != status_npb_done_id && $npb['Npb']['npb_status_id'] != status_npb_movement_id && $npb['Npb']['npb_status_id'] != status_npb_processing_id && $group_id != housekeeper_group_id){?>
						<li>
							<?php echo $this->Html->link($approveLink['label'],$approveLink['options']) ?>
						</li>
				  <? }else if($group_id != housekeeper_group_id && ($npb['Npb']['npb_status_id'] == status_npb_done_id || $npb['Npb']['npb_status_id'] == status_npb_movement_id || $npb['Npb']['npb_status_id'] == status_npb_processing_id)){;?>
						<li><?php echo $this->Html->link(__('Back', true), array('action' => 'index')); ?> </li>
				  <? }?>
				  
				  <?php if($group_id == housekeeper_group_id){?>
					<?php if($this->Session->read('HKConf.table_name') == 'npbs'){
							$options	= array('controller'=>'house_keepings','action'=>'get_view_npbs');
						}else if($this->Session->read('HKConf.table_name') == 'pos'){
							$options	= array('controller'=>'house_keepings','action'=>'get_view_pos');
						}else if($this->Session->read('HKConf.table_name') == 'delivery_orders'){
							$options	= array('controller'=>'house_keepings','action'=>'get_view_delivery_orders');
						}else if($this->Session->read('HKConf.table_name') == 'inlogs'){
							$options	= array('controller'=>'house_keepings','action'=>'get_view_inlogs');
						}else if($this->Session->read('HKConf.table_name') == 'outlogs'){
							$options	= array('controller'=>'house_keepings','action'=>'get_view_outlogs');
						}
					?>
					<li><?php echo $this->Html->link(__('Back', true), $options); ?> </li>
				  <?php };?>
			
                  <?php if ($this->Session->read('Npb.can_approve_branch')) : ?>
                        <!--li><!--?php echo $this->Html->link(__('Approve', true), array('action' => 'approvalDepartmentHead', $npb['Npb']['id'])); ?--> </li-->		
						<!--li><!--?php echo $this->Html->link(__('Approve To PO', true), array('action' => 'approveToPo', $npb['Npb']['id'])); ?--> </li-->		
                  <?php endif; ?>

                  <?php if ($this->Session->read('Npb.can_send_to_branch_head')) : ?>
                        <!--li><!--?php echo $this->Html->link(__('Send to Approval', true), array('action' => 'notifyDepartmentHead', $npb['Npb']['id'])); ?--> </li-->
                  <?php endif; ?>

                  <?php if ($this->Session->read('Npb.can_send_to_supervisor')) : ?>
                        <li><?php echo $this->Html->link(__('Sent to Approval', true), array('action' => 'sentToStockSupervisor', $npb['Npb']['id'])); ?> </li>
                  <?php endif; ?>

                  <?php if ($this->Session->read('Npb.can_create_po')) : ?>
                        <li><?php echo $this->Html->link(__('Create PO', true), array('controller' => 'pos', 'action' => 'po_type', $request_type_id)); ?> </li>		
                  <?php endif; ?>

                  <?php if ($this->Session->read('Npb.can_cancel')) : ?>
                        <li><?php echo $this->Html->link(__('Cancel', true), array('action' => 'cancel', $npb['Npb']['id'])); ?> </li>
                  <?php endif; ?>

                  <?php if ($this->Session->read('Npb.can_reject')) : ?>
                        <li><?php echo $this->Html->link(__('Reject', true), array('action' => 'reject', $npb['Npb']['id'])); ?> </li>
                  <?php endif; ?>

                  <?php if ($this->Session->read('Npb.can_send_to_stock_management')): ?>
                        <li><?php echo $this->Html->link(__('Sent to Stock Management', true), array('action' => 'sentToStockManagement', $npb['Npb']['id'])); ?> </li>
                  <?php endif; ?>

                  <?php if ($this->Session->read('Npb.can_approval_it_manager')) : ?>
                        <li><?php echo $this->Html->link(__('Approved by IT for Processing', true), array('controller' => 'npbs', 'action' => 'approvalItManager', $npb['Npb']['id'])); ?> </li>
                  <?php endif; ?>

                  <!--?php if ($this->Session->read('Npb.can_print_npb')) : ?-->
                        <li><?php
								echo $this->Html->link(__('Print Memo Request', true), array('controller' => 'npbs', 'action' => 'view_pdf', $npb['Npb']['id']), array('target' => '_blank', 'onclick' => 'setTimeout("location.reload(true)", 2000);'));
                        ?> 
                        </li>
                  <!--?php endif; ?-->

                  <?php if ($this->Session->read('Npb.can_send_for_processing')) : ?>
                        <li><?php echo $this->Html->link(__('Approve', true), array('action' => 'updateStatus', $npb['Npb']['id'], status_npb_processing_id)); ?> </li>
                  <?php endif; ?>

                  <?php if ($this->Session->read('Npb.can_archive')) : ?>
                        <li><?php echo $this->Html->link(__('Archive', true), array('action' => 'mrArchive', $npb['Npb']['id'])); ?> </li>
                  <?php endif; ?>

                  <?php if ($this->Session->read('Npb.can_check_stock')) : ?>
                        <li><?php echo $this->Html->link(__('Delivery', true), array('controller' => 'npbs', 'action' => 'check_stock', $npb['Npb']['id'])); ?> </li>
                  <?php endif; ?>

                  <?php if ($this->Session->read('Npb.can_create_movement')) : ?>
                        <li><?php echo $this->Html->link(__('Create Movement', true), array('controller' => 'movements', 'action' => 'add', $npb['Npb']['id'])); ?> </li>
                  <?php endif; ?>

                  <?php if ($this->Session->read('Npb.can_sent_to_gs_spv')) : ?>
                        <li><?php echo $this->Html->link(__('Send to Approval', true), array('action' => 'mrSentToGsSpv', $npb['Npb']['id'])); ?> </li>
                  <?php endif; ?>
				  
				  

            </ul>
      </div>
</div>


<div class="actions">
      <h3><?php __('Actions'); ?></h3>
      <ul>
            <?php if ($this->Session->read('Npb.can_edit') && $group_id == normal_user_group_id) : ?>
                  <li><?php echo $this->Html->link(__('Edit Npb', true), array('action' => 'edit', $npb['Npb']['id'])); ?> </li>
                  <li><?php echo $this->Html->link(__('Delete Npb', true), array('action' => 'delete', $npb['Npb']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $npb['Npb']['id'])); ?> </li>
            <?php endif; ?>
            <?php if ($this->Session->read('Npb.can_edit') && $group_id == stock_management_group_id) : ?>
                  <li><?php echo $this->Html->link(__('Delete Npb', true), array('action' => 'delete', $npb['Npb']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $npb['Npb']['id'])); ?> </li>
            <?php endif; ?>
            <li><?php echo $this->Html->link(__('List Npbs', true), array('action' => 'index')); ?> </li>
      </ul>
</div>



<div class="related">
      <h3><?php __('NPB Item Details'); ?></h3>
      <?php echo $this->Form->create('NpbDetail', array('action' => 'ajax_add')); ?>
      <table id="npb_details" cellpadding = "0" cellspacing = "0">

            <?php if ($this->Session->read('Npb.can_edit_price')) : ?>
                  <? // can edit price, for IT admin only ?>
                  <tr>
                        <th><?php __('No'); ?></th>
                        <th><?php __('Code'); ?></th>
                        <th><?php __('Name'); ?></th>
                        <th><?php __('Qty'); ?></th>
                        <th><?php __('Qty Filled'); ?></th>
                        <th><?php __('Unit'); ?></th>
                        <th><?php __('Currency'); ?></th>
                        <th><?php __('Price Cur'); ?></th>
                        <th><?php __('Amount Cur'); ?></th>
                        <th><?php __('Brand'); ?></th>
                        <th><?php __('Type'); ?></th>
                        <th><?php __('Color'); ?></th>
                        <th><?php __('Ref Doc'); ?></th>
                        <th class="actions"><?php __('Process Type'); ?></th>
                  </tr>	
                  <?php if (!empty($npb['NpbDetail'])): ?>
					
                        <?php
						$i = 0;
						$group_id = $this->Session->read('Security.permissions');
                        foreach ($npb['NpbDetail'] as $npbDetail):
                              $class = null;
                              if ($i++ % 2 == 0) {
                                    $class = ' class="altrow"';
                              }
                              $id = $npbDetail['id'];
                              ?>
								<tr<?php echo $class; ?>>
									<td><?php echo $i; ?></td>
									<td><?php echo $npbDetail['item_code']; ?></td>
									<td><?php echo $npbDetail['item_name']; ?></td>
									<td><?php echo $npbDetail['qty']; ?></td>
									<td><?php echo $npbDetail['qty_filled'] ?></td>
									<td><?php echo $units[$npbDetail['unit_id']]; ?></td>
									<td>
										  <?php echo $form->input('currency_id', array('selected' => $npbDetail['currency_id'], 'id' => 'NpbDetailCurrencyId' . $id, 'options' => $currencies, 'label' => '')); ?>
										  <//?php if ($can_edit_price) : ?>
												<?php
												echo $ajax->observeField('NpbDetailCurrencyId' . $id, array(
													'url' => array('controller' => 'npb_details', 'action' => 'ajax_edit_currency', $id),
													'indicator' => 'LoadingDiv',
													'update' => 'NpbDetailCurrencyId'
														)
												);
												?>
										  <//?php endif; ?>
									</td>
									<td class="number">
										<?php $places = $myApp->getPlaces($currency[$npbDetail['currency_id']]); ?>
										  <div id="price_cur.<?php echo $id ?>"><?php echo $this->Number->format($npbDetail['price_cur'], $places); ?></div>
										  <//?php if ($can_edit_price) : ?>
												<?php
												echo $ajax->editor('price_cur.' . $id, array('controller' => 'npb_details', 'action' => 'ajax_edit', $id), array('loaded' => $recalcFunction)
												)
												?>
										  <//?php endif; ?>
									</td>
									
									<td class="number">
										  <div id="amount_cur.<?php echo $id ?>"><?php echo $this->Number->format($npbDetail['amount_cur'], $places); ?></div>
									</td>
									<td>
										   <//?php if ($can_edit_price) : ?>
										 <div id="brand.<?php echo $id ?>"><?php echo $npbDetail['brand']; ?></div>
												<?php
												echo $ajax->editor('brand.' . $id, array('controller' => 'npb_details', 'action' => 'ajax_edit', $id), array('loaded' => $recalcFunction)
												)
												?>
										  <//?php endif; ?>
									</td>
									<td>
										   <//?php if ($can_edit_price) : ?>
										 <div id="type.<?php echo $id ?>"><?php echo $npbDetail['type']; ?></div>
												<?php
												echo $ajax->editor('type.' . $id, array('controller' => 'npb_details', 'action' => 'ajax_edit', $id), array('loaded' => $recalcFunction)
												)
												?>
											  <//?php endif; ?>
									</td>
									<td>
											 <//?php if ($can_edit_price) : ?>
									   <div id="color.<?php echo $id ?>"><?php echo $npbDetail['color']; ?></div>
												<?php
												echo $ajax->editor('color.' . $id, array('controller' => 'npb_details', 'action' => 'ajax_edit', $id), array('loaded' => $recalcFunction)
												)
												?>
											  <//?php endif; ?>
									</td>
									<td class="left">
										  <?php echo empty($npbDetail['po_id']) ? "" :
												  $this->Html->link($pos[$npbDetail['po_id']], array('controller' => 'pos', 'action' => 'view', $npbDetail['po_id'])); ?>

										  <?php echo empty($npbDetail['movement_id']) ? "" :
												  $this->Html->link($movements[$npbDetail['movement_id']], array('controller' => 'movements', 'action' => 'view', $npbDetail['movement_id'])); ?>
									</td>
									<td class="actions">

										  <?php
										  if ($this->Session->read('Npb.can_set_process_type') && $npbDetail['qty_filled'] == 0 && $npb['Npb']['request_type_id'] != request_type_point_reward_id):
												echo $ajax->link('Movement', array('controller' => 'npb_details', 'action' => 'set_movement', $npbDetail['id']), array('class' => ($npbDetail['process_type_id'] == movement_process_type_id ? 'checked' : 'unchecked'),
													'id' => 'movementLink' . $npbDetail['id'],
													'indicator' => 'LoadingDiv',
													'complete' => 'toggleLink("movement",' . $npbDetail['id'] . ')'
														)
												);
												echo $ajax->link('Procurement', array('controller' => 'npb_details', 'action' => 'set_procurement', $npbDetail['id']), array('class' => $npbDetail['process_type_id'] == procurement_process_type_id ? 'checked' : 'unchecked',
													'id' => 'procurementLink' . $npbDetail['id'],
													'indicator' => 'LoadingDiv',
													'complete' => 'toggleLink("procurement",' . $npbDetail['id'] . ')'
														)
												);
										  /* echo $ajax->link('Cancel', 
											array('controller'=>'npb_details', 'action'=>'set_cancel', $npbDetail['id']),
											array('class'=> 'unchecked',
											'id'=>'cancelLink'. $npbDetail['id'],
											'indicator'=>'LoadingDiv',
											'complete'=>'cancelLink('.$npbDetail['id'].')'
											)
											); */
										  else :
												echo isset($npbDetail['process_type_id']) ? $processTypes[$npbDetail['process_type_id']] : '';
										  endif;
										  ?>
										  <?php //if($can_edit_price) :?>
										  <?php //echo $this->Html->link(__('Delete', true), array('controller' => 'npb_details', 'action' => 'delete', $npbDetail['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $npbDetail['id'])); ?>
										  <?php //endif;?>
									</td>
								</tr>								
                        <?php endforeach; ?>
                  <?php endif; // empty?>

            <?php elseif (!$this->Session->read('Npb.can_edit_price')): ?>
                  <? // cannot edit price  ?>
                  <tr>
                        <th><?php __('No'); ?></th>
                        <th><?php __('Code'); ?></th>
                        <th><?php __('Name'); ?></th>
                        <th><?php __('Qty'); ?></th>
                        <?php if (!$this->Session->read('Npb.can_edit')) : ?>
                              <th><?php __('Qty Filled'); ?></th>
                        <?php endif; ?>
                        <th><?php __('Unit'); ?></th>
                        <//?php if ($request_type_id == request_type_fa_it_id && $npb_status_id != status_npb_draft_id): ?>
                              <th><?php __('Currency'); ?></th>
                              <th><?php __('Price Cur'); ?></th>
                              <th><?php __('Amount Cur'); ?></th>
                        <//?php endif; ?>
                        <th><?php __('Brand'); ?></th>
                        <th><?php __('Type'); ?></th>
                        <th><?php __('Color'); ?></th>
                        <?php if (!$this->Session->read('Npb.can_edit')) : ?>
                              <th><?php __('Ref Doc'); ?></th>
                        <?php endif; ?>
                        <th class="actions"><?php __('Process Type'); ?></th>
                  </tr>
                  <?php if (!empty($npb['NpbDetail'])): ?>
				  
                        <?php
                        $i = 0;
						$total_price = 0;
						$total_amount = 0;
                        foreach ($npb['NpbDetail'] as $npbDetail):
                              $class = null;
                              if ($i++ % 2 == 0) {
                                    $class = ' class="altrow"';
                              }
                              ?>
		  <?php
			$group_id = $this->Session->read('Security.permissions');
			if($group_id == gs_group_id && $npbDetail['process_type_id'] == movement_process_type_id){
				continue;
				}else if($group_id == po_approval1_group_id && $npbDetail['process_type_id'] == movement_process_type_id){
				continue;
				}else if($group_id == fa_management_group_id && $npbDetail['process_type_id'] == procurement_process_type_id){
				continue;
				}else if($group_id == fa_supervisor_group_id && $npbDetail['process_type_id'] == procurement_process_type_id){
				continue;
				}else if($group_id == it_management_group_id && $npbDetail['process_type_id'] == procurement_process_type_id){
				continue;
				}else if($group_id == it_supervisor_group_id && $npbDetail['process_type_id'] == procurement_process_type_id){
				continue;
				}
				
				if($group_id == stock_management_group_id || $group_id == stock_supervisor_group_id){
					
					//if($npbDetail['process_type_id'] == 1){
			?>
					<tr<?php echo $class; ?>>
						<td><?php echo $i; ?></td>
						<td class="left"><?php echo $npbDetail['item_code']; ?></td>
						<td class="left"><?php echo $npbDetail['item_name']; ?></td>
						<td class="left"><?php echo $npbDetail['qty']; ?></td>
						<?php if (!$this->Session->read('Npb.can_edit')) : ?>
							  <td><?php echo $npbDetail['qty_filled']; ?></td>
						<?php endif; ?>
						<td class="left"><?php echo $units[$npbDetail['unit_id']]; ?></td>
						<//?php if ($request_type_id == request_type_fa_it_id && $npb_status_id != status_npb_draft_id): ?>
								<?php $places = $myApp->getPlaces($currency[$npbDetail['currency_id']]); ?>
							  <td><?php echo $currencies[$npbDetail['currency_id']]; ?></td>
							  <td class="number"><?php echo $this->Number->format($npbDetail['price_cur'], $places); ?></td>
							  <td class="number"><?php echo $this->Number->format($npbDetail['amount_cur'], $places); ?></td>
						<//?php endif; ?>
						<td class="left"><?php echo $npbDetail['brand']; ?></td>
						<td class="left"><?php echo $npbDetail['type']; ?></td>
						<td class="left"><?php echo $npbDetail['color']; ?></td>
						<?php if (!$this->Session->read('Npb.can_edit')) : ?>	
							  <td class="left">
									<?php echo empty($npbDetail['po_id']) ? "" :
											$this->Html->link($pos[$npbDetail['po_id']], array('controller' => 'pos', 'action' => 'view', $npbDetail['po_id'])); ?>

									<?php echo empty($npbDetail['movement_id']) ? "" :
											$this->Html->link($movements[$npbDetail['movement_id']], array('controller' => 'movements', 'action' => 'view', $npbDetail['movement_id'])); ?>
							  </td>
						<?php endif; ?>					

						<td class="actions">
							  <?php
							  if ($this->Session->read('Npb.can_set_process_type') && $npbDetail['qty_filled'] == 0 && $npb['Npb']['request_type_id'] != request_type_point_reward_id):
									echo $ajax->link('Movement', array('controller' => 'npb_details', 'action' => 'set_movement', $npbDetail['id']), array('class' => ($npbDetail['process_type_id'] == movement_process_type_id ? 'checked' : 'unchecked'),
										'id' => 'movementLink' . $npbDetail['id'],
										'indicator' => 'LoadingDiv',
										'complete' => 'toggleLink("movement",' . $npbDetail['id'] . ')'
											)
									);
									echo $ajax->link('Procurement', array('controller' => 'npb_details', 'action' => 'set_procurement', $npbDetail['id']), array('class' => $npbDetail['process_type_id'] == procurement_process_type_id ? 'checked' : 'unchecked',
										'id' => 'procurementLink' . $npbDetail['id'],
										'indicator' => 'LoadingDiv',
										'complete' => 'toggleLink("procurement",' . $npbDetail['id'] . ')'
											)
									);
							  /* echo $ajax->link('Cancel', 
								array('controller'=>'npb_details', 'action'=>'set_cancel', $npbDetail['id']),
								array('class'=> 'unchecked',
								'id'=>'cancelLink'. $npbDetail['id'],
								'indicator'=>'LoadingDiv',
								'complete'=>'cancelLink('.$npbDetail['id'].')'
								)
								); */
							  else :
									echo isset($npbDetail['process_type_id']) ? $processTypes[$npbDetail['process_type_id']] : '';
							  endif;
							  ?>

							  <?php if ($this->Session->read('Npb.can_edit')) : ?>
									<?php echo $this->Html->link(__('Delete', true), array('controller' => 'npb_details', 'action' => 'delete', $npbDetail['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $npbDetail['id'])); ?>
							  <?php endif; ?>
						</td>
					</tr>
				  <?php $total_price += $npbDetail['price_cur']; ?>
				  <?php $total_amount += $npbDetail['amount_cur']; ?>
				<?php //};
				?>
			<?php }else if($group_id == gs_group_id && $npbDetail['process_type_id'] == procurement_process_type_id){ ?>
					<tr<?php echo $class; ?>>
						<td><?php echo $i; ?></td>
						<td class="left"><?php echo $npbDetail['item_code']; ?></td>
						<td class="left"><?php echo $npbDetail['item_name']; ?></td>
						<td class="left"><?php echo $npbDetail['qty']; ?></td>
						<?php if (!$this->Session->read('Npb.can_edit')) : ?>
							  <td><?php echo $npbDetail['qty_filled']; ?></td>
						<?php endif; ?>
						<td class="left"><?php echo $units[$npbDetail['unit_id']]; ?></td>
						<//?php if ($request_type_id == request_type_fa_it_id && $npb_status_id != status_npb_draft_id): ?>
								<?php $places = $myApp->getPlaces($currency[$npbDetail['currency_id']]); ?>
							  <td><?php echo $currencies[$npbDetail['currency_id']]; ?></td>
							  <td class="number"><?php echo $this->Number->format($npbDetail['price_cur'], $places); ?></td>
							  <td class="number"><?php echo $this->Number->format($npbDetail['amount_cur'], $places); ?></td>
						<//?php endif; ?>
						<td class="left"><?php echo $npbDetail['brand']; ?></td>
						<td class="left"><?php echo $npbDetail['type']; ?></td>
						<td class="left"><?php echo $npbDetail['color']; ?></td>
						<?php if (!$this->Session->read('Npb.can_edit')) : ?>	
							  <td class="left">
									<?php echo empty($npbDetail['po_id']) ? "" :
											$this->Html->link($pos[$npbDetail['po_id']], array('controller' => 'pos', 'action' => 'view', $npbDetail['po_id'])); ?>

									<?php echo empty($npbDetail['movement_id']) ? "" :
											$this->Html->link($movements[$npbDetail['movement_id']], array('controller' => 'movements', 'action' => 'view', $npbDetail['movement_id'])); ?>
							  </td>
						<?php endif; ?>					

						<td class="actions">
							  <?php
							  if ($this->Session->read('Npb.can_set_process_type') && $npbDetail['qty_filled'] == 0):
									echo $ajax->link('Movement', array('controller' => 'npb_details', 'action' => 'set_movement', $npbDetail['id']), array('class' => ($npbDetail['process_type_id'] == movement_process_type_id ? 'checked' : 'unchecked'),
										'id' => 'movementLink' . $npbDetail['id'],
										'indicator' => 'LoadingDiv',
										'complete' => 'toggleLink("movement",' . $npbDetail['id'] . ')'
											)
									);
									echo $ajax->link('Procurement', array('controller' => 'npb_details', 'action' => 'set_procurement', $npbDetail['id']), array('class' => $npbDetail['process_type_id'] == procurement_process_type_id ? 'checked' : 'unchecked',
										'id' => 'procurementLink' . $npbDetail['id'],
										'indicator' => 'LoadingDiv',
										'complete' => 'toggleLink("procurement",' . $npbDetail['id'] . ')'
											)
									);
							  /* echo $ajax->link('Cancel', 
								array('controller'=>'npb_details', 'action'=>'set_cancel', $npbDetail['id']),
								array('class'=> 'unchecked',
								'id'=>'cancelLink'. $npbDetail['id'],
								'indicator'=>'LoadingDiv',
								'complete'=>'cancelLink('.$npbDetail['id'].')'
								)
								); */
							  else :
									echo isset($npbDetail['process_type_id']) ? $processTypes[$npbDetail['process_type_id']] : '';
							  endif;
							  ?>

							  <?php if ($this->Session->read('Npb.can_edit')) : ?>
									<?php echo $this->Html->link(__('Delete', true), array('controller' => 'npb_details', 'action' => 'delete', $npbDetail['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $npbDetail['id'])); ?>
							  <?php endif; ?>
						</td>
					</tr>
				  <?php $total_price += $npbDetail['price_cur']; ?>
				  <?php $total_amount += $npbDetail['amount_cur']; ?>

			<?php } else {?>
					<tr<?php echo $class; ?>>
						<td><?php echo $i; ?></td>
						<td class="left"><?php echo $npbDetail['item_code']; ?></td>
						<td class="left"><?php echo $npbDetail['item_name']; ?></td>
						<td class="left"><?php echo $npbDetail['qty']; ?></td>
						<?php if (!$this->Session->read('Npb.can_edit')) : ?>
							  <td><?php echo $npbDetail['qty_filled']; ?></td>
						<?php endif; ?>
						<td class="left"><?php echo $units[$npbDetail['unit_id']]; ?></td>
						<//?php if ($request_type_id == request_type_fa_it_id && $npb_status_id != status_npb_draft_id): ?>
								<?php $places = $myApp->getPlaces($currency[$npbDetail['currency_id']]); ?>
							  <td><?php echo $currencies[$npbDetail['currency_id']]; ?></td>
							  <td class="number"><?php echo $this->Number->format($npbDetail['price'], $places); ?>&nbsp;</td>
							  <td class="number"><?php echo $this->Number->format($npbDetail['amount'], $places); ?>&nbsp;</td>
						<//?php endif; ?>
						<td class="left"><?php echo $npbDetail['brand']; ?></td>
						<td class="left"><?php echo $npbDetail['type']; ?></td>
						<td class="left"><?php echo $npbDetail['color']; ?></td>
						<?php if (!$this->Session->read('Npb.can_edit')) : ?>	
							  <td class="left">
									<?php echo empty($npbDetail['po_id']) ? "" :
											$this->Html->link($pos[$npbDetail['po_id']], array('controller' => 'pos', 'action' => 'view', $npbDetail['po_id'])); ?>

									<?php echo empty($npbDetail['movement_id']) ? "" :
											$this->Html->link($movements[$npbDetail['movement_id']], array('controller' => 'movements', 'action' => 'view', $npbDetail['movement_id'])); ?>
							  </td>
						<?php endif; ?>					

						<td class="actions">
							  <?php
							  if ($this->Session->read('Npb.can_set_process_type') && $npbDetail['qty_filled'] == 0 && $npb['Npb']['request_type_id'] != request_type_point_reward_id):
									echo $ajax->link('Movement', array('controller' => 'npb_details', 'action' => 'set_movement', $npbDetail['id']), array('class' => ($npbDetail['process_type_id'] == movement_process_type_id ? 'checked' : 'unchecked'),
										'id' => 'movementLink' . $npbDetail['id'],
										'indicator' => 'LoadingDiv',
										'complete' => 'toggleLink("movement",' . $npbDetail['id'] . ')'
											)
									);
									echo $ajax->link('Procurement', array('controller' => 'npb_details', 'action' => 'set_procurement', $npbDetail['id']), array('class' => $npbDetail['process_type_id'] == procurement_process_type_id ? 'checked' : 'unchecked',
										'id' => 'procurementLink' . $npbDetail['id'],
										'indicator' => 'LoadingDiv',
										'complete' => 'toggleLink("procurement",' . $npbDetail['id'] . ')'
											)
									);
							  /* echo $ajax->link('Cancel', 
								array('controller'=>'npb_details', 'action'=>'set_cancel', $npbDetail['id']),
								array('class'=> 'unchecked',
								'id'=>'cancelLink'. $npbDetail['id'],
								'indicator'=>'LoadingDiv',
								'complete'=>'cancelLink('.$npbDetail['id'].')'
								)
								); */
							  else :
									echo isset($npbDetail['process_type_id']) ? $processTypes[$npbDetail['process_type_id']] : '';
							  endif;
							  ?>

							  <?php if ($this->Session->read('Npb.can_edit')) : ?>
									<?php echo $this->Html->link(__('Delete', true), array('controller' => 'npb_details', 'action' => 'delete', $npbDetail['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $npbDetail['id'])); ?>
							  <?php endif; ?>
						</td>
					</tr>
				  <?php $total_price += $npbDetail['price_cur']; ?>
				  <?php $total_amount += $npbDetail['amount_cur']; ?>
			<?php };?>
								
                        <?php endforeach; ?>
								<//?php if($request_type_id == request_type_fa_it_id && $npb_status_id != status_npb_draft_id){?>
									<tr>
										<?php if ($this->Session->read('Npb.can_edit')) { ?>
											<td colspan="6"><div align="right">Total</div></td>
										<?php }else{ ?>
											<td colspan="7"><div align="right">Total</div></td>
										<?php } ?>
										<td class="number" align="right"><?php echo $this->Number->format($total_price) ;?>&nbsp;</td>
										<td class="number" align="right"><?php echo $this->Number->format($total_amount) ;?>&nbsp;</td>
									</tr>
								<//?php };?>
								
					<?php endif; ?>

					<?php if ($this->Session->read('Npb.can_edit')) : ?>
					
                        <tr id="newRecord">
                              <td></td>
                              <td>
                                    <?php echo $this->Form->input('item_id', array('type' => 'hidden')); ?>
                                    <?php echo $this->Form->input('Item.name', array('label' => 'Select Code - Name')); ?>
                                    <div id="item_choices" class="auto_complete"></div> 
                                    <script type="text/javascript"> 
                                          //<![CDATA[
                                          new Ajax.Autocompleter('ItemName', 'item_choices', '<?php echo BASE_URL ?>/items/auto_complete/<?php echo $request_type_id ?>', {afterUpdateElement : setItemValues});
                                          //]]>
                                    </script>
                              </td>
                              <td></td>
                              <td><?php echo $this->Form->input('qty'); ?></td>
                              <td></td>
                              <td>
								<?php if ($request_type_id == request_type_point_reward_id){
									
								}else if($request_type_id == request_type_fa_it_id && $group_id == normal_user_group_id){
								
								}else{
									echo $this->Form->input('currency_id', array('maxlength'=>'50','options'=>$currencies, 'empty'=>'')); 
								}?>
							  </td>
                              <td>
								<?php if ($request_type_id == request_type_stock_id || $request_type_id == request_type_point_reward_id){
									
								}else if($request_type_id == request_type_fa_it_id && $group_id == normal_user_group_id){
								
								}else if($request_type_id == request_type_fa_it_id && $group_id == it_admin_group_id){
									echo $this->Form->input('price', array('maxlength'=>'50'));
								}else if($request_type_id == request_type_point_reward_id && $group_id != rac_group_id && $group_id != normal_user_group_id){
									echo $this->Form->input('price', array('maxlength'=>'50'));
								}else if($request_type_id == request_type_fa_general_id){
									echo $this->Form->input('price', array('maxlength'=>'50'));
								}
								?>								
							  </td>
                              <td></td>
                              <td><?php echo $this->Form->input('brand', array('maxlength'=>'50')); ?></td>
                              <td><?php echo $this->Form->input('type', array('maxlength'=>'100')); ?></td>
                              <td><?php echo $this->Form->input('color', array('maxlength'=>'10')); ?></td>
                              <td class="actions">
                                    <?php echo $this->Form->input('npb_id', array('value' => $this->Session->read('Npb.id'), 'type' => 'hidden')); ?>
                                    <?php
                                    echo $ajax->submit('Add', array('url' => array('controller' => 'npb_details', 'action' => 'ajax_add'),
                                        'indicator' => 'LoadingDiv',
                                        'complete' => 'appendNpbDetail(request)'));
                                    ?>
                              </td>
                        </tr>
                  <?php endif; // can add more detail?>
            <?php endif; ?>
      </table>
      <?php echo $this->Form->end(); ?>
</div>

<div class="related">
      <h3><?php __('Attachments'); ?></h3>
      <?php echo $this->Form->create('Attachment', array('controller' => 'attachments', 'action' => 'add', 'type' => 'file')); ?>
      <table cellpadding = "0" cellspacing = "0">
            <tr>
                  <th><?php __('No'); ?></th>
                  <th><?php __('Name'); ?></th>
                  <th><?php __('Attachment File Name'); ?></th>
                  <th class="actions"><?php __('Actions'); ?></th>
            </tr>
            <?php if (!empty($npb['Attachment'])): ?>
                  <?php
                  $i = 0;
                  foreach ($npb['Attachment'] as $attachment):
                        $class = null;
                        if ($i++ % 2 == 0) {
                              $class = ' class="altrow"';
                        }
                        ?>
                        <tr<?php echo $class; ?>>
                              <td><?php echo $i; ?></td>
                              <td><?php echo $attachment['name']; ?> </td>
                              <td><?php echo $attachment['attachment_file_name']; ?></td>
                              <td class="actions">
                                    <?php if ($this->Session->read('Npb.can_edit')) : ?>
                                          <?php echo $this->Html->link(__('Delete', true), array('controller' => 'attachments', 'action' => 'delete', $attachment['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $attachment['id'])); ?>
                                    <?php endif; ?>
                                    <?php echo $this->Html->link(__('View', true), array('controller' => 'attachments', 'action' => 'view', $attachment['id']), array('target' => 'blank')); ?>
                              </td>
                        </tr>
                  <?php endforeach; ?>
            <?php endif; ?>

            <?php if ($can_attachment) : ?>
                  <tr id="newAttachmentRecord">
                        <td></td>
                        <td><?php echo $this->Form->input('name'); ?></td>
                        <td>
                              <?php echo $this->Form->input('MAX_FILE_SIZE', array('type' => 'hidden', 'value' => '30000000')); ?>
                              <?php echo $this->Form->file('submittedfile'); ?>
                        </td>
                        <td class="actions">
                              <?php echo $this->Form->input('npb_id', array('value' => $this->Session->read('Npb.id'), 'type' => 'hidden')); ?>
                              <?php echo $this->Form->submit('Add');
                              ?>
                        </td>
                  </tr>	
            <?php endif; ?>
      </table>	
      <?php echo $this->Form->end(); ?>

</div>

<div>
      <?php $id_npb = $npb['Npb']['id']; ?>
      <h3><?php __('Notes'); ?></h3>
      <div id="notes.<?php echo $id_npb ?>"><pre><?php echo $npb['Npb']['notes']; ?></pre></div>
      <?php if ($can_edit_price) : ?>
            <?php
            echo $ajax->editor('notes.' . $id_npb, array('action' => 'ajax_edit_notes', $id_npb), array('rows' => '10', 'cols' => '157')
            )
            ?>
      <?php endif; ?>
</div>

<!--div class="related">
	<h3><?php __('Suggested Suppliers'); ?></h3>
<?php if (!empty($npb['NpbSupplier'])): ?>
                  <table cellpadding = "0" cellspacing = "0">
                  <tr>
                        <th><?php __('No'); ?></th>
                        <th><?php __('Id Supplier'); ?></th>
                        <th><?php __('Selected'); ?></th>
                        <th><?php __('Description'); ?></th>
                        <th class="actions"><?php __('Actions'); ?></th>
            	</tr>
      <?php
      $i = 0;
      foreach ($npb['NpbSupplier'] as $npbSupplier):
            $class = null;
            if ($i++ % 2 == 0) {
                  $class = ' class="altrow"';
            }
            ?>
                                    <tr<?php echo $class; ?>>
                                          <td><?php echo $i; ?></td>
                                          <td><?php echo $npbSupplier['supplier_id']; ?> - <?php echo $npbSupplier['supplier_name']; ?></td>
                                          <td><?php echo $npbSupplier['selected']; ?></td>
                                          <td><?php echo $npbSupplier['description']; ?></td>
                                          <td class="actions">
            <?php if ($this->Session->read('Npb.can_edit')) : ?>
                  <?php if ($this->Session->read('Npb.can_select_supplier')) : ?>
                        <?php echo $this->Html->link(__('Select', true), array('controller' => 'npbs', 'action' => 'select_supplier/' . $npbSupplier['id'], $npbSupplier['supplier_id'])); ?>
                  <?php endif; ?>
                  <?php echo $this->Html->link(__('Edit', true), array('controller' => 'npb_suppliers', 'action' => 'edit', $npbSupplier['id'])); ?>
                  <?php echo $this->Html->link(__('Delete', true), array('controller' => 'npb_suppliers', 'action' => 'delete', $npbSupplier['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $npbSupplier['id'])); ?>
            <?php endif; ?>
                        			</td>
                        		</tr>
      <?php endforeach; ?>
            	</table>
<?php endif; ?>

<?php if ($this->Session->read('Npb.can_edit')) : ?>
            	<div class="actions">
            		<ul>
            			<li><?php echo $this->Html->link(__('New Npb Supplier', true), array('controller' => 'npb_suppliers', 'action' => 'add')); ?> </li>
            		</ul>
            	</div>
<?php endif; ?>
</div-->


<div class="related">
      <h3><?php __('Related POs'); ?></h3>
      <?php if (!empty($npb['Po'])): ?>
            <table cellpadding = "0" cellspacing = "0">
                  <tr>
                        <th><?php __('No'); ?></th>
                        <th><?php __('No Po'); ?></th>
                        <th><?php __('Supplier'); ?></th>
                        <th><?php __('Total'); ?></th>
                        <th class="actions"><?php __('Actions'); ?></th>
                  </tr>
                  <?php
                  $i = 0;
                  foreach ($npb['Po'] as $po):
                        $class = null;
                        if ($i++ % 2 == 0) {
                              $class = ' class="altrow"';
                        }
                        ?>
                        <tr<?php echo $class; ?>>
                              <td><?php echo $i; ?></td>
                              <td><?php echo $po['no']; ?></td>
                              <td><?php echo $suppliers[$po['supplier_id']]; ?></td>
 							  <?php $places = $myApp->getPlaces($currency[$po['currency_id']]); ?>
                              <td class="number"><?php echo $this->Number->format($po['total_cur'], $places); ?></td>
                              <td class="actions">
                                    <?php echo $this->Html->link(__('View', true), array('controller' => 'pos', 'action' => 'view', $po['id'])); ?>
                              </td>
                        </tr>
                  <?php endforeach; ?>
            </table>
      <?php endif; ?>

</div>

<script>
      function toggleLink(type,id)
      {
            if(type=='movement')
            {
                  $('movementLink'+id).addClassName('checked');
                  $('movementLink'+id).removeClassName('unchecked');
		
                  $('procurementLink'+id).addClassName('unchecked');
                  $('procurementLink'+id).removeClassName('checked');
            }
            else{
                  $('movementLink'+id).addClassName('unchecked');
                  $('movementLink'+id).removeClassName('checked');
		
                  $('procurementLink'+id).addClassName('checked');
                  $('procurementLink'+id).removeClassName('unchecked');
            }
      }
      function cancelLink(id)
      {
            $('movementLink'+id).addClassName('unchecked');
            $('movementLink'+id).removeClassName('checked');
            $('procurementLink'+id).addClassName('unchecked');
            $('procurementLink'+id).removeClassName('checked');
      }
</script>
