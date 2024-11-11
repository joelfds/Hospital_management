<?php
include 'db_connect.php';

// Get the patient ID from the URL
$patient_id = $_GET['id'];

// SQL query to delete the patient
$sql = "DELETE FROM patient WHERE patient_id = $patient_id";

if ($conn->query($sql) === TRUE) {
    echo "Patient deleted successfully!";
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();

// Redirect back to the manage patients page
header("Location: manage_patient.php");
?>
