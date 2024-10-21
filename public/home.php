<?php
// Include necessary configuration and class files
require_once './config/config.php';
require_once './admin/php/ProductController.php';

// Create a new database connection
$database = new Database();
$dbConnection = $database->conn;

// Pass the database connection to the ProductController
$productController = new ProductController($dbConnection);

// Get all products
$products = $productController->getProducts();

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
    <!-- swiper -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <!-- custom css -->
    <link rel="stylesheet" href="assets/shop/css/style.css">
    <link rel="stylesheet" href="assets/shop/css/animation.css">
    <link rel="stylesheet" href="assets/shop/css/navbar.css">
    <title>Shop</title>
</head>

<body>
    <!-- header -->
    <?php include  './includes/header.php'; ?>

    <!-- navbar -->
    <?php include  './includes/nav.php'; ?>

    <!-- hero section -->
    <section class="hero-section py-5 position-relative">
        <img src="assets/shop/images/h_flour.png" alt="Flour Background" class="hero-background d-none d-lg-block">
        <img src="assets/shop/images/h1_left_leaf.png" alt="Leaf" class="h1_left_leaf">
        <img src="assets/shop/images/h2_right_leaf.png" alt="Leaf" class="h2_right_leaf ">
        <img src="assets/shop/images/h2_mushroom.png" alt="Mushroom" class="h2_mushroom ">
        <img src="assets/shop/images/h1_tomato.png" alt="Tomato" class="h1_tomato">
        <img src="assets/shop/images/h1_mint.png" alt="Mint" class="h1_mint">
        <div class="container position-relative">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4 hero-title">UNLIMITED MEDIUM <span>PIZZAS</span></h1>
                    <h2 class="h3 mb-3">Medium 2-topping* pizza</h2>
                    <p class="mb-4">*Additional charge for premium toppings. Minimum of 2 required.</p>
                    <a href="#" class="btn btn-primary btn-lg order-now-btn">ORDER NOW</a>
                </div>
                <div class="col-lg-6 mt-4">
                    <div class="d-flex justify-content-center position-relative" style="height: 100%;">
                        <img src="assets/shop/images/h_sprinkle.png" alt="Sprinkle Background"
                            class="position-absolute h_sprinkle d-none d-lg-block">
                        <img src="assets/shop/images/h_pizza.png" alt="Delicious Pizza"
                            class="img-fluid rounded position-relative pizza-image"
                            style="max-height: 100%; width: auto; z-index: 2;filter: brightness(0.90);">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="container position-relative">
        <div class="row align-items-center">
            <div class="d-flex justify-content-center position-relative" style="top: -28px;">
                <a href="#" class="btn order-now-btn fs-5">MENU</a>
            </div>
        </div>
    </div>

    <!-- main section -->
    <main>
        <!-- category-section -->
        <section class="category-section">
            <div class="container">
                <div class="row justify-content-center text-center col-lg gap-lg-5 align-items-end">
                    <div class="col-6 col-sm-6 col-md-3 col-lg-1 mb-4 product-cat">
                        <a href="#" class="link_category_product">
                            <div class="img-wrapper position-relative">
                                <img src="assets/shop/images/category-1.png" alt="Category 1" class="">
                            </div>
                            <span class="cat-title text-uppercase">combo</span>
                            <div class="hover-circle"
                                style="background-image: url('assets/shop/images/hy-circle.png');z-index: -3;"></div>
                        </a>
                    </div>
                    <div class="col-6 col-sm-6 col-md-3 col-lg-1 mb-4 product-cat">
                        <a href="#" class="link_category_product">
                            <div class="img-wrapper position-relative">
                                <img src="assets/shop/images/category-2.png" alt="Category 2" class="">
                            </div>
                            <span class="cat-title">kids menu</span>
                            <div class="hover-circle"
                                style="background-image: url('assets/shop/images/hy-circle.png');z-index: -3;"></div>
                        </a>
                    </div>
                    <div class="col-6 col-sm-6 col-md-3 col-lg-1 mb-4 product-cat">
                        <a href="#" class="link_category_product">
                            <div class="img-wrapper position-relative">
                                <img src="assets/shop/images/category-3.png" alt="Category 3" class="img-fluid">
                            </div>
                            <span class="cat-title">pizza</span>
                            <div class="hover-circle"
                                style="background-image: url('assets/shop/images/hy-circle.png');z-index: -3;"></div>
                        </a>
                    </div>
                    <div class="col-6 col-sm-6 col-md-3 col-lg-1 mb-4 product-cat">
                        <a href="#" class="link_category_product">
                            <div class="img-wrapper position-relative">
                                <img src="assets/shop/images/category-4.png" alt="Category 4" class="img-fluid">
                            </div>
                            <span class="cat-title">box meals</span>
                            <div class="hover-circle"
                                style="background-image: url('assets/shop/images/hy-circle.png');z-index: -3;"></div>
                        </a>
                    </div>
                    <div class="col-6 col-sm-6 col-md-3 col-lg-1 mb-4 product-cat">
                        <a href="#" class="link_category_product">
                            <div class="img-wrapper position-relative">
                                <img src="assets/shop/images/category-5.png" alt="Category 5" class="img-fluid">
                            </div>
                            <span class="cat-title">burger</span>
                            <div class="hover-circle"
                                style="background-image: url('assets/shop/images/hy-circle.png');z-index: -3;"></div>
                        </a>
                    </div>
                    <div class="col-6 col-sm-6 col-md-3 col-lg-1 mb-4 product-cat">
                        <a href="#" class="link_category_product">
                            <div class="img-wrapper position-relative">
                                <img src="assets/shop/images/category-6.png" alt="Category 6" class="img-fluid">
                            </div>
                            <span class="cat-title">chicken</span>
                            <div class="hover-circle"
                                style="background-image: url('assets/shop/images/hy-circle.png');z-index: -3;"></div>
                        </a>
                    </div>
                    <div class="col-6 col-sm-6 col-md-3 col-lg-1 mb-4 product-cat">
                        <a href="#" class="link_category_product">
                            <div class="img-wrapper position-relative">
                                <img src="assets/shop/images/category-7.png" alt="Category 7" class="img-fluid">
                            </div>
                            <span class="cat-title">sauces</span>
                            <div class="hover-circle"
                                style="background-image: url('assets/shop/images/hy-circle.png');z-index: -3;"></div>
                        </a>
                    </div>
                    <div class="col-6 col-sm-6 col-md-3 col-lg-1 mb-4 product-cat">
                        <a href="#" class="link_category_product">
                            <div class="img-wrapper position-relative">
                                <img src="assets/shop/images/category-8.png" alt="Category 8" class="img-fluid">
                            </div>
                            <span class="cat-title">drinks</span>
                            <div class="hover-circle"
                                style="background-image: url('assets/shop/images/hy-circle.png');z-index: -3;"></div>
                        </a>
                    </div>
                </div>
            </div>

        </section>

        <!-- offers section -->
        <section class="offers-section mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="offer-card bg-white">
                            <div class="row g-0 h-100">
                                <div class="col-6">
                                    <div class="card-body d-flex flex-column h-100">
                                        <h5 class="card-title text-dark">Any day <br> offers</h5>
                                        <p class="card-text flex-grow-1">New phenomenon burger taste</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="img-wrapper">
                                        <img src="assets/shop/images/hy-circle.png" alt="Hover Circle"
                                            class="hover-circle">
                                        <img src="assets/shop/images/offer1.png" class="img-fluid" alt="Offer 1"
                                            style="width: 150px !important;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="offer-card" style="background-image: url('assets/shop/images/offer-c2bg.jpg');">
                            <div class="row g-0 h-100">
                                <div class="col-6">
                                    <div class="card-body d-flex flex-column h-100">
                                        <h5 class="card-title text-white">Other flavors</h5>
                                        <p class="card-text flex-grow-1 text-white">Save room. We made salads</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="img-wrapper">
                                        <div class="hover-circle"
                                            style="background-image: url('assets/shop/images/hr-circle.png');"></div>
                                        <img src="assets/shop/images/offer2.png" class="img-fluid" alt="Offer 2"
                                            style="right: 0 !important;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="offer-card bg-white">
                            <div class="row g-0 h-100">
                                <div class="col-6">
                                    <div class="card-body d-flex flex-column h-100">
                                        <h5 class="card-title">Find a Poco store near you</h5>
                                        <p class="card-text flex-grow-1">Discover our locations</p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="img-wrapper">
                                        <div class="hover-circle"
                                            style="background-image: url('assets/shop/images/hw_circle.png');"></div>
                                        <img src="assets/shop/images/location.png" class="img-fluid" alt="Offer 3"
                                            style="width: 150px !important;top: 7px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Products-section -->
        <section class="products-section">
            <div class="container">
                <h1>Popular dishes</h1>
                <div class="row">
                    <div class="col-md-3">
                        <div class="card" style="width: 18rem;">
                            <img src="..." class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                <a href="#" class="btn"><i class="fas fa-shopping-cart myCart"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>

        <!-- clients section -->
        <section class="clients-section py-5">
            <div class="container">
                <h2 class="text-dark text-center mb-5">What Our Clients Say</h2>
                <div class="clients-slider overflow-hidden">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="client-card">
                                <img src="assets/shop/images/avatar-3.jpg" alt="Client 1" class="client-image">
                                <h4 class="client-name">John Doe</h4>
                                <p class="client-review">"The pizza here is absolutely amazing! The crust is perfectly
                                    crispy, and the toppings are always fresh. I'm a regular customer now!"</p>
                                <div class="client-rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="client-card">
                                <img src="assets/shop/images/avatar-2.jpg" alt="Client 2" class="client-image">
                                <h4 class="client-name">James Smith</h4>
                                <p class="client-review">"I love the variety of options on the menu. The combo meals are
                                    a great value, and the service is always friendly and quick."</p>
                                <div class="client-rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="client-card">
                                <img src="assets/shop/images/avatar-4.jpg" alt="Client 3" class="client-image">
                                <h4 class="client-name">Mike Johnson</h4>
                                <p class="client-review">"The delivery is always on time, and the food arrives hot and
                                    fresh. It's my go-to place for a quick and delicious meal!"</p>
                                <div class="client-rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="client-card">
                                <img src="assets/shop/images/avatar-3.jpg" alt="Client 1" class="client-image">
                                <h4 class="client-name">John Doe</h4>
                                <p class="client-review">"The pizza here is absolutely amazing! The crust is perfectly
                                    crispy, and the toppings are always fresh. I'm a regular customer now!"</p>
                                <div class="client-rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="client-card">
                                <img src="assets/shop/images/avatar-2.jpg" alt="Client 2" class="client-image">
                                <h4 class="client-name">James Smith</h4>
                                <p class="client-review">"I love the variety of options on the menu. The combo meals are
                                    a great value, and the service is always friendly and quick."</p>
                                <div class="client-rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="client-card">
                                <img src="assets/shop/images/avatar-4.jpg" alt="Client 3" class="client-image">
                                <h4 class="client-name">Mike Johnson</h4>
                                <p class="client-review">"The delivery is always on time, and the food arrives hot and
                                    fresh. It's my go-to place for a quick and delicious meal!"</p>
                                <div class="client-rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </section>

        <!-- hero 2 section -->
        <section class="hero-2-section">
            <div class="container-fluid">
                <div class="row overflow-hidden">
                    <div class="col-lg-4 hero2-col-lg-4 p-0 position-relative">
                        <div class="h2h-b"></div>
                        <div class="hero2-content-1">
                            <div class="img-wrapper">
                                <img src="assets/shop/images/h2-1.png" alt="Hero 2" class="img-fluid">
                            </div>
                            <div class="content">
                                <h2>Fast Food</h2>
                                <h1>Meals</h1>
                                <p class="text-white">New phenomenon <br> burger taste</p>
                                <p class="price">$19.90</p>
                                <a href="#" class="btn wb-btn">Order Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 hero2-col-lg-4 p-0 position-relative">
                        <div class="hero2-content-2">
                            <div class="h2h-b"></div>
                            <div class="img-wrapper">
                                <img src="assets/shop/images/h2-2.png" alt="Hero 2" class="img-fluid">
                            </div>
                            <div class="content">
                                <h2>Fast Food</h2>
                                <h1>Meals</h1>
                                <p class="text-white" style="line-height: 1.5rem;">New phenomenon <br> burger taste</p>
                                <p class="price">$19.90</p>
                                <a href="#" class="btn wb-btn">Order Now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 hero2-col-lg-4 p-0 position-relative">
                        <div class="hero2-content-3">
                            <div class="h2h-b"></div>
                            <div class="img-wrapper">
                                <img src="assets/shop/images/h2-3.png" alt="Hero 2" class="img-fluid "
                                    style="top: -4rem;">
                            </div>
                            <div class="content">
                                <h2>Fast Food</h2>
                                <h1>Meals</h1>
                                <p class="text-white">New phenomenon <br> burger taste</p>
                                <p class="price">$19.90</p>
                                <a href="#" class="btn wb-btn">Order Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- blog section -->
        <section class="blog-section">
            <div class="container">
                <h1>Latest News</h1>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <img src="assets/shop/images/blog-1.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <small class="text-muted">Posted at: July 1, 2023</small>
                                <h5 class="card-title">10 Reasons To Do A Digital Detox Challenge</h5>
                                <p class="card-text text-muted">Ac haca ullamcorper donec ante habi tasse donec
                                    imperdiet eturpis varius per a augue magna hac. Nec hac…</p>
                                <a href="#" class="btn btn-primary btn-lg order-now-btn"
                                    style="margin-top: 1.5rem;">Read More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <img src="assets/shop/images/blog-2.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <small class="text-muted">Posted at: July 2, 2023</small>
                                <h5 class="card-title">The Ultimate Hangover Burger: Egg in a Hole Burger Grilled Cheese
                                </h5>
                                <p class="card-text text-muted">Ac haca ullamcorper donec ante habi tasse donec
                                    imperdiet eturpis varius per a augue magna hac. Nec hac…</p>
                                <a href="#" class="btn btn-primary btn-lg order-now-btn"
                                    style="margin-top: 1.5rem;">Read More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <img src="assets/shop/images/blog-3.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <small class="text-muted">Posted at: July 3, 2023</small>
                                <h5 class="card-title">Traditional Soft Pretzels with Sweet Beer Cheese</h5>
                                <p class="card-text text-muted">Ac haca ullamcorper donec ante habi tasse donec
                                    imperdiet eturpis varius per a augue magna hac. Nec hac…</p>
                                <a href="#" class="btn btn-primary btn-lg order-now-btn"
                                    style="margin-top: 1.5rem;">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- footer section -->
        <?php include './includes/footer.php' ?>

    </main>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper('.clients-slider', {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            touchEventsTarget: 'container',
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
            }
        });
    </script>
    </script>
    <script src="assets/shop/js/animation.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>