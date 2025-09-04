<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Method Not Allowed
    header('Allow: POST');
    exit;
}

require_once('../db.php');
require_once __DIR__ . '/../cookie.php';

$userId = checkAuthCookie();

if($userId === null) {
    header("Location: /LAMPAPIS/Login.php");
    exit;
}

$colorName  = trim($_POST['colorName'] ?? '');
$red        = trim($_POST['r'] ?? '');
$green      = trim($_POST['g'] ?? '');
$blue       = trim($_POST['b'] ?? '');

// validate name
if ($colorName === '' || strlen($colorName) > 63) {
    http_response_code(400);
    echo "Invalid color name";
    exit;
}

// validate rgb
foreach (['r' => $red, 'g' => $green, 'b' => $blue] as $key => $val) {
    if (!ctype_digit($val) || (int)$val < 0 || (int)$val > 255) {
        http_response_code(400);
        echo "Invalid $key value";
        exit;
    }
}

// convert to int
$red   = (int)$red;
$green = (int)$green;
$blue  = (int)$blue;


try {
    $pdo = db();

    $stmt = $pdo->prepare(
        "INSERT INTO Colors (name, user_id, r, g, b)
            VALUES (:n, :u, :r, :g, :b)"
    );
    $stmt->execute([':n'=>$colorName, ':u'=>$userId, ':r'=>$red, ':g'=>$green, ':b'=>$blue]);
} catch(PDOException $e) {
    error_log($e->getMessage());
    http_response_code(500);
    echo "Database error";
    exit;
}

?>