<ul>
<?php foreach($suppliers as $supplier): ?>
<li supplier_id="<?php echo $supplier['Supplier']['id']; ?>"><?php echo $supplier['Supplier']['name']; ?></li>
<?php endforeach; ?>
</ul>