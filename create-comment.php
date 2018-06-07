<?php
include 'connection_to_db.php';
$postId = $_POST['postId'];
$author = $_POST['usrname'];
$comment = $_POST['comment'];

$alert = "Both name and comment must be entered.";

if(isset($_POST['btn'])){
    if(empty($author) || empty($comment)) {
        header('Location: single-post.php?id=' . $postId . '&error=1');
        
    } else {
        try {
            $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO comments (author, tekst, post_id)
            VALUES ('$author', '$comment', $postId)";
            $connection->exec($sql);
            echo "New comment created successfully";
            header('Location: single-post.php?id=' . $postId);
            }
        catch(PDOException $e)
            {
            echo $sql . "<br>" . $e->getMessage();
            }
        
        $connection = null;

        
        
    }
} 
?>