<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
</head>
<body>

<h1>Registration Page</h1>

<form action="process.php" method="post">

<table>
        <tr>
        <td><label for="matric">Matric:</label></td>
        <td><input type="text" name="matric"></td><br>
        </tr>

        <tr>
        <td><label for="name">Name</label></td>
        <td><input type="text" name="name"><br></td>
        </tr>

        <tr>
        <td><label for="password">Password: </label></td>
        <td><input type="password" name="password"><br></td>
        </tr>

        <tr>
        <td>
            <label for="role">Role:</label>

            <td>
            <select name="role">
                <option value="" disabled selected>Please select</option>
                <option value="student">student</option>
                <option value="staff">lecturer</option>
            </select>
            </td>
        </td>

        <br>

        <tr>
            <td></td>
            <td colspan="2"><input type ="submit" value= "Submit"></td>
        </tr>
        
    </table>

</form>

</body>
</html>