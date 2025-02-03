<?php
// index.php (Home)
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Home - Appointment System</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="header">
  <h1>Appointment System</h1>
</div>

<div class="nav">
  <a href="index.php" class="active">Home</a>
  <a href="doctor_list.php">Doctors</a>
  <a href="cancel.php">ppointments</a>
  <a href="canceled_appointments.php">Canceled Appointments</a>
  <a href="logout.php">Logout</a>
</div>

<div class="container">
  <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
  <p>
    You’re now logged in. This appointment system allows you to:
  </p>
  <ul style="line-height:1.8;">
    <li><strong>View Doctors</strong> (search by specialty) and their available slots.</li>
    <li><strong>Book Appointments</strong> as needed.</li>
    <li><strong>Cancel Appointments</strong> for any upcoming bookings.</li>
    <li><strong>View Canceled Appointments</strong> to keep track of your canceled bookings.</li>
  </ul>
  <p style="margin-top:10px;">
    Use the navigation menu above to manage your appointments. 
    Thank you for choosing our service!
  </p>
</div>

<div class="footer">
  <p>&copy; <?php echo date("Y"); ?> Appointment System - KSA Demo</p>
</div>

</body>
</html>
