<?php
/* Dancing Everywhere Submit Style List
** Version 1.0.1
** Date Created:  07-29-2013 by Marc Longhenry
** Date		Developer				Modification Made
** -------- ----------------------- --------------------------------------------------------------
** 02-17-15	Marc Longhenry			Original File Created to generate a Select for Dance Styles
*/

	// Set Variables for Error Logging  ----------------------------------------------------------
	$timestamp = date("d-m-y H:i:s");
	$filename = " phpsqlajax_genxml2.php";  // Space added in front for alignment and spacing purposes
	$root = $_SERVER['DOCUMENT_ROOT'];
	
	// Include Database Connection information  --------------------------------------------------
	require("db.php");

	// Set up Dance Style Dropdown ---------------------------------------------------------------
	echo "<div class='submit-style-item'><label for='style'>Primary Style:</label><select name='style' required='required'>";
	if ($result = $mysqli->query("SELECT style_name FROM `style_table` WHERE 1 ORDER BY style_name ASC")) {
		while($row = $result->fetch_assoc()) {
			echo '<option value="'.$row['style_name'].'">'.$row['style_name'].'</option>';
		}
		$result->close();
	} else {
		$error_msg = $timestamp.$filename." Did not complete MYSQLI QUERY for DANCE STYLE SELECT with ".$event_id."\n";
		error_log($error_msg, 3, $root."/includes/error.log");
	}			
	echo "</select></div><div id='secondary-styles' class='submit-style-item'><label for='style_ext'>Secondary Styles:</label><input type='text' id='submission-style-ext' name='style_ext'></div><p>Tell about you!  Do you Hip Hop it up?  Are you smooth and elegant like Tango?  Let the people viewing this site know what kind of dancing they can expect to see at your dance.  The Primary Style will determine the logo that shows up on the map, the Secondary Styles tell people what else they can expect.  Also, if you don't see your dance listed above, please <a href='mailto:info@dancingeverywhere.com?subject=MissingDance'>send us an e-mail</a> at Info(at)DancingEverywhere(dot)com, and we'll add it as soon as we can.</p>";				
?>