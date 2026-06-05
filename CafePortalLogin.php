<?php
$host = "localhost";
$user = "root";
$pass = "";
$database = "cafe_management";

$connection = mysqli_connect($host, $user, $pass, $database);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$invalid_error = "";
$invalidpass_error = "";

if (isset($_POST['login'])) {

    $username = $_POST['uname'];
    $password = $_POST['pass'];

    if (empty($username) || empty($password)) {
        $invalid_error = "Please enter username and password";
    } else {
        
        if ($username === "admin" && $password === "admin123") {
            echo "<script>
                alert('Admin Login Successful');
                window.location.href='CafePortalAdminPortal.php';
            </script>";
            exit();
        }

        $sql = "SELECT * FROM register WHERE Username='$username'";
        $result = mysqli_query($connection, $sql);

        if (mysqli_num_rows($result) == 0) {
            $invalid_error = "Username does not exist";
        } else {
            $row = mysqli_fetch_assoc($result);

            if ($row['Password'] == $password) {
                echo "<script>
                    alert('Login Successful');
                    window.location.href='CafePortalHome.php';
                </script>";
                exit();
            } else {
                $invalidpass_error = "Incorrect password";
            }
        }
    }
}

mysqli_close($connection);
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <style>
      
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body{
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            background:#f2f2f2;
        }

        .container{
            width:800px;
            height:500px;
            display:flex;
            box-shadow:0 5px 20px rgba(0,0,0,0.4);
            background:white;
            border-radius: 10px;
        }

        .left{
            width:50%;
            background:#0f6b66;
            color:white;
            display:flex;
            flex-direction:column;
            justify-content:center;
            align-items:center;
            padding:40px;
            text-align:center;
        }

        .left img{
            width:80px;
            margin-bottom:20px;
            height:80px;
            border-radius:50%;
            border:3px solid white;
            object-fit:cover;
        }

        .left h2{
            margin-bottom:60px;
        }

        .left p{
            margin-bottom:10px;
        }

        .register-btn{
            width:150px;
            padding:6px;
            border:2px solid #ffffff80;
            background:transparent;
            color:white;
            cursor:pointer;
            font-weight:bold;
            border-radius: 4px;
            text-decoration: none;
            font-size: 13px;
        }

        .register-btn:hover{
            background:white;
            color:#0f6b66;
        }

        .right{
            width:50%;
            padding:40px;
        }

        .right h2{
            margin-bottom:30px;
        }

        .form-group{
            margin-bottom:20px;
        }

        label{
            font-size:14px;
        }

        input[type="text"],
        input[type="password"]{
            width:100%;
            padding:8px;
            margin-top:5px;
            border:1px solid #ccc;
        }

        input[type="text"]:focus,
        input[type="password"]:focus{
            outline:none;
            border:1px solid #0f6b66;
        }

        .login-btn{
            width:120px;
            padding:10px;
            background:#0f6b66;
            color:white;
            border:none;
            cursor:pointer;
            font-weight:bold;
            margin-top:10px;
            border-radius: 4px;
        }

        .login-btn:hover{
            background:#094c49;
        }

        .checkbox{
            font-size:14px;
            margin-top:5px;
        }
    </style>
</head>
<body>

<div class="container">

    <div class="left">
        <img src="images/Screenshot 2026-02-12 110430.png" alt="Coffee Logo">
        <h2>Cafe Shop Management System</h2>
        <p>New User?</p>
        <a href="CafePortalRegister.php" class="register-btn">REGISTER</a>
    </div>

    <div class="right">
        <h2>SIGN IN</h2>

        <form action="CafePortalLogin.php" method="post">
            <div class="form-group">
                <label>Username:</label>
                <input type="text" name="uname" id="username" placeholder="Enter username" required>
                 <span style="color: red;"><?php  echo $invalid_error; ?></span>
            </div>

            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="pass" id="password" placeholder="Enter password" required>
                 <span style="color: red;"><?php  echo $invalidpass_error; ?></span>
            </div>

            <div class="checkbox">
                <input type="checkbox" onclick="togglePassword()"> Show Password
            </div>

            <button type="submit" name="login" class="login-btn" >LOGIN</button>
        </form>
    </div>

</div>

<script>


function togglePassword() {
    var passwordField = document.getElementById("password");
    if(passwordField.type === "password") {
        passwordField.type = "text";
    } else {
        passwordField.type = "password";
    }
}
</script>

</body>
</html>
