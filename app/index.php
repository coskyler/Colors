<?php
$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

define('ROOT', realpath(__DIR__));

switch ($uri) {
    case '':
        require ROOT . '/html/Home.html';
        break;
    case 'login':
        require ROOT . '/LAMPAPIS/Login.php';
        break;
    case 'register':
        require ROOT . '/LAMPAPIS/SignUp.php';
        break;
	case 'colors':
        require ROOT . '/LAMPAPIS/SearchColors.php';
        break;
	case 'demo':
		header("Location: https://drive.google.com/file/d/1qDgd2E41RBCU5JQGQyozd-8VdvKBpV79/view");
		exit;
    default:
        http_response_code(404);
        echo "Page not found";
}