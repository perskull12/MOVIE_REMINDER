<!DOCTYPE html>
<html>
<head>
  <title>Reminders</title>
  <link rel="stylesheet" href="display_reminders.css">
</head>
<body>
  <div class="container">
  <div class="logo-section">
      <img src="logo.png" alt="Movix Logo">
      <h1>Reminders</h1>
    <a href="homepage.html" class="back-link">Back</a>
    </div>
         <?php
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

    // Fetch reminders from the database
    $sql = "SELECT * FROM reminders";
    $result = $conn->query($sql);

    // Display reminders
    if ($result->num_rows > 0) {
        echo '<ul>';
        while ($row = $result->fetch_assoc()) {
            echo '<li><strong>Title:</strong> ' . $row["movie_title"] . ', <strong>Reminder Date:</strong> ' . $row["reminder_date"] . '
                  <button onclick="editReminder(' . $row["id"] . ')">Edit</button>
                  <button onclick="removeReminder(' . $row["id"] . ')">Remove</button></li>';
        }
        echo '</ul>';
    } else {
        echo '<p>No reminders found.</p>';
    }

    // Close the database connection
    $conn->close();
    ?>
  </div>

  <script>
    function editReminder(id) {
      // Redirect to the edit reminder page with the specified reminder ID
      window.location.href = "edit_reminder.php?id=" + id;
    }
    
    function goBack() {
      // Redirect back to the homepage
      window.location.href = "homepage.html";
    }

    function removeReminder(id) {
      // Make an AJAX request to remove the reminder from the database
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            // Refresh the page to update the reminder list
            window.location.reload();
          } else {
            console.error("Error removing reminder: " + xhr.responseText);
          }
        }
      };

      xhr.open("POST", "remove_reminder.php", true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhr.send("id=" + id);
    }
  </script>
</body>
</html>
