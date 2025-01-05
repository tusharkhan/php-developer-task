<?php
/**
 * created by: tushar Khan
 * email : tushar.khan0122@gmail.com
 * date : 1/5/2025
 */

require 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = connectDatabase();

    $categoryName = $_POST['category_name'];

    $stmt = $conn->prepare("INSERT INTO categories (name) VALUES (?)");
    $stmt->bind_param("s", $categoryName);
    $stmt->execute();

    echo "Category added successfully!";
    $stmt->close();
    $conn->close();

    header("Location: ../index.php");
    exit();
}