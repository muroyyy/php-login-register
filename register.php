<?php
require 'config.php';

$success = false;

if (isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $email    = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $stmt->execute([$username, $email]);
    if ($stmt->fetch()) {
        $error = "Username or email already exists.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$username, $email, $password]);
        $success = true;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="style.css">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Register</h2>
        <form method="post">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit" name="register" class="btn btn-success">Register</button>
            <p class="mt-3">Already have an account? <a href="login.php">Login</a></p>
            <?php if (isset($error)) echo "<p class='error text-danger'>$error</p>"; ?>
        </form>
    </div>

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center">
          <div class="modal-header">
            <h5 class="modal-title" id="successModalLabel">Registration Successful</h5>
          </div>
          <div class="modal-body">
            You have registered successfully. Click below to login.
          </div>
          <div class="modal-footer justify-content-center">
            <a href="login.php" class="btn btn-primary">Go to Login</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <?php if ($success): ?>
    <script>
        const successModal = new bootstrap.Modal(document.getElementById('successModal'));
        successModal.show();
    </script>
    <?php endif; ?>
</body>
</html>
