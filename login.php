<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="login.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <title>Login Page</title>
    <style>
        /* Add your CSS styles here */
* {
    padding: 0;
    margin: 0;
    box-sizing: auto;
}
.main-container {
    font-family: poppins;
    text-align: center ;
    background-image: url("./img/bg.jpg");
    background-size: cover;
    background-repeat: no-repeat;
    background-color: #f2f2f2;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    margin: 0;
}

.main-container::before {
    background-image: url("./img/bg.jpg");
    background-size: cover;
    background-repeat: no-repeat;
    background-size: cover;
    opacity: 0.75;
}



header {
    background-color: #333;
    color: #fff;
    padding: 10px;
    text-align: center;
}

nav ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    background-color: #eee;
    text-align: center;
}

nav ul li {
    display: inline;
    margin-right: 20px;
}

nav ul li a {
    text-decoration: none;
    color: #fff;
    font-weight: bold;
}

.login-container {
    width: 300px;
    margin: 0 auto;
    padding: 20px;
    border-radius: 5px;
    margin: 50vh auto 0;
    transform: translateY(-50%);
    margin-top: 20%;
}

.parent-container {
    display: flex;
    justify-content: center; 
    align-items: center;
    height: 100px; 
}

img {
    height: 250px;
    margin-bottom: 20px; 
}

.submit {
    width: 100px;
    border-radius: 200px;
    font-family: poppins;
    font-size: 20px;
}

h2 {
    font-size: 60px;
    color: #fff;
    margin: 0;
}

p {
    font-size: 20px;
    display: flex;
    margin: 0;
    padding-left: 50px;
    padding-bottom: 70px;
    color: #fff
}

input::placeholder {
    height: 30px;
    width: auto;
    text-align: center;
    font-size: 20px;
}

input{
    border-radius: 20px;
    height: 30px;
    font-family: poppins;
    width: auto;
}
    </style>
</head>
<body>
    <div class="main-container">
        <div class="login-container">
            <img src="./img/logo.jpg" alt="letran-logo">
            <h2>WELCOME BACK!</h2>
            <p>Login to your account</p>
            <form id="login-form" action="login.php" method="post">
                <input type="text" id="username" name="username" placeholder="Username" required><br><br>
                <input type="password" id="password" name="password" placeholder="Password" required><br><br>
                <input type="submit" class="submit" value="SIGN IN">
            </form>
        </div>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Database connection details
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "login";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

       // Check connection
       if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

        // Handle form submission
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Secure the input
        $username = mysqli_real_escape_string($conn, $username);
        $password = mysqli_real_escape_string($conn, $password);

        // Query to check credentials
        $query = "SELECT * FROM admin_login WHERE username='$username' AND password='$password'";
        $result = $conn->query($query);

        // Check if the query was successful
        if ($result && $result->num_rows > 0) {
            // Redirect to homepage
            header("Location: homepage.html");
            exit();
        } else {
            echo '<script>alert("Invalid username or password. Please try again.");</script>';
        }

        // Close the database connection
        $conn->close();
}
?>
</body>
</html>
