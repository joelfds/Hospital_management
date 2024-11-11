<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'doctor') {
    header("Location: login.php");
    exit();
}

$doctor_id = $_SESSION['user_id'];
$conn = new mysqli('localhost', 'root', '', 'hospital_management');

// Fetch appointments for this doctor
$sql = "SELECT appointments.appointment_date, appointments.appointment_time, patients.full_name AS patient_name 
        FROM appointments 
        JOIN patients ON appointments.patient_id = patients.id 
        WHERE appointments.doctor_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $doctor_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Doctor Dashboard</title>
</head>
<body>
    <h2>Your Appointments</h2>
    <ul>
        <?php while ($appointment = $result->fetch_assoc()): ?>
            <li>
                Patient: <?= $appointment['patient_name']; ?><br>
                Date: <?= $appointment['appointment_date']; ?><br>
                Time: <?= $appointment['appointment_time']; ?><br><br>
            </li>
        <?php endwhile; ?>
    </ul>
</body>
</html>
