<?php
// Connect to MySQL
$conn = mysqli_connect('localhost', 'root', '', 'company');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle form submission
if (isset($_POST['Register'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $role = $_POST['role'];

// Simple query method
    $sql = "INSERT INTO employees (firstname, lastname, role) 
            VALUES ('$firstname', '$lastname', '$role')";

    $query = mysqli_query($conn, $sql);

    if ($query) {
        echo "<p style='color:green;'>Employee added successfully.</p>";
    } else {
        echo "<p style='color:red;'>Insert failed: " . mysqli_error($conn) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Insert Employee</title>
<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
    padding: 20px;
}

h2 {
    color: #333;
}

form {
    background-color: #fff;
    padding: 20px;
    max-width: 400px;
    border-radius: 8px;
    box-shadow: 0 0 8px rgba(0,0,0,0.1);
}

label {
    font-weight: bold;
}

input[type="text"], select {
    width: 100%;
    padding: 8px;
    margin-top: 4px;
    margin-bottom: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

input[type="submit"] {
    background-color: #1976d2;
    color: white;
    padding: 10px 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #115293;
}
</style>
</head>
<body>

<h2>Add New Employee</h2>

<form action="" method="post">
    <label for="firstname">First name:</label>
    <input type="text" id="firstname" name="firstname" required>

    <label for="lastname">Last name:</label>
    <input type="text" id="lastname" name="lastname" required>

    <label for="role">Role / Position:</label>
    <select id="role" name="role" required>
        <option value="">-- select role --</option>
        <option value="Admin">Admin</option>
        <option value="Developer">Developer</option>
        <option value="Designer">Designer</option>
        <option value="HR">HR</option>
        <option value="leacture">Leacture</option>
    </select>

    <input type="submit" name="Register" value="Save Employee">
</form>

</body>
</html>
