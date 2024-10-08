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
    include __DIR__ . '/../partials/navbar.php';
    ?>

    <main>
        <h1>Main content goes here</h1>
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
