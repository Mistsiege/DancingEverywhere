<?php
/**
*	Dancing Everywhere Scene Submission Script
*	Version 1.0.3
*	Date Created:	07-29-2013 by Marc Longhenry
*
*	File Created to accept POST data from submission page and insert it into the DancingEverywhere Database
* 
* 	Date		Developer				Modification Made
* 	----------- ----------------------- --------------------------------------------------------------
* 	07-29-13	Marc Longhenry			Original File Created
*	06-12-14		"					Modifications made to header forwarding, sending to wordpress page
*		"			"					and fixed changed $conn to $mysqli to match db.php.
*	08-01-14		"					Modified to include error logging variables and code.
*
*/

// Get Database Connection Info and Set database table  --------------------------------------
include('db.php');
	
// Set Variables for Error Logging  --------------------------------------------------------------------------------------------------------------------
$timestamp = date("d-m-y H:i:s");
$filename = " insert_scene.php";  // Space added in front for alignment and spacing purposes
$root = $_SERVER['DOCUMENT_ROOT'];
	
// Adjust incoming information as needed
if($_POST['address']==NULL) {
	$_POST['address']="none";
}
if($_POST['timing_ext']==NULL) {
	$_POST['timing_ext']=" ";
}
if($_POST['submission']==NULL) {
	$error_msg = $timestamp.$filename." error submitting submission ".$_POST['submission']." \n";
	error_log($error_msg, 3, $root."/includes/error.log");
}
if($_POST['timing1']==='Other' && $_POST['timing2']==='Other') {
	$timing = $_POST['timing3'];
} else {
	$timing = $_POST['timing1'].' '.$_POST['timing2'];
}

$approved = '1';
$name = $_POST[name];
$address = $_POST[address];
$type = $_POST[type];
$city = $_POST[city];
$state = $_POST[state];
$country = $_POST[country];
$lat = $_POST[lat];
$lng = $_POST[lng];
$style = $_POST[style];
$style_ext = $_POST[style_ext];
$website = $_POST[website];
$lesson = $_POST[lesson];
$description = $_POST[description];
$submission = $_POST[submission];
$organizer_email = $_POST[organizer_email];

// Generate SQL entry
if ($stmt = $mysqli->prepare("INSERT INTO scene_table (approved, name, address, type, city, state, country, lat, lng, style, style_ext, timing, website, lesson, description, submission, organizer)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")) {
	if($stmt->bind_param("sssssssssssssssss", $approved, $name,$address,$type,$city,$state,$country,$lat,$lng,$style,$style_ext,$timing,$website,$lesson,$description,$submission,$organizer_email)) {
		if($stmt->execute()) {
			$stmt->close();
			// Close Database Connection after submission is complete
			mysqli_close($mysqli);
	
			// Redirect Submiter to Thank You page
			header("Location: /thank-you/");
		} else {
			$error_msg = $timestamp.$filename." Did not complete EXECUTE entry with ".$mysqli->error." for SCENE CREATION with ".$fname."-".$lname."-".$email."-".$city."-".$state."-".$country."\n";
			error_log($error_msg, 3, $root."/includes/error.log");
		}
	}  else {
		$error_msg = $timestamp.$filename." Did not complete BIND PARAMETERS entry with ".$mysqli->error." for SCENE CREATION with ".$fname."-".$lname."-".$email."-".$city."-".$state."-".$country."\n";
		error_log($error_msg, 3, $root."/includes/error.log");
	}
} else {
	$error_msg = $timestamp.$filename." Did not complete PREPARE STATEMENT entry with ".$mysqli->error." for SCENE CREATION with ".$fname."-".$lname."-".$email."-".$city."-".$state."-".$country."\n";
	error_log($error_msg, 3, $root."/includes/error.log");
}
?>