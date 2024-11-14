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


      <div class="col-md-4 fw-semibold p-4" style="border: 6px solid #e5e5e5;">
                        <h2 class="text-capitalize border-bottom mb-2">Cart Totals</h2>
                        <?php
                        // Initialize subtotal and total
                        $subtotal = 0;

                        // Calculate subtotal
                        foreach ($cartData as $item) {
                            $subtotal += $item['price'] * $item['quantity'];
                        }

                        // Calculate total
                        $shippingCost = 0; // Set shipping cost if applicable
                        $total = $subtotal + $shippingCost;

                        // Format the values for display
                        $formattedSubtotal = number_format($subtotal, 2);
                        $formattedTotal = number_format($total, 2);
                        ?>

                        <form action="" method="post">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr class="cart-subtotal mb-2">
                                        <th>Subtotal</th>
                                        <td class="text-end"><span id="subtotal">£<?php echo $formattedSubtotal; ?></span></td>
                                    </tr>
                                    <tr class="shipping-totals shipping">
                                        <th>Shipping</th>
                                        <td class="text-end">
                                            <span class="text-muted" style="font-size: 14px;">Shipping costs are calculated during checkout.</span>
                                        </td>
                                    </tr>
                                    <tr class="order-total">
                                        <th>Total</th>
                                        <td class="text-end"><strong><span id="total">£<?php echo $formattedTotal; ?></span></strong></td>
                                    </tr>
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-warning text-capitalize w-100 mt-3" style="font-weight: bold;">
                                Proceed to checkout
                            </button>
                        </form>
                    </div>