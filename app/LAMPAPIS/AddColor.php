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

$colorName  = trim($_POST['name'] ?? '');
$red   = trim($_POST['r'] ?? '') ?: '0';
$green = trim($_POST['g'] ?? '') ?: '0';
$blue  = trim($_POST['b'] ?? '') ?: '0';

// validate name
if ($colorName === '' || strlen($colorName) > 50) {
    http_response_code(400);
    echo "Name cannot be more than 50 characters";
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

echo "OK";

?>