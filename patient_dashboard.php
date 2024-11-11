<?php
session_start();

// Check if the user is logged in and is a patient
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'patient') {
    header("Location: login.php");
    exit();
}

// Get the patient's user ID
$patient_id = $_SESSION['user_id'];
$conn = new mysqli('localhost', 'root', '', 'hospital_management');

// Fetch the patient's appointments
$sql = "SELECT appointments.appointment_date, appointments.appointment_time, doctors.full_name AS doctor_name 
        FROM appointments 
        JOIN doctors ON appointments.doctor_id = doctors.id 
        WHERE appointments.patient_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $patient_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Patient Dashboard</title>
</head>
<body>
    <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
    <h3>Your Appointments</h3>
    <ul>
        <?php while ($appointment = $result->fetch_assoc()): ?>
            <li>
                Doctor: <?php echo $appointment['doctor_name']; ?><br>
                Date: <?php echo $appointment['appointment_date']; ?><br>
                Time: <?php echo $appointment['appointment_time']; ?><br><br>
            </li>
        <?php endwhile; ?>
    </ul>
    
    <!-- Link to schedule a new appointment -->
    <h3>Schedule a New Appointment</h3>
    <form action="schedule_appointment.php" method="POST">
        <label for="doctor">Choose a Doctor:</label>
        <select name="doctor_id" id="doctor">
            <?php
            // Fetch all doctors for the dropdown
            $doctor_sql = "SELECT id, full_name FROM doctors";
            $doctor_result = $conn->query($doctor_sql);
            while ($doctor = $doctor_result->fetch_assoc()):
            ?>
                <option value="<?php echo $doctor['id']; ?>">
                    <?php echo $doctor['full_name']; ?>
                </option>
            <?php endwhile; ?>
        </select><br><br>
        
        <label for="date">Appointment Date:</label>
        <input type="date" name="appointment_date" id="date" required><br><br>
        
        <label for="time">Appointment Time:</label>
        <input type="time" name="appointment_time" id="time" required><br><br>
        
        <input type="submit" value="Schedule Appointment">
    </form>

    <a href="logout.php">Logout</a>
</body>
</html>
