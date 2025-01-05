<?php
/**
 * created by: tushar Khan
 * email : tushar.khan0122@gmail.com
 * date : 1/5/2025
 */

require 'database.php';

$conn = connectDatabase();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['product_id'];
    $action = $_POST['action'];

    if ($action === 'add') {
        $stmt = $conn->prepare("INSERT INTO cart (product_id) VALUES (?)");
        $stmt->bind_param("i", $productId);
        $stmt->execute();
    } elseif ($action === 'remove') {
        $stmt = $conn->prepare("DELETE FROM cart WHERE product_id = ?");
        $stmt->bind_param("i", $productId);
        $stmt->execute();
    }

    echo "Cart updated successfully!";
}