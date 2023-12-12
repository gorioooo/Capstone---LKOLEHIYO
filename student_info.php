<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="info.css">
    <title>Students</title>
</head>
<body>
    <button type="button" id="back" onclick="goBack()">Back</button>


    <form id="studentForm" method="post" action="student_info.php">
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

        <button type="submit" id="submit" name="submitForm">Submit</button>

    </form>

    <!-- Add this section below your form -->
<div id="studentList">
    <h2>Student List</h2>
    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Grade and Section</th>
            <th>Strand</th>
            <th>ID Number</th>
        </tr>

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
        // Retrieve student information from the database
        $result = $conn->query("SELECT * FROM student_info");

        // Display each row in the table
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
            echo "<td>" . htmlspecialchars($row['grade_section']) . "</td>";
            echo "<td>" . htmlspecialchars($row['strand']) . "</td>";
            echo "<td>" . htmlspecialchars($row['id_number']) . "</td>";
            echo "</tr>";
        }

        // Close the result set
        $result->close();
        ?>
    </table>
</div>


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
    // Using prepared statements to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO student_info (name, email, grade_section, strand, id_number) VALUES (?, ?, ?, ?, ?)");

    // Bind parameters
    $stmt->bind_param("sssss", $studentName, $studentEmail, $studentGrade_section, $studentStrand, $studentId);

    // Sanitize and set variables
    $studentName = htmlspecialchars($_POST['studentName']);
    $studentEmail = htmlspecialchars($_POST['studentEmail']);
    $studentGrade_section = htmlspecialchars($_POST['grade_section']);
    $studentStrand = htmlspecialchars($_POST['strand']);
    $studentId = htmlspecialchars($_POST['idNumber']);

    // Execute the statement
    if ($stmt->execute()) {
        // Display success message
        echo '<script>alert("Form submitted successfully!");</script>';

        // Display added student information
    echo '<div id="addedStudentInfo">';
    echo '<h2>Added Student Information:</h2>';
    echo '<p><strong>Name:</strong> ' . $studentName . '</p>';
    echo '<p><strong>Email:</strong> ' . $studentEmail . '</p>';
    echo '<p><strong>Grade and Section:</strong> ' . $studentGrade_section . '</p>';
    echo '<p><strong>Strand:</strong> ' . $studentStrand . '</p>';
    echo '<p><strong>ID Number:</strong> ' . $studentId . '</p>';
    echo '</div>';

    } else {
        // Display error message
        echo '<script>alert("Error submitting form. Please try again.");</script>';
    }

    // Close the prepared statement
    $stmt->close();
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
