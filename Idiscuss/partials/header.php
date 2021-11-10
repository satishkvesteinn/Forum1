<?php
session_start();

echo '
<!-- navbar is starting is here -->

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/idiscuss/index.php">iDiscuss</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/idiscuss/index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="#">Contact</a>
      </li>
      </ul>
      <div class="d-flex">';
      if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
        echo '<form class="d-flex me-2">
        <p class= "text-light align-self-center my-0 mx-2" >'. $_SESSION['user_name'] .'</p>
        <a class="btn btn-outline-danger me-2" role="button" href="partials/logout.php" type="submit">Logout</a>
      </form>';
      }else{
      
      echo '<form class="d-flex me-2">
    </form>
        <button class="btn btn-outline-danger me-2" type="submit" data-bs-toggle="modal" data-bs-target="#loginmodal">Login</button>
        <button class="btn btn-outline-primary" type="submit" data-bs-toggle="modal" data-bs-target="#signmodal">Signup</button>';
      }

    echo '</div>
    </div>
  </div>
</nav>';

include 'login.php';
include 'signup.php';
if(isset($_GET['signupsuccess']) && ($_GET['signupsuccess'] == "true")){
  echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
  <strong>Congartulations!</strong> You can login now.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}else if(isset($_GET['signupsuccess']) && ($_GET['signupsuccess'] == "false")){
  echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
  <strong>Sorry!</strong> This user name or email id is alerady exist.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
if(isset($_GET['loginsuccess']) && ($_GET['loginsuccess'] == "true")){
  echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
 Welcome back....
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}else if(isset($_GET['loginsuccess']) && ($_GET['loginsuccess'] == "false")){
  echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
  <strong>Sorry!</strong> This user name or password is incorrect.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
// }else{
//   echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
//   <strong>Sorry!</strong> This user name is already exisit.
//   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
// </div>';
// }

?>