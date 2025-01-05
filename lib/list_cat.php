<?php
/**
 * created by: tushar Khan
 * email : tushar.khan0122@gmail.com
 * date : 1/5/2025
 */

require 'database.php';

$conn = connectDatabase();

$result = $conn->query("SELECT id, name FROM categories");

$categories = [];
while ($row = $result->fetch_assoc()) {
    $categories[] = $row;
}

echo json_encode($categories);