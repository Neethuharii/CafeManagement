<?php
$host = "localhost";
$Username = "root";
$Password = "";
$database = "cafe_management";
$con = mysqli_connect($host, $Username, $Password, $database);

if (!$con) {
    die("Connection Failed: " . mysqli_connect_error());
}

$payment = mysqli_query($con, "SELECT * FROM payment ORDER BY id DESC LIMIT 1");
if (mysqli_num_rows($payment) == 0) {
    die("No payment found.");
}
$paymentData = mysqli_fetch_assoc($payment);
$payment_id = $paymentData['id'];


$orderItems = mysqli_query($con, "SELECT * FROM order_history WHERE payment_id='$payment_id'");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cafe Receipt</title>
    <style>
        body {
            font-family: 'Courier New', monospace;
            max-width: 300px;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
        }
        h2, h3, p {
            text-align: center;
            margin: 4px 0;
        }
        hr {
            border: 0;
            border-top: 1px dashed #000;
            margin: 8px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }
        th, td {
            text-align: left;
            padding: 2px 0;
        }
        th {
            border-bottom: 1px dashed #000;
        }
        tfoot td {
            border-top: 1px dashed #000;
            font-weight: bold;
        }
        .right {
            text-align: right;
        }
        button {
            display: block;
            margin: 15px auto 0;
            padding: 8px 20px;
            font-size: 14px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<h2>Cafe Receipt</h2>
<p>Payment ID: <?= $payment_id; ?></p>
<hr>

<table>
    <thead>
        <tr>
            <th>Item</th>
            <th class="right">Qty</th>
            <th class="right">Price</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($row = mysqli_fetch_assoc($orderItems)) {
            echo "<tr>
                <td>{$row['ProductName']}</td>
                <td class='right'>{$row['Quantity']}</td>
                <td class='right'>₹{$row['Price']}</td>
            </tr>";
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <td>Total</td>
            <td></td>
            <td class="right">₹<?= $paymentData['total']; ?></td>
        </tr>
        <tr>
            <td>Paid</td>
            <td></td>
            <td class="right">₹<?= $paymentData['amount_paid']; ?></td>
        </tr>
        <tr>
            <td>Change</td>
            <td></td>
            <td class="right">₹<?= $paymentData['change_amount']; ?></td>
        </tr>
    </tfoot>
</table>

<hr>
<p style="text-align:center;">Thank you for your visit!</p>

<button onclick="window.print()">Print</button>

</body>
</html>