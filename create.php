<?php
include 'connection_to_db.php';
$post = $_POST['comment'];
$author = $_POST['usrname'];
$title = $_POST['title'];

$alert = "Both name and comment must be entered.";

if(isset($_POST['newPost'])){
    if(!empty($author) && !empty($post) && !empty($title)) {
        try {
            $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO posts (author, title, body, created_at)
            VALUES ('$author', '$title', '$post', NOW())";
            $connection->exec($sql);
            header('Location: index.php');
            }
        catch(PDOException $e)
            {
            echo $sql . "<br>" . $e->getMessage();
            }
        
        $connection = null;
        
    } else {
        header('Location: create-post.php?error=1');
    }
    
} 
?>