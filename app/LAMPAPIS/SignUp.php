<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    include $_SERVER['DOCUMENT_ROOT'] . "/html/SignUp.html";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first  = trim($_POST['first_name'] ?? '');
    $last   = trim($_POST['last_name'] ?? '');
    $user   = trim($_POST['username'] ?? '');
    $pass   = $_POST['password'] ?? '';
    $verify = $_POST['verify_password'] ?? '';

    // Check for empty fields
    if ($first === '' || $last === '' || $user === '' || $pass === '' || $verify === '') {
        echo "All fields are required";
        exit;
    }

    // Check username length
    if (strlen($user) < 3) {
        echo "Username must be at least 3 characters";
        exit;
    }

    // Check password length
    if (strlen($pass) < 8) {
        echo "Password must be at least 8 characters";
        exit;
    }

    // Check password match
    if ($pass !== $verify) {
        echo "Passwords do not match";
        exit;
    }

    // If valid, continue (for now just echo)
    echo "OK";
}
?>
