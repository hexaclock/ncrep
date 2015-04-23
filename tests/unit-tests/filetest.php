<?php

require_once '../../classes/File.php';
require_once '../../classes/Statistics.php';

//$f = new File('./testcsv_new.csv');
$g = new Statistics('./ftpdata.csv');
//if ($f->parseFile() != NULL)
//	$f->printPCAP();
$res = $g->getCredentials();
//print_r($res["ftpresults"]);
print_r($res);

?>
