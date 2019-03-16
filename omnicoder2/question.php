<!-- 
	In this page we take compress file from user and save it to "submittedFile".
 -->
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
		$sql = "SELECT submitStatus FROM round2 WHERE newip='$ip'";
		$result = mysqli_query($db, $sql);

		$row = $result->fetch_assoc();
    	return $row["submitStatus"];
	}

	//if form is already submitter redirect it to submitted page
	if(getSubmitStatus()!=0)
	{
		header("location: submitted.php");
	}	

	function update_submit_status()
	{
		$db = mysqli_connect('localhost', 'root', '', 'omnicoder');
		$ip = get_client_ip();
		$sql1 = "UPDATE round2
      			SET submitStatus=1
      			WHERE ip='$ip'";
      	// echo $sql;
		mysqli_query($db, $sql1);
		$sql2 = "UPDATE round2
      			SET submitTime=now()
      			WHERE ip='$ip'";
      	mysqli_query($db, $sql2);
		// header("location: submitted.php");
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Round 2 | Question</title>
</head>
<body>

	<h2>Welcome to round 2</h2>

	<!-- THis form is used to get value of confirmation message from the last question -->
	<form style="display: none;" id="myform" action="" method="post">
        <input type="text" id="x" name="x">
    </form>
    <!-- Javascript used in this page -->
	<script type="text/javascript">
	    var confirm ;
	    function myFunction() {
	        document.getElementById("x").value='12343215555';
	        document.getElementById("myform").submit();
	    }

	    function confirmKro()
	    {
		    confirm = confirm("Are you sure, you want to submit!!");
		    if (confirm)
		    {
		        myFunction();
		    }
		}
	</script>


	<form method="post" action="">
		<?php
		// ***************************question for omnicoder Round 2 **********************************

			for ($i=0; $i < 10; $i++) { 
				$fileadd = "./Question/".($i+1).".html";
				$myfile = fopen($fileadd , "r") or die("Unable to open file!");
				echo fread($myfile,filesize($fileadd));
				echo "<br><br>";
				fclose($myfile);
			}
		?>
		<button type="submit" name="savebtn">Submit Round 2</button>
		<!-- <input type="button" name="back" value="back"> -->
	</form>

	<?php
		if(isset($_POST['savebtn']))
		{
			echo '<script type="text/javascript">',
	 					 ' confirmKro();',
		 				 '</script>'
				;
			
		}

		//This function is only call, in successfull submission
		if(isset($_POST['x']))
		{
		    // Call this function if user successfully submit the form
			update_submit_status();
		}

	?>

</body>
</html>