<!-- 
	######  DO NOT APPLY CSS IN THIS FILE  ######
	This file is only used to update database of result.

	######  MAI TO DAALUNGA CSS  #########
	Mera man hora CSS daalne ka.
 -->

<?php
	$answer = array('q1'=> "1", 'q2'=> "1",'q3'=> "1",'q4'=> "1",'q5'=> "1",'q6'=> "1",'q7'=> "1",'q8'=> "1",'q9'=> "1",'q10'=> "1",'q11'=> "1",'q12'=> "1",'q13'=> "1",'q14'=> "1",'q15'=> "1",'q16'=> "1",'q17'=> "1",'q18'=> "1",'q19'=> "1",'q20'=> "1");
	
	function toGetHighestUsername()
		{
			$db = mysqli_connect('localhost', 'root', '', 'omnicoder');
			$sql = "SELECT max(username) FROM r1detail";
			$result = mysqli_query($db, $sql);
			$row = $result ->fetch_assoc();
			$username = $row['max(username)'];
			// echo $username;
			if(is_null($username))
				return 100;
			else
				return ($username+1);
		}

	function pwd()
	{
		$pass = "";
		for ($i=0; $i < 5; $i++) { 
			$pass = $pass.chr(number_format(rand(65,90))) ;
		}
		return $pass; 
	}
	function insertInR1detail($row)
	{
		$db = mysqli_connect('localhost', 'root', '', 'omnicoder');

		global $answer;
		$marks = 0;
		for ($i=0; $i < 20; $i++) {
				$t = $row['q'.($i+1)];
				// echo "submit: ".$row['q'.($i+1)]."  ans: ".$answer['q'.($i+1)]."  equality:  ".($t==$answer['q'.($i+1)])." <br>";
				if($t==$answer['q'.($i+1)])
					$marks +=4;
				elseif($t==0)
					$marks+=0;
				else
					$marks -=1;
			}
		$username = toGetHighestUsername();
		$pwd = pwd();
		$ip = $row['ip'];
		$submitTime = $row['submitTime'];
		$sql = "INSERT INTO r1detail(ip, marks, username, pwd, submitTime, loginStatus, selected) VALUES ('$ip', $marks, '$username', '$pwd', '$submitTime', 0, 0)";
		mysqli_query($db, $sql);
	}

	function updateTable()
	{
		
		$db = mysqli_connect('localhost', 'root', '', 'omnicoder');
		$sql = "SELECT * FROM solution";
		$result = mysqli_query($db, $sql);
		while($row = $result ->fetch_assoc()) {
			insertInR1detail($row);
   		}

   		echo "Result updated!!";
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Calculate Result</title>
	<link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>
	<header>
		<img src="../favicon.png" style="height:100%">
		<h1>Turington 2k19</h1>
	</header>

<div class="container">
		<?php
			updateTable()
		?>
</div>
<footer>©Turington 2019</footer>
</body>
</html>
