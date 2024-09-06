<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Signup</title>
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
    <link rel="stylesheet" href="../assets/bootstrap-5.3.3-dist/css/bootstrap.min.css">

</head>

<body>
<?php include './partials/preloader.php' ?>

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <div class="text-center mb-3">
                                        <a href="index.php"><img src="./assets/images/logo-full.png" alt=""></a>
                                    </div>
                                    <h4 class="text-center mb-4">Sign up your account</h4>
                                    <form id="singupForm">
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Username</strong></label>
                                            <input name="username" type="text" class="form-control" placeholder="username">
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Email</strong></label>
                                            <input name="email" type="email" class="form-control" value="admin@example.com" placeholder="hello@example.com">
                                        </div>
                                        <div class="form-group position-relative">
                                            <label class="mb-1"><strong>Password</strong></label>
                                            <input name="password" type="password" id="dz-password" class="form-control" value="12345678">
                                            <span class="show-pass eye">

                                                <i class="fa fa-eye-slash"></i>
                                                <i class="fa fa-eye"></i>

                                            </span>
                                        </div>
                                        <div class="text-center mt-4">
                                            <button type="submit" class="btn btn-primary btn-block">Sign me up</button>
                                        </div>
                                    </form>
                                    <div class="new-account mt-3">
                                        <p>Already have an account? <a class="text-primary" href="page-login.html">Sign in</a></p>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>

document.getElementById('singupForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch('php/register.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            if (data.success) {
                window.location.href = './login.php';
            }
        })
        .catch(error => console.error('Error:', error));
});


    </script>
    <script src="../assets/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>

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