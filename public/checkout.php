<?php
session_start();
require_once 'admin/config/config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php?page=login');
    exit;
}

// Initialize database connection
$database = new Database();
$db = $database->conn;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap -->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.2/css/all.css">
    <!-- Font Awesome 5 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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
    <!-- custom style -->
    <link rel="stylesheet" href="assets/shop/css/style.css">
    <link rel="stylesheet" href="assets/shop/css/navbar.css">
    <title>Checkout</title>
    <style>
        input[type="text"] {
            width: 100%;
            height: 50px;
            padding: 0 15px;
            font-size: 1em;
            border: 1px solid #ddd;
            border-radius: 5px;
            outline: none;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus {
            border-color: var(--primary);
        }


        datalist {
            display: none;
        }

        .text-container {
            position: relative;
        }

        .accordion-button:not(.collapsed) {
            background-color: #ffc2224d !important;
        }

        .form-check-input:checked {
            background-color: var(--primary) !important;
            border-color: var(--primary) !important;
        }

        .dropdown-menu>li {
            padding-left: 10px;
            cursor: pointer;
        }

        .selectBox {
            position: relative;
        }

        .search-box {
            width: 100%;
            padding: 10px;
            border: none;
            border-bottom: 1px solid #ccc;
            outline: none;
            font-size: 16px;
        }

        .center-text {
            text-align: center;
            color: green;
        }


        .options {
            list-style: none;
            padding: 0;
            max-height: 250px;
            overflow-y: auto;
            border-bottom: 1px solid #ccc;
        }

        .options li {
            padding: 10px;
            cursor: pointer;
        }

        .options li:hover {
            background-color: #f0f0f0;
        }

        .selected-option {
            padding: 10px;
            cursor: pointer;
        }

        #clear-button {
            background-color: #ff6347;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        #clear-button:hover {
            background-color: #ff0000;
        }
    </style>
</head>

