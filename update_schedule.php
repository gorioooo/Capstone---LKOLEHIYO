<?php
// Database configuration
$host = "localhost";
$username = "root";
$password = "";
$database = "students";

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize user input
function sanitizeInput($data)
{
    return htmlspecialchars(strip_tags(trim($data)));
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"]) && isset($_POST["schedule"])) {
    // Get the record ID, subject, and new subject from the form
    $record_id = sanitizeInput($_POST["id"]);
    $new_schedule = sanitizeInput($_POST["schedule"]);

    // SQL query to update the grade for a specific record
    $sql = "UPDATE student_schedule SET subject = '$new_schedule' WHERE id_number = '$record_id'";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "Schedule updated successfully.";
    } else {
        echo "Error updating schedule: " . $conn->error;
    }
} else {
    echo "Invalid request. Please provide the necessary parameters.";
}

// Close the database connection
$conn->close();
?>
