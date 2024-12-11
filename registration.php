<!DOCTYPE html>
<html>
<head>
    <title>Registration Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h2>Registration Form</h2>
    <form action="authenticate.php" method="post">
        <label for="matric">Matric:</label>
        <input type="text" id="matric" name="matric" required><br><br>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <label for="role">Role:</label>
        <select id="role" name="role" required>
            <option value="default  ">Please select</option>
            <option value="lecturer">lecturer</option>
            <option value="student">student</option>
        </select><br><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>