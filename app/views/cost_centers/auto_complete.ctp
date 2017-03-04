<ul>
<?php foreach($costCenters as $costCenter): ?>
	<li cost_center_id="<?php echo $costCenter[0]['id']; ?>"><?php echo $costCenter[0]['name']; ?> - <?php echo $costCenter[0]['t24_dao']; ?></li>
<?php endforeach; ?>
</ul>