<?php
// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $role = $_POST['role'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $password = $_POST['password'];

    // Here you would typically perform validation, sanitation, and then
    // save the data to a database or perform other processing

    // For demonstration, we'll just return a success message
    echo "Registration successful for role: $role. Username: $username, Email: $email, Contact: $contact.";
} else {
    // If the request method is not POST, return an error
    echo "HTTP ERROR 405: Method Not Allowed";
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <form method="POST" action="">
        Username: <input type="text" name="username" required><br>
        Password: <input type="password" name="password" required><br>
        <button type="submit">Register</button>
    </form>
</body>
</html>
