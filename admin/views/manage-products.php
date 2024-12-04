<?php
// Include necessary configuration and class files
require_once './config/config.php';
require_once './php/ProductController.php';

// Create a new database connection
$database = new Database();
$dbConnection = $database->conn;

// Pass the database connection to the ProductController
$productController = new ProductController($dbConnection);

// Get all products
$products = $productController->getProducts();

// Handle search
if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
    $products = $productController->searchProducts($searchTerm);
} else {
    $products = $productController->getProducts();
}

// Handle delete product
if (isset($_POST['delete_product'])) {
    $product_id = $_POST['product_id'];
    if ($productController->deleteProduct($product_id)) {
        // Deletion successful
        $products = $productController->getProducts();
        echo "
        <div class='toast align-items-center text-bg-success position-fixed top-0 end-0 m-3' role='alert' aria-live='assertive' aria-atomic='true' id='successToast' style='min-width: 300px;'>
            <div class='d-flex'>
                <div class='toast-body'>
                    <span>
                        <img class='me-2' src='./assets/images/done.gif' style='width: 85px;' alt=''>
                    </span>Product deleted successfully!
                    <div class='progress mt-2'>
                        <div class='progress-bar bg-light' role='progressbar' style='width: 100%' aria-valuenow='100' aria-valuemin='0' aria-valuemax='100'></div>
                    </div>
                </div>
                <button type='button' class='btn-close me-2 m-auto' data-bs-dismiss='toast' aria-label='Close'></button>
            </div>
        </div>
        ";
    } else {
        // Deletion failed
        echo "
        <div class='toast align-items-center text-bg-danger position-fixed top-0 end-0 m-3' role='alert' aria-live='assertive' aria-atomic='true' id='errorToast' style='min-width: 300px;'>
            <div class='d-flex'>
                <div class='toast-body'>
                    <span>
                        <img class='me-2' src='./assets/images/danger.gif' style='width: 85px;' alt=''>
                    </span> Failed to delete product.
                    <div class='progress mt-2'>
                        <div class='progress-bar bg-light' role='progressbar' style='width: 100%' aria-valuenow='100' aria-valuemin='0' aria-valuemax='100'></div>
                    </div>
                </div>
                <button type='button' class='btn-close me-2 m-auto' data-bs-dismiss='toast' aria-label='Close'></button>
            </div>
        </div>
        ";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
    <!-- ICONS -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="./assets/css/nav.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
    <!-- Make sure to include the Phosphor Icons library -->
    <link href="https://unpkg.com/phosphor-icons@1.4.1/css/phosphor.css" rel="stylesheet">

    <style>
        input::placeholder{
            color: #fff !important;
        }
    </style>

</head>

<body>
    <?php
    include __DIR__ . '/../partials/navbar.php';
    ?>

    <main class="main-content">
        <!-- Delete Modal -->
        <div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="deleteModalLabel">Confirm Delete</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this product?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <form id="deleteForm" method="POST">
                            <input type="hidden" name="product_id" id="productIdToDelete">
                            <button type="submit" name="delete_product" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <!-- Search Form -->
            <div class="row mt-3">
                <div class="col-md-6 offset-md-3">
                    <form action="" method="GET" class="d-flex">
                        <input class="form-control me-2 bg-transparent text-white" type="search" placeholder="Search products" aria-label="Search" name="search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
            <div class="row m-3">
                <?php foreach ($products as $product): ?>
                    <div class="col-md-12 menage-cat-card col-lg-6 col-xl-4 p-0  mb-4 mx-auto position-relative">
                        <div class="content" style="width: 100%;">
                            <img src="<?php echo explode(',', $product['images'])[0]; ?>" class="content-image card-img-top img-fluid" alt="">
                            <div class="content-details fadeIn-bottom">
                                <span class="card-icon">
                                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" onclick="openImageInFigure(this)" data-toggle="tooltip" data-placement="top" title="View Image">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0" />
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" />
                                        <g id="SVGRepo_iconCarrier">
                                            <path d="M15.7955 15.8111L21 21M18 10.5C18 14.6421 14.6421 18 10.5 18C6.35786 18 3 14.6421 3 10.5C3 6.35786 6.35786 3 10.5 3C14.6421 3 18 6.35786 18 10.5Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </g>
                                    </svg>

                                </span>
                                <span class="card-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="10px" width="10px" viewBox="0 0 448 512" data-toggle="tooltip" data-placement="top" title="Delete" onclick="confirmDelete(<?php echo $product['id']; ?>)" style="cursor: pointer;">
                                        <path d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z" />
                                    </svg>
                                </span>
                                <span class="card-icon">
                                    <a href="index.php?page=edit-products&id=<?php echo $product['id']; ?>" data-toggle="tooltip" data-placement="top" title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="47px" width="47px" viewBox="0 0 512 512">
                                            <path d="M495.9 166.6c3.2 8.7 .5 18.4-6.4 24.6l-43.3 39.4c1.1 8.3 1.7 16.8 1.7 25.4s-.6 17.1-1.7 25.4l43.3 39.4c6.9 6.2 9.6 15.9 6.4 24.6c-4.4 11.9-9.7 23.3-15.8 34.3l-4.7 8.1c-6.6 11-14 21.4-22.1 31.2c-5.9 7.2-15.7 9.6-24.5 6.8l-55.7-17.7c-13.4 10.3-28.2 18.9-44 25.4l-12.5 57.1c-2 9.1-9 16.3-18.2 17.8c-13.8 2.3-28 3.5-42.5 3.5s-28.7-1.2-42.5-3.5c-9.2-1.5-16.2-8.7-18.2-17.8l-12.5-57.1c-15.8-6.5-30.6-15.1-44-25.4L83.1 425.9c-8.8 2.8-18.6 .3-24.5-6.8c-8.1-9.8-15.5-20.2-22.1-31.2l-4.7-8.1c-6.1-11-11.4-22.4-15.8-34.3c-3.2-8.7-.5-18.4 6.4-24.6l43.3-39.4C64.6 273.1 64 264.6 64 256s.6-17.1 1.7-25.4L22.4 191.2c-6.9-6.2-9.6-15.9-6.4-24.6c4.4-11.9 9.7-23.3 15.8-34.3l4.7-8.1c6.6-11 14-21.4 22.1-31.2c5.9-7.2 15.7-9.6 24.5-6.8l55.7 17.7c13.4-10.3 28.2-18.9 44-25.4l12.5-57.1c2-9.1 9-16.3 18.2-17.8C227.3 1.2 241.5 0 256 0s28.7 1.2 42.5 3.5c9.2 1.5 16.2 8.7 18.2 17.8l12.5 57.1c15.8 6.5 30.6 15.1 44 25.4l55.7-17.7c8.8-2.8 18.6-.3 24.5 6.8c8.1 9.8 15.5 20.2 22.1 31.2l4.7 8.1c6.1 11 11.4 22.4 15.8 34.3zM256 336a80 80 0 1 0 0-160 80 80 0 1 0 0 160z"></path>
                                        </svg>
                                    </a>
                                </span>
                                </span>

                            </div>
                            <!-- Overlay -->
                            <div class="content-overlay"></div>
                        </div>
                        <div class="p-2 mt-2">
                            <h5 class="card-title"><?php echo $product['name']; ?></h5>
                            <p class="card-text">Price: $<?php echo $product['price']; ?></p>
                            <p class="card-text">Category: <?php echo $product['cat_name']; ?></p>
                            <p class="card-text">Available: <?php echo $product['is_available'] ? 'Yes' : 'No'; ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var successToast = document.getElementById('successToast');
            var errorToast = document.getElementById('errorToast');

            if (successToast) {
                var toast = new bootstrap.Toast(successToast);
                toast.show();
            }

            if (errorToast) {
                var toast = new bootstrap.Toast(errorToast);
                toast.show();
            }
        });

        function confirmDelete(productId) {
            document.getElementById('productIdToDelete').value = productId;
            var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            deleteModal.show();
        }

        function openImageInFigure(icon) {
            var imgSrc = icon.closest('.content').querySelector('.content-image').src;
            var figure = document.createElement('figure');
            var img = document.createElement('img');
            var closeBtn = document.createElement('button');

            img.src = imgSrc;
            img.style.maxWidth = '90%';
            img.style.maxHeight = '90%';
            img.style.objectFit = 'contain';

            closeBtn.innerHTML = '&times;';
            closeBtn.style.position = 'absolute';
            closeBtn.style.top = '10px';
            closeBtn.style.right = '10px';
            closeBtn.style.fontSize = '24px';
            closeBtn.style.background = 'none';
            closeBtn.style.border = 'none';
            closeBtn.style.color = 'white';
            closeBtn.style.cursor = 'pointer';

            figure.appendChild(img);
            figure.appendChild(closeBtn);
            figure.style.position = 'fixed';
            figure.style.top = '0';
            figure.style.left = '0';
            figure.style.width = '100%';
            figure.style.height = '100%';
            figure.style.backgroundColor = 'rgba(0,0,0,0.8)';
            figure.style.display = 'flex';
            figure.style.justifyContent = 'center';
            figure.style.alignItems = 'center';
            figure.style.zIndex = '1000';

            closeBtn.onclick = function() {
                figure.remove();
            };
            figure.onclick = function(e) {
                if (e.target === figure) figure.remove();
            };

            document.body.appendChild(figure);
        }
    </script>
    <!-- Add jQuery from a CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- Custom JS -->
    <script src="./assets/js/nav.js"></script>
</body>

</html>