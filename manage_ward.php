<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Wards - Hospital Management System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Manage Wards</h1>

    <!-- Button to Redirect to Add New Ward Page -->
    <button onclick="window.location.href='add_ward.php'">Add New Ward</button>


    <!-- Button to Redirect to Home Page -->
    <button onclick="window.location.href='index.php'">Home Page</button>

    
    <h2>Ward List</h2>
    <table border="1">
        <tr>
            <th>Ward No.</th>
            <th>Ward Number</th>
            <th>Ward Type</th>
            <th>Actions</th>
        </tr>
        <?php
        include 'db_connect.php';

        // SQL query to fetch ward details
        $sql = "SELECT ward_id, ward_number, ward_type FROM ward";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['ward_id']}</td>
                        <td>{$row['ward_number']}</td>
                        <td>{$row['ward_type']}</td>
                        <td>
                            <a href='update_ward.php?id={$row['ward_id']}'>Update</a> |
                            <a href='delete_ward.php?id={$row['ward_id']}' onclick='return confirm(\"Are you sure you want to delete this ward?\");'>Delete</a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No wards found.</td></tr>";
        }

        $conn->close();
        ?>
    </table>
</body>
</html>
