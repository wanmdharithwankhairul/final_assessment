
<?php
session_start();

if (isset($_SESSION['admin_logged_in']) &&
    $_SESSION['admin_logged_in'] === true) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_regenerate_id(true);
    $_SESSION['admin_logged_in'] = true;

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
</head>
<body>

<h1>Student Grading System</h1>
<h2>Admin Login</h2>

<form method="post">
    <button type="submit">Login as Admin</button>
</form>

</body>
</html>
