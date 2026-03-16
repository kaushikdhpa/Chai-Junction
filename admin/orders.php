<?php
include("../db.php");  // ensure correct path
?>

<link rel="stylesheet" href="admin.css">
<?php include("sidebar.php"); ?>

<div class="main">
<h2>Customer Orders</h2>

<table>
<tr>
<th>ID</th>
<th>Name</th>
<th>Items</th>
<th>Total</th>
<th>Date</th>
<th>Action</th>
</tr>

<?php
$result = mysqli_query($conn,"SELECT * FROM orders ORDER BY id DESC");
while($row=mysqli_fetch_assoc($result)){
    $items = json_decode($row['items'], true);
?>
<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo $row['customer_name']; ?></td>
<td>
<?php
if(is_array($items)){
    foreach($items as $item){
        echo $item['name'] . " - ₹" . $item['price'] . "<br>";
    }
} else {
    echo $row['items']; // fallback if JSON invalid
}
?>
</td>
<td>₹<?php echo $row['total_amount']; ?></td>
<td><?php echo $row['order_date']; ?></td>
<td>
<a class="update-btn" href="update_order.php?id=<?php echo $row['id']; ?>">Update</a>
<a class="delete-btn" href="delete_order.php?id=<?php echo $row['id']; ?>">Delete</a>
</td>
</tr>
<?php } ?>
</table>
</div>