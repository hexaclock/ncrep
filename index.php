<html>
	<head>
		<title>ncrep</title>
		<style type="text/css">
			/**** BEGIN RESET ****/
			html, body, div, span, applet, object, iframe,
			h1, h2, h3, h4, h5, h6, p, blockquote, pre,
			a, abbr, acronym, address, big, cite, code,
			del, dfn, em, img, ins, kbd, q, s, samp,
			small, strike, strong, sub, sup, tt, var,
			b, u, i, center,
			dl, dt, dd, ol, ul, li,
			fieldset, form, label, legend,
			table, caption, tbody, tfoot, thead, tr, th, td,
			article, aside, canvas, details, embed, 
			figure, figcaption, footer, header, hgroup, 
			menu, nav, output, ruby, section, summary,
			time, mark, audio, video {
				margin: 0;
				padding: 0;
				border: 0;
				/*font-size: 100%;
				font: inherit;*/
				vertical-align: baseline;
			}
			/* HTML5 display-role reset for older browsers */
			article, aside, details, figcaption, figure, 
			footer, header, hgroup, menu, nav, section {
				display: block;
			}
			body {
				line-height: 1;
			}
			ol, ul {
				list-style: none;
			}
			blockquote, q {
				quotes: none;
			}
			blockquote:before, blockquote:after,
			q:before, q:after {
				content: '';
				content: none;
			}
			table {
				border-collapse: collapse;
				border-spacing: 0;
			}
			/**** END RESET ****/
			* {
				-webkit-box-sizing: border-box;
				-moz-box-sizing: border-box;
				box-sizing: border-box;
			}
			div {
				padding: 10px;
			}
			div.content {
				width: 80%;
				float: left;
			}
			div.side {
				width: 20%;
				float: left;
			}
			table.packet-info {
				width: 80%;
			}
			table.packet-info th {
				text-align: left;
			}
			table.packet-info th, table.packet-info td {
				padding: 5px;
				border: 1px solid #E0E0E0;
			}
		</style>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script type="text/javascript">
			$(function() {
				$("table td, table th").hover(function() {
					var i = $(this).index()+1;
					updateTableColor(i, "#F0F0F0");
				}, function() {
					var i = $(this).index()+1;
					updateTableColor(i, "#fff");
				});
				
			});
			
			function updateTableColor(n, color)
				{
					$("table th:nth-child("+n+")").css("background-color", color);
					$("table tr td:nth-child("+n+")").each( function () {
						$(this).css("background-color", color);
					});
				}
		</script>
	</head>
	<body>
		<div class="content">
			<form action='./' method='post' enctype='multipart/form-data'>
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
						$arr3 = $file_stats->getCredentials();
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
					if(isset($arr3))
					{
						foreach($arr3 as $key => $arr2)
						{
							foreach($arr2 as $key => $arr1)
							{
								echo "<tr>";
								echo "<td>".$arr1['proto']."</td>";
								echo "<td>".$arr1['src']."</td>";
								echo "<td>".$arr1['dst']."</td>";
								echo "<td>".$arr1['user']."</td>";
								echo "<td>".$arr1['pass']."</td>";
								echo "</tr>";
							}
						}
					}
				
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
