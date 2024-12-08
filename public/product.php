<?php
// Include necessary configuration and class files
require_once './admin/config/config.php';
require_once './admin/php/ProductController.php';
require_once './php/Contact.php';
// Create a new database connection
$database = new Database();
$dbConnection = $database->conn;

// Create a new instance of ProductController
$productController = new ProductController($dbConnection);
// Get the product ID from the URL
$productId = isset($_GET['id']) ? $_GET['id'] : null;
$product = $productController->getProduct($productId);
$contactController = new ContactController($dbConnection);
if (isset($product['id'])) {
    $reviews = $contactController->getReviews($product['id']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--jQuery-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    <title><?php echo htmlspecialchars($product['name']); ?></title>

</head>

<body>
    <!-- loader -->
    <div class="loader-bg" style="display: none;">
        <div class="loader"></div>
    </div>
    <!-- header -->
    <?php include  './includes/header.php'; ?>

    <!-- navbar -->
    <?php include  './includes/nav.php'; ?>

    <!-- Hero section -->

    <section class="op_hero_section" style="background-image: url(assets/shop/images/breadcrumb1.jpg);">
        <div class="container-fluid">
            <div>
                <nav class="container d-flex justify-content-start test-start"
                    style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#" class="text-muted">Home</a></li>
                        <li class="breadcrumb-item"><a href="#" class="text-muted">Shop</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="#" class="text-dark">Product
                                Name</a>
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
                <a class="text-end float-end p-2" style="border-left: 0.5px solid rgba(0, 128, 0, 0.61);" href="#">VIEW CART</a>
            </div>

            <!-- Error Message -->
            <div id="error-message" class="text-white p-3" style="background-color: red; display: none;">
                <p class="position-relative d-inline" style="text-align: center; top: 6px;">Try again to add product to cart</p>
                <a class="text-end float-end p-2" style="border-left: 0.5px solid rgba(0, 128, 0, 0.61);" href="#">VIEW CART</a>
            </div>
        </div>
    </div>
    <main>
        <div class="container mb-5">
            <div class="row">
                <div class="col-md-6">
                    <div class="zoom-area">
                        <div class="large"></div>
                        <?php
                        $images = explode(',', $product['images']);
                        foreach ($images as $image) {
                            echo '<img class="small" src="admin/' . htmlspecialchars($image) . '" width="500" height="500" alt="' . htmlspecialchars($product['name']) . '" />';
                        }
                        ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <h1 class="fw-semibold" style="font-size: 52px;"><?php echo htmlspecialchars($product['name']); ?></h1>
                    <div class="rating d-inline">
                        <div class="rating d-inline">
                            <?php
                            // Assuming you already have a database connection in $dbConnection

                            // Check if product_id is set and valid
                            if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                                $product_id = intval($_GET['id']); // Sanitize product_id

                                // Fetch average rating and review count for the product
                                $stmt = $dbConnection->prepare("SELECT AVG(rating) AS average_rating, COUNT(*) AS review_count FROM reviews WHERE product_id = ?");
                                $stmt->bind_param("i", $product_id); // Bind the product ID
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $data = $result->fetch_assoc();

                                // Handle data
                                $averageRating = isset($data['average_rating']) ? round($data['average_rating'], 1) : 0; // Round to 1 decimal
                                $reviewCount = isset($data['review_count']) ? intval($data['review_count']) : 0;
                            } else {
                                $averageRating = 0;
                                $reviewCount = 0;
                            }
                            ?>

                            <!-- Display the average rating and review count -->
                            <p class="customer_reviews_trigger mx-2 text-muted d-inline">
                                <?php if ($reviewCount > 0): ?>
                                    <span>
                                        <?php for ($i = 1; $i <= 5; $i++): ?>
                                            <i
                                                class="fa fa-star" aria-hidden="true" style="color: <?php echo ($i <= $averageRating) ? 'warning' : 'gray'; ?>;">
                                            </i>
                                        <?php endfor; ?>
                                    </span>
                            <p><small class="text-muted text-hover">(<?php echo htmlspecialchars($reviewCount); ?> customer reviews)</small></p>
                        <?php else: ?>
                            <span>No reviews yet</span>
                        <?php endif; ?>
                        </p>


                        <p class="text-muted mt-3"><?php echo htmlspecialchars($product['tagline']); ?></p>
                        <h3 class="mb-0 price fw-bold">£<?php echo htmlspecialchars($product['price']); ?></h3>
                        <hr>
                        <div class="row">
                            <div class="quantity col-4">
                                <button class="btn fw-semibold" id="decrease-quantity">-</button>
                                <input class="fw-semibold" type="number" id="quantity" value="1" min="1" style="width: 50px; text-align: center;" />
                                <button class="btn fw-semibold" id="increase-quantity">+</button>
                            </div>
                            <button class="btn bg-warning col-6 invers_btn" id="add-to-cart" data-id="<?php echo $product['id']; ?>">
                                <i class="fa-solid fa-basket-shopping mx-2"></i>Add to cart
                            </button>
                            <button class="btn col-1"><i class="fa fa-heart"></i></button>
                        </div>
                        </div>

                        <small class="text-muted d-block"><strong>Category:</strong> <a class="cat_name_p text-muted" href="#">category_name</a></small> <small class="d-inline">Share:</small>
                        <div class="social-share d-inline">
                            <a href="https://www.facebook.com/" class="text-muted"><i class="fa-brands fa-square-facebook"></i></a>
                            <a href="https://twitter.com/" class="text-muted"><i class="fa-brands fa-twitter"></i></a>
                            <a href="https://www.linkedin.com/" class="text-muted"><i class="fa-brands fa-linkedin"></i></a>
                            <a href="https://plus.google.com/" class="text-muted"><i class="fa-brands fa-google-plus"></i></a>
                            <a href="https://www.pinterest.com/" class="text-muted"><i class="fa-brands fa-pinterest"></i></a>
                            <a href="mailto:info@example.com" class="text-muted"><i class="fa fa-envelope"></i></a>
                        </div>
                        <hr>
                        <ul class="mt-3">
                            <li><small class="text-muted">Free global shipping on all orders</small></li>
                            <li><small class="text-muted">30 days easy returns if you change your mind</small></li>
                            <li><small class="text-muted">Order before noon for same day dispatch</small></li>
                        </ul>
                        <hr>
                        <div>
                            <small class="text-muted"><strong>Guaranteed Safe Checkout</strong></small>
                            <img src="assets/shop/images/garante_checkoutd.png" alt="">
                        </div>
                    </div>
                </div>
            </div>

            <div class="container mt-5 mb-5">
                <div class="row">
                    <div class="mb-5" style="display: flex; justify-content: center; gap: 20px;">
                        <button class="btn btn-lg drb" style="flex: 1; max-width: 150px;" id="btn-description">Description</button>
                        <button class="btn btn-lg drb" style="flex: 1; max-width: 150px;" id="btn-reviews">Reviews (5)</button>
                    </div>
                    <div class="row">
                        <div class="description text-muted" id="description-section">
                            <p><?php echo htmlspecialchars($product['desc']); ?></p><br>
                            <p><strong>Ingredients:</strong> <?php echo htmlspecialchars($product['ingredients']); ?></p>
                        </div>
                        <div class="customer_review mt-5" id="reviews-section">
                            <div class="row">
                                <div class="col-md-6 mb-5">
                                    <?php
                                    if (!empty($reviews)) {
                                        foreach ($reviews as $review) {
                                            echo '<div class="review border p-4 rounded shadow-sm mb-4">';
                                            echo '<div class="d-flex align-items-center">';
                                            echo '<img src="assets/shop/images/profile.png" alt="' . htmlspecialchars($review['name']) . '" class="profile-img rounded-circle" style="width: 50px; height: 50px; object-fit: cover;" />';
                                            echo '<div class="ms-3">';
                                            echo '<p><strong class="me-3">' . htmlspecialchars($review['name']) . '</strong>';
                                            echo '<span><i class="fa fa-clock"></i> ' . date('F j, Y, g:i a', strtotime($review['created_at'])) . '</span></p>';
                                            echo '<div>';
                                            for ($i = 1; $i <= 5; $i++) {
                                                echo '<span class="fa fa-star' . (($i <= $review['rating']) ? ' text-warning' : ' text-muted') . '"></span>';
                                            }
                                            echo '</div>';
                                            echo '<p class="text-muted mt-2">' . nl2br(htmlspecialchars($review['review'])) . '</p>';
                                            echo '</div>';
                                            echo '</div>';
                                            echo '</div>';
                                        }
                                    } else {
                                        echo '<h1 class="text-dark text-center mt-5 text-bold">No reviews yet.</h1>';
                                    }
                                    ?>
                                </div>


                                <div class="col-md-6">
                                    <p class="text-muted mb-3">Your email address will not be published. Required fields are
                                        marked <small class="text-danger">*</small></p>
                                    <form id="review-form" novalidate>
                                        <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($_GET['id']); ?>" />
                                        <div class="form-group">
                                            <label for="rating text-dark fw-semibold">Your rating <small class="text-danger">*</small></label>
                                            <div id="star-rating" class="star-rating" required>
                                                <span class="fa fa-star" data-value="1"></span>
                                                <span class="fa fa-star" data-value="2"></span>
                                                <span class="fa fa-star" data-value="3"></span>
                                                <span class="fa fa-star" data-value="4"></span>
                                                <span class="fa fa-star" data-value="5"></span>
                                            </div>
                                            <input type="hidden" id="rating-value" name="rating" value="0" required>
                                            <small class="text-danger" id="rating-error" style="display: none;">Please select a rating.</small>
                                        </div>
                                        <div class="form-group mt-2">
                                            <label for="review">Your review <small class="text-danger">*</small></label>
                                            <textarea id="review" class="form-control" rows="4" minlength="10" required></textarea>
                                            <div class="invalid-feedback">Please enter at least 10 characters for your review.</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Name <small class="text-danger">*</small></label>
                                            <input type="text" id="name" class="form-control" minlength="3" required />
                                            <div class="invalid-feedback">Please enter your name (at least 3 characters).</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email <small class="text-danger">*</small></label>
                                            <input type="email" id="email" class="form-control" required />
                                            <div class="invalid-feedback">Please enter a valid email address.</div>
                                        </div>
                                        <button class="btn btn-warning btn-lg order-now-btn" type="submit">Submit</button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
        </div>
        </div>
        </div>

        <div id="toast-container" class="position-fixed bottom-0 end-0 p-3" style="z-index: 1100;"></div>
    </main>
    <?php include './includes/footer.php' ?>
    <!-- Include jQuery from a CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const descriptionButton = document.getElementById('btn-description');
            const reviewsButton = document.getElementById('btn-reviews');
            const descriptionSection = document.getElementById('description-section');
            const reviewsSection = document.getElementById('reviews-section');

            // Show description and hide reviews by default
            descriptionSection.style.display = 'block';
            reviewsSection.style.display = 'none';

            descriptionButton.addEventListener('click', function() {
                descriptionSection.style.display = 'block';
                reviewsSection.style.display = 'none';
            });

            reviewsButton.addEventListener('click', function() {
                reviewsSection.style.display = 'block';
                descriptionSection.style.display = 'none';
            });
        });

        $(document).ready(function() {
            $('#add-to-cart').on('click', function() {
                let productId = $(this).data('id');
                let quantity = $('#quantity').val();

                $('#success-message').hide();
                $('#error-message').hide();
                $('.loader-bg').show(); // Show loader

                $.ajax({
                    url: './php/add_to_cart.php',
                    method: 'POST',
                    data: {
                        product_id: productId,
                        quantity: quantity
                    },
                    success: function(response) {
                        try {
                            if (typeof response === 'string') {
                                response = JSON.parse(response); // Parse if JSON string
                            }

                            if (response.status === 'success') {
                                $('#success-message p').text(response.product_name + '" has been added successfully');
                                $('#success-message').fadeIn();
                                $('.count-icon').text(response.cart_count); // Update cart count
                            } else {
                                $('#error-message p').text(response.message || 'An error occurred');
                                $('#error-message').fadeIn();
                            }
                        } catch (error) {
                            console.error("Parsing error:", error);
                            $('#error-message p').text('Unexpected response format');
                            $('#error-message').fadeIn();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX error:', status, error);
                        $('#error-message p').text('Failed to add product to cart');
                        $('#error-message').fadeIn();
                    },
                    complete: function() {
                        setTimeout(() => {
                            $('.loader-bg').fadeOut(); // Smoothly hide loader
                        }, 500); // Optional delay
                    }
                });
            });

            // Function to fetch and update cart count
            function updateCartCount() {
                $.ajax({
                    url: './php/get_cart_count.php',
                    method: 'GET',
                    success: function(response) {
                        try {
                            if (typeof response === 'string') {
                                response = JSON.parse(response);
                            }
                            if (response.status === 'success') {
                                $('#cart-count').text(response.count); // Update cart count badge
                                $('#cart-count-sm').text(response.count); // Update cart count badge
                            } else {
                                console.error('Error in response:', response.message);
                            }
                        } catch (error) {
                            console.error("Parsing error:", error);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Failed to fetch cart count:', status, error);
                    }
                });
            }

            // Initial cart count update on page load
            updateCartCount();
        });
        document.querySelectorAll('#star-rating .fa-star').forEach(star => {
            star.addEventListener('click', function() {
                const ratingValue = this.getAttribute('data-value');
                document.getElementById('rating-value').value = ratingValue;
                document.getElementById('rating-error').style.display = 'none';
                document.querySelectorAll('#star-rating .fa-star').forEach(s => s.classList.remove('text-warning'));
                for (let i = 0; i < ratingValue; i++) {
                    document.querySelectorAll('#star-rating .fa-star')[i].classList.add('text-warning');
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('review-form');

            form.addEventListener('submit', function(event) {
                // Check if the form is valid
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                // Add Bootstrap validation classes
                form.classList.add('was-validated');
            });

            // Handle star rating selection
            document.querySelectorAll('#star-rating .fa-star').forEach(star => {
                star.addEventListener('click', function() {
                    const ratingValue = this.getAttribute('data-value');
                    document.getElementById('rating-value').value = ratingValue;
                    document.getElementById('rating-error').style.display = 'none';
                    document.querySelectorAll('#star-rating .fa-star').forEach(s => s.classList.remove('text-warning'));
                    for (let i = 0; i < ratingValue; i++) {
                        document.querySelectorAll('#star-rating .fa-star')[i].classList.add('text-warning');
                    }
                });
            });
        });

        $(document).ready(function() {
            // Check if the review was successfully submitted
            if (sessionStorage.getItem('reviewSubmitted') === 'true') {
                // Show success toast
                showToast('Success', 'Review submitted successfully.', 'bg-success');
                // Remove the flag from session storage
                sessionStorage.removeItem('reviewSubmitted');
            }

            $('form').on('submit', function(e) {
                e.preventDefault();

                const formData = {
                    name: $('#name').val(),
                    email: $('#email').val(),
                    rating: $('#rating-value').val(),
                    review: $('#review').val(),
                    product_id: $('#product-id').val() || new URLSearchParams(window.location.search).get('id') // Fallback to URL parameter
                };


                $.ajax({
                    url: './php/submit_review.php', // Adjust the path as necessary
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            // Store a flag in session storage
                            sessionStorage.setItem('reviewSubmitted', 'true');
                            // Reload the page
                            location.reload();
                        } else {
                            showToast('Error', response.message, 'bg-danger');
                            console.error(response.message);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        showToast('Error', 'An error occurred while submitting your review.', 'bg-danger');
                        console.error('Error: ' + textStatus + ', ' + errorThrown);
                        console.error(jqXHR.responseText); // Log the error response for debugging
                    }
                });
            });

            function showToast(title, message, className) {
                const toastHtml = `
        <div class="toast ${className}" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="3000">
            <div class="toast-header">
                <strong class="me-auto">${title}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                ${message}
            </div>
        </div>
    `;

                $('#toast-container').append(toastHtml);
                const toast = new bootstrap.Toast($('#toast-container .toast').last()[0]);
                toast.show();
            }
        });
    </script>

    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>