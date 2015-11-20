<?php
@session_start();
$user="";
if(isSet($_SESSION['login']))
{
	$log=$_SESSION['login'];
	if($log=="user")
	{
		$user=$_SESSION['e-user'];
	}
	else
	{
		?>
		<script type="text/javascript">
			document.location.href="./index.php";
		</script>
		<?php
		die("--Error: Please Login!");
	}
}
else
{
	?>
	<script type="text/javascript">
		document.location.href="./index.php";
	</script>
	<?php
	die("--Error: Please Login!");
}
?>
