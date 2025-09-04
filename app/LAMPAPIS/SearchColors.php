<?php
require_once __DIR__ . '/../cookie.php';
require_once('../db.php');

header('Cache-Control: no-store');

$userId = checkAuthCookie();

if($userId === null) {
    header("Location: /LAMPAPIS/Login.php");
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $row = null;

    try {
        $pdo = db();
        $stmt = $pdo->prepare("SELECT username, first_name, last_name FROM Users WHERE id = ?");
        $stmt->execute([$userId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        error_log($e->getMessage());
        http_response_code(500);
        echo "Database error";
        exit;
    }

    if(!$row) {
        header("Location: /LAMPAPIS/Login.php");
        exit;
    }

    echo "<script>window.userData = " . json_encode($row) . ";</script>";

    include $_SERVER['DOCUMENT_ROOT'] . "/html/MyColors.html";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $search  = trim($_POST['search'] ?? '');

    try {
        $pdo = db();
        $stmt = $pdo->prepare("SELECT name, r, g, b FROM Colors WHERE user_id = ? AND name LIKE ? ORDER BY id DESC LIMIT 50");
        $stmt->execute([$userId, $search . '%']);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        header('Content-Type: application/json');
        echo json_encode($rows);
    } catch(PDOException $e) {
        error_log($e->getMessage());
        http_response_code(500);
        echo "Database error";
        exit;
    }
}
?>