<?php
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'dbconnect.php';
    $admin_name = $_POST['adminname'];
    $admin_username = $_POST['username'];
    $admin_email = $_POST['signupEmail'];
    $pass = $_POST['signupPassword'];
    $cpass = $_POST['signupcPassword'];

    // cheaking wheather this email exisit
    $existsql = "SELECT * FROM `admin` WHERE admin_name = '$admin_name' AND admin_email = '$admin_email'";
    $result = mysqli_query($conn, $existsql);
    $numRows = mysqli_num_rows($result);
    // $showError = false;
    if($numRows>0){
        header("Location: /idiscuss/admin/index.php?signupsuccess=false");
    }else{
        if($pass == $cpass){
            $hash =  password_hash($pass , PASSWORD_DEFAULT);
            $sql = "INSERT INTO `admin` (`admin_name`, `admin_email`, `admin_pass`, `admin_username`, `admin_time`) VALUES ('$admin_name', '$admin_email', '$hash', '$admin_username', CURRENT_TIMESTAMP)";
            $result = mysqli_query($conn , $sql);
            if($result){
                $showAlert = true;
                echo "submitted";
                header("Location: /idiscuss/admin/index.php?signupsuccess=true");
                exit();
            }
        }
    }
    header("Location: /idiscuss/admin/index.php?signupsuccess=false");
}

?>