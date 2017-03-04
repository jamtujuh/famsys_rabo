<?php 
$server = '10.224.15.119';
$user = 'rabobank';
$password = 'r4b0b4nk';
// Connect to MSSQL
$con = mssql_connect($server, $user, $password);

if (!$con) {
    die('Something went wrong while connecting to MSSQL');
}

mssql_select_db("famsys", $con);

mssql_query("update assets set posting = 0");

mssql_close($con);
?>