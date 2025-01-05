<?php
/**
 * created by: tushar Khan
 * email : tushar.khan0122@gmail.com
 * date : 1/5/2025
 */

require 'database.php';

$conn = connectDatabase();

$result = $conn->query("SELECT 
    p.id, p.name as product_name, c.name as category_name, 
    po.name as option_name, po.image_path, po.price , po.id as option_id
FROM products p 
LEFT JOIN categories c ON p.category_id = c.id
LEFT JOIN product_options po ON p.id = po.product_id");

$products = [];
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

echo json_encode($products);