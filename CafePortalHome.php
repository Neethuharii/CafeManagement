<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "cafe_management";


$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$res1 = mysqli_query($conn, "SELECT COUNT(*) as total FROM addcashier WHERE Role='cashier'");
$row1 = mysqli_fetch_assoc($res1);

$res2 = mysqli_query($conn, "SELECT COUNT(*) AS total_cus FROM payment");
$row2 = mysqli_fetch_assoc($res2);

$res3 = mysqli_query($conn,"SELECT SUM(total) as total_inc FROM payment WHERE DATE(Date) = CURDATE()");
$row3 = mysqli_fetch_assoc($res3);

$res4 = mysqli_query($conn, "SELECT SUM(total) as total_pri FROM payment");
$row4 = mysqli_fetch_assoc($res4);


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
            background:#f4f4f4;
            overflow:hidden;
        }

        .container{
            display:flex;
            height:100vh;
        }

     

        .sidebar{
            width:230px;
            background:#0f6b63;
            color:white;
            padding:15px;
            display:flex;
            flex-direction:column;
        }

        .logo{
            display:flex;
            justify-content:center;
            margin-bottom:10px;
        }

        .logo img{
            width:80px;
            height:80px;
            border-radius:50%;
            border:3px solid white;
            object-fit:cover;
        }

        .sidebar h2{
            text-align:center;
            font-size:18px;
            margin-bottom:5px;
        }

        .sidebar p{
            text-align:center;
            font-size:13px;
            margin-bottom:20px;
        }

        .menu{
            flex:1;
        }

        .menu-btn{
            display:block;
            height: 35px;
            width:100%;
            padding:8px;
            margin-bottom:10px;
            border:1px solid #ffffff80;
            background:transparent;
            color:white;
            text-align:center;
            cursor:pointer;
            transition:0.3s;
            border-radius:8px;
            text-decoration:none;
            font-size:14px;
        }

        .menu-btn:hover{
            background:white;
            color:#0f6b63;
        }

        .logout{
            margin-top:auto;
            border:1px solid #ffdddd;
        }

        .logout:hover{
            background:#ffdddd;
            color:#0f6b63;
        }

       

        .main{
            flex:1;
            padding:15px;
            display:flex;
            flex-direction:column;
        }

       

        .cards{
            display:flex;
            gap:15px;
            margin-bottom:15px;
            flex-wrap:nowrap; 
        }

        .card{
            flex:1;
            background:#0f6b63;
            color:white;
            padding:10px;
            border-radius:8px;
            text-align:center;
            height:90px;       
            display:flex;
            flex-direction:column;
            justify-content:center;
        }

        .card h3{
            font-size:14px;
            margin-bottom:5px;
        }

        .card p{
            font-size:18px;
            font-weight:bold;
        }

 

        .image-box{
            flex:1;
            background:white;
            border-radius:8px;
            overflow:hidden;
          
        }

        .image-box img{
            width:100%;
            height:100%;
            object-fit:cover;
        }

    </style>
</head>

<body>

<div class="container">

    <div class="sidebar">

        <div class="logo">
            <img src="images/Screenshot 2026-02-12 110430.png">
        </div>
<br>
        <h2>Cashier's Portal</h2>
        <p>Username: Cashier</p><br>

        <div class="menu">
            <a href="CafePortalHome.php" class="menu-btn">Dashboard</a>
            <a href="AddProduct_CashierPortal.php" class="menu-btn">Add Product</a>
            <a href="CafePortal.php" class="menu-btn">Orders</a>
            <a href="Customer_CashierPortal.php" class="menu-btn">Customers</a>
        </div>

        <a href="CafePortalLogin.php" class="menu-btn logout">Logout</a>

    </div>

    <div class="main">

        <div class="cards">
            <div class="card">
                <h3>Total of Cashiers</h3>
               <p><?php echo $row1['total']; ?></p>
            </div>

            <div class="card">
                <h3>Total of Customers</h3>
               <p><?php echo $row2['total_cus']; ?></p>
            </div>

            <div class="card">
                <h3>Today's Income</h3>
               <p><?php echo "₹ " . ($row3['total_inc'] ? $row3['total_inc'] : 0); ?></p>
            </div>

            <div class="card">
                <h3>Total Income</h3>
               <p><?php echo "₹ ". $row4['total_pri']; ?></p>
            </div>
        </div>

        <div class="image-box">
            <img src="images/cafe2.jpg" alt="Cafe Image">
        </div>

    </div>

</div>

</body>
</html>
