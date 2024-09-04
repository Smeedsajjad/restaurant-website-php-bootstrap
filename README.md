# restaurant-website-php-bootstrap

A dynamic restaurant website built with PHP, Bootstrap, HTML, CSS, and JavaScript, featuring an interactive menu, reservation system, and responsive design for a seamless user experience across all devices.

```plaintext
/restaurant-website/
│
├── /admin/                # Admin panel related files
│   ├── /assets/           # CSS, JS, images for admin
│   ├── /partials/         # Common includes (header, footer, sidebar)
│   ├── /views/            # Admin views (pages)
│   ├── add-product.php    # Page to add a product
│   ├── edit-product.php   # Page to edit a product
│   ├── manage-products.php# Manage products (list, edit, delete)
│   ├── manage-orders.php  # Manage orders
│   ├── manage-users.php   # Manage users
│   ├── dashboard.php      # Admin dashboard
│   ├── login.php          # Admin login
│   ├── index.php          # Admin homepage (redirect to dashboard)
│   └── logout.php         # Admin logout
│
├── /assets/               # CSS, JS, images for frontend
│   ├── /css/              # Stylesheets
│   ├── /js/               # JavaScript files
│   ├── /images/           # Images for the website
│   └── /fonts/            # Fonts, if any
│
├── /partials/             # Common includes for frontend (header, footer, navbar)
│   ├── header.php         # Header file (includes navbar)
│   ├── footer.php         # Footer file
│   └── sidebar.php        # Sidebar, if used
│
├── /uploads/              # Folder to store uploaded images (product images, etc.)
│
├── /config/               # Configuration files
│   ├── config.php         # Database connection and other settings
│   ├── functions.php      # Common utility functions
│
├── /views/                # Frontend views (pages)
│   ├── home.php           # Home page
│   ├── menu.php           # Menu page (lists categories and products)
│   ├── product.php        # Product details page
│   ├── cart.php           # Shopping cart page
│   ├── checkout.php       # Checkout page
│   ├── order-history.php  # Order history for logged-in users
│   ├── contact.php        # Contact page
│   ├── register.php       # User registration page
│   ├── login.php          # User login page
└── index.php              # Website homepage (redirects to home.php)
│ ├── order-history.php # Order history for logged-in users │ ├── contact.php # Contact page │ ├── register.php # User registration page │ ├── login.php # User login page └── index.php # Website homepage (redirects to home.php)

