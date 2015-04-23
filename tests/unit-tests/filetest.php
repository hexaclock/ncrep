<?php

require_once '../../classes/File.php';
require_once '../../classes/Statistics.php';

//$f = new File('./testcsv_new.csv');
$g = new Statistics('./lots_of_ftp.csv');
//if ($f->parseFile() != NULL)
//	$f->printPCAP();
$res    = $g->getCredentials();
$pcnt   = $g->getProtocolsCount();
$pcts   = $g->getProtocolsPercent();
$totcnt = $g->getTotalPacketsCount();
//print_r($res["ftpresults"]);
echo "Total packet count: $totcnt\n";
print_r($pcnt);
print_r($pcts);
print_r($res);

?>
