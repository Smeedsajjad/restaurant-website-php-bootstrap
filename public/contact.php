<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap -->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.4.2/css/all.css">
    <!-- Font Awesome 5 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <!-- font-family: "Norican", cursive; -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Norican&display=swap" rel="stylesheet">
    <!-- swiper -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <!-- Map-->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <!-- custom css -->
    <link rel="stylesheet" href="assets/shop/css/style.css">
    <link rel="stylesheet" href="assets/shop/css/animation.css">
    <link rel="stylesheet" href="assets/shop/css/navbar.css">
    <title>Contact Us</title>
    <style>
        .leaflet-bottom.leaflet-right {
            display: none;
        }
    </style>
</head>

<body>

    <!-- header -->
    <?php include  './includes/header.php'; ?>
    <!-- navbar -->
    <?php include  './includes/nav.php'; ?>
    <!-- Cart Slider -->
    <?php include  './includes/cartSlider.php'; ?>
    <!-- main section -->
    <main>
        <!-- Hero section -->
        <section class="op_hero_section"
            style="margin-bottom: 15vh;background-image: url(./assets/shop/images/breadcrumb1.jpg);">
            <div class="container-fluid">
                <h1 class="opht d-flex justify-content-center text-center">Contact</h1>
                <div>
                    <nav class="d-flex justify-content-center test-center"
                        style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
                        aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php?page=home" class="text-muted">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="index.php?page=contact"
                                    class="text-dark">Contact Us</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </section>

        <div class="container mt-5">
            <div class="row mt-5 mb-5">
                <h1 class="fw-bold ">Call us or visit place</h1>
                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
            <div class="contact-container">
                <div class="col-md-4 contact-info">
                    <svg height="70px" width="70px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64">
                        <g id="Layer_2" data-name="Layer 2">
                            <path d="M23.21,28.53A32.51,32.51,0,0,0,28,35.26a27.67,27.67,0,0,0,7.61,5.62.81.81,0,0,0,.66,0,2.78,2.78,0,0,0,.92-.66,11.08,11.08,0,0,0,.83-1c1.23-1.61,2.74-3.6,4.88-2.6l.13.06,7.13,4.1.06,0a3.23,3.23,0,0,1,1.34,2.78,7.49,7.49,0,0,1-1,3.53,7.22,7.22,0,0,1-3.43,3,15.36,15.36,0,0,1-4.23,1.15,14.42,14.42,0,0,1-6.46-.53,28.82,28.82,0,0,1-6.49-3.14l-.17-.11c-1.06-.66-2.2-1.36-3.32-2.19a41.65,41.65,0,0,1-11-12.47c-2.27-4.12-3.52-8.57-2.84-12.82a9.2,9.2,0,0,1,3.12-5.83,8.28,8.28,0,0,1,6.2-1.66.91.91,0,0,1,.72.46l4.57,7.73a2.41,2.41,0,0,1,.38,2.59,5,5,0,0,1-1.75,2c-.24.21-.53.42-.84.64-1,.74-2.19,1.6-1.79,2.61v0Z"></path>
                        </g>
                    </svg>
                    <h4 class="fw-bold">Phone:</h4>
                    <p class="text-muted mt-2">+ 44 123 456 78 90 <br> + 844 123 444 77 88</p>
                </div>
                <div class="col-md-4 contact-info">
                    <svg width="50px" height="50px" viewBox="0 0 14 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="Rounded" transform="translate(-377.000000, -1306.000000)">
                                <g id="Communication" transform="translate(100.000000, 1162.000000)">
                                    <g id="-Round-/-Communication-/-location_on" transform="translate(272.000000, 142.000000)">
                                        <g>
                                            <polygon id="Path" points="0 0 24 0 24 24 0 24"></polygon>
                                            <path d="M12,2 C8.13,2 5,5.13 5,9 C5,13.17 9.42,18.92 11.24,21.11 C11.64,21.59 12.37,21.59 12.77,21.11 C14.58,18.92 19,13.17 19,9 C19,5.13 15.87,2 12,2 Z M12,11.5 C10.62,11.5 9.5,10.38 9.5,9 C9.5,7.62 10.62,6.5 12,6.5 C13.38,6.5 14.5,7.62 14.5,9 C14.5,10.38 13.38,11.5 12,11.5 Z" id="🔹Icon-Color" fill="#eeac00"></path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </svg>

                    <h4 class="fw-bold" style="margin-top: 13px;">Address:</h4>
                    <p class="text-muted mt-2">Box 565, Pinney's Beach, Charlestown,<br> Nevis, West Indies, Caribbean</p>
                </div>
                <div class="col-md-4 contact-info">

                    <svg width="50px" height="50px" viewBox="0 0 20 16" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="Rounded" transform="translate(-782.000000, -1220.000000)">
                                <g id="Communication" transform="translate(100.000000, 1162.000000)">
                                    <g id="-Round-/-Communication-/-email" transform="translate(680.000000, 54.000000)">
                                        <g transform="translate(0.000000, 0.000000)">
                                            <polygon id="Path" points="0 0 24 0 24 24 0 24"></polygon>
                                            <path d="M20,4 L4,4 C2.9,4 2.01,4.9 2.01,6 L2,18 C2,19.1 2.9,20 4,20 L20,20 C21.1,20 22,19.1 22,18 L22,6 C22,4.9 21.1,4 20,4 Z M19.6,8.25 L12.53,12.67 C12.21,12.87 11.79,12.87 11.47,12.67 L4.4,8.25 C4.15,8.09 4,7.82 4,7.53 C4,6.86 4.73,6.46 5.3,6.81 L12,11 L18.7,6.81 C19.27,6.46 20,6.86 20,7.53 C20,7.82 19.85,8.09 19.6,8.25 Z" id="🔹Icon-Color" fill="#eeac00"></path>
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </svg>

                    <h4 class="fw-bold" style="margin-top: 11px;">Email:</h4>
                    <p class="text-muted mt-2">contact@example.com<br> info@example.com</p>
                </div>
            </div>
        </div>


        <div class="container">
            <div class="row border border-2 rounded">
                <div class="col-md-6 p-0">
                    <div id="map" style="height: 100%; width: 100%;"></div>
                </div>
                <div class="col-md-6 p-5">
                    <h3 class="fw-bold mb-2">Contact Us</h3>
                    <small class="text-muted mb-5"><span class="text-danger">Note:</span> Reply will be received at your email.</small>
                    <form id="contactForm" method="POST" novalidate>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                            <div class="invalid-feedback">Please enter your name.</div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                            <div class="invalid-feedback">Please enter a valid email address.</div>
                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" class="form-control" id="subject" name="subject" required>
                            <div class="invalid-feedback">Please enter a subject.</div>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                            <div class="invalid-feedback">Please enter your message.</div>
                        </div>
                        <button type="submit" class="btn btn-warning text-dark">Send Message</button>
                    </form>
                </div>
            </div>
        </div>


        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header text-bg-success">
                    <strong class="me-auto">Contact Form</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body text-bg-success">
                    Toast body text.
                </div>
            </div>
        </div>

    </main>
    <!-- footer section -->
    <?php include './includes/footer.php' ?>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            let successMessageShown = false;

            // Enable/disable button based on quantity changes
            $('.quantity-input').on('input', function() {
                const originalQuantity = parseInt($(this).data('original-quantity'));
                const currentQuantity = parseInt($(this).val());
                $('#update-cart-button').prop('disabled', currentQuantity === originalQuantity);
            });

            // Handle form submission for updating cart
            $('.cart-form').on('submit', function(e) {
                e.preventDefault();
                const cartData = $(this).serialize();

                $.ajax({
                    url: 'php/update_cart.php',
                    type: 'POST',
                    data: cartData,
                    success: function(response) {
                        const result = JSON.parse(response);
                        if (result.status === 'success' && !successMessageShown) {
                            $('#success-message').show().delay(6000).fadeOut();
                            successMessageShown = true;
                            location.reload(); // Reload the page to update cart items
                        } else if (result.status === 'error') {
                            $('#error-message').show().delay(6000).fadeOut();
                            successMessageShown = false;
                        }
                    },
                    error: function() {
                        $('#error-message').show().delay(6000).fadeOut();
                        successMessageShown = false;
                    }
                });
            });

            // Handle delete item click
            $('.delete-item').on('click', function(e) {
                e.preventDefault();
                const cartId = $(this).data('cart-id');

                $.ajax({
                    url: 'php/remove_cart.php',
                    type: 'POST',
                    data: {
                        cart_id: cartId
                    },
                    success: function(response) {
                        const result = JSON.parse(response);
                        if (result.status === 'success') {
                            location.reload(); // Reload the page to update cart items
                        } else {
                            $('#error-message').text(result.message).show().delay(6000).fadeOut();
                        }
                    },
                    error: function() {
                        $('#error-message').show().delay(6000).fadeOut();
                    }
                });

            });
        });


        $(document).ready(function() {
            // Use event delegation for dynamically generated elements
            $(document).on('click', '#add-to-cart', function() {
                let productId = $(this).data('id');

                // Check if user is logged in
                if (!<?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>) {
                    alert('You are not logged in. Please log in to add items to your cart.');
                    return; // Exit the function if not logged in
                }

                $.ajax({
                    url: './php/add_to_cart.php',

                    method: 'POST',

                    data: {
                        product_id: productId,
                        quantity: 1

                    },
                    success: function(response) {

                        if (response.status === 'success') {

                            $('.cart-count').text(response.cart_count); // Update both cart counts

                        } else {

                            alert(response.message); // Show the specific error message
                        }

                    }
                });

            });


            function updateCartCount() {
                $.ajax({
                    url: './php/get_cart_count.php',

                    method: 'GET',
                    success: function(response) {
                        if (response.status === 'success') {
                            $('.cart-count').text(response.count); // Update both cart counts
                        }
                    }
                });
            }

            updateCartCount();

        });

        document.addEventListener("DOMContentLoaded", () => {
            const animatedElements = document.querySelectorAll(".animate");

            const observer = new IntersectionObserver(
                (entries) => {
                    entries.forEach((entry) => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add("active");
                        }
                    });
                }, {
                    threshold: 0.1
                } // Trigger when 10% of the element is visible
            );

            animatedElements.forEach((el) => observer.observe(el));
        });
    </script>
    <script>
        // Set the map to Islamabad, Pakistan
        const map = L.map("map").setView([40.7128, -74.0060], 10); // Islamabad coordinates
        // const map = L.map("map").setView([33.6844, 73.0479], 13); // Islamabad coordinates

        // Add OpenStreetMap tiles
        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png").addTo(map);

        // Add a marker for Islamabad
        L.marker([40.7128, -74.0060]) // Islamabad coordinates
        // L.marker([33.6844, 73.0479]) // Islamabad coordinates
            .addTo(map)
            // .bindPopup("Welcome to Islamabad, Pakistan!")
            .openPopup();
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('contactForm');
            const toastElement = document.querySelector('.toast');
            const toastBody = document.querySelector('.toast-body');
            const toast = new bootstrap.Toast(toastElement);

            form.addEventListener('submit', function(event) {
                event.preventDefault();
                event.stopPropagation();

                if (form.checkValidity()) {
                    const formData = new FormData(form);

                    fetch('php/process_contact.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => {
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            toastBody.textContent = 'Message sent successfully!';
                            toastElement.classList.replace('text-bg-success', 'text-bg-success');
                        } else {
                            toastBody.textContent = 'Failed to send message. Please try again.';
                            toastElement.classList.replace('text-bg-success', 'text-bg-danger');
                        }
                        toast.show();
                    })
                    .catch(error => {
                        toastBody.textContent = 'An error occurred. Please try again later.';
                        toastElement.classList.replace('text-bg-danger', 'text-bg-danger');
                        toast.show();
                    });
                } else {
                    form.classList.add('was-validated');
                }
            }, false);
        });
    </script>
    <script>
        // Example of Bootstrap form validation
        (function() {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission if invalid
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>