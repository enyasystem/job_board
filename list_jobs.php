<?php
// list_jobs.php
include 'db_connect.php';

// Retrieve job listings from the database
$sql = "SELECT * FROM job_listings";
$result = mysqli_query($conn, $sql);

$jobListings = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $jobListings[] = $row;
    }
}

mysqli_close($conn);

// Return job listings as JSON response
header('Content-Type: application/json');
echo json_encode($jobListings);
?>
