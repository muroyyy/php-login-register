<?php
require 'config.php';

if (isset($_POST['login'])) {
    $email    = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user['username'];
        header("Location: homepage.php");
        exit;
    } else {
        $error = "Invalid email or password.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container mt-5">
        <div class="form-box">
            <h2 class="text-center">Login</h2>
            <form method="post">
                <input type="email" name="email" placeholder="Email" required><br>
                <input type="password" name="password" placeholder="Password" required><br>
                <button type="submit" name="login" class="btn btn-success">Login</button>
                <p class="mt-3 text-center">Don't have an account? <a href="register.php">Register</a></p>
                <?php if (isset($error)) echo "<p class='error text-danger'>$error</p>"; ?>
            </form>
        </div>
    </div>
</body>
</html>
