<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'hospital_management');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $full_name = $_POST['full_name'];
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';

    // Insert into `users` table
    $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $password, $role);

    if ($stmt->execute()) {
        $user_id = $stmt->insert_id;

        if ($role == 'doctor') {
            $specialization = $_POST['specialization'] ?? '';
            $stmt_doctor = $conn->prepare("INSERT INTO doctors (user_id, full_name, specialization, phone) VALUES (?, ?, ?, ?)");
            $stmt_doctor->bind_param("isss", $user_id, $full_name, $specialization, $phone);
            $stmt_doctor->execute();
        } elseif ($role == 'patient') {
            $age = isset($_POST['age']) ? $_POST['age'] : 0;
            $address = isset($_POST['address']) ? $_POST['address'] : '';
            $stmt_patient = $conn->prepare("INSERT INTO patients (user_id, full_name, age, address, phone) VALUES (?, ?, ?, ?, ?)");
            $stmt_patient->bind_param("isiss", $user_id, $full_name, $age, $address, $phone);
            $stmt_patient->execute();
        }

        // Redirect to the login page after successful signup
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
