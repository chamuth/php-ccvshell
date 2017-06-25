<?php 

if (startsWith(($command), "search"))
{
	$args = explode(" ", $command);
	unset($args[0]);

	$searchterm = null;

	if (sizeof($args) > 0)
	{
		if (startsWith($args[1], "*.") == false)
		{
			$searchterm = $args[1];
			unset($args[1]);
		}
	}else{
		$searchterm = null;
	}

	$searchterm = decodeCMD($searchterm);

	$otherargs = $args;

	//STRING PROPERTIES
	$extension = array();

	foreach ($otherargs as $arg)
	{
		if (startsWith($arg, "*."))
		{
			$extension[] = str_replace("*", "", $arg);
		}
	}

	$results = array();
	$allfiles = getAllFiles($_CD); // Get all the files in the server

	if( sizeof($extension) > 0)
	{
		$allfiles = verifyExtension($allfiles, $extension);
	}

	foreach($allfiles as $file)
	{	
		if ($searchterm === null)
		{
				$permissions = (getPermissions($file));
				$results[] = array("name" => $file, "length" => filesize($file), "mtime" => filemtime($file), "permission" => $permissions, "isdir" => is_dir($file));	
		}else{
			if (strpos(strtolower($file), strtolower($searchterm)))
			{
				$permissions = (getPermissions($file));
				$results[] = array("name" => $file, "length" => filesize($file), "mtime" => filemtime($file), "permission" => $permissions, "isdir" => is_dir($file));
			}
		}
	}

	echo json_encode(array("files" => $results));
}