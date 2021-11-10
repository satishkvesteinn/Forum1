


    <?php
    include '../partials/dbconnect.php';
    $id = $_GET['userid'];
     $sql =  "DELETE FROM `users` WHERE sno = $id";
     $result = mysqli_query($conn, $sql);
     if($result){
     header("Location: /idiscuss/admin/allusertable.php");
     exit();}else{
         echo "Not deleted";
     }
    ?>