<?php
@session_start();
$user=@$_SESSION['user'];
$fname=@$_SESSION['fname'];
if(@$user=="coordinator@aoes.com")
{
include "../../includes/db.inc.php";
$e_id=str_replace("'", "\'", $_REQUEST["id"]);
$e_name=str_replace("'", "\'", $_REQUEST["name"]);
$e_type=str_replace("'", "\'", $_REQUEST["type"]);
$no_q=str_replace("'", "\'", $_REQUEST["no_questions"]);
$e_ngm=str_replace("'", "\'", $_REQUEST["date"]);  //negitive marks
$e_duration=str_replace("'", "\'", $_REQUEST["duration"]);
$e_pass=str_replace("'", "\'", $_REQUEST["e_pass"]);
$e_inv=str_replace("'", "\'", $_REQUEST["e_inv"]);
	$q="create database $e_id";
	$q1=mysql_query($q) or die(mysql_error()."<br> Try to choose different Exam ID");
	if($q1)
	{
		if(mysql_select_db("$e_id"))
		{
			$q="CREATE TABLE IF NOT EXISTS `questions` (
					 `qid` int(11) NOT NULL,
					 `sid` int(11) DEFAULT NULL,
					  `q` text,
					  `nop` int(11) DEFAULT NULL,
					  `ans` text,
					  `a` text,
					  `b` text,
					  `c` text,
					  `d` text,
					  `e` text,
					  `f` text,
					  `g` text,
					  `h` text,
					  PRIMARY KEY (`qid`)
					) ENGINE=MyISAM DEFAULT CHARSET=utf8";
			$q1=mysql_query($q)or die(goToDie());

			$q1="CREATE TABLE IF NOT EXISTS `time` (
					  `min` int(11) NOT NULL,
					  `sec` int(11) NOT NULL,
					  `id` varchar(50) NOT NULL,
					  PRIMARY KEY (`id`)
					) ENGINE=InnoDB DEFAULT CHARSET=latin1";
			mysql_query($q1)or die(goToDie());
			if($e_type=="SR")
			{
				$q1="CREATE TABLE IF NOT EXISTS `exam` (
						  `id` varchar(50) NOT NULL,
						  `sec` int(11) NOT NULL,
						  `q` int(11) NOT NULL,
						  `ans` text NOT NULL,
						  `mark` varchar(11) NOT NULL
						) ENGINE=InnoDB DEFAULT CHARSET=latin1";
				mysql_query($q1)or die(goToDie());
			}
			else
			{
				$q1="CREATE TABLE IF NOT EXISTS `exam` (
						  `id` varchar(50) NOT NULL,
						  `sec` int(11) NOT NULL,
						  `q` int(11) NOT NULL,
						  `ans` text NOT NULL
						) ENGINE=InnoDB DEFAULT CHARSET=latin1";
				mysql_query($q1)or die(goToDie());
			}
			
			$q="CREATE TABLE IF NOT EXISTS `results` (
					  `id` varchar(50) NOT NULL,
					  `marks` text NOT NULL,
					  PRIMARY KEY (`id`)
					) ENGINE=InnoDB DEFAULT CHARSET=latin1";
			$q1=mysql_query($q) or die(goToDie());
			
				if(is_dir("../../Exams/") && mkdir("../../Exams/".$e_id, 0777, TRUE))
				{
					mysql_select_db("aoes");
					$q="insert into exams values('$e_id', '$e_name', '$e_type', NOW(), $no_q, '$e_duration','$e_pass', '$e_inv', default, default, default, default, default, '$e_ngm')";
					if($e_type=="SR")
					{
						$q="insert into exams values('$e_id', '$e_name', '$e_type', NOW(), $no_q, '$e_duration','$e_pass', '$e_inv', default, 'SPOT RESULTS', default, default, default, '$e_ngm')";
					}
						$q1=mysql_query($q);
						if($q1)
						{
							echo "success";
						}
						else
						{
							echo mysql_error();
							$q=mysql_query("drop DATABASE $e_id");
						}
					}
					else
					{
						echo "Error: Unable to create $e_id folder make sure 'es-1' directory writable!";
						$q=mysql_query("drop DATABASE $e_id");
					}
				}
				else
				{
					echo mysql_error();
					$q=mysql_query("drop DATABASE $e_id");
				}
		}
		else
		{
			echo mysql_error();
			$q=mysql_query("drop DATABASE $e_id") or die(mysql_error());
		}
	}

function goToDie()
{
	echo mysql_error();
	$q=mysql_query("drop DATABASE $e_id") or die(mysql_error());
}
?>
