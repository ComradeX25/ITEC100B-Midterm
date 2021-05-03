<?php
date_default_timezone_set("Asia/Manila");
// Page Title
$pageTitle = 'Login';

// Initialize the session
session_start();


// Include database config file
require_once 'database.php';

// Define variables and initialize with empty values
$username = $password = '';
$username_err = $password_err = '';

// Processing form data when form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Check if username is empty
    if (empty(trim($_POST['username']))) {
        $username_err = ' Please enter a username.';
    } else {
        $username = trim($_POST['username']);
    }

    // Check if password is empty
    if (empty(trim($_POST['password']))) {
        $password_err = ' Please enter a password.';
    } else {
        $password = trim($_POST['password']);
    }

    // Validate credentials
    if (empty($username_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = 'SELECT id, username, password FROM users WHERE username = ?';

        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, 's', $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);

                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password)) {
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION['loggedin'] = true;
                            $_SESSION['id'] = $id;
                            $_SESSION['username'] = $username;
                            $_SESSION['authenticated'] = false;

                            $user_id = $_SESSION['id'];
                            $code = rand(100000, 1000000);
                            $dateTime = new DateTime();
                            $dateTimeFormat = 'Y-m-d H:i:s';
                            $created_at = $dateTime->format($dateTimeFormat);
                            $dateTime->add(new DateInterval('PT5M'));
                            $expiration = $dateTime->format($dateTimeFormat);

                            $sql = "INSERT INTO authentication_code (user_id, code, created_at, expiration) VALUES ('$user_id', '$code', '$created_at', '$expiration')";

                            $stmt1 = $conn->prepare("INSERT INTO activity_log (activity, user_name) VALUES (?, ?)");
                            $stmt1->bind_param("ss", $activity, $username);
                           
                             
                            // // set parameters and execute
                            $activity = "Logged In";
                            $username = $username;
                            
                            $stmt1->execute();
                            $stmt1->close();

                            if ($conn->query($sql) === true) {
                                // Redirect user to enter authentication code page
                                header('location: enter_authentication_code.php');
                            }
                        } else {
                            // Display an error message if password is not valid
                            $password_err = 'Incorrect Password.';
                        }
                    }
                } else {
                    // Display an error message if username doesn't exist
                    $username_err = 'User does not exist.';
                }
            } else {
                header('location: error.php');
                exit;
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
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
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>

    <!-- Sign in -->
    <div>
        <div style="width: 500px;padding-top:50px;">
            <div>
                <!-- Card title -->
               
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                     <center><h2>SIGN IN</h2></center><Br>
                    <!-- Username -->
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" class="form-control <?php if (!empty($username_err)) {echo 'is-invalid';} ?> mt-3" value="<?php echo $username; ?>" placeholder="Enter Username" style="display: block;border: 2px solid #808080;width: 95%;padding: 10px;margin: 10px auto;border-radius: 5px;height:46px;">
                    <div class="invalid-feedback">
                        <?php echo $username_err; ?>
                    </div><br>
                    <!-- Password -->
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control <?php if (!empty($password_err)) {echo 'is-invalid';} ?> mt-3" placeholder="Enter Password" style="display: block;border: 2px solid #808080;width: 95%;padding: 10px;margin: 10px auto;border-radius: 5px;height:46px;">
                    <div class="invalid-feedback">
                        <?php echo $password_err; ?>
                    </div>
                    
                    <!-- Sign in button -->
                    <div class="mt-3"><br>
                        <button type="submit" style="height:45px;">Sign In</button><br><br>
                        <a href="forgot_password.php"  class="ca" style="font-size: 15px;">Forgot Password?</a><br>
                    </div><br>
                    <a href="register.php" class="ca" style="font-size: 15px;">Create Account</a></p><br>
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