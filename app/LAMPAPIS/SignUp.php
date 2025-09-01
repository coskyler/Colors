<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Load the sign up page
    echo '<!DOCTYPE html>
    <html>
    <head>
        <title>Sign Up</title>
        <link rel="stylesheet" href="/css/Login.css">
        <script src="/js/SignUp.js"></script>
    </head>
    <body>
        <div class="container">
            <!-- Left side -->
            <div class="left">
                <div class="left-header">
                    <h1>Colors</h1>
                    <p class="subtitle">The best place to manage all your colors</p>
                    <a class="github" href="https://github.com/coskyler/Colors" target="_blank">
                        GitHub link
                    </a>
                </div>
            </div>

            <!-- Right side -->
            <div class="right">
                <form method="POST" action="/LAMPAPIS/SignUp.php" class="form">
                    <h1>Sign Up</h1>
                    <input type="text" name="first_name" placeholder="First Name" required>
                    <input type="text" name="last_name" placeholder="Last Name" required>
                    <input type="text" name="username" placeholder="Username" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <input type="password" name="verify_password" placeholder="Verify Password" required>
                    <button type="submit">Sign Up</button>
                    <p class="error"> </p>
                    <a class="noacc" href="/LAMPAPIS/Login.php">
                        Already have an account? Log in
                    </a>
                </form>
            </div>
        </div>
    </body>
    </html>';
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
