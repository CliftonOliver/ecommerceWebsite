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
    <title>Profile</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include('navbar.php'); ?>
    <h2>Your Profile</h2>
    <form action="update_profile.php" method="post">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $_SESSION['email']; ?>" required>
        <br>
        <label for="password">New Password:</label>
        <input type="password" id="password" name="password">
        <br>
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password">
        <br>
        <input type="submit" value="Update Profile">
    </form>
    <?php if ($role === 'seller'): ?>
        <h2>Your Products</h2>
        <div id="seller-products">
            <!-- Seller products will be populated here -->
        </div>
        <script>
            function loadSellerProducts() {
                const xhr = new XMLHttpRequest();
                xhr.open('GET', 'load_seller_products.php', true);
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        document.getElementById('seller-products').innerHTML = xhr.responseText;
                    }
                };
                xhr.send();
            }
            loadSellerProducts();
        </script>
    <?php endif; ?>
</body>
</html>
