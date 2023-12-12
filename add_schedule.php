<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include your database connection file or create a connection here
    // Example using MySQLi

    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "students";

    $conn = new mysqli($host, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve student ID from the form
    $student_id =  $_POST["student_id"];

    // Loop through subjects and store data in the database
    for ($i = 1; $i <= 10; $i++) {
        $subject = $_POST["subject{$i}_select"];
        $time = $_POST["subject{$i}_time"];

        // Insert data into the database
        $sql = "INSERT INTO student_schedule (id_number, subject, time) VALUES ('$student_id', '$subject', '$time')";

        if ($conn->query($sql) !== TRUE) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    echo "Schedule added/edited successfully!";
    
    // Close the database connection
    $conn->close();
}
?>

