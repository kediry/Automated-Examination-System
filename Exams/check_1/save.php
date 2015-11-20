<?php
include "./includes/user.php";
include "../../includes/db.inc.php";
include "./includes/default.php";
mysql_select_db($e_id) or die(mysql_error());
		$id=$_SESSION['e-user'];
		$sec=$_REQUEST['sect'];
		$q=$_REQUEST['q'];
		$ans=$_REQUEST['ans'];
		if($e_type=="SR")
		{	
			$mark=mysql_query("SELECT ans FROM questions WHERE qid='$q'");
			$marks=mysql_fetch_row($mark);
			$count=0;
			if($ans==$marks[0])
			{
				$count=1;
			}
			else
			{
				$count=$count-$e_ngm;
			}
			$r=mysql_query("SELECT * FROM exam WHERE id='$id' AND q='$q'");
			if(mysql_affected_rows()>0)
			{
				mysql_query("UPDATE exam SET ans='$ans',mark=$count WHERE id='$id' AND q='$q'")or die(mysql_error());
			}
			else
			{
				echo "INSERT INTO exam VALUES('$id',1,$q,'$ans',$count)";
			     mysql_query("INSERT INTO exam VALUES('$id',1,$q,'$ans',$count)")or die(mysql_error());
			     echo "INSERT INTO exam VALUES('$id',1,$q,'$ans',$count)";
			}
		}
		if($e_type=="LR")
		{	
			$r=mysql_query("SELECT * FROM exam WHERE id='$id' AND q='$q'");
			if(mysql_affected_rows()>0)
			{
				mysql_query("UPDATE exam SET ans='$ans' WHERE id='$id' AND q='$q'")or die(mysql_error());
			}
			else
			{
			     mysql_query("INSERT INTO exam VALUES('$id',1,$q,'$ans')")or die(mysql_error());
			}
		}

