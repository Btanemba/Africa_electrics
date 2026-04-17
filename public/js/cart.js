// Cart functionality
document.addEventListener('DOMContentLoaded', function() {
    const forms = document.querySelectorAll('.quantity-form, form');

    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            // Optional: Add loading state or validation here
            // For now, just let form submit normally
        });
    });

    // Quantity input validation
    const quantityInputs = document.querySelectorAll('.quantity-form input, .card-quantity-form input');
    quantityInputs.forEach(input => {
        input.addEventListener('change', function() {
            if (this.value < 1) this.value = 1;
            if (this.value > 999) this.value = 999;
        });
    });
});
