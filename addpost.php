<?php

include 'includes/header.inc.php';

if (!isset($_SESSION['is_auth'])) {
    header("Location: index.php");
    exit();
}
?>

<main>
    <div class="container">
        <form action="includes/addpost.inc.php" method="post">
            <div class="form-group">
                <label for="postTitle">Post Title</label>
                <input type="text" name="post_title" class="form-control" id="postTitle" placeholder="Post Title">
            </div>
            <div class="form-group">
                <label for="textarea">Post Text</label>
                <textarea name="post_body" class="form-control" id="textarea" rows="12"></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="post_submit">Submit</button>
        </form>
    </div>
</main>


<?php include 'includes/footer.inc.php';?>