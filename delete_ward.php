<?php
include 'db_connect.php';

// Get the ward ID from the URL
$ward_id = $_GET['id'];

// SQL query to delete the ward
$sql = "DELETE FROM ward WHERE ward_id = $ward_id";

if ($conn->query($sql) === TRUE) {
    echo "Ward deleted successfully!";
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();

// Redirect back to the manage wards page
header("Location: manage_ward.php");
?>
