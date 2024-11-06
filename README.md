```bash
restaurant-website/
│
├── admin/                         # Admin panel for managing restaurant content
│   ├── css/                       # Admin CSS files
│   ├── js/                        # Admin JavaScript files
│   ├── php/                       # PHP scripts for admin functionalities
│   │   ├── ProductController.php
│   │   ├── CategoryController.php
│   │   ├── UserController.php
│   │   └── Database.php
│   ├── views/                     # Admin panel views
│   │   ├── add-products.php
│   │   ├── edit-products.php
│   │   ├── product-list.php
│   │   └── dashboard.php
│   └── index.php                  # Entry point for the admin panel
│
├── assets/                        # Public assets for the restaurant website
│   ├── css/                       # Stylesheets for the frontend
│   ├── js/                        # JavaScript
│   ├── images/                    # Images used in the website
│   └── fonts/                     # Custom fonts if any
│
├── includes/                      # Commonly used files
│   ├── header.php                 # Header HTML
│   ├── footer.php                 # Footer HTML
│   └── nav.php                    # It includ cart navbar etc...
│
├── php/
|                        # Controller & other php code
|
├── public/                        # Publicly accessible files
│   ├── index.php                  # Home page
│   ├── menu.php                   # Menu page
│   ├── about.php                  # About page
│   ├── contact.php                # Contact page
│   ├── signup.php                # SignUp page
│   ├── reservations.php           # Reservation page
│   ├── gallery.php                # Gallery page
│   └── 404.php                    # 404 error page
│
├── .htaccess                      # Apache configuration for URL rewriting
├── composer.json                  # Composer dependencies (if using)
├── package.json                   # Node.js dependencies (if using)
└── README.md                      # Project documentation
```

<h1>Later Add this code</h1>
  <h2>Welcome to the Restaurant Management System</h2>
    <p>Hello,<?php
                // Check if the user is logged in and display the username or a default message
                echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Guest';
                ?>!
    </p>

    <?php if (!isset($_SESSION['user_id'])): ?>
        <p><a href="index.php?page=login">Login</a> or <a href="index.php?page=signup">Sign Up</a> to enjoy more features.</p>
    <?php endif; ?>