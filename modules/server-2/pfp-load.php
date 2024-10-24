<?php
require "ret-data.php";
$host = 'localhost';
$database = 'extraneous';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("SELECT profile FROM user_accounts WHERE username = ?");
    $stmt->execute([$user_ret]);
    $row = $stmt->fetch();
    if ($row) {
        $imageFilename = $row['profile'];
        $imagePath = '../media/profiles/' . $imageFilename;
    }
} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}
?>