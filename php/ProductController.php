<?php
class ProductController
{
    private $connection;

    public function __construct($dbConnection)
    {
        $this->connection = $dbConnection;
    }

    // Get all categories
    public function getAllCategories()
    {
        $result = $this->connection->query("SELECT * FROM categories ORDER BY cat_name ASC");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Upload product
    public function uploadProduct($name, $tagline, $desc, $category_id, $ingredients, $images, $price, $is_available, $created_at, $updated_at)
    {
        $stmt = $this->connection->prepare("INSERT INTO products (name, tagline, `desc`, category_id, ingredients, images, price, is_available, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssissdiss", $name, $tagline, $desc, $category_id, $ingredients, $images, $price, $is_available, $created_at, $updated_at); // Fixed type string
        return $stmt->execute();
    }

    public function getAllProduct()
    {
        $query = "SELECT * FROM products";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getProducts()
    {
        // Assuming the primary key in the 'categories' table is 'category_id'
        $query = "SELECT products.*, categories.cat_name FROM products 
                  JOIN categories ON products.category_id = categories.category_id";
        $result = $this->connection->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }


    // Get 6 products
    public function getLimitProducts($limit = 6)
    {
        // Only fetch products that are available (is_available = 1)
        $stmt = $this->connection->prepare("SELECT * FROM products WHERE is_available = 1 LIMIT ?");
        $stmt->bind_param("i", $limit);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Get All products
    public function getAllProducts()
    {
        // Only fetch products that are available (is_available = 1)
        $stmt = $this->connection->prepare("SELECT * FROM products WHERE is_available = 1");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Function to get product details by ID
    public function fetchProductById($id)
    {
        // Prepare the SQL statement to fetch product details and category name
        $stmt = $this->connection->prepare("
            SELECT p.*, c.cat_name AS category_name, COUNT(r.id) AS review_count 
            FROM products p 
            LEFT JOIN categories c ON p.category_id = c.id 
            LEFT JOIN reviews r ON p.id = r.product_id 
            WHERE p.id = ?
            GROUP BY p.id
        ");
        $stmt->bind_param("i", $id); // Bind the parameter
        $stmt->execute();
        $result = $stmt->get_result(); // Get the result set
        return $result->fetch_assoc(); // Return the product details as an associative array
    }

    // Get a single product by ID
    public function getProduct($id)
    {
        $stmt = $this->connection->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $product = $stmt->get_result()->fetch_assoc();

        // Check if the images field is set
        if (!isset($product['images']) || $product['images'] === null) {
            $product['images'] = '';
        }

        return $product;
    }

    // Update a product
    public function updateProduct($id, $name, $tagline, $desc, $category_id, $ingredients, $images, $price, $is_available)
    {
        try {
            // Get the current product images
            $currentProduct = $this->getProduct($id);
            $oldImages = explode(',', $currentProduct['images']);
            $newImages = explode(',', $images);

            // Remove old images that are not in the new images list
            $imagesToRemove = array_diff($oldImages, $newImages);
            foreach ($imagesToRemove as $imageToRemove) {
                if (file_exists($imageToRemove)) {
                    unlink($imageToRemove);
                }
            }

            // Set the current time for the updated_at field
            $updated_at = date('Y-m-d H:i:s');
            // Set created_at to the existing value or current time
            $created_at = $currentProduct['created_at']; // Use existing created_at value

            // Example of an update query
            $update_query = "UPDATE products SET name = ?, tagline = ?, `desc` = ?, category_id = ?, ingredients = ?, images = ?, price = ?, is_available = ?, updated_at = NOW() WHERE id = ?";

            // Prepare the statement
            $stmt = $this->connection->prepare($update_query);

            // Bind parameters
            $stmt->bind_param("sssissdis", $name, $tagline, $desc, $category_id, $ingredients, $images, $price, $is_available, $id);

            // Execute the statement
            $stmt->execute();
            return true; // Return true on success
        } catch (\Throwable $th) {
            return "Error updating product: " . $th->getMessage(); // Return error message
        }
    }

    // Delete a product
    public function deleteProduct($id)
    {
        // Fetch the product details to get the image path
        $product = $this->getProduct($id);
        if ($product && !empty($product['images'])) {
            $images = explode(',', $product['images']);
            foreach ($images as $image) {
                if (file_exists($image)) {
                    unlink($image); // Delete the image file
                }
            }
        }

        $stmt = $this->connection->prepare("DELETE FROM products WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    // Search for products by name, description, or tagline
    public function searchProducts($searchTerm)
    {
        $searchTerm = "%$searchTerm%";
        $stmt = $this->connection->prepare("SELECT * FROM products WHERE name LIKE ? OR `desc` LIKE ? OR tagline LIKE ?");
        $stmt->bind_param("sss", $searchTerm, $searchTerm, $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getProductsLoadMore($offset, $limit)
    {
        $query = "SELECT * FROM products LIMIT ? OFFSET ?";
        $stmt = $this->connection->prepare($query);

        // Bind the offset and limit as integers
        $stmt->bind_param("ii", $limit, $offset);

        $stmt->execute();
        $result = $stmt->get_result();

        $products = [];
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }

        return $products;
    }
}
