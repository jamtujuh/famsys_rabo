<?php
$url='http://10.224.15.119/journal_transactions/journal_interfase';
$ch = curl_init($url);
curl_exec($ch); 
curl_close($ch); 
?>