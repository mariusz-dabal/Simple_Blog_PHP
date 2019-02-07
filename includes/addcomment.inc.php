<?php

session_start();

if (isset($_POST['comment_submit'])) {

    require "db.php";

    $postID = $_GET['postid']; 

    $commAuthor = mysqli_real_escape_string($conn, $_POST['comment_author']);
    $commBody = mysqli_real_escape_string($conn, $_POST['comment_body']);

    $sql = "INSERT INTO comments (id, post_id, comment_author, comment_body, comment_published) VALUES (NULL, '$postID', '$commAuthor', '$commBody', CURRENT_TIMESTAMP)";

    if (mysqli_query($conn, $sql)) {
        header("Location: ../post.php?postid=$postID");
    } else {
        echo "Error".mysqli_error($conn);
    }
    mysqli_close($conn);

} else {
    header("Location: ../index.php");
    exit();
}