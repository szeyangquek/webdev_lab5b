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
    <title>Users List</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container2">
        <h2 class="center">Users List</h2>
        <table>
            <tr>
                <th>Matric</th>
                <th>Name</th>
                <th>Level</th>
                <th colspan="2">Actions</th>
            </tr>
            <?php
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

            $sql = "SELECT matric, name, role AS accessLevel FROM users";
            $result = $conn->query($sql);

            if ($result) {
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["matric"] . "</td>
                                <td>" . $row["name"] . "</td>
                                <td>" . $row["accessLevel"] . "</td>
                                <td class='center'>
                                    <a href='update.php?matric=" . $row["matric"] . "'>Update</a>
                                </td>
                                <td class='center'>
                                    <a href='delete.php?matric=" . $row["matric"] . "' onclick='return confirm(\"Are you sure you want to delete this user?\")'>Delete</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No users found</td></tr>";
                }
            } else {
                echo "Error: " . $conn->error;
            }

            $conn->close();
            ?>
        </table>
    </div>
</body>
</html>