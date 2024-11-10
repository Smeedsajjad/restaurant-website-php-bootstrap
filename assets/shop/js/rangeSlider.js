const priceRangeSlider = document.getElementById("priceRangeSlider");
const priceRange = document.getElementById("priceRange");

const totalMinPrice = 0; // Minimum price in dollars
const totalMaxPrice = 20; // Maximum price in dollars

function updatePriceRange() {
    const sliderValue = priceRangeSlider.value; // 0 to 100
    const minPrice = Math.round((totalMaxPrice - totalMinPrice) * (sliderValue / 100));
    const maxPrice = totalMaxPrice - minPrice;

    // Display the range
    priceRange.textContent = `Price: $${minPrice} - $${maxPrice}`;
}

// Update the range display on input change
priceRangeSlider.addEventListener("input", updatePriceRange);

// Initialize display
updatePriceRange();