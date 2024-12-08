<?php session_start() ?>
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
    <!-- swiper -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <!-- custom css -->
    <link rel="stylesheet" href="assets/shop/css/style.css">
    <link rel="stylesheet" href="assets/shop/css/animation.css">
    <link rel="stylesheet" href="assets/shop/css/navbar.css">
    <title>About Us</title>
</head>

<body>

    <!-- header -->
    <?php include  './includes/header.php'; ?>

    <!-- navbar -->
    <?php include  './includes/nav.php'; ?>
    <!-- Cart Slider -->
    <?php include  './includes/cartSlider.php'; ?>
    <!-- main section -->
    <main>
        <!-- Hero section -->

        <section class="op_hero_section"
            style="margin-bottom: 15vh;background-image: url(./assets/shop/images/breadcrumb1.jpg);">
            <div class="container-fluid">
                <h1 class="opht d-flex justify-content-center text-center">About</h1>
                <div>
                    <nav class="d-flex justify-content-center test-center"
                        style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
                        aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php?page=home" class="text-muted">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="index.php?page=about"
                                    class="text-dark">About Us</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </section>

        <article>
            <div class="container">
                <div class="row">
                    <div class="col-md-5 md-center">
                        <h1 class="fw-bold norican">Welcome!</h1>
                        <h1 class="fw-bold">Best burger ideas & traditions from the whole world</h1>
                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut
                            labore et dolore magna aliqua. Ut enim ad minim veniam.
                            <br><br>
                            Mauris tempus erat laoreet turpis lobortis, eu tincidunt erat fermentum. Aliquam non
                            tincidunt urna. Integer tincidunt nec nisl vitae ullamcorper. Proin sed ultrices erat.
                        </p>
                        <a href="index.php?page=contact" class="btn btn-warning order-now-btn fs-5 mt-4">Contact Now</a>
                    </div>
                    <div class="col-md-7 md-none">
                        <div class="row">
                            <div class="col-md-5">
                                <img class="img-fluid rounded img-hover animated-image"
                                    src="assets/shop/images/image1-h4.jpg" alt="">
                            </div>
                            <div class="col-md-7">
                                <div class="row">
                                    <div class="col-md-12">
                                        <img class="img-fluid rounded img-hover animated-image"
                                            src="assets/shop/images/image2-h4.jpg" alt="">
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <img class="img-fluid rounded img-hover animated-image"
                                            src="assets/shop/images/image3-h4.jpg" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>


        <section class="video-section mt-5 mb-5">
            <div class="video-container-fluid container-fluid">
                <div class="content-wrapper"
                    style="display: flex; flex-direction: column; justify-content: center; align-items: center; height: 100%;">
                    <!-- Video Play Button -->
                    <div class="video-button-wrapper">
                        <a id="play-video" class="video-play-button" href="javascript:void(0);">
                            <span></span>
                        </a>
                    </div>

                    <!-- Text Content -->
                    <div class="text-content text-white text-center mt-4">
                        <h1 class="fw-bold">Make the thing Anything is Possible</h1>
                        <br>
                        <p>Enjoy our luscious dishes wherever you want</p>
                        <br>
                        <a href="index.php?page=contact" class="btn btn-warning order-now-btn fs-5 mt-4">Contact Now</a>
                    </div>
                </div>
            </div>
        </section>

        <article>
            <div class="container md-none">
                <div class="row">
                    <!-- 1 -->
                    <div class="col-md-5 md-center">
                        <h3 class="fw-bold norican">Our Quality</h3><br>
                        <h1 class="fw-semibold">Chicken</h1><br>
                        <p class="text-muted">Quality is our #1 ingredient. That’s why our Chicken Wings, Chicken Bites
                            and Grilled Chicken Topping are made from chickens raised without antibiotics and fed an all
                            vegetable-grain diet, with no animal by-products. Plus, our Bites are made with 100% chicken
                            breast meat.</p>
                        <a href="#" class="btn btn-warning order-now-btn fs-5 mt-4">Contact Now</a>
                    </div>
                    <div class="col-md-7 justify-content-center d-flex mt-5">
                        <img src="assets/shop/images/about-imager-5.png" alt="" class="img-fluid animate from-right">
                    </div>
                </div>
                <!-- 2 -->
                <br><br>
                <div class="row">
                    <div class="col-md-7 justify-content-center d-flex mt-5">
                        <img src="assets/shop/images/about-imager-6.png" alt="" class="img-fluid animate from-left">
                    </div>
                    <div class="col-md-5 md-center">
                        <h3 class="fw-bold norican">Our Quality</h3><br>
                        <h1 class="fw-semibold">Burger</h1><br>
                        <p class="text-muted">Some of the world’s best cheese is made close to home! All our deliciously
                            melty Mozzarella is made with 100% Canadian milk. We’re proud to support Canadian dairy
                            farmers.</p>
                        <a href="index.php?page=contact" class="btn btn-warning order-now-btn fs-5 mt-4">Contact Now</a>
                    </div>

                </div>
                <!-- 3 -->
                <br><br>
                <div class="row">
                    <div class="col-md-5 md-center">
                        <h3 class="fw-bold norican">Our Quality</h3><br>
                        <h1 class="fw-semibold">Pizza Douche</h1><br>
                        <p class="text-muted">Quality is our #1 ingredient. That’s why our Chicken Wings, Chicken Bites
                            and Grilled Chicken Topping are made from chickens raised without antibiotics and fed an all
                            vegetable-grain diet, with no animal by-products. Plus, our Bites are made with 100% chicken
                            breast meat.</p>
                        <a href="index.php?page=contact" class="btn btn-warning order-now-btn fs-5 mt-4">Contact Now</a>
                    </div>
                    <div class="col-md-7 justify-content-center d-flex mt-5">
                        <img src="assets/shop/images/about-imager-7.png" alt="" class="img-fluid animate from-right">
                    </div>
                </div>
            </div>
            <!-- for md -->
            <div class="container lg-none">
                <div class="row">
                    <!-- 1 -->
                    <div class="col-md-7 justify-content-center d-flex mt-5">
                        <img src="assets/shop/images/about-imager-5.png" alt="" class="img-fluid animate from-right">
                    </div>
                    <div class="col-md-5 md-center">
                        <h3 class="fw-bold norican">Our Quality</h3><br>
                        <h1 class="fw-semibold">Chicken</h1><br>
                        <p class="text-muted">Quality is our #1 ingredient. That’s why our Chicken Wings, Chicken Bites
                            and Grilled Chicken Topping are made from chickens raised without antibiotics and fed an all
                            vegetable-grain diet, with no animal by-products. Plus, our Bites are made with 100% chicken
                            breast meat.</p>
                        <a href="index.php?page=contact" class="btn btn-warning order-now-btn fs-5 mt-4">Contact Now</a>
                    </div>

                </div>
                <!-- 2 -->
                <br><br>
                <div class="row">
                    <div class="col-md-7 justify-content-center d-flex mt-5">
                        <img src="assets/shop/images/about-imager-6.png" alt="" class="img-fluid animate from-right">
                    </div>
                    <div class="col-md-5 md-center">
                        <h3 class="fw-bold norican">Our Quality</h3><br>
                        <h1 class="fw-semibold">Burger</h1><br>
                        <p class="text-muted">Some of the world’s best cheese is made close to home! All our deliciously
                            melty Mozzarella is made with 100% Canadian milk. We’re proud to support Canadian dairy
                            farmers.</p>
                        <a href="index.php?page=contact" class="btn btn-warning order-now-btn fs-5 mt-4">Contact Now</a>
                    </div>

                </div>
                <!-- 3 -->
                <br><br>
                <div class="row">
                    <div class="col-md-7 justify-content-center d-flex mt-5">
                        <img src="assets/shop/images/about-imager-7.png" alt="" class="img-fluid animate from-right">
                    </div>
                    <div class="col-md-5 md-center">
                        <h3 class="fw-bold norican">Our Quality</h3><br>
                        <h1 class="fw-semibold">Pizza Douche</h1><br>
                        <p class="text-muted">Quality is our #1 ingredient. That’s why our Chicken Wings, Chicken Bites
                            and Grilled Chicken Topping are made from chickens raised without antibiotics and fed an all
                            vegetable-grain diet, with no animal by-products. Plus, our Bites are made with 100% chicken
                            breast meat.</p>
                        <a href="index.php?page=contact" class="btn btn-warning order-now-btn fs-5 mt-4">Contact Now</a>
                    </div>
                </div>
            </div>
        </article>

        <!-- clients section -->
        <section class="clients-section py-5 mt-5 mb-5">
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
        <!-- staf -->
        <section>
            <div class="container">
                <div class="row">
                    <div class="mt-3 text-center">
                        <h3 class="norican">Always Quality</h3>
                        <h1 class="fw-bold">Our Talented Chefs</h1>
                    </div>
                    <div class="col-md-4">
                        <div class="card mt-3">
                            <img src="assets/shop/images/box-team-1-2.jpg" class="card-img-top" alt="...">
                            <p class="text-dark text-uppercase staf-badge text-center">Chef</p>
                            <div class="card-body text-center">
                                <h5 class="card-title fw-bold text-hover">Chef William Smith</h5>
                                <p class="card-text text-muted fs-6 text-muted">Everything We Pizza, We Pizza With Love.
                                    Designer Fastfood.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mt-3">
                            <img src="assets/shop/images/box-team-2-1.jpg" class="card-img-top" alt="...">
                            <p class="text-dark text-uppercase staf-badge text-center">Menager</p>
                            <div class="card-body text-center">
                                <h5 class="card-title fw-bold text-hover">John Doe</h5>
                                <p class="card-text text-muted fs-6 text-muted">Everything We Pizza, We Pizza With Love.
                                    Designer Fastfood.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mt-3">
                            <img src="assets/shop/images/box-team-6-1.jpg" class="card-img-top" alt="...">
                            <p class="text-dark text-uppercase staf-badge text-center">chef</p>
                            <div class="card-body text-center">
                                <h5 class="card-title fw-bold text-hover">Bradd</h5>
                                <p class="card-text text-muted fs-6 text-muted">Everything We Pizza, We Pizza With Love.
                                    Designer Fastfood.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

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
                            $('#success-message').show().delay(6000).fadeOut();
                            successMessageShown = true;
                            location.reload(); // Reload the page to update cart items
                        } else if (result.status === 'error') {
                            $('#error-message').show().delay(6000).fadeOut();
                            successMessageShown = false;
                        }
                    },
                    error: function() {
                        $('#error-message').show().delay(6000).fadeOut();
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
                            $('#error-message').text(result.message).show().delay(6000).fadeOut();
                        }
                    },
                    error: function() {
                        $('#error-message').show().delay(6000).fadeOut();
                    }
                });

            });
        }); 


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

                            $('.cart-count').text(response.cart_count); // Update both cart counts

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
                            $('.cart-count').text(response.count); // Update both cart counts
                        }
                    }
                });
            }

            updateCartCount();

        });
        
        document.addEventListener("DOMContentLoaded", () => {
            const animatedElements = document.querySelectorAll(".animate");

            const observer = new IntersectionObserver(
                (entries) => {
                    entries.forEach((entry) => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add("active");
                        }
                    });
                }, {
                    threshold: 0.1
                } // Trigger when 10% of the element is visible
            );

            animatedElements.forEach((el) => observer.observe(el));
        });
    </script>
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

        document.addEventListener("DOMContentLoaded", () => {
            const images = document.querySelectorAll(".animated-image");
            images.forEach((image, index) => {
                setTimeout(() => {
                    image.classList.add("animate");
                }, index * 300); // Stagger animations with a delay
            });
        });
    </script>

    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>