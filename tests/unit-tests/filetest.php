<?php

require_once '../../classes/Statistics.php';

$g      = new Statistics('./lots_of_ftp.csv');
$res    = $g->getCredentials();
$pcnt   = $g->getProtocolsCount();
$totcnt = $g->getTotalPacketsCount();
$ipcnt  = $g->getTotalCountForIP("192.168.2.20");

if ($totcnt == 11251)
	echo "Total packet count test passed!\n";
else
	echo "Total packet count test failed!\n";

if (array("UDP" => 4462,"TCP" => 2317,"ICMP" => 182,"ARP" => 58,
    	"TPKT" => 74,"STP" => 38,"LLDP" => 3,"DIS" => 68,"DNS" => 10,
	"FTP" => 133,"FTP-DATA" => 3771,"ICMPv6" => 4,"TLSv1.2" => 21,
        "TLSv1" => 8,"IMAP" => 98,"SSH" => 1,"DHCP" => 1,"MDNS" => 2) === $pcnt) { echo "Protocol count test passed!\n"; }
else
	echo "Protocol count test failed!\n";

if (sizeof($res["ftpresults"]) == 3 || $res["ftpresults"][0]["proto"] == "FTP")
	echo "FTP credentials extracter test passed!\n";
else
	echo "FTP credentials extracter test failed!\n";


$badfile = new File('./malformed.csv');

if ($badfile->parseFile() == NULL)
	echo "Malformed input CSV file test passed!\n";
else
	echo "Malformed input CSV file test failed!\n";

if ($ipcnt == 11134)
	echo "Total count for IP address 192.168.2.20 passed!\n";
else
	echo "Total count for IP address 192.168.2.20 failed!\n";

if ($ipcnt - $g->getSrcCountForIP("192.168.2.20") == $g->getDstCountForIP("192.168.2.20"))
	echo "IP address count arithmetic passed!\n";
else
	echo "IP address count arithmetic failed!\n";


?>
