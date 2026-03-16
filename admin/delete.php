<?php
include ("../db.php");

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM contact WHERE id=$id");

header("Location: contect.php");
?>