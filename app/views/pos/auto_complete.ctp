<ul>
<?php foreach($pos as $po): ?>
<li po_id="<?php echo $po['Po']['id']; ?>"><?php echo $po['Po']['no']; ?></li>
<?php endforeach; ?>
</ul>