<?php
session_start();
require_once '../admin/config/config.php';

if (!isset($_SESSION['user_id']) || !isset($_GET['order_id'])) {
    header('Location: index.php');
    exit;
}

$orderId = $_GET['order_id'];
$database = new Database();
$db = $database->conn;

// Get order details
$stmt = $db->prepare("
    SELECT o.*, b.firstName, b.lastName, b.email, b.phone, b.address, b.city, b.country, b.postcode
    FROM orders o
    JOIN billingdetails b ON o.billing_id = b.id
    WHERE o.id = ? AND o.user_id = ?
");
$stmt->bind_param("ii", $orderId, $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$order = $result->fetch_assoc();

if (!$order) {
    header('Location: index.php');
    exit;
}

// Get order items
$stmt = $db->prepare("
    SELECT oi.*, p.name, p.image
    FROM order_items oi
    JOIN products p ON oi.product_id = p.id
    WHERE oi.order_id = ?
");
$stmt->bind_param("i", $orderId);
$stmt->execute();
$items = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation - Restaurant Name</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="container my-5">
        <div class="row">
            <div class="col-12">
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Thank you for your order!</h4>
                    <p>Your order has been successfully placed. Order ID: #<?php echo $orderId; ?></p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Order Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($items as $item): ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>" class="img-thumbnail me-2" style="width: 50px;">
                                                <?php echo $item['name']; ?>
                                            </div>
                                        </td>
                                        <td><?php echo $item['quantity']; ?></td>
                                        <td>$<?php echo number_format($item['price'], 2); ?></td>
                                        <td>$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <tr>
                                        <td colspan="3" class="text-end"><strong>Total Amount:</strong></td>
                                        <td><strong>$<?php echo number_format($order['total_amount'], 2); ?></strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Delivery Information</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Name:</strong> <?php echo $order['firstName'] . ' ' . $order['lastName']; ?></p>
                        <p><strong>Email:</strong> <?php echo $order['email']; ?></p>
                        <p><strong>Phone:</strong> <?php echo $order['phone']; ?></p>
                        <p><strong>Address:</strong><br>
                            <?php echo $order['address']; ?><br>
                            <?php echo $order['city']; ?><br>
                            <?php echo $order['country']; ?><br>
                            <?php echo $order['postcode']; ?>
                        </p>
                        <p><strong>Payment Method:</strong> <?php echo ucfirst($order['payment_method']); ?></p>
                    </div>
                </div>
                <div class="text-center">
                    <a href="index.php" class="btn btn-primary">Continue Shopping</a>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
