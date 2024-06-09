<?php
session_start();
?>
<nav>
    <ul>
        <li><a href="product_list.php">Home</a></li>
        <?php if ($_SESSION['role'] === 'seller'): ?>
            <li><a href="profile.php">Profile</a></li>
        <?php endif; ?>
        <li><a href="cart.php">Cart</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</nav>
