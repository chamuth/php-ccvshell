<?php 	

function getFilenamefromURL($url)
{
	$splits = explode("/", $url);

	return $splits[sizeof($splits) - 1];
}

function fixCommand(&$command)
{
	$command = strtolower($command);
	$command = ltrim(rtrim($command));
	ultraTrim($command);
	$command=  encodeCMD($command);
}

function encodeCMD($command)
{
	return str_replace('\ ', '∞', $command);
}

function decodeCMD($command)
{
	return str_replace('∞', ' ', $command);
}

function verifyExtension($filelist, $extensions)
{
	$list = array();

	foreach($filelist as $file)
	{
		foreach ($extensions as $extension)
			if (endsWith($file, $extension))
			{
				$list[] = $file;
				break;
			}
	}

	return $list;
}

function getAllFiles ($root)
{
	$files = array();

	foreach (scandir($root) as $file)
	{
		if ($file != "." && $file != "..")
		{
			$realfile = $root . "/" . $file;

			$files[] = $realfile;

			if (is_dir($realfile))
				$files = array_merge($files, getAllFiles($realfile));
		}
	}

	return $files;
}

function changed($old, $new)
{
	return !($old == $new);
}

function trimOnce($input)
{
	return str_replace("  ", " ", $input);
}

function ultraTrim(&$input)
{
	$prev = "";
	do {
		$prev = $input;
		$input = trimOnce($input);
	} while (changed($prev, $input));
}

function fixCurrentDirectory($array, $ccvshell)
{
	$ccvshell_directory = str_replace("\\", "/", $ccvshell);

	$new_arr = array();

	foreach ($array as $element)
	{
		$file = str_replace("\\", "/", $element);

		if (strpos($file, $ccvshell_directory) === false)
		{
			$new_arr[] = $file;
		}
	}

	return $new_arr;
}

function startsWith($haystack, $needle)
{
	if (substr($haystack, 0, strlen($needle)) == $needle)
		return true;
	return false;
}

function endsWith ($haystack, $needle)
{
	if (substr($haystack, strlen($haystack) - strlen($needle), strlen($needle)) == $needle)
		return true;
	return false;
}

function FixCD()
{
	if (isset($_CD))
	{
		$GLOBALS["_CD"] = str_replace("\\", "/", $_CD);
		$GLOBALS["_CD"] = str_replace("//", "/", $_CD);			
	}
}

function getPermissions($filename)
{

	$perms = fileperms($filename);
	$info = "";

	switch ($perms & 0xF000) {
	    case 0xC000: // socket
	        $info = 's';
	        break;
	    case 0xA000: // symbolic link
	        $info = 'l';
	        break;
	    case 0x8000: // regular
	        $info = 'r';
	        break;
	    case 0x6000: // block special
	        $info = 'b';
	        break;
	    case 0x4000: // directory
	        $info = 'd';
	        break;
	    case 0x2000: // character special
	        $info = 'c';
	        break;
	    case 0x1000: // FIFO pipe
	        $info = 'p';
	        break;
	    default: // unknown
	        $info = 'u';
	}

	// Owner
	$info .= (($perms & 0x0100) ? 'r' : '-');
	$info .= (($perms & 0x0080) ? 'w' : '-');
	$info .= (($perms & 0x0040) ?
	            (($perms & 0x0800) ? 's' : 'x' ) :
	            (($perms & 0x0800) ? 'S' : '-'));

	// Group
	$info .= (($perms & 0x0020) ? 'r' : '-');
	$info .= (($perms & 0x0010) ? 'w' : '-');
	$info .= (($perms & 0x0008) ?
	            (($perms & 0x0400) ? 's' : 'x' ) :
	            (($perms & 0x0400) ? 'S' : '-'));

	// World
	$info .= (($perms & 0x0004) ? 'r' : '-');
	$info .= (($perms & 0x0002) ? 'w' : '-');
	$info .= (($perms & 0x0001) ?
	            (($perms & 0x0200) ? 't' : 'x' ) :
	            (($perms & 0x0200) ? 'T' : '-'));

	return $info;

}

 ?>