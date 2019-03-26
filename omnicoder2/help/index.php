<!DOCTYPE html>
<html>
<head>
	<title>Round 2 | Help</title>
	<link rel="stylesheet" type="text/css" href="../../style.css">
</head>
<body>
	<header>
		<img src="../../favicon.png" style="height:100%">
		<h1>Turington 2k19</h1>
	</header>

	<div class="container">
		<h2>Help for compiling your code</h2>
		<?php
				$fileadd = "../../docker-command/docker-command.txt";
				$myfile = fopen($fileadd , "r") or die("Unable to open file!");
				echo fread($myfile,filesize($fileadd));
				echo "<br>";
				fclose($myfile);
		?>
	</div>


	<footer>©Turington 2019</footer>
</body>
</html>