<?php
session_start();
session_destroy();
header("refresh:2;url=login.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Logging Out...</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container home-box">
        <h2>You’ve been signed out.</h2>
        <p>Redirecting to login...</p>
    </div>
</body>
</html>
