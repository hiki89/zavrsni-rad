<?php
include 'connection_to_db.php';
include 'partials/header.php';
//$postId = $_POST['postId'];
?>
<main role="main" class="container">

<div class="row">

    <div class="col-sm-8 blog-main">

        <div class="blog-post">

        <form action="create.php" method="POST">
            <input type="text" name="title" placeholder="Title">
            <input type="text" name="usrname" placeholder="Your name"></br>
            <textarea name="comment" rows="4" cols="50" placeholder="Enter your post here"></textarea></br>
            <button type="submit" name="newPost">Submit</button>
        </form>

        <?php if (!empty($_GET['error'])) { ?>
            <div class="alert alert-danger">All fields are required!</div>
        <?php } ?>

        </div><!-- /.blog-post -->

        <nav class="blog-pagination">
            <a class="btn btn-outline-primary" href="#">Older</a>
            <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
        </nav>

    </div><!-- /.blog-main -->

    <?php include 'partials/sidebar.php' ?>

</div><!-- /.row -->

</main><!-- /.container -->

<?php
include 'partials/footer.php';
?>