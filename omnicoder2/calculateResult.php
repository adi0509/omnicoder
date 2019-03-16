<!-- 
	######  DO NOT APPLY CSS IN THIS FILE  ######
	This file is only used to update database of result.
 -->

<?php
	$answer = array('q1'=> "1", 'q2'=> "1",'q3'=> "1",'q4'=> "1",'q5'=> "1",'q6'=> "1",'q7'=> "1",'q8'=> "1",'q9'=> "1",'q10'=> "1",'q11'=> "1",'q12'=> "1",'q13'=> "1",'q14'=> "1",'q15'=> "1",'q16'=> "1",'q17'=> "1",'q18'=> "1",'q19'=> "1",'q20'=> "1");
	
	// usename starts from 100
	$username = 100;
	function username()
	{
		global $username;
		$username +=1;
		return $username;
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
		$username = username();
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
</head>
<body>
		<?php

			//uncomment this to get result

			updateTable()
		?>
</body>
</html>