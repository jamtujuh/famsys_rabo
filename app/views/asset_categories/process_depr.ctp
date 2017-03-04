<?
	echo $this->Html->link(__('Home', true), '/pages/home' ); 
	echo $this->Html->link(__('Asset Depr.', true), array('controller'=>'asset', 'action'=>'depr_report') );
	echo $this->Html->link(__('Asset Details Depr.', true), array('controller'=>'asset_details', 'action'=>'depr_report') );
	echo $this->Html->link(__('List Purchases', true), array('controller'=>'purchases', 'action'=>'index') ); 
?>