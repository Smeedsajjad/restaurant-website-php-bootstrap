<?php
session_start();
require_once './php/UserController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Assuming a `UserController` method for login verification
    $userController = new UserController();
    $user = $userController->login($email, $password);

    if ($user) {
        // Store user information in session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        // Redirect to home
        header("Location: index.php?page=home");
        exit();
    } else {
        echo "Login failed. Please check your credentials.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/shop/css/login.css">
    <!-- bootstrap -->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.2/css/all.css">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Login</title>
</head>

<body style="background-image: url(assets/shop/images/bg_login.png);">

    <div class="container bg-white d-flex justify-content-center align-items-center shadow-lg mt-5 p-4" style="max-width: 500px;">
        <div class="row w-100">
            <div class="col-12">
                <div class="text-center mb-4">
                    <img src="./assets/shop/images/lc.png" alt="Logo" style="width: 80px;">
                    <h2 class="fw-bold mt-2">Login to Your Account</h2>
                </div>
                <form method="post" action="index.php?page=login" class="needs-validation" id="loginForm" novalidate>
                    <!-- Email -->
                    <div class="mb-3">
                        <label for="validationEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="validationEmail" name="email" required>
                        <div class="invalid-feedback">Please enter a valid email address.</div>
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="validationPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="validationPassword" name="password" required>
                        <div class="invalid-feedback">Please enter your password.</div>
                    </div>

                    <!-- Remember Me and Forgot Password -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="rememberMe">
                            <label class="form-check-label" for="rememberMe">Remember me</label>
                        </div>
                        <a href="#" class="text-decoration-none">Forgot password?</a>
                    </div>
                    <div id="response"></div>
                    <!-- Submit Button -->
                    <div class="d-grid">
                        <button class="btn btn-primary fw-semibold" type="submit">Login</button>
                    </div>
                </form>
                <hr>
                <div class="text-center">
                    <p>Don’t have an account? <a href="index.php?page=signup" class="text-decoration-none">Sign Up</a></p>
                </div>
            </div>
        </div>
    </div>

   
    <script>
        (() => {
            'use strict';

            // Fetch all forms we want to apply custom validation styles to
            const forms = document.querySelectorAll('.needs-validation');

            // Loop over them and prevent submission if invalid
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();
    </script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
