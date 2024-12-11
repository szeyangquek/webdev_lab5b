<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update User</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h2 class="center">Update User</h2>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "lab_5b";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['matric'])) {
            $matric = $_GET['matric'];
            $sql = "SELECT * FROM users WHERE matric='$matric'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                ?>
                <form action="update.php" method="post">
                    <input type="hidden" name="matric" value="<?php echo $row['matric']; ?>">
                    <label for="matric">Matric:</label>
                    <input type="text" id="matric" name="matric" value="<?php echo $row['matric']; ?>" required><br><br>
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" required><br><br>
                    <label for="role">Access Level:</label>
                    <input type="text" id="role" name="role" value="<?php echo $row['role']; ?>" required><br><br>
                    <input type="submit" value="Update">
                    <a href="display.php">Cancel</a>
                </form>
                <?php
            } else {
                echo "User not found.";
            }
        } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
            $matric = $_POST['matric'];
            $name = $_POST['name'];
            $role = $_POST['role'];

            $sql = "UPDATE users SET name='$name', role='$role' WHERE matric='$matric'";

            if ($conn->query($sql) === TRUE) {
                echo "Record updated successfully";
                header("Location: display.php");
                exit();
            } else {
                echo "Error updating record: " . $conn->error;
            }
        }

        $conn->close();
        ?>
    </div>
</body>
</html>