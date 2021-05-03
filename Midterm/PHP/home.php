<?php
date_default_timezone_set("Asia/Manila");
// Page Title

$pageTitle = 'Home';

// Initialize the session
session_start();
require_once "database.php";
$username = '';
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] === false) {
	// Check if the user is not logged in, if yes then redirect him to login page
	header('location: index.php');
	exit;
} elseif (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] === false) {
	// Check if the user is not authenticated, if yes then redirect him to enter authentication code page
	header('location: enter_authentication_code.php');
	exit;
  }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$sql = 'SELECT id, username, password FROM users WHERE username = ?';

        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, 's', $param_username);

            // Set parameters
            $param_username = $username;
		 	$stmt1 = $conn->prepare("INSERT INTO activity_log (activity, user_name) VALUES (?, ?)");
         	$stmt1->bind_param("ss", $activity, $username);
         
        	// set parameters and execute
         	$activity = "Logged out";
         	$username = ($_SESSION["username"]);
        
         	$stmt1->execute();
         	$stmt1->close();
       
       		// Redirect to login page        
        	header("location: logout.php" );
    }
    mysqli_close($conn);	
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Title -->
	<title><?php echo $pageTitle; ?></title>

    <!-- Styles -->
    <link rel="stylesheet" href="css/bootstrap1.css">
    <link rel="stylesheet" href="css/min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous">   
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<style>
		form {
			width: 540px;
			border: 2px solid #808080;
			padding: 30px;
			background: linear-gradient(to top left, #3366ff 0%, #00ffcc 100%);
			border-radius: 15px;
			height: 150px;
}
	</style>
</head>

<body>

	<!-- Welcome message -->
	<div style="height: 100%;padding-top:300px;">
		<div>
			<div>
				<div>
					<h2 style="color: black;" align="center">Welcome, <?php echo htmlspecialchars($_SESSION["username"]); ?>!</h2>
					<br><br>
					<div style="padding-right: 5px;">
						<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
						<div style="padding-left: 15px;">
							<a href="forgot_password.php" class="btn btn-default"style="background-color: gray;text-align: center;color:white;float:left;width:451px;height:43px;">Reset Password</a><br>
						</div><br>
						
							<button type="submit" name="logout" id="logout" style="height:45px;">Log Out</button>
			        	</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Scripts -->
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script>
</body>

</html>