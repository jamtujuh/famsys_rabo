<ul>
<?php foreach($currencies as $currency): ?>
<li currency_id="<?php echo $currency['Currency']['id']; ?>"><?php echo $currency['Currency']['name']; ?></li>
<?php endforeach; ?>
</ul>