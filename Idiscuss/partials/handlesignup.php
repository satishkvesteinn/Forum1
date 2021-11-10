<?php
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'dbconnect.php';
    $full_name = $_POST['fullname'];
    $user_name = $_POST['username'];
    $user_question = $_POST['question'];
    $user_answer = $_POST['answer'];
    $user_email = $_POST['signupEmail'];
    $pass = $_POST['signupPassword'];
    $cpass = $_POST['signupcPassword'];

    // cheaking wheather this email exisit
    $existsql = "SELECT * FROM `users` WHERE user_names = '$user_name' OR user_email = '$user_email'";
    $result = mysqli_query($conn, $existsql);
    $numRows = mysqli_num_rows($result);
    // $showError = false;
    if($numRows>0){
        header("Location: /idiscuss/index.php?signupsuccess=false");
    }else {
        if($pass == $cpass){
            $hash =  password_hash($pass , PASSWORD_DEFAULT);
            // $sql = "INSERT INTO `users` (`user_email`, `user_pass`, `timestamp`) VALUES ('$user_email', '$hash', current_timestamp())";
            $sql = "INSERT INTO `users` (`full_name`,`user_names`,`user_question`,`user_answer`,`user_email`, `user_pass`, `timestamp`) VALUES ('$full_name','$user_name','$user_question','$user_answer','$user_email', '$hash', CURRENT_TIMESTAMP)";
            $result = mysqli_query($conn , $sql);
            if($result){
                $showAlert = true;
                echo "submitted";
                header("Location: /idiscuss/index.php?signupsuccess=true");
                exit();
            }
        }
    }
    header("Location: /idiscuss/index.php?signupsuccess=false");
}

?>