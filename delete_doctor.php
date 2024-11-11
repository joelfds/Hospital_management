<?php
include 'db_connect.php';

// Get the doctor ID from the URL
$doctor_id = $_GET['id'];

// SQL query to delete the doctor
$sql = "DELETE FROM doctor WHERE doctor_id = $doctor_id";

if ($conn->query($sql) === TRUE) {
    echo "Doctor deleted successfully!";
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();

// Redirect back to the manage doctors page
header("Location: manage_doctor.php");
?>
