<?php
// Retrieve the form data
$title = $_POST['movie_title'];
$reminderDate = $_POST['reminder_date'];

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "movixx";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and execute the SQL query to insert the reminder data into the database
$sql = "INSERT INTO reminders (movie_title, reminder_date) VALUES ('$title', '$reminderDate')";

if ($conn->query($sql) === TRUE) {
    echo "Reminder set successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
