<?php
require_once __DIR__ . '/../cookie.php';

if(checkAuthCookie() !== null) {
    header("Location: /MyColors.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    include $_SERVER['DOCUMENT_ROOT'] . "/html/Login.html";
}
?>