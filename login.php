<?php
session_start();
include '../includesdb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id, $username, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['user'] = $username;
            header("Location: ../dashboard.php");
        } else {
            echo "<script>alert('Incorrect password'); window.location.href='../login.html';</script>";
        }
    } else {
        echo "<script>alert('Email not found'); window.location.href='../login.html';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
