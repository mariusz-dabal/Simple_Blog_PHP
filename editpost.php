<?php

include 'includes/header.inc.php';

if (!isset($_SESSION['is_auth'])) {
    header("Location: index.php");
    exit();
}
    
if (isset($_GET['postid'])) {
    require "includes/db.php";

    $postID = mysqli_real_escape_string($conn, $_GET['postid']); 
   
   $sqlPost = "SELECT posts.id, posts.post_title, posts.post_body, posts.post_published, authors.author_name 
   FROM posts, authors
   WHERE authors.id = posts.author_id AND posts.id='$postID'"; 
   
   $resultPost = mysqli_query($conn, $sqlPost);

   if (mysqli_num_rows($resultPost) > 0) {
    $row = mysqli_fetch_assoc($resultPost);
    $postTitle = $row['post_title'];
    $postBody = $row['post_body'];

    }
   } else {
       echo '<div class="container">
                <h2>No posts</h2>
            </div>';
   }

   mysqli_close($conn);

?>

<main class="pb-5">
    <div class="container">
        <form action="includes/editpost.inc.php?postid=<?= $postID?>" method="post">
            <div class="form-group">
                <label for="postTitle">Post Title</label>
                <input type="text" name="post_title" class="form-control" id="postTitle" placeholder="Post Title"
                    value="<?= $postTitle; ?>">
            </div>
            <div class="form-group">
                <label for="textarea">Post Text</label>
                <textarea name="post_body" class="form-control" id="textarea" rows="12"><?= $postBody; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="edit_submit">Submit</button>
        </form>
    </div>
</main>


<?php include 'includes/footer.inc.php';?>