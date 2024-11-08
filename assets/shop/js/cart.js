$(document).ready(function () {
  let successMessageShown = false;

  // Enable/disable button based on quantity changes
  $(".quantity-input").on("input", function () {
    const originalQuantity = parseInt($(this).data("original-quantity"));
    const currentQuantity = parseInt($(this).val());
    $("#update-cart-button").prop(
      "disabled",
      currentQuantity === originalQuantity
    );
  });

  // Handle form submission for updating cart
  $(".cart-form").on("submit", function (e) {
    e.preventDefault();
    const cartData = $(this).serialize();

    $.ajax({
      url: "php/update_cart.php",
      type: "POST",
      data: cartData,
      success: function (response) {
        const result = JSON.parse(response);
        if (result.status === "success" && !successMessageShown) {
          $("#success-message").show().delay(3000).fadeOut();
          successMessageShown = true;
          location.reload(); // Reload the page to update cart items
        } else if (result.status === "error") {
          $("#error-message").show().delay(3000).fadeOut();
          successMessageShown = false;
        }
      },
      error: function () {
        $("#error-message").show().delay(3000).fadeOut();
        successMessageShown = false;
      },
    });
  });

  // Handle delete item click
  $(".delete-item").on("click", function (e) {
    e.preventDefault();
    const cartId = $(this).data("cart-id");

    $.ajax({
      url: "php/remove_cart.php",
      type: "POST",
      data: {
        cart_id: cartId,
      },
      success: function (response) {
        const result = JSON.parse(response);
        if (result.status === "success") {
          location.reload(); // Reload the page to update cart items
        } else {
          $("#error-message").text(result.message).show().delay(3000).fadeOut();
        }
      },
      error: function () {
        $("#error-message").show().delay(3000).fadeOut();
      },
    });
  });
});
