$(document).ready(function() {
    // Function to check if the product is in the favorites (cache)
    function updateFavoriteIcon(productId) {
        if (localStorage.getItem('favorites')) {
            const favorites = JSON.parse(localStorage.getItem('favorites'));
            return favorites.includes(productId);
        }
        return false; // Return false if there are no favorites in cache
    }

    // Initial setup - Apply the active class (red color) to favorite icons based on localStorage
    $('.favorite_icon').each(function() {
        const productId = $(this).data('id');
        if (updateFavoriteIcon(productId)) {
            $(this).addClass('active'); // Add 'active' class to turn icon red
        }
    });

    // Handle click event on favorite icon
    $(document).on('click', '.favorite_icon', function() {
        const productId = $(this).data('id');
        const isActive = $(this).hasClass('active');

        // Toggle active class
        if (isActive) {
            $(this).removeClass('active'); // Remove red color (deactivate)
            // Remove from localStorage (favorites cache)
            let favorites = JSON.parse(localStorage.getItem('favorites')) || [];
            favorites = favorites.filter(id => id !== productId);
            localStorage.setItem('favorites', JSON.stringify(favorites));
        } else {
            $(this).addClass('active'); // Add red color (activate)
            // Add to localStorage (favorites cache)
            let favorites = JSON.parse(localStorage.getItem('favorites')) || [];
            favorites.push(productId);
            localStorage.setItem('favorites', JSON.stringify(favorites));
        }
    });
});