<?php
session_start();

// Check if user is logged in, otherwise redirect to sign-in page
if (!isset($_SESSION['user'])) {
  header('Location: index.html');
  exit();
}

// Retrieve the user's details from the session
$user = $_SESSION['user'];
$name = $user['name'];

// Retrieve the form data
$title = $_POST['movie_title'];
$reminderDate = $_POST['reminder_date'];

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and execute the SQL query to insert the reminder data into the database
$sql = "INSERT INTO process_rem (MOVIE_TITLE, REMINDER_DATE) VALUES ('$title', '$reminderDate')";

if ($conn->query($sql) === TRUE) {
    echo "Reminder set successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Movix - Reminders</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <header>
      <div class="logo">
        <img src="logo.png" alt="Movix Logo">
      </div>
      <nav>
        <ul>
          <li><a href="reminders.php">Reminders</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </nav>
    </header>
    <h1>Welcome, <?php echo $name; ?>!</h1>
    <h2>Set a Movie Reminder</h2>
    <div class="movie-form">
      <form action="reminders.php" method="post">
        <div class="form-group">
          <label for="movie_title">Movie Title:</label>
          <input type="text" id="movie_title" name="movie_title" placeholder="Enter movie title">
        </div>
        <div class="form-group">
          <label for="reminder_date">Reminder Date:</label>
          <input type="text" id="reminder_date" name="reminder_date" placeholder="Enter reminder date">
        </div>
        <input type="submit" value="Add Reminder">
      </form>
    </div>
    <div class="movie-list">
      <!-- Display movie reminders here -->
    </div>
  </div>
</body>
</html>
