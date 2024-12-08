<?php
session_start();
ob_start();
require_once './config/config.php';
require_once './php/Admin.php';

// Create a new database connection
$database = new Database();
$dbConnection = $database->conn;

// Create an Admin object
$admin = new Admin($dbConnection);

// Set the session timeout duration in seconds (e.g., 1800 for 30 minutes)
$sessionTimeout = 86400;

// Check if the user is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php?page=login"); // Redirect to login if not logged in
    exit;
}

// Check session timeout
if (isset($_SESSION['last_activity'])) {
    // Calculate the session lifetime
    $sessionLifetime = time() - $_SESSION['last_activity'];

    // If session has expired, log out the user
    if ($sessionLifetime > $sessionTimeout) {
        // Destroy session and redirect to login page
        session_unset();
        session_destroy();
        header("Location: index.php?page=login"); // Optional: Indicate session timeout
        exit;
    }
}

// Update last activity timestamp
$_SESSION['last_activity'] = time();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .main-content {
            padding: 20px;
        }

        .welcome-message {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .stats-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .card {
            background-color: var(--navbg);
            color: #fff !important;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;

        }

        .card h3 {
            margin: 0;
            font-size: 18px;
            color: #fff;
        }

        .card .number {
            font-size: 36px;
            color: #fff;
            margin: 10px 0;
        }

        .chart-container {
            background: #ffffff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        canvas {
            max-width: 100%;
            height: auto;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #aaa;
        }
        .chart-container{
            background: var(--navbg)
        }
    </style>
</head>

<body>
    <?php include './partials/navbar.php'; ?>

    <main class="main-content">
        <h2 class="welcome-message">
            <?php
            if (isset($_SESSION['username'])) {
                echo "Welcome, " . htmlspecialchars($_SESSION['username']) . "!";
            } else {
                header("Location: index.php?page=login");
                exit;
            }
            ?>
        </h2>

        <!-- Statistics Cards -->
        <section class="stats-cards ">
            <div class="card">
                <h3>Total Users</h3>
                <div class="number">1,245</div>
            </div>
            <div class="card">
                <h3>Orders Today</h3>
                <div class="number">348</div>
            </div>
            <div class="card">
                <h3>Revenue</h3>
                <div class="number">$12,400</div>
            </div>
            <div class="card">
                <h3>New Messages</h3>
                <div class="number">15</div>
            </div>
        </section>

        <!-- Chart Section -->
        <section class="chart-container">
            <canvas id="salesChart"></canvas>
        </section>
    </main>

    <footer class="footer">
        <p>&copy; 2024 Admin Dashboard. All rights reserved.</p>
    </footer>

    <script>
        // Chart.js Configuration
        const ctx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                datasets: [{
                    label: 'Sales Over Time',
                    data: [300, 400, 200, 500, 700, 600, 800],
                    backgroundColor: 'rgba(97, 51, 189, 0.2)',
                    borderColor: '#0d6dfc',
                    borderWidth: 2,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Months'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Sales ($)'
                        }
                    }
                }
            }
        });
    </script>
        <script src="assets/js/nav.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
