<?php
/**
 * Project: blog
 * File: index.php
 * User: eikood
 * Date: 10.10.15
 * Time: 21:30
 */

require('includes/config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Blog</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>

<div id="wrapper">

    <h1>eikood's Blog</h1>
    <hr/>

    <?php
    try {

        $stmt = $db->query('SELECT postID, postTitle, postDesc, postDate FROM blog_posts ORDER BY postID DESC');
        while ($row = $stmt->fetch()) {
            ?>

            <div>
                <h1><a href="viewpost.php?id=<?= $row['postID'] ?>"> <?= $row['postTitle'] ?></a></h1>

                <p>Posted on <?= date('jS M Y H:i:s', strtotime($row['postDate'])) ?></p>

                <p><?= $row['postDesc'] ?></p>

                <p><a href="viewpost.php?id=<?= $row['postID'] ?>">Read More</a></p>
            </div>
            <?php

        }

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    ?>

</div>


</body>
</html>