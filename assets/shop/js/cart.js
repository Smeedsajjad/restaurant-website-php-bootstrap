$(document).ready(function() {
  $('#add-to-cart').on('click', function() {
      let productId = $(this).data('id');
      let quantity = $('#quantity').val();

      $('#success-message').hide();
      $('#error-message').hide();
      $('.loader-bg').show(); // Show loader

      $.ajax({
          url: './php/add_to_cart.php',
          method: 'POST',
          data: {
              product_id: productId,
              quantity: quantity
          },
          success: function(response) {
              try {
                  if (typeof response === 'string') {
                      response = JSON.parse(response); // Parse if JSON string
                  }

                  if (response.status === 'success') {
                      $('#success-message p').text('Product has been added successfully');
                      // $('#success-message p').text(response.product_name + ' has been added successfully');
                      $('#success-message').fadeIn();
                      $('.count-icon').text(response.cart_count); // Update cart count
                  } else {
                      $('#error-message p').text(response.message || 'An error occurred');
                      $('#error-message').fadeIn();
                  }
              } catch (error) {
                  console.error("Parsing error:", error);
                  $('#error-message p').text('Unexpected response format');
                  $('#error-message').fadeIn();
              }
          },
          error: function(xhr, status, error) {
              console.error('AJAX error:', status, error);
              $('#error-message p').text('Failed to add product to cart');
              $('#error-message').fadeIn();
          },
          complete: function() {
              setTimeout(() => {
                  $('.loader-bg').fadeOut(); // Smoothly hide loader
              }, 500); // Optional delay
          }
      });
  });

  // Function to fetch and update cart count
  function updateCartCount() {
      $.ajax({
          url: './php/get_cart_count.php',
          method: 'GET',
          success: function(response) {
              try {
                  if (typeof response === 'string') {
                      response = JSON.parse(response);
                  }
                  if (response.status === 'success') {
                      $('#cart-count').text(response.count); // Update cart count badge
                      $('#cart-count-sm').text(response.count); // Update cart count badge
                  } else {
                      console.error('Error in response:', response.message);
                  }
              } catch (error) {
                  console.error("Parsing error:", error);
              }
          },
          error: function(xhr, status, error) {
              console.error('Failed to fetch cart count:', status, error);
          }
      });
  }

  // Initial cart count update on page load
  updateCartCount();
});