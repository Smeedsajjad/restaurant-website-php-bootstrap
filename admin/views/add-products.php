<?php
// Include necessary configuration and class files
require_once './config/config.php';
require_once './php/CategoryController.php';
require_once './php/ProductController.php';

// Create a new database connection
$database = new Database();
$dbConnection = $database->conn; // Get the connection object

// Pass the database connection to the CategoryController
$categoryController = new CategoryController($dbConnection);
$categories = $categoryController->getCategories();

$productController = new ProductController($dbConnection);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $desc = $_POST['desc'];
    $category_id = $_POST['category_id'];
    $ingredients = $_POST['ingredients'];
    $price = $_POST['price'];
    $tagline = $_POST['tagline'];
    $is_available = isset($_POST['is_available']) ? $_POST['is_available'] : 0;
    $created_at = date('Y-m-d H:i:s');
    $updated_at = date('Y-m-d H:i:s');

    // Handle multiple image uploads
    $imagePaths = [];
    if (isset($_FILES['images']) && !empty($_FILES['images']['name'][0])) {
        $targetDir = 'uploads/products/';
        $fileCount = count($_FILES['images']['name']);

        for ($i = 0; $i < $fileCount; $i++) {
            if ($_FILES['images']['error'][$i] == 0) {
                $imageName = basename($_FILES['images']['name'][$i]);
                $targetFilePath = $targetDir . uniqid() . '_' . $imageName;

                if (move_uploaded_file($_FILES['images']['tmp_name'][$i], $targetFilePath)) {
                    $imagePaths[] = $targetFilePath;
                } else {
                    echo "Error uploading image: " . $imageName . "<br>";
                }
            }
        }
    }

    // Convert image paths array to a string (e.g., comma-separated) for database storage
    $imagePathsString = implode(',', $imagePaths);

    if ($productController->uploadProduct($name, $tagline, $desc, $category_id, $ingredients, $imagePathsString, $price,  $is_available, $created_at, $updated_at)) {
        // Success message in toast with tick icon and progress bar
        echo "
        <div class='toast align-items-center text-bg-success position-fixed top-0 end-0 m-3' role='alert' aria-live='assertive' aria-atomic='true' id='successToast' style='min-width: 300px;'>
            <div class='d-flex'>
                <div class='toast-body'>
                    <span>
                        <img class='me-2' src='./assets/images/done.gif' style='width: 85px;' alt=''>
                    </span>Product added successfully!
                    <div class='progress mt-2'>
                        <div class='progress-bar bg-light' role='progressbar' style='width: 100%' aria-valuenow='100' aria-valuemin='0' aria-valuemax='100'></div>
                    </div>
                </div>
                <button type='button' class='btn-close me-2 m-auto' data-bs-dismiss='toast' aria-label='Close'></button>
            </div>
        </div>
        ";
        header('Location: index.php?page=manage-products');
    } else {
        // Deletion failed
        // Failure message in toast with cross icon and progress bar
        echo "
        <div class='toast align-items-center text-bg-danger position-fixed top-0 end-0 m-3' role='alert' aria-live='assertive' aria-atomic='true' id='errorToast' style='min-width: 300px;'>
            <div class='d-flex'>
                <div class='toast-body'>
                    <span>
                        <img class='me-2' src='./assets/images/danger.gif' style='width: 85px;' alt=''>
                    </span> Failed to add Product.
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
    <title>Add Products</title>
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

    <style>
        .form-control {
            color: #c8c9d4 !important;
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
                            <div class="me-auto">
                                <h4 class="page-title">Products</h4>
                                <span>Add</span>
                            </div>
                        </div>
                    </div>
                    <div class="box-body p-3">
                        <form method="post" action="index.php?page=add-products" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="productName" class="form-label">Name</label>
                                    <input name="name" type="text" class="form-control my-input" id="productName" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="productPrice" class="form-label">Price</label>
                                    <input name="price" type="number" min="0" step="0.01" class="form-control my-input" id="productPrice" required>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="producttagline" class="form-label">Tagline</label>
                                    <textarea name="tagline" class="form-control my-input" id="producttagline" rows="3"></textarea>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="productDesc" class="form-label">Description</label>
                                    <textarea name="desc" class="form-control my-input" id="productDesc" rows="3"></textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="productCategory" class="form-label">Category</label>
                                    <select name="category_id" class="form-control my-input" id="productCategory" required>
                                        <option value="">Select a category</option>
                                        <?php if (!empty($categories)) : ?>
                                            <?php foreach ($categories as $category) : ?>
                                                <option value="<?php echo $category['category_id']; ?>">
                                                    <?php echo htmlspecialchars($category['cat_name']); ?></option>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <option value="">No categories available</option>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="productAvailability" class="form-label">Availability</label>
                                    <select name="is_available" class="form-control my-input" id="productAvailability">
                                        <option value="1">Available</option>
                                        <option value="0">Not Available</option>
                                    </select>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="productIngredients" class="form-label">Ingredients</label>
                                    <div class="ingredient-tags-container">
                                        <input type="text" id="ingredientInput" class="form-control my-input" placeholder="Enter an ingredient and press Enter">
                                        <div id="ingredientTags" class="mt-2"></div>
                                        <input type="hidden" name="ingredients" id="ingredientsHidden">
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="productImages" class="form-label">Upload Product Images</label>
                                <input name="images[]" type="file" class="form-control my-input" id="productImages" aria-describedby="emailHelp" required accept="image/*" multiple>
                                <div id="imagePreview" style="margin-top: 15px;"></div>
                            </div>
                            <div class="m-1">
                                <button class="submit" type="submit">
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
                                            <span style="--i:0">A</span>
                                            <span style="--i:1">d</span>
                                            <span style="--i:2">d</span>
                                            <span style="--i:3">C</span>
                                            <span style="--i:4">a</span>
                                            <span style="--i:5">t</span>
                                            <span style="--i:6">e</span>
                                            <span style="--i:7">g</span>
                                            <span style="--i:8">o</span>
                                            <span style="--i:9">r</span>
                                            <span style="--i:10">y</span>
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
                                            <span style="--i:6">e</span>
                                            <span style="--i:7">n</span>
                                            <span style="--i:8">t</span>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const input = document.getElementById('ingredientInput');
            const tagsContainer = document.getElementById('ingredientTags');
            const hiddenInput = document.getElementById('ingredientsHidden');
            const ingredients = [];

            input.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' && this.value) {
                    e.preventDefault();
                    addIngredient(this.value.trim());
                    this.value = '';
                }
            });

            function addIngredient(ingredient) {
                if (!ingredients.includes(ingredient)) {
                    ingredients.push(ingredient);
                    updateTags();
                }
            }

            function removeIngredient(ingredient) {
                const index = ingredients.indexOf(ingredient);
                if (index > -1) {
                    ingredients.splice(index, 1);
                    updateTags();
                }
            }

            function updateTags() {
                tagsContainer.innerHTML = '';
                ingredients.forEach(ingredient => {
                    const tag = document.createElement('span');
                    tag.classList.add('badge', 'bg-primary', 'me-2', 'mb-2');
                    tag.innerHTML = `${ingredient} <i class="fa-solid fa-x" style="cursor: pointer;"></i>`;
                    tag.querySelector('i').addEventListener('click', () => removeIngredient(ingredient));
                    tagsContainer.appendChild(tag);
                });
                hiddenInput.value = ingredients.join(','); // Join ingredients with commas
            }
        });
    </script>
    <script>
        // Image preview script
        const input = document.getElementById('productImages');
        const imagePreview = document.getElementById('imagePreview');

        input.addEventListener('change', function() {
            imagePreview.innerHTML = '';
            const files = this.files;
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        const imgElement = document.createElement('img');
                        imgElement.src = event.target.result;
                        imgElement.style.maxWidth = '100px';
                        imgElement.style.marginRight = '10px';
                        imgElement.style.marginTop = '10px';
                        imagePreview.appendChild(imgElement);
                    };
                    reader.readAsDataURL(file);
                }
            }
        });
    </script>

    <script>
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




    </script>
    <!-- Add jQuery from a CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- Custom JS -->
    <script src="./assets/js/nav.js"></script>
</body>

</html>