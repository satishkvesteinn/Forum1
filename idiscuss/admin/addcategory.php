<?php session_start();?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>idisucss - welcome back</title>
</head>

<body>
    <?php include '../partials/dbconnect.php';?>
    
    <?php
       
        if(isset($_SESSION['loggedin']) && ($_SESSION['loggedin'] == true)){
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                include '../partials/dbconnect.php';
                $addtittle = $_REQUEST['addtittle'];
                $description = $_REQUEST['description'];
                if(empty($addtittle) && empty($description)){
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> Write something.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
                }else if(!empty($addtittle) && !empty($description)){
                $sql = "INSERT INTO `categories` (`category_name`, `category_description`, `category_created`) VALUES ('$addtittle', '$description', CURRENT_TIMESTAMP)";
                $result = mysqli_query($conn , $sql);
                header("Location: /idiscuss/admin/index.php?categorysuccess=true");
                exit();
            }else{
                header("Location: /idiscuss/admin/index.php?categorysuccess=false");
                }
        }
    }else{
        header("Location: /idiscuss/admin/index.php?categorysuccess=false");
    }
  ?>
<?php
        if(isset($_SESSION['loggedin']) && ($_SESSION['loggedin'] == true)){
    echo '<div class="container">
    <div class="mt-3 text-center"><h3><b>Add Category</b></h3></div>
        <div class="row d-flex justify-content-center mt-4" >
            <div class="col-8 p-5" style="box-shadow: 0px 0px 2px 2px grey;">
                <form action="'. $_SERVER["PHP_SELF"] .'" method="post">
                    <div class="mb-3">
                        <label for="addtittle" class="form-label">
                            <h5>Tittle</h5>
                        </label>
                        <input type="text" class="form-control" id="addtittle" name="addtittle" placeholder="e.g. Python">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">
                            <h5>Description</h5>
                        </label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <button class="btn btn-primary">Add Category</button>
                </form>
                <div class="mt-3 d-flex justify-content-end">
                    <a class="btn btn-primary" role="button" href="index.php">Go back</a>
                </div>
            </div>
        </div>
    </div>';
        }else{
            header("Location: /idiscuss/admin/index.php");
        }
    ?>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>