<?php
				if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') 
				{
					$email=$_POST['email'];
					$pass=$_POST['password'];
					$servername="localhost";
					$username="root";
					$password="";
					$dbname="login_details";
					$conn=mysqli_connect($servername,$username,$password,$dbname);
					if(!$conn)
					{
						die("Sorry we failed to connect: ". mysqli_connect_error());
					}
					else
					{
					echo "connection was Successful!<br>";
					$sql="INSERT INTO `student` (`email`, `password`) VALUES ('$email', '$pass')";
					$result=mysqli_query($conn,$sql);
					if($result)
					{
						echo '<div class="alert alert-success" role="alert">
						<h4 class="alert-heading">Success!</h4>
						<p>Your entry have been submitted  successfully</p>
					</div>';
					header("Location: 20010107.asgn.11.aspirant_details.php");
 				    exit();
					}
					else
					{
						echo "The record was not inserted successfully because of this error-->".mysqli_errno($conn);
					}
					}
			   }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Form</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<style>
		body {
			background-image: url('https://images.unsplash.com/photo-1485827404703-89b55fcc595a');
			background-size: cover;
			background-position: center;
		}
	</style>
</head>
<body>

<div class="container my-5">
	<div class="row justify-content-center">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header bg-primary text-white text-center">
					<h3>Resume Manager</h3>
				</div>
				<div class="card-body">
					<form action="/sai/20010107.asgn.11.user_login.php" method="post">
						<div class="form-group">
							<label for="email">Email:</label>
							<input type="email" class="form-control" id="email" name="email" required autocomplete="off">
						</div>
						<div class="form-group">
							<label for="password">Password:</label>
							<input type="password" class="form-control" id="password" name="password" required autocomplete="off">
						</div>
						<div class="text-center">
							<button type="submit" class="btn btn-primary btn-block">Sign up</button>
						</div>
					</form>
				</div>
				<div class="card-footer">
					<div class="text-center">
						<p class="mb-0">Already have an account? <a href="20010107.asgn.11.userlogin1.php">Login</a></p>
						<p class="mt-3 mb-0">Admin? <a href="20010107.asgn.11.admin_login.php">Click here to login</a></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
