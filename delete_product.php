// delete_product.php
<?php
session_start();
include('config.php');

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'seller') {
    header("Location: index.html");
    exit();
}

$product_id = $_GET['product_id'];

$sql = "DELETE FROM products WHERE id='$product_id' AND seller='{$_SESSION['username']}'";
if ($conn->query($sql) === TRUE) {
    header("Location: profile.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
