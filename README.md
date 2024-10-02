restaurant-website-php-bootstrap/
├── admin/
│   ├── index.php
│   └── views/
│       └── dashboard.php
├── assets/
│   ├── css/
│       ├── nav.css
│       └── style.css
│   └── js/
│       └── nav.js
└── vendor/
    └── bootstrap/
        ├── css/
        │   └── bootstrap.min.css
        └── js/
            └── bootstrap.min.js

project-root/
│
├── assets/
│   ├── css/
│   │   ├── style.css        # Global styles
│   │   └── nav.css          # Navbar-specific styles
│   ├── images/
│   │   └── logo.png         # Logo and other images
│   ├── js/
│       └── nav.js           # JavaScript for navbar toggling
│
├── vendor/
│   ├── bootstrap/
│       └── bootstrap.min.css # Bootstrap CSS
│       └── bootstrap.min.js  # Bootstrap JS
│
├── includes/
│   ├── navbar.php           # Navbar component
│
├── pages/
│   ├── home.php             # Home page content
│   ├── dashboard.php        # Dashboard content
│   └── posts.php            # Posts content
│
├── index.php                # Entry point for the website
└── config.php               # Configuration settings (if any)



restaurant-website/
│
├── admin/                  # Admin panel-related files
│   ├── css/                # Admin-specific CSS
│   │   └── admin-styles.css
│   ├── js/                 # Admin-specific JavaScript
│   │   └── admin-scripts.js
│   ├── dashboard.php       # Admin dashboard
│   ├── manage-menu.php     # Admin page to manage restaurant menu
│   ├── manage-orders.php   # Admin page to view/manage orders
│   ├── manage-users.php    # Admin page to manage users
│   └── includes/           # Admin common includes (header, footer, etc.)
│       ├── header.php
│       ├── footer.php
│       └── sidebar.php
│
├── assets/                 # Static files
│   ├── css/                # General site CSS
│   │   └── styles.css      # Main stylesheet for the user panel
│   ├── images/             # All images used across the website
│   │   └── logo.png
│   ├── js/                 # General JavaScript
│   │   ├── main.js         # Main JS file
│   │   └── validations.js  # Form validations
│   └── vendor/             # External libraries (e.g., Bootstrap, jQuery)
│       ├── bootstrap/
│       ├── fontawesome/
│       └── jquery/
│
├── user/                   # User panel-related files
│   ├── css/                # User-specific CSS
│   │   └── user-styles.css
│   ├── js/                 # User-specific JavaScript
│   │   └── user-scripts.js
│   ├── index.php           # User homepage (main page)
│   ├── menu.php            # Restaurant menu page
│   ├── cart.php            # Cart page for users
│   ├── checkout.php        # Checkout page for users
│   ├── contact.php         # Contact page
│   └── includes/           # User common includes (header, footer, etc.)
│       ├── header.php
│       ├── footer.php
│       └── navbar.php
│
├── config/                 # Configuration files
│   ├── config.php          # Database connection, app constants
│   └── db.php              # Database connection script
│
├── functions/              # Helper PHP functions
│   └── user-functions.php  # User-related PHP functions
│   └── admin-functions.php # Admin-related PHP functions
│
├── uploads/                # Folder to store uploaded files (images, etc.)
│   └── menu-images/
│
├── api/                    # API routes for the app (e.g., REST API for AJAX requests)
│   └── user-api.php        # User-related API routes
│   └── admin-api.php       # Admin-related API routes
│
├── vendor/                 # Composer dependencies (if you use any)
│
├── .htaccess               # Apache server settings (if required)
├── index.php               # Main index file for the website (landing page)
├── login.php               # Login page for users and admins
├── register.php            # Registration page for users
├── logout.php              # Logout script
└── README.md               # Project documentation
