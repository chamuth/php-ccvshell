<?php 


if (startsWith($command, "http"))
{
	$splits = explode(" ", $command);
	$url = $splits[1]; // Get the url to pull data from

	echo file_get_contents($url);
}