$(document).ready(function() {
    // Open cart slider and load cart items
    $(document).on('click', '[data-bs-toggle="offcanvas"]', function() {
        loadCartItems();
    });

    // Add to cart
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
                    $('#cart-count').text(response.cart_count);
                    loadCartItems(); // Reload cart items after adding
                } else {
                    alert(response.message); // Show the specific error message
                }
            }
        });
    });

    // Remove item from cart
    $(document).on('click', '.remove-item', function() {
        let cartItemId = $(this).data('cart-id');
        let $itemElement = $(this).closest('.items');
        
        $itemElement.fadeOut(300); // Start fade out animation
        
        $.ajax({
            url: './php/remove_cart.php',
            method: 'POST',
            data: {
                cart_id: cartItemId
            },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    updateCartCount(); // Update the cart count
                    // After animation completes, update the entire cart
                    setTimeout(() => {
                        loadCartItems();
                    }, 300);
                } else {
                    // If error occurs, show the item again
                    $itemElement.fadeIn(300);
                    alert(response.message || 'Failed to remove item');
                }
            },
            error: function(xhr, status, error) {
                // If AJAX fails, show the item again
                $itemElement.fadeIn(300);
                alert('Failed to remove item. Please try again.');
            }
        });
    });

    // Load cart items
    function loadCartItems() {
        $.ajax({
            url: './php/get_cart_items.php',
            method: 'GET',
            success: function(response) {
                if (response.status === 'success') {
                    let cartHtml = '';
                    let subtotal = 0;
                    response.cart_items.forEach(item => {
                        cartHtml += `
                            <div class="items d-flex align-items-center border-bottom ms-3 me-3 fw-light">
                                <i class="fa-regular fa-circle-xmark remove-item" data-cart-id="${item.cart_item_id}"></i>
                                <img src="admin/${item.images}" class="img-fluid rounded-start" style="width: 80px;">
                                <span class="card-body d-inline ms-3">
                                    <h5 class="card-title mb-1">${item.name}</h5>
                                    <p>${item.quantity} x <span class="hoverText">$${item.price}</span></p>
                                </span>
                            </div>
                        `;
                        subtotal += item.quantity * item.price;
                    });

                    $('#cart-items').html(cartHtml);
                    $('#cart-subtotal').text('$' + subtotal.toFixed(2));
                    $('#empty-message').hide();
                } else {
                    $('#cart-items').html('<p style="text-align: center;">Your cart is empty.</p>');
                    $('#empty-message').show();
                }
            },
            error: function(xhr, status, error) {
                console.error('Internal Server Error');
            }
        });
    }


    // Fetch cart count
    function updateCartCount() {
        $.ajax({
            url: './php/get_cart_count.php',
            method: 'GET',
            success: function(response) {
                if (response.status === 'success') {
                    $('#cart-count').text(response.count);
                }
            }
        });
    }

    updateCartCount(); // Update the cart count on page load
});