<?php
/**
 * created by: tushar Khan
 * email : tushar.khan0122@gmail.com
 * date : 1/6/2025
 */

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

require "database.php";

$conn = connectDatabase();

$userId = $_SESSION['user_id'];

$sql = "SELECT cart.quantity, products.name, product_options.name as option_name, product_options.price FROM cart
    JOIN products ON products.id = cart.product_id
    JOIN product_options ON cart.product_item_id = product_options.id WHERE cart.user_id=".$userId ;

$st = $conn->query($sql);

$cats = [];
while ($row = $st->fetch_assoc()) {
    $cats[] = $row;
}

echo json_encode($cats);