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
$email = $user['email'];

// Display user profile
echo "<h1>Welcome, $name!</h1>";
echo "<p>Email: $email</p>";
echo "<p><a href='logout.php'>Logout</a></p>";
?>
