<?php
/* Dancing Everywhere database connection info
** Version 1.0.3
** Date Created:  07-29-2013 by Marc Longhenry
** Date		Developer				Modification Made
** -------- ----------------------- --------------------------------------------------------------
** 07-29-13	Marc Longhenry			Original File Created.
** 05-30-14 	"					Modifications made to include error logging.
** 02-17-15		"					Updated error logging to include Document Root.
*/
	
	// Set Variables for Error Logging  ----------------------------------------------------------
	$timestamp = date("d-m-y H:i:s");
	$filename = " db.php";  // Space added in front for alignment and spacing purposes
	$root = $_SERVER['DOCUMENT_ROOT'];
	
	// Database Connection Information  ----------------------------------------------------------
	$hostname 	= "mysql.dancingeverywhere.com";	// host name
	$dbname 	= "dancing_everywhere";				// database name
	$username 	= "globaldancescene";				// username 
	$password 	= "ILikePie13";						// password
	
	//  This stores the Connection to the Database  ----------------------------------------------
	$mysqli = new mysqli($hostname, $username, $password, $dbname);
	if ($mysqli->connect_errno) {
		$error_msg = $timestamp.$filename." MySQLi Connection: ".$mysqli->connect_errno." - ".$mysqli->sqlstate." - ".$mysqli->connect_error." - ".$mysqli->error." \n";
		error_log($error_msg, 3, $root."/includes/error.log");
	}
?>