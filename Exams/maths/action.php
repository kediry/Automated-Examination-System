<?php
	session_start();
	if(isSet($_REQUEST['signout']))
	{
		if($_REQUEST['signout']=="yes")
		{
			unset($_SESSION['user']);
			unset($_SESSION['e-user']);
			unset($_SESSION['login']);
			unset($_SESSION['exam_user']);
			?>
			<script type="text/javascript">
				document.location.href="../";
			</script>
			<?php 
		}
	}
?>
