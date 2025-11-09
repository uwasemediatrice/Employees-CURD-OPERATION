<?php
// Connect to MySQL
$conn = mysqli_connect('localhost', 'root', '', 'company');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Employee List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f7f7f7;
            padding: 20px;
        }
        h2 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }
        th {
            background: #007bff;
            color: white;
        }
        a {
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 5px;
        }
        a.delete {
            background: #dc3545;
            color: white;
        }
        a.update {
            background: #28a745;
            color: white;
        }
        .msg {
            text-align: center;
            color: white;
            background: #28a745;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            width: 50%;
            margin: 10px auto;
        }
    </style>
</head>
<body>

<h2>Employee List</h2>

<?php
if (isset($_GET['msg'])) {
    echo "<div class='msg'>" . htmlspecialchars($_GET['msg']) . "</div>";
}
?>

<table>
    <tr>
        <th>emp_id</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Role</th>
        <th colspan="2">Commands</th>
    </tr>
    <?php
    $sql = mysqli_query($conn, "SELECT * FROM employees ORDER BY emp_id ASC");
    while ($row = mysqli_fetch_assoc($sql)) {
    ?>
        <tr>
            <td><?php echo $row['emp_id']; ?></td>
            <td><?php echo $row['firstname']; ?></td>
            <td><?php echo $row['lastname']; ?></td>
            <td><?php echo $row['role']; ?></td>
            <td><a href="delete.php?delete=<?php echo $row['emp_id']; ?>" class="delete" onclick="return confirm('Are you sure you want to delete this employee?')">Delete</a></td>
            <td><a href="update.php?update=<?php echo $row['emp_id']; ?>" class="update">Update</a></td>
        </tr>
    <?php
    }
    ?>
</table>

</body>
</html>
