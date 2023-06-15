<?php
// create_job.php
include 'src/db_connect.php';

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    // ... add more fields as needed

    // Insert the job listing into the database
    $sql = "INSERT INTO job_listings (title, description, location) VALUES ('$title', '$description', '$location')";
    if (mysqli_query($conn, $sql)) {
        // Successful insertion
        echo "Job listing created successfully";
    } else {
        // Error
        echo "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
