<!-- Offcanvas Cart -->
<div class="offcanvas offcanvas-end " tabindex="-1" id="cartOffcanvas" aria-labelledby="cartOffcanvasLabel">
    <div class="offcanvas-header">
        <h5 id="cartOffcanvasLabel">Your Cart</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <!-- Cart Items Container -->
        <div id="cart-items">
            <!-- Cart items will be populated here dynamically via AJAX -->
        </div>
        <!-- Cart Summary Section -->
        <div class="position-absolute bottom-0 w-100 p-2" style="left: 0px;">
            <hr>
            <p>
                <strong class="text-capitalize">Subtotal:</strong>
                <span id="cart-subtotal">$0.00</span>
            </p>
            <div class="mt-3">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="index.php?page=checkout" class="btn invers_btn d-block">Checkout</a>
                <?php else: ?>
                    <a href="index.php?page=login" class="btn invers_btn d-block">Login to Checkout</a>
                <?php endif; ?>
                <a href="index.php?page=cart" class="btn outline_btn d-block mb-3 mt-3">View Cart</a>
            </div>
        </div>
    </div>
</div>