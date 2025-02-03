<?php
// password_reset_dynamic.php

// Set the timezone (adjust as needed)
date_default_timezone_set('UTC');
include 'db_connect.php';

// Handle AJAX requests using the same file as endpoint
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    // Set header for JSON response
    header('Content-Type: application/json');
    
    // ACTION 1: Send the reset code to the user's email (or display for testing)
    if ($_POST['action'] === 'send_code') {
        // Trim email input to remove extra spaces
        $email = trim($_POST['email']);
        
        // Check if the email exists in the users table
        $query = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $query->bind_param("s", $email);
        $query->execute();
        $result = $query->get_result();
        
        if ($result->num_rows > 0) {
            // Generate a 4-digit random reset code and set an expiration time (1 minute later)
            $reset_code = rand(1000, 9999);
            $expires_at = date("Y-m-d H:i:s", strtotime("+1 minute"));
            
            // Debug: Log the generated values
            error_log("Sending reset code for {$email}: code={$reset_code}, expires_at={$expires_at}");
            
            // Insert or update the reset code in the password_reset table
            $insert = $conn->prepare(
                "INSERT INTO password_reset (email, reset_code, expires_at) 
                 VALUES (?, ?, ?) 
                 ON DUPLICATE KEY UPDATE reset_code = VALUES(reset_code), expires_at = VALUES(expires_at)"
            );
            if (!$insert) {
                echo json_encode([
                    'status'  => 'error',
                    'message' => "SQL error: " . $conn->error
                ]);
                exit;
            }
            $insert->bind_param("sss", $email, $reset_code, $expires_at);
            $insert->execute();
    
            // For offline testing, return the reset code in the response.
            // In production, you would email the reset code to the user.
            echo json_encode([
                'status'  => 'success',
                'message' => "Reset code sent. (For testing, your code is: {$reset_code})"
            ]);
        } else {
            echo json_encode([
                'status'  => 'error',
                'message' => 'No account found with that email.'
            ]);
        }
        exit;
    }
    
    // ACTION 2: Reset the password (verify the reset code and update the user's password)
    if ($_POST['action'] === 'reset_password') {
        // Trim inputs to ensure consistency
        $email        = trim($_POST['email']);
        $reset_code   = trim($_POST['reset_code']);
        $new_password = $_POST['new_password'];  // Plain text password
        
        // Debug: Log the reset attempt details
        error_log("Reset password attempt for email: {$email} with code: {$reset_code}");
        
        // First, check if the verification code exists in the password_reset table
        $query = $conn->prepare("SELECT * FROM password_reset WHERE email = ? AND reset_code = ?");
        $query->bind_param("ss", $email, $reset_code);
        $query->execute();
        $result = $query->get_result();
        
        if ($result->num_rows > 0) {
            $record = $result->fetch_assoc();
            // Check if the reset code has expired
            if (strtotime($record['expires_at']) < time()) {
                echo json_encode([
                    'status'  => 'error',
                    'message' => 'Reset code has expired. Please request a new one.'
                ]);
                exit;
            }
            
            // Update the password in the users table without hashing (plain text)
            $update = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
            $update->bind_param("ss", $new_password, $email);
            $update->execute();
    
            // Remove the reset code from the password_reset table after a successful update
            $delete = $conn->prepare("DELETE FROM password_reset WHERE email = ?");
            $delete->bind_param("s", $email);
            $delete->execute();
    
            error_log("Password successfully reset for email: {$email}");
            
            echo json_encode([
                'status'  => 'success',
                'message' => 'Password has been successfully reset.'
            ]);
        } else {
            // Log an error if no matching record is found
            error_log("No matching reset record found for email: {$email} with code: {$reset_code}");
            
            echo json_encode([
                'status'  => 'error',
                'message' => 'Invalid verification code.'
            ]);
        }
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Password Reset</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS (using CDN) -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Optional: Your custom styles -->
  <link rel="stylesheet" href="style.css">
  <style>
      body {
          background-color: #f8f9fa;
      }
      .container {
          margin-top: 50px;
      }
  </style>
  <script>
    // Function to send the reset code request using the Fetch API
    function sendResetCode() {
      const email = document.getElementById('email').value;
      const formData = new URLSearchParams();
      formData.append('action', 'send_code');
      formData.append('email', email);
      
      fetch('', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: formData.toString()
      })
      .then(response => response.json())
      .then(data => {
        // Display a Bootstrap alert with the response message
        const alertBox = document.getElementById('alertBox');
        alertBox.innerHTML = `<div class="alert alert-${data.status === 'success' ? 'success' : 'danger'}" role="alert">
                                  ${data.message}
                              </div>`;
        if (data.status === 'success') {
          // Reveal the section for entering the reset code and new password
          document.getElementById('codeSection').style.display = 'block';
        }
      })
      .catch(error => {
        console.error('Error:', error);
      });
      
      return false; // Prevent default form submission
    }
    
    // Function to send the reset password request using the Fetch API
    function resetPassword() {
      const email = document.getElementById('email').value;
      const reset_code = document.getElementById('reset_code').value;
      const new_password = document.getElementById('new_password').value;
      
      const formData = new URLSearchParams();
      formData.append('action', 'reset_password');
      formData.append('email', email);
      formData.append('reset_code', reset_code);
      formData.append('new_password', new_password);
      
      fetch('', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: formData.toString()
      })
      .then(response => response.json())
      .then(data => {
        const alertBox = document.getElementById('alertBox');
        alertBox.innerHTML = `<div class="alert alert-${data.status === 'success' ? 'success' : 'danger'}" role="alert">
                                  ${data.message}
                              </div>`;
        if (data.status === 'success') {
          // Redirect to the login page after a brief delay
          setTimeout(() => {
            window.location.href = 'login.php';
          }, 2000);
        }
      })
      .catch(error => {
        console.error('Error:', error);
      });
      
      return false; // Prevent default form submission
    }
  </script>
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow-sm">
          <div class="card-body">
            <h3 class="card-title text-center mb-4">Password Reset</h3>
            <div id="alertBox"></div>
            <!-- Form to request the reset code -->
            <form onsubmit="return sendResetCode();">
              <div class="form-group">
                <label for="email">Enter your email:</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="you@gmail.com" required>
              </div>
              <button type="submit" class="btn btn-primary btn-block">Send Reset Code</button>
            </form>
            
            <!-- Hidden section: Appears after the reset code is sent -->
            <div id="codeSection" style="display:none; margin-top:20px;">
              <hr>
              <form onsubmit="return resetPassword();">
                <div class="form-group">
                  <label for="reset_code">Reset Code:</label>
                  <input type="text" id="reset_code" name="reset_code" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="new_password">New Password:</label>
                  <input type="password" id="new_password" name="new_password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success btn-block">Reset Password</button>
              </form>
            </div>
          </div>
        </div>
        <div class="text-center mt-3">
          <a href="login.php">Back to Login</a>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Bootstrap JS and dependencies (using CDN) -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
