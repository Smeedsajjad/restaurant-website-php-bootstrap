<?php
class ProductController
{
    private $connection;

    public function __construct($dbConnection)
    {
        $this->connection = $dbConnection;
    }
    public function getAllCategories()
    {
        $result = $this->connection->query("SELECT * FROM categories ORDER BY cat_name ASC");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function uploadProduct($name, $desc, $category_id, $ingredients, $images, $price, $is_available, $created_at, $updated_at)
    {
        $stmt = $this->connection->prepare("INSERT INTO products (name, `desc`, category_id, ingredients, images, price, is_available, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssissdiss", $name, $desc, $category_id, $ingredients, $images, $price, $is_available, $created_at, $updated_at);
        return $stmt->execute();
    }

    public function getProducts()
    {
        $result = $this->connection->query("SELECT * FROM products");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getProduct($id)
    {
        $stmt = $this->connection->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $product = $stmt->get_result()->fetch_assoc();

        // Add this check before returning the product
        if (!isset($product['images']) || $product['images'] === null) {
            $product['images'] = '';
        }

        return $product;
    }

    public function updateProduct($id, $name, $desc, $category_id, $ingredients, $images, $price, $is_available, $created_at) {
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
        $stmt = $this->connection->prepare("UPDATE products SET name = ?, `desc` = ?, category_id = ?, ingredients = ?, images = ?, price = ?, is_available = ?, created_at = ? WHERE id = ?");
        $stmt->bind_param("sssssdisi", $name, $desc, $category_id, $ingredients, $images, $price, $is_available, $created_at, $id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteProduct($id)
    {
        $stmt = $this->connection->prepare("DELETE FROM products WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function searchProducts($searchTerm)
    {
        $searchTerm = "%$searchTerm%";
        $stmt = $this->connection->prepare("SELECT * FROM products WHERE name LIKE ? OR `desc` LIKE ?");
        $stmt->bind_param("ss", $searchTerm, $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
