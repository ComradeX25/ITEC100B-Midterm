<?php
date_default_timezone_set("Asia/Manila");
// Page Title
$pageTitle = 'Enter Authentication Code';

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

// Define variables and initialize with empty values
$authentication_code = $authentication_code_err = '';
$user_id = $_SESSION['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Prepare a select statement
    $sql = "SELECT * FROM authentication_code WHERE user_id = $user_id AND NOW() >= created_at AND NOW() <= expiration ORDER BY id DESC limit 1";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        if ($row = $result->fetch_assoc()) {
            // Check if username is empty
            if (empty(trim($_POST['authentication_code']))) {
                $authentication_code_err = 'Please enter your authentication code.';
            } else {
                $authentication_code = trim($_POST['authentication_code']);
            }

            if (empty($authentication_code_err)) {
                if ($authentication_code === $row['code']) {
                    $_SESSION['authenticated'] = true;
                    header('location: home.php');
                } else {
                    $authentication_code_err = 'Your authentication code is incorrect.';
                }
            }
        }
    } else {
        $authentication_code_err = 'Your code is expired please sign out and login again.';
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

    <!-- Styles -->
    <link rel="stylesheet" href="css/bootstrap1.css">
    <link rel="stylesheet" href="css/min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>

    <!-- Sign in -->
    <div style="height: 100%;padding-top:300px;">
        <div style="width: 500px;">
            <div style="color: white;">

                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <!-- Authentication Code -->
                    <input type="number" id="authentication_code" name="authentication_code" class="form-control <?php if (!empty($authentication_code_err)) {echo 'is-invalid';} ?> mt-3" placeholder="XXXXXX">
                    <div class="invalid-feedback">
                        <?php echo $authentication_code_err; ?>
                    </div>
                    <p class="mt-3" style="float:right;color:black;font-family: georgia;">Click<a href="authentication_code.php" target="blank" class="ca" style="font-size: 17px;float:none;color:white;">this</a>for Authentication code.</p>
                    <!-- Sign in button -->
                    <div class="mt-3">
                        <button type="submit">Confirm</button>
                        <a href="logout.php" style="padding-top:10px;padding-right:10px;color:darkred;">Sign Out</a>
                    </div><br><br><Br><br><Br><Br>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4Twt/qOuYxE721u19sVFLVSA4hf/rRt6PrZTmiPltdZcI7q7PXQBYTKyf" crossorigin="anonymous"></script>
</body>

</html>