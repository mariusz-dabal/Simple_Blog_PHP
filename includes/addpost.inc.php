<?php

session_start();

if (isset($_POST['post_submit']) && isset($_SESSION['is_auth'])) {

    require "db.php";

    $postTitle = mysqli_real_escape_string($conn, $_POST['post_title']);
    $postBody = mysqli_real_escape_string($conn, $_POST['post_body']);
    $authorID = $_SESSION['author_id'];

    $sql = "INSERT INTO posts (id, author_id, post_title, post_body, post_published) VALUES (NULL, '$authorID', '$postTitle', '$postBody', CURRENT_TIMESTAMP)";

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