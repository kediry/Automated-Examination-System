<?php
/*echo mt_rand(1,6);
echo mt_rand(1,6);
echo mt_rand(1,6);
echo mt_rand(1,6);
echo mt_rand(1,6);
echo mt_rand(1,6);*/
@session_start();
$user=@$_SESSION['user'];
$fname=@$_SESSION['fname'];
if(@$user=="coordinator@aoes.com")
{
	$user="Coordinator";
	include "../../includes/db.inc.php";
	
?>

<div  class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
					     <div id="CPU">
                                            <input type="text" class="knob" data-readonly="true" data-width="60" data-height="60" data-fgColor="#f56954"/>
                                            </div>
</div><!-- ./col -->

<script type="text/javascript">
	i=0;
	k=0;
	nani();
	function nani()
	{
		if(i<=<?php echo "100"; ?>)
		{
			setTimeout("nani()",5);
			$(".knob").remove();
			$("#CPU").html("<input type='text' class='knob' value='"+i+"' data-readonly='true' data-width='60' data-height='60' data-fgColor='green'/>");
			$(".knob").knob();
		}
		i++;
	}
	function nani1()
	{
		
	}

		
</script>
<?php 
}
else
{
	
}
?>
