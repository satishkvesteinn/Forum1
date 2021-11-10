


<!-- admin nav bar -->

<?php
    include '../partials\dbconnect.php';
    session_start();
echo ' <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">iDiscuss</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Contact</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Controls
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="allusertable.php">Users</a></li>
                <li><a class="dropdown-item" href="allquestions.php">Questions</a></li>
                <li><a class="dropdown-item" href="allpost.php">Posts</a></li>
              </ul>
            </li>
          </ul>';
        if(isset($_SESSION['loggedin']) && ($_SESSION['loggedin'] == true)){
          echo '<a class="btn btn-outline-danger me-2" type="button" role="button" href="adminlogout.php">Logout</a>';
           
         }
        //  <button class="btn btn-outline-primary" type="submit">Signup</button>
        //else{
        //   echo '<a class="btn btn-outline-danger me-2" type="button" role="button" href="adminlogin.php">Login</a>';
        // }
   echo '</div>
  </div>
  </nav>';
      

  ?>

      <?php 
     
      include '../partials/dbconnect.php';
      $updatesuccess = "false";
      $categorysuccess = "false";
      $show = isset($_GET['updatesuccess']);
      if($show=='true'){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Update successfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      }else if($show=='false'){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Failed!</strong> Update unsuccessful.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      }
      
      // category status
      $status = isset($_GET['categorysuccess']);
      if($status=="true"){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Created successfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      }else if($status=="false"){
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Failed!</strong> create unsuccessful.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      }
      
      ?>



<!-- category container is start -->
<div class="container my-4">
    <div class="d-flex justify-content-end mt-3 pe-3">
        <a href="addcategory.php" type="button" role="button" class=" me-5 btn btn-primary">Add catergory</a>
    </div>
    <div class="row my-4">

        <!-- Fetch all categories -->
        <?php
         $sql= "SELECT * FROM `categories`";
        $result = mysqli_query($conn , $sql);
        while($row = mysqli_fetch_assoc($result)){
            // echo $row['category_name'];
            $catid = $row['category_id'];
            $cat = $row['category_name'];
            $desc = $row['category_description'];
            echo ' <div class="col-4">
                      <div class="card my-4" style="width: 18rem;">
                          <img src="https://source.unsplash.com/1600x900/?' . $cat.',coding". class="card-img-top" alt="...">
                          <div class="card-body">
                              <h5 class="card-title"><a href="adminthreads.php?catid='. $catid .'">' . $cat .'</a></h5>
                              <p class="card-text">'. substr($desc ,0, 140) . '.... </p>
                              <a href="adminthreads.php?catid='. $catid .'" class="btn btn-primary">View Therdes</a>
                              <a href="categoryadminedit.php?catid='. $catid .'" class="btn btn-primary">Edit</a>
                              <a href="categorydelete.php?catid='. $catid .'" class="btn btn-primary">Delete</a>
                          </div>
                      </div>
                    </div>';
              }
            ?>
    </div>
</div>