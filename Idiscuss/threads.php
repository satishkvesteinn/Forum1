<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>idisucss - welcome back</title>
</head>

<body>
<?php include 'partials/dbconnect.php';?>
    <?php include 'partials/header.php';?>


    <?php
    $id = $_GET['catid'];
     $sql =  "SELECT * FROM `categories` WHERE category_id=$id";
     $result = mysqli_query($conn, $sql);
     while($row = mysqli_fetch_assoc($result)){
         $catname = $row['category_name'];
         $catdesc = $row['category_description'];
     }

    ?>

    <?php
    $showAlert = false;
     $method = $_SERVER['REQUEST_METHOD'];
        if($method == 'POST'){
            $th_tittle = $_POST['tittle'];
            $th_tittle = str_replace("<","&lt;",$th_tittle);
            $th_tittle = str_replace(">","&gt;",$th_tittle);
            $th_desc = $_POST['desc'];
            $th_desc = str_replace("<","&lt;",$th_desc);
            $th_desc = str_replace(">","&gt;",$th_desc);
            $sno = $_POST['sno'];
            $sql =  "INSERT INTO `threads` (`thread_tittle`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$th_tittle', '$th_desc', '$id', '$sno', CURRENT_TIMESTAMP)
            ";
            $result = mysqli_query($conn, $sql);
            // $th_desc = "";
            // $th_tittle = "";
            $showAlert = true;
            if($showAlert){
                echo '<div class="alert alert-success" role="alert">
                your post was submit
              </div>';
            }
        }

    ?>

    <!-- category container is start -->
    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-5">Welcome to <?php echo $catname ?> Fourm</h1>
            <p class="lead"><?php echo $catdesc ?></p>
            <hr class="my-4">
            <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
        </div>
    </div>
<input type="hidden" name="">
    <?php
      if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
echo '
<div class="container">
    <h2>Start a Discussion</h2>
    <form ' .$_SERVER["REQUEST_URI"] .' method="post">
        <div class="mb-3">
            <label for="tittle" class="form-label">Tittle</label>
            <input type="text" class="form-control" id="tittle" name="tittle" aria-describedby="tittleHelp">
        </div>
        <div class="form-group">
            <label for="desc">Ellaborate your concern</label>
            <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
            <input type="hidden" name="sno" value="'. $_SESSION["sno"] .'">
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
</div>';
}else{
    echo '<div class="container">
    <h2>Start a Discussion</h2>
        <p class="lead">you are not loggedin. Please first Login for start discussion</p>
    </div>';
}

?>


    <div class="container">
        <h2 class="py-2">Browse Questions</h2>
        <?php
    $id = $_GET['catid'];
     $sql =  "SELECT * FROM `threads` WHERE thread_cat_id = $id";
     $result = mysqli_query($conn, $sql);
     $noResult = true;
     while($row = mysqli_fetch_assoc($result)){
         $noResult = false;
         $id= $row['thread_id'];
         $tittle = $row['thread_tittle'];
         $desc = $row['thread_desc'];
         $thread_user_id = $row['thread_user_id'];

        $sql2 = "SELECT full_name FROM `users` WHERE  sno = '$thread_user_id'";
        $result2 = mysqli_query($conn , $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        

        echo '<div class="media my-4">
            <img src="https://www.pngitem.com/pimgs/m/150-1503945_transparent-user-png-default-user-image-png-png.png" width="54px" class="mr-3" alt="...">
            <div class="media-body">' . ' 
                <h5 class="mt-0 my-0"><a class="text-dark" href="thread.php?threadid=' . $id . '"> ' . $tittle . '</a></h5> '. $desc . '
            </div>'.' <p class="font-weight-bold"> ask by ' . $row2['full_name'] . ' </p>
        </div>';
     }
    //  echo var_dump($noResult);
     if($noResult){
         echo '<div class="jumbotron jumbotron-fluid">
         <div class="container">
           <h1 class="display-6">No threads found</h1>
           <p class="lead">Be the First person for asking first Question</p>
         </div>
       </div>';
     }

?>


        <!-- <div class="media my-4">
            <img src="https://www.pngitem.com/pimgs/m/150-1503945_transparent-user-png-default-user-image-png-png.png" width="100px" class="mr-3" alt="...">
            <div class="media-body">
                <h5 class="mt-0">Media heading</h5>
                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus
                odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate
                fringilla. Donec lacinia congue felis in faucibus.
            </div>
        </div> -->
    </div>

    <?php include 'partials/footer.php';?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>