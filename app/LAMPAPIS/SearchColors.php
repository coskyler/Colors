<?php
require_once __DIR__ . '/../cookie.php';

if(checkAuthCookie() === null) {
    header("Location: /LAMPAPIS/Login.php");
    exit;
}

header('Cache-Control: no-store');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    include $_SERVER['DOCUMENT_ROOT'] . "/html/MyColors.html";
}
?>