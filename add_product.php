// add_product.php
<?php
session_start();
include('config.php');

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'seller') {
    header("Location: index.html");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $sql = "INSERT INTO products (seller, product_name, price, description) VALUES ('{$_SESSION['username']}', '$product_name', '$price', '$description')";
    if ($conn->query($sql) === TRUE) {
        header("Location: profile.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Add Product</h2>
    <form action="add_product.php" method="post">
        <label for="product_name">Product Name:</label>
        <input type="text" id="product_name" name="product_name" required>
        <br>
        <label for="price">Price:</label>
        <input type="number" step="0.01" id="price" name="price" required>
        <br>
        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>
        <br>
        <input type="submit" value="Add Product">
    </form>
</body>
</html>
