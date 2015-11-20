<?php
include "./includes/user.php";
include "../../includes/db.inc.php";
include "./includes/default.php";
mysql_select_db($e_id);
$min=$_REQUEST['min'];
$sec=$_REQUEST['sec'];
mysql_query("UPDATE time SET min=$min,sec=$sec WHERE id='$user'") or die(mysql_error());

?>

