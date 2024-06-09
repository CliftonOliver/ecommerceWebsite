<?php
session_start();
include('config.php');

if (!isset($_SESSION['username'])) {
    echo "You must be logged in to add items to the cart.";
    exit();
}

$product_id = $_POST['product_id'];
$sql = "SELECT * FROM products WHERE id = '$product_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $product = $result->fetch_assoc();
    $username = $_SESSION['username'];
    $product_name = $product['product_name'];
    $price = $product['price'];

    $sql = "INSERT INTO cart (user, product_name, price) VALUES ('$username', '$product_name', '$price')";
    if ($conn->query($sql) === TRUE) {
        echo "Product added to cart.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Product not found.";
}

$conn->close();
?>
