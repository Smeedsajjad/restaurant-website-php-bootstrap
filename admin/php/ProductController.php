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

    // Get all products
    // public function getProducts()
    // {
    //     $result = $this->connection->query("SELECT * FROM products");
    //     return $result->fetch_all(MYSQLI_ASSOC);
    // }
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
        //code...
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
       } catch (\Throwable $th) {
           // Print the error message
           echo "Error updating product: " . $th->getMessage();
       }
    }

    // Delete a product
    public function deleteProduct($id)
    {
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
}
