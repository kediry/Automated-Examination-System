<html>
	<head>
        <title>Coordinator | </title>
        <?php include "css.php"; ?>
    </head>
<body class="skin-black fixed">
		
<?php
session_start();
$user=@$_SESSION['user'];
$fname=@$_SESSION['fname'];
if(@$user=="coordinator@aoes.com")
{
	$user="Coordinator";
	include "head.php";
	?>

        <div class="wrapper row-offcanvas row-offcanvas-left"><!-- wrapper -->
           
	<?php include "left.php"; ?>

	<!-- Main Content -->
            <aside class="right-side">

		 <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Dashboard
                        <small>Control panel</small>
                    </h1>
                </section>

         <!-- content -->
        <section class="content">

				<div class="row" id="alerts">
				</div>
				
				<div id="main-content"><!-- navigation content -->
					
				<div class="row"><!-- First Row -->
				
					<div class="col-lg-3 col-xs-6">
						<div class="small-box bg-aqua">
							<div class="inner">
								<h3>+1</h3>
								<p>Create New Exam</p>
							</div>
							<div class="icon">
								<i class="fa fa-pencil-square-o"></i>
							</div>
							<a href="#" class="btn small-box-footer" data-toggle="modal" data-target="#compose-modal">Click Here<i class="fa fa-arrow-circle-right"></i>
							</a>
						</div>
					</div><!-- 1st column -->
					
				</div><!-- end navigation main content -->

				</div>

		</section>
		    
            </aside>
	<!--End Main Content -->
	
	 </div><!-- ./wrapper -->
	 

	 <!-- jQuery 2.0.2 -->
        <script src="../includes/js/jquery.min.js" type="text/javascript"></script>
	<!--Creating Exam -->
	<?php 
		include "Create_Exam/index.php";

		include "js.php";
}
else
{
	?>
	<script type="text/javascript">
				document.location.href="../";
	</script>
	<?php 
}
?>
</body>
</html>
