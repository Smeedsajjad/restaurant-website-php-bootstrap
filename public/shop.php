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
.active>.page-link, .page-link.active  {
    border-radius: 50%;
    background: var(--primary);
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
    <script src="./assets/shop/js/wishlist.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Loader visibility functions
            function showLoader() {
                $('.loader-bg').show();
            }

            function hideLoader() {
                $('.loader-bg').hide();
            }

            // Function to update products display and results count
            function updateProductsDisplay(products, offset, append = false) {
                let productsContainer = $('.col-md-9 .row:last');

                if (!append) {
                    productsContainer.empty(); // Clear container only if not appending
                }

                if (products.length > 0) {
                    products.forEach(function(product) {
                        productsContainer.append(`
                        <div class="col-md-4 col-sm-6">
                            <div class="card myCard col-sm mt-3" style="width: 100%; border-radius: 15px;">
                                <div class="card-img-wrapper">
                                    <i class="fas fa-heart favorite_icon" style="top: 6px;right: 8px"></i>
                                    <a href="index.php?page=product&id=${product.id}" class="text-decoration-none">
                                        <img src="admin/${product.images}" class="card-img-top card-img" alt="${product.name}">
                                    </a>
                                </div>
                                <div class="card-body">
                                    <p>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </p>
                                    <h5 class="card-title myCardText">${product.name}</h5>
                                    <p class="card-text" style="color: #999999; font-size: 13px;">
                                        ${product.tagline.split(' ').slice(0, 4).join(' ')}...
                                    </p>
                                    <p class="price d-inline fs-3">$${product.price}</p>
                                    <button class="btn p-0 position-absolute" style="right: 0;margin: 20px;" id="add-to-cart" data-id="${product.id}">
                                        <i class="fa-solid fa-basket-shopping myCart" style="background-color: var(--primary);"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    `);
                    });
                    $('#results-count').text(`Showing ${offset + 1}-${offset + products.length} Results`);
                } else {
                    productsContainer.append('<div class="col-md-12 text-center"><h2>No more products available</h2></div>');
                    $('#results-count').text('Showing 0 of 0 Results');
                }
            }

            let currentPage = 1;
            let totalProducts = 0; // Define totalProducts globally
            const limit = 6; // Number of products per page

            function updatePagination(totalProducts) {
                const totalPages = Math.ceil(totalProducts / limit); // Calculate total pages
                const paginationContainer = $('.pagination');

                // Clear existing page links (except Previous and Next buttons)
                paginationContainer.find('.page-item:not(:first-child):not(:last-child)').remove();

                // Generate page links based on total pages
                for (let i = 1; i <= totalPages; i++) {
                    const pageItem = $('<li class="page-item"></li>');
                    const pageLink = $(`<a class="page-link" href="#">${i}</a>`);

                    // Add active class to the current page
                    if (i === currentPage) {
                        pageItem.addClass('active');
                    }

                    // Click event for page link to load selected page
                    pageLink.on('click', function(e) {
                        e.preventDefault();
                        currentPage = i; // Update current page
                        loadProducts(currentPage); // Load products for the selected page
                        updatePagination(totalProducts); // Refresh pagination
                    });

                    pageItem.append(pageLink);
                    paginationContainer.find('#next-page').parent().before(pageItem); // Insert before Next button
                }

                // Update page info
                $('#page-info').text(`Page ${currentPage} of ${totalPages}`);

                // Enable or disable Previous and Next buttons based on the current page
                $('#prev-page').prop('disabled', currentPage === 1);
                $('#next-page').prop('disabled', currentPage === totalPages);
            }

            function loadProducts(page) {
                const offset = (page - 1) * limit; // Calculate offset for the current page

                $.ajax({
                    url: 'php/load_more_products.php',
                    type: 'POST',
                    data: {
                        offset: offset,
                        limit: limit
                    },
                    beforeSend: showLoader,
                    success: function(response) {
                        try {
                            const data = JSON.parse(response);
                            const products = data.products;
                            totalProducts = data.total; // Update total products globally
                            updateProductsDisplay(products, offset); // Display products
                            updatePagination(totalProducts); // Refresh pagination
                            $('#page-info').text(`Page ${page}`);
                        } catch (e) {
                            console.error('Error parsing JSON:', e, response);
                            alert('Error loading products');
                        }
                    },
                    complete: hideLoader,
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('AJAX error:', textStatus, errorThrown);
                        alert('Failed to load products');
                    }
                });
            }

            // Initial load for the first page
            loadProducts(currentPage);

            // Event listeners for Previous and Next buttons
            $('#prev-page').on('click', function(e) {
                e.preventDefault();
                if (currentPage > 1) {
                    currentPage--;
                    loadProducts(currentPage);
                }
            });

            $('#next-page').on('click', function(e) {
                e.preventDefault();
                if (currentPage < Math.ceil(totalProducts / limit)) {
                    currentPage++;
                    loadProducts(currentPage);
                }
            });

            // Fetch and set the maximum price for the range slider
            $.ajax({
                url: 'php/filterProducts.php',
                type: 'POST',
                data: {
                    get_max_price: true
                },
                success: function(response) {
                    let data = JSON.parse(response);
                    let maxPrice = data.max_price || 1000; // Default to 1000 if no max price is found
                    $('#priceRangeSlider').attr('max', maxPrice);
                    $('#priceRange').text(`Price: $0 - $${maxPrice}`);
                },
                error: function() {
                    alert('Error retrieving maximum price');
                }
            });

            // Handle category filter
            $('.category-link').on('click', function(e) {
                e.preventDefault();
                let categoryId = $(this).data('category-id');

                showLoader(); // Show loader when the category link is clicked

                $.ajax({
                    url: 'php/filterProducts.php',
                    type: 'POST',
                    data: {
                        category_id: categoryId
                    },
                    success: function(response) {
                        let products = JSON.parse(response);
                        updateProductsDisplay(products, 0); // Reset offset for category filter
                        hideLoader(); // Hide loader after the search is complete
                    },
                    error: function() {
                        alert('Error retrieving products');
                        hideLoader(); // Hide loader in case of error
                    }
                });
            });

            // Handle search input
            $('.afs').on('keypress', function(e) {
                if (e.which == 13) { // Enter key pressed
                    e.preventDefault();
                    let searchQuery = $(this).val();

                    showLoader(); // Show loader when the search is initiated

                    $.ajax({
                        url: 'php/filterProducts.php',
                        type: 'POST',
                        data: {
                            search_query: searchQuery
                        },
                        success: function(response) {
                            let products = JSON.parse(response);
                            updateProductsDisplay(products, 0); // Reset offset for search
                            hideLoader(); // Hide loader after the search is complete
                        },
                        error: function() {
                            alert('Error retrieving products');
                            hideLoader(); // Hide loader in case of error
                        }
                    });
                }
            });

            // Handle price range filter
            $('.filter_submit_btn').on('click', function(e) {
                e.preventDefault();
                let priceMin = 0; // Set your minimum price
                let priceMax = $('#priceRangeSlider').val();

                showLoader(); // Show loader when the filter is applied

                $.ajax({
                    url: 'php/filterProducts.php',
                    type: 'POST',
                    data: {
                        price_min: priceMin,
                        price_max: priceMax
                    },
                    success: function(response) {
                        let products = JSON.parse(response);
                        updateProductsDisplay(products, 0); // Reset offset for price filter
                        hideLoader(); // Hide loader after the filter is applied
                    },
                    error: function() {
                        alert('Error retrieving products');
                        hideLoader(); // Hide loader in case of error
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Use event delegation for dynamically generated elements
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
                        } else {
                            alert(response.message); // Show the specific error message
                        }
                    }
                });
            });

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

            updateCartCount();
        });
    </script>
    <!-- <script src="./assets/shop/js/filterProducts.js"></script> -->
</body>

</html>