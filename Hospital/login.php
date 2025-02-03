<?php
// login.php
session_start();
require_once 'db_connect.php';

// If user is already logged in, go to Home
if (isset($_SESSION['user_id'])) {
  header("Location: index.php");
  exit();
}

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = trim($_POST['username']);
  $password = trim($_POST['password']);

  if ($username === "" || $password === "") {
    $message = "Please enter both username and password.";
  } else {
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
    $result = $conn->query($sql);

    if ($result && $result->num_rows === 1) {
      $row = $result->fetch_assoc();
      // Set session
      $_SESSION['user_id'] = $row['id'];
      $_SESSION['username'] = $row['username'];

      header("Location: index.php");
      exit();
    } else {
      $message = "Invalid username or password.";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login - Appointment System</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="flex-center">
  <div class="card">
    <h2>Login</h2>

    <?php if ($message): ?>
      <div class="message error"><?php echo $message; ?></div>
    <?php endif; ?>

    <form action="" method="POST">
      <label for="username">Username</label>
      <input type="text" id="username" name="username" required>

      <label for="password">Password  </label>
      <input type="password" id="password" name="password" maxlength="4" required>

      <button type="submit">Sign In</button>
    </form>

    <div class="alt-link">
      <p>Don’t have an account? <a href="register.php">Register here</a>.</p>
      <p><a href="password_reset_dynamic.php">Forgot Password?</a></p>

    </div>
  </div>
</div>

</body>
</html>
