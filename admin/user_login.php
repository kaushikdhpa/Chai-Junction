<?php
session_start();
include("../db.php");

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        $user = mysqli_fetch_assoc($result);
        if(password_verify($password, $user['password'])){
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            header("location:../home.html");
            exit;
        } else {
            $error = "Invalid password!";
        }
    } else {
        $error = "Email not registered!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - Chai Junction</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="form-container">
    <h2>Login</h2>
    <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>
    <form method="POST">
        Email:<br>
        <input type="email" name="email" required><br>
        Password:<br>
        <input type="password" name="password" required><br>
        <button type="submit" name="login">Login</button>
    </form>
    <p>Don't have an account? <a href="register.php" class="register-link">Register Here</a></p>
</div>
</body>
</html>