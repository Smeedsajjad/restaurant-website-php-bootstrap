<?php
session_start();


// Include necessary configuration and class files
require_once './admin/config/config.php';
require_once './admin/php/ProductController.php';
require './php/categoryFilter.php';
// Create a new database connection
$database = new Database();
$dbConnection = $database->conn;

// Pass the database connection to the ProductController
$productController = new ProductController($dbConnection);

// Get All avilable products
$products = $productController->getAllProducts();
// Assuming $dbConnection is already initialized and available here
$categoryData = new CategoryData($dbConnection);

// Fetch categories
$categories = $categoryData->getCategories();


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
    <title>Shop</title>
    <style>
        .page-link {
            border: none;
            color: #000;
            font-weight: 600;
        }

        .active>.page-link,
        .page-link.active {
            border-radius: 50%;
            background: var(--primary);
        }
        .page-link:hover{
            color: var(--primary_hover);
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
            <h1 class="opht d-flex justify-content-center text-center">Shop</h1>
            <div>
                <nav class="d-flex justify-content-center test-center"
                    style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#" class="text-muted">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="#" class="text-dark">Shop</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <main>
        <div class="container">
            <div class="row">
                <!-- products -->
                <div class="col-md-9">
                    <div class="row">
                        <small id="results-count" class="text-muted mb-5">Showing 1-24 of 54 Results</small>
                    </div>
                    <div class="row">
                        <?php if (count($products) > 0): ?>
                            <?php foreach ($products as $product): ?>
                                <div class="col-md-4 col-sm-6">
                                    <div class="card myCard col-sm mt-3" style="width: 100%;border-radius: 15px;">
                                        <div class="card-img-wrapper">
                                            <i class="fas fa-heart favorite_icon" style="top: 6px;right: 8px"></i>
                                            <a href="index.php?page=product&id=<?php echo $product['id']; ?>" class="text-decoration-none">
                                                <?php
                                                // Extract the image filename from the 'images' field, in case it includes subdirectories
                                                $imagePath = basename($product['images']);
                                                ?>
                                                <!-- Use only the image filename, prefixed with 'admin/uploads/' -->
                                                <img src="admin/uploads/products/<?php echo $imagePath; ?>" class="card-img-top card-img" alt="<?php echo $product['name']; ?>">
                                        </div>
                                        <div class="card-body">
                                            <p>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </p>
                                            <h5 class="card-title myCardText"><?php echo $product['name']; ?></h5>
                                            <p class="card-text" style="color: #999999; font-size: 13px;">
                                                <?php
                                                // Split the tagline into an array of words
                                                $words = explode(' ', $product['tagline']);

                                                // Get the first 4 words
                                                $firstFourWords = array_slice($words, 0, 4);

                                                // Join the first 4 words back into a string
                                                $shortTagline = implode(' ', $firstFourWords);

                                                // Display the first 4 words followed by '...' if there are more than 4 words
                                                echo (count($words) > 4) ? $shortTagline . '...' : $product['tagline'];
                                                ?>
                                            </p>

                                            <p class="price d-inline fs-3">$<?php echo $product['price']; ?></p>
                                            </a>
                                            <button class="btn p-0 position-absolute" style="right: 0;margin: 20px;" id="add-to-cart" data-id="<?php echo $product['id']; ?>">
                                                <i class="fa-solid fa-basket-shopping myCart" style="background-color: var(--primary);"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="col-md-12 mb-6 text-center">
                                <h2>Explore Other Options</h2>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- aside filter -->
                <div class="col-md-3">
                    <aside>
                        <div class="p-3 rounded-4 border border-muted border-1">
                            <h5 class="fw-bold">Categories</h5>
                            <!-- Category Links -->
                            <ul class="product-categories list-unstyled" id="categories-list">
                                <?php foreach ($categories as $category): ?>
                                    <li class="cat-item">
                                        <a href="#" class="text-muted category-link" data-category-id="<?php echo $category['id']; ?>">
                                            <span><?php echo htmlspecialchars($category['name']); ?></span>
                                            <span class="count">(<?php echo $category['product_count']; ?>)</span>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>

                            <!-- Search Input -->
                            <div class="input-group mt-5 mb-5">
                                <input type="text" placeholder="Search Product" class="afs form-control">
                                <div class="input-group-append">
                                    <i class="fas fa-search"></i>
                                </div>
                            </div>

                            <div class="text-center mb-5">
                                <h5 class="fw-bold text-start mb-3">Filter by price</h5>
                                <input type="range" id="priceRangeSlider" min="0" max="100" step="1" value="50">
                                <p id="priceRange" class="text-muted text-start mb-3 mt-2">Price: $0 - $1000</p>
                                <button type="submit" class="filter_submit_btn btn d-flex justify-content-start rounded-3 fw-bold">FILTER</button>
                            </div>
                    </aside>
                </div>
            </div>
            <!-- Pagination -->
            <div class="row mt-5 justify-content-center align-items-center d-flex ">
                <!-- Pagination -->
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <li class="page-item">
                            <button id="prev-page" class="page-link" disabled>Previous</button>
                        </li>
                        <!-- Dynamic page links will be inserted here -->
                        <li class="page-item">
                            <span id="page-info">Page 1</span>
                        </li>
                        <li class="page-item">
                            <button id="next-page" class="page-link">Next</button>
                        </li>
                    </ul>
                </nav>

            </div>

        </div>
    </main>
    <!-- footer section -->
    <?php include './includes/footer.php' ?>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/shop/js/rangeSlider.js"></script>
    <script src="./assets/shop/js/cart.js"></script>
    <script src="./assets/shop/js/shop.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Open cart slider and load cart items
            $(document).on('click', '[data-bs-toggle="offcanvas"]', function() {
                loadCartItems();
            });

            // Add to cart
            $(document).on('click', '#add-to-cart', function() {
                let productId = $(this).data('id');

                // Check if user is logged in
                if (!<?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>) {
                    alert('You are not logged in. Please log in to add items to your cart.');
                    return; // Exit the function if not logged in
                }

                $.ajax({
                    url: './php/add_to_cart.php',
                    method: 'POST',
                    data: {
                        product_id: productId,
                        quantity: 1
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            $('#cart-count').text(response.cart_count);
                            loadCartItems(); // Reload cart items after adding
                        } else {
                            alert(response.message); // Show the specific error message
                        }
                    }
                });
            });

            // Remove item from cart
            $(document).on('click', '.remove-item', function() {
                let cartItemId = $(this).data('cart-id');
                let $itemElement = $(this).closest('.items');
                
                $itemElement.fadeOut(300); // Start fade out animation
                
                $.ajax({
                    url: './php/remove_cart.php',
                    method: 'POST',
                    data: {
                        cart_id: cartItemId
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            updateCartCount(); // Update the cart count
                            // After animation completes, update the entire cart
                            setTimeout(() => {
                                loadCartItems();
                            }, 300);
                        } else {
                            // If error occurs, show the item again
                            $itemElement.fadeIn(300);
                            alert(response.message || 'Failed to remove item');
                        }
                    },
                    error: function(xhr, status, error) {
                        // If AJAX fails, show the item again
                        $itemElement.fadeIn(300);
                        alert('Failed to remove item. Please try again.');
                    }
                });
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
    <!-- <script src="./assets/shop/js/filterProducts.js"></script> -->
</body>

</html>