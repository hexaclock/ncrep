<?php

require("classes/Statistics.php");

if ($argc < 2)
{
	print "usage: php $argv[0] <CSV packet capture file>\n";
	return 1;
}

for ($i=1; $i<$argc; $i++)
{
	$statsobj = new Statistics($argv[$i]);
	$res      = $statsobj->getCredentials();
	//$pcnt     = $statsobj->getProtocolsCount();
	$totcnt   = $statsobj->getTotalPacketsCount();
	print "\nStatistics for file: $argv[$i]:\n";
	print("The total number of packets read from the file: $totcnt\n");
	print_r($res);
	print_r($statsobj->getProtocolsPercent());
	//$ipcnt    = $statsobj->getTotalCountForIP("192.168.2.20");
}

return 0;

?>
