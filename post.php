<?php include 'includes/header.inc.php'; ?>

<main class="pb-5">
    <?php
    
    if (isset($_GET['postid'])) {
        require "includes/db.php";

        $postID = mysqli_real_escape_string($conn, $_GET['postid']);
       
       $sqlPost = "SELECT posts.id, posts.post_title, posts.post_body, posts.post_published, authors.author_name 
       FROM posts, authors
       WHERE authors.id = posts.author_id AND posts.id='$postID'"; 
       
       $resultPost = mysqli_query($conn, $sqlPost);

       if (mysqli_num_rows($resultPost) > 0) {
        while($row = mysqli_fetch_assoc($resultPost)) {

            echo '<article class="container text-justify p-2 mt-5">
                <small class="text-muted">'.$row['post_published'].' @'.$row['author_name'].'</small>';

                if (isset($_SESSION['is_auth'])) {
                    echo '<div class="text-muted float-right">
                    <button type="submit" class="btn btn-link text-reset p-0"><a href="editpost.php?postid='.$postID.'" class="text-reset">edit</a></button>
                       <form method="post" action="includes/deletepost.inc.php" class="d-inline">
                       <input type="hidden" name="delete_id" value="'.$postID.'">
                        <button type="submit" name="delete_submit" class="btn btn-link text-reset p-0">delete</button>
                        </form>
                    </div>';
                }

                echo '
                <h1>'.$row['post_title'].'</h1>
                <p>'.$row['post_body'].'</p></article>';
        }
       } else {
           echo '<div class="container">
                    <h2>No posts</h2>
                </div>';
       }

       $sqlComm = "SELECT comments.comment_author, comments.comment_body, comments.comment_published
       FROM comments, posts
       WHERE posts.id = comments.post_id AND comments.post_id='$postID'";

        $resultComm = mysqli_query($conn, $sqlComm);
        $countComm = mysqli_num_rows($resultComm);

        echo '<h3 class="text-center text-muted mt-5 p-2">'.$countComm.' Comments</h3>';

        if ($countComm > 0) {
            while($row = mysqli_fetch_assoc($resultComm)) {
    
                echo '<div class="container p-2 mt-5">
                    <small class="text-muted">'.$row['comment_published'].'</small>
                    <h6>'.$row['comment_author'].'</h6>
                    <p class="text-muted">'.$row['comment_body'].'</p>
                    </div>';
            }
           } else {
              $countComm = 0;
           }


       mysqli_close($conn);

    } else {
        header('Location: index.php');
        exit();
    }
    
    ?>

    <div class="container">
        <h3 class="text-center text-muted mt-5 p-2">Add Comment</h3>

        <form action="includes/addcomment.inc.php<?='?postid='.$postID;?>" method="post"
            class="border p-3 w-75 mx-auto">
            <div class="form-group">
                <label for="commentAuthor">Your Email</label>
                <input type="email" name="comment_author" class="form-control form-control-sm" id="commentAuthor"
                    placeholder="Enter Email">
            </div>
            <div class="form-group">
                <label for="textarea">Comment</label>
                <textarea name="comment_body" class="form-control form-control-sm" id="textarea" rows="2"></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-sm" name="comment_submit">Submit</button>
        </form>
    </div>


</main>

<?php include 'includes/footer.inc.php'; ?>