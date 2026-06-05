
<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "cafe_management";

$con = mysqli_connect($host, $username, $password, $database);

if(!$con){
    die("Connection failed: " . mysqli_connect_error());
}

$name_error="";
$password_error="";

if(isset($_POST['submit'])){

$Name = $_POST['name'];
$Email = $_POST['email'];
$Username = $_POST['uname'];
$Password = $_POST['pass'];
$confirmPassword = $_POST['confirmPassword'];

/* Username Validation */

if(empty($Username)){
    $name_error="Username is required";
}
else{
    if(!preg_match("/^[a-zA-Z ]+$/",$Username)){
        $name_error="Username should contain only letters and spaces";
    }
}

/* Password Validation */

if(empty($Password)){
    $password_error="Password is required";
}
elseif(strlen($Password) < 8){
    $password_error="At least 8 characters required";
}
elseif(!preg_match("#[0-9]+#", $Password)){
    $password_error="At least one digit required";
}
elseif(!preg_match("#[a-z]+#", $Password)){
    $password_error="At least one lowercase letter required";
}
elseif(!preg_match("#[A-Z]+#", $Password)){
    $password_error="At least one uppercase letter required";
}
elseif($Password != $confirmPassword){
    $password_error="Passwords do not match";
}

/* Insert Data */

if($name_error=="" && $password_error==""){

  

    $sql = "INSERT INTO register(Name,Email,Username,Password,Confirm_Password)
            VALUES('$Name','$Email','$Username','$Password','$confirmPassword')";

    if(mysqli_query($con,$sql)){
        echo "<script>
        alert('Registered successfully');
        window.location.href='CafePortalAdminLogin.php';
        </script>";
    }
    else{
        echo "Error: " . mysqli_error($con);
    }
}

}


mysqli_close($con);

?>



<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
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
            height:520px;
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
            margin-bottom:30px;
        }

        .left p{
            margin-bottom:15px;
        }

        .login-btn-left{
            width:200px;
            padding:7px;
            border:2px solid #ffffff80;
            background:transparent;
            color:white;
            cursor:pointer;
            font-weight:bold;
            border-radius: 4px;
            text-decoration: none;
        }

        .login-btn-left:hover{
            background:white;
            color:#0f6b66;
        }

       
        .right{
            width:50%;
            padding:40px;
        }

        .right h2{
            margin-bottom:25px;
        }

        .form-group{
            margin-bottom:18px;
        }

        label{
            font-size:14px;
        }

        input[type="text"],
        input[type="password"],
        input[type="email"]{
            width:100%;
            padding:8px;
            margin-top:5px;
            border:1px solid #ccc;
            border-radius: 4px;
        }

        input:focus{
            outline:none;
            border:1px solid #0f6b66;
        }

        .register-btn{
            width:140px;
            padding:10px;
            background:#0f6b66;
            color:white;
            border:none;
            cursor:pointer;
            font-weight:bold;
            margin-top:4px;
            border-radius: 4px;
        }

        .register-btn:hover{
            background:#094c49;
        }

    </style>
</head>
<body>

<div class="container">

    
    <div class="left">
        <img src="images/Screenshot 2026-02-12 110430.png" alt="Coffee Logo">
        <h2>Cafe Shop Management System</h2>
        <br><br><br>
        <p>Already have an account?</p>
        <a href="CafePortalAdminLogin.php"  class="login-btn-left">LOGIN</a>
    </div>

   
    <div class="right">
        <h2>REGISTER</h2>
        
        <form method="post" action="CafePortalAdminRegister.php">
        <div class="form-group">
            <label>Full Name:<span style="color:red;"> *</span></label>
            <input type="text" name="name" placeholder="Enter full name" required>
        </div>

        <div class="form-group">
            <label>Email: <span style="color:red;"> *</span></label>
            <input type="email" name="email" placeholder="Enter email" >
        </div>

        <div class="form-group">
            <label>Username: <span style="color:red;"> *</span></label>
            <input type="text" name="uname" placeholder="Create username" >
            <span style="color: red;"><?php  echo $name_error; ?></span>
        </div>

        <div class="form-group">
            <label>Password: <span style="color:red;"> *</span></label>
            <input type="password" name="pass" placeholder="Create password">
              <span style="color:red;"><?php echo $password_error; ?></span>
        </div>

        <div class="form-group">
            <label>Confirm Password: <span style="color:red;"> *</span></label>
            <input type="password" name="confirmPassword" placeholder="Confirm password" required>
        </div>

            <button class="register-btn" name="submit">REGISTER</button>
        </form>

    </div>

</div>
</body>
</html>
