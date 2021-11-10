<?php

    $showError = "false";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        include 'dbconnect.php';
        $user_name = $_POST['username'];
        $pass = $_POST['loginPass'];

        $sql = "SELECT * FROM `users` WHERE user_names = '$user_name'";
        $result = mysqli_query($conn, $sql);
        $numRows = mysqli_num_rows($result);
        if($numRows == 1){
            $row = mysqli_fetch_assoc($result);
            if(password_verify($pass , $row['user_pass'])){
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['sno'] = $row['sno'];
                $_SESSION['user_name'] = $user_name;
                header("Location: /idiscuss/index.php?loginsuccess=true");
                exit();
            } else{
                header("Location: /idiscuss/index.php?loginsuccess=false");
                exit();
            }   
        }else {
            header("Location: /idiscuss/index.php?loginsuccess=false");
        }
    }

?>