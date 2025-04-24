<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "recipe_book";

$conn = new mysqli($host, $user, $password, $recipe_book);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
