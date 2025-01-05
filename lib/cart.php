<?php
/**
 * created by: tushar Khan
 * email : tushar.khan0122@gmail.com
 * date : 1/5/2025
 */

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

require 'database.php';

$conn = connectDatabase();

    $userId = $_SESSION['user_id'];
    $productId = (int)$_GET['p'];
    $action = $_GET['a'];
    $item = (int)$_GET['i'];
    $quantity = 1;

    if ($action != 'add'){
        $sql = "DELETE FROM cart WHERE user_id=? AND product_id=? AND product_item_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('iii', $userId, $productId, $item);

        if($stmt->execute()){
            echo "Cart deleted successfully!";
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        $checkQuery = "SELECT id, quantity FROM cart WHERE user_id=? AND product_id=? AND product_item_id=? LIMIT 1";
        $stmt = $conn->prepare($checkQuery);
        $stmt->bind_param('iii', $userId, $productId, $item);
        $stmt->execute();
        $result = $stmt->get_result();
        $cart = $result->fetch_assoc();
        echo "<pre>";
        print_r($cart);
        if ($cart){
            $qt = ((int)$cart['quantity']) + 1;
            $update = "UPDATE cart SET quantity=? WHERE user_id=? AND product_id=? AND product_item_id=?";
            $stmt = $conn->prepare($update);
            $stmt->bind_param("iiii", $qt, $userId, $productId, $item);

            if($stmt->execute()){
                echo "Cart updated successfully!";
            } else {
                echo "Error: " . $conn->error;
            }
        } else {
            $sql = "INSERT INTO cart (user_id, product_id, quantity, product_item_id) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iiii", $userId, $productId, $quantity, $item);

            if ($stmt->execute()) {
                echo "Cart added successfully!";
            } else {
                echo "Error: " . $conn->error;
            }
        }
    }


