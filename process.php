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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get student ID
    $student_id = sanitizeInput($_POST["student_id"]);

    // Loop through submitted grades and subjects
    for ($i = 1; $i <= 10; $i++) {
        $subject = sanitizeInput($_POST["subject" . $i . "_select"]);
        $grade = sanitizeInput($_POST["value" . $i]);

        // SQL query to insert or update grades
        $sql = "INSERT INTO student_grades (id_number, subject, grade)
                VALUES ('$student_id', '$subject', '$grade')
                ON DUPLICATE KEY UPDATE grade = '$grade'";

        // Execute the query
        if ($conn->query($sql) !== TRUE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    echo "Grades added/edited successfully!";
}

// Close the database connection
$conn->close();
?>
