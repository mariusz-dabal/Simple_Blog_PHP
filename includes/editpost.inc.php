<?php

session_start();

if (isset($_POST['edit_submit']) && isset($_SESSION['is_auth'])) {

    require "db.php";

    $postID = mysqli_escape_string($conn, $_GET['postid']);
    $postTitle = mysqli_real_escape_string($conn, $_POST['post_title']);
    $postBody = mysqli_real_escape_string($conn, $_POST['post_body']);
    $authorID = $_SESSION['author_id'];

    $sql = "UPDATE posts SET
            author_id='$authorID',
            post_title='$postTitle',
            post_body='$postBody'
            WHERE id = {$postID}";

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