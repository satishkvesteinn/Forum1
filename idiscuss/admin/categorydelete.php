<div class="container">
    <?php
    session_start();
    if(isset($_SESSION['loggedin']) && ($_SESSION['loggedin'] == true)){
    include '../partials/dbconnect.php';
    if(isset($_GET['catid'])){
    $id = $_GET['catid'];
     $sql =  "DELETE FROM `categories` WHERE category_id = $id";
     $result = mysqli_query($conn, $sql);
     if($result){
     header("Location: /idiscuss/admin/index.php");
    }else{
        header("Location: /idiscuss/admin/index.php");
     }
    }
    }else{
        header("Location: /idiscuss/admin/index.php");
    }
    ?>
</div>