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


<?php session_start(); ?>

<?php

if(isset($_SESSION['loggedin']) && ($_SESSION['loggedin'] == true)){
         if($_SERVER["REQUEST_METHOD"] == "POST"){ 
                $idss = $_GET['caid'];    
                include '../partials/dbconnect.php';
                $desc = $_REQUEST['description'];
                $desc = str_replace("<","&lt;",$desc);
                $desc = str_replace(">","&gt;",$desc);
                $sql1 = "UPDATE `categories` SET `category_description`= '$desc' WHERE `category_id`= $idss";
                    if(mysqli_query($conn, $sql1)){
                        header("Location: /idiscuss/admin/index.php?updatesuccess=true");
                    }else{
                        header("Location: /idiscuss/admin/index.php?updatesuccess=false");
                    }
                    // mysqli_close($conn);
         }
        }  
?>

   <?php
   if(isset($_SESSION['loggedin']) && ($_SESSION['loggedin'] == true)){
include '../partials/dbconnect.php';
         $id = $_GET['catid'];
         $sql = "SELECT * FROM `categories` WHERE category_id = $id";
         $result = mysqli_query($conn , $sql);
         $row = mysqli_fetch_assoc($result);
            $ids = $row['category_id'];
            $cat = $row['category_name'];
            $desc = $row['category_description'];
            echo ' <div class="text-center mt-4 mb-3"><h3><b>Edit Category</b></h3></div> <div class="container d-flex justify-content-center">
           
                <div class="col-8 bg-info">
                    <div class="card-body">
                         
                              <form action="categoryadminedit.php?caid='.$ids.'" method="post">
                                  <div class="mb-3">
                                      <label for="addtittle" class="form-label">
                                          <h5>Tittle</h5>
                                      </label>
                                      <input type="text" class="form-control" id="addtittle" name="addtittle"  placeholder="'. $cat .'" readonly>
                                  </div>
                                  <div class="mb-3">
                                      <label for="description" class="form-label">
                                          <h5>Description</h5>
                                      </label>
                                      <textarea class="form-control" id="description" name="description" rows="3">'. $desc .'</textarea>
                                  </div>
                                  <button type="submit" class="btn btn-primary">Update</button>
                              </form>
                        
                      </div>
                  </div>
            </div>';}else{
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