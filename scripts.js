document.addEventListener('DOMContentLoaded', function () {
    // Add to cart function
    const addToCartButtons = document.querySelectorAll('.add-to-cart');
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function () {
            const productId = this.dataset.productId;
            addToCart(productId);
        });
    });

    // Function to add product to cart
    function addToCart(productId) {
        fetch('add_to_cart.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `product_id=${productId}`
        })
        .then(response => response.text())
        .then(data => {
            alert(data); // Display success or error message
            loadCart(); // Reload cart to reflect changes
        })
        .catch(error => console.error('Error:', error));
    }

    // Function to remove product from cart
    window.removeFromCart = function (productId) {
        fetch('remove_from_cart.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `product_id=${productId}`
        })
        .then(response => response.text())
        .then(data => {
            alert(data); // Display success or error message
            loadCart(); // Reload cart to reflect changes
        })
        .catch(error => console.error('Error:', error));
    };

    // Load cart items
    function loadCart() {
        fetch('load_cart.php')
        .then(response => response.text())
        .then(data => {
            document.getElementById('cart-items').innerHTML = data;
        })
        .catch(error => console.error('Error:', error));
    }

    // Initial load of cart items
    if (document.getElementById('cart-items')) {
        loadCart();
    }
});
