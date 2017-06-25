<?php 

function pwd()
{
	echo json_encode(array("cd" => $GLOBALS["_CD"]));
	die;
}
 ?>