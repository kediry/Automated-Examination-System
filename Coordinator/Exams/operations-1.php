<?php
@session_start();
$user=@$_SESSION['user'];
if(@$user=="coordinator@aoes.com")
{
	include "../../includes/db.inc.php";
	$operation=$_REQUEST["operation"];
	$e_id=$_REQUEST["id"];
	mysql_select_db($e_id) or die(mysql_error());
	$q=mysql_query("select qid,ans from questions") or die(mysql_error());
	$k_n=0;
	$q_m=0;
	while($ar=mysql_fetch_array($q))
	{
		if($ar[1]!=NULL)
		{
			$k_n+=1;
		}
		$q_m+=1;
	}
	mysql_select_db("aoes") or die(mysql_error());
	
			switch ($operation)
			{
				case "exam_active":
					Check_Exam($e_id, $k_n, $q_m);
					exam_status($e_id, "YES");
					break;
					
				case "exam_deactive":
					exam_status($e_id, "NO");
					break;
				
				case "results_active":
					Check_Exam($e_id, $k_n, $k_n);
					results_status($e_id, "GENARATED");
					break;
					
				case "results_deactive":
					results_status($e_id, "NOT GENARATED");
					break;
					
				case "key_active":
					Check_Exam($e_id, $k_n, $k_n);
					exam_status($e_id, "NO");
					results_status($e_id, "NOT GENARATED");
					key_status($e_id, "UPLOADED");
					break;
					
				case "key_deactive":
					key_status($e_id, "$k_n");
					break;
			}
}

function exam_status($e_id, $op)
{
	if(file_exists("../../Exams/$e_id/exam.php") || $op=="NO")
	{
		$q=mysql_query("UPDATE exams SET exam_active = '$op' WHERE id = '$e_id'") or die(mysql_error());
		if($q)
		{
			echo "success";
		}
		else
		{
			echo "Something Wrong!";
		}
	}
	else
	{
		if($op=="YES")
		{
			if(RCopy("../../Exams/Source", "../../Exams/$e_id"))
			{
				$q=mysql_query("UPDATE exams SET exam_active = '$op' WHERE id = '$e_id'") or die(mysql_error());
				if($q)
				{
					echo "success";
				}
				else
				{
					echo "Something Wrong!";
				}
			}
			else
			{
				echo "Faild to Create Exam Files!";
			}
		}
	}
}

function results_status($e_id, $op)
{
	$q=mysql_query("UPDATE exams SET results = '$op' WHERE id = '$e_id'") or die(mysql_error());
	if($q)
	{
		echo "success";
	}
	else
	{
		echo "Something Wrong!";
	}
}

function key_status($e_id, $op)
{
	$q=mysql_query("UPDATE exams SET key_status = '$op' WHERE id = '$e_id'") or die(mysql_error());
	if($q)
	{
		echo "success";
	}
	else
	{
		echo "Something Wrong!";
	}
}

function Check_Exam($e_id, $k_n, $q_m)
{
	$q=mysql_query("SELECT * from exams WHERE id = '$e_id'") or die(mysql_error());
	$ar=mysql_fetch_row($q);
			$e_name=$ar[1];
			$e_type=$ar[2];
			$e_date=$ar[3];
			$no_q=$ar[4];
			$e_duration=$ar[5];
			$e_pass=$ar[6];
			$e_inv=$ar[7];
			$paper_status=$ar[8];
			$results=$ar[9];
			$key_status=$ar[10];
			$exam_active=$ar[11];
			$reg=$ar[12];
			if($e_type=="LR")
			{
				if($no_q==$q_m)
				{
					
				}
				else
				{
					die("Prepare Questions and Keys First !");
				}
			}
			else
			{
				if($no_q==$k_n)
				{
					
				}
				else
				{
					die("Prepare Questions and Keys First !");
				}
			}
}

function RCopy($src, $dst)
{
	$dir=opendir($src);
	while(false !== ( $file = readdir($dir) ))
	{
		if ( ($file != '.') && ( $file != '..' ))
		{
			if(is_dir($src.'/'.$file))
			{
				if(!is_dir($dst.'/'.$file))
				{
					mkdir($dst.'/'.$file, 0777, TRUE);
				}
				RCopy($src . '/' . $file, $dst . '/' .  $file);
			}
			else
			{
				if($file=="default.php")
				{
					$e_id=$_REQUEST["id"];
					$fp=fopen($dst."/default.php", "a+");
					$buff=<<<EOD
					<?php
					\$e_id="$e_id";
					\$query=mysql_query("select * from exams where id='\$e_id'")or die(mysql_error());
					\$ar=mysql_fetch_row(\$query);
					\$e_id=\$ar[0];
					\$e_name=\$ar[1];
					\$e_type=\$ar[2];
					\$e_date=\$ar[3];
					\$no_q=\$ar[4];
					\$e_duration=\$ar[5];
					\$e_pass=\$ar[6];
					\$e_inv=\$ar[7];
					\$paper_status=\$ar[8];
					\$results=\$ar[9];
					\$key_status=\$ar[10];
					\$exam_active=\$ar[11];
					\$reg=\$ar[12];
					\$e_ngm=\$ar[13];
					?>
EOD;
				   fwrite($fp, $buff);
				   fclose($fp);
				   continue;
				   
				}
				else if(!copy($src . '/' . $file, $dst . '/' .  $file))
				{
					return false;
				}
			}
		}
	}
	closedir($dir);
	return true;
}
?>
