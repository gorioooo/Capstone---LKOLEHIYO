<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Grades Management</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        h2 {
            color: #333;
        }

        form {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: inline-block;
            padding: 20px;
            margin: 20px;
            width: 80%; /* Set the width as desired */
            max-width: 1000px; /* Set a maximum width if needed */
            margin-left: auto;
            margin-right: auto;
            position: relative; /* Position relative for absolute positioning of the button */
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input, select {
            width: calc(50% - 12px);
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
            display: inline-block;
        }

        input[type="submit"] {
            background-color: #002145;
            color: #fff;
            cursor: pointer;
            padding: 8px;
            border: none;
            border-radius: 4px;
        }

        input[type="submit"]:hover {
            background-color: #002145;
        }

        .subject-column {
            width: calc(10% - 12px);
        }

        .grade-column {
            width: 10%;
            display: inline-block;
        }

        button {
            background-color: #002145;
            color: #fff;
            cursor: pointer;
            padding: 8px;
            border: none;
            border-radius: 4px;
            position: absolute;
            top: 10px;
            left: 10px;
        }

        button:hover {
            background-color: #002145;
        }
    </style>
</head>
<body>

<h2>Add/Edit Student Schedule</h2>

<form action="process.php" method="post">
    <button type="button" onclick="goBack()">Back</button>
    <label for="student_id">Student ID:</label>
    <input type="text" name="student_id" required>

    <!-- Subjects  -->
    <div>
        <?php for ($i = 1; $i <= 10; $i++) : ?>
            <label class="subject-column" for="subject<?= $i ?>_select">Subject <?= $i ?>:</label>
            <select class="subject-column" name="subject<?= $i ?>_select" required>
                <option value="Schedule1">Math</option>
                <option value="Schedule2">Math</option>
                <option value="Schedule3">Math</option>
                <option value="Schedule4">Math</option>
                <option value="Schedule5">Math</option>
                <option value="Schedule6">Math</option>
                <option value="Schedule7">Math</option>
                <option value="Schedule8">Math</option>
                <option value="Schedule9">Math</option>
                <option value="Schedule10">Math</option>
                <!-- Add more options as needed -->
            </select>
        <?php endfor; ?>
    </div>

    <input type="submit" value="Add/Edit Schedule">
</form>

<h2>Search and Edit Grades</h2>

<form action="search.php" method="get">
    <label for="student_id_search">Student ID:</label>
    <input type="text" name="student_id_search" required><br>

    <label for="subject_search">Subject:</label>
    <input type="text" name="subject_search"><br>

    <input type="submit" value="Search and Edit">
</form>

<script>
    function goBack() {
        window.history.back();
    }
</script>

</body>
</html>
