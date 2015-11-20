<?php
@session_start();
$user=@$_SESSION['user'];
$fname=@$_SESSION['fname'];
if(@$user=="coordinator@aoes.com")
{
	if(isSet($_REQUEST['id']))
	{
			$e_id=$_REQUEST['id'];
			$e_type=$_REQUEST['type'];
			$e_ngm=$_REQUEST['ngm'];
			$e_name=$_REQUEST['ename'];
			include "../../includes/db.inc.php";
			mysql_select_db($e_id);
			
			
			header("Content-type: application/vnd.ms-excel; name='excel'");
			header("Content-Disposition: attachment; filename=Results_$e_id.xls");
			header("Pragma: no-cache");
			header("Expires: 0");
			
			
		$z=mysql_query("select id from time where min=-1 and sec=60") or die(mysql_error());
		?>
		<table border='1'>
			<tr>
				<th colspan='4' bgcolor="#C8C8C8" height="15px"><h3><?php echo $e_name; ?></h3></th>
			</tr>
			<tr>
				<th bgcolor="#E8E8E8">ID</th><th bgcolor="#E8E8E8">Positive Marks</th><th bgcolor="#E8E8E8">Negitive Marks</th><th bgcolor="#E8E8E8">Total Marks</th>
			</tr>
		<?php
		while($uk=mysql_fetch_array($z))
		{
						$u=$uk[0];
						$q=mysql_query("select * from exam where id='$u'") or die(mysql_error());
							$pm=0;
							$nm=0;
							$no_qq=0;
							if($e_type=="SR")
							{
								while($r=mysql_fetch_array($q))
								{
									$qq=$r[2];
									$ans=$r[3];
									$mark=$r[4];
									if(strncmp("-", $mark, 1))
									{
										$pm+=$mark;
									}
									else
									{
										$nm+=$mark;
									}
									$no_qq+=1;
								}
								//echo $no_qq;
							}
							if($e_type=="LR")
							{
								$query=mysql_query("select qid,ans from questions order by qid asc") or die(mysql_error());
								while($r=mysql_fetch_array($query))
								{
									$qid=$r[0];
									$ans=$r[1];
									$ans1=mysql_query("SELECT ans FROM exam WHERE id='$u' AND sec=1 AND q=$qid");
									if(mysql_affected_rows()>0)
									{
										$answ=mysql_fetch_row($ans1);
										if($ans==$answ[0])
										{
											$pm+=1;
										}
										else
										{
											$nm-=$e_ngm;
										}
										$no_qq+=1;
									}
								}	
							}
							?>
							<tr>
								<td><?php echo $u; ?></td>
								<td><?php echo $pm; ?></td>
								<td><?php echo $nm; ?></td>
								<td><?php echo $pm+$nm; ?></td>
							</tr>
							<?php
							
			}
			echo "</table>";
	}
}
else
{
	?>
	<script type='text/javascript'>
		window.location="../"
	</script>
	<?php
}
