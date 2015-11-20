<?php
//$db_name="nnnn";
$db_name="aoes";
//$file1="../includes/dbb.php";
$file1="../includes/db.inc.php";
if(@($_REQUEST['K']=="OK"))
{
	$db_host=$_REQUEST['dhost'];
	$db_user=$_REQUEST['duser'];
	$db_pass=$_REQUEST['dpass'];
	

	$c_name=str_replace("'","\'",$_REQUEST['cname']);
	$c_pass=str_replace("'","\'",$_REQUEST['cpass']);
	
	//echo $db_host."<br>".$db_user."<br>".$db_pass."<br>".$c_name."<br>".$c_pass;
	
	$fp=fopen($file1, "w+") or die("--Error: Faild to Creating DB file Please give Read and Write Permissions to all users");
					$buff=<<<EOD
					<?php
					\$db_host="$db_host";
					\$db_user="$db_user";
					\$db_pass="$db_pass";
					
					mysql_connect(\$db_host, \$db_user, \$db_pass);
					mysql_select_db("aoes") or die(mysql_error());
					
					?>
EOD;
					 fwrite($fp, $buff) or die("--Error: Faild to Creating DB file Please give Read and Write Permissions to all users");
					 fclose($fp);
					 mysql_connect($db_host, $db_user, $db_pass);
					 if(mysql_query("create database $db_name"))
					 {
						 if(mysql_select_db($db_name))
						 {
							 $q="CREATE TABLE IF NOT EXISTS `accounts` (
										  `fname` varchar(30) NOT NULL,
										  `uname` varchar(30) NOT NULL,
										  `passwd` varchar(30) NOT NULL,
										  `gen` varchar(30) NOT NULL,
										  `dob` varchar(30) NOT NULL,
										  `edu` varchar(30) NOT NULL,
										  `add` varchar(30) NOT NULL,
										  `email` varchar(30) NOT NULL,
										  `pno` varchar(12) NOT NULL,
										  `sq` varchar(30) NOT NULL,
										  `ans` varchar(30) NOT NULL,
										  PRIMARY KEY (`uname`)
										) ENGINE=InnoDB DEFAULT CHARSET=latin1";
								$q1=mysql_query($q)or die(goToDie());
								
								$q="CREATE TABLE IF NOT EXISTS `exams` (
										  `id` varchar(30) NOT NULL,
										  `name` text NOT NULL,
										  `type` varchar(20) NOT NULL,
										  `date` date NOT NULL,
										  `no_questions` int(11) NOT NULL,
										  `duration` varchar(10) NOT NULL,
										  `pass` text NOT NULL,
										  `inv_pass` text NOT NULL,
										  `paper_status` varchar(50) NOT NULL DEFAULT 'NOT PREPARED',
										  `results` varchar(30) NOT NULL DEFAULT 'NOT GENARATED',
										  `key_status` varchar(30) NOT NULL DEFAULT 'NOT UPLOADED',
										  `exam_active` varchar(30) NOT NULL DEFAULT 'NO',
										  `reg` varchar(30) NOT NULL DEFAULT 'NOT OPEND',
										  `ngm` varchar(10) NOT NULL,
										  PRIMARY KEY (`id`)
										) ENGINE=InnoDB DEFAULT CHARSET=latin1";
								$q1=mysql_query($q)or die(goToDie());
								
								$q="insert into accounts values('$c_name', 'coordinator@aoes.com', '$c_pass', '', '', '', '', 'coordinator@aoes.com', '', '', '')";
								mysql_query($q);
								if(mysql_affected_rows()>0)
								{
									?>
									<script type="text/javascript">
										window.location="del.php";
									</script>
									<?php
								}
								else
								{
									die(goToDie());
								}
						 }
						 else
						 {
							 die(mysql_error());
						 }
					}
					else
					{
						die(mysql_error());
					}
}

function goToDie()
{
	echo mysql_error();
	$q=mysql_query("drop DATABASE $db_name") or die(mysql_error());
}
?>
