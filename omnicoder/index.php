<?php
	session_start();
	$page=0;
	if(!isset($_SESSION['page']))
	{	
		$_SESSION['page'] = $page;
	}

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

	//to register in database
	function register($name, $course, $semester, $college, $email, $mobile, $language)
	{
		// echo($name."  ".$course."  ".$semester."  ".$college."  ".$email."  ".$mobile);
		$db = mysqli_connect('localhost', 'root', '', 'omnicoder');
		$ip = get_client_ip();
		$sql = "INSERT INTO student(ip, name, course, semester, college, email, mobile, language) VALUES('$ip', '$name', '$course', '$semester', '$college', '$email', '$mobile', '$language' )";
		
		mysqli_query($db, $sql);

		//redirect to instruction page
		header("location: instruction.php");
	}

	function registerSolution()
	{
		$db = mysqli_connect('localhost', 'root', '', 'omnicoder');
		$ip = get_client_ip();
		$sql = "INSERT INTO solution(ip, q1, q2, q3, q4, q5, q6, q7, q8, q9, q10, q11, q12, q13, q14, q15, q16, q17, q18, q19, q20, submit,submitTime) VALUES('$ip', 0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0)";
		
		mysqli_query($db, $sql);
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

?>

<!DOCTYPE html>
<html>
<head>
	<title>Omnicoder</title>
	<link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>
	<header>
		<img src="../favicon.png" style="height:100%">
		<h1>Turington 2k19</h1>
	</header>

<div class="container">
		<h1>Welcome to omnicoder</h1>

		<form action="index.php" method="post">
			<span id="ques">Name: </span>
			<input type="text" name="name"><br>
			<span id="ques">Course: </span>
			<input type="text" name="course"><br>
			<span id="ques">Semester: </span>
			<input type="text" name="semester"><br>
			<span id="ques">College: </span>
			<input type="text" name="college"><br>
			<span id="ques">Email: </span>
			<input type="text" name="email"><br>
			<span id="ques">Mobile number: </span>
			<input type="text" name="mobile"><br>
			<span id="ques">Language you know(separated by ',' comma): </span><br>
			<textarea name="language"></textarea><br>

			<input type="submit" name="sbt">
		</form>

		<?php
			if(isset($_POST['sbt']))
			{

				//this line update the page to go to instruction page
				$_SESSION['page']=1;

				$name = $_POST['name'];
				$course = $_POST['course'];
				$semester = $_POST['semester'];
				$college = $_POST['college'];
				$email = $_POST['email'];
				$mobile = $_POST['mobile'];
				$language = $_POST['language'];
				registerSolution();
				register($name, $course, $semester, $college, $email, $mobile, $language);


			}

			if($_SESSION['page']==1)
			{
				header("location: instruction.php");
			}
			elseif($_SESSION['page']==2)
			{
				header("location: mcq.php");
			}
			// echo $_SESSION['page'];

			//if form is already submitter redirect it to submitted page
			if(getSubmitStatus()!=0)
			{
				header("location: submitted.php");
			}	
		?>

<footer>©Turington</footer>
</body>
</html>
