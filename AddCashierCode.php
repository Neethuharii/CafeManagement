<?php
$host="localhost";
$username="root";
$password="";
$database="cafe_management";

$con = mysqli_connect($host, $username, $password, $database);

if(!$con){
    die("Connection failed: " . mysqli_connect_error());
}

$Username=$_POST['uname'];
       $Password=$_POST['pass'];
       $Role=$_POST['role'];
       $Status=$_POST['status'];
       $action= $_POST['action'];




$newfilename = "";

if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
    $Image = $_FILES['image']['name'];
    $tmp = explode(".", $Image);
    $newfilename = round(microtime(true)) . '.' . end($tmp);
    $uploadpath = "images/" . $newfilename;
    move_uploaded_file($_FILES['image']['tmp_name'], $uploadpath);
}



if($action == "Add"){

    $sql = "INSERT INTO addcashier
            (Username, Password, Role, Status,Image)
            VALUES
            ('$Username','$Password','$Role','$Status','$newfilename')";

    if(mysqli_query($con, $sql)){
        echo "<script>
                alert('Inserted successfully');
                window.location.href='AddCashier.php';
              </script>";
    } else {
        die("Insert failed: " . mysqli_error($con));
    }
}



elseif($action == "Update"){

    if($newfilename != ""){
        $sql = "UPDATE addcashier SET
                Password='$Password',
                Role='$Role',
                Status='$Status',
                Image='$newfilename'
                WHERE Username='$Username'";
    } else {
        $sql = "UPDATE addcashier SET
       
                Password='$Password',
                Role='$Role',
                Status='$Status'
                WHERE Username='$Username'";
    }

    if(mysqli_query($con, $sql)){
        echo "<script>
                alert('Updated successfully');
                window.location.href='AddCashier.php';
              </script>";
    } else {
        die("Update failed: " . mysqli_error($con));
    }
}



elseif($action == "Delete"){

    $sql = "DELETE FROM addcashier WHERE Username='$Username'";

    if(mysqli_query($con, $sql)){
        echo "<script>
                alert('Deleted successfully');
                window.location.href='AddCashier.php';
              </script>";
    } else {
        die("Delete failed: " . mysqli_error($con));
    }
}

mysqli_close($con);
?>