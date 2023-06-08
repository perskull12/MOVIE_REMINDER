<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "movixx";

// Get the reminder ID from the query parameters
$id = $_GET['id'];

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the reminder details from the database
$sql = "SELECT * FROM reminders WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    // Display the reminder details and provide an edit form
    echo '<h1>Edit Reminder</h1>';
    echo '<form action="update_reminder.php" method="post">';
    echo '<input type="hidden" name="id" value="' . $id . '">';
    echo 'Movie Title: <input type="text" name="movie_title" value="' . $row['movie_title'] . '"><br>';
    echo 'Reminder Date: <input type="text" name="reminder_date" value="' . $row['reminder_date'] . '"><br>';
    echo '<input type="submit" value="Update Reminder">';
    echo '</form>';
} else {
    echo 'Reminder not found.';
}

// Close the database connection
$stmt->close();
$conn->close();
?>
