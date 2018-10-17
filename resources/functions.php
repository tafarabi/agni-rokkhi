<?php
// helper functions

function redirect($location){
	header("Location: $location");
}

function query($sql){
	global $connection;
	return mysqli_query($connection,$sql);
}

function confirm($result){
	global $connection;
	if(!$result){
		die("QUERY FAILED" . mysqli_error($connection));
	}
}

function escape_string($string){
	global $connection;
	return mysqli_real_escape_string($connection,$string);
}

function fetch_array($result){
	
	return mysqli_fetch_array($result);
}

function set_message($msg) {
	if(!empty($msg)) {
		$_SESSION['message'] = $msg;
	} else {
		$msg = "";
	}
}

function display_message() {
	if(isset($_SESSION['message'])) {
		echo $_SESSION['message'];
		unset($_SESSION['message']);
	}
}

// visitor registration
function registration_user() {
	if(isset($_POST['registration'])){
		$name     = escape_string($_POST['name']);
		$email    = escape_string($_POST['email']);
		$password = escape_string($_POST['password']);
		$location = "";
		$date     = date(" jS \ F, Y ");
		$check_query=query("select * from users where email='$email'");
		confirm($check_query);
	    if(mysqli_num_rows($check_query) >0 ){
		    
			echo"<script>alert('This Email is used !')</script>";
	    }
		else
		{
			$query = query("INSERT INTO users(name,email,password,location,date) VALUES('{$name}','{$email}' ,'{$password}' ,'{$location}','{$date}')");
			confirm($query);
			echo"<script>alert('Thanks for being with us !')</script>";
		}
	}
}

// visitor registration
function alert_verifications() {
	if(isset($_POST['text'])){
		$date=date(" jS \ F, Y ");
		$query = query("INSERT INTO fire_alarts(location,file,date, ispublish) VALUES('Uttara','text alert' ,'{$date}' ,'false')");
		confirm($query);
		echo"<script>alert('Thanks for alerting.We will verify your alert before publish')</script>";
	}
	if(isset($_POST['file'])){
		echo"<script>alert('Thanks for alerting.We will verify your Image/Video before publishing fire alert')</script>";
	}
}
// local alert in index
function local_alerts() {
	$query = query("SELECT * FROM fire_alarts WHERE ispublish='true' ORDER by id DESC LIMIT 0,6");
	confirm($query);
	$i = 0;
	while($row = fetch_array($query)) {
		
			$alert = <<<DELIMETER

			<div class="form-group" style="color:#fff;">
							<div class="col-md-2">
								<img src="resources/uploads/{$row['file']}" width="80" alt="" />
							</div>
							<div class="col-md-7">
								<h4>It's burning in {$row['location']}</h4>
							</div>
							<div class="col-md-3">
								<h4>{$row['date']}</h4>
							</div>
			</div>
		
           
DELIMETER;

echo $alert;
		
		
		
	}
	
}

// recent alert in index
function recent_alerts() {
	$query = query("SELECT * FROM fire_alarts WHERE ispublish='true' ORDER by id DESC LIMIT 0,1");
	confirm($query);
	while($row = fetch_array($query)) {
		
			$alert = <<<DELIMETER

			<marquee>It's burning at {$row['location']} !!!</marquee>
		
           
DELIMETER;

echo $alert;
	
	}
	
}

function login_user() {
	if(isset($_POST['login'])) {
		$email    = escape_string($_POST['email']);
		$password = escape_string($_POST['password']);
		$query    = query("SELECT * FROM users WHERE email = '{$email}' AND password = '{$password}'");
		
		confirm($query);
		if(mysqli_num_rows($query) == 0){
			//redirect("index.php");
			echo"<script>alert('Invalid')</script>";
		} else {
			$_SESSION['email'] = $email;
			redirect("user_profile.php");
		}
	}
}
// display notification number
function notifications() {
	$date=date(" jS \ F, Y ");
	$day_before = date( ' jS \ F, Y ', strtotime( $date . ' -1 day' ) );
	$query = query("SELECT * FROM fire_alarts WHERE date > '$day_before' AND ispublish='true' ");
	confirm($query);
	
	$rows = mysqli_num_rows($query);
		echo $rows;
	
	
	
}

