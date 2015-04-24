<html>
<<<<<<< HEAD
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
		</style>
	</head>
	<body>
		<div class="content">
			<form>
				<input type="file" name="packet" />
				<input type="submit" value="Upload" />
			</form>
			
			<div class="data">
				Data goes here

				<table>
					<tr>
						<th>Protocol</th>
						<th>Source</th>
						<th>Destination</th>
						<th>Username</th>
						<th>Password</th>
					</tr>
						
				<?php
				
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
				
				?>
				</table>
			</div>
		</div>
		<div class="side">
			Login?
			<form>
				<input type="text" name="user" placeholder="Username" /><br />
				<input type="password" name="passwd" placeholder="Password" /><br />
				<input type="submit" value="Login" />
			</form>
		</div>
	</body>
=======
<head></head>
<body>
<?php
echo "ncrep";
?>
</body>
>>>>>>> 8cdaf5f30c5ae4da437c65aec459028afe58caf2
</html>
