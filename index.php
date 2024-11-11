<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hospital Management System - Admin Panel</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Hospital Management System - Admin Panel</h1>

    <!-- Button to Redirect to Manage Patients Page -->
    <button onclick="window.location.href='manage_patient.php'">Manage Patients</button> 

    <!-- Button to Redirect to Manage Doctor Page -->
    <button onclick="window.location.href='manage_doctor.php'">Manage Doctor</button>


     <!-- Button to Redirect to Manage Doctor Page -->
     <button onclick="window.location.href='manage_ward.php'">Manage ward</button>


    <!-- Display Patients Information -->
    <h2>Patient Information</h2>
    <table border="1">
        <tr>
            <th>Patient No.</th>
            <th>Patient Name</th>
            <th>Ward</th>
            <th>Assigned Doctor</th>
        </tr>
        <?php
        include 'db_connect.php';

        // SQL query to get patient details, ward number, and assigned doctor's name
        $sql = "
            SELECT 
                patient.patient_id AS patient_no,
                patient.name AS patient_name,
                ward.ward_number AS ward,
                doctor.name AS assigned_doctor
            FROM 
                patient
            LEFT JOIN 
                ward ON patient.ward_id = ward.ward_id
            LEFT JOIN 
                doctor ON ward.ward_id = doctor.ward_id
        ";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Fetch and display each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['patient_no']}</td>
                        <td>{$row['patient_name']}</td>
                        <td>{$row['ward']}</td>
                        <td>{$row['assigned_doctor']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No patients found.</td></tr>";
        }

        $conn->close();
        ?>
    </table>
</body>
</html>
