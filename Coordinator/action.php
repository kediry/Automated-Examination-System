<?php
	session_start();
	if(isSet($_REQUEST['signout']))
	{
		if($_REQUEST['signout']=="yes")
		{
			unset($_SESSION['user']);
			?>
			<script type="text/javascript">
				document.location.href="../";
			</script>
			<?php 
		}
	}
?>
