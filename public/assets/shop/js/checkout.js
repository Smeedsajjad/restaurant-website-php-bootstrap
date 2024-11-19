document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('checkout-form');
    const submitButton = form.querySelector('button[type="submit"]');

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        // Disable submit button to prevent double submission
        submitButton.disabled = true;
        submitButton.innerHTML = 'Processing...';

        // Get the selected country value
        const countryInput = document.getElementById('countrySearch');
        const formData = new FormData(form);
        formData.append('country', countryInput.value);

        // Send AJAX request
        fetch('./php/checkout.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            // Create response container if it doesn't exist
            let responseDiv = document.getElementById('checkout-response');
            if (!responseDiv) {
                responseDiv = document.createElement('div');
                responseDiv.id = 'checkout-response';
                form.insertBefore(responseDiv, form.firstChild);
            }

            // Show response message
            if (data.includes('successfully')) {
                responseDiv.className = 'alert alert-success';
                form.reset();
                // Redirect to success page or show success message
                setTimeout(() => {
                    window.location.href = 'order-confirmation.php';
                }, 2000);
            } else {
                responseDiv.className = 'alert alert-danger';
            }
            responseDiv.textContent = data;
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while processing your order. Please try again.');
        })
        .finally(() => {
            // Re-enable submit button
            submitButton.disabled = false;
            submitButton.innerHTML = 'Place order';
        });
    });
});
