<ul>
<?php foreach($items as $item): ?>
<li item_id="<?php echo $item['Item']['id']; ?>"><?php echo $item['Item']['code']; ?> - <?php echo $item['Item']['name']; ?></li>
<?php endforeach; ?>
</ul>