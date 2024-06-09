<?php
session_start();
include('config.php');

if (!isset($_SESSION['username'])) {
    header("Location: index.html");
    exit();
}

$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include('navbar.php'); ?>
    <h2>Your Cart</h2>
    <div id="cart-items">
        <!-- Cart items will be populated here -->
    </div>
    <button onclick="checkout()">Checkout</button>
    <script>
        function loadCart() {
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'load_cart.php', true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    document.getElementById('cart-items').innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        }
        function checkout() {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'checkout.php', true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    alert('Checkout successful');
                    loadCart();
                }
            };
            xhr.send();
        }
        loadCart();
    </script>
    <div id="cart-items"></div>

</body>
</html>
