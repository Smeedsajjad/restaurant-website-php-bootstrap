document.addEventListener('DOMContentLoaded', function () {
    const descriptionButton = document.getElementById('btn-description');
    const reviewsButton = document.getElementById('btn-reviews');
    const descriptionSection = document.getElementById('description-section');
    const reviewsSection = document.getElementById('reviews-section');

    // Show description section and hide reviews section
    descriptionButton.addEventListener('click', function () {
        descriptionSection.style.display = 'block';
        reviewsSection.style.display = 'none';
    });

    // Show reviews section and hide description section
    reviewsButton.addEventListener('click', function () {
        descriptionSection.style.display = 'none';
        reviewsSection.style.display = 'block';
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const stars = document.querySelectorAll('#star-rating .fa-star');
    const ratingValueInput = document.getElementById('rating-value');
    const ratingError = document.getElementById('rating-error');

    stars.forEach(star => {
        star.addEventListener('click', function () {
            const ratingValue = this.getAttribute('data-value');

            // Remove 'selected' class from all stars
            stars.forEach(s => s.classList.remove('selected'));

            // Add 'selected' class to the clicked star and all previous stars
            for (let i = 0; i < ratingValue; i++) {
                stars[i].classList.add('selected');
            }

            // Set the value of the hidden input to the selected rating
            ratingValueInput.value = ratingValue;

            // Hide error message
            ratingError.style.display = 'none';
        });

        star.addEventListener('mouseover', function () {
            const ratingValue = this.getAttribute('data-value');

            // Highlight stars on hover
            stars.forEach((s, index) => {
                s.classList.toggle('selected', index < ratingValue);
            });
        });

        star.addEventListener('mouseout', function () {
            // Reset stars to the current rating
            const currentRating = ratingValueInput.value; // Get the current rating from the hidden input
            stars.forEach((s, index) => {
                s.classList.toggle('selected', index < currentRating);
            });
        });
    });

    // Form submission validation
    const form = document.querySelector('form'); // Adjust the selector to your form
    form.addEventListener('submit', function (event) {
        if (ratingValueInput.value === '0') { // Check if no rating is selected
            event.preventDefault(); // Prevent form submission
            ratingError.style.display = 'block'; // Show error message
        }
    });
});

/* Created by Rohan Hapani */
$(document).ready(function () {
    var sub_width = 0;
    var sub_height = 0;
    $(".large").css("background", "url('" + $(".small").attr("src") + "') no-repeat");

    $(".zoom-area").mousemove(function (e) {
        if (!sub_width && !sub_height) {
            var image_object = new Image();
            image_object.src = $(".small").attr("src");
            sub_width = image_object.width;
            sub_height = image_object.height;
        }
        else {
            var magnify_position = $(this).offset();

            var mx = e.pageX - magnify_position.left;
            var my = e.pageY - magnify_position.top;

            if (mx < $(this).width() && my < $(this).height() && mx > 0 && my > 0) {
                $(".large").fadeIn(100);
            }
            else {
                $(".large").fadeOut(100);
            }
            if ($(".large").is(":visible")) {
                var rx = Math.round(mx / $(".small").width() * sub_width - $(".large").width() / 2) * -1;
                var ry = Math.round(my / $(".small").height() * sub_height - $(".large").height() / 2) * -1;

                var bgp = rx + "px " + ry + "px";

                var px = mx - $(".large").width() / 2;
                var py = my - $(".large").height() / 2;

                $(".large").css({ left: px, top: py, backgroundPosition: bgp });
            }
        }
    })

    // Update quantity on button click
    $("#increase-quantity").click(function () {
        var quantity = parseInt($("#quantity").val());
        $("#quantity").val(quantity + 1);
    });

    $("#decrease-quantity").click(function () {
        var quantity = parseInt($("#quantity").val());
        if (quantity > 1) {
            $("#quantity").val(quantity - 1);
        }
    });
})