<?php
session_start();
include('config.php');

if (!isset($_SESSION['username'])) {
    echo "You must be logged in to remove items from the cart.";
    exit();
}

$product_id = $_POST['product_id'];
$sql = "DELETE FROM cart WHERE id = '$product_id' AND user = '{$_SESSION['username']}'";

if ($conn->query($sql) === TRUE) {
    echo "Product removed from cart.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
