<?php
@session_start();
include "./includes/user.php";
include "../../includes/db.inc.php";
include "./includes/default.php";
$pass=$_REQUEST['pass'];
$pass1=$_REQUEST['pass1'];
$ex=$_REQUEST['exam'];
if(($pass==$e_inv)||($pass1==$e_inv))
{
	echo "success";
}
else
{
	echo "error_2";
}
?>
