<?php
/**
 * created by: tushar Khan
 * email : tushar.khan0122@gmail.com
 * date : 1/5/2025
 */

require 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = connectDatabase();

    $productName = $_POST['product_name'];
    $productCategory = $_POST['product_category'];
    $options = $_POST['options'];

    $stmt = $conn->prepare("INSERT INTO products (name, category_id) VALUES (?, ?)");
    $stmt->bind_param("si", $productName, $productCategory);
    $stmt->execute();
    $productId = $stmt->insert_id;

    foreach ($options as $ind => $option) {
        $optionName = $option['name'];
        $price = $option['price'];

        $imagePath = "";
        if (!empty($_FILES['options']['name'][$ind])) {
            $imagePath = 'uploads/' . generateRandomString() . '.' . pathinfo($_FILES['options']['name'][$ind]['image'], PATHINFO_EXTENSION);
            move_uploaded_file($_FILES['options']['tmp_name'][$ind]['image'], __DIR__ .'/../'. $imagePath);
        }

        $stmt = $conn->prepare("INSERT INTO product_options (product_id, name, image_path, price) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("issd", $productId, $optionName, $imagePath, $price);
        $stmt->execute();
    }

    echo "Product saved successfully!";
    $stmt->close();
    $conn->close();

    header("Location: ../index.html");
    exit();
}

function generateRandomString($length = 25) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}