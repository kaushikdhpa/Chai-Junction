<?php
include("db.php");

// JSON response
header("Content-Type: application/json");

// JSON data read
$json = file_get_contents("php://input");
$data = json_decode($json, true);

// check data
if(!isset($data['customer_name']) || !isset($data['items']) || !isset($data['total_amount'])){
    echo json_encode([
        "status" => "error",
        "message" => "Invalid Data"
    ]);
    exit;
}

// variables
$customer_name = mysqli_real_escape_string($conn, $data['customer_name']);
$items = json_encode($data['items']); // array ne JSON string ma convert
$total_amount = intval($data['total_amount']);

// query
$sql = "INSERT INTO orders (customer_name, items, total_amount, order_date)
        VALUES ('$customer_name','$items','$total_amount',NOW())";

if(mysqli_query($conn,$sql)){
    echo json_encode([
        "status" => "success",
        "message" => "Order Saved Successfully"
    ]);
}else{
    echo json_encode([
        "status" => "error",
        "message" => mysqli_error($conn)
    ]);
}
?>