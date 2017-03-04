<ul>
<?php foreach($assets as $asset): ?>
<li asset_id="<?php echo $asset['Asset']['id']; ?>"><?php echo $asset['Asset']['code']; ?> - <?php echo $asset['Asset']['name']; ?></li>
<?php endforeach; ?>
</ul>