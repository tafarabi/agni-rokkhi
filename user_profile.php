<?php require_once("resources/config.php");?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Abacus_Xtreme</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="shortcut icon" href="assets/images/favicon.html">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel="stylesheet" href="assets/css/responsive.css">

</head>

<body>
    <div class="se-pre-con"></div>
    <div class="container" style="background:#164B8D;width:100%;">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header logoo">
            <button id="tog-btn" type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!--<a class="navbar-brand" href="#home-section"><img class="img-responsive" src="assets/images/logo.png"></a>-->
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            
            <ul class="nav navbar-nav navbar-right hidden-xs hidden-sm">
                <li class="gold"><a href="logout.php"><button class="  btn btn-gradient outline-button" style="margin-bottom: 0px;" data-toggle="modal" data-target="#pop-login">
                            <div style="background: #1C589B;transition: all 0.3s;">Logout</div>
                        </button></a></li>
            </ul>
			
			<ul class="nav navbar-nav navbar-right hidden-xs hidden-sm">
                <li class="gold"><a href="javascript:;"><button class="  btn btn-gradient outline-button" style="margin-bottom: 0px;" data-toggle="modal" data-target="#pop-notification">
                            <div style="background: #1C589B;transition: all 0.3s;">Notifications  <sup style="color:#18FFFF; font-size:16px;"><?php notifications(); ?></sup></div>
                        </button></a></li>
            </ul>
			
            <ul class="nav navbar-nav navbar-right hidden-xs hidden-sm">
                <li class="gold"><a href="javascript:;"><button class="  btn btn-gradient outline-button" style="margin-bottom: 0px;" data-toggle="modal" data-target="#pop-fire-station">
                            <div style="background: #1C589B;transition: all 0.3s;">Fire Station</div>
                        </button></a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right hidden-xs hidden-sm">
                <li class="gold"><a href="javascript:;"><button class="  btn btn-gradient outline-button" style="margin-bottom: 0px;" data-toggle="modal" data-target="#pop-fire-alert">
                            <div style="background: #1C589B;transition: all 0.3s;">Fire Alert</div>
                        </button></a></li>
            </ul>
            <ul id="navigation" class="nav navbar-nav navbar-right">
                <!--
                 <li><a class="active" href="#home-section">Home</a></li>
                <li><a href="#about-section">About</a></li>
                <li><a href="#why-us-section">Why Us?</a></li>
                <li><a href="#how-section">How?</a></li>
                <li><a href="#offers-section">Offers</a></li>
                <li><a href="#team-section">Team</a></li>
                <li><a href="#testimonial-section">Testimonial</a></li>
                <li><a href="#contact-section">Contact</a></li> 
-->
            </ul>



        </div>

    </div>
	
    <section>
        <iframe src="kml.html" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
    </section>
    <div id="map"></div>
    <script>

        function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 3,
          center: {lat: 23.796653, lng: 90.415466}, 
		  mapTypeId: 'satellite'
        });

        var ctaLayer = new google.maps.KmlLayer({
          url: 'https://firms.modaps.eosdis.nasa.gov/active_fire/viirs/kml/VNP14IMGTDL_NRT_South_Asia_24h.kml',
          map: map
        });
      }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBC-tbhtYcVscYoa09AQ1hVNEH5yHsne98&callback=initMap">
    </script>
    <section>
        <div class="box">
            <div class="col-md-2" style="height:50px;background-color:cyan;">
                <h3>Recent Alarm</h3>
            </div>
            <div class="col-md-10" style="height:50px;background-color:#fff;">
                <?php recent_alerts(); ?>
            </div>
        </div>
    </section>
    <!-- Footer Section -->
    <footer id="contact-section" class="sectionP60 dark-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="col-md-6 col-sm-7 col-xs-12 pull-right resCont">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="heading-text">
                                <span class="gold-gradient-color">Local Incidents</span>
                            </div>
                        </div>
						<?php local_alerts(); ?>
                        <button class="btn btn-gradient outline-button pull-left mtb20">
                            <div style="background: #0C1222;transition: all 0.3s">Load more</div>
                        </button>
                    </div>
                    <div class="col-md-6 col-sm-5 col-xs-12 border-right resCompany">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="heading-text">
                                <span class="gold-gradient-color">Global Incidents</span>
                            </div>
                        </div>
						<?php local_alerts(); ?>
                        <button class="btn btn-gradient outline-button pull-left mtb20">
                            <div style="background: #0C1222;transition: all 0.3s">Load more</div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section -->

    <!-- Copyright Section -->
    <section class="sectionP20" style="background: #0b101d;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="col-md-12">
                        <p class="light oR m0" style="opacity: .65">&copy; Copyright 2018, all rights reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Copyright Section -->

    <!-- Scroll Back Top Button -->
    <button onclick="topFunction()" id="myBtn" class="btn btn-gradient"><i class="visible-xs fa fa-arrow-up"></i>
        <tag class="hidden-xs">Back To Top</tag>
    </button>
    <!-- Scroll Back Top Button -->


    <!-- Popups Are Here -->
    <popups>

       

        

        <div id="pop-fire-alert" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" data-aos="zoom-in-up" data-aos-duration="800">&times;</button>
                        <h3 class="modal-title  blue oR m0">FIRE ALERT</h3>
                        <span class="light oR" style="font-size: 14px">Please alert us if any fire disaster is nearby.</span>
                    </div>
					<?php alert_verifications(); ?>
					<form action="" method="POST">
						<?php //alert_verifications(); ?>
                        <div class="modal-body">
                            <div class="input-box">
                                <button type="submit" name="text" class="btn btn-gradient">Text Alert</button>
                            </div>
                            

                        </div>
                    </form>
                    <form action="" method="POST">
						
                        <div class="modal-body">
                            
                            <p>Insert a Picture/Video of your nearest fire disaster.</p>
                            <div class="input-box">
                                <input type="file" name="pic" accept="video/*,image/*" required>
                                <span style="position: absolute"><i class="fa fa-camera"></i></span>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="file" class="btn btn-gradient">Submit</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        <!-- Login Popup -->
<!-- Login Popup -->
        <div id="pop-fire-station" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" data-aos="zoom-in-up" data-aos-duration="800">&times;</button>
                        <h3 class="modal-title  blue oR m0">FIRE STATION(S)</h3>
                        <span class="light oR" style="font-size: 14px">Your nearest fire station numbers.</span>
                    </div>
                    <?php user_location(); ?>
                    
                   
                </div>

            </div>
        </div>
        <!-- Login Popup -->

<div id="pop-notification" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" data-aos="zoom-in-up" data-aos-duration="800">&times;</button>
                        <h3 class="modal-title  blue oR m0">FIRE Notifications</h3>
                        
                    </div>
					<br />
					<ul>
						<?php notification_list(); ?>
						
                    </ul>
                   
                </div>

            </div>
        </div>
    </popups>
    <!-- Popups Are Here -->



    <!-- All Javascripts -->

    <!-- Jquery -->
    <script src="ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- Bootstrap -->
    <script type="text/javascript" src="assets/js/bootstrap.js"></script>

    <!-- Nice Scroll -->
    <script type="text/javascript" src="assets/plugins/niceScroll/niceScroll.min.js"></script> <!-- Common -->
    <script type="text/javascript" src="assets/js/common.js"></script>

    <!-- All Javascripts -->
</body>

</html>
