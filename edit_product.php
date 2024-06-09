// edit_product.php
<?php
session_start();
include('config.php');

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'seller') {
    header("Location: index.html");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $sql = "UPDATE products SET product_name='$product_name', price='$price', description='$description' WHERE id='$product_id' AND seller='{$_SESSION['username']}'";
    if ($conn->query($sql) === TRUE) {
        header("Location: profile.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} else {
    $product_id = $_GET['product_id'];
    $sql = "SELECT * FROM products WHERE id='$product_id' AND seller='{$_SESSION['username']}'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        echo "Product not found.";
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Edit Product</h2>
    <form action="edit_product.php" method="post">
        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
        <label for="product_name">Product Name:</label>
        <input type="text" id="product_name" name="product_name" value="<?php echo $product['product_name']; ?>" required>
        <br>
        <label for="price">Price:</label>
        <input type="number" step="0.01" id="price" name="price" value="<?php echo $product['price']; ?>" required>
        <br>
        <label for="description">Description:</label>
        <textarea id="description" name="description" required><?php echo $product['description']; ?></textarea>
        <br>
        <input type="submit" value="Update Product">
    </form>
</body>
</html>
