<?php
date_default_timezone_set("Asia/Manila");
// Page Title
$pageTitle = 'Error';

$previous = 'javascript:history.go(-1)';

if (isset($_SERVER['HTTP_REFERER'])) {
	$previous = $_SERVER['HTTP_REFERER'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Title -->
	<title><?php echo $pageTitle; ?></title>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">

	<!-- Styles -->
	<!--<link rel="stylesheet" href="css/bootstrap1.css">
    <link rel="stylesheet" href="css/min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous">
    -->
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>

	<!-- About -->
	<div class="jumbotron" style="height: 100%;">
		<div class="container">
			<div class="row justify-content-md-center">
				<div class="mbr-white col-md-10">
					<h3 class="mbr-section-title align-center mbr-light pb-3 mbr-fonts-style display-2" style="font-size:30px;color:black;">Oops!</h3>
					<p class="mbr-text align-center pb-3 mbr-fonts-style display-5">Something went wrong. Please try again later.</p>
					<button class="btn btn-primary float-right" onclick="window.location.href = '<?php echo $previous; ?>'">Go back to previous page</button>
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