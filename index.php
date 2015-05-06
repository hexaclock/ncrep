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
		<script src="js/Chart.min.js"></script>
		<script src="js/main.js"></script>
		<script src="js/tablesort.js"></script>
	</head>
	<body>
		<div class="title">
			<h2>ncrep</h2>
		</div>
		
		<div class="content">
			<form action='./' method='post' enctype='multipart/form-data'>
				<p>Upload your packet capture file here, and we will report all the login information we find.</p>
				<?php
					if ($upload_error != "")
						echo "<p>".$upload_error."</p>";
				?>
				<input type="file" name="packet" id="packet" />
				<input type="hidden" name="check" value="1" />
				<input type="submit" value="Upload" name="upload" />
			</form>
			<?php
				if(isset($file_stats))
				{
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
						$file_stats->displayCredentialsTable();
					?>
				</table>
				
				<div class="stats">
					<?php
						$perc_arr = $file_stats->getProtocolsPercent();
						
						$start = 0;
						$js = "";
						foreach($perc_arr as $key => $value)
						{
							$perc = round(360 * ($value/100));
							$class = "pie";
							if($perc > 180)
								$class .= " big";
							$randcolor = strtoupper(dechex(rand(0x000000, 0xFFFFFF)));
							$highlight = strtoupper(dechex(hexdec($randcolor)+20));
							$js .= "{ value: $perc, color: \"#$randcolor\", highlight: \"#$highlight\", label: \"$key\" },";
							$start += $perc;
						}
						$js = rtrim($js,',');
						echo "<script>pieData = [ $js ];</script><script src=\"js/circle.js\"></script>";
					?>
					<div class="left">
						<p>Hover over a section to view the protocol type.</p>
						<div id="canvas-holder">
							<canvas id="chart-area" width="300" height="300"/>
						</div>
					</div>
					<div class="left">
						<span class="togglestats">View Actual Percentages</span>
						<div class="actualstats">
							<?php
								$i = 1;
								foreach($perc_arr as $key => $value)
								{
									echo "<strong>$key</strong> : $value%";
									if(($i % 4) == 0)
										echo "<br />";
									else
										echo " || ";
									$i++;
								}
							?>
						</div>
					</div>
				</div>
			</div>
			
			<?php
				}
			?>
		</div>
	</body>
</html>
