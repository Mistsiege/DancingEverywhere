<?php
/* Dancing Everywhere phpsqlajax_genxml file
** Version 1.0.2
** Date Created:  07-29-2013 by Marc Longhenry
**
**	*Note* - Just navigate to this file to verify XML output
**
** Date		Developer				Modification Made
** -------- ----------------------- --------------------------------------------------------------
** 07-29-13	Marc Longhenry			Original File Downloaded and Modified.
** 05-30-14 	"					Modifications made to include error logging.
*/
	
	// Set Variables for Error Logging  ----------------------------------------------------------
	$timestamp = date("d-m-y H:i:s");
	$filename = " phpsqlajax_genxml2.php";  // Space added in front for alignment and spacing purposes
	$root = $_SERVER['DOCUMENT_ROOT'];
	
	// Include Database Connection information  --------------------------------------------------
	require("db.php");

	// Character Parsing Function  ----------------------------------------------------------------
	function parseToXML($htmlStr) { 
		$xmlStr=str_replace('<','&lt;',$htmlStr); 
		$xmlStr=str_replace('>','&gt;',$xmlStr); 
		$xmlStr=str_replace('"','&quot;',$xmlStr); 
		$xmlStr=str_replace("'",'&#39;',$xmlStr); 
		$xmlStr=str_replace("&",'&amp;',$xmlStr); 
		return $xmlStr; 
	} 

	// Start XML file, echo parent node  -------------------------------------------------------------
	header("Content-type: text/xml");
	echo '<scenes>';
	
	// Select all the rows in the Scene Table  -------------------------------------------------------
	if ($result = $mysqli->query("SELECT * FROM scene_table WHERE approved = 1")) {
		while($row = $result->fetch_assoc()) {			
	// Iterate through the rows, printing XML nodes for each  ----------------------------------------
					// ADD TO XML DOCUMENT NODE
					echo '<marker ';
					echo 'name="' . parseToXML($row['name']).'" ';
					echo 'address="';
					if($row['address'] != NULL) {
						echo parseToXML($row['address']) . ', ';
					}
					echo parseToXML($row['city']) . ', ' . parseToXML($row['state']) .'" ';
					echo 'lat="' . parseToXML($row['lat']) . '" ';
					echo 'lng="' . parseToXML($row['lng']) . '" ';
					echo 'type="' . parseToXML($row['type']) . '" ';
					echo 'style="' . parseToXML($row['style']) . '" ';	
					echo 'timing="' . parseToXML($row['timing']) . '" ';
					echo 'www="' . parseToXML($row['website']) . '" ';
					echo 'lesson="' . parseToXML($row['lesson']) . '" >';
					echo '</marker>';
		}
		$result->close();
	} else {
		$error_msg = $timestamp.$filename." Did not complete RESULTS entry for SCENE TABLE QUERY \n";
		error_log($error_msg, 3, $root."/includes/error.log");
	}	

	// End XML file  --------------------------------------------------------------------------------
	echo '</scenes>';

?>