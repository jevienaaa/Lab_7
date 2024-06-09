<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'Lab_7');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO users (matric, name, password, role) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $matric, $name, $password, $role);
    if ($stmt->execute()) {
        echo "Registration successful. <a href='login.php'>Login</a>";
    } else {
        echo "Error: " . $conn->error;
    }
    $stmt->close();
    $conn->close();
}