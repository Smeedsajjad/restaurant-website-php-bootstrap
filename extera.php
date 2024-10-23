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

public function uploadProduct($name, $tagline, $desc, $category_id, $ingredients, $images, $price, $is_available, $created_at, $updated_at)
    {
        $stmt = $this->connection->prepare("INSERT INTO products (name, tagline, `desc`, category_id, ingredients, images, price, is_available, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssissdiss", $name, $tagline, $desc, $category_id, $ingredients, $images, $price, $is_available, $created_at, $updated_at); // Fixed type string
        return $stmt->execute();
    }