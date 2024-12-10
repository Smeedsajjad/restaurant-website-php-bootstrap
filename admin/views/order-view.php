<?php
// Start the session
session_start();

// Include the database configuration
require_once __DIR__ . '/../config/config.php';

// Initialize database connection
$database = new Database();
$db = $database->conn;

// Check if database connection is successful
if (!$db) {
    die("Database connection failed");
}

try {
    if (isset($_GET['id'])) {
        // Fetch single order with customer details
        $stmt = $db->prepare("
            SELECT o.*, b.*
            FROM orders o
            JOIN billingdetails b ON o.billing_id = b.id
            WHERE o.id = ?
        ");

        if (!$stmt) {
            throw new Exception("Failed to prepare statement: " . $db->error);
        }

        $order_id = intval($_GET['id']);
        $stmt->bind_param("i", $order_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $order = $result->fetch_assoc();

        if (!$order) {
            throw new Exception("Order not found");
        }

        // Fetch order items
        $stmt = $db->prepare("
            SELECT oi.*, p.name, p.images
            FROM order_items oi
            JOIN products p ON oi.product_id = p.id
            WHERE oi.order_id = ?
        ");
        $stmt->bind_param("i", $order_id);
        $stmt->execute();
        $items = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    } else {
        // Fetch all orders with customer details
        $stmt = $db->prepare("
            SELECT o.*, b.firstName, b.lastName, b.city, b.country
            FROM orders o
            JOIN billingdetails b ON o.billing_id = b.id
            ORDER BY o.created_at DESC
        ");

        if (!$stmt) {
            throw new Exception("Failed to prepare statement: " . $db->error);
        }

        $stmt->execute();
        $result = $stmt->get_result();
        $orders = $result->fetch_all(MYSQLI_ASSOC);
    }
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>

    <!-- ICONS -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.2/css/all.css">
    <!-- Font Awesome 5 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="./assets/css/nav.css"> <!-- Correct path for nav.css -->
    <link rel="stylesheet" href="./assets/css/style.css"> <!-- Correct path for style.css -->
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
    <!-- Make sure to include the Phosphor Icons library -->
    <link href="https://unpkg.com/phosphor-icons@1.4.1/css/phosphor.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <style>
        .table {
            margin-bottom: 0;
            background-color: transparent !important;
            color: #fff !important;
        }

        .table td,
        .table th {
            color: #fff !important;
            vertical-align: middle;
            background-color: transparent !important;
            border-color: rgba(255, 255, 255, 0.1);
        }

        .table thead th {
            color: #fff !important;
            border-bottom: 2px solid rgba(255, 255, 255, 0.1);
            font-weight: 600;
        }

        .table tbody tr:hover {
            background-color: rgba(255, 255, 255, 0.05) !important;
        }

        .badge {
            padding: 0.5em 0.8em;
            font-size: 0.85em;
        }

        .btn-sm {
            padding: 0.25rem 0.5rem;
            margin: 0 0.2rem;
        }

        .order-status-select {
            background-color: transparent;
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 0.3rem;
            border-radius: 4px;
        }

        .order-status-select option {
            background-color: #2b2f3a;
            color: white;
        }

        .table-hover tbody tr:hover {
            color: #fff;
        }
    </style>
</head>

<body>
    <?php include __DIR__ . '/../partials/navbar.php'; ?>

    <main class="main-content px-3 py-2">
        <div class="container-fluid">
            <div class="mb-3">
                <h2 class="text-white">Order<?php echo isset($_GET['id']) ? ' #' . htmlspecialchars($_GET['id']) : 's'; ?></h2>
            </div>

            <div class="card border-0 box-body text-white" style="background-color: var(--box-body);">
                <div class="card-header">
                    <h5 class="card-title">Order Details</h5>
                </div>
                <div class="card-body">
                    <?php if (isset($_GET['id']) && isset($order)): ?>
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="mb-3">Order Information</h6>
                                <p><strong>Order ID:</strong> #<?php echo htmlspecialchars($order['id']); ?></p>
                                <p><strong>Order Date:</strong> <?php echo date('F j, Y H:i', strtotime($order['created_at'])); ?></p>
                                <p><strong>Last Updated:</strong> <?php echo date('F j, Y H:i', strtotime($order['updated_at'])); ?></p>
                                <p><strong>Status:</strong>
                                    <?php
                                    $statusClass = 'secondary';
                                    switch ($order['order_status']) {
                                        case 'pending':
                                            $statusClass = 'warning';
                                            break;
                                        case 'processing':
                                            $statusClass = 'info';
                                            break;
                                        case 'completed':
                                            $statusClass = 'success';
                                            break;
                                        case 'cancelled':
                                            $statusClass = 'danger';
                                            break;
                                    }
                                    ?>
                                    <span class="badge bg-<?php echo $statusClass; ?>"><?php echo ucfirst($order['order_status']); ?></span>
                                </p>
                                <p><strong>Total Amount:</strong> <span class="fw-bold">$<?php echo number_format($order['total_amount'], 2); ?></span></p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="mb-3">Customer Information</h6>
                                <p><strong>Name:</strong> <?php echo htmlspecialchars($order['firstName'] . ' ' . $order['lastName']); ?></p>
                                <p><strong>Email:</strong> <?php echo htmlspecialchars($order['email']); ?></p>
                                <p><strong>Phone:</strong> <?php echo htmlspecialchars($order['phone']); ?></p>
                                <p><strong>Address:</strong> <?php
                                                                $address = $order['address'];
                                                                if (!empty($order['address2'])) {
                                                                    $address .= ', ' . $order['address2'];
                                                                }
                                                                $address .= ', ' . $order['city'];
                                                                if (!empty($order['county'])) {
                                                                    $address .= ', ' . $order['county'];
                                                                }
                                                                $address .= ', ' . $order['country'] . ' ' . $order['postcode'];
                                                                echo htmlspecialchars($address);
                                                                ?></p>
                            </div>
                        </div>

                        <?php if (!empty($order['notes'])): ?>
                            <div class="row mt-4">
                                <div class="col-12">
                                    <h6 class="mb-3">Order Notes</h6>
                                    <p class="mb-0"><?php echo nl2br(htmlspecialchars($order['notes'])); ?></p>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($items)): ?>
                            <h6 class="mt-4 mb-3">Order Items</h6>
                            <div class="table-responsive">
                                <table class="table table-hover text-white">
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
                                                        <?php if (!empty($item['images'])): ?>
                                                            <img src="<?php echo htmlspecialchars($item['images']); ?>"
                                                                alt="<?php echo htmlspecialchars($item['name']); ?>"
                                                                class="me-2"
                                                                style="width: 50px; height: 50px; object-fit: cover;">
                                                        <?php endif; ?>
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
                        <?php endif; ?>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-hover text-white">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Customer Name</th>
                                        <th>Location</th>
                                        <th>Total Amount</th>
                                        <th>Order Date</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($orders as $order): ?>
                                        <tr>
                                            <td>#<?php echo htmlspecialchars($order['id']); ?></td>
                                            <td><?php echo htmlspecialchars($order['firstName'] . ' ' . $order['lastName']); ?></td>
                                            <td><?php echo htmlspecialchars($order['city'] . ', ' . $order['country']); ?></td>
                                            <td>$<?php echo htmlspecialchars(number_format($order['total_amount'], 2)); ?></td>
                                            <td><?php echo date('M d, Y H:i', strtotime($order['created_at'])); ?></td>
                                            <td>
                                                <?php
                                                $statusClass = 'secondary'; // Default value
                                                switch ($order['order_status']) {
                                                    case 'pending':
                                                        $statusClass = 'warning';
                                                        break;
                                                    case 'processing':
                                                        $statusClass = 'info';
                                                        break;
                                                    case 'completed':
                                                        $statusClass = 'success';
                                                        break;
                                                    case 'cancelled':
                                                        $statusClass = 'danger';
                                                        break;
                                                }
                                                ?>
                                                <span class="badge bg-<?php echo $statusClass; ?>"><?php echo ucfirst($order['order_status']); ?></span>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-info view-details" data-order-id="<?php echo $order['id']; ?>">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="btn btn-sm btn-success update-status" data-order-id="<?php echo $order['id']; ?>">
                                                    <i class="fas fa-sync-alt"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>

    <!-- Nav -->
    <script src="assets/js/nav.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>