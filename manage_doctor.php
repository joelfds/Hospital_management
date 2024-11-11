<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Doctors - Hospital Management System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Manage Doctors</h1>

    <!-- Button to Redirect to Add New Doctor Page -->
    <button onclick="window.location.href='add_doctor.php'">Add New Doctor</button>

    <!-- Button to Redirect to Home Page -->
    <button onclick="window.location.href='index.php'">Home Page</button>

    
    <h2>Doctor List</h2>
    <table border="1">
        <tr>
            <th>Doctor No.</th>
            <th>Doctor Name</th>
            <th>Specialization</th>
            <th>Ward</th>
            <th>Actions</th>
        </tr>
        <?php
        include 'db_connect.php';

        // SQL query to fetch doctor details along with the ward they are assigned to
        $sql = "
            SELECT 
                doctor.doctor_id AS doctor_no,
                doctor.name AS doctor_name,
                doctor.specialization,
                ward.ward_number AS ward
            FROM 
                doctor
            LEFT JOIN 
                ward ON doctor.ward_id = ward.ward_id
        ";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['doctor_no']}</td>
                        <td>{$row['doctor_name']}</td>
                        <td>{$row['specialization']}</td>
                        <td>{$row['ward']}</td>
                        <td>
                            <a href='update_doctor.php?id={$row['doctor_no']}'>Update</a> |
                            <a href='delete_doctor.php?id={$row['doctor_no']}' onclick='return confirm(\"Are you sure you want to delete this doctor?\");'>Delete</a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No doctors found.</td></tr>";
        }

        $conn->close();
        ?>
    </table>
</body>
</html>
