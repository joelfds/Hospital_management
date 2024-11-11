<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $ward_number = $_POST['ward_number'];
    $ward_type = $_POST['ward_type'];

    // SQL query to insert a new ward
    $sql = "INSERT INTO ward (ward_number, ward_type) VALUES ('$ward_number', '$ward_type')";

    if ($conn->query($sql) === TRUE) {
        echo "New ward added successfully!";
        header("Location: manage_ward.php"); // Redirect back to manage wards page
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Ward</title>
</head>
<body>
    <h1>Add New Ward</h1>

    <form action="add_ward.php" method="POST">
        <label for="ward_number">Ward Number:</label>
        <input type="text" name="ward_number" required>
        <br>
        <label for="ward_type">Ward Type:</label>
        <input type="text" name="ward_type" required>
        <br>
        <button type="submit">Add Ward</button>
    </form>
</body>
</html>
