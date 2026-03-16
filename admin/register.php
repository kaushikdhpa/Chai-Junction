<?php

include("../db.php"); 

if(isset($_POST['register'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check email exists
    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if(mysqli_num_rows($check) > 0){
        $error = "Email already registered!";
    } else {
        mysqli_query($conn, "INSERT INTO users(name,email,password) VALUES('$name','$email','$password')");
        header("location:user_login.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register - Chai Junction</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="form-container">
    <h2>Register</h2>
    <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>
    <form method="POST">
        Name:<br>
        <input type="text" name="name" required><br>
        Email:<br>
        <input type="email" name="email" required><br>
        Password:<br>
        <input type="password" name="password" required><br>
        <button type="submit" name="register">Register</button>
    </form>
    <p>Already have an account? <a href="user_login.php">Login Here</a></p>
</div>
</body>
</html>