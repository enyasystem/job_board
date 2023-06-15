<?php
require_once 'db_connect.php';
require_once 'src/functions.php';

// Define variables and set to empty values
$username = $email = $password = '';
$usernameErr = $emailErr = $passwordErr = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize input values
    $username = sanitizeInput($_POST['username']);
    $email = sanitizeInput($_POST['email']);
    $password = sanitizeInput($_POST['password']);

    // Validate username
    if (empty($username)) {
        $usernameErr = 'Username is required';
    }

    // Validate email
    if (empty($email)) {
        $emailErr = 'Email is required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = 'Invalid email format';
    }

    // Validate password
    if (empty($password)) {
        $passwordErr = 'Password is required';
    } elseif (strlen($password) < 6) {
        $passwordErr = 'Password must be at least 6 characters long';
    }

    // Check if there are no validation errors and user doesn't exist
    if (empty($usernameErr) && empty($emailErr) && empty($passwordErr)) {
        // Check if the email already exists
        if (isEmailExists($email)) {
            $emailErr = 'This email is already registered';
        }
        
        // Check if the username already exists
        if (isUsernameExists($username)) {
            $usernameErr = 'This username is already taken';
        }

        // If neither email nor username exists, proceed with registration
        if (empty($emailErr) && empty($usernameErr)) {
            // Create a new user in the database
            $result = registerUser($username, $email, $password);

            // Check if registration is successful
            if ($result === true) {
                // Redirect the user to the login page
                header('Location: login.php');
                exit;
            } else {
                // Display the appropriate error message
                echo $result;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Job Board - Registration</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <header>
        <?php
        require_once ('src/header.php')
        ?>
    </header>
    <div class="container">
        <h1>User Registration</h1>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" name="username" id="username" value="<?php echo $username; ?>">
                <span class="text-danger"><?php echo $usernameErr; ?></span>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" id="email" value="<?php echo $email; ?>">
                <span class="text-danger"><?php echo $emailErr; ?></span>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" name="password" id="password">
                <span class="text-danger"><?php echo $passwordErr; ?></span>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
</body>
</html>
