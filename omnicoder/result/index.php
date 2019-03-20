<!-- 
	In this we have 2 function, we call both function one by one. 

	1. we call showRanking() so that we can show all students their result.
	2. we call  getRound2Credential() so that we can give all students their login details, so that we can change their seats, since I am using IP address as a primary key.
 -->


<?php
	//number of student selected in round 1
	$noSelected = 1;

	// Function to get the client IP address
	function get_client_ip() {
	    $ipaddress = '';
	    if (getenv('HTTP_CLIENT_IP'))
	        $ipaddress = getenv('HTTP_CLIENT_IP');
	    else if(getenv('HTTP_X_FORWARDED_FOR'))
	        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	    else if(getenv('HTTP_X_FORWARDED'))
	        $ipaddress = getenv('HTTP_X_FORWARDED');
	    else if(getenv('HTTP_FORWARDED_FOR'))
	        $ipaddress = getenv('HTTP_FORWARDED_FOR');
	    else if(getenv('HTTP_FORWARDED'))
	       $ipaddress = getenv('HTTP_FORWARDED');
	    else if(getenv('REMOTE_ADDR'))
	        $ipaddress = getenv('REMOTE_ADDR');
	    else
	        $ipaddress = 'UNKNOWN';
	    return $ipaddress;
	}

	function getMarks($ip)
	{
		$db = mysqli_connect('localhost', 'root', '', 'omnicoder');
		$sql = "SELECT marks  FROM r1detail where ip='$ip'";
		$result = mysqli_query($db, $sql);
		$row = $result ->fetch_assoc();
		return $row['marks'];
	}

	function getName($ip, $rank)
	{
		$db = mysqli_connect('localhost', 'root', '', 'omnicoder');
		$sql = "SELECT * FROM student where ip='$ip'";
		$result = mysqli_query($db, $sql);
		$marks = getMarks($ip);
		$str = "";
		while($row = $result ->fetch_assoc())
		{
			// name, college, course
			$str = "<tr>  <td>".($rank+1)."</td>  <td>".$marks."</td>  <td>".$row['name']."</td> <td>".$row['course']."</td> <td>".$row['college']."</td>  </tr>";
		}
		
		return $str;
	}

	function updateRank($ip)
	{
		$db = mysqli_connect('localhost', 'root', '', 'omnicoder');
		$sql = "UPDATE r1detail
      			SET selected=1
      			WHERE ip='$ip'";
      	// echo $sql;
		mysqli_query($db, $sql);

	}

	function showRanking()
	{
		global $noSelected;
		$db = mysqli_connect('localhost', 'root', '', 'omnicoder');
		$sql = "SELECT * FROM r1detail ORDER BY marks DESC , submitTime ASC";
		$result = mysqli_query($db, $sql);

		$selected = 1;
		$rank = 0;
		echo "<H1> Rank List</H1>";
		$str = "<table>";
		$str = $str."<tr>  <th>Rank</th> <th>Marks</th>  <th>Name</th> <th>Course</th> <th>College</th>  </tr>";
		while($row = $result ->fetch_assoc()) {
			if ($selected<=$noSelected)
			{
				
				
				updateRank($row['ip']);
				$selected+=1;
			}
			$str = $str.(getName($row['ip'], $rank));
			$rank+=1;
   		}
   		$str = $str."</table>";
   		echo $str;
	}

	
	function getRound2Credential()
	{
		$ip = get_client_ip();
		$db = mysqli_connect('localhost', 'root', '', 'omnicoder');
		$sql = "SELECT * FROM r1detail where ip='$ip' AND selected=1";
		$result = mysqli_query($db, $sql);
		$check =0;
		$str = "";
		while($row = $result ->fetch_assoc())
		{
			$str = "<h1> Your Login Credentials </h1>";
			$str = $str."Username: ".$row['username']."  <br>  Password: ".$row['pwd']; 
			$check +=1;
		}

		if($check==0)
			$str = $str.'<p id="error_msg">Sorry you are not selected</p>';

		echo $str;

	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Result Of Round-1</title>
	<link rel="stylesheet" type="text/css" href="../../style.css">
</head>
<body>
	<header>
		<img src="../../favicon.png" style="height:100%">
		<h1>Turington 2k19</h1>
	</header>

	<div class="container">
		<?php
			// this is used to rank all students	
			showRanking();
		?>
		<hr id="spaced">
		<?php
			// this function is used to get username and password
			getRound2Credential	();
		?>
		<br><br>
		<?php
			// uncomment this when all user redirect it to round 2
			// echo '<a href="../../omnicoder2/"><button>Go to Round 2</button></a>';
		?>
	</div>
<footer>©Turington 2019</footer>
</body>
</html>
