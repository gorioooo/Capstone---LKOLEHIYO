<?php

    // Replace these values with your actual database credentials
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "students";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submitForm"])) {
        $studentName = htmlspecialchars($_POST['studentName']);
        $studentEmail = htmlspecialchars($_POST['studentEmail']);
        $studentGrade_section = htmlspecialchars($_POST['grade_section']);
        $studentStrand = htmlspecialchars($_POST['strand']);
        $studentId = htmlspecialchars($_POST['idNumber']);

        // Assuming you have a 'students' table in your database
        $sql = "INSERT INTO student_info (name, email, grade_section, strand, id_number) VALUES ('$studentName', '$studentEmail', '$studentGrade_section', '$studentStrand', '$studentId')";

        // Execute the statement
        if ($conn->query($sql) === TRUE) {
            // Display success message
            echo '<script>alert("Form submitted successfully!");</script>';
        } else {
            // Display error message
            echo '<script>alert("Error submitting form. Please try again.");</script>';
        }
    }

    // Close the database connection at the end of your script
    $conn->close();
    ?>