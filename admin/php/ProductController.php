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
    public function getProducts()
    {
        $result = $this->connection->query("SELECT * FROM products");
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
    public function updateProduct($id, $name, $desc, $category_id, $ingredients, $images, $price, $is_available, $created_at, $tagline)
    {
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

        // Update the product in the database
        $stmt = $this->connection->prepare("UPDATE products SET name = ?, tagline = ?, `desc` = ?, category_id = ?, ingredients = ?, images = ?, price = ?, is_available = ?, created_at = ? WHERE id = ?");
        $stmt->bind_param("sssissdiss", $name, $tagline, $desc, $category_id, $ingredients, $images, $price, $is_available, $created_at, $id);

        return $stmt->execute();
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
