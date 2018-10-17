<?php require_once("../resources/config.php");?>
<!DOCTYPE HTML>
<html lang="zxx">

<head>
	<title>Agni-Rakkhi | Login</title>
	<!-- Meta-Tags -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<meta name="keywords" content="Particles Login Form Form a Responsive Web Template, Bootstrap Web Templates, Flat Web Templates, Android Compatible Web Template, Smartphone Compatible Web Template, Free Webdesigns for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design">
	<script>
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!-- //Meta-Tags -->
	<!-- Stylesheets -->
	<link href="css/login.css" rel='stylesheet' type='text/css' />
	<!-- online fonts-->
	<link href="https://fonts.googleapis.com/css?family=Amiri:400,400i,700,700i" rel="stylesheet">
</head>

<body>
	<!--  particles  -->
	<div id="particles-js"></div>
	<!-- //particles -->
	<div class="w3ls-pos">
		<h1>Content Management System</h1>
		<h2 class="text-center bg-warning" style="color:red;font-size:25px;"><?php //display_message(); ?></h2>
		<div class="w3ls-login box">
			<!-- form starts here -->
			<form action="" method="post" enctype="multipart/form-data">
				<?php login_admin(); ?>
				<div class="agile-field-txt">
					<input type="text" name="username" placeholder="username" required="" />
				</div>
				<div class="agile-field-txt">
					<input type="password" name="password" placeholder="password" required="" id="myInput" />
					
				</div>
				<div class="w3ls-bot">
					<input type="submit" name="login" value="LOGIN">
				</div>
			</form>
		</div>
		<!-- //form ends here -->
		<!--copyright-->
		<div class="copy-wthree">
			<p>© ISTT_Abacus_Xtreme</p>
		</div>
		<!--//copyright-->
	</div>
	<!-- scripts required  for particle effect -->
	<script src='js/login_js/particles.min.js'></script>
	<script src="js/login_js/index.js"></script>
	<!-- //scripts required for particle effect -->
</body>

</html>