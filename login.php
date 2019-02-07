<?php 

include 'includes/header.inc.php'; 

if (isset($_SESSION['is_auth']) && $_SESSION['is_auth'] == true) {
    header("Location: index.php");
    exit();
}

?>

<main>
    <div class="container">
        <form action="includes/login.inc.php" method="post" class="w-50 p-3 mx-auto mt-5">
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp"
                    placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Password">
            </div>

            <?php 
                if (isset($_SESSION['e_login'])) {
                    echo '<div class="text-danger pb-3">'.$_SESSION['e_login'].'</div>';
                    unset($_SESSION['e_login']);
                }
            ?>

            <button type="submit" class="btn btn-primary" name="login_submit">Submit</button>
        </form>
    </div>

</main>

<?php include 'includes/footer.inc.php'; ?>