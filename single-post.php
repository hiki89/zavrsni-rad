<?php include 'partials/header.php';?>
<?php include 'connection_to_db.php'; ?>
<?php
$post_id = $_GET['id'];

if (!empty($_GET['error'])) {
    $error = true;
}

$sql = "SELECT posts.id AS pId, posts.title, posts.body, posts.author, posts.created_at,
comments.id, comments.post_id, comments.author AS comm_author,
comments.tekst FROM posts INNER JOIN comments ON posts.id = 
comments.post_id WHERE posts.id = $post_id";
$statement = $connection->prepare($sql);
$statement->execute();
$statement->setFetchMode(PDO::FETCH_ASSOC);
$postWithComments = $statement->fetchAll(); 

$post = $postWithComments[0];
$comments = [];
foreach($postWithComments as $comment) {
    array_push($comments, ['author' => $comment['comm_author'], 'text' => $comment['tekst']]);
}

?>

<main role="main" class="container">

    <div class="row">

        <div class="col-sm-8 blog-main">

            <div class="blog-post">
               
                <h2 class="blog-post-title">
                <?php echo($post['title']) ?></h2>
                <p class="blog-post-meta"><?php echo($post['created_at']) ?> <a href="#"><?php echo($post['author']) ?></a></p>
                <?php echo($post['body']) ?>
                    
            </div>
            <div>
            
                <form action="create-comment.php" method="POST">
                    <input name="postId" type="hidden" value="<?php echo $post_id ?>">
                    <input type="text" name="usrname" placeholder="Your name"></br>
                    <textarea name="comment" rows="4" cols="50" placeholder="Enter comment here"></textarea></br>
                    <button type="submit" name="btn">Submit</button>
                </form>

                <?php if ($error) { ?>
                    <div class="alert alert-danger">All fields are required!</div>
                <?php } ?>
                
            </div>

            
                <button type="button" class="btn" id="button1" onclick="myFunction()">Hide comments</button>
                <script>
                    function myFunction() {
                        var commmentsDiv = document.getElementById("myDIV");
                        var switchButton =  document.getElementById("button1");
                        if (commmentsDiv.style.display === "none") {
                            commmentsDiv.style.display = "block";
                            switchButton.innerHTML = 'Hide Comments';
                        } else {
                            commmentsDiv.style.display = "none";
                            switchButton.innerHTML = 'Show Comments';
                        }
                    }
                    
                </script>
            

            <div class="comment" id="myDIV">
                <?php
                    foreach ($comments as $comm) {
                ?>
                    <ul>
                        <li><?php echo ($comm['text']) ?></li>
                        <li><?php echo ($comm['author']) . "<hr/>"?></li>
                        <!-- <li><form method="post" action="delete-comment.php">
                        <button class="btn btn-default float-right">Delete comment</button></form></li> -->
                    </ul>
                <?php
                }
                ?>
            </div>

            <nav class="blog-pagination">
                <a class="btn btn-outline-primary" href="#">Older</a>
                <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
            </nav>

        </div>

        <?php include 'partials/sidebar.php' ?>

    </div><!-- /.row -->

</main><!-- /.container -->

<?php include 'partials/footer.php'?>