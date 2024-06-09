<?php
session_start();
include('config.php');

$username = $_POST['username'];
$email = $_POST['email'];
$role = $_POST['role'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// Check if passwords match
if ($password !== $confirm_password) {
    die("Passwords do not match.");
}

// Password complexity check
if (strlen($password) < 8 || !preg_match("/[A-Z]/", $password) || !preg_match("/[0-9]/", $password)) {
    die("Password must be at least 8 characters long and include at least one uppercase letter and one number.");
}

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Check if username or email already exists
$sql = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    die("Username or Email already exists.");
}

// Insert new user
$sql = "INSERT INTO users (username, email, role, password) VALUES ('$username', '$email', '$role', '$hashed_password')";
if ($conn->query($sql) === TRUE) {
    $_SESSION['username'] = $username;
    $_SESSION['role'] = $role;
    $_SESSION['email'] = $email;
    header("Location: product_list.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
