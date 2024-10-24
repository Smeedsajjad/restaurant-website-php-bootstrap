<?php
class CategoryController {
    private $connection;

    public function __construct($dbConnection) {
        $this->connection = $dbConnection;
    }

    public function uploadCategory($name, $imagePath) {
        $stmt = $this->connection->prepare("INSERT INTO categories (cat_name, cat_img) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $imagePath);
        return $stmt->execute();
    }

    public function getCategories() {
        $result = $this->connection->query("SELECT * FROM categories");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getCategory($id) {
        $stmt = $this->connection->prepare("SELECT * FROM categories WHERE category_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function updateCategory($id, $name, $imagePath) {
        $stmt = $this->connection->prepare("UPDATE categories SET cat_name = ?, cat_img = ? WHERE category_id = ?");
        $stmt->bind_param("ssi", $name, $imagePath, $id);
        return $stmt->execute();
    }

    public function deleteCategory($id) {
        // Fetch the category details to get the image path
        $category = $this->getCategory($id);
        if ($category && !empty($category['cat_img'])) {
            $imagePath = $category['cat_img'];
            if (file_exists($imagePath)) {
                unlink($imagePath); // Delete the image file
            }
        }

        $stmt = $this->connection->prepare("DELETE FROM categories WHERE category_id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
