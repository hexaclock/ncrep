<?php

require_once '../../classes/File.php';

$f = new File('./testcsv_new.csv');
if ($f->parseFile() != NULL)
{
	$f->printPCAP();
}

?>