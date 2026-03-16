<?php
include("db.php");

if(isset($_POST['submit'])){

$name = mysqli_real_escape_string($conn,$_POST['name']);
$email = mysqli_real_escape_string($conn,$_POST['email']);
$subject = mysqli_real_escape_string($conn,$_POST['subject']);
$message = mysqli_real_escape_string($conn,$_POST['message']);

$sql = "INSERT INTO contact (name,email,subject,message) 
VALUES ('$name','$email','$subject','$message')";

if(mysqli_query($conn,$sql)){
    echo "<script>
    alert('Message Sent Successfully');
    window.location.href='home.html';
    </script>";
}else{
    echo "Error: ".mysqli_error($conn);
}

}
?>