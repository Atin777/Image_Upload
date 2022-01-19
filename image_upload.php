<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
		<input type="text" name="username" placeholder="Enter Username"/><br><br>
		<input type="text" name="useremail" placeholder="Enter Email-Id"/><br><br>
		<input type="password" name="userpassword" placeholder="Enter Password"/><br><br>
		<input type="file" name="userimage"/><br><br>
		<input type="text" name="userdetails" placeholder="Enter User Details"/><br><br>
		<input type="submit" name="submit" value="SUBMIT"/><br>
	</form>

	<?php

	$conn = mysqli_connect('localhost', 'root', '', 'testing');

	if(isset($_POST['submit'])){
		if(isset($_POST['username']) && isset($_POST['useremail']) && isset($_POST['userpassword']) && isset($_FILES['userimage']['name']) && isset($_POST['userdetails'])){
			if(!empty($_POST['username']) && !empty($_POST['useremail']) && !empty($_POST['userpassword']) && !empty($_FILES['userimage']['name']) && !empty($_POST['userdetails'])){

				$username = mysqli_real_escape_string($conn, htmlspecialchars($_POST['username']));
				$useremail = mysqli_real_escape_string($conn, htmlspecialchars($_POST['useremail']));
				$userpassword = mysqli_real_escape_string($conn, htmlspecialchars($_POST['userpassword']));
				$userdetails = mysqli_real_escape_string($conn, htmlspecialchars($_POST['userdetails']));

				$file_directory = "images/";
				$file = $file_directory . basename($_FILES["userimage"]["name"]);

				if (move_uploaded_file($_FILES["userimage"]["tmp_name"], $file)){
					$query = "insert into testing(name, email, password, image, details) values('".$username."', '".$useremail."', '".$userpassword."', '".$file."', '".$userdetails."')";
					$run_query = mysqli_query($conn, $query);
						if($run_query){
					        echo 'Thank you for registering';
					    }
					}
				}else{
					echo 'Empty Fields.';
			}

				
			}
		}

	?>

</body>
</html>
