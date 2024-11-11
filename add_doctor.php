<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $specialization = $_POST['specialization'];
    $ward_id = $_POST['ward_id'];

    // SQL query to insert a new doctor
    $sql = "INSERT INTO doctor (name, specialization, ward_id) VALUES ('$name', '$specialization', $ward_id)";

    if ($conn->query($sql) === TRUE) {
        echo "New doctor added successfully!";
        header("Location: manage_doctor.php"); // Redirect back to manage doctors page
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
    <title>Add New Doctor</title>
</head>
<body>
    <h1>Add New Doctor</h1>

    <form action="add_doctor.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" name="name" required>
        <br>
        <label for="specialization">Specialization:</label>
        <input type="text" name="specialization" required>
        <br>
        <label for="ward_id">Ward:</label>
        <select name="ward_id" required>
            <?php
            $ward_result = $conn->query("SELECT ward_id, ward_number FROM ward");
            while ($ward = $ward_result->fetch_assoc()) {
                echo "<option value='{$ward['ward_id']}'>{$ward['ward_number']}</option>";
            }
            ?>
        </select>
        <br>
        <button type="submit">Add Doctor</button>
    </form>
</body>
</html>
