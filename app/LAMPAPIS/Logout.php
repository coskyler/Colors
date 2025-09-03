<?php
require_once __DIR__ . '/../cookie.php';

deleteAuthCookie();

header("Location: /");
exit;
?>