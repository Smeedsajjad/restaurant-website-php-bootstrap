    <?php
    session_start(); // Start the session at the beginning of the file

    require_once './php/UserController.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $phone = $_POST['phone'];

        $userController = new UserController();

        // Check if the email is already registered
        if ($userController->checkEmailExists($email)) {
            $_SESSION['email_error'] = "Email is already registered. Please use a different email.";
            header("Location: index.php?page=signup"); // Redirect back to the signup page
            exit; // Stop further processing
        }

        $isRegistered = $userController->register($full_name, $username, $email, $password, $phone);

        if ($isRegistered) {
            header("Location: index.php?page=home");
        } else {
            echo "<p>Registration failed. Please try again.</p>";
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
        <!-- Font Awesome 5 -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <!-- fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
            rel="stylesheet">
        <!-- font-family: "Norican", cursive; -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Norican&display=swap" rel="stylesheet">
        <!-- ajax -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <title>SiginUp</title>
    </head>

    <!-- <body style="background-color: var(--primary_hover);"> -->

    <body style="background-image: url(assets/shop/images/bg_login.png);">

        <div class="container bg-white d-flex justify-content-center align-items-center shadow-lg">
            <div class="row">
                <div class="col-md-6 p-4">
                    <div>
                        <a href="index.php?page=home" class="btn position-absolute rounded-pill" style="top: 1rem;"><svg width="22px"
                                height="22px" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                <polyline points="244 400 100 256 244 112"
                                    style="fill:none;stroke:#000000;stroke-linecap:round;stroke-linejoin:round;stroke-width:48px" />
                                <line x1="120" y1="256" x2="412" y2="256"
                                    style="fill:none;stroke:#000000;stroke-linecap:round;stroke-linejoin:round;stroke-width:48px" />
                            </svg>Back</a>
                    </div>
                    <form method="post" action="index.php?page=signup" class="row g-3 needs-validation" id="signupForm" novalidate>
                        <!-- Full Name -->
                        <div class="col-md-6">
                            <label for="validationFullName" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="validationFullName" name="full_name" required>
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Full Name must be at least 5.</div>
                        </div>

                        <!-- Username -->
                        <div class="col-md-6">
                            <label for="validationUsername" class="form-label">Username</label>
                            <input type="text" class="form-control" id="validationUsername" name="username" required>
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Please enter a username.</div>
                        </div>

                        <!-- Email -->
                        <div class="col-md-6">
                            <label for="validationEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="validationEmail" name="email" required>
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback" id="emailFeedback"></div>
                        </div>

                        <!-- Password -->
                        <div class="col-md-6">
                            <label for="validationPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="validationPassword" name="password" required>
                            <div class="invalid-feedback">Please enter a password.</div>
                        </div>

                        <!-- Phone -->
                        <div class="col-md-6">
                            <label for="validationPhone" class="form-label">Phone</label>
                            <input type="tel" class="form-control" id="validationPhone" name="phone">
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Please enter a valid phone number.</div>
                        </div>

                        <!-- Terms and Conditions -->
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input " type="checkbox" value="" id="termsCheck" required>
                                <label class="form-check-label" for="termsCheck">Agree to terms and conditions</label>
                                <div class="invalid-feedback">You must agree before submitting.</div>
                            </div>
                        </div>
                        <div id="response"></div>
                        <!-- Submit Button -->
                        <div class="col-12">
                            <button class="btn fw-semibold" type="submit">Register</button>
                        </div>
                    </form>

                </div>
                <div class="col-md-6">
                    <div class="p-4">
                        <h2 class="fw-bold">Join Your Restaurant !</h2>
                        <p>As a member, enjoy these exclusive perks:</p>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check-circle text-success me-2"></i>Save your favorite meals</li>
                            <li><i class="fas fa-check-circle text-success me-2"></i>Member-only discounts</li>
                            <li><i class="fas fa-check-circle text-success me-2"></i>Priority delivery service</li>
                            <li><i class="fas fa-check-circle text-success me-2"></i>Order tracking from kitchen to door
                            </li>
                        </ul>
                        <hr>
                        <h4 class="fw-bold">Special Offers</h4>
                        <p>Sign up today and get:</p>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-gift text-danger me-2"></i>20% off your first order</li>
                            <li><i class="fas fa-truck text-primary me-2"></i>Free delivery on orders over $30</li>
                            <li><i class="fas fa-calendar-check text-success me-2"></i>Early access to seasonal offers</li>
                        </ul>
                        <p class="text-muted mt-3"><em>Order your favorite dishes with just a few clicks!</em></p>
                    </div>
                </div>
            </div>
        </div>
        <script>
            (() => {
                'use strict'

                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                const forms = document.querySelectorAll('.needs-validation')

                // Custom validation for full name
                const validateFullName = (input) => {
                    if (input.value.length < 5) {
                        input.setCustomValidity('Full name must be at least 5 characters long.');
                    } else {
                        input.setCustomValidity('');
                    }
                };

                // Custom validation for password
                const validatePassword = (input) => {
                    const passwordPattern = /^(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$/; // At least 8 characters and at least one symbol
                    if (!passwordPattern.test(input.value)) {
                        input.setCustomValidity('Password must be at least 8 characters long and include at least one symbol.');
                    } else {
                        input.setCustomValidity('');
                    }
                };

                // Custom validation for phone number
                const validatePhone = (input) => {
                    const phonePattern = /^\d{11}$/; // 11 digits
                    if (input.value && !phonePattern.test(input.value)) {
                        input.setCustomValidity('Please enter a valid phone number (10 digits).');
                    } else {
                        input.setCustomValidity('');
                    }
                };

                // Loop over them and prevent submission
                Array.from(forms).forEach(form => {
                    form.addEventListener('submit', event => {
                        // Validate full name
                        const fullNameInput = form.querySelector('#validationFullName');
                        validateFullName(fullNameInput);

                        // Validate password
                        const passwordInput = form.querySelector('#validationPassword');
                        validatePassword(passwordInput);

                        // Validate phone number
                        const phoneInput = form.querySelector('#validationPhone');
                        validatePhone(phoneInput);

                        if (!form.checkValidity()) {
                            event.preventDefault();
                            event.stopPropagation();
                        }

                        form.classList.add('was-validated');
                    }, false);
                });
            })();
        </script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#signupForm').on('submit', function(event) {
                    event.preventDefault(); // Prevent the default form submission

                    const email = $('#validationEmail').val();
                    const formData = $(this).serialize(); // Serialize form data

                    // Check if the email exists
                    $.ajax({
                        url: 'php/check_email.php', // URL to the PHP file that checks the email
                        type: 'POST',
                        data: {
                            email: email
                        },
                        dataType: 'json', // Expect a JSON response
                        success: function(response) {
                            console.log(response);
                            if (response.status === 'exists') {
                                $('#emailFeedback').text('Email is already registered. Please use a different email.').show();
                            } else {
                                $('#emailFeedback').text('').hide(); // Clear the message if email is available

                                // If email is available, proceed with form submission
                                $.ajax({
                                    url: 'index.php?page=signup', // URL to submit the form
                                    type: 'POST',
                                    data: formData,
                                    success: function(data) {
                                        // Handle success response (e.g., redirect or show success message)
                                        window.location.href = 'index.php?page=home'; // Redirect to home page
                                    },
                                    error: function() {
                                        // Handle error response
                                        alert('Registration failed. Please try again.');
                                    }
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('AJAX Error:', error);
                            console.error('Response:', xhr.responseText);
                        }
                    });
                });
            });
        </script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>