<?php
include 'db_connect.php';

// Get the doctor ID from the URL
$doctor_id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve updated form data
    $name = $_POST['name'];
    $specialization = $_POST['specialization'];
    $ward_id = $_POST['ward_id'];

    // SQL query to update the doctor
    $sql = "UPDATE doctor SET name = '$name', specialization = '$specialization', ward_id = $ward_id WHERE doctor_id = $doctor_id";

    if ($conn->query($sql) === TRUE) {
        echo "Doctor updated successfully!";
        header("Location: manage_doctor.php"); // Redirect back to manage doctors page
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
} else {
    // Retrieve doctor data for the form
    $result = $conn->query("SELECT * FROM doctor WHERE doctor_id = $doctor_id");
    $doctor = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Doctor</title>
</head>
<body>
    <h1>Update Doctor Details</h1>

    <form action="" method="POST">
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo $doctor['name']; ?>" required>
        <br>
        <label for="specialization">Specialization:</label>
        <input type="text" name="specialization" value="<?php echo $doctor['specialization']; ?>" required>
        <br>
        <label for="ward_id">Ward:</label>
        <select name="ward_id" required>
            <?php
            $ward_result = $conn->query("SELECT ward_id, ward_number FROM ward");
            while ($ward = $ward_result->fetch_assoc()) {
                // Select the current ward
                $selected = ($ward['ward_id'] == $doctor['ward_id']) ? 'selected' : '';
                echo "<option value='{$ward['ward_id']}' $selected>{$ward['ward_number']}</option>";
            }
            ?>
        </select>
        <br>
        <button type="submit">Update Doctor</button>
    </form>
</body>
</html>
