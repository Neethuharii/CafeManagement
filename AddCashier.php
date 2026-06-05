<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "cafe_management";

$conn = mysqli_connect($host, $username, $password, $database);


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$result = mysqli_query($conn, "SELECT * FROM addcashier");

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
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
                height:100vh;
                overflow:hidden; 
            }

            .container{
                display:flex;
                height:100%;
            }




            /* SIDEBAR */
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
            }

            .panel{
                display:flex;
                gap:20px;
                height:100%; 
            }


            .form-section{
                flex:0 0 43%;
                background:white;
                border-radius:4px;
                box-shadow:0 0 5px rgba(0,0,0,0.2);
                padding:15px;
                display:flex;
                flex-direction:column;
                justify-content:flex-start;
                height:100%;
            }
            .image-box {
                width: 120px; 
                height: 130px; 
                background: #cfcfcf; 
                margin: 10px auto; 
                overflow: hidden;
                display: flex;
                align-items: center;
                justify-content: center;
                border: 1px solid #ccc;
            }

            .image-box img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                margin: 0; 
            }

            .import-wrapper{
                text-align:center;
                margin-bottom:10px;
            }

            .import-btn{
                padding:6px 36px;
                background:#0f6b63;
                color:white;
                border-radius:4px;

                cursor:pointer;
                margin-left: 1px;
                

            }

            .import-btn:hover{
                background:#45a049;
            }

            .form-group{
                margin-bottom:10px;
            }
            .form-group label{
                display:block;
                margin-bottom:5px;
            }

            .form-group input,
            .form-group select{
                width:100%;
                padding:5px;
                border:1px solid #999;
                border-radius: 4px;
                height: 30px;
            }

            .button-group{
                margin-top:10px;
                display:flex;
                flex-wrap:wrap;
                gap:5px;
            }

            .button-group button{
                flex:1 1 48%;
                padding:8px;
                background:#0f6b63;
                color:white;
                border:none;
                border-radius:6px;
                cursor:pointer;
            }

            .button-group button:hover{
                background:#094e49;
            }


            .table-section{
                flex:0 0 55%;
                background:white;
                border-radius:4px;
                box-shadow:0 0 5px rgba(0,0,0,0.2);
                padding:15px;
                height:100%; 
                display:flex;
                flex-direction:column;
                justify-content:flex-start;
                margin-left: -4px;
            }

            .table-section h3{
                margin:0 0 13px 0;

            }

            table{
                width:100%;
                border-collapse:collapse;
                font-size:12px;
            }

            th{
                background:#0f6b63;
                color:white;
                padding:8px;
                text-align:left;
            }

            td{
                border:1px solid #ccc;
                padding:7px;
                text-align:center;
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
                <h2>Admin's Portal</h2>
                <p>Username: Admin</p>
                <br> 
                <div class="menu">
                    <a href="CafePortalAdminPortal.php" class="menu-btn">Dashboard</a>
                    <a href="AddCashier.php" class="menu-btn">Add Cashier</a>
                    <a href="AddProduct.php" class="menu-btn">Add Product</a>
                    <a href="Customers.php" class="menu-btn">Customers</a>
                </div>

                <a href="CafePortalLogin.php" class="menu-btn logout">Logout</a>

            </div>

            <div class="main">
                <form method="post" action="AddCashierCode.php" enctype="multipart/form-data">
                    <div class="panel">

                        <div class="form-section">
                            <div class="image-box">
                                <img src="images/logohead-removebg-preview.png" id="preview"> 
                            </div>

                            <div class="import-wrapper">
                                <input type="file" id="fileInput" name="image" hidden><br>
                                <label for="fileInput" class="import-btn">Import</label>
                            </div>

                            <div class="form-group">
                                <label>Username:</label>
                                <input type="text" name="uname">
                            </div>

                            <div class="form-group">
                                <label>Password:</label>
                                <input type="password" name="pass">
                            </div>

                            <div class="form-group">
                                <label>Role:</label>
                                <select name="role">
                                    <option>Select Role</option>
                                    <option>Admin</option>
                                    <option>Cashier</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Status:</label>
                                <select name="status">
                                    <option>Select Status</option>
                                    <option>Active</option>
                                    <option>Approval</option>
                                </select>
                            </div>

                            <div class="button-group">
                                <button type="submit" name="action" value="Add">ADD</button>
                                <button type="submit" name="action" value="Update">UPDATE</button>
                                <button type="submit" name="action" value="Delete" style="background:#D32F2F;">DELETE</button>
                                <button type="reset" name="action" value="Clear">CLEAR</button>
                            </div>

                        </div>
                        <div class="table-section">
                            <h3>Data of Users</h3>
                            <table>
                                <tr>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Image</th>
                                    <!--<th>Date Registered</th>-->
                                </tr>

                                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>

                                        <td><?php echo $row['id']; ?></td>
                                        <td><?php echo $row['Username']; ?></td>
                                        <td><?php echo $row['Password']; ?></td>
                                        <td><?php echo $row['Role']; ?></td>
                                        <td><?php echo $row['Status']; ?></td>
                                        <td>
                                            <img src="images/<?php echo $row['Image']; ?>" width="30" height="20">
                                        </td>


                                    </tr>
                                <?php endwhile; ?>
                            </table>
                        </div>

                    </div>
                </form>

            </div>

        </div>
        <script>
            const fileInput = document.getElementById('fileInput');
                    const previewImage = document.getElementById('preview');
                    fileInput.onchange = function() {
                    const [file] = fileInput.files;
                            if (file) {

                    previewImage.src = URL.createObjectURL(file);
                    }
                    };
        </script>
    </body>
</html>
