<?php
require_once '../config/config.php';

if (isset($_GET['order_id'])) {
    $database = new Database();
    $db = $database->conn;
    
    $order_id = intval($_GET['order_id']);
    
    // Get order details
    $stmt = $db->prepare("
        SELECT o.*, b.*, u.username, u.email
        FROM orders o
        JOIN billingdetails b ON o.billing_id = b.id
        JOIN users u ON o.user_id = u.id
        WHERE o.id = ?
    ");
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $order = $stmt->get_result()->fetch_assoc();
    
    // Get order items
    $stmt = $db->prepare("
        SELECT oi.*, p.name, p.images
        FROM order_items oi
        JOIN products p ON oi.product_id = p.id
        WHERE oi.order_id = ?
    ");
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $items = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    
    if ($order) {
        ?>
        <div class="row">
            <div class="col-md-6">
                <h6 class="mb-3">Order Information</h6>
                <p><strong>Order ID:</strong> #<?php echo $order['id']; ?></p>
                <p><strong>Date:</strong> <?php echo date('F j, Y', strtotime($order['created_at'])); ?></p>
                <p><strong>Status:</strong> <?php echo ucfirst($order['order_status']); ?></p>
                <p><strong>Total Amount:</strong> $<?php echo number_format($order['total_amount'], 2); ?></p>
            </div>
            <div class="col-md-6">
                <h6 class="mb-3">Customer Information</h6>
                <p><strong>Name:</strong> <?php echo htmlspecialchars($order['firstName'] . ' ' . $order['lastName']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($order['email']); ?></p>
                <p><strong>Phone:</strong> <?php echo htmlspecialchars($order['phone']); ?></p>
                <p><strong>Address:</strong> <?php echo htmlspecialchars($order['address'] . ', ' . $order['city'] . ', ' . $order['country'] . ' ' . $order['postcode']); ?></p>
            </div>
        </div>
        
        <h6 class="mt-4 mb-3">Order Items</h6>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $item): ?>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="../admin/<?php echo htmlspecialchars($item['images']); ?>" 
                                         alt="<?php echo htmlspecialchars($item['name']); ?>" 
                                         class="me-2" 
                                         style="width: 50px; height: 50px; object-fit: cover;">
                                    <?php echo htmlspecialchars($item['name']); ?>
                                </div>
                            </td>
                            <td>$<?php echo number_format($item['price'], 2); ?></td>
                            <td><?php echo $item['quantity']; ?></td>
                            <td>$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php
    } else {
        echo '<div class="alert alert-danger">Order not found</div>';
    }
} else {
    echo '<div class="alert alert-danger">Invalid request</div>';
}
?>
