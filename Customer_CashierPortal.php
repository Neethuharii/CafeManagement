<?php
$host="localhost";
       $username="root";
       $password="";
       $database="cafe_management";
       
$conn=  mysqli_connect($host, $username, $password, $database);
     

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$result = mysqli_query($conn, "SELECT * FROM payment");

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
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



            .main-box {
                box-shadow: 0 0 10px rgb(0,0,0,0.2);
                width: 1000px;

                margin-left: 20px;
                margin-top: 10px;
                margin-bottom: 10px;
                padding: 20px;
                border: 2px solid #ccc;
                border-radius: 7px;
                background-color: #f9f9f9; 
            }
            .main-box h2{
                margin-bottom:15px;
                font-size:20px;
            }

            table {

                width: 100%;
                border-collapse: collapse;

            }

            th {

                background-color: #0f6b63;
                color: white;
                padding: 10px;
                text-align: left;
            }

            td {
                background-color: #eaeaea; 
                height: 40px; 
                border: 1px solid #ddd;
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
                    <a href="CafePortal.php" class="menu-btn">Order</a>
                    <a href="Customer_CashierPortal.php" class="menu-btn">Customers</a>
                </div>

                 <a href="CafePortalLogin.php" class="menu-btn logout">Logout</a>

            </div>

            <div class="main-box">
                <h2>All Customers</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Customer ID</th>
                            <th>TotalPrice</th>
                            <th>Amount</th>
                            <th>Change</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>

                         <?php while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
               
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['total']; ?></td>
                <td><?php echo $row['amount_paid']; ?></td>
                <td><?php echo $row['change_amount']; ?></td>
                 
                    <td><?php echo $row['Date']; ?></td>
                      
               
            </tr>
            <?php endwhile; ?>

                    </tbody>
                </table>
            </div>
        </div>

    </body>
</html>
