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
		header("location: ../submitted/");
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
		header("location: ../submitted/");
	}

	//function return status, that form is already submitted or not
	function getUsername()
	{
		$db = mysqli_connect('localhost', 'root', '', 'omnicoder');
		$ip = get_client_ip();
		$sql = "SELECT username FROM round2 WHERE newip='$ip'";
		$result = mysqli_query($db, $sql);

		$row = $result->fetch_assoc();
    	return $row["username"];
	}

	function delete_directory($dirname) {
		if (is_dir($dirname))
			$dir_handle = opendir($dirname);
		if (!$dir_handle)
			return false;
		while($file = readdir($dir_handle)) {
			if ($file != "." && $file != "..") {
				if (!is_dir($dirname."/".$file))
						unlink($dirname."/".$file);
				else
						delete_directory($dirname.'/'.$file);
			}
		}
		closedir($dir_handle);
		rmdir($dirname);
		return true;
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Round 2 | Questions</title>
	<link rel="stylesheet" type="text/css" href="../../style.css">
</head>
<body>
	<header>
		<img src="../../favicon.png" style="height:100%">
		<h1>Turington 2k19</h1>
	</header>

<div class="container">
	<h2>Welcome to round 2</h2>

	<!-- This form is used to get value of confirmation message from the last question -->
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

	<form method="post" enctype="multipart/form-data">
		<?php
		// ***************************question for omnicoder Round 2 **********************************

			for ($i=0; $i < 10; $i++) { 
				$fileadd = "../Ques/".($i+1).".html";
				$myfile = fopen($fileadd , "r") or die("Unable to open file!");
				echo fread($myfile,filesize($fileadd));
				echo "<br><br>";
				fclose($myfile);
			}
		?>
		<br>
	
		<button type="submit" name="x">Upload file</button>
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

		function saveFile($username)
		{
			$x = 0;
			for( $i=1; $i<11; $i++)
			{
				$target_dir = "../uploads/$username/";
				$target_file = $target_dir . basename($_FILES["fileToUpload$i"]["name"]);

				if(!is_dir($target_dir))
					mkdir($target_dir);

				// Check if image file is a actual image or fake image
				// if(isset($_POST["submit"])) {
				// 	$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
				// 		echo "<p>File is an image - " . $check["mime"] . ".</p>";
				// }
				// Check if file already exists
				if($_FILES["fileToUpload$i"]['tmp_name']!='')	
				{	
					// if (file_exists($target_file)) {
					// 	echo '<p id="error_msg_upload">Q'.$i.'. Sorry, file already exists.</p>';
					// 	$x++;
					// }
					// else
					// {
						if (move_uploaded_file($_FILES["fileToUpload$i"]["tmp_name"], $target_file)) 
						{
							echo '<p id="msg_upload">Q'.$i.'. The file ( '.$_FILES["fileToUpload$i"]["name"].') has been uploaded.</p>';
						} 
						else 
						{
							echo '<p id="error_msg_upload">Q'.$i.'. Sorry, there was an error uploading your file.</p>';
						}
					// }
				}
			}	
			return $x;
		}

		//This function is only called, in successfull submission
		if(isset($_POST['x']))
		{
			$user = getUsername();
			$x = saveFile($user);
			// echo $x;
			if(!$x)
			{
				//Call this function if user successfully submit the form
				update_submit_status();
			}
			else
			{
				// delete_all_file($user);
				// delete_directory("../uploads/$user/");
				echo '<p id="error_msg_upload">Something went WRONG!!, 	Please Try Again</p>';
			}
		
		}

	?>
</div>
<footer>©Turington 2019</footer>
</body>
</html>
