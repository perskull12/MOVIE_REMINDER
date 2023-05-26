<?php
// Retrieve the form data
$title = $_POST['movie_title'] ?? '';
$reminderDate = $_POST['reminder_date'] ?? '';

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "movix";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind the SQL statement with parameterized queries
$stmt = $conn->prepare("INSERT INTO process_rem (MOVIE_TITLE, REMINDER_DATE) VALUES (?, ?)");
$stmt->bind_param("ss", $title, $reminderDate);

// Execute the prepared statement
if ($stmt->execute()) {
    echo "Reminder set successfully!";
} else {
    echo "Error: " . $stmt->error;
}

// Close the prepared statement and database connection
$stmt->close();
$conn->close();
?>