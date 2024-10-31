<?php
// Include necessary configuration and class files
require_once './admin/config/config.php';
require './admin/php/ProductController.php';
// Create a new database connection
$database = new Database();
$dbConnection = $database->conn;


// Create a new instance of ProductController
$productController = new ProductController($dbConnection);
// Get the product ID from the URL
$productId = isset($_GET['id']) ? $_GET['id'] : null;

// if ($productId) {
//     // Fetch product details
$product = $productController->getProduct($productId);
//     if (!$product) {
//         // Handle product not found
//         echo "Product not found.";
//         exit;
//     }
// } else {
//     // Handle case where no product ID is provided
//     echo "No product selected.";
//     exit;
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <title><?php echo htmlspecialchars($product['name']); ?></title>
    <style>
        .zoom-area {
            /* margin: 50px auto; */
            position: relative;
            /* cursor: none */
        }

        .form-control:focus {
            border: 0.5px solid var(--primary);
            outline: none !important;
            box-shadow: none;
        }

        @media (max-width: 991px) {
            .zoom-area {
                left: -100px;
            }
        }

        @media (max-width: 767px) {
            .zoom-area {
                left: 0px;
            }
        }

        /* for create magnify glass */
        .large {
            width: 175px;
            height: 175px;
            position: absolute;
            border-radius: 100%;

            /* for box shadow for glass effect */
            box-shadow: 0 0 0 7px rgba(255, 255, 255, 0.85),
                0 0 7px 7px rgba(0, 0, 0, 0.25),
                inset 0 0 40px 2px rgba(0, 0, 0, 0.25);

            /*for hide the glass by default*/
            display: none;
        }

        .small {
            display: block;
        }
    </style>
</head>

