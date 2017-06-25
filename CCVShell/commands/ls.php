<?php 

function ls($sub = "")
{
	try {
		$cd = $GLOBALS["_CD"];

		$files = scandir($cd);

		$results = array();
		
		foreach ($files as $file)
		{
			if ($sub == "")
			{
				// List the files
				$booler = is_dir($cd . "/" . $file);

				$results["files"][] = array("name" => $file, "isdir" => $booler);
			}
			else if ($sub == "-al")
			{
				// List the files with their information
				if ($file != "." && $file != "..")
				{
					$filenamereal = $cd . "/" . $file;

					$permissions = (getPermissions($filenamereal));
					$mtime = filemtime($filenamereal);
					$filelength = "";

					if (is_dir($filenamereal) === false)
					{
						$filelength = filesize($filenamereal);
					}

					$booler = is_dir($filenamereal);

					$results["files"][] = array("permission" => $permissions, "mtime" => $mtime, "length" => $filelength,  "name" => $file, "isdir" => $booler);
				}
			}
		}

		echo json_encode($results);

		die;
		
	} catch (Exception $e) {
		
	}
}
