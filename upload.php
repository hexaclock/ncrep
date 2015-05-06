<?php

require_once("classes/Statistics.php");

$upload_error = "";
echo $_POST['upload'];
if(isset($_POST['upload']))
{
	//check to make sure user actually uploaded something
	if(!file_exists($_FILES['packet']['tmp_name']) || !is_uploaded_file($_FILES['packet']['tmp_name'])) {
		 $upload_error = "Please select a file to upload.";
	}
	else {
		$target_dir = '/tmp/'; //where file will be stored
		$target_file = $target_dir.sha1(sha1_file($_FILES["packet"]["tmp_name"]).time()); //where file will be placed
		$filetype = pathinfo($_FILES["packet"]["name"],PATHINFO_EXTENSION); //get the extension of the file

		if(file_exists($target_file)) //if file exists then fail
			$upload_error = "File already exists.";
		else if($_FILES["packet"]["size"] > 10000000) //if file is bigger than 10mb then fail
			$upload_error = "File is too big.";
		else if($filetype != "csv") //if the file is not CSV then fail
			$upload_error = "CSV files only.";
		else if(move_uploaded_file($_FILES["packet"]["tmp_name"], $target_file)) //attempt to move file
		{
			//file has been uploaded successfully
			$file_stats = new Statistics($target_file);
			//$arr3 = $file_stats->getCredentials();
			//print_r($arr3);
		}
		else
			$upload_error = "Upload failed.";
	}
}

?>
