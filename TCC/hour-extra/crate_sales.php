<?php
require_once 'connect.php';
$total_sales = $_POST['total_sales'];
$data = $_POST['data'];

$sql = "INSERT INTO sales(total_value) VALUES ($total_sales)";
if($connect->query($sql) === TRUE){
    foreach ($data as $key => $value) {
        if($value["total"] < -1){
            $value["total"] = 0;
        }
        $sqlUp = "UPDATE products SET amount = $value[total] WHERE id_products = $value[id]";
        $connect->query($sqlUp);
    }
}

