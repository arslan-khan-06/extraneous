<?php
require "db_con.php";
require "ret-data.php";
require "pdo.php";

$stmt = $conn->prepare("SELECT * FROM user_accounts WHERE username = ?");
$stmt->execute([$user_ret]);
$user_b = $stmt->get_result();
$user = mysqli_fetch_all($user_b, MYSQLI_ASSOC);


$claiming = $_GET['claiming'];

if (isset($claiming)) {
    foreach ($user as $user_ach) {
        $lastClaim = strtotime($user_ach['bonus']);
        $currentTime = time();
        $elapsedTime = $currentTime - $lastClaim;

        if ($elapsedTime >= 28800 + (24*60*60)) {
            $coins = $user_ach['coins'] + 5;

            $stmt = $conn->prepare("UPDATE user_accounts SET bonus = CURRENT_TIMESTAMP, coins = ? WHERE username = ?");
            $stmt->execute([$coins, $user_ret]);
            $claimed = 'Recieved 5 coins';
            $_SESSION['recieved'] = $claimed;
            header('Location: ../../community/home');
        }
    }
} else {
    header('Location: ../../community/home');
}
