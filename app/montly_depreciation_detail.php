<?php
$url='http://10.224.15.119/asset_details/process_depr';
$ch = curl_init($url);
curl_exec($ch); 
curl_close($ch); 
?>