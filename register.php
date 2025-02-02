<?php
// register.php
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
  $password = trim($_POST['password']); // plain text 4 digits
  $email    = trim($_POST['email']);

  if ($username === "" || $password === "" || $email === "") {
    $message = "Please fill in all fields.";
  } else {
    // Check if username or email already exists
    $checkQuery = "SELECT id FROM users WHERE username='$username' OR email='$email' LIMIT 1";
    $checkResult = $conn->query($checkQuery);
    if ($checkResult && $checkResult->num_rows > 0) {
      $message = "Username or email is already taken.";
    } else {
      // Insert user
      $sql = "INSERT INTO users (username, password, email)
              VALUES ('$username', '$password', '$email')";
      if ($conn->query($sql) === TRUE) {
        // Optionally create default notification preferences
        $newUserId = $conn->insert_id;
        $conn->query("INSERT INTO notification_preferences (user_id, email_notifications)
                      VALUES ($newUserId, 1)");

        // Auto login
        $_SESSION['user_id'] = $newUserId;
        $_SESSION['username'] = $username;

        header("Location: index.php");
        exit();
      } else {
        $message = "Error: " . $conn->error;
      }
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register - Appointment System</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="flex-center">
  <div class="card">
    <h2>Create Account</h2>

    <?php if ($message): ?>
      <div class="message error"><?php echo $message; ?></div>
    <?php endif; ?>

    <form action="" method="POST">
      <label for="username">Username</label>
      <input type="text" id="username" name="username" maxlength="50" required>

      <label for="password">Password  </label>
      <input type="password" id="password" name="password" maxlength="4" required>

      <label for="email">Email</label>
      <input type="email" id="email" name="email" maxlength="100" required>

      <button type="submit">Register</button>
    </form>

    <div class="alt-link">
      <p>Have an account? <a href="login.php">Login here</a>.</p>
    </div>
  </div>
</div>

</body>
</html>
