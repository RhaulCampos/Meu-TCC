<?php
require_once 'connect.php';

if(isset($_POST['id_product'])){
    $id_product = $_POST['id_product'];
    $sql = "DELETE FROM products WHERE id_products = '$id_product'";
    return $connect->query($sql);
}