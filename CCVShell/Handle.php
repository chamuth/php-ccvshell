<?php 

header("Content-Type: application/json");

$_CD = "";

if (isset($_GET["cd"]))
	$_CD = $_GET["cd"];
else 
	$_CD = dirname(dirname(__FILE__));


if (isset($_GET["p"]))
{
	$_password = $_GET["p"];

	$file_loc = "../../config.json";

	$handle = fopen($file_loc, "r");
	$filecontent = fread($handle, filesize($file_loc));
	fclose($handle);

	$json_content = json_decode($filecontent, true);

	if ($json_content["password"] == $_password)
	{
		http_response_code(200); // SET OKAY

		if (isset($_GET["cmd"]))
		{
			$command = $_GET["cmd"];

			// Include all the functions
			include "funcs.php";

			//Fix the command using the function
			fixCommand($command);

			// COMMAND HANDLING
			include "navigation.php"; // Navigation through the remote directories and files using cd, pwd
			include "files.php"; // Creating, deleting and renaming directories and files from the server
			include "info.php"; // Getting information about the server using serverinfo and serverinfo all
			include "sync.php"; // Syncing the content between the local directory and remote directory bi-directionally
			include "proxy.php"; // for http requests through the server
			include "cpm.php"; // for Chamuth's Package Manager commands
			include "search.php"; // for Searching files
			include "zip.php"; // for zipping and unzipping files
			include "edit.php"; // for editing files through the cmd
		}else{
			header("HTTP/1.0 403 Forbidden");
		}
	}else{
		header("HTTP/1.0 403 Forbidden");
	}
}else{
	header("HTTP/1.0 403 Forbidden");
}