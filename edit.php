<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student Grade</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Your custom CSS styles -->
    <style>
        /* Add your custom styles here */
    </style>
</head>
<body>

<div class="container mt-5">
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
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
        // Get the student's ID from the URL parameter
        $student_id = sanitizeInput($_GET["id"]);

        // Debugging information
        echo "<p>Student ID: $student_id</p>";

        // SQL query to retrieve student's information
        $sql = "SELECT * FROM student_grades WHERE id_number = '$student_id'";
        $result = $conn->query($sql);

        // Check for errors during query execution
        if (!$result) {
            die("Error in query: " . $conn->error);
        }

        // Check if any rows are returned
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $subject = $row['subject'];
            $grade = $row['grade'];

            // Display the subject and form to edit the grade
            ?>
            <h2>Edit Grade for <?= $subject ?></h2>
            <form action="update.php" method="post">
                <input type="hidden" name="id" value="<?= $student_id ?>">
                <div class="mb-3">
                    <label for="grade" class="form-label">New Grade</label>
                    <input type="text" class="form-control" id="grade" name="grade" value="<?= $grade ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Update Grade</button>
            </form>
            <?php
        } else {
            echo "<p>No student found with the specified ID.</p>";
        }
    } else {
        echo "<p>Invalid request. No student ID provided.</p>";
    }

    // Close the database connection
    $conn->close();
    ?>
</div>

<!-- Bootstrap JS and Popper.js (required for Bootstrap components) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
