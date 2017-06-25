<?php 

if (startsWith($command, "cpm"))
{
	// Chamuth's Package Manager
	$splits = explode(" ", $command);

	if(sizeof($splits) > 1)
	{
		$mainarg = $splits[1]; 
		$subarg = "";

		if (sizeof($splits) > 2)
			$subarg = $splits[2];
		
		$root = dirname(dirname(__FILE__));
		$cpmjson = $root . "/cpm.json";

		if (str_replace(" ", "", $mainarg)){
			if ($mainarg == "-v")
			{
				echo "Chamuth's Package Manager for PHP \nCPM v1.0.1";
			}
			else if ($mainarg == "install")
			{
				if ($subarg == ""){
					//Said to install the packages mentioned in the cpm.json
					if (file_exists($cpmjson))
					{
						$filecontent = file_get_contents($cpmjson);
						$json = json_decode($filecontent, true);

						if (sizeof($json["packages"]) > 0)
						{
							// Install the Package Xs
						}else
						{
							echo "No packages found in the cpm configuration";
						}
					}else{
						echo "cpm.json configuration file not found. Use cpm init to create one";
					}
				}else{
					//Install package X

				}

			}else if ($mainarg == "init")
			{
				if (file_exists($cpmjson))
				{
					echo "A pre-configured cpm.json file exists in the server";
				}else{
					touch($cpmjson); // Create the cpm.json file
					$contenter = "{\n \t\"packages\": []\n}";
					file_put_contents($cpmjson, $contenter);

					echo "A CPM Configuration (cpm.json) file has been initialized in the root,\n\n" . $contenter;
				}
			}
		}
		else
		{
			cpmInfo();
		}
	}
	else
	{
		cpmInfo();
	}
}

function cpmInfo()
{
	echo "Chamuth's Package Manager for PHP\n================================\n";
	echo "CPM is a cross-platform (Linux and Windows Server) package manager developed by Chamuth Chamandana with the development of Virtual Shell (A Virtualization of SSH for the hosts who don't support SSH).";
}