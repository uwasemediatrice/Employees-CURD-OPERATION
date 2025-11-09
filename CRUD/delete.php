<?php
// Connect to MySQL
$conn = mysqli_connect('localhost', 'root', '', 'company');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle Delete
if (isset($_GET['delete'])) {
    $emp_id = $_GET['delete'];
    $delete = mysqli_query($conn, "DELETE FROM employees WHERE emp_id='$emp_id'");

    if ($delete) {
        header("Location: REPORT.php?msg=Employee+deleted+successfully");
    } else {
        header("Location: REPORT.php?msg=Error+deleting+employee");
    }
    exit;
}
?>
