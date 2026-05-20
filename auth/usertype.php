<!DOCTYPE html>
<html>
<head>
    <title>Choose User Type</title>
</head>
<body>

<h2>Select User Type</h2>

<form method="POST" action="redirect.php">

    <label>
        <input type="radio" name="user_type" value="student" required>
        JUST Student
    </label><br>

    <label>
        <input type="radio" name="user_type" value="notstudent">
        Not a JUST Student
    </label><br><br>

    <button type="submit">Next</button>

</form>

</body>



</html>
``