<?php
// canceled_appointments.php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}
require_once 'db_connect.php';

$user_id = $_SESSION['user_id'];

// Fetch all canceled appointments
$sql = "SELECT a.appointment_id, a.time_slot, d.name AS doctor_name, d.specialty
        FROM appointments a
        JOIN doctors d ON a.doctor_id = d.doctor_id
        WHERE a.user_id = $user_id
          AND a.status = 'canceled'
        ORDER BY a.time_slot DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Canceled Appointments - Appointment System</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="header">
  <h1>Canceled Appointments</h1>
</div>

<div class="nav">
  <a href="index.php">Home</a>
  <a href="doctor_list.php">Doctors</a>
  <a href="cancel.php">Appointments</a>
  <a href="canceled_appointments.php" class="active">Canceled Appointments</a>
  <a href="logout.php">Logout</a>
</div>

<div class="container">
  <h2>Your Canceled Appointments</h2>
  
  <?php if ($result && $result->num_rows > 0): ?>
    <table>
      <tr>
        <th>ID</th>
        <th>Doctor</th>
        <th>Specialty</th>
        <th>Time Slot</th>
      </tr>
      <?php while ($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?php echo $row['appointment_id']; ?></td>
        <td><?php echo htmlentities($row['doctor_name']); ?></td>
        <td><?php echo htmlentities($row['specialty']); ?></td>
        <td><?php echo $row['time_slot']; ?></td>
      </tr>
      <?php endwhile; ?>
    </table>
  <?php else: ?>
    <p>You have no canceled appointments.</p>
  <?php endif; ?>
</div>

<div class="footer">
  <p>&copy; <?php echo date("Y"); ?> Appointment System - KSA Demo</p>
</div>

</body>
</html>
