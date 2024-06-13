<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
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
        table {
            width: 100%;
            border-collapse: collapse;
        }
        td {
            padding: 10px 0;
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
        label {
            display: block;
            margin-bottom: 6px;
        }
    </style>
</head>
<body>

<header>
    <h1>Registration Page</h1>
</header>

<main>
    <form action="process.php" method="post">
        <table>
            <tr>
                <td><label for="matric">Matric:</label></td>
                <td><input type="text" id="matric" name="matric" required></td>
            </tr>
            <tr>
                <td><label for="name">Name:</label></td>
                <td><input type="text" id="name" name="name" required></td>
            </tr>
            <tr>
                <td><label for="password">Password:</label></td>
                <td><input type="password" id="password" name="password" required></td>
            </tr>
            <tr>
                <td><label for="role">Role:</label></td>
                <td>
                    <select id="role" name="role" required>
                        <option value="" disabled selected>Please select</option>
                        <option value="student">Student</option>
                        <option value="lecturer">Lecturer</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td></td>
                <td colspan="2"><input type="submit" value="Submit"></td>
            </tr>

            <tr>
                <td></td>
                <td colspan="2"><p>Already have an account? <a href="login.php">Login here</a></p></td>
            </tr>
        </table>
        


    </form>

</main>

</body>
</html>
