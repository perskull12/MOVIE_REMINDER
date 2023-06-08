<?php
// Retrieve the form data
$email = $_POST['email'];
$password = $_POST['password'];

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

// Prepare and execute the SQL query to check the user credentials
$sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    $storedPassword = $row['password'];

    // Verify the password
    if (password_verify($password, $storedPassword)) {
        // Password is correct
        // Start the session and store user details
        session_start();
        $_SESSION['user'] = $row;

        // Redirect to the user profile
        header('Location: homepage.html');
        exit();
    } else {
        // Invalid password
        echo "Invalid email or password. Please try again.";
    }
} else {
    // User not found
    echo "Invalid email or password. Please try again.";
}

// Close the database connection
$conn->close();
?>
