<?php 

if (startsWith($command , "sync"))
{
	$splits = explode(" ", $command);

	if ($splits[1] == "up")
	{
	}
	else if ($splits[1] == "upload")
	{
		// Save the content to the server
		if ($_SERVER["REQUEST_METHOD"] == "POST")
		{
			if (isset($_GET["ld"]))
			{
				$localdir = $_GET["ld"];
				$root_dir = dirname(dirname(__FILE__));
				$actual_url = $root_dir . "/" . $localdir;

				if (file_exists($actual_url))
					unlink($actual_url);

				// Save the file into the actual url file
				move_uploaded_file($_FILES["fileData"]["tmp_name"], $actual_url); 
			}
		}
	}
	else if ($splits[1] == "down")
	{
		//Saves the content in the local directory
		$root = dirname(dirname(__FILE__));

		$arr = getAllFiles($root);
		$arr = fixCurrentDirectory($arr, dirname(__FILE__));
		$new_arr = array();

		foreach ($arr as $file)
		{
			$new_arr[] = array("name" => $file, "isdir" => is_dir($file));
		}

		echo json_encode(array("files" => $new_arr));
	}
	else if ($splits[1] == "file")
	{
		$root = dirname(dirname(__FILE__));

		$filename = $splits;
		unset($filename[0]);
		unset($filename[1]);

		$filename = implode(" ", $filename);

		$file = $filename;

		if (file_exists($file)) {
		    header('Content-Description: File Transfer');
		    header('Content-Type: application/octet-stream');
		    header('Content-Disposition: attachment; filename="'.basename($file).'"');
		    header('Expires: 0');
		    header('Cache-Control: must-revalidate');
		    header('Pragma: public');
		    header('Content-Length: ' . filesize($file));
		    readfile($file);
		    exit;
		}
	}
}	