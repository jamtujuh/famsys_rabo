<?php
//header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
//header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
//header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
//header ("Content-type: application/vnd.ms-excel");
header("Content-type: text/csv; charset=UTF-8");
header ("Content-Disposition: attachment; filename=\"" .__('Journal', true).'-'. gmdate("d M Y") . ".csv" );
//header ("Content-Description: Generated Report" );

echo $header;
echo $detail;
?>