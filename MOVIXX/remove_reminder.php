<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "movixx";

// Get the reminder ID from the request
$id = $_POST['id'];

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and execute the SQL query to remove the reminder
$sql = "DELETE FROM reminders WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    // Reminder successfully removed
    echo "Reminder removed successfully";
} else {
    // Error removing reminder
    echo "Error removing reminder: " . $stmt->error;
}

// Close the database connection
$stmt->close();
$conn->close();
?>
