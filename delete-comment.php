<?php

include 'connection_to_db.php';

$postId = $_POST['postId'];
$commentId = $_POST['commentId'];

if(isset($_POST['delete-button'])){
    try {
        $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM comments WHERE id = $commentId";
        $connection->exec($sql);
        header('Location: single-post.php?id=' . $postId.'&comment_deleted=1');
        }
    catch(PDOException $e)
        {
        echo $sql . "<br>" . $e->getMessage();
        }
    
    $connection = null;
}

?>