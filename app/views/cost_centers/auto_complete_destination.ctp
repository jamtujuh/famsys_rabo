<ul>
<?php foreach($costCenters as $costCenter): ?>
<li cost_center_id="<?php echo $costCenter['CostCenter']['id']; ?>"><?php echo $costCenter['CostCenter']['cost_centers']; ?> - <?php echo $costCenter['CostCenter']['name']; ?></li>
<?php endforeach; ?>
</ul>