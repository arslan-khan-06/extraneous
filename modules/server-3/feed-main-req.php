<?php
session_start();


$req_post = $_GET['req_post'];
$_SESSION['req_post'] = $req_post;

header('Location: ../../community/feed-main');
?>
