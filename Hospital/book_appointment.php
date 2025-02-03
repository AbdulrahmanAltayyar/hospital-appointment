<?php
// book_appointment.php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}
require_once 'db_connect.php';

$user_id   = $_SESSION['user_id'];
$message   = "";
$doctor_id = isset($_GET['doctor_id']) ? intval($_GET['doctor_id']) : 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $doctor_id = intval($_POST['doctor_id']);
  // Example: "2025-02-15T10:00" => "2025-02-15 10:00:00"
  $time_slot_input = $_POST['time_slot'];
  $time_slot       = str_replace("T", " ", $time_slot_input) . ":00";

  if ($doctor_id <= 0 || empty($time_slot_input)) {
    $message = "Please select a valid doctor and time slot.";
  } else {
    // Check if slot is already booked
    $checkSql = "SELECT appointment_id FROM appointments
                 WHERE doctor_id=$doctor_id
                   AND time_slot='$time_slot'
                   AND status='active'";
    $checkResult = $conn->query($checkSql);

    if ($checkResult && $checkResult->num_rows > 0) {
      $message = "This time slot is already taken. Please choose another.";
    } else {
      $insertSql = "INSERT INTO appointments (user_id, doctor_id, time_slot, status)
                    VALUES ($user_id, $doctor_id, '$time_slot', 'active')";
      if ($conn->query($insertSql) === TRUE) {
        $message = "Appointment booked successfully!";
      } else {
        $message = "Error booking appointment: " . $conn->error;
      }
    }
  }
} else {
  // If GET, fetch doctor info
  if ($doctor_id) {
    $docSql = "SELECT name, specialty FROM doctors WHERE doctor_id=$doctor_id";
    $docResult = $conn->query($docSql);
    if ($docResult && $docResult->num_rows === 1) {
      $docRow = $docResult->fetch_assoc();
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Book Appointment - Appointment System</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="header">
  <h1>Book an Appointment</h1>
</div>

<div class="nav">
  <a href="index.php">Home</a>
  <a href="doctor_list.php">Doctors</a>
  <a href="cancel.php">Appointments</a>
  <a href="canceled_appointments.php">Canceled Appointments</a>
  <a href="logout.php">Logout</a>
</div>

<div class="container">
  <h2>Appointment Details</h2>
  <?php if ($message): ?>
    <div class="message <?php echo (strpos($message, 'successfully') !== false) ? 'success' : 'error'; ?>">
      <?php echo $message; ?>
    </div>
  <?php endif; ?>

  <form action="" method="POST">
    <input type="hidden" name="doctor_id" value="<?php echo $doctor_id; ?>">

    <?php if (isset($docRow)): ?>
      <p>
        <strong>Doctor:</strong> <?php echo htmlentities($docRow['name']); ?>
        (<?php echo htmlentities($docRow['specialty']); ?>)
      </p>
    <?php else: ?>
      <p style="color:red;">
        No doctor selected.
        <a href="doctor_list.php" style="color:#2ecc71;">Go back</a>
      </p>
    <?php endif; ?>

    <label for="time_slot">Date &amp; Time:</label>
    <input type="datetime-local" id="time_slot" name="time_slot" required>

    <button type="submit">Book Appointment</button>
  </form>
</div>

<div class="footer">
  <p>&copy; <?php echo date("Y"); ?> Appointment System - KSA Demo</p>
</div>

</body>
</html>
