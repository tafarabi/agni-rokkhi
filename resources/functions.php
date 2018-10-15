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
?>