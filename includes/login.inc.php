<?php

session_start();

if (isset($_POST['login_submit'])) {

    require "db.php";

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT author_email, author_pass, id FROM authors WHERE author_email='$email'";
    
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        
        if (password_verify($password, $row['author_pass'])) {
            $_SESSION['is_auth'] = true;
            $_SESSION['author_id'] = $row['id'];
           header("Location: ../index.php");
        } else {
            header("Location: ../login.php");
            $_SESSION['e_login'] = "Wrong login or password!";
        }
    } else {
        header("Location: ../login.php");
        $_SESSION['e_login'] = "Wrong login or password!";
    }

    mysqli_close($conn);   
} else {
    header("Location: ../login.php");
    exit();
}