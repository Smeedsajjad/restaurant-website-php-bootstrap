<!-- nav for lg -->
<nav class="navbar navbar-expand-lg d-none d-lg-flex" style="position: sticky; top: 0; z-index: 1000;background-color: #fff;">
    <div class="container">
        <a class="navbar-brand p-3" href="#">
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
                    <a class="nav-link fw-bold text-dark" href="index.php?page=shop">Shop</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold text-dark" href="index.php?page=blog">Blog</a>
                </li>
                <!-- Only show these links if the user is NOT logged in -->
                <?php if (!isset($_SESSION['user_id'])): ?>
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-dark" href="index.php?page=signup">SignUp</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-dark" href="index.php?page=login">Login</a>
                    </li>
                <?php else: ?>
                    <!-- Show logout only if the user IS logged in -->
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-dark" href="index.php?page=logout">Logout</a>
                    </li>
                <?php endif; ?>
            </ul>

            <div class="d-flex align-items-center p-3">
                <span class="text-dark me-3 call-order-container">
                    <div class="call-order-icon">
                        <svg id="Layer_1" width="45" height="45" data-name="Layer 1"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
                            <defs>
                                <style>
                                    .cls-1 {
                                        stroke-width: 0px;
                                        fill: #00A149;
                                    }
                                </style>
                            </defs>
                            <path class="cls-1"
                                d="m47.628,31.482c-.775-.626-1.659-1.114-2.628-1.46v-1.552c0-.918-.258-1.825-.747-2.624-.484-.788-1.179-1.427-2.019-1.853-.849-.42-1.437-1.203-1.611-2.144l-.885-4.851h1.262c1.103,0,2-.897,2-2v-5c0-1.103-.897-2-2-2h-3.5c-.369,0-.722.057-1.065.141l-.261-.792c-.283-.807-1.044-1.349-1.894-1.349h-1.28v-1c0-.552-.447-1-1-1s-1,.448-1,1v4c0,.552.447,1,1,1s1-.448,1-1v-1.003l1.28-.004.352,1.069c-.867.724-1.449,1.758-1.581,2.939h-3.051c-.553,0-1,.448-1,1s.447,1,1,1h3.074l.759,9.821c.075,1.061-.391,2.062-1.243,2.675-1.251.891-2.861,2.041-3.951,2.82-.687.49-1.542.675-2.336.507-2.599-.566-4.725-2.403-5.705,4.823h.403c1.654,0,3-1.346,3-3s-1.346-3-3-3h-5.178c.112-.314.178-.648.178-1v-8c0-1.654-1.346-3-3-3H5c-1.654,0-3,1.346-3,3v8c0,.396.099.763.239,1.11-1.285.339-2.239,1.5-2.239,2.89,0,1.654,1.346,3,3,3h.149c-2.012,2.544-3.149,5.711-3.149,9,0,1.192.145,2.374.43,3.511.218.876,1.016,1.489,1.94,1.489h2.655c.254,2.799,2.611,5,5.475,5s5.221-2.201,5.475-5h18.045c.528,0,.965-.411.998-.938.23-3.68,3.298-6.562,6.982-6.562.767,0,1.525.126,2.254.375.785.271,1.498.662,2.118,1.162.428.347,1.059.279,1.406-.149.347-.43.279-1.06-.15-1.406Zm-6.628-21.482v5h-3.5c-1.379,0-2.5-1.122-2.5-2.5s1.121-2.5,2.5-2.5,2.5,1.57,2.5,3.5-1.57,3.5-3.5,3.5Zm-37,0c0-.551.448-1,1-1h8c.552,0,1,.449,1,1v8c0,.551-.448,1-1,1H5c-.552,0-1-.449-1-1v-8Zm-2,12c0-.551.448-1,1-1h18c.552,0,1,.449,1,1s-.448,1-1,1H3c-.552,0-1-.449-1-1Zm8.5,20c-1.758,0-3.204-1.308-3.449-3h6.899c-.245,1.692-1.691,3-3.449,3Zm22.63-4.999l-30.76.026c-.245-.98-.37-1.999-.37-3.027,0-3.4,1.4-6.653,3.835-9h12.657c1.069,3.389,3.876,6.013,7.392,6.778.331.07.667.104,1.002.104,1.03,0,2.055-.324,2.916-.939,1.089-.78,2.699-1.929,3.952-2.821,1.424-1.024,2.199-2.685,2.073-4.449l-.563-7.291c.661.383,1.418.618,2.236.618h.206l.95,5.212c.287,1.545,1.293,2.881,2.682,3.569.501.255.92.639,1.21.1.296.483.452.1.452.1.578v1.093c-.332-.037-.665-.063-1-.063-4.421,0-8.149,3.226-8.87,7.501Z"
                                id="id_101"></path>
                            <path class="cls-1"
                                d="m42,33c-3.032,0-5.5,2.467-5.5,5.5s2.468,5.5,5.5,5.5,5.5-2.467,5.5-5.5-2.468-5.5-5.5-5.5Zm0,9c-1.93,0-3.5-1.57-3.5-3.5s1.57-3.5,3.5-3.5,3.5,1.57,3.5,3.5-1.57,3.5-3.5,3.5Z"
                                id="id_102"></path>
                            <circle class="cls-1" cx="42" cy="38.5" r="1" id="id_103"></circle>
                            <path class="cls-1"
                                d="m13.778,26.403c-.5-.233-1.096-.017-1.329.483-.233.5-.017,1.096.483,1.329,1.161.542,2.187,1.365,2.967,2.381.778,1.015,1.309,2.219,1.532,3.481.085.485.507.826.983.826.058,0,.116-.005.175-.015.544-.096.907-.615.811-1.159-.278-1.578-.94-3.082-1.915-4.351-.974-1.27-2.256-2.299-3.707-2.976Z"
                                id="id_104"></path>
                        </svg>
                    </div>
                    <div class="call-order-text">
                        <p class="caoit" style="color: #999999;">Call and Order in</p>
                        <h3 class="caoith fw-bold">+1 718-904-4450</h3>
                    </div>
                </span>
                <div class="d-flex align-items-center">
                    <a href="#" class="text-dark me-4"><i class="fas fa-search"></i></a>
                    <a href="#" class="text-dark me-4"><i class="fas fa-user"></i></a>
                    <a href="#" class="text-dark me-4 position-relative">
                        <i class="fas fa-heart"></i>
                        <span
                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill count-icon">
                            0
                        </span>
                    </a>
                    <a href="#" class="text-dark position-relative">
                        <i class="fas fa-shopping-cart"></i>
                        <span
                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill count-icon">
                            0
                        </span>
                    </a>
                </div>
            </div>
        </div>
</nav>

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

            <a class="navbar-brand mx-auto" href="#">
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
                        <a class="nav-link active fw-bold text-white" aria-current="page" href="#">Home</a>
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
                <a href="#" class="text-dark">
                    <i class="fas fa-heart icon-size"></i>
                    <span class="position-absolute badge rounded-pill count-icon" style="top: -10px; right: 0;">0</span>
                </a>
                <h6 class="fw-semibold mb-0">Wishlist</h6>
            </div>
            <div class="text-center icon-item position-relative">
                <a href="#" class="text-dark">
                    <i class="fa-solid fa-basket-shopping icon-size"></i>
                    <span class="position-absolute badge rounded-pill count-icon" style="top: -10px; right: 0;">0</span>
                </a>
                <h6 class="fw-semibold mb-0">Cart</h6>
            </div>
        </div>
    </div>
</nav>

<script>
    $(document).ready(function() {
        $('#logoutButton').on('click', function(event) {
            event.preventDefault(); // Prevent default link action

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
                            window.location.href = 'index.php'; // Redirect after logout
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