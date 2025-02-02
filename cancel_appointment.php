<?php
// cancel_appointment.php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}
require_once 'db_connect.php';

$user_id        = $_SESSION['user_id'];
$appointment_id = isset($_GET['appointment_id']) ? intval($_GET['appointment_id']) : 0;
$msg            = "Invalid appointment ID.";

if ($appointment_id > 0) {
  // Check if it belongs to this user
  $checkSql = "SELECT appointment_id FROM appointments
               WHERE appointment_id = $appointment_id
                 AND user_id = $user_id
                 AND status = 'active'
               LIMIT 1";
  $checkResult = $conn->query($checkSql);

  if ($checkResult && $checkResult->num_rows === 1) {
    // Cancel it
    $updateSql = "UPDATE appointments
                  SET status='canceled'
                  WHERE appointment_id = $appointment_id";
    if ($conn->query($updateSql) === TRUE) {
      $msg = "Appointment #$appointment_id has been canceled.";
    } else {
      $msg = "Error canceling appointment: " . $conn->error;
    }
  } else {
    $msg = "Appointment not found or already canceled.";
  }
}

$conn->close();
header("Location: cancel.php?msg=" . urlencode($msg));
exit();