<body>
    <div class="loader-bg">
        <div class="loader"></div>
    </div>
    <!-- header -->
    <?php include  './includes/header.php'; ?>
    <!-- navbar -->
    <?php include  './includes/nav.php'; ?>
    <!-- cartSlider -->
    <?php include  './includes/cartSlider.php'; ?>
    <!-- Hero section -->
    <section class="op_hero_section" style="margin-bottom: 15vh;background-image: url(./assets/shop/images/breadcrumb1.jpg);">
        <div class="container-fluid">
            <h1 class="opht d-flex justify-content-center text-center">Checkout</h1>
            <div>
                <nav class="d-flex justify-content-center test-center"
                    style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#" class="text-muted">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="#" class="text-dark">Checkout</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <main>
        <div class="container">
            <form id="checkout-form" class="needs-validation" novalidate>
                <div class="row">
                    <div class="col-md-7">
                        <!-- Billing Details -->
                        <h2 class="mb-4">Billing Details</h2>
                        <div class="row g-3">
                            <!-- First Name -->
                            <div class="col-md-6">
                                <label for="firstName" class="form-label">First name <span class="text-danger">* </span></label>
                                <input type="text" class="form-control" id="firstName" name="firstName" required>
                                <div class="invalid-feedback">Please enter your first name.</div>
                            </div>

                            <!-- Last Name -->
                            <div class="col-md-6">
                                <label for="lastName" class="form-label">Last name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="lastName" name="lastName" required>
                                <div class="invalid-feedback">Please enter your last name.</div>
                            </div>
                            <!-- Country -->

                            <div class="col-12">
                                <div class="text-container">
                                    <select name="country" class="form-select" aria-label="Default select example" id="country" required>
                                        <option value="">Select your country</option>
                                        <option value="afghanistan">Afghanistan</option>
                                        <option value="albania">Albania</option>
                                        <option value="algeria">Algeria</option>
                                        <option value="andorra">Andorra</option>
                                        <option value="angola">Angola</option>
                                        <option value="antigua-and-barbuda">
                                            Antigua and Barbuda
                                        </option>
                                        <option value="argentina">Argentina</option>
                                        <option value="armenia">Armenia</option>
                                        <option value="australia">Australia</option>
                                        <option value="austria">Austria</option>
                                        <option value="azerbaijan">Azerbaijan</option>
                                        <option value="bahamas">Bahamas</option>
                                        <option value="bahrain">Bahrain</option>
                                        <option value="bangladesh">Bangladesh</option>
                                        <option value="barbados">Barbados</option>
                                        <option value="belarus">Belarus</option>
                                        <option value="belgium">Belgium</option>
                                        <option value="belize">Belize</option>
                                        <option value="benin">Benin</option>
                                        <option value="bhutan">Bhutan</option>
                                        <option value="bolivia">Bolivia</option>
                                        <option value="bosnia-and-herzegovina">
                                            Bosnia and Herzegovina
                                        </option>
                                        <option value="botswana">Botswana</option>
                                        <option value="brazil">Brazil</option>
                                        <option value="brunei">Brunei</option>
                                        <option value="bulgaria">Bulgaria</option>
                                        <option value="burkina-faso">Burkina Faso</option>
                                        <option value="burundi">Burundi</option>
                                        <option value="cabo-verde">Cabo Verde</option>
                                        <option value="cambodia">Cambodia</option>
                                        <option value="cameroon">Cameroon</option>
                                        <option value="canada">Canada</option>
                                        <option value="central-african-republic">
                                            Central African Republic
                                        </option>
                                        <option value="chad">Chad</option>
                                        <option value="chile">Chile</option>
                                        <option value="china">China</option>
                                        <option value="colombia">Colombia</option>
                                        <option value="comoros">Comoros</option>
                                        <option value="congo-brazzaville">
                                            Congo (Brazzaville)
                                        </option>
                                        <option value="congo-kinshasa">
                                            Congo (Kinshasa)
                                        </option>
                                        <option value="costa-rica">Costa Rica</option>
                                        <option value="croatia">Croatia</option>
                                        <option value="cuba">Cuba</option>
                                        <option value="cyprus">Cyprus</option>
                                        <option value="czech-republic">
                                            Czech Republic
                                        </option>
                                        <option value="denmark">Denmark</option>
                                        <option value="djibouti">Djibouti</option>
                                        <option value="dominica">Dominica</option>
                                        <option value="dominican-republic">
                                            Dominican Republic
                                        </option>
                                        <option value="east-timor">East Timor</option>
                                        <option value="ecuador">Ecuador</option>
                                        <option value="egypt">Egypt</option>
                                        <option value="el-salvador">El Salvador</option>
                                        <option value="equatorial-guinea">
                                            Equatorial Guinea
                                        </option>
                                        <option value="eritrea">Eritrea</option>
                                        <option value="estonia">Estonia</option>
                                        <option value="eswatini">Eswatini</option>
                                        <option value="ethiopia">Ethiopia</option>
                                        <option value="fiji">Fiji</option>
                                        <option value="finland">Finland</option>
                                        <option value="france">France</option>
                                        <option value="gabon">Gabon</option>
                                        <option value="gambia">Gambia</option>
                                        <option value="georgia">Georgia</option>
                                        <option value="germany">Germany</option>
                                        <option value="ghana">Ghana</option>
                                        <option value="greece">Greece</option>
                                        <option value="grenada">Grenada</option>
                                        <option value="guatemala">Guatemala</option>
                                        <option value="guinea">Guinea</option>
                                        <option value="guinea-bissau">Guinea-Bissau</option>
                                        <option value="guyana">Guyana</option>
                                        <option value="haiti">Haiti</option>
                                        <option value="honduras">Honduras</option>
                                        <option value="hungary">Hungary</option>
                                        <option value="iceland">Iceland</option>
                                        <option value="india">India</option>
                                        <option value="indonesia">Indonesia</option>
                                        <option value="iran">Iran</option>
                                        <option value="iraq">Iraq</option>
                                        <option value="ireland">Ireland</option>
                                        <option value="israel">Israel</option>
                                        <option value="italy">Italy</option>
                                        <option value="ivory-coast">Ivory Coast</option>
                                        <option value="jamaica">Jamaica</option>
                                        <option value="japan">Japan</option>
                                        <option value="jordan">Jordan</option>
                                        <option value="kazakhstan">Kazakhstan</option>
                                        <option value="kenya">Kenya</option>
                                        <option value="kiribati">Kiribati</option>
                                        <option value="kosovo">Kosovo</option>
                                        <option value="kuwait">Kuwait</option>
                                        <option value="kyrgyzstan">Kyrgyzstan</option>
                                        <option value="laos">Laos</option>
                                        <option value="latvia">Latvia</option>
                                        <option value="lebanon">Lebanon</option>
                                        <option value="lesotho">Lesotho</option>
                                        <option value="liberia">Liberia</option>
                                        <option value="libya">Libya</option>
                                        <option value="liechtenstein">Liechtenstein</option>
                                        <option value="lithuania">Lithuania</option>
                                        <option value="luxembourg">Luxembourg</option>
                                        <option value="north-macedonia">North Macedonia</option>
                                        <option value="madagascar">Madagascar</option>
                                        <option value="malawi">Malawi</option>
                                        <option value="malaysia">Malaysia</option>
                                        <option value="maldives">Maldives</option>
                                        <option value="mali">Mali</option>
                                        <option value="malta">Malta</option>
                                        <option value="marshall-islands">Marshall Islands</option>
                                        <option value="mauritania">Mauritania</option>
                                        <option value="mauritius">Mauritius</option>
                                        <option value="mexico">Mexico</option>
                                        <option value="micronesia">Micronesia</option>
                                        <option value="moldova">Moldova</option>
                                        <option value="monaco">Monaco</option>
                                        <option value="mongolia">Mongolia</option>
                                        <option value="montenegro">Montenegro</option>
                                        <option value="morocco">Morocco</option>
                                        <option value="mozambique">Mozambique</option>
                                        <option value="myanmar">Myanmar</option>
                                        <option value="namibia">Namibia</option>
                                        <option value="nauru">Nauru</option>
                                        <option value="nepal">Nepal</option>
                                        <option value="netherlands">Netherlands</option>
                                        <option value="new-zealand">New Zealand</option>
                                        <option value="nicaragua">Nicaragua</option>
                                        <option value="niger">Niger</option>
                                        <option value="nigeria">Nigeria</option>
                                        <option value="north-korea">North Korea</option>
                                        <option value="norway">Norway</option>
                                        <option value="oman">Oman</option>
                                        <option value="pakistan">Pakistan</option>
                                        <option value="palau">Palau</option>
                                        <option value="palestine">Palestine</option>
                                        <option value="panama">Panama</option>
                                        <option value="papua-new-guinea">Papua New Guinea</option>
                                        <option value="paraguay">Paraguay</option>
                                        <option value="peru">Peru</option>
                                        <option value="philippines">Philippines</option>
                                        <option value="poland">Poland</option>
                                </div>
                            </div>

                            <!-- Street Address -->
                            <div class="col-12">
                                <label for="address" class="form-label">Street address <span class="text-danger">*</span></label>
                                <input type="text" class="form-control mb-3" id="address" name="address" placeholder="House number and street name" required>
                                <input type="text" class="form-control" id="address2" name="address2" placeholder="Apartment, suite, unit, etc. (optional)">
                                <div class="invalid-feedback">Please enter your street address.</div>
                            </div>

                            <!-- Town/City -->
                            <div class="col-md-6">
                                <label for="city" class="form-label">Town / City <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="city" name="city" required>
                                <div class="invalid-feedback">Please enter your town/city.</div>
                            </div>

                            <!-- County -->
                            <div class="col-md-6">
                                <label for="county" class="form-label">County (optional)</label>
                                <input type="text" class="form-control" id="county" name="county">
                            </div>

                            <!-- Postcode -->
                            <div class="col-md-6">
                                <label for="postcode" class="form-label">Postcode <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="postcode" name="postcode" required>
                                <div class="invalid-feedback">Please enter your postcode.</div>
                            </div>

                            <!-- Phone -->
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control" id="phone" name="phone" required>
                                <div class="invalid-feedback">Please enter your phone number.</div>
                            </div>

                            <!-- Email -->
                            <div class="col-12">
                                <label for="email" class="form-label">Email address <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" required>
                                <div class="invalid-feedback">Please enter a valid email address.</div>
                            </div>

                            <!-- Order Notes -->
                            <div class="col-12">
                                <label for="notes" class="form-label">Order notes (optional)</label>
                                <textarea class="form-control" id="notes" name="notes" rows="4" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                            </div>
                        </div>

                    </div>
                    <!-- aside filter -->
                    <div class="col-md-5">
                        <aside>
                            <div class="p-4 border border-muted border-5">
                                <h3 class="card-title mb-4">Your Order</h3>
                                <div class="order-details">
                                    <div class="d-flex justify-content-between mb-3">
                                        <div>
                                            <h6><strong>Product</strong></h6>
                                        </div>
                                        <strong>Subtotal</strong>
                                    </div>
                                    <hr class="my-3">
                                    <?php
                                    require_once 'php/Cart.php';
                                    $cart = new Cart($db);
                                    $cartItems = $cart->getCartItems($_SESSION['user_id']);
                                    $subtotal = 0;

                                    foreach ($cartItems as $item):
                                        $itemTotal = $item['price'] * $item['quantity'];
                                        $subtotal += $itemTotal;
                                    ?>
                                        <div class="d-flex justify-content-between mb-3 mt-4">
                                            <div>
                                                <h6 class="fw-light"><?php echo htmlspecialchars($item['product_name']); ?> × <?php echo $item['quantity']; ?></h6>
                                            </div>
                                            <span class="fw-semibold">£<?php echo number_format($itemTotal, 2); ?></span>
                                        </div>
                                        <hr class="my-3">
                                    <?php endforeach; ?>

                                    <div class="d-flex justify-content-between mb-3">
                                        <strong>Subtotal:</strong>
                                        <span>£<?php echo number_format($subtotal, 2); ?></span>
                                    </div>
                                    <hr class="my-3">
                                    <div class="d-flex justify-content-between mb-3">
                                        <strong>Shipping:</strong>
                                        <span class="text-muted">Enter your address to view shipping options.</span>
                                    </div>
                                    <hr class="my-3">
                                    <div class="d-flex justify-content-between mb-4">
                                        <strong>Total:</strong>
                                        <span class="price fw-bold fs-4" style="line-height: 25px;">£<?php echo number_format($subtotal, 2); ?></span>
                                    </div>

                                    <!-- Payment Methods -->
                                    <div class="accordion" id="paymentAccordion">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#bankTransfer" aria-expanded="true" aria-controls="bankTransfer" onclick="document.getElementById('bank-transfer').checked = true;">
                                                    Direct bank transfer
                                                </button>
                                            </h2>
                                            <div id="bankTransfer" class="accordion-collapse collapse show" data-bs-parent="#paymentAccordion">
                                                <div class="accordion-body">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="payment" id="bank-transfer" checked>
                                                        <label class="form-check-label" for="bank-transfer">
                                                            Direct bank transfer
                                                        </label>
                                                    </div>
                                                    <div class="payment-description text-muted small mt-2">
                                                        Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will not be shipped until the funds have cleared in our account.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#checkPayment" aria-expanded="false" aria-controls="checkPayment" onclick="document.getElementById('check').checked = true;">
                                                    Check payments
                                                </button>
                                            </h2>
                                            <div id="checkPayment" class="accordion-collapse collapse" data-bs-parent="#paymentAccordion">
                                                <div class="accordion-body">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="payment" id="check">
                                                        <label class="form-check-label" for="check">
                                                            Check payments
                                                        </label>
                                                    </div>
                                                    <div class="payment-description text-muted small mt-2">
                                                        Please send a check to our office address. Your order will be processed once the check is cleared.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#cashDelivery" aria-expanded="false" aria-controls="cashDelivery" onclick="document.getElementById('cod').checked = true;">
                                                    Cash on delivery
                                                </button>
                                            </h2>
                                            <div id="cashDelivery" class="accordion-collapse collapse" data-bs-parent="#paymentAccordion">
                                                <div class="accordion-body">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="payment" id="cod">
                                                        <label class="form-check-label" for="cod">
                                                            Cash on delivery
                                                        </label>
                                                    </div>
                                                    <div class="payment-description text-muted small mt-2">
                                                        Pay with cash upon delivery. Available for selected locations only.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#paypalPayment" aria-expanded="false" aria-controls="paypalPayment" onclick="document.getElementById('paypal').checked = true;">
                                                    PayPal
                                                </button>
                                            </h2>
                                            <div id="paypalPayment" class="accordion-collapse collapse" data-bs-parent="#paymentAccordion">
                                                <div class="accordion-body">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="payment" id="paypal">
                                                        <label class="form-check-label" for="paypal">
                                                            <img src="https://imgs.search.brave.com/W9VWE9rWDe1JhgrU52DJ1gri_YWldH9FH-UeUYqFZMk/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly91cGxv/YWQud2lraW1lZGlh/Lm9yZy93aWtpcGVk/aWEvY29tbW9ucy9i/L2I1L1BheVBhbC5z/dmc" alt="PayPal acceptance mark" height="20">
                                                        </label>
                                                    </div>
                                                    <div class="payment-description text-muted small mt-2">
                                                        Pay via PayPal; you can pay with your credit card if you don't have a PayPal account.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="privacy-notice text-muted small mt-4">
                                        Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our privacy policy.
                                    </div>

                                    <button type="submit" class="btn order-now-btn w-100 mt-4">Place order</button>
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>
            </form>

        </div>
        </div>
    </main>
    <!-- footer section -->
    <?php include './includes/footer.php' ?>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- <script src="js/country-select.js"></script> -->
    <script>
        $(document).ready(function() {
            // Open cart slider and load cart items
            $(document).on('click', '[data-bs-toggle="offcanvas"]', function() {
                loadCartItems();
            });

            // Load cart items
            function loadCartItems() {
                $.ajax({
                    url: './php/get_cart_items.php',
                    method: 'GET',
                    success: function(response) {
                        if (response.status === 'success') {
                            let cartHtml = '';
                            let subtotal = 0;
                            response.cart_items.forEach(item => {
                                cartHtml += `
                                    <div class="items d-flex align-items-center border-bottom ms-3 me-3 fw-light">
                                        <i class="fa-regular fa-circle-xmark remove-item" data-cart-id="${item.cart_item_id}"></i>
                                        <img src="admin/${item.images}" class="img-fluid rounded-start" style="width: 80px;">
                                        <span class="card-body d-inline ms-3">
                                            <h5 class="card-title mb-1">${item.name}</h5>
                                            <p>${item.quantity} x <span class="hoverText">$${item.price}</span></p>
                                        </span>
                                    </div>
                                `;
                                subtotal += item.quantity * item.price;
                            });

                            $('#cart-items').html(cartHtml);
                            $('#cart-subtotal').text('$' + subtotal.toFixed(2));
                            $('#empty-message').hide();
                        } else {
                            $('#cart-items').html('<p style="text-align: center;">Your cart is empty.</p>');
                            $('#empty-message').show();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Internal Server Error');
                    }
                });
            }

            // Fetch cart count
            function updateCartCount() {
                $.ajax({
                    url: './php/get_cart_count.php',
                    method: 'GET',
                    success: function(response) {
                        if (response.status === 'success') {
                            $('#cart-count').text(response.count);
                        }
                    }
                });
            }

            updateCartCount(); // Update the cart count on page load
        });
    </script>
    <script>
        $(document).ready(function() {
            // Form validation
            const form = document.getElementById('checkout-form');

            form.addEventListener('submit', function(event) {
                event.preventDefault();

                if (!form.checkValidity()) {
                    event.stopPropagation();
                } else {
                    // Form is valid, collect form data
                    const formData = new FormData(form);
                    const formDataObj = {};
                    formData.forEach((value, key) => {
                        formDataObj[key] = value;
                    });

                    // Here you can send the formDataObj to your server
                    console.log('Form data:', formDataObj);
                    // TODO: Add AJAX call to submit form data
                }

                form.classList.add('was-validated');
            });

            // Phone number validation
            const phoneInput = document.getElementById('phone');
            phoneInput.addEventListener('input', function(e) {
                const phoneNumber = e.target.value.replace(/\D/g, '');
                if (phoneNumber.length < 10) {
                    phoneInput.setCustomValidity('Please enter a valid phone number');
                } else {
                    phoneInput.setCustomValidity('');
                }
            });

            // Email validation
            const emailInput = document.getElementById('email');
            emailInput.addEventListener('input', function(e) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(e.target.value)) {
                    emailInput.setCustomValidity('Please enter a valid email address');
                } else {
                    emailInput.setCustomValidity('');
                }
            });

            // Postcode validation
            const postcodeInput = document.getElementById('postcode');
            postcodeInput.addEventListener('input', function(e) {
                const postcode = e.target.value.trim();
                if (postcode.length < 5) {
                    postcodeInput.setCustomValidity('Please enter a valid postcode');
                } else {
                    postcodeInput.setCustomValidity('');
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle form submission
            document.getElementById('checkout-form').addEventListener('submit', function(e) {
                e.preventDefault();

                // Clear previous error messages
                clearErrors();

                // Validate form
                if (!validateForm()) {
                    return false;
                }

                // Get selected payment method
                const paymentMethod = document.querySelector('input[name="payment"]:checked').value;

                // Get form data
                const formData = new FormData(this);
                formData.append('payment', paymentMethod);

                // Show loading state
                const submitBtn = document.querySelector('button[type="submit"]');
                const originalBtnText = submitBtn.innerHTML;
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...';

                // Submit form via AJAX
                fetch('../php/checkout.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        // Show success alert
                        Swal.fire({
                            title: 'Order Placed Successfully!',
                            text: 'Thank you for your order. You will be redirected to the order confirmation page.',
                            icon: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            // Update all cart count elements
                            document.querySelectorAll('.cart-count, #cart-count').forEach(el => {
                                el.textContent = '0';
                            });

                            // Clear cart slider if it exists
                            if (document.getElementById('cartItems')) {
                                document.getElementById('cartItems').innerHTML = '';
                            }
                            
                            // Update cart total
                            document.querySelectorAll('.cart-total').forEach(el => {
                                el.textContent = '£0.00';
                            });

                            // Clear the checkout form
                            document.getElementById('checkout-form').reset();

                            // Clear cart session
                            fetch('../php/clear-cart.php')
                                .then(response => response.json())
                                .then(data => {
                                    console.log('Cart cleared:', data);
                                })
                                .catch(error => console.error('Error clearing cart:', error));

                            // Redirect to order confirmation page
                            window.location.href = 'order-confirmation.php?order_id=' + data.order_id;
                        });
                    } else {
                        // Show error message
                        Swal.fire({
                            title: 'Error',
                            text: data.message,
                            icon: 'error'
                        });
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = originalBtnText;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        title: 'Error',
                        text: 'An error occurred while processing your order. Please try again.',
                        icon: 'error'
                    });
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalBtnText;
                });
            });

            function showError(message) {
                const errorDiv = document.getElementById('error-message');
                errorDiv.textContent = message;
                errorDiv.style.display = 'block';
                errorDiv.scrollIntoView({ behavior: 'smooth' });
            }

            function clearErrors() {
                const errorDiv = document.getElementById('error-message');
                errorDiv.textContent = '';
                errorDiv.style.display = 'none';
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#checkout-form').on('submit', function(e) {
                e.preventDefault();

                // Get the country value
                const countryValue = $('#country').val();
                if (!countryValue) {
                    alert('Please select a country');
                    return false;
                }

                var formData = $(this).serialize();
                console.log("Form data being sent:", formData);

                $.ajax({
                    url: './php/checkout.php',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        console.log(response);
                        if (response.includes('successfully')) {
                            $('#response').html('<div class="alert alert-success">' + response + '</div>');
                            // Optional: redirect or reset form
                            // window.location.href = 'thank-you.php';
                            // form.reset();
                        } else {
                            $('#response').html('<div class="alert alert-danger">' + response + '</div>');
                        }
                    },
                    error: function() {
                        alert("There was an error submitting the form.");
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#checkout-form').on('submit', function(e) {
                e.preventDefault();

                // Get form data
                var formData = new FormData(this);

                // Get the submit button
                var submitBtn = document.querySelector('button[type="submit"]');
                var originalBtnText = submitBtn.innerHTML;

                // Disable submit button and show loading state
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...';

                // Submit form via AJAX
                $.ajax({
                    url: '../php/checkout.php',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        try {
                            var data = JSON.parse(response);
                            if (data.status === 'success') {
                                // Update cart count to 0
                                $('.cart-count').text('0');

                                // Clear cart slider if it exists
                                $('#cartItems').empty();
                                $('.cart-total').text('£0.00');

                                // Redirect to order confirmation page
                                window.location.href = 'order-confirmation.php?order_id=' + data.order_id;
                            } else {
                                showError(data.message);
                                submitBtn.disabled = false;
                                submitBtn.innerHTML = originalBtnText;
                            }
                        } catch (e) {
                            showError('Invalid response from server');
                            submitBtn.disabled = false;
                            submitBtn.innerHTML = originalBtnText;
                        }
                    },
                    error: function() {
                        showError('An error occurred while processing your order. Please try again.');
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = originalBtnText;
                    }
                });
            });

            function showError(message) {
                const errorDiv = document.getElementById('error-message');
                errorDiv.textContent = message;
                errorDiv.style.display = 'block';
                errorDiv.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    </script>
</body>

</html>