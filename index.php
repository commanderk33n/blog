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
    <title>eikood.xyz</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>

<div id="wrapper">

    <h1>My scrapbook and other silly crap...</h1>
    <hr/>

    <?php
    $query = "SELECT postID, postTitle, postDesc, postDate FROM blog_posts ORDER BY postID";
    $records_per_page=5;
    $newquery = $paging->paging($query,$records_per_page);
    $paging->dataview($newquery, "index");
    $paging->paginglink($query,$records_per_page);
    ?>

</div>
<footer class="footer">
    <p>&copy; eikood 2015 - proudly made without any framework</p>
</footer>


</body>
</html>