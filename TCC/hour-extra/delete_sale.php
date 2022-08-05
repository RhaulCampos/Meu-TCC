<?php
require_once 'connect.php';

if(isset($_POST['id_sale'])){
    $id_sale = $_POST['id_sale'];
    $sql = "DELETE FROM sales WHERE id_sale = '$id_sale'";
    return $connect->query($sql);
}