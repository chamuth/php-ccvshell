<?php 

//TOUCH : CREATE FILE
//MKDIR : CREATE DIRECTORY
//RM : REMOVE
//REN : RENAME
//FILE : GET THE FILE CONTENTS

if (startsWith($command, "touch"))
{
	// Creating a file
	$splits = explode(" ", $command);
	unset($splits[0]);

	$filename = $_CD . "/" . implode(" ", $splits); // Create the filename

	$filename = decodeCMD($filename);

	if (file_exists($filename))
		echo "The file \"$filename\"exists in the server.";
	else
		touch ($filename);
}
else if (startsWith($command, "file"))
{
	$splits = explode(" ", $command);
	unset($splits[0]);

	$filename = $_CD . "/" . $splits[1];
	$filename = decodeCMD($filename);
	
	if (file_exists($filename))
	{
		if (filesize($filename) > 1000000)
		{
			echo "The file exceeds the maximum size to read";
		}else{
			$content = file_get_contents($filename);

			echo $content;
		}
	}else{
		echo "The file does not exist in the server.";
	}
}
else if (startsWith($command, "mkdir"))
{
	$splits = explode(" ", $command);
	unset($splits[0]);

	$dirname = $_CD . "/" . implode(" ", $splits);
	$dirname = decodeCMD($dirname);

	if (is_dir($dirname))
		echo "The directory \"$dirname\" exists in the server";
	else
		mkdir($dirname);
}
else if (startsWith($command, "rm"))
{
	$splits = explode(" ", $command);
	unset($splits[0]);

	$filename = $_CD . "/" . implode(" ", $splits);
	$filename = decodeCMD($filename);

	if (file_exists($filename))
		if (is_dir($filename))
			rmdir($filename);
		else
			unlink($filename);
	else 
		echo "The file or directory \"$filename\" does not exist in the server.";
}
else if (startsWith($command, "ren"))
{
	$splits = explode(" ", $command);
	
	$oldname = $_CD . "/" . $splits[1];
	$newname = $_CD . "/" . $splits[2];

	$oldname = decodeCMD($oldname);
	$newname = decodeCMD($newname);

	if (file_exists($oldname))
	{
		rename($oldname, $newname);
	}else{
		echo "The file or directory \"$oldname\" does not exist in the server";
	}
}
else if (startsWith($command, "move"))
{
	$splits = explode(" ", $command);

	$oldname = $_CD . "/" . $splits[1];
	$newname = $_CD . "/" . $splits[2];

	$oldname = decodeCMD($oldname);
	$newname = decodeCMD($newname);

	if (file_exists($oldname))
	{
		rename($oldname, $newname);
	}else{
		echo "The file or directory \"$oldname\" does not exist in the server";
	}
}