<?php
include("../db.php");

if(isset($_POST['item']) && isset($_POST['price'])){
    $item = $_POST['item'];
    $price = $_POST['price'];

    mysqli_query($conn,"INSERT INTO orders(item_name,price) VALUES('$item','$price')");
}
?>