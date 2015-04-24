<?php

require_once("classes/Statistics.php");

if(isset($_POST['upload']))
{
	$target_dir = '/tmp/';
	$target_file = $target_dir.sha1(sha1_file($_FILES["packet"]["tmp_name"]).time()); //basename($_FILES["packet"]["name"]);
	$filetype = pathinfo($_FILES["packet"]["name"],PATHINFO_EXTENSION);

	if(file_exists($target_file)) //if file exists then fail
		echo "File already exists.";
	else if($_FILES["packet"]["size"] > 10000000) //if file is bigger than 10mb then fail
		echo "File is too big.";
	else if($filetype != "csv") //if the file is not CSV then fail
		echo "CSV files only.";
	else if(move_uploaded_file($_FILES["packet"]["tmp_name"], $target_file)) //attempt to move file
	{
		//file has been uploaded successfully
		$file_stats = new Statistics($target_file);
		//$arr3 = $file_stats->getCredentials();
		//print_r($arr3);
	}
	else
		echo "Upload failed.";
}

?>
