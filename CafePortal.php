<?php
$host = "localhost";
$Username = "root";
$Password = "";
$database = "cafe_management";
$con = mysqli_connect($host, $Username, $Password, $database);

if (!$con) {
    die("Connection Failed" . mysqli_connect_error());
}

$result = mysqli_query($con, "SELECT * FROM addproduct");
$result1 = mysqli_query($con, "SELECT * FROM order_detail");

if (!$result) {
    die("Query Failed: " . mysqli_error($con));
}
if (!$result1) {
    die("Query Failed: " . mysqli_error($con));
}

$total = 0;
$orderData = [];

while ($row = mysqli_fetch_assoc($result1)) {
    $subtotal = $row['Price'];
    $total += $subtotal;
    $orderData[] = $row;
}

if (isset($_POST['pay-btn'])) {

    $total = $_POST['total'];
    $amountPaid = $_POST['amount_paid'];
    $change_amount = $_POST['change'];

    if ($amountPaid < $total) {

        echo "<script>alert('Amount paid is less than total!');</script>";
    } else {


        $sql = "INSERT INTO payment (total, amount_paid, change_amount) 
                VALUES ('$total', '$amountPaid', '$change_amount')";

        if (mysqli_query($con, $sql)) {


            $payment_id = mysqli_insert_id($con);


            $items = mysqli_query($con, "SELECT * FROM order_detail");

            while ($row = mysqli_fetch_assoc($items)) {

                $pid = $row['ProductId'];
                $pname = $row['ProductName'];
                $type = $row['Type'];
                $qty = $row['Quantity'];
                $price = $row['Price'];

                mysqli_query($con, "INSERT INTO order_history
                (payment_id,ProductId,ProductName,Type,Quantity,Price)
                VALUES
                ('$payment_id','$pid','$pname','$type','$qty','$price')");
            }


            mysqli_query($con, "DELETE FROM order_detail");


            echo "<script>
            alert('Payment successful!');
            window.open('Receipt.php?id=$payment_id','_blank');
            window.location.href='CafePortal.php';
            </script>";
        } else {

            die("Error occurred during payment: " . mysqli_error($con));
        }
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cashier Portal - Order</title>

        <style>

            *{
                margin:0;
                padding:0;
                box-sizing:border-box;
                font-family: Arial, sans-serif;
            }

            body{
                display:flex;
                height:100vh;
                background:#f4f6fb;
                overflow:hidden;
            }

            /* SIDEBAR */
            .sidebar{
                width:220px;
                background:#0f6b63;
                color:white;
                padding:20px 15px;
                display:flex;
                flex-direction:column;
            }
            .sidebar h3{
                margin-left: 25px;
            }
            .sidebar p{
                margin-left: 35px;
            }

            .logo{
                text-align:center;
                margin-bottom:15px;
            }

            .logo img{
                width:70px;
                height:70px;
                border-radius:50%;
                border:3px solid white;
            }

            .menu{
                flex:1;
            }

            .menu-btn{
                /*    display:block;
                    padding:8px;
                    margin-bottom:10px;
                    border:1px solid #ffffff80;
                    background:transparent;
                    color:white;
                    text-align:center;
                    border-radius:8px;
                    text-decoration:none;
                    font-size:13px;*/

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
                display:flex;
                gap:15px;
                padding:15px;
                overflow:hidden;
            }

            /* LEFT SECTION */
            .left-section{
                flex:2;
                display:flex;
                flex-direction:column;
                gap:15px;
                overflow:hidden;
            }

            /* MENU TABLE CARD */
            .card{
                height:55%;
                background:white;
                padding:12px;
                border-radius:10px;
                box-shadow:0 4px 10px rgba(0,0,0,0.1);
                display:flex;
                flex-direction:column;
            }

            .card table{
                width:100%;
                border-collapse:collapse;
                font-size:12px;
            }

            .card .table-wrapper{
                overflow:auto;
                flex:1;
            }

            th{
                background:#0f6b63;
                color:white;
                padding:6px;
                font-size:12px;
            }

            td{
                padding:6px;
                border-bottom:1px solid #ddd;
                font-size:12px;
            }

            /* ORDER FORM CARD */
            .card2{
                flex:1;
                background:white;
                padding:12px;
                border-radius:10px;
                box-shadow:0 4px 10px rgba(0,0,0,0.1);
            }

            .form-row{
                display:flex;
                gap:10px;
                margin-bottom:10px;
            }

            .form-group{
                flex:1;
                display:flex;
                flex-direction:column;
            }

            .form-group label{
                font-size:12px;
                margin-bottom:4px;
            }

            input, select{
                padding:6px;
                border:1px solid #ccc;
                border-radius:4px;
                font-size:12px;
            }

            .action-buttons{
                display:flex;
                gap:10px;
                margin-top:10px;
            }

            .action-buttons button{
                padding:8px 20px;
                border:none;
                border-radius:4px;
                background:#0f6b63;
                color:white;
                cursor:pointer;
                font-size:12px;
            }

            .action-buttons button:hover{
                background:#094e49;
            }

            /* RECEIPT RIGHT SIDE */
            .receipt{
                flex:1;
                background:linear-gradient(135deg,#ffffff,#f0f7f6);
                padding:18px;
                border-radius:12px;
                box-shadow:0 8px 20px rgba(0,0,0,0.12);
                display:flex;
                flex-direction:column;
                overflow:hidden;
                border:2px solid #0f6b63;
            }

            .receipt h3{
                text-align:center;
                color:#0f6b63;
                font-size:18px;
                margin-bottom:10px;
                margin-left: -270px;
            }

            /* Billing Table */
            .receipt table{
                width:100%;
                border-collapse:collapse;
                font-size:12px;
            }

            .receipt th{
                background:#0f6b63;
                color:white;
                padding:8px;
                font-size:12px;
            }

            .receipt td{
                padding:6px;
                border-bottom:1px solid #ddd;
                text-align:center;
            }

            .receipt .table-wrapper{
                flex:1;
                overflow:auto;
                margin-bottom:10px;
            }

            /* Billing Summary Box */
            .billing-info{
                background:#e8f5f3;
                padding:12px;
                border-radius:8px;
                font-size:14px;
                border:1px solid #0f6b63;
            }

            .billing-info p{
                margin:8px 0;
                display:flex;
                justify-content:space-between;
                align-items:center;
            }

            .billing-info input{
                width:120px;
                padding:6px;
                border-radius:5px;
                border:1px solid #ccc;
            }

            /* Total Highlight */
            .billing-info strong{
                font-size:16px;
                color:#0f6b63;
            }

            /* Change Highlight */
            #change{
                font-weight:bold;
                color:#2e7d32;
                font-size:15px;
            }

            /* Pay Button */
            .pay-btn{
                margin-top:12px;
                padding:10px;
                width:45%;
                border:none;
                border-radius:8px;
                background:linear-gradient(45deg,#0f6b63,#0a4e48);
                color:white;
                font-size:15px;
                font-weight:bold;
                cursor:pointer;
                transition:0.3s ease;
            }

            .receipt-btn{
                margin-top:-25px;
                margin-left: 25px;
                padding:10px;
                width:45%;
                border:none;
                border-radius:8px;
                background:linear-gradient(45deg,#0f6b63,#0a4e48);
                color:white;
                font-size:15px;
                font-weight:bold;
                cursor:pointer;
                transition:0.3s ease;
            }

            .pay-btn:hover{
                transform:scale(1.03);
                box-shadow:0 5px 15px rgba(0,0,0,0.2);
            }

        </style>
    </head>

    <body>

        <div class="sidebar">
            <div class="logo">
                <img src="images/Screenshot 2026-02-12 110430.png">
            </div>

            <h3>Cashier Portal</h3>
            <p style="font-size:12px;">Username: Cashier</p>
            <br>
            <br>
            <div class="menu">
                <a href="CafePortalHome.php" class="menu-btn">Dashboard</a>
                <a href="AddProduct_CashierPortal.php" class="menu-btn">Add Product</a>
                <a href="CafePortal.php" class="menu-btn">Order</a>
                <a href="Customer_CashierPortal.php" class="menu-btn">Customers</a>
            </div>

            <a href="CafePortalLogin.php" class="menu-btn logout">Logout</a>
        </div>

        <div class="main">

            <div class="left-section">

                <div class="card">
                    <h3>Menu Items</h3>
                    <br>
                    <div class="table-wrapper" id="orderForm">
                        <table>
                            <tr>
                                <th>ID</th>
                                <th>ProductID</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Stock</th>
                                <th>Price</th>
                                <th>Status</th>
                            </tr>

<?php while ($row = mysqli_fetch_assoc($result)): ?>
                                <tr>
                                    <td><?= $row['id']; ?></td>
                                    <td><?= $row['ProductId']; ?></td>
                                    <td><?= $row['ProductName']; ?></td>
                                    <td><?= $row['Type']; ?></td>
                                    <td><?= $row['Stock']; ?></td>
                                    <td><?= $row['Price']; ?></td>
                                    <td><?= $row['Status']; ?></td>
                                </tr>
<?php endwhile; ?>
                        </table>
                    </div>
                </div>

                <form method="post" action="CafePortalCode.php">
                    <div class="card2">
                        <h3>Order Details</h3>
                        <br>

                        <div class="form-row">
                            <div class="form-group">
                                <label>Type</label>
                                <select name="type" id="type">
                                    <option>Select Type</option>
                                    <option>Meal</option>
                                    <option>Drink</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Product ID</label>
                                <select name="prodId" id="prodId" onchange="fillData()">
                                    <option value="">Select Product</option>

<?php
mysqli_data_seek($result, 0);
while ($row = mysqli_fetch_assoc($result)) {
    ?>

                                        <option 
                                            value="<?= $row['ProductId']; ?>"
                                            data-name="<?= $row['ProductName']; ?>"
                                            data-type="<?= $row['Type']; ?>"
                                            data-price="<?= $row['Price']; ?>"
                                            >
    <?= $row['ProductId']; ?> - <?= $row['ProductName']; ?>
                                        </option>

                                        <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label>Product Name</label>
                                <input type="text" name="prodName" id="prodName">
                            </div>

                            <div class="form-group">
                                <label>Quantity</label>
                                <input type="number" name="qty" id="qty"  min="1">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">

                                <label>Price</label>
                                <input type="number" id="price" name="price" readonly>

                                <input type="hidden" id="basePrice">
                            </div>


                        </div>

                        <div class="action-buttons">
                            <button type="submit" name="action" value="Add">Add</button>
                            <button type="submit" name="action" style="background:#D32F2F;" value="Delete">Delete</button>
                            <button type="reset" >Clear</button>
                        </div>
                    </div>
                </form>

            </div>

            <div class="receipt">
                <h3>Billing</h3>
                <br>

                <div class="table-wrapper">
                    <table>
                        <tr>

                            <th>PID</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Qty</th>
                            <th>Price</th>
                        </tr>

<?php foreach ($orderData as $row): ?>
                            <tr>

                                <td><?= $row['ProductId']; ?></td>
                                <td><?= $row['ProductName']; ?></td>
                                <td><?= $row['Type']; ?></td>
                                <td><?= $row['Quantity']; ?></td>
                                <td><?= $row['Price']; ?></td>
                            </tr>
<?php endforeach; ?>
                    </table>
                </div>

                <div class="billing-info">
                    <form method="post">
                        <p>
                            <strong>Total:</strong>
                            <strong>₹<span id="totalAmountDisplay"><?= $total; ?></span></strong>
                            <input type="hidden" name="total" id="totalAmount" value="<?= $total; ?>">
                        </p>

                        <p>
                            Amount Paid:
                            <input type="number" name="amount_paid" step="0.01" id="amount_paid" placeholder="Enter amount">
                        </p>

                        <p>
                            Change:
                            <span id="change">₹0.00</span>
                            <input type="hidden" name="change" id="hiddenChange" value="0">
                        </p>

                        <button class="pay-btn" name="pay-btn">Pay Now</button>
                        <button class="pay-btn" onclick="window.open('Receipt.php', '_blank')">Receipt</button>
                    </form>
                </div>

            </div>

        </div>
        <script>
                    const amountInput = document.getElementById("amount_paid");
                    const changeDisplay = document.getElementById("change");
                    const totalAmount = parseFloat(document.getElementById("totalAmount").value);
                    const hiddenChange = document.getElementById("hiddenChange");
                    amountInput.addEventListener("input", function() {
                    let paid = parseFloat(this.value);
                            let change = paid - totalAmount;
                            if (!isNaN(paid)) {
                    if (change < 0) {
                    changeDisplay.style.color = "red";
                            changeDisplay.innerText = "Insufficient";
                            hiddenChange.value = 0;
                    } else {
                    changeDisplay.style.color = "green";
                            changeDisplay.innerText = "₹" + change.toFixed(2);
                            hiddenChange.value = change.toFixed(2);
                            Document.getElementById("orderForm").reset();
                    }
                    } else {
                    changeDisplay.innerText = "₹0.00";
                            hiddenChange.value = 0;
                    }
                    });
// Auto fill product details
                    function fillData(){

                    var select = document.getElementById("prodId");
                            var option = select.options[select.selectedIndex];
                            if (option.value !== ""){

                    // Get product data
                    var type = option.getAttribute("data-type");
                            var name = option.getAttribute("data-name");
                            var price = option.getAttribute("data-price");
                            // Fill inputs
                            document.getElementById("type").value = type;
                            document.getElementById("prodName").value = name;
                            // Store original price
                            document.getElementById("basePrice").value = price;
                            // Show price
                            document.getElementById("price").value = price;
                    }
                    else{

                    document.getElementById("type").value = "";
                            document.getElementById("prodName").value = "";
                            document.getElementById("price").value = "";
                            document.getElementById("basePrice").value = "";
                    }
                    }


// Quantity change → update price
            document.getElementById("qty").addEventListener("input", function(){

            var qty = parseInt(this.value);
                    var basePrice = parseFloat(document.getElementById("basePrice").value);
                    if (!isNaN(qty) && !isNaN(basePrice)){

            var total = qty * basePrice;
                    document.getElementById("price").value = total;
            }

            });
        </script>
    </body>
</html>