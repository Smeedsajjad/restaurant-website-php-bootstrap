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
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
// update status
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order_id = $_POST['order_id'];
    $order_id = $_POST['order_status'];
    $order_status = $_POST['status'];

    $stmt = $pdo->prepare("UPDATE orders SET order_status = ?, updated_at = NOW() WHERE id = ?");
    if ($stmt->execute([$order_status, $order_id])) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders</title>

    <!-- ICONS -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.2/css/all.css">
    <!-- Font Awesome 5 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="./assets/css/nav.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/orders.css">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
    <!-- Make sure to include the Phosphor Icons library -->
    <link href="https://unpkg.com/phosphor-icons@1.4.1/css/phosphor.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="../vendor/datatables/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.bootstrap5.min.css">

   
</head>

<body>
    <?php include __DIR__ . '/../partials/navbar.php'; ?>

    <main class="main-content px-3 py-2">
        <div class="container-fluid">
            <div class="mb-3">
                <h2 class="text-white">Manage Orders</h2>
            </div>

            <div class="card border-0 box-body text-white" style="background-color: var(--box-body);">
                <div class="card-header">
                    <h5 class="card-title">Orders List</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Date</th>
                                    <th>Customer Name</th>
                                    <th>Location</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (isset($orders) && is_array($orders)): ?>
                                    <?php foreach ($orders as $order): ?>
                                        <tr>
                                            <td>#<?php echo htmlspecialchars($order['id']); ?></td>
                                            <td><?php echo date('M d, Y', strtotime($order['created_at'])); ?></td>
                                            <td><?php echo htmlspecialchars($order['firstName'] . ' ' . $order['lastName']); ?></td>
                                            <td><?php echo htmlspecialchars($order['city'] . ', ' . $order['country']); ?></td>
                                            <td>$<?php echo number_format($order['total_amount'], 2); ?></td>
                                            <td>
                                                <span class="status-badge status-<?php echo $order['order_status']; ?>">
                                                    <?php echo ucfirst($order['order_status']); ?>
                                                </span>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        ...
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="index.php?page=order-view&id=<?php echo $order['id']; ?>">View</a></li>
                                                        <li>
                                                            <hr class="dropdown-divider">
                                                        </li>
                                                        <li>
                                                            <button type="button" class="btn btn-primary text-white dropdown-item edit-status-btn"
                                                                data-bs-toggle="modal" data-order-id="<?php echo $order['id']; ?>">
                                                                Edit Status
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Status Update Modal -->
    <div class="modal fade" id="updateStatusModal" tabindex="-1" aria-labelledby="updateStatusModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateStatusModalLabel">Update Order Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="updateStatusForm">
                    <div class="modal-body">
                        <input type="hidden" name="order_id" id="orderIdInput">
                        <div class="mb-3">
                            <label for="statusSelect" class="form-label">Status</label>
                            <select class="form-select" id="statusSelect" name="status" required>
                                <option value="pending">Pending</option>
                                <option value="processing">Processing</option>
                                <option value="completed">Completed</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Status</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Toast Notification -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="statusToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Notification</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body"></div>
        </div>
    </div>

    <!-- Nav -->
    <script src="assets/js/nav.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables JS -->
    <script src="../vendor/datatables/datatables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTable with export buttons
            var table = $('#example').DataTable({
                responsive: true,
                order: [
                    [1, 'desc']
                ],
                pageLength: 10,
                dom: '<"row"<"col-md-6"B><"col-md-6"f>>rtip',
                buttons: [{
                        extend: 'collection',
                        text: '<svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="0.576"></g><g id="SVGRepo_iconCarrier"> <path d="M4.06189 13C4.02104 12.6724 4 12.3387 4 12C4 7.58172 7.58172 4 12 4C14.5006 4 16.7332 5.14727 18.2002 6.94416M19.9381 11C19.979 11.3276 20 11.6613 20 12C20 16.4183 16.4183 20 12 20C9.61061 20 7.46589 18.9525 6 17.2916M9 17H6V17.2916M18.2002 4V6.94416M18.2002 6.94416V6.99993L15.2002 7M6 20V17.2916" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg> Export',
                        buttons: [{
                                extend: 'excel',
                                text: 'Excel',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5]
                                }
                            },
                            {
                                extend: 'csv',
                                text: ' CSV',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5]
                                }
                            },
                            {
                                extend: 'pdf',
                                text: 'PDF',
                                exportOptions: {
                                    columns: [0, 1, 2, 3, 4, 5]
                                }
                            }
                        ]
                    },
                    {
                        extend: 'print',
                        text: '<svg width="17px" height="17px" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M7 1H1V5H7V1Z" fill="#ffffff"></path> <path d="M7 7H1V15H7V7Z" fill="#ffffff"></path> <path d="M9 1H15V9H9V1Z" fill="#ffffff"></path> <path d="M15 11H9V15H15V11Z" fill="#ffffff"></path> </g></svg> Print',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        }
                    },
                    {
                        text: '<svg height="24" width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff" transform="rotate(90)"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="0.576"></g><g id="SVGRepo_iconCarrier"> <path d="M4.06189 13C4.02104 12.6724 4 12.3387 4 12C4 7.58172 7.58172 4 12 4C14.5006 4 16.7332 5.14727 18.2002 6.94416M19.9381 11C19.979 11.3276 20 11.6613 20 12C20 16.4183 16.4183 20 12 20C9.61061 20 7.46589 18.9525 6 17.2916M9 17H6V17.2916M18.2002 4V6.94416M18.2002 6.94416V6.99993L15.2002 7M6 20V17.2916" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg> Refresh',
                        action: function(e, dt, node, config) {
                            // Reload the page
                            location.reload();
                        },
                        attr: {
                            id: 'refreshTable'
                        }
                    }
                ]
            });


        });
    </script>

    <script>
        // Add this to your existing JavaScript
        document.addEventListener('DOMContentLoaded', function() {
            const editStatusBtns = document.querySelectorAll('.edit-status-btn');
            const statusModal = new bootstrap.Modal(document.getElementById('updateStatusModal'));
            const toastEl = document.getElementById('statusToast');
            const toast = new bootstrap.Toast(toastEl);
            let currentRow;

            function showToast(message, isSuccess) {
                document.querySelector('.toast-body').textContent = message;
                toastEl.classList.remove(isSuccess ? 'bg-danger' : 'bg-success');
                toastEl.classList.add(isSuccess ? 'bg-success' : 'bg-danger');
                toast.show();
            }

            editStatusBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    currentRow = this.closest('tr');
                    const orderId = this.getAttribute('data-order-id');
                    const currentStatus = currentRow.querySelector('.status-badge').textContent.trim().toLowerCase();

                    document.getElementById('orderIdInput').value = orderId;
                    document.getElementById('statusSelect').value = currentStatus;

                    statusModal.show();
                });
            });

            // Handle form submission
            document.getElementById('updateStatusForm').addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);
                const submitBtn = this.querySelector('button[type="submit"]');
                submitBtn.disabled = true;

                fetch('php/update_order_status.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(async response => {
                        const text = await response.text();

                        try {
                            const data = JSON.parse(text);
                            return data;
                        } catch (e) {
                            throw new Error('Invalid JSON response from server');
                        }
                    })
                    .then(data => {

                        if (data.success) {
                            // Update the status badge in the table
                            const statusBadge = currentRow.querySelector('.status-badge');
                            const newStatus = formData.get('status');
                            statusBadge.textContent = newStatus.charAt(0).toUpperCase() + newStatus.slice(1);

                            // Update badge classes
                            statusBadge.className = 'status-badge';
                            switch (newStatus) {
                                case 'pending':
                                    statusBadge.classList.add('bg-warning', 'text-dark');
                                    break;
                                case 'processing':
                                    statusBadge.classList.add('bg-info', 'text-dark');
                                    break;
                                case 'completed':
                                    statusBadge.classList.add('bg-success');
                                    break;
                                case 'cancelled':
                                    statusBadge.classList.add('bg-danger');
                                    break;
                            }

                            showToast(data.message, true);
                            statusModal.hide();
                        } else {
                            showToast(data.message || 'Failed to update status', false);
                        }
                    })
                    .catch(error => {
                        showToast(error.message || 'An error occurred while updating the status', false);
                    })
                    .finally(() => {
                        submitBtn.disabled = false;
                    });
            });
        });
    </script>
</body>

</html>