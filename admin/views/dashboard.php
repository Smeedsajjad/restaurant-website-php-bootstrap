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
    <title>Dashboard</title>
    <!-- ICONS -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
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
</head>

<body>
    <?php
    include './partials/navbar.php';
    ?>
    <main>
        <h2 class="text-capitalize" >
            <?php
        if (isset($_SESSION['username'])) {
            echo "Welcome, " . htmlspecialchars($_SESSION['username']) . "!";
        } else {
            header("Location: index.php?page=login");
            exit;
        }
        ?>
        </h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit impedit quo aut earum assumenda ipsa adipisci culpa quia. Consequatur eum eveniet quo facere ea modi corrupti optio voluptatem quia exercitationem?</p>
    </main>

    <!-- Add jQuery from a CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- Custom JS -->
    <script src="./assets/js/nav.js"></script>
</body>

</html>