<?php
session_start();
ob_start();
require_once './config/config.php';
require_once './php/ContactMessages.php'; // Ensure this is the correct path

// Create a new database connection
$database = new Database();
$dbConnection = $database->conn;

// Create a ContactController object
$contact = new ContactController($dbConnection);
$contacts = $contact->getAllContacts();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
    <!-- ICONS -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="./assets/css/nav.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #2c3e50;
            color: #ecf0f1;
            font-family: 'Roboto', sans-serif;
        }

        .table {
            margin-bottom: 0;
            background-color: #34495e !important;
            color: #ecf0f1 !important;
            border-radius: 5px;
            overflow: hidden;
        }

        .table th,
        .table td {
            color: #ecf0f1 !important;
            vertical-align: middle;
            background-color: transparent !important;
            border-color: var(--box-body);
            padding: 15px;
        }

        .table thead th {
            color: #ecf0f1 !important;
            border-bottom: 2px solid var(--box-body);
            font-weight: 600;
            background-color: #2c3e50;
        }

        .table tbody tr {
            background-color: var(--box-body) !important;
            cursor: pointer;
        }

        .card {
            background-color: #34495e;
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .dataTables_length,
        select,
        div#DataTables_Table_0_info {
            color: #fff !important;

        }

        .table thead {
            background-color: var(--box-body) !important;
        }

        .stripe1 {
            background-color: #2c3e50;
            /* Darker shade for odd rows */
        }

        .stripe2 {
            background-color: #34495e;
            /* Lighter shade for even rows */
        }
    </style>
</head>

<body>
    <?php include_once './partials/navbar.php'; ?>
    <main class="main-content px-3 py-2">
        <div class="container-fluid">
            <div class="mb-3">
                <h2 class="text-white">Messages</h2>
            </div>

            <div class="card border-0 box-body text-white" style="background-color: var(--box-body);">
                <div class="card-header">
                    <h5 class="card-title">Message Details</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover text-white mb-4 border-0 position-relative" style="top: 10px;">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Subject</th>
                                    <th>Message</th>
                                    <th>Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($contacts as $message): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($message['id']); ?></td>
                                        <td><?php echo htmlspecialchars($message['name']); ?></td>
                                        <td><?php echo htmlspecialchars($message['email']); ?></td>
                                        <td><?php echo htmlspecialchars($message['subject']); ?></td>
                                        <td><?php echo htmlspecialchars($message['message']); ?></td>
                                        <td><?php echo date('M d, Y H:i', strtotime($message['created_at'])); ?></td>
                                        <td>
                                            <button class="btn btn-danger btn-sm delete-message" data-id="<?php echo $message['id']; ?>">Delete</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Add jQuery from a CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <!-- Custom JS -->
    <script src="./assets/js/nav.js"></script>
    <script>
        $(document).ready(function() {
            $('.table').DataTable({
                responsive: true,
                paging: true,
                searching: true,
                ordering: true,
                columnDefs: [{
                    targets: [0, 5], // Assuming ID and Time columns are not sortable
                    orderable: false
                }],
                stripeClasses: ['stripe1', 'stripe2']
            });

            // Handle delete button click
            $('.delete-message').on('click', function() {
                const messageId = $(this).data('id');
                const row = $(this).closest('tr'); // Get the row of the clicked button

                if (confirm('Are you sure you want to delete this message?')) {
                    $.ajax({
                        url: './php/delete_message.php',
                        type: 'POST',
                        data: {
                            id: messageId
                        },
                        success: function(response) {
                            try {
                                if (typeof response === 'string') {
                                    response = JSON.parse(response);
                                }

                                if (response.success) {
                                    row.fadeOut(function() {
                                        row.remove();
                                    });
                                    alert(response.message);
                                } else {
                                    alert(response.message);
                                }
                            } catch (e) {
                                console.error('Response:', response); // Log the response for debugging
                                alert('Failed to parse JSON response.');
                            }
                        },
                        error: function() {
                            alert('An error occurred while trying to delete the message.');
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>