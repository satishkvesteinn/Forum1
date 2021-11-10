


    <?php
    include '../partials/dbconnect.php';
    $id = $_GET['comment'];
     $sql =  "DELETE FROM `comments` WHERE comment_id = $id";
     $result = mysqli_query($conn, $sql);
     if($result){
     header("Location: /idiscuss/admin/deletepost.php");
     exit();}else{
         echo "Not deleted";
     }
    ?>