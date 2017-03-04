<div id="loginForm">
	<form id="frm_login" method="post">
		<?if(isset($loginerr)): ?>
			<div class="valError" style="text-align:center"><?=$loginerr;?></div>
		<?endif;?>
			<?=$form->create('User'); ?>
			<?=$form->input('email'); ?>
			<?=$form->input('password'); ?>
			<?= $form->end(__('Login', true)); ?>
	</form>
</div>