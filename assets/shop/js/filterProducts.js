$(document).ready(function() {
    $('.category-link').on('click', function(e) {
        e.preventDefault();
        let categoryId = $(this).data('category-id');

        $.ajax({
            url: 'php/filterProducts.php',
            type: 'POST',
            data: {
                category_id: categoryId
            },
            success: function(response) {
                let products = JSON.parse(response);
                let productsContainer = $('.col-md-9 .row:last');

                productsContainer.empty();

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
                } else {
                    productsContainer.append('<div class="col-md-12 text-center"><h2>No products found in this category</h2></div>');
                }
            },
            error: function() {
                alert('Error retrieving products');
            }
        });
    });

});