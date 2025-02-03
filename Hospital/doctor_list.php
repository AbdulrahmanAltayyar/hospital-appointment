<?php
// doctor_list.php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

require_once 'db_connect.php';

$searchSpecialty = isset($_GET['specialty']) ? trim($_GET['specialty']) : "";

// Build the query
$sql = "SELECT * FROM doctors";
if ($searchSpecialty !== "") {
  $sql .= " WHERE specialty LIKE '%$searchSpecialty%'";
}

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Doctors - Appointment System</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="header">
  <h1>Doctors</h1>
</div>

<div class="nav">
  <a href="index.php">Home</a>
  <a href="doctor_list.php" class="active">Doctors</a>
  <a href="cancel.php">Appointments</a>
  <a href="canceled_appointments.php">Canceled Appointments</a>
  <a href="logout.php">Logout</a>
</div>

<div class="container">
  <h2>Search by Specialty</h2>
  <form action="" method="GET" style="margin-bottom:20px;">
    <label for="specialty">Specialty:</label>
    <input type="text" id="specialty" name="specialty" 
           placeholder="Enter specialty..." 
           value="<?php echo htmlspecialchars($searchSpecialty); ?>">
    <button type="submit" style="margin-top:0;">Search</button>
  </form>

  <?php if ($searchSpecialty !== ""): ?>
    <p>Showing results for specialty containing: <strong><?php echo htmlspecialchars($searchSpecialty); ?></strong></p>
  <?php endif; ?>

  <?php if ($result && $result->num_rows > 0): ?>
    <table>
      <tr>
        <th>Doctor Name</th>
        <th>Specialty</th>
        <th>Available Slots</th>
        <th>Action</th>
      </tr>
      <?php while ($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?php echo htmlentities($row['name']); ?></td>
        <td><?php echo htmlentities($row['specialty']); ?></td>
        <td><?php echo htmlentities($row['available_slots']); ?></td>
        <td>
          <a href="book_appointment.php?doctor_id=<?php echo $row['doctor_id']; ?>" class="book-btn">
            Book
          </a>
        </td>
      </tr>
      <?php endwhile; ?>
    </table>
  <?php else: ?>
    <p>No doctors found.</p>
  <?php endif; ?>
</div>

<div class="footer">
  <p>&copy; <?php echo date("Y"); ?> Appointment System - KSA Demo</p>
</div>

</body>
</html>
