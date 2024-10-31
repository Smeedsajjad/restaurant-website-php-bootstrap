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
    <title>Shop</title>
</head>

<body>
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
                        <small class="text-muted mb-5">Showing 1-24 of 54 Results</small>
                    </div>
                    <div class="row">
                        <?php if (count($products) > 0): ?>
                            <?php foreach ($products as $product): ?>
                                <div class="col-md-4 col-sm-6">
                                    <a href="index.php?page=product&id=<?php echo $product['id']; ?>" class="text-decoration-none">
                                        <div class="card myCard col-sm mt-3" style="width: 100%;border-radius: 15px;">
                                            <div class="card-img-wrapper">
                                                <i class="fas fa-heart favorite_icon"></i>
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
                                                <a href="#" class="btn p-0 position-absolute" style="right: 0;margin: 20px;">
                                                    <i class="fas fa-shopping-cart myCart" style="background-color: var(--primary);"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </a>
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
                            <h5 class="fw-bold ">Categories</h5>
                            <ul class="product-categories list-unstyled">
                                <li class="cat-item">
                                    <a href="#" class="text-muted">
                                        <span>Burgers</span>
                                        <span class="count">(9)</span>
                                    </a>
                                </li>
                                <li class="cat-item">
                                    <a href="#" class="text-muted">
                                        <span>Pizzas</span>
                                        <span class="count">(12)</span>
                                    </a>
                                </li>
                                <li class="cat-item">
                                    <a href="#" class="text-muted">
                                        <span>Salads</span>
                                        <span class="count">(8)</span>
                                    </a>
                                </li>
                                <li class="cat-item">
                                    <a href="#" class="text-muted">
                                        <span>Sandwiches</span>
                                        <span class="count">(10)</span>
                                    </a>
                                </li>
                                <li class="cat-item">
                                    <a href="#" class="text-muted">
                                        <span>Breakfast</span>
                                        <span class="count">(7)</span>
                                    </a>
                                </li>
                                <li class="cat-item">
                                    <a href="#" class="text-muted">
                                        <span>Uncategorized</span>
                                        <span class="count">(0)</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="input-group mt-5 mb-5">
                            <input type="text" placeholder="Search Product" class="afs form-control">
                            <div class="input-group-append">
                                <i class="fas fa-search"></i>
                            </div>
                        </div>
                        <div>
                            <form class="text-center mb-5">
                                <h5 class="fw-bold text-start mb-3">Filter by price</h5>
                                <input type="range" id="priceRangeSlider" min="0" max="100" step="1" value="50">
                                <p id="priceRange" class="text-muted text-start mb-3 mt-2">Price: $0 - $1000</p>
                                <button type="submit"
                                    class="filter_submit_btn btn d-flex justify-content-start rounded-3 fw-bold">FILTER</button>
                            </form>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </main>
    <!-- footer section -->
    <?php include './includes/footer.php' ?>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        const priceRangeSlider = document.getElementById("priceRangeSlider");
        const priceRange = document.getElementById("priceRange");

        const totalMinPrice = 0; // Minimum price in dollars
        const totalMaxPrice = 20; // Maximum price in dollars

        function updatePriceRange() {
            const sliderValue = priceRangeSlider.value; // 0 to 100
            const minPrice = Math.round((totalMaxPrice - totalMinPrice) * (sliderValue / 100));
            const maxPrice = totalMaxPrice - minPrice;

            // Display the range
            priceRange.textContent = `Price: $${minPrice} - $${maxPrice}`;
        }

        // Update the range display on input change
        priceRangeSlider.addEventListener("input", updatePriceRange);

        // Initialize display
        updatePriceRange();
    </script>
</body>

</html>