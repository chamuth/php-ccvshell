<?php 

if ($command == "serverinfo")
{
	// Get the server information
	echo "Running " . $_SERVER["SERVER_SOFTWARE"] . " at \"" . $_SERVER["SERVER_NAME"] . "\"";
	die;
}

if (startsWith($command, "serverinfo"))
{
	$splits = explode(" ", $command);	

	if ($splits[1] == "all")
	{
		$arr = array();

		for ($i=0; $i < sizeof($_SERVER); $i++) { 
			$arr[] = array("key" => array_keys($_SERVER)[$i], "value" => array_values($_SERVER)[$i]);
		}

		echo json_encode($arr);
	}
}
