<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== TRUE) {
    header('Location: login.php');
    exit();
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection
$conn = new mysqli('localhost', 'root', '', 'Lab_7');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = ''; // Initialize an empty variable to store success or error message

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $role = $_POST['role'];

    $sql = "UPDATE users SET name=?, role=? WHERE matric=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $role, $matric);
    if ($stmt->execute()) {
        $message = "Record updated successfully. <a href='display.php'>Go back</a>";
    } else {
        $message = "Error updating record: " . $conn->error;
    }
    $stmt->close();
} else {
    // Fetch user details based on matric from GET parameter
    $matric = $_GET['matric'];
    $sql = "SELECT * FROM users WHERE matric=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $matric);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
        }
        header {
            background-color: #4CAF50;
            color: white;
            width: 100%;
            padding: 10px 0;
            text-align: center;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
        }
        main {
            margin-top: 60px; /* Height of the header */
            display: flex;
            justify-content: center;
            align-items: center;
            flex-grow: 1;
            width: 100%;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        input[type="text"],
        input[type="password"],
        select {
            width: 100%;
            padding: 10px;
            margin: 5px 0 10px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        a {
            color: #4CAF50;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<header>
    <h1>Update User</h1>
</header>

<main>
    <?php if (!empty($message)) : ?>
        <div class="message">
            <?php echo $message; ?>
        </div>
    <?php else : ?>
        <form method="POST" action="update.php">
            <label for="matric">Matric:</label>
            <input type="text" id="matric" name="matric" value="<?php echo $user['matric']; ?>" required><br><br>

            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $user['name']; ?>" required><br><br>

            <label for="role">Access Level:</label>
            <select id="role" name="role" required>
                <option value="student" <?php if ($user['role'] == 'student') echo 'selected'; ?>>Student</option>
                <option value="lecturer" <?php if ($user['role'] == 'lecturer') echo 'selected'; ?>>Lecturer</option>
            </select><br><br>

            <input type="submit" value="Update"> <a href="display.php">Cancel</a>
        </form>
    <?php endif; ?>
</main>

</body>
</html>

<?php
$conn->close();
?>
