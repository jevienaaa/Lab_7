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

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete User</title>
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
        .message {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
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
    <h1>Delete User</h1>
</header>

<main>
    <div class="message">
        <?php
        if (isset($_GET['matric'])) {
            $matric = $_GET['matric'];

            $sql = "DELETE FROM users WHERE matric=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $matric);
            if ($stmt->execute()) {
                echo "Record deleted successfully. <a href='display.php'>Go back</a>";
            } else {
                echo "Error deleting record: " . $conn->error;
            }
            $stmt->close();
        } else {
            echo "Invalid request.";
        }
        ?>
    </div>
</main>

</body>
</html>

<?php
$conn->close();
?>
