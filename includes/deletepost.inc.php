<?php

session_start();

if (isset($_POST['delete_submit']) && isset($_SESSION['is_auth'])) {

    require "db.php";

    $postID = mysqli_escape_string($conn, $_POST['delete_id']);

    $sql = "DELETE FROM posts WHERE id={$postID}";

    if (mysqli_query($conn, $sql)) {
        header("Location: ../index.php");
    } else {
        echo "Error".mysqli_error($conn);
    }
    mysqli_close($conn);

} else {
    header("Location: ../index.php");
    exit();
}