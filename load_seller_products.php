// load_seller_products.php
<?php
session_start();
include('config.php');

$seller = $_SESSION['username'];

$sql = "SELECT * FROM products WHERE seller='$seller'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div>";
        echo "<p>{$row['product_name']} - \${$row['price']}</p>";
        echo "<button onclick=\"window.location.href='edit_product.php?product_id={$row['id']}'\">Edit</button>";
        echo "<button onclick=\"window.location.href='delete_product.php?product_id={$row['id']}'\">Delete</button>";
        echo "</div>";
    }
} else {
    echo "You have no products.";
}

$conn->close();
?>
