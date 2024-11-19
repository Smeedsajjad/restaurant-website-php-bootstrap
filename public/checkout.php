<?php
session_start();
require_once '../admin/config/config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
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
                                <label for="country" class="form-label">Country / Region <span class="text-danger">*</span></label>
                                <div class="dropdown">
                                    <input type="text" class="form-control" id="countrySearch" placeholder="Select your country" data-bs-toggle="dropdown" readonly>
                                    <input type="hidden" name="country" id="country" required>
                                    <ul class="dropdown-menu w-100" style="max-height: 250px; overflow-y: auto;">
                                        <li data-value="afghanistan">Afghanistan</li>
                                        <li data-value="albania">Albania</li>
                                        <li data-value="algeria">Algeria</li>
                                        <li data-value="andorra">Andorra</li>
                                        <li data-value="angola">Angola</li>
                                        <li data-value="antigua-and-barbuda">
                                            Antigua and Barbuda
                                        </li>
                                        <li data-value="argentina">Argentina</li>
                                        <li data-value="armenia">Armenia</li>
                                        <li data-value="australia">Australia</li>
                                        <li data-value="austria">Austria</li>
                                        <li data-value="azerbaijan">Azerbaijan</li>
                                        <li data-value="bahamas">Bahamas</li>
                                        <li data-value="bahrain">Bahrain</li>
                                        <li data-value="bangladesh">Bangladesh</li>
                                        <li data-value="barbados">Barbados</li>
                                        <li data-value="belarus">Belarus</li>
                                        <li data-value="belgium">Belgium</li>
                                        <li data-value="belize">Belize</li>
                                        <li data-value="benin">Benin</li>
                                        <li data-value="bhutan">Bhutan</li>
                                        <li data-value="bolivia">Bolivia</li>
                                        <li data-value="bosnia-and-herzegovina">
                                            Bosnia and Herzegovina
                                        </li>
                                        <li data-value="botswana">Botswana</li>
                                        <li data-value="brazil">Brazil</li>
                                        <li data-value="brunei">Brunei</li>
                                        <li data-value="bulgaria">Bulgaria</li>
                                        <li data-value="burkina-faso">Burkina Faso</li>
                                        <li data-value="burundi">Burundi</li>
                                        <li data-value="cabo-verde">Cabo Verde</li>
                                        <li data-value="cambodia">Cambodia</li>
                                        <li data-value="cameroon">Cameroon</li>
                                        <li data-value="canada">Canada</li>
                                        <li data-value="central-african-republic">
                                            Central African Republic
                                        </li>
                                        <li data-value="chad">Chad</li>
                                        <li data-value="chile">Chile</li>
                                        <li data-value="china">China</li>
                                        <li data-value="colombia">Colombia</li>
                                        <li data-value="comoros">Comoros</li>
                                        <li data-value="congo-brazzaville">
                                            Congo (Brazzaville)
                                        </li>
                                        <li data-value="congo-kinshasa">
                                            Congo (Kinshasa)
                                        </li>
                                        <li data-value="costa-rica">Costa Rica</li>
                                        <li data-value="croatia">Croatia</li>
                                        <li data-value="cuba">Cuba</li>
                                        <li data-value="cyprus">Cyprus</li>
                                        <li data-value="czech-republic">
                                            Czech Republic
                                        </li>
                                        <li data-value="denmark">Denmark</li>
                                        <li data-value="djibouti">Djibouti</li>
                                        <li data-value="dominica">Dominica</li>
                                        <li data-value="dominican-republic">
                                            Dominican Republic
                                        </li>
                                        <li data-value="east-timor">East Timor</li>
                                        <li data-value="ecuador">Ecuador</li>
                                        <li data-value="egypt">Egypt</li>
                                        <li data-value="el-salvador">El Salvador</li>
                                        <li data-value="equatorial-guinea">
                                            Equatorial Guinea
                                        </li>
                                        <li data-value="eritrea">Eritrea</li>
                                        <li data-value="estonia">Estonia</li>
                                        <li data-value="eswatini">Eswatini</li>
                                        <li data-value="ethiopia">Ethiopia</li>
                                        <li data-value="fiji">Fiji</li>
                                        <li data-value="finland">Finland</li>
                                        <li data-value="france">France</li>
                                        <li data-value="gabon">Gabon</li>
                                        <li data-value="gambia">Gambia</li>
                                        <li data-value="georgia">Georgia</li>
                                        <li data-value="germany">Germany</li>
                                        <li data-value="ghana">Ghana</li>
                                        <li data-value="greece">Greece</li>
                                        <li data-value="grenada">Grenada</li>
                                        <li data-value="guatemala">Guatemala</li>
                                        <li data-value="guinea">Guinea</li>
                                        <li data-value="guinea-bissau">Guinea-Bissau</li>
                                        <li data-value="guyana">Guyana</li>
                                        <li data-value="haiti">Haiti</li>
                                        <li data-value="honduras">Honduras</li>
                                        <li data-value="hungary">Hungary</li>
                                        <li data-value="iceland">Iceland</li>
                                        <li data-value="india">India</li>
                                        <li data-value="indonesia">Indonesia</li>
                                        <li data-value="iran">Iran</li>
                                        <li data-value="iraq">Iraq</li>
                                        <li data-value="ireland">Ireland</li>
                                        <li data-value="israel">Israel</li>
                                        <li data-value="italy">Italy</li>
                                        <li data-value="ivory-coast">Ivory Coast</li>
                                        <li data-value="jamaica">Jamaica</li>
                                        <li data-value="japan">Japan</li>
                                        <li data-value="jordan">Jordan</li>
                                        <li data-value="kazakhstan">Kazakhstan</li>
                                        <li data-value="kenya">Kenya</li>
                                        <li data-value="kiribati">Kiribati</li>
                                        <li data-value="kosovo">Kosovo</li>
                                        <li data-value="kuwait">Kuwait</li>
                                        <li data-value="kyrgyzstan">Kyrgyzstan</li>
                                        <li data-value="laos">Laos</li>
                                        <li data-value="latvia">Latvia</li>
                                        <li data-value="lebanon">Lebanon</li>
                                        <li data-value="lesotho">Lesotho</li>
                                        <li data-value="liberia">Liberia</li>
                                        <li data-value="libya">Libya</li>
                                        <li data-value="liechtenstein">Liechtenstein</li>
                                        <li data-value="lithuania">Lithuania</li>
                                        <li data-value="luxembourg">Luxembourg</li>
                                        <li data-value="north-macedonia">North Macedonia</li>
                                        <li data-value="madagascar">Madagascar</li>
                                        <li data-value="malawi">Malawi</li>
                                        <li data-value="malaysia">Malaysia</li>
                                        <li data-value="maldives">Maldives</li>
                                        <li data-value="mali">Mali</li>
                                        <li data-value="malta">Malta</li>
                                        <li data-value="marshall-islands">Marshall Islands</li>
                                        <li data-value="mauritania">Mauritania</li>
                                        <li data-value="mauritius">Mauritius</li>
                                        <li data-value="mexico">Mexico</li>
                                        <li data-value="micronesia">Micronesia</li>
                                        <li data-value="moldova">Moldova</li>
                                        <li data-value="monaco">Monaco</li>
                                        <li data-value="mongolia">Mongolia</li>
                                        <li data-value="montenegro">Montenegro</li>
                                        <li data-value="morocco">Morocco</li>
                                        <li data-value="mozambique">Mozambique</li>
                                        <li data-value="myanmar">Myanmar</li>
                                        <li data-value="namibia">Namibia</li>
                                        <li data-value="nauru">Nauru</li>
                                        <li data-value="nepal">Nepal</li>
                                        <li data-value="netherlands">Netherlands</li>
                                        <li data-value="new-zealand">New Zealand</li>
                                        <li data-value="nicaragua">Nicaragua</li>
                                        <li data-value="niger">Niger</li>
                                        <li data-value="nigeria">Nigeria</li>
                                        <li data-value="north-korea">North Korea</li>
                                        <li data-value="norway">Norway</li>
                                        <li data-value="oman">Oman</li>
                                        <li data-value="pakistan">Pakistan</li>
                                        <li data-value="palau">Palau</li>
                                        <li data-value="palestine">Palestine</li>
                                        <li data-value="panama">Panama</li>
                                        <li data-value="papua-new-guinea">Papua New Guinea</li>
                                        <li data-value="paraguay">Paraguay</li>
                                        <li data-value="peru">Peru</li>
                                        <li data-value="philippines">Philippines</li>
                                        <li data-value="poland">Poland</li>
                                        <li data-value="portugal">Portugal</li>
                                        <li data-value="qatar">Qatar</li>
                                        <li data-value="romania">Romania</li>
                                        <li data-value="russia">Russia</li>
                                        <li data-value="rwanda">Rwanda</li>
                                        <li data-value="saint-kitts-and-nevis">
                                            Saint Kitts and Nevis
                                        </li>
                                        <li data-value="saint-lucia">Saint Lucia</li>
                                        <li data-value="saint-vincent-and-the-grenadines">
                                            Saint Vincent and the Grenadines
                                        </li>
                                        <li data-value="samoa">Samoa</li>
                                        <li data-value="san-marino">San Marino</li>
                                        <li data-value="sao-tome-and-principe">
                                            Sao Tome and Principe
                                        </li>
                                        <li data-value="saudi-arabia">Saudi Arabia</li>
                                        <li data-value="senegal">Senegal</li>
                                        <li data-value="serbia">Serbia</li>
                                        <li data-value="seychelles">Seychelles</li>
                                        <li data-value="sierra-leone">Sierra Leone</li>
                                        <li data-value="singapore">Singapore</li>
                                        <li data-value="slovakia">Slovakia</li>
                                        <li data-value="slovenia">Slovenia</li>
                                        <li data-value="solomon-islands">Solomon Islands</li>
                                        <li data-value="somalia">Somalia</li>
                                        <li data-value="south-africa">South Africa</li>
                                        <li data-value="south-korea">South Korea</li>
                                        <li data-value="south-sudan">South Sudan</li>
                                        <li data-value="spain">Spain</li>
                                        <li data-value="sri-lanka">Sri Lanka</li>
                                        <li data-value="sudan">Sudan</li>
                                        <li data-value="suriname">Suriname</li>
                                        <li data-value="sweden">Sweden</li>
                                        <li data-value="switzerland">Switzerland</li>
                                        <li data-value="syria">Syria</li>
                                        <li data-value="taiwan">Taiwan</li>
                                        <li data-value="tajikistan">Tajikistan</li>
                                        <li data-value="tanzania">Tanzania</li>
                                        <li data-value="thailand">Thailand</li>
                                        <li data-value="togo">Togo</li>
                                        <li data-value="tonga">Tonga</li>
                                        <li data-value="trinidad-and-tobago">
                                            Trinidad and Tobago
                                        </li>
                                        <li data-value="tunisia">Tunisia</li>
                                        <li data-value="turkey">Turkey</li>
                                        <li data-value="turkmenistan">Turkmenistan</li>
                                        <li data-value="tuvalu">Tuvalu</li>
                                        <li data-value="uganda">Uganda</li>
                                        <li data-value="ukraine">Ukraine</li>
                                        <li data-value="united-arab-emirates">
                                            United Arab Emirates
                                        </li>
                                        <li data-value="united-kingdom">United Kingdom</li>
                                        <li data-value="united-states">United States</li>
                                        <li data-value="uruguay">Uruguay</li>
                                        <li data-value="uzbekistan">Uzbekistan</li>
                                        <li data-value="vanuatu">Vanuatu</li>
                                        <li data-value="vatican-city">Vatican City</li>
                                        <li data-value="venezuela">Venezuela</li>
                                        <li data-value="vietnam">Vietnam</li>
                                        <li data-value="yemen">Yemen</li>
                                        <li data-value="zambia">Zambia</li>
                                        <li data-value="zimbabwe">Zimbabwe</li>
                                    </ul>
                                    <div id="selectedCountry" class="text-success text-center mt-2"></div>
                                </div>
                                <div class="invalid-feedback">Please select a country.</div>
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
                                    require_once '../php/Cart.php';
                                    $cart = new Cart($db);
                                    $cartItems = $cart->getCartItems($_SESSION['user_id']);
                                    $subtotal = 0;

                                    foreach ($cartItems as $item):
                                        $itemTotal = $item['price'] * $item['quantity'];
                                        $subtotal += $itemTotal;
                                    ?>
                                    <div class="d-flex justify-content-between mb-3 mt-4">
                                        <div>
                                            <h6 class="fw-light"><?php echo htmlspecialchars($item['name']); ?> × <?php echo $item['quantity']; ?></h6>
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
                        // Redirect to order confirmation page
                        window.location.href = 'order-confirmation.php?order_id=' + data.order_id;
                    } else {
                        // Show error message
                        showError(data.message);
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = originalBtnText;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showError('An error occurred while processing your order. Please try again.');
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

            // ... rest of your code ...
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
</body>

</html>