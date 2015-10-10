<?php
/**
 * Project: blog
 * File: index.php
 * User: eikood
 * Date: 10.10.15
 * Time: 22:30
 */
//include config
require_once('../includes/config.php');
//if not logged in redirect to login page
if (!$user->is_logged_in()) {
    header('Location: login.php');
}
//show message from add / edit page
if (isset($_GET['delpost'])) {
    $stmt = $db->prepare('DELETE FROM blog_posts WHERE postID = :postID');
    $stmt->execute(array(':postID' => $_GET['delpost']));
    header('Location: index.php?action=deleted');
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Admin</title>
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/main.css">
    <script language="JavaScript" type="text/javascript" src="../js/utils.js"></script>
</head>
<body>

<div id="wrapper">

    <?php include('menu.php'); ?>

    <?php
    //show message from add / edit page
    if (isset($_GET['action'])) {
        echo '<h3>Post ' . $_GET['action'] . '.</h3>';
    }
    ?>
    <table>
        <tr>
            <th>Title</th>
            <th>Date</th>
            <th>Action</th>
        </tr>

        <?php
        try {
            $stmt = $db->query('SELECT postID, postTitle, postDate FROM blog_posts ORDER BY postID DESC');
            while ($row = $stmt->fetch()) {
                ?>
                <tr>
                    <td><?= $row['postTitle'] ?></td>
                    <td><?= date('jS M Y', strtotime($row['postDate'])) ?></td>

                    <td>
                        <a href="edit-post.php?id=<?= $row['postID'] ?>">Edit</a>
                        <a href="javascript:delpost('<?= $row['postID'] ?>','<?= $row['postTitle']?>')">Delete</a>
                    </td>
                </tr>

                <?php
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        ?>
    </table>
    <p><a href='add-post.php'>Add Post</a></p>

</div>

</body>
</html>
