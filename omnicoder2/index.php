
<?php
	session_start();
	if(!isset($_SESSION['page']))
	{	
		$_SESSION['page'] = 1;
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

	function updateLoginStatus($ip)
	{
		$db = mysqli_connect('localhost', 'root', '', 'omnicoder');
		$sql = "UPDATE r1detail
      			SET loginStatus=1
      			WHERE ip='$ip'";
      	echo $sql;
		mysqli_query($db, $sql);
	}

	function getOldip($username)
	{
		$db = mysqli_connect('localhost', 'root', '', 'omnicoder');
		$sql = "SELECT ip FROM r1detail WHERE username='$username'";
		$result = mysqli_query($db, $sql);
		$row = $result->fetch_assoc();
    	return $row["ip"];
	}

	function updateRound2Table($username)
	{
		$db = mysqli_connect('localhost', 'root', '', 'omnicoder');
		$ip = get_client_ip();
		$oldip = getOldip($username);
		$sql =  "INSERT INTO round2(ip, newip, submitStatus, username) VALUES( '$oldip' , '$ip', 0, '$username' )";
		mysqli_query($db, $sql);
	}

	function alreadyLogin()
	{
		$ip = get_client_ip();
		$db = mysqli_connect('localhost', 'root', '', 'omnicoder');
		$sql = "SELECT * FROM round2 WHERE newip='$ip'";
		$result = mysqli_query($db, $sql);

		if(mysqli_num_rows($result)==1) 
			return 1;
		else
			return 0;
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Round 2</title>
</head>
<body>
	<h2>Login using your login credential</h2>
	<form method="post" action="">
		Username<input type="text" name="username"><br>
		Password<input type="password" name="password"><br>
		<input type="submit" name="btn">
	</form>

	<?php
		if(empty($_SESSION['userName'])!=1)
		{
			 header("location: instruction.php"); //redirect
		}

		if(alreadyLogin())
		{
			header("location: instruction.php"); //redirect
		}

		if(isset($_POST['btn']))
		{
			$username = $_POST['username'];
			$password = $_POST['password'];

			$db = mysqli_connect('localhost', 'root', '', 'omnicoder');
			$sql = "SELECT * FROM r1detail WHERE username='$username' AND pwd='$password'";
			$result = mysqli_query($db, $sql);

			if(mysqli_num_rows($result)==1) 
			{
				$row = $result->fetch_assoc();
				if($row['loginStatus']=="0")
				{
					$_SESSION['message']= "You are now logged in";
					$_SESSION['userName']= $username;
					updateLoginStatus($row['ip']);
					updateRound2Table($username);
					header("location: instruction.php"); //redirect;
				}
				else
				{
					$_SESSION['message']= "Someone has already login with this login credentials.";
				}
			}
			else 
			{
				$_SESSION['message']= "Username/Password combination is not correct";
			}

			
			if(isset($_SESSION['message']))
			{
				echo "<div id='error_msg'>".$_SESSION['message']."</div>";
				unset($_SESSION['message']);
			}
		}

	?>
		
</body>
</html>