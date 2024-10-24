<?php
require "../../modules/server-1/db_con.php";
require "ret-data.php";

if (isset($_POST['image'])) {
    $imageData = $_POST['image'];

    $imageData = str_replace('data:image/png;base64,', '', $imageData);
    $imageData = str_replace(' ', '+', $imageData);

    $imageDecoded = base64_decode($imageData);

    $filename = uniqid() . '.png';

    $filePath = '../../media/profiles/' . $filename;

    file_put_contents($filePath, $imageDecoded);


    require "pdo.php";

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("SELECT profile FROM user_accounts WHERE username = ?");
        $stmt->execute([$user_ret]);
        $row = $stmt->fetch();
        if ($row) {
            $oldImage = $row['profile'];
            $oldImagePath = '../../media/profiles/' . $oldImage;
            
            if (file_exists($oldImagePath)) {
                if ($oldImagePath != '../../media/profiles/profile.svg') {
                    unlink($oldImagePath);
                }
            }
        }

        $stmt = $pdo->prepare("UPDATE user_accounts SET profile = ? WHERE username = ?");
        $stmt->execute([$filename, $user_ret]);

        echo 'Image uploaded and inserted into the row where username is Alex. Older image deleted if it existed.';
    } catch (PDOException $e) {
        die('Database connection failed: ' . $e->getMessage());
    }
}
?>
