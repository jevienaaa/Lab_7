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

if ($result === FALSE) {
    echo "Error: " . $conn->error;
} else {
    if ($result->num_rows > 0) {
        echo "<table border='1'>
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
        echo "0 results";
    }
}

$conn->close();
?>
