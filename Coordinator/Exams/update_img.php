<?php
@session_start();
$user=@$_SESSION['user'];
if(@$user=="coordinator@aoes.com")
{
	include "../../includes/db.inc.php";
	$e_id = $_REQUEST["exam"];
	$q_no = $_REQUEST["q_no"];
	$no_options = $_REQUEST["no_options"];
	if((($_FILES["question"]["type"] == "image/png") || ($_FILES["question"]["type"]=="image/jpeg") || ($_FILES["question"]["type"]=="image/jpg") || ($_FILES["question"]["type"]=="image/gif")) && ($_FILES["question"]["size"] < 204800))
	{
		if($_FILES["question"]["error"] > 0)
		{
			die("Return code: ".$_FILES["question"]["error"]."<br>");
		}
		$name = $_FILES["question"]["name"];
		$ext = pathinfo($name, PATHINFO_EXTENSION);
		$img_name=md5($q_no).".".$ext;

		/*if($ext == "jpg" || $ext == "jpeg")
		{
			$upf = $_FILES["question"]["tmp_name"];
			$src = imagecreatefromjpeg($upf) or die("Invalid file!");
		}
		else if($ext == "png")
		{
			$upf = $_FILES["question"]["tmp_name"];
			$src = imagecreatefrompng($upf) or die("Invalid file!");
		}
		else
		{
			$upf = $_FILES["question"]["tmp_name"];
			$src = imagecreatefromgif($upf) or die("Invalid file!");
		}*/

		list($width, $height) = getimagesize($upf);

		echo "$width X $height";
		$check=0;
		if(is_dir("../../Exams/$e_id") && is_writable("../../Exams/$e_id"))
		{
			if(is_dir("../../Exams/$e_id/includes/img") &&  is_writable("../../Exams/$e_id/includes/img"))
			{
				if(file_exists("../../Exams/$e_id/includes/img/".$img_name))
				{
					if(unlink("../../Exams/$e_id/includes/img/".$img_name))
					{
						move_uploaded_file($_FILES["question"]["tmp_name"], "../../Exams/$e_id/includes/img/".$img_name) or die("Faild to Move file into ../../Exams/$e_id/includes/img/");
						$check=1;
					}
					else
					{
						//genarate mail;
					}
				}
				else
				{
					move_uploaded_file($_FILES["question"]["tmp_name"], "../../Exams/$e_id/includes/img/".$img_name) or die("Faild to Move file into ../../Exams/$e_id/includes/img/");
					$check=1;
				}
			}
			else
			{
				mkdir("../../Exams/$e_id/includes", 0777, TRUE) or die();
				chmod("../../Exams/$e_id/includes", 0777) or die();
				mkdir("../../Exams/$e_id/includes/img", 0777, TRUE) or die();
				chmod("../../Exams/$e_id/includes/img", 0777)or die();

				if(file_exists("../../Exams/$e_id/includes/img/".$img_name))
				{
					if(unlink("../../Exams/$e_id/includes/img/".$img_name))
					{
						move_uploaded_file($_FILES["question"]["tmp_name"], "../../Exams/$e_id/includes/img/".$img_name) or die("Faild to Move file into ../../Exams/$e_id/includes/img/");
						$check=1;
					}
					else
					{
						//genarate mail;
					}
				}
				else
				{
					move_uploaded_file($_FILES["question"]["tmp_name"], "../../Exams/$e_id/includes/img/".$img_name) or die("Faild to Move file into ../../Exams/$e_id/includes/img/");
					$check=1;
				}
			}
		}
		else
		{
			die("Exams folder is not existed in root directory or It was not writable !");
		}
		
	//Storing into database
		$options=array("","A", "B", "C", "D", "E", "F", "G", "H");
		$opp=array("", "a", "b", "c", "d", "e", "f", "g", "h");
		$q=mysql_query("use $e_id") or die(mysql_error());
		if($q && ($check>0))
		{
			$query="update questions set q='<img src=/includes/img/$img_name />', nop=$no_options";
			for($i=1;$i<=8;$i++)
			{
				if($i<=$no_options)
				{
					$query=$query.", ".$opp[$i]."= '".$options[$i]."'";
				}
				else
				{
					$query=$query.", ".$opp[$i]."= default ";
				}
			}
			$query=$query." where qid=$q_no";
			$result=mysql_query($query)or die(mysql_error());
			if($result)
			{
						echo "success";
			}
		}
	//Storing into database
		
	}
	else
	{
		echo "Upload Image files of format '.jpg' or '.jpeg' or '.png' or '.gif' which are less than '2MB' !";
	}
}
?>
