<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/login.php");
    exit();
}

/** @var mysqli $conn */
include '../database/db_connection.php';

$id = $_SESSION['user_id'];

$sql = "SELECT * FROM users WHERE id = $id";

$result = mysqli_query($conn, $sql);

$user = mysqli_fetch_assoc($result);

?>
<?php

$faculties = [
    "Medicine",
    "Dentistry",
    "Pharmacy",
    "Nursing",
    "Applied Medical Sciences",
    "Engineering",
    "Computer and Information Technology",
    "Science and Arts",
    "Agriculture",
    "Architecture and Design",
    "Business",
    "Graduate Studies"
];

?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../assets/css/edit_profile.css">
</head>

<body class="body">
   
<div class="edit-profile-page">
    <h2 class="h2">Edit Profile</h2>
    <div class="edit-profile-card">

         <img
    src="<?= empty($user['profile_image'])
        ? '../assets/images/default.png'
        : '../user_profile_images/' . $user['profile_image'] ?>"
    class="edit-profile-image">


        <form action="update_profile.php" method="POST" class="edit-profile-form">
<div class="form-group">

            <label>Name</label>

            <input
                type="text"
                name="name"
                value="<?= $user['name'] ?>"
                required>
</div>
<div class="form-group">

<label>Faculty</label>
           <select name="faculty">

    <option value="">Select Faculty</option>

    <?php foreach ($faculties as $faculty) : ?>

        <option
            value="<?= $faculty ?>"
            <?= $user['faculty'] == $faculty ? 'selected' : '' ?>>

            <?= $faculty ?>

        </option>

    <?php endforeach; ?>

</select>

         </div>  
<div class="buttons">

            <button type="submit" class="save-btn">
                Save Changes
            </button>
   <a
                href="profile.php"
                class="cancel-btn">

                Cancel

            </a>
</div>
        </form>

    </div>
</div>
</body>

</html>