<body>

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
                            // Check if the product has a rating
                            $rating = isset($product['rating']) ? $product['rating'] : 0; // Default to 0 if not set
                            $reviewCount = isset($product['review_count']) ? $product['review_count'] : 0; // Assuming you have a review count field

                            // Display stars based on product rating
                            for ($i = 1; $i <= 5; $i++) {
                                // Set star color based on rating
                                $starClass = ($i <= $rating) ? 'fa-star checked' : 'fa-star text-muted';
                                echo '<span class="fa ' . $starClass . '"></span>';
                            }
                           
                       echo " </div>";
                       echo ' <p class="customer_reviews_trigger mx-2 text-muted d-inline">(' . htmlspecialchars($reviewCount) . ' customer reviews)</p>';
                        ?> 
                        <p class="text-muted mt-3"><?php echo htmlspecialchars($product['tagline']); ?></p>
                        <h3 class="mb-0 price fw-bold">£<?php echo htmlspecialchars($product['price']); ?></h3>
                        <hr>
                        <div class="row">
                            <div class="quantity col-4">
                                <button class="btn fw-semibold" id="decrease-quantity">-</button>
                                <input class="fw-semibold" type="number" id="quantity" value="1" min="1" style="width: 50px; text-align: center;" />
                                <button class="btn fw-semibold" id="increase-quantity">+</button>
                            </div>
                            <button class="btn bg-warning col-6 invers_btn"><i class="fa-solid fa-basket-shopping mx-2"></i>Add to cart</button>
                            <button class="btn col-1"><i class="fa fa-heart"></i></button>
                        </div>

                        <small class="text-muted d-block"><strong>Category:</strong> <a class="cat_name_p text-muted" href="#"><?php echo htmlspecialchars($product['category_name']); ?></a></small>                        <small class="d-inline">Share:</small>
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

            <div class="container-fluid mt-5 mb-5">
                <div class="row">
                    <div class="mb-5" style="display: flex; justify-content: center; gap: 20px;">
                        <button class="btn btn-lg drb" style="flex: 1; max-width: 150px;" id="btn-description">Description</button>
                        <button class="btn btn-lg drb" style="flex: 1; max-width: 150px;" id="btn-reviews">Reviews (5)</button>
                    </div>
                    <div class="row">
                        <div class="description text-muted" id="description-section">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium distinctio quidem modi
                                laborum quaerat vitae mollitia ipsum tenetur culpa. Placeat quia iste sunt ipsam natus
                                voluptates, consectetur tenetur obcaecati autem.</p>
                            <p><strong>Ingredients:</strong> Dr. Praeger’s Black Bean Burger, Focaccia bun, Balsamic
                                Vinaigrette, Pesto, Tomato, Swiss Cheese</p>
                        </div>
                        <div class="customer_review mt-5" id="reviews-section customer_review" style="display: none;">
                            <div class="row">
                                <div class="col-md-6 mb-5">
                                    <div class="review">
                                        <div class="d-flex align-items-center"> <!-- Flex container -->
                                            <img src="../admin/uploads/default.png" alt="Duc Pham" class="profile-img" />
                                            <div class="ms-2"> <!-- Margin start for spacing -->
                                                <div>
                                                    <span class="fa fa-star text-warning"></span>
                                                    <span class="fa fa-star text-warning"></span>
                                                    <span class="fa fa-star text-warning"></span>
                                                    <span class="fa fa-star text-warning"></span>
                                                    <span class="fa fa-star text-warning"></span>
                                                </div>
                                                <p><strong class="me-3">Duc Pham</strong> <span><i class="fa fa-clock"></i>
                                                        September 4, 2020</span></p>
                                            </div>
                                        </div>
                                        <p class="text-muted">I am 6 feet tall and 220 lbs. This shirt fit me perfectly in
                                            the chest and
                                            shoulders. My only complaint is that it is so long! I like to wear polo shirts
                                            untucked. This shirt goes completely past my rear end. If I wore it with
                                            ordinary shorts, you probably wouldn't be able to see the shorts at all –
                                            completely hidden by the shirt. It needs to be 4 to 5 inches shorter in terms of
                                            length to suit me. I have many RL polo shirts, and this one is by far the
                                            longest. I don't understand why.</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <p class="text-muted mb-3">Your email address will not be published. Required fields are
                                        marked <small class="text-danger">*</small></p>
                                    <form>
                                        <div class="form-group">
                                            <label for="rating text-dark fw-semibold">Your rating <small
                                                    class="text-danger">*</small></label>
                                            <div id="star-rating" class="star-rating" required>
                                                <span class="fa fa-star" data-value="1"></span>
                                                <span class="fa fa-star" data-value="2"></span>
                                                <span class="fa fa-star" data-value="3"></span>
                                                <span class="fa fa-star" data-value="4"></span>
                                                <span class="fa fa-star" data-value="5"></span>
                                            </div>
                                            <input type="hidden" id="rating-value" name="rating" value="0" required>
                                            <small class="text-danger" id="rating-error" style="display: none;">Please
                                                select a rating.</small>
                                        </div>
                                        <div class="form-group mt-2">
                                            <label for="review">Your review <small class="text-danger">*</small></label>
                                            <textarea id="review" class="form-control" rows="4" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Name <small class="text-danger">*</small></label>
                                            <input type="text" id="name" class="form-control" required />
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email <small class="text-danger">*</small></label>
                                            <input type="email" id="email" class="form-control" required />
                                        </div>
                                        <button class="btn btn-warning btn-lg order-now-btn" type="submit">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Related Products -->
            <div class="container-fluid mt-5 mb-5">
                <div class="row">
                    <div class="text-center">
                        <h1 class="mb-5">Related products</h1>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="card myCard" style="width: 100%;border-radius: 15px;">
                            <div class="card-img-wrapper">
                                <i class="fas fa-heart favorite_icon"></i>
                                <img src="../admin/uploads/products/671fbd6503d1a_Apricot_Chicken.png"
                                    class="card-img-top card-img" alt="">
                            </div>
                            <div class="card-body">
                                <p>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </p>
                                <h5 class="card-title myCardText">Vegge Lover</h5>
                                <p class="card-text" style="color: #999999; font-size: 13px;">Extra-virgin olive oil,
                                    garlic,...</p>
                                <p class="price d-inline fs-3">$14.90</p>
                                <a href="#" class="btn p-0 position-absolute" style="right: 0;margin: 20px;">
                                    <i class="fa-solid fa-basket-shopping myCart"
                                        style="background-color: var(--primary);"></i>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
    </main>
    <?php include './includes/footer.php' ?>
    <!-- Include jQuery from a CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="assets/shop/js/product.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>