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
        <div class="offcanvas offcanvas-end bg-dark text-white" tabindex="-1" id="offcanvasNavbar"
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
