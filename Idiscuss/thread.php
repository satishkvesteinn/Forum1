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

    <?php include 'partials/header.php';?>
    <?php include 'partials/dbconnect.php';?>

    <?php
    $id = $_GET['threadid'];
     $sql =  "SELECT * FROM `threads` WHERE thread_id= $id";
     $result = mysqli_query($conn, $sql);
     while($row = mysqli_fetch_assoc($result)){
         $tittle = $row['thread_tittle'];
         $desc = $row['thread_desc'];
         $thread_user_id = $row['thread_user_id'];

         $sql2 = "SELECT user_names FROM `users` WHERE  sno = '$thread_user_id'";
         $result2 = mysqli_query($conn , $sql2);
         $row2 = mysqli_fetch_assoc($result2);
     }

    ?>

    <?php
    $showAlert = false;
     $method = $_SERVER['REQUEST_METHOD'];
        if($method == 'POST'){
            $comment = $_POST['comment'];
            $comment = str_replace("<","&lt;",$comment);
            $comment = str_replace(">","&gt;",$comment);
            $sno = $_POST['sno'];
            // $th_desc = $_POST['desc'];
            $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$comment', '$id', '$sno', CURRENT_TIMESTAMP);";
            $result = mysqli_query($conn, $sql);
            $showAlert = true;
            if($showAlert){
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success ! </strong>Post was successfuly submitted
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
            }
        }
    ?>

    <!-- category container is start -->
    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4">
                <?php echo $tittle; ?>
            </h1>
            <p class="lead">
                <?php echo $desc; ?>
            </p>
            <hr class="my-4">
            <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
            <h5><b>Posted by : <?php echo $row2['user_names']; ?></b></h5>
        </div>
    </div>


    <?php
      if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
echo '
<div class="container">
        <h2>Post a comment</h2>
        <form '. $_SERVER["REQUEST_URI"] .' method="post">
            <div class="form-group">
                <label for="comment">Type your comment</label>
                <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                <input type="hidden" name="sno" value="'. $_SESSION["sno"] .'">
            </div>
            <button type="submit" class="btn btn-success">Post comment</button>
        </form>
    </div>';
}else{
    echo '<div class="container">
    <h2>Post a comment</h2>
        <p class="lead">you are not loggedin. Please first Login for start discussion</p>
    </div>';
}

?>


    <div class="container">
        <h2 class="py-2">Discussions</h2>
        <?php
            $id = $_GET['threadid'];
            $sql =  "SELECT * FROM `comments` WHERE thread_id=$id";
            $result = mysqli_query($conn, $sql);
            $noResult = true;
            while($row = mysqli_fetch_assoc($result)){
            $noResult = false;

            $id = $row['comment_id'];
            $content = $row['comment_content'];
            $comment_time = $row['comment_time'];
            $thread_user_id = $row['comment_by'];

            $sql2 = "SELECT user_names FROM `users` WHERE  sno = '$thread_user_id'";
        $result2 = mysqli_query($conn , $sql2);
        $row2 = mysqli_fetch_assoc($result2);

            echo '<div class="media my-4">
                <img src="https://www.pngitem.com/pimgs/m/150-1503945_transparent-user-png-default-user-image-png-png.png" width="54px" class="mr-3" alt="...">
                <div class="media-body">
                <p class="font-weight-bold my-0">Answered by ' . $row2['user_names'].'</p>
                    ' . $content . '
                </div>
            </div>';
     }


    //  echo var_dump($noResult);
     if($noResult){
        echo '<div class="jumbotron jumbotron-fluid">
        <div class="container">
          <h1 class="display-6">No threads found</h1>
          <p class="lead">Be the First person for Answering this Question</p>
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