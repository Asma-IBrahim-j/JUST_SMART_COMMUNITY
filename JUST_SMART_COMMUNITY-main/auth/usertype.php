<!DOCTYPE html>
<html>
<head>
    <title>Choose User Type</title>
    <link rel="stylesheet" href="../assets/css/auth.css">
</head>
<body>

<div class="form-container">

    <h2>
        Select User Type
    </h2>

    <p class="user-title">
        Please choose how you want to continue
    </p>

    <form method="POST"
          action="redirect.php">

        <div class="user-options">

            <label class="user-card">

                <input type="radio"
                       name="user_type"
                       value="student"
                       required>

                <h3>JUST Student</h3>

                <p>
                    I am a student at JUST University
                </p>

            </label>

            <label class="user-card">

                <input type="radio"
                       name="user_type"
                       value="notstudent">

                <h3>Community Member</h3>

                <p>
                    I am not a JUST student
                </p>

            </label>

        </div>

        <button type="submit">

            Continue

        </button>

    </form>

</div>

</body>

</html>
``