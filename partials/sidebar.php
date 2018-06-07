<?php

$sql = "SELECT id, title FROM posts ORDER BY created_at ASC";
         $statement = $connection->prepare($sql);

         // izvrsavamo upit
         $statement->execute();

         // zelimo da se rezultat vrati kao asocijativni niz.
         // ukoliko izostavimo ovu liniju, vratice nam se obican, numerisan niz
         $statement->setFetchMode(PDO::FETCH_ASSOC);

         // punimo promenjivu sa rezultatom upita
         $posts = $statement->fetchAll();

?>
        <aside class="col-sm-3 ml-sm-auto blog-sidebar">
            <div class="sidebar-module sidebar-module-inset">
                <h4>Latest posts</h4>
                <?php
                foreach ($posts as $post) {
                ?>

                    <a href='single-post.php?id=<?php echo $post['id'] ?>'>
                    <?php echo($post['title']); echo "<br>"; ?></a>
                
                <?php
                }
                ?>
            </div>
            <div class="sidebar-module">
                <!-- ovde je bio Archives -->
            </div>
            <div class="sidebar-module">
                <!-- ovde je bio Elsewhere -->
            </div>
        </aside><!-- /.blog-sidebar -->