<html>
	<head>
		<title>ncrep</title>
		<link rel="stylesheet" type="text/css" href="css/reset.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="js/main.js"></script>
	</head>
	<body>
		<div class="title">
			<h2>ncrep</h2>
		</div>
		<div class="content">
			<form action='./' method='post' enctype='multipart/form-data'>
				<p>Upload your packet capture file here, and we will report all the login information we find.</p>
				<input type="file" name="packet" id="packet" />
				<input type="submit" value="Upload" name="upload" />
			</form>
			<?php
				ini_set('display_errors',1);  error_reporting(E_ALL);
				include("classes/Statistics.php");
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
			<div class="data">
				<table class="packet-info">
					<tr>
						<th>Protocol</th>
						<th>Source</th>
						<th>Destination</th>
						<th>Username</th>
						<th>Password</th>
					</tr>
				<?php
					if (isset($file_stats))
						$file_stats->displayCredentialsTable();
				?>
				</table>
			</div>
		</div>
	<!--
		<div class="side">
			<!--Login?
			<form>
				<input type="text" name="user" placeholder="Username" /><br />
				<input type="password" name="passwd" placeholder="Password" /><br />
				<input type="submit" value="Login" />
			</form>
		</div>-->
	</body>
</html>
