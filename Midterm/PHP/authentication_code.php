<?php
date_default_timezone_set("Asia/Manila");
// Page Title
$pageTitle = 'Authentication Code';

// Initialize the session
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] === false) {
    // Check if the user is not logged in, if yes then redirect him to login page
    header('location: index.php');
    exit;
} else if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
    // Check if the user is authenticated, if yes then redirect him to home page
    header('location: home.php');
    exit;
}

// Include database config file
require_once 'database.php';

// Define variables and initialize
$user_id = $_SESSION['id'];
$authentication_code = 'EXPIRED';

$sql = "SELECT code FROM authentication_code WHERE user_id = $user_id AND NOW() >= created_at AND NOW() <= expiration ORDER BY id DESC limit 1";
$result = $conn->query($sql);

if ($result->num_rows === 1) {
    if ($row = $result->fetch_assoc()) {
        $authentication_code = $row['code'];
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Title -->
    <title><?php echo $pageTitle; ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">

    <!-- Styles -->
    <link rel="stylesheet" href="css/bootstrap1.css">
    <link rel="stylesheet" href="css/min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>

    <!-- Sign in -->
    <div style="height: 100%;">
        <div style="width: 370px;padding-top:300px;">
            <div style="color: white;">
                <!-- Card title -->
                <h1 align="center" style="font-family: georgia;">Authentication Code</h1>
                <div class="container">
                    <div class="row" style="background-color: gray;">
                        <div class="col border rounded text-center py-3">
                            <label style="font-size: 50px; color: black;"><?php echo $authentication_code; ?></label>
                        </div>
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