<?php
// Start PHP, no output before header
include("../db.php");

$id = $_GET['id'];

// Handle form submission FIRST
if(isset($_POST['update'])){
    $customer_name = $_POST['customer_name'];
    $total_amount = $_POST['total_amount'];
    $order_date = $_POST['order_date'];
    $items = json_encode($_POST['items']); // Save items as JSON

    $update = "UPDATE orders 
               SET customer_name='$customer_name', 
                   total_amount='$total_amount', 
                   order_date='$order_date', 
                   items='$items' 
               WHERE id='$id'";
    mysqli_query($conn, $update);

    header("location:orders.php"); // redirect BEFORE any HTML
    exit;
}

// Fetch order data
$sql = "SELECT * FROM orders WHERE id='$id'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Order</title>
    <link rel="stylesheet" href="admin.css">
    <style>
        /* ===== Chai/Coffee Themed Admin Panel ===== */
.main {
    max-width: 800px;
    margin: 30px auto;
    background: #fff8f0; /* soft cream background */
    padding: 30px 25px;
    border-radius: 15px;
    box-shadow: 0 10px 25px rgba(150,100,50,0.15); /* soft brown shadow */
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

/* Headings */
.main h2 {
    text-align: center;
    color: #5a3e2b; /* coffee brown */
    font-size: 28px;
    margin-bottom: 15px;
    letter-spacing: 1px;
}

.main h3 {
    color: #8b5e3c; /* lighter coffee */
    margin-bottom: 10px;
    font-size: 22px;
    text-align: center;
}

/* Inputs and textarea */
.main input, .main textarea {
    width: 100%;
    padding: 10px 12px;
    margin: 8px 0 18px;
    border: 1px solid #d9b38c; /* soft coffee border */
    border-radius: 8px;
    font-size: 16px;
    transition: all 0.3s;
    background: #fff3e6; /* light cream background */
}

.main input:focus, .main textarea:focus {
    border-color: #a66a39; /* darker coffee highlight */
    box-shadow: 0 0 6px rgba(166,106,57,0.5);
    outline: none;
}

/* Buttons */
.main button {
    background-color: #a66a39; /* coffee brown button */
    color: #fff8f0;
    padding: 10px 22px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-size: 16px;
    font-weight: 500;
    transition: all 0.3s;
}

.main button:hover {
    background-color: #8b5e3c;
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(0,0,0,0.15);
}

/* Items Row */
.item-row {
    display: flex;
    justify-content: space-between;
    gap: 10px;
    margin-bottom: 10px;
}

.item-row input {
    flex: 1;
    padding: 8px;
    font-size: 15px;
    border-radius: 6px;
    border: 1px solid #d9b38c;
    transition: all 0.3s;
    background: #fff3e6;
}

.item-row input:focus {
    border-color: #a66a39;
    box-shadow: 0 0 5px rgba(166,106,57,0.4);
}

/* Table Styling */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    font-size: 15px;
}

table th, table td {
    padding: 12px 10px;
    text-align: left;
    border-bottom: 1px solid #d9b38c;
}

table th {
    background-color: #f7e5d7; /* light coffee header */
    color: #5a3e2b;
    font-weight: 600;
}

table tr:hover {
    background-color: #fff1e0; /* light hover effect */
    transition: 0.3s;
}

/* Update / Delete Links */
.update-btn {
    display: block;
    background-color: #8b5e3c;
    color: #fff8f0;
    padding: 6px 14px;
    margin: 6px 0;
    border-radius: 6px;
    text-align: center;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s;
}

.update-btn:hover {
    background-color: #734c2d;
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

.delete-btn {
    display: block;
    background-color: #d9534f; /* reddish-brown delete */
    color: #fff8f0;
    padding: 6px 14px;
    margin: 6px 0;
    border-radius: 6px;
    text-align: center;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s;
}

.delete-btn:hover {
    background-color: #b7413e;
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}
    </style>
</head>
<body>

<div class="main">
<h2>Update Order</h2>

<form method="POST">
Customer Name <br>
<input type="text" name="customer_name" value="<?php echo htmlspecialchars($row['customer_name']); ?>"><br>

Total Amount <br>
<input type="number" name="total_amount" value="<?php echo htmlspecialchars($row['total_amount']); ?>"><br>

Order Date <br>
<input type="date" name="order_date" value="<?php echo htmlspecialchars($row['order_date']); ?>"><br>


<h3>Items</h3>
<div id="items-container">
<?php
$items = json_decode($row['items'], true);
if(!is_array($items)) $items = [];
foreach($items as $index => $item):
?>
<div class="item-row">
    Name: <input type="text" name="items[<?php echo $index; ?>][name]" value="<?php echo htmlspecialchars($item['name']); ?>">
    Price: <input type="number" name="items[<?php echo $index; ?>][price]" value="<?php echo htmlspecialchars($item['price']); ?>">
</div>
<?php endforeach; ?>
</div>

<button type="button" onclick="addItem()">Add Item</button>
<button type="button" onclick="removeItem()">Remove Last Item</button><br><br>

<button type="submit" name="update">Update Order</button>
</form>
</div>

<script>
function addItem(){
    let container = document.getElementById('items-container');
    let index = container.children.length;
    let div = document.createElement('div');
    div.classList.add('item-row');
    div.innerHTML = `Name: <input type="text" name="items[${index}][name]"> Price: <input type="number" name="items[${index}][price]">`;
    container.appendChild(div);
}

function removeItem(){
    let container = document.getElementById('items-container');
    if(container.children.length > 0){
        container.removeChild(container.lastElementChild);
    }
}
</script>

</body>
</html>