<?php
	session_start();	
	$quesNo = $_SESSION['quesNo'];
	$index = $_SESSION['index'];

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
	function getSubmitStatus($quesNo, $index)
	{
		$db = mysqli_connect('localhost', 'root', '', 'omnicoder');
		$ip = get_client_ip();
		$sql = "SELECT submit FROM solution WHERE ip='$ip'";
		$result = mysqli_query($db, $sql);

		$row = $result->fetch_assoc();
    	return $row["submit"];
	}

	//Function to update submit status of column name 'submit'
	function update_submit_status($quesNo, $index)
	{
		$db = mysqli_connect('localhost', 'root', '', 'omnicoder');
		$ip = get_client_ip();
		$sql = "UPDATE solution
      			SET submit=1
      			WHERE ip='$ip'";
      	// echo $sql;
		mysqli_query($db, $sql);
		header("location: submitted.php");
	}

	//Function which checks in database and return the saved answer
	function getSavedAns($quesNo, $index)
	{
		$db = mysqli_connect('localhost', 'root', '', 'omnicoder');
		$ip = get_client_ip();
		$sql = "SELECT q$quesNo[$index] FROM solution WHERE ip='$ip'";
		$result = mysqli_query($db, $sql);

		$row = $result->fetch_assoc();
    	return $row["q$quesNo[$index]"];
	}


	//Function to do when back button is pressed
	function backbutton($index)
	{
		if($index>0)
			{
				$_SESSION['index'] = $_SESSION['index'] - 1;
				header("location: mcq.php");
			}
	}

	//Function to do when save button is pressed
	function saveButton($quesNo, $index)
	{	
		$db = mysqli_connect('localhost', 'root', '', 'omnicoder');
		$ip = get_client_ip();
		$radioVal = $_POST["q".($quesNo[$index])];
		if($radioVal=='a')
			$radioVal = 1;
		elseif($radioVal=='b')
			$radioVal = 2;
		elseif($radioVal=='c')
			$radioVal = 3;
		elseif($radioVal=='d')
			$radioVal = 4;
		$sql = "UPDATE solution
      			SET q$quesNo[$index]=$radioVal
      			WHERE ip='$ip'";
      	// echo $sql;
		mysqli_query($db, $sql);
		header("location: mcq.php");//refresh page
	}

	//Function to do when clear button is pressed
	function clearButton($quesNo, $index)
	{
		$db = mysqli_connect('localhost', 'root', '', 'omnicoder');
		$ip = get_client_ip();
		$sql = "UPDATE solution
      			SET q$quesNo[$index]=0
      			WHERE ip='$ip'";
      	// echo $sql;
		mysqli_query($db, $sql);
		// header("location: mcq.php");//refresh page
	}

	function upadte_submit_time_in_database()
	{
		$db = mysqli_connect('localhost', 'root', '', 'omnicoder');
		$ip = get_client_ip();
		$sql = "UPDATE solution
      			SET submitTime = now()
      			WHERE ip='$ip'";
      	// echo $sql;
		mysqli_query($db, $sql);
	}	
?>

<!DOCTYPE html>
<html>
<head>
	<title>MCQ round</title>
	<meta content="width=device-width, initial-scale=1" name="viewport">
</head>
<body>
	<h1>Welcome to round 1</h1>

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
		// ***************************question for omnicoder**********************************

			echo "Question ".($index+1);
			echo "<br>";
			$fileadd = "./Question/".($quesNo[$index]).".html";
			$myfile = fopen($fileadd , "r") or die("Unable to open file!");
			echo fread($myfile,filesize($fileadd));
			fclose($myfile);
		?>
		<button type="submit" name="savebtn">Save Answer</button>
		<button type="submit" name="clearbtn">Clear Answer</button>
		<button type="submit" name="nextbtn">Next</button>
		<button type="submit" name="back">Back</button>
		<!-- <input type="button" name="back" value="back"> -->
	</form>

	<?php
		//*****************************saved answer*****************************************
		$savedAns = getSavedAns($quesNo, $index);
		if($savedAns==0)
		{
			echo "Please choose a answer and SAVE it.";
		}
		else
		{
			echo "Your saved answer is: ".$savedAns;
		}
	?>

	<?php
		//************************BACK button is pressed****************************************
		if(isset($_POST['back']))
		{
			backbutton($index);
		}

		//************************NEXT button is pressed****************************************
		if (isset($_POST['nextbtn'])) 
		{
			nextButton($index);
		}

		//************************SAVED button is pressed****************************************
		if (isset($_POST['savebtn'])) 
		{
			saveButton($quesNo, $index);
		}

		//************************CLEAR button is pressed****************************************
		if (isset($_POST['clearbtn'])) 
		{
			clearButton($quesNo, $index);
		}

		//if form is already submitter redirect it to submitted page
		if(getSubmitStatus($quesNo, $index)!=0)
		{
			header("location: submitted.php");
		}	
	?>

	<?php
		//Function to do when next button is pressed
		function nextButton($index)
		{
			if($index<19)
				{
					$_SESSION['index'] = $_SESSION['index'] + 1;
					header("location: mcq.php");
				}
			// this line will execute when user submit last question
			else if($index==19)
				{
					echo '<script type="text/javascript">',
	 					 ' confirmKro();',
		 				 '</script>'
					;
				
				}
		}

		//This function is only call, in successfull submission after question 20
		if(isset($_POST['x']))
		{
			//update the submit time in database
			upadte_submit_time_in_database();
		    // Call this function if user successfully submit the form
			update_submit_status($quesNo, $index);
		}
	?>
</body>

</html>