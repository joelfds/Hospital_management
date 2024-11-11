<?php
session_start();

// Debug: Check if form data is received
var_dump($_POST);


// Check if the user is logged in and is a patient
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'patient') {
    header("Location: login.php");
    exit();
}

$conn = new mysqli('localhost', 'root', '', 'hospital_management');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user ID and form data
$patient_id = $_SESSION['user_id'];
$doctor_id = $_POST['doctor_id'];
$appointment_date = $_POST['appointment_date'];
$appointment_time = $_POST['appointment_time'];

// Check if patient ID exists in the `patients` table before proceeding
$patient_check_sql = "SELECT id FROM patients WHERE id = ?";
$patient_stmt = $conn->prepare($patient_check_sql);
$patient_stmt->bind_param("i", $patient_id);
$patient_stmt->execute();
$patient_check_result = $patient_stmt->get_result();

if ($patient_check_result->num_rows > 0) {
    // Insert the new appointment if the patient exists
    $stmt = $conn->prepare("INSERT INTO appointments (doctor_id, patient_id, appointment_date, appointment_time) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiss", $doctor_id, $patient_id, $appointment_date, $appointment_time);
    
    if ($stmt->execute()) {
        echo "Appointment scheduled successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "Error: Patient ID does not exist.";
}

$patient_stmt->close();
$conn->close();

// Redirect back to the patient dashboard
//header("Location: patient_dashboard.php");
//exit();
?>
