<?php
session_start();
include('config.php');

if (!isset($_SESSION['username'])) {
    header("Location: index.html");
    exit();
}

$username = $_SESSION['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

if ($password !== $confirm_password) {
    die("Passwords do not match.");
}

if (!empty($password)) {
    if (strlen($password) < 8 || !preg_match("/[A-Z]/", $password) || !preg_match("/[0-9]/", $password)) {
        die("Password must be at least 8 characters long and include at least one uppercase letter and one number.");
    }
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "UPDATE users SET email='$email', password='$hashed_password' WHERE username='$username'";
} else {
    $sql = "UPDATE users SET email='$email' WHERE username='$username'";
}

if ($conn->query($sql) === TRUE) {
    $_SESSION['email'] = $email;
    header("Location: profile.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