// display notification list
function notification_list() {
	$date=date(" jS \ F, Y ");
	$day_before = date( ' jS \ F, Y ', strtotime( $date . ' -1 day' ) );
	$query = query("SELECT * FROM fire_alarts WHERE date > '$day_before' AND ispublish='true' ");
	confirm($query);
	while($row = fetch_array($query)) {
		
			$notification = <<<DELIMETER

			<li style="padding:5px;">It's burning 3km<sup>2</sup> away from you !!!</li>
DELIMETER;

echo $notification;
		
		
		
	}
	
}
//collecting user location and show nearby fire service phone number

function user_location() {
	require_once('geoplugin.class.php');

$geoplugin = new geoPlugin();


//locate the IP
$geoplugin->locate();

// echo "
	// Latitude: {$geoplugin->latitude} <br />\n".
	// "Longitude: {$geoplugin->longitude} <br />\n";
	$query = query("SELECT * FROM fire_stations");
	confirm($query);
	$distance_tmp = 21400000000;
	while($row = fetch_array($query)) {
		$distance = vincentyGreatCircleDistance($geoplugin->latitude, $geoplugin->longitude, $row['latitude'], $row['longitude'], $earthRadius = 6371000);
		if($distance < $distance_tmp) {
			$distance_tmp = $distance;
			$fire_station = <<<DELIMETER

			<h4 class="modal-title  blue oR m0">{$row['name']} - <strong>{$row['phone']}</strong></h4>
DELIMETER;
		}
	}	

	echo $fire_station;
	
	
	//$distance = vincentyGreatCircleDistance($geoplugin->latitude, $geoplugin->longitude, 23.729, 90.4112, $earthRadius = 6371000);
	//echo $distance;
}

// calculating shortest distance of fire station form user

function vincentyGreatCircleDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
{
  // convert from degrees to radians
  $latFrom = deg2rad($latitudeFrom);
  $lonFrom = deg2rad($longitudeFrom);
  $latTo = deg2rad($latitudeTo);
  $lonTo = deg2rad($longitudeTo);

  $lonDelta = $lonTo - $lonFrom;
  $a = pow(cos($latTo) * sin($lonDelta), 2) +
    pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
  $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);

  $angle = atan2(sqrt($a), $b);
  return $angle * $earthRadius;
}




/***************Back End Functions Start*****************/

//login page

function login_admin() {
	if(isset($_POST['login'])) {
		$username = escape_string($_POST['username']);
		$password = escape_string($_POST['password']);
		$query = query("SELECT * FROM admins WHERE username = '{$username}' AND password = '{$password}'");
		
		confirm($query);
		if(mysqli_num_rows($query) == 0){
			set_message("Don't try to access there , it will destroy your device !");
			redirect("login.php");
		} else {
			$_SESSION['username'] = $username;
			redirect("../admin");
		}
	}
	
	
	
	
	
}
// alert requiest
function alert_requiest() {
	$query = query("SELECT * FROM fire_alarts ORDER by id DESC");
	confirm($query);
	$i = 0;
	while($row = fetch_array($query)) {
		$i++;
		if($row['ispublish'] == "true") {
			$alert = <<<DELIMETER

		<tr>
            <td>{$i}</td>
            <td>{$row['location']}</td>
            <td><img src="../resources/uploads/{$row['file']}" width='100'/></td>
            <td>{$row['date']}</td>
            <td><a class="btn btn-danger" href="../resources/templates/back/action.php?id={$row['id']}">Delete</a></td>
        </tr>
           
DELIMETER;

echo $alert;
		}
		else {
			$alert = <<<DELIMETER

		<tr>
            <td>{$i}</td>
            <td>{$row['location']}</td>
            <td><img src="../resources/uploads/{$row['file']}" width='100'/></td>
            <td>{$row['date']}</td>
            <td><a class="btn btn-success" href="../resources/templates/back/action.php?id={$row['id']}">Publish</a></td>
        </tr>
           
DELIMETER;

echo $alert;
		}
		
	}
	
}














?>