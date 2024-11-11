<?php
class CategoryData {
    private $connection;

    public function __construct($dbConnection)
    {
        $this->connection = $dbConnection;
    }

    public function getCategories() {
        $query = "SELECT c.category_id AS id, c.cat_name AS name, COUNT(p.id) AS product_count 
                  FROM categories c
                  LEFT JOIN products p ON c.category_id = p.category_id
                  GROUP BY c.category_id";
        $result = $this->connection->query($query);

        $categories = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $categories[] = [
                    'id' => $row['id'],
                    'name' => $row['name'],
                    'product_count' => $row['product_count']
                ];
            }
        }
        return $categories;
    }
}
?>