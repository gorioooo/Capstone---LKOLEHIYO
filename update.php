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
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"]) && isset($_POST["grade"])) {
    // Get the record ID, subject, and new grade from the form
    $record_id = sanitizeInput($_POST["id"]);
    $new_grade = sanitizeInput($_POST["grade"]);

    // SQL query to update the grade for a specific record
    $sql = "UPDATE student_grades SET grade = '$new_grade' WHERE id_number = '$record_id'";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "Grade updated successfully.";
    } else {
        echo "Error updating grade: " . $conn->error;
    }
} else {
    echo "Invalid request. Please provide the necessary parameters.";
}

// Close the database connection
$conn->close();
?>
