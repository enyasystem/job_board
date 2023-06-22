<?php
// Start the session
session_start();
error_reporting(E_ERROR);


// Check if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page
    header("Location: login.php");
    exit();
}

// Include the database connection file
require_once 'db_connect.php';

// Fetch the user's details from the database
$userId = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

// Check if the user exists
if (!$row) {
    // Redirect to the login page
    header("Location: login.php");
    exit();
}

// Handle form submission for updating user information
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the updated information from the form
    $updatedUsername = $_POST['username'];
    $updatedEmail = $_POST['email'];

    // Validate and sanitize the inputs (You can add more validation if needed)
    $updatedUsername = filter_var($updatedUsername, FILTER_SANITIZE_STRING);
    $updatedEmail = filter_var($updatedEmail, FILTER_SANITIZE_EMAIL);

    // Update the user's information in the database
    $updateSql = "UPDATE users SET username = ?, email = ? WHERE id = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("ssi", $updatedUsername, $updatedEmail, $userId);

    if ($updateStmt->execute()) {
        // Update successful, refresh the page to display the updated information
        header("Location: profile.php");
        exit();
    } else {
        // Update failed
        $errorMessage = "Failed to update user information.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>User Profile</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Include your custom CSS styles -->
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
<?php
        include('./src/header.php')
    ?>
    <div class="container">
        <h1>User Profile</h1>
        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $row['username']; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>

</html>
