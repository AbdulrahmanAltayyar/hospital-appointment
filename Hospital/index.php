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
  <title>Home - Hospital Appointment System</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <style>
    /* Reset */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      line-height: 1.6;
      color: #333;
    }

    /* Header */
    .header {
      background-color: #2ecc71;
      color: #fff;
      padding: 20px 0;
      text-align: center;
    }

    .header h1 {
      font-size: 2.5em;
    }

    /* Navigation */
    .nav {
      background-color: #27ae60;
      overflow: hidden;
    }

    .nav a {
      display: inline-block;
      color: #fff;
      text-align: center;
      padding: 14px 20px;
      text-decoration: none;
      font-weight: bold;
    }

    .nav a:hover {
      background-color: #219150;
    }

    .nav a.active {
      background-color: #1e8e53;
    }

    /* Container */
    .container {
      max-width: 1000px;
      margin: 20px auto;
      padding: 20px;
      background: #fff;
      border-radius: 5px;
    }

    /* Welcome Section */
    .welcome {
      text-align: center;
      margin-bottom: 20px;
    }

    .welcome h2 {
      font-size: 2em;
      color: #333;
      margin-bottom: 10px;
    }

    .welcome p {
      font-size: 1.1em;
      margin-top: 10px;
    }

    /* Feature Cards */
    .feature-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
    }

    .card {
      background: #e9f7ef;
      border: 1px solid #ccc;
      border-radius: 5px;
      width: 30%;
      margin-bottom: 20px;
      box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.1);
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .card .card-body {
      padding: 15px;
    }

    .card .card-title {
      font-size: 1.5em;
      color: #2ecc71;
      margin-bottom: 10px;
    }

    .card .card-text {
      font-size: 1em;
      color: #333;
    }

    .card .card-footer {
      background: #f1f1f1;
      text-align: center;
      padding: 10px;
      border-top: 1px solid #ddd;
    }

    .card .card-footer a {
      text-decoration: none;
      color: #2ecc71;
      font-weight: bold;
    }

    .card .card-footer a:hover {
      text-decoration: underline;
    }

    /* Footer */
    .footer {
      background-color: #2ecc71;
      color: #fff;
      text-align: center;
      padding: 10px 0;
      margin-top: 20px;
    }

    /* Responsive Styles */
    @media (max-width: 768px) {
      .feature-container {
        flex-direction: column;
        align-items: center;
      }
      
      .card {
        width: 90%;
      }
    }
  </style>
  <!-- Optional JavaScript -->
  <script>
    // Example JavaScript: You can add additional interactivity if needed.
    // For instance, a simple mobile menu toggle can be added here.
    function toggleMenu() {
      var nav = document.querySelector('.nav');
      if (nav.style.display === 'block') {
        nav.style.display = 'none';
      } else {
        nav.style.display = 'block';
      }
    }
  </script>
</head>
<body>

  <!-- Header -->
  <div class="header">
    <h1>Hospital Appointment System</h1>
  </div>

  <!-- Navigation -->
  <div class="nav">
    <a href="index.php" class="active">Home</a>
    <a href="doctor_list.php">Doctors</a>
    <a href="cancel.php">Appointments</a>
    <a href="canceled_appointments.php">Canceled</a>
    <a href="logout.php">Logout</a>
  </div>

  <!-- Main Container -->
  <div class="container">
    <!-- Welcome Section -->
    <div class="welcome">
      <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
      <p>You are now logged in. Use the options below or the navigation menu to manage your appointments.</p>
    </div>
    
    <!-- Feature Cards -->
    <div class="feature-container">
      <div class="card">
        <div class="card-body">
          <div class="card-title">View Doctors</div>
          <div class="card-text">Search and view a list of doctors by specialty and available time slots.</div>
        </div>
        <div class="card-footer">
          <a href="doctor_list.php">View Doctors</a>
        </div>
      </div>
      
      <div class="card">
        <div class="card-body">
          <div class="card-title">Book Appointments</div>
          <div class="card-text">Select a doctor and book an appointment that fits your schedule.</div>
        </div>
        <div class="card-footer">
          <a href="book_appointment.php">Book Now</a>
        </div>
      </div>
      
      <div class="card">
        <div class="card-body">
          <div class="card-title">Manage Appointments</div>
          <div class="card-text">View upcoming appointments, cancel bookings, and track your appointment history.</div>
        </div>
        <div class="card-footer">
          <a href="cancel.php">Manage Appointments</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <div class="footer">
    <p>&copy; <?php echo date("Y"); ?> Hospital Appointment System - KSA Demo</p>
  </div>

</body>
</html>
