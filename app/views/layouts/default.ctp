<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
    <head> 
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	
		<title> 
			<?php echo $title_for_layout  ;/* $myMenu->title_favicon($this->Session->read('Menu.main')) */ ?> - 
			<?php echo client_name ?> 
		</title> 
		<link href="<?php echo BASE_URL ?>/favicon.ico" type="image/x-icon" rel="icon" />
		<link href="<?php echo BASE_URL ?>/favicon.ico" type="image/x-icon" rel="shortcut icon" />
		<?php e($javascript->link('prototype')); ?>
		<?php e($javascript->link('scriptaculous')); ?>
		<?php e($javascript->link('timeout')); ?>
		<?php e($javascript->link('back_space')); ?>
		<?php echo $scripts_for_layout ?>

		<?php echo $html->css('cake.generic.css'); ?>
		<?php echo $html->css('menu'); ?>	
    </head> 
    <body onload="init('<?php echo BASE_URL?>', '<? echo $this->Session->read('idle_time')?>')"> 
		<div id="LoadingDiv" style="display:none"> 
			<?php echo $html->image('ajax-loader.gif'); ?> 
			Loading, please wait ....
		</div> 

            <div id="container"> 

                <div id="header"> 
					<h1><?php echo $this->Html->link('Fixed Asset Management Systems - ' . client_name, '/pages/home'); ?></h1> 
					<?php if ($Security['logged_in']) : ?>
						<div style="position:absolute;top:1px; left:65%">
							Welcome <?php echo $Userinfo['name'] ?> [<?php echo $this->Html->link('Logout', '/users/logout', array('style' => 'color:red')); ?>]
							<br><?php __('Department') ?>: <?php echo $Userinfo['department_name'] ?>
							<br>
							<?php if($Userinfo['cost_center_name']){?>
								<?php __('Cost Center') ?>: <?php echo $Userinfo['business_type_name'] ?> <?php echo $Userinfo['cost_center_name'] ?>
							<?php }else{?>
								<?php __('Cost Center') ?>: <?php echo $Userinfo['business_type_name'] ?>
							<?php };?>
							<?php //if(!empty($Userinfo['department_sub_name'])) :?>
							<?php //__('Department Sub')?> <?php //echo $Userinfo['department_sub_name'] ?>
							<?php //endif;?>
							<br>
							<?php //if(!empty($Userinfo['department_unit_name'])) :?>
							<?php ///__('Department Unit')?> <?php //echo $Userinfo['department_unit_name'] ?>
							<?php ///endif;?>
							<?php __('Group') ?>: <?php echo $Userinfo['group_name'] ?>
						</div>
					<?php endif; ?>			
				</div> 

				<?php 
					if($this->Session->read('ric.custom.password_is_expired')===null){
						echo $myMenu->render($session->read('Menu.main')); 
					}
				?>

				<div id="content"> 
					<?php echo $session->flash(); ?>
					<?php echo $content_for_layout ?>
				</div> 

				<div id="footer"> 
					&copy; 2011 RABOBANK INTERNATIONAL INDONESIA
				</div> 
			</div> 

			<?php echo $this->element('sql_dump'); ?>

	</body> 
</html>