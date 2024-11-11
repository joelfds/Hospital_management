<?php
include 'db_connect.php';

// Get the ward ID from the URL
$ward_id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve updated form data
    $ward_number = $_POST['ward_number'];
    $ward_type = $_POST['ward_type'];

    // SQL query to update the ward
    $sql = "UPDATE ward SET ward_number = '$ward_number', ward_type = '$ward_type' WHERE ward_id = $ward_id";

    if ($conn->query($sql) === TRUE) {
        echo "Ward updated successfully!";
        header("Location: manage_ward.php"); // Redirect back to manage wards page
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
} else {
    // Retrieve ward data for the form
    $result = $conn->query("SELECT * FROM ward WHERE ward_id = $ward_id");
    $ward = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Ward</title>
</head>
<body>
    <h1>Update Ward Details</h1>

    <form action="" method="POST">
        <label for="ward_number">Ward Number:</label>
        <input type="text" name="ward_number" value="<?php echo $ward['ward_number']; ?>" required>
        <br>
        <label for="ward_type">Ward Type:</label>
        <input type="text" name="ward_type" value="<?php echo $ward['ward_type']; ?>" required>
        <br>
        <button type="submit">Update Ward</button>
    </form>
</body>
</html>
