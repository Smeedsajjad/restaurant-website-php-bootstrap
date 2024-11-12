$(document).ready(function () {
  // Function to show loader
  function showLoader() {
    $(".loader-bg").show();
  }

  // Function to hide loader
  function hideLoader() {
    $(".loader-bg").hide();
  }

  // Fetch and set the maximum price for the range slider
  $.ajax({
    url: "php/filterProducts.php",
    type: "POST",
    data: {
      get_max_price: true,
    },
    success: function (response) {
      let data = JSON.parse(response);
      let maxPrice = data.max_price || 1000; // Default to 1000 if no max price is found
      $("#priceRangeSlider").attr("max", maxPrice);
      $("#priceRange").text(`Price: $0 - $${maxPrice}`);
    },
    error: function () {
      alert("Error retrieving maximum price");
    },
  });

  $(".category-link").on("click", function (e) {
    e.preventDefault();
    let categoryId = $(this).data("category-id");

    showLoader(); // Show loader when the category link is clicked

    $.ajax({
      url: "php/filterProducts.php",
      type: "POST",
      data: {
        category_id: categoryId,
      },
      success: function (response) {
        let products = JSON.parse(response);
        let productsContainer = $(".col-md-9 .row:last");

        productsContainer.empty();

        if (products.length > 0) {
          products.forEach(function (product) {
            productsContainer.append(`
                <div class="col-md-4 col-sm-6">
                    <div class="card myCard col-sm mt-3" style="width: 100%; border-radius: 15px;">
                        <div class="card-img-wrapper">
                            <i class="fas fa-heart favorite_icon" style="top: 6px;right: 8px"></i>
                            <a href="index.php?page=product&id=${
                              product.id
                            }" class="text-decoration-none">
                                <img src="admin/${
                                  product.images
                                }" class="card-img-top card-img" alt="${product.name}">
                            </a>
                        </div>
                        <div class="card-body">
                            <p>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </p>
                            <h5 class="card-title myCardText">${
                              product.name
                            }</h5>
                            <p class="card-text" style="color: #999999; font-size: 13px;">
                                ${product.tagline
                                  .split(" ")
                                  .slice(0, 4)
                                  .join(" ")}...
                            </p>
                            <p class="price d-inline fs-3">$${product.price}</p>
                            <button class="btn p-0 position-absolute" style="right: 0;margin: 20px;" id="add-to-cart" data-id="${
                              product.id
                            }">
                                <i class="fa-solid fa-basket-shopping myCart" style="background-color: var(--primary);"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `);
          });
        } else {
          productsContainer.append(
            '<div class="col-md-12 text-center"><h2>No products found in this category</h2></div>'
          );
        }
        hideLoader(); // Hide loader after the search is complete
      },
      error: function () {
        alert("Error retrieving products");
        hideLoader(); // Hide loader in case of error
      },
    });
  });

  // Handle search input
  $(".afs").on("keypress", function (e) {
    if (e.which == 13) {
      // Enter key pressed
      e.preventDefault();
      let searchQuery = $(this).val();

      showLoader(); // Show loader when the search is initiated

      $.ajax({
        url: "php/filterProducts.php",
        type: "POST",
        data: {
          search_query: searchQuery,
        },
        success: function (response) {
          let products = JSON.parse(response);
          let productsContainer = $(".col-md-9 .row:last");

          productsContainer.empty();

          if (products.length > 0) {
            products.forEach(function (product) {
              productsContainer.append(`
                                <div class="col-md-4 col-sm-6">
                                    <div class="card myCard col-sm mt-3" style="width: 100%; border-radius: 15px;">
                                        <div class="card-img-wrapper">
                                            <i class="fas fa-heart favorite_icon" style="top: 6px;right: 8px"></i>
                                            <a href="index.php?page=product&id=${
                                              product.id
                                            }" class="text-decoration-none">
                                                <img src="admin/${
                                                  product.images
                                                }" class="card-img-top card-img" alt="${product.name}">
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <p>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </p>
                                            <h5 class="card-title myCardText">${
                                              product.name
                                            }</h5>
                                            <p class="card-text" style="color: #999999; font-size: 13px;">
                                                ${product.tagline
                                                  .split(" ")
                                                  .slice(0, 4)
                                                  .join(" ")}...
                                            </p>
                                            <p class="price d-inline fs-3">$${
                                              product.price
                                            }</p>
                                            <button class="btn p-0 position-absolute" style="right: 0;margin: 20px;" id="add-to-cart" data-id="${
                                              product.id
                                            }">
                                                <i class="fa-solid fa-basket-shopping myCart" style="background-color: var(--primary);"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            `);
            });
          } else {
            productsContainer.append(
              '<div class="col-md-12 text-center"><h2>No products found</h2></div>'
            );
          }
          hideLoader(); // Hide loader after the search is complete
        },
        error: function () {
          alert("Error retrieving products");
          hideLoader(); // Hide loader in case of error
        },
      });
    }
  });

  // Handle price range filter
  $(".filter_submit_btn").on("click", function (e) {
    e.preventDefault();
    let priceMin = 0; // Set your minimum price
    let priceMax = $("#priceRangeSlider").val();

    showLoader(); // Show loader when the filter is applied

    $.ajax({
      url: "php/filterProducts.php",
      type: "POST",
      data: {
        price_min: priceMin,
        price_max: priceMax,
      },
      success: function (response) {
        let products = JSON.parse(response);
        let productsContainer = $(".col-md-9 .row:last");

        productsContainer.empty();

        if (products.length > 0) {
          products.forEach(function (product) {
            productsContainer.append(`
                    <div class="col-md-4 col-sm-6">
                        <div class="card myCard col-sm mt-3" style="width: 100%; border-radius: 15px;">
                            <div class="card-img-wrapper">
                                <i class="fas fa-heart favorite_icon" style="top: 6px;right: 8px"></i>
                                <a href="index.php?page=product&id=${
                                  product.id
                                }" class="text-decoration-none">
                                    <img src="admin/${
                                      product.images
                                    }" class="card-img-top card-img" alt="${product.name}">
                                </a>
                            </div>
                            <div class="card-body">
                                <p>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </p>
                                <h5 class="card-title myCardText">${
                                  product.name
                                }</h5>
                                <p class="card-text" style="color: #999999; font-size: 13px;">
                                    ${product.tagline
                                      .split(" ")
                                      .slice(0, 4)
                                      .join(" ")}...
                                </p>
                                <p class="price d-inline fs-3">$${
                                  product.price
                                }</p>
                                <button class="btn p-0 position-absolute" style="right: 0;margin: 20px;" id="add-to-cart" data-id="${
                                  product.id
                                }">
                                    <i class="fa-solid fa-basket-shopping myCart" style="background-color: var(--primary);"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                `);
          });
        } else {
          productsContainer.append(
            '<div class="col-md-12 text-center"><h2>No products found in this price range</h2></div>'
          );
        }
        hideLoader(); // Hide loader after the filter is applied
      },
      error: function () {
        alert("Error retrieving products");
        hideLoader(); // Hide loader in case of error
      },
    });
  });
});
