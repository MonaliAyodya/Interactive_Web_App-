<?php
session_start();
include '../includesdb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        $_SESSION['user'] = $username;
        header("Location: ../dashboard.php");
    } else {
        echo "<script>alert('Email already exists.'); window.location.href='../signup.html';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
