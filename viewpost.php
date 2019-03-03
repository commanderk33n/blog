<?php
/**
 * Project: blog
 * File: viewpost.php
 * User: commanderk33n
 * Date: 10.10.15
 * Time: 21:50
 */
require('includes/config.php');
$stmt = $db->prepare('SELECT postID, postTitle, postCont, postDate FROM blog_posts WHERE postID = :postID');
$stmt->execute(array(':postID' => $_GET['id']));
$row = $stmt->fetch();

//if post does not exists redirect user.
if ($row['postID'] == '') {
    header('Location: ./');
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>eikood.xyz<?php echo $row['postTitle'] ?></title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>

<div id="wrapper">

    <h1>My scrapbook and other silly crap...</h1>
    <hr/>
    <p><a href="./">back</a></p>

    <div>
        <h1><?= $row['postTitle'] ?></h1>

        <p>Posted on <?= date('jS M Y', strtotime($row['postDate'])) ?> </p>

        <p><?= $row['postCont'] ?></p>
    </div>
</div>
<footer class="footer">
    <p>&copy; commanderk33n 2019 - proudly made without any framework</p>
</footer>


</body>
</html>