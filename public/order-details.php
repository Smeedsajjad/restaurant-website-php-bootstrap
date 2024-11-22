<?php
session_start();

require_once 'admin/config/config.php';

// Initialize database connection
$database = new Database();
$db = $database->conn;

$orderId = $_GET['id'];

// Get order details
$stmt = $db->prepare("
    SELECT o.*, b.firstName, b.lastName, b.email, b.phone, b.address, b.city, b.country, b.postcode
    FROM orders o
    JOIN billingdetails b ON o.billing_id = b.id
    WHERE o.id = ? AND o.user_id = ?
");
$stmt->bind_param("ii", $orderId, $_SESSION['user_id']);
$stmt->execute();
$order = $stmt->get_result()->fetch_assoc();

// If order not found or doesn't belong to user, redirect
if (!$order) {
    header('Location: index.php?page=orders');
    exit;
}

// Get order items
$stmt = $db->prepare("
    SELECT oi.*, p.name, p.images
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
    <!-- bootstrap -->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.2/css/all.css">
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <!-- custom style -->
    <link rel="stylesheet" href="assets/shop/css/style.css">
    <link rel="stylesheet" href="assets/shop/css/navbar.css">
    <title>Order Details #<?php echo $orderId; ?></title>
</head>

<body>
    <!-- header -->
    <?php include './includes/header.php'; ?>

    <!-- navbar -->
    <?php include './includes/nav.php'; ?>
    <!-- Cart Slider -->
    <?php include './includes/cartSlider.php'; ?>

    <!-- Hero section -->
    <section class="op_hero_section" style="margin-bottom: 10vh;background-image: url(./assets/shop/images/breadcrumb1.jpg);">
        <div class="container-fluid">
            <h1 class="opht d-flex justify-content-center text-center">Order Details</h1>
            <div>
                <nav class="d-flex justify-content-center test-center"
                    style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php" class="text-muted">Home</a></li>
                        <li class="breadcrumb-item"><a href="index.php?page=orders" class="text-muted">Orders</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="#" class="text-dark">Order #<?php echo $orderId; ?></a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <main>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Order Summary</h5>
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

                                echo '<span class="badge bg-' . $statusClass . '">' . $order['order_status'] . '</span>';
                                ?></span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th class="text-end">Price</th>
                                            <th class="text-end">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($items as $item): ?>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="admin/<?php echo htmlspecialchars($item['images']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" class="me-3" style="width: 50px; height: 50px; object-fit: cover;">
                                                        <div>
                                                            <h6 class="mb-0"><?php echo htmlspecialchars($item['name']); ?></h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="align-middle"><?php echo $item['quantity']; ?></td>
                                                <td class="align-middle text-end">$<?php echo number_format($item['price'], 2); ?></td>
                                                <td class="align-middle text-end">$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <tr>
                                            <td colspan="3" class="text-end"><strong>Total</strong></td>
                                            <td class="text-end"><strong>$<?php echo number_format($order['total_amount'], 2); ?></strong></td>
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
                            <h5 class="mb-0">Order Information</h5>
                        </div>
                        <div class="card-body">
                            <p><strong>Order Date:</strong><br>
                                <?php echo date('F j, Y g:i A', strtotime($order['created_at'])); ?></p>
                            <p><strong>Payment Method:</strong><br>
                                <?php echo ucfirst($order['payment_method']); ?></p>
                            <hr>
                            <h6>Shipping Address</h6>
                            <p class="mb-0">
                                <?php echo $order['firstName'] . ' ' . $order['lastName']; ?><br>
                                <?php echo $order['address']; ?><br>
                                <?php echo $order['city'] . ', ' . $order['country']; ?><br>
                                <?php echo $order['postcode']; ?><br>
                                Phone: <?php echo $order['phone']; ?><br>
                                Email: <?php echo $order['email']; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- footer section -->
    <?php include './includes/footer.php' ?>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#add-to-cart').on('click', function() {
                let productId = $(this).data('id');
                let quantity = $('#quantity').val();

                $('#success-message').hide();
                $('#error-message').hide();
                $('.loader-bg').show(); // Show loader

                $.ajax({
                    url: './php/add_to_cart.php',
                    method: 'POST',
                    data: {
                        product_id: productId,
                        quantity: quantity
                    },
                    success: function(response) {
                        try {
                            if (typeof response === 'string') {
                                response = JSON.parse(response); // Parse if JSON string
                            }

                            if (response.status === 'success') {
                                $('#success-message p').text(response.product_name + '" has been added successfully');
                                $('#success-message').fadeIn();
                                $('.count-icon').text(response.cart_count); // Update cart count
                            } else {
                                $('#error-message p').text(response.message || 'An error occurred');
                                $('#error-message').fadeIn();
                            }
                        } catch (error) {
                            console.error("Parsing error:", error);
                            $('#error-message p').text('Unexpected response format');
                            $('#error-message').fadeIn();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX error:', status, error);
                        $('#error-message p').text('Failed to add product to cart');
                        $('#error-message').fadeIn();
                    },
                    complete: function() {
                        setTimeout(() => {
                            $('.loader-bg').fadeOut(); // Smoothly hide loader
                        }, 500); // Optional delay
                    }
                });
            });

            // Function to fetch and update cart count
            function updateCartCount() {
                $.ajax({
                    url: './php/get_cart_count.php',
                    method: 'GET',
                    success: function(response) {
                        try {
                            if (typeof response === 'string') {
                                response = JSON.parse(response);
                            }
                            if (response.status === 'success') {
                                $('#cart-count').text(response.count); // Update cart count badge
                                $('#cart-count-sm').text(response.count); // Update cart count badge
                            } else {
                                console.error('Error in response:', response.message);
                            }
                        } catch (error) {
                            console.error("Parsing error:", error);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Failed to fetch cart count:', status, error);
                    }
                });
            }

            // Initial cart count update on page load
            updateCartCount();
        });
    </script>
</body>

</html>