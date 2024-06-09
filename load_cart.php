// load_cart.php
<?php
session_start();
include('config.php');

$username = $_SESSION['username'];

$sql = "SELECT * FROM cart WHERE user='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div>";
        echo "<p>{$row['product_name']} - \${$row['price']}</p>";
        echo "<button onclick=\"removeFromCart({$row['id']})\">Remove</button>";
        echo "</div>";
    }
} else {
    echo "Your cart is empty.";
}

$conn->close();
?>
