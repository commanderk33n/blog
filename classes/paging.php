<?php

/**
 * Project: blog
 * File: paging.php
 * User: eikood
 * Date: 11.10.15
 * Time: 02:25
 */
class Paging
{
    private $db;

    function __construct($DB_con)
    {
        $this->db = $DB_con;
    }

    public function dataview($query, $id)
    {
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if ($id == "index") {
                    ?>
                    <div>
                        <h1><a href="viewpost.php?id=<?= $row['postID'] ?>"> <?= $row['postTitle'] ?></a></h1>

                        <p>posted on <?= date('jS M Y H:i:s', strtotime($row['postDate'])) ?></p>

                        <p><?= $row['postDesc'] ?></p>

                        <p><a class="readMore" href="viewpost.php?id=<?= $row['postID'] ?>">Read more</a></p>
                    </div>
                    <?php
                }
                if ($id == "admin") {
                    ?>
                    <tr>
                        <td><?= $row['postTitle'] ?></td>
                        <td><?= date('jS M Y', strtotime($row['postDate'])) ?></td>

                        <td>
                            <a href="edit-post.php?id=<?= $row['postID'] ?>">Edit</a>
                            <a href="javascript:delpost('<?= $row['postID'] ?>','<?= $row['postTitle'] ?>')">Delete</a>
                        </td>
                    </tr>

                    <?php
                }
            }
        } else {
            ?>
            <tr>
                <td>Nothing here...</td>
            </tr>
            <?php
        }

    }

    public function paging($query, $records_per_page)
    {
        $starting_position = 0;
        if (isset($_GET["page_no"])) {
            $starting_position = ($_GET["page_no"] - 1) * $records_per_page;
        }
        $query2 = $query . " limit $starting_position,$records_per_page";
        return $query2;
    }

    public function paginglink($query, $records_per_page)
    {

        $self = $_SERVER['PHP_SELF'];

        $stmt = $this->db->prepare($query);
        $stmt->execute();

        $total_no_of_records = $stmt->rowCount();

        if ($total_no_of_records > 0) {
            ?>
            <tr>
            <td colspan="3"><?php
                $total_no_of_pages = ceil($total_no_of_records / $records_per_page);
                $current_page = 1;
                if (isset($_GET["page_no"])) {
                    $current_page = $_GET["page_no"];
                }
                if ($current_page != 1) {
                    $previous = $current_page - 1;
                    echo "<a href='" . $self . "?page_no=1'>First</a>&nbsp;&nbsp;";
                    echo "<a href='" . $self . "?page_no=" . $previous . "'>Previous</a>&nbsp;&nbsp;";
                }
                for ($i = 1; $i <= $total_no_of_pages; $i++) {
                    if ($i == $current_page) {
                        echo "<strong><a href='" . $self . "?page_no=" . $i . "' style='text-decoration:underline'>" . $i . "</a></strong>&nbsp;&nbsp;";
                    } else {
                        echo "<a href='" . $self . "?page_no=" . $i . "'>" . $i . "</a>&nbsp;&nbsp;";
                    }
                }
                if ($current_page != $total_no_of_pages) {
                    $next = $current_page + 1;
                    echo "<a href='" . $self . "?page_no=" . $next . "'>Next</a>&nbsp;&nbsp;";
                    echo "<a href='" . $self . "?page_no=" . $total_no_of_pages . "'>Last</a>&nbsp;&nbsp;";
                }
                ?></td></tr><?php
        }
    }
}