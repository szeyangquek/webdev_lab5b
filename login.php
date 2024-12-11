<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "lab_5b";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $matric = $_POST['matric'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE matric='$matric' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Authentication successful
        $_SESSION['loggedin'] = true;
        $_SESSION['matric'] = $matric;
        header("Location: display.php");
        exit();
    } else {
        // Authentication failed
        $error_message = "Invalid matric or password, try <a href='login.php'>login</a> again.";
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h2 class="center">Login Form</h2>
        <form action="login.php" method="post">
            <label for="matric">Matric:</label>
            <input type="text" id="matric" name="matric" required><br><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>
            <input type="submit" value="Login">
        </form>
        <p>Register <a href="registration.php">here</a> if you have not.</p>
        <?php
        if (isset($error_message)) {
            echo "<p style='color:red;'>$error_message</p>";
        }
        ?>
    </div>
</body>
</html>