<?php
session_start();
include("../db.php");
?>

<link rel="stylesheet" href="admin.css">

<?php include("sidebar.php"); ?>

<div class="main">

<h1>Dashboard</h1>

<div class="cards">

<div class="card">
<h3>Total Orders</h3>

<?php
$result = mysqli_query($conn,"SELECT COUNT(*) as total FROM orders");
$row = mysqli_fetch_assoc($result);
echo $row['total'];
?>

</div>

<div class="card">
<h3>Contact Messages</h3>

<?php
$result = mysqli_query($conn,"SELECT COUNT(*) as total FROM contact");
$row = mysqli_fetch_assoc($result);
echo $row['total'];
?>

</div>

</div>

</div>