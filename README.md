# Hospital Appointment System
This **Hospital Appointment System** is a simple web-based application developed as part of a student project. Its primary goal is to let users (patients) register, view a list of doctors, book appointments, and cancel them when necessary. This project demonstrates core concepts of **PHP**, **MySQL**, and **Git**.

## Features
1. **User Registration**  
   - Allows new users to sign up with minimal validation (username, email, password).
   - Stores user data in the MySQL database.

2. **Doctor Listing**  
   - Displays available doctors and their specialties.
   - Offers a search function to filter doctors by specialty.

3. **Appointment Booking**  
   - Users can choose a doctor and pick a time slot for their appointment.
   - The system checks for conflicts and records each booking in the database.

4. **Cancel Appointment**  
   - Lists active appointments with a simple option to cancel.
   - Marks appointments as `canceled` rather than deleting them.

5. **View Past/Canceled Appointments**  
   - Provides a page to see canceled or completed appointments (depending on the system’s logic).
   - Helps track a patient’s appointment history.

## Project Structure

```
hospital_appointment/
├── db_connect.php          # Database connection (adjust credentials as needed)
├── register.php            # Registration page
├── login.php               # Login page
├── logout.php              # Logout script
├── doctor_list.php         # Doctor listing + search feature
├── book_appointment.php    # Appointment booking interface
├── cancel.php              # Lists active appointments for cancellation
├── cancel_appointment.php  # Processes the cancellation
├── canceled_appointments.php # (Optional) Lists canceled appointments
├── style.css               # CSS for styling pages
├── README.md               # This README file
└── (Additional files)      # E.g., images, scripts, etc.
```

## Setup & Installation
1. **Clone or Download** this repository to your local machine:
   ```bash
   git clone https://github.com/yourusername/hospital_appointment.git
   ```
2. **Move** the `hospital_appointment` folder into the `htdocs` (XAMPP) or `www` (WAMP) directory.
3. **Database**:
   1. Create a new MySQL database (e.g., `hospital_db`).
   2. Import the SQL file (or manually create tables) that defines the `users`, `doctors`, `appointments`, etc.
   3. Adjust the credentials in `db_connect.php` to match your local MySQL settings.
4. **Start** your local server environment (XAMPP, WAMP, or similar).
5. **Navigate** to `http://localhost/hospital_appointment/login.php` in your browser:
   - `login.php` for login
   - `register.php` for new user registration
   - `doctor_list.php` to view or search doctors
   - `book_appointment.php` to create a booking
   - `cancel.php` to cancel existing appointments
   - `canceled_appointments.php` to review canceled/archived appointments

## Usage
1. **Register** a new user account (or use existing credentials if provided).
2. **Login** with your username/password.
3. **Explore** the system:
   - Book appointments under “Doctors” or “Book Appointment.”
   - Cancel an existing appointment from the cancellation page.
   - Check past or canceled appointments (if implemented).

## Future Improvements
- **Stronger Validation**: Add password strength checks and email format validation.
- **Security Enhancements**: Implement password hashing (`password_hash()` in PHP), prepared statements to avoid SQL injection, etc.
- **UI/UX**: Improve the interface’s responsiveness and design consistency.
- **Notifications**: Integrate email or SMS reminders for upcoming appointments.
