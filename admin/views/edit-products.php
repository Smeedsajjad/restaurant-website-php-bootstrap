<?php
// Include necessary configuration and class files
require_once './config/config.php'; // Database configuration
require_once './php/ProductController.php'; // Include the product controller

// Create a new database connection
$database = new Database();
$dbConnection = $database->conn; // Get the connection object

// Pass the database connection to the ProductController
$productController = new ProductController($dbConnection);

// Check if product ID is provided
if (!isset($_GET['id'])) {
    // Redirect to manage products page if no ID is provided
    header('Location: index.php?page=manage-products');
    exit();
}

$productId = $_GET['id'];
$product = $productController->getProduct($productId);

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $desc = $_POST['desc'];
    $category_id = $_POST['category'];
    $ingredients = $_POST['ingredients'];
    $tagline = $_POST['tagline'];
    // Check if $ingredients is a JSON string
    if (is_string($ingredients) && is_array(json_decode($ingredients, true))) {
        $ingredientsArray = json_decode($ingredients, true);
        $ingredientsString = implode(',', array_column($ingredientsArray, 'value'));
    } else {
        // If it's not a JSON string, assume it's already a comma-separated string
        $ingredientsString = $ingredients;
    }

    $price = $_POST['price'];
    $is_available = isset($_POST['is_available']) ? 1 : 0;
    $images = $product['images']; // Keep existing images by default

    $currentImages = isset($_POST['current_images']) ? explode(',', $_POST['current_images']) : [];
    $newImages = [];

    // Handle image uploads
    if (!empty($_FILES['images']['name'][0])) {
        $targetDir = './uploads/products/';
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');

        foreach ($_FILES['images']['name'] as $key => $val) {
            $fileName = basename($_FILES['images']['name'][$key]);
            $targetFilePath = $targetDir . $fileName;

            // Check if file type is valid
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
            if (in_array($fileType, $allowTypes)) {
                // Upload file to server
                if (move_uploaded_file($_FILES["images"]["tmp_name"][$key], $targetFilePath)) {
                    $newImages[] = $targetFilePath;
                }
            }
        }
    }

    // Combine current and new images
    $updatedImages = array_merge($currentImages, $newImages);

    // Filter out any empty values and create the final image string
    $images = implode(',', array_filter($updatedImages));

    // Call the updateProduct method with the updated images
    if ($productController->updateProduct($productId, $name, $tagline, $desc, $category_id, $ingredientsString, $images, $price, $is_available, null)) {
        // Success message in toast
        echo "
        <div class='toast align-items-center text-bg-success position-fixed top-0 end-0 m-3' role='alert' aria-live='assertive' aria-atomic='true' id='successToast' style='min-width: 300px;'>
            <div class='d-flex'>
                <div class='toast-body'>
                    <span>
                        <img class='me-2' src='./assets/images/done.gif' style='width: 85px;' alt=''>
                    </span>Product updated successfully!
                    <div class='progress mt-2'>
                        <div class='progress-bar bg-light' role='progressbar' style='width: 100%' aria-valuenow='100' aria-valuemin='0' aria-valuemax='100'></div>
                    </div>
                </div>
                <button type='button' class='btn-close me-2 m-auto' data-bs-dismiss='toast' aria-label='Close'></button>
            </div>
        </div>
        ";
        header('Location: index.php?page=manage-products');
        // Refresh product data
        $product = $productController->getProduct($productId);
    } else {
        // Failure message in toast
        echo "
        <div class='toast align-items-center text-bg-danger position-fixed top-0 end-0 m-3' role='alert' aria-live='assertive' aria-atomic='true' id='errorToast' style='min-width: 300px;'>
            <div class='d-flex'>
                <div class='toast-body'>
                    <span>
                        <img class='me-2' src='./assets/images/danger.gif' style='width: 85px;' alt=''>
                    </span> Failed to update product.
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

// At the top of your file, replace the previous suggestion with:
function base_url($uri = '')
{
    return 'http://localhost/restaurant-website-php-bootstrap/admin/' . $uri;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- ICONS -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="./assets/css/nav.css"> <!-- Correct path for nav.css -->
    <link rel="stylesheet" href="./assets/css/style.css"> <!-- Correct path for style.css -->
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
    <!-- Make sure to include the Phosphor Icons library -->
    <link href="https://unpkg.com/phosphor-icons@1.4.1/css/phosphor.css" rel="stylesheet">
    <!-- ... other head content ... -->
    <link href="https://unpkg.com/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
    <script src="https://unpkg.com/@yaireo/tagify"></script>
    <style>
        .tagify {
            --tags-border-color: #ccc;
            --tags-hover-border-color: #3595f6;
            --tags-focus-border-color: #3595f6;
        }

        .form-control {
            color: #c8c9d4 !important;
        }

        .image-preview {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .image-preview img {
            object-fit: cover;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .image-container {
            position: relative;
            display: inline-block;
        }

        .remove-image {
            position: absolute;
            top: 5px;
            right: 5px;
            padding: 2px 5px;
            font-size: 0.8rem;
        }
    </style>
</head>

<body>
    <?php
    include __DIR__ . '/../partials/navbar.php';
    ?>

    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12" id="box">
                    <div class="content-header">
                        <div class="d-flex align-items-center">
                            <h4 class="page-title">Edit Product</h4>
                        </div>
                    </div>
                    <div class="box-body p-3">
                        <form method="post" action="index.php?page=edit-products&id=<?php echo $product['id']; ?>" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control my-input" id="name" name="name" value="<?php echo htmlspecialchars($product['name']); ?>">
                            </div>

                            <div class="mb-3">
                                <label for="tagline" class="form-label">Tagline</label>
                                <textarea class="form-control my-input" id="tagline" name="tagline" rows="3"><?php echo htmlspecialchars($product['tagline']); ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="desc" class="form-label">Description</label>
                                <textarea class="form-control my-input" id="desc" name="desc" rows="3"><?php echo htmlspecialchars($product['desc']); ?></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="ingredients" class="form-label">Ingredients</label>
                                <input type="text" class="form-control my-input" id="ingredients" name="ingredients" value="<?php echo htmlspecialchars($product['ingredients']); ?>">
                            </div>

                            <div class="mb-3">
                                <label for="category" class="form-label">Category</label>
                                <select class="form-control my-input" id="category" name="category">
                                    <?php
                                    $categories = $productController->getAllCategories();
                                    foreach ($categories as $category) {
                                        $selected = ($category['id'] == $product['category_id']) ? 'selected' : '';
                                        echo "<option value='{$category['id']}' {$selected}>{$category['cat_name']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" step="0.01" class="form-control my-input" id="price" name="price" value="<?php echo htmlspecialchars($product['price']); ?>">
                            </div>
                            <div class="mb-3 form-check " style="padding-left: 0 !important;">
                                <label for="productAvailability" class="form-label">Availability</label>
                                <select name="is_available" class="form-control my-input" id="productAvailability">
                                    <option value="1" <?php echo $product['is_available'] ? 'selected' : ''; ?>>Available</option>
                                    <option value="0" <?php echo !$product['is_available'] ? 'selected' : ''; ?>>Not Available</option>
                                </select>
                            </div>

                            <div class="mb-3">
    <label for="images" class="form-label">Product Images</label>
    <input type="file" class="form-control my-input" id="images" name="images[]" accept="image/*" multiple>
    <div id="imagePreview" class="mt-2 image-preview">
        <?php
        if (!empty($product['images'])) {
            $images = explode(',', $product['images']);
            foreach ($images as $index => $image) {
                $imagePath = trim($image);
                if (file_exists($imagePath)) {
                    echo "<div class='image-container' data-path='" . htmlspecialchars($imagePath) . "'>";
                    echo "<img src='" . htmlspecialchars(base_url($imagePath)) . "' alt='Current Product Image' class='mt-2 me-2' style='max-width: 100px; max-height: 100px;'>";
                    echo "<button type='button' class='btn btn-danger btn-sm remove-image'>Remove</button>";
                    echo "</div>";
                }
            }
        }
        ?>
    </div>
    <input type="hidden" name="current_images" id="currentImages" value="">
</div>

                            <div class="m-1">
                                <button class="submit">
                                    <div class="outline"></div>
                                    <div class="state state--default">
                                        <div class="icon">
                                            <svg
                                                width="1em"
                                                height="1em"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g style="filter: url(#shadow)">
                                                    <path
                                                        d="M14.2199 21.63C13.0399 21.63 11.3699 20.8 10.0499 16.83L9.32988 14.67L7.16988 13.95C3.20988 12.63 2.37988 10.96 2.37988 9.78001C2.37988 8.61001 3.20988 6.93001 7.16988 5.60001L15.6599 2.77001C17.7799 2.06001 19.5499 2.27001 20.6399 3.35001C21.7299 4.43001 21.9399 6.21001 21.2299 8.33001L18.3999 16.82C17.0699 20.8 15.3999 21.63 14.2199 21.63ZM7.63988 7.03001C4.85988 7.96001 3.86988 9.06001 3.86988 9.78001C3.86988 10.5 4.85988 11.6 7.63988 12.52L10.1599 13.36C10.3799 13.43 10.5599 13.61 10.6299 13.83L11.4699 16.35C12.3899 19.13 13.4999 20.12 14.2199 20.12C14.9399 20.12 16.0399 19.13 16.9699 16.35L19.7999 7.86001C20.3099 6.32001 20.2199 5.06001 19.5699 4.41001C18.9199 3.76001 17.6599 3.68001 16.1299 4.19001L7.63988 7.03001Z"
                                                        fill="currentColor"></path>
                                                    <path
                                                        d="M10.11 14.4C9.92005 14.4 9.73005 14.33 9.58005 14.18C9.29005 13.89 9.29005 13.41 9.58005 13.12L13.16 9.53C13.45 9.24 13.93 9.24 14.22 9.53C14.51 9.82 14.51 10.3 14.22 10.59L10.64 14.18C10.5 14.33 10.3 14.4 10.11 14.4Z"
                                                        fill="currentColor"></path>
                                                </g>
                                                <defs>
                                                    <filter id="shadow">
                                                        <fedropshadow
                                                            dx="0"
                                                            dy="1"
                                                            stdDeviation="0.6"
                                                            flood-opacity="0.5"></fedropshadow>
                                                    </filter>
                                                </defs>
                                            </svg>
                                        </div>
                                        <p class="position-relative" style="top: 5px;">
                                            <span style="--i:0">E</span>
                                            <span style="--i:1">d</span>
                                            <span style="--i:2">i</span>
                                            <span style="--i:3">t</span>
                                            <span style="--i:4"></span>
                                            <span style="--i:5">P</span>
                                            <span style="--i:6">r</span>
                                            <span style="--i:7">o</span>
                                            <span style="--i:8">d</span>
                                            <span style="--i:9">u</span>
                                            <span style="--i:10">c</span>
                                            <span style="--i:11">t</span>
                                        </p>
                                    </div>
                                    <div class="state state--sent">
                                        <div class="icon">
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                height="1em"
                                                width="1em"
                                                stroke-width="0.5px"
                                                stroke="black">
                                                <g style="filter: url(#shadow)">
                                                    <path
                                                        fill="currentColor"
                                                        d="M12 22.75C6.07 22.75 1.25 17.93 1.25 12C1.25 6.07 6.07 1.25 12 1.25C17.93 1.25 22.75 6.07 22.75 12C22.75 17.93 17.93 22.75 12 22.75ZM12 2.75C6.9 2.75 2.75 6.9 2.75 12C2.75 17.1 6.9 21.25 12 21.25C17.1 21.25 21.25 17.1 21.25 12C21.25 6.9 17.1 2.75 12 2.75Z"></path>
                                                    <path
                                                        fill="currentColor"
                                                        d="M10.5795 15.5801C10.3795 15.5801 10.1895 15.5001 10.0495 15.3601L7.21945 12.5301C6.92945 12.2401 6.92945 11.7601 7.21945 11.4701C7.50945 11.1801 7.98945 11.1801 8.27945 11.4701L10.5795 13.7701L15.7195 8.6301C16.0095 8.3401 16.4895 8.3401 16.7795 8.6301C17.0695 8.9201 17.0695 9.4001 16.7795 9.6901L11.1095 15.3601C10.9695 15.5001 10.7795 15.5801 10.5795 15.5801Z"></path>
                                                </g>
                                            </svg>
                                        </div>
                                        <p>
                                            <span style="--i:5">S</span>
                                            <span style="--i:6">a</span>
                                            <span style="--i:7">v</span>
                                            <span style="--i:8">e</span>
                                        </p>
                                    </div>
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>





    </script>
    <!-- Add jQuery from a CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- Custom JS -->
    <script src="./assets/js/nav.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const imagePreview = document.getElementById('imagePreview');
            const currentImagesInput = document.getElementById('currentImages');

            // Function to update the current images input
            function updateCurrentImages() {
                const imagePaths = Array.from(imagePreview.querySelectorAll('.image-container'))
                    .map(container => container.dataset.path);
                currentImagesInput.value = imagePaths.join(',');
            }

            // Initialize current images
            updateCurrentImages();

            // Handle new image uploads
            document.getElementById('images').addEventListener('change', function() {
                const files = this.files;
                
                for (let i = 0; i < files.length; i++) {
                    const file = files[i];
                    const reader = new FileReader();

                    reader.onload = function(event) {
                        const container = document.createElement('div');
                        container.classList.add('image-container');
                        container.dataset.path = ''; // New images don't have a path yet

                        const imgElement = document.createElement('img');
                        imgElement.src = event.target.result;
                        imgElement.style.maxWidth = '100px';
                        imgElement.style.maxHeight = '100px';
                        imgElement.classList.add('mt-2', 'me-2');

                        const removeButton = document.createElement('button');
                        removeButton.textContent = 'Remove';
                        removeButton.classList.add('btn', 'btn-danger', 'btn-sm', 'remove-image');

                        container.appendChild(imgElement);
                        container.appendChild(removeButton);
                        imagePreview.appendChild(container);

                        updateCurrentImages();
                    };

                    reader.readAsDataURL(file);
                }
            });

            // Handle image removal
            imagePreview.addEventListener('click', function(e) {
                if (e.target && e.target.classList.contains('remove-image')) {
                    const container = e.target.closest('.image-container');
                    container.remove();
                    updateCurrentImages();
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            var successToast = document.getElementById('successToast');
            var errorToast = document.getElementById('errorToast');

            if (successToast) {
                var toast = new bootstrap.Toast(successToast);
                toast.show();
                animateProgressBar(successToast);
            }

            if (errorToast) {
                var toast = new bootstrap.Toast(errorToast);
                toast.show();
                animateProgressBar(errorToast);
            }
        });

        function animateProgressBar(toastElement) {
            var progressBar = toastElement.querySelector('.progress-bar');
            var width = 100;
            var interval = setInterval(function() {
                if (width <= 0) {
                    clearInterval(interval);
                    toastElement.querySelector('.btn-close').click();
                } else {
                    width--;
                    progressBar.style.width = width + "%";
                }
            }, 30); // Adjust the interval for faster/slower progress
        }

        document.addEventListener('DOMContentLoaded', function() {
            var input = document.querySelector('input[name=ingredients]');
            var tagify = new Tagify(input, {
                delimiters: ",| ",
                trim: true
            });

            // Pre-populate tags
            var ingredients = <?php echo json_encode(explode(',', $product['ingredients'])); ?>;
            tagify.addTags(ingredients);

            // Add this part to ensure Tagify sends data in the correct format
            document.querySelector('form').addEventListener('submit', function() {
                var tagsJson = JSON.stringify(tagify.value);
                input.value = tagsJson;
            });
        });
    </script>


</body>

</html>