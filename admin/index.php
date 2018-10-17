<?php require_once("../resources/config.php");?>
<?php include(TEMPLATE_BACK . DS . "header.php"); ?>
<?php
	if(!isset($_SESSION['username'])) {
		redirect("login.php");
	}

?>
        <div id="page-wrapper">

            <div class="container-fluid">

                 <?php
				 if($_SERVER['REQUEST_URI'] == "/agni-rokkhi/admin/" || $_SERVER['REQUEST_URI'] == "/agni-rokkhi/admin/index.php") {
					 include(TEMPLATE_BACK . DS . "admin_content.php");
				 }
				 if(isset($_GET['fire_alert'])) {
					 include(TEMPLATE_BACK . DS . "fire_alert.php");
				 }
				 
				 
				 ?>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include(TEMPLATE_BACK . DS . "footer.php"); ?>