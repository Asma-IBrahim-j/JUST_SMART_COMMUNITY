<html>

<head>
    <link rel="stylesheet" href="../assets/css/change_password.css">
</head>

<body class="body">
    <div class="change-password-page">

        <div class="change-password-card">

            <h2>Change Password</h2>

            <form
                action="update_password.php"
                method="POST"
                class="change-password-form">

                <div class="form-group">

                    <label>Current Password</label>

                    <input
                        type="password"
                        name="current_password"
                        required>

                </div>

                <div class="form-group">

                    <label>New Password</label>

                    <input
                        type="password"
                        name="new_password"
                        minlength="6"
                        required>

                </div>

                <div class="form-group">

                    <label>Confirm Password</label>

                    <input
                        type="password"
                        name="confirm_password"
                        minlength="6"
                        required>

                </div>

                <div class="buttons">

                    <button
                        type="submit"
                        class="save-btn">

                        Change Password

                    </button>

                    <a
                        href="profile.php"
                        class="cancel-btn">

                        Cancel

                    </a>

                </div>

            </form>

        </div><?php if (isset($_GET['error'])): ?>

    <div class="error-message">

        <?php

        if ($_GET['error'] == 'wrong_password') {
            echo "Current password is incorrect.";
        }

        elseif ($_GET['error'] == 'password_mismatch') {
            echo "Passwords do not match.";
        }

        elseif ($_GET['error'] == 'password_less_than_6_characters') {
            echo "Password must be at least 6 characters.";
        }

        ?>

    </div>

<?php endif; ?>

    </div>
</body>

</html>