<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "cafe_management";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$result = mysqli_query($conn, "SELECT * FROM addproduct");

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Cashier Portal - Add Product</title>

        <style>
            *{
                margin:0;
                padding:0;
                box-sizing:border-box;
                font-family: Arial, Helvetica, sans-serif;
            }

            html, body{
                height:100%;
                overflow:hidden;
                background:#d4d2d2;
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
                height:35px;
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
            }

            /* MAIN */
            .main{
                flex:1;
                padding:20px;
                background:white;
                display:flex;
                flex-direction:column;
            }

            .main h2{
                margin-bottom:10px;
                font-size:20px;
            }

            /* TABLE */
            .table-container{
                border:1px solid #ccc;
                flex:1;
                overflow:auto;
                box-shadow:0 0 5px rgba(0,0,0,0.1);
                border-radius:10px;
                margin-bottom:15px;
            }

            table{
                width:100%;
                border-collapse:collapse;
                font-size:13px;
            }

            th, td{
                border:1px solid #ccc;
                padding:6px;
                text-align:center;
            }

            th{
                background:#0f6a63;
                color:white;
            }

            /* FORM SECTION */
            .form-section{
                display:flex;
                justify-content:space-between;
                border:1px solid #ccc;
                box-shadow:0 0 5px rgba(0,0,0,0.1);
                border-radius:10px;
                padding:15px;
                height:305px;
            }

            /* LEFT FORM */
            .form-left{
                flex:1;
                display:flex;
                flex-direction:column;
                justify-content:space-between;
                margin-right:20px;
            }

            .form-grid{
                display:grid;
                grid-template-columns: 1fr 1fr; 
                gap:12px 25px; 
            }

            .form-group{
                display:flex;
                flex-direction:column;
            }

            .form-group label{
                font-weight:bold;
                margin-bottom:5px;
                font-size:13px;
            }

            .form-group input,
            .form-group select{
                padding:6px;
                border:1px solid #ccc;
                border-radius:4px;
                font-size:13px;
            }

            /* DELETE FIELD FIT FIX */
            .delete-group{
                background:#FFF5F5;
                padding:5px;
                border-radius:4px;
            }

            /* BUTTONS */
            .buttons{
                margin-top:10px;
                display:flex;
                gap:10px;
                flex-wrap:wrap;
            }

            .buttons button{
                padding:8px 18px;
                background:#0f6a63;
                color:white;
                border:none;
                cursor:pointer;
                border-radius:4px;
            }

            .buttons button:hover{
                background:#094e49;
            }

            /* RIGHT IMAGE */
            .form-right{
                width:200px;
                display:flex;
                flex-direction:column;
                align-items:center;
                justify-content:flex-start;
            }

           .image-box {
                width: 120px; 
                height: 130px; 
                background: #cfcfcf; 
                margin: 10px auto; /* Centers the box */
                overflow: hidden; /* Ensures image stays inside the box */
                display: flex;
                align-items: center;
                justify-content: center;
                border: 1px solid #ccc;
            }

            .image-box img {
                width: 100%;
                height: 100%;
               object-fit: cover; /* This makes the image fit nicely without stretching */
                margin: 0; /* Remove those negative margins */
            }


            .import-wrapper{
                text-align:center;
                margin-top:10px;
            }

            .import-btn{
                padding:6px 36px;
                background:#0f6b63;
                color:white;
                border-radius:4px;
                cursor:pointer;
                margin-left:1px;
            }

            .import-btn:hover{
                background:#45a049;
            }
        </style>
    </head>

    <body>

        <div class="container">

            <!-- SIDEBAR -->
            <div class="sidebar">
                <div class="logo">
                    <img src="images/Screenshot 2026-02-12 110430.png">
                </div>
                <br>
                <h2>Cashier's Portal</h2>
                <p>Username: Cashier</p>
                <br>
                <div class="menu">
                    <a href="CafePortalHome.php" class="menu-btn">Dashboard</a>
                    <a href="AddProduct_CashierPortal.php" class="menu-btn">Add Product</a>
                    <a href="CafePortal.php" class="menu-btn">Orders</a>
                    <a href="Customer_CashierPortal.php" class="menu-btn">Customers</a>
                </div>

                <a href="CafePortalLogin.php" class="menu-btn logout">Logout</a>
            </div>

            <!-- MAIN -->
            <div class="main">

                <h2>Data of Products</h2>

                <div class="table-container">
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Product ID</th>
                            <th>Product Name</th>
                            <th>Type</th>
                            <th>Stock</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Image</th>
                            <th>DateInsert</th>
                            <th>DateUpdate</th>
                        </tr>

                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['ProductId']; ?></td>
                                <td><?php echo $row['ProductName']; ?></td>
                                <td><?php echo $row['Type']; ?></td>
                                <td><?php echo $row['Stock']; ?></td>
                                <td><?php echo $row['Price']; ?></td>
                                <td><?php echo $row['Status']; ?></td>
                               <td>
<img src="images/<?php echo $row['Image']; ?>" width="30" height="20">
</td>
                                <td><?php echo $row['DateInsert']; ?></td>
                                <td><?php echo $row['DateUpdate']; ?></td>

                            </tr>
                        <?php endwhile; ?>
                    </table>
                </div>

                <form method="post" action="AddProduct_CashierPortalCode.php" enctype="multipart/form-data">

                    <div class="form-section">

                        <div class="form-left">

                            <div class="form-grid">

                                <div class="form-group">
                                    <label>Product ID</label>
                                    <input type="text" name="prodId">
                                </div>

                                <div class="form-group">
                                    <label>Stock</label>
                                    <input type="number" name="stock">
                                </div>

                                <div class="form-group">
                                    <label>Product Name</label>
                                    <input type="text" name="prodName">
                                </div>

                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="number" name="price">
                                </div>

                                <div class="form-group">
                                    <label>Type</label>
                                    <select name="type">
                                        <option>Select Type</option>
                                        <option>Drink</option>
                                        <option>Food</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status">
                                        <option>Select Status</option>
                                        <option>Available</option>
                                        <option>Unavailable</option>
                                    </select>
                                </div>

                                <div class="form-group delete-group">
                                    <label style="color:#D32F2F;">ID to Delete</label>
                                    <input type="text" name="delete_id" placeholder="Enter ID ">
                                </div>

                            </div>

                            <div class="buttons">
                                <button type="submit" name="action" value="Add">Add</button>
                                <button type="submit" name="action" value="Update">Update</button>
                                <button type="submit" name="action" value="Delete" style="background:#D32F2F;">Delete</button>
                                <button type="reset" >Clear</button>
                            </div>

                        </div>

                        <div class="form-right">
                            <div class="image-box">
                                <img src="images/logohead-removebg-preview.png" id="preview"> 
                            </div>

                            <div class="import-wrapper">
                                <input type="file" id="fileInput" name="image" hidden>
                                <label for="fileInput" class="import-btn">Import</label>
                            </div>
                        </div>

                    </div>
                </form>

            </div>
        </div>
 <script>
    const fileInput = document.getElementById('fileInput');
    const previewImage = document.getElementById('preview');

    fileInput.onchange = function() {
        // Check if a file was actually selected
        if (fileInput.files && fileInput.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                // Set the image src to the result of the file reader
                previewImage.src = e.target.result;
            }

            reader.readAsDataURL(fileInput.files[0]);
        }
    };
</script>
    </body>
</html>