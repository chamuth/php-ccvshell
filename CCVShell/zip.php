<?php 

if (startsWith($command, "zip"))
{
	$splits = explode(" ", $command);
	unset($splits[0]);

	if (sizeof($splits) == 3) // ADDING A FILE TO THE ZIP FILE
	{
		// Only the filename
		$filename = "";

		if (file_exists($splits[1]))
		{
			$filename = $splits[1];
		}else{
			$filename = $_CD . "/" . $splits[1];
		}

		unset($splits[1]);

		$zip = new ZipArchive();

		if ($zip->open($filename, ZipArchive::CREATE) !== TRUE)
		{
			echo "Cannot open the stream to the zip file \"$filename\".";
			exit;
		}
		
		$oldname = $splits[2];
		$newname = $splits[3];

		$newname = decodeCMD($newname);

		if (file_exists($oldname))
		{
			$oldname = decodeCMD($oldname);
		}
		else
		{
			$oldname = $_CD . "/" . decodeCMD($oldname);
		}

		if (is_dir($oldname))
		{
			$zip->addFile($oldname, $newname);
		}
		else
		{
			if (file_exists($oldname))
			{
				$zip->addFile($oldname, $newname);
			}
		}
		

		$zip->close();
	}else if (sizeof ($splits) == 2) // ADDING A DIRECTORY TO THE ZIP FILE
	{
		$filename = "";

		if (file_exists($splits[1]))
		{
			$filename = $splits[1];
		}else{
			$filename = $_CD . "/" . $splits[1];
		}

		$filename = decodeCMD($filename);
		
		$zip = new ZipArchive();

		if ($zip->open($filename, ZipArchive::CREATE) !== TRUE)
		{
			echo "Cannot open the stream to the zip file \"$filename\".";
			exit;
		}

		$dirname = $splits[2];
		$dirname = decodeCMD($dirname);

		if (is_dir($_CD . "/" . $dirname))
		{		
			$dirname = $dirname;
		}else{
			exit;
		}

		$dirname = str_replace("/", "\\", $dirname);
		$directory_name = $dirname;

		if (strpos($dirname, "/"))
		{
			$directory_name = getFilenamefromURL($dirname);
		}

		$zip->addEmptyDir($directory_name);

		foreach (scandir($_CD . "/" . $dirname) as $file)
		{
			if ($file != "." && $file != "..")
			{
				$zip->addFile($_CD . "/" . $dirname . "/" . $file, $directory_name . "/" . $file);
			}
		}

		$zip->close();
	}
}else if (startsWith($command, "unzip"))
{
	$splits = explode(" ", $command); 
	unset($splits[0]);

	$zipfile = $splits[1];
	$extractLocation = $splits[2];

	$extractLocation = $_CD ."/" . decodeCMD($extractLocation);
	$zipfile = $_CD . "/" . decodeCMD($zipfile);

	if (is_dir($extractLocation))
		mkdir($extractLocation);
	
	if (file_exists($zipfile))
	{
		$zip = new ZipArchive;
		if ($zip->open($zipfile) === TRUE) {
		    $zip->extractTo($extractLocation);
		    $zip->close();
		    echo "\"$zipfile\" has been successfully extracted to \"$extractLocation\"\n\n";

		    foreach (scandir($extractLocation) as $file)
		       	if ($file != "." && $file != "..")
		    		echo "Extracted \"$file\"\n";
		    
		} else {
		    echo "\"$zipfile\" cannot be extracted";
		}
	}
}