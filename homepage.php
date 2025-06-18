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

    <!-- Optional: Bootstrap for consistent button style -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container home-box">
        <h2>Welcome, <?= htmlspecialchars($_SESSION['user']) ?>!</h2>
        <form method="post" action="logout.php">
            <button type="submit" name="logout" class="btn btn-success mt-3">Sign Out</button>
        </form>
    </div>
</body>
</html>
