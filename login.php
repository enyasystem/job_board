<?php
// Check if the user is already logged in, redirect to home page if true
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// Include the login functions and database connection
require_once 'src/functions.php';
require_once 'db_connect.php';

// Handle the login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if email and password are provided
    if (isset($_POST['email']) && isset($_POST['password'])) {
        // Sanitize user input
        $email = sanitizeInput($_POST['email']);
        $password = sanitizeInput($_POST['password']);

        // Authenticate the user
        if (authenticateUser($email, $password)) {
            // Login successful, redirect to home page
            header("Location: index.php");
            exit();
        } else {
            // Login failed, display error message
            $loginError = "Invalid email or password.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        .container {
            max-width: 400px;
            margin: 100px auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <?php if (isset($loginError)) : ?>
            <div class="alert alert-danger"><?php echo $loginError; ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="form-group">
                <label>Email:</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</body>
</html>
