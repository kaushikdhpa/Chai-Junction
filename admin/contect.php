<?php
include("../db.php");
?>

<link rel="stylesheet" href="admin.css">

<?php include("sidebar.php"); ?>

<div class="main">

<h2>Contact Messages</h2>

<table>

<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Subject</th>
<th>Action</th>
</tr>

<?php

$result = mysqli_query($conn,"SELECT * FROM contact ORDER BY id DESC");

while($row=mysqli_fetch_assoc($result)){

?>

<tr>

<td><?php echo $row['id']; ?></td>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['email']; ?></td>
<td><?php echo $row['subject']; ?></td>


<td>
<a class="delete-btn" href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
</td>

</tr>

<?php } ?>

</table>

</div>