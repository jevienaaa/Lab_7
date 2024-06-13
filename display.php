<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== TRUE) {
    header('Location: login.php');
    exit();
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//connect the database
$conn = new mysqli('localhost', 'root', '', 'lab_7');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT DISTINCT matric, name, role FROM users"; 
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Users</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e0f7fa;
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
            padding: 15px 0;
            text-align: center;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
        }
        main {
            margin-top: 80px; /* Height of the header */
            display: flex;
            justify-content: center;
            align-items: center;
            flex-grow: 1;
            width: 100%;
            flex-direction: column;
        }
        .container {
            background-color: #ffffff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            max-width: 800px;
            width: 100%;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        a {
            color: #4CAF50;
            text-decoration: none;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<header>
    <h1>Users List</h1>
</header>

<main>
    <div class="container">
        <?php
        if ($result === FALSE) {
            echo "<p>Error: " . $conn->error . "</p>";
        } else {
            if ($result->num_rows > 0) {
                echo "<table>
                        <tr>
                            <th>Matric</th>
                            <th>Name</th>
                            <th>Level</th>
                            <th>Action</th>
                        </tr>";
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>".$row["matric"]."</td>
                            <td>".$row["name"]."</td>
                            <td>".$row["role"]."</td>
                            <td>
                                <a href='update.php?matric=".$row["matric"]."' style='color: blue;'>Update</a> |
                                <a href='delete.php?matric=".$row["matric"]."' style='color: blue;'>Delete</a>
                            </td>
                          </tr>";
                }
                echo "</table>";
            } else {
                echo "<p>0 results</p>";
            }
        }

        $conn->close();
        ?>
    </div>
</main>

</body>
</html>
