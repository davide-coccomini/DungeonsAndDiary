<?php
$host = 'localhost';
$user = 'root';
$pass = null;
$db = 'calendario';
$con = @mysql_connect($host,$user,$pass) or die (mysql_error());
$sel = @mysql_select_db($db) or die (mysql_error());
?>