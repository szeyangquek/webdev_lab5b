<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit();
}

$servername ="localhost";
$username = "root";
$password = "";
$dbname = "lab_5b";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['matric'])) {
    $matric = $_GET['matric'];
    $sql = "DELETE FROM users WHERE matric='$matric'";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
        header("Location: display.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
?>