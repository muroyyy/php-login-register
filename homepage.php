<?php
require 'config.php';
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Homepage</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Welcome, <?= htmlspecialchars($_SESSION['user']) ?>!</h2>
    <form method="post" action="logout.php">
        <button type="submit" name="logout">Sign Out</button>
    </form>
</body>
</html>
