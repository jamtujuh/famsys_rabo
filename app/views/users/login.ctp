<?php if($cutOn < date('H:i:s') && $cutOff > date('H:i:s')): ?>
<div id="loginForm">
	<?php if(isset($login_message)): ?>
		<h3><?php echo __('WARNING : ');?><?php echo $login_message ;?></h3>
	<?php endif;?>

	<?php echo $form->create('User'); ?>
	<?php echo $form->input('ad_user', array('label'=>'User Login')); ?>
	<?php echo $form->input('password'); ?>
	<?php echo $form->end(__('Login', true)); ?>
</div>
<?php endif;?>