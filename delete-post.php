<?php

include 'connection_to_db.php';

$postId = $_POST['postId'];

if(isset($_POST['delPost'])){
    try {
        $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM posts WHERE id = $postId";
        $connection->exec($sql);
        header('Location: index.php');
        }
    catch(PDOException $e)
        {
        echo $sql . "<br>" . $e->getMessage();
        }
    
    $connection = null;
}

?>