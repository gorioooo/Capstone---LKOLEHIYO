<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="info.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="studentselection.css">
    <title>Students</title>
</head>
<body>
    <button type="button" onclick="goBack()">Back</button>


    <form id="studentForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="studentName">Student Name:</label>
        <input type="text" id="studentName" name="studentName" required>

        <label for="studentEmail">Student Email:</label>
        <input type="text" id="studentEmail" name="studentEmail" required>

        <label for="grade">Grade and Section:</label>
        <input type="text" id="grade_section" name="grade_section" required>

        <label for="strand">Strand:</label>
        <input type="text" id="strand" name="strand">

        <label for="idNumber">ID Number:</label>
        <input type="text" id="idNumber" name="idNumber" required>

        <!-- Other form fields remain unchanged -->

        <button2 type="submit" name="submitForm">Submit</button2>
    </form>

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

<script>
    function goBack() {
        window.history.back();
    }
</script>
</body>
</html>
