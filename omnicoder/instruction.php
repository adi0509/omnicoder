<?php

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

	//function return status, that form is already submitted or not
	function getSubmitStatus()
	{
		$db = mysqli_connect('localhost', 'root', '', 'omnicoder');
		$ip = get_client_ip();
		$sql = "SELECT submit FROM solution WHERE ip='$ip'";
		$result = mysqli_query($db, $sql);

		$row = $result->fetch_assoc();
    	return $row["submit"];
	}

	//if form is already submitter redirect it to submitted page
	if(getSubmitStatus()!=0)
	{
		header("location: submitted.php");
	}	

?>


<!DOCTYPE html>
<html>
<head>
	<title>Instruction</title>
	<link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>
	<header>
		<img src="../favicon.png" style="height:100%">
		<h1>Turington 2k19</h1>
	</header>

<div class="container">
	<h1>Instructions</h1>
	<ol>
		<li>Anyone who submits first(final submit time) will be given more prefrence.</li>
		<li>Do not use Mobile Phone.</li>
		<li>Do not use Internet.</li>
		<li>Any participant found doing cheating shall be eliminated immediately.</li>
		<li>Please co-orporate with our voluteers.</li>
		<li>Selection for Round-2 will be based on number of registration.</li>
		<li>Round 1 Consist 30% and Round 2 consist of 70% weightage.</li>
		<li>Each Question has 4 options, and only one of them is correct.</li>
		<li>There is a <b>negative marking</b> of -1 for each incorrect answer.</li>
	</ol>
	<form method="post">
		<label class="cont">I have read all the instruction.
			<input type="checkbox" name="agree">
			<span class="checkmark"></span>
		</label>
		<input type="submit" name="submitbtn" id="submitbtn">
	</form>
</div>
	<?php
		session_start();

		//question
		$quesNo = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20 ); 

		shuffle($quesNo);
		$_SESSION['quesNo'] = $quesNo;
		$_SESSION['index'] = 0;

		if (isset($_POST['agree'])) {
			//echo $_POST['agree'];
			header("location: mcq.php");
			$_SESSION['page'] = 2;
		}

		// if user already read the inctruction go to mcq
		if($_SESSION['page']==2)
			{
				header("location: mcq.php");
			}
	?>
<footer>©Turington 2019</footer>
</body>
</html>
