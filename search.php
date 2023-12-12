<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search and Edit Student Grades</title>

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
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Get search parameters
    $student_id_search = sanitizeInput($_GET["student_id_search"]);
    $subject_search = sanitizeInput($_GET["subject_search"]);

    // SQL query to retrieve grades based on search parameters
    $sql = "SELECT * FROM student_grades WHERE id_number = '$student_id_search'";

    if (!empty($subject_search)) {
        // Use an exact match for the subject
        $sql .= " AND subject = '$subject_search'";
    }

    $result = $conn->query($sql);
}
    ?>

<?php if ($result->num_rows > 0): ?>
        <h2 class="mb-4">Search Results</h2>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Student ID</th>
                <th scope="col">Subject</th>
                <th scope="col">Grade</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id_number'] ?></td>
                    <td><?= $row['subject'] ?></td>
                    <td><?= $row['grade'] ?></td>
                    <td>
                        <a href="edit.php?id=<?= $row['id_number'] ?>" class="btn btn-primary">Edit</a>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No results found.</p>
    <?php endif; ?>
</div>

<!-- Bootstrap JS and Popper.js (required for Bootstrap components) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
