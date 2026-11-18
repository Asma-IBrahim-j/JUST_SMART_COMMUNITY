
<?php
if (isset($_POST['user_type'])) {

    $type = $_POST['user_type'];

    if ($type == "student") {
        header("Location: studentregister.php");
    } else {
        header("Location: othersregister.php");
    }

    exit();
}
?>
