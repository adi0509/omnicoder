<?php
	session_start();

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
		$sql = "SELECT submitStatus FROM round2 WHERE newip='$ip'";
		$result = mysqli_query($db, $sql);

		$row = $result->fetch_assoc();
    	return $row["submitStatus"];
	}

	//if form is already submitter redirect it to submitted page
	if(getSubmitStatus()!=0)
	{
		header("location: ../submitted/");
	}	

?>

<!DOCTYPE html>
<html>
<head>
	<title>Instruction</title>
	<link rel="stylesheet" type="text/css" href="../../style.css">
</head>
<body>
	<header>
		<img src="../../favicon.png" style="height:100%">
		<h1>Turington 2k19</h1>
	</header>

<div class="container">
	<h1>Instruction</h1>
	<ol>
		<li>Anyone who submit first(final submit time) will be given more prefrence.</li>
		<li>Do not use Mobile Phone.</li>
		<li>Do not use Internet.</li>
		<li>Any participant found doing cheating can be eliminate by our volunteers.</li>
		<li>Please co-orporate with our voluteers.</li>
		<li>There are 10 question, you have write code of each program.</li>
		<li>You can only write <b>one question from one language</b>.</li>
		<li>There is no negative marking in this round.</li>
		<li> <b>Each question is saved as "q1.cpp" etc.</b> </li>
		<li>In each program,<b>(in the first line)</b> you should comment your question number and languauge you are using.</li>
		<li>You have to compile all your code in Docker container (Don't worry we'll help you if you don't know about docker).</li>
	</ol>
	<form method="post">
		<label class="cont">I have read all the instruction.
			<input type="checkbox" name="agree">
			<span class="checkmark"></span>
		</label>
		<input type="submit" name="submitbtn" id="submitbtn">
	</form>
	<?php

		if (isset($_POST['agree'])) {
			//echo $_POST['agree'];
			$_SESSION['page'] = 2;
			header("location: ../question/");
		}

		// if user already read the inctruction go to question.php
		if($_SESSION['page']==2)
			{
				header("location: ../question/");
			}
		// echo $_SESSION['page'];
	?>
</div>
<footer>©Turington 2019</footer>
</body>
</html>
