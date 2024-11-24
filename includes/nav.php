<?php
$_SESSION['logged_in'] = true;
?>
<!-- Navbar for large screens -->
<nav class="navbar navbar-expand-lg d-none d-lg-flex" style="position: sticky; top: 0; z-index: 1000;background-color: #fff;">
    <div class="container">
        <a class="navbar-brand p-3" href="index.php?page=home">
            <img src="assets/shop/images/logo_svg.svg" alt="Logo" height="30">
        </a>
        <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active fw-bold text-dark" aria-current="page" href="index.php?page=home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold text-dark" href="index.php?page=about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold text-dark" href="index.php?page=contact">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold text-dark" href="index.php?page=shop">Shop</a>
                </li>
                <?php if (!isset($_SESSION['user_id'])): ?>
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-dark" href="index.php?page=signup">SignUp</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-dark" href="index.php?page=login">Login</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-dark" href="index.php?page=orders">Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-dark" href="index.php?page=logout">Logout</a>
                    </li>
                <?php endif; ?>
            </ul>

            <div class="d-flex align-items-center p-3">
                <a href="#" class="text-dark me-4"><i class="fas fa-search"></i></a>
                <div class="dropdown">
                    <button class="dropdown-toggle text-dark me-3" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="border: none;">
                        <i class="fas fa-user"></i>
                    </button>

                    <ul class="dropdown-menu">
                        <li>
                            <p class="dropdown-item" style="font-size: small;"><span class="fw-bold">Hi, </span><?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest'; ?></p>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <?php if (!isset($_SESSION['user_id'])): ?>
                            <li><a class="dropdown-item text-dark fw-bold" href="index.php?page=signup">Create Account</a></li>
                        <?php else: ?>
                            <li><a class="dropdown-item text-dark fw-bold" href="#">Menage Profile</a></li>
                        <?php endif; ?>
                    </ul>
                </div>

                <a href="#" class="text-dark me-4 position-relative">
                    <i class="fas fa-heart"></i>
                    <span id="wishlist-count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill count-icon">0</span>
                </a>
                <!-- Cart Icon -->
                <a data-bs-toggle="offcanvas" data-bs-target="#cartOffcanvas" aria-controls="cartOffcanvas" class="text-dark position-relative" style="cursor: pointer;">
                    <i class="fa-solid fa-basket-shopping"></i>
                    <span class="cart-count position-absolute top-0 start-100 translate-middle badge rounded-pill count-icon" id="cart-count">0</span>
                </a>

            </div>
        </div>
    </div>
</nav>
<style>
    .fa-basket-shopping {
        padding: 10px;
        border-radius: 50%;
        background-color: transparent;
    }

    .fa-basket-shopping:hover {
        background-color: var(--primary);
    }

    .dropdown-toggle::after {
        display: none;
    }
</style>
<!-- nav for sm -->
<nav class="navbar navbar-expand-lg d-lg-none bg-light position-sticky top-0" style="z-index: 1000; padding: 15px;">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center w-100">
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-expanded="false"
                aria-label="Toggle navigation">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon-toggler h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" width="30" height="30">
                    <path stroke-linecap="square" stroke-linejoin="round" stroke-width="2" d="M4 6h16" />
                    <path stroke-linecap="square" stroke-linejoin="round" stroke-width="2" d="M4 12h12" />
                    <path stroke-linecap="square" stroke-linejoin="round" stroke-width="2" d="M4 18h16" />
                </svg>
            </button>

            <a class="navbar-brand mx-auto" href="index.php?page=home">
                <img src="assets/shop/images/logo_svg.svg" alt="Logo" height="30">
            </a>
            <a href="tel:+17189044450" class="text-dark">
                <span class="position-relative">
                    <i class="fas fa-phone-alt fs-3"></i>
                </span>
            </a>
        </div>
        <div class="offcanvas offcanvas-start bg-dark text-white" tabindex="-1" id="offcanvasNavbar"
            aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active fw-bold text-white" aria-current="page" href="index.php?page=home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-white" href="index.php?page=about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-white" href="index.php?page=shop">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-white" href="index.php?page=blog">Blog</a>
                    </li>
                    <!-- Only show these links if the user is NOT logged in -->
                    <?php if (!isset($_SESSION['user_id'])): ?>
                        <li class="nav-item">
                            <a class="nav-link fw-bold text-white" href="index.php?page=signup">SignUp</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-bold text-white" href="index.php?page=login">Login</a>
                        </li>
                    <?php else: ?>
                        <!-- Show logout only if the user IS logged in -->
                        <li class="nav-item">
                            <a class="nav-link fw-bold text-white" href="index.php?page=logout">Logout</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</nav>

<!-- sm bottom nav -->
<nav class="navbar navbar-expand-lg d-lg-none bg-light position-fixed bottom-0 w-100" style="z-index: 1000; padding: 10px;">
    <div class="container-fluid p-0">
        <div class="d-flex justify-content-between align-items-center w-100 icon-container">
            <div class="text-center icon-item">
                <a href="#" class="text-dark"><i class="fa-solid fa-store icon-size"></i></a>
                <h6 class="fw-semibold mb-0">Shop</h6>
            </div>
            <div class="text-center icon-item">
                <a href="#" class="text-dark"><i class="fas fa-user icon-size"></i></a>
                <h6 class="fw-semibold mb-0">Account</h6>
            </div>
            <div class="text-center icon-item">
                <a href="#" class="text-dark"><i class="fas fa-search icon-size"></i></a>
                <h6 class="fw-semibold mb-0">Search</h6>
            </div>
            <div class="text-center icon-item position-relative">
                <a href="#" class="text-dark me-4 position-relative">
                    <i class="fas fa-heart"></i>
                    <span id="wishlist-count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill count-icon">0</span>
                </a>
                <h6 class="fw-semibold mb-0">Wishlist</h6>
            </div>
            <div class="text-center icon-item position-relative">
                <a href="index.php?page=cart" class="text-dark">
                    <i class="fa-solid fa-basket-shopping icon-size"></i>
                    <span id="cart-count-sm" class="position-absolute badge rounded-pill count-icon" style="top: -10px; right: 0;">0</span>
                </a>
                <h6 class="fw-semibold mb-0">Cart</h6>
            </div>

        </div>
    </div>
</nav>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#logoutButton').on('click', function(event) {
            event.preventDefault();

            $.ajax({
                url: 'ajax.php',
                type: 'POST',
                data: {
                    action: 'logout'
                },
                success: function(response) {
                    $('#response').html(response.message);
                    if (response.status) {
                        setTimeout(function() {
                            window.location.href = 'index.php';
                        }, 1000);
                    }
                },
                error: function() {
                    $('#response').html('An error occurred.');
                }
            });
        });
    });
</script>