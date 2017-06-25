<?php 

include "commands/pwd.php";
include "commands/ls.php";

switch ($command) {
	case 'pwd':
		pwd();
		die;
		break;
	case 'ls':
		ls();
		break;
	case 'ls -al':
		ls('-al');
		break;
	case 'cd..':
		$_CD = dirname($_CD); // Go to the up directory
		FixCD();
		echo json_encode(array("cd" => $_CD));
		die;
		break;
}

//Changing to current directory
if (startsWith($command, "cd"))
{
	//ChangeDirectory command
	$splitted = explode(" ", $command);
	$arg = $splitted;
	unset($arg[0]);
	$arg = decodeCMD($arg[1]);

	if ($arg != ".")
	{
		//For Multiple Change Directores
		if (sizeof(explode("/", $arg)) > 1){
			foreach (explode("/", $arg) as $argsplit)
			{
				if ($argsplit == "..")
				{
					$_CD = dirname($_CD);
				}else {
					
					if (file_exists($_CD . "/" . $argsplit))
					{
						$_CD = $_CD . "/" . $argsplit;
						FixCD();
					}
				}
			}
			echo json_encode(array("cd" => $_CD));
			die;
		}


		// $arg = str_replace("/", "", $arg);
		if ($arg == "..")
		{
			//Go to the previous directory
			$_CD = dirname($_CD);

		}else {
			if (file_exists($_CD . "/" . $arg))
			{
				//Remove the trailing slashes
				$_CD = $_CD . "/" . $arg;
				FixCD();
			}	
		}
	}

	echo json_encode(array("cd" => $_CD));
}

 ?>