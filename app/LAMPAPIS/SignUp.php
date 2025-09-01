<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Load the sign up page
    echo '<!DOCTYPE html>
    <html>
    <head>
        <title>Sign Up</title>
        <link rel="stylesheet" href="/css/Login.css">
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
                    <a class="noacc" href="/LAMPAPIS/Login.php">
                        Already have an account? Log in
                    </a>
                </form>
            </div>
        </div>
    </body>
    </html>';
}
?>
