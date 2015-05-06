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
		<!--<style type='text/css'>
			/* 
			  make each pie piece a rectangle twice as high as it is wide.
			  move the transform origin to the middle of the left side.
			  Also ensure that overflow is set to hidden.
			*/
			  .pie {
					position:absolute;
					width:100px;
					height:220px;
					overflow:hidden;
					left:150px;
					-moz-transform-origin:left center;
					-ms-transform-origin:left center;
					-o-transform-origin:left center;
					-webkit-transform-origin:left center;
					transform-origin:left center;
				}
			/*
			  unless the piece represents more than 50% of the whole chart.
			  then make it a square, and ensure the transform origin is
			  back in the center.

			  NOTE: since this is only ever a single piece, you could
			  move this to a piece specific rule and remove the extra class
			*/
				.pie.big {
					width:200px;
					height:219px;
					left:50px;
					-moz-transform-origin:center center;
					-ms-transform-origin:center center;
					-o-transform-origin:center center;
					-webkit-transform-origin:center center;
					transform-origin:center center;
				}
			/*
			  this is the actual visible part of the pie. 
			  Give it the same dimensions as the regular piece.
			  Use border radius make it a half circle.
			  move transform origin to the middle of the right side.
			  Push it out to the left of the containing box.
			*/
				.pie:BEFORE {
					content:"";
					position:absolute;
					width:100px;
					height:200px;
					left:-100px;
					border-radius:100px 0 0 100px;
					-moz-transform-origin:right center;
					-ms-transform-origin:right center;
					-o-transform-origin:right center;
					-webkit-transform-origin:right center;
					transform-origin:right center;
		
				}
			 /* if it's part of a big piece, bring it back into the square */
				.pie.big:BEFORE {
					left:0px;
				}
			/* 
			  big pieces will also need a second semicircle, pointed in the
			  opposite direction to hide the first part behind.
			*/
				.pie.big:AFTER {
					content:"";
					position:absolute;
					width:100px;
					height:200px;
					left:100px;
					border-radius:0 100px 100px 0;
				}
			/*
			  add colour to each piece.
			*/
				.pie:nth-of-type(n+1):BEFORE,
				.pie:nth-of-type(n+1):AFTER {
					background-color:blue;	
				}
				.pie:nth-of-type(n+2):AFTER,
				.pie:nth-of-type(n+2):BEFORE {
					background-color:green;	
				}
				.pie:nth-of-type(n+3):AFTER,
				.pie:nth-of-type(n+3):BEFORE {
					background-color:red;	
				}
				.pie:nth-of-type(n+4):AFTER,
				.pie:nth-of-type(n+4):BEFORE {
					background-color:orange;	
				}
			/*
			  now rotate each piece based on their cumulative starting
			  position
			*/
				.pie[data-start="30"] {
					-moz-transform: rotate(30deg); /* Firefox */
					-ms-transform: rotate(30deg); /* IE */
					-webkit-transform: rotate(30deg); /* Safari and Chrome */
					-o-transform: rotate(30deg); /* Opera */
					transform:rotate(30deg);
				}
				.pie[data-start="60"] {
					-moz-transform: rotate(60deg); /* Firefox */
					-ms-transform: rotate(60deg); /* IE */
					-webkit-transform: rotate(60deg); /* Safari and Chrome */
					-o-transform: rotate(60deg); /* Opera */
					transform:rotate(60deg);
				}
				.pie[data-start="100"] {
					-moz-transform: rotate(100deg); /* Firefox */
					-ms-transform: rotate(100deg); /* IE */
					-webkit-transform: rotate(100deg); /* Safari and Chrome */
					-o-transform: rotate(100deg); /* Opera */
					transform:rotate(100deg);
				}
			/*
			  and rotate the amount of the pie that's showing.

			  NOTE: add an extra degree to all but the final piece, 
			  to fill in unsightly gaps.
			*/
				.pie[data-value="30"]:BEFORE {
					-moz-transform: rotate(31deg); /* Firefox */
					-ms-transform: rotate(31deg); /* IE */
					-webkit-transform: rotate(31deg); /* Safari and Chrome */
					-o-transform: rotate(31deg); /* Opera */
					transform:rotate(31deg);
				}
				.pie[data-value="40"]:BEFORE {
					-moz-transform: rotate(41deg); /* Firefox */
					-ms-transform: rotate(41deg); /* IE */
					-webkit-transform: rotate(41deg); /* Safari and Chrome */
					-o-transform: rotate(41deg); /* Opera */
					transform:rotate(41deg);
				}
				.pie[data-value="260"]:BEFORE {
					-moz-transform: rotate(260deg); /* Firefox */
					-ms-transform: rotate(260deg); /* IE */
					-webkit-transform: rotate(260deg); /* Safari and Chrome */
					-o-transform: rotate(260deg); /* Opera */
					transform:rotate(260deg);
				}
		</style>
		<script type='text/javascript'>
			$(function() {
				var pies = $("div.pie");
				var numpies = pies.length;
				var i = 1;
				pies.hover(function() {
					var type = $(this).attr("data-key");
					var perc = $(this).attr("data-perc");
					$("div.pieinfo").html("<h2>"+type+"</h2><p>"+perc+"</p>");
				}, function() {
					$("div.pieinfo").html("");
				});
				pies.each(function() {
					start = parseInt($(this).attr("data-start"));
					starttext = "rotate("+start+"deg)";
					perc = parseInt($(this).attr("data-value"));
					if(i < numpies)
						perc++;
					perctext = "rotate("+perc+"deg)";
					$(this).css({
						"-moz-transform": starttext, /* Firefox */
						"-ms-transform": starttext, /* IE */
						"-webkit-transform": starttext, /* Safari and Chrome */
						"-o-transform": starttext, /* Opera */
						"transform": starttext
					});
					// workaround to manipulate pseudo-elements
					var rules = " "+
						"-moz-transform: "+perctext+";"+
						"-ms-transform: "+perctext+";"+
						"-webkit-transform: "+perctext+";"+
						"-o-transform: "+perctext+";"+
						"transform: "+perctext+";"+
						" ";
					if(i == numpies)
						perc++;
					var selector = ".pie[data-value='"+(perc-1)+"']";
					$('<style>'+selector+':before{'+rules+'}</style>').appendTo('head');
					i++;
				});
			});
			
			
		</script>-->
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
				
				<div class="stats">
					<br /><br />
					<?php
						if(isset($file_stats))
						{
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
						}
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
								if(isset($file_stats))
								{
									$perc_arr = $file_stats->getProtocolsPercent();
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
								}	
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="side">
		
		</div>
	</body>
</html>
