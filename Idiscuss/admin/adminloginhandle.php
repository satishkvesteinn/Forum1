<?php

    $showError = "false";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        include '../partials/dbconnect.php';
        $admin_email = $_POST['admin_email'];
        $pass = $_POST['admin_pass'];

        $sql = "SELECT * FROM `admin` WHERE admin_email = '$admin_email'";
        $result = mysqli_query($conn, $sql);
        $numRows = mysqli_num_rows($result);
        if($numRows == 1){
            $row = mysqli_fetch_assoc($result);
            if($pass == $row['admin_pass']){
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['sno'] = $row['sno'];
                $_SESSION['admin_name'] = $admin_name;
                header("Location: /idiscuss/admin/index.php?loginsuccess=true");// echo "loggedin";
                exit();
            } else{
                header("Location: /idiscuss/admin/adminlogin.php?loginsuccess=false");
                exit();
            }   
        }else {
            header("Location: /idiscuss/admin/adminlogin.php?loginsuccess=false");
        }
    }

?>