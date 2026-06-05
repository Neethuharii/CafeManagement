<?php
$host="localhost";
$username="root";
$password="";
$database="cafe_management";

$con = mysqli_connect($host, $username, $password, $database);

if(!$con){
    die("Connection failed: " . mysqli_connect_error());
}

$ProductId   = $_POST['prodId'];
$Stock       = $_POST['stock'];
$ProductName = $_POST['prodName'];
$Price       = $_POST['price'];
$Type        = $_POST['type'];
$Status      = $_POST['status'];
$DeleteId    = $_POST['delete_id'];
$action      = $_POST['action'];


$newfilename = "";

if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
    $Image = $_FILES['image']['name'];
    $tmp = explode(".", $Image);
    $newfilename = round(microtime(true)) . '.' . end($tmp);
    $uploadpath = "images/" . $newfilename;
    move_uploaded_file($_FILES['image']['tmp_name'], $uploadpath);
}



if($action == "Add"){

    $sql = "INSERT INTO addproduct
            (ProductId, Stock, ProductName, Price, Type, Status, Image)
            VALUES
            ('$ProductId','$Stock','$ProductName','$Price','$Type','$Status','$newfilename')";

    if(mysqli_query($con, $sql)){
        echo "<script>
                alert('Inserted successfully');
                window.location.href='AddProduct_CashierPortal.php';
              </script>";
    } else {
        die("Insert failed: " . mysqli_error($con));
    }
}



elseif($action == "Update"){

    if($newfilename != ""){
        $sql = "UPDATE addproduct SET
                Stock='$Stock',
                ProductName='$ProductName',
                Price='$Price',
                Type='$Type',
                Status='$Status',
                Image='$newfilename'
                WHERE ProductId='$ProductId'";
    } else {
        $sql = "UPDATE addproduct SET
                Stock='$Stock',
                ProductName='$ProductName',
                Price='$Price',
                Type='$Type',
                Status='$Status'
                WHERE ProductId='$ProductId'";
    }

    if(mysqli_query($con, $sql)){
        echo "<script>
                alert('Updated successfully');
                window.location.href='AddProduct_CashierPortal.php';
              </script>";
    } else {
        die("Update failed: " . mysqli_error($con));
    }
}



elseif($action == "Delete"){

    $sql = "DELETE FROM addproduct WHERE id='$DeleteId'";

    if(mysqli_query($con, $sql)){
        echo "<script>
                alert('Deleted successfully');
                window.location.href='AddProduct_CashierPortal.php';
              </script>";
    } else {
        die("Delete failed: " . mysqli_error($con));
    }
}

mysqli_close($con);
?>