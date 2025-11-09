<?php
$conn = mysqli_connect('localhost', 'root', '', 'company');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['delete'])) {
    $emp_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM employees WHERE emp_id='$emp_id'");
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
$row = null;
if (isset($_GET['update'])) {
    $emp_id = $_GET['update'];
    $res = mysqli_query($conn, "SELECT * FROM employees WHERE emp_id='$emp_id'");
    if ($res && mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
    }
}
if (isset($_POST['update_submit'])) {
    $emp_id = $_POST['emp_id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $role = $_POST['role'];

    mysqli_query($conn, "UPDATE employees SET firstname='$firstname', lastname='$lastname', role='$role' WHERE emp_id='$emp_id'");
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Employee List</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f2f2f2; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #ddd; }
        form { background: #fff; padding: 15px; border: 1px solid #ccc; max-width: 400px; border-radius: 8px; }
        input, select { width: 100%; padding: 6px; margin-bottom: 10px; border-radius: 4px; border: 1px solid #ccc; }
        input[type="submit"] { background-color: #1976d2; color: #fff; border: none; cursor: pointer; }
        input[type="submit"]:hover { background-color: #115293; }
        a { text-decoration: none; color: blue; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>

<h2>Employee List</h2>

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
    while ($r = mysqli_fetch_assoc($sql)) {
        echo "<tr>
            <td>{$r['emp_id']}</td>
            <td>{$r['firstname']}</td>
            <td>{$r['lastname']}</td>
            <td>{$r['role']}</td>
            <td><a href='?delete={$r['emp_id']}' onclick=\"return confirm('Are you sure to delete this employee?')\">Delete</a></td>
            <td><a href='?update={$r['emp_id']}'>Update</a></td>
        </tr>";
    }
    ?>
</table>

<?php if ($row) { ?>
<h2>Update Employee</h2>
<form method="post">
    <input type="hidden" name="emp_id" value="<?php echo $row['emp_id']; ?>">

    <label>First name:</label>
    <input type="text" name="firstname" value="<?php echo htmlspecialchars($row['firstname']); ?>" required>

    <label>Last name:</label>
    <input type="text" name="lastname" value="<?php echo htmlspecialchars($row['lastname']); ?>" required>

    <label>Role:</label>
    <select name="role" required>
        <option value="">-- select role --</option>
        <option value="Admin" <?php if($row['role']=='Admin') echo 'selected'; ?>>Admin</option>
        <option value="Developer" <?php if($row['role']=='Developer') echo 'selected'; ?>>Developer</option>
        <option value="Designer" <?php if($row['role']=='Designer') echo 'selected'; ?>>Designer</option>
        <option value="HR" <?php if($row['role']=='HR') echo 'selected'; ?>>HR</option>
        <option value="Lecture" <?php if($row['role']=='Lecture') echo 'selected'; ?>>Lecture</option>
    </select>

    <input type="submit" name="update_submit" value="Update Employee">
</form>
<?php } ?>

</body>
</html>