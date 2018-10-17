<?php
	require_once("../../config.php");
	
	if(isset($_GET['id'])) {
		$query = query("SELECT * FROM fire_alarts WHERE id = ".escape_string($_GET['id'])."");
		confirm($query);
		$row = fetch_array($query);
		if($row['ispublish'] == "false") {
			$query1 = query("UPDATE fire_alarts SET ispublish='true' WHERE id = ".escape_string($_GET['id'])."");
			confirm($query1);
			set_message("Fire alert published successfully");
			redirect("../../../admin/index.php?fire_alert");
		}
		else {
			$query2 = query("UPDATE fire_alarts SET ispublish='false' WHERE id = ".escape_string($_GET['id'])."");
			confirm($query2);
			set_message("Request Rejected");
			redirect("../../../admin/index.php?fire_alert");
		}
		
	} else {
		redirect("../../../admin/index.php?fire_alert");
	}

?>