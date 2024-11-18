$(document).ready(function() {
    // Loader visibility functions
    function showLoader() {
        $('.loader-bg').show();
    }

    function hideLoader() {
        $('.loader-bg').hide();
    }

    // Function to update products display and results count
    function updateProductsDisplay(products, offset, append = false) {
        let productsContainer = $('.col-md-9 .row:last');

        if (!append) {
            productsContainer.empty(); // Clear container only if not appending
        }

        if (products.length > 0) {
            products.forEach(function(product) {
                productsContainer.append(`
                <div class="col-md-4 col-sm-6">
                    <div class="card myCard col-sm mt-3" style="width: 100%; border-radius: 15px;">
                        <div class="card-img-wrapper">
                            <i class="fas fa-heart favorite_icon" style="top: 6px;right: 8px"></i>
                            <a href="index.php?page=product&id=${product.id}" class="text-decoration-none">
                                <img src="admin/${product.images}" class="card-img-top card-img" alt="${product.name}">
                            </a>
                        </div>
                        <div class="card-body">
                            <p>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </p>
                            <h5 class="card-title myCardText">${product.name}</h5>
                            <p class="card-text" style="color: #999999; font-size: 13px;">
                                ${product.tagline.split(' ').slice(0, 4).join(' ')}...
                            </p>
                            <p class="price d-inline fs-3">$${product.price}</p>
                            <button class="btn p-0 position-absolute" style="right: 0;margin: 20px;" id="add-to-cart" data-id="${product.id}">
                                <i class="fa-solid fa-basket-shopping myCart" style="background-color: var(--primary);"></i>
                            </button>
                        </div>
                    </div>
                </div>
            `);
            });
            $('#results-count').text(`Showing ${offset + 1}-${offset + products.length} Results`);
        } else {
            productsContainer.append('<div class="col-md-12 text-center"><h2>No more products available</h2></div>');
            $('#results-count').text('Showing 0 of 0 Results');
        }
    }

    let currentPage = 1;
    let totalProducts = 0; // Define totalProducts globally
    const limit = 6; // Number of products per page

    function updatePagination(totalProducts) {
        const totalPages = Math.ceil(totalProducts / limit); // Calculate total pages
        const paginationContainer = $('.pagination');

        // Clear existing page links (except Previous and Next buttons)
        paginationContainer.find('.page-item:not(:first-child):not(:last-child)').remove();

        // Generate page links based on total pages
        for (let i = 1; i <= totalPages; i++) {
            const pageItem = $('<li class="page-item"></li>');
            const pageLink = $(`<a class="page-link" href="#">${i}</a>`);

            // Add active class to the current page
            if (i === currentPage) {
                pageItem.addClass('active');
            }

            // Click event for page link to load selected page
            pageLink.on('click', function(e) {
                e.preventDefault();
                currentPage = i; // Update current page
                loadProducts(currentPage); // Load products for the selected page
                updatePagination(totalProducts); // Refresh pagination
            });

            pageItem.append(pageLink);
            paginationContainer.find('#next-page').parent().before(pageItem); // Insert before Next button
        }

        // Update page info
        $('#page-info').text(`Page ${currentPage} of ${totalPages}`);

        // Enable or disable Previous and Next buttons based on the current page
        $('#prev-page').prop('disabled', currentPage === 1);
        $('#next-page').prop('disabled', currentPage === totalPages);
    }

    function loadProducts(page) {
        const offset = (page - 1) * limit; // Calculate offset for the current page

        $.ajax({
            url: 'php/load_more_products.php',
            type: 'POST',
            data: {
                offset: offset,
                limit: limit
            },
            beforeSend: showLoader,
            success: function(response) {
                try {
                    const data = JSON.parse(response);
                    const products = data.products;
                    totalProducts = data.total; // Update total products globally
                    updateProductsDisplay(products, offset); // Display products
                    updatePagination(totalProducts); // Refresh pagination
                    $('#page-info').text(`Page ${page}`);
                } catch (e) {
                    console.error('Error parsing JSON:', e, response);
                    alert('Error loading products');
                }
            },
            complete: hideLoader,
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('AJAX error:', textStatus, errorThrown);
                alert('Failed to load products');
            }
        });
    }

    // Initial load for the first page
    loadProducts(currentPage);

    // Event listeners for Previous and Next buttons
    $('#prev-page').on('click', function(e) {
        e.preventDefault();
        if (currentPage > 1) {
            currentPage--;
            loadProducts(currentPage);
        }
    });

    $('#next-page').on('click', function(e) {
        e.preventDefault();
        if (currentPage < Math.ceil(totalProducts / limit)) {
            currentPage++;
            loadProducts(currentPage);
        }
    });

    // Fetch and set the maximum price for the range slider
    $.ajax({
        url: 'php/filterProducts.php',
        type: 'POST',
        data: {
            get_max_price: true
        },
        success: function(response) {
            let data = JSON.parse(response);
            let maxPrice = data.max_price || 1000; // Default to 1000 if no max price is found
            $('#priceRangeSlider').attr('max', maxPrice);
            $('#priceRange').text(`Price: $0 - $${maxPrice}`);
        },
        error: function() {
            alert('Error retrieving maximum price');
        }
    });

    // Handle category filter
    $('.category-link').on('click', function(e) {
        e.preventDefault();
        let categoryId = $(this).data('category-id');

        showLoader(); // Show loader when the category link is clicked

        $.ajax({
            url: 'php/filterProducts.php',
            type: 'POST',
            data: {
                category_id: categoryId
            },
            success: function(response) {
                let products = JSON.parse(response);
                updateProductsDisplay(products, 0); // Reset offset for category filter
                hideLoader(); // Hide loader after the search is complete
            },
            error: function() {
                alert('Error retrieving products');
                hideLoader(); // Hide loader in case of error
            }
        });
    });

    // Handle search input
    $('.afs').on('keypress', function(e) {
        if (e.which == 13) { // Enter key pressed
            e.preventDefault();
            let searchQuery = $(this).val();

            showLoader(); // Show loader when the search is initiated

            $.ajax({
                url: 'php/filterProducts.php',
                type: 'POST',
                data: {
                    search_query: searchQuery
                },
                success: function(response) {
                    let products = JSON.parse(response);
                    updateProductsDisplay(products, 0); // Reset offset for search
                    hideLoader(); // Hide loader after the search is complete
                },
                error: function() {
                    alert('Error retrieving products');
                    hideLoader(); // Hide loader in case of error
                }
            });
        }
    });

    // Handle price range filter
    $('.filter_submit_btn').on('click', function(e) {
        e.preventDefault();
        let priceMin = 0; // Set your minimum price
        let priceMax = $('#priceRangeSlider').val();

        showLoader(); // Show loader when the filter is applied

        $.ajax({
            url: 'php/filterProducts.php',
            type: 'POST',
            data: {
                price_min: priceMin,
                price_max: priceMax
            },
            success: function(response) {
                let products = JSON.parse(response);
                updateProductsDisplay(products, 0); // Reset offset for price filter
                hideLoader(); // Hide loader after the filter is applied
            },
            error: function() {
                alert('Error retrieving products');
                hideLoader(); // Hide loader in case of error
            }
        });
    });
});