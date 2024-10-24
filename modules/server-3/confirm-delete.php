<?php
require 'db_con.php';

if (isset($_GET['feed_id'])) {
    $feed_id = $_GET['feed_id'];
} else {
    exit();
}

$sql = "
DELETE FROM cmt_likes WHERE cmt_id IN (SELECT id FROM comments WHERE cmt_to = $feed_id);
DELETE FROM likes WHERE post_id = $feed_id;
DELETE FROM comments WHERE cmt_to = $feed_id;
DELETE FROM posts WHERE id = $feed_id;
";

if ($conn->multi_query($sql)) {
    do {
        if ($result = $conn->store_result()) {
            $result->free();
        }

        // Check for errors
        if ($conn->errno) {
            die("Query error: " . $conn->error);
        }
    } while ($conn->next_result());

    echo "succeed";
} else {
    die("Multi-query error: " . $conn->error);
}

$conn->close();

