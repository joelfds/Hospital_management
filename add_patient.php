<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $ward_id = $_POST['ward_id'];

    // SQL query to insert a new patient
    $sql = "INSERT INTO patient (name, age, gender, ward_id) VALUES ('$name', $age, '$gender', $ward_id)";

    if ($conn->query($sql) === TRUE) {
        echo "New patient added successfully!";
        header("Location: manage_patient.php"); // Redirect back to manage patients page
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
    <title>Add New Patient</title>
</head>
<body>
    <h1>Add New Patient</h1>

    <form action="add_patient.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" name="name" required>
        <br>
        <label for="age">Age:</label>
        <input type="number" name="age" required>
        <br>
        <label for="gender">Gender:</label>
        <select name="gender">
            <option value="M">Male</option>
            <option value="F">Female</option>
        </select>
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
        <button type="submit">Add Patient</button>
    </form>
</body>
</html>
