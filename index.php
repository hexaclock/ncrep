<?php
	ini_set('display_errors',1);  error_reporting(E_ALL);
	require_once("upload.php");
?>

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
				<?php
					if (isset($upload_error))
						echo "<p>".$upload_error."</p>";
				<input type="file" name="packet" id="packet" />
				<input type="submit" value="Upload" name="upload" />
			</form>
			
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
		
		<div class="side">
		
		</div>
	</body>
</html>
