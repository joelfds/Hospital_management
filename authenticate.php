<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'hospital_management');

$username = $_POST['username'];
$password = $_POST['password'];

// Fetch user from `users` table
$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    // Verify password
    if ($user['password'] == $password) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $user['role'];

        if ($user['role'] == 'doctor') {
            header("Location: doctor_dashboard.php");
        } elseif ($user['role'] == 'patient') {
            header("Location: patient_dashboard.php");
        } elseif ($user['role'] == 'admin') {
            header("Location: admin_dashboard.php");
        }
        exit();
    } else {
        echo "Incorrect password.";
    }
} else {
    echo "User not found.";
}

$_SESSION['user_id'] = $user['id'];  // Assuming $user['id'] is from the patients table
$_SESSION['role'] = $user['role'];

$stmt->close();
$conn->close();
?>
