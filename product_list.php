<?php
session_start();
include('config.php');

if (!isset($_SESSION['username'])) {
    header("Location: index.html");
    exit();
}

$username = $_SESSION['username'];
$role = $_SESSION['role'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Listing</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include('navbar.php'); ?>
    <h2>Product Listing</h2>
    <?php if ($role === 'seller'): ?>
        <button onclick="window.location.href='add_product.php'">Add Product</button>
    <?php endif; ?>
    <input type="text" id="search" placeholder="Search products..." onkeyup="searchProducts()">
    <div id="product-list">
        <!-- Product items will be populated here -->
    </div>
    <script>
        function searchProducts() {
            const query = document.getElementById('search').value;
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'search_products.php?q=' + query, true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    document.getElementById('product-list').innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        }
        searchProducts();
    </script>
</body>
</html>
