<?php
// Include necessary configuration and class files
require_once './admin/config/config.php';
require_once './admin/php/ProductController.php';
// Create a new database connection
$database = new Database();
$dbConnection = $database->conn;

// Pass the database connection to the ProductController
$productController = new ProductController($dbConnection);

// Get All avilable products
$products = $productController->getAllProducts();
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
    <title>Cart</title>
    <style>
        tr.align-middle.text-center>td {
            padding: 20px 15px 20px 0;
        }
    </style>
</head>

<body>
    <!-- header -->
    <?php include  './includes/header.php'; ?>

    <!-- navbar -->
    <?php include  './includes/nav.php'; ?>
    <!-- Hero section -->

    <section class="op_hero_section" style="margin-bottom: 15vh;background-image: url(./assets/shop/images/breadcrumb1.jpg);">
        <div class="container-fluid">
            <h1 class="opht d-flex justify-content-center text-center">Cart</h1>
            <div>
                <nav class="d-flex justify-content-center test-center"
                    style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#" class="text-muted">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="#" class="text-dark">Cart</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <main>
        <section id="empty-cart" class="d-none">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="icon mx-auto">
                        <svg width="164px" height="164px" viewBox="0 0 20 19" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <defs></defs>
                            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="Dribbble-Light-Preview" transform="translate(-340.000000, -3120.000000)" fill="#000000">
                                    <g id="icons" transform="translate(56.000000, 160.000000)">
                                        <path d="M291.879613,2973.3029 L292.586322,2972.59038 L291.879613,2971.87787 C291.488775,2971.48382 291.488775,2970.84588 291.879613,2970.45284 C292.270452,2970.05878 292.903191,2970.05878 293.29303,2970.45284 L293.999738,2971.16535 L294.706447,2970.45284 C295.097285,2970.05878 295.730024,2970.05878 296.120863,2970.45284 C296.510702,2970.84588 296.510702,2971.48382 296.120863,2971.87787 L295.414155,2972.59038 L296.120863,2973.3029 C296.510702,2973.69695 296.510702,2974.33489 296.120863,2974.72793 C295.730024,2975.12198 295.097285,2975.12198 294.706447,2974.72793 L293.999738,2974.01541 L293.29303,2974.72793 C292.903191,2975.12198 292.270452,2975.12198 291.879613,2974.72793 C291.488775,2974.33489 291.488775,2973.69695 291.879613,2973.3029 L291.879613,2973.3029 Z M299.457486,2976.16405 C299.368523,2976.63973 298.955693,2976.9844 298.475891,2976.9844 L289.543577,2976.9844 C289.054779,2976.9844 288.637951,2976.62864 288.556985,2976.14288 L287.363477,2968.92198 L300.816925,2968.92198 L299.457486,2976.16405 Z M302.996026,2966.90638 L300.996851,2966.90638 L297.475304,2960.57436 C297.199418,2960.09264 296.58767,2959.83665 296.109868,2960.11481 C295.632065,2960.39296 295.468132,2961.14579 295.744019,2961.62752 L298.688803,2966.90638 L289.311673,2966.90638 L292.256458,2961.58217 C292.532344,2961.10044 292.368412,2960.39296 291.890609,2960.11481 C291.412806,2959.83665 290.801058,2960.13799 290.525172,2960.61972 L287.002626,2966.90638 L285.003451,2966.90638 C283.807945,2966.90638 283.412108,2968.92198 285.337313,2968.92198 L286.724741,2977.31596 C286.885674,2978.28748 287.71933,2979 288.696927,2979 L299.30355,2979 C300.281146,2979 301.114802,2978.28748 301.275736,2977.31596 L302.663163,2968.92198 C304.590368,2968.92198 304.189533,2966.90638 302.996026,2966.90638 L302.996026,2966.90638 Z" id="shopping_cart_close_round-[#1132]"></path>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <p class="text-center mt-3 mb-3">Your cart is currently empty.</p>

                    <div>
                        <button class="btn bg-warning invers_btn text-capitalize mx-auto">Return to shop</button>
                    </div>
                </div>
            </div>
        </section>
        <div class="container">
            <div class="row">
                <div class="col-md-8 p-3">
                    <form class="cart-form" action="" method="post">
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Thumbnail</th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="align-middle text-center">
                                    <td>
                                        <a href=""><i class="fa-regular fa-circle-xmark"></i></a>
                                    </td>
                                    <td>
                                        <img id="tableImg" src="./admin/uploads/products/671fbd6503d1a_Apricot_Chicken.png" style="width: 90px;">
                                    </td>
                                    <td>
                                        <p>Apricot Chicken</p>
                                    </td>
                                    <td>£18.30</td>
                                    <td>
                                        <div class="input-group">
                                            <label for="quantity" class="visually-hidden">Quantity</label>
                                            <input type="number" id="quantity" class="form-control" name="cart[c9f0f895fb98ab9159f51fd0297e236d][qty]" value="1" min="0" step="1">
                                        </div>
                                    </td>
                                    <td>£18.30</td>
                                </tr>
                                <tr>
                                    <td colspan="6" class="text-end">
                                        <div class="d-flex justify-content-end align-items-center">
                                            <button type="submit" class="btn bg-warning invers_btn text-capitalize disabled" name="update_cart" style="border: none;cursor: not-allowed;">Update cart</button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>

                </div>
                <div class="col-md-4 fw-semibold">
                    <h2 class="capitalize">Cart totals</h2>
                    <table>
                        <tbody>
                            <tr class="cart-subtotal">
                                <th>Subtotal</th>
                                <td><span>£18.30</span></td>
                            </tr>
                            <tr class="shipping-totals shipping">
                                <th>Shipping</th>
                                <td data-title="Shipping">
                                    <span class="text-muted">Shipping costs are calculated during checkout.</span>
                                </td>
                            </tr>
                            <tr class="order-total">
                                <th>Total</th>
                                <td data-title="Total"><strong><span>£18.30</span></strong>"></td>
                            </tr>
                        </tbody>
                    </table>
                    <button class="btn bg-warning invers_btn text-capitalize mx-auto">Proceed to checkout</button>
                    <div></div>
                </div>
            </div>
        </div>
    </main>
    <!-- footer section -->
    <?php include './includes/footer.php' ?>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>