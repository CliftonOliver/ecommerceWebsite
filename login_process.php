<?php
session_start();
include('config.php');

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $row['role'];
        $_SESSION['email'] = $row['email'];
        header("Location: product_list.php");
    } else {
        echo "Invalid username or password.";
    }
} else {
    echo "Invalid username or password.";
}

$conn->close();
?>
