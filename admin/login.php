<?php
session_start();
include("../db.php");

if(isset($_POST['login'])){

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";

$result = mysqli_query($conn,$sql);

if(mysqli_num_rows($result) == 1){

$_SESSION['admin'] = $username;

header("location:dashboard.php");

}else{

$error = "Invalid Username or Password";

}

}
?>

<!DOCTYPE html>
<html>
<head>
<title>Tea Shop Admin Login</title>

<style>

body{
margin:0;
font-family:Arial;
background:linear-gradient(135deg,#6b4f3b,#a67c52);
height:100vh;
display:flex;
align-items:center;
justify-content:center;
}

/* Login Box */

.login-box{
background:white;
padding:40px;
width:350px;
border-radius:10px;
box-shadow:0 10px 25px rgba(0,0,0,0.3);
text-align:center;
}

/* Title */

.login-box h2{
margin-bottom:20px;
color:#6b4f3b;
}

/* Inputs */

.login-box input{
width:100%;
padding:10px;
margin:10px 0;
border:1px solid #ccc;
border-radius:5px;
}

/* Button */

.login-box button{
width:100%;
padding:10px;
background:#6b4f3b;
color:white;
border:none;
border-radius:5px;
cursor:pointer;
font-size:16px;
}

.login-box button:hover{
background:#4e3728;
}

/* Error */

.error{
color:red;
margin-bottom:10px;
}

</style>

</head>

<body>

<div class="login-box">

<h2>☕ Tea Shop Admin</h2>

<?php if(isset($error)){ ?>

<p class="error"><?php echo $error; ?></p>

<?php } ?>

<form method="POST">

<input type="text" name="username" placeholder="Username" required>

<input type="password" name="password" placeholder="Password" required>

<button name="login">Login</button>

</form>

</div>

</body>
</html>