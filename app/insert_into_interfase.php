<?php
$url='http://10.224.15.119/famsys_interfaces/insert_into_csb';
$ch = curl_init($url);
curl_exec($ch); 
curl_close($ch); 
?>