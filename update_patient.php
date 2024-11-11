<?php
include 'db_connect.php';

// Get the patient ID from the URL
$patient_id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Update patient data
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $ward_id = $_POST['ward_id'];

    $sql = "UPDATE patient SET name = '$name', age = $age, gender = '$gender', ward_id = $ward_id WHERE patient_id = $patient_id";

    if ($conn->query($sql) === TRUE) {
        echo "Patient updated successfully!";
        header("Location: manage_patient.php"); // Redirect back to the manage patients page
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
} else {
    // Retrieve patient data for the form
    $result = $conn->query("SELECT * FROM patient WHERE patient_id = $patient_id");
    $patient = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Patient</title>
</head>
<body>
    <h1>Update Patient Details</h1>
    <form action="" method="POST">
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo $patient['name']; ?>" required>
        <br>
        <label for="age">Age:</label>
        <input type="number" name="age" value="<?php echo $patient['age']; ?>" required>
        <br>
        <label for="gender">Gender:</label>
        <select name="gender">
            <option value="M" <?php echo ($patient['gender'] === 'M') ? 'selected' : ''; ?>>Male</option>
            <option value="F" <?php echo ($patient['gender'] === 'F') ? 'selected' : ''; ?>>Female</option>
        </select>
        <br>
        <label for="ward_id">Ward ID:</label>
        <input type="number" name="ward_id" value="<?php echo $patient['ward_id']; ?>">
        <br>
        <button type="submit">Update Patient</button>
    </form>
</body>
</html>
