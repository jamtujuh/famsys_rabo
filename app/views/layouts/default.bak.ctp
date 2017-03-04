<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	
	<title> 
		Fixed Asset Management Systems - <?php echo client_name ?> 	
	</title> 
	<link href="<?php echo BASE_URL ?>/favicon.ico" type="image/x-icon" rel="icon" /><link href="<?php echo BASE_URL ?>/favicon.ico" type="image/x-icon" rel="shortcut icon" />
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL ?>/css/cake.generic.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL ?>/css/menu-style.css" />
	<?php echo $scripts_for_layout ?>
	<?php echo $html->css('menu'); ?>
	
	</head> 
<body> 
	<div id="LoadingDiv" style="display:none"> 
		<?php echo $html->image('ajax-loader.gif'); ?> 
		Loading, please wait ....
	</div> 
	<div id="container"> 
		<div id="header"> 
			<h1><?php echo $this->Html->link('Fixed Asset Management Systems - ' . client_name, '/pages/home'); ?></h1> 
			<?php if($Security['logged_in']) :?>
				<div style="position:absolute;top:1px; left:80%">
				Welcome <?php echo  $Userinfo['username'] ?> (<?php echo  $Userinfo['department_id'] ?>) , Group Id <?php echo $Security['permissions']?>
				<br><?php echo $this->Html->link('Logout ' . $this->Session->read('Userinfo.username') , '/users/logout'); ?>
	
				</div>
			<?php endif;?>			
		</div> 
		
		<div id="menu">		

		
			<ul id="nav">
				<li class="current"><?php echo $this->Html->link('Home', '/pages/home'); ?></li>

				<?php if($Security['logged_in']) :?>
				<li><?php echo $this->Html->link('NPB', '#'); ?>
				  <ul class="sub">
					 <li><?php echo $this->Html->link('New NPB', '/npbs/add'); ?></li>
					 <li><?php echo $this->Html->link('List NPB', '/npbs/index'); ?></li>
				  </ul>
				</li>

				<li><?php echo $this->Html->link('PO', '#'); ?>
				  <ul class="sub">
					 <!--li><?php echo $this->Html->link('New PO from NPBs', '/pos/addFromNpb'); ?></li-->
					 <li><?php echo $this->Html->link('New PO', '/pos/add'); ?></li>
					 <li><?php echo $this->Html->link('List PO', '/pos/index'); ?></li>
				  </ul>
				</li>

				<li><?php echo $this->Html->link('Invoice', '#'); ?>
				  <ul class="sub">
					 <li><?php echo $this->Html->link('New Invoice', '/invoices/add'); ?></li>
					 <li><?php echo $this->Html->link('List Invoice', '/invoices/index'); ?></li>
				  </ul>
				</li>
				
				<li><?php echo $this->Html->link('Journal', '#'); ?>
				  <ul class="sub">
					 <li><?php echo $this->Html->link('List Transaction Journal', '/journal_transactions'); ?></li>
				  </ul>
				</li>

				<li><?php echo $this->Html->link('Asset', '#'); ?>
				  <ul class="sub">
					 <li><?php echo $this->Html->link('New Asset Register', '/purchases/add'); ?></li>
					 <li><?php echo $this->Html->link('List Asset Register', '/purchases/index'); ?></li>
					 <li><?php echo $this->Html->link('List FA Movement', '/movements/index'); ?></li>
					 <li><?php echo $this->Html->link('List FA Write Off', '/disposals/index/writeoff'); ?></li>
					 <li><?php echo $this->Html->link('List FA Sales', '/disposals/index/sales'); ?></li>
					 <li><?php echo $this->Html->link('New FA Movement', '/movements/add'); ?></li>
					 <li><?php echo $this->Html->link('New FA Write Off', '/disposals/add/writeoff'); ?></li>
					 <li><?php echo $this->Html->link('New FA Sales', '/disposals/add/sales'); ?></li>
					 <li><?php echo $this->Html->link('AYDA', '/aydas/index'); ?></li>
				  </ul>
				</li>

				<li><?php echo $this->Html->link('Reports', '#'); ?>
				  <ul class="sub">
					 <li><?php echo $this->Html->link('Fixed Asset Depreciation Report', '/assets/depr_report'); ?></li>
					 <li><?php echo $this->Html->link('Fixed Asset Detail Depreciation Report', '/asset_details/depr_report'); ?></li>
					 <li><?php echo $this->Html->link('Fixed Asset Movement', '/assets/movement_report'); ?></li>
					 <li><?php echo $this->Html->link('Fixed Asset Purchase', '/assets/purchase_report'); ?></li>
					 <li><?php echo $this->Html->link('Fixed Asset Depreciation Recapitulation', '/assets/depr_recap_report'); ?></li>
					 <li><?php echo $this->Html->link('Fixed Asset Recapitulation', '/assets/recap_report'); ?></li>
					 <li><?php echo $this->Html->link('Process Depreciation', '/assets/process_depr'); ?></li>
				  </ul>
				</li>

				<li><?php echo $this->Html->link('Master Data', '#'); ?>
				  <ul class="sub">
					<li><?php echo $this->Html->link(__('Asset Category',true), '/asset_categories'); ?></li>
					<li><?php echo $this->Html->link(__('GL Accounts',true), '/accounts'); ?></li>
					<li><?php echo $this->Html->link(__('Department',true), '/departments'); ?></li>
					<li><?php echo $this->Html->link(__('Location',true), '/locations'); ?></li>
					<li><?php echo $this->Html->link(__('Supplier',true), '/suppliers'); ?></li>
					<li><?php echo $this->Html->link(__('Warranty',true), '/warranties'); ?></li>
					<li><?php echo $this->Html->link(__('Requester',true), '/requesters'); ?></li>
					<li><?php echo $this->Html->link(__('Currency',true), '/currencies'); ?></li>
					<li><?php echo $this->Html->link(__('Item',true), '/items'); ?></li>
					<li><?php echo $this->Html->link(__('NPB Status',true), '/npb_statuses'); ?></li>
					<li><?php echo $this->Html->link(__('PO Status',true), '/po_statuses'); ?></li>
					<li><?php echo $this->Html->link(__('User',true), '/users'); ?></li>
					<li><?php echo $this->Html->link(__('Group',true), '/groups'); ?></li>
					<li><?php echo $this->Html->link(__('Menu',true), '/menus'); ?></li>
					<li><?php echo $this->Html->link(__('System Configuration',true), '/configs'); ?></li>
					<li><?php echo $this->Html->link(__('Journal Group',true), '/journal_groups'); ?></li>
					<li><?php echo $this->Html->link(__('Journal Template',true), '/journal_templates'); ?></li>
				  </ul>
				</li>				
				<!--li>
					<?php echo $this->Html->link('Logout ' . $this->Session->read('Userinfo.username') , '/users/logout'); ?>
				</li-->
				<?php else :?>
				<li>
					<?php echo $this->Html->link('Login', '/users/login'); ?>
				</li>
				<?php endif;?>
			</ul>
		</div>
		
		<div id="content"> 
			<?php echo $session->flash();?>
			<?php echo $content_for_layout ?>
		</div> 
		
		<div id="footer"> 
		&copy; 2011 skyworx.com
		</div> 
	</div> 
	
	<?php echo $this->element('sql_dump'); ?>

	</body> 
</html>