<?php include 'includes/header.inc.php'; ?>

<main class="pb-5">

    <?php 
    
       require "includes/db.php";
       
       $sql = "SELECT posts.id, posts.post_title, posts.post_body, posts.post_published, authors.author_name FROM posts, authors
       WHERE authors.id = posts.author_id
       ORDER BY posts.post_published DESC"; 
       $result = mysqli_query($conn, $sql);

       if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {

            $postID = $row['id'];

            echo '<article class="container text-justify p-2 mt-5">
                <small class="text-muted">'.$row['post_published'].' @'.$row['author_name'].'</small>
                <h3>'.'<a href="post.php?postid='.$postID.'" class="text-reset text-decoration-none">'.$row['post_title'].'</a>'.'</h3>
                <p>'.$row['post_body'].'</p>
                <small><a href="post.php?postid='.$postID.'" class="text-muted">Comments</a></small>
                </article>';
        }
       } else {
           echo '<div class="container">
                    <h2>No posts</h2>
                </div>';
       }

       mysqli_close($conn);
    
    ?>

</main>

<?php include 'includes/footer.inc.php'; ?>