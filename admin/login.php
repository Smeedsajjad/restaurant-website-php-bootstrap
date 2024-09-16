<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <meta property="og:image" content="assets/images/social-image.png" />
    <meta name="format-detection" content="telephone=no" />

    <!-- Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Favicon icon -->
    <link rel="stylesheet" href="./assets/styles/nav/flaticon-1.css">
    <link rel="icon" type="image/png" href="assets/images/favicon.png" />
    <link href="assets/styles/nav/bootstrap-select.min.css" rel="stylesheet" />
    <link href="assets/styles/nav/style.css" rel="stylesheet" />
    <link href="assets/styles/nav/LineIcons.css" rel="stylesheet" />

</head>

<body>

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <?php
    // include './partials/preloader.php'; 
    ?>

    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <div class="text-center mb-3">
                                        <a href="index.html"><img src="./assets/images/logo-full.png" alt=""></a>
                                    </div>
                                    <h4 class="text-center mb-4">Sign in your account</h4>
                                    <form action="./php/login.php" method="post">
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Email</strong></label>
                                            <input name="email" type="email" class="form-control" required>
                                        </div>
                                        <div class="form-group position-relative">
                                            <label class="mb-1"><strong>Password</strong></label>
                                            <input name="password" type="password" class="form-control" required>
                                        </div>
                                        <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                            <div class="form-group">
                                                <div class="form-check custom-checkbox ms-1">
                                                    <input type="checkbox" class="form-check-input" name="remember_me" id="remember_me">
                                                    <label class="custom-control-label" for="remember_me">Remember my preference</label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <a href="/">Forgot Password?</a>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block">Sign Me In</button>
                                        </div>
                                    </form>
                                    <div class="new-account mt-3">
                                        <p>Don't have an account? <a class="text-primary" href="./singup.php">Sign up</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->
   
    <!--**********************************
        Scripts
    ***********************************-->

    <!-- Required vendors -->

    <script src="assets/js/nav/global.min.js"></script>
    <script src="assets/js/nav/bootstrap-select.min.js"></script>
    <script src="assets/js/nav/chart.bundle.min.js"></script>
    <script src="assets/js/nav/custom.min.js"></script>
    <script src="assets/js/nav/deznav-init.js"></script>

    <!-- Apex Chart -->
    <script src="assets/js/nav/apexchart.js"></script>

    <!-- Dashboard 1 -->
    <script src="assets/js/nav/dashboard-1.js"></script>
</body>

</html>