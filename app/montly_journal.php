<?php
$url='http://10.224.15.119/journal_transactions/montly_journal';
$ch = curl_init($url);
curl_exec($ch); 
curl_close($ch); 
?>