<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Patients - Hospital Management System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Manage Patients</h1>

    <!-- Button to Redirect to Add New Patient Page -->
    <button onclick="window.location.href='add_patient.php'">Add New Patient</button>

     <!-- Button to Redirect to Home Page -->
     <button onclick="window.location.href='index.php'">Home Page</button>

    <h2>Patient List</h2>
    <table border="1">
        <tr>
            <th>Patient No.</th>
            <th>Patient Name</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Ward</th>
            <th>Actions</th>
        </tr>
        <?php
        include 'db_connect.php';

        // Fetch all patients with ward information
        $sql = "
            SELECT 
                patient.patient_id AS patient_no,
                patient.name AS patient_name,
                patient.age,
                patient.gender,
                ward.ward_number AS ward
            FROM 
                patient
            LEFT JOIN 
                ward ON patient.ward_id = ward.ward_id
        ";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['patient_no']}</td>
                        <td>{$row['patient_name']}</td>
                        <td>{$row['age']}</td>
                        <td>{$row['gender']}</td>
                        <td>{$row['ward']}</td>
                        <td>
                            <a href='update_patient.php?id={$row['patient_no']}'>Update</a> |
                            <a href='delete_patient.php?id={$row['patient_no']}' onclick='return confirm(\"Are you sure you want to delete this patient?\");'>Delete</a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No patients found.</td></tr>";
        }

        $conn->close();
        ?>
    </table>
</body>
</html>
