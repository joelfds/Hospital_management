<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <script>
        function toggleFields() {
            const role = document.getElementById("role").value;
            document.getElementById("doctorFields").style.display = role === "doctor" ? "block" : "none";
            document.getElementById("patientFields").style.display = role === "patient" ? "block" : "none";
        }
    </script>
</head>
<body>
    <h2>Sign Up</h2>
    <form action="register.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <label for="full_name">Full Name:</label>
        <input type="text" id="full_name" name="full_name" required><br><br>

        <label for="phone">Phone:</label>
        <input type="text" name="phone" required><br><br>

        <label for="role">Role:</label>
        <select id="role" name="role" required onchange="toggleFields()">
            <option value="admin">Admin</option>
            <option value="doctor">Doctor</option>
            <option value="patient">Patient</option>
        </select><br><br>

        <!-- Doctor-specific fields -->
        <div id="doctorFields" style="display:none;">
            <label for="specialization">Specialization:</label>
            <input type="text" id="specialization" name="specialization"><br><br>
        </div>

        <!-- Patient-specific fields -->
        <div id="patientFields" style="display:none;">
            <label for="date_of_birth">Date of Birth:</label>
            <input type="date" id="date_of_birth" name="date_of_birth"><br><br>
        </div>

        <button type="submit">Sign Up</button>
    </form>

    <p>Already have an account? <a href="login.php">Login here</a>.</p>
</body>
</html>
