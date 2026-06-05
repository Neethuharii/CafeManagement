<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $host="localhost";
        $username="root";
        $password="";
        $database="cafe_management";
       
       $con=  mysqli_connect($host, $username, $password, $database);
      
       
       $Type=$_POST['type']; 
       $ProductId=$_POST['prodId'];
       $ProductName=$_POST['prodName']; 
       $Quantity=$_POST['qty'];
       $Price=$_POST['price']; 
       $Cid=$_POST['cid']; 
      
      $sql = "INSERT INTO order_detail(Type,ProductId,ProductName,Quantity,Price,cid) values('$Type','$ProductId','$ProductName','$Quantity','$Price','$Cid')";
      

      
        if(mysqli_query($con, $sql)){
             
          echo "<script>
                alert('Inserted successfully');
                window.location.href='CafePortal.php';
              </script>";
        }
        else{
            die("Not inserted");
        }
      
        mysqli_close($con);
        ?>
    </body>
</html>
