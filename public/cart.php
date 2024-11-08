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
    <!-- jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
    <div class="container">
        <div class="row mb-5">
            <!-- Success Message -->
            <div id="success-message" class="text-white p-3" style="background-color: var(--secondary); display: none;">
                <p class="position-relative d-inline" style="text-align: center; top: 6px;">Product has been added successfully</p>
            </div>

            <!-- Error Message -->
            <div id="error-message" class="text-white p-3" style="background-color: red; display: none;">
                <p class="position-relative d-inline" style="text-align: center; top: 6px;">Try again to add product to cart</p>
            </div>
        </div>
    </div>
    <main>
    <?php
// Include necessary configuration and class files
require_once './config/config.php';
require_once './php/ProductController.php';

// Create a new database connection
$database = new Database();
$dbConnection = $database->conn;

// Pass the database connection to the ProductController
$productController = new ProductController($dbConnection);

// Get all available products
$products = $productController->getAllProducts();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Loop through the cart data
    foreach ($_POST['cart'] as $cartId => $data) {
        $quantity = $data['qty']; // Get the quantity for this cart item

        // Update the cart quantity in the database
        $sql = "UPDATE cart SET quantity = ? WHERE id = ?";
        $stmt = $dbConnection->prepare($sql);
        $stmt->bind_param("ii", $quantity, $cartId);

        if ($stmt->execute()) {
            $response = ['status' => 'success'];
        } else {
            $response = ['status' => 'error'];
        }
    }

    $stmt->close();

    // Return the response as JSON
    echo json_encode($response);
    exit; // End execution to avoid further script processing
}

// SQL to get the cart items with the related product information
$sql = "SELECT cart.id AS cart_id, cart.quantity, products.id AS product_id, products.name, products.price, products.images FROM cart INNER JOIN products ON cart.product_id = products.id";

// Execute the query using $dbConnection
$result = $dbConnection->query($sql);

// Prepare an array to store the data
$cartData = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cartData[] = $row;
    }
}

// Close the database connection after all operations
$dbConnection->close();
?>

<!-- Check if the cart is empty -->
<?php if (empty($cartData)) { ?>
    <section id="empty-cart" class="d-block"> <!-- Change d-none to d-block to show the section -->
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
<?php } else { ?>
    <!-- Main cart section -->
    <div class="container">
        <div class="row">
            <div class="col-md-8 p-3">
                <form class="cart-form" action="index.php?page=cart" method="post">
                    <table class="table">
                        <thead>
                            <tr class="d-none d-md-table-row">
                                <th scope="col"></th>
                                <th scope="col">Thumbnail</th>
                                <th scope="col">Product</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cartData as $item) { ?>
                                <tr class="d-none d-md-table-row align-middle text-center">
                                    <td>
                                        <a href="#" class="delete-item" data-cart-id="<?php echo $item['cart_id']; ?>">
                                            <i class="fa-regular fa-circle-xmark"></i>
                                        </a>
                                    </td>
                                    <td><img src="./admin/<?php echo $item['images']; ?>" style="width: 90px;"></td>
                                    <td>
                                        <p><?php echo $item['name']; ?></p>
                                    </td>
                                    <td>£<?php echo $item['price']; ?></td>
                                    <td>
                                        <div class="input-group">
                                            <label for="quantity" class="visually-hidden">Quantity</label>
                                            <input type="number" class="form-control quantity-input" name="cart[<?php echo $item['cart_id']; ?>][qty]" value="<?php echo $item['quantity']; ?>" min="0" step="1">
                                        </div>
                                    </td>
                                    <td>£<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <button type="submit" id="update-cart-button" class="btn bg-warning invers_btn text-capitalize mx-auto mt-4" disabled>Update cart</button>
                </form>
            </div>
            <div class="col-md-4 fw-semibold p-4" style="border: 6px solid #e5e5e5;">
                <h2 class="text-capitalize border-bottom mb-2">Cart Totals</h2>
                <?php
                // Initialize subtotal and total
                $subtotal = 0;

                // Calculate subtotal
                foreach ($cartData as $item) {
                    $subtotal += $item['price'] * $item['quantity'];
                }

                // Calculate total
                $shippingCost = 0; // Set shipping cost if applicable
                $total = $subtotal + $shippingCost;

                // Format the values for display
                $formattedSubtotal = number_format($subtotal, 2);
                $formattedTotal = number_format($total, 2);
                ?>

                <form action="" method="post">
                    <table class="table table-borderless">
                        <tbody>
                            <tr class="cart-subtotal mb-2">
                                <th>Subtotal</th>
                                <td class="text-end"><span id="subtotal">£<?php echo $formattedSubtotal; ?></span></td>
                            </tr>
                            <tr class="shipping-totals shipping">
                                <th>Shipping</th>
                                <td class="text-end">
                                    <span class="text-muted" style="font-size: 14px;">Shipping costs are calculated during checkout.</span>
                                </td>
                            </tr>
                            <tr class="order-total">
                                <th>Total</th>
                                <td class="text-end"><strong><span id="total">£<?php echo $formattedTotal; ?></span></strong></td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-warning text-capitalize w-100 mt-3" style="font-weight: bold;">
                        Proceed to checkout
                    </button>
                </form>
            </div>
        </div>
    </div>
<?php } ?>
    </main>
    <!-- footer section -->
    <?php include './includes/footer.php' ?>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            let successMessageShown = false;

            // Enable/disable button based on quantity changes
            $('.quantity-input').on('input', function() {
                const originalQuantity = parseInt($(this).data('original-quantity'));
                const currentQuantity = parseInt($(this).val());
                $('#update-cart-button').prop('disabled', currentQuantity === originalQuantity);
            });

            // Handle form submission for updating cart
            $('.cart-form').on('submit', function(e) {
                e.preventDefault();
                const cartData = $(this).serialize();

                $.ajax({
                    url: 'php/update_cart.php',
                    type: 'POST',
                    data: cartData,
                    success: function(response) {
                        const result = JSON.parse(response);
                        if (result.status === 'success' && !successMessageShown) {
                            $('#success-message').show().delay(3000).fadeOut();
                            successMessageShown = true;
                            location.reload(); // Reload the page to update cart items
                        } else if (result.status === 'error') {
                            $('#error-message').show().delay(3000).fadeOut();
                            successMessageShown = false;
                        }
                    },
                    error: function() {
                        $('#error-message').show().delay(3000).fadeOut();
                        successMessageShown = false;
                    }
                });
            });

            // Handle delete item click
            $('.delete-item').on('click', function(e) {
                e.preventDefault();
                const cartId = $(this).data('cart-id');

                $.ajax({
                    url: 'php/remove_cart.php',
                    type: 'POST',
                    data: {
                        cart_id: cartId
                    },
                    success: function(response) {
                        const result = JSON.parse(response);
                        if (result.status === 'success') {
                            location.reload(); // Reload the page to update cart items
                        } else {
                            $('#error-message').text(result.message).show().delay(3000).fadeOut();
                        }
                    },
                    error: function() {
                        $('#error-message').show().delay(3000).fadeOut();
                    }
                });

            });
        });
    </script>
</body>

</html>