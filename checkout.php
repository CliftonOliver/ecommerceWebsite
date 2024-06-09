// checkout.php
<?php
session_start();
include('config.php');

$username = $_SESSION['username'];

$sql = "DELETE FROM cart WHERE user='$username'";
if ($conn->query($sql) === TRUE) {
    echo "Checkout successful.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
