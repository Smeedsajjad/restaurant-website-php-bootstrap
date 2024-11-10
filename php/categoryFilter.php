<?php
class CategoryData
{
    private $connection;

    public function __construct($dbConnection)
    {
        $this->connection = $dbConnection;
    }

    public function getCategories()
    {
        // Query to fetch categories and product counts
        $query = "SELECT c.category_id, c.cat_name, COUNT(p.id) AS product_count 
                  FROM categories c
                  LEFT JOIN products p ON c.category_id = p.category_id
                  GROUP BY c.category_id";

        $result = $this->connection->query($query);

        // Check if query executed successfully
        if ($result) {
            $categories = [];

            // Fetch the results and prepare the data
            while ($row = $result->fetch_assoc()) {
                $categories[] = [
                    'id' => $row['category_id'],
                    'name' => $row['cat_name'],
                    'product_count' => $row['product_count']
                ];
            }

            // Log the data to ensure it's fetched correctly
            error_log(print_r($categories, true));

            // Return the categories data as a JSON response
            echo json_encode($categories);
        } else {
            // If there was an error, log it and show a message
            error_log('Query error: ' . $this->connection->error);
            echo json_encode(['status' => 'error', 'message' => 'Failed to fetch categories']);
        }
    }
}

?